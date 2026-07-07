@extends('layouts.app')

@section('title', 'お客様情報登録')
@section('description', 'スマートスティッチ | スマホで商品券買取！誰でも簡単最大30万まで')
@section('Keywords', 'スマートスティッチ,商品券,ギフト券,買取')

@section('content')


<section id="contact" class="">
  <h2>お客様情報登録</h2>

  <div class="row">
    <div class="in_row box-wrap03">
      <p>お客様情報をご入力ください。</p>
  {{ Aire::open()->route('mypage.entry_confirm')->encType('multipart/form-data')->addClass('') }}

  <table class="entry_tb">
    <tr>
      <th>お名前 <span>必須</span></th>
      <td>
        {{ $auth->name }}
        <input type="hidden" name="name" value="{{ $auth->name }}">
      </td>
      <th>名前フリガナ <span>必須</span></th>
      <td>
        <input type="text" class="form-text Form-Item-Input p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="kana" required value="" data-aire-for="kana" placeholder="カタカナで入力してください。" id="__aire-0-kana4" />
      </td>
    </tr>

    <tr>
      <th>携帯番号 <span>必須</span></th>
      <td>
        {{ $auth->mobile }}
        <input type="hidden" name="mobile" value="{{ $auth->mobile }}">
      </td>
      <th>メールアドレス <span>必須</span></th>
      <td>
        {{ $auth->email }}
        <input type="hidden" name="email" value="{{ $auth->email }}">
      </td>
    </tr>

    <tr>
      <th>生年月日 <span>必須</span></th>
      <td>
        {{ $auth->userData->birthday }}
        <input type="hidden" name="birthday" value="{{ $auth->userData->birthday }}">
      </td>

      <th>性別 <span>必須</span></th>
      <td>
        <input type="radio" id="box-5" name="gender" checked value="男性">
        <label for="box-5">男性</label>
        <input type="radio" id="box-6" name="gender" value="女性">
        <label for="box-6">女性</label>
      </td>
    </tr>
    <tr>
      <th>LINE ID</th>
      <td>
        LINEのID検索をONにしてください。
        <input type="text" class="form-text Form-Item-Input p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="line" placeholder="" value="" data-aire-for="line" id="__aire-0-line16" />
      </td>

      <th>ご連絡方法 <span>必須</span></th>
      <td>
        <input type="radio" id="box-1" name="contact" checked value="携帯">
        <label for="box-1">携帯</label>
        <input type="radio" id="box-2" name="contact" value="LINE">
        <label for="box-2">LINE</label>
      </td>
    </tr>
    <tr><th colspan="4" class="midashi_th">お住まい</th></tr>
    <tr>
      <th>郵便番号 <span>必須</span></th>
      <td>
        <input type="tel" class="form-text Form-Item-Input p-postal-code p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="zip" size="8" maxlength="8" required placeholder="ハイフンなしで入力してください。" data-aire-for="zip" id="__aire-0-zip19" />
      </td>

      <th>都道府県 <span>必須</span></th>
      <td>
      <select class="form-select-100 block w-full p-2 leading-normal border rounded-sm bg-white appearance-none text-gray-900" data-aire-component="select" name="pref" required data-aire-for="pref" id="__aire-0-pref1">
        <option value="" selected>選択してください</option>
        <option value="北海道">北海道</option>
        <option value="青森県">青森県</option>
        <option value="岩手県">岩手県</option>
        <option value="宮城県">宮城県</option>
        <option value="秋田県">秋田県</option>
        <option value="山形県">山形県</option>
        <option value="福島県">福島県</option>
        <option value="茨城県">茨城県</option>
        <option value="栃木県">栃木県</option>
        <option value="群馬県">群馬県</option>
        <option value="埼玉県">埼玉県</option>
        <option value="千葉県">千葉県</option>
        <option value="東京都">東京都</option>
        <option value="神奈川県">神奈川県</option>
        <option value="新潟県">新潟県</option>
        <option value="富山県">富山県</option>
        <option value="石川県">石川県</option>
        <option value="福井県">福井県</option>
        <option value="山梨県">山梨県</option>
        <option value="長野県">長野県</option>
        <option value="岐阜県">岐阜県</option>
        <option value="静岡県">静岡県</option>
        <option value="愛知県">愛知県</option>
        <option value="三重県">三重県</option>
        <option value="滋賀県">滋賀県</option>
        <option value="京都府">京都府</option>
        <option value="大阪府">大阪府</option>
        <option value="兵庫県">兵庫県</option>
        <option value="奈良県">奈良県</option>
        <option value="和歌山県">和歌山県</option>
        <option value="鳥取県">鳥取県</option>
        <option value="島根県">島根県</option>
        <option value="岡山県">岡山県</option>
        <option value="広島県">広島県</option>
        <option value="山口県">山口県</option>
        <option value="徳島県">徳島県</option>
        <option value="香川県">香川県</option>
        <option value="愛媛県">愛媛県</option>
        <option value="高知県">高知県</option>
        <option value="福岡県">福岡県</option>
        <option value="佐賀県">佐賀県</option>
        <option value="長崎県">長崎県</option>
        <option value="熊本県">熊本県</option>
        <option value="大分県">大分県</option>
        <option value="宮崎県">宮崎県</option>
        <option value="鹿児島県">鹿児島県</option>
        <option value="沖縄県">沖縄県</option>
      </select>
      </td>
    </tr>
    <tr>
      <th>市区町村 <span>必須</span></th>
      <td>
        <input type="text" class="form-text Form-Item-Input p-locality p-street-address p-extended-address p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="city" required data-aire-for="city" id="__aire-3-city28" />
      </td>

      <th>番地以降 <span>必須</span></th>
      <td>
        <input type="text" class="form-text Form-Item-Input p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="address" required data-aire-for="address" id="__aire-3-address31" />
      </td>
    </tr>
    <tr>
      <th>ビルマンション名・部屋番号</th>
      <td colspan="3">
        <input type="text" class="form-text Form-Item-Input p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="building" data-aire-for="building" id="__aire-3-building34" />
      </td>
    </tr>

    <tr><th colspan="4" class="midashi_th">お振込み口座</th></tr>
    <tr>
      <th>銀行名 <span>必須</span></th>
      <td>
        <input type="text" class="form-text Form-Item-Input p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="bank_name" id="bank_name" required data-aire-for="bank_name" />
      </td>

      <th>支店名 <span>必須</span></th>
      <td>
        <input type="text" class="form-text Form-Item-Input p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="branch_name" id="branch_name" required data-aire-for="branch_name" />
      </td>
    </tr>
    <tr>
      <th>支店番号 <span>必須</span></th>
      <td>
        <input type="text" class="form-text Form-Item-Input p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="branch_code" id="branch_code" required placeholder="" data-aire-for="branch_code" />
      </td>

      <th>口座種別 <span>必須</span></th>
      <td>
        <input type="radio" id="box-3" name="bank_type" checked value="普通">
        <label for="box-3">普通</label>
        <input type="radio" id="box-4" name="bank_type" value="当座">
        <label for="box-4">当座</label>
      </td>
    </tr>
    <tr>
      <th>口座番号 <span>必須</span></th>
      <td>
        <input type="tel" class="form-text Form-Item-Input p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="bank_number" required data-aire-for="bank_number" id="__aire-3-bank_number49" />
      </td>

      <th>口座名義（カナ） <span>必須</span></th>
      <td>
        <input type="text" class="form-text Form-Item-Input p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="bank_kana" required data-aire-for="bank_kana" id="__aire-3-bank_kana52" />
      </td>
    </tr>
  </table>
  <table class="entry_tb2">
    <tr><th colspan="2" class="midashi_th">ご本人様確認(身分証明書)</th></tr>
    <tr>
      <td colspan="2" class="center">
        <p class="error_mes">
          身分証画像は、顔写真付きの運転免許証、パスポート、マイナンバーカードに限ります。<br class="sp-none">
          すべての項目と顔写真がはっきりと確認できるように撮影してください。<br>
          ※１　公共料金の明細などご住所が確認できる書類
        </p>
      </td>
    </tr>
    <tr>
      <td>身分証(表) <span>必須</span>
        <input type="file" name="files1" id="file1" required="">
      </td>
      <td>身分証(裏) <span>必須</span>
        <input type="file" name="files2" id="file2" required="">
      </td>
    </tr>
    <tr>
      <td>身分証(自撮り) <span>必須</span>
        <input type="file" name="files3" id="file3" required="">
      </td>
      <td>ご住所確認書類1 <span>※１</span>
        <input type="file" name="files4" id="file4">
      </td>
    </tr>
    <tr>
      <td>ご住所確認書類2
        <input type="file" name="files5" id="file5">
      </td>
      <td>ご住所確認書類3
        <input type="file" name="files6" id="file6">
      </td>
    </tr>
    <tr>
      <td>ご住所確認書類4
        <input type="file" name="files7" id="file7">
      </td>
      <td>ご住所確認書類5
        <input type="file" name="files8" id="file8">
      </td>
    </tr>
    <tr>
      <td>ご住所確認書類6
        <input type="file" name="files9" id="file9">
      </td>
      <td>ご住所確認書類7
        <input type="file" name="files10" id="file10">
      </td>
    </tr>

  </table>
  {{ Aire::submit('確認')->addClass('contact-submit') }}
  {{ Aire::close() }}



  </div>
</div>
</section>




@endsection

@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('/')}}vendor/dropify/dist/css/dropify.css">

@endsection

@section('javascript')

<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
<script src="https://zipaddr.github.io/bankauto0.js" charset="UTF-8"></script>
<script type="text/javascript" src="{{ asset('/')}}vendor/dropify/dist/js/dropify.js"></script>

<script type="text/javascript">
  var drEvent1 = $('#file1').dropify();
  var drEvent2 = $('#file2').dropify();
  var drEvent3 = $('#file3').dropify();
  var drEvent4 = $('#file4').dropify();
  var drEvent5 = $('#file5').dropify();
  var drEvent6 = $('#file6').dropify();
  var drEvent7 = $('#file7').dropify();
  var drEvent8 = $('#file8').dropify();
  var drEvent9 = $('#file9').dropify();
  var drEvent10 = $('#file10').dropify();
</script>

@endsection