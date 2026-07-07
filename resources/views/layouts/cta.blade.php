@section('cta')

  <div class="row cta">
    <div class="in_row cta_in">
      <div class="cta_red wow fadeInDown" data-wow-duration="1.5s">
        <div>
          <h3>あなたのアイテムが現金にかわる！<br>まずはWEBから会員登録</h3>
          <a href="{{ route('register') }}" class="cta_btn01">新規会員登録</a>
        </div>
        <img src="{{ asset('/') }}images/cta_img01.png" alt="アイテムが現金に">
      </div>
      <div class="cta_green wow fadeInUp" data-wow-duration="1.5s">
        <div>
          <h3>すぐに現金化！<br>買取対象アイテムはなんでもOK！<br>キャンセルOK！</h3>
          <a href="{{ route('service') }}" class="cta_btn02">ご利用ガイドはこちら</a>
        </div>
        <img src="{{ asset('/') }}images/cta_img02.png" alt="ご利用ガイド">
      </div>

    </div>
  </div>

  @endsection