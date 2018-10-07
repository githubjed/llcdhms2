@extends('admin.master')
 
@section('content')
<div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">Patients</li>
            </ol>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Patients</h1>
            </div>
        </div><!--/.row-->
<div class="panel panel-container">
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<h2>
		
			<div class="row">
				<div class="col-lg-4">
          <form action="/transactions" method="get">
					<div class="form-group">
            {{ csrf_field() }}
						<input  type="text"  name="searchname" id="searchname" class="form-control" placeholder="Search Patient here..." required/>
					</div>
          <div id="namelist" style="position:absolute;z-index: 9999;margin-top: -10px;">
        
          </div>
          
				</div>
        <div class="col-lg-2">
          <button style="height: 46px;margin-left:-30px;" class="btn btn-primary">Search</button>
        </div>
        </form>
				<div class="col-lg-4"></div>
				<div class="col-lg-2">
					
						<button style="height: 46px;" type="button" id="add_data" data-toggle="modal" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Patient</button>
					
				</div>
			</div>
	
			
		</h2>
	</div>
</div>
<div id="clickhere" class="row" style="padding-bottom: 100px;margin-bottom: -10px;">
	<div class="col-md-10 col-md-offset-1">
		<table class="table table-bordered" id="p_table">
               <thead>
                  <tr>
                     <th>PID</th>
                     <th>Full Name</th>
                     <th>Address</th>
                     <th>Gender</th>
                     <th>Guardian</th>
                     <th>Type</th>
                     <th>Action</th>
                  </tr>
               </thead>
         </table>
	</div>
</div>
</div>

<div id="patientModal" class="modal fade bd-example-modal-lg" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <form method="post" id="patient_form">
                <div class="modal-header btn-primary" >
                   <button type="button" class="close" data-dismiss="modal" style="color:red;">&times;</button>
                   <h4 class="modal-title text-center" style="color:white;" >Add Data</h4>
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    <span id="form_output"></span>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" id="address" class="form-control" />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label>Date of birth </label>
                            <input type="date" name="bdate" id="bdate" class="form-control" />
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label>Age</label>
                            <input type="text" name="age" id="age" class="form-control" />
                        </div>
                      </div>
                       <div class="col-lg-4">
                        <div class="form-group">
                          <label for="status">Status</label>
                          <select placeholder="Civil Status" name="status" id="status" class="form-control  form-control-lg"  style="height: 47px">
                            <option value="" selected disabled>Please select</option>
                            <option value="married">Married</option>
                            <option value="single">Single</option>
                            <option value="divorced">Divorced</option>
                            <option value="separated">Separated</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="gender">Gender</label>
                          <select name="gender" id="gender" class="form-control  form-control-lg" style="height: 47px">
                            <option value="" selected disabled>Please select</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                          <label for="religion">Religion</label>
                          <select name="religion" id="religion" class="form-control  form-control-lg" style="height: 47px">
                            <option value="" selected disabled>Please select</option>
                            <option value="Roman Catholic">Roman Catholic</option>
                            <option value="Protestant">Protestant</option>
                            <option value="Iglesia ni Cristo">Iglesia ni Cristo</option>
                            <option value="Born Again">Born Again</option>
                            <option value="Jehova's Witness">Jehova's Witness</option>
                            <option value="Muslim">Muslim</option>
                            <option value="Buddhist">Buddhist</option>
                          </select>
                        </div>
                      </div>

                       <div class="col-lg-4">
                          <div class="form-group">
                          <label for="patient_type">Patient Type</label>
                          <select name="patient_type" id="patient_type" class="form-control  form-control-lg" style="height: 47px">
                            <option value="" selected disabled>Please select</option>
                            <option value="1">In-Patient</option>
                            <option value="0">Out-Patient</option>
                          </select>
                        </div>
<!--                          <div class="form-group">
                            <label>Patient ID</label>
                            <input disabled type="text" name="patient_id" id="patient_id" class="form-control" />
                        </div> -->
                      </div>
                    </div>
                    <div class="row">
                       <div class="col-lg-4">
                        <div class="guardianup">
                            <label>Guardian Name</label>
                            <input type="text" name="guardian" id="guardian" class="form-control" />
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" name="contact" id="contact" class="form-control" />
                        </div>
                      </div>
                     <!--  <div class="col-lg-4">
                        <div class="form-group">
                            <label>Religion</label>
                            <input type="text" name="religion" id="religion" class="form-control" />
                        </div>
                      </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                     <input type="hidden" name="p_id" id="p_id" value="" />
                    <input type="hidden" name="button_action" id="button_action" value="insert" />
                    <input type="submit" name="submit" id="action" value="Add" class="btn btn-success" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>

 //--datatables
   $(document).ready(function() {
             $('#p_table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('patient.getdata') }}",
                "columns":[
                    { "data": "id" },
                    { "data": "fullname" },
                    { "data": "address" },
                    { "data": "gender" },
                    { "data": "guardian" },
                    { "data": "patient_type" },
                    { "data": "action", orderable:false, searchable: false}
                ]
             });

            $('#add_data').click(function(){
              $('#patientModal').modal('show');
              $('#patient_form')[0].reset();
                $('#form_output').html('');
                $('#button_action').val('insert');
                $('#action').val('Add');
                $('.modal-title').text('Patient Data Form');
            });

              $('#patient_form').on('submit', function(event){
                  event.preventDefault();
                  var form_data = $(this).serialize();
                 
                  $.ajax({
                      url:"{{ route('patient.postdata') }}",
                      method:"POST",
                      data:form_data,
                      dataType:"json",
                      success:function(data)
                      {
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
                              $('#patient_form')[0].reset();
                              $('#action').val('Add');
                              $('.modal-title').text('Patient Data Form');
                              $('#button_action').val('insert');
                              $('#p_table').DataTable().ajax.reload();
                               $('#patientModal').modal('hide');
                          }
                      }
                  })
              });

    $(document).on('click', '.edit', function(){
        var id = $(this).attr("id");
        $('#form_output').html('');
        $('#mmname').hide();
        $('#llname').hide();
        $('#ffname').hide();
        $.ajax({
            url:"{{route('patient.fetchdata')}}",
            method:'get',
            data:{id:id},
            dataType:'json',
            success:function(data)
            {   
                $('#patient_id').val(data.id);
                $('#fullname').val(data.fullname);
                $('#divfullname').show();
                $('#address').val(data.address);
                $('#contact').val(data.contact);
                $('#guardian').val(data.guardian);
                $('#bdate').val(data.bdate);
                $('#age').val(data.age);
                $('#status').val(data.status);
                $('#gender').val(data.gender);
                $('#patient_type').val(data.patient_type);
                $('#religion').val(data.religion);
                $('#p_id').val(id);
                $('#patientModal').modal('show');
                $('#action').val('Edit');
                $('.modal-title').text(' Edit Patient Data Form');
                $('#button_action').val('update');
            }
        })
    });
    
    $(document).on('click', '.view', function(){
        var id = $(this).attr("id");
        $('#form_output').html('');
        $('#mmname').hide();
        $('#llname').hide();
        $('#ffname').hide();
        $.ajax({
            url:"{{route('patient.fetchdata')}}",
            method:'get',
            data:{id:id},
            dataType:'json',
            success:function(data)
            {
                $('#patient_id').val(data.patient_id);
                $('#fullname').val(data.fullname);
                $('#divfullname').show();
                $('#address').val(data.address);
                $('#contact').val(data.contact);
                $('#guardian').val(data.guardian);
                $('#bdate').val(data.bdate);
                $('#age').val(data.age);
                $('#status').val(data.status);
                $('#patient_type').val(data.patient_type);
                $('#gender').val(data.gender);
                $('#religion').val(data.religion);
                $('#p_id').val(id);
                $('#patientModal').modal('show');
                $('#action').val('Edit');
                $('.modal-title').text('Edit Data');
                $('#button_action').val('update');
            }
        })
    });

});









  //--seach
  $(document).ready(function(){

    $('#searchname').keyup(function(){

        var query = $(this).val();
        if(query != '')
        {

          var _token = $('input[name="_token"]').val();

          $.ajax({
          url:"{{ route('patient.search') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data)
            {
              $('#namelist').show(100);
              $('#namelist').html(data);
            }
          });
        }
        
    });
    $(document).on('click', 'li', function()
    {
      $('#searchname').val($(this).text());
      $('#namelist').hide(100);
    });
    $(document).on('click', '#hidethis', function()
    {
      $('#namelist').hide(100);
      $('#searchname').val('');
    });
    $(document).on('click', '#clickhere', function()
    {
      $('#namelist').hide(100);
      $('#searchname').val('');
    });
  });
 
</script>
@endsection
