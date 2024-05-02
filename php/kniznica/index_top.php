<?php
session_start();
include_once 'inc/config.php';
include_once 'inc/functions.php';
?>
<!doctype html>
<html lang="sk">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Knižnica</title>

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css"> 

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
</head>
<body>
<?php
// ak existuju udaje  - chcem sa prihlasit
$email = isset($_POST['email']) ? checkDBInput($_POST['email']) : false;
$password = isset($_POST['password']) ? md5($_POST['password']) : false;
$showLogin = '';
if($email && $password)
{
	$sql = "SELECT id FROM users WHERE email = '$email' AND password = '$password'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	if(isset($row['id']) && $row['id'])
	{
		$_SESSION['auth_id'] = $row['id'];
		$showLogin = showBox('Boli ste úspešne prihlásený do knižnice.', 'success');
	}
	else
	{
		$showLogin =  showBox('Nesprávne prihlasovacie údaje.', 'danger');
	}
}

?>
<nav class="navbar navbar-inverse">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php">Knižnica</a>
		</div>
		<ul class="nav navbar-nav">
<?php
if(isset($_SESSION['auth_id']) && getPosition($_SESSION['auth_id']) == 1)
{
?>
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Administrácia
				<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="authors.php">Autori</a></li>
					<li><a href="users.php">Čitatelia</a></li>
					<li><a href="books.php">Knihy</a></li>
					<li><a href="printouts.php">Exempláre</a></li>
					<li><a href="loans.php">Výpožičky</a></li>
				</ul>
			</li>
<?php
}
?>
			
			<li><a href="list_books.php">Zoznam kníh</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<?php
			if(isset($_SESSION['auth_id']) && $_SESSION['auth_id'])
			 echo '<li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Odhlásenie</a></li>';
			else
			 echo '<li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Prihlásenie</a></li>';

			?>
		</ul>
	</div>
</nav>

<div class="container">
<?php
echo $showLogin;
?>