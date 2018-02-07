<?php
/**
 * Created by IntelliJ IDEA.
 * User: asantha
 * Date: 1/3/2018
 * Time: 9:39 AM
 */

namespace App\Http\Controllers;


use App\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{

    public function index(){

        $stocks = Stock::all();
        return view('/stock.stocks',['stocks' => $stocks]);
    }

    public function addStock(){

        return view('/stock.addstock');
    }

    public function edit_stock($stock_id){

        $stock = Stock::find($stock_id);
        return view('stock.editstock', ['stock_data' => $stock,'status' => 'Edit', 'action' => 'updatestock', 'diable'=>'']);
    }

    public function view_stock($stock_id){

        $stock = Stock::find($stock_id);
        return view('stock.editstock', ['stock_data' => $stock,'status' => 'View', 'action' => '#','diable'=>'readonly']);
    }

    public function remove_stock($stock_id){

        $stock = Stock::find($stock_id);
        return view('stock.editstock',['stock_data' => $stock, 'status' => 'Remove', 'action' => 'deletestock','diable' => 'readonly']);
    }

    public function saveStock(Request $request){

        $this->validate($request,[

            'sheet_type' => 'required',
            'thickness' => 'bail|required',
            'price64' => 'bail|required|numeric',
            'price84' => 'bail|required|numeric',
            'square_feet_price' => 'bail|required|numeric',
            'material' => 'required',
            'qty_available' => 'bail|required|numeric'
        ]);

        $stock = new Stock;
        $stock->sheet_type = $request->input('sheet_type');
        $stock->sheet_thickness = $request->input('thickness');
        $stock->price64 = $request->input('price64');
        $stock->price84 = $request->input('price84');
        $stock->sqft_price = $request->input('square_feet_price');
        $stock->material = $request->input('material');
        $stock->quantity = $request->input('qty_available');

        $stock->save();
        $request->session()->flash('success','Stock Inserted Successfully!!!');
        return redirect()->to('/stocks');
    }

    public function updateStock(Request $request){

        $this->validate($request,[

            'sheet_type' => 'required',
            'thickness' => 'bail|required',
            'price64' => 'bail|required|numeric',
            'price84' => 'bail|required|numeric',
            'square_feet_price' => 'bail|required|numeric',
            'material' => 'required',
            'qty_available' => 'bail|required|numeric'
        ]);

        $stock = Stock::find($request->input('stockID'));
        $stock->sheet_type = $request->input('sheet_type');
        $stock->sheet_thickness = $request->input('thickness');
        $stock->price64 = $request->input('price64');
        $stock->price84 = $request->input('price84');
        $stock->sqft_price = $request->input('square_feet_price');
        $stock->material = $request->input('material');
        $stock->quantity = $request->input('qty_available');
        $stock->save();
        $request->session()->flash('success','Stock Updated Successfully!!!');
        return redirect()->to('/stocks');
    }

    public function deleteStock(Request $request){

        Stock::destroy($request->input('stockID'));

        $request->session()->flash('success','Stock Deleted Successfully!!!');
        return redirect()->to('/stocks');
    }



}