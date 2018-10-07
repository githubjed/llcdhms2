@extends('admin.master')
 
@section('content')
	<div class="row">
		<ol class="breadcrumb">
		    <li>
		    	<a href="#">
		            <em class="fa fa-home"></em>
		        </a>
		    </li>
		    <li class="active">
		    	Employees
		    </li>
	    </ol>
	</div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
            	Employees
        	</h1>
        </div>
    </div>
<div class="panel panel-container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<h2>
				<form role="search">
					<div class="row">
						<div class="col-lg-6">
						</div>
						<div class="col-lg-4"></div>
						<div class="col-lg-2">
							<button style="height: 45px;" id="add_data" type="button" data-target="" data-toggle="modal" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Employee
							</button>
						</div>
					</div>
				</form>	
			</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<table class="table table-bordered" id="user_table">
	               <thead>
	                  <tr>
	                     <th>User Id</th>
	                     <th>Full Name</th>
	                     <th>Email</th>
	                     <th>User Type</th>
	                     <th>Status</th>
	                     <th>Action</th>
	                  </tr>
	               </thead>
	         </table>
		</div>
	</div>
</div>

<div id="UserModal" class="modal fade" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <form method="post" id="user_form">
                <div class="modal-header btn-primary" >
                   <button type="button" class="close" data-dismiss="modal" style="color:red;">&times;</button>
                   <h4 class="modal-title text-center" style="color:white;" >Add Data</h4>
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    <span id="form_output"></span>
                        <div class="form-group">
                            <input type="hidden" name="user_id" id="user_id" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="names" id="names" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" id="email" class="form-control" />
                        </div>
                        <div class="form-group" id="passwordField">
                            <label>Password</label>
                            <input disabled value="hms1131" name="password" id="password" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>User Type</label>
                            <select id="user_type" name="user_type" class="form-control" required>
                                    @foreach ($roles as $role)
                                         <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                        </div>
                      
                <div class="modal-footer">
                     <!-- <input type="hidden" name="u_id" id="u_id" value="" /> -->
                    <input type="hidden" name="button_action" id="button_action" value="insert" />
                    <input type="submit" name="submit" id="action" value="Add" class="btn btn-success" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

	// datatables
	  $(document).ready(function() {
     $('#user_table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('employee.getempdata') }}",
        "columns":[
            { "data": "id" },
            { "data": "name" },
            { "data": "email" },
            { "data": "user_type" },
            { "data": "user_status" },
            { "data": "action", orderable:false, searchable: false}
        ]
     });

    $('#add_data').click(function(){
      $('#UserModal').modal('show');
      $('#passwordField').show();

      $('#user_form')[0].reset();
        $('#form_output').html('');
        $('#button_action').val('insert');
        $('#user_id').val('');
        $('#action').val('Add');
        $('.modal-title').text('User Data Form');
    });

    $(document).on('click', '.delete', function(){
        event.preventDefault();
        var id = $(this).attr("id");
        var token = $("input[name=_token]").val();

         $.ajax({
            url:"{{route('employee.activation')}}",
            method:'post',
            data:{id:id , "_token": "{{ csrf_token() }}"},
            dataType:'json',
        }).then(response =>{
            $('#user_table').DataTable().ajax.reload();
        })

    });

    $('#user_form').on('submit', function(event){
        event.preventDefault();

        var disabled = $(this).find(':input:disabled').removeAttr('disabled');

         // serialize the form
        var form_data = $(this).serialize();

         // re-disabled the set of inputs that you previously enabled
        disabled.attr('disabled','disabled');

        $.ajax({
            url:"{{ route('employee.postempdata') }}",
            method:"POST",
            data:form_data,
            dataType:"json",
            success:function(data)
            {
                if(data.error.length)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                    }

                    $('#form_output').html(error_html);
                    // console.log(data);
                }
                else
                {
                    $('#form_output').html(data.success);
                    $('#user_form')[0].reset();
                    $('#action').val('Add');
                    $('.modal-title').text('User Data Form');
                    $('#button_action').val('insert');
                    $('#UserModal').modal('hide');
                    $('#user_table').DataTable().ajax.reload();

                }
            }
        })
    });

    $(document).on('click', '.editemp', function(){
        var id = $(this).attr("id");
        $('#form_output').html('');
        $.ajax({
            url:"{{route('employee.fetchempdata')}}",
            method:'get',
            data:{id:id},
            dataType:'json',
            success:function(data)
            {   
                $('#user_id').val(data.user_id);
                $('#names').val(data.name);
                $('#email').val(data.email);
                $('#user_status').val(data.user_status);
                // $('#password').val(data.password);
                $('#passwordField').hide();
                $('#u_id').val(id);
                $('#user_type').val(data.user_type);
                $('#UserModal').modal('show');
                $('#action').val('Edit');
                $('.modal-title').text(' Edit User Data Form');
                $('#button_action').val('update');


            }
        })
    });
    $(document).on('click', '.view', function(){
        var id = $(this).attr("id");
        $('#form_output').html('');
        $.ajax({
            url:"{{route('employee.fetchempdata')}}",
            method:'get',
            data:{id:id},
            dataType:'json',
            success:function(data)
            {
               $('#user_id').val(data.user_id);
                $('#names').val(data.name);
                $('#email').val(data.email);
                $('#user_status').val(data.user_status);
                $('#user_type').val(data.user_type);
                $('#password').val(data.password);
                $('#u_id').val(id);
                $('#UserModal').modal('show');
                $('#action').val('Edit');
                $('.modal-title').text(' View Data');
                $('#button_action').val('update');
            }
        })
    });

});

</script>
@endsection
