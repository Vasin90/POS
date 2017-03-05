<?php
	require('ConnectDB.php');
	require("session.php");

	$userName = $_POST['Username'];
	$passWord = $_POST['Password'];

	$passWord = $passWord."ds4sd4fasd4fasd3f4sd34fwe6456g";
    $passWord_Hash = md5($passWord);

	$sql = "EXEC asp_LoginSel @Option = 1, @Username = '$userName', @Password = '$passWord_Hash'";
	$objConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $objConnect->prepare($sql);
	
	try{
		$stmt->execute();
		$reSult = $stmt->fetch(PDO::FETCH_ASSOC);
	}catch(PDOException $e){
		echo "เกิดข้อผิดพลาด ".$e->getMessage();
	}
	if($reSult){
		session_start();
		$_SESSION['LoginID'] = $reSult['LoginID'];
		$_SESSION['Name'] = $reSult['Name'];
		$_SESSION['StID'] = $reSult['StID'];
		$_SESSION['DpID'] = $reSult['DpID'];
		header("location: main.php");
	}else{ ?>
		<script type="text/javascript">
			alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
			window.location="index.php";
		</script>
<?php } ?>