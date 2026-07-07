<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LineUser;
use App\User;
use App\UserData;
use App\UserItem;
use App\Message;
use Functions;
use App\Referrer;//2024.06.28 add

use Illuminate\Support\Facades\Log;

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


class LineAuthController extends Controller
{
    // LINEの認証を開始するメソッド
    public function redirectToProvider(Request $request)
    {
        // $state = $request->input('state');
        // `state` がない or 空なら 'official' を設定
        $state = $request->filled('state') ? $request->input('state') : 'official';
        return Socialite::driver('line')->stateless()->with(['state' => $state])->redirect();
    }

    // LINEのコールバックを処理するメソッド
    public function handleProviderCallback(Request $request)
    {
        try {
            // `state` がない場合は 'official' をデフォルト値として設定
            $state = $request->input('state', 'official');

            // LINEのユーザー情報を取得
            $user = Socialite::driver('line')->stateless()->user();
            $line_id = $user->getId();

            // ユーザーの存在確認
            $u_user = User::where('line_id', $line_id)->first();

            if (empty($u_user)) {
                // `firstOrCreate()` を使用してリファラー情報を保存（重複エラーを回避）
                Referrer::firstOrCreate(
                    ['line_id' => $line_id],  // 検索条件
                    ['referrer' => $state]    // 新規作成時のデータ
                );
            }
            // トーク画面にリダイレクト
            $line_friend_register_url = "https://line.me/R/ti/p/@".env('COM_LINE_ID');
            return redirect($line_friend_register_url);

            // リダイレクト処理
            // return redirect()->route('lp2_top')->with('status', 'LINEログインに成功しました');
        } catch (\Exception $e) {
            // エラーメッセージをログに記録 (デバッグ用)
            // \Log::error('LINEログインエラー: ' . $e->getMessage());
            Log::error('LINEログインエラー: ' . $e->getMessage());

            // エラー詳細をセッションに保存してトップページへリダイレクト
            return redirect('/')->with('error', 'LINEログインに失敗しました: ' . $e->getMessage());
        }
    }
}