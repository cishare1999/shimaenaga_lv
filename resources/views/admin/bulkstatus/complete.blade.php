@extends('adminlte::page')

@section('title', 'ステータス一括更新 完了')

@section('content_header')
    <h1>ステータス一括更新　完了</h1>
@stop

@section('content')

<div class="row">
  <div class="col-md-12">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <span style="color:red;font-size:13px;">ステータス一括更新完了しました。</span>
        </h3>
      </div>
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
  .blue {
    background-color: #e0efff;
  }
  .table th,td{
    font-size:14px !important;
  }
  .btn-sm{
    font-size:12px;
    min-width:40px;
    text-align:center;
    display: block !important;
  }
</style>
@stop

@section('js')

@stop