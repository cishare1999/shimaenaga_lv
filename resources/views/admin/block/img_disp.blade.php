@section('img_disp')

<div class="card callout callout-line">
  <div class="card-header">
    <h3 class="card-title">LINE送信画像</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <div class="row">
      <ul class="line_img_list">
      @foreach($u_img as $img)
        <li>
        <a href="{{ url('/storage/lineimg') }}/{{ $img->text }}" data-toggle="lightbox" data-title="" data-gallery="gallery">
          <img src="{{ url('/storage/lineimg') }}/{{ $img->text }}" class="img-thumbnail">
        </a>
        </li>
      @endforeach
      </ul>
    </div>
  </div>
</div>


@endsection