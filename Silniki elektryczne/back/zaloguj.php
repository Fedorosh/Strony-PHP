<?php

session_start();

if((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
{
	header('Location: login.html');
	exit();
}

require_once "connect.php";

$polaczenie = @new mysqli($host,$db_user,$db_password,$db_name);

if($polaczenie->connect_errno!=0)
{
	echo "Błąd: ".$polaczenie->connect_errno.": ".$polaczenie->connect_error;
}
else
{
	$login = $_POST['login'];
	$haslo = $_POST['haslo'];

	 $login = htmlentities($login,ENT_QUOTES,"utf-8");
	 // $haslo = htmlentities($haslo,ENT_QUOTES,"utf-8");

	if($result = @$polaczenie->query(sprintf("SELECT * FROM uzytkownicy WHERE
		login = '%s'",mysqli_real_escape_string($polaczenie,$login))))
	{
		$ile_userow = $result->num_rows;
		if($ile_userow > 0)
		{
			$wiersz = $result->fetch_assoc();

			if(password_verify($haslo,$wiersz['haslo']))
			{
				$result->close();
				$_SESSION['zalogowany'] = true;
				$_SESSION['login'] = $wiersz['login'];
				$_SESSION['id'] = $wiersz['id'];
				$_SESSION['email'] = $wiersz['email'];
				$_SESSION['uprawnienia'] = $wiersz['uprawnienia'];
				unset($_SESSION['blad']);
				header('Location: ../main.php?page=profil');
			}
			else
			{
				$_SESSION['blad'] = 'nieprawidłowy login lub hasło';
				header('Location: ../main.php?page=login');
			}
		}
		else 
		{
			$_SESSION['blad'] = 'nieprawidłowy login lub hasło';
			header('Location: ../main.php?page=login');
		}
	}

	$polaczenie->close();
}

?>