@extends('layouts.app')

@section('title', '個人情報登録 確認')
@section('description', 'LINEで完結！高く売れるリサイクル！最短１０分買取！')
@section('Keywords', '買取シマエナガ,iphone,収入印紙,ギフト券,商品券,買取')

@section('content')

<section id="contact" class="">
  <h2>お客様情報登録</h2>

  <div class="row">
    <div class="in_row box-wrap03">
      <p>入力内容をご確認ください。<br>登録後の情報変更はLINEにてご連絡下さい。</p>
      <table class="contact_tb2">
        <tr><th>お名前/カナ</th><td>{{ $request->name }}/{{ $request->kana }}</td></tr>
        <tr><th>携帯電話番号</th><td>{{ $request->mobile }}</td></tr>
        <tr><th>メールアドレス</th><td>{{ $request->email }}</td></tr>
        <tr><th>生年月日</th><td>{{ $request->birthday }}</td></tr>
        <tr><th>性別</th><td>{{ $request->gender }}</td></tr>
        <tr><th>LINE ID</th><td>{{ $request->line }}</td></tr>
        <tr><th>ご連絡方法</th><td>{{ $request->contact }}</td></tr>

        <tr><th>住所</th>
          <td>
            〒{{ $request->zip }}<br>
            {{ $request->pref }}{{ $request->city }}{{ $request->address }}<br>
            {{ $request->building }}
          </td>
        </tr>
        <tr><th>銀行名</th><td>{{ $request->bank_name }}</td></tr>
        <tr><th>支店名</th><td>{{ $request->branch_name }}({{ $request->branch_code }})</td></tr>
        <tr><th>口座</th>
          <td>
            ({{ $request->bank_type }}){{ $request->bank_number }}<br>
            {{ $request->bank_kana }}
          </td>
        </tr>
      </table>
      <table class="entry_tb2">
        <tr>
          <td>身分証（表）<br>
            <img src="{{ asset('/') }}{{ $files['read_temp1'] }}" style="max-height: 14rem;">
          </td>
          <td>身分証（裏）<br>
            <img src="{{ asset('/') }}{{ $files['read_temp2'] }}" style="max-height: 14rem;">
          </td>
        </tr>
        <tr>
          <td>身分証（自撮り）<br>
            <img src="{{ asset('/') }}{{ $files['read_temp3'] }}" style="max-height: 14rem;">
          </td>
          <td>ご住所確認書類1<br>
            @if(!empty($files['read_temp4']))
            <img src="{{ asset('/') }}{{ $files['read_temp4'] }}" style="max-height: 14rem;">
            @endif
          </td>
        </tr>
        <tr>
          <td>ご住所確認書類2<br>
            @if(!empty($files['read_temp5']))
            <img src="{{ asset('/') }}{{ $files['read_temp5'] }}" style="max-height: 14rem;">
            @endif
          </td>
          <td>ご住所確認書類3<br>
            @if(!empty($files['read_temp6']))
            <img src="{{ asset('/') }}{{ $files['read_temp6'] }}" style="max-height: 14rem;">
            @endif
          </td>
        </tr>
        <tr>
          <td>ご住所確認書類4<br>
            @if(!empty($files['read_temp7']))
            <img src="{{ asset('/') }}{{ $files['read_temp7'] }}" style="max-height: 14rem;">
            @endif
          </td>
          <td>ご住所確認書類5<br>
            @if(!empty($files['read_temp8']))
            <img src="{{ asset('/') }}{{ $files['read_temp8'] }}" style="max-height: 14rem;">
            @endif
          </td>
        </tr>
        <tr>
          <td>ご住所確認書類6<br>
            @if(!empty($files['read_temp9']))
            <img src="{{ asset('/') }}{{ $files['read_temp9'] }}" style="max-height: 14rem;">
            @endif
          </td>
          <td>ご住所確認書類7<br>
            @if(!empty($files['read_temp10']))
            <img src="{{ asset('/') }}{{ $files['read_temp10'] }}" style="max-height: 14rem;">
            @endif
          </td>
        </tr>

      </table>
    
    {{ Aire::open()->route('mypage.entry_complete') }}

    {{ Aire::hidden('name')->value($request->name) }}
    {{ Aire::hidden('kana')->value($request->kana) }}
    {{ Aire::hidden('email')->value($request->email) }}
    {{ Aire::hidden('mobile')->value($request->mobile) }}
    {{ Aire::hidden('line')->value($request->line) }}
    {{ Aire::hidden('birthday')->value($request->birthday) }}
    {{ Aire::hidden('gender')->value($request->gender) }}
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
    @if(!empty($files['read_temp4']))
    {{ Aire::hidden('temp4')->value($files['temp4']) }}
    @endif
    @if(!empty($files['read_temp5']))
    {{ Aire::hidden('temp5')->value($files['temp5']) }}
    @endif
    @if(!empty($files['read_temp6']))
    {{ Aire::hidden('temp6')->value($files['temp6']) }}
    @endif
    @if(!empty($files['read_temp7']))
    {{ Aire::hidden('temp7')->value($files['temp7']) }}
    @endif
    @if(!empty($files['read_temp8']))
    {{ Aire::hidden('temp8')->value($files['temp8']) }}
    @endif
    @if(!empty($files['read_temp9']))
    {{ Aire::hidden('temp9')->value($files['temp9']) }}
    @endif
    @if(!empty($files['read_temp10']))
    {{ Aire::hidden('temp10')->value($files['temp10']) }}
    @endif

    <div class="btn-wrap">
      <button type="button" class="contact-submit-prev" onclick="history.back()">戻る</button>
      <button type="submit" class="contact-submit" style="color:#fff;">登録</button>  
    </div>
    {{ Aire::close() }}

  </div>
</div>
</section>



@endsection

@section('css')

@endsection

@section('javascript')

@endsection