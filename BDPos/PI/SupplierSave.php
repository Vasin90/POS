<?php
    require "../ConnectDB.php";
    require "../session.php";

    $SuppName = $_POST['SpName'];
    $AddrNo = $_POST['SpAddr'];
    $SubDistrict = $_POST['SubDistrict'];
    $District = $_POST['District'];
    $City = $_POST['City'];
    $Country = $_POST['Country'];
    $Zipcode = $_POST['Zipcode'];
    $Tel = $_POST['Telephone'];
    $Email = $_POST['Email'];
    $SpID = $_POST['SpID'];
    $AddrID = $_POST['AddrID'];

    if($SpID == "" || $AddrID == ""){
        $sql = "EXEC SupplierSelInsUpdDel @Option = 2, @SpName = '".$SuppName."', @LoginID = ".$loginID.", ";
        $sql .= "@AddrNo = '".$AddrNo."', @SubDistrict = ".$SubDistrict.", @District = ".$District.", ";
        $sql .= "@City = ".$City.", @Country = ".$Country.", @Zipcode = '".$Zipcode."', @Tel = '".$Tel."', ";
        $sql .= "@Email = '".$Email."'";
        $objConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $objConnect->prepare($sql);
    }else{
        $sql = "EXEC SupplierSelInsUpdDel @Option = 3, @SpName = '".$SuppName."', @LoginID = ".$loginID.", ";
        $sql .= "@AddrNo = '".$AddrNo."', @SubDistrict = ".$SubDistrict.", @District = ".$District.", ";
        $sql .= "@City = ".$City.", @Country = ".$Country.", @Zipcode = '".$Zipcode."', @Tel = '".$Tel."', ";
        $sql .= "@Email = '".$Email."', @SpID = ".$SpID.", @AddrID = ".$AddrID;
        $objConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $objConnect->prepare($sql);
    }
    try{
        $stmt->execute();
    }catch(PDOException $e){
        echo "การเรียกข้อมูลผิดพลาด".$e-getMessage();
    }
    if($stmt){
        header("Location: ../main.php?url=PI/SupplierControl.php");
    }else{
        echo "ไม่สามารถบันทึกข้อมูลได้ ".$sql;
    }

