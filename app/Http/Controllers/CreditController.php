<?php
/**
 * Created by IntelliJ IDEA.
 * User: asantha
 * Date: 2/10/2018
 * Time: 8:39 PM
 */

namespace App\Http\Controllers;


use App\Credit_payment;
use App\Customer;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class CreditController extends Controller
{

    public function index(){

       $credits = Credit_payment::all();
       $data['credits'] = $credits;
       return view('credits.credits', $data);
    }

    public function addCreditPayment(Request $request){

        $this->validate($request,[

            'customer_name' => 'required',
            'outstanding' => 'required'
        ]);

        $credit = new Credit_payment;
        $credit->customer_id = $request->input('customer_name');
        $credit->outstanding_amount = $request->input('outstanding');
        $credit->amount_paid = 0;
        $credit->amount_paid_date = date('Y-m-d H:i:s');

        $credit->save();
        $request->session()->flash('success','Credit Added Successfully!!!');
        return redirect()->to('/credits');
    }

    public function updateCreditPayment(Request $request){

        $this->validate($request,[

            'customer_name' => 'required',
            'outstanding' => 'required'
        ]);

        $credit = Credit_payment::find($request->input('creditID'));
        $credit->customer_id = $request->input('customer_name');
        $credit->outstanding_amount = $request->input('outstanding');
        $credit->amount_paid = $request->input('amount_paid');
        if($request->input('date'))
            $credit->amount_paid_date = date('Y-m-d H:i:s', strtotime($request->input('date')));
        else
            $credit->amount_paid_date = date('Y-m-d H:i:s');

        $credit->save();
        $request->session()->flash('success','Credit Updated Successfully!!!');
        return redirect()->to('/credits');
    }

    public function deleteCreditPayment(Request $request){

        $this->validate($request,[

            'customer_name' => 'required',
            'outstanding' => 'required'
        ]);

        Credit_payment::destroy($request->input('creditID'));
        $request->session()->flash('success','Credit Deleted Successfully!!!');
        return redirect()->to('/credits');
    }

    public function editCreditPayment($creditID){

        $credit = Credit_payment::find($creditID);
        $customers = Customer::all();
        $data['credit_data'] = $credit;
        $data['customers_list'] = load_combo_fromdb($customers,'customerID','customer_name',$credit->customer_id);
        $data['status'] = 'Edit';
        $data['disable'] = '';
        $data['action'] = 'updatecredit';
        return view('credits.editcredits', $data);
    }

    public function removeCreditPayment($creditID){

        $credit = Credit_payment::find($creditID);
        $customers = Customer::all();
        $data['credit_data'] = $credit;
        $data['customers_list'] = load_combo_fromdb($customers,'customerID','customer_name',$credit->customer_id);
        $data['status'] = 'Remove';
        $data['disable'] = '';
        $data['action'] = 'deletecredit';
        return view('credits.editcredits', $data);
    }

    public function viewCreditPayment($creditID){

        $credit = Credit_payment::find($creditID);
        $customers = Customer::all();
        $data['credit_data'] = $credit;
        $data['customers_list'] = load_combo_fromdb($customers,'customerID','customer_name',$credit->customer_id);
        $data['status'] = 'View';
        $data['disable'] = '';
        $data['action'] = '#';
        return view('credits.editcredits', $data);
    }

    public function saveCreditPayment(){

        $customers = Customer::all();
        $data['customers_list'] = load_combo_fromdb($customers,'customerID','customer_name','Please Select a Customer');
        return view('credits.addcredits',$data);
    }
}