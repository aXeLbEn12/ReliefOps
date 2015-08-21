@extends('main')

@section('content')
<section class="content-placer col-md-9">
	<div class="header">


		<h1 class="page-title">Reports</h1>
	</div>
	
	<ul class="breadcrumb">
		<li><a href="index.html">Home</a></li>
		<li class="active">Report</li>
	</ul>
	
	<div id="content-Articles">
		<a href="#" class="btn btn-primary"><i class="icon-plus"></i> New Report</a>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Column 1</th>
					<th>Column 2</th>
					<th>Column 3</th>
					<th>Column 4</th>
					<th>Column 5</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>##</td>
					<td>Soufflé tart wafer topping</td>
					<td>
						Donut soufflé cookie cheesecake. Cookie tootsie roll cotton candy dragée dragée ice cream. Chocolate cake cotton candy chocolate cake bear claw lemon drops. Apple pie powder icing macaroon sweet roll ice cream dragée.
					</td>
					<td>
						<a href="#previewItem" role="button" class="btn" data-toggle="modal" data-target="#previewItem">Preview</a>
					</td>
					<td>
						<a href="article.html"><i class="icon-pencil"></i></a>
						<a href="#deleteItem" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
					</td>
				</tr>
				<tr>
					<td>##</td>
					<td>Soufflé tart wafer topping</td>
					<td>
						Donut soufflé cookie cheesecake. Cookie tootsie roll cotton candy dragée dragée ice cream. Chocolate cake cotton candy chocolate cake bear claw lemon drops. Apple pie powder icing macaroon sweet roll ice cream dragée.
					</td>
					<td><a href="#previewItem" role="button" class="btn" data-toggle="modal" data-target="#previewItem">Preview</a>
						
					</td>
					<td>
						<a href="article.html"><i class="icon-pencil"></i></a>
						<a href="#deleteItem" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
					</td>
				</tr>
				<tr>
					<td>##</td>
					<td>Soufflé tart wafer topping</td>
					<td>
						Donut soufflé cookie cheesecake. Cookie tootsie roll cotton candy dragée dragée ice cream. Chocolate cake cotton candy chocolate cake bear claw lemon drops. Apple pie powder icing macaroon sweet roll ice cream dragée.
					</td>
					<td><a href="#previewItem" role="button" class="btn" data-toggle="modal" data-target="#previewItem">Preview</a>
						
					</td>
					<td>
						<a href="article.html"><i class="icon-pencil"></i></a>
						<a href="#deleteItem" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
					</td>
				</tr>
				<tr>
					<td>##</td>
					<td>Soufflé tart wafer topping</td>
					<td>
						Donut soufflé cookie cheesecake. Cookie tootsie roll cotton candy dragée dragée ice cream. Chocolate cake cotton candy chocolate cake bear claw lemon drops. Apple pie powder icing macaroon sweet roll ice cream dragée.
					</td>
					<td><a href="#previewItem" role="button" class="btn" data-toggle="modal" data-target="#previewItem">Preview</a>
						
					</td>
					<td>
						<a href="article.html"><i class="icon-pencil"></i></a>
						<a href="#deleteItem" role="button" data-toggle="modal"><i class="icon-remove"></i></a>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="pagination-holder">
			<ul class="pagination">
				<li class="disabled"><a href="#">«</a></li>
				<li class="active"><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">»</a></li>
			</ul>
		</div>
	</div>
	
	<div class="clearfix"></div>
</section> <!-- content-cont end -->
@endsection