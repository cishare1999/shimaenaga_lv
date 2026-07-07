@extends('adminlte::page')

@section('title', '集計')

@section('content_header')
    <h1>{{$tdate}} 集計 詳細</h1>
@stop

@section('content')


@if($item)
<div class="row">
  <div class="col-md-12">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title"></h3>
        <div class="card-tools">

        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
          <table class="table table-striped total_table">
            <thead>
              <tr>
                <th class="bgtb">id</th>
                <th class="bgtb">名前</th>
                <th class="bgtb">流入経路</th>
                <th class="bgtb">ステータス</th>
                <th class="bgtb">申込日付</th>
              </tr>
            </thead>
            <tbody>
            @foreach($item as $k=>$hm)
            <tr>
                <td>{{$hm->id}}</td>
                <td>{{$hm->name}}</td>
                <td>{{$hm->from_url}}</td>
                <td>{{$hm->status_total}}</td>
                <td>{{$hm->created_at}}</td>
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
@endif

@stop

@section('css')
<style type="text/css">
.total_table{
  width:95% !important;
  margin:20px auto 20px !important;
}
.total_table th{
    font-size:13px !important;
    vertical-align:middle !important;
    text-align:center;
    border:1px solid #ccc;
    padding:5px;
}
.total_table td{
    border:1px solid #ccc;
    padding:5px;
    text-align:center;
}
.bgtb{
    background:#333333;
    border:1px solid #fff;
    color:#fff;
}
</style>
@stop

@section('js')

@stop