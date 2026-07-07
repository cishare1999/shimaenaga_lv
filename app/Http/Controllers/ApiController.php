<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{

    public function fetchData($kana, $birthday)
    {
        //API でセンターに情報問合せ
        $context = stream_context_create(array(
          'http' => array(
              'ignore_errors' => true,
              'method'  => 'GET', 
              'timeout' => 100),
          'ssl' => array(
              'verify_peer'      => false,
              'verify_peer_name' => false
          )
        ));

        $kana = str_replace(array(" ", "　"), "", $kana);
        $birthday = date("Ymd", strtotime($birthday));
        $url = config('app.kanri_api_url') . $kana . '/' . $birthday;
        $response = Http::get($url);
        // $json = file_get_contents($url, false, $context);
        // $json_data = json_decode($json);  // JSONを配列に
        // dd($json_data);
    
        
        // 正常ならViewに渡す
        // if ($json_data) {
        //   $reports = $json_data;
        // } else {
        //   $reports = null;
        // } 


        return $response->json();
    }

}
