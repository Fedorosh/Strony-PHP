<?php
session_start();
if(isset($_SESSION['zalogowany']))
        {
        	header('Location: ../main.php?page=profil');
        }
if(isset($_POST['email']))
{
	$succes = true;

	$login = $_POST['login'];

	if(ctype_alnum($login)==false)
	{
		$succes = false;
		$_SESSION['errlog'] = "Login może się składać tylko z liter i cyfr";
	}

	$email = $_POST['email'];
	$emailB = filter_var($email,FILTER_SANITIZE_EMAIL);
	if(filter_var($emailB,FILTER_VALIDATE_EMAIL) == false || $emailB != $email)
	{
		$succes = false;
		$_SESSION['errmail'] = "Niepoprawny adres email";
	}

	$haslo = $_POST['haslo'];
	$rehaslo = $_POST['rehaslo'];

	if(strlen($haslo) < 8 || strlen($haslo) > 20)
	{
		$succes = false;
		$_SESSION['errpass'] = "Hasło musi mieć od 8 do 20 znaków";
	}

	if($haslo != $rehaslo)
	{
		$succes = false;
		$_SESSION['errpass'] = "hasła muszą być identyczne";
	}

	$haslo_hash = password_hash($haslo,PASSWORD_DEFAULT);

	if(!isset($_POST['regulamin']))
	{
		$succes = false;
		$_SESSION['errgulamin'] = "Zaakceptuj regulamin";
	}

	$_SESSION['relog'] = $login;
	$_SESSION['remail'] = $email;
	$_SESSION['repass'] = $haslo;
	$_SESSION['rerepass'] = $rehaslo;
	if(isset($_POST['regulamin'])) $_SESSION['reegulamin'] = true;

	require_once "connect.php";

	mysqli_report(MYSQLI_REPORT_STRICT);
	try
	{
		$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
		if($polaczenie->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		else 
		{
			$result = $polaczenie->query("SELECT id FROM uzytkownicy WHERE email = '$email'");
			if(!$result) throw new Exception($polaczenie->error);

			$ile_maili = $result->num_rows;
			if($ile_maili > 0)
			{
				$succes = false;
				$_SESSION['errmail'] = "Już jest taki email";
			}

			$result = $polaczenie->query("SELECT id FROM uzytkownicy WHERE login = '$login'");
			if(!$result) throw new Exception($polaczenie->error);

			$ile_loginow = $result->num_rows;
			if($ile_loginow > 0)
			{
				$succes = false;
				$_SESSION['errlog'] = "ten login jest zajęty";
			}

			if($succes == true)
			{
				if($polaczenie->query("INSERT INTO uzytkownicy VALUES(NULL,'$login','$haslo_hash','$email','user')"))
				{
					$_SESSION['zarejestrowany'] = true;

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
		echo 'udana walidacja<br/><a href = "../main.php?page=login">Możesz się już zalogować</a>'; exit();
	}

}
?>
<!DOCTYPE HTML>
<html lang = "pl">
<head>
	<meta charset="utf-8"/>
	<link rel = "stylesheet" type= "text/css" href = "../front/arkusz.css"/>
	<title>
		Podsumowanie Zamówienia
	</title>
		<style>
	.error
	{
		color:red;
		margin-top: 10px;
		margin-bottom: 10px;
	}
</style>
	</head>

<body>

<form method = "post">
	<b>Login:</b>
</br>
	<input type = "text" name = "login" value="<?php
	if(isset($_SESSION['relog']))
	{
		echo $_SESSION['relog'];
		unset($_SESSION['relog']);
	}
	?>" />
</br>
<?php
	if(isset($_SESSION['errlog']))
	{
		echo '<div class = "error">'.$_SESSION['errlog'].'</div>';
		unset($_SESSION['errlog']);
	}
?>
	<b>Email:</b>
</br>
	<input type = "text" name = "email" value="<?php
	if(isset($_SESSION['remail']))
	{
		echo $_SESSION['remail'];
		unset($_SESSION['remail']);
	} 
	?>" />
</br>
<?php
	if(isset($_SESSION['errmail']))
	{
		echo '<div class = "error">'.$_SESSION['errmail'].'</div>';
		unset($_SESSION['errmail']);
	}
?>
	<b>Hasło:</b>
</br>
	<input type = "password" name = "haslo" />
</br>
<?php
	if(isset($_SESSION['errpass']))
	{
		echo '<div class = "error">'.$_SESSION['errpass'].'</div>';
		unset($_SESSION['errpass']);
	}
?>
	<b>Powtórz hasło:</b>
</br>
	<input type = "password" name = "rehaslo"/>
</br>
<label>
	<input type = "checkbox" name = "regulamin"  <?php
	if(isset($_SESSION['reegulamin']))
	{
		echo "checked";
		unset ($_SESSION['reegulamin']);
	} 
	?> />
	Akceptuję Regulamin
	</label>
</br>
<?php
	if(isset($_SESSION['errgulamin']))
	{
		echo '<div class = "error">'.$_SESSION['errgulamin'].'</div>';
		unset($_SESSION['errgulamin']);
	}
?>
	<input type = "submit" value = "Zarejestruj się"/>

	</form>

	<br/>

	<a href = "../index.html"> Przejdź do strony głównej</a>

</body>

</html>