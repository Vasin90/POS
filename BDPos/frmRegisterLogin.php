<?php
	require("ConnectDB.php");
	require("session.php");

	$sqlDp = "SELECT DpID, DpName FROM Department ORDER BY DpID ASC";
	$objConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmtDp = $objConnect->prepare($sqlDp);
	try{
		$stmtDp->execute();
	}catch(PDOException $e){
		echo "เกิดข้อผิดพลาด ".$e->getMessage();
	}

	if(isset($_GET['id'])){
		$LoginID = $_GET['id'];

		$sql = "select li.LoginName, li.Password, st.StFirstName, st.StLastName, st.StEmail, dp.DpName, dp.DpID ";
		$sql .= "from staff st with(nolock) ";
		$sql .= "join Login li with(nolock) on li.StCode = st.StID ";
		$sql .= "join Department dp with(nolock) on dp.DpID = st.DpID ";
		$sql .= "where li.LoginID = ".$LoginID;
		$objConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmtEdit = $objConnect->prepare($sql);
		try{
			$stmtEdit->execute();
			$reSult = $stmtEdit->fetch(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			echo "เกิดข้อผิดพลาด ".$e->getMessage();
		}
?>
<div>
	<fieldset>
		<legend><h1>Register Staff</h1></legend>
		<form class="form-horizontal" action="RegisterLogin.php" name="frmRegisLogin" method="post">
			<div class="form-group">
				<label for="Username" class="col-sm-2 control-label">Username:</label>
				<div class="col-sm-10">
					<input type="Username" class="form-control" name="Username" value="<?php echo $reSult['LoginName']; ?>" placeholder="Username" autofocus>
				</div>
			</div>
			<div class="form-group">
				<label for="Password" class="col-sm-2 control-label">Password:</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" name="Password" value="" placeholder="Password">
				</div>
			</div>
			<div class="form-group">
				<label for="Firstname" class="col-sm-2 control-label">Firstname:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="Firstname" value="<?php echo $reSult['StFirstName']; ?>" placeholder="Firstname">
				</div>
			</div>
			<div class="form-group">
				<label for="Lastname" class="col-sm-2 control-label">Lastname:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="Lastname" value="<?php echo $reSult['StLastName']; ?>" placeholder="Lastname">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmailPassword3" class="col-sm-2 control-label">Email:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="Email" value="<?php echo $reSult['StEmail']; ?>" placeholder="Email">
				</div>
			</div>
			<div class="form-group">
				<label for="Departmant" class="col-sm-2 control-label">Departmant:</label>
				<div class="col-sm-10">
					<select class="form-control" name="Department">
						<option value="<?php echo $reSult['DpID']; ?>"><?php echo $reSult['DpName']; ?></option>
					<?php while($reSultDb = $stmtDp->fetch(PDO::FETCH_ASSOC)){ ?>
						<option value="<?php echo $reSultDb['DpID']; ?>"><?php echo $reSultDb['DpName']; ?></option>
					<?php } ?>
					</select>
				</div>
			</div>			
<?php }else{ ?>
<div>
	<fieldset>
		<legend><h1>Register Staff</h1></legend>
		<form class="form-horizontal" action="RegisterLogin.php" name="frmRegisLogin" method="post">
			<div class="form-group">
				<label for="Username" class="col-sm-2 control-label">Username:</label>
				<div class="col-sm-10">
					<input type="Username" class="form-control" name="Username" placeholder="Username" autofocus>
				</div>
			</div>
			<div class="form-group">
				<label for="Password" class="col-sm-2 control-label">Password:</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" name="Password" placeholder="Password">
				</div>
			</div>
			<div class="form-group">
				<label for="Firstname" class="col-sm-2 control-label">Firstname:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="Firstname" placeholder="Firstname">
				</div>
			</div>
			<div class="form-group">
				<label for="Lastname" class="col-sm-2 control-label">Lastname:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="Lastname" placeholder="Lastname">
				</div>
			</div>
			<div class="form-group">
				<label for="inputEmailPassword3" class="col-sm-2 control-label">Email:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="Email" placeholder="Email">
				</div>
			</div>
			<div class="form-group">
				<label for="Departmant" class="col-sm-2 control-label">Departmant:</label>
				<div class="col-sm-10">
					<select class="form-control" name="Department">
					<?php while($reSultDb = $stmtDp->fetch(PDO::FETCH_ASSOC)){ ?>
						<option value="<?php echo $reSultDb['DpID']; ?>"><?php echo $reSultDb['DpName']; ?></option>
					<?php } ?>
					</select>
				</div>
			</div>		
<?php } ?>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="hidden" name="LoginID" value="<?php echo $LoginID; ?>" />
					<button type="button" class="btn btn-primary" onclick="chkRegisLogin()">Sign in</button>
					<button class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	<fieldset>
</div>