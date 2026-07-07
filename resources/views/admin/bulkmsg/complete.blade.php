@extends('adminlte::page')

@section('title', 'LINE一括送信 完了')

@section('content_header')
    <h1>LINE一括送信　完了</h1>
@stop

@section('content')

<div class="row">
  <div class="col-md-12">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <span style="color:red;font-size:13px;">LINEメッセージを送信しました。送信内容は買取リスト詳細からご確認ください。</span>
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
<script>
//checkbox 全選択
$(document).on('click', '#all_chk', function() {
    $("input[name='bulk_id[]']").prop('checked', this.checked);
});  
</script>
@stop