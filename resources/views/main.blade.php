<!DOCTYPE html>
<html lang="en">
<head>
	@include('partials.siteheader')
	@yield('header_scripts')
	
</head>
<body>

	@include('partials.header_nav')
	
	<div class="row main-content">
		@include('partials.sidebar_nav')
		@yield('content')
	</div> <!-- main-content end -->
	@include('partials.sitefooter')
	@yield('footer_scripts')
</body>
</html>