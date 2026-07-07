@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ダッシュボード</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card callout callout-danger">
            <div class="card-header">
                <h3 class="card-title">お知らせ</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <p style="color:red;font-size:14px;line-height:1.8;">
                    ※このシステムはLINE公式アカウントとの連携を前提として作られております。<br>
                    　ユーザーへLINEメッセージを送信する上限が無料プランですと月200通までとなります。<br>
                    　公式アカウントの「設定」から左メニューの「利用と請求」にいき月額プランを変更してください。
                </p>
            </div>
        </div>
    </div>
</div>    


@stop

@section('css')

@stop

@section('js')

@stop