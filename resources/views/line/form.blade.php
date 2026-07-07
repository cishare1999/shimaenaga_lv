<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Style-type" content="text/css; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>新規お申込みフォーム</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<style>
  h1{
    width:100%;
    font-size:20px;
    text-align:center;
    padding:10px;
    box-sizing: border-box;
  }
  table.client_tb{
    width:96%;
    margin:0 auto;
    border-collapse: collapse;
    border:1px solid #ccc;
  }
  table.client_tb th{
    width:37%;
    border-collapse: collapse;
    border:1px solid #ccc;
    padding:5px;
    font-size:13px;
    background:#efefef;
  }
  table.client_tb td{
    width:63%;
    border-collapse: collapse;
    border:1px solid #ccc;
    padding:5px;
  }
  table.client_tb th span{
    color:red;
    font-size:12px;
  }
  input[type="text"] {
    font-size: 16px;
    width: 100%;
    box-sizing: border-box;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    border-radius:0;
  }
  input[type="tel"] {
    font-size: 16px;
    width: 100%;
    box-sizing: border-box;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    border-radius:0;
  }
  input[type="email"] {
    font-size: 16px;
    width: 100%;
    box-sizing: border-box;
    appearance: none;
    -webkit-appearance: none;
    border-radius:0;
    -moz-appearance: none;
  }
  select{
    font-size: 16px;
    border-radius:0;
    width: 100%;
  }
  textarea{
    font-size: 16px;
    width: 100%;
    height:120px;
    box-sizing: border-box;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    border-radius:0;
  }
  .selectbox-001 {
      position: relative;
      display: block;
  }
  .selectbox-001::before,
  .selectbox-001::after {
      position: absolute;
      content: '';
      pointer-events: none;
  }
  .selectbox-001::before {
      display: inline-block;
      right: 0;
      width: 1.8em;
      height: 1.8em;
      border-radius: 0 3px 3px 0;
      background-color: #1ccaff;
  }
  .selectbox-001::after {
      position: absolute;
      top: 40%;
      right: 0.9em;
      transform: translate(50%, -50%) rotate(45deg);
      width: 4px;
      height: 4px;
      border-bottom: 2px solid #fff;
      border-right: 2px solid #fff;
  }
  .selectbox-001 select {
      appearance: none;
      height: 1.8em;
      padding: .4em 3.6em .4em .8em;
      border: none;
      border-radius: 3px;
      background-color: #e6edf3;
      color: #333;
      font-size: 1em;
      cursor: pointer;
  }
  .selectbox-001 select:focus {
      outline: 2px solid #eaeaea;
  }

  span.fn12{
    font-size:12px;
    color:red;
  }


  .line-submit {
    width: 60%;
    font-size: 18px;
    display: block;
    background: #1ccaff;
    color: #FFF;
    border-radius: 5px;
    margin:15px auto;
    padding:15px 0 15px;
  }
  ul#error_msg {
    width:100%;
    margin:0 auto;
    box-sizing: border-box;
    padding:0;
  }
  ul#error_msg li{
    list-style:none;
    font-size:13px;
    text-align:left;
    line-height:1.3;
    color:red;
    box-sizing: border-box;
    padding:15px;
  }
  ul#cation_msg {
    width:100%;
    margin:20px auto;
    padding:0;
    box-sizing: border-box;
  }
  ul#cation_msg li{
    list-style:none;
    font-size:14px;
    text-align:center;
    line-height:1.3;
    color:red;
    box-sizing: border-box;
    padding:0;
  }
  
  dl.ac_list{
    box-sizing: border-box;
    width: 100%;
    margin: 10px auto;
  }
  dl.ac_list dt{
    width:100% !important;
    float:none !important;
    font-weight: normal;
    cursor: pointer;
    position: relative;
    font-size:14px;
    color:#fff !important;
    background: #1ccaff;
    text-align:center;
    box-sizing: border-box;
    padding:10px 0 10px 10px;
    margin:10px 0 0px 0px !important;;
    border:1px solid #ccc;
  }
  dl.ac_list dd{
    width:100% !important;
    margin:0px auto 5px !important;
    border:1px solid #1ccaff;
    border-top:none;
    background: #fff;
    padding:10px;
    position: relative;
    color:#000;
    font-size:13px;
    line-height: 1.3em;
    text-align:left;
    box-sizing: border-box;
    max-height:150px;
    overflow: auto !important;
  }
  dl.ac_list dd h4{
    text-align:center;
    padding:10px 0 10px;
    margin:0;
  }
  dl.ac_list dd p{
    text-align:left;
    padding:0;
    margin:0;
  }

  .is-hide{
    display:none; 
  }
  .loading{
    position:fixed;
    top:0;
    right:0;
    bottom:0;
    left:0;
    background:rgba(0,0,0,.5);
    z-index:100;
  }
  .loading::before{
    content:"";
    display:block;
    position:fixed;
    left:50%;
    top:50%;
    width:50px;
    height:50px;
    border-radius:5px;
    margin-top:-15px;
    margin-left:-15px;
    background:white;
  }
  .loading::after{
    content:"";
    display:block;
    position:fixed;
    left:50%;
    top:50%;
    width:32px;
    height:32px;
    border-radius:20px;
    margin-top:-10px;
    margin-left:-10px;
    border:4px solid #60ABB9;
    border-right:4px solid white;
    animation: rotate 1s infinite linear;
  }
  @keyframes rotate {
    0%    { transform: rotate(0deg); }
    100%  { transform: rotate(360deg); }
  }
  .osaka_tx_wrap{
    width:90%;
    text-align:center;
    margin:10px auto;
    padding:7px;
    background-origin: border-box;
    border:1px solid red;
  }
  .osaka_tx_wrap h3{
    color:red;
    text-align:center;
    font-size:16px;
    padding:0 0 5px 0;
  }
  .osaka_tx_wrap p{
    color:#000;
    font-weight: bold;
    text-align:left;
    line-height:1.5;
    font-size:14px;
  }
  .osaka_tx_wrap p b{
    color:red;
  }

</style>
</head>
<body>
  <div class="loading is-hide">
    <div class="loading_icon"></div>
  </div>


  <ul id="cation_msg"></ul>



    <form id="line-form" method="POST" action="{{ route('line.form.submit') }}">
        <h1>お客様情報のご入力フォーム</h1>
        <div class="osaka_tx_wrap">
          <h3>※重要なお知らせ</h3>
          <p>
            現在、<b>大阪府、岩手県</b>にお住まいのお客様からの買取に関しまして、偽造品に関する事案が多数発生したため、安全対策として一時的に買取を停止させていただいております。<br>
            <br>
            お客様にはご不便をおかけいたしますが、何卒ご理解のほどよろしくお願い申し上げます。<br>
            買取再開の際には、改めてご案内いたします。
          </p>
        </div>

        @csrf
        <table class="client_tb">
          <tr>
            <th>お名前 <span>※</span></th>
            <td>
              <input type="text" name="name" value="">
            </td>
          </tr>
          <tr>
            <th>名前フリガナ <span>※</span></th>
            <td>
              <input type="text" name="kana">
            </td>
          </tr>
          <tr>
            <th>携帯番号 <span>※</span></th>
            <td>
              <input type="tel" name="mobile">
            </td>
          </tr>
          <tr>
            <th>メールアドレス <span>※</span></th>
            <td>
              <input type="email" name="email">
            </td>
          </tr>
          <tr>
            <th>生年月日 <span>※</span></th>
            <td>
              <div class="birthday_box">
              <label class="selectbox-001">

                <select class="form-select-100" name="birthday_year">
                  <option value="">年</option>
                    @foreach(config('date_year') as $key => $val)
                        <option value="{{ $val }}" @if($val == old('birthday_year')) selected="" @endif>{{ $val }}</option>
                    @endforeach
                </select>
                
              </label>
              <label class="selectbox-001">

                <select class="form-select-100" name="birthday_month">
                  <option value="">月</option>
                    @foreach(config('date_month') as $key => $val)
                        <option value="{{ $val }}" @if($val == old('birthday_month')) selected="" @endif>{{ $val }}</option>
                    @endforeach
                </select>

              </label>
              <label class="selectbox-001">

                <select class="form-select-100" name="birthday_day">
                  <option value="">日</option>
                    @foreach(config('date_day') as $key => $val)
                        <option value="{{ $val }}" @if($val == old('birthday_day')) selected="" @endif>{{ $val }}</option>
                    @endforeach
                </select>

              </label>
            </div>
            </td>
          </tr>
          <tr>
            <th>性別　<span>※</span></th>
            <td>
              <input type="radio" id="box-5" name="gender" checked value="男性">
              <label for="box-5">男性</label>
              <input type="radio" id="box-6" name="gender" value="女性">
              <label for="box-6">女性</label>
            </td>
          </tr>
          <tr>
            <th>郵便番号 <span>※</span></th>
            <td>
              <input type="tel" name="zip">
            </td>
          </tr>
          <tr><th colspan="2" class="midashi_th">ご住所</th></tr>
          <tr>
            <th>都道府県 <span>※</span></th>
            <td>
              <label class="selectbox-001">

              <select name="pref">
                <option value="" selected>選択してください</option>
                <option value="北海道">北海道</option>
                <option value="青森県">青森県</option>
                {{-- <option value="岩手県">岩手県</option> --}}
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
                {{-- <option value="大阪府">大阪府</option> --}}
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

              </label>
            </td>
          </tr>
          <tr>
            <th>市区町村 <span>※</span></th>
            <td>
              <input type="text" name="city">
            </td>
          </tr>
          <tr>
      
            <th>番地以降 <span>※</span></th>
            <td>
              <input type="text" name="address">
            </td>
          </tr>
          <tr>
            <th>ビルマンション名・部屋番号</th>
            <td colspan="3">
              <input type="text" name="building">
            </td>
          </tr>
          <tr><th colspan="2" class="midashi_th">お振込み口座</th></tr>
          <tr>
            <th>銀行名 <span>※</span></th>
            <td>
              <input type="text" name="bank_name">
            </td>
          </tr>
          <tr>
            <th>支店名 <span>※</span></th>
            <td>
              <input type="text" name="branch_name">
            </td>
          </tr>
          <tr>
            <th>支店番号 <span>※</span></th>
            <td>
              <input type="tel" name="branch_code">
            </td>
          </tr>
          <tr>
            <th>口座種別 <span>※</span></th>
            <td>
              <input type="radio" id="box-3" name="bank_type" checked value="普通">
              <label for="box-3">普通</label>
              <input type="radio" id="box-4" name="bank_type" value="当座">
              <label for="box-4">当座</label>
            </td>
          </tr>
          <tr>
            <th>口座番号 <span>※</span></th>
            <td>
              <input type="tel" name="bank_number">
            </td>
          </tr>
          <tr>
            <th>口座名義（カナ） <span>※</span></th>
            <td>
              <input type="text" name="bank_kana">
            </td>
          </tr>
          <tr>
            <th colspan="2" class="midashi_th">勤務先情報</th>
          </tr>
          <tr>
            <th>勤務先名 <span>※</span></th>
            <td>
              <input type="text" name="work_name">
            </td>
          </tr>
          <tr>
            <th>勤務先 電話番号 <span>※</span></th>
            <td>
              <input type="tel" name="work_tel">
            </td>
          </tr>
          <tr>
            <th>勤務先 郵便番号 <span>※</span></th>
            <td>
              <input type="tel" name="work_zip">
            </td>
          </tr>
          <tr>
            <th>勤務先 都道府県 <span>※</span></th>
            <td>
              <label class="selectbox-001">

              <select name="work_pref">
                <option value="" selected>選択してください</option>
                <option value="北海道">北海道</option>
                <option value="青森県">青森県</option>
                {{-- <option value="岩手県">岩手県</option> --}}
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
                {{-- <option value="大阪府">大阪府</option> --}}
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

              </label>
            </td>
          </tr>
          <tr>
            <th>勤務先 市区町村 <span>※</span></th>
            <td>
              <input type="text" name="work_city">
            </td>
          </tr>
          <tr>
            <th>勤務先 番地以降 <span>※</span></th>
            <td>
              <input type="text" name="work_address">
            </td>
          </tr>
          <tr>
            <th>勤務先 ビルマンション名・部屋番号</th>
            <td>
              <input type="text" name="work_building">
            </td>
          </tr>
          <tr>
            <th>月額給与額 <span>※</span></th>
            <td>
              <input type="text" name="salary">
            </td>
          </tr>
          <tr>
            <th>給料日 <span>※</span></th>
            <td colspan="3">
              <input type="text" name="payday">
            </td>
          </tr>

          {{--　ここから買取フォーム  --}}
          <tr>
            <th colspan="2" class="midashi_th">買取情報</th>
          </tr>
          <tr>
            <th>買取方法 <span>※</span></th>
            <td>
              <input type="radio" id="box-1" name="way" checked value="後日郵送買取">
              <label for="box-1">後日郵送買取 <span class="fn12">※先に現金化</span></label><br>
              <input type="radio" id="box-2" name="way" value="郵送">
              <label for="box-2">郵送買取 <span class="fn12">※郵送後現金化</span></label>
            </td>
          </tr>
          <tr>
            <th>商品 <span>必須</span></th>
            <td colspan="3">
              <label class="selectbox-001">
                <select name="status_item">
                  <option value=""selected>選択してください</option>
                  {{-- <option value="21">全国百貨店共通商品券</option>
                  <option value="22">ギフト券</option> --}}
                  <option value="iphone各種">iphone各種</option>
                  <option value="収入印紙">収入印紙</option>
                  <option value="切手">切手</option>
                  <option value="全国百貨店共通商品券">全国百貨店共通商品券</option>
                  <option value="ギフト券">ギフト券</option>
                </select>
              </label>
              <span class="fn12">※iphone各種を選択した場合商品説明に詳細をご入力ください。<br>※リストに表示されていない商品は現在買取を停止しております。</span>
            </td>
          </tr>
          <tr>
            <th>商品説明 <span>必須</span></th>
            <td colspan="3">
              <textarea name="comment"></textarea>
            </td>
          </tr>
          <tr>
            <th>希望金額 <span>必須</span></th>
            <td>
              <span class="fn12">※後日郵送買取の上限は10万円です</span>
              <label class="selectbox-001">

                <select name="price">
                  <option value=""selected>選択してください</option>
                  <option value="5,000円">5,000円</option>
                  <option value="10,000円">10,000円</option>
                  <option value="11,000円">11,000円</option>
                  <option value="12,000円">12,000円</option>
                  <option value="13,000円">13,000円</option>
                  <option value="14,000円">14,000円</option>
                  <option value="15,000円">15,000円</option>
                  <option value="16,000円">16,000円</option>
                  <option value="17,000円">17,000円</option>
                  <option value="18,000円">18,000円</option>
                  <option value="19,000円">19,000円</option>
                  <option value="20,000円">20,000円</option>
                  <option value="21,000円">21,000円</option>
                  <option value="22,000円">22,000円</option>
                  <option value="23,000円">23,000円</option>
                  <option value="24,000円">24,000円</option>
                  <option value="25,000円">25,000円</option>
                  <option value="26,000円">26,000円</option>
                  <option value="27,000円">27,000円</option>
                  <option value="28,000円">28,000円</option>
                  <option value="29,000円">29,000円</option>
                  <option value="30,000円">30,000円</option>
                  <option value="31,000円">31,000円</option>
                  <option value="32,000円">32,000円</option>
                  <option value="33,000円">33,000円</option>
                  <option value="34,000円">34,000円</option>
                  <option value="35,000円">35,000円</option>
                  <option value="36,000円">36,000円</option>
                  <option value="37,000円">37,000円</option>
                  <option value="38,000円">38,000円</option>
                  <option value="39,000円">39,000円</option>
                  <option value="40,000円">40,000円</option>
                  <option value="41,000円">41,000円</option>
                  <option value="42,000円">42,000円</option>
                  <option value="43,000円">43,000円</option>
                  <option value="44,000円">44,000円</option>
                  <option value="45,000円">45,000円</option>
                  <option value="46,000円">46,000円</option>
                  <option value="47,000円">47,000円</option>
                  <option value="48,000円">48,000円</option>
                  <option value="49,000円">49,000円</option>
                  <option value="50,000円">50,000円</option>
                  <option value="51,000円">51,000円</option>
                  <option value="52,000円">52,000円</option>
                  <option value="53,000円">53,000円</option>
                  <option value="54,000円">54,000円</option>
                  <option value="55,000円">55,000円</option>
                  <option value="56,000円">56,000円</option>
                  <option value="57,000円">57,000円</option>
                  <option value="58,000円">58,000円</option>
                  <option value="59,000円">59,000円</option>
                  <option value="60,000円">60,000円</option>
                  <option value="61,000円">61,000円</option>
                  <option value="62,000円">62,000円</option>
                  <option value="63,000円">63,000円</option>
                  <option value="64,000円">64,000円</option>
                  <option value="65,000円">65,000円</option>
                  <option value="66,000円">66,000円</option>
                  <option value="67,000円">67,000円</option>
                  <option value="68,000円">68,000円</option>
                  <option value="69,000円">69,000円</option>
                  <option value="70,000円">70,000円</option>
                  <option value="71,000円">71,000円</option>
                  <option value="72,000円">72,000円</option>
                  <option value="73,000円">73,000円</option>
                  <option value="74,000円">74,000円</option>
                  <option value="75,000円">75,000円</option>
                  <option value="76,000円">76,000円</option>
                  <option value="77,000円">77,000円</option>
                  <option value="78,000円">78,000円</option>
                  <option value="79,000円">79,000円</option>
                  <option value="80,000円">80,000円</option>
                  <option value="81,000円">81,000円</option>
                  <option value="82,000円">82,000円</option>
                  <option value="83,000円">83,000円</option>
                  <option value="84,000円">84,000円</option>
                  <option value="85,000円">85,000円</option>
                  <option value="86,000円">86,000円</option>
                  <option value="87,000円">87,000円</option>
                  <option value="88,000円">88,000円</option>
                  <option value="89,000円">89,000円</option>
                  <option value="90,000円">90,000円</option>
                  <option value="91,000円">91,000円</option>
                  <option value="92,000円">92,000円</option>
                  <option value="93,000円">93,000円</option>
                  <option value="94,000円">94,000円</option>
                  <option value="95,000円">95,000円</option>
                  <option value="96,000円">96,000円</option>
                  <option value="97,000円">97,000円</option>
                  <option value="98,000円">98,000円</option>
                  <option value="99,000円">99,000円</option>
                  <option value="100,000円">100,000円</option>
                  <option value="10万円以上">10万円以上</option>
                </select>
              </label>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <dl class="ac_list">
                <dt>利用規約</dt>
                <dd>{!! config('terms') !!}</dd>
              </dl>
              <div class="Form-Item" align="center">
                <input type="checkbox" id="box-9" name="terms">
                <label for="box-9">利用規約に同意する</label>  
              </div>
              <div class="Form-Item" align="center">
                <input type="checkbox" id="box-10" name="terms2">
                <label for="box-10">手元に商品があるので買取を申し込む</label>  
              </div>


            </td>
          </tr>

        </table>

        <input type="hidden" id="line_id" name="line_id">


        <div class="alert alert-danger">
          <ul id="error_msg"></ul>
        </div>
  


        <button class="line-submit" type="submit">送信</button>
    </form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
<script>
    $(document).ready(function() {
        liff.init({
            liffId: '{{$liff01_id}}' // LIFF ID を設定
        }).then(function() {
            if (liff.isLoggedIn()) {
                liff.getProfile().then(function(profile) {
                    $('#line_id').val(profile.userId);
                    // 読み込み時に顧客情報のありなしを判断してフォームの表示を制御する
                    var $loading = $(".loading");
                    $.ajax({
                        url: "{{ route('line.form.status') }}",
                        method: "POST",
                        data: {
                          "line_id" : profile.userId
                        },
                        beforeSend:function(){
                          $loading.removeClass("is-hide");
                        },
                        success: function(data) {
                            $loading.addClass("is-hide");
                            if(data.st === "NG"){
                              $('form').remove();
                              $('#cation_msg li').remove();
                              $('#cation_msg').append('<li>※お客様情報は登録されています。<br>変更される場合は直接メッセージにてご連絡ください。</li>');
                            }
                        },
                        error: function(xhr) {
                            // フォームの送信エラー時の処理

                        }
                    });

                }).catch(function(error) {
                    console.log('LINEプロフィール情報の取得に失敗しました:', error);
                });
            } else {
                liff.login();
            }
        }).catch(function(error) {
            console.log('LIFFの初期化に失敗しました:', error);
        });

        $('#line-form').submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');
            var data = form.serialize();

            $.ajax({
                url: url,
                method: method,
                data: data,
                success: function(data) {
                    // フォームの送信成功時の処理
                    // alert(data.message);
                    sendText(data.message);
                    // sendMessages(response);
                },
                error: function(xhr) {
                    // フォームの送信エラー時の処理
                    var errors = xhr.responseJSON.errors;
                    if (errors) {
                        var errorMessages = Object.values(errors).join('<br>');
                        $('#error_msg li').remove();
                        $('#error_msg').append('<li>'+errorMessages+'</li>');
                    } else {
                        alert('フォームの送信に失敗しました。');
                    }
                }
            });
        });

    });

function sendText(data) {
  // var next_msg = "お客様情報の入力ありがとうございます。\n続きまして、ご本人様確認(身分証明書)画像の提出をお願いします。\n以下の画像3点を送信して下さい。\n・身分証明書　表面\n・身分証明書　裏面\n・身分証(自撮り)\n\n画像送信が完了したら、メニューより買取商品のお申し込みを行ってください。";
  var next_msg = "お申込ありがとうございます。\n続きまして、ご本人様確認(身分証明書)画像の提出をお願いします。\n以下の画像3点を送信して下さい。\n・身分証明書　表面\n・身分証明書　裏面\n・身分証(自撮り)\n\n画像送信が終わりましたら査定に入ります。\nしばしお待ちください。";
  liff.sendMessages([{
      'type': 'text',
      'text': data
  },{
     "type": "sticker",
     "packageId": "11537",
     "stickerId": "52002739"
  },{
    'type': 'text',
    'text': next_msg
  }]).then(function () {
    liff.closeWindow();
  }).catch(function (error) {
    window.alert('メッセージの送信に失敗しました: ' + error);
  });
}



</script>
</body>
</html>