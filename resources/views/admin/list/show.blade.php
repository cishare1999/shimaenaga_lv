@extends('adminlte::page')

@section('title', '買取詳細')

@section('content_header')
    <h1>買取詳細</h1>
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

  @if($user->userData->is_black)
  <div class="col-md-12">
    <div class="callout callout-danger">
      <p>このユーザーはブラックです</p>
    </div>
  </div>
  @endif 
</div>

<div class="row">

  <div class="col-md-4">
    <div class="card callout callout-info" style="height:98%;">
      <div class="card-header">
        <h3 class="card-title"><b>買取情報</b></h3>
      </div>
      <div class="card-body p-0">
        <div class="row">
          <div class="col-md-12">
            <table class="table table-sm mb-0">
              <colgroup>
                <col style="width:7rem;">
                <col style="">
              </colgroup>
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
                  <th>希望金額</th>
                  <td>
                    {{ $item->price }}
                    @if($item->price_more)({{ $item->price_more }})@endif
                  </td>
                </tr>
                <tr>
                  <th>商品説明</th><td>{{ $item->comment }}</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>
      <hr>
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
  @include('admin.block.api')
  @yield('api')
</div>
</div>
{{-- @endif     --}}

{{-- @if(!empty($reports)) --}}
<div class="row">
<div class="col-md-12">
  @include('admin.block.img_disp')
  @yield('img_disp')
</div>
</div>
{{-- @endif     --}}






<div class="row">
  <div class="col-md-8">

    <div class="card callout callout-success">
      <div class="card-header">
        <h3 class="card-title">ユーザー情報</h3>
        <div class="card-tools">
          <a class="btn btn-info btn-sm" href="{{ route('admin.users.edit', $user->id) }}?item={{ $item->id }}">ユーザー情報修正</a>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="row">
          <div class="col-md-6">
            <table class="table table-sm mb-0">
              <colgroup>
                <col style="width:10rem;">
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
              </tbody>
            </table>
          </div>
          <div class="col-md-6">
            <table class="table table-sm mb-0">
              <colgroup>
                <col style="width:7rem;">
                <col style="">
              </colgroup>
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
                <th>流入経路</th><td>{{ $user->from_url }}</td>
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
                <th>口座名義</th><td>{{ $user->userData->bank_kana }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="card callout callout-info">
      <div class="card-header">
        <h3 class="card-title">勤務先情報</h3>
      </div>
      <div class="card-body p-0">
        <div class="row">
          <div class="col-md-12">
            <table class="table table-sm mb-0">
              <colgroup>
                <col style="width:14rem;">
                <col style="">
              </colgroup>
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
                  <th>勤務先 所在地</th><td>{{ $user->userData->work_pref }}{{ $user->userData->work_city }}{{ $user->userData->work_address }} {{ $user->userData->work_building }}</td>
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
        </div>
      </div>
    </div>
    <div class="card callout callout-info">
      <div class="card-header">
        <h3 class="card-title">申込み履歴</h3>
      </div>
      <div class="card-body p-0">
        <div class="row">
          <div class="col-md-12">
            <table class="table table-sm mb-0">
              <tbody>
                <tr>
                  <th>#</th>
                  <th>商品名</th>
                  <th>買取方法</th>
                  <th>希望金額</th>
                  <th>ステータス</th>
                  <th>振込後</th>
                  <th>商品の額面</th>
                  <th>承認</th>
                  <th>登録日時</th>
                </tr>
                @foreach($userlist as $list)
                <tr>
                  <td>{{ $list->id }}</td>
                  <td>
                    @if($list->id == $item->id)
                      {{ $list->item_name }}
                    @else
                      <a href="{{ route('admin.list.show', $list->id) }}">{{ $list->item_name }}</a>
                    @endif
                  </td>
                  <td>{{ $list->way }}</td>
                  <td>{{ $list->price }}</td>
                  <td>{{ $list->status_total }}</td>
                  <td>{{ $list->status_paid }}</td>
                  <td>
                    @if($list->judge_price)
                    {{ $list->judge_price }}円
                    @endif
                  </td>
                  <td>{{ $list->user_agree }}</td>
                  <td>{{ $list->created_at }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


    <div class="card callout callout-warning">
      <div class="card-header">
        <h3 class="card-title">契約書情報</h3>
        @if($item->contract_status)
        <div style="margin:auto;float:right;"><a class="btn btn-success" target="_balnk" href="{{ route('admin.list.pdf', $item->id) }}">PDF</a></div>
        @endif
      </div>
      <form action="{{ route('admin.items.contract', $item->id) }}?page=showlist" method="post">
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
  <div class="col-md-4">
    <form action="{{ route('admin.users.status', $user->id) }}?item={{ $item->id }}" method="post">
      @csrf
      <div class="card callout callout-warning">
        <div class="card-header">
          <h3 class="card-title">ユーザーステータス</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">  
          <div class="form-group">
            <label for="">【緊急連絡先１】</label>
            <div class="input-group">
              <div class="input-group-append"><div class="input-group-text">TEL</div></div>
              <input type="tel" class="form-control" name="emergency_1" placeholder="半角数字で入力" value="{{ $user->userData->emergency_1 }}">
            </div>
          </div>
          <div class="form-group">
            <label for="">【緊急連絡先２】</label>
            <div class="input-group">
              <div class="input-group-append"><div class="input-group-text">TEL</div></div>
              <input type="tel" class="form-control" name="emergency_2" placeholder="半角数字で入力" value="{{ $user->userData->emergency_2 }}">
            </div>
          </div>

          <div class="form-group">
            <label>メモ</label>
            {{-- <textarea id="kanri_memo" class="form-control" rows="8" name="memo" placeholder="">@if($user->userData->memo){!! $user->userData->memo !!} @else借りパク　センター　会社番号　LINE　SM @endif</textarea> --}}
            <textarea id="kanri_memo" class="form-control" rows="8" name="memo" placeholder="">@if($user->userData->memo){!! $user->userData->memo !!}@endif</textarea>
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

    <div class="card callout callout-warning">
      <div class="card-header">
        <h3 class="card-title">買取ステータス</h3>
      </div>
      
      <form action="{{ route('admin.items.status', $item->id) }}" method="post">
        @csrf
        <div class="card-body">
          @if($item->status_judge)
          <div class="" style="font-size: 10px;">
            {{ $item->status_judge }} / {{ $item->status_payment }} / {{ $item->status_item }}
          </div>
          @endif
          <div class="form-group">
            <label for="">査定ステータス</label>
            <select class="form-control" name="status_total">
              <option value="">選択してください</option>
              <option value="査定中" @if($item->status_total == '査定中') selected="" @endif>査定中</option>
              <option value="保留" @if($item->status_total == '保留') selected="" @endif>保留</option>
              <option value="書類不備" @if($item->status_total == '書類不備') selected="" @endif>書類不備</option>
              <option value="本人キャンセル" @if($item->status_total == '本人キャンセル') selected="" @endif>本人キャンセル</option>
              <option value="査定完了（買取不可）" @if($item->status_total == '査定完了（買取不可）') selected="" @endif>査定完了（買取不可）</option>
              <option value="ケリ" @if($item->status_total == 'ケリ') selected="" @endif>ケリ</option>
              <option value="詐欺" @if($item->status_total == '詐欺') selected="" @endif>詐欺</option>
              <option value="査定完了（買取可）" @if($item->status_total == '査定完了（買取可）') selected="" @endif>査定完了（買取可）</option>
              <option value="代金振込済" @if($item->status_total == '代金振込済') selected="" @endif>代金振込済</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">【買取金額】※マイページでは査定金額</label>
            <div class="input-group">
              <input type="tel" class="form-control" name="judge_price" placeholder="半角数字で入力" value="{{ $item->judge_price }}">
              <div class="input-group-append"><div class="input-group-text">円</div></div>
            </div>
          </div>
          <div class="form-group">
            <label for="">【商品の額面】</label>
            <div class="input-group">
              <input type="tel" class="form-control" name="contract_cancel" placeholder="半角数字で入力" value="{{ $item->contract_cancel }}">
              <div class="input-group-append"><div class="input-group-text">円</div></div>
            </div>
          </div>
          <div class="form-group">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>項目</th>
                  <th>状態</th>
                  <th>操作 / 詳細</th>
                </tr>
              </thead>
              <tbody>

                {{-- 買取同意（追加） --}}
                <tr>
                  <td><span style="color:red;">新</span> 買取同意</td>
                  <td>
                    @if(!empty($item->agreement_signed_at))
                      <span class="badge bg-success">入力済み</span><br>
                      <small class="text-muted">{{ $item->agreement_signed_at }}</small>
                    @else
                      <span class="badge bg-secondary">未入力</span>
                    @endif
                  </td>
                  <td>
                    @if(!empty($item->agreement_url))
                      <a href="{{ $item->agreement_url }}" target="_blank" rel="noopener"
                        class="btn btn-sm btn-outline-primary">
                        同意書を確認
                      </a>
                    @else
                      <span class="text-muted">—</span>
                    @endif

                    {{-- 任意：同意をリセットする運用がある場合 --}}
                    {{--
                    @if(!empty($item->agreement_signed_at))
                      <div class="form-check mt-2">
                        <input type="checkbox" class="form-check-input" id="reset_agreement" name="reset_agreement">
                        <label class="form-check-label" for="reset_agreement">同意情報リセット</label>
                      </div>
                    @endif
                    --}}
                  </td>
                </tr>

                {{-- 査定承認（既存） --}}
                <tr>
                  <td><span style="color:red;">旧</span> 査定承認</td>
                  <td>
                    @if($item->user_agree)
                      <span style="color:red;">{{ $item->user_agree }}</span>
                    @else
                      未承認
                      <input type="hidden" name="reset_agree">
                    @endif
                  </td>
                  <td>
                    @if($item->user_agree)
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="agree" name="reset_agree">
                        <label class="form-check-label" for="agree">承認解除</label>
                      </div>
                    @endif
                  </td>
                </tr>



              </tbody>
            </table>
          </div>

          <div class="form-group">
            <label for="">振込後ステータス</label>
            <select class="form-control" name="status_paid">
              <option value="">選択してください</option>
              <option value="商品到着待" @if($item->status_paid == '商品到着待') selected="" @endif>商品到着待</option>
              <option value="取引完了" @if($item->status_paid == '取引完了') selected="" @endif>取引完了</option>
              <option value="取引完了遅延" @if($item->status_paid == '取引完了遅延') selected="" @endif>取引完了遅延</option>
              <option value="商品到着済" @if($item->status_paid == '商品到着済') selected="" @endif>商品到着済</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">ユーザー向けメモ</label>
            <textarea class="form-control" rows="8" name="for_user" placeholder="">{!! $item->for_user !!}</textarea>
            
          </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">変更</button>
        </div>
      </form>
    </div>
{{-- 
    <form action="{{ route('admin.users.mailline', $user->id) }}?item={{ $item->id }}" method="post">
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

    <form action="{{ route('admin.users.mailcancel', $user->id) }}?item={{ $item->id }}" method="post">
      @csrf
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">断りメール送信</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">       
          <div class="form-group">
            <label>以下の内容のメールを送信します。</label>
            <textarea class="form-control" rows="6" name="mailline" placeholder="">
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
  .callout a {
    text-decoration: none;
    color:inherit;
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

  $(function () {
    $(document).on('click', '#con_btn', function(event) {
      if(confirm('契約書情報を登録します。よろしいですか？')){
        return true;
      }else{
        return false;
      }
    });
  })
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


