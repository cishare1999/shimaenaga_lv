@extends('adminlte::page')

@section('title', '取引完了リスト')

@section('content_header')
    <h1>取引完了リスト</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <form method="get" action="">
          <div class="row">
            <div class="col-12">
              <span style="color:red;font-size:13px;padding:0 0 10px 0;">※抽出条件　全ての取引の振込後ステータスが「取引完了」「取引完了遅延」を抽出</span>
            </div>
          </div>
          <div class="row">
            <div class="col-2">
              <input type="text" class="form-control" placeholder="漢字" name="name" value="{{ $request->name }}">
            </div>
            <div class="col-2">
              <input type="text" class="form-control" placeholder="カナ" name="kana" value="{{ $request->kana }}">
            </div>
            <div class="col-2">
              <input type="text" class="form-control" placeholder="携帯" name="tel" value="{{ $request->tel }}">
            </div>
            <div class="col-2">
              <input type="text" class="form-control" placeholder="生年月日 2001/01/11" name="birthday" value="{{ $request->birthday }}">
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
              <th>生年月日</th>
              <th>LINE表示名</th>
              <th>流入経路</th>
              <th>電話番号</th>
              <th>登録日時</th>
              <th>ユーザーメモ</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $item)


            @if(optional($item->is_black) == 'on')
            <tr class="black">
            @else
            <tr>
            @endif
              <td>{{ $item->id }}</td>
              <td>
                @if($item->birthday)
                  <a href="{{ route('admin.list.show', $item->list_id) }}">
                @endif
                  {{ $item->name }}
                @if($item->birthday)
                  </a>
                @endif
              </td>
              <td>{{ $item->birthday }}</td>
              <td>{{ $item->display_name }}</td>

              <td>{{ $item->from_url }}</td>

              <td>{{ $item->mobile }}</td>

              <td>{{ $item->created_at }}</td>
              <td>
                <div style="width:200px;height:70px;overflow:auto;border:1px solid #ccc;font-size:12px;">
                {{ $item->memo }}
                </div>
              </td>
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