@extends('layouts.app')

@section('title', '新規買取 完了')
@section('description', 'LINEで完結！高く売れるリサイクル！最短１０分買取！')
@section('Keywords', '買取シマエナガ,iphone,収入印紙,ギフト券,商品券,買取')
@section('content')


<section id="contact" class="">
  <h2>申し込み完了</h2>

  <div class="row">
    <div class="in_row box-pd80">
      <p style="margin-top:40px;"">この度は買取のお申込みありがとうございます。<br>
        査定結果につきましては追ってご連絡いたします。<br>
      </p>
      <br>
      <a href="{{ route('mypage.index') }}" class="contact-submit">マイページへ</a>


  </div>
</div>
</section>


@endsection

@section('css')

@endsection

@section('javascript')

@endsection