<div class="container-fluid">
    <div class="row">
		<div class="col-md-8 margin">
			<b>Category Control</b>
		</div>
		<div class="col-md-4 margin" align="right">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#frmCategory" onclick="NewFrm()">
            New
            </button>
		</div>
	</div>
	<hr>
    <form class="form-inline" action="main.php?url=PI/CategoryControl.php" method="post" name="Categorycon">
        <div class="form-group">
            <label for="CategoryName">Category Name: </label>
            <input type="text" class="form-control" id="CategoryName" name="CategoryName" placeholder="Category Name">
        </div>
        <button type="submit" class="btn btn-default">
            <span class="glyphicon glyphicon-refresh"></span>
        </button>
    </form>
    <br><br>
<!-- Modal -->
    <div class="modal fade" id="frmCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="CategoryName2"></div>
        </div>
    </div>
<?php
    require "ConnectDB.php";
    require "session.php";

    if(isset($_POST['CategoryName'])){
        $CategoryName = $_POST['CategoryName'];

        $sql = "EXEC CategorySelInsUpdDel @Option = 1, @CategoryName = '".$CategoryName."'";
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

    <table class="table table-hover" id="CategoryID">
	    <thead style="background-color: #ffff00;">
            <tr>
                <th width="15%"><b>Category Code</b></th>
                <th width="15%"><b>Category Level</b></th>                
                <th width="55%"><b>Category Name</b></th>
                <th width="10%"><b>Active</b></th>
                <th width="5%"><b>Edit</b></th>
            </tr>
	    </thead>
		<tbody style="background-color: #ffffff;">
<?php while($result = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
            <tr onclick="myFunction(this)">
                <td><?php echo $result['CategoryID']; ?></td>
                <td><?php echo $result['CategoryLv']; ?></td>
                <td><?php echo $result['CategoryName']; ?></td>
                <td><?php echo $result['IsActive']; ?></td>
                <td>
                    <a data-toggle="modal" data-target="#frmCategory" href="#">
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
                document.getElementById("CategoryName2").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "PI/frmCategory.php", true);
        xmlhttp.send();
    }
    
    function myFunction(x) {
        var rows = x.rowIndex;
        var CatID = document.getElementById("CategoryID").rows[rows].cells;
        var CategoryID = CatID[0].innerHTML;

        if(CategoryID != ""){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("CategoryName2").innerHTML = this.responseText;
            }
        }
            xmlhttp.open("GET", "PI/frmCategory.php?id=" + CategoryID, true);
            xmlhttp.send();
        }
    }

    function CheckCat(){
        var CategoryLv = document.Category.CategoryLv.value;
        var CategoryName = document.Category.CategoryName.value;
        var CategoryParent = document.Category.CategoryParent.value;   
        if(CategoryLv == ""){
            alert("Pless Input Category Level.");
            document.Category.CategoryLv.focus();
        }else if(CategoryName == ""){
            alert("Pless Input Category Name.");
            document.Category.CategoryName.focus();
        }else if(CategoryParent == "" && CategoryLv !== "1"){
            alert("Pless Input Parent Category.");
            document.Category.CategoryParent.focus();
        }else{
            document.Category.submit();
        }
    }
</script>
