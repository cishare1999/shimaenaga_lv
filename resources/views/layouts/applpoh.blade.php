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

  <link rel="icon" href="{{ asset('/') }}images/favicon.ico">

  <link rel="stylesheet" media="screen and (min-width: 980px)" type="text/css" href="{{ asset('/') }}css/pc.css" />
  <link rel="stylesheet" media="screen and (max-width: 979px)" type="text/css" href="{{ asset('/') }}css/sp.css" />
  <link rel="stylesheet" media="all" type="text/css" href="{{ asset('/') }}css/modal.css" />
  <link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic:wght@400;500&display=swap" rel="stylesheet">

  @if (request()->segment(1) === 'lp3')
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-5X3C43ZS');</script>
  <!-- End Google Tag Manager -->
  @endif

  @yield('css')
  <!-- [if lt IE 9]>
  <script src="http://html5shim.googlecode/svn/trunk/html5.js"></script>
  <![end if]-->
</head>
<body>
  @if (request()->segment(1) === 'lp3')
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5X3C43ZS"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  @endif
  
  

<header id="header">
  <div class="header_in">
  
    <div class="header_top">
      <div class="h_logo">
        <a href="{{ url('/' . session('from_url') . '/') }}"><img src="{{ asset('/') }}images/h_logo.png" alt="買取シマエナガ"></a>
      </div>
  
      <div class="h_content02">
        <div class="h_links01 sp-none">
          <a href="{{ url('/' . session('from_url') . '/') }}" title="ホーム">ホーム</a>　
          <a href="{{ url('/' . session('from_url') . '/service') }}" title="ご利用ルール">ご利用ルール</a>　
          <a href="{{ url('/' . session('from_url') . '/company') }}" title="会社概要">会社概要</a>　
          <a href="{{ url('/' . session('from_url') . '/privacy') }}" title="プライバシーポリシー">プライバシーポリシー</a>
        </div>
  
        <div class="h_links02 sp-none">
          <button class="js-open button-open" data-id="1">
            <div class="h_nav02">
              <p class="h_nav02_btn01">
              <span>簡単LINE申し込み</span>
              </p>
            </div>
          </button>
        </div>
      </div>
  
      <!-- ハンバーガーメニュー部分 -->
      <div class="nav pc-none">
      <!-- ハンバーガーメニューの表示・非表示を切り替えるチェックボックス -->
      <input id="drawer_input" class="drawer_hidden" type="checkbox">
      <!-- ハンバーガーアイコン -->
          <label for="drawer_input" class="drawer_open"><span></span></label>
      <!-- メニュー -->
      <nav class="nav_content">
            <ul class="nav_list">
              <li class="nav_item">- <a href="{{ url('/' . session('from_url') . '/') }}" title="HOME">HOME</a>
              <li class="nav_item">- <a href="{{ url('/' . session('from_url') . '/service') }}" title="ご利用ルール">ご利用ルール</a>
              <li class="nav_item">- <a href="{{ url('/' . session('from_url') . '/company') }}" title="会社概要">会社概要</a>
              <li class="nav_item">- <a href="{{ url('/' . session('from_url') . '/privacy') }}" title="プライバシーポリシー">プライバシーポリシー</a></li>
              <li class="nav_item">- <a href="{{ route('line.login', ['state' => session('from_url')]) }}" title="簡単LINE申込">簡単LINE申込</a></li>
            </ul>
      </nav>
      </div>
  
    </div>
  
  </div>
</header>



<main>
  @yield('content')
</main>


<div class="footer">
	<div class="footer_in">

		<div class="footer_in_left">
      <div class="f_navi sp-none">
        <a href="{{ url('/' . session('from_url') . '/') }}" title="HOME">HOME</a>　|　
        <a href="{{ url('/' . session('from_url') . '/service') }}" title="ご利用ルール">ご利用ルール</a>　|　
        <a href="{{ url('/' . session('from_url') . '/company') }}" title="会社概要">会社概要</a>　|　
        <a href="{{ url('/' . session('from_url') . '/privacy') }}" title="プライバシーポリシー">プライバシーポリシー</a>　|　
      </div>
			<div class="f_copy">
				<p class="copy sp-none">Copyright 買取シマエナガ. All rights reserved</p>
				<p class="copy pc-none">© 買取シマエナガ inc.</p>
			</div>
		</div>

	</div>
</div>



<!-- オーバーレイ -->
<div id="overlay" class="overlay"></div>
<!-- モーダルウィンドウ1 -->
<div class="modal-window" data-id="modal1">
  <h2><img src="{{ asset('/') }}images/h_logo.png" alt="Rich/買取シマエナガ"></h2>
  <h3><span>公式LINEは以下から<br class="pc-none">登録お願いします。</span></h3>
  <div class="modal_in_box">
    <a href="{{ route('line.login', ['state' => session('from_url')]) }}" target="_blank"><img src="{{ asset('/') }}images/line_btn.png" alt="友達追加ボタン"></a>
  </div>
  <p>お申し込み希望のお客様は公式LINEアカウントにご登録後メッセージをお送りください。</p>
  <p>ご利用方法や手続きにつきまして当店スタッフから改めてご連絡いたします。</p>
  <button class="js-close button-close">× 閉じる</button>
</div>






<!-- JS area  -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="{{ asset('/') }}js/jQuery.fastClick.js"></script>
<script src="{{ asset('/') }}js/main.js"></script>
@yield('javascript')

</body>
</html>