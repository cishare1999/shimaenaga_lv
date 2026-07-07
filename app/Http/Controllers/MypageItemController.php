<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\UserData;
use App\UserItem;

class MypageItemController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('verified');
  }
  
  public function new(Request $request)
  {
    $auth = Auth::user();
    
    return view('mypage.new', compact('auth'));
  }

  public function newConfirm(Request $request)
  {
    $auth_id = Auth::id();

    // $files1 = $request->file('files1');
    // $temp1 = $files1->store('public/temp');
    // $read_temp1 = str_replace('public/', 'storage/', $temp1);
    if ($request->file('files1')) {
      $files1 = $request->file('files1');
      $temp1 = $files1->store('public/temp');
      $read_temp1 = str_replace('public/', 'storage/', $temp1);
    } else {
      $files1 = '';
      $temp1 = '';
      $read_temp1 = '';
    }

    if ($request->file('files2')) {
      $files2 = $request->file('files2');
      $temp2 = $files2->store('public/temp');
      $read_temp2 = str_replace('public/', 'storage/', $temp2);
    } else {
      $files2 = '';
      $temp2 = '';
      $read_temp2 = '';
    }

    if ($request->file('files3')) {
      $files3 = $request->file('files3');
      $temp3 = $files3->store('public/temp');
      $read_temp3 = str_replace('public/', 'storage/', $temp3);
    } else {
      $files3 = '';
      $temp3 = '';
      $read_temp3 = '';
    }

    $files = [
      'temp1' => $temp1,
      'read_temp1' => $read_temp1,
      'temp2' => $temp2,
      'read_temp2' => $read_temp2,
      'temp3' => $temp3,
      'read_temp3' => $read_temp3,
    ];

    return view('mypage.new_confirm', compact('request','files'));
  }

  public function newComplete(Request $request)
  {
    $auth_id = Auth::id();

    // $image1 = str_replace('public/temp/', '', $request->temp1);
    // Storage::move($request->temp1, 'public/image/'.$image1);

    if ($request->temp1) {
      $image1 = str_replace('public/temp/', '', $request->temp1);
      Storage::move($request->temp1, 'public/image/'.$image1);
    } else {
      $image1 = '';
    }

    if ($request->temp2) {
      $image2 = str_replace('public/temp/', '', $request->temp2);
      Storage::move($request->temp2, 'public/image/'.$image2);
    } else {
      $image2 = '';
    }

    if ($request->temp3) {
      $image3 = str_replace('public/temp/', '', $request->temp3);
      Storage::move($request->temp3, 'public/image/'.$image3);
    } else {
      $image3 = '';
    }

    $item = new UserItem;    
    $item->user_id = Auth::id();
    $item->way = $request->way;
    $item->status_item = $request->status_item;
    $item->item_name = $request->item_name;
    $item->condition = $request->condition;
    $item->comment = $request->comment;
    $item->price = $request->price;
    $item->item_image1 = $image1;
    $item->item_image2 = $image2;
    $item->item_image3 = $image3;
    /*
    $item->status_judge = '査定中';
    $item->status_payment = '支払い前';
    $item->status_item = '商品到着待ち';
    */
    $item->status_total = '査定中';
    $item->memo = '';
    $item->save();

    if ($request->way == '後日郵送買取') {
      if($request->workdata != 'on') {
        $userdata = UserData::where('user_id', Auth::id())->first();
        $userdata->work_name = $request->work_name;
        $userdata->work_tel = $request->work_tel;
        $userdata->work_zip = $request->work_zip;
        $userdata->work_pref = $request->work_pref;
        $userdata->work_city = $request->work_city;
        $userdata->work_address = $request->work_address;
        $userdata->work_building = $request->work_building;
        $userdata->salary = $request->salary;
        $userdata->payday = $request->payday;
        $userdata->save();  
      }
    }

    return view('mypage.new_complete');
  }
}
