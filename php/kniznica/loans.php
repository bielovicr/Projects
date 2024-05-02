<?php
include_once "index_top.php";
?>

<h1>Výpožičky</h1>


<?php
//print_r($_SESSION);
$ok = isset($_SESSION['email_ok']) ? $_SESSION['email_ok'] : false;
$error = isset($_SESSION['email_error']) ? $_SESSION['email_error'] : false;
if($ok)
{
	echo showBox($ok, 'success');
	unset($_SESSION['email_ok']);
}
elseif($error)
{
	echo showBox($error, 'danger');
	unset($_SESSION['email_error']);
}

$id = 0;
$user_id = 0;
?>
<hr>
<form action="loans_save.php" method="post" class="form-horizontal">
	<input type="hidden" name="id" value="<?php echo $id;?>">
	<div class="form-group">
		<label for="user_id" class="col-sm-2 control-label">Čítateľ</label>
		<div class="col-sm-6">
			<select  class="form-control" id="user_id" name="user_id"required>
				<option>---</option>
				<?php
				$sql = "SELECT * FROM users ORDER BY last_name, first_name";
				$result = mysqli_query($conn, $sql);
				// kontrola ci vratil nejake udaje
				if (mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)){
						echo '<option value="'.$row['id']. '">' . $row['last_name'] . ' ' . $row['first_name'] .' ' . $row['personal_number'] . '</option>';
					}
				}
				?>
			</select>
		</div>
	</div>
	<?php for($i = 0; $i < 5; $i++) 
	{ 	
	?>
	<div class="form-group">
		<label for="book_printout_id" class="col-sm-2 control-label">Kniha/Exemplár</label>
		<div class="col-sm-6">
			<select  class="form-control" id="book_printout_id" name="book_printout_id[]" <?php if($i==0) echo 'required';?>>
				<option value='0' >---</option>
				<?php
				$sql = "SELECT name, book_printouts.id AS book_printout_id FROM book_printouts JOIN books ON books.id = book_printouts.book_id ORDER BY name";
				$result = mysqli_query($conn, $sql);
				// kontrola ci vratil nejake udaje
				if (mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_assoc($result)){
						echo '<option value="'.$row['book_printout_id']. '">' . $row['name'] . '[' . $row['book_printout_id'] . ']</option>';
					}
				}
				?>
				</select>
		</div>
		
	</div>
	<?php } ?>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-info">Uložiť</button>
		</div>
</form>
<h3>Zoznam výpožičiek</h3>
<table class="table table-striped tablejs">
<thead>
	<tr>
		<th>ID</th>
		<th>Dátum výpožičky</th>
		<th>Zoznam kníh</th>
        <th>Čítateľ</th>
		<th data-orderable="false" class="text-nowrap text-right">
			<a href="loans.php" class="btn btn-success btn-sm">Nový</a>
			<a href="loans_pdf.php" class="btn btn-info btn-sm">PDF</a>
			<a href="loans_excel.php" class="btn btn-info btn-sm">XLSX</a>
		</th>
	</tr>
</thead>
<tbody>
<?php
$sql = "SELECT book_loans.*, GROUP_CONCAT(books.name SEPARATOR '<br>') AS book_name, CONCAT(last_name,' ',first_name) 
AS user_name FROM book_loans 
JOIN users ON book_loans.user_id = users.id
JOIN book_loan_book_printout ON book_loan_book_printout.book_loan_id = book_loans.id
JOIN book_printouts ON book_loan_book_printout.book_printout_id = book_printouts.id
JOIN books ON book_printouts.book_id = books.id
GROUP BY book_loans.id";
$result = mysqli_query($conn, $sql);
// kontrola ci vratil nejake udaje
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		echo "<td>" . $row["id"]. "</td>";
		echo "<td>" . $row["loaned_at"]. "</td>";
		echo "<td>" . $row["book_name"]. "</td>";
        echo "<td>" . $row["user_name"]. "</td>";
		echo "<td class='text-right'>";
        echo '<a href="mail.php?id=' . $row["user_id"]. '" class="btn btn-primary btn-sm">Poslať upomienku</a>&nbsp;&nbsp;';
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