@extends('adminlte::page')

@section('title', '集計')

@section('content_header')
    <h1>集計</h1>
@stop

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
        <div class="card-header">{{ __('集計する期間を入力してください。') }}</div>
        <div class="card-body">
          <form method="GET" action="{{route('admin.totalization.index')}}" class="form-inline my-2 my-lg-0">
          <div class="row">
            <div style="padding:0 5px 0;">
              <select id="tyear" class="form-control" name="tyear">
                @for($y = 2020; $y <= 2028; $y++)
                  <option value="{{ $y }}" {{ ($request->tyear ?? '') == $y ? 'selected' : '' }}>
                    {{ $y }}年
                  </option>
                @endfor
              </select>
            </div>

            <div style="padding:0 5px 0;">
              <select id="tmonth" class="form-control" name="tmonth">
                @for($m = 1; $m <= 12; $m++)
                  @php $mm = sprintf('%02d', $m); @endphp
                  <option value="{{ $mm }}" {{ ($request->tmonth ?? '') == $mm ? 'selected' : '' }}>
                    {{ $mm }}月
                  </option>
                @endfor
              </select>
            </div>
            <div style="padding:0 5px 0;">
              <button class="btn btn-primary" type="submit">集計</button>
            </div>
          </div>
          </form>
        </div>
    </div>
  </div>
</div>

@if($item2)
<div class="row">
  <div class="col-md-12">

    <div class="card">
      <div class="card-header">
        ※会員登録した時点での集計
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0" style="width:100%;overflow: auto;">
        <table class="table table-striped total_table">
          <thead>
            <tr>
              <th rowspan="2">月日</th>
              <th rowspan="2">総件数</th>
              @foreach($mediaList as $m)
                <th>{{ $m['name'] }}</th>
              @endforeach
              <th rowspan="2">詳細</th>
            </tr>
            <tr>
              @foreach($mediaList as $m)
                <th>申込数</th>
              @endforeach
            </tr>
          </thead>

          <tbody>
            @foreach($item2 as $row)
            <tr @if($loop->last) style="background:#ffe4c4" @endif>
              <td>{{ $loop->last ? '合計' : $row->day }}</td>
              <td>{{ $row->件数 }}</td>

              @foreach($mediaList as $m)
                <td>{{ $row->{$m['name']} }}</td>
              @endforeach

              <td></td>
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

@if($item)
<div class="row">
  <div class="col-md-12">

    <div class="card">
      <div class="card-header">
        ※会員登録後、買取申込した集計
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0" style="width:100%;overflow: auto;">
        <table class="table table-striped total_table">
          <thead>
            <tr>
              <th rowspan="2">月日</th>
              <th rowspan="2">総件数</th>
              @foreach($mediaList as $m)
                <th colspan="2">{{ $m['name'] }}</th>
              @endforeach
              <th rowspan="2">詳細</th>
            </tr>
            <tr>
              @foreach($mediaList as $m)
                <th>申込</th>
                <th>送金</th>
              @endforeach
            </tr>
          </thead>

          <tbody>
            @foreach($item as $row)
            <tr @if($loop->last) style="background:#ffe4c4" @endif>
              <td>{{ $loop->last ? '合計' : $row->day }}</td>
              <td>{{ $row->件数 }}</td>

              @foreach($mediaList as $m)
                <td>{{ $row->{$m['name']} }}</td>
                <td>{{ $row->{$m['name'].'振込'} }}</td>
              @endforeach

              <td style="white-space: nowrap;font-size:12px;">
                @unless($loop->last)
                  <a target="_blank"
                     href="{{ route('admin.totalization.show', Functions::tdateFnc($row->day)) }}">
                     詳細
                  </a>
                @endunless
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
@endif

@stop

@section('css')
<style type="text/css">
.show_btn{
  margin:0 auto;
  text-align:center;
  background:dodgerblue;
  color:#fff;
  font-size:14px;
  padding:3px;
  display: block;
  width:45px;
}
.total_table{
  width:95% !important;
  margin:20px auto 20px !important;
}
.total_table th{
    font-size:13px !important;
    vertical-align:middle !important;
    text-align:center;
    border:1px solid #ccc;
}
.total_table td{
    border:1px solid #ccc;
}
.bgtb{
    background:#333333;
    border:1px solid #fff;
    color:#fff;
}
.total_table td{
  padding:3px;
  text-align: center;
}
</style>
@stop

@section('js')

@stop