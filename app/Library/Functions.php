<?php
namespace App\Library;
use App\User;
use App\UserData;
use App\UserItem;
class Functions
{
    public static function dateYmd($birthday)
    {
        if(strpos($birthday,'-')){
            $birthday = str_replace('-','/',$birthday);
        }else{
            $birthday = $birthday;
        }
        return $birthday;

    }
    public static function dateYmdHi($date)
    {
        if($date != NULL || $date != ''){
            if($date === '0000-00-00 00:00:00'){
                $date = "-";
            }else{
                $date = date('Y/m/d H:i', strtotime($date));
            }
        }else{
            $date = "-";
        }
        return $date;

    }
    //年齢を出す関数
    public static function ageFunc($birthday)
    {
        $now = date("Ymd");
        $birthday = str_replace("/", "", $birthday);//ハイフンを除去しています。
        $age = "(".floor(($now-$birthday)/10000).'歳)';
        return $age;
    }
    //集計で日付を変換する関数
    public static function tdateFnc($date)
    {
        $tdate = date("Y-m-d", strtotime($date));
        return $tdate;
    }

    //日付を変換する関数
    public static function hisDateFnc($date)
    {
        $tdate = date("Y/m/d", strtotime($date));
        return $tdate;
    }


    //ユーザー一覧に買取情報があるかどうかチェックする関数
    public static function userItemChk($id)
    {
        $item = UserItem::where('user_id', $id)->first();
        if($item){
            $chk = "yes";
        }else{
            $chk = "no";
        }

        return $chk;
    }
    //西暦から和暦を出す関数
    public static function wareki($year) {
        $eras = [
            ['year' => 2018, 'name' => '令和'],
            ['year' => 1988, 'name' => '平成'],
            ['year' => 1925, 'name' => '昭和'],
            ['year' => 1911, 'name' => '大正'],
            ['year' => 1867, 'name' => '明治']
        ];
        foreach($eras as $era) {
            $base_year = $era['year'];
            $era_name = $era['name'];
    
            if($year > $base_year) {
                $era_year = $year - $base_year;
                if($era_year === 1) {
                    return $era_name .'元年';
                }
                return $era_name . $era_year .'年';
            }
        }
        return null;
    }
    //生年月日　年
    public static function birth_year()
    {
        $arr = array();
        for ($i=1930; $i <= 2019; $i++) {
            $arr[] = $i;
        }

        return $arr;
    }

}