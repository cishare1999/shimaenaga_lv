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




class AdminBulkstatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->concon == 2) { // CSV処理
            // フォームから送信されたステータスとCSVファイルを取得
            $statusPaidCsv = $request->input('status_paid_csv');
            $for_user_csv = $request->input('for_user_csv');
            // CSVファイルのアップロード処理
            if ($request->hasFile('csv_file')) {
                $csvFile = $request->file('csv_file');
                $extension = $csvFile->getClientOriginalExtension();

                if ($extension == 'csv') {
                    // CSVファイルの読み取りと処理を行う
                    // CSVファイルの読み取り
                    // $csvData = array_map('str_getcsv', file($csvFile));
                    $csvData = array_map(function ($row) {
                        // 不可視文字や制御文字を削除
                        $cleanRow = preg_replace('/\p{C}/u', '', $row);
                        return str_getcsv($cleanRow);
                    }, file($csvFile));
                    
                    // dd($csvData);
                    // ユーザー名の配列を初期化
                    $userNames = [];
        
                    // 各行のデータを処理
                    foreach ($csvData as $row) {
                        // カンマで分割してユーザー名を取得
                        $userNames[] = $row[0];
                    }
                    // dd($userNames);
                    // ユーザー名を部分一致でusersテーブルから該当するユーザーを取得
                    $userIds = User::where(function ($query) use ($userNames) {
                        foreach ($userNames as $userName) {
                            $query->orWhere('name', 'LIKE', '%' . $userName . '%');
                        }
                    })->pluck('id');
                    // dd($userIds);
                    // ユーザーごとに関連するuser_itemsを取得
                    $userItems = [];
                    foreach ($userIds as $userId) {
                        // ユーザーごとのuser_itemsを取得し、status_paidの条件を付けて抽出
                        $userItems[] = UserItem::where('user_id', $userId)
                                                ->where('status_paid', $statusPaidCsv)
                                                ->where('for_user', 'LIKE', '%' . $for_user_csv . '%')
                                                ->get();
                    }
                    // dd($userItems);
                    // $userItemsの配列をフラット化して1つの配列にする
                    $items = collect($userItems)->flatten();
                    // dd($items);

                    // itemsの件数をカウント
                    $itemCount = $items->count();
                    $csv_error = "";


                } else {
                    // エラー処理: 拡張子が.csvでない場合
                    $items = "";
                    $itemCount = "";
                    $csv_error = "CSVファイル以外のファイルをアップロードしないでください。";
                }

            } else {
                // CSVファイルがアップロードされていない場合のエラー処理
                // 必要に応じてエラーメッセージを設定
                $items = "";
                $itemCount = "";
                $csv_error = "CSVファイルをアップロードしてください。";
            }
        }elseif ($request->concon == 1) { // CSV処理
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
            }
            if ($request->for_user) {
                $query->where('for_user', 'LIKE', '%' . $request->for_user . '%');
            }
    
            if ($commonList || $request->status_total || $request->status_paid) {
                $items = $query->orderBy('created_at', 'desc')->get();
                // 件数カウント
                $itemCount = $items->count(); // $itemsの件数をカウント
            } else {
                $items = $query->orderBy('created_at', 'desc')->get();
                // 件数カウント
                $itemCount = $items->count(); // $itemsの件数をカウント
            }
            $csv_error = "";
        }else{
            $items = "";
            $itemCount = "";
            $csv_error = "";
        }
    
        return view('admin.bulkstatus.index', compact('request', 'items', 'itemCount','csv_error'));
    }


    public function bulkstatusConfirm(Request $request)
    {
      $userItemIds = $request->input('bulk_id');
    //   dd($request->input('bulk_id'));
      $bulk_id = implode(',', $userItemIds);
      $items = UserItem::whereIn('id', $userItemIds)->get();
      $itemCount = $items->count(); // $itemsの件数をカウント
      // dd($itemCount);
      return view('admin.bulkstatus.confirm', compact('items', 'bulk_id', 'itemCount'));

    }

    public function bulkstatusComplete(Request $request)
    {
    //   dd($request);
      $userItemIds = $request->input('bulk_id');//送るuser_itemsのid
      $userItemIds = explode(',', $userItemIds);//idをカンマから配列に

      $status_paid = $request->status_paid;

       // IDの配列からUserItemを取得して更新
      UserItem::whereIn('id', $userItemIds)->update(['status_paid' => $status_paid]);



      return view('admin.bulkstatus.complete');

    }




  }
