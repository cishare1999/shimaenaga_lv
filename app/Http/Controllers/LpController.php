<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cookie;

use App\Eximage;
use Functions;

class LpController extends Controller
{
    public function show(Request $request, $prefix = null, $page = 'top')
    {
        // 許可されたページ
        $allowedPages = [
            'top' => 'top',
            'company' => 'company',
            'service' => 'service',
            'privacy' => 'privacy'
        ];

        // 無効なページなら 404
        if (!array_key_exists($page, $allowedPages)) {
            abort(404);
        }

        // `test.com/` の場合は from_url を設定しない
        if ($prefix === null) {
          // ルート (test.com/) の場合、明示的に from_url を空にする
          $request->session()->put('from_url', '');
        } else {
            $request->session()->put('from_url', $prefix);
        }

        // 必要なデータを取得（top の場合のみ）
        $exlist = ($page === 'top') ? Eximage::all() : [];

        return view($allowedPages[$page], compact('exlist'));
    }
}

// class LpController extends Controller
// {
//   public function sms(Request $request)
//   {
//     $exlist = Eximage::all();
//     $request->session()->put('from_url', 'sms');
//     return view('top', compact('exlist'));
//   }

//   public function index(Request $request)
//   {
//     $exlist = Eximage::all();
//     $request->session()->put('from_url', 'lp');
//     return view('lp_top', compact('exlist'));
//   }

//   public function company(Request $request)
//   {
//     return view('lp_company');
//   }

//   public function service(Request $request)
//   {
//     return view('lp_service');
//   }

//   public function privacy(Request $request)
//   {
//     return view('lp_privacy');
//   }
//   public function index2(Request $request)
//   {
//     $exlist = Eximage::all();
//     $request->session()->put('from_url', 'lp2');
//     return view('top', compact('exlist'));
//   }

//   public function index3(Request $request)
//   {
//     $exlist = Eximage::all();
//     // Cookie::queue('from_url', 'lp3', 129600);
//     // Cookie::queue('a8', $request->a8, 129600);
//     $request->session()->put('from_url', 'lp3');
//     // $request->session()->put('a8', $request->a8);
//     return view('top', compact('exlist'));
//   }

//   public function index4(Request $request)
//   {
//     $exlist = Eximage::all();

//     $request->session()->put('from_url', 'lp4');

//     return view('top', compact('exlist'));
//   }

//   // 2024.09.28追加
//   public function index_lp2gp(Request $request, $prefix)
//   {
//       $exlist = Eximage::all();
//       $request->session()->put('from_url', $prefix);
//       return view('lpoh_top', compact('exlist'));
//   }
//   public function company_lp2gp(Request $request, $prefix)
//   {
//       $request->session()->put('from_url', $prefix);
//       return view('lpoh_company');
//   }
//   public function service_lp2gp(Request $request, $prefix)
//   {
//       $request->session()->put('from_url', $prefix);
//       return view('lpoh_service');
//   }
//   public function privacy_lp2gp(Request $request, $prefix)
//   {
//       $request->session()->put('from_url', $prefix);
//       return view('lpoh_privacy');
//   }

// }
