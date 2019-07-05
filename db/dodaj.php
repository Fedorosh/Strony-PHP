<?php
		ini_set("display_errors", 0);
            require_once "dbconnect.php";
            $polaczenie = mysqli_connect($host, $user, $password);
			mysqli_query($polaczenie, "SET CHARSET utf8");
			mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
            mysqli_select_db($polaczenie, $database);
        $imieautora = $_POST['imieautora'];
		$nazwiskoautora = $_POST['nazwiskoautora'];
		$tytul = $_POST['tytul']; 
		$cena = $_POST['cena'];
        $polaczenie -> query("INSERT INTO ksiazki (idksiazki,imieautora,nazwiskoautora,tytul,cena) VALUES (null,'$imieautora','$nazwiskoautora','$tytul','$cena')");
        unset($_POST['imieautora']);
        unset($_POST['nazwiskoautora']);
        unset($_POST['tytul']);
        unset($_POST['cena']);
        Header('Location: index.php');
      

?>
