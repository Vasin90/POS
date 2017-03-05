<?php
    require("ConnectDB.php");
    require("session.php");
    
    $loginID = $_POST['LoginID'];
    $userName = $_POST['Username'];
    $passWord = $_POST['Password'];
    $firstName = $_POST['Firstname'];
    $lastName = $_POST['Lastname'];
    $departMent = $_POST['Department'];
    $eMail = $_POST['Email'];
    
    $passWord = $passWord."ds4sd4fasd4fasd3f4sd34fwe6456g";
    $passWord_Hash = md5($passWord);
    
    if($loginID == ""){
        $sql = "EXEC LoginInsUpdDel @Option = 1, @Username = '".$userName."', @Password = '".$passWord_Hash."', ";
        $sql .= "@Firstname = '".$firstName."', @Lastname = '".$lastName."', @Email = '".$eMail."', @DpID = ".$departMent.", @Creator = ".$_SESSION['StID'];
    }else{
        $sql = "EXEC LoginInsUpdDel @Option = 2, @Username = '".$userName."', @Password = '".$passWord_Hash."', ";
        $sql .= "@Firstname = '".$firstName."', @Lastname = '".$lastName."', @Email = '".$eMail."', @DpID = ".$departMent.", @Creator = ".$_SESSION['StID'];
        $sql .= ", @LoginID = ".$loginID;
    }
    $objConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $objConnect->prepare($sql);
	try{
		$stmt->execute();
        header("Location: main.php?url=loginControl.php");
        //echo $sql;
	}catch(PDOException $e){
		echo "เกิดข้อผิดพลาด ".$e->getMessage();
        echo $sql;
	}
   
?>