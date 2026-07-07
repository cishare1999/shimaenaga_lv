@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ユーザー一覧</h1>
@stop

@section('content')
<form>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <input class="form-control" type="" name="s_name" placeholder="名前" value="{{ $request->s_name }}">
          </div>
          <div class="col-md-3">
            <input class="form-control" type="" name="s_tel" placeholder="電話番号" value="{{ $request->s_tel }}">
          </div>
          <div class="col-md-3">
            <input type="submit" class="btn btn-primary" name="" value="検索">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>


<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"></h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table table-sm">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>名前</th>
              <th>メールアドレス</th>
              <th>メアド認証</th>
              <th>個人情報</th>
              <th>電話番号</th>
              <th>登録日時</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $item)
            @if($item->userData)
            <tr class="@if($item->userData->is_black) bg-secondary @endif">
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
              <td>{{ $item->email }}</td>
              <td>
                @if($item->email_verified_at)
                〇
                @else
                ―
                @endif
              </td>
              @if($item->userData)
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
  .bg-secondary a {
    text-decoration: underline;
    color: #fff;
  }
</style>
@stop

@section('js')

@stop