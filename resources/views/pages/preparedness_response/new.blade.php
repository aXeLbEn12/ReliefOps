@extends('main')

@section('content')
<section class="content-placer col-md-9">
	<div class="header">


		<h1 class="page-title">Reports</h1>
	</div>
	
	<ul class="breadcrumb">
		<li><a href="index.html">Home</a></li>
		<li><a href="#">Preparedness Response</a></li>
		<li><a href="#">New</a></li>
	</ul>
	
	<div id="content-Articles">
		<a href="#" class="btn btn-primary"><i class="icon-plus"></i> New Report</a>
		{!! Form::open(array('url'=>'preparedness_response/upload','method'=>'POST', 'files'=>true)) !!}
			@if (Session::has('success'))
				<div class="alert alert-dismissible alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<p>{{ Session::get('success') }}</p>
				</div>
			@endif
			@if(Session::has('error'))
				<div class="alert alert-dismissible alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<p>{!! Session::get('error') !!}</p>
				</div>
			@endif
			
			<div class="form-group">
				<label for="email_address" class="control-label">Upload File:</label>
				<div>
					<input type="file" name="report" id="report" />
					<p class="errors">{!!$errors->first('image')!!}</p>
				</div>
			</div>
			
			<div class="text-left">
				<input type="submit" name="submit" id="submit" name="Submit" class="btn  btn-default" />
			</div>
		{!! Form::close() !!}
	</div>
	
	<div class="clearfix"></div>
</section> <!-- content-cont end -->
@endsection