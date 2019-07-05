<?php
session_start();
		ini_set("display_errors", 0);
            require_once "connect.php";
            $polaczenie = mysqli_connect($host, $db_user, $db_password);
			mysqli_query($polaczenie, "SET CHARSET utf8");
			mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
            mysqli_select_db($polaczenie, $db_name);
        $id = $_SESSION['temp'];
        $polaczenie -> query("DELETE FROM `uzytkownicy` WHERE `uzytkownicy`.`id` = '$id';");
        unset($_SESSION['temp']);
        Header('Location: admin.php');
      

?>
