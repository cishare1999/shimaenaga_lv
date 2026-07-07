@section('chat')

<div class="card callout callout-line" style="height:98%;">
  <div class="card-header">
    <h3 class="card-title">LINEメッセージ閲覧</h3>
  </div>
  <div class="card-body p-0">


    <!-- ▼LINE風ここから -->
    <div class="line__container">
      <!-- タイトル -->
      {{-- <div class="line__title">
        {{$user->display_name}}
      </div> --}}

      <!-- ▼会話エリア scrollを外すと高さ固定解除 -->
      <div class="line__contents" id="scin">

        @if($chatmsg)
          @foreach($chatmsg as $cm)
            @if($cm->send_type == "受信")
              <!-- 相手の吹き出し -->
              <div class="line__left">
                <figure>
                  <img src="{{ url('/storage/linepic') }}/{{ $user->userData->licence_1 }}" />
                </figure>
                <div class="line__left-text">
                  <div class="name">{{ Functions::dateYmdHi($cm->created_at) }}</div>
                  <div class="text">{!! nl2br($cm->text) !!}</div>
                </div>
              </div>
            @elseif ($cm->send_type == "送信")
              <!-- 自分の吹き出し -->
              <div class="line__right">
                <div class="text">{!! nl2br($cm->text) !!}</div>
                <span class="date">{{ Functions::dateYmdHi($cm->created_at) }}</span>
              </div>
            @elseif ($cm->send_type == "自動返信")
              <!-- 自分の吹き出し -->
              <div class="line__right">
                <div class="text">{{$cm->text}}</div>
                <span class="date">{{ Functions::dateYmdHi($cm->created_at) }}</span>
              </div>
            @elseif ($cm->send_type == "画像")
              <!-- 相手の画像 -->
              <div class="line__left">
                <div class="stamp"><img src="{{ url('/storage/lineimg') }}/{{ $cm->text }}" /></div>
              </div>
            @elseif ($cm->send_type == "スタンプ")
              <!-- 相手の吹き出し -->
              <div class="line__left">
                <figure>
                  <img src="{{ url('/storage/linepic') }}/{{ $user->userData->licence_1 }}" />
                </figure>
                <div class="line__left-text">
                  <div class="name">{{ Functions::dateYmdHi($cm->created_at) }}</div>
                  <div class="text">スタンプ送信</div>
                </div>
              </div>
            @endif
          @endforeach
        @else
          <div style="text-align:center;margin:20px auto;">
            まだメッセージはありません。
          </div>
        @endif


      </div>
      <!--　▲会話エリア ここまで -->
    </div>
    <!--　▲LINE風ここまで -->


  </div>

</div>
@endsection