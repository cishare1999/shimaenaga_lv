@extends('layouts.app')

@section('title', 'お問合せ 確認')
@section('description', 'LINEで完結！高く売れるリサイクル！最短１０分買取！')
@section('Keywords', '買取シマエナガ,iphone,収入印紙,ギフト券,商品券,買取')

@section('content')

@if (session()->has('register_message'))
<p>
  {{ session()->get('register_message') }}
</p>
@endif


<section id="contact" class="">
  <h2>お問合せ　確認</h2>
  <p style="text-align:center;"> 入力内容を確認し、送信してください。 </p>

  <div class="row">
    <div class="in_row box-pd80">
      <table class="contact_tb2">
        <tr>
          <th>名前</th>
          <td>{{ $data['name'] }}</td>
        </tr>
        <tr>
          <th>メールアドレス</th>
          <td>{{ $data['email'] }}</td>
        </tr>
        <tr>
          <th>電話番号</th>
          <td>{{ $data['tel'] }}</td>
        </tr>
        <tr>
          <th>タイトル</th>
          <td>{{ $data['title'] }}</td>
        </tr>
        <tr>
          <th>お問い合わせ内容</th>
          <td>{!! nl2br($data['comment']) !!}</td>
        </tr>
      </table>

      <form method="post" action="{{ route('contact_complete') }}">
        @csrf
        <input type="hidden" name="name" value="{{ $data['name'] }}">
        <input type="hidden" name="email" value="{{ $data['email'] }}">
        <input type="hidden" name="tel" value="{{ $data['tel'] }}">
        <input type="hidden" name="title" value="{{ $data['title'] }}">
        <input type="hidden" name="comment" value="{{ $data['comment'] }}">
        <button class="contact-submit font-normal text-center whitespace-no-wrap align-middle select-none border leading-normal Form-Btn inline-block text-base rounded p-2 px-4 text-white bg-blue-600 border-blue-700 hover:bg-blue-700 hover:border-blue-900" data-aire-component="button" type="submit">送信</button>
      </form>


    </div>
  </div>
</section>


@endsection

@section('css')

@endsection

@section('javascript')

@endsection