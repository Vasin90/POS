<?php
	session_start();
	if(isset($_SESSION['LoginID'])){
		$loginID = $_SESSION['LoginID'];
		if($loginID){
			header("Location: main.php");
		}
	}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BD Pos System</title>
		<style ref"stylesheet" href="css/bootstrap.min.css"></style>
		<link rel="stylesheet" href="css/bootstrap-theme.min.css" />
		<style>
			.form{
				margin:15% 50% 0 35%;
				background-color: #ffbf00;
				width: 300px;
			}
		</style>		
	</head>
	<body style="background: #b3ffff">
		<form method="post" action="Login.php" name="ChkLogin" class="form">
			<fieldset>
				<legend><h1>BD Pos System</h1></legend>
				<table>
					<tr>
						<td><label>Username: </label></td>
						<td><input type="text" name="Username" value="" autofocus /></td>
					</tr>
					<tr>
						<td><label>Password: </label></td>
						<td><input type="password" name="Password" value="" /></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input style="color: #ffffff" class="btn btn-primary btn-sm" type="submit" onclick="ChekLogin()"  value="Login Now!" />
						</td>
					</tr>
				</table>
			</fieldset>
		</form>
	</body>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquert-3.1.1.min.js"></script>
	<script type="text/javascript">
			function ChekLogin(){
				var user = document.ChkLogin.Username.value;
				var pass = document.ChkLogin.Password.value;

				if(user == ""){
					alert("กรุณากรอก Username");
					document.ChkLogin.Username.focus();
				}else if(pass == ""){
					alert("กรุณากรอก Password");
					document.ChkLogin.Password.focus();
				}else{
					document.ChkLogin.submit();
				}
			}
		</script>
</html>