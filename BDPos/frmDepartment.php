<?php
    require("ConnectDB.php");
    require("session.php");
?>
<div>
<fieldset>
	<legend><h1>Department</h1></legend>
    <form class="form-horizontal" action="DepartmentSave.php" name="department" method="post">
<?php
    if(isset($_GET['id'])){
        $DpID = $_GET['id'];

        $sql = "SELECT DpID, DpName FROM Department WHERE DpID = ".$DpID;
        $objConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $objConnect->prepare($sql);

        try{
            $stmt->execute();
            $reSult = $stmt->FETCH(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "การเรียกข้อมูลผิดพลาด".$e->getMessage();
        }
?>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="Department">Department Name: </label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="<?php echo $reSult['DpName']; ?>" name="DpName" placeholder="Department Name" autofocus>
                <input type="hidden" value="<?php echo $reSult['DpID']; ?>" name="DpID">     
            </div>       
        </div>
    <?php }else{ ?>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="Department">Department Name: </label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="DpName" placeholder="Department Name" autofocus>
            </div>
        </div>
    <?php } ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-primary" onclick="ChkDp()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>         
            </div>
        </div>
    </form>
</fieldset>
</div>
<br><br>
