<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\UserData;
use App\UserItem;
use App\Message;

class LineAgreementController extends Controller
{
    private $channel_secret, $access_token;

    public function __construct()
    {
        $this->channel_secret = env('LINE_CHANNEL_SECRET');
        $this->access_token   = env('LINE_ACCESS_TOKEN');
    }

    /**
     * 買取同意フォーム表示
     * /line/agreement?item_id=XXX でアクセスされる想定
     */
    public function showForm(Request $request)
    {
        $liff_agreement_id = env('LINE_LIFF_AGREEMENT_ID');
        $itemId = $request->query('item_id');

        // LIFFアクセスの場合（item_id が URL に来ないケース）
        if (empty($itemId)) {
            // item などは null のまま返す（JSで取得するため）
            return view('line.agreement', [
                'liff_agreement_id' => $liff_agreement_id,
                'item' => null,
                'user' => null,
                'userData' => null,
                'finalAmount' => null,
                'isLiffMode' => true, // ← 追加
            ]);
        }

        // ここから先はブラウザアクセスなど「item_id がある場合」
        $item = UserItem::findOrFail($itemId);
        $user = User::find($item->user_id);
        $userData = UserData::where('user_id', $item->user_id)->first();

        // 過去に user_items があるか（今回の item を除外して判定）
        $isRepeat = UserItem::where('user_id', $item->user_id)
            ->where('id', '!=', $item->id)
            ->exists();


        $finalAmount = $item->judge_price ?? $item->price;

        if ($item->user_agree === '承認済' || !empty($item->agreement_signed_at)) {
            return view('line.agreement_already', [
                'item' => $item,
                'user' => $user,
                'userData' => $userData,
                
                'finalAmount' => $finalAmount,
            ]);
        }

        return view('line.agreement', [
            'liff_agreement_id' => $liff_agreement_id,
            'item' => $item,
            'user' => $user,
            'userData' => $userData,
            'is_repeat' => $isRepeat,
            'finalAmount' => $finalAmount,
            'isLiffMode' => false, // ブラウザアクセス
        ]);
    }



    /**
     * 買取同意フォーム送信処理（AJAX）
     */
    public function submitForm(Request $request)
    {
        \Log::info('agreement submit payload', $request->all());
        $validator = Validator::make($request->all(), [
            'item_id'        => 'required|exists:user_items,id',
            'line_id'        => 'required',
            'signature_data' => 'required',
            'agree_terms'    => 'accepted',
            'agree_accurate' => 'accepted',
            'agree_ownership' => 'accepted',
            'agree_deliver' => 'accepted',
            'agree_sell'     => 'accepted',
            'agree_antisocial' => 'accepted',
        ], [
            'item_id.required'        => '申込情報の取得に失敗しました。',
            'item_id.exists'          => '対象の買取申込が見つかりませんでした。',
            'line_id.required'        => 'LINE ID の取得に失敗しました。',
            'signature_data.required' => '署名を入力してください。',
            'agree_terms.accepted'    => '利用規約への同意が必要です。',
            'agree_accurate.accepted' => '記載内容が正しいことの確認が必要です。',
            'agree_ownership.accepted' => '取引する商品がご自身の所有物である確認が必要です。',
            'agree_deliver.accepted' => '商品を引渡す意向があることの確認が必要です。',
            'agree_sell.accepted'     => '買取に同意するチェックが必要です。',
            'agree_antisocial.accepted' => '反社会的勢力ではない確認が必要です。',

        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
        }

        $item = UserItem::findOrFail($request->item_id);
        $user = User::find($item->user_id);
        $userData = UserData::where('user_id', $item->user_id)->first();

        $finalAmount = $item->contract_price ?: $item->judge_price ?: $item->price;

        // すでに同意済みならフォームを表示しない
        if ($item->user_agree === '承認済' || !empty($item->agreement_signed_at)) {
            return view('line.agreement_already', [
                'item' => $item,
                'user' => $user,
                'userData' => $userData,
                'finalAmount' => $finalAmount,
            ]);
        }


        // ---- 署名画像の保存 ----
        $signatureData = $request->signature_data;

        if (!preg_match('/^data:image\/(\w+);base64,/', $signatureData, $type)) {
            return response()->json(['errors' => ['signature' => ['署名画像の形式が不正です。']]], 422);
        }

        $imageType = strtolower($type[1]); // png, jpg など
        if (!in_array($imageType, ['png', 'jpg', 'jpeg'])) {
            return response()->json(['errors' => ['signature' => ['署名画像の形式が不正です。']]], 422);
        }

        $signatureData = substr($signatureData, strpos($signatureData, ',') + 1);
        $imageData = base64_decode($signatureData);

        if ($imageData === false) {
            return response()->json(['errors' => ['signature' => ['署名画像のデコードに失敗しました。']]], 422);
        }

        // ファイル名：itemID_lineID_タイムスタンプ
        $filename = 'agree_' . $item->id . '_' . $request->line_id . '_' . time() . '.' . $imageType;

        // storage/app/public/signatures に保存
        Storage::put('public/signatures/' . $filename, $imageData);

        // ---- agreement_text の生成（Aパターン：シンプル）----
        $lines = [];
        $lines[] = '【買取同意内容】';
        $lines[] = '買取申込ID：' . $item->id;
        if ($user) {
            $lines[] = 'お名前：' . $user->name;
        }
        $lines[] = '商品名：' . $item->item_name;
        $lines[] = '買取方法：' . $item->way;
        $lines[] = '査定額：' . $finalAmount;
        $lines[] = '同意日時：' . now()->format('Y-m-d H:i:s');

        $checked = [];
        if ($request->boolean('agree_terms')) {
            $checked[] = '利用規約に同意';
        }
        if ($request->boolean('agree_accurate')) {
            $checked[] = '記載内容が正確であることを確認';
        }
        if ($request->boolean('agree_ownership')) {
            $checked[] = '取引する商品は自分が所有している商品であることを確認';
        }
        if ($request->boolean('agree_deliver')) {
            $checked[] = '商品を引渡す意向があることを確認';
        }
        if ($request->boolean('agree_sell')) {
            $checked[] = '上記内容で買取に同意';
        }
        if ($request->boolean('agree_antisocial')) {
            $checked[] = '反社会的勢力に該当しないことを確認';
        }

        $lines[] = '同意チェック：' . implode(' / ', $checked);

        $agreementText = implode("\n", $lines);

        // ---- 閲覧用URLを生成 ----
        $agreementUrl = route('line.agreement.view', ['item_id' => $item->id]);

        // ---- user_items 更新 ----
        $item->user_agree         = '承認済';
        $item->agreement_signature = $filename;
        $item->agreement_signed_at = now();
        $item->agreement_text      = $agreementText;
        $item->agreement_url       = $agreementUrl;
        $item->save();

        // ---- LINEに送るメッセージ文面（LIFF側で送信）----
        $lineMessage  = "買取同意の手続きありがとうございます。\n\n";
        $lineMessage .= "買取申込[ID]：" . $item->id . "\n";
        $lineMessage .= "商品名：" . $item->item_name . "\n";
        $lineMessage .= "査定額：" . $finalAmount . "\n";
        $lineMessage .= "同意内容の確認は以下のURLから確認できます。\n\n" . $agreementUrl;

        // ---- messages テーブルにも保存 ----
        if (!empty($request->line_id)) {
            $msg = new Message;
            $msg->line_id   = $request->line_id;
            $msg->send_type = "フォーム送信";
            $msg->text      = $lineMessage;
            $msg->save();
        }

        // フロント（LIFF）に返す
        return response()->json([
            'message' => $lineMessage,
            'url'     => $agreementUrl,
        ]);
    }

    /**
     * 買取同意書の閲覧ページ
     * /line/agreement/view/{item_id}
     */
    public function view($item_id)
    {
        $item = UserItem::findOrFail($item_id);
        $user = User::find($item->user_id);
        $userData = UserData::where('user_id', $item->user_id)->first();
        $finalAmount = $item->contract_price ?: $item->judge_price ?: $item->price;

        // 🔽 追加：1回目 / 2回目 判定
        $isRepeat = UserItem::where('user_id', $item->user_id)
            ->where('id', '!=', $item->id)
            ->exists();

        return view('line.agreement_view', compact(
            'item','user','userData','finalAmount','isRepeat'
        ) + ['isLiffMode' => false]);
    }

}
