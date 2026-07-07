<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Style-type" content="text/css; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')｜{{ config('app.name', '買取シマエナガ') }}</title>
  <meta name="description" content="@yield('description')">
  <meta name="Keywords" content="@yield('Keywords')">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  @if(Request::is('lp'))
  <meta name="robots" content="noindex,nofollow">
  <link rel="canonical" href="{{ config('app.domain_url') }}/lp/">
  @endif

  <link rel="icon" href="{{ asset('/') }}img/favicon.ico">

  <link rel="stylesheet" media="screen and (min-width: 980px)" type="text/css" href="{{ asset('/') }}css/pc_or.css" />
  <link rel="stylesheet" media="screen and (max-width: 979px)" type="text/css" href="{{ asset('/') }}css/sp_or.css" />
  <link rel="stylesheet" media="all" type="text/css" href="{{ asset('/') }}css/modal.css" />

  @yield('css')
  <!-- [if lt IE 9]>
  <script src="http://html5shim.googlecode/svn/trunk/html5.js"></script>
  <![end if]-->
</head>
<body>

<header id="header">
  <div class="header_in">
    <div class="header_top">
      <div class="h_logo">
        <a href="{{ route('top') }}"><img src="{{ asset('/') }}img/h_logo.jpg" alt="買取シマエナガ"></a>
      </div>
      <div class="h_links02 sp-none">
      <button class="js-open button-open" data-id="1">
        <div class="h_nav02">
          <p class="h_nav02_btn01">
            <span>お申し込み</span>
          </p>
        </div>
      </button>
      </div>
      <div id="navToggle">
        <div><img src="{{ asset('/') }}img/nav_icon_sp.png" class="pc-none" alt="Menu"></div>
      </div>
    </div>
    <div class="header_bottom pc-none">
      <nav class="navigation">
      <ul class="sp_navi01">
        <li><a href="{{ route('service') }}" title="ご利用ガイド">◯ ご利用ガイド</a></li>
        <li><a href="{{ route('company') }}" title="会社概要">◯ 会社概要</a></li>
        <li><a href="{{ route('privacy') }}" title="プライバシーポリシー">◯ プライバシーポリシー</a></li>
        <li><a href="{{config('app.com_line')}}" title="お問合せ">◯ お問合せ</a></li>
      </ul>
      </nav>
    </div>
  </div>
</header>
  


<main>
  @yield('content')
</main>

<div class="footer">
	<div class="footer_in">
		<div class="f_navi sp-none">
      <a href="{{ route('service') }}" title="ご利用ガイド">・ご利用ガイド</a>　
      <a href="{{ route('company') }}" title="会社概要">・会社概要</a>　
      <a href="{{ route('privacy') }}" title="プライバシーポリシー">・プライバシーポリシー</a>
		</div>
	</div>
</div>
<div class="f_copy">
	<p class="copy sp-none">Copyright <a href="{{ route('top') }}">買取シマエナガ</a>. All rights reserved</p>
  <p class="copy pc-none">© <a href="{{ route('top') }}">買取シマエナガ</a> inc.</p>
</div>


<section class="bg_black pc-none">
	<div class="sp_btn_cv">
		<button class="js-open button-open" data-id="1">- LINE完結！簡単お申し込み -</button>
	</div>
</section>

<!-- オーバーレイ -->
<div id="overlay" class="overlay"></div>
<!-- モーダルウィンドウ1 -->
<div class="modal-window" data-id="modal1">
  <h3>お申し込みについて</h3>
  <p>この度は、買取シマエナガをご覧いただき誠にありがとうございます。<br>お申し込み希望のお客様は以下の公式LINEアカウントにご登録後メッセージをお送りください。<br>ご利用方法や手続きにつきまして当店スタッフから改めてご連絡いたします。</p>
  <h3>公式LINEアカウント</h3>
  <div class="modal_in_box">
    <a href="{{config('app.com_line')}}" target="_blank"><img src="{{ asset('/') }}img/line_qr.png" alt="line_qr"></a>
  </div>
  <h4>{{config('app.com_line')}}</h4>
  <p>上記をクリック、またはQRコードを読み込むことにより公式LINEアカウントを登録する事ができます。</p>
  <button class="js-close button-close">× 閉じる</button>
</div>


<!-- JS area  -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="{{ asset('/') }}js/jQuery.fastClick.js"></script>
<script src="{{ asset('/') }}js/main.js"></script>
@yield('javascript')

</body>
</html>