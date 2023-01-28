<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterDataController extends Controller
{
    public function show(){
        $data = DB::table('operators')
        ->leftJoin('operator_masters','operator_masters.id','=', 'operators.id_operator')
        ->get();
        return view('pages.master-data', ['data' => $data]);
    }
}
