<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\LineUser;
use App\User;
use App\UserData;
use App\UserItem;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use LINE\LINEBot;
use LINE\LINEBot\Event\FollowEvent;
use LINE\LINEBot\Event\UnfollowEvent;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\ImagemapActionBuilder\AreaBuilder;
use LINE\LINEBot\ImagemapActionBuilder\ImagemapUriActionBuilder;
use LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder;
use LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;


class LineItemFormController extends Controller
{
    private $channel_secret, $access_token;

    public function __construct() {

        $this->channel_secret = env('LINE_CHANNEL_SECRET');
        $this->access_token = env('LINE_ACCESS_TOKEN');

    }


    public function showForm()
    {
        $liff01_item_id = env('LINE_LIFF01_ITEM_ID');
        // return view('line.form');
        return view('line.itemform',compact('liff01_item_id'));
    }

    public function statusForm(Request $request)
    {
        //顧客情報が登録されていないのに買取申請フォームを開く場合の処理
        //データの検証と登録
        $u_user = User::where('line_id', $request->line_id)->first();//usersにあるかどうか
        //user_data
        $user_data = UserData::where('user_id', $u_user->id)->first();//user_idでuser_dataにあるかどうか
        if (!empty($user_data)) { 
            if($user_data->kana && $user_data->birthday){
                $item_chk = UserItem::where('user_id', $u_user->id)->where('status_total','査定中')->first();//
                if(empty($item_chk)){
                    return response()->json(['st' => "OK"]);
                }else{
                    return response()->json(['st' => "CHK"]);
                }
            }else{
                return response()->json(['st' => "NG"]);
            }
        }
    }

    public function submitForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'way' => 'required',
            'status_item' => 'required',
            'comment' => 'required',
            'price' => 'required',
            'terms' => 'required',
            'terms2' => 'required',
            'chk_2time' => 'required',
        ], [
            'way.required' => '買取方法を選択してください。',
            'status_item.required' => '商品を選択してください。',
            'comment.required' => '商品説明を入力してください。',
            'price.required' => '希望金額を選択してください。',
            'terms.required' => '利用規約を選択してください。',
            'terms2.required' => '手元に商品があるので買取を申し込むを選択してください。',
            'chk_2time.required' => '利用規約2を選択してください。',
        ]);

        //バリデーションを返す
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } 
        }

        //ユーザーIDを取得
        $user = User::where('line_id', $request->line_id)->first();//usersにあるかどうか

        //申込を登録
        $item = new UserItem;    
        $item->user_id = $user->id;
        $item->way = $request->way;

        //商品を追加したので数字(status_item)を使わないようにする 2025.06.05
        $item->status_item = "";
        $item->item_name = $request->status_item;
        // $item->status_item = $request->status_item;
        // $item->item_name = "";
        // if($request->status_item == 21){
        //     $item->item_name = "全国百貨店共通商品券";
        // }elseif($request->status_item == 22){
        //     $item->item_name = "ギフト券";
        // }
        $item->condition = "新品";
        $item->comment = $request->comment;
        $item->price = $request->price;

        $item->status_total = '査定中';
        $item->memo = '';
        $item->save();
    
        //メッセージを返す
        $message = "買取申込内容:\n";
        $message .= "買取方法: " . $request->way . "\n";

        // if($request->status_item == 21){
        //     $message .= "商品: 全国百貨店共通商品券\n";
        // }elseif($request->status_item == 22){
        //     $message .= "商品: ギフト券\n";
        // }
        //商品を追加したので数字(status_item)を使わないようにする 2025.06.05
        $message .= "商品: " . $request->status_item . "\n";


        $message .= "商品説明: " . $request->comment . "\n";
        $message .= "希望金額: " . $request->price . "\n";

        return response()->json(['message' => $message]);


    }

}