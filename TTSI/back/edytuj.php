<?php
session_start();
		ini_set("display_errors", 0);
            require_once "connect.php";
            $polaczenie1 = mysqli_connect($host, $db_user, $db_password);
			mysqli_query($polaczenie1, "SET CHARSET utf8");
			mysqli_query($polaczenie1, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
            mysqli_select_db($polaczenie1, $db_name);

        $id = $_SESSION['temp'];
        $result = mysqli_query($polaczenie1,"SELECT * FROM `uzytkownicy` WHERE id = $id");
        $wiersz = mysqli_fetch_assoc($result);


        if(isset($_POST['login']) && $_POST['login']!='') $login = $_POST['login'];
        else $login = $wiersz['login'];

        if(isset($_POST['haslo'])&& $_POST['haslo']!='') 
            {
                $haslo = $_POST['haslo'];
                $hashlo = password_hash($haslo,PASSWORD_DEFAULT);
            }
        else $hashlo = $wiersz['haslo'];


        if(isset($_POST['email'])&& $_POST['email']!='') $email = $_POST['email'];
        else $email = $wiersz['email'];

        $uprawnienia = $wiersz['uprawnienia'];

        mysqli_query($polaczenie1,"UPDATE `uzytkownicy` SET `login` = '$login',`haslo` = '$hashlo',`email` = '$email',`uprawnienia` = '$uprawnienia' WHERE `uzytkownicy`.`id` = $id");
        $polaczenie1->close();
        unset($_POST['login']);
        unset($_POST['haslo']);
        unset($_POST['email']);
        Header('Location: admin.php');
?>
