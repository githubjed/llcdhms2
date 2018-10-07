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
		<form role="search">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Search Patient here...">
					</div>
				</div>
				<div class="col-lg-4"></div>
				<div class="col-lg-2">
					
						<button style="height: 45px;" type="button" data-target="#addnew" data-toggle="modal" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Patient</button>
					
				</div>
			</div>
		</form>
			
		</h2>
	</div>
</div>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<table class="table table-bordered" id="table">
               <thead>
                  <tr>
                     <th>Id</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Password</th>
                     <th>Date Created</th>
                     <th>Date Updated</th>
                  </tr>
               </thead>
         </table>
	</div>
</div>
</div>

<script>
	 $(function() {
               $('#table').DataTable({
               processing: true,
               serverSide: true,
               ajax: '{{ url('index') }}',
               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'avatar', name: 'avatar' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'updated_at', name: 'updated_at' }
                     ]
            });
         });
</script>
@endsection
