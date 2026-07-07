<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="Content-Style-type" content="text/css; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>買取同意フォーム</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <style>
    body { font-family: -apple-system, BlinkMacSystemFont, "Helvetica Neue", "YuGothic", "メイリオ", sans-serif; padding: 10px; }
    .client_tb { width: 100%; border-collapse: collapse; }
    .client_tb th, .client_tb td { border: 1px solid #ccc; padding: 8px; font-size: 14px; vertical-align: top; }
    .client_tb th { background: #f5f5f5; width: 30%; }
    .midashi_th { background: #333; color: #fff; text-align: center; }
    .loading { position: fixed; inset: 0; background: rgba(255,255,255,0.7); display: flex; align-items: center; justify-content: center; z-index: 9999; }
    .loading.is-hide { display: none; }
    .loading_icon { width: 40px; height: 40px; border-radius: 50%; border: 4px solid #ccc; border-top-color: #333; animation: spin 1s linear infinite; }
    @keyframes spin { to { transform: rotate(360deg); } }

    .terms-box { border: 1px solid #ccc; height: 150px; overflow-y: scroll; padding: 8px; background: #fafafa; font-size: 12px; }
    .Form-Item { margin-top: 8px; font-size: 13px; }
    .disabled-label { color: #aaa; }
    .line-submit { width: 100%; padding: 12px; background: #06c755; color: #fff; border: none; border-radius: 4px; font-size: 16px; margin-top: 16px; }
    .line-submit:disabled { background: #ccc; }

    #signature-pad { border: 1px solid #ccc; border-radius: 4px; }
    #signature-pad canvas { width: 100%; height: 200px; }
    .sig-btn { margin-top: 5px; padding: 5px 10px; font-size: 12px; }

    .alert.alert-danger { margin-top: 10px; color: #c00; font-size: 13px; display:none; }
    #agreement_form_wrap {
      display: none;
    }

    .body-loading {
      overflow: hidden;
    }


  </style>
</head>
<body>
  <div class="loading is-hide">
    <div class="loading_icon"></div>
  </div>

  <ul id="cation_msg"></ul>

  <div id="agreement_form_wrap">
  <form id="line-form" method="POST" action="{{ route('line.agreement.submit') }}">
    <h1 style="font-size:18px;text-align:center;">買取同意フォーム</h1>
    @csrf

    {{-- item_id は 1つだけ（LIFF モードで後からセット） --}}
    <input type="hidden" name="item_id" id="item_id"
       value="{{ (!$isLiffMode && $item) ? $item->id : '' }}">

    <table class="client_tb">


      <tr>
        <td colspan="2">
          {{-- 同意契約の文章　新規とリピートで出し分け --}}
          @if(!$isLiffMode)
            @if($is_repeat)
              @include('line.block.repeat_agreement_text')
            @else
              @include('line.block.first_agreement_text')
            @endif
          @endif
        </td>
      </tr>


      <tr><th colspan="2">お申込情報</th></tr>
      <tr>
        <th>買取申込ID</th>
        <td>{{ !$isLiffMode ? $item->id : '' }}</td>
      </tr>
      <tr>
        <th>お名前</th>
        <td>{{ !$isLiffMode ? optional($user)->name : '' }}</td>
      </tr>
      <tr>
        <th>商品名</th>
        <td>{{ !$isLiffMode ? $item->item_name : '' }}</td>
      </tr>
      <tr>
        <th>買取方法</th>
        <td>{{ !$isLiffMode ? $item->way : '' }}</td>
      </tr>
      <tr>
        <th>査定額</th>
        <td>{{ !$isLiffMode ? $finalAmount : '' }}</td>
      </tr>

      <tr><th colspan="2">ご本人情報（一部抜粋）</th></tr>
      <tr>
        <th>電話番号</th>
        <td>{{ !$isLiffMode ? optional($user)->mobile : '' }}</td>
      </tr>
      <tr>
        <th>ご住所</th>
        <td>
          @if(!$isLiffMode)
            {{ optional($userData)->zip }}
            {{ optional($userData)->pref }}
            {{ optional($userData)->city }}
            {{ optional($userData)->address }}
            {{ optional($userData)->building }}
          @endif
        </td>
      </tr>
      <tr>
        <th>振込口座</th>
        <td>
          @if(!$isLiffMode)
            {{ optional($userData)->bank_name }}
            {{ optional($userData)->branch_name }} ({{ optional($userData)->branch_code }})<br>
            {{ optional($userData)->bank_type }} {{ optional($userData)->bank_number }} {{ optional($userData)->bank_kana }}
          @endif
        </td>
      </tr>

      <tr><th colspan="2">買取同意内容</th></tr>
      <tr>
        <th colspan="2">利用規約</th>
      </tr>
      <tr>
        <td colspan="2">
          <div class="terms-box" id="terms_box">
            {!! config('terms') !!}
          </div>
          <div class="Form-Item" align="left">
            <input type="checkbox" id="agree_terms" name="agree_terms" disabled>
            <label for="agree_terms" id="agree_terms_label" class="disabled-label">（スクロールを最後まで読むとチェックできます）利用規約に同意する</label>
          </div>
        </td>
      </tr>

      <tr>
        <th colspan="2">同意チェック</th>
      </tr>
      <tr>
        <td colspan="2">
          <div class="Form-Item"><input type="checkbox" id="agree_accurate" name="agree_accurate"> <label for="agree_accurate">上記内容及び提出資料が正確であることを確認します。</label></div>
          <div class="Form-Item"><input type="checkbox" id="agree_ownership" name="agree_ownership"><label for="agree_ownership">取引する商品は自分が所有している商品です。</label></div>
          <div class="Form-Item"><input type="checkbox" id="agree_deliver" name="agree_deliver"><label for="agree_deliver">商品を引渡す意向があります。（その意向がないのに申込む行為は詐欺罪に該当する行為です。）</label></div>
          <div class="Form-Item"><input type="checkbox" id="agree_antisocial" name="agree_antisocial"> <label for="agree_antisocial">私は反社会的勢力に該当しません。</label></div>
          <div class="Form-Item"><input type="checkbox" id="agree_sell" name="agree_sell"> <label for="agree_sell">上記内容で買取に同意します。</label></div>
        </td>
      </tr>

      <tr>
        <th colspan="2">署名欄</th>
      </tr>
      <tr>
        <td colspan="2">
          <div id="signature-pad"><canvas></canvas></div>
          <button type="button" id="clear-signature" class="sig-btn">署名をクリア</button>
          <p style="font-size:12px;margin-top:5px;">※指やタッチペンでご署名ください。</p>
        </td>
      </tr>
    </table>

    <input type="hidden" id="line_id" name="line_id">
    <input type="hidden" id="signature_data" name="signature_data">

    <div class="alert alert-danger"><ul id="error_msg"></ul></div>

    <button class="line-submit" type="submit" id="submit_btn">送信</button>
  </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://static.line-scdn.net/liff/edge/2.1/sdk.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.5/dist/signature_pad.umd.min.js"></script>

  <script>
    let signaturePad;

    $(document).ready(function () {

      $(".loading").removeClass("is-hide");   // ページ読み込み後すぐにローディング表示
      // ---- LIFF 初期化（item_id を state から取得） ----
      liff.init({ liffId: '{{ $liff_agreement_id }}' })
        .then(() => {

            let itemId = null;

            // ① LIFF context（LINEアプリ内）
            const ctx = liff.getContext();
            if (ctx && typeof ctx.state === 'string' && ctx.state !== '') {
                const ps = new URLSearchParams(ctx.state);
                itemId = ps.get('item_id');
            }

            // ② ブラウザの URL パラメータ（pcテスト時）
            if (!itemId) {
                const urlParams = new URLSearchParams(window.location.search);
                itemId = urlParams.get('item_id');

                // ③ ?liff.state=%3Fitem_id%3D5 パターン
                if (!itemId && urlParams.get('liff.state')) {
                    const decoded = decodeURIComponent(urlParams.get('liff.state'));
                    const ps2 = new URLSearchParams(decoded);
                    itemId = ps2.get('item_id');
                }
            }

            // ---- item_id を hidden にセット ----
            if (itemId) {
                $("#item_id").val(itemId);
            } else {
                console.warn("item_id が取得できませんでした");
            }

            // ---- LINE ID ----
            if (liff.isLoggedIn()) {
                liff.getProfile().then(profile => {
                    $("#line_id").val(profile.userId);
                });
            }

            // ---- item_id / LINE ID の取得が完了したらフォーム表示 ----
            $("#agreement_form_wrap").fadeIn(200, function() {
                // フォーム表示完了後にキャンバスのサイズを再調整
                const canvas = document.querySelector("#signature-pad canvas");
                resizeCanvas(canvas);
            });
            $(".loading").addClass("is-hide");
        })
        .catch(err => {
            console.error("LIFF 初期化エラー:", err);
            $(".loading").addClass("is-hide");
            $("#agreement_form_wrap").fadeIn(200);
        });


      // ---- 署名パッド ----
      $("#agreement_form_wrap").fadeIn(200, function() {

          const canvas = document.querySelector("#signature-pad canvas");

          // 表示後にサイズ調整
          resizeCanvas(canvas);

          // ここで初期化（最も重要）
          signaturePad = new SignaturePad(canvas, {
              backgroundColor: 'white',
              penColor: 'black'
          });
      });

      const canvasEl = document.querySelector("#signature-pad canvas");
      canvasEl.addEventListener("touchstart", function(e) {
          e.preventDefault();
      }, { passive: false });

      canvasEl.addEventListener("touchmove", function(e) {
          e.preventDefault();
      }, { passive: false });




      $('#clear-signature').on('click', function () {
        signaturePad.clear();
      });

      // ---- 規約スクロール ----
      const termsBox = document.getElementById('terms_box');
      const agreeTerms = document.getElementById('agree_terms');
      const agreeTermsLabel = document.getElementById('agree_terms_label');

      termsBox.addEventListener('scroll', function () {
        const threshold = 10;
        if (termsBox.scrollTop + termsBox.clientHeight >= termsBox.scrollHeight - threshold) {
          agreeTerms.disabled = false;
          agreeTermsLabel.classList.remove('disabled-label');
          agreeTermsLabel.textContent = '利用規約に同意する';
        }
      });

      // ---- 送信処理 ----
      $('#line-form').submit(function (e) {
          e.preventDefault();

          $('#error_msg').empty();
          $('.alert.alert-danger').hide();

          // 署名チェック
          if (signaturePad.isEmpty()) {
              $('#error_msg').append('<li>署名を入力してください。</li>');
              $('.alert.alert-danger').show();
              return;
          }

          // ---- チェックボックスのバリデーション ----
          if (!$('#agree_terms').is(':checked')) {
              $('#error_msg').append('<li>利用規約に同意してください。</li>');
          }
          if (!$('#agree_accurate').is(':checked')) {
              $('#error_msg').append('<li>登録情報と査定内容が正確であることの確認が必要です。</li>');
          }
          if (!$('#agree_sell').is(':checked')) {
              $('#error_msg').append('<li>買取内容への同意が必要です。</li>');
          }
          if (!$('#agree_ownership').is(':checked')) {
              $('#error_msg').append('<li>取引する商品がご自身の所有物であることの確認が必要です。</li>');
          }
          if (!$('#agree_deliver').is(':checked')) {
              $('#error_msg').append('<li>商品を引渡す意向があることの確認が必要です。</li>');
          }
          if (!$('#agree_antisocial').is(':checked')) {
              $('#error_msg').append('<li>反社会的勢力ではないことの確認が必要です。</li>');
          }

          // エラーがあれば中断
          if ($('#error_msg').children().length > 0) {
              $('.alert.alert-danger').show();
              return;
          }

          // 署名データセット
          const dataUrl = signaturePad.toDataURL('image/png');
          $('#signature_data').val(dataUrl);

          const form = $(this);
          const url = form.attr('action');
          const method = form.attr('method');
          const data = form.serialize();

          $(".loading").removeClass("is-hide");
          $("#submit_btn").prop('disabled', true);

          $.ajax({
              url: url,
              method: method,
              data: data,
              success: function (data) {
                  $(".loading").addClass("is-hide");
                  sendText(data.message, data.url);
              },
              error: function (xhr) {
                  $(".loading").addClass("is-hide");
                  $("#submit_btn").prop('disabled', false);

                  const errors = xhr.responseJSON?.errors || null;
                  if (errors) {
                      $('#error_msg').empty();
                      $.each(errors, function (key, msgs) {
                          $('#error_msg').append('<li>' + msgs + '</li>');
                      });
                      $('.alert.alert-danger').show();
                  } else {
                      alert('フォーム送信に失敗しました');
                  }
              }
          });
      });




    });

    // Canvas 調整
    function resizeCanvas(canvas) {
      const ratio = Math.max(window.devicePixelRatio || 1, 1);
      canvas.width = canvas.offsetWidth * ratio;
      canvas.height = 200 * ratio;
      canvas.getContext("2d").scale(ratio, ratio);
    }

    // LINE 送信
    function sendText(message, url) {
      const next_msg = "買取同意の手続きありがとうございます。\n以下のURLから内容を確認できます。\n" + url;

      liff.sendMessages([
        { type: 'text', text: message }
        // { type: 'sticker', packageId: "11537", stickerId: "52002739" },
        // { type: 'text', text: next_msg }
      ])
      .then(() => liff.closeWindow())
      .catch(err => alert('メッセージ送信に失敗:' + err));
    }
  </script>
</body>
</html>
