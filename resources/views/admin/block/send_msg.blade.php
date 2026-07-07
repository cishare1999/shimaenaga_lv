@section('send_msg')
<div class="card callout callout-warning" style="height:98%;">
  <div class="card-header">
    <h3 class="card-title">LINEメッセージの送信</h3>
  </div>
  <form action="{{ route('admin.users.line_sending', $user->id) }}" method="post">
    @csrf
    <input type="hidden" name="item_id" value="@if($item){{ $item->id }}@endif">
    <div class="card-body">
      <div class="form-group">
        <label for="">定型文タイトル</label><br>
        <label style="color:red;font-size:12px;">※定型文にない文章を送信する場合は「そのまま」を選択してください。送信文章を変更することでその文章をそのまま送信できます。</label>
        <select class="form-control" name="line_send_title" id="line_send_title">
          <option value="999">そのまま</option>
          @foreach($sendtext as $val)
          <option value="{{ $val->id }}">{{ $val->send_title}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="">送信文章</label>
        <textarea class="form-control" rows="12" name="line_send_msg" id="line_send_msg" placeholder=""></textarea>
        
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-success">送 信</button>
    </div>
  </form>
  @foreach($sendtext as $val)
  <input type="hidden" id="sentence_id_{{ $val->id }}" value="{{ $val->sentence}}">
  @endforeach
</div>
@endsection