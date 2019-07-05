<?php

session_start();
include('../include/PHPTAL.php');

if($_SESSION['zalogowany'])
{
	$logged = true;
} 
else
	$logged = false;

require_once "connect.php";

$polaczenie = mysqli_connect($host, $db_user, $db_password);

// if($polaczenie->connect_errno!=0)
// {
// 	echo "Błąd: ".$polaczenie->connect_errno.": ".$polaczenie->connect_error;
// }
// else
// {
	mysqli_select_db($polaczenie, $db_name);
	$result = mysqli_query($polaczenie, "SELECT * FROM artykuly");
	// $ile = mysqli_num_rows($result);
	// for($i = 0; $i < $ile; $i++)
	// 	{
			$row1 = mysqli_fetch_assoc($result);
			$nazwa = $row1['tytul'];
			// $nazwy[$i] = $nazwa;

	$polaczenie->close();

	$template = new PHPTAL('artykuly.html');
	$template->tekst = $nazwa;
	try {
	echo $template->execute();	// Uruchomienie szablonu
}
catch (Exception $e){
	echo $e;
}
// }



?>