<?php
		ini_set("display_errors", 0);
            require_once "dbconnect.php";
            $polaczenie = mysqli_connect($host, $user, $password);
			mysqli_query($polaczenie, "SET CHARSET utf8");
			mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
            mysqli_select_db($polaczenie, $database);
        $nr_klasy = $_POST['nr_klasy'];
		$nauczyciel = $_POST['nauczyciel'];
        $polaczenie -> query("INSERT INTO klasy VALUES (null,'$nr_klasy','$nauczyciel')");
        unset($_POST['nr_klasy']);
        unset($_POST['nauczyciel']);
        Header('Location: index.php');
      

?>
