@extends('admin.master')
 
@section('content')




<div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">Patient Transaction</li>
            </ol>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Patient Transaction</h1>
            </div>
        </div><!--/.row-->

<div class="panel panel-container">
<div class="row">
	<div class="col-md-10 col-md-offset-1">
      @if(count($patients))
      @foreach ($patients as $patient)
      <div class="row">
        <div class="col-lg-8"> 
          <h3><b>Patient Name:</b> <i>{{$patient->fullname}}</i></h3>
        </div>
        <div class="col-lg-4">    
            <button style="height: 46px;" type="button" id="add_record" data-toggle="modal" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> New Record</button>
            {{ csrf_field() }}
            <input type="hidden" name="pid" id="pid" value="{{$patient->id}}">
        </div>
      </div>
	</div>
</div>
    <div class="row" style="margin-bottom: -10px;padding-top: 20px;">
    	<div class="col-md-10 col-md-offset-1">
    		<table class="table table-bordered" id="trans_table">
                   <thead>
                      <tr>
                         <th>Transaction #</th>
                         <th>Incharge Doctor</th>
                         <th>WardName</th>
                         <th>Bed #</th>
                         <th>Date Admitted</th>
                         <th>Admitting Diagnosis</th>
                         <th>Date Discharge</th>
                         <th>Final Diagnosis</th>
                         <th>Doctor's Prescription</th>
                         <th>Total Billings</th>
                         <th>Action</th>
                      </tr>
                   </thead>
                   <tbody>
                     
                   </tbody>
        </table>
         <div id="empty" style="display: none;"><h5>No Transaction Yet!</h5>
         </div>

    	</div>
    </div>
    <div class="row">
      <div class="col-md-10 col-md-offset-1" id="lab_row">
      <div class="col-lg-4">
        <button disabled="{{auth()->user()->user_type != 'Laboratory'}}" class="btn btn-primary pull-left" style="margin-left:-15px;"><span class="fa fa-plus-circle"></span> INPUT LABORATORY</button>
      </div>
      <div class="col-lg-4"></div>
      <div class="col-lg-4">
        <button disabled="{{auth()->user()->user_type != 'Cashier'}}" class="btn btn-warning pull-right" style="margin-right:-65px;"><span class="fa fa-money"></span> RECEIVE PAYMENTS</button>
      </div>
      </div>
    </div>
    <div class="row" style="padding-bottom: 100px;margin-top: 5px;">
      <div class="col-md-10 col-md-offset-1" id="med_row">
      <div class="col-lg-4">
        <button disabled="{{auth()->user()->user_type != 'Pharmacist'}}" class="btn btn-success pull-left" style="margin-left:-15px;width:189px;text-align: left;"><span class="fa fa-plus-circle"></span> INPUT MEDICINES</button>
      </div>
      <div class="col-lg-4"></div>
      <div class="col-lg-4">
        <button disabled="{{auth()->user()->user_type != 'Cashier'}}" class="btn btn-danger pull-right" style="margin-right:-65px;width:189px;text-align:left;"><span class="fa fa-eye"></span> VIEW BILLINGS</button>
      </div>
      </div>
    </div>

</div>

<div id="TransactionModal" class="modal fade" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <form method="post" id="patient_trans_form">
                <div class="modal-header btn-primary" >
                   <button type="button" class="close" data-dismiss="modal" style="color:red;">&times;</button>
                   <h4 class="modal-title text-center" style="color:white;" >Add Data</h4>
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    <span id="form_output"></span>
                    <input type="hidden" name="trans_id" id="trans_id" value="">
                    <input type="hidden" name="patientId" id="patientId" value="{{$patient->id}}">
                    <div class="row">
                   <!--    <div  class="col-lg-6">
                        <div class="form-group">
                            <label>Patient Transaction No.</label>
                            <input type="text" name="ptn" id="ptn" class="form-control" />
                             <input type="hidden" name="patientId" id="patientId" value="{{$patient->id}}">
                        </div>
                        <div class="form-group">
                          
                        </div>
                      </div> -->
                      <div class="col-lg-6">
                        <div class="form-group">
                            <label>Assigned Doctor</label>
                            <select id="inchargedoctor" name="inchargedoctor" class="form-control" required style="height: 44px;">
                                    <option value="">Please Select a Doctor</option>
                                @foreach ($doctors as $doctor)
                                     <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label>Ward Name</label>
                            <select id="wname" name="wname" class="form-control" required style="height: 44px;">
                                    <option value="">Please Select Ward Name</option>
                                @foreach ($wards as $ward)
                                     <option value="{{$ward->name}}">{{$ward->name}}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label>Ward No.</label>
                            <input type="number" max="10" name="wno" id="wno" class="form-control" />
                        </div>
                      </div>
                       <div class="col-lg-4">
                        <div class="guardianup">
                            <label>Bed No.</label>
                            <input type="text" name="bno" id="bno" class="form-control" />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                            <label>Admitting Diagnosis</label>
                            <textarea name="admitDiagnosis" id="admitDiagnosis" rows="4" cols="50" class="form-control">
                            </textarea>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <hr>
                        <h5><b>VITAL SIGN RESULTS</b></h5>
                        <hr>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                            <label>Body Temperature</label>
                            <input type="text" name="btemp" id="btemp" class="form-control" />
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                            <label>Blood Pressure</label>
                            <input type="text" name="bp" id="bp" class="form-control" />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                            <label>Pulse Rate</label>
                            <input type="text" name="prate" id="prate" class="form-control" />
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                            <label>Respiration Rate</label>
                            <input type="text" name="rrate" id="rrate" class="form-control" />
                        </div>
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                     <!-- <input type="hidden" name="p_id" id="p_id" value="" /> -->
                    <input type="hidden" name="button_action" id="button_action" value="insert" />
                    <input type="submit" name="submit" id="action" value="Add" class="btn btn-success" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endforeach

@else
<div class="row">
  <h3>
    <b style="color:red;">No Patient found,</b> <i><a href="/patients">Please try again!</a></i>
  </h3>
  </div>
  </div>
@endif

<script>
    
    $(document).ready(function() {
           var iid = $('#pid').val();
            $.ajax({
              url:"{{ route('transaction.getdata') }}",
              method:'GET',
              data:{pid:iid},
              dataType:'json',
              success:function(data)
              {
                if(data.total_data > 0)
                { 
                  $('#add_record').hide();
                  $('tbody').html(data.table_data);
                  console.log(data);
                }
                else
                { 
                  $('#lab_row').hide();
                  $('#med_row').hide();
                  console.log(data);
                }
              }
            })

            $('#add_record').click(function(){
              $('#TransactionModal').modal('show');
              $('#patient_trans_form')[0].reset();
                $('#form_output').html('');
                $('#button_action').val('insert');
                $('#action').val('Add');
                $('.modal-title').text('Patient Transaction Form');
            });

              $('#patient_trans_form').on('submit', function(event){
                  event.preventDefault();
                  var form_data = $(this).serialize();
                  $.ajax({
                      url:"{{ route('transaction.postdata') }}",
                      method:"POST",
                      data:form_data,
                      dataType:"json",
                      success:function(data)

                      {
                        console.log(data);
                          if(data.error.length > 0)
                          {
                              var error_html = '';
                              for(var count = 0; count < data.error.length; count++)
                              {
                                  error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                              }
                              $('#form_output').html(error_html);
                          }
                          else
                          {
                              $('#form_output').html(data.success);
                              $('#patient_trans_form')[0].reset();
                              $('#action').val('Add');
                              $('.modal-title').text('Patient Data Form');
                              $('#button_action').val('insert');

                              location.reload()
                          }
                      }
                  })
              });
              //edit

              $(document).on('click', '.edit', function(){
                var id = $(this).attr("id");
                $('#form_output').html('');
                $.ajax({
                    url:"{{route('transaction.find-data')}}",
                    method:'get',
                    data:{id:id},
                    dataType:'json',
                    success:function(response)
                    {   
                      var data = response.transaction
                      $('#TransactionModal').modal('show');
                      $('#inchargedoctor').val(data.incharge_doc);
                      $('#trans_id').val(data.id)
                      $('#wname').val(data.wardName);
                      $('#wno').val(data.wardNo);
                      $('#bno').val(data.bedNo);
                      $('#admitDiagnosis').val(data.admitDiagnos);
                      $('#btemp').val(data.vital.btemp);
                      $('#bp').val(data.vital.bpressure);
                      $('#prate').val(data.vital.prate);
                      $('#rrate').val(data.vital.rrate);
                    }
                })
              });
                 

});


</script>
@endsection
