<!----------------------------------------------- action for medicine ----------------------------------------------------- -->

<!-- Edit Modal -->
<div class="modal fade" id="edit_med{{$medicine->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title text-center" id="myModalLabel">Edit Medicine</h4>
			</div>
			<div class="modal-body">
				{!! Form::model($medicines, [ 'method' => 'patch','route' => ['medicine.update', $medicine->id] ]) !!}
			    	<div class="form-group">
						<div class="row">
				    		<div class="col-md-2" style="margin-top:7px;">
				    			{!! Form::label('med_name', 'Name') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::text('med_name', $medicine->med_name, ['class' => 'form-control']) !!}
				    		</div>
				    	</div>
			    	</div>
			    	<div class="form-group">
						<div class="row">
				    		<div class="col-md-2" style="margin-top:7px;">
				    			{!! Form::label('med_cat', 'Category') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::text('med_cat', $medicine->med_cat, ['class' => 'form-control']) !!}
				    		</div>
				    	</div>
			    	</div>
			    	<div class="form-group">
			    		<div class="row">
				    		<div class="col-md-2" style="margin-top:7px;">
				    			{!! Form::label('med_price', 'Price') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::text('med_price', $medicine->med_price, ['class' => 'form-control']) !!}
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
<div class="modal fade" id="delete_med{{$medicine->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title text-center" id="myModalLabel">Delete Medicine</h4>
			</div>
			<div class="modal-body">
				{!! Form::model($medicines, [ 'method' => 'delete','route' => ['medicine.delete', $medicine->id] ]) !!}
					<h4 class="text-center">Are you sure you want to delete Medicine?</h4>
					<h5 class="text-center">Name: {{$medicine->med_name}} {{$medicine->med_cat}}</h5>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
				{{Form::button('<i class="fa fa-trash"></i> Delete', ['class' => 'btn btn-danger', 'type' => 'submit'])}}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>