@extends('admin.master')
 
@section('content')
<div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">Medicines</li>
            </ol>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Medicines</h1>
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
					
						<button style="height: 45px;" type="button" data-target="#addnewmed" data-toggle="modal" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Medicine</button>
					
				</div>
			</div>
		</form>
			
		</h2>
	</div>
</div>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<table class="table table-bordered table-responsive table-striped">
			<thead>
				<th>Name</th>
				<th>Category</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Action</th>
			</thead>
			<tbody>
				@foreach ($medicines as $medicine)
					<tr>
						<td>{{$medicine->med_name}}</td>
						<td>{{$medicine->med_cat}}</td>
						<td>{{$medicine->quantity}}</td>
						<td>{{$medicine->med_price}}</td>
						<td><a href="#edit_med{{$medicine->id}}" data-toggle="modal" class="btn btn-success"><i class='fa fa-edit'></i> Edit</a> <a href="#delete_med{{$medicine->id}}" data-toggle="modal" class="btn btn-danger"><i class='fa fa-trash'></i> Delete</a>
							@include('action_medicine')
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div>
			{{ $medicines->links() }}
		</div>
	</div>
</div>
</div>
@endsection