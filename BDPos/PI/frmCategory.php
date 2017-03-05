<?php
    require("../ConnectDB.php");
    require("../session.php");
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Category</h4>
</div>
<div class="modal-body">
    <form class="form-horizontal" action="PI/CategorySave.php" name="Category" method="post">
<?php
    if(isset($_GET['id'])){
        $CategoryID = $_GET['id'];

        $sql = "EXEC CategorySelInsUpdDel @Option = 1, @CategoryID = ".$CategoryID;
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
                <label for="Category">Category Level: </label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="CategoryLv" id="CategoryLv" placeholder="Category Level" value="<?php echo $reSult['CategoryLv']; ?>">                
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="CategoryParent">Parent Category: </label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="CategoryParent" id="CategoryParent" placeholder="Category Parent" value="<?php echo $reSult['CategoryParent']; ?>">                
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="Address">Category Name: </label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="CategoryName" placeholder="Category Name" value="<?php echo $reSult['CategoryName']; ?>" autofocus>
                <input type="hidden" class="form-control" name="CategoryID" value="<?php echo $reSult['CategoryID']; ?>"/>
            </div>
        </div>
    <?php }else{ ?>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="Category">Category Level: </label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="CategoryLv" id="CategoryLv" placeholder="Category Level">                
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="CategoryParent">Parent Category: </label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="CategoryParent" id="CategoryParent" placeholder="Category Parent">                
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="CategoryLv">Category Name: </label>
            </div>
            <div class="col-sm-10">
               <input type="text" class="form-control" name="CategoryName" placeholder="Category Name" autofocus>
            </div>
        </div>
    <?php } ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="CheckCat();">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
<br><br>