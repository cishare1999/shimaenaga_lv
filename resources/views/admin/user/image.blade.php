@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ユーザー画像変更</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">身分証画像</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="row">
          <div class="col-md-4">
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_1 }}" data-toggle="lightbox" data-title="身分証（表）" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_1 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
          </div>
          <div class="col-md-4">
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_2 }}" data-toggle="lightbox" data-title="身分証（裏）" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_2 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
          </div>
          <div class="col-md-4">
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_3 }}" data-toggle="lightbox" data-title="身分証（セルフィー）" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_3 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
          </div>
          <div class="col-md-4">
            @if(!empty($user->userData->licence_4))
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_4 }}" data-toggle="lightbox" data-title="公共料金の明細など" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_4 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
            @endif
          </div>
          <div class="col-md-4">
            @if(!empty($user->userData->licence_5))
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_5 }}" data-toggle="lightbox" data-title="公共料金の明細など" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_5 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
            @endif
          </div>
          <div class="col-md-4">
            @if(!empty($user->userData->licence_6))
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_6 }}" data-toggle="lightbox" data-title="公共料金の明細など" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_6 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
            @endif
          </div>
          <div class="col-md-4">
            @if(!empty($user->userData->licence_7))
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_7 }}" data-toggle="lightbox" data-title="公共料金の明細など" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_7 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
            @endif
          </div>
          <div class="col-md-4">
            @if(!empty($user->userData->licence_8))
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_8 }}" data-toggle="lightbox" data-title="公共料金の明細など" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_8 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
            @endif
          </div>
          <div class="col-md-4">
            @if(!empty($user->userData->licence_9))
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_9 }}" data-toggle="lightbox" data-title="公共料金の明細など" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_9 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
            @endif
          </div>
          <div class="col-md-4">
            @if(!empty($user->userData->licence_10))
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_10 }}" data-toggle="lightbox" data-title="公共料金の明細など" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_10 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
            @endif
          </div>



        </div>
      </div>
    </div>
  </div>
</div>
<form method="post" action="{{ route('admin.users.image', $user->id) }}" enctype="multipart/form-data">
@csrf
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">身分証画像 <small>※変更分のみ登録してください。</small></h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="customFile">身分証（表）</label>

              <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile1" name="files1">
                <label class="custom-file-label" for="customFile1">選択してください</label>
              </div>
            </div>

            <div class="form-group">
              <label for="customFile">身分証（裏）</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile2" name="files2">
                <label class="custom-file-label" for="customFile2">選択してください</label>
              </div>
            </div>

            <div class="form-group">
              <label for="customFile">身分証（セルフィー）</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile3" name="files3">
                <label class="custom-file-label" for="customFile3">選択してください</label>
              </div>
            </div>

            <div class="form-group">
              <label for="customFile">公共料金の明細など</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile4" name="files4">
                <label class="custom-file-label" for="customFile4">選択してください</label>
              </div>
            </div>
            <div class="form-group">
              <label for="customFile">公共料金の明細など</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile5" name="files5">
                <label class="custom-file-label" for="customFile5">選択してください</label>
              </div>
            </div>
            <div class="form-group">
              <label for="customFile">公共料金の明細など</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile6" name="files6">
                <label class="custom-file-label" for="customFile6">選択してください</label>
              </div>
            </div>
            <div class="form-group">
              <label for="customFile">公共料金の明細など</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile7" name="files7">
                <label class="custom-file-label" for="customFile7">選択してください</label>
              </div>
            </div>
            <div class="form-group">
              <label for="customFile">公共料金の明細など</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile8" name="files8">
                <label class="custom-file-label" for="customFile8">選択してください</label>
              </div>
            </div>
            <div class="form-group">
              <label for="customFile">公共料金の明細など</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile9" name="files9">
                <label class="custom-file-label" for="customFile9">選択してください</label>
              </div>
            </div>
            <div class="form-group">
              <label for="customFile">公共料金の明細など</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile10" name="files10">
                <label class="custom-file-label" for="customFile10">選択してください</label>
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


