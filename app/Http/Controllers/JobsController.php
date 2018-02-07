<?php
/**
 * Created by IntelliJ IDEA.
 * User: asantha
 * Date: 1/4/2018
 * Time: 9:23 AM
 */

namespace App\Http\Controllers;


use App\Customer;
use App\Dailyjob;
use App\Stock;
use Illuminate\Http\Request;

class JobsController extends Controller
{

    public function index(){

        $jobs = Dailyjob::all();
        $data['jobs'] = $jobs;
        return view('jobs.jobs', $data);
    }

    public function addJob(){

        $customers = Customer::all();
        $data['customers_list'] = load_combo_fromdb($customers,'customerID','customer_name','Please Select a Customer');
        $materials = Stock::select('material')->distinct()->get();
        $data['material_list'] = load_combo_fromdb($materials,'material','material','Please Select the material');
        $sheet_types = Stock::select('sheet_type')->distinct()->get();
        $data['sheet_type_list'] = load_combo_fromdb($sheet_types,'sheet_type','sheet_type','Please Select a Sheet Type');
        return view('jobs.addjob',$data);
    }

    public function get_materials(Request $request){

        $sheet = $request->input('sheet_type');
        $materials = Stock::where('sheet_type',$sheet)->select('material')->distinct()->get();
        $material_list = array();
        foreach ($materials as $material){

            $material_list['material'] = $material;
        }
        echo json_encode($material_list);
    }

    public function check_availability(Request $request){

        $sheet_type = $request->input('sheet_type');
        $material = $request->input('material');
        $thickness = $request->input('thickness');
        $quantity = $request->input('quantity');
        $stock = Stock::where('sheet_type',$sheet_type)
                        ->where('material', $material)
                        ->where('sheet_thickness', $thickness)
                        ->select('quantity')
                        ->get();

        if($quantity > $stock->quantity){

            echo json_encode(array('msg' => 'unsuccess', 'quantity' => $stock->quantity));
        }else{

            echo json_encode(array('msg' => 'success'));
        }
    }

    public function edit_job($job_id){

        $job = Dailyjob::find($job_id);
        $customers = Customer::all();
        $data['job_data'] = $job;
        $data['customers_list'] = load_combo_fromdb($customers,'customerID','customer_name',$job->customerID);
        $materials = Stock::select('material')->distinct()->get();
        $data['material_list'] = load_combo_fromdb($materials,'material','material',$job->material);
        /*$sheet_types = Stock::select('sheet_type')->distinct()->get();
        $data['sheet_type_list'] = load_combo_fromdb($sheet_types,'sheet_type','sheet_type',$job->sheet_type);
        $thickness_sheet = Dailyjob::where('sheet_type',$job->sheet_type)
                                    ->where('material', $job->material)
                                    ->select('thickness')
                                    ->distinct()
                                    ->get();*/
        //$data['thickness'] = load_combo_fromdb($thickness_sheet,'sheet_thickness','sheet_thickness', $job->thickness);
        $data['status'] = 'Edit';
        $data['disable'] = '';
        $data['action'] = 'updatejob';
        return view('jobs.editjobs', $data);
    }

    public function view_job($job_id){

        $job = Dailyjob::find($job_id);
        $customers = Customer::all();
        $data['job_data'] = $job;
        $data['customers_list'] = load_combo_fromdb($customers,'customerID','customer_name',$job->customerID);
        $materials = Stock::select('material')->distinct()->get();
        $data['material_list'] = load_combo_fromdb($materials,'material','material',$job->material);
        /*$sheet_types = Stock::select('sheet_type')->distinct()->get();
        $data['sheet_type_list'] = load_combo_fromdb($sheet_types,'sheet_type','sheet_type',$job->sheet_type);
        $thickness_sheet = Dailyjob::where('sheet_type',$job->sheet_type)
            ->where('material', $job->material)
            ->select('sheet_thickness')
            ->distinct()
            ->get();*/
      //  $data['thickness'] = load_combo_fromdb($thickness_sheet,'sheet_thickness','sheet_thickness', $job->thickness);
        $data['status'] = 'View';
        $data['disable'] = 'readonly';
        $data['action'] = '#';
        return view('jobs.editjobs', $data);
    }

    public function remove_job($job_id){

        $job = Dailyjob::find($job_id);
        $customers = Customer::all();
        $data['job_data'] = $job;
        $data['customers_list'] = load_combo_fromdb($customers,'customerID','customer_name',$job->customerID);
        $materials = Stock::select('material')->distinct()->get();
        $data['material_list'] = load_combo_fromdb($materials,'material','material',$job->material);
        /*$sheet_types = Stock::select('sheet_type')->distinct()->get();
        $data['sheet_type_list'] = load_combo_fromdb($sheet_types,'sheet_type','sheet_type',$job->sheet_type);
        $thickness_sheet = Dailyjob::where('sheet_type',$job->sheet_type)
            ->where('material', $job->material)
            ->select('sheet_thickness')
            ->distinct()
            ->get();*/
      //  $data['thickness'] = load_combo_fromdb($thickness_sheet,'sheet_thickness','sheet_thickness', $job->thickness);
        $data['status'] = 'Delete';
        $data['disable'] = 'readonly';
        $data['action'] = 'deletejob';
        return view('jobs.editjobs', $data);
    }

    public function savejob(Request $request){

        $this->validate($request,[

            'customer_name' => 'required',
            'material' => 'required',
            'thickness' => 'required',
            'date' => 'required',
            'job_duration' => 'bail|required|numeric'
        ]);

        $job = new Dailyjob;
        $job->customerID = $request->input('customer_name');
        $job->material = $request->input('material');
        $job->thickness = $request->input('thickness');
        $job->date = date('Y-m-d', strtotime($request->input('date')));
        $job->duration = $request->input('job_duration');
        $job->description = $request->input('description');

        $job->save();
        $request->session()->flash('success','Job Added Successfully!!!');
        return redirect()->to('/jobs');
    }

    public function updatejob(Request $request){

        $this->validate($request,[

            'customer_name' => 'required',
            'material' => 'required',
            'thickness' => 'required',
            'date' => 'required',
            'job_duration' => 'bail|required|numeric'
        ]);

        $job = Dailyjob::find($request->input('jobID'));
        $job->customerID = $request->input('customer_name');
        $job->material = $request->input('material');
        $job->thickness = $request->input('thickness');
        $job->date = date('Y-m-d', strtotime($request->input('date')));
        $job->duration = $request->input('job_duration');
        $job->status = $request->input('status');
        $job->description = $request->input('description');

        $job->save();
        $request->session()->flash('success','Job Updated Successfully!!!');
        return redirect()->to('/jobs');
    }

    public function deletejob(Request $request){

        Dailyjob::destroy($request->input('jobID'));

        $request->session()->flash('success','Job Deleted Successfully!!!');
        return redirect()->to('/jobs');
    }
}