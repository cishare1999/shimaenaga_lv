@extends('layouts.app')

@section('title', '登録情報確認')
@section('description', 'LINEで完結！高く売れるリサイクル！最短１０分買取！')
@section('Keywords', '買取シマエナガ,iphone,収入印紙,ギフト券,商品券,買取')
@section('content')

<section id="contact" class="">
  <h2>お客様情報確認</h2>

  <div class="row">
    <div class="in_row" style="padding-top:40px;">
    


      <table class="entry_tb">
        <tr><th>お名前/カナ</th><td>{{ $auth->name }}/{{ $auth->userData->kana }}</td></tr>
        <tr><th>メールアドレス</th><td>{{ $auth->email }}</td></tr>
        <tr><th>携帯電話番号</th><td>{{ $auth->mobile }}</td></tr>
        <tr><th>生年月日</th><td>{{ $auth->userData->birthday }}</td></tr>
        <tr><th>性別</th><td>{{ $auth->userData->gender }}</td></tr>
        <tr><th>LINE ID</th><td>{{ $auth->userData->line }}</td></tr>
        <tr><th>ご連絡方法</th><td>{{ $auth->userData->contact }}</td></tr>
        <tr><th>住所</th>
          <td>
            〒{{ $auth->userData->zip }}<br>
            {{ $auth->userData->pref }}{{ $auth->userData->city }}{{ $auth->userData->address }}<br>
            {{ $auth->userData->building }}
          </td>
        </tr>

        <tr><th>銀行名</th><td>{{ $auth->userData->bank_name }}</td></tr>
        <tr><th>支店名</th><td>{{ $auth->userData->branch_name }}({{ $auth->userData->branch_code }})</td></tr>
        <tr><th>口座</th>
          <td>
            ({{ $auth->userData->bank_type }}){{ $auth->userData->bank_number }}<br>
            {{ $auth->userData->bank_kana }}
          </td>
        </tr>
        <tr><th>勤務先名</th><td>{{ $auth->userData->work_name }}</td></tr>
        <tr><th>勤務先 電話番号</th><td>{{ $auth->userData->work_tel }}</td></tr>
        <tr><th>勤務先 住所</th>
          <td>
            〒{{ $auth->userData->work_zip }}<br>
            {{ $auth->userData->work_pref }}{{ $auth->userData->work_city }}{{ $auth->userData->work_address }}<br>
            {{ $auth->userData->work_building }}
          </td>
        </tr>
        <tr><th>月額給与額</th><td>{{ $auth->userData->salary }}</td></tr>
        <tr><th>給料日</th><td>{{ $auth->userData->payday }}</td></tr>
      </table>
      <p>
        登録内容の変更はLINEにてご連絡ください。
        <a style="margin:10px auto;" href="{{config('app.com_line')}}" class="contact-submit-prev" target="_blank">LINEを開く</a>
      </p>

    <div class="btn-wrap">
      <a href="{{ route('mypage.index') }}" class="contact-submit">マイページへ戻る</a>
    </div>

  </div>
</div>
</section>


@endsection

@section('css')

@endsection

@section('javascript')

@endsection