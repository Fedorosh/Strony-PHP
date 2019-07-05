<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"pl-PL\">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"> 
	<link rel = "stylesheet" type = "text/css" href = "../front/arkusz.css"/>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script type="text/javascript" src="../front/script.js"></script>
    <title>Rezultat zapytania</title>
</head>
    
<body>
    
    <table width="1000" align="center" border="1" bordercolor="#d5d5d5"  cellpadding="0" cellspacing="0">
        <tr>
        <?php
        session_start();
        if(!isset($_SESSION['uprawnienia']) || $_SESSION['uprawnienia'] != 'admin')
        {
        	header('Location: ../main.php?page=login');
        }
        if(isset($_GET['temp'])) $_SESSION['temp'] = $_GET['temp'];
            ini_set("display_errors", 0);
            require_once "connect.php";
            $polaczenie = mysqli_connect($host, $db_user, $db_password);
			mysqli_query($polaczenie, "SET CHARSET utf8");
			mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
            mysqli_select_db($polaczenie, $db_name);
            

			$rezultat1 = mysqli_query($polaczenie, "SELECT * FROM uzytkownicy");
            $ile = mysqli_num_rows($rezultat1);

             echo "znaleziono: ".$ile;

if ($ile>=1) 
{
echo<<<END
<div id="display">
<td width="50" align="center" bgcolor="e5e5e5">id</td>
<td width="100" align="center" bgcolor="e5e5e5">login</td>
<td width="100" align="center" bgcolor="e5e5e5">email</td>
<td width="100" align="center" bgcolor="e5e5e5">uprawnienia</td>
</tr><tr>
END;
}

	for ($i = 1; $i <= $ile; $i++) 
	{
		
		$row1 = mysqli_fetch_assoc($rezultat1);
		$a1 = $row1['id'];
		$a2 = $row1['login'];
		$a3 = $row1['email'];
		$a4 = $row1['uprawnienia'];
	
		
echo<<<END
<td width="50" align="center"><a href = "admin.php?temp=$a1">$a1</a></td>
<td width="100" align="center">$a2</td>
<td width="100" align="center">$a3</td>
<td width="100" align="center">$a4</td>
</tr><tr>
</div>
END;
}

	$polaczenie -> close();
?>

</tr></table>

<br/><br/>
<form method = "post" action = "dodaj.php" class = "dodaj">
	<b>Login:</b><br/>
<input type = "text" name = "login"/> <br/>
	<b>Hasło:</b><br/>
<input type = "password" name = "haslo"/><br/>
	<b>Email:</b><br/>
<input type = "text" name = "email"/><br/>
	<b>Uprawnienia:</b><br/>
<input type = "text" name = "uprawnienia"/><br/>
<input type = "submit" value="dodaj nowego użytkownika"/><br/>
</form>

<form action = "usun.php" class = "edytuj">
<b>Wybrane id: <?php echo $_SESSION['temp']; ?></b><br/>
<input type="submit" onclick="return confirm('Na pewno chcesz usunąć tego użytkownika?')" value= "usuń użytkownika" />
<br/></form>
<form method = "post" action = "edytuj.php" class = "edytuj"> 
<input type = "text" name = "login"/>
<input type = "submit" value = "zmień login"/> <br/>

<input type = "password" name = "haslo"/>
<input type = "submit" onclick="return confirm('Na pewno chcesz zmienić hasło?')" value = "zmień hasło"/> <br/>

<input type = "text" name = "email"/>
<input type = "submit" value = "zmień email"/> <br/>
</form>
<form action = "op.php" class = "edytuj">
<input type = "submit" onclick="return confirm('Czy na pewno chcesz to zrobić?')" value="daj/odbierz admina"/>

<input type="text" id="search" placeholder="Search" />

</form> 
<br/>
<a href = "../main.php?page=profil"> Powrót</a>
<div id="display"></div>

</body>
</html>

