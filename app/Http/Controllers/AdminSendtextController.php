<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

Paginator::useBootstrap();

use App\User;
use App\UserData;
use App\UserItem;
use App\Sendmessage;
use App\Message;

use Mail;

class AdminSendtextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      //定型文の読み込み
      $sendtext = Sendmessage::orderBy('created_at', 'asc')->get();
      // dd($sendtext);
      return view('admin.sendtext.index', compact('request', 'sendtext'));


    }

    public function textedit(Request $request, $id)
    {
      $sendtext = Sendmessage::where('id', $id)->first();
      // dd($request);

      if($id != 6 && $id != 7 && $id != 8){
        $sendtext->send_title = $request->send_title;
      }
      $sendtext->sentence = $request->sentence;
      $sendtext->save();

      return redirect('/admin/sendtext/')->with('message', '定型文を変更しました。');

    }






  }
