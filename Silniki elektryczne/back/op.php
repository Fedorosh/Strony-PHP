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

        $uprawnienia = $wiersz['uprawnienia'];
        if($uprawnienia == 'admin') $uprawnienia = 'user';
        else $uprawnienia = 'admin';

        mysqli_query($polaczenie1,"UPDATE `uzytkownicy` SET `uprawnienia` = '$uprawnienia' WHERE `uzytkownicy`.`id` = $id");
        $polaczenie1->close();
        unset($_POST['login']);
        unset($_POST['haslo']);
        unset($_POST['email']);
        unset($_POST['uprawnienia']);
        Header('Location: admin.php');
?>
