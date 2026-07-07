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
use App\Sendmessage;
use App\Message;

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




class AdminListController extends Controller
{
  public function index(Request $request)
  {
      $tel = $request->tel;
      $kana = $request->kana;
      $birthday = $request->birthday;
      $name = $request->name;
      $emergency = $request->emergency;

      $list = [];

      if ($tel) {
          $list[] = User::where('mobile', 'LIKE', "%$tel%")->pluck('id')->toArray();
      }
      if ($kana) {
          $list[] = UserData::where('kana', 'LIKE', "%$kana%")->pluck('user_id')->map('intval')->toArray();
      }
      if ($birthday) {
          $list[] = UserData::where('birthday', $birthday)->pluck('user_id')->map('intval')->toArray();
      }
      if ($name) {
          $list[] = User::where('name', 'LIKE', "%$name%")->pluck('id')->toArray();
      }
      if ($emergency) {
          $list[] = UserData::where('emergency_1', 'LIKE', "%$emergency%")
              ->orWhere('emergency_2', 'LIKE', "%$emergency%")
              ->pluck('user_id')->map('intval')->toArray();
      }

      $commonList = count($list) > 0 ? $list[0] : [];

      for ($i = 1; $i < count($list); $i++) {
          $commonList = array_values(array_intersect($commonList, $list[$i]));
      }

      $query = UserItem::query();

      if (!empty($commonList)) {
          $query->whereIn('user_id', $commonList);
      }
      if ($request->status_total) {
          $query->where('status_total', $request->status_total);
      }
      if ($request->status_paid) {
          $query->where('status_paid', $request->status_paid);
          // $query->where('id', '-999');
      }

      $items = $request->concon == 1 ? ($commonList || $request->status_total || $request->status_paid ? $query->orderBy('created_at', 'desc')->paginate(100) : $query->orderBy('created_at', 'desc')->paginate(100)) : $query->orderBy('created_at', 'desc')->paginate(100);

      // 現在の検索条件をページネーションのリンクに含める
      $items->appends([
        'status_total' => $request->status_total,
        'status_paid' => $request->status_paid,
        'tel' => $tel,
        'kana' => $kana,
        'birthday' => $birthday,
        'name' => $name,
        'emergency' => $emergency,
      ]);

      return view('admin.list.index', compact('request', 'items'));
  }

  public function show($id)
  {
    $item = UserItem::where('id', $id)->first();

    $user = User::where('id', $item->user_id)->first();

    $userlist = UserItem::where('user_id', $item->user_id)->orderBy('created_at', 'desc')->get();
    //API でセンターに情報問合せ
    // $context = stream_context_create(array(
    //   'http' => array(
    //       'ignore_errors' => true,
    //       'method'  => 'GET', 
    //       'timeout' => 100),
    //   'ssl' => array(
    //       'verify_peer'      => false,
    //       'verify_peer_name' => false
    //   )
    // ));
    // $kana = str_replace(array(" ", "　"), "", $user->userData->kana);
    // $birthday = date("Ymd", strtotime($user->userData->birthday));
    // $url = config('app.kanri_api_url').$kana.'/'.$birthday;
    //  // APIを呼び出す
    // // dd($url);
    // $json = file_get_contents($url, false, $context);
    // $json_data = json_decode($json);  // JSONを配列に
    // // dd($json_data);

    
    // // 正常ならViewに渡す
    // if ($json_data) {
    //   $reports = $json_data;
    // } else {
    //   $reports = null;
    // }    
    // dd($reports);

    //LINE送信画像の読み込み
    $u_img = Message::where('line_id', $user->line_id)->where('send_type', '=', '画像')->orderBy('created_at', 'asc')->get();
    $chatmsg = Message::where('line_id', $user->line_id)->orderBy('created_at', 'asc')->get();
    // dd($u_img);

    //定型文の読み込み
    $sendtext = Sendmessage::whereNotIn('id', [6,7])->orderBy('created_at', 'asc')->get();

    // return view('admin.list.show', compact('item', 'user', 'userlist', 'u_img', 'sendtext', 'chatmsg', 'reports'));
    return view('admin.list.show', compact('item', 'user', 'userlist', 'u_img', 'sendtext', 'chatmsg'));
  }


  public function contract($id)
  {
    $item = UserItem::where('id', $id)->first();

    $user = User::where('id', $item->user_id)->first();

    return view('admin.list.contract', compact('item', 'user'));
  }
  public function pdf($id)
  {
      $item = UserItem::where('id', $id)->first();

      $user = User::where('id', $item->user_id)->first();
      $file_name = $item->contract_issu_date.$user->name.'様買取契約書.pdf';
      
      $year = date('Y',strtotime($item->contract_repayment_date));
      $yy = Functions::wareki($year);
      $repayment_date = $yy.date('m月d日',strtotime($item->contract_repayment_date));
      
      $year2 = date('Y',strtotime($item->contract_deadline_date));
      $yy2 = Functions::wareki($year2);
      $deadline_date = $yy2.date('m月d日',strtotime($item->contract_deadline_date));

      $year3 = date('Y',strtotime($item->contract_issu_date));
      $yy3 = Functions::wareki($year3);
      $issu_date = $yy3.date('m月d日',strtotime($item->contract_issu_date));
      //印鑑画像の処理
      $image_path = storage_path('inkan.png');
      $image_data = base64_encode(file_get_contents($image_path));
      
      // $pdf = PDF::loadHTML('<h1>Hello World</h1>');
      $pdf = PDF::loadView('admin.list.contract_pdf', compact('item','user','repayment_date','deadline_date','issu_date','image_data'));

      return $pdf->download($file_name);
      // return $pdf->stream($file_name);
  }
 

}
