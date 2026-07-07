<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

Paginator::useBootstrap();

use App\User;
use App\UserData;
use App\UserItem;
use App\Message;
use App\Sendmessage;
use Mail;
use PDF;
use Functions;

//LINE用の読み込み
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
use LINE\LINEBot\Event\MessageEvent\UnknownMessageContent;

use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\Event\MessageEvent\ImageMessage;
use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;

use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;

use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\Event\MessageEvent\StickerMessage;



class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      // $users = User::orderBy('created_at', 'desc')->paginate(30);
      // return view('admin.user.index', compact('users', 'request'));

    
      $tel = $request->tel;
      if($tel) {
        $query1 = User::query();
        $query1->where('mobile', 'LIKE', "%$tel%");
        $list1 = $query1->pluck('id')->toArray();
      } else {
        $list1 = [];
      }
      $name = $request->name;
      if($name) {
        $query2 = User::query();
        $query2->where('name', 'LIKE', "%$name%");
        $list2 = $query2->pluck('id')->toArray();
        $list2 = array_map('intval', $list2);
      } else {
        $list2 = [];
      }

      if($tel && $name) {
        $list = array_intersect($list1, $list2);
      } elseif($tel) {
        $list = $list1;
      } elseif ($name) {
        $list = $list2;
      } else {
        $list = [];
      }

      $query = User::query();

      if( !empty($list) ) {
        $query->whereIn('id', $list);
      }
      $users = $query->orderBy('created_at', 'desc')->paginate(100);
      // dd($users);
      return view('admin.user.index', compact('request', 'users'));





    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = User::where('id', $id)->first();

      $items = UserItem::where('user_id', $id)->orderBy('created_at', 'desc')->get();

      //API でセンターに情報問合せ
    //   $context = stream_context_create(array(
    //     'http' => array(
    //         'ignore_errors' => true,
    //         'method'  => 'GET', 
    //         'timeout' => 10),
    //     'ssl' => array(
    //         'verify_peer'      => false,
    //         'verify_peer_name' => false
    //     )
    // ));

    //   $kana = str_replace(array(" ", "　"), "", $user->userData->kana);
    //   $birthday = date("Ymd", strtotime($user->userData->birthday));
    //   $url = config('app.kanri_api_url').$kana.'/'.$birthday;
    //   // APIを呼び出す
    //   // dd($url);
    //   $json = file_get_contents($url, false, $context);
    //   $json_data = json_decode($json);  // JSONを配列に
    //   // dd($json_data);

    //   // 正常ならViewに渡す
    //   if ($json_data) {
    //     $reports = $json_data;
    //   } else {
    //     $reports = null;
    //   }    

      $item = "";
      //LINE送信画像の読み込み
      $u_img = Message::where('line_id', $user->line_id)->where('send_type', '=', '画像')->orderBy('created_at', 'asc')->get();
      $chatmsg = Message::where('line_id', $user->line_id)->orderBy('created_at', 'asc')->get();
      // dd($u_img);

      //定型文の読み込み
      $sendtext = Sendmessage::whereNotIn('id', [6,7])->orderBy('created_at', 'asc')->get();


      // return view('admin.user.show', compact('user', 'items', 'u_img', 'reports','sendtext', 'chatmsg', 'item'));
      return view('admin.user.show', compact('user', 'items', 'u_img','sendtext', 'chatmsg', 'item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

      $user = User::where('id', $id)->first();

      return view('admin.user.edit', compact('user', 'request'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $user = User::where('id', $id)->first();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->mobile = $request->mobile;
      $user->display_name = $request->display_name;
      $user->save();

      $userdata = UserData::where('user_id', $id)->first();
      $userdata->kana = $request->kana;
      // $userdata->line = $request->line;
      $userdata->birthday = $request->birthday;
      $userdata->gender = $request->gender;
      // $userdata->contact = $request->contact;
      $userdata->zip = $request->zip;
      $userdata->pref = $request->pref;
      $userdata->city = $request->city;
      $userdata->address = $request->address;
      $userdata->building = $request->building;
      $userdata->bank_name = $request->bank_name;
      $userdata->bank_code = $request->bank_code;
      $userdata->branch_name = $request->branch_name;
      $userdata->branch_code = $request->branch_code;
      $userdata->bank_type = $request->bank_type;
      $userdata->bank_number = $request->bank_number;
      $userdata->bank_kana = $request->bank_kana;
      $userdata->work_name = $request->work_name;
      $userdata->work_tel = $request->work_tel;
      $userdata->work_zip = $request->work_zip;
      $userdata->work_pref = $request->work_pref;
      $userdata->work_city = $request->work_city;
      $userdata->work_address = $request->work_address;
      $userdata->work_building = $request->work_building;
      $userdata->salary = $request->salary;
      $userdata->payday = $request->payday;
      $userdata->save();

      return redirect('/admin/list/'.$request->item)->with('message', '登録情報を変更しました');

      //return redirect('/admin/users/'.$id)->with('message', '登録情報を変更しました');

/*
kana
line
contact
zip
pref
city
address
building
bank_name
bank_code
branch_name
branch_code
bank_type
bank_number
bank_kana
work_name
work_tel
work_zip
work_pref
work_city
work_address
work_building
salary
payday
*/
      
    }

    public function status(Request $request, $id)
    {
      $userdata = UserData::where('user_id', $id)->first();
      $userdata->is_black = $request->is_black;
      $userdata->emergency_1 = $request->emergency_1;
      $userdata->emergency_2 = $request->emergency_2;
      $userdata->memo = $request->memo;
      $userdata->save();


      if($request->page == "users"){//ユーザーページ
        return redirect('/admin/users/'.$id)->with('message', 'ユーザーステータス・メモを変更しました');
      }else{
        return redirect('/admin/list/'.$request->item)->with('message', 'ユーザーステータス・メモを変更しました');
      }
    }

    public function email_verified(Request $request, $id)
    {
        // dd($request);
        $users = User::where('id', $id)->first();
        $users->email_verified_at = date('Y-m-d H:i:s');
        $users->save();
        return redirect('/admin/users')->with('message', 'ユーザーの仮登録を手動で認証しました。');
    }

    public function mailline(Request $request, $id)
    {
      $users = User::where('id', $id)->first();

      $mail_address = config('app.mail_address');
      $com_line_d = config('app.com_line');

      Mail::send('emails.linemail', [
        'com_line' => $com_line_d,
      ], function($message) use($users, $mail_address){
        $message->from($mail_address, '買取シマエナガ')->to($users->email)->subject('LINE登録お願い致します。');
      });

      
      
      if($request->page == "users"){//ユーザーページ
        return redirect('/admin/users/'.$id)->with('message', 'メールを送信しました。');
      }else{
        return redirect('/admin/list/'.$request->item)->with('message', 'メールを送信しました。');
      }
    }
    
    
    public function mailcancel(Request $request, $id)
    {
      $users = User::where('id', $id)->first();

      $mail_address = config('app.mail_address');
      // dd($mail_address);
      Mail::send('emails.cancelmail', [], 
        function($message) use($users, $mail_address){
        $message->from($mail_address, '買取シマエナガ')->to($users->email)->subject('査定結果のご案内');
      });
      
      if($request->page == "users"){//ユーザーページ
        return redirect('/admin/users/'.$id)->with('message', 'メールを送信しました。');
      }else{
        return redirect('/admin/list/'.$request->item)->with('message', 'メールを送信しました。');
      }
    }

    //LINE　APIをつなげる記述
    private $channel_secret, $access_token;

    public function __construct() {

        $this->channel_secret = env('LINE_CHANNEL_SECRET');
        $this->access_token = env('LINE_ACCESS_TOKEN');

    }

    //LINEメッセージのＰＵＳＨ送信
    public function line_sending(Request $request, $id)
    {
      $users = User::where('id', $id)->first();
      $line_id = $users->line_id;
      $msg = $request->line_send_msg;
      // dd($request);
      $client = new CurlHTTPClient($this->access_token);
      $bot = new LINEBot($client, ['channelSecret' => $this->channel_secret]);

      $textMessage = new TextMessageBuilder($msg);
      // pushメッセージを送信
      $response = $bot->pushMessage($line_id, $textMessage);

      $msg1 = new Message; 
      $msg1->line_id = $line_id;
      $msg1->send_type = "送信";
      $msg1->text = $msg;
      $msg1->save();

      
      if($request->item_id == ""){//ユーザーページ
        return redirect('/admin/users/'.$id)->with('message', 'LINEメッセージを送信しました。');
      }else{
        return redirect('/admin/list/'.$request->item_id)->with('message', 'LINEメッセージを送信しました。');
      }
    }









    public function image(Request $request, $id)
    {

      $user = User::where('id', $id)->first();

      return view('admin.user.image', compact('user', 'request'));
    }

    public function imageupdate(Request $request, $id)
    {

      $userdata = UserData::where('user_id', $id)->first();

      if($request->file('files1')) {
        $files1 = $request->file('files1');
        $temp1 = $files1->store('public/temp');

        $image1 = str_replace('public/temp/', '', $temp1);
        Storage::move($temp1, 'public/licence/'.$image1);

        $userdata->licence_1 = $image1;
      }

      if($request->file('files2')) {
        $files2 = $request->file('files2');
        $temp2 = $files2->store('public/temp');

        $image2 = str_replace('public/temp/', '', $temp2);
        Storage::move($temp2, 'public/licence/'.$image2);

        $userdata->licence_2 = $image2;
      }

      if($request->file('files3')) {
        $files3 = $request->file('files3');
        $temp3 = $files3->store('public/temp');

        $image3 = str_replace('public/temp/', '', $temp3);
        Storage::move($temp3, 'public/licence/'.$image3);

        $userdata->licence_3 = $image3;
      }

      if($request->file('files4')) {
        $files4 = $request->file('files4');
        $temp4 = $files4->store('public/temp');

        $image4 = str_replace('public/temp/', '', $temp4);
        Storage::move($temp4, 'public/licence/'.$image4);

        $userdata->licence_4 = $image4;
      }
      if($request->file('files5')) {
        $files5 = $request->file('files5');
        $temp5 = $files5->store('public/temp');

        $image5 = str_replace('public/temp/', '', $temp5);
        Storage::move($temp5, 'public/licence/'.$image5);

        $userdata->licence_5 = $image5;
      }
      if($request->file('files6')) {
        $files6 = $request->file('files6');
        $temp6 = $files6->store('public/temp');

        $image6 = str_replace('public/temp/', '', $temp6);
        Storage::move($temp6, 'public/licence/'.$image6);

        $userdata->licence_6 = $image6;
      }
      if($request->file('files7')) {
        $files7 = $request->file('files7');
        $temp7 = $files7->store('public/temp');

        $image7 = str_replace('public/temp/', '', $temp7);
        Storage::move($temp7, 'public/licence/'.$image7);

        $userdata->licence_7 = $image7;
      }
      if($request->file('files8')) {
        $files8 = $request->file('files8');
        $temp8 = $files8->store('public/temp');

        $image8 = str_replace('public/temp/', '', $temp8);
        Storage::move($temp8, 'public/licence/'.$image8);

        $userdata->licence_8 = $image8;
      }
      if($request->file('files9')) {
        $files9 = $request->file('files9');
        $temp9 = $files9->store('public/temp');

        $image9 = str_replace('public/temp/', '', $temp9);
        Storage::move($temp9, 'public/licence/'.$image9);

        $userdata->licence_9 = $image9;
      }
      if($request->file('files10')) {
        $files10 = $request->file('files10');
        $temp10 = $files10->store('public/temp');

        $image10 = str_replace('public/temp/', '', $temp10);
        Storage::move($temp10, 'public/licence/'.$image10);

        $userdata->licence_10 = $image10;
      }



      $userdata->save();

      return redirect('/admin/list/'.$request->item)->with('message', '身分証画像を変更しました');

      /*
      return redirect('/admin/users/'.$id)->with('message', '画像を変更しました');
      */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
  }
