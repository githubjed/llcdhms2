<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Role;
use App\Ward;
use DB;
use Datatables;
use Illuminate\Http\Request;
use Validator;


class PatientController extends Controller
{   
    function index()
    {
     return view('show_patient');
    }
   
   function getdata()
    {
     $patients = Patient::where('remarks','=','Active');

     return Datatables::of($patients)
            // ->addColumn('mergeColumn', function($patient){
            //    return $patient->fname.' '.$patient->lname;
            // })
            ->addColumn('action', function($patient){
                return '<a href="#" class="btn btn-xs btn-success edit" id="'.$patient->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a> <a href="#" class="btn btn-xs btn-primary view" id="'.$patient->id.'"><i class="glyphicon glyphicon-eye-open"></i> View</a>';
            })
            ->make(true);
    }

     function fetchdata(Request $request)
    {
        $id = $request->input('id');
        $patient = Patient::find($id);
        $output = array(
            'patient_id'   =>  $patient->id,
            'fullname'     =>  $patient->fullname,
            'patient_type' =>  $patient->getOriginal('patient_type'), 
            'address'      =>  $patient->address,
            'contact'      =>  $patient->contact,
            'guardian'     =>  $patient->guardian,
            'bdate'        =>  $patient->bdate,
            'age'          =>  $patient->age,
            'status'       =>  $patient->status,
            'gender'       =>  $patient->gender,
            'religion'     =>  $patient->religion
        );
        echo json_encode($output);
    }


    function postdata(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'address'      =>  "required",
            'contact'      =>  "required",
            'guardian'     =>  "required",
            'bdate'        =>  "required",
            'age'          =>  "required",
            'status'       =>  "required",
            'gender'       =>  "required",
            'religion'     =>  "required",
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

            // $fullname = request('fname')." ".request('mname')." ".request('lname');

            $patient = Patient::updateOrCreate([
                'id' => $request->get('p_id')
                ],
                [
                    'fullname'     =>  $request->get('fullname'),
                    'address'      =>  $request->get('address'),
                    'contact'      =>  $request->get('contact'),
                    'guardian'     =>  $request->get('guardian'),
                    'patient_type' =>  $request->get('patient_type'),
                    'bdate'        =>  $request->get('bdate'),
                    'age'          =>  $request->get('age'),
                    'status'       =>  $request->get('status'),
                    'gender'       =>  $request->get('gender'),
                    'religion'     =>  $request->get('religion')
                ]
                );

            $success_output = '<div class="alert alert-success">Data Inserted</div>';

            // if($request->get('button_action') == 'insert')
            // {
                
            //      $patient = Patient::create([
            //         'fullname'     =>  $request->get('fullname'),
            //         'address'      =>  $request->get('address'),
            //         'contact'      =>  $request->get('contact'),
            //         'guardian'     =>  $request->get('guardian'),
            //         'bdate'        =>  $request->get('bdate'),
            //         'age'          =>  $request->get('age'),
            //         'patient_type' =>  $request->get('patient_type'),
            //         'status'       =>  $request->get('status'),
            //         'gender'       =>  $request->get('gender'),
            //         'religion'     =>  $request->get('religion')
            //     ]);
            //     $success_output = '<div class="alert alert-success">Data Inserted</div>';
            // }

            // if($request->get('button_action') == 'update')
            // {
            //     $patient = Patient::find($request->get('p_id'));
            //     $patient->id =  $request->get('p_id');
            //     $patient->fullname   =  $request->get('fullname');
            //     $patient->address    =  $request->get('address');
            //     $patient->contact    =  $request->get('contact');
            //     $patient->guardian   =  $request->get('guardian');
            //     $patient->bdate      =  $request->get('bdate');
            //     $patient->patient_type =  $request->get('patient_type');
            //     $patient->age        =  $request->get('age');
            //     $patient->status     =  $request->get('status');
            //     $patient->gender     =  $request->get('gender');
            //     $patient->religion   =  $request->get('religion');

            //     $patient->save();
            //     $success_output = '<div class="alert alert-success">Data Updated</div>';
            
            // }
            
        }
        
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );

        echo json_encode($output);
    }


     function search( Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('patients')->where('fullname','LIKE','%'.$query.'%')
            ->orWhere('id','LIKE','%'.$query.'%')
            ->take(5)
            ->get();
            $output = '<ul class="dropdown-menu" style="display:block;position:relative;width:252px;">';
            $total_row = $data->count();
            if($total_row > 0)
            {
                foreach($data as $row)
                {
                    $output .= '<li style="width:100%;"><a href="#">'.$row->fullname.'</a></li>';

                }
            }
            else
            {
                   $output .= '<li id="hidethis" style="width:100%;" ><a href="#">No Data Found </a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function searchpatient(Request $request)
    {
        $doctors = Role::whereName('Doctor')
                        ->first()->user;

        $search = $request->get('searchname');
        $patients = Patient::where('fullname', '=', $search)
        ->orWhere('id', '=', $search)
        ->get();
        $wards = Ward::all();

        $payload = array(
                    'patients' => $patients,
                    'doctors'  => $doctors,
                    'wards'    => $wards
                    ); 

        return view('searched_patient')->with($payload);
    }
  //   public function save(Request $request){
  //   	$patient = new Patient;
  //   	$patient->firstname = $request->input('firstname');
  //   	$patient->lastname = $request->input('lastname');
  // 		$patient->save();
 
  // 		return redirect('/patients');
  //   }
 
  //   public function update(Request $request, $id){
  //   	$patients = Patient::find($id);
  //   	$input = $request->all();
		// $patients->fill($input)->save();
 
  //   	return redirect('/patients');
  //   }
 
  //   public function delete($id)
  //   {
  //       $patients = Patient::find($id);
  //       $patients->delete();
 
  //       return redirect('/patients');
  //   }
}
