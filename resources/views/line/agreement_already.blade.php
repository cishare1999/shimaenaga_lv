<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>買取同意書（済）</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: sans-serif; padding: 20px; text-align: center; }
        .msg-box { margin-top: 40px; padding: 20px; border: 1px solid #ccc; border-radius: 6px; background: #fafafa; }
        .btn { display:block; width:100%; padding:12px; background:#06c755; color:#fff; margin-top:20px; text-decoration:none; border-radius:4px; }
    </style>
</head>
<body>

<h1>買取同意書の確認</h1>

<div class="msg-box">
    <p>この買取申込（ID: {{ $item->id }}）は既に同意手続きが完了しています。</p>
    {{-- <p>内容はこちらから確認できます。</p> --}}

    {{-- <a href="{{ $item->agreement_url }}" class="btn" target="_blank">同意書を確認する</a> --}}
</div>

</body>
</html>
