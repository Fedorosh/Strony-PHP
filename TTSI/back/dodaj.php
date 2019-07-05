<?php
		ini_set("display_errors", 0);
            require_once "connect.php";
            $polaczenie = mysqli_connect($host, $db_user, $db_password);
			mysqli_query($polaczenie, "SET CHARSET utf8");
			mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
            mysqli_select_db($polaczenie, $db_name);
        $login = $_POST['login'];
		$haslo = $_POST['haslo'];
        $email = $_POST['email'];
        $uprawnienia = $_POST['uprawnienia'];
        $hashlo = password_hash($haslo,PASSWORD_DEFAULT);
        $polaczenie -> query("INSERT INTO uzytkownicy VALUES (null,'$login','$hashlo','$email','$uprawnienia')");
        unset($_POST['login']);
        unset($_POST['haslo']);
        unset($_POST['email']);
        unset($_POST['uprawnienia']);
        Header('Location: admin.php');
      

?>
