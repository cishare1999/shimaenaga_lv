@extends('adminlte::page')

@section('title', '契約書')

@section('content_header')
    <h1>契約書情報</h1>
    @if($item->contract_status)
    <div style="margin:5px auto;"><a class="btn btn-success" target="_balnk" href="{{ route('admin.list.pdf', $item->id) }}">PDF</a></div>
    @endif
@stop

@section('content')

<div class="row">
  @if (session('message'))
  <div class="col-md-12">
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      {{ session('message') }}
    </div>
  </div>
  @endif
  
</div>

<div class="row">

  <div class="col-md-6">


    <div class="card">
      <div class="card-header">
        <h3 class="card-title">契約書情報</h3>
        
      </div>
      
      <form action="{{ route('admin.items.contract', $item->id) }}" method="post">
        @csrf
        <div class="card-body">


          <div class="form-group">
            <label for="">【契約者名】</label>
            <div class="input-group">
              {{ $user->name }}
            </div>
          </div>
          <div class="form-group">
            <label for="">【商品名】</label>
            <div class="input-group">
              {{ $item->item_name }}
            </div>
          </div>
          <div class="form-group">
            <label for="">【引き渡し期限】</label>
            <div class="input-group">
              @if($item->contract_repayment_date)
              <input type="date" class="form-control" id="contract_repayment_date" name="contract_repayment_date" placeholder="" value="{{ $item->contract_repayment_date }}">
              @else
              <input type="date" class="form-control" id="contract_repayment_date" name="contract_repayment_date" placeholder="" value="">
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="">【買取金額】</label>
            <div class="input-group">
              {{ $item->judge_price }}　円
            </div>
          </div>
          <div class="form-group">
            <label for="">【商品の額面】</label>
            <div class="input-group">
            {{ $item->contract_cancel }}　円
            </div>
          </div>
          <div class="form-group">
            <label for="">【支払期限】</label>
            <div class="input-group">
              <input type="date" class="form-control" id="contract_deadline_date" name="contract_deadline_date" placeholder="" value="{{ $item->contract_deadline_date }}">
            </div>
          </div>
          
        </div>
        <div class="card-footer">
          <button type="submit" id="con_btn" class="btn btn-primary">入力</button>
        </div>
      </form>
    </div>
  </div>

  <div class="col-md-6">

    <div class="card">
        <div class="card-header">
          <h3 class="card-title">買取ステータス</h3>
        </div>

          <div class="card-body">
            @if($item->status_judge)
            <div class="" style="font-size: 10px;">
              {{ $item->status_judge }} / {{ $item->status_payment }} / {{ $item->status_item }}
            </div>
            @endif
            <div class="form-group">
              <label for="">査定ステータス</label>
              <select class="form-control" name="status_total" disabled>
                <option value="">選択してください</option>
                <option value="査定中" @if($item->status_total == '査定中') selected="" @endif>査定中</option>
                <option value="保留" @if($item->status_total == '保留') selected="" @endif>保留</option>
                <option value="書類不備" @if($item->status_total == '書類不備') selected="" @endif>書類不備</option>
                <option value="査定完了（買取不可）" @if($item->status_total == '査定完了（買取不可）') selected="" @endif>査定完了（買取不可）</option>
                <option value="ケリ" @if($item->status_total == 'ケリ') selected="" @endif>ケリ</option>
                <option value="詐欺" @if($item->status_total == '詐欺') selected="" @endif>詐欺</option>
                <option value="査定完了（買取可）" @if($item->status_total == '査定完了（買取可）') selected="" @endif>査定完了（買取可）</option>
                <option value="代金振込済" @if($item->status_total == '代金振込済') selected="" @endif>代金振込済</option>
              </select>
            </div>
            <div class="form-group">
              <label for="">買取金額</label>
              <div class="input-group">
                <input type="tel" class="form-control" name="judge_price" placeholder="半角数字で入力" value="{{ $item->judge_price }}" disabled>
                <div class="input-group-append"><div class="input-group-text">円</div></div>
              </div>
            </div>
            <div class="form-group">
              <label for="">【商品の額面】</label>
              <div class="input-group">
                <input type="tel" class="form-control" name="contract_cancel" placeholder="半角数字で入力" value="{{ $item->contract_cancel }}" disabled>
                <div class="input-group-append"><div class="input-group-text">円</div></div>
              </div>
            </div>
            <div class="form-group">
              <label for="">査定承認</label>
              <div class="input-group">
                @if($item->user_agree)
                {{ $item->user_agree }}
                @else
                未承認
                <input type="hidden" name="reset_agree" disabled>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="">振込後ステータス</label>
              <select class="form-control" name="status_paid" disabled>
                <option value="">選択してください</option>
                <option value="商品到着待" @if($item->status_paid == '商品到着待') selected="" @endif>商品到着待</option>
                <option value="取引完了" @if($item->status_paid == '取引完了') selected="" @endif>取引完了</option>
                <option value="取引完了遅延" @if($item->status_paid == '取引完了遅延') selected="" @endif>取引完了遅延</option>
                <option value="商品到着済" @if($item->status_paid == '商品到着済') selected="" @endif>商品到着済</option>
              </select>
            </div>
            <div class="form-group">
              <label for="">ユーザー向けメモ</label>
              <textarea class="form-control" rows="3" name="for_user" placeholder="" disabled>{!! $item->for_user !!}</textarea>
              
            </div>
          </div>

      </div>
    </div>

</div>


@stop

@section('css')

@stop

@section('js')
<script type="text/javascript">
  
  $(function () {
    $(document).on('click', '#con_btn', function(event) {
      if(confirm('契約書情報を登録します。よろしいですか？')){
        return true;
      }else{
        return false;
      }
    });
  })
  // $(function () {
  //   $(document).ready(function(){
  //     var now = new Date();
  //     now.setDate(now.getDate() + 6);

  //     var ima = formatDate(now);
  //     var val1 = $('#contract_repayment_date').val();
  //     if(!val1){
  //       $('#contract_repayment_date').attr("value",ima);
  //     }
  //   });
  // })
  $(function () {
    $('#contract_repayment_date').change(function() {
      var tt = $('#contract_repayment_date').val();
      $('#contract_deadline_date').val(tt);
    });
  })
  // 日付をYYYY-MM-DDの書式で返すメソッド
  function formatDate(dt) {
    var y = dt.getFullYear();
    var m = ('00' + (dt.getMonth()+1)).slice(-2);
    var d = ('00' + dt.getDate()).slice(-2);
    return (y + '-' + m + '-' + d);
  }
</script>
@stop


