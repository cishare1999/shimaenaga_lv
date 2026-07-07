<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\UserData;
use App\UserItem;
use Illuminate\Support\Facades\DB;

class AdminTotalizationController extends Controller
{
//   public function index(Request $request)
//   {
//     if(!$request->tyear && !$request->tmonth){
//       $request->tyear = date('Y');
//       $request->tmonth = date('m');
//       $item = "";
//       $item2 = "";
//     }else{
//       $st_h = $request->tyear."-".$request->tmonth."-01 00:00:00";
//       $fn_h = $request->tyear."-".$request->tmonth."-31 23:59:59";


//       //リピーターなしの集計
//       $all_id = DB::select('SELECT 
//                 a.id 
//                 FROM user_items a 
//                 LEFT JOIN users b ON a.user_id = b.id 
//                 GROUP BY a.user_id 
//                 ORDER BY a.created_at, a.id ASC');
//       //IN句を形成
//       $cc = count($all_id);
//       if($cc){
//         // $ink1 = "";
//         $ink2 = "";
//         foreach($all_id as $k=>$v){
//           // $ink1  .= "?,";
//           $ink2 .= $v->id.",";
//         }
//       }else{
//         $ink2 = 0;
//       }
//       // $inkt1 = trim($ink1,",");

//       $inkt2 = trim($ink2,",");
// // dd($inkt2);
//       $item = DB::select('SELECT 
//               coalesce(date_format(b.created_at,"%Y/%m/%d"),"total") as day 
//               ,count(a.id) as 件数 
//               ,IFNULL(sum(a.from_url is null),0) as 一般 
//               ,IFNULL(sum(a.from_url is null AND b.status_total="代金振込済"),0) as 一般振込
//               ,IFNULL(sum(a.from_url="lp"),0) as 情報館 
//               ,IFNULL(sum(a.from_url="lp" AND b.status_total="代金振込済"),0) as 情報館振込
//               ,IFNULL(sum(a.from_url="lp_jo"),0) as LPJO 
//               ,IFNULL(sum(a.from_url="lp_jo" AND b.status_total="代金振込済"),0) as LPJO振込
//               ,IFNULL(sum(a.from_url="lp_mt"),0) as LPMT 
//               ,IFNULL(sum(a.from_url="lp_mt" AND b.status_total="代金振込済"),0) as LPMT振込
//               ,IFNULL(sum(a.from_url="lp_ag"),0) as LPAG 
//               ,IFNULL(sum(a.from_url="lp_ag" AND b.status_total="代金振込済"),0) as LPAG振込
//               ,IFNULL(sum(a.from_url="lp_sm"),0) as LPSM
//               ,IFNULL(sum(a.from_url="lp_sm" AND b.status_total="代金振込済"),0) as LPSM振込
//               ,IFNULL(sum(a.from_url="lp_kr"),0) as LPKR
//               ,IFNULL(sum(a.from_url="lp_kr" AND b.status_total="代金振込済"),0) as LPKR振込
//               ,IFNULL(sum(a.from_url="sms"),0) as 配信 
//               ,IFNULL(sum(a.from_url="sms" AND b.status_total="代金振込済"),0) as 配信振込
//               ,IFNULL(sum(a.from_url="lp2"),0) as A8 
//               ,IFNULL(sum(a.from_url="lp2" AND b.status_total="代金振込済"),0) as A8振込
//               ,IFNULL(sum(a.from_url="lp3"),0) as LP3 
//               ,IFNULL(sum(a.from_url="lp3" AND b.status_total="代金振込済"),0) as lp3振込
//               ,IFNULL(sum(a.from_url="lp4"),0) as LP4 
//               ,IFNULL(sum(a.from_url="lp4" AND b.status_total="代金振込済"),0) as lp4振込
//               ,IFNULL(sum(a.from_url="lp2seo"),0) as LP2SEO 
//               ,IFNULL(sum(a.from_url="lp2seo" AND b.status_total="代金振込済"),0) as lp2seo振込
//               ,IFNULL(sum(a.from_url="lp2lis"),0) as LP2LIS 
//               ,IFNULL(sum(a.from_url="lp2lis" AND b.status_total="代金振込済"),0) as lp2lis振込
//               ,IFNULL(sum(a.from_url="lp2afi"),0) as LP2AFI 
//               ,IFNULL(sum(a.from_url="lp2afi" AND b.status_total="代金振込済"),0) as lp2afi振込
//               FROM users a 
//               LEFT JOIN user_items b ON a.id = b.user_id 
//               WHERE b.created_at BETWEEN ? AND ? 
//               AND b.id IN ('.$inkt2.') 
//               GROUP BY DATE_FORMAT(b.created_at,"%Y%m%d") with rollup',[ $st_h,$fn_h ]);



//       //リピーターありの集計
//       // $item = DB::select('SELECT 
//       //         coalesce(date_format(a.created_at,"%Y/%m/%d"),"total") as day 
//       //         ,count(a.id) as 件数 
//       //         ,IFNULL(sum(a.from_url is null),0) as 一般 
//       //         ,IFNULL(sum(a.from_url is null AND b.status_total="代金振込済"),0) as 一般振込
//       //         ,IFNULL(sum(a.from_url="lp"),0) as 情報館 
//       //         ,IFNULL(sum(a.from_url="lp" AND b.status_total="代金振込済"),0) as 情報館振込
//       //         ,IFNULL(sum(a.from_url="sms"),0) as 配信 
//       //         ,IFNULL(sum(a.from_url="sms" AND b.status_total="代金振込済"),0) as 配信振込
//       //         ,IFNULL(sum(a.from_url="lp2"),0) as A8 
//       //         ,IFNULL(sum(a.from_url="lp2" AND b.status_total="代金振込済"),0) as A8振込
//       //         ,IFNULL(sum(a.from_url="lp3"),0) as LP3 
//       //         ,IFNULL(sum(a.from_url="lp3" AND b.status_total="代金振込済"),0) as lp3振込
//       //         ,IFNULL(sum(a.from_url="lp4"),0) as LP4 
//       //         ,IFNULL(sum(a.from_url="lp4" AND b.status_total="代金振込済"),0) as lp4振込
//       //         FROM users a 
//       //         LEFT JOIN user_items b ON a.id = b.user_id 
//       //         WHERE a.created_at BETWEEN ? AND ? 
//       //         GROUP BY DATE_FORMAT(a.created_at,"%Y%m%d") with rollup',[ $st_h,$fn_h ]);

//       //2023.08.17 追加　新しいメディア用の会員登録したらカウントする集計
//       // $item2 = DB::select('SELECT COUNT(*) as cnt FROM users WHERE from_url = ? AND created_at BETWEEN ? AND ? ',['lp3', $st_h,$fn_h ]);
//       $item2 = DB::select('SELECT 
//                 coalesce(date_format(a.created_at,"%Y/%m/%d"),"total") as day 
//                 ,count(a.id) as 件数 
//                 ,IFNULL(sum(a.from_url is null),0) as 一般 
//                 ,IFNULL(sum(a.from_url="lp"),0) as 情報館 
//                 ,IFNULL(sum(a.from_url="lp_jo"),0) as LPJO 
//                 ,IFNULL(sum(a.from_url="lp_mt"),0) as LPMT 
//                 ,IFNULL(sum(a.from_url="lp_ag"),0) as LPAG 
//                 ,IFNULL(sum(a.from_url="lp_sm"),0) as LPSM 
//                 ,IFNULL(sum(a.from_url="lp_kr"),0) as LPKR 
//                 ,IFNULL(sum(a.from_url="sms"),0) as 配信 
//                 ,IFNULL(sum(a.from_url="lp2"),0) as A8 
//                 ,IFNULL(sum(a.from_url="lp3"),0) as LP3 
//                 ,IFNULL(sum(a.from_url="lp4"),0) as LP4 
//                 ,IFNULL(sum(a.from_url="lp2seo"),0) as LP2SEO 
//                 ,IFNULL(sum(a.from_url="lp2lis"),0) as LP2LIS 
//                 ,IFNULL(sum(a.from_url="lp2afi"),0) as LP2AFI 
//                 FROM users a 
//                 WHERE a.created_at BETWEEN ? AND ? 
//                 GROUP BY DATE_FORMAT(a.created_at,"%Y%m%d") with rollup',[ $st_h,$fn_h ]);
//       // dd($item2);



//       // dd($hmquery);

      
//     }


//     // return view('admin.totalization.index', compact('request','item'));
//     return view('admin.totalization.index', compact('request','item','item2'));
//   }

  public function index(Request $request)
  {
      // ============================
      // 流入元定義（ここだけ編集）
      // ============================
      $mediaList = [
          'null'    => ['name' => '一般'],
          'lp'      => ['name' => '情報館'],
          'lp_jo'   => ['name' => 'LPJO'],
          'lp_mt'   => ['name' => 'LPMT'],
          'lp_kr'   => ['name' => 'LPKR'],
          'lp_mi'   => ['name' => 'LPMI'],
          'lp_bl'   => ['name' => 'LPBL'],
          'lp_cc'   => ['name' => 'LPCC'],
          'lp_mc'   => ['name' => 'LPMC'],
          'lp_am'   => ['name' => 'LPAM'],
          'sms'     => ['name' => '配信'],
          'lp2'     => ['name' => 'A8'],
          'lp3'     => ['name' => 'LP3'],
          'lp4'     => ['name' => 'LP4'],

          // 追加メディア
          'lp2seo'  => ['name' => 'LP2SEO'],
          'lp2lis'  => ['name' => 'LP2LIS'],
          'lp2afi'  => ['name' => 'LP2AFI'],
          'lp2seo1' => ['name' => 'LP2SEO1'],
          'lp2seo2' => ['name' => 'LP2SEO2'],
          'lp2seo3' => ['name' => 'LP2SEO3'],
          'lp2seo4' => ['name' => 'LP2SEO4'],
          'lp2seo5' => ['name' => 'LP2SEO5'],
          'lp2seo6' => ['name' => 'LP2SEO6'],
      ];

      // ============================
      // 初期表示
      // ============================
      if (!$request->tyear || !$request->tmonth) {
          $request->tyear  = date('Y');
          $request->tmonth = date('m');

          return view('admin.totalization.index', compact('request'))
              ->with([
                  'item'      => null,
                  'item2'     => null,
                  'mediaList' => $mediaList,
              ]);
      }

      $st_h = "{$request->tyear}-{$request->tmonth}-01 00:00:00";
      $fn_h = "{$request->tyear}-{$request->tmonth}-31 23:59:59";

      // ==================================================
      // 初回申込ID取得（リピーター除外）
      // ==================================================
      $firstItemIds = DB::select("
          SELECT MIN(id) AS id
          FROM user_items
          GROUP BY user_id
      ");

      $firstIds = collect($firstItemIds)->pluck('id')->all();
      if (empty($firstIds)) {
          $firstIds = [0];
      }

      $firstIdIn = implode(',', $firstIds);

      // ==================================================
      // ① 会員登録後 → 初回買取申込（＋送金）
      // ==================================================
      $selects = [];
      $bindings = [];

      foreach ($mediaList as $key => $m) {
          if ($key === 'null') {
              $selects[] = "
                  IFNULL(SUM(a.from_url IS NULL),0) AS {$m['name']},
                  IFNULL(SUM(a.from_url IS NULL AND b.status_total='代金振込済'),0) AS {$m['name']}振込
              ";
          } else {
              $selects[] = "
                  IFNULL(SUM(a.from_url=?),0) AS {$m['name']},
                  IFNULL(SUM(a.from_url=? AND b.status_total='代金振込済'),0) AS {$m['name']}振込
              ";
              $bindings[] = $key;
              $bindings[] = $key;
          }
      }

      $bindings = array_merge($bindings, [$st_h, $fn_h]);

      $item = DB::select("
          SELECT
              COALESCE(DATE_FORMAT(b.created_at,'%Y/%m/%d'),'total') AS day,
              COUNT(a.id) AS 件数,
              ".implode(',', $selects)."
          FROM users a
          LEFT JOIN user_items b ON a.id = b.user_id
          WHERE b.created_at BETWEEN ? AND ?
            AND b.id IN ({$firstIdIn})
          GROUP BY DATE_FORMAT(b.created_at,'%Y%m%d') WITH ROLLUP
      ", $bindings);

      // ==================================================
      // ② 会員登録時点の集計
      // ==================================================
      $selects2 = [];
      $bindings2 = [];

      foreach ($mediaList as $key => $m) {
          if ($key === 'null') {
              $selects2[] = "IFNULL(SUM(a.from_url IS NULL),0) AS {$m['name']}";
          } else {
              $selects2[] = "IFNULL(SUM(a.from_url=?),0) AS {$m['name']}";
              $bindings2[] = $key;
          }
      }

      $bindings2 = array_merge($bindings2, [$st_h, $fn_h]);

      $item2 = DB::select("
          SELECT
              COALESCE(DATE_FORMAT(a.created_at,'%Y/%m/%d'),'total') AS day,
              COUNT(a.id) AS 件数,
              ".implode(',', $selects2)."
          FROM users a
          WHERE a.created_at BETWEEN ? AND ?
          GROUP BY DATE_FORMAT(a.created_at,'%Y%m%d') WITH ROLLUP
      ", $bindings2);

      return view('admin.totalization.index', compact(
          'request',
          'item',
          'item2',
          'mediaList'
      ));
  }



  public function show($tdate)
  {
    $st_h = $tdate." 00:00:00";
    $fn_h = $tdate." 23:59:59";
    // $fn_h = date("Y-m-d", strtotime('last day of'.$tdate))." 23:59:59";

      //リピーターなしの集計
      $all_id = DB::select('SELECT 
                a.id 
                FROM user_items a 
                LEFT JOIN users b ON a.user_id = b.id 
                GROUP BY a.user_id 
                ORDER BY a.created_at, a.id ASC');
      //IN句を形成
      $cc = count($all_id);
      if($cc){
        // $ink1 = "";
        $ink2 = "";
        foreach($all_id as $k=>$v){
          // $ink1  .= "?,";
          $ink2 .= $v->id.",";
        }
      }
      // $inkt1 = trim($ink1,",");
      $inkt2 = trim($ink2,",");
      
      $item = DB::select('SELECT a.id,a.user_id,b.name,b.from_url,a.status_total,a.created_at FROM user_items a
                LEFT JOIN users b ON a.user_id = b.id  
                WHERE 
                a.id IN ('.$inkt2.') 
                AND a.created_at BETWEEN ? AND ? ORDER BY from_url ASC',[ $st_h,$fn_h ]);

      // dd($item);

    return view('admin.totalization.show', compact('tdate','item',));
  }

}
