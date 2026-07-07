@extends('adminlte::page')

@section('title', '高額商品画像')

@section('content_header')
  <h1>高額商品画像</h1>
@stop

@section('content')


<div class="row">
  <div class="col-md-12">
    @if (session('message'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      {{ session('message') }}
    </div>
    @endif
  </div>
</div>

<div class="row">

  <div class="col-md-6">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">画像</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        
        @foreach( $list as $item)

        <div class="row" style="margin-bottom: 2rem;">
          <div class="col-md-8">
            <label>商品画像{{ $item->id }}</label><br>
            <img src="{{ asset('/storage/eximage') }}/{{ $item->eximage_name }}">
          </div>
          <div class="col-md-4">
            <form  method="post" action="{{ route('admin.eximage.index') }}/delete">
              @csrf
              <input type="hidden" name="id" value="{{ $item->id }}">
              <input type="submit" name="" value="削除" class="btn btn-danger btn-sm">
            </form>
          </div>
        </div>

        @endforeach
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <div class="col-md-6">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">画像変更 ※変更分のみ登録してください</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <p>画像のサイズは全て統一してください。（180px以上の正方形推奨）</p>
        @for ($i = 1; $i < 11; $i++)
        
        <form method="post" action="{{ route('admin.eximage.index') }}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-12"><label for="customFile">画像{{ $i }}</label></div>
            <div class="col-md-9"><div class="form-group"><div class="custom-file">
              <input type="file" class="custom-file-input" id="customFile1" name="file">
              <input type="hidden" name="id" value="{{ $i }}">
              <label class="custom-file-label" for="customFile1">選択してください</label>
            </div></div></div>
            <div class="col-md-3">
              <input type="submit" name="" value="変更" class="btn btn-primary">
            </div>
          </div>
        </form>

        @endfor
        
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
@stop

@section('css')

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script>
  bsCustomFileInput.init();
</script>
@stop