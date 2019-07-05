<?php
session_start();

include('include/PHPTAL.php'); // doczytanie klasy szablonów (Widok)

$logout = $_GET['logout'];

echo $logout;

if($logout == 1)
{
	session_unset();
}

if(isset($_SESSION['zalogowany']))
{
	$logged = true;
}

else $logged = false;


//widok na podstawie szablonu
if($logged)
{$template = new PHPTAL("$page.php"); }
else {
	$template = new PHPTAL("main.html");
}

try {
	echo $template->execute();	// Uruchomienie szablonu
}
catch (Exception $e){
	echo $e;
}
?>
