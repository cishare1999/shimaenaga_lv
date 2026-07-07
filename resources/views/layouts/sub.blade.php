<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Style-type" content="text/css; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <title>@yield('title')｜{{ config('app.name', '買取シマエナガ') }}</title>
  <meta name="description" content="@yield('description')">
  <meta name="Keywords" content="@yield('Keywords')">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <link rel="icon" href="{{ asset('/') }}images/favicon.ico">
  <link rel="stylesheet" href="{{ asset('/') }}css2/style.css" media="all">
  <link rel="stylesheet" href="{{ asset('/') }}css2/sp.css" media="screen and (max-width:480px)">
  <link rel="stylesheet" href="{{ asset('/') }}css2/add.css" media="all">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

  <!-- アニメーション用 -->
  <link href="{{ asset('/') }}css2/animate.css" rel="stylesheet" media="all">
  <link href="{{ asset('/') }}css2/animations.css" rel="stylesheet" media="all">
  @yield('css')

  <!-- [if lt IE 9]>
  <script src="http://html5shim.googlecode/svn/trunk/html5.js"></script>
  <![end if]-->
</head>
<body>

<header id="header_pc" class="header_main">
  <div class="row head_in">
    <a href=""><h1>SPEED GIFT</h1></a>
    <div class="head_login">
    @guest
      <a href="{{ route('register') }}" class="login_btn"><i class="far fa-envelope"></i> お申込み</a>
    @else
      <a href="{{ route('mypage.index') }}" class="login_btn"><i class="far fa-envelope"></i> マイページ</a>
    @endguest

      
    </div>
  </div>
</header>
<!-- //header end -->

  <main>
    @yield('content')
  </main>
  <footer>
  <h5 style="text-align:center;">Copyright (c)　2022 買取シマエナガ　<br class="pc-none">All rights reserved.</h5>
  </footer>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@yield('javascript')

</body>
</html>
