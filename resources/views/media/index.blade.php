<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>メディア集計【{{ config('app.name') }}】</title>
<link rel="stylesheet" href="{{ asset('/') }}vendor/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="{{ asset('/') }}vendor/overlayScrollbars/css/OverlayScrollbars.min.css">
<link rel="stylesheet" href="{{ asset('/') }}vendor/adminlte/dist/css/adminlte.min.css">
<style>
body:not(.sidebar-mini-md) .content-wrapper, body:not(.sidebar-mini-md) .main-footer, body:not(.sidebar-mini-md) .main-header{
  margin-left:0 !important;
  .table td, .table th{
    padding:5px;
  }
}  
</style>
</head>
<body class="sidebar-mini-1" >

<div class="content-wrapper ">
    <div class="content-header">
      <div class="container-fluid">
        <h1>メディア集計【{{ config('app.name') }}】</h1>
      </div>
    </div>
  
<div class="content">
<div class="container-fluid">
  <p style="font-size:16px;padding:10px;">/lp2seo/,/lp2lis/,/lp2afi/,/lp2seo1/,/lp2seo2/,/lp2seo3/,/lp2seo4/,/lp2seo5/,/lp2seo6/からの流入を計測しております。</p>
  {{-- <p style="font-size:16px;padding:10px;">/lp2/は以前のデータになります。</p> --}}
  {{-- <p style="font-size:16px;padding:10px;">/lp2/のURLからの流入を計測しております。</p> --}}
  <div class="row">
    <div class="col-4">
      <div class="card">
          <div class="card-header">{{ __('集計する期間を入力してください。') }}</div>
          <div class="card-body">
            <form method="GET" action="{{route('media.index')}}" class="form-inline my-2 my-lg-0">
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
  
  @if($item)
  <div class="row">
    <div class="col-md-10">
  
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">※会員登録した時点での集計</h3>
          <div class="card-tools">
  
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <table class="table table-striped total_table">
            <thead>
            <tr>
              <th>月日</th>
              @foreach($mediaList as $label)
                <th>{{ $label }}</th>
              @endforeach
            </tr>
            </thead>

            <tbody>
            @foreach($item as $row)
            <tr @if($loop->last) style="background:#ffe4c4" @endif>
              <td>{{ $loop->last ? '合計' : $row->day }}</td>
              @foreach($mediaList as $label)
                <td>{{ $row->$label }}</td>
              @endforeach
            </tr>
            @endforeach
            </tbody>
          </table>

  
  
  
  
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>



    <div class="col-md-10">
  
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">※会員登録後、買取申込した集計</h3>
          <div class="card-tools">
  
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <table class="table table-striped total_table text-center">
            <thead>
            <tr>
              <th>月日</th>
              @foreach($mediaList as $label)
                <th colspan="2">{{ $label }}<br>申込 / 送金</th>
              @endforeach
            </tr>
            </thead>

            <tbody>
            @foreach($item2 as $row)
            <tr @if($loop->last) style="background:#ffe4c4" @endif>
              <td>{{ $loop->last ? '合計' : $row->day }}</td>

              @foreach($mediaList as $label)
                <td class="text-danger">{{ $row->$label }}</td>
                <td>{{ $row->{$label.'振込'} }}</td>
              @endforeach
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