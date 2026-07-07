@extends('layouts.app')

@section('title', 'お問合せ')
@section('description', 'LINEで完結！高く売れるリサイクル！最短１０分買取！')
@section('Keywords', '買取シマエナガ,iphone,収入印紙,ギフト券,商品券,買取')

@section('content')



<section id="contact" class="">
  <h2 class="fade-in fade-in-left">お問い合わせ</h2>

    <div class="row">
      <div class="in_row box-pd80">

        {{ Aire::open()->route('contact_comfirm') }}
        
          <table class="contact_tb">
            <tr>
              <th>名前 <span>必須</span></th>
              <td><input type="text" class="form-control form-text p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="name" required placeholder="漢字入力" data-aire-for="name" id="__aire-0-name4" /></td>
            </tr>
            <tr>
              <th>メールアドレス <span>必須</span></th>
              <td><input type="email" class="form-control form-text p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="email" required placeholder="半角英数字" data-aire-for="email" id="__aire-0-email7" /></td>
            </tr>
            <tr>
              <th>電話番号 <span>必須</span></th>
              <td><input type="tel" class="form-control form-text p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="tel" required placeholder="半角英数字" data-aire-for="tel" id="__aire-0-tel13" /></td>
            </tr>
            <tr>
              <tr>
                <th>タイトル <span>必須</span></th>
                <td><input type="text" class="form-control form-text p-2 text-base rounded-sm text-gray-900" data-aire-component="input" name="title" required placeholder="件名" data-aire-for="title" id="__aire-0-title1" /></td>
              </tr>
              <th>お問い合わせ内容  <span>必須</span></th>
              <td><textarea class="block w-full p-2 text-base leading-normal bg-white border rounded-sm form-textarea text-gray-900" data-aire-component="textarea" name="comment" required data-aire-for="comment" id="__aire-0-comment16"></textarea></td>
            </tr>
          </table>
          <input class="contact-submit font-normal text-center whitespace-no-wrap align-middle select-none border leading-normal Form-Btn inline-block text-base rounded p-2 px-4 text-white bg-blue-600 border-blue-700 hover:bg-blue-700 hover:border-blue-900" data-aire-component="button" type="submit" value="送信">

        {{ Aire::close() }}

      </div>
    </div>

</section>




@endsection

@section('css')

@endsection

@section('javascript')

@endsection