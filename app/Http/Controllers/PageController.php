<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use Request;
use Mail;

use App\Eximage;
use Functions;

class PageController extends Controller
{
  public function index()
  {

    $exlist = Eximage::all();
    // $dd = Functions::birth_year();
    // dd($dd);

    return view('top', compact('exlist'));
  }
  public function newtop()
  {
    return view('newtop');
  }


  public function service()
  {
    return view('service');
  }

  public function company()
  {
    return view('company');
  }

  public function privacy()
  {
    return view('privacy');
  }

  public function attention()
  {
    return view('attention');
  }


  public function contact(Request $request)
  {
    return view('contact');
  }

  public function contactConfirm(Request $request)
  {

    $data = Request::all();

    return view('confirm', compact('data'));
  }

  public function contactComplete(Request $request)
  {

    $data = Request::all();

    $mail_address = config('app.mail_address');
// dd($mail_address);
    Mail::send('emails.contact', [
      'name' => $data['name'],
      'email' => $data['email'],
      'tel' => $data['tel'],
      'title' => $data['title'],
      'comment' => $data['comment'],
    ], function($message) use($mail_address){
      $message->from($mail_address, '買取シマエナガ HP')->to($mail_address)->subject('買取シマエナガ HPからのお問い合わせ');
      // $message->from('masaya@9re8.net', '買取シマエナガ HP')->to('masaya@9re8.net')->subject('買取シマエナガ HPからのお問い合わせ');
    });

    Mail::send('emails.contact2', [
      'name' => $data['name'],
      'email' => $data['email'],
      'tel' => $data['tel'],
      'title' => $data['title'],
      'comment' => $data['comment'],
    ], function($message) use ($data,$mail_address){
      $message->from($mail_address, '買取シマエナガ HP')->to($data['email'])->subject('買取シマエナガ 自動返信メール');
    });

    return view('complete');
  }

  public function checkEmail(Request $request)
  {
    return view('checkemail');
  }
}

