<?php

namespace App\Http\Controllers;

use App\LineUser;
use App\User;
use App\UserData;
use App\UserItem;
use App\Message;
use Functions;

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



class LineRegistration2Controller extends Controller
{
    private $channel_secret, $access_token;

    public function __construct() {

        $this->channel_secret = env('LINE_CHANNEL_SECRET2');
        $this->access_token = env('LINE_ACCESS_TOKEN2');

    }

    public function getMessageContent($messageId)
    {
        return $this->client->get('https://api-data.line.me/v2/bot/message/' . urlencode($messageId) . '/content');
    }

    public function webhook2(Request $request) {

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


                    if($event instanceof FollowEvent) { // お友達登録されたとき

                        // DBへ取得情報を保存
                        $mode = $event->getMode();
                        $profile = $bot->getProfile($line_id)->getJSONDecodedBody();
                        $display_name = $profile['displayName'];//表示名
                        // $pic_url = $profile['pictureUrl'];//プロフィール画像
                        $pic_url = isset($profile['pictureUrl']) ? $profile['pictureUrl'] : Storage::url('linepic/noicon.jpg');

                        //ユーザーの存在確認
                        $u_user = User::where('line_id', $line_id)->first();
                        if (empty($u_user)) {
                            //新規ユーザーの登録
                            $u_user = new User; 
                            $u_user->line_id = $line_id;
                            $u_user->from_url = "lp";
                            $u_user->mode = $mode;
                            $u_user->display_name = $display_name;
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
                            // if($u_user->mode == "delete"){
                            //     $u_user->mode = $mode;
                            //     $u_user->save();
                            // }
                        }

                        // メッセージの保存処理を追記
                        // $msg1 = new Message; 
                        // $msg1->line_id = $line_id;
                        // $msg1->send_type = "自動返信";
                        // $msg1->text = "友達登録自動返信";
                        // $msg1->save();

                        // $link_url = env('LINE_LIFF01_URL');
                        // // ボタンテンプレートを作成
                        // $buttonTemplate = new ButtonTemplateBuilder(
                        //     '友達登録ありがとうございます！',  // テンプレートのタイトル
                        //     '続いてフォームからお客様情報を入力してください。',  // テンプレートの説明
                        //     null,  // テンプレートのサムネイル画像URL
                        //     [  // ボタンの配列
                        //         new UriTemplateActionBuilder('フォームを開く', $link_url)
                        //     ]
                        // );
                        // // ボタンテンプレートメッセージを作成
                        // $buttonMessage = new TemplateMessageBuilder('ボタンテンプレート', $buttonTemplate);
                        // $bot->replyMessage($reply_token, $buttonMessage);


                    } 


                }

            } catch (\Exception $e) {

                // ここでエラー処理

            }

        }

    }
}