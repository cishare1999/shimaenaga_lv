<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Sendmessage;

class SendmessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 商品データを追加
        $item = Sendmessage::create([
            'send_status'     => 'active',
            'send_title'    => 'あいさつ',
            'sentence'    => 'ご登録ありがとうございます。
ご不明点等ございましたらこちらのLINEもしくはお電話にてお問い合わせください。
よろしくお願いいたします。

【営業時間】
年中無休（年末年始お休み）
営業時間：9:00～19:00
電話番号：050-0000-0000',
        ]);
        $item = Sendmessage::create([
            'send_status'     => 'active',
            'send_title'    => 'お申込み感謝',
            'sentence'    => 'お申込みありがとうございます。

ご契約を円滑にすすめる為、お手数ですが下記の内容にご回答ください。

【お取引にあたっての質問】

',
        ]);
        $item = Sendmessage::create([
            'send_status'     => 'active',
            'send_title'    => '電話確認',
            'sentence'    => 'ご質問への回答ありがとうございます。

ご契約に向けお手数ですが、お手すきの時間にお電話お願い致します。

【営業時間】
年中無休（年末年始お休み）
営業時間：9:00～19:00
電話番号：050-0000-0000',
        ]);
        $item = Sendmessage::create([
            'send_status'     => 'active',
            'send_title'    => '緊急連絡先の確認',
            'sentence'    => 'お忙しいところありがとうございます。

以下の緊急連絡先の内容をお送りください。

',
        ]);
        $item = Sendmessage::create([
            'send_status'     => 'active',
            'send_title'    => '契約書の確認',
            'sentence'    => '後ほど契約書のURLを送ります。
契約書へご署名をお願いいたします。
※3ページ目にございます。

',
        ]);
        $item = Sendmessage::create([
            'send_status'     => 'fixed',
            'send_title'    => '査定完了（買取可）※ステータス変更',
            'sentence'    => '査定が完了しましたのでお知らせ致します。

査定金額、注意事項をよくお読みになった上で買取同意フォームのご入力をお願いいたします。

買取同意の確認が取れましたら送金をさせていただきます。
',
        ]);
        $item = Sendmessage::create([
            'send_status'     => 'fixed',
            'send_title'    => '査定完了（買取不可）※ステータス変更',
            'sentence'    => '総合判断の結果、今回のお取引·買取はお見送りとさせていただきます。
お力になれず申し訳ございません。

以上、宜しくお願い致します。',
        ]);
        $item = Sendmessage::create([
            'send_status'     => 'fixed',
            'send_title'    => '代金振込済　※ステータス変更',
            'sentence'    => 'お待たせいたしました。
査定金額の承認を頂けましたので買取金額をお振込み致しました。
ご確認をお願いいたします。

【注意事項】

',
        ]);
        $item = Sendmessage::create([
            'send_status'     => 'active',
            'send_title'    => 'ありがとう文',
            'sentence'    => 'ご確認ありがとうございます。
今後ともよろしくお願いいたします。',
        ]);
        $item = Sendmessage::create([
            'send_status'     => 'active',
            'send_title'    => '商品発送確認',
            'sentence'    => '【重要】※必ずご確認ください。
〇月〇日がお買取り商品の受付期限となります。
期日までにお手続きをお願い致します。',
        ]);
        $item = Sendmessage::create([
            'send_status'     => 'active',
            'send_title'    => '取引完了',
            'sentence'    => 'この度はお取引ありがとうござした。
またのご利用をお待ちしております。',
        ]);
        $item = Sendmessage::create([
            'send_status'     => 'active',
            'send_title'    => '勧誘',
            'sentence'    => 'お世話になっております。
以前お取引頂きました、〇〇でございます。

現在、査定完了までのお時間10分でご対応できます。
よろしければ再度のご利用お待ちしております。
よろしくお願いいたします。',
        ]);


    }
}
