<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KanriAPIController extends Controller
{
   // indexアクションを定義（indexメソッドの定義と同義)
   public function index(Request $request, $kana_r, $birthday_r)
   {
      //配列　店名、名前、カナ、電話番号、生年月日、貸出日、金額、ステータス、状況
      if($kana_r && $birthday_r){
         $kana = $kana_r;
         $birthday = date('Y/m/d',strtotime($birthday_r));

        if($kana_r != '12345' && $birthday_r != '00000000'){//両方ありの場合
            $hmquery = DB::select('SELECT "SN" as shop,a.id,a.name,b.kana,a.mobile,b.birthday,c.created_at,c.judge_price,c.status_total,c.status_paid 
                    FROM user_items c 
                    LEFT JOIN users a ON c.user_id = a.id 
                    LEFT JOIN user_data b ON a.id = b.user_id 
                    WHERE REPLACE(REPLACE(b.kana, " ", ""), "　", "") LIKE ? AND b.birthday = ?',[ '%'.$kana.'%', $birthday ]);
        }elseif($birthday_r != '00000000' && $kana_r == '12345'){//かななし
            $hmquery = DB::select('SELECT "SN" as shop,a.id,a.name,b.kana,a.mobile,b.birthday,c.created_at,c.judge_price,c.status_total,c.status_paid 
                    FROM user_items c 
                    LEFT JOIN users a ON c.user_id = a.id 
                    LEFT JOIN user_data b ON a.id = b.user_id 
                    WHERE b.birthday = ?',[ $birthday ]);
        }elseif($kana_r != '12345' && $birthday_r == '00000000'){//たんなし
            $hmquery = DB::select('SELECT "SN" as shop,a.id,a.name,b.kana,a.mobile,b.birthday,c.created_at,c.judge_price,c.status_total,c.status_paid 
                    FROM user_items c 
                    LEFT JOIN users a ON c.user_id = a.id 
                    LEFT JOIN user_data b ON a.id = b.user_id 
                    WHERE REPLACE(REPLACE(b.kana, " ", ""), "　", "") LIKE ? ',[ '%'.$kana.'%']);
        }

         //配列の結合
         $arr = array_merge($hmquery);
        //  dd($arr);
         return response()->json($arr);

      }else{
         return response()->json(404);
      }

   }

   public function show($id)
   {
      if($id){
          $hmquery = DB::select('SELECT * FROM users INNER JOIN user_data 
                        ON users.id = user_data.user_id WHERE users.id = ?',[ $id ]);

      $hmquery_data = DB::select('SELECT c.id as item_id,c.item_name,c.way,c.status_total,c.status_paid,c.judge_price,c.user_agree,c.created_at, a.id,a.name,a.mobile,b.kana,c.price,c.status_judge,c.memo, b.memo as umemo
                      FROM user_items c 
                      LEFT JOIN users a ON c.user_id = a.id 
                      LEFT JOIN user_data b ON a.id = b.user_id 
                      WHERE a.id = ?',[ $id ]);
        // dd($hmquery_data);
        $arr = ["show" => $hmquery, "item" => $hmquery_data];
        // dd($arr);
        return response()->json($arr);
      }else{
        return response()->json(404);
      }
    }
      public function oudan(Request $request, $kana_r, $birthday_r)
      {

          //配列　店名、名前、カナ、電話番号、生年月日、貸出日、金額、ステータス、状況
          if($kana_r && $birthday_r){
            $kana = $kana_r;
            $birthday = date('Y/m/d',strtotime($birthday_r));

            if($birthday_r != "00000000"){//バースデーがあれば
                $hmquery = DB::select('SELECT "SN" as shop,"-" as services, a.name,b.kana,a.mobile,b.birthday,c.created_at,c.judge_price,c.status_total,"-" as pay_in,"-" as pay_total,c.status_paid 
                        FROM user_items c 
                        LEFT JOIN users a ON c.user_id = a.id 
                        LEFT JOIN user_data b ON a.id = b.user_id 
                        WHERE REPLACE(REPLACE(b.kana, " ", ""), "　", "") LIKE ? AND b.birthday = ? ORDER BY c.created_at DESC',[ '%'.$kana.'%', $birthday ]);
            }else{//
                $hmquery = DB::select('SELECT "SN" as shop,"-" as services, a.name,b.kana,a.mobile,b.birthday,c.created_at,c.judge_price,c.status_total,"-" as pay_in,"-" as pay_total,c.status_paid 
                        FROM user_items c 
                        LEFT JOIN users a ON c.user_id = a.id 
                        LEFT JOIN user_data b ON a.id = b.user_id 
                        WHERE REPLACE(REPLACE(b.kana, " ", ""), "　", "") LIKE ? ORDER BY c.created_at DESC',[ '%'.$kana.'%']);
            }
            //配列の結合
            $arr = $hmquery;
            //  dd($arr);
            return response()->json($arr);

          }else{
            return response()->json(404);
          }

      }

      public function total(Request $request, $st, $fn)
      {

          if($st && $fn){
            $st_h = $st." 00:00:00";
            $fn_h = $fn." 23:59:59";
            // dd($st_h,$fn_h);

            $hmquery = DB::select('SELECT 
                          coalesce(DATE_FORMAT(a.created_at, "%Y/%m/%d"),"total") as day 
                          ,count(a.id) as 件数 
                          ,count(b.from_url="lp") as lp 
                          ,sum(a.judge_price) as 査定金額合計 
                          ,sum(a.judge_price*(a.status_total="代金振込済")) as 代金振込済金額合計
                          ,sum(a.status_total="査定中") as 査定中
                          ,sum(a.status_total="書類不備") as 書類不備
                          ,sum(a.status_total="査定完了（買取不可）") as 査定完了（買取不可）
                          ,sum(a.status_total="ケリ") as ケリ
                          ,sum(a.status_total="詐欺") as 詐欺
                          ,sum(a.status_total="査定完了（買取可）") as 査定完了（買取可）
                          ,sum(a.status_total="代金振込済") as 代金振込済 
                          ,sum(a.status_paid="商品到着待") as 商品到着待 
                          ,sum(a.status_paid="取引完了") as 取引完了 
                          ,sum(a.status_paid="取引完了遅延") as 取引完了遅延 
                          ,sum(a.status_paid="商品到着済") as 商品到着済 
                          FROM user_items a 
                          LEFT JOIN users b ON a.user_id = b.id 
                          WHERE a.created_at BETWEEN ? AND ? 
                          GROUP BY DATE_FORMAT(a.created_at,"%Y%m%d") with rollup',[ $st_h,$fn_h ]);
                          // dd($hmquery);
            //配列の結合
            $arr = $hmquery;
            //  dd($arr);
            return response()->json($arr);

          }else{
            return response()->json(404);
          }

      }







}