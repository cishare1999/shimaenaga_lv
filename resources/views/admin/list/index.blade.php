@extends('adminlte::page')

@section('title', '買取リスト')

@section('content_header')
    <h1>買取リスト</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <form method="get" action="">
          <div class="row">
            <div class="col-2">
              <input type="text" class="form-control" placeholder="漢字" name="name" value="{{ $request->name }}">
            </div>
            <div class="col-2">
              <input type="text" class="form-control" placeholder="カナ" name="kana" value="{{ $request->kana }}">
            </div>
            <div class="col-2">
              <input type="text" class="form-control" placeholder="携帯" name="tel" value="{{ $request->tel }}">
            </div>

            <div class="col-2">
              <input type="tel" class="form-control" placeholder="緊急連絡先1,2" name="emergency" value="{{ $request->emergency }}">
            </div>

            <div class="col-2">
              <button type="submit" class="btn btn-primary">検索</button>
            </div>
            <div class="col-2"></div>
          </div>
          <div class="row" style="padding:10px 0 0 0;">
            <div class="col-2">
              <input type="text" class="form-control" placeholder="生年月日 2001/01/11" name="birthday" value="{{ $request->birthday }}">
            </div>
            <div class="col-2">
              <select class="form-control" name="status_total">
                <option value="">選択してください</option>
                <option value="査定中" @if($request->status_total == '査定中') selected="" @endif>査定中</option>
                <option value="保留" @if($request->status_total == '保留') selected="" @endif>保留</option>
                <option value="書類不備" @if($request->status_total == '書類不備') selected="" @endif>書類不備</option>
                <option value="本人キャンセル" @if($request->status_total == '本人キャンセル') selected="" @endif>本人キャンセル</option>
                <option value="査定完了（買取不可）" @if($request->status_total == '査定完了（買取不可）') selected="" @endif>査定完了（買取不可）</option>
                <option value="ケリ" @if($request->status_total == 'ケリ') selected="" @endif>ケリ</option>
                <option value="詐欺" @if($request->status_total == '詐欺') selected="" @endif>詐欺</option>
                <option value="査定完了（買取可）" @if($request->status_total == '査定完了（買取可）') selected="" @endif>査定完了（買取可）</option>
                <option value="代金振込済" @if($request->status_total == '代金振込済') selected="" @endif>代金振込済</option>
              </select>
            </div>
            <div class="col-2">
              <select class="form-control" name="status_paid">
                <option value="">選択してください</option>
                <option value="商品到着待" @if($request->status_paid == '商品到着待') selected="" @endif>商品到着待</option>
                <option value="取引完了" @if($request->status_paid == '取引完了') selected="" @endif>取引完了</option>
                <option value="取引完了遅延" @if($request->status_paid == '取引完了遅延') selected="" @endif>取引完了遅延</option>
                <option value="商品到着済" @if($request->status_paid == '商品到着済') selected="" @endif>商品到着済</option>
              </select>
            </div>

            <div class="col-2"></div>

            <div class="col-2"></div>
            <div class="col-2"></div>


          </div>
          <input type="hidden" name="concon" value="1">
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title"></h3>
        <div class="card-tools">
          {{ $items->appends(['kana'=>$request->kana,'tel'=>$request->tel,'birthday'=>$request->birthday, 'status_total'=>$request->status_total])->links() }}
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>契約書</th>
              <th>申込者</th>
              <th>メール</th>
              {{-- <th>LINE表示名 --}}

              </th>
              <th>流入経路</th>
              
              <th>商品名</th>
              <!-- <th>買取方法</th> -->
              <th>希望金額</th>
              <th>ステータス</th>
              <th>振込後</th>
              <th>査定金額</th>
              <th>承認</th>
              <th>登録日時</th>
              <th>代金振込日時</th>
              <th>ユーザーメモ</th>
            </tr>
          </thead>
          <tbody>
            @foreach($items as $item)
            @if($item->user->userData->is_black == 'on')
            <tr class="black">
            @elseif($item->status_total == '査定中')
            <tr class="pink">
            @elseif($item->status_total == '査定完了（買取可）')
            <tr class="blue">
            @else
            <tr class="">
            @endif
              <td>
                {{ $item->id }}
              </td>
              <td>
                <a class="btn-sm btn-danger" href="{{ route('admin.list.contract', $item->id) }}">入力</a>
                @if($item->contract_status)
                <div style="margin:5px auto;"><a class="btn-sm btn-success" target="_balnk" href="{{ route('admin.list.pdf', $item->id) }}">PDF</a></div>
                @endif
              </td>
              <td nowrap>{{ $item->user->name }}</td>
              <td>{{ $item->user->email }}</td>
              {{-- <td>{{ $item->user->display_name }}</td> --}}
              <td>{{ $item->user->from_url }}</td>
              <td>
                <a href="{{ route('admin.list.show', $item->id) }}">
                  {{ $item->item_name }}
                </a>
              </td>

              <td>{{ $item->price }}</td>
              <td>{{ $item->status_total }}</td>
              <td>{{ $item->status_paid }}</td>
              <td>
                @if($item->judge_price)
                {{ $item->judge_price }}円
                @endif
              </td>
              <td>
              @if($item->user_agree)
                <img src="{{ asset('/') }}img/akacheck.png" width="20">
              @endif
              </td>
              <td>{{ $item->created_at }}</td>
              <td>{{ $item->memo }}</td>
              <td>
                <div style="width:200px;height:70px;overflow:auto;border:1px solid #ccc;font-size:12px;">
                {{-- @if($item->user->userData->memo){{ $item->user->userData->memo  }} @else借りパク　センター　会社番号　LINE　SM @endif --}}
                @if($item->user->userData->memo){{ $item->user->userData->memo  }}@endif
                </div>
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