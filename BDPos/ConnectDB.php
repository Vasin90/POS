<?php
	$objUser = "sa";
	$objPass = "Vasin112";
	$objDbName = "BDPos";
	$objServerName = "VASIN-PC\BDPOS";

	$objConnect = new PDO("sqlsrv:server=$objServerName ; Database = $objDbName", $objUser, $objPass);
?>