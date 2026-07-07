<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Style-type" content="text/css; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>買取申込フォーム　リピート</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<style>
  html,body{
    padding:0;
    margin:0;
  }


  
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
  span.fn12{
    font-size:12px;
    color:red;
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
  select{
    font-size: 16px;
    border-radius:0;
    width: 100%;
  }
  .selectbox-001 {
      display: block;
      position: relative;
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
      background-color: #eaeaea;
      color: #333;
      font-size: 1em;
      cursor: pointer;
  }
  .selectbox-001 select:focus {
      outline: 2px solid #eaeaea;
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
</style>
</head>
<body>
    <div class="loading is-hide">
      <div class="loading_icon"></div>
    </div>


    <ul id="cation_msg"></ul>
    
    <form id="line-form" method="POST" action="{{ route('line.itemform.submit') }}">
        <h1>買取お申し込み</h1>
        @csrf
        <table class="client_tb">
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
                <br>
                <input type="checkbox" id="box-10" name="terms2">
                <label for="box-10">手元に商品があるので買取を申し込む</label>  
                <br>

                <input type="checkbox" id="chk_2time" name="chk_2time">
                <label for="chk_2time" class="chk_2time_css">前回利用時に合意した買取契約書の第11条の規定に基づき、同契約書の内容が適用されることを確認します。</label>     
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
            liffId: '{{$liff01_item_id}}' // LIFF ID を設定
        }).then(function() {
            if (liff.isLoggedIn()) {
                liff.getProfile().then(function(profile) {
                    $('#line_id').val(profile.userId);

                    // 読み込み時に顧客情報のありなしを判断してフォームの表示を制御する
                    var $loading = $(".loading");
                    $.ajax({
                        url: "{{ route('line.itemform.status') }}",
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
                              $('#cation_msg').append('<li>※最初にお客様情報の登録を行ってください。</li>');
                            }
                            else if(data.st === "CHK"){
                              $('form').remove();
                              $('#cation_msg li').remove();
                              $('#cation_msg').append('<li>※現在査定中の申込があります。<br>査定が完了してから再度お申し込み下さい。</li>');
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
  var next_msg = "買取申込ありがとうございます！\n査定に入りますのでしばしお待ちください。";
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