<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Eximage;

class AdminEximageController extends Controller
{
  public function index(Request $request)
  {

    $list = Eximage::all();

    return view('admin.eximage.index', compact('list'));

  }


  public function update(Request $request)
  {
    $img_id = $request->id;

    if($request->file('file')) {
      
      $file = $request->file('file');
      $temp = $file->store('public/temp');
      $image = str_replace('public/temp/', '', $temp);
      
      Storage::move($temp, 'public/eximage/'.$image);

      Eximage::updateOrCreate(
        ['id' => $img_id],
        ['eximage_name' => $image]
      );
    }

    return redirect('/admin/eximage/')->with('message', '高額商品画像を変更しました');

  }


  public function delete(Request $request)
  {

    $img_id = $request->id;

    Eximage::destroy($img_id);

    return redirect('/admin/eximage/')->with('message', '高額商品画像を削除しました');
  }
}
