<!DOCTYPE html>
<html lang="en">
<head>
	@include('partials.siteheader')
	@yield('header_scripts')
	
</head>
<body>
    <div id="wrapper">
		@include('partials.sidebar_nav')
		@include('partials.header_nav')
		<div class="row wrapper border-bottom white-bg page-heading">
			@yield('content')
		</div>
		@include('partials.sitefooter')
		@yield('footer_scripts')
	</div>
</body>
</html>