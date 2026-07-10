@extends('layouts.app')
@section('title', '会社概要')
@section('description', 'LINEで完結！高く売れるリサイクル！最短１０分買取！')
@section('Keywords', '買取シマエナガ,iphone,収入印紙,ギフト券,商品券,買取')

@section('content')

<div class="mv_none">
</div>


<section>
<div class="box_in">

	<div class="title_text_c">
        <p><img src="{{ asset('/') }}images/title_icon.png" alt=""></p>
		<h2><img src="{{ asset('/') }}images/company_title.png" alt="会社情報"></h2>
	</div>

		<ul class="company">

<li>
<h3>運営会社</h3>
<p>{{config('app.com_name')}}</p>
</li>

<li>
<h3>所在地</h3>
<p>{{config('app.com_address')}}</p>
</li>

<li>
<h3>古物商許可証</h3>
<p>{{config('app.com_kobutsu')}}</p>
</li>
		</ul>


</div>
</section>




@endsection

@section('css')

@endsection

@section('javascript')

@endsection
