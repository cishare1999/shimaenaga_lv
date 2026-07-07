@extends('layouts.app')

@section('title', 'マイページ')
@section('description', 'LINEで完結！高く売れるリサイクル！最短１０分買取！')
@section('Keywords', '買取シマエナガ,iphone,収入印紙,ギフト券,商品券,買取')

@section('content')


<section id="contact">
  <h2>マイページ</h2>

  <div class="row">
    <div class="in_row">


      <div class="mypage_wrap pd_top80">
        <div class="mypage_uname_wrap">
          <p>こんにちは　{{ $user->name }} さん</p>
        </div>
        <div class="mypage_new_pro_wrap">
          <div class="mypage_l">
            <p>
              新規お申込みから買取申請して下さい。
            </p>
            @if($check2 != "true")
            <a href="{{ route('mypage.new') }}" class="contact-submit center" style="max-width:100%;">新規お申込み</a>
            @endif
            <p style="color:crimson;">
            お急ぎの方はコチラよりご連絡ください。<br>
            【電話番号：{{config('app.tel_number')}}】
            </p>
          </div>
          <div class="mypage_r">
            <p>
              登録情報の確認・変更
            </p>
            <a href="{{ route('mypage.profile') }}" class="contact-submit-prev center" style="max-width:100%;">登録情報確認</a>
          </div>
        </div>
      </div>
      {{-- end mypage_wrap --}}



      <div class="mypage_wrap">
          <div class="mypage_history_wrap">
            <h3>お申し込み履歴</h3>

            {{-- 申込があれば --}}
            @if($items != "[]")
              <p>
                ※査定が終了した場合、査定額をご確認いただき、注意事項を読み最下部の「金額承認」ボタンを押してください。<br>
                査定中の場合はボタンは表示されません。
              </p>
              {{-- 申込データを展開 --}}
              @foreach($items as $item)
                <div class="mypage_history_list">
                  <div class="mypage_history_list_title">
                    <div class="t_01">
                      申込日時：{{ $item->created_at->format('Y/m/d') }}
                    </div>
                    <div class="t_02">
                      申込状態：
                      @if($item->status_total == 'ケリ' || $item->status_total == '詐欺') 
                      査定完了（買取不可）
                      @elseif($item->status_total == '保留')
                      査定中*
                      @else
                        {{ $item->status_total }}
                      @endif
                    </div>
                  </div>
                  <div class="mypage_history_list_data">
                    <table class="mypage_history_tb">
                      <tr>
                        <th>買取方法</th>
                        <td>{{ $item->way }}</td>
                        <th>商品名</th>
                        <td>{{ $item->item_name }}</td>
                      </tr>
                      <tr>
                        <th>ステータス</th>
                        <td>
                          @if($item->status_paid) 
                            <span>{{ $item->status_paid }}</span> 
                          @endif
                        </td>
                        <th>査定額</th>
                        <td>
                          @if( $item->judge_price > 0 )
                            <span>{{ number_format($item->judge_price) }}</span>円
                          @endif
                        </td>
                      </tr>
                      <tr>
                        <th>備考</th>
                        <td colspan="3">
                          @if( $item->for_user )
                            お知らせ：{!! nl2br($item->for_user) !!}
                          @endif
                        </td>
                      </tr>
                    </table>
                    

                    @if( $item->user_agree == '承認済' )
                      <div class="syounin">【承認済み】</div>
                    @else
                      @if($item->status_total == '査定完了（買取可）')
                        <p class="ok_cation">※下記の注意事項をお読みになり、「金額承認」ボタンを押してください。</p>
                      @endif

                      @if( $item->judge_price > 0 )
                        <div class="mypage_cation_wrap">
                          {!! config('attention') !!}
                        </div>
                        @unless($item->user_agree)
                          @if( $item->judge_price > 0 )
                            <form id="form{{ $item->id }}" method="post" action="{{ route('mypage.user_agree') }}">
                              @csrf
                              <input type="hidden" name="item_id" value="{{ $item->id }}">
                              <input type="hidden" id="doui" name="doui" value="">
                              <!-- <button id="agree_btn" class="btn" data-item="{{ $item->id }}"> -->
                              <button id="cation_btn" class="cation_btn" data-item="{{ $item->id }}">
                                金額承認
                              </button>
                            </form>
                          @endif
                        @endunless
                      @endif

                    @endif



                  </div>
                </div>
              @endforeach

            {{-- 申込無ければ --}}
            @else

              <p>
                お申込み情報はまだありません。  
              </p>

            @endif
            {{-- 申込終わり --}}

          </div>

          
      


    </div>
  </div>
</section>




@endsection

@section('css')

@endsection

@section('javascript')
<script type="text/javascript">
  $('#cation_btn').click(function(){
    if(confirm('査定金額を承認します。よろしいですか？')){
      return true;
    }else{
      return false;
      // var item = $(this).data('item');
      // var formid = '#form' + item;
      // $('form').submit();
    }
  }); 
  //  $('#agree_btn').click(function(){
  //   if(confirm('表示されている査定金額でお取引を進める場合は、必ず注意事項をお読みになった上でOKボタンを押してください。取引のキャンセルをご希望の方は、直接お問い合わせください。')){
  //     return true;
  //   }else{
  //     return false;
  //     // var item = $(this).data('item');
  //     // var formid = '#form' + item;
  //     // $('form').submit();
  //   }
  // }); 
  // $('#cation_btn').click(function(){
  //   var doui = $("#doui").val();
  //   console.log(doui);

  //   if(doui != 1){
  //     alert('注意事項をお読みになり同意ボタンを押した上で再度査定金額承認ボタンを押してください。')
  //     return false;
  //   }else{
  //     if(confirm('表示されている査定金額でお取引を進めます。取引のキャンセルをご希望の方は、直接お問い合わせください。')){
  //       return true;
  //     }else{
  //       return false;
  //     }
  //   }
  // });
</script>
<script type="text/javascript">
  // function disp(url){
  //   window.open(url, "attention", "width=400,height=800,scrollbars=yes");
  // }
</script>

@endsection
