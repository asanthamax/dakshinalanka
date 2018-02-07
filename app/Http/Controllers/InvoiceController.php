<?php
/**
 * Created by IntelliJ IDEA.
 * User: asantha
 * Date: 1/8/2018
 * Time: 8:50 AM
 */

namespace App\Http\Controllers;


class InvoiceController extends Controller
{

    public function index(){

        return view('invoices.invoices');
    }

    public function createInvoice(){

        return view('invoices.invoice');
    }
}