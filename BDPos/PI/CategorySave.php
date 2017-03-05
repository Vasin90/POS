<?php
    require "../ConnectDB.php";
    require "../session.php";

    $CategoryName = $_POST['CategoryName'];
    $CategoryLv = $_POST['CategoryLv'];    
    if(isset($_POST['CategoryParent'])){
        $CategoryParent = $_POST['CategoryParent'];
    }else{
        $CategoryParent =  "";
    }    
    if(isset($_POST['CategoryID'])){
        $CategoryID = $_POST['CategoryID'];
    }else{
        $CategoryID = "";
    }

    if($CategoryID == ""){
        $sql = "EXEC CategorySelInsUpdDel @Option = 2, @CategoryName = '". $CategoryName ."', @CategoryLv = ". $CategoryLv .", @CategoryParent = '". $CategoryParent ."', ";
        $sql .= "@LoginID = ".$loginID;
    }else{
        $sql = "EXEC CategorySelInsUpdDel @Option = 3, @CategoryName = '". $CategoryName ."', @CategoryLv = ". $CategoryLv .", @CategoryParent = '". $CategoryParent ."', ";
        $sql .= "@CategoryID = ". $CategoryID .",@LoginID = ".$loginID;
    }
    $objConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $objConnect->prepare($sql);

    try{
        $stmt->execute();
    }catch(PDOException $e){
        echo "การเรียกข้อมูลผิดพลาด".$e->getMessage();
    }
    if($stmt){
        //echo $sql;
        header("Location: ../main.php?url=PI/CategoryControl.php");
    }else{
        echo "ไม่สามารถบันทึกข้อมูลได้ ".$sql;
    }

