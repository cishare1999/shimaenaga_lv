@extends('adminlte::page')

@section('title', 'LINE一括送信 確認')

@section('content_header')
    <h1>LINE一括送信　確認</h1>
@stop

@section('content')

<div class="row">
  <div class="col-md-12">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <span style="color:red;font-size:13px;">※以下のユーザーにメッセージを送信します。</span>
        </h3>
      </div>
      <div class="row">
        <div class="col-md-8">
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>名前</th>
                  <th>ステータス</th>
                  <th>振込後</th>
                  <th>査定金額</th>
                  <th>代金振込日時</th>
                </tr>
              </thead>
              <tbody>
                @foreach($items as $val)
                <tr>
                  <td>{{ $val->id }}</td>
                  <td>{{ $val->user->name }}</td>
                  <td>{{ $val->status_total }}</td>
                  <td>{{ $val->status_paid }}</td>
                  <td>{{ $val->judge_price }}円</td>
                  <td>{{ $val->memo }}</td>
                  </td>
                </tr>
                @endforeach
                <tr>
                  <td colspan="6">@if($itemCount)TOTAL　{{ $itemCount }}　 件@endif</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <div class="col-md-4">
          <form action="{{ route('admin.bulkmsg.complete') }}" method="post">
            @csrf
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>送信文章</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">       
                <div class="form-group">
                  <textarea class="form-control" rows="15" id="sentence" name="sentence" placeholder="3日前確認連絡" style="margin-top:10px;"></textarea>
                  <input type="hidden" name="bulk_id" value="{{$bulk_id}}">
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" id="sendtext_submit" class="btn btn-primary">一括送信</button><br>
                <span style="font-size:12px;color:red;">※ボタンは一度だけ押してください。<br>件数が多いと時間がかかる場合があります。</span>
              </div>
            </div>
          </form>
        </div>
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
<script>
//送信ボタン
$(document).on('click', '#sendtext_submit', function() {
  var tt = $('#sentence').val();
  if(tt){
    if(confirm("一括送信を行います。\nよろしいですか？")){
      return true;
    }else{
      return false;
    }
  }else{
    alert("送信文章を入力してください。");
    return false;
  }
});  
</script>
@stop