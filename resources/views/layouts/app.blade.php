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
  <link rel="canonical" href="{{ config('app.domain_url') }}/lp_jo/">
  @endif

<link rel="stylesheet" media="screen and (min-width:1100px)" type="text/css" href="{{ asset('/') }}css/pc.css" />
<link rel="stylesheet" media="screen and (max-width:1099px)" type="text/css" href="{{ asset('/') }}css/sp.css" />
<link rel="stylesheet" media="all" type="text/css" href="{{ asset('/') }}css/modal.css" />


  @if (request()->segment(1) === 'lp3')
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-5X3C43ZS');</script>
  <!-- End Google Tag Manager -->
  @endif

<style>
.alert {
    padding: 15px;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 20px;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}  
</style>

  @yield('css')

</head>
<body class="fade">
<!--[if lte IE 10]>
<p class="brs_chk">現在ご使用のブラウザではこのサイトが正しく表示されない可能性があります。最新版のブラウザをご使用ください。</p>
<![endif]-->


@if (request()->segment(1) === 'lp3')
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5X3C43ZS"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
@endif



@if (Request::is('/') || Request::is('lp_jo') || Request::is('lp2seo') || Request::is('lp2afi') || Request::is('lp2lis') || Request::is('lp3')  || Request::is('lp2seo1') || Request::is('lp2seo2') || Request::is('lp2seo3') || Request::is('lp2seo4') || Request::is('lp2seo5') || Request::is('lp2seo6')  || Request::is('lp2lis2')  || Request::is('lp2lis3') )
<header id="header" class="header">
@else
<header id="header" class="header_low">
@endif

<div class="header_in">

	<div class="header_top">
		<div class="h_logo">
			<a href="{{ url(session('from_url') ? '/' . session('from_url') . '/' : '/') }}"><img src="{{ asset('/') }}images/h_logo.png" alt="買取シマエナガ"></a>
		</div>

		<div class="h_content02">
			<div class="h_links02 sp-none">
				<button class="js-open button-open" data-id="1">
					<div>
						<img src="{{ asset('/') }}images/h_links_btn.png" alt="LINE簡単申込み">
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
            <li class="nav_item"><a href="{{ url(session('from_url') ? '/' . session('from_url') . '/' : '/') }}" title="HOME">HOME</a></li>
            <li class="nav_item"><a href="{{ url(session('from_url') ? '/' . session('from_url') . '/service' : '/service') }}" title="ご利用ルール">ご利用ルール</a></li>
            <li class="nav_item"><a href="{{ url(session('from_url') ? '/' . session('from_url') . '/company' : '/company') }}" title="会社概要">会社概要</a></li>
            <li class="nav_item"><a href="{{ url(session('from_url') ? '/' . session('from_url') . '/privacy' : '/privacy') }}" title="個人情報取扱">個人情報取扱</a></li>
          </ul>
		  <div class="h_content02">
			<div class="h_links02">
				<button class="js-open button-open" data-id="1">
					<div>
						<img src="{{ asset('/') }}images/btn_cv.png" alt="LINE簡単申込み">
					</div>
				</button>
			</div>
		  </div>
		</nav>
		</div>

	</div>

  @if (Request::is('/') || Request::is('lp_jo') || Request::is('lp2seo') || Request::is('lp2afi') || Request::is('lp2lis') || Request::is('lp3') || Request::is('lp2seo1') || Request::is('lp2seo2') || Request::is('lp2seo3') || Request::is('lp2seo4') || Request::is('lp2seo5') || Request::is('lp2seo6') || Request::is('lp2lis2')  || Request::is('lp2lis3') )
	<div class="s-fade-wrap sp-none">
		<div class="mv_view">
			<div class="mv_view-01 animate fade-in-from-bottom">
				<img src="{{ asset('/') }}images/mv_view01.png" alt="LINEで完結。高く売れるリサイクル">
			</div>
		</div>
	</div>
  @endif

</div>
</header>




  @yield('content')




<div class="footer">
	<div class="footer_in">

        <div class="f_navi sp-none">
            <div class="f_logo">
                <a href="{{ url(session('from_url') ? '/' . session('from_url') . '/' : '/') }}"><img src="{{ asset('/') }}images/h_logo.png" alt="買取シマエナガ"></a>
            </div>
            <div class="f_c_navi">
                <a href="{{ url(session('from_url') ? '/' . session('from_url') . '/' : '/') }}" title="ホーム">ホーム</a>　<a href="{{ url(session('from_url') ? '/' . session('from_url') . '/service' : '/service') }}" title="ご利用ルール">ご利用ルール</a>　<a href="{{ url(session('from_url') ? '/' . session('from_url') . '/company' : '/company') }}" title="会社概要">会社概要</a>　<a href="{{ url(session('from_url') ? '/' . session('from_url') . '/privacy' : '/privacy') }}" title="個人情報取扱">個人情報取扱</a>
            </div>
        </div>
	</div>
    <div class="f_copy">
        <p class="copy sp-none">Copyright 買取シマエナガ. All rights reserved</p>
        <p class="copy pc-none">© 買取シマエナガ inc.</p>
    </div>
</div>

<div id="pageTop">
	<a href="#"><img src="{{ asset('/') }}images/pagetop_btn.png" alt="pagetop"></a>
</div>


<!-- オーバーレイ -->
  <div id="overlay" class="overlay"></div>
<!-- モーダルウィンドウ1 -->
  <div class="modal-window" data-id="modal1">
    <h2><img src="{{ asset('/') }}images/h_logo.png" alt="買取シマエナガ"></h2>
    <p>お申し込み希望のお客様は下記の公式LINEアカウントに<br class="sp-none">ご登録後メッセージをお送りください。</p>
    <p>ご利用方法や手続きにつきまして当店スタッフから改めてご連絡いたします。</p>
    <h3><span>- 公式LINEから簡単申込み -</span></h3>
    <div class="modal_in_box">
        <a href="{{ route('line.login', ['state' => session('from_url')]) }}" target="_blank"><img src="{{ asset('/') }}images/line_btn.png" alt="友達追加ボタン"></a>
    </div>
    <button class="js-close button-close">× 閉じる</button>
    <div class="modal_middle01"><img src="{{ asset('/') }}images/t_two_middle01.png" alt=""></div>
    <div class="modal_middle02"><img src="{{ asset('/') }}images/t_two_middle02.png" alt=""></div>
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ asset('/') }}js/jQuery.fastClick.js"></script>
<script src="{{ asset('/') }}js/main.js"></script>

</body>
</html>