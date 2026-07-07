@extends('layouts.app')

@section('title', '個人情報登録')
@section('description', 'ディスクリプション')

@section('content')

<!--  main  -->
<div id="main">
  <div id="page-content">
    <div class="register-icon">
      <ul>
        <li>
          <img src="{{ asset('/') }}img/icon01.png">
          <div class="register_txt">個人情報編集</div>
          <hr>
        </li>
     
        
      </ul>
    </div>
    <div class="sign-up">
      <div class="title">個人情報編集</div>
        <div class="text center">
          お客様についてご入力ください。
        </div>
        <div class="signup-inner">
          <div class="Form">
            {{ Aire::open()->route('mypage.entryedit_confirm')->encType('multipart/form-data')->addClass('h-adr') }}
            
            {{ Aire::input('name','お名前')->required()->prepend('必須')->addClass('Form-Item-Input')->readonly()->value($auth->name) }}
            {{ Aire::input('kana','お名前(カナ)')->required()->prepend('必須')->addClass('Form-Item-Input')->placeholder('')->value($auth->userData->kana) }}
            {{ Aire::email('email','メールアドレス')->required()->prepend('必須')->addClass('Form-Item-Input')->readonly()->value($auth->email) }}
            {{ Aire::tel('mobile','携帯電話番号')->required()->prepend('必須')->addClass('Form-Item-Input')->readonly()->value($auth->mobile) }}
            {{ Aire::input('line','LINE ID')->addClass('Form-Item-Input')->placeholder('')->value($auth->userData->line) }}

            <small>ID検索をONにしてください。</small>
            <div class="Form-Item">
              <p class="Form-Item-Label">ご連絡方法
              <span class="Form-Item-Label-Required">必須</span></p>
              <input type="radio" id="box-1" name="contact" checked value="携帯" {{ old('contact',$auth->userData->contact) == '携帯' ? 'checked' : '' }}>
              <label for="box-1">携帯</label>
              <input type="radio" id="box-2" name="contact" value="LINE" {{ old('contact',$auth->userData->contact) == 'LINE' ? 'checked' : '' }}>
              <label for="box-2">LINE</label>
            </div>
            <small>2回目以降はLINEで簡単に取引ができます。</small>

            {{ Aire::tel('zip','郵便番号')->size('8')->maxLength('8')->required()->prepend('必須')->addClass('Form-Item-Input p-postal-code')->placeholder('1000001')->value($auth->userData->zip) }}
            <span class="p-country-name" style="display:none;">Japan</span>
            {{ Aire::select(config('select_prefs'), 'pref')->label('都道府県')->required()->prepend('必須')->addClass('p-region')->value($auth->userData->pref) }}
            {{ Aire::input('city','市区町村')->required()->prepend('必須')->addClass('Form-Item-Input p-locality p-street-address p-extended-address')->value($auth->userData->city) }}
            {{ Aire::input('address','番地以降')->required()->prepend('必須')->addClass('Form-Item-Input')->value($auth->userData->address) }}
            {{ Aire::input('building','ビルマンション名・部屋番号')->addClass('Form-Item-Input')->value($auth->userData->building) }}

            <p class="form_ttl">お振込み先口座</p>

            {{ Aire::input('bank_name','銀行名')->id('bank_name')->required()->prepend('必須')->addClass('Form-Item-Input')->value($auth->userData->bank_name) }}
            {{ Aire::input('bank_code','銀行コード')->id('bank_code')->required()->prepend('必須')->addClass('Form-Item-Input')->placeholder('自動入力')->value($auth->userData->bank_code) }}
            {{ Aire::input('branch_name','支店名')->id('branch_name')->required()->prepend('必須')->addClass('Form-Item-Input')->value($auth->userData->branch_name) }}
            {{ Aire::input('branch_code','支店コード')->id('branch_code')->required()->prepend('必須')->addClass('Form-Item-Input')->placeholder('自動入力')->value($auth->userData->branch_code) }}
            <div class="Form-Item">
              <p class="Form-Item-Label">口座種別
              <span class="Form-Item-Label-Required">必須</span></p>
              <input type="radio" id="box-3" name="bank_type" checked value="普通" {{ old('bank_type',$auth->userData->bank_type) == '普通' ? 'checked' : '' }}>
              <label for="box-3">普通</label>
              <input type="radio" id="box-4" name="bank_type" value="当座" {{ old('bank_type',$auth->userData->bank_type) == '当座' ? 'checked' : '' }}>
              <label for="box-4">当座</label>
            </div>
            {{ Aire::tel('bank_number','口座番号')->required()->prepend('必須')->addClass('Form-Item-Input')->value($auth->userData->bank_number) }}
            {{ Aire::input('bank_kana','口座名義（カナ）')->required()->prepend('必須')->addClass('Form-Item-Input')->value($auth->userData->bank_kana) }}

            <p class="form_ttl">身分証明書</p>

            <div class="selfy">
              <div class="left">
                <img src="{{ asset('/') }}img/selfy.jpg" style="max-width: 240px; display: block; margin: 0 auto;">
              </div>
              <div class="right">
                <p>
                  身分証画像は、顔写真付きの運転免許証、パスポート、マイナンバーカードに限ります。<br>
                  すべての項目と顔写真がはっきりと確認できるように撮影してください。<br>
                  セルフィーはイラストを参考に写真を撮影し送付してください。
                </p>
              </div>
            </div>

            <div class="Form-Item">
              <p class="Form-Item-Label">身分証<small>(表)</small>
                <span class="Form-Item-Label-Required">必須</span>
              </p>
              <div class="inputImage">
                <input type="file" name="files1" id="file1" required="">
              </div>
            </div>
            <div class="Form-Item">
              <p class="Form-Item-Label">身分証<small>(裏)</small>
                <span class="Form-Item-Label-Required">必須</span>
              </p>
              <div class="inputImage">
                <input type="file" name="files2" id="file2" required="">
              </div>
            </div>
            <div class="Form-Item">
              <p class="Form-Item-Label">身分証<small>(セルフィー)</small>
                <span class="Form-Item-Label-Required">必須</span>
              </p>
              <div class="inputImage">
                <input type="file" name="files3" id="file3" required="">
              </div>
            </div>

            {{ Aire::submit('確認')->addClass('Form-Btn') }}

            {{ Aire::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>





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
</script>

@endsection