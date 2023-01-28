<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Operator;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{
    public function index(){
        $card = PaymentMethod::first();
        $bill = DB::table('billings')
                    ->leftJoin('operators','billings.id_operator','=', 'operators.id')
                    ->leftJoin('operator_masters', 'operator_masters.id', '=','billings.id_operator')
                    ->select('billings.*', 'operators.email', 'operators.company', 'operator_masters.operator_name')
                    ->where('payment_status', '=', 'Pending')
                    ->get();
        
        $paid = number_format(Billing::where('payment_status', 'Paid')->sum('amount'),0,',','.');
        $pending = number_format(Billing::where('payment_status', 'Pending')->sum('amount'),0,',','.');

        $date = date_create(date("Y-m-d"));
        $date2 = date_format($date,"Y-m-d%",);
        $date_str = substr($date2, 0,10);
        $hist_news = DB::table('billings')
                    ->leftJoin('operators','billings.id_menara','=', 'operators.id')
                    ->select('billings.*', 'operators.menara_name')
                    ->whereDate('billings.created_at', $date_str)
                    ->get();
        
        date_add($date,date_interval_create_from_date_string("-1 days"));
        $date2 = date_format($date,"Y-m-d%",);
        $date_str = substr($date2, 0,10);
        $hist_yests = DB::table('billings')
                    ->leftJoin('operators','billings.id_menara','=', 'operators.id')
                    ->select('billings.*', 'operators.menara_name')
                    ->whereDate('billings.created_at', $date_str)
                    ->get();

        return view('pages.billing', [
            'card' => $card,
            'bill' => $bill,
            'paid' => $paid,
            'pending' => $pending,
            'hist_news' => $hist_news,
            'hist_yests' => $hist_yests
        ]);
    }

    public function invoice(){

    }

    public function trasaction(){

    }

    public function payment_method(){

    }

    public function confirm_payment(string $id){
        $data = Billing::find($id);
        $data->payment_status = 'Paid';
        $data->save();

        $operator = Operator::find($data->id_menara);
        $operator->status = 'Active';
        $operator->save();

        return redirect()->route('page', [ 'page' => 'billing']);
    }   
}
