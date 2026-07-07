@section('api')

<div class="card callout callout-danger">
  <div class="card-header">
    <h3 class="card-title">他店情報</h3>
  </div>
  <div class="card-body">
    <div class="row" style="max-height:400px;overflow:auto;">
      <div id="ajax_loader"></div>
      <div id="ajax_result"></div>

    </div>
  </div>
</div><!-- //card -->

<style>
  #ajax_result{
    width:100%;
    position: relative;
  }
  #ajax_loader {
      display: none;
      border: 8px solid #f3f3f3;
      border-top: 8px solid #dd3459;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      animation: spin 1s linear infinite;
      position: absolute;
      top: 50%;
      left: 50%;
      margin-top: -25px;
      margin-left: -25px;
  }
  @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
  }
</style>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    showLoader(); // ローダー表示
    var kana = "{{ $user->userData->kana }}";
    var birthday = "{{ date('Ymd', strtotime($user->userData->birthday)) }}";

    axios.get(`/api/fetch-data/${kana}/${birthday}`)
        .then(function (response) {
            // console.log(response.data);
            hideLoader(); // ローダー非表示
            var inhtml = '<table class="table table-striped">' +
                          '<thead>' +
                          '<tr>' +
                          '<th>店名</th>' + 
                          '<th>支店</th>' + 
                          '<th>サービス利用日</th>' + 
                          '<th>送金金額</th>' + 
                          '<th>ステータス</th>' + 
                          '<th>入金日</th>' + 
                          '<th>入金金額</th>' + 
                          '<th>状況</th>' + 
                          '</tr>' + 
                          '</thead>' + 
                          '<tbody id="reports">';

            var outhtml = '</tbody>' +
                          '</table>';

            var src = response.data.map(function(i){
                if(i.judge_price == null){
                  var j_price = '';
                }else{
                  var j_price = i.judge_price;
                }
                if(i.status_paid == null){
                  var s_paid = '-';
                }else{
                  var s_paid = i.status_paid;
                }
                var now = new Date(i.created_at);
                var yy = now.getFullYear();
                var mm = now.getMonth() + 1;
                var dd = now.getDate();
                var h = now.getHours();
                var m = now.getMinutes();
                var c_at = yy+'/'+mm+'/'+dd+' '+h+':'+m;
                //自分の表示をなくす
                if(i.shop != 'SN'){
                  return '<tr>' +
                  '<td>' + i.shop + '</td>' +
                  '<td>' + i.services + '</td>' +
                  '<td>' + c_at + '</td>' +
                  '<td>' + j_price + '</td>' +
                  '<td>' + i.status_total + '</td>' +
                  '<td>' + i.pay_in + '</td>' +
                  '<td>' + i.pay_total + '</td>' +
                  '<td>' + s_paid + '</td>' +
                  '</tr>';
                }

            })
            .join('');
            var allhtml = inhtml + src + outhtml;
            // console.log(allhtml);
            document.getElementById('ajax_result').innerHTML = allhtml;
        })
        .catch(function (error) {
            console.error(error);
            hideLoader(); // エラーの場合もローダー非表示
        });
});

function showLoader() {
    document.getElementById('ajax_loader').style.display = 'block';
}

function hideLoader() {
    document.getElementById('ajax_loader').style.display = 'none';
}
</script>


@endsection