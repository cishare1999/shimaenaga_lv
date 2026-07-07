@extends('layouts.app')

@section('title', 'メールアドレス認証')

@section('description', '')

@section('content')


<section id="privacy">
  <h2>メールアドレス認証</h2>
  <p style="text-align:center;">メールアドレス認証が完了していないため、本登録が完了していません。<br>
    ご登録のメールアドレスをご確認いただき、メールアドレス認証を完了してください。<br>
    もし確認メールが届いていない場合は、以下をクリックして再送してください。 </p>
    <div class="row">
      <div class="in_row box-pd80">


        <form method="POST" action="{{ route('verification.resend') }}">
        @csrf
          <button type="submit" class="contact-submit">
            メールアドレス認証リンクを再送
          </button>
        </form>
        @if (session('resent'))
        <p class="error_mes">
          メールアドレス認証用リンクを再送しました。
        </p>
        @endif
  </div>
</div>
</section>



@endsection
