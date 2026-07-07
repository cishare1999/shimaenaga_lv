@extends('layouts.app')

@section('title', '新規買取')
@section('description', '最短10分でできる商品券買取スマホで簡単')
@section('Keywords', '全国百貨店共通商品券,ギフト券,商品券,買取')

@section('content')
<section id="contact" class="">
  <h2>新規買取お申し込み</h2>

  <div class="row">
    <div class="in_row">
      <p style="margin-top:30px;">
        商品についてご入力ください。
        @unless($auth->userData->work_name)
        <br>
        <span style="color:red;">後日郵送買取</span>をご希望の場合は勤務先についてもご入力ください。
        @endunless
      </p>


{{ Aire::open()->route('mypage.new_confirm')->encType('multipart/form-data')->addClass('') }}

<table class="entry_tb">
  <tr><th colspan="4" class="center">商品情報</th></tr>
  <tr>
    <th>買取方法 <span>必須</span></th>
    <td colspan="3">
      <input type="radio" id="box-1" name="way" checked value="後日郵送買取">
      <label for="box-1">後日郵送買取 ※先に現金化</label><br>
      <input type="radio" id="box-2" name="way" value="郵送">
      <label for="box-2">郵送買取 ※郵送後現金化</label>
    </td>
  </tr>
  <tr>
    <th colspan="4" class="center">下記から該当商品を選択してください。</th>
  </tr>
  <tr>
    <td colspan="4">
      <div id="satei01">
      {{-- <table class="entry_tb">
        <tr>
          <th class="center"><img src="{{ asset('/') }}images/newimg/gift.jpg" alt="" width="100"></th>
          <td>
          <input type="radio" id="satei_item21" name="status_item" checked value="21">
          <label for="satei_item01">全国百貨店共通商品券</label><br>
          </td>
        </tr>
        <tr>
          <th class="center"><img src="{{ asset('/') }}images/newimg/inshi.jpg" alt="" width="100"></th>
          <td>
            <input type="radio" id="satei_item22" name="status_item" value="22">
            <label for="satei_item22">収入印紙</label>
          </td>
        </tr>
      </table> --}}
      </div>
      <!-- #satei01 end -->

      <div id="satei02">
        <table class="entry_tb">
          <tr>
            <td>画像1<input type="file" name="files1" id="file1"></td>
            <td>画像2<input type="file" name="files2" id="file2"></td>
            <td>画像3<input type="file" name="files3" id="file3"></td>
          </tr>
        </table>
      </div>
      <!-- #satei02 end -->

    </td>
  </tr>
  {{-- <tr>
    <th>商品名 <span>必須</span></th>
    <td>
      <input type="text" class="form-text Form-Item-Input p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="item_name" required value="" data-aire-for="item_name" id="__aire-0-item_name1" />
    </td>
  </tr>
  <tr>
    <th>商品の状態 <span>必須</span></th>
    <td>
      <select name="condition" class="form-select-100" required="">
        <option value=""selected>選択してください</option>
        <option value="新品">新品</option>
        <!-- <option value="未使用に近い">未使用に近い</option> -->
        <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
        <option value="やや傷や汚れあり">やや傷や汚れあり</option>
        <!-- <option value="傷や汚れあり">傷や汚れあり</option> -->
        <!-- <option value="全体的に状態が悪い">全体的に状態が悪い</option> -->
      </select>
    </td>
  </tr> --}}
  <tr>
    <th>商品 <span>必須</span></th>
    <td colspan="3">
      <select name="status_item" class="form-select-100" required="">
        <option value=""selected>選択してください</option>
        <option value="21">全国百貨店共通商品券</option>
        <option value="22">ギフト券</option>
      </select>
    </td>
  </tr>
  <tr>
    <th>商品説明 <span>必須</span></th>
    <td colspan="3">
      <textarea class="form-textarea block w-full p-2 text-base leading-normal bg-white border rounded-sm Form-Item-Textarea text-gray-900" data-aire-component="textarea" name="comment" required data-aire-for="comment" id="__aire-0-comment4"></textarea>
    </td>
  </tr>
  <tr>
    <th>希望金額 <span>必須</span></th>
    <td>
      <small>※後日郵送買取の上限は10万円です</small>
      <select class="form-select-100" name="price" required="">
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
        <option class="limit_option" style="display: none;" value="10万円以上">10万円以上</option>
      </select>
    </td>

    <th>希望金額(10万円以上)</th>
    <td>
      <input type="text" class="form-text Form-Item-Input p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="price_more" value="" data-aire-for="price_more" id="__aire-0-price_more7" />
    </td>
  </tr>
  <tbody class="job_area">
  @unless($auth->userData->work_name)  
  <tr>
    <th colspan="4" class="center">勤務先情報</th>
  </tr>
  <tr>
    <th>勤務先名 <span>必須</span></th>
    <td>
      <input type="text" class="form-text Form-Item-Input p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="work_name" required value="" data-aire-for="work_name" id="__aire-0-work_name10" />
    </td>

    <th>勤務先 電話番号 <span>必須</span></th>
    <td>
      <input type="tel" class="form-text Form-Item-Input p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="work_tel" required placeholder="" value="" data-aire-for="work_tel" id="__aire-0-work_tel13" />
    </td>
  </tr>
  <tr>
    <th>勤務先 郵便番号 <span>必須</span></th>
    <td>
      <input type="tel" class="form-text Form-Item-Input p-postal-code p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="work_zip" size="8" maxlength="8" required placeholder="1000001" data-aire-for="work_zip" id="__aire-0-work_zip16" />
    </td>

    <th>勤務先 都道府県 <span>必須</span></th>
    <td>
      <select class="form-select-100 block w-full p-2 leading-normal border rounded-sm bg-white appearance-none p-region text-gray-900" data-aire-component="select" name="work_pref" required data-aire-for="work_pref" id="__aire-0-work_pref19">
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
    <th>勤務先 市区町村 <span>必須</span></th>
    <td>
      <input type="text" class="form-text Form-Item-Input p-locality p-street-address p-extended-address p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="work_city" required data-aire-for="work_city" id="__aire-0-work_city22" />
    </td>

    <th>勤務先 番地以降 <span>必須</span></th>
    <td>
      <input type="text" class="form-text Form-Item-Input p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="work_address" required data-aire-for="work_address" id="__aire-0-work_address25" />
    </td>
  </tr>
  <tr>
    <th>勤務先 ビルマンション名・部屋番号 <span>必須</span></th>
    <td>
      <input type="text" class="form-text Form-Item-Input p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="work_building" data-aire-for="work_building" id="__aire-0-work_building28" />
    </td>

    <th>月額給与額 <span>必須</span></th>
    <td>
      <input type="text" class="form-text Form-Item-Input p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="salary" required placeholder="例）30万円" value="" data-aire-for="salary" id="__aire-0-salary31" />
    </td>
  </tr>
  <tr>
    <th>給料日 <span>必須</span></th>
    <td colspan="3">
      <input type="text" class="form-text Form-Item-Input p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="payday" required placeholder="例）25日" value="" data-aire-for="payday" id="__aire-0-payday34" />
    </td>
  </tr>
  @else
  <input type="hidden" name="workdata" value="on">
  @endunless
  </tbody>
  <tr>
    <td colspan="4">
    <dl class="ac_list">
      <dt>利用規約</dt>
      <dd>{!! config('terms') !!}</dd>
      {{-- <dt>キャンセルポリシー</dt>
      <dd>{!! config('cancel') !!}</dd> --}}
    </dl>
    <div class="Form-Item" align="center">
      <input type="checkbox" id="box-9" name="terms">
      {{-- <label for="box-9">利用規約・キャンセルポリシーに同意する</label>   --}}
      <label for="box-9">利用規約に同意する</label>  
    </div>
    @error('terms')
    <p class="error_mes">{{ $message }}</p>
    @enderror
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

<script type="text/javascript">
  $('input[name=way]').on('change', function() {
    if($('input[name=way]:checked').val() === '後日郵送買取') {
      $('.job_area').show();
      $('input[name=work_name]').prop('required', true);
      $('input[name=work_tel]').prop('required', true);
      $('input[name=work_zip]').prop('required', true);
      $('select[name=work_pref]').prop('required', true);
      $('input[name=work_city]').prop('required', true);
      $('input[name=work_address]').prop('required', true);
      $('input[name=salary]').prop('required', true);
      $('input[name=payday]').prop('required', true);
      $('.more_area').hide();
      $('.limit_option').hide();
      $('.limit_txt').show();
    } else {
      $('.job_area').hide();
      $('input[name=work_name]').prop('required', false);
      $('input[name=work_tel]').prop('required', false);
      $('input[name=work_zip]').prop('required', false);
      $('select[name=work_pref]').prop('required', false);
      $('input[name=work_city]').prop('required', false);
      $('input[name=work_address]').prop('required', false);
      $('input[name=salary]').prop('required', false);
      $('input[name=payday]').prop('required', false);
      $('.more_area').show();
      $('.limit_option').show();
      $('.limit_txt').hide();
    }
  });
</script>

<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>
<script src="https://zipaddr.github.io/bankauto0.js" charset="UTF-8"></script>
<script type="text/javascript" src="{{ asset('/')}}vendor/dropify/dist/js/dropify.js"></script>

<script type="text/javascript">
  var drEvent1 = $('#file1').dropify();
  var drEvent2 = $('#file2').dropify();
  var drEvent3 = $('#file3').dropify();
</script>
<script type="text/javascript">
$(function() {
  $('[name="way"]:radio').change( function() {
    if($('[id=box-1]').prop('checked')){
      $('#satei02').hide();
      $('#satei01').show();
    } else if ($('[id=box-2]').prop('checked')) {
      $('#satei01').hide();
      $('#satei02').show();
    } 
  });
});
</script>
<script type="text/javascript">
  $(function() {
    var radioVal = $("input[name='status_item']:checked").val();
    $("input[name='item_name']").val("全国百貨店共通商品券");

    $("input[name='status_item']").click( function() {
      var radioVal = $("input[name='status_item']:checked").val();
      if(radioVal == 21){
        $("input[name='item_name']").val("全国百貨店共通商品券");
      }else{
        $("input[name='item_name']").val("収入印紙");
      }
    });
  });
  </script>
@endsection