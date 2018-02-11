<?php
/**
 * Created by IntelliJ IDEA.
 * User: asantha
 * Date: 2/2/2018
 * Time: 11:20 PM
 */
if(!function_exists('load_combo_fromdb')) {

    function load_combo_fromdb($data,$key,$text,$default='')
    {

        $result = array();
        $result[''] = $default;
        foreach ($data as $d) {

            $result[$d->$key] = $d->$text;
        }
        return $result;
    }
}

if(!function_exists('load_customers')){

    function load_customers($customerID){

        $customer = \App\Customer::find($customerID);
        return $customer->customer_name;
    }

    function load_invoice_amount($invoice_id){

        $amount = \App\Invoice_description::where('invoice_id', $invoice_id)->sum('amount');
        return $amount;
    }
}