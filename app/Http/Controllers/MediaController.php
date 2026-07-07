<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\UserData;
use App\UserItem;
use Illuminate\Support\Facades\DB;


use Functions;

class MediaController extends Controller
{
  // public function index(Request $request)
  // {

  //   if(!$request->tyear && !$request->tmonth){
  //     $request->tyear = date('Y');
  //     $request->tmonth = date('m');
  //     $item = "";
  //     $item2 = "";
  //   }else{
  //     $st_h = $request->tyear."-".$request->tmonth."-01 00:00:00";
  //     $fn_h = $request->tyear."-".$request->tmonth."-31 23:59:59";

  //     $item = DB::select('SELECT 
  //             coalesce(date_format(a.created_at,"%Y/%m/%d"),"total") as day 
  //             ,count(a.id) as 件数 
  //             ,IFNULL(sum(a.from_url="lp2"),0) as LP2, 
  //             IFNULL(sum(a.from_url="lp2seo"), 0) as LP2SEO,
  //             IFNULL(sum(a.from_url="lp2lis"), 0) as LP2LIS,
  //             IFNULL(sum(a.from_url="lp2afi"), 0) as LP2AFI
  //             FROM users a 
  //             WHERE a.from_url IN (?, ?, ?, ?) AND a.created_at BETWEEN ? AND ?
  //             GROUP BY DATE_FORMAT(a.created_at,"%Y%m%d") with rollup', ['lp2', 'lp2seo', 'lp2lis', 'lp2afi', $st_h, $fn_h]);


  //     //リピーターなしの集計
  //     $all_id = DB::select('SELECT 
  //               a.id 
  //               FROM user_items a 
  //               LEFT JOIN users b ON a.user_id = b.id 
  //               GROUP BY a.user_id 
  //               ORDER BY a.created_at, a.id ASC');
  //     //IN句を形成
  //     $ink2 = ""; // 事前に初期化
  //     //IN句を形成
  //     $cc = count($all_id);
  //     if($cc){
  //       foreach($all_id as $k=>$v){
  //         $ink2 .= $v->id.",";
  //       }
  //     }
  //     // $inkt1 = trim($ink1,",");
  //     $inkt2 = trim($ink2,",");
  //     if(empty($inkt2)) $inkt2 = "0"; // 空の場合は "0" を設定
  //     // dd($inkt2);
  //     $item2 = DB::select('SELECT 
  //             coalesce(date_format(b.created_at,"%Y/%m/%d"),"total") as day 
  //             ,count(a.id) as 件数 
  //             ,IFNULL(sum(a.from_url="lp2"),0) as A8 
  //             ,IFNULL(sum(a.from_url="lp2" AND b.status_total="代金振込済"),0) as A8振込
  //             ,IFNULL(sum(a.from_url="lp2seo"),0) as LP2SEO 
  //             ,IFNULL(sum(a.from_url="lp2seo" AND b.status_total="代金振込済"),0) as lp2seo振込
  //             ,IFNULL(sum(a.from_url="lp2lis"),0) as LP2LIS 
  //             ,IFNULL(sum(a.from_url="lp2lis" AND b.status_total="代金振込済"),0) as lp2lis振込
  //             ,IFNULL(sum(a.from_url="lp2afi"),0) as LP2AFI 
  //             ,IFNULL(sum(a.from_url="lp2afi" AND b.status_total="代金振込済"),0) as lp2afi振込
  //             FROM users a 
  //             LEFT JOIN user_items b ON a.id = b.user_id 
  //             WHERE b.created_at BETWEEN ? AND ? 
  //             AND b.id IN ('.$inkt2.') 
  //             GROUP BY DATE_FORMAT(b.created_at,"%Y%m%d") with rollup',[ $st_h,$fn_h ]);

  //   }
  //   // データが空の場合は null にする
  //   $item2 = !empty($item2) ? $item2 : null;
  //   // $item2 = DB::select('SELECT COUNT(*) as cnt FROM users WHERE from_url = ? AND created_at BETWEEN ? AND ? ',['lp3', $st_h,$fn_h ]);
  //   return view('media.index', compact('request','item','item2'));
    
  // }

  public function index(Request $request)
  {
      $mediaList = [
          // 'lp2'  => 'LP2',
          'lp2seo'  => 'LP2SEO',
          'lp2lis'  => 'LP2LIS',
          'lp2afi'  => 'LP2AFI',
          'lp2seo1' => 'LP2SEO1',
          'lp2seo2' => 'LP2SEO2',
          'lp2seo3' => 'LP2SEO3',
          'lp2seo4' => 'LP2SEO4',
          'lp2seo5' => 'LP2SEO5',
          'lp2seo6' => 'LP2SEO6',
      ];

      /* =========================
        初期表示
      ========================= */
      if (!$request->tyear && !$request->tmonth) {
          $request->tyear  = date('Y');
          $request->tmonth = date('m');
          return view('media.index', [
              'request'   => $request,
              'item'      => null,
              'item2'     => null,
              'mediaList' => $mediaList,
          ]);
      }

      $st_h = "{$request->tyear}-{$request->tmonth}-01 00:00:00";
      $fn_h = "{$request->tyear}-{$request->tmonth}-31 23:59:59";

      /* =========================
        会員登録時点の集計
      ========================= */
      $selects = [];
      $bindings = [];

      foreach ($mediaList as $key => $label) {
          $selects[]  = "IFNULL(SUM(a.from_url = ?),0) AS {$label}";
          $bindings[] = $key;
      }

      $inPlaceholders = implode(',', array_fill(0, count($mediaList), '?'));
      $bindings = array_merge($bindings, array_keys($mediaList), [$st_h, $fn_h]);

      $item = DB::select("
          SELECT
              COALESCE(DATE_FORMAT(a.created_at,'%Y/%m/%d'),'total') AS day,
              COUNT(a.id) AS 件数,
              ".implode(',', $selects)."
          FROM users a
          WHERE a.from_url IN ({$inPlaceholders})
            AND a.created_at BETWEEN ? AND ?
          GROUP BY DATE_FORMAT(a.created_at,'%Y%m%d') WITH ROLLUP
      ", $bindings);

      /* =========================
        リピーター除外用ID取得（旧仕様完全再現）
      ========================= */
      $all_id = DB::select("
          SELECT a.id
          FROM user_items a
          LEFT JOIN users b ON a.user_id = b.id
          GROUP BY a.user_id
          ORDER BY a.created_at, a.id ASC
      ");

      $ink2 = '';
      foreach ($all_id as $v) {
          $ink2 .= $v->id . ',';
      }

      $inkt2 = trim($ink2, ',');
      if (empty($inkt2)) {
          $inkt2 = '0';
      }

      /* =========================
        申込＋振込集計
      ========================= */
      $selects2 = [];
      $bindings2 = [];

      foreach ($mediaList as $key => $label) {
          $selects2[] = "IFNULL(SUM(a.from_url = ?),0) AS {$label}";
          $selects2[] = "IFNULL(SUM(a.from_url = ? AND b.status_total='代金振込済'),0) AS {$label}振込";
          $bindings2[] = $key;
          $bindings2[] = $key;
      }

      $bindings2 = array_merge($bindings2, [$st_h, $fn_h]);

      $item2 = DB::select("
          SELECT
              COALESCE(DATE_FORMAT(b.created_at,'%Y/%m/%d'),'total') AS day,
              COUNT(a.id) AS 件数,
              ".implode(',', $selects2)."
          FROM users a
          LEFT JOIN user_items b ON a.id = b.user_id
          WHERE b.created_at BETWEEN ? AND ?
            AND b.id IN ({$inkt2})
          GROUP BY DATE_FORMAT(b.created_at,'%Y%m%d') WITH ROLLUP
      ", $bindings2);

      $item2 = !empty($item2) ? $item2 : null;

      return view('media.index', compact('request','item','item2','mediaList'));
  }

  public function index3(Request $request)
  {

    if(!$request->tyear && !$request->tmonth){
      $request->tyear = date('Y');
      $request->tmonth = date('m');
      $item = "";
    }else{
      $st_h = $request->tyear."-".$request->tmonth."-01 00:00:00";
      $fn_h = $request->tyear."-".$request->tmonth."-31 23:59:59";

      $item = DB::select('SELECT 
              coalesce(date_format(a.created_at,"%Y/%m/%d"),"total") as day 
              ,count(a.id) as 件数 
              ,IFNULL(sum(a.from_url="lp3"),0) as LP3 
              FROM users a 
              WHERE a.from_url IN (?) AND a.created_at BETWEEN ? AND ?
              GROUP BY DATE_FORMAT(a.created_at,"%Y%m%d") with rollup', ['lp3', $st_h, $fn_h]);

    }


    // $item2 = DB::select('SELECT COUNT(*) as cnt FROM users WHERE from_url = ? AND created_at BETWEEN ? AND ? ',['lp3', $st_h,$fn_h ]);


    return view('media.index3', compact('request','item'));
    
  }

  // lp用の集計
  public function indexlp(Request $request)
  {

    if(!$request->tyear && !$request->tmonth){
      $request->tyear = date('Y');
      $request->tmonth = date('m');
      $item = "";
      $item2 = "";
    }else{
      $st_h = $request->tyear."-".$request->tmonth."-01 00:00:00";
      $fn_h = $request->tyear."-".$request->tmonth."-31 23:59:59";

      $item = DB::select('SELECT 
              coalesce(date_format(a.created_at,"%Y/%m/%d"),"total") as day 
              ,count(a.id) as 件数 
              ,IFNULL(sum(a.from_url="lp"),0) as LP
              ,IFNULL(sum(a.from_url="lp_jo"),0) as LPJO
              ,IFNULL(sum(a.from_url="lp_mt"),0) as LPMT
              ,IFNULL(sum(a.from_url="lp_ag"),0) as LPAG
              ,IFNULL(sum(a.from_url="lp_sm"),0) as LPSM
              ,IFNULL(sum(a.from_url="lp_kr"),0) as LPKR
              FROM users a 
              WHERE a.from_url IN (?,?,?,?,?,?) AND a.created_at BETWEEN ? AND ?
              GROUP BY DATE_FORMAT(a.created_at,"%Y%m%d") with rollup', ['lp','lp_jo','lp_mt','lp_ag','lp_sm','lp_kr', $st_h, $fn_h]);


      //リピーターなしの集計
      $all_id = DB::select('SELECT 
                a.id 
                FROM user_items a 
                LEFT JOIN users b ON a.user_id = b.id 
                GROUP BY a.user_id 
                ORDER BY a.created_at, a.id ASC');
      //IN句を形成
      $ink2 = "";
      //IN句を形成
      $cc = count($all_id);
      if($cc){
        foreach($all_id as $k=>$v){
          // $ink1  .= "?,";
          $ink2 .= $v->id.",";
        }
      }
      // $inkt1 = trim($ink1,",");
      $inkt2 = trim($ink2,",");
      if(empty($inkt2)) $inkt2 = "0"; // 空の場合は "0" を設定
// dd($inkt2);
      $item2 = DB::select('SELECT 
              coalesce(date_format(b.created_at,"%Y/%m/%d"),"total") as day 
              ,count(a.id) as 件数 
              ,IFNULL(sum(a.from_url="lp"),0) as LP 
              ,IFNULL(sum(a.from_url="lp" AND b.status_total="代金振込済"),0) as LP振込
              ,IFNULL(sum(a.from_url="lp_jo"),0) as LPJO 
              ,IFNULL(sum(a.from_url="lp_jo" AND b.status_total="代金振込済"),0) as LPJO振込
              ,IFNULL(sum(a.from_url="lp_mt"),0) as LPMT 
              ,IFNULL(sum(a.from_url="lp_mt" AND b.status_total="代金振込済"),0) as LPMT振込
              ,IFNULL(sum(a.from_url="lp_ag"),0) as LPAG
              ,IFNULL(sum(a.from_url="lp_ag" AND b.status_total="代金振込済"),0) as LPAG振込
              ,IFNULL(sum(a.from_url="lp_sm"),0) as LPSM
              ,IFNULL(sum(a.from_url="lp_sm" AND b.status_total="代金振込済"),0) as LPSM振込
              ,IFNULL(sum(a.from_url="lp_kr"),0) as LPKR
              ,IFNULL(sum(a.from_url="lp_kr" AND b.status_total="代金振込済"),0) as LPKR振込
              FROM users a 
              LEFT JOIN user_items b ON a.id = b.user_id 
              WHERE b.created_at BETWEEN ? AND ? 
              AND b.id IN ('.$inkt2.') 
              GROUP BY DATE_FORMAT(b.created_at,"%Y%m%d") with rollup',[ $st_h,$fn_h ]);



    }
    // データが空の場合は null にする
    $item2 = !empty($item2) ? $item2 : null;
    return view('media.indexlp', compact('request','item','item2'));
    
  }






















  
}

