<!DOCTYPE html>
<html lang="en">
<head>
	@include('partials.siteheader')
	@yield('header_scripts')
	
</head>
<body>
	<div class="wrapper blank-wrapper">
		@yield('content')
	</div> <!-- blank-wrapper end -->
	@yield('footer_scripts')
</body>
</html>