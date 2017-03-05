<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>BD Pos System</title>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="css/menu.css" />
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>
<body style="background-color: coral">
	<div>
		<h1>BD Pos System</h1>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div style="border:1px solid; background-color: burlywood; height: 100vh;" class="col-md-2">
				<?php include("menu.php"); ?>
			</div>
			<div style="border:1px solid; background-color: #1affff; height: 100vh;" class="col-md-10"><?php include("content.php"); ?></div>
		</div>
	</div>
</body>
</html>