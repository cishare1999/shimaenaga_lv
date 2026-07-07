{{-- @extends('layouts.app')

@section('title', '仮登録完了')
@section('description', 'LINEで完結！高く売れるリサイクル！最短１０分買取！')

@section('content')

@if(Session::get('from_url'))
  @if(Session::get('from_url')  == 'lp')
  <img src="https://s3.aspservice.jp/asp/track.php?p=645347eadc11a&t=645347ea" width="1" height="1" />
  @elseif(Session::get('from_url')  == 'lp2')
    <!-- <img src="https://s3.aspservice.jp/asp/track.php?p=5f6af5526d4d6&t=5f6af552" width="1" height="1" /> -->
  @endif
@endif

@if(Cookie::get('from_url')  == 'lp3')
  <!-- <img src="https://px.a8.net/a8fly/earnings?a8={{ Cookie::get('a8') }}&pid=s00000021582001&so={{ Session::get('uid') }}&si=1-1-1-a8&currency=JPY" width="1" height="1" /> -->
@endif

@if(Session::get('from_url'))
  @if(Session::get('from_url')  == 'lp4')
    <!-- <script src="https://www.cross-a.net/act/afrotk.js?adid=17933&rn=1&u1={{ Session::get('uid') }}"></script> -->
  @endif
@endif

<section id="contact" class="">
  <h2>仮登録完了</h2>
  <p style="text-align:center;padding-top:40px;">仮登録を完了し確認メールを送信しました。本登録を完了してください。 </p>
  <div class="row">
    <div class="in_row box-pd80">

    </div>
  </div>
</section>



@endsection

@section('css')

@endsection

@section('javascript')

@endsection --}}



<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title>404 Custom Error Page Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 
</head>
 
<body>
    <div class="container mt-5 pt-5">
        <div class="alert alert-danger text-center">
            <h2 class="display-3">404</h2>
            <p class="display-5">このページは削除されたか、存在しません。</p>
        </div>
    </div>
</body>
 
</html>