<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Transaction;
use App\Vital;
use Carbon\Carbon;
use DB;
use DateTime;
use Illuminate\Http\Request;
use Validator;
class TransactionController extends Controller
{

    function getdata(Request $request)
    {   
        // dd($request->all());
        $id = $request->get('pid');
        // return $id. 'this is test!';

        if($request->ajax())
        {
            $output ='';
          
            $data = Patient::find($id)
                            ->transactions()
                            ->where('patientStatus' , 'Active')
                            ->get();
                
             if(count($data))
              {
               foreach($data as $row)
               {

                // auth()->user()->user_type == 'Doctor' ? '' : 'disabled';

                $pDisabled = auth()->user()->user_type == 'Doctor' ? '' : 'disabled';

                $f = $row->findings != '' ? $row->findings
                                          : '<button class="btn btn-primary '.$pDisabled
                                              .'">ADD</button>';
                $p = $row->prescription != '' ? $row->prescription 
                                              : '<button class="btn btn-primary '.$pDisabled
                                              .'">ADD</button>';

                $dd = $row->date_discharge != '' ? $row->date_discharge 
                                                 : '<button class="btn btn-danger '. $pDisabled.'">Discharge</button>';
                
                $output .= '
                <tr>
                 <td>'.$row->id.'</td>
                 <td>'.$row->incharge_doc.'</td>
                 <td>'.$row->wardName.'</td>
                 <td>'.$row->bedNo.'</td>
                 <td>'.$row->date_incharge.'</td>
                 <td>'.$row->admitDiagnos.'</td>
                 <td>'.$dd.'</td>
                 <td>'.$f.'</td>
                 <td>'.$p.'</td>
                 <td>'.$row->totalBills.'</td>
                 <td><button class="btn btn-success edit" id="'.$row->id.'">EDIT</button></td>
                </tr>
                ';
               }
              }
              else
              {
               $output = '
               <tr>
                <td align="center" colspan="11">No Data Found</td>
               </tr>
               ';
              }
              $data = array(
               'table_data'  => $output,
               'total_data'  => count($data)
            );
          
           echo json_encode($data);   
        }

    }

    public function findData()
    {
        $transaction = Transaction::with('vital')->findOrFail(request()->id);

        $ward = explode('-', $transaction->wardName);
        unset($transaction->wardName);
        $transaction->wardName = $ward[0];
        $transaction->wardNo = $ward[1];

        return response()->json(['transaction' => $transaction] , 200);
    }

    public function postdata(Request $request)
    {
        $error_array = array();
        $success_output = '';

         $validation = Validator::make($request->all(), [
            'inchargedoctor' =>  "required",
            'wno'            =>  "required",
            'wname'          =>  "required",
            'bno'            =>  "required",
            'btemp'          =>  "required",
            'bp'             =>  "required",
            'prate'          =>  "required",
            'rrate'          =>  "required",
        ]);

        if ($validation->fails())
        {
            foreach ($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages; 
            }
        }else{

           $wname = $request->get('wname').'-'.$request->get('wno'); 

           $transactions = Transaction::updateOrCreate([
                                          'id' => request()->trans_id
                                      ],[
                                          'patient_id'   => $request->get('patientId'),
                                          'incharge_doc' => $request->get('inchargedoctor'),
                                          'wardName'     => $wname,
                                          'bedNo'        => $request->get('bno'),
                                          'admitDiagnos' => $request->get('admitDiagnosis'),
                                          'date_incharge' => Carbon::now()->format('Y-m-d H:i:s')
                                      ]);

            $patientVital = Vital::updateOrCreate([
                      'transaction_id'=> $transactions->id
                  ],
                  [
                    'transaction_id' => $transactions->id,
                    'btemp' => $request->get('btemp'),
                    'bpressure' => $request->get('bp'),
                    'prate' => $request->get('prate'),
                    'rrate' =>$request->get('rrate')
                ]);

           $success_output = '<div class="alert alert-success">Data Updated</div>';

        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);

    }

    // function postdata(Request $request)
    // {
    //     $validation = Validator::make($request->all(), [
    //         'ptn'            =>  "required",  
    //         'inchargedoctor' =>  "required",
    //         'wno'            =>  "required",
    //         'wname'          =>  "required",
    //         'bno'            =>  "required",
    //         'btemp'          =>  "required",
    //         'bp'             =>  "required",
    //         'prate'          =>  "required",
    //         'rrate'          =>  "required",
    //     ]); 
        
    //     $error_array = array();
    //     $success_output = '';
    //     if ($validation->fails())
    //     {
    //         foreach ($validation->messages()->getMessages() as $field_name => $messages)
    //         {
    //             $error_array[] = $messages; 
    //         }
    //     }
    //     else
    //     {
    //         if($request->get('button_action') == 'insert')
    //         {
    //             $ptn = $request->get('patientId').''.$request->get('ptn'); 
    //             $wname = $request->get('wname').'-'.$request->get('wno'); 
    //             $now = new DateTime();
    //             $PatientTransaction = new Transaction([
    //                 'id' => $ptn,
    //                 'patient_id' => $request->get('patientId'),
    //                 'incharge_doc'     =>  $request->get('inchargedoctor'),
    //                 'wardName'      =>  $wname,
    //                 'bedNo'      =>  $request->get('bno'),
    //                 'admitDiagnos'     =>  $request->get('admitDiagnosis'),
    //                 'date_incharge' => $now->format('Y-m-d H:i:s')
    //             ]);
    //             $PatientTransaction->save();

    //             $patientVital = new Vital([
    //                 'patient_trans_id' => $ptn,
    //                 'btemp' => $request->get('btemp'),
    //                 'bpressure' => $request->get('bp'),
    //                 'prate' => $request->get('prate'),
    //                 'rrate' =>$request->get('rrate')
    //             ]);
    //             $patientVital->save();
    //             $success_output = '<div class="alert alert-success">Data Inserted</div>';
    //         }

    //         if($request->get('button_action') == 'update')
    //         {
               

    //             $patient = Patient::find($request->get('p_id'));

    //                 $patient->patient_id =  $request->get('patient_id');
    //                 $patient->fullname   =  $request->get('fullname');
    //                 $patient->address    =  $request->get('address');
    //                 $patient->contact    =  $request->get('contact');
    //                 $patient->guardian   =  $request->get('guardian');
    //                 $patient->bdate      =  $request->get('bdate');
    //                 $patient->age        =  $request->get('age');
    //                 $patient->status     =  $request->get('status');
    //                 $patient->gender     =  $request->get('gender');
    //                 $patient->religion   =  $request->get('religion');

    //             $patient->save();
    //             $success_output = '<div class="alert alert-success">Data Updated</div>';
    //         }
            
    //     }
        
    //     $output = array(
    //         'error'     =>  $error_array,
    //         'success'   =>  $success_output
    //     );
    //     echo json_encode($output);
    // }
}
