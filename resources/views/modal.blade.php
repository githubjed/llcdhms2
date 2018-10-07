<!-- Add Modal for patient -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title text-center" id="myModalLabel">Add New Patient</h4>
			</div>
			<div class="modal-body">
				{!! Form::open(['url' => 'save']) !!}
			    	<div class="form-group">
						<div class="row">
				    		<div class="col-md-2" style="margin-top:7px;">
				    			{!! Form::label('firstname', 'Firstname') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::text('firstname', '', ['class' => 'form-control', 'placeholder' => 'Input Firstname', 'required']) !!}
				    		</div>
				    	</div>
			    	</div>
			    	<div class="form-group">
			    		<div class="row">
				    		<div class="col-md-2" style="margin-top:7px;">
				    			{!! Form::label('lastname', 'Lastname') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::text('lastname', '', ['class' => 'form-control', 'placeholder' => 'Input Lastname', 'required']) !!}
				    		</div>
				    	</div>
			    	</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
				<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

<!-- Add Modal for employees -->
<div class="modal fade" id="addnewemp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title text-center" id="myModalLabel">Add New Employee</h4>
			</div>
			<div class="modal-body">
				{!! Form::open(['url' => 'emp_save']) !!}
			    	<div class="form-group">
						<div class="row">
				    		<div class="col-md-2" style="margin-top:7px;">
				    			{!! Form::label('firstname', 'Firstname') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::text('firstname', '', ['class' => 'form-control', 'placeholder' => 'Input Firstname', 'required']) !!}
				    		</div>
				    	</div>
			    	</div>
			    	<div class="form-group">
			    		<div class="row">
				    		<div class="col-md-2" style="margin-top:7px;">
				    			{!! Form::label('lastname', 'Lastname') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::text('lastname', '', ['class' => 'form-control', 'placeholder' => 'Input Lastname', 'required']) !!}
				    		</div>
				    	</div>
			    	</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
				<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>



<!-- Add Modal for medicines -->
<div class="modal fade" id="addnewmed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title text-center" id="myModalLabel">Add New Medicine</h4>
			</div>
			<script >
				

			</script>
			<div class="modal-body">
				{!! Form::open(['url' => 'med_save']) !!}
			    	<div class="form-group">
						<div class="row">
				    		<div class="col-md-2" style="margin-top:7px;">
				    			{!! Form::label('med_id', 'MID') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::text('med_id', '', ['class' => 'form-control', 'placeholder' => 'input MID','required']) !!}
				    		</div>
				    	</div>
			    	</div>
			    	<div class="form-group">
						<div class="row">
				    		<div class="col-md-2" style="margin-top:7px;">
				    			{!! Form::label('med_name', 'Name') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::text('med_name', '', ['class' => 'form-control', 'placeholder' => 'Input Name', 'required']) !!}
				    		</div>
				    	</div>
			    	</div>
			    	<div class="form-group">
						<div class="row">
				    		<div class="col-md-2" style="margin-top:7px;">
				    			{!! Form::label('med_cat', 'Category') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::text('med_cat', '', ['class' => 'form-control', 'placeholder' => 'Input Category', 'required']) !!}
				    		</div>
				    	</div>
			    	</div>
			    	<div class="form-group">
						<div class="row">
				    		<div class="col-md-2" style="margin-top:7px;">

				    			<!-- {!! Form::label('med_qty', 'Quantity') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::text('med_qty', '', ['class' => 'form-control', 'placeholder' => 'Input Quantity', 'required']) !!} -->

				    			{!! Form::label('quantity', 'Quantity') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::number('quantity', '', ['class' => 'form-control', 'placeholder' => 'Input Quantity', 'required']) !!}

				    		</div>
				    	</div>
			    	</div>
			    	<div class="form-group">
			    		<div class="row">
				    		<div class="col-md-2" style="margin-top:7px;">
				    			{!! Form::label('med_price', 'Price') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::text('med_price', '', ['class' => 'form-control', 'placeholder' => 'Input Price', 'required']) !!}
				    		</div>
				    	</div>
			    	</div>
			    	<div class="form-group">
			    		<div class="row">
				    		<div class="col-md-2" style="margin-top:7px;">
				    			{!! Form::label('expiry_date', 'Expiry Date') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::date('expiry_date', '', ['class' => 'form-control', 'required']) !!}
				    		</div>
				    	</div>
			    	</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
				<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>


<!-- Add Modal for laboratories -->
<div class="modal fade" id="addnewlab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title text-center" id="myModalLabel">Add New Laboratory</h4>
			</div>
			<div class="modal-body">
				{!! Form::open(['url' => 'lab_save']) !!}
			    	<div class="form-group">
						<div class="row">
				    		<div class="col-md-2" style="margin-top:7px;">
				    			{!! Form::label('lab_name', 'Lab. Name') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::text('lab_name', '', ['class' => 'form-control', 'placeholder' => 'Input Lab. Name', 'required']) !!}
				    		</div>
				    	</div>
			    	</div>
			    	<div class="form-group">
			    		<div class="row">
				    		<div class="col-md-2" style="margin-top:7px;">
				    			{!! Form::label('lab_price', 'Lab. Price') !!}
				    		</div>
				    		<div class="col-md-10">
				    			{!! Form::text('lab_price', '', ['class' => 'form-control', 'placeholder' => 'Input Lab. Price', 'required']) !!}
				    		</div>
				    	</div>
			    	</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
				<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>