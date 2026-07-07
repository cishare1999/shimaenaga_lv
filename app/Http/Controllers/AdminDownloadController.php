<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\UserData;
use App\UserItem;

use Carbon\Carbon;

use App\Exports\Export;

class AdminDownloadController extends Controller
{

  public function index()
  {

    return view('admin.download.index');

  }

  public function export(Request $request)
  {
    //PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);

    //データ指定
    $type = $request->type; //item user
    $from = $request->from;
    $to = $request->to;

    $until = new Carbon($request->to);
    $until = $until->addDay();

    if($type == 'user') {
      $data = User::whereBetween("created_at", [$from, $until])->get();

      //$data = $this->sanitize_html($data);
      
      $filename = 'users-'. $from .'-' . $to .'.xlsx';

      $view = \view('admin.download.user_xlsx', compact('data'));

      //dd(\Excel::download(new Export($view), $filename));

      return \Excel::download(new Export($view), $filename);
    }

    if($type == 'item') {
      $data = UserItem::whereBetween("created_at", [$from, $until])->get();
      
      $filename = 'items-'. $from .'-' . $to .'.xlsx';

      $view = \view('admin.download.item_xlsx', compact('data'));

      return \Excel::download(new Export($view), $filename);
    }

  }

  public function sanitize_html($content) {
    if (!$content) return '';
    $invalid_characters = '/[^\x9\xa\x20-\xD7FF\xE000-\xFFFD]/';
    return preg_replace($invalid_characters,'', $content);
  }

}
