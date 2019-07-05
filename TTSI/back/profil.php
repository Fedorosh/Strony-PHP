<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
	header('Location: login.php');
	exit();
}

?>
<!DOCTYPE HTML>
<html lang = "pl">
<head>
	<meta charset="utf-8"/>
	<link rel = "stylesheet" type="text/css" href="../arkusz.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	<title>
		Tesla
	</title>
	</head>

<body>
	Logowanie przebiegło pomyślnie<br/>
	<a href = "../index.php?page=change"> Zmień Hasło </a> <br/>
	<button onclick = '
	if(confirm("Czy na pewno chcesz usunąć konto?"))
	{
     window.open("delete.php");
     if(confirm("konto zostało usunięte"))
     location.reload();
 	else {}
	}
	else {}
	' > Usuń konto </button>
	<?php
	if($_SESSION['uprawnienia'] == 'admin') echo "jesteś adminem";
	?>

	<a href = "../index.php?logout=1"> Wyloguj się </a>

	<!-- <form method = "post" action = "../index.php?logout = 1">
	<br/>
		<input type = "submit" value = "wyloguj się" />
	</form> -->

</body>

</html>