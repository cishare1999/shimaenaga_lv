@extends('layouts.app')

@section('title', '新規買取 確認')
@section('description', 'LINEで完結！高く売れるリサイクル！最短１０分買取！')
@section('Keywords', '買取シマエナガ,iphone,収入印紙,ギフト券,商品券,買取')

@section('content')


<section id="contact" class="">
  <h2>新規買取お申し込み　確認</h2>

  <div class="row">
    <div class="in_row box-pd80">
      <p style="margin-top:40px;">入力内容をご確認ください。</p>


        <table class="entry_tb">
          <tr>
            <th>買取方法</th>
            {{-- <td>@if($request->way === "後日郵送買取")後日郵送買取@endif ({{ $request->way }})</td> --}}
            <td>{{ $request->way }}</td>
          </tr>
          @if($request->way === "後日郵送買取")

          @else
          <tr><th>画像１</th>
            <td>
              <img src="{{ asset('/') }}{{ $files['read_temp1'] }}" style="max-height: 14rem;">
            </td>
          </tr>
          <tr><th>画像２</th>
            <td>
              @if($files['read_temp2'])
              <img src="{{ asset('/') }}{{ $files['read_temp2'] }}" style="max-height: 14rem;">
              @endif
            </td>
          </tr>
          <tr><th>画像３</th>
            <td>
              @if($files['read_temp3'])
              <img src="{{ asset('/') }}{{ $files['read_temp3'] }}" style="max-height: 14rem;">
              @endif
            </td>
          </tr>
          @endif
          <tr><th>商品</th>
            <td>
              @if($request->status_item == 21)
                全国百貨店共通商品券
              @elseif($request->status_item == 22)
                ギフト券
              @endif
            </td>
          </tr>
          {{-- <tr><th>商品名</th><td>{{ $request->item_name }}</td></tr>
          <tr><th>商品状態</th><td>{{ $request->condition }}</td></tr> --}}
          <tr><th>商品説明</th><td>{{ $request->comment }}</td></tr>
          <tr><th>希望金額</th><td>{{ $request->price }}</td></tr>
          
          @if( $request->way == '後日郵送買取' )
          @unless($request->workdata)
          <tr><th>勤務先名</th><td>{{ $request->work_name }}</td></tr>
          <tr><th>勤務先 電話番号</th><td>{{ $request->work_tel }}</td></tr>
          <tr><th>勤務先 住所</th>
            <td>
              〒{{ $request->work_zip }}<br>
              {{ $request->work_pref }}{{ $request->work_city }}{{ $request->work_address }}<br>
              {{ $request->work_building }}
            </td>
          </tr>
          <tr><th>月額給与額</th><td>{{ $request->salary }}</td></tr>
          <tr><th>給料日</th><td>{{ $request->payday }}</td></tr>
          @endunless
          @endif
        </table>
      
      {{ Aire::open()->route('mypage.new_complete') }}

      {{ Aire::hidden('temp1')->value($files['temp1']) }}
      {{ Aire::hidden('temp2')->value($files['temp2']) }}
      {{ Aire::hidden('temp3')->value($files['temp3']) }}
      {{-- @if($request->way == '後日郵送買取')
      {{ Aire::hidden('status_item')->value($request->status_item) }}
      @endif --}}
      {{ Aire::hidden('status_item')->value($request->status_item) }}
      @if($request->status_item == 21)
        {{ Aire::hidden('item_name')->value('全国百貨店共通商品券') }}
      @elseif($request->status_item == 22)
        {{ Aire::hidden('item_name')->value('ギフト券') }}
      @endif
      
      {{ Aire::hidden('way')->value($request->way) }}
      {{-- {{ Aire::hidden('item_name')->value($request->item_name) }} --}}
      {{-- {{ Aire::hidden('condition')->value($request->condition) }} --}}
      {{ Aire::hidden('condition')->value('新品') }}
      {{ Aire::hidden('comment')->value($request->comment) }}
      {{ Aire::hidden('price')->value($request->price) }}
      {{ Aire::hidden('work_name')->value($request->work_name) }}
      {{ Aire::hidden('work_tel')->value($request->work_tel) }}
      {{ Aire::hidden('work_zip')->value($request->work_zip) }}
      {{ Aire::hidden('work_pref')->value($request->work_pref) }}
      {{ Aire::hidden('work_city')->value($request->work_city) }}
      {{ Aire::hidden('work_address')->value($request->work_address) }}
      {{ Aire::hidden('work_building')->value($request->work_building) }}
      {{ Aire::hidden('salary')->value($request->salary) }}
      {{ Aire::hidden('payday')->value($request->payday) }}
      {{ Aire::hidden('workdata')->value($request->workdata) }}

      <div class="btn-wrap">
        <button type="button" class="contact-submit-prev" onclick="history.back()">戻る</button>
        <button type="submit" class="contact-submit">申し込む</button>  
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