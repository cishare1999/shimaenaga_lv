@extends('layouts.app')

@section('title', '個人情報登録　完了')
@section('description', 'LINEで完結！高く売れるリサイクル！最短１０分買取！')
@section('Keywords', '買取シマエナガ,iphone,収入印紙,ギフト券,商品券,買取')

@section('content')




<section id="contact" class="">
  <h2>お客様情報登録</h2>

  <div class="row">
    <div class="in_row box-pd80">


    <p style="margin-top:40px;">
      ご登録ありがとうございます。<br>
      マイページから買取申込みへお進みください。<br>
      <br>
      <a href="{{ route('mypage.index') }}" class="contact-submit" style="margin-top:20px;">マイページへ</a>
    </p>

  </div>
</div>
</section>

@endsection

@section('css')

@endsection

@section('javascript')

@endsection