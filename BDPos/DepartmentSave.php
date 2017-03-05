<?php
    require("ConnectDB.php");
    require("session.php");

    $DpID = $_POST['DpID'];
    $DpName = $_POST['DpName'];

    if($DpID == ""){
        $sql = "INSERT INTO Department(DpName) VALUES('".$DpName."')";
    }else{
        $sql = "UPDATE Department SET DpName = '".$DpName."' WHERE DpID = ".$DpID;
    }
    $objConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $objConnect->prepare($sql);
echo $sql;
    try{
        $stmt->execute();
        if($_SESSION['DpID'] == 1){
				echo $sql;
			}
        header("Location: main.php?url=DepartmentControl.php");
    }catch(PDOException $e){
        echo "เกิดข้อผิดพลาด ".$e->getMessage();
    }
?>