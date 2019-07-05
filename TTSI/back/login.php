<?php
session_start();
if(isset($_SESSION['zalogowany']))
{
	header('Location: profil.php');
	exit();
}
?>

<!DOCTYPE HTML>
<html lang = "pl">
<head>
	<meta charset="utf-8"/>
	<link rel = "stylesheet" type="text/css" href="../arkusz.css"/>
	<title>
		Zaloguj się
	</title>
	</head>

<body>
	<h1>Zaloguj się do forum</h1>
	<br/> <a href = "rejestracja.php"> lub stwórz darmowe konto </a>

<form method = "post" action = "zaloguj.php">
	Login:
	<br/>
	<input type = "text" name ="login"/>
	<br/><br/>
	Hasło:
	<br/>
	<input type = "password" name ="haslo"/>
	<br/>
	<input type = "submit" value = "Zaloguj się"/>
</form>
<!-- <span class="info" tal:condition="exists: info" tal:content="info"></span> -->

</body>

<?php

if(isset($_SESSION['blad']))
{
	echo $_SESSION['blad'];
}

?>

</html>