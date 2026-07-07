{{config('app.com_name')}}（以下「甲」という。）と、<br>
{{ !$isLiffMode ? optional($user)->name : '' }}（以下「乙」という。）は、以下の内容について乙が同意したことを確認する。<br>
<br>
<b>第１条　対象商品および買取内容の確認</b><br>
乙は、甲に対して次の商品について買取申込を行い、その内容に同意する。<br>
<br>
<b>
<span style="text-align:center;">記</span><br>
商品名 ：{{ !$isLiffMode ? $item->item_name : '' }}<br>
買取金額（査定額）：{{ !$isLiffMode ? $finalAmount : '' }}<br>
商品の額面：{{ !$isLiffMode ? $item->contract_cancel : '' }}<br>
</b>
<br>
<b>第２条　対象商品の取扱い</b><br>
甲は、甲乙間で本日以前に同意した買取条件を第１条に基づく買取申込にも適用することを提示し、乙はそれに同意する。なお、乙からの申出があった場合には、甲は本同意の内容を再度提示する。<br>
<br><hr>
<b>乙は、本同意書の内容を理解し、すべての事項に同意の上、以下で署名する。</b><br>
