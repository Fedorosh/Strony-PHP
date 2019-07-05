<?php
session_start();
if(!isset($_SESSION['zalogowany']))
{
	header('Location: ../main.php?page=login');
	exit();
}
if(isset($_POST['haslo']))
{
	$haslo = $_POST['haslo'];
$rehaslo = $_POST['rehaslo'];
$succes = true;


if(strlen($haslo) < 8 || strlen($haslo) > 20)
{
	$succes = false;
	$_SESSION['errpass'] = "Hasło musi mieć od 8 do 20 znaków";
}

if($haslo != $rehaslo)
{
	$succes = false;
	$_SESSION['errpass'] = "Hasła muszą być identyczne";
}

$hashlo = password_hash($haslo,PASSWORD_DEFAULT);

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
		if($succes == true)
		{
			if($polaczenie->query("UPDATE uzytkownicy SET haslo = '$hashlo' WHERE id = $id"))
			{
				unset($_SESSION['errpass']);
			}
			else
			{
				throw new Exception($polaczenie->error);
			}

		}
		$polaczenie->close();
	}
}
catch(Exception $e)
{
	echo '<span style = "color:red;">Błąd serwera, przepraszamy</span>';
}

if($succes == true)
{
	echo "pomyślnie zmieniono hasło<br/>";
	echo '<a href= "../main.php?page=profil">Przejdź do profilu</a>';
	exit();
}
else 
{
	header('Location: ../main.php?page=change');
}

}
else 
{
	header('Location: ../main.php?page=change');
}

?>