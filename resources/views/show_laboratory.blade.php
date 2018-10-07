@extends('admin.master')
 
@section('content')
<div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">Laboratory</li>
            </ol>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Laboratory</h1>
            </div>
        </div><!--/.row-->
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
					
						<button style="height: 45px;" type="button" id="add_lab" data-toggle="modal" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Laboratory</button>
					
				</div>
			</div>
		</form>
			
		</h2>
	</div>
</div>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<table class="table table-bordered" id="lab_table">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Lab. Name</th>
                     <th>Lab. Price</th>
                     <th>Action</th>
                     
                  </tr>
               </thead>
         </table>
	</div>
</div>
</div>


<div id="LabModal" class="modal fade" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <form method="post" id="lab_form">
                <div class="modal-header btn-primary" >
                   <button type="button" class="close" data-dismiss="modal" style="color:red;">&times;</button>
                   <h4 class="modal-title text-center" style="color:white;" >Add Data</h4>
                </div>
                <div class="modal-body">
                    {{csrf_field()}}
                    <span id="form_output"></span>
                    <div class="row">
                      <div id="ffname" class="col-lg-12">
                        <div class="form-group">
                            <label>Lab Name</label>
                            <input type="text" name="labname" id="labname" class="form-control" />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                            <label>Lab Price</label>
                            <input type="text" name="labprice" id="labprice" class="form-control" />
                        </div>
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                     <input type="hidden" name="l_id" id="l_id" value="" />
                    <input type="hidden" name="button_action" id="button_action" value="insert" />
                    <input type="submit" name="submit" id="action" value="Add" class="btn btn-success" />
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
	 $(function() {
            $('#lab_table').DataTable({
                "order": [[ 0, "asc" ]],
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('laboratory.getdata') }}",
                "columns":[
                    { "data": "id" },
                    { "data": "lab_name" },
                    { "data": "mergeColumn" },
                    { "data": "action", orderable:false, searchable: false}
                ]
             });
            $('#add_lab').click(function(){
              $('#LabModal').modal('show');
              $('#lab_form')[0].reset();
                $('#form_output').html('');
                $('#divfullname').hide();
                $('#button_action').val('insert');
                $('#action').val('Add');
                $('.modal-title').text('Laboratory Data Form');
            });

              $('#lab_form').on('submit', function(event){
                  event.preventDefault();
                  var form_data = $(this).serialize();
                  $.ajax({
                      url:"{{ route('laboratory.postdata') }}",
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
                              $('#lab_form')[0].reset();
                              $('#action').val('Add');
                              $('.modal-title').text('Laboratory Data Form');
                              $('#button_action').val('insert');
                              $('#lab_table').DataTable().ajax.reload();
                              $('#LabModal').modal('hide');
                          }
                      }
                  })
              });

    $(document).on('click', '.edit', function(){
        var iid = $(this).attr("value");
        $('#form_output').html('');
        $.ajax({
            url:"{{route('laboratory.fetchdata')}}",
            method:'get',
            data:{pid:iid},
            dataType:'json',
            success:function(data)
            {   
                $('#labname').val(data.labname);
                $('#labprice').val(data.labprice);
                $('#l_id').val(iid);
                $('#LabModal').modal('show');
                $('#action').val('Edit');
                $('.modal-title').text(' Edit Laboratory Data Form');
                $('#button_action').val('update');
                console.log(data);
            }
        })
    });
    
   

         });
</script>
@endsection
