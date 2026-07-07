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
        ご登録ありがとうございます。<br>
        マイページから買取申込みへお進みください。<br>
        <br>
        <a href="{{ route('mypage.index') }}">マイページへ</a>
      </div>
    </div>
  </div>
</div>





@endsection

@section('css')

@endsection

@section('javascript')

@endsection