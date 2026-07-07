@extends('layouts.app')

@section('title', '新規登録')
@section('description', 'LINEで完結！高く売れるリサイクル！最短１０分買取！')
@section('Keywords', '買取シマエナガ,iphone,収入印紙,ギフト券,商品券,買取')

@section('content')



<section id="contact" class="">
  <h2>新規お申し込み</h2>
  {{-- <div class="register_cation_box">
    「<span>このメールアドレスは既に使用されています。</span>」とエラーメッセージが出たお客様は、<br class="sp-none">
    入力したメールアドレスで<a href="{{ route('password.request') }}">こちら</a>よりパスワードを再発行していただき、会員ログインからお入り下さい。<br>
    ログイン後マイページよりご希望の商品を選択してください。
  </div> --}}
  <div class="row">
    <div class="in_row box-pd80">
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <table class="contact_tb" style="margin-bottom:40px;">
          <tr>
            <th>名前 <span>必須</span></th>
            <td>
              <input type="text" name="name" class="form-text" placeholder="漢字で入力してください。" value="{{ old('name') }}">
              @error('name')
                <p class="error_mes">{{ $message }}</p>
              @enderror
            </td>
          </tr>

          <tr>
            <th>メールアドレス <span>必須</span></th>
            <td>
              <input type="email" name="email" class="form-text" placeholder="半角英数字で入力してください。" value="{{ old('email') }}">
              @error('email')
                <p class="error_mes">{{ $message }}</p>
              @enderror
            </td>
          </tr>
          <tr>
            <th>携帯電話番号 <span>必須</span></th>
            <td>
              <input type="tel" name="mobile" class="form-text" placeholder="半角英数字で入力してください。" value="{{ old('mobile') }}">
              @error('mobile')
                <p class="error_mes">{{ $message }}</p>
              @enderror
            </td>
          </tr>

          <tr>
            <th>生年月日 <span>必須</span></th>
            <td>
              <div class="birthday_box">

            <select class="form-select-100" name="birthday_year" required>
              <option value="">年</option>
                @foreach(config('date_year') as $key => $val)
                    <option value="{{ $val }}" @if($val == old('birthday_year')) selected="" @endif>{{ $val }}</option>
                @endforeach
            </select>
            <select class="form-select-100" name="birthday_month" required>
              <option value="">月</option>
                @foreach(config('date_month') as $key => $val)
                    <option value="{{ $val }}" @if($val == old('birthday_month')) selected="" @endif>{{ $val }}</option>
                @endforeach
            </select>
            <select class="form-select-100" name="birthday_day" required>
              <option value="">日</option>
                @foreach(config('date_day') as $key => $val)
                    <option value="{{ $val }}" @if($val == old('birthday_day')) selected="" @endif>{{ $val }}</option>
                @endforeach
            </select>
              {{-- <input type="date" name="birthday" class="form-text" placeholder="カレンダーから選択してください。" value="{{ old('birthday') }}"> --}}

            </div>
            @error('birthday_year')
              <p class="error_mes">{{ $message }}</p>
            @enderror
            @error('birthday_month')
              <p class="error_mes">{{ $message }}</p>
            @enderror
            @error('birthday_day')
              <p class="error_mes">{{ $message }}</p>
            @enderror

            </td>
          </tr>


          <tr>
            <th>パスワード <span>必須</span></th>
            <td>
              <input type="password" name="password" class="form-text" placeholder="半角英数字8文字以上">
              @error('password')
                <p class="error_mes">{{ $message }}</p>
              @enderror
            </td>
          </tr>
          <tr>
            <th>パスワード(確認) <span>必須</span></th>
            <td>
              <input type="password" name="password_confirmation" class="form-text" placeholder="半角英数字8文字以上">
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <div class="formPolicy">
                {!! config('privacy') !!}
              </div>
              <div class="termsCheck">
                <label>
                  <input type="checkbox" id="box-1" name="terms">
                  <span>プライバシーポリシーに同意する</span>
                </label>
              </div>
              @error('terms')
              <p class="error_mes">{{ $message }}</p>
              @enderror
            </td>
          </tr>
        </table>


        @if(Session::get('from_url'))
          <input type="hidden" name="from_url" value="{{ Session::get('from_url') }}">
        @elseif(Cookie::get('from_url')  == 'lp3')
          <input type="hidden" name="from_url" value="{{ Cookie::get('from_url') }}">
          <input type="hidden" name="a8code" value="{{ Cookie::get('a8') }}">
        @else
        <input type="hidden" name="from_url" value="">
        @endif


        <input class="contact-submit" type="submit" value="登録">
      </form>


    </div>
  </div>
</section>


@endsection
