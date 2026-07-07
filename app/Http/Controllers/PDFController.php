<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserData;
use App\UserItem;

use PDF;

class PDFController extends Controller
{
    public function index(){

    	// $pdf = PDF::loadHTML('<h1>Hello World</h1>');
        $pdf = PDF::loadView('admin.list.contract_pdf');

    	return $pdf->download('date.pdf');

    }
}