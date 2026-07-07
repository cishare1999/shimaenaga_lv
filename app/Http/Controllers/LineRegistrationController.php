<?php

namespace App\Http\Controllers;

use App\LineUser;
use App\User;
use App\UserData;
use App\UserItem;
use App\Message;
use Functions;
use App\Referrer;//2024.06.28 add

use Illuminate\Http\Request;
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
use Illuminate\Support\Facades\Storage;

use LINE\LINEBot\MessageBuilder\TemplateBuilder\ButtonTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateMessageBuilder;
use LINE\LINEBot\TemplateActionBuilder\UriTemplateActionBuilder;
use LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder;

use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselColumnTemplateBuilder;
use LINE\LINEBot\MessageBuilder\TemplateBuilder\CarouselTemplateBuilder;
use LINE\LINEBot\Event\MessageEvent\StickerMessage;


use Illuminate\Support\Facades\Log;

class LineRegistrationController extends Controller
{
    private $channel_secret, $access_token;

    public function __construct() {

        $this->channel_secret = env('LINE_CHANNEL_SECRET');
        $this->access_token = env('LINE_ACCESS_TOKEN');

    }

    public function image($size) {

        $path = storage_path('app/images/line_user_registration_img2.png');
        $image = \Image::make($path);

        if($size < 1040) {

            $image->resize($size, $size);

        }

        return $image->response();

    }

    //LINEソーシャルログインで使う予定だったが使用しない
    // public function callback(Request $request) {

    //     $socialite_user = Socialite::driver('line')->stateless()->user();
    //     $socialite_id = $socialite_user->getId();
    //     $socialite_email = $socialite_user->getEmail();
    //     $socialite_name = $socialite_user->getName();
    //     $line_user = LineUser::where('line_id', $socialite_id)->first();

    //     if(!is_null($line_user) && !is_null($socialite_email)) {

    //         \DB::beginTransaction();

    //         try {

    //             $user = User::firstOrNew(['email' => $socialite_email]);
    //             $user->email = $socialite_email;
    //             $user->name = $socialite_name;
    //             $user->password = Hash::make(Str::random()); // パスワードはランダム
    //             $user->save();

    //             $line_user->user_id = $user->id;
    //             $line_user->save();

    //             $line_id = $line_user->line_id;
    //             $client = new CurlHTTPClient($this->access_token);
    //             $bot = new LINEBot($client, ['channelSecret' => $this->channel_secret]);
    //             $text_message = new TextMessageBuilder('会員登録が完了しました！');
    //             $bot->pushMessage($line_id, $text_message);

    //             auth()->login($user); // 自動ログイン
    //             \DB::commit();

    //             return '会員登録が完了しました！';

    //         } catch (\Exception $e) {

    //             // ここでエラー処理
    //             \DB::rollBack();

    //         }

    //     }

    //     return '必要な情報が取得できていません。';

    // }

    public function getMessageContent($messageId)
    {
        return $this->client->get('https://api-data.line.me/v2/bot/message/' . urlencode($messageId) . '/content');
    }

    public function webhook(Request $request) {

        $request_body = $request->getContent();
        $hash = hash_hmac('sha256', $request_body, $this->channel_secret, true);
        $signature = base64_encode($hash);

        if($signature === $request->header('X-Line-Signature')) { // ここでLINEからの送信を検証してます

            $client = new CurlHTTPClient($this->access_token);
            $bot = new LINEBot($client, ['channelSecret' => $this->channel_secret]);

            try {

                $events = $bot->parseEventRequest($request_body, $signature);

                foreach($events as $event) {

                    $line_id = $event->getEventSourceId();
                    $reply_token = $event->getReplyToken(); // 返信用トークン

                    // $ee = $event->getType();
                    // $ee = $event->getMessageType();
                    // $reply=$bot->replyText($reply_token, $ee);
                    // return 'ok';

                    if($event instanceof FollowEvent) { // お友達登録されたとき

                        // DBへ取得情報を保存
                        $mode = $event->getMode();
                        $profile = $bot->getProfile($line_id)->getJSONDecodedBody();
                        $display_name = $profile['displayName'];//表示名

                        $pic_url = isset($profile['pictureUrl']) ? $profile['pictureUrl'] : Storage::url('linepic/noicon.jpg');
                        // デバック用のテキスト発出
                        // $reply=$bot->replyText($reply_token, $pic_url);
                        // return 'ok';

                        //データの確認と登録
                        // $line_user = LineUser::where('line_id', $line_id)->first();
                        // if (empty($line_user)) {
                        //     $line_user = new LineUser; 
                        //     $line_user->line_id = $line_id;
                        //     $line_user->mode = $mode;
                        //     $line_user->display_name = $display_name;
                        //     $line_user->save();
                        // }

                        //ユーザーの存在確認
                        $u_user = User::where('line_id', $line_id)->first();
                        if (empty($u_user)) {
                            //新規ユーザーの登録
                            $u_user = new User; 
                            $u_user->line_id = $line_id;
                            $u_user->mode = $mode;
                            $u_user->display_name = $display_name;
                            // リファラー情報の確認と保存　新規だったら
                            $referrer = Referrer::where('line_id', $line_id)->first();
                            if ($referrer) {
                                // `referrer` が `official` なら空にする
                                $u_user->from_url = ($referrer->referrer === 'official') ? '' : $referrer->referrer;
                            }
                            $u_user->save();

                            if($pic_url === "/storage/linepic/noicon.jpg"){
                                //プロフィール画像がなかった時
                                $us = User::where('line_id', $line_id)->first();
                                // $udata = UserData::where('user_id', $us->id)->first();
                                $udata = new UserData;
                                $udata->user_id = $us->id;
                                $udata->licence_1 = "noicon.jpg";
                                $udata->save();
                            }else{
                                //プロフィール画像があった時
                                // プロフィール画像を取得
                                $response = $client->get($pic_url);
                                if ($response->isSucceeded()) {
                                    // 画像の取得に成功した場合
                                    // 画像データを取得
                                    $imageData = $response->getRawBody();

                                    // 画像をLaravelのpublicディレクトリに保存
                                    $storagePath = storage_path('app/public/linepic');
                                    $filename = $line_id .'.jpg';
                                    $filePath = $storagePath . '/' . $filename;

                                    // 画像をファイルに保存
                                    file_put_contents($filePath, $imageData);
                                    //user_dataに画像のパスを保存

                                    $us = User::where('line_id', $line_id)->first();
                                    // $udata = UserData::where('user_id', $us->id)->first();
                                    $udata = new UserData;
                                    $udata->user_id = $us->id;
                                    $udata->licence_1 = $filename;
                                    $udata->save();
                                }
                            }

                            
                        }else{//ブロック後の再登録
                            if($u_user->mode == "delete"){
                                $u_user->mode = $mode;
                                $u_user->save();
                            }
                        }



                        //2023.09.08追加　友達登録後の流れをテキストで追加
                        $msg11 = new Message; 
                        $msg11->line_id = $line_id;
                        $msg11->send_type = "自動返信";
                        $msg11->text = "友達登録自動返信ながれ";
                        $msg11->save();

                        $p_msg = "友達登録ありがとうございます！！\n\n";
                        $p_msg .= "【申込からお振込までの流れ】\n";
                        $p_msg .= "①お申込情報の入力\n";
                        $p_msg .= "LINE下部のメニュー「新規買取申し込み」よりお申し込み下さい。\n";
                        $p_msg .= "↓\n";
                        $p_msg .= "②身分証明書のご送付\n";
                        $p_msg .= "ご本人様確認(身分証明書)画像をLINEに送信して下さい。\n";
                        $p_msg .= "↓\n";
                        $p_msg .= "③買取商品の査定\n";
                        $p_msg .= "査定結果をお待ち下さい。\n";
                        $p_msg .= "↓\n";
                        $p_msg .= "④査定完了・お振込み\n";
                        $p_msg .= "お客様の口座にお振込み！\n";
                        $p_msg .= "↓\n";
                        $p_msg .= "※リピートの申し込みはLINE下部のメニュー「買取申込２回目以降」からお申込み下さい。\n";
                        

                        $text_message = new TextMessageBuilder($p_msg);
                        $bot->replyMessage($reply_token, $text_message);

                        //2023.09.08ボタンでフォーム出すの廃止

                        // メッセージの保存処理を追記
                        // $msg1 = new Message; 
                        // $msg1->line_id = $line_id;
                        // $msg1->send_type = "自動返信";
                        // $msg1->text = "友達登録自動返信ボタン";
                        // $msg1->save();

                        // $link_url = env('LINE_LIFF01_URL');

                        // // ボタンテンプレートを作成
                        // $buttonTemplate = new ButtonTemplateBuilder(
                        //     '友達登録ありがとうございます！',  // テンプレートのタイトル
                        //     '続いてフォームからお客様情報を入力してください。',  // テンプレートの説明
                        //     null,  // テンプレートのサムネイル画像URL
                        //     [  // ボタンの配列
                        //         new UriTemplateActionBuilder('お客様情報入力フォームを開く', $link_url)
                        //     ]
                        // );
                        // // ボタンテンプレートメッセージを作成
                        // $buttonMessage = new TemplateMessageBuilder('ボタンテンプレート', $buttonTemplate);
                        // $bot->replyMessage($reply_token, $buttonMessage);


                        //画像を送る用の記述
                        // 自動返信（登録リンク送信）
                        // $width = 1040;
                        // $height = 1040;
                        // $alt_text = '画像をクリックして会員登録！'; // 代替テキスト
                        // $base_url = route('line.registration.image', ''); // 画像URL
                        // $base_size = new BaseSizeBuilder($height, $width); // 基本画像のサイズ

                        // $x = 0;
                        // $y = 0;
                        // $area = new AreaBuilder($x, $y, $width, $height);
                        // // $link_url = Socialite::driver('line') // LINEログインのURL
                        // //     ->redirect()
                        // //     ->getTargetUrl();
                        // $link_url = env('LINE_LIFF01_URL');
                        // $image_map_actions = [ new ImagemapUriActionBuilder($link_url, $area)];

                        // $image_map_message = new ImagemapMessageBuilder(
                        //     $base_url,
                        //     $alt_text,
                        //     $base_size,
                        //     $image_map_actions
                        // );
                        // // $msg = "続いて以下のリンクから詳細情報を入力してください。\n".env('LINE_LIFF01_URL');
                        // $bot->replyMessage($reply_token, $image_map_message);
                        // $reply=$bot->replyText($reply_token, $msg);

                    } else if($event instanceof UnfollowEvent) { // お友達登録が解除されたとき

                        // メッセージの保存処理を追記
                        $msg1 = new Message; 
                        $msg1->line_id = $line_id;
                        $msg1->send_type = "送信";
                        $msg1->text = "ブロックされました";
                        $msg1->save();

                        // LineUser::where('line_id', $line_id)->delete();
                        //データは消さずに　モードにdeleteをつけておく
                        $uu_user = User::where('line_id', $line_id)->first();
                        $uu_user->mode = "delete";
                        $uu_user->save();
                        // UserData::where('user_id', $uu_user->id)->delete();
                        // $uu_user->delete();
                    } else if($event instanceof MessageEvent && $event instanceof TextMessage) {   // テキストメッセージの場合
                        
                        $event_type = $event->getType();//イベントタイプを取得する 
                        $msg_type = $event->getMessageType();// メッセージタイプを取得する

                        $text = $event->getText();// LINEで送信されたテキスト
                        $msg_id = $event->getMessageId();
                        // メッセージの保存処理を追記
                        $msg1 = new Message; 
                        $msg1->line_id = $line_id;
                        $msg1->line_message_id = $msg_id;
                        $msg1->send_type = "受信";
                        $msg1->text = $text;
                        $msg1->save();

                        //2023.09.08 メニューから確認を削除した
                        if($text === "登録情報確認"){
                            $p_user = User::where('line_id', $line_id)->first();
                            if(empty($p_user)){
                                $p_msg = "登録されていません。";
                            }else{
                                $p_msg = "【お預かりしたお客様の登録情報】\n";
                                $p_msg .= "名前: " . $p_user->name . "\n";
                                $p_msg .= "カナ: " . $p_user->userData->kana . "\n";
                                $p_msg .= "電話番号: " . $p_user->mobile . "\n";
                                $p_msg .= "メールアドレス: " . $p_user->email . "\n";
                                $p_msg .= "生年月日: " . $p_user->userData->birthday . "\n";
                                $p_msg .= "性別: " . $p_user->userData->gender . "\n";
                                $p_msg .= "住所: " . $p_user->userData->zip." ".$p_user->userData->pref. $p_user->userData->city.$p_user->userData->address. $p_user->userData->building. "\n";
                                $p_msg .= "口座情報: " . $p_user->userData->bank_name." ".$p_user->userData->branch_name."(".$p_user->userData->branch_code.")". $p_user->userData->bank_type.$p_user->userData->bank_number. $p_user->userData->bank_kana. "\n";
                                $p_msg .= "勤務先名: " . $p_user->userData->work_name . "\n";
                                $p_msg .= "勤務先電話: " . $p_user->userData->work_tel . "\n";
                                $p_msg .= "勤務先名住所: " . $p_user->userData->work_zip." ".$p_user->userData->work_pref. $p_user->userData->work_city.$p_user->userData->work_address. $p_user->userData->work_building. "\n";
                                $p_msg .= "月額給与額: " . $p_user->userData->salary . "\n";
                                $p_msg .= "給料日: " . $p_user->userData->payday . "\n";
                            }

                            // メッセージの保存処理を追記
                            $msg1 = new Message; 
                            $msg1->line_id = $line_id;
                            $msg1->line_message_id = $msg_id;
                            $msg1->send_type = "自動返信";
                            $msg1->text = "登録情報自動返信";
                            $msg1->save();

                            $text_message = new TextMessageBuilder($p_msg);
                            $reply=$bot->replyMessage($reply_token, $text_message);
                        }

                        // if($text === "申込履歴確認"){
                        //     // カルーセルメッセージのカラムを作成
                        //     $p_user = User::where('line_id', $line_id)->first();
                        //     $userItems = UserItem::where('user_id', $p_user->id)->limit(10)->get();//

                        //     // メッセージの保存処理を追記
                        //     $msg1 = new Message; 
                        //     $msg1->line_id = $line_id;
                        //     $msg1->line_message_id = $msg_id;
                        //     $msg1->send_type = "自動返信";
                        //     $msg1->text = "申込情報一覧自動返信";
                        //     $msg1->save();

                        //     if(empty($userItems)){
                        //         $errorMessage = '申込履歴がありません。';
                        //         // エラーメッセージを返信
                        //         $bot->replyMessage($reply_token, new TextMessageBuilder($errorMessage));
                        //     }else{
                        //         $carouselColumns = [];
                        //         foreach ($userItems as $userItem) {

                        //             if($userItem->status_total == 'ケリ' || $userItem->status_total == '詐欺'){
                        //                 $st = "審査完了（買取不可）";
                        //             }elseif($userItem->status_total == '保留'){
                        //                 $st = "審査中*";
                        //             }else{
                        //                 $st = $userItem->status_total;
                        //             }

                        //             $carouselColumn = new CarouselColumnTemplateBuilder(
                        //                 "申込日：".Functions::hisDateFnc($userItem->created_at),     // カラムのタイトル
                        //                 "【".$userItem->way."】\n希望金額：".$userItem->price."\n状態：".$st,  // カラムの説明
                        //                 null,    // カラムの画像URL
                        //                 [   // リンクをクリック
                        //                     // new UriTemplateActionBuilder('詳細を見る', $link_url)
                        //                     //メッセージ発出
                        //                     new MessageTemplateActionBuilder('詳細を確認', '買取申込ID：'.$userItem->id)
                        //                 ]
                        //             );
                        //             $carouselColumns[] = $carouselColumn;
                        //         }
    
                        //         // カルーセルテンプレートを作成
                        //         $carouselTemplate = new CarouselTemplateBuilder($carouselColumns);
                        //         // カルーセルメッセージを作成
                        //         $carouselMessage = new TemplateMessageBuilder('申込履歴', $carouselTemplate);
                        //         // メッセージを返信
                        //         $bot->replyMessage($reply_token, $carouselMessage);
                        //     }
                        // }

                        if ($text === "申込履歴確認" || strpos($text, "申込履歴ページ:") === 0) {
                        
                            $start_time = microtime(true); // ✅ **処理開始時間を記録**
                            Log::info("申込履歴確認が押されました。");
                        
                            // 現在のページ番号を取得
                            $page = 1;
                            if (strpos($text, "申込履歴ページ:") === 0) {
                                $page = intval(str_replace("申込履歴ページ:", "", $text));
                            }
                        
                            // ✅ **ユーザー取得**
                            $p_user = User::where('line_id', $line_id)->first();
                            if (!$p_user) {
                                Log::error("ユーザーが見つかりません。LINE ID: " . $line_id);
                                $bot->replyMessage($reply_token, new TextMessageBuilder("ユーザー情報が見つかりません。"));
                                return;
                            }
                            Log::info("取得したユーザーID: " . $p_user->id);
                        
                            // ✅ **取引履歴の取得**
                            $limit = 9;
                            $offset = ($page - 1) * $limit;
                            $userItems = UserItem::where('user_id', $p_user->id)
                                ->orderBy('id', 'desc')
                                ->offset($offset)
                                ->limit($limit)
                                ->get();
                        
                            $end_query_time = microtime(true); // ✅ **DB取得完了時間を記録**
                            Log::info("取得した申込履歴件数: " . $userItems->count() . " | DB取得時間: " . round($end_query_time - $start_time, 4) . "秒");
                        
                            // ✅ **メッセージの保存**
                            $msg1 = new Message; 
                            $msg1->line_id = $line_id;
                            $msg1->line_message_id = $msg_id;
                            $msg1->send_type = "自動返信";
                            $msg1->text = "申込情報一覧自動返信（ページ {$page}）";
                            $msg1->save();
                        
                            if ($userItems->isEmpty()) {
                                Log::warning("申込履歴なし。ユーザーID: " . $p_user->id);
                                $errorMessage = '申込履歴がありません。';
                                $bot->replyMessage($reply_token, new TextMessageBuilder($errorMessage));
                                return;
                            }
                        
                            // ✅ **カルーセルのカラムを作成**
                            $carouselColumns = [];
                            foreach ($userItems as $userItem) {
                                if ($userItem->status_total == 'ケリ' || $userItem->status_total == '詐欺') {
                                    $st = "審査完了（買取不可）";
                                } elseif ($userItem->status_total == '保留') {
                                    $st = "審査中*";
                                } elseif ($userItem->status_total == '本人キャンセル') {
                                    $st = "審査中*";
                                } else {
                                    $st = $userItem->status_total;
                                }
                        
                                $carouselColumn = new CarouselColumnTemplateBuilder(
                                    "申込日：" . Functions::hisDateFnc($userItem->created_at),
                                    "【" . $userItem->way . "】\n希望金額：" . $userItem->price . "\n状態：" . $st,
                                    null,
                                    [   
                                        new MessageTemplateActionBuilder('詳細を確認', '買取申込ID：' . $userItem->id)
                                    ]
                                );
                                $carouselColumns[] = $carouselColumn;
                            }
                        
                            // ✅ **次のページがある場合、「次のページへ」ボタンを追加**
                            $totalItems = UserItem::where('user_id', $p_user->id)->count();
                            $totalPages = ceil($totalItems / $limit);
                        
                            if ($page < $totalPages) {
                                $nextPageColumn = new CarouselColumnTemplateBuilder(
                                    "次のページを見る",
                                    "ページ {$page} / {$totalPages}",
                                    null,
                                    [   
                                        new MessageTemplateActionBuilder('次のページへ', "申込履歴ページ:" . ($page + 1))
                                    ]
                                );
                                $carouselColumns[] = $nextPageColumn;
                            }
                        
                            // ✅ **カルーセルテンプレートを作成**
                            $carouselTemplate = new CarouselTemplateBuilder($carouselColumns);
                            $carouselMessage = new TemplateMessageBuilder('申込履歴', $carouselTemplate);
                        
                            $end_time = microtime(true); // ✅ **処理終了時間を記録**
                            Log::info("カルーセルメッセージ作成完了 | 処理時間: " . round($end_time - $start_time, 4) . "秒");
                        
                            // ✅ **`replyMessage()` をできるだけ早く実行**
                            $response = $bot->replyMessage($reply_token, $carouselMessage);
                        
                            if (!$response->isSucceeded()) {
                                Log::error("LINE APIエラー: " . $response->getRawBody());
                            } else {
                                Log::info("カルーセルメッセージ送信成功！");
                            }
                        }


                        //取引履歴のIDから詳細情報を出す
                        // メッセージから買取申込IDを抽出
                        $pattern = '/買取申込ID：(\d+)/';
                        if (preg_match($pattern, $text, $matches)) {
                            $buyItemId = $matches[1];

                            // メッセージの保存処理を追記
                            $msg1 = new Message; 
                            $msg1->line_id = $line_id;
                            $msg1->line_message_id = $msg_id;
                            $msg1->send_type = "自動返信";
                            $msg1->text = "申込情報詳細自動返信";
                            $msg1->save();

                            // user_itemテーブルとの照合
                            $userItem = UserItem::where('id', $buyItemId)->first();
                            if ($userItem) {

                                if($userItem->status_total == 'ケリ' || $userItem->status_total == '詐欺'){
                                    $st = "審査完了（買取不可）";
                                }elseif($userItem->status_total == '保留'){
                                    $st = "審査中*";
                                }elseif($userItem->status_total == '本人キャンセル'){
                                    $st = "審査中*";
                                }else{
                                    $st = $userItem->status_total;
                                }

                                // 照合に成功した場合の処理
                                $replyMessage = "【買取申込情報】\n";
                                $replyMessage .= "買取申込ID: " . $userItem->id . "\n";
                                $replyMessage .= "申込日時: " . Functions::hisDateFnc($userItem->created_at)."\n";
                                $replyMessage .= "申込状態: " . $st."\n";
                                $replyMessage .= "買取方法: " . $userItem->way."\n";
                                $replyMessage .= "商品名: " . $userItem->item_name."\n";
                                $replyMessage .= "ステータス: " . $userItem->status_paid."\n";
                                $replyMessage .= "査定額: " . $userItem->judge_price."\n";
                                $replyMessage .= "備考: " . $userItem->for_user."\n";
            
                                // メッセージを返信
                                $bot->replyMessage($reply_token, new TextMessageBuilder($replyMessage));
                            } else {
                                // 照合に失敗した場合の処理
                                $errorMessage = '買取申込IDが見つかりませんでした。';
                                // エラーメッセージを返信
                                $bot->replyMessage($reply_token, new TextMessageBuilder($errorMessage));
                            }
                        }

                        // メッセージから承認IDを抽出
                        $pattern2 = '/承認ID：(\d+)/';
                        if (preg_match($pattern2, $text, $matches)) {
                            $buyItemId = $matches[1];
                            $userItem = UserItem::where('id', $buyItemId)->first();
                            $userItem->user_agree = '承認済';
                            $userItem->save();
                        }



                        //メッセージの発出
                        // $text_message = new TextMessageBuilder($msg_type);
                        // $reply=$bot->replyMessage($reply_token, $text_message);

                    } else if ($event instanceof MessageEvent && $event instanceof ImageMessage) {//画像の場合
                        // 画像メッセージの場合
                        $replying_text = '';
                        $messageId = $event->getMessageId(); // 画像メッセージのID
                        $response = $bot->getMessageContent($messageId); // 画像データを取得

                        if($response->isSucceeded()) {
                            //画像の保存
                            $filename = $messageId .'.jpg';
                            // $image_path = storage_path('app/lineimg/'. $filename);
                            \Storage::put('public/lineimg/'. $filename, $response->getRawBody());
                            // $replying_text = $this->read_qr($image_path);
                            // @unlink($image_path);

                            // メッセージの保存処理を追記
                            $msg1 = new Message; 
                            $msg1->line_id = $line_id;
                            $msg1->line_message_id = $messageId;
                            $msg1->send_type = "画像";
                            $msg1->text = $filename;
                            $msg1->save();

                            //メッセージの発出
                            // $text_message = new TextMessageBuilder($filename);
                            // $reply=$bot->replyMessage($reply_token, $text_message);
                        }

                    } else if ($event instanceof MessageEvent && $event instanceof StickerMessage) {//スタンプの場合
                        // 受信したメッセージがスタンプの場合
                        $messageId = $event->getMessageId(); // 画像メッセージのID

                        $packageId = $event->getPackageId(); // スタンプのパッケージID
                        $stickerId = $event->getStickerId(); // スタンプのスタンプID
                        
                        // メッセージの保存処理を追記
                        $msg1 = new Message; 
                        $msg1->line_id = $line_id;
                        $msg1->line_message_id = $messageId;
                        $msg1->send_type = "スタンプ";
                        $msg1->text = $packageId."/".$stickerId;
                        $msg1->save();
                    }





                }

            } catch (\Exception $e) {

                // ここでエラー処理

            }

        }

    }
}