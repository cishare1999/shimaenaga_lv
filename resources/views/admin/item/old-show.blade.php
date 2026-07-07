@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>買取希望詳細</h1>
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
  </div>
</div>

<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-body p-0">
        <table class="table table-sm">
          <tbody>
            <tr>
              <th>買取方法</th><td>{{ $item->way }}</td>
            </tr>
            <tr>
              <th>商品名</th><td>{{ $item->item_name }}</td>
            </tr>
            <tr>
              <th>商品状態</th><td>{{ $item->condition }}</td>
            </tr>
            <tr>
              <th>商品説明</th><td>{{ $item->comment }}</td>
            </tr>
            <tr>
              <th>希望金額</th><td>{{ $item->price }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="card">
      <div class="card-body p-0">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">商品画像</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="row">
              <div class="col-md-4">
                <a href="{{ asset('/storage/image') }}/{{ $item->item_image1 }}" data-toggle="lightbox" data-title="商品画像１" data-gallery="gallery">
                  <img src="{{ asset('/storage/image') }}/{{ $item->item_image1 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
                </a>
              </div>
              <div class="col-md-4">
                <a href="{{ asset('/storage/image') }}/{{ $item->item_image2 }}" data-toggle="lightbox" data-title="商品画像２" data-gallery="gallery">
                  <img src="{{ asset('/storage/image') }}/{{ $item->item_image2 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
                </a>
              </div>
              <div class="col-md-4">
                <a href="{{ asset('/storage/image') }}/{{ $item->item_image3 }}" data-toggle="lightbox" data-title="商品画像３" data-gallery="gallery">
                  <img src="{{ asset('/storage/image') }}/{{ $item->item_image3 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <form action="{{ route('admin.items.status', $item->id) }}" method="post">
      @csrf
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">買取ステータス</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @if($user->userData->is_black)
          <p>このユーザーはブラックです</p>
          @endif          
          
          <div class="form-group">
            <label for="">査定ステータス</label>
            <select class="form-control" name="status_judge">
              <option>選択してください</option>
              <option value="査定中" @if($item->status_judge == '査定中') selected="" @endif>査定中</option>
              <option value="必要情報不備" @if($item->status_judge == '必要情報不備') selected="" @endif>必要情報不備</option>
              <option value="査定完了（買取可）" @if($item->status_judge == '査定完了（買取可）') selected="" @endif>査定完了（買取可）</option>
              <option value="査定完了（買取不可）" @if($item->status_judge == '査定完了（買取不可）') selected="" @endif>査定完了（買取不可）</option>

            </select>
          </div>

          <div class="form-group">
            <label for="">支払いステータス</label>
            <select class="form-control" name="status_payment">
              <option>選択してください</option>
              <option value="支払い前" @if($item->status_payment == '支払い前') selected="" @endif>支払い前</option>
              <option value="振込準備" @if($item->status_payment == '振込準備') selected="" @endif>振込準備</option>
              <option value="必要情報不備" @if($item->status_payment == '必要情報不備') selected="" @endif>必要情報不備</option>
              <option value="振込済" @if($item->status_payment == '振込済') selected="" @endif>振込済</option>
            </select>
          </div>

          <div class="form-group">
            <label for="">商品ステータス</label>
            <select class="form-control" name="status_item">
              <option>選択してください</option>
              <option value="商品到着待ち" @if($item->status_item == '商品到着待ち') selected="" @endif>商品到着待ち</option>
              <option value="到着済（OK）" @if($item->status_item == '到着済（OK）') selected="" @endif>到着済（OK）</option>
              <option value=" 到着済（NG）" @if($item->status_item == '到着済（NG）') selected="" @endif>到着済（NG）</option>
            </select>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">変更</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">身分証画像</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="row">
          <div class="col-md-4">
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_1 }}" data-toggle="lightbox" data-title="身分証（表）" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_1 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
          </div>
          <div class="col-md-4">
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_2 }}" data-toggle="lightbox" data-title="身分証（裏）" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_2 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
          </div>
          <div class="col-md-4">
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_3 }}" data-toggle="lightbox" data-title="身分証（セルフィー）" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_3 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">ユーザー情報</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table table-sm">
          <tbody>
            <tr>
              <th>お名前</th>
              <td>
                <a href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a>
              </td>
            </tr>
            <tr>
              <th>お名前(カナ)</th><td>{{ $user->userData->kana }}</td>
            </tr>
            <tr>
              <th>メールアドレス</th><td>{{ $user->email }}</td>
            </tr>
            <tr>
              <th>携帯電話番号</th><td>{{ $user->mobile }}</td>
            </tr>
            <tr>
              <th>LINE ID</th><td>{{ $user->userData->line }}</td>
            </tr>
            <tr>
              <th>ご連絡方法</th><td>{{ $user->userData->contact }}</td>
            </tr>
            <tr>
              <th>郵便番号</th><td>〒{{ $user->userData->zip }}</td>
            </tr>
            <tr>
              <th>都道府県</th><td>{{ $user->userData->pref }}</td>
            </tr>
            <tr>
              <th>市区町村</th><td>{{ $user->userData->city }}</td>
            </tr>
            <tr>
              <th>番地以降</th><td>{{ $user->userData->address }}</td>
            </tr>
            <tr>
              <th>ビルマンション名・部屋番号</th><td>{{ $user->userData->building }}</td>
            </tr>
            <tr>
              <th>銀行名</th><td>{{ $user->userData->bank_name }}({{ $user->userData->bank_code }})</td>
            </tr>
            <tr>
              <th>支店名</th><td>{{ $user->userData->branch_name }}({{ $user->userData->branch_code }})</td>
            </tr>
            <tr>
              <th>口座種別</th><td>{{ $user->userData->bank_type }}</td>
            </tr>
            <tr>
              <th>口座番号</th><td>{{ $user->userData->bank_number }}</td>
            </tr>
            <tr>
              <th>口座名義（カナ）</th><td>{{ $user->userData->bank_kana }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">勤務先情報情報</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table table-sm">
          <tbody>

            <tr>
              <th>勤務先名</th><td>{{ $user->userData->work_name }}</td>
            </tr>
            <tr>
              <th>勤務先 電話番号</th><td>{{ $user->userData->work_tel }}</td>
            </tr>
            <tr>
              <th>勤務先 郵便番号</th><td>〒{{ $user->userData->work_zip }}</td>
            </tr>
            <tr>
              <th>勤務先 都道府県</th><td>{{ $user->userData->work_pref }}</td>
            </tr>
            <tr>
              <th>勤務先 市区町村</th><td>{{ $user->userData->work_city }}</td>
            </tr>
            <tr>
              <th>勤務先 番地以降</th><td>{{ $user->userData->work_address }}</td>
            </tr>
            <tr>
              <th>勤務先 ビルマンション名・部屋番号</th><td>{{ $user->userData->work_building }}</td>
            </tr>
            <tr>
              <th>月額給与額</th><td>{{ $user->userData->salary }}</td>
            </tr>
            <tr>
              <th>給料日</th><td>{{ $user->userData->payday }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <div class="col-md-6">
    <form action="{{ route('admin.items.memo', $item->id) }}" method="post">
      @csrf
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">ステータス・メモ</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">          
          <div class="form-group">
            <label>メモ</label>
            <textarea class="form-control" rows="8" name="memo" placeholder="">{!! $user->userData->memo !!}</textarea>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <button type="submit" class="btn btn-primary">登録</button>
        </div>
      </div>
    </form>
  </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ==" crossorigin="anonymous" />
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js" integrity="sha512-Y2IiVZeaBwXG1wSV7f13plqlmFOx8MdjuHyYFVoYzhyRr3nH/NMDjTBSswijzADdNzMyWNetbLMfOpIPl6Cv9g==" crossorigin="anonymous"></script>
<script type="text/javascript">
  
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });
  })
</script>
@stop


