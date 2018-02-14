<?php
/**
 * Created by IntelliJ IDEA.
 * User: asantha
 * Date: 1/8/2018
 * Time: 8:50 AM
 */

namespace App\Http\Controllers;


use App\Customer;
use App\Invoice;
use App\Invoice_description;
use App\Stock;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index(){

        $invoice = Invoice::all();
        $data['invoices'] = $invoice;
        return view('invoices.invoices', $data);
    }

    public function createInvoice(){

        $customers = Customer::all();
        $data['customers_list'] = load_combo_fromdb($customers,'customerID','customer_name','Please Select a Customer');
        $types = Stock::select('sheet_type')->distinct()->get();
        $data['sheet_types'] = load_combo_fromdb($types,'sheet_type','sheet_type','Please Select a Sheet Type');

        return view('invoices.invoice', $data);
    }

    public function getPrice(Request $request){

        $thin = $request->input('diameter');
        $sheet_type = $request->input('sheet_type');
        $stock = Stock::where('sheet_type',$sheet_type)
                        ->where('sheet_thickness', $thin)
                        ->select('*')
                        ->get();
      /*  echo '<pre>';
        print_r($stock);*/
        echo json_encode(array('msg' => $stock->$price_size));
    }

    public function getThickness(Request $request){

        $sheet_type = $request->input('sheet_type');
        $thickness = Stock::where('sheet_type',$sheet_type)->select('*')->get();
        $thick = array();
        foreach($thickness as $th){

          $thick[] = $th->sheet_thickness;
        }
        echo json_encode($thick);
    }

    public function addInvoice(Request $request){

        $invoice = new Invoice;
        $invoice->customer = $request->input('customer_name');
        $date = $request->input('date');
        $invoice->date = date('Y-m-d', strtotime($date));

        if($invoice->save()){

           $id = $invoice->invoiceID;
           $description = $request->input('desc');
           $amount = $request->input('amount');
           $quantity = $request->input('qty');
           $particulars = $request->input('particulars');
           $i = 0;
           foreach($quantity as $qty){

               $invoice_description = new Invoice_description;
               $invoice_description->quantity = $qty;
               $invoice_description->description = $particulars[$i];
               $invoice_description->amount = $amount[$i];
               $invoice_description->invoice_id = $id;
               $invoice_description->type = 'non laser';
               $invoice_description->save();
               $i++;
           }

           $laser_custting = $request->input('laser_custting_description');
           $laser_amount = $request->input('laser_cutting_amount');
           $laser_duration = $request->input('laser_cutting_duration');
           if($laser_custting){

                $j = 0;
                foreach ($laser_custting as $laser){

                    $invoice_description2 = new Invoice_description;
                    $invoice_description2->description = $laser;
                    $invoice_description2->amount = $laser_amount[$j];
                    $invoice_description2->invoice_id = $id;
                    $invoice_description2->type = $laser_duration[$j];
                    $invoice_description2->save();
                    $j++;
                }
           }

            $request->session()->flash('success','Invoice Added Successfully!!!');
            return redirect()->to('/invoices');
        }else{

            $request->session()->flash('error','Invoice adding UnSuccessfull!!!');
            return redirect()->to('/invoices');
        }
    }
}
