<?php
include_once "index_top.php";
?>

<h1>Autori</h1>
<?php
// editacia autora
if(isset($_GET['upd'])){
	$upd = intval($_GET['upd']);
	if($upd){
		$sql = "SELECT first_name, last_name FROM authors WHERE id = $upd";
$result = mysqli_query($conn, $sql);
// kontrola ci vratil nejake udaje
if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$meno = $row["first_name"];
	$priezvisko = $row["last_name"];
  		} 
	}	
	$id = $upd;
}
else {
	$meno = "";
	$priezvisko = "";
	$id = 0;
}
?>
<form action="authors_save.php" method="post" class="form-horizontal">
	<input type="hidden" name="id" value="<?php echo $id;?>">
	<div class="form-group">
		<label for="meno" class="col-sm-2 control-label">Meno</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" id="meno" name="meno" value="<?php echo $meno;?>" required>
		</div>
	</div>
	<div class="form-group">
		<label for="priezvisko" class="col-sm-2 control-label">Priezvisko</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" id="priezvisko" name="priezvisko" value="<?php echo $priezvisko;?>" required>
		</div>
	</div>	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-info">Uložiť</button>
		</div>
	</div>
</form>
<?php 
// vymazanie autora
if(isset($_GET['del'])){
	$del = intval($_GET['del']);
	
	$sql = "DELETE FROM authors WHERE id = $del";
	if($del){
	if (mysqli_query($conn, $sql)) {
		echo showBox("Autor bol vymazaný.", "success");}
	 else {
		echo showBox("Autora sa nepodarilo vymazať.", "danger");}}
	
}



if(isset($_SESSION['authors_save'])) {
	if($_SESSION['authors_save'] == "1") {
		echo showBox("Autor bol úspešne uložený.", "success");
	} elseif($_SESSION['authors_save'] == "2"){
		echo showBox("Autora sa nepodarilo uložiť.", "danger");
	} elseif($_SESSION['authors_save'] == "3"){
		echo showBox("Vyplňte všetky polia.", "warning");
	} elseif($_SESSION['authors_save'] == "4"){
		echo showBox("Autor bol úspešne upravený.", "success");
	} elseif($_SESSION['authors_save'] == "5"){
		echo showBox("Autora sa nepodarilo upraviť.", "danger");
	}
	unset($_SESSION['authors_save']);
}
?>
<hr>

<h3>Zoznam autorov</h3>
<table class="table table-striped tablejs">
<thead>
	<tr>
		<th>ID</th>
		<th>Meno</th>
		<th>Priezvisko</th>
		<th data-orderable="false" class="text-nowrap text-right">
			<a href="authors.php" class="btn btn-success btn-sm">Nový</a>
			<a href="authors_pdf.php" class="btn btn-info btn-sm">PDF</a>
			<a href="authors_excel.php" class="btn btn-info btn-sm">XLSX</a>
		</th>
	</tr>
</thead>
<tbody>
<?php
$sql = "SELECT id, first_name, last_name FROM authors";
$result = mysqli_query($conn, $sql);
// kontrola ci vratil nejake udaje
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		echo "<td>" . $row["id"]. "</td>";
		echo "<td>" . $row["first_name"]. "</td>";
		echo "<td>" . $row["last_name"]. "</td>";
		echo "<td class='text-right'>";
		echo '<a href="?upd=' . $row["id"]. '" class="btn btn-warning btn-sm">Edit</a>&nbsp;&nbsp;';
		echo '<a href="?del=' . $row["id"]. '" class="btn btn-danger btn-sm">Delete</a>';
		echo "</td>";
		echo "<td> </td>";
		echo "</td>";
		echo "</tr>";

	}
  } 

?>
</tbody>
</table>

<?php
include_once "index_bottom.php";