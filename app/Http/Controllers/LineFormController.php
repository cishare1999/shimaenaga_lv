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


class LineFormController extends Controller
{
    private $channel_secret, $access_token;

    public function __construct() {

        $this->channel_secret = env('LINE_CHANNEL_SECRET');
        $this->access_token = env('LINE_ACCESS_TOKEN');

    }

    public function showForm()
    {
        $liff01_id = env('LINE_LIFF01_ID');
        // return view('line.form');
        return view('line.form',compact('liff01_id'));
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
                return response()->json(['st' => "NG"]);
            }else{
                return response()->json(['st' => "OK"]);
            }
        }
    }

    public function submitForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'kana' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'birthday_year' => 'required',
            'birthday_month' => 'required',
            'birthday_day' => 'required',
            'gender' => 'required',
            'zip' => 'required',
            'pref' => 'required',
            'city' => 'required',
            'address' => 'required',
            'bank_name' => 'required',
            'branch_name' => 'required',
            'branch_code' => 'required',
            'bank_type' => 'required',
            'bank_number' => 'required',
            'bank_kana' => 'required',
            'work_name' => 'required',
            'work_tel' => 'required',
            'work_zip' => 'required',
            'work_pref' => 'required',
            'work_city' => 'required',
            'work_address' => 'required',
            'salary' => 'required',
            'payday' => 'required',
            // itemの確認
            'way' => 'required',
            'status_item' => 'required',
            'comment' => 'required',
            'price' => 'required',
            'terms' => 'required',
            'terms2' => 'required',
        ], [
            'name.required' => '名前を入力してください。',
            'kana.required' => 'カナを入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'mobile.required' => '電話番号を入力してください。',
            'birthday_year.required' => '年を選択してください。',
            'birthday_month.required' => '月を選択してください。',
            'birthday_day.required' => '日を選択してください。',
            'gender.required' => '性別を選択してください。',
            'zip.required' => '郵便番号を入力してください。',
            'pref.required' => '都道府県を入力してください。',
            'city.required' => '市区町村を入力してください。',
            'address.required' => '番地以降を入力してください。',
            'bank_name.required' => '銀行名を入力してください。',
            'branch_name.required' => '支店名を入力してください。',
            'branch_code.required' => '支店番号を入力してください。',
            'bank_type.required' => '口座種別を入力してください。',
            'bank_number.required' => '口座番号を入力してください。',
            'bank_kana.required' => '口座名義（カナ）を入力してください。',
            'work_name.required' => '勤務先名を入力してください。',
            'work_tel.required' => '勤務先 電話番号を入力してください。',
            'work_zip.required' => '勤務先 郵便番号を入力してください。',
            'work_pref.required' => '勤務先 都道府県を入力してください。',
            'work_city.required' => '勤務先 市区町村を入力してください。',
            'work_address.required' => '勤務先 番地以降を入力してください。',
            'salary.required' => '月額給与額を入力してください。',
            'payday.required' => '給料日を入力してください。',
            // itemの確認
            'way.required' => '買取方法を選択してください。',
            'status_item.required' => '商品を選択してください。',
            'comment.required' => '商品説明を入力してください。',
            'price.required' => '希望金額を選択してください。',
            'terms.required' => '利用規約を選択してください。',
            'terms2.required' => '手元に商品があるので買取を申し込むを選択してください。',

        ]);

        //バリデーションを返す
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()], 422);
            } 
        }

        //データの検証と登録
        $u_user = User::where('line_id', $request->line_id)->first();//usersにあるかどうか
        //user_data
        $user_data = UserData::where('user_id', $u_user->id)->first();//user_idでuser_dataにあるかどうか
        //２回目の登録を防ぐ
        if($user_data->kana && $user_data->birthday){
            $tt = array("udata" => array(0=>'お客様情報は登録されています。変更される場合は直接メッセージにてご連絡ください。'));
            // $errors = "お客様情報は登録されています。\n変更される場合は直接メッセージにてご連絡ください。";
            return response()->json(['errors' => $tt], 422);
        }else{
            //users
            $u_user->name = $request->name;
            $u_user->mobile = $request->mobile;
            $u_user->email = $request->email;
            // $u_user->from_url = "lp";//LPの時使う予定
            $u_user->save();

            //生年月日変換
            $birthday_res = $request->birthday_year."/".$request->birthday_month."/".$request->birthday_day;
            $birthday = date('Y/m/d',strtotime($birthday_res));

            
            //user_data
            // $user_data = new UserData; 
            $user_data->user_id = $u_user->id;
            $user_data->kana =  $request->kana;
            // $user_data->birthday =  $request->birthday_year."/".$request->birthday_month."/".$request->birthday_day;
            $user_data->birthday =  $birthday;
            $user_data->gender =  $request->gender;
            $user_data->zip =  $request->zip;
            $user_data->pref =  $request->pref;
            $user_data->city =  $request->city;
            $user_data->address =  $request->address;
            $user_data->building =  $request->building;
            $user_data->bank_name =  $request->bank_name;
            $user_data->branch_name =  $request->branch_name;
            $user_data->branch_code =  $request->branch_code;
            $user_data->bank_type =  $request->bank_type;
            $user_data->bank_number =  $request->bank_number;
            $user_data->bank_kana =  $request->bank_kana;
            $user_data->work_name =  $request->work_name;
            $user_data->work_tel =  $request->work_tel;
            $user_data->work_zip =  $request->work_zip;
            $user_data->work_pref =  $request->work_pref;
            $user_data->work_city =  $request->work_city;
            $user_data->work_address =  $request->work_address;
            $user_data->work_building =  $request->work_building;
            $user_data->salary =  $request->salary;
            $user_data->payday =  $request->payday;
            $user_data->save();

            // 2023.09.08追加　新規で買取情報まで登録する
            //item申込を登録
            $item = new UserItem;    
            $item->user_id = $u_user->id;
            $item->way = $request->way;

            //商品を追加したので数字(status_item)を使わないようにする 2025.06.05
            $item->status_item = "";
            $item->item_name = $request->status_item;
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
        

        }


        $message = "入力されたフォームの内容:\n";
        $message .= "名前: " . $request->name . "\n";
        $message .= "カナ: " . $request->kana . "\n";
        $message .= "電話番号: " . $request->mobile . "\n";
        $message .= "メールアドレス: " . $request->email . "\n";
        $message .= "生年月日: " . $request->birthday_year."/".$request->birthday_month."/".$request->birthday_day . "\n";
        $message .= "性別: " . $request->gender . "\n";
        $message .= "住所: " . $request->zip." ".$request->pref. $request->city.$request->address. $request->building. "\n";
        $message .= "口座情報: " . $request->bank_name." ".$request->branch_name."(".$request->branch_code.")". $request->bank_type.$request->bank_number. $request->bank_kana. "\n";
        $message .= "勤務先名: " . $request->work_name . "\n";
        $message .= "勤務先電話: " . $request->work_tel . "\n";
        $message .= "勤務先名住所: " . $request->work_zip." ".$request->work_pref. $request->work_city.$request->work_address. $request->work_building. "\n";
        $message .= "月額給与額: " . $request->salary . "\n";
        $message .= "給料日: " . $request->payday . "\n";
        // itemの追加
        $message .= "買取方法: " . $request->way . "\n";

        //商品を追加したので数字(status_item)を使わないようにする 2025.06.05
        // if($request->status_item == 21){
        //     $ii_name = "全国百貨店共通商品券";
        // }elseif($request->status_item == 22){
        //     $ii_name = "ギフト券";
        // }
        // $message .= "商品: " . $ii_name . "\n";
        $message .= "商品: " . $request->status_item . "\n";


        $message .= "商品説明: " . $request->comment . "\n";
        $message .= "希望金額: " . $request->price . "\n";

        return response()->json(['message' => $message]);


    }

}