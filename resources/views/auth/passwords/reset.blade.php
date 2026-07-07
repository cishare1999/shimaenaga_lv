{{-- @extends('layouts.app')

@section('title', 'パスワードリセット')

@section('description', '')

@section('content')

<section id="contact">
  <h2>パスワードリセット</h2>

  <div class="row">
    <div class="in_row box-pd80">
      
      <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">


        <table class="contact_tb">
          <tr>
            <th>メールアドレス</th>
            <td>
              <input id="email" type="text" placeholder="" class="form-text @error('email') is-danger @enderror" name="email" value="{{ $email ?? old('email') }}" required>
              @error('email')
              <p class="error_mes">{{ $message }}</p>
              @enderror
            </td>
          </tr>
          <tr>
            <th>新しいパスワード</th>
            <td>
              <input id="password" type="password" placeholder="" class="form-text @error('password') is-danger @enderror" name="password" required>
              @error('password')
              <p class="error_mes">{{ $message }}</p>
              @enderror
            </td>
          </tr>
          <tr>
            <th>新しいパスワード（確認）</th>
            <td>
              <input id="password-confirm" type="password" placeholder="" class="form-text" name="password_confirmation" required>
            </td>
          </tr>
        </table>
        @if (session('status'))
        <p class="error_mes">{{ session('status') }}</p>
        @endif
        <button type="submit" class="contact-submit">パスワード変更</button>
      </form>
      
    </div>
  </div>
  </section>



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