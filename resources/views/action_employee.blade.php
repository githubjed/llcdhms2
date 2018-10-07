<!----------------------------------------------- action for employee ----------------------------------------------------- -->

<!-- Edit Modal -->
<div class="modal fade" id="edit_emp{{$employee->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title text-center" id="myModalLabel">Edit Employee</h4>
			</div>
			<div class="modal-body">
				{!! Form::model($employees, [ 'method' => 'patch','route' => ['employees.update', $employee->id] ]) !!}
			    	<div class="form-group">
						<div class="row">
				    		<div class="col-md-2" style="margin-top:7px;">
				    			{!! Form::label('firstname', 'Firstname') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::text('firstname', $employee->firstname, ['class' => 'form-control']) !!}
				    		</div>
				    	</div>
			    	</div>
			    	<div class="form-group">
			    		<div class="row">
				    		<div class="col-md-2" style="margin-top:7px;">
				    			{!! Form::label('lastname', 'Lastname') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::text('lastname', $employee->lastname, ['class' => 'form-control']) !!}
				    		</div>
				    	</div>
			    	</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
				{{Form::button('<i class="fa fa-check-square-o"></i> Update', ['class' => 'btn btn-success', 'type' => 'submit'])}}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
 
<!-- Delete Modal -->
<div class="modal fade" id="delete_emp{{$employee->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title text-center" id="myModalLabel">Delete Employee</h4>
			</div>
			<div class="modal-body">
				{!! Form::model($employees, [ 'method' => 'delete','route' => ['employees.delete', $employee->id] ]) !!}
					<h4 class="text-center">Are you sure you want to delete Employee?</h4>
					<h5 class="text-center">Name: {{$employee->firstname}} {{$employee->lastname}}</h5>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
				{{Form::button('<i class="fa fa-trash"></i> Delete', ['class' => 'btn btn-danger', 'type' => 'submit'])}}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>