<?php
    include("../ConnectDB.php");
    require("../session.php");
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Supplier</h4>
</div>
<div class="modal-body">
    <form class="form-horizontal" action="PI/SupplierSave.php" name="Supplier" method="post">
<?php
        $sqlCountry = "EXEC AddressSel @Option = 1";
        $objConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmtCountry = $objConnect->prepare($sqlCountry);
        try{
            $stmtCountry->execute();
        }catch(PDOException $e){
            echo "การเรียกข้อมูลผิดพลาด ".$e->getMessage();
        }
    if(isset($_GET['id'])){
        $SpID = $_GET['id'];

        $sql = "EXEC SupplierSelInsUpdDel @Option = 1, @SpID = ".$SpID;
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
                <label for="Supplier">Supplier Name1: </label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="SpName" placeholder="Supplier Name" value="<?php echo $reSult['SupplierName']; ?>" autofocus>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="Address">Address: </label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="SpAddr" id="SpAddr" placeholder="Address" value="<?php echo $reSult['AddrNo']; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="Country">Country: </label>
            </div>
            <div class="col-sm-10">
                <select class="form-control" name="Country" id="Country" onChange="changeCountry();">
                    <option value="<?php echo $reSult['AddrCountry']; ?>"><?php echo $reSult['CountName']; ?></option>
<?php while($resultCountry = $stmtCountry->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $resultCountry['CountID']; ?>"><?php echo $resultCountry['CountName']; ?></option>
<?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="City">City: </label>
            </div>
            <div class="col-sm-10">
                <select class="form-control" name="City" id="City" onChange="changeCity();">
                    <option value="<?php echo $reSult['AddrCity']; ?>"><?php echo $reSult['CityName']; ?></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="District">District: </label>
            </div>
            <div class="col-sm-10">
                <select class="form-control" name="District" id="District" onChange="changeDistrict();">
                    <option value="<?php echo $reSult['AddrDistrict']; ?>"><?php echo $reSult['DistName']; ?></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="SubDistrict">Sub-District: </label>
            </div>
            <div class="col-sm-10">
                <select class="form-control" name="SubDistrict" id="SubDistrict">
                    <option value="<?php echo $reSult['AddrSubdistrict']; ?>"><?php echo $reSult['SubName']; ?></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="Zipcode">Zipcode: </label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Zipcode" id="Zipcode" placeholder="Zipcode" value="<?php echo $reSult['AddrZipcode']; ?>"/>
            </div>        
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="Telephone">Tel/Fax No.: </label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Telephone" id="Telephone" placeholder="Telephone" value="<?php echo $reSult['AddrTel']; ?>"/>
            </div>        
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="Email">Email: </label>
            </div>
            <div class="col-sm-10">
                <input type="Email" class="form-control" name="Email" id="Email" placeholder="Email" value="<?php echo $reSult['AddrEmail']; ?>"/>
                <input type="hidden" class="form-control" name="SpID" value="<?php echo $reSult['SupplierID']; ?>"/>
                <input type="hidden" class="form-control" name="AddrID" value="<?php echo $reSult['AddrID']; ?>"/>
            </div>        
        </div>
    <?php }else{ ?>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="Supplier">Supplier Name2: </label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="SpName" placeholder="Supplier Name" autofocus>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="Address">Address: </label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="SpAddr" id="SpAddr" placeholder="Address">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="Country">Country: </label>
            </div>
            <div class="col-sm-10">
                <select class="form-control" name="Country" id="Country" onChange="changeCountry();">
                    <option value="">---- Selected ----</option>
<?php while($resultCountry = $stmtCountry->fetch(PDO::FETCH_ASSOC)){ ?>
                    <option value="<?php echo $resultCountry['CountID']; ?>"><?php echo $resultCountry['CountName']; ?></option>
<?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="City">City: </label>
            </div>
            <div class="col-sm-10">
                <select class="form-control" name="City" id="City" onChange="changeCity();">
                    <option value="">---- Selected ----</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="District">District: </label>
            </div>
            <div class="col-sm-10">
                <select class="form-control" name="District" id="District" onChange="changeDistrict();">
                    <option value="">---- Selected ----</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="SubDistrict">Sub-District: </label>
            </div>
            <div class="col-sm-10">
                <select class="form-control" name="SubDistrict" id="SubDistrict">
                    <option value="">---- Selected ----</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="Zipcode">Zipcode: </label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Zipcode" id="Zipcode" placeholder="Zipcode"/>
            </div>        
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="Telephone">Tel/Fax No.: </label>
            </div>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="Telephone" id="Telephone" placeholder="Telephone"/>
            </div>        
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">
                <label for="Email">Email: </label>
            </div>
            <div class="col-sm-10">
                <input type="Email" class="form-control" name="Email" id="Email" placeholder="Email"/>
            </div>        
        </div>
    <?php } ?>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-primary" onclick="ChkSPP()">Save</button>
                <a href="main.php?url=PI/SupplierControl.php" class="btn btn-primary" data-dismiss="modal">Close</a>
            </div>
        </div>
    </form>
</div>
<br><br>
