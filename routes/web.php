<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LineRegistrationController;
use App\Http\Controllers\LineRegistration2Controller;
use App\Http\Controllers\LineAuthController;//2024.06.27 add

//他社情報のapi ajax分離
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//2023.11.20 add
Route::get('/api/fetch-data/{kana}/{birthday}', [ApiController::class, 'fetchData']);

// LINE Messaging API 連携　2023.07.07
Route::prefix('line')->group(function(){

  //2024.06.27 add LINE loginを使ってリファラーを取得する
  Route::get('login', [LineAuthController::class, 'redirectToProvider'])->name('line.login');
  Route::get('callback', [LineAuthController::class, 'handleProviderCallback'])->name('line.callback');
  

  Route::get('registration/image/{size}', [LineRegistrationController::class, 'image'])
      ->where('size', '240|300|460|700|1040')
      ->name('line.registration.image');
  // Route::get('registration/callback', [LineRegistrationController::class, 'callback']);
  // Route::get('registration/webhook', [LineRegistrationController::class, 'webhook']);
  Route::post('registration/webhook', [LineRegistrationController::class, 'webhook']);
  Route::post('registration2/webhook2', [LineRegistration2Controller::class, 'webhook2']);
  
  //LINE liffフォームアプリ　2023.07.07
  // LINE顧客情報フォーム表示
  Route::get('/form', 'LineFormController@showForm')->name('line.form');
  // 申込フォーム表示非表示
  Route::post('/form/status', 'LineFormController@statusForm')->name('line.form.status');

  // 顧客情報フォーム送信処理
  Route::post('/form/submit', 'LineFormController@submitForm')->name('line.form.submit');

  // LINE申込フォーム表示
  Route::get('/itemform', 'LineItemFormController@showForm')->name('line.itemform');
  // 申込フォーム表示非表示
  Route::post('/itemform/status', 'LineItemFormController@statusForm')->name('line.itemform.status');

  // 申込フォーム送信処理
  Route::post('/itemform/submit', 'LineItemFormController@submitForm')->name('line.itemform.submit');
  
  // 買取同意フォーム表示（LIFFから /line/agreement?item_id=XXX で開く）
  Route::get('/agreement', 'LineAgreementController@showForm')->name('line.agreement');

  // 買取同意フォーム送信処理（AJAX）
  Route::post('/agreement/submit', 'LineAgreementController@submitForm')->name('line.agreement.submit');

  // 買取同意書閲覧ページ（管理画面からもURLを参照できる用）
  Route::get('/agreement/view/{item_id}', 'LineAgreementController@view')->name('line.agreement.view');


});

Auth::routes(['register' => false]);

//静的htmlをTOPに表示する
// Route::get('/', function () {
//   return \File::get(public_path() . '/index.html');
// });

// Route::get('/', 'PageController@index')->name('top');
Route::get('/newtop', 'PageController@newtop')->name('newtop');

Route::get('/service', 'PageController@service')->name('service');

Route::get('/company', 'PageController@company')->name('company');

Route::get('/privacy', 'PageController@privacy')->name('privacy');

// Route::get('/contact', 'PageController@contact')->name('contact');

// Route::post('/contact', 'PageController@contactConfirm')->name('contact_comfirm');

// Route::post('/contact/complete', 'PageController@contactComplete')->name('contact_complete');

Route::get('/attention', 'PageController@attention')->name('attention');

Auth::routes(['verify' => true]);

// Route::get('/checkemail', 'PageController@checkEmail');

Route::group(['prefix' => 'sms'], function () {

  Route::get('/', 'LpController@sms')->name('sms_top');

});

Route::group(['prefix' => 'lp'], function () {

  // Route::get('/', 'LpController@index')->name('lp_top');
  // Route::get('/privacy', 'LpController@privacy')->name('lp_privacy');
  // Route::get('/company', 'LpController@company')->name('lp_company');
  // Route::get('/service', 'LpController@service')->name('lp_service');
  // Route::get('/', 'LpController@index')->name('lp_top');

});

Route::group(['prefix' => 'lp2'], function () {

  // Route::get('/', 'LpController@index2')->name('lp_top2');

});

// 2024.08.08追加
// 共通の処理を行うルートグループ
// Route::group(['prefix' => '{prefix}'], function () {
//   Route::get('/', 'LpController@index_lp2gp')->name('lp2gp_top')->where('prefix', 'lp|lp2seo|lp2lis|lp2afi|lp3');
//   Route::get('/privacy', 'LpController@privacy_lp2gp')->name('lp2gp_privacy')->where('prefix', 'lp|lp2seo|lp2lis|lp2afi|lp3');
//   Route::get('/company', 'LpController@company_lp2gp')->name('lp2gp_company')->where('prefix', 'lp|lp2seo|lp2lis|lp2afi|lp3');
//   Route::get('/service', 'LpController@service_lp2gp')->name('lp2gp_service')->where('prefix', 'lp|lp2seo|lp2lis|lp2afi|lp3');
// });
// lp3 のみのルーティング
// Route::group(['prefix' => '{prefix}'], function () {
//   Route::get('/', 'LpController@index_lp2gp')->name('lp2gp_top')->where('prefix', 'lp3');
//   Route::get('/privacy', 'LpController@privacy_lp2gp')->name('lp2gp_privacy')->where('prefix', 'lp3');
//   Route::get('/company', 'LpController@company_lp2gp')->name('lp2gp_company')->where('prefix', 'lp3');
//   Route::get('/service', 'LpController@service_lp2gp')->name('lp2gp_service')->where('prefix', 'lp3');
// });

// lp のみのルーティング 情報館のものこっちになった koccchi
// Route::group(['prefix' => '{prefix}'], function () {
//   Route::get('/', 'LpController@index_lp2gp')->name('lp2gp_top')->where('prefix', 'lp');
//   Route::get('/privacy', 'LpController@privacy_lp2gp')->name('lp2gp_privacy')->where('prefix', 'lp');
//   Route::get('/company', 'LpController@company_lp2gp')->name('lp2gp_company')->where('prefix', 'lp');
//   Route::get('/service', 'LpController@service_lp2gp')->name('lp2gp_service')->where('prefix', 'lp');
// });

// 2025.202.20追加
// ルートのURL＋lp+lp2+lp3など様々なルーティングに共通の処理を行うルートグループ
Route::group(['prefix' => '{prefix?}'], function () {
  Route::get('/{page?}', 'LpController@show')
      // ->where('prefix', 'lp|lp_jo|lp_mt|lp_ag|lp_sm|lp_kr|lp2seo|lp2lis|lp2afi|lp3')
      // ->where('prefix', 'lp')
      // ->where('prefix', 'lp|lp_mt|lp_ag|lp_sm|lp_kr')
      // ->where('prefix', 'lp|lp_mt|lp_ag|lp_sm|lp_kr|lp2seo|lp2lis|lp2afi')
      // ->where('prefix', 'lp|lp_mt|lp_ag|lp_sm|lp_kr|lp')
      ->where('prefix', 'lp_jo|lp2seo|lp2lis|lp2afi|lp3|lp2seo1|lp2seo2|lp2seo3|lp2seo4|lp2seo5|lp2seo6')
      // ->where('prefix', 'lp2seo|lp2lis|lp2afi')
      // ->where('prefix', 'lp3')
      ->where('page', 'privacy|company|service|top')
      ->name('lp2gp_dynamic');
});

Route::group(['prefix' => 'lp3'], function () {

  // Route::get('/', 'LpController@index3')->name('lp_top3');

});

Route::group(['prefix' => 'lp4'], function () {

  // Route::get('/', 'LpController@index4')->name('lp_top4');

});




// Route::group(['prefix' => 'mypage','middleware' => 'auth'], function () {

//   Route::get('/', 'MypageController@index')->name('mypage.index');

//   Route::get('/profile', 'MypageController@profile')->name('mypage.profile');

//   Route::get('/entry', 'MypageController@entry')->name('mypage.entry');
//   Route::post('/entry/confirm', 'MypageController@entryConfirm')->name('mypage.entry_confirm');
//   Route::post('/entry/complete', 'MypageController@entryComplete')->name('mypage.entry_complete');

//   //2021.06.23 追加　プロフィール編集機能
//   Route::get('/entryedit', 'MypageController@entryedit')->name('mypage.entryedit');
//   Route::post('/entryedit/confirm', 'MypageController@entryeditConfirm')->name('mypage.entryedit_confirm');
//   Route::post('/entryedit/complete', 'MypageController@entryeditComplete')->name('mypage.entryedit_complete');


//   Route::get('/new', 'MypageItemController@new')->name('mypage.new');
//   Route::post('/new/confirm', 'MypageItemController@newConfirm')->name('mypage.new_confirm');
//   Route::post('/new/complete', 'MypageItemController@newComplete')->name('mypage.new_complete');

//   Route::post('/useragree', 'MypageController@userAgree')->name('mypage.user_agree');

// });

//2024.06.26 メディア用集計画面
Route::group(['prefix' => 'customer', 'middleware' => 'basicauth'], function() {
  Route::get('/media', 'MediaController@index')->name('media.index');
  Route::get('/medialp3', 'MediaController@index3')->name('media.index3');//2024.08.28 lp3用の管理画面追加
  Route::get('/jmedia', 'MediaController@indexlp')->name('media.indexlp');//2024.12.10 lp用の管理画面追加
});


//Basic認証 管理画面
Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => 'basicauth'], function() {
  //atcrew
  //admin2020
  
  //管理TOP
  Route::get('/', 'AdminController@index')->name('index');



  /* 買取リスト */
  Route::resource('/list', 'AdminListController');
  // 契約書入力ページ　2021.12.14 add
  Route::get('/list/contract/{id}', 'AdminListController@contract')->name('list.contract');
  // 契約書入力ページ　2021.12.14 add
  Route::get('/list/pdf/{id}','AdminListController@pdf')->name('list.pdf');


  /* 取引完了リスト 2021.11.16追加 */
  Route::resource('/completion', 'AdminCompletionController');

  /* 定型文 2023.07.21add */
  Route::resource('/sendtext', 'AdminSendtextController');
  Route::post('/sendtext/textedit/{id}', 'AdminSendtextController@textedit')->name('sendtext.textedit');
  //LINEメッセージ送信
  Route::post('/users/line_sending/{id}', 'AdminUserController@line_sending')->name('users.line_sending');

    /* 一括LINE送信 2024.03.22 add */
  Route::get('/bulkmsg', 'AdminBulkmsgController@index')->name('bulkmsg.index');
  Route::post('/bulkmsg/confirm', 'AdminBulkmsgController@bulkmsgConfirm')->name('bulkmsg.confirm');
  Route::post('/bulkmsg/complete', 'AdminBulkmsgController@bulkmsgComplete')->name('bulkmsg.complete');

  /*ステータス一括更新 2024.05.25 add */
  Route::get('/bulkstatus', 'AdminBulkstatusController@index')->name('bulkstatus.index');
  Route::post('/bulkstatus', 'AdminBulkstatusController@index')->name('bulkstatus.index');
  Route::post('/bulkstatus/confirm', 'AdminBulkstatusController@bulkstatusConfirm')->name('bulkstatus.confirm');
  Route::post('/bulkstatus/complete', 'AdminBulkstatusController@bulkstatusComplete')->name('bulkstatus.complete');



  //ユーザー
  Route::resource('/users', 'AdminUserController');

  Route::post('/users/status/{id}', 'AdminUserController@status')->name('users.status');
  Route::post('/users/email_verified/{id}', 'AdminUserController@email_verified')->name('users.email_verified');

  Route::get('/users/image/{id}', 'AdminUserController@image')->name('users.image');
  Route::post('/users/image/{id}', 'AdminUserController@imageupdate');

  //商品
  Route::resource('/items', 'AdminItemController');

  Route::get('/items/image/{id}', 'AdminItemController@image')->name('items.image');
  Route::post('/items/image/{id}', 'AdminItemController@imageupdate');

  Route::post('/items/status/{id}', 'AdminItemController@status')->name('items.status');
  //契約書入力item　2021.12.14 add
  Route::post('/items/contract/{id}', 'AdminItemController@contract')->name('items.contract');



  Route::post('/items/memo/{id}', 'AdminItemController@memo')->name('items.memo');

  Route::get('/download', 'AdminDownloadController@index')->name('download.index');
  Route::post('/download', 'AdminDownloadController@export');

  Route::get('/eximage', 'AdminEximageController@index')->name('eximage.index');
  Route::post('/eximage', 'AdminEximageController@update');

  Route::post('/eximage/delete', 'AdminEximageController@delete');

  Route::post('/users/mailline/{id}', 'AdminUserController@mailline')->name('users.mailline');
  Route::post('/users/mailcancel/{id}', 'AdminUserController@mailcancel')->name('users.mailcancel');


    //集計
    Route::resource('/totalization', 'AdminTotalizationController');

});
