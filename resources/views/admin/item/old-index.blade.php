@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>買取希望一覧</h1>
@stop

@section('content')
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
              
              <th>商品名</th>
              <th>買取方法</th>
              <th>希望金額</th>
              <th>査定</th>
              <th>支払い</th>
              <th>商品</th>
              <th>申込者</th>
              <th>メールアドレス</th>
              <th>登録日時</th>
            </tr>
          </thead>
          <tbody>
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
              <td>{{ $item->status_payment }}</td>
              <td>{{ $item->status_item }}</td>
              <td>
                <a href="{{ route('admin.users.show', $item->user_id) }}">
                  {{ $item->user->name }}
                </a>
              </td>
              <td>{{ $item->user->email }}</td>
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

@stop

@section('js')

@stop