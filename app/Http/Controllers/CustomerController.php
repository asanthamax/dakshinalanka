<?php
/**
 * Created by IntelliJ IDEA.
 * User: asantha
 * Date: 1/2/2018
 * Time: 9:43 PM
 */

namespace App\Http\Controllers;


use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function add_user(){

        return view('customers.addcustomer');
    }

    public function index(){

        $customers = Customer::all();
        return view('customers.customers',['customers' => $customers]);
    }

    public function save_customer(Request $request){

        $this->validate($request,[

            'customer_name' => 'required',
            'contact_no' => ['bail', 'required','numeric','regex:/(0)(1|7)[0-9]{1}[0-9]{7}/'],
            'customer_email' => 'bail|required|email'
        ]);


        $address = strip_tags($request->input('address'));

        $customer = new Customer;
        $customer->customer_name = $request->input('customer_name');
        $customer->contact_no = $request->input('contact_no');
        $customer->customer_email = $request->input('customer_email');
        $customer->customer_address = $request->input('customer_address');

        $customer->save();
        $request->session()->flash('success','Customer Inserted Successfully!!!');
        return redirect()->to('/customers');
    }

    public function update_customer(Request $request){

        $this->validate($request,[

            'customer_name' => 'required',
            'contact_no' => ['bail','required','regex:/(0)(1|7)[0-9]{1}[0-9]{7}/'],
            'customer_email' => 'bail|required|email'
        ]);

        $address = strip_tags($request->input('address'));
        $customer = Customer::find($request->input('customerID'));
        $customer->customer_name = $request->input('customer_name');
        $customer->contact_no = $request->input('contact_no');
        $customer->customer_email = $request->input('customer_email');
        $customer->customer_address = $request->input('customer_address');

        $customer->save();
        $request->session()->flash('success','Customer Updated Successfully!!!');
        return redirect()->to('/customers');
    }

    public function delete_customer(Request $request){

        Customer::destroy($request->input('customerID'));

        $request->session()->flash('success','Customer Deleted Successfully!!!');
        return redirect()->to('/customers');
    }

    public function edit_customer($customer_id){

        $customer = Customer::find($customer_id);
        return view('customers.editcustomer', ['customer_data' => $customer,'status' => 'Edit', 'action' => 'updatecustomer', 'diable'=>'']);
    }

    public function view_customer($customer_id){

        $customer = Customer::find($customer_id);
        return view('customers.editcustomer', ['customer_data' => $customer,'status' => 'View', 'action' => '#','diable'=>'readonly']);
    }

    public function remove_customer($customer_id)
    {
        $customer = Customer::find($customer_id);
        return view('customers.editcustomer', ['customer_data' => $customer,'status' => 'Remove', 'action' => 'deletecustomer','diable'=>'readonly']);
    }

}