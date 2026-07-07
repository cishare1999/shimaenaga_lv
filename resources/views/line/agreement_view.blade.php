<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>買取同意書 {{ $item->id }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body { font-family: -apple-system, BlinkMacSystemFont, "Helvetica Neue", "YuGothic", "メイリオ", sans-serif; padding: 10px; }
    .wrap{
      max-width:800px;
      width:100%;
      margin:0 auto;
    }
    h1 { font-size: 20px; margin-bottom: 10px; }
    .info-table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
    .info-table th, .info-table td { border: 1px solid #ccc; padding: 6px; font-size: 13px; vertical-align: top; }
    .info-table th { background: #f5f5f5; width: 30%; }
    pre { white-space: pre-wrap; word-wrap: break-word; font-size: 13px; background: #fafafa; padding: 8px; border: 1px solid #ddd; }
    .signature-box { margin-top: 10px; }
    .signature-box img { max-width: 100%; border: 1px solid #ccc; }
    .print-btn { margin-top: 10px; padding: 8px 16px; font-size: 13px; }
  </style>
</head>
<body>
<div class="wrap">
  <h1>買取同意書（申込ID：{{ $item->id }}）</h1>

  <table class="info-table">

      <tr>
        <td colspan="2">
          {{-- 同意契約の文章　新規とリピートで出し分け --}}
          @if($isRepeat)
            @include('line.block.repeat_agreement_text')
          @else
            @include('line.block.first_agreement_text')
          @endif

        </td>
      </tr>



    <tr>
      <th>同意日時</th>
      <td>{{ $item->agreement_signed_at }}</td>
    </tr>
    <tr>
      <th>買取申込ID</th>
      <td>{{ $item->id }}</td>
    </tr>
    <tr>
      <th>お名前</th>
      <td>{{ optional($user)->name }}</td>
    </tr>
    <tr>
      <th>商品名</th>
      <td>{{ $item->item_name }}</td>
    </tr>
    <tr>
      <th>買取方法</th>
      <td>{{ $item->way }}</td>
    </tr>
    <tr>
      <th>査定額</th>
      <td>{{ $finalAmount }}</td>
    </tr>
      <tr>
      <th>電話番号</th>
      <td>{{ optional($user)->mobile }}</td>
    </tr>

    <tr>
      <th>住所</th>
      <td>
        {{ optional($userData)->zip }}
        {{ optional($userData)->pref }}
        {{ optional($userData)->city }}
        {{ optional($userData)->address }}
        {{ optional($userData)->building }}
      </td>
    </tr>

  </table>

  <h2 style="font-size:16px;">同意内容</h2>
  <pre>{{ $item->agreement_text }}</pre>

  <div class="signature-box">
    <h2 style="font-size:16px;">署名</h2>
    @if ($item->agreement_signature)
      <img src="{{ asset('storage/signatures/' . $item->agreement_signature) }}" alt="署名画像">
    @else
      <p>署名画像は登録されていません。</p>
    @endif
  </div>

</div>
  {{-- <button class="print-btn" onclick="window.print();">印刷する</button> --}}

</body>
</html>
