<!-- Edit Modal -->
<div class="modal fade" id="edit_lab{{$laboratory->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title text-center" id="myModalLabel">Edit Laboratory</h4>
			</div>
			<div class="modal-body">
				{!! Form::model($laboratories, [ 'method' => 'patch','route' => ['laboratory.update', $laboratory->id] ]) !!}
			    	<div class="form-group">
						<div class="row">
				    		<div class="col-md-2" style="margin-top:7px;">
				    			{!! Form::label('lab_name', 'Lab. Name') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::text('lab_name', $laboratory->lab_name, ['class' => 'form-control']) !!}
				    		</div>
				    	</div>
			    	</div>
			    	<div class="form-group">
			    		<div class="row">
				    		<div class="col-md-2" style="margin-top:7px;">
				    			{!! Form::label('lab_price', 'Lab. Prce') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::text('lab_price', $laboratory->lab_price, ['class' => 'form-control']) !!}
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
<div class="modal fade" id="delete_lab{{$laboratory->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title text-center" id="myModalLabel">Delete Laboratory</h4>
			</div>
			<div class="modal-body">
				{!! Form::model($laboratories, [ 'method' => 'delete','route' => ['laboratory.delete', $laboratory->id] ]) !!}
					<h4 class="text-center">Are you sure you want to delete Laboratory?</h4>
					<h5 class="text-center">Name: {{$laboratory->lab_name}} {{$laboratory->lab_price}}</h5>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
				{{Form::button('<i class="fa fa-trash"></i> Delete', ['class' => 'btn btn-danger', 'type' => 'submit'])}}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

