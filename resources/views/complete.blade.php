@extends('layouts.app')

@section('title', 'お問合せ 完了')
@section('description', 'LINEで完結！高く売れるリサイクル！最短１０分買取！')
@section('Keywords', '買取シマエナガ,iphone,収入印紙,ギフト券,商品券,買取')
@section('content')

@if (session()->has('register_message'))
<p>
  {{ session()->get('register_message') }}
</p>
@endif

<section id="contact" class="">
  <h2>お問合せ　完了</h2>
  <p style="text-align:center;"> お問い合わせを受け付けました。 </p>
  <div class="row">
    <div class="in_row box-pd80">

      <a href="{{ route('top') }}" class="contact-submit" style="margin-top:20px;">
        TOPページへ
      </a>
    </div>
  </div>
</section>

@endsection

@section('css')

@endsection

@section('javascript')

@endsection