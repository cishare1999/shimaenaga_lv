<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>リスティング集計【{{ config('app.name') }}】</title>
<link rel="stylesheet" href="{{ asset('/') }}vendor/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="{{ asset('/') }}vendor/overlayScrollbars/css/OverlayScrollbars.min.css">
<link rel="stylesheet" href="{{ asset('/') }}vendor/adminlte/dist/css/adminlte.min.css">
<style>
body:not(.sidebar-mini-md) .content-wrapper, body:not(.sidebar-mini-md) .main-footer, body:not(.sidebar-mini-md) .main-header{
  margin-left:0 !important;
}  
</style>
</head>
<body class="sidebar-mini-1" >

<div class="content-wrapper ">
    <div class="content-header">
      <div class="container-fluid">
        <h1>リスティング集計【{{ config('app.name') }}】</h1>
      </div>
    </div>
  
<div class="content">
<div class="container-fluid">
  <p style="font-size:16px;padding:10px;">/lp3からの流入を計測しております。</p>
  <div class="row">
    <div class="col-4">
      <div class="card">
          <div class="card-header">{{ __('集計する期間を入力してください。') }}</div>
          <div class="card-body">
            <form method="GET" action="{{route('media.index3')}}" class="form-inline my-2 my-lg-0">
            <div class="row">
              <div style="padding:0 5px 0;">
                <select id="tyear" class="form-control" name="tyear">
                  <option value="2022" @if($request->tyear == 2022) selected="" @endif>2022年</option>
                  <option value="2023" @if($request->tyear == 2023) selected="" @endif>2023年</option>
                  <option value="2024" @if($request->tyear == 2024) selected="" @endif>2024年</option>
                  <option value="2025" @if($request->tyear == 2025) selected="" @endif>2025年</option>
                  <option value="2026" @if($request->tyear == 2026) selected="" @endif>2026年</option>
                </select>
              </div>
  
              <div style="padding:0 5px 0;">
                <select id="tmonth" class="form-control" name="tmonth">
                  <option value="01" @if($request->tmonth == '01') selected="" @endif>01月</option>
                  <option value="02" @if($request->tmonth == '02') selected="" @endif>02月</option>
                  <option value="03" @if($request->tmonth == '03') selected="" @endif>03月</option>
                  <option value="04" @if($request->tmonth == '04') selected="" @endif>04月</option>
                  <option value="05" @if($request->tmonth == '05') selected="" @endif>05月</option>
                  <option value="06" @if($request->tmonth == '06') selected="" @endif>06月</option>
                  <option value="07" @if($request->tmonth == '07') selected="" @endif>07月</option>
                  <option value="08" @if($request->tmonth == '08') selected="" @endif>08月</option>
                  <option value="09" @if($request->tmonth == '09') selected="" @endif>09月</option>
                  <option value="10" @if($request->tmonth == '10') selected="" @endif>10月</option>
                  <option value="11" @if($request->tmonth == '11') selected="" @endif>11月</option>
                  <option value="12" @if($request->tmonth == '12') selected="" @endif>12月</option>
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
  
  @if($item)
  <div class="row">
    <div class="col-md-4">
  
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
                <th>月日</th>
                <th>LP3</th>
              </tr>
            </thead>
            <tbody>
            @foreach($item as $k=>$hm)
              @if ($loop->last)
              <tr style="background-color:#ffe4c4;">
                <td>合計</td>
                <td>{{$hm->LP3}}</td>
              </tr>
              @else
              <tr>
                <td>{{$hm->day}}<br></td>
                <td>{{$hm->LP3}}</td>
              </tr>
              @endif
            @endforeach
            </tbody>
          </table>

  
  
  
  
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  @else

  <div class="row">
    <div class="col-md-4">
  
      <div class="card">
        <div class="card-header">
          <h5 class="card-title">※集計結果がありません</h5>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </div>


  @endif

</div>
</div>
</div>

</body>
</html>