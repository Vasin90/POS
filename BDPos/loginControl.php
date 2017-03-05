<div>
	<div class="row">
		<div class="col-md-8 margin">
			<b>User Contrl</b>
		</div>
		<div class="col-md-4 margin" align="right">
			<button type="button" class="btn btn-info" data-toggle="modal" data-target="#frmLogin" onclick="NewFrm()">
            New
            </button>
		</div>
	</div>
	<hr>
	<div>
		<form action="main.php?url=loginControl.php" method="post">
			<label>Staff name: </label>&nbsp;
			<input type="text" name="StaffName" />&nbsp;&nbsp;
			<label>Last name: </label>&nbsp;
			<input type="text" name="LastName" />&nbsp;&nbsp;
			<button type="submit"><span class="glyphicon glyphicon-refresh"></span></button>
		</form>
	</div>	
</div>
<br>
<!-- Modal -->
    <div class="modal fade" id="frmLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="LastName2"></div>
        </div>
    </div>
<?php
require("ConnectDB.php");
require("session.php");
	if(isset($_POST['StaffName']) || isset($_POST['LastName'])){
		$stFirstName = $_POST['StaffName'];
		$stLastName = $_POST['LastName'];

		$sql = "EXEC asp_LoginSel @Option = 2, @StaffName = '".$stFirstName."', @LastName = '".$stLastName."'";
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
	<table class="table table-hover" id="LoginID">
		<thead style="background-color: #ffff00;">
			<tr>
				<th>LoginID</th>
				<th>Login name</th>
				<th>Staff name</th>
				<th>Department</th>
				<th>Active</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody style="background-color: #ffffff;">
<?php while($reSult = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
		<tr onclick="myFunction(this)">
			<td>
				<?php echo $reSult['LoginID']; ?>
			</td>
			<td>
				<?php echo $reSult['LoginName']; ?>
			</td>
			<td>
				<?php echo $reSult['StaffName']; ?>
			</td>
			<td>
				<?php echo $reSult['DpName']; ?>
			</td>
			<td>
				<?php echo $reSult['IsActive']; ?>
			</td>
			<td>
				<a href="#" data-toggle="modal" data-target="#frmLogin">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
			</td>
		</tr>
<?php }} ?>
		</tbody>
	</table>

<script type="text/javascript">
	function NewFrm(){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("LastName2").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "frmRegisterLogin.php", true);
        xmlhttp.send();
    }
    
    function myFunction(x) {
        var rows = x.rowIndex;
        var LogID = document.getElementById("LoginID").rows[rows].cells;
        var LoginID = LogID[0].innerHTML;

        if(LoginID != ""){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("LastName2").innerHTML = this.responseText;
            }
        }
            xmlhttp.open("GET", "frmRegisterLogin.php?id=" + LoginID, true);
            xmlhttp.send();
        }
    }

	function chkRegisLogin(){
		var user = document.frmRegisLogin.Username.value;
		var pass = document.frmRegisLogin.Password.value;
		var fName = document.frmRegisLogin.Firstname.value;
		var lName = document.frmRegisLogin.Lastname.value;

		if(user == ""){
			alert("กรุณากรอก Username");
			document.frmRegisLogin.Username.focus();
		}else if(pass == ""){
			alert("กรุณากรอก Password");
			document.frmRegisLogin.Password.focus();
		}else if(fName == ""){
			alert("กรุณากรอก Firstname");
			document.frmRegisLogin.Firstname.focus();
		}else if(lName == ""){
			alert("กรุณากรอก Lastname");
			document.frmRegisLogin.Lastname.focus();
		}else{
			document.frmRegisLogin.submit();
		}
	}
</script>
