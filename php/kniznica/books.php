<?php
include_once "index_top.php";
?>

<h1>Knihy</h1>

<form action="books_save.php" method="post" class="form-horizontal">
	<div class="form-group">
		<label for="nazov" class="col-sm-2 control-label">Názov knihy</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" id="nazov" name="nazov" value="" required>
		</div>
	</div>
	<div class="form-group">
		<label for="popis" class="col-sm-2 control-label">Popis knihy</label>
		<div class="col-sm-10">
			<textarea class="form-control" rows="8" id="popis" name="popis" required></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="zaner" class="col-sm-2 control-label">Žáner</label>
		<div class="col-sm-6">
			<select class="form-control" id="zaner" name="zaner" required>
				<option value="">-----</option>

			</select>
		</div>
	</div>	
	<div class="form-group">
		<label for="autor" class="col-sm-2 control-label">Autor</label>
		<div class="col-sm-6">
			<select class="form-control" id="autor" name="autor" required>
				<option value="">-----</option>

			</select>
		</div>
	</div>	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-info">Uložiť</button>
		</div>
	</div>
</form>
<hr>

<h3>Zoznam kníh</h3>
<table class="table table-striped tablejs">
<thead>
	<tr>
		<th>ID</th>
		<th>Názov knihy</th>
		<th>Opis knihy</th>
		<th>Žáner</th>
		<th>Autor</th>
		<th data-orderable="false" class="text-nowrap text-right">
			<a href="" class="btn btn-success btn-sm">Nová</a>
			<a href="" class="btn btn-info btn-sm">PDF</a>
			<a href="" class="btn btn-info btn-sm">XLSX</a>
		</th>
	</tr>
</thead>
<tbody>

</tbody>
</table>

<?php
include_once "index_bottom.php";