<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
	header('Location: ../main.php?page=login');
	exit();
}

$id = $_SESSION['id'];

require_once "connect.php";
try
{
	$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
	if($polaczenie->connect_errno!=0)
	{
		throw new Exception(mysqli_connect_errno());
	}
	else
	{
			if($polaczenie->query("DELETE FROM uzytkownicy WHERE `uzytkownicy`.`id` = '$id'"))
			{
				$_SESSION['usuniete'] = true; 
				session_unset();
				echo "<script>window.close();</script>";
				exit();
			}
			else
			{
				throw new Exception($polaczenie->error);
			}

		$polaczenie->close();
	}
}
catch(Exception $e)
{
	echo '<span style = "color:red;">Błąd serwera, przepraszamy</span>';
}