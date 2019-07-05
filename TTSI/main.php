<?php

session_start();

include('include/PHPTAL.php'); // doczytanie klasy szablonów (Widok)

$logout = isset($_GET['logout']) ? $_GET['logout'] : '';
if(isset($_GET['page']) && $_GET['page'] != 'login')
	$page = $_GET['page'];
else $page = 'profil';

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
{
	$template = new PHPTAL("$page.html"); 
	$template->login = 'login: '.$_SESSION['login'];
	$template->email = 'email: '.$_SESSION['email'];
	$template->uprawnienia = 'uprawnienia: '.$_SESSION['uprawnienia'];
	if(isset($_SESSION['errpass']))
		$template->errpass = $_SESSION['errpass'];
	if($_SESSION['uprawnienia'] == 'admin')
		$template->admin = true;
	else $template->admin = false;
}
else
{
	$template = new PHPTAL("login.html");
	if(isset($_SESSION['blad']))
	$template->error = $_SESSION['blad'];
}

try {
	echo $template->execute();	// Uruchomienie szablonu
}
catch (Exception $e){
	echo $e;
}
?>
