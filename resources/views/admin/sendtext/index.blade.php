@extends('adminlte::page')

@section('title', '定型文')

@section('content_header')
    <h1>定型文</h1>
@stop

@section('content')

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
        <h3 class="card-title">
          定型文一覧<br>
          <span style="color:red;font-size:13px;">※ステータス変更はステータスを変更した時に自動的に送信されるメッセージになります。</span>
        </h3>
        
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table table-sm">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>タイトル</th>
              <th>備考</th>
              <th>変更日時</th>
            </tr>
          </thead>
          <tbody>
            @foreach($sendtext as $val)
            <tr>
              <td>{{ $val->id }}</td>
              <td>{{ $val->send_title }}</td>
              <td>
              @if($val->id == 6) 
                <span style="color:red;font-size:12px;">※本文の下に自動で「買取申込情報」「注意事項確認URL」が入ります。</span>
              @endif  
              </td>
              <td>{{ $val->updated_at }}</td>
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


<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          定型文の編集<br>
          <span style="color:red;font-size:13px;">※各定型文を編集して登録ボタンを押すことでメッセージを変更できます。ステータス変更のタイトルは変更できません。</span>
        </h3>
        
      </div>
      <!-- /.card-header -->
      <div class="card-body cd_flex">

        @foreach($sendtext as $val)
        <div class="cd_wrap">
        <form action="{{ route('admin.sendtext.textedit', $val->id) }}?item={{ $val->id }}" method="post">
          @csrf
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b>定型文:{{ $val->id }}</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">       
              <div class="form-group">
                @if($val->send_status != "fixed")
                <input type="text" class="form-control" name="send_title" value="{{ $val->send_title }}">
                @else
                <input type="text" class="form-control" name="send_title" value="{{ $val->send_title }}" disabled>
                @endif
                <textarea class="form-control" rows="15" name="sentence" placeholder="" style="margin-top:10px;">{{ $val->sentence }}</textarea>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" id="sendtext_submit" class="btn btn-primary">登　録</button>
            </div>
          </div>
        </form>
        </div>
        @endforeach
    


      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>












@stop

@section('css')
<style type="text/css">
  div.cd_flex{
    display: flex;
    justify-content: flex-start;
    align-content: stretch;
    flex-wrap: wrap;
    width:97%;
    gap:10px;
    margin:0 auto;
    padding:10px 0 0 0;
  }
  div.cd_wrap{
    width:32%;
  }
</style>
@stop

@section('js')

@stop