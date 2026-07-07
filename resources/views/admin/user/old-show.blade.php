@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ユーザー詳細</h1>
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
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">身分証画像</h3>
        <div class="card-tools">
          <a class="btn btn-info btn-sm" href="{{ route('admin.users.image', $user->id) }}">画像修正</a>
        </div>
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
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">ユーザー情報</h3>
        <div class="card-tools">
          <a class="btn btn-info btn-sm" href="{{ route('admin.users.edit', $user->id) }}">情報修正</a>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table table-sm">
          <tbody>
            <tr>
              <th>お名前</th><td>{{ $user->name }}</td>
            </tr>
            <tr>
              <th>お名前(カナ)</th><td>{{ $user->userData->kana }}</td>
            </tr>
            <tr>
              <th>メールアドレス</th><td>{{ $user->email }}</td>
            </tr>
            <tr>
              <th>携帯電話番号</th><td>{{ $user->mobile }}</td>
            </tr>
            <tr>
              <th>LINE ID</th><td>{{ $user->userData->line }}</td>
            </tr>
            <tr>
              <th>ご連絡方法</th><td>{{ $user->userData->contact }}</td>
            </tr>
            <tr>
              <th>郵便番号</th><td>〒{{ $user->userData->zip }}</td>
            </tr>
            <tr>
              <th>都道府県</th><td>{{ $user->userData->pref }}</td>
            </tr>
            <tr>
              <th>市区町村</th><td>{{ $user->userData->city }}</td>
            </tr>
            <tr>
              <th>番地以降</th><td>{{ $user->userData->address }}</td>
            </tr>
            <tr>
              <th>ビルマンション名・部屋番号</th><td>{{ $user->userData->building }}</td>
            </tr>
            <tr>
              <th>銀行名</th><td>{{ $user->userData->bank_name }}({{ $user->userData->bank_code }})</td>
            </tr>
            <tr>
              <th>支店名</th><td>{{ $user->userData->branch_name }}({{ $user->userData->branch_code }})</td>
            </tr>
            <tr>
              <th>口座種別</th><td>{{ $user->userData->bank_type }}</td>
            </tr>
            <tr>
              <th>口座番号</th><td>{{ $user->userData->bank_number }}</td>
            </tr>
            <tr>
              <th>口座名義（カナ）</th><td>{{ $user->userData->bank_kana }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">勤務先情報情報</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table table-sm">
          <tbody>

            <tr>
              <th>勤務先名</th><td>{{ $user->userData->work_name }}</td>
            </tr>
            <tr>
              <th>勤務先 電話番号</th><td>{{ $user->userData->work_tel }}</td>
            </tr>
            <tr>
              <th>勤務先 郵便番号</th><td>〒{{ $user->userData->work_zip }}</td>
            </tr>
            <tr>
              <th>勤務先 都道府県</th><td>{{ $user->userData->work_pref }}</td>
            </tr>
            <tr>
              <th>勤務先 市区町村</th><td>{{ $user->userData->work_city }}</td>
            </tr>
            <tr>
              <th>勤務先 番地以降</th><td>{{ $user->userData->work_address }}</td>
            </tr>
            <tr>
              <th>勤務先 ビルマンション名・部屋番号</th><td>{{ $user->userData->work_building }}</td>
            </tr>
            <tr>
              <th>月額給与額</th><td>{{ $user->userData->salary }}</td>
            </tr>
            <tr>
              <th>給料日</th><td>{{ $user->userData->payday }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <div class="col-md-6">
    <form action="{{ route('admin.users.status', $user->id) }}" method="post">
      @csrf
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">ステータス・メモ</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">       
          <div class="form-group">
            <label>メモ</label>
            <textarea class="form-control" rows="8" name="memo" placeholder="">{!! $user->userData->memo !!}</textarea>
          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="is_black" name="is_black"　@if($user->userData->is_black) checked @endif>
              <label class="form-check-label" for="is_black">ブラック登録</label>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">登録</button>
        </div>
      </div>
    </form>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">申込み一覧</h3>
          </div>
          <div class="card-body">
            <table class="table-responsive">
              <tr>
                <th style="width: 10px">#</th>
                <th>商品名</th>
                <th>買取方法</th>
                <th>希望金額</th>
                <th>査定</th>
                <th>登録日時</th>
              </tr>
              @foreach($items as $item)
              <tr>
              <td>{{ $item->id }}</td>
              <td>
                <a href="{{ route('admin.items.show', $item->id) }}">
                  {{ $item->item_name }}
                </a>
              </td>
              <td>{{ $item->way }}</td>
              <td>{{ $item->price }}</td>
              <td>{{ $item->status_judge }}</td>
              <td>{{ $item->created_at }}</td>
            </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
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
@stop


