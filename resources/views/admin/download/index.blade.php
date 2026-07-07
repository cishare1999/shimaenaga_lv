@extends('adminlte::page')

@section('title', 'ダウンロード')

@section('content_header')
    <h1>ダウンロード</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    <p>
      期間の指定は必須です。
    </p>
    <form method="post" action="">
      @csrf
      <div class="form-inline mb-3">
        <select class="custom-select" required="" name="type">
          <option value="">選択してください</option>
          <option value="item">申込みデータ</option>
          <option value="user">ユーザーデータ</option>
        </select>
      </div>
      <div class="form-group">
        <input  type="date" name="from" value="" required=""> ～ <input type="date" name="to" value="" required="">
      </div>
      <input type="submit" name="" class="btn btn-primary" value="ダウンロード">
    </form>

    <div class="card">
      
    </div>

  </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop