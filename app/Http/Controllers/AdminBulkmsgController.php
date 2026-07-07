<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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




class AdminBulkmsgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        if ($request->for_user) {
            $query->where('for_user', 'LIKE', '%' . $request->for_user . '%');
        }
        // $items = $request->concon == 1 ? ($commonList || $request->status_total || $request->status_paid ? $query->orderBy('created_at', 'desc')->paginate(100) : $query->orderBy('created_at', 'desc')->paginate(100)) : $query->orderBy('created_at', 'desc')->paginate(100);
        // $items = $request->concon == 1 ? ($commonList || $request->status_total || $request->status_paid ? $query->orderBy('created_at', 'desc')->get() : $query->orderBy('created_at', 'desc')->get()) : $query->orderBy('created_at', 'desc')->get();
        if ($request->concon == 1) {
          if ($commonList || $request->status_total || $request->status_paid) {
              $items = $query->orderBy('created_at', 'desc')->get();
              //件数カウント
              $itemCount = $items->count(); // $itemsの件数をカウント
          } else {
              $items = $query->orderBy('created_at', 'desc')->get();
              //件数カウント
              $itemCount = $items->count(); // $itemsの件数をカウント
          }
        } else {
            $items = "";
            $itemCount = "";
        }

        return view('admin.bulkmsg.index', compact('request', 'items','itemCount'));
    }

    public function bulkmsgConfirm(Request $request)
    {
      $userItemIds = $request->input('bulk_id');
      $bulk_id = implode(',', $userItemIds);
      $items = UserItem::whereIn('id', $userItemIds)->get();
      $itemCount = $items->count(); // $itemsの件数をカウント
      // dd($itemCount);
      return view('admin.bulkmsg.confirm', compact('items', 'bulk_id', 'itemCount'));

    }

    //LINE　APIをつなげる記述
    private $channel_secret, $access_token;

    public function __construct() {

        $this->channel_secret = env('LINE_CHANNEL_SECRET');
        $this->access_token = env('LINE_ACCESS_TOKEN');

    }

    public function bulkmsgComplete(Request $request)
    {
      // dd($request);
      $userItemIds = $request->input('bulk_id');//送るuser_itemsのid
      $userItemIds = explode(',', $userItemIds);//idをカンマから配列に
      $sendmsg = $request->sentence;

      //LINEを送信するための初期化
      $client = new CurlHTTPClient($this->access_token);
      $bot = new LINEBot($client, ['channelSecret' => $this->channel_secret]);
      // メッセージの作成
      $textMessage = new TextMessageBuilder($sendmsg);

      // ユーザーIDの配列
      $userIds = [];
      foreach ($userItemIds as $userItemId) {
          $userItem = UserItem::find($userItemId);
          if ($userItem) {
              $userIds[] = $userItem->user->line_id;
          }
      }
      // 重複するline_idを除去する
      $userIdsUnique = array_unique($userIds);
      // dd($userIds);
      // dd($userIdsUnique);
      
      // ユーザーIDの配列からマルチキャストを送信
      if (!empty($userIdsUnique)) {
        //マルチキャスト送信　※使えなかった
        // $response = $bot->multicast($userIdsUnique, $textMessage);

        // メッセージの送信履歴を保存
        foreach ($userIdsUnique as $lineId) {

            // メッセージを送信
            $response = $bot->pushMessage($lineId, $textMessage);

            $msg1 = new Message; 
            $msg1->line_id = $lineId;
            $msg1->send_type = "送信";
            $msg1->text = $sendmsg;
            $msg1->save();
        }
      }

      return view('admin.bulkmsg.complete', compact('userIds'));

    }




  }
