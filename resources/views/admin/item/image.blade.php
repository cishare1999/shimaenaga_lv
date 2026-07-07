@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>商品画像変更</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">商品画像</h3>
        
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            @if($item->item_image1)
            <a href="{{ asset('/storage/image') }}/{{ $item->item_image1 }}" data-toggle="lightbox" data-title="商品画像1" data-gallery="gallery">
              <img src="{{ asset('/storage/image') }}/{{ $item->item_image1 }}" class="img-thumbnail">
            </a>
            @else
              <img src="{{ asset('/') }}/img/noimg.png" class="img-thumbnail">
            @endif
          </div>
          <div class="col-md-4">
            @if($item->item_image2)
            <a href="{{ asset('/storage/image') }}/{{ $item->item_image2 }}" data-toggle="lightbox" data-title="商品画像2" data-gallery="gallery">
              <img src="{{ asset('/storage/image') }}/{{ $item->item_image2 }}" class="img-thumbnail">
            </a>
            @else
              <img src="{{ asset('/') }}/img/noimg.png" class="img-thumbnail">
            @endif
          </div>
          <div class="col-md-4">
            @if($item->item_image3)
            <a href="{{ asset('/storage/image') }}/{{ $item->item_image3 }}" data-toggle="lightbox" data-title="商品画像3" data-gallery="gallery">
              <img src="{{ asset('/storage/image') }}/{{ $item->item_image3 }}" class="img-thumbnail">
            </a>
            @else
              <img src="{{ asset('/') }}/img/noimg.png" class="img-thumbnail">
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<form method="post" action="{{ route('admin.items.image', $item->id) }}" enctype="multipart/form-data">
@csrf
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">商品画像 <small>※変更分のみ登録してください。</small></h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="customFile">商品画像1</label>

              <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile1" name="files1">
                <label class="custom-file-label" for="customFile1">選択してください</label>
              </div>
            </div>

            <div class="form-group">
              <label for="customFile">商品画像2</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile2" name="files2">
                <label class="custom-file-label" for="customFile2">選択してください</label>
              </div>
            </div>

            <div class="form-group">
              <label for="customFile">商品画像3</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile3" name="files3">
                <label class="custom-file-label" for="customFile3">選択してください</label>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <input type="hidden" name="item" value="{{ $request->item }}">
        <input type="submit" name="" class="btn btn-primary" value="変更">
      </div>
    </div>
  </div>
</div>
</form>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ==" crossorigin="anonymous" />
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js" integrity="sha512-Y2IiVZeaBwXG1wSV7f13plqlmFOx8MdjuHyYFVoYzhyRr3nH/NMDjTBSswijzADdNzMyWNetbLMfOpIPl6Cv9g==" crossorigin="anonymous"></script>
<script type="text/javascript">
  
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });
  })
</script>

<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script>
  bsCustomFileInput.init();
</script>
@stop


