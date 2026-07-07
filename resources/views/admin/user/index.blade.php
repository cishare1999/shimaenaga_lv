@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ユーザー一覧</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <form method="get" action="">
          <div class="row">
            <div class="col-3">
              <input type="text" class="form-control" placeholder="漢字" name="name" value="{{ $request->name }}">
            </div>
            <div class="col-3">
              <input type="text" class="form-control" placeholder="携帯" name="tel" value="{{ $request->tel }}">
            </div>
            <div class="col-2">
              <button type="submit" class="btn btn-primary">検索</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

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
        <h3 class="card-title"></h3>
        <div class="card-tools">
          {{ $users->links() }}
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table table-sm">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>名前</th>
              {{-- <th>LINE表示名</th> --}}
              <th>メール</th>
              <th>LINE状態</th>
              <th>買取情報</th>
              <th>流入経路</th>
              <th>個人情報</th>
              <th>電話番号</th>
              <th>登録日時</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $item)


            @if(optional($item->userData)->is_black == 'on')
            <tr class="black">
            @else
            <tr>
            @endif
              <td>{{ $item->id }}</td>
              <td>
                @if($item->userData)
                  <a href="{{ route('admin.users.show', $item->id) }}">
                @endif
                  {{ $item->name }}
                @if($item->userData)
                  </a>
                @endif
              </td>
              {{-- <td>{{ $item->display_name }}</td> --}}
              <td>{{ $item->email }}</td>
              <td>{{ $item->mode }}</td>
              <td>
              @if(Functions::userItemChk($item->id) == "yes")
                <img src="{{ asset('/') }}img/akacheck.png" width="20">
              @endif
              </td>
              <td>{{ $item->from_url }}</td>
              {{-- 2022.08.23 店舗から店舗へのユーザーDBの移行を行ったところエラーになり以下のoptionalの記述を追加 --}}
              @if(optional($item->userData)->kana)
              <td>〇</td>
              @else
              <td></td>
              @endif
              <td>{{ $item->mobile }}</td>
              <td>{{ $item->created_at }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
@stop

@section('css')
<style type="text/css">
  .black {
    background-color: #ccc;
  }
  .pink {
    background-color: #ffc8c8;
  }
</style>
@stop

@section('js')
<script>
  $(function () {
    $(document).on('click', '#email_verified', function(event) {
      if(confirm('仮登録を手動認証します。よろしいですか？')){
        return true;
      }else{
        return false;
      }
    });
  })
</script>
@stop