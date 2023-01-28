<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use App\Models\OperatorMaster;
use App\Models\Billing;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index(){
        $op_master = OperatorMaster::all();
        $pay_method = PaymentMethod::all();

        return view('pages.operator', [
            'op_master' => $op_master,
            'pay_method' => $pay_method
        ]);
    }

    public function create(Request $request){
        $request->validate([
            'operator' => 'required',
            'nama-menara' => 'required',
            'email' => 'required'
        ]);

        $data = new Operator();
        
        $id_operator = $request->input('operator'); 
        $data->id_operator = $id_operator;
        $data->menara_name = $request->input('nama-menara');
        $data->email = $request->input('email');
        $data->address = $request->input('address');
        $data->city = $request->input('city');
        $data->country = $request->input('country');
        $data->postal = $request->input('postal');
        $data->longtitude = $request->input('longtitude');
        $data->latitude = $request->input('latitude');
        $data->status = 'Deactivated';
        $data->company = $request->input('company');
        $data->save();
        
        $bill = new Billing();
        $bill->id_menara = $data->id;
        $bill->id_operator = $id_operator;
        $pack_harga = $request->input('pack_harga');
        $date = date_create(date("Y-m-d"));
        switch ($pack_harga) {
            case '1':
                $amount = 100000;
                date_add($date,date_interval_create_from_date_string("1 months"));
                break;
            case '2':
                $amount = 280000;
                date_add($date,date_interval_create_from_date_string("3 months"));
                break;
            case '3':
                $amount = 520000;
                date_add($date,date_interval_create_from_date_string("6 months"));
                break;
            case '4':
                $amount = 1000000;
                date_add($date,date_interval_create_from_date_string("1 years"));
                break;
        }
        $bill->amount = $amount;
        $bill->due_date = date_format($date,"Y-m-d");
        $bill->payment_method = $request->input('payment_method');
        $bill->payment_status = 'Pending';

        $vat = Billing::all()->last();
        $vat_num_str = substr($vat, 3, 4);
        $vat_num = (int)$vat_num_str + 1;
        $bill->vat_number = 'VAT'. $vat_num;
        $bill->save();
    
        if ($bill->save()) {
            $status = 'Data Has been saved';
        } else {
            $status = 'Data failed';
        }

        return redirect()->route('operator')->with('status', $status);
    }
}
