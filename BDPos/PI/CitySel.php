<?php
    require "../ConnectDB.php";
    require "../session.php";

    if(isset($_GET['CountID'])){
        $CountID = $_GET['CountID'];
        $sql = "SELECT CityID, CityName FROM City WHERE CountID = ".$CountID;
        $objConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $objConnect->prepare($sql);
        
        try{
            $stmt->execute();            
        }catch(PDOException $e){
            echo "เกิดข้อผิดพลาด ".$e->getMessage();
        }
            echo "<option value=''>---- Selected ----</option>";
        while($reSult = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<option value='".$reSult['CityID']."'>".$reSult['CityName']."</option>";
        }
    }else if(isset($_GET['DistrictID'])){
        $DistrictID = $_GET['DistrictID'];
        $sql = "SELECT SubID, SubName FROM SubDistrict WHERE DistID = ".$DistrictID;
        $objConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $objConnect->prepare($sql);
        
        try{
            $stmt->execute();            
        }catch(PDOException $e){
            echo "เกิดข้อผิดพลาด ".$e->getMessage();
        }
            echo "<option value=''>---- Selected ----</option>";
        while($reSult = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<option value='".$reSult['SubID']."'>".$reSult['SubName']."</option>";
        }
    }else if(isset($_GET['CityID'])){
        $CityID = $_GET['CityID'];
        $sql = "SELECT DistID, DistName FROM District WHERE CityID = ".$CityID;
        $objConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $objConnect->prepare($sql);
        
        try{
            $stmt->execute();            
        }catch(PDOException $e){
            echo "เกิดข้อผิดพลาด ".$e->getMessage();
        }
            echo "<option value=''>---- Selected ----</option>";
        while($reSult = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<option value='".$reSult['DistID']."'>".$reSult['DistName']."</option>";
        }
    }
?>