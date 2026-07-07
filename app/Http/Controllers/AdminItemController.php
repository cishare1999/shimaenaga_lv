<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\UserData;
use App\UserItem;
use App\Sendmessage;
use App\Message;

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




class AdminItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $items = UserItem::orderBy('created_at', 'desc')->get();

      return view('admin.item.index', compact('items'));
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $item = UserItem::where('id', $id)->first();

      $user = User::where('id', $item->user_id)->first();

      return view('admin.item.show', compact('item', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }


    //LINE　APIをつなげる記述
    private $channel_secret, $access_token;

    public function __construct() {

        $this->channel_secret = env('LINE_CHANNEL_SECRET');
        $this->access_token = env('LINE_ACCESS_TOKEN');

    }

    public function status(Request $request, $id)
    {
        $item = UserItem::where('id', $id)->first();
    
        // 現在の status_total の値を保持
        $originalStatusTotal = $item->status_total;
    
        // リクエストデータをモデルに設定
        $item->contract_cancel = $request->contract_cancel;
        $item->status_total = $request->status_total;
        $item->status_paid = $request->status_paid;
        $item->judge_price = $request->judge_price;
        $item->for_user = $request->for_user;
    
        if ($request->reset_agree) {
            $item->user_agree = null;    
        }
    
        // 特定のステータスの場合、メモを更新
        if ($request->status_total == "代金振込済") {
            $item->memo = date("Y/m/d H:i:s");
        }
    
        // モデルが変更されている場合は保存
        if ($item->isDirty()) {
            $item->save();
        }
    
        // status_paidが取引完了じゃなければこの中を実行する
        // if ($request->status_paid != "取引完了") {
        if (!in_array($request->status_paid, ["取引完了", "取引完了遅延"], true)) {

        // status_total が変更された場合の特定の処理
        // if ($originalStatusTotal !== $request->status_total) {
            // ステータスでLINEへのメッセージ送信
            $users = User::where('id', $item->user_id)->first();
            $line_id = $users->line_id;
    
            $client = new CurlHTTPClient($this->access_token);
            $bot = new LINEBot($client, ['channelSecret' => $this->channel_secret]);
    
            if ($request->status_total == "査定完了（買取可）") {
                $sendtext = Sendmessage::where('id', 6)->first();
                $msg_ok = $sendtext->sentence;
                $msg_ok .= "\n\n";
    
                if ($item) {
                    // 照合に成功した場合の処理
                    $msg_ok .= "【買取申込情報】\n";
                    $msg_ok .= "買取申込ID: " . $item->id . "\n";
                    $msg_ok .= "申込日時: " . Functions::hisDateFnc($item->created_at) . "\n";
                    $msg_ok .= "申込状態: " . $item->status_total . "\n";
                    $msg_ok .= "買取方法: " . $item->way . "\n";
                    $msg_ok .= "商品名: " . $item->item_name . "\n";
                    $msg_ok .= "ステータス: " . $item->status_paid . "\n";
                    $msg_ok .= "査定額: " . $item->judge_price . "\n";
                    $msg_ok .= "備考: " . $item->for_user . "\n";
                }
    
                $msg_ok .= "\n\n注意事項確認URL\n" . config('app.domain_url') . '/attention';
    
                // まずは定型文を発出
                $textMessage = new TextMessageBuilder($msg_ok);
                // pushメッセージを送信
                $response = $bot->pushMessage($line_id, $textMessage);
    
                $msg1 = new Message; 
                $msg1->line_id = $line_id;
                $msg1->send_type = "送信";
                $msg1->text = $msg_ok;
                $msg1->save();
    
                // $s_tx = "承認ID：" . $item->id;
                // // ボタンテンプレートを作成
                // $buttonTemplate = new ButtonTemplateBuilder(
                //     '承認ボタン',  // テンプレートのタイトル
                //     '査定金額を確認して承認ボタンを押してください。',  // テンプレートの説明
                //     null,  // テンプレートのサムネイル画像URL
                //     [  // ボタンの配列
                //         new MessageTemplateActionBuilder('承認', $s_tx)
                //     ]
                // );
                // // ボタンテンプレートメッセージを作成
                // $buttonMessage = new TemplateMessageBuilder('承認ボタン', $buttonTemplate);
                // $response2 = $bot->pushMessage($line_id, $buttonMessage);
    
                // $msg2 = new Message; 
                // $msg2->line_id = $line_id;
                // $msg2->send_type = "送信";
                // $msg2->text = "承認ボタン";
                // $msg2->save();

                // 2026.01.29 add
                // LIFF同意フォームURL（item_id付き）
                $agreementLiffUrl = 'https://liff.line.me/' . env('LINE_LIFF_AGREEMENT_ID') . '?item_id=' . $item->id;

                $buttonTemplate = new ButtonTemplateBuilder(
                    '買取同意フォーム',
                    '査定内容をご確認のうえ、買取同意フォームを開いて手続きを完了してください。',
                    null,
                    [
                        new UriTemplateActionBuilder('買取同意フォームを開く', $agreementLiffUrl),
                    ]
                );

                $buttonMessage = new TemplateMessageBuilder('買取同意フォーム', $buttonTemplate);
                $response2 = $bot->pushMessage($line_id, $buttonMessage);

                $msg2 = new Message;
                $msg2->line_id = $line_id;
                $msg2->send_type = "送信";
                $msg2->text = "買取同意フォームボタン\n" . $agreementLiffUrl;
                $msg2->save();

    
            } elseif ($request->status_total == "査定完了（買取不可）") {
                $sendtext = Sendmessage::where('id', 7)->first();
    
                $textMessage = new TextMessageBuilder($sendtext->sentence);
                // pushメッセージを送信
                $response = $bot->pushMessage($line_id, $textMessage);
    
                $msg1 = new Message; 
                $msg1->line_id = $line_id;
                $msg1->send_type = "送信";
                $msg1->text = $sendtext->sentence;
                $msg1->save();
            } elseif ($request->status_total == "代金振込済") {
                $sendtext = Sendmessage::where('id', 8)->first();
    
                $textMessage = new TextMessageBuilder($sendtext->sentence);
                // pushメッセージを送信
                $response = $bot->pushMessage($line_id, $textMessage);
    
                $msg1 = new Message; 
                $msg1->line_id = $line_id;
                $msg1->send_type = "送信";
                $msg1->text = $sendtext->sentence;
                $msg1->save();
            }
        // }// status_total が変更された場合の特定の処理end
        }
        return redirect('/admin/list/'.$id)->with('message', '買取ステータスを変更しました');
    }


    public function memo(Request $request, $id)
    {
      $userdata = UserData::where('user_id', $request->user_id)->first();
      $userdata->memo = $request->memo;
      $userdata->save();
      
      return redirect('/admin/items/'.$id)->with('message', 'メモを変更しました');
    }

    public function image(Request $request, $id)
    {

      $item = UserItem::where('user_id', $id)->first();

      return view('admin.item.image', compact('item', 'request'));
    }

    public function imageupdate(Request $request, $id)
    {

      $item = UserItem::where('id', $id)->first();

      if($request->file('files1')) {
        $files1 = $request->file('files1');
        $temp1 = $files1->store('public/temp');

        $image1 = str_replace('public/temp/', '', $temp1);
        Storage::move($temp1, 'public/image/'.$image1);

        $item->item_image1 = $image1;
      }

      if($request->file('files2')) {
        $files2 = $request->file('files2');
        $temp2 = $files2->store('public/temp');

        $image2 = str_replace('public/temp/', '', $temp2);
        Storage::move($temp2, 'public/image/'.$image2);

        $item->item_image2 = $image2;
      }

      if($request->file('files3')) {
        $files3 = $request->file('files3');
        $temp3 = $files3->store('public/temp');

        $image3 = str_replace('public/temp/', '', $temp3);
        Storage::move($temp3, 'public/image/'.$image3);

        $item->item_image3 = $image3;
      }

      $item->save();

      return redirect('/admin/list/'.$request->item)->with('message', '商品画像を変更しました');

      /*
      return redirect('/admin/users/'.$id)->with('message', '画像を変更しました');
      */
    }
    public function contract(Request $request, $id)
    {
      $item = UserItem::where('id', $id)->first();
      // $item->contract_cancel = $request->contract_cancel;
      $item->contract_repayment_date = $request->contract_repayment_date;
      $item->contract_deadline_date = $request->contract_deadline_date;
      $item->contract_issu_date = date("Y-m-d");
      $item->contract_status = 1;


      $item->save();

      if($request->page == "showlist"){//list詳細ページなら
        return redirect('/admin/list/'.$id)->with('message', '契約書情報を変更しました');
      }else{
        return redirect('/admin/list/contract/'.$id)->with('message', '契約書情報を変更しました');
      }

      return redirect('/admin/list/contract/'.$id)->with('message', '契約書情報を変更しました');

      //return redirect('/admin/items/'.$id)->with('message', 'ステータスを変更しました');
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
