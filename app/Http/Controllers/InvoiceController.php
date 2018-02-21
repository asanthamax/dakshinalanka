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

        $thin = $request->input('thickness');
        $sheet_type = $request->input('sheet_type');
        $size = $request->input('size');
        $stock = Stock::where('sheet_type',$sheet_type)
                        ->where('sheet_thickness', $thin)
                        ->select('*')
                        ->get();
        echo json_encode(array('msg' => $stock[0]->$size));
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
           $sheet_types = $request->input('sheet_types');
           $thickness = $request->input('thickness');
           $size = $request->input('size');
           $i = 0;
           foreach($quantity as $qty){

               $invoice_description = new Invoice_description;
               $invoice_description->quantity = $qty;
               $invoice_description->description = $particulars[$i];
               $invoice_description->amount = $amount[$i];
               $invoice_description->invoice_id = $id;
               $invoice_description->sheet_type = $sheet_types[$i];
               $invoice_description->thickness = $thickness[$i];
               $invoice_description->size = $size[$i];
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
                    $invoice_description2->quantity = 0;
                    $invoice_description2->sheet_type = 'non';
                    $invoice_description2->thickness = 'non';
                    $invoice_description2->size = 'non';
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

    public function updateInvoice(Request $request){

      $invoice_id = $request->input('invoice_id');
      $invoice = Invoice::find($invoice_id);
      $invoice->customer = $request->input('customer_name');
      $date = $request->input('date');
      $invoice->date = date('Y-m-d', strtotime($date));

      if($invoice->save()){

         $affectedRows = Invoice_description::where('invoice_id', $invoice_id)->delete();
         if($affectedRows > 0){
           $id = $invoice->invoiceID;
           $description = $request->input('desc');
           $amount = $request->input('amount');
           $quantity = $request->input('qty');
           $particulars = $request->input('particulars');
           $sheet_types = $request->input('sheet_types');
           $thickness = $request->input('thickness');
           $size = $request->input('size');
           $i = 0;
           foreach($quantity as $qty){

               $invoice_description = new Invoice_description;
               $invoice_description->quantity = $qty;
               $invoice_description->description = $particulars[$i];
               $invoice_description->amount = $amount[$i];
               $invoice_description->invoice_id = $id;
               $invoice_description->sheet_type = $sheet_types[$i];
               $invoice_description->thickness = $thickness[$i];
               $invoice_description->size = $size[$i];
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
                    $invoice_description2->quantity = 0;
                    $invoice_description2->sheet_type = 'non';
                    $invoice_description2->thickness = 'non';
                    $invoice_description2->size = 'non';
                    $invoice_description2->save();
                    $j++;
                }
           }
         }
         $request->session()->flash('success','Invoice Added Successfully!!!');
         return redirect()->to('/invoices');
      }else{

          $request->session()->flash('error','Invoice adding UnSuccessfull!!!');
          return redirect()->to('/invoices');
      }
    }

    public function getInvoice($invoiceID){

      $invoice = Invoice::find($invoiceID);
      $invoice_description = Invoice_description::where('invoice_id', $invoiceID)->select('*')->get();
      $invoice_det = array(

        'customer' => $invoice->customer,
        'date' => $invoice->date
      );
      $invoice_details = array();
      $invoice_details_laser = array();
      foreach($invoice_description as $description){

        if($description->type=='non laser'){

          $invoice_details[] = array(

            'description' => $description->description,
            'quantity' => $description->quantity,
            'amount' => $description->amount,
            'sheet_type' => $description->sheet_type,
            'thickness' => $description->thickness,
            'size' => $description->size
          );
        }else{

          $invoice_details_laser[] = array(

            'description' => $description->description,
            'amount' => $description->amount,
            'duration' => $description->type
          );
        }
      }

      $data['invoice_details'] = $invoice_details;
      $data['invoice_details_laser'] = $invoice_details_laser;
      $data['invoice_id'] = $invoiceID;
      $data['status'] = 'Update';
      $data['action'] = 'updateinvoice';
      $data['invoice'] = $invoice_det;
      $data['disable'] = '';

      $customers = Customer::all();
      $data['customers_list'] = load_combo_fromdb($customers,'customerID','customer_name','Please Select a Customer');
      $types = Stock::select('sheet_type')->distinct()->get();
      $data['sheet_types'] = load_combo_fromdb($types,'sheet_type','sheet_type','Please Select a Sheet Type');
      return view('invoices.editinvoice', $data);
    }

    public function printInvoice(){


    }

    public function removeInvoice($invoiceID){

      $invoice = Invoice::find($invoiceID);
      $invoice_description = Invoice_description::where('invoice_id', $invoiceID)->select('*')->get();
      $invoice_det = array(

        'customer' => $invoice->customer,
        'date' => $invoice->date
      );
      $invoice_details = array();
      $invoice_details_laser = array();
      foreach($invoice_description as $description){

        if($description->type=='non laser'){

          $invoice_details[] = array(

            'description' => $description->description,
            'quantity' => $description->quantity,
            'amount' => $description->amount,
            'sheet_type' => $description->sheet_type,
            'thickness' => $description->thickness,
            'size' => $description->size
          );
        }else{

          $invoice_details_laser[] = array(

            'description' => $description->description,
            'amount' => $description->amount,
            'duration' => $description->type
          );
        }
      }

      $data['invoice_details'] = $invoice_details;
      $data['invoice_details_laser'] = $invoice_details_laser;
      $data['invoice_id'] = $invoiceID;
      $data['status'] = 'Delete';
      $data['action'] = 'deleteinvoice';
      $data['invoice'] = $invoice_det;
      $data['disable'] = 'readonly';

      $customers = Customer::all();
      $data['customers_list'] = load_combo_fromdb($customers,'customerID','customer_name','Please Select a Customer');
      $types = Stock::select('sheet_type')->distinct()->get();
      $data['sheet_types'] = load_combo_fromdb($types,'sheet_type','sheet_type','Please Select a Sheet Type');
      return view('invoices.editinvoice', $data);
    }

    public function viewInvoice($invoiceID){

      $invoice = Invoice::find($invoiceID);
      $invoice_description = Invoice_description::where('invoice_id', $invoiceID)->select('*')->get();
      $invoice_det = array(

        'customer' => $invoice->customer,
        'date' => $invoice->date
      );
      $invoice_details = array();
      $invoice_details_laser = array();
      foreach($invoice_description as $description){

        if($description->type=='non laser'){

          $invoice_details[] = array(

            'description' => $description->description,
            'quantity' => $description->quantity,
            'amount' => $description->amount,
            'sheet_type' => $description->sheet_type,
            'thickness' => $description->thickness,
            'size' => $description->size
          );
        }else{

          $invoice_details_laser[] = array(

            'description' => $description->description,
            'amount' => $description->amount,
            'duration' => $description->type
          );
        }
      }

      $data['invoice_details'] = $invoice_details;
      $data['invoice_details_laser'] = $invoice_details_laser;
      $data['invoice_id'] = $invoiceID;
      $data['status'] = 'View';
      $data['action'] = '#';
      $data['invoice'] = $invoice_det;
      $data['disable'] = 'readonly';

      $customers = Customer::all();
      $data['customers_list'] = load_combo_fromdb($customers,'customerID','customer_name','Please Select a Customer');
      $types = Stock::select('sheet_type')->distinct()->get();
      $data['sheet_types'] = load_combo_fromdb($types,'sheet_type','sheet_type','Please Select a Sheet Type');
      return view('invoices.editinvoice', $data);
    }

    public function deleteInvoice(Request $request){

      $invoice_id = $request->input('invoice_id');
      Invoice_description::where('invoice_id', $invoice_id)->delete();
      Invoice::destroy($invoice_id);
      $request->session()->flash('success','Invoice Deleted Successfully!!!');
      return redirect()->to('/invoices');
    }
}
