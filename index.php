<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Bootstrap 101 Template</title>

		<!-- Bootstrap -->
		<link href="app/libs/bootstrap/css/bootstrap.min.css?<?php echo time(); ?>" rel="stylesheet">
		<link href="app/css/style.css?<?php echo time(); ?>" rel="stylesheet">
		<link href="app/css/font-awesome.min.css?<?php echo time(); ?>" rel="stylesheet">
		<link href="app/css/animate.min.css?<?php echo time(); ?>" rel="stylesheet">
		<link href="app/css/font-oswald.css?<?php echo time(); ?>" rel="stylesheet">
		<!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Oswald:300,400,700|Source+Sans+Pro:300,400,600,700&amp;subset=latin,latin-ext" />-->

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div ng-include src="'app/partials/resources/frontend/views/header.html'"></div>
		<div ng-view></div>

		<script data-main="app/main" src="app/require.js?<?php echo time(); ?>"></script>
	</body>
</html>
