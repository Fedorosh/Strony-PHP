<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"pl-PL\">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"> 
    <title>Rezultat zapytania</title>
</head>
    
<body>
    
    <table width="1000" align="center" border="1" bordercolor="#d5d5d5"  cellpadding="0" cellspacing="0">
        <tr>
        <?php
        
            ini_set("display_errors", 0);
            require_once "dbconnect.php";
            $polaczenie = mysqli_connect($host, $user, $password);
			mysqli_query($polaczenie, "SET CHARSET utf8");
			mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
            mysqli_select_db($polaczenie, $database);
            
 //           if(isset($_POST['imieautora']))
 //        {
 //        		$imieautora = $_POST['imieautora'];
	// $nazwiskoautora = $_POST['nazwiskoautora'];
	// $tytul = $_POST['tytul'];
	// $cena = $_POST['cena'];
 //        $polaczenie -> query("INSERT INTO ksiazki (idksiazki,imieautora,nazwiskoautora,tytul,cena) VALUES (null,'$imieautora','$nazwiskoautora','$tytul','$cena')");
 //        unset($_POST['imieautora']);
 //        unset($_POST['nazwiskoautora']);
 //        unset($_POST['tytul']);
 //        unset($_POST['cena']);

 //        }
            
            
            
 //            $imieautora = $_POST['imieautora'];
 // $nazwiskoautora = $_POST['nazwiskoautora'];
 // $tytul = $_POST['tytul'];
 // $cena = $_POST['cena'];


 // if(isset($imieautora))
 // {
 // 	$polaczenie -> query("INSERT INTO ksiazki (idksiazki,imieautora,nazwiskoautora,tytul,cena) VALUES (null,'$imieautora','$nazwiskoautora','$tytul','$cena')");
 // }
	// else echo "coś nie tak";

			$rezultat1 = mysqli_query($polaczenie, "SELECT * FROM klasy");
            // $rezultat2 = mysqli_query($polaczenie, "SELECT * FROM uczniowie");
            // $rezultat3 = mysqli_query($polaczenie, "SELECT * FROM zamowienia");
            $ile = mysqli_num_rows($rezultat1);
            // $ile += mysqli_num_rows($rezultat2);
            // $ile += mysqli_num_rows($rezultat3);

             echo "znaleziono: ".$ile;

if ($ile>=1) 
{
echo<<<END
<td width="50" align="center" bgcolor="e5e5e5">id</td>
<td width="100" align="center" bgcolor="e5e5e5">nr_klasy</td>
<td width="100" align="center" bgcolor="e5e5e5">nauczyciel</td>
<!-- <td width="100" align="center" bgcolor="e5e5e5">miejscowosc</td>
<td width="50" align="center" bgcolor="e5e5e5">idksiazki</td>
<td width="100" align="center" bgcolor="e5e5e5">imieautora</td>
<td width="100" align="center" bgcolor="e5e5e5">nazwiskoautora</td>
<td width="100" align="center" bgcolor="e5e5e5">tytul</td>
<td width="100" align="center" bgcolor="e5e5e5">cena</td>
<td width="50" align="center" bgcolor="e5e5e5">idzamowienia</td>
<td width="100" align="center" bgcolor="e5e5e5">data</td>
<td width="100" align="center" bgcolor="e5e5e5">status</td> -->
</tr><tr>
END;
}

	for ($i = 1; $i <= $ile; $i++) 
	{
		
		$row1 = mysqli_fetch_assoc($rezultat1);
		// $row2 = mysqli_fetch_assoc($rezultat2);
		// $row3 = mysqli_fetch_assoc($rezultat3);
		$a1 = $row1['id'];
		$a2 = $row1['nr_klasy'];
		$a3 = $row1['nauczyciel'];
		// $a4 = $row1['miejscowosc'];
		// $a5 = $row2['idksiazki'];
		// $a6 = $row2['imieautora'];
		// $a7 = $row2['nazwiskoautora'];
		// $a8 = $row2['tytul'];
		// $a9 = $row2['cena'];
		// $a10 = $row3['idzamowienia'];
		// $a11 = $row3['data'];	
		// $a12 = $row3['status'];			
		
echo<<<END
<td width="50" align="center">$a1</td>
<td width="100" align="center">$a2</td>
<td width="100" align="center">$a3</td>
<!-- <td width="100" align="center">$a4</td>
<td width="100" align="center">$a5</td>
<td width="100" align="center">$a6</td>
<td width="100" align="center">$a7</td>
<td width="100" align="center">$a8</td>
<td width="100" align="center">$a9</td>
<td width="50" align="center">$a10</td>
<td width="100" align="center">$a11</td>
<td width="100" align="center">$a12</td> -->
</tr><tr>
END;
}
	$polaczenie -> close();
?>

</tr></table>

<br/><br/>
<form method = "post" action = "dodaj.php">
<input type = "text" name = "nr_klasy"/>
<input type = "text" name = "nauczyciel"/>
<input type = "submit" value="Dodaj nową klasę"/>
</form>

<form method = "post" action = "usun.php">

<input type = "text" name = "id"/>
<input type = "submit" value="Usuń klasę"/>
	
</form>

<form method = "post" action = "modyfikuj.php">
<input type = "text" name = "id"/>
<input type = "text" name = "nr_klasy"/>
<input type = "text" name = "nauczyciel"/>
<input type = "submit" value="Modyfikuj klasę"/>
</form>


</body>
</html>

