<?php
		ini_set("display_errors", 0);
            require_once "dbconnect.php";
            $polaczenie = mysqli_connect($host, $user, $password);
			mysqli_query($polaczenie, "SET CHARSET utf8");
			mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
            mysqli_select_db($polaczenie, $database);
        $id = $_POST['id'];
        $polaczenie -> query("DELETE FROM `klasy` WHERE `klasy`.`id` = '$id';");
        unset($_POST['id']);
        Header('Location: index.php');
      

?>
