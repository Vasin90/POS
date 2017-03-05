<?php
	session_start();
	$loginID = $_SESSION['LoginID'];
	if(!$loginID){
		header("Location: index.php");
	}
?>