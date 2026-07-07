@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ユーザー詳細</h1>
@stop

@section('content')
@if (session('message'))
<div class="alert alert-success alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  {{ session('message') }}
</div>
@endif

  @if($user->userData->is_black)
  <div class="col-md-12">
    <div class="callout callout-danger">
      <p>このユーザーはブラックです</p>
    </div>
  </div>
  @endif 


  <div class="row">

    <div class="col-md-4">
      <div class="card callout callout-info" style="height:98%;">

        <div class="card-header">
          <h3 class="card-title"><b>簡易ユーザー情報</b></h3>
        </div>
        <div class="card-body p-0">
          <table class="table table-sm mb-0">
            <colgroup>
              <col style="width:7rem;">
              <col style="">
            </colgroup>
            <tbody>
              <tr>
                <th>お名前</th><td>{{ $user->name }}</td>
              </tr>
              <tr>
                <th>お名前(カナ)</th><td>{{ $user->userData->kana }}</td>
              </tr>
              <tr>
                <th>生年月日</th><td>{{ $user->userData->birthday }} {{ Functions::ageFunc($user->userData->birthday) }}</td>
              </tr>
              <tr>
                <th>LINE 表示名</th><td>{{ $user->display_name }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  

  
    {{-- @if(!empty($reports)) --}}
    <div class="col-md-4">
      @include('admin.block.send_msg')
      @yield('send_msg')
    </div>
    {{-- @endif  --}}
  
    
    {{-- @if(!empty($reports)) --}}
    <div class="col-md-4">
      @include('admin.block.chat')
      @yield('chat')
    </div>
    {{-- @endif  --}}
  
  </div>



{{-- @if(!empty($reports)) --}}
<div class="row">
<div class="col-md-12">
  @include('admin.block.img_disp')
  @yield('img_disp')
</div>
</div>
{{-- @endif     --}}

{{-- @if(!empty($reports)) --}}
<div class="row">
<div class="col-md-12">
  @include('admin.block.api')
  @yield('api')
</div>
</div>
{{-- @endif     --}}



<div class="row">
  <div class="col-md-6">

    <div class="card callout callout-info">
      <div class="card-header">
        <h3 class="card-title">ユーザー情報</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table table-sm">
          <tbody>
            <tr>
              <th>お名前</th><td>{{ $user->name }}</td>
            </tr>
            <tr>
              <th>お名前(カナ)</th><td>{{ $user->userData->kana }}</td>
            </tr>
            <tr>
              <th>LINE取引ID</th><td>{{ $user->line_id }}</td>
            </tr>
            <tr>
              <th>LINE 表示名</th><td>{{ $user->display_name }}</td>
            </tr>
            <tr>
              <th>LINE 状態</th><td>{{ $user->mode }}</td>
            </tr>
            <tr>
              <th>生年月日</th><td>{{ $user->userData->birthday }} {{ Functions::ageFunc($user->userData->birthday) }}</td>
            </tr>
            <tr>
              <th>メールアドレス</th><td>{{ $user->email }}</td>
            </tr>
            <tr>
              <th>携帯電話番号</th><td>{{ $user->mobile }}</td>
            </tr>
            {{-- <tr>
              <th>LINE ID</th><td>{{ $user->userData->line }}</td>
            </tr> --}}

            <tr>
              <th>性別</th><td>{{ $user->userData->gender }}</td>
            </tr>
            {{-- <tr>
              <th>ご連絡方法</th><td>{{ $user->userData->contact }}</td>
            </tr> --}}
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
              <th>全住所</th>
              <td>{{ $user->userData->pref }}{{ $user->userData->city }}{{ $user->userData->address }}{{ $user->userData->building }}</td>
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





  </div>
  <div class="col-md-6">
    <div class="card callout callout-info">
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

    <form action="{{ route('admin.users.status', $user->id) }}?page=users" method="post">
      @csrf
      <div class="card callout callout-warning">
        <div class="card-header">
          <h3 class="card-title">ユーザーステータス</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">       
          <div class="form-group">
            <label>メモ</label>
            <textarea id="kanri_memo" class="form-control" rows="8" name="memo" placeholder="">{!! $user->userData->memo !!}</textarea>
            <a id="memo_date_btn" href="#">[メモに日時を入れる]</a>
          </div>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="is_black" name="is_black"　@if($user->userData->is_black) checked @endif>
              <label class="form-check-label" for="is_black">ブラック登録</label>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">変更</button>
        </div>
      </div>
    </form>

{{-- 

    <form action="{{ route('admin.users.mailline', $user->id) }}?page=users" method="post">
      @csrf
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">LINEメール送信</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">       
          <div class="form-group">
            <label>以下の内容のメールを送信します。</label>
            <textarea class="form-control" rows="6" name="mailline" placeholder="">
この度は買取シマエナガにお申込頂きありがとうございます。
今後のやり取りをスムーズに行う為にLINE登録をお願い致します。
{{config('app.com_line')}}
            </textarea>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" id="mailline_btn" class="btn btn-primary">LINEメール送信</button>
        </div>
      </div>
    </form>

    <form action="{{ route('admin.users.mailcancel', $user->id) }}?page=users" method="post">
      @csrf
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">断りメール送信</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">       
          <div class="form-group">
            <label>以下の内容のメールを送信します。</label>
            <textarea class="form-control" rows="6" name="cancelmail" placeholder="">
買取シマエナガにお申込み頂きありがとうございます。

総合判断の結果、今回のお取引·買取はお見送りとさせていただきます。
お力になれず申し訳ございません。

以上、宜しくお願い致します。
            </textarea>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" id="mailcancel_btn" class="btn btn-primary">断りメール送信</button>
        </div>
      </div>
    </form> --}}


  </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ==" crossorigin="anonymous" />
<link rel="stylesheet" href="{{ asset('/') }}vendor/adminlte/dist/css/line_style.css" media="all">
<style>
ul.line_img_list{
  width:95%;
  display: flex;
  justify-content: flex-start;
  align-content: center;
  flex-wrap: wrap;
  list-style:none;
  gap:10px;
  margin:0 auto;
  padding:10px 0 10px;
}
ul.line_img_list li{
  width:18%;
}
ul.line_img_list li img{
  width:100%;
  height:140px;
  object-fit: cover;
}

</style>
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

  $(function () {
    $(document).on('click', '#mailline_btn', function(event) {
      if(confirm('LINEメールを送信します。よろしいですか？')){
        return true;
      }else{
        return false;
      }
    });
  })
  $(function () {
    $(document).on('click', '#mailcancel_btn', function(event) {
      if(confirm('断りメールを送信します。よろしいですか？')){
        return true;
      }else{
        return false;
      }
    });
  })
  $(function () {
    $(document).on('click', '#memo_date_btn', function(event) {
      event.preventDefault();
      var now = new Date();
      var yy = now.getFullYear();
      var mm = now.getMonth() + 1;
      var dd = now.getDate();
      var h = now.getHours();
      var m = now.getMinutes();
      var s = now.getSeconds();
      var ima = '['+yy+'/'+mm+'/'+dd+' '+h+':'+m+']';
      var momo = $('#kanri_memo').val();
      $('#kanri_memo').val(momo+ima);
    });
  })
  //2023.07.21 add LINEへのメッセージ送信定型文SELECT変更
  $(function () {
    $(document).on('change', '#line_send_title', function(event) {
      var sl = $('#line_send_title').val();
      var cm = $('#sentence_id_'+sl).val();

      $('#line_send_msg').val("");
      $('#line_send_msg').val(cm);
      // console.log(cm);
    });
  })
  $(function() {
    $(window).on("load",function() {
      // スクロール対象のエリアのIDを指定
      var scrollAreaId = '#scin';

      // スクロール対象のエリアの要素を取得
      var $scrollArea = $(scrollAreaId);

      // スクロール位置を一番下に設定
      var maxHeight = $scrollArea[0].scrollHeight - $scrollArea.outerHeight();
      $scrollArea.scrollTop(maxHeight);
    })
  });

</script>
@stop
