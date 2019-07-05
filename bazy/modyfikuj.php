<?php
		ini_set("display_errors", 0);
            require_once "dbconnect.php";
            $polaczenie = mysqli_connect($host, $user, $password);
			mysqli_query($polaczenie, "SET CHARSET utf8");
			mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
            mysqli_select_db($polaczenie, $database);
        $id = $_POST['id'];
        $nr_klasy = $_POST['nr_klasy'];
		$nauczyciel = $_POST['nauczyciel'];
        $polaczenie -> query("UPDATE `klasy` SET `nr_klasy` = '$nr_klasy',`nauczyciel` = '$nauczyciel' WHERE `klasy`.`id` = $id;");
        unset($_POST['id']);
        unset($_POST['nr_klasy']);
        unset($_POST['nauczyciel']);
        Header('Location: index.php');
?>
