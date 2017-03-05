<div>
	<div class="row">
		<div class="col-md-8 margin">
			<b>Department Control</b>
		</div>
		<div class="col-md-4 margin" align="right">
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#frmDepartment" onclick="NewFrm()">
            New
            </button>
		</div>
	</div>
    <hr>
	<div>
		<form action="main.php?url=DepartmentControl.php" method="post">
			<label>Demartment: </label>&nbsp;
			<input type="text" name="Department" />&nbsp;&nbsp;
			<button type="submit"><span class="glyphicon glyphicon-refresh"></span></button>
		</form>
	</div>	
</div>
<br>
<!-- Modal -->
    <div class="modal fade" id="frmDepartment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="DepartmentName2"></div>
        </div>
    </div>
<?php
    require("ConnectDB.php");
    require("session.php");
    if(isset($_POST['Department'])){
        $dpName = $_POST['Department'];

        $sql = "SELECT DpID, DpName FROM Department WHERE DpName LIKE '%".$dpName."%'";
        $objConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $objConnect->prepare($sql);

        try{
            $stmt->execute();
            if($_SESSION['DpID'] == 1){
				echo $sql;
			}
        }catch(PDOException $e){
			echo "เกิดข้อผิดพลาด ".$e->getMessage();
        }
?>
    <table class="table table-hover" id="DpID">
        <thead style="background-color: #ffff00;">
            <tr>
                <th>Department Code</th>
                <th>Department Name</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody style="background-color: #ffffff;">
        <?php while($reSult = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
            <tr onclick="myFunction(this)">
                <td>
                    <?php echo $reSult['DpID']; ?>
                </td>
                <td>
                    <?php echo $reSult['DpName']; ?>
                </td>
                <td>
                    <a href="#" data-toggle="modal" data-target="#frmDepartment">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>

<script type="text/javascript">

    function NewFrm(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("DepartmentName2").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "frmDepartment.php", true);
        xmlhttp.send();
    }
    
    function myFunction(x) {
        var rows = x.rowIndex;
        var DepartID = document.getElementById("DpID").rows[rows].cells;
        var DpID = DepartID[0].innerHTML;

        if(DpID != ""){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("DepartmentName2").innerHTML = this.responseText;
            }
        }
            xmlhttp.open("GET", "frmDepartment.php?id=" + DpID, true);
            xmlhttp.send();
        }
    }

    function ChkDp(){
        var departName = document.department.DpName.value;
        if(departName == ""){
            alert("กรุณากรอก Department Name!");
            document.department.DpName.focus();
        }else{
            document.department.submit();
        }
    }

</script>
