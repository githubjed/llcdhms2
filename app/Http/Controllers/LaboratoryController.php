<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\Laboratory;
use DB;
use Validator;

class LaboratoryController extends Controller
{   
    function index()
    {
     return view('show_laboratory');
    }
   
   function getdata()
    {
     $laboratories = DB::table('laboratories');
     return Datatables::of($laboratories)
            ->addColumn('mergeColumn', function($patient){
               return '₱ '.$patient->lab_price.'.00';
            })
            ->addColumn('action', function($tory){
                return '<a href="#" class="btn btn-xs btn-success edit" value="'.$tory->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->make(true);
    }  
    function fetchdata(Request $request)
    {
        $lab_id = $request->input('pid');
        $laboratory = Laboratory::find($lab_id);
        $output = array(
            'labname'   =>  $laboratory->lab_name,

            'labprice'  =>  $laboratory->lab_price
        );
        echo json_encode($output);
    }


    function postdata(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'labname'   =>  "required",  
            'labprice'      =>  "required",
        ]);
        
        $error_array = array();
        $success_output = '';
        if ($validation->fails())
        {
            foreach ($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages; 
            }
        }
        else
        {
            if($request->get('button_action') == 'insert')
            {  
                $price = $request->get('labprice');

                $laboratory = new Laboratory([
                    'lab_name'   => $request->get('labname'),
                    'lab_price'  => $price,
                ]);
                $laboratory->save();
                $success_output = '<div class="alert alert-success">Data Inserted</div>';
            }

            if($request->get('button_action') == 'update')
            {
                

                $laboratory = Laboratory::find($request->get('l_id'));

                    $laboratory->lab_name   =  $request->get('labname');
                    $laboratory->lab_price  =  $request->get('labprice');

                $laboratory->save();
                $success_output = '<div class="alert alert-success">Data Updated</div>';
            }
            
        }
        
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }
}
