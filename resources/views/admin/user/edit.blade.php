@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ユーザー情報変更</h1>
@stop

@section('content')
{{-- <div class="row">
  <div class="col-md-12">
    @if (session('message'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      {{ session('message') }}
    </div>
    @endif
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
          <div class="col-md-4">
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_4 }}" data-toggle="lightbox" data-title="公共料金の明細など" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_4 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
          </div>
          <div class="col-md-4">
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_5 }}" data-toggle="lightbox" data-title="公共料金の明細など" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_5 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
          </div>
          <div class="col-md-4">
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_6 }}" data-toggle="lightbox" data-title="公共料金の明細など" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_6 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
          </div>
          <div class="col-md-4">
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_7 }}" data-toggle="lightbox" data-title="公共料金の明細など" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_7 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
          </div>
          <div class="col-md-4">
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_8 }}" data-toggle="lightbox" data-title="公共料金の明細など" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_8 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
          </div>
          <div class="col-md-4">
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_9 }}" data-toggle="lightbox" data-title="公共料金の明細など" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_9 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
          </div>
          <div class="col-md-4">
            <a href="{{ asset('/storage/licence') }}/{{ $user->userData->licence_10 }}" data-toggle="lightbox" data-title="公共料金の明細など" data-gallery="gallery">
              <img src="{{ asset('/storage/licence') }}/{{ $user->userData->licence_10 }}" class="img-thumbnail" style="height: 14rem; margin: 1rem;">
            </a>
          </div>



          
        </div>
      </div>
    </div>

  </div>
</div> --}}
<form method="post" action="{{ route('admin.users.update', $user->id) }}">
@csrf
@method('PUT')
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">ユーザー情報</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="">お名前</label>
            <input type="text" class="form-control" id="" name="name" value="{{ $user->name }}">
          </div>
          <div class="form-group">
            <label for="">お名前(カナ)</label>
            <input type="text" class="form-control" id="" name="kana" value="{{ $user->userData->kana }}">
          </div>
          <div class="form-group">
            <label for="">LINE 表示名</label>
            <input type="text" class="form-control" id="" name="display_name" value="{{ $user->display_name }}">
          </div>
          <div class="form-group">
            <label for="">メールアドレス</label>
            <input type="email" class="form-control" id="" name="email" value="{{ $user->email }}">
          </div>
          <div class="form-group">
            <label for="">携帯電話番号</label>
            <input type="tel" class="form-control" id="" name="mobile" value="{{ $user->mobile }}">
          </div>
          {{-- <div class="form-group">
            <label for="">LINE ID</label>
            <input type="text" class="form-control" id="" name="line" value="{{ $user->userData->line }}">
          </div> --}}
          <div class="form-group">
            <label for="">生年月日</label>
            <input type="text" class="form-control" id="" name="birthday" value="{{ $user->userData->birthday }}">
          </div>

          
          <div class="form-group">
            <label for="">性別</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id="c5" value="男性" @if($user->userData->gender == '男性') checked="" @endif>
              <label class="form-check-label" for="c5">男性</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="gender" id="c6" value="女性"  @if($user->userData->gender == '女性') checked="" @endif>
              <label class="form-check-label" for="c6">女性</label>
            </div>
          </div>

          {{-- <div class="form-group">
            <label for="">ご連絡方法</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="contact" id="c1" value="携帯" @if($user->userData->contact == '携帯') checked="" @endif>
              <label class="form-check-label" for="c1">携帯</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="contact" id="c2" value="LINE"  @if($user->userData->contact == 'LINE') checked="" @endif>
              <label class="form-check-label" for="c2">LINE</label>
            </div>
          </div> --}}
          <div class="form-group">
            <label for="">郵便番号</label>
            <input type="tel" class="form-control" id="" name="zip" value="{{ $user->userData->zip }}">
          </div>
          <div class="form-group">
            <label for="">都道府県</label>
            <select class="form-control" name="pref">
              @foreach(config('select_prefs') as $pref)
                <option value="{{ $pref }}" @if( $user->userData->pref == $pref) selected="" @endif>{{ $pref }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="">市区町村</label>
            <input type="text" class="form-control" id="" name="city" value="{{ $user->userData->city }}">
          </div>
          <div class="form-group">
            <label for="">番地以降</label>
            <input type="text" class="form-control" id="" name="address" value="{{ $user->userData->address }}">
          </div>
          <div class="form-group">
            <label for="">ビルマンション名・部屋番号</label>
            <input type="text" class="form-control" id="" name="building" value="{{ $user->userData->building }}">
          </div>
          <div class="form-group">
            <label for="">銀行名</label>
            <input type="text" class="form-control" id="" name="bank_name" value="{{ $user->userData->bank_name }}">
          </div>
          <div class="form-group">
            <label for="">銀行コード</label>
            <input type="text" class="form-control" id="" name="bank_code" value="{{ $user->userData->bank_code }}">
          </div>
          <div class="form-group">
            <label for="">支店名</label>
            <input type="text" class="form-control" id="" name="branch_name" value="{{ $user->userData->branch_name }}">
          </div>
          <div class="form-group">
            <label for="">支店コード</label>
            <input type="text" class="form-control" id="" name="branch_code" value="{{ $user->userData->branch_code }}">
          </div>
          <div class="form-group">
            <label for="">口座種別</label>
            <div class="form-check">
              <input class="form-check-input" type="radio" id="b1" name="bank_type" value="普通" @if($user->userData->bank_type == '普通') checked="" @endif>
              <label class="form-check-label" for="b1">普通</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" id="b2" name="bank_type" value="当座"  @if($user->userData->bank_type == '当座') checked="" @endif>
              <label class="form-check-label" for="b2">当座</label>
            </div>
          </div>
          <div class="form-group">
            <label for="">口座番号</label>
            <input type="text" class="form-control" id="" name="bank_number" value="{{ $user->userData->bank_number }}">
          </div>
          <div class="form-group">
            <label for="">口座名義（カナ）</label>
            <input type="text" class="form-control" id="" name="bank_kana" value="{{ $user->userData->bank_kana }}">
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
    <div class="col-md-6">
      <!-- /.card -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">勤務先情報情報</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="">勤務先名</label>
            <input type="text" class="form-control" id="" name="work_name" value="{{ $user->userData->work_name }}">
          </div>
          <div class="form-group">
            <label for="">勤務先　電話番号</label>
            <input type="tel" class="form-control" id="" name="work_tel" value="{{ $user->userData->work_tel }}">
          </div>
          <div class="form-group">
            <label for="">郵便番号</label>
            <input type="text" class="form-control" id="" name="work_zip" value="{{ $user->userData->work_zip }}">
          </div>
          <div class="form-group">
            <label for="">勤務先 都道府県</label>
            <select class="form-control" name="work_pref">
              @foreach(config('select_prefs') as $pref)
                <option value="{{ $pref }}" @if( $user->userData->work_pref == $pref) selected="" @endif>{{ $pref }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="">勤務先 市区町村</label>
            <input type="text" class="form-control" id="" name="work_city" value="{{ $user->userData->work_city }}">
          </div>
          <div class="form-group">
            <label for="">勤務先 番地以降</label>
            <input type="text" class="form-control" id="" name="work_address" value="{{ $user->userData->work_address }}">
          </div>
          <div class="form-group">
            <label for="">勤務先 ビルマンション名・部屋番号</label>
            <input type="text" class="form-control" id="" name="work_building" value="{{ $user->userData->work_building }}">
          </div>
          <div class="form-group">
            <label for="">月額給与額</label>
            <input type="text" class="form-control" id="" name="salary" value="{{ $user->userData->salary }}">
          </div>
          <div class="form-group">
            <label for="">給料日</label>
            <input type="text" class="form-control" id="" name="payday" value="{{ $user->userData->payday }}">
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
      <div class="card">
        <div class="card-body">
          <input type="hidden" name="item" value="{{ $request->item }}">
          <input type="submit" name="" class="btn btn-primary" value="変更">
        </div>
      </div>
    </div>
  </div>
</form>
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


