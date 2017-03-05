<div class="container-fluid">
    <div class="row">
		<div class="col-md-8 margin">
			<b>Supplier Control</b>
		</div>
		<div class="col-md-4 margin" align="right">
			<button class="btn btn-info" data-toggle="modal" data-target="#frmSupplier" onclick="NewFrm()">New</button>
		</div>
	</div>
	<hr>
    <form class="form-inline" action="main.php?url=PI/SupplierControl.php" method="post" name="Suppliercon">
        <div class="form-group">
            <label for="SupplierName">Supplier Name: </label>
            <input type="text" class="form-control" id="SupplierName" name="SupplierName" placeholder="Supplier Name">
        </div>
        <button type="submit" class="btn btn-default">
            <span class="glyphicon glyphicon-refresh"></span>
        </button>
    </form>
    <br><br>
<!-- Modal -->
    <div class="modal fade" id="frmSupplier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="frmSupplier2"></div>
        </div>
    </div>

<?php
    require "ConnectDB.php";
    require "session.php";

    if(isset($_POST['SupplierName'])){
        $SupplierName = $_POST['SupplierName'];

        $sql = "EXEC SupplierSelInsUpdDel @Option = 1, @SpName = '".$SupplierName."'";
        $objConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $objConnect->prepare($sql);

        try{
            $stmt->execute();
            if($_SESSION['DpID'] == 1){
				echo $sql;
			}
        }catch(PDOException $e){
            echo "การเรียกข้อมูลผิดพลาด".$e->getMessage();
        }
?>
    <table class="table table-hover" id="SpID">
	    <thead style="background-color: #ffff00;">
            <tr>
                <th width="15%">Supplier Code</th>
                <th width="70%">Supplier Name</th>
                <th width="10%">Active</th>
                <th width="5%">Edit</th>
            </tr>
	    </thead>
		<tbody style="background-color: #ffffff;">
<?php while($result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $a = $result["Row"];
?>
            <tr onclick="myFunction(this)">
                <td><?php echo $result['SupplierID']; ?></td>
                <td><?php echo $result['SupplierName']; ?></td>
                <td><?php echo $result['IsActive']; ?></td>
                <td>
                    <a href="#" data-toggle="modal" data-target="#frmSupplier">                        
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                </td>
            </tr>
<?php } ?>
        </tbody>
    </table>
</div>
<?php } ?>
<script type="text/javascript">
    
    function NewFrm(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("frmSupplier2").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "PI/frmSupplier.php", true);
        xmlhttp.send();
    }
    
    function myFunction(x) {
        var rows = x.rowIndex;
        var SpID = document.getElementById("SpID").rows[rows].cells;
        var SupplierID = SpID[0].innerHTML;

        if(SupplierID != ""){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("frmSupplier2").innerHTML = this.responseText;
            }
        }
            xmlhttp.open("GET", "PI/frmSupplier.php?id=" + SupplierID, true);
            xmlhttp.send();
        }
    }

    function changeCountry(){
        
        var CountID = document.Supplier.Country.value;
        if(CountID != ""){
            //alert(CountID);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("City").innerHTML = this.responseText;
            }
        }
            xmlhttp.open("GET", "PI/CitySel.php?CountID=" + CountID, true);
            xmlhttp.send();
        }
    }
    function changeCity(){
        
        var CityID = document.Supplier.City.value;
        if(CityID != ""){
            //alert(CountID);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("District").innerHTML = this.responseText;
            }
        }
            xmlhttp.open("GET", "PI/CitySel.php?CityID=" + CityID, true);
            xmlhttp.send();
        }
    }
    function changeDistrict(){
        
        var DistrictID = document.Supplier.District.value;
        if(DistrictID != ""){
            //alert(CountID);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("SubDistrict").innerHTML = this.responseText;
            }
        }
            xmlhttp.open("GET", "PI/CitySel.php?DistrictID=" + DistrictID, true);
            xmlhttp.send();
        }
    }

    function ChkSPP(){
        var SpName = document.Supplier.SpName.value;
        var AddrNo = document.Supplier.SpAddr.value;
        var Country = document.Supplier.Country.value;
        var City = document.Supplier.City.value;
        var District = document.Supplier.District.value;
        var SubDistrict = document.Supplier.SubDistrict.value;

        if(SpName == ""){
            alert("Pless Input Supplier Name.");
            document.Supplier.SpName.focus();
        }else if(AddrNo == ""){
            alert("Pless Input Address No.");
            document.Supplier.SpAddr.focus();
        }else if(Country == ""){
            alert("Pless Input Country.");
            document.supplier.Country.focus();
        }else if(City == ""){
            alert("Pless Input City.");
        }else if(District == ""){
            alert("Pless Input District");
        }else if(SubDistrict == ""){
            alert("Pless Input Sub-District");
        }else{
            document.Supplier.submit();
        }
        
    }
</script>
