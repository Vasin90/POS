<?php
	if(isset($_GET['url'])){
		$url = $_GET['url'];
		$file = $url;
		
		include_once $file;
	}else{
		require("session.php");
		echo "<h1>BD Pos System!</h1>";
		echo "ยินดีต้อนรับคุณ ".$_SESSION['Name'];
	}
?>