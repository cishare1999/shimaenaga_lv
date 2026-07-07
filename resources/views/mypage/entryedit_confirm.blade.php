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
        入力内容をご確認ください。
      </div>
      <div class="confirm-inner">
        <table class="confirm-table">
          <tr><th>お名前</th><td>{{ $request->name }}</td></tr>
          <tr><th>お名前（カナ）</th><td>{{ $request->kana }}</td></tr>
          <tr><th>メールアドレス</th><td>{{ $request->email }}</td></tr>
          <tr><th>携帯電話番号</th><td>{{ $request->mobile }}</td></tr>
          <tr><th>LINE ID</th><td>{{ $request->line }}</td></tr>
          <tr><th>ご連絡方法</th><td>{{ $request->contact }}</td></tr>
          <tr><th>住所</th>
            <td>
              〒{{ $request->zip }}<br>
              {{ $request->pref }}{{ $request->city }}{{ $request->address }}<br>
              {{ $request->building }}
            </td>
          </tr>
          <tr><th>銀行名</th><td>{{ $request->bank_name }}({{ $request->bank_code }})</td></tr>
          <tr><th>支店名</th><td>{{ $request->branch_name }}({{ $request->branch_code }})</td></tr>
          <tr><th>口座</th>
            <td>
              ({{ $request->bank_type }}){{ $request->bank_number }}<br>
              {{ $request->bank_kana }}
            </td>
          </tr>
          <tr><th>身分証（表）</th>
            <td>
              <img src="{{ asset('/') }}{{ $files['read_temp1'] }}" style="max-height: 14rem;">
            </td>
          </tr>
          <tr><th>身分証（裏）</th>
            <td>
              <img src="{{ asset('/') }}{{ $files['read_temp2'] }}" style="max-height: 14rem;">
            </td>
          </tr>
          <tr><th>身分証（セルフィー）</th>
            <td>
              <img src="{{ asset('/') }}{{ $files['read_temp3'] }}" style="max-height: 14rem;">
            </td>
          </tr>
        </table>
      </div>
      
      {{ Aire::open()->route('mypage.entryedit_complete') }}

      {{ Aire::hidden('name')->value($request->name) }}
      {{ Aire::hidden('kana')->value($request->kana) }}
      {{ Aire::hidden('email')->value($request->email) }}
      {{ Aire::hidden('mobile')->value($request->mobile) }}
      {{ Aire::hidden('line')->value($request->line) }}
      {{ Aire::hidden('contact')->value($request->contact) }}
      {{ Aire::hidden('zip')->value($request->zip) }}
      {{ Aire::hidden('pref')->value($request->pref) }}
      {{ Aire::hidden('city')->value($request->city) }}
      {{ Aire::hidden('address')->value($request->address) }}
      {{ Aire::hidden('building')->value($request->building) }}
      {{ Aire::hidden('bank_name')->value($request->bank_name) }}
      {{ Aire::hidden('bank_code')->value($request->bank_code) }}
      {{ Aire::hidden('branch_name')->value($request->branch_name) }}
      {{ Aire::hidden('branch_code')->value($request->branch_code) }}
      {{ Aire::hidden('bank_type')->value($request->bank_type) }}
      {{ Aire::hidden('bank_number')->value($request->bank_number) }}
      {{ Aire::hidden('bank_kana')->value($request->bank_kana) }}
      {{ Aire::hidden('temp1')->value($files['temp1']) }}
      {{ Aire::hidden('temp2')->value($files['temp2']) }}
      {{ Aire::hidden('temp3')->value($files['temp3']) }}

      <div class="btn-wrap">
        <button type="button" class="btn-back" onclick="history.back()">戻る</button>
        <button type="submit" class="btn-reg">登録</button>  
      </div>
      {{ Aire::close() }}

    </div>
  </div>
</div>





@endsection

@section('css')

@endsection

@section('javascript')

@endsection