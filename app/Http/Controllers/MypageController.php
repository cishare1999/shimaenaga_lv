<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\UserData;
use App\UserItem;


class MypageController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('verified');
  }
  
  public function index(Request $request)
  {
    $auth_id = Auth::id();
    $user = Auth::user();
    // dd($user->userData->kana);

    // if(UserData::where('user_id', $auth_id)->exists()) {
    if($user->userData->kana != NULL) {//初回登録の判別を変更
      
    } else {
      return redirect('/mypage/entry');
    }

    $items = UserItem::where('user_id', $auth_id)->orderBy('created_at', 'desc')->get();


    $check = UserItem::where('user_id', $auth_id)->where(function($query){
      $query->orWhere('status_total', '=', '査定中')
            ->orWhere('status_total', '=', '査定完了（買取可）')
            ->orWhere('status_paid', '=', '商品到着待');
    })->exists();

    $check2 = UserItem::where('user_id', $auth_id)->where(function($query){
      $query->orWhere('status_total', '=', 'ケリ')
            ->orWhere('status_total', '=', '詐欺');
    })->exists();

    // dd($check2);

    if(! $check) {
      $check = UserItem::where('user_id', $auth_id)->where('status_total', '代金振込済')->where(function($query){
        $query->orWhereNull('status_paid')
              ->orWhere('status_paid', '=', '商品到着待');
      })->exists();
    }
    
    return view('mypage.index', compact('items', 'check', 'check2','user'));
  }

  public function profile(Request $request)
  {
    $auth = Auth::user();
    
    return view('mypage.profile', compact('auth'));
  }

  //初回情報登録
  public function entry(Request $request)
  {
    $auth_id = Auth::id();

    $auth = Auth::user();
    // $auth2 = UserData::where('user_id', $auth_id);

    return view('mypage.entry', compact('auth'));
  }

  public function entryConfirm(Request $request)
  {
    $auth_id = Auth::id();
    $user = Auth::user();

    // if(UserData::where('user_id', $auth_id)->exists()) {
    if($user->userData->kana != NULL) {//初回登録の判別を変更
      return redirect('/mypage/');
    }


    if($request->file('files1')){
    $files1 = $request->file('files1');
      $temp1 = $files1->store('public/temp');
      $read_temp1 = str_replace('public/', 'storage/', $temp1);
      $files = [
        'temp1' => $temp1,
        'read_temp1' => $read_temp1,
      ];
    }
    if($request->file('files2')){
      $files2 = $request->file('files2');
      $temp2 = $files2->store('public/temp');
      $read_temp2 = str_replace('public/', 'storage/', $temp2);
      $files = array_merge($files,
        [
          'temp2' => $temp2,
          'read_temp2' => $read_temp2,
        ]
      );
    }
    if($request->file('files3')){
      $files3 = $request->file('files3');
      $temp3 = $files3->store('public/temp');
      $read_temp3 = str_replace('public/', 'storage/', $temp3);
      $files = array_merge($files,
        [
          'temp3' => $temp3,
          'read_temp3' => $read_temp3,
        ]
      );
    }
    if($request->file('files4')){
      $files4 = $request->file('files4');
      $temp4 = $files4->store('public/temp');
      $read_temp4 = str_replace('public/', 'storage/', $temp4);
      $files = array_merge($files,
        [
          'temp4' => $temp4,
          'read_temp4' => $read_temp4,
        ]
      );
    }
    if($request->file('files5')){
      $files5 = $request->file('files5');
      $temp5 = $files5->store('public/temp');
      $read_temp5 = str_replace('public/', 'storage/', $temp5);
      $files = array_merge($files,
        [
          'temp5' => $temp5,
          'read_temp5' => $read_temp5,
        ]
      );
    }
    if($request->file('files6')){
      $files6 = $request->file('files6');
      $temp6 = $files6->store('public/temp');
      $read_temp6 = str_replace('public/', 'storage/', $temp6);
      $files = array_merge($files,
        [
          'temp6' => $temp6,
          'read_temp6' => $read_temp6,
        ]
      );
    }
    if($request->file('files7')){
      $files7 = $request->file('files7');
      $temp7 = $files7->store('public/temp');
      $read_temp7 = str_replace('public/', 'storage/', $temp7);
      $files = array_merge($files,
        [
          'temp7' => $temp7,
          'read_temp7' => $read_temp7,
        ]
      );
    }
    if($request->file('files8')){
      $files8 = $request->file('files8');
      $temp8 = $files8->store('public/temp');
      $read_temp8 = str_replace('public/', 'storage/', $temp8);
      $files = array_merge($files,
        [
          'temp8' => $temp8,
          'read_temp8' => $read_temp8,
        ]
      );
    }
    if($request->file('files9')){
      $files9 = $request->file('files9');
      $temp9 = $files9->store('public/temp');
      $read_temp9 = str_replace('public/', 'storage/', $temp9);
      $files = array_merge($files,
        [
          'temp9' => $temp9,
          'read_temp9' => $read_temp9,
        ]
      );
    }
    if($request->file('files10')){
      $files10 = $request->file('files10');
      $temp10 = $files10->store('public/temp');
      $read_temp10 = str_replace('public/', 'storage/', $temp10); 
      $files = array_merge($files,
        [
          'temp10' => $temp10,
          'read_temp10' => $read_temp10,
        ]
      );
    }

    // $files = [
    //   'temp1' => $temp1,
    //   'read_temp1' => $read_temp1,
    //   'temp2' => $temp2,
    //   'read_temp2' => $read_temp2,
    //   'temp3' => $temp3,
    //   'read_temp3' => $read_temp3,
    //   'temp4' => $temp4,
    //   'read_temp4' => $read_temp4,
    //   'temp5' => $temp5,
    //   'read_temp5' => $read_temp5,
    //   'temp6' => $temp6,
    //   'read_temp6' => $read_temp6,
    //   'temp7' => $temp7,
    //   'read_temp7' => $read_temp7,
    //   'temp8' => $temp8,
    //   'read_temp8' => $read_temp8,
    //   'temp9' => $temp9,
    //   'read_temp9' => $read_temp9,
    //   'temp10' => $temp10,
    //   'read_temp10' => $read_temp10,
    // ];

    //$request->session()->put('data', $data);

    return view('mypage.entry_confirm', compact('request','files'));
  }

  public function entryComplete(Request $request)
  {
    $auth_id = Auth::id();

    if($request->temp1){
      $image1 = str_replace('public/temp/', '', $request->temp1);
      Storage::move($request->temp1, 'public/licence/'.$image1);
    }

    if($request->temp2){
      $image2 = str_replace('public/temp/', '', $request->temp2);
      Storage::move($request->temp2, 'public/licence/'.$image2);
    }

    if($request->temp3){
      $image3 = str_replace('public/temp/', '', $request->temp3);
      Storage::move($request->temp3, 'public/licence/'.$image3);
    }

    if($request->temp4){
      $image4 = str_replace('public/temp/', '', $request->temp4);
      Storage::move($request->temp4, 'public/licence/'.$image4);
    }

    if($request->temp5){
      $image5 = str_replace('public/temp/', '', $request->temp5);
      Storage::move($request->temp5, 'public/licence/'.$image5);
    }

    if($request->temp6){
      $image6 = str_replace('public/temp/', '', $request->temp6);
      Storage::move($request->temp6, 'public/licence/'.$image6);
    }

    if($request->temp7){
      $image7 = str_replace('public/temp/', '', $request->temp7);
      Storage::move($request->temp7, 'public/licence/'.$image7);
    }

    if($request->temp8){
      $image8 = str_replace('public/temp/', '', $request->temp8);
      Storage::move($request->temp8, 'public/licence/'.$image8);
    }

    if($request->temp9){
      $image9 = str_replace('public/temp/', '', $request->temp9);
      Storage::move($request->temp9, 'public/licence/'.$image9);
    }

    if($request->temp10){
      $image10 = str_replace('public/temp/', '', $request->temp10);
      Storage::move($request->temp10, 'public/licence/'.$image10);
    }

    //生年月日変換
    $birthday = date('Y/m/d',strtotime($request->birthday));


    // $userdata = new UserData;
    $userdata = UserData::where('user_id', Auth::id())->first();
    // $userdata->user_id = Auth::id();
    $userdata->kana = $request->kana;
    $userdata->line = $request->line;
    $userdata->birthday = $birthday;
    $userdata->gender = $request->gender;
    $userdata->contact = $request->contact;
    $userdata->zip = $request->zip;
    $userdata->pref = $request->pref;
    $userdata->city = $request->city;
    $userdata->address = $request->address;
    $userdata->building = $request->building;
    $userdata->bank_name = $request->bank_name;
    $userdata->bank_code = $request->bank_code;
    $userdata->branch_name = $request->branch_name;
    $userdata->branch_code = $request->branch_code;
    $userdata->bank_type = $request->bank_type;
    $userdata->bank_number = $request->bank_number;
    $userdata->bank_kana = $request->bank_kana;
    $userdata->licence_1 = $image1;
    $userdata->licence_2 = $image2;
    $userdata->licence_3 = $image3;
    if(!empty($image4)){
      $userdata->licence_4 = $image4;
    }
    if(!empty($image5)){
      $userdata->licence_5 = $image5;
    }
    if(!empty($image6)){
      $userdata->licence_6 = $image6;
    }
    if(!empty($image7)){
      $userdata->licence_7 = $image7;
    }
    if(!empty($image8)){
      $userdata->licence_8 = $image8;
    }
    if(!empty($image9)){
      $userdata->licence_9 = $image9;
    }
    if(!empty($image10)){
      $userdata->licence_10 = $image10;
    }

    $userdata->save();

    return view('mypage.entry_complete');
  }

  public function userAgree(Request $request)
  {
    $auth = Auth::user();

    $item = UserItem::where('id', $request->item_id)->where('user_id', $auth->id)->first();

    $item->user_agree = '承認済';

    $item->save();

    return redirect()->route('mypage.index');
  }



  //編集登録
  public function entryedit(Request $request)
  {
    $auth_id = Auth::id();

    $auth = Auth::user();

    return view('mypage.entryedit', compact('auth'));
  }

  public function entryeditConfirm(Request $request)
  {
    $auth_id = Auth::id();
    // if(UserData::where('user_id', $auth_id)->exists()) {
    //   return redirect('/mypage/');
    // }

    $auth_id = Auth::id();

    $auth = Auth::user();

    $files1 = $request->file('files1');
    $temp1 = $files1->store('public/temp');
    $read_temp1 = str_replace('public/', 'storage/', $temp1);

    $files2 = $request->file('files2');
    $temp2 = $files2->store('public/temp');
    $read_temp2 = str_replace('public/', 'storage/', $temp2);

    $files3 = $request->file('files3');
    $temp3 = $files3->store('public/temp');
    $read_temp3 = str_replace('public/', 'storage/', $temp3);

    $files = [
      'temp1' => $temp1,
      'read_temp1' => $read_temp1,
      'temp2' => $temp2,
      'read_temp2' => $read_temp2,
      'temp3' => $temp3,
      'read_temp3' => $read_temp3,
    ];

    //$request->session()->put('data', $data);

    return view('mypage.entryedit_confirm', compact('request','files','auth'));
  }

  public function entryeditComplete(Request $request)
  {

    $image1 = str_replace('public/temp/', '', $request->temp1);
    Storage::move($request->temp1, 'public/licence/'.$image1);
    
    $image2 = str_replace('public/temp/', '', $request->temp2);
    Storage::move($request->temp2, 'public/licence/'.$image2);

    $image3 = str_replace('public/temp/', '', $request->temp3);
    Storage::move($request->temp3, 'public/licence/'.$image3);

    $userdata = UserData::where('user_id', Auth::id())->first();
    // $userdata->user_id = Auth::id();
    $userdata->kana = $request->kana;
    $userdata->line = $request->line;
    $userdata->contact = $request->contact;
    $userdata->zip = $request->zip;
    $userdata->pref = $request->pref;
    $userdata->city = $request->city;
    $userdata->address = $request->address;
    $userdata->building = $request->building;
    $userdata->bank_name = $request->bank_name;
    $userdata->bank_code = $request->bank_code;
    $userdata->branch_name = $request->branch_name;
    $userdata->branch_code = $request->branch_code;
    $userdata->bank_type = $request->bank_type;
    $userdata->bank_number = $request->bank_number;
    $userdata->bank_kana = $request->bank_kana;
    $userdata->licence_1 = $image1;
    $userdata->licence_2 = $image2;
    $userdata->licence_3 = $image3;

    // dd($userdata);
    $userdata->save();

    return view('mypage.entryedit_complete');
  }


















}


