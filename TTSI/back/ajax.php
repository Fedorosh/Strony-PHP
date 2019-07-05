<?php
//Including Database configuration file.
include "db.php";
//Getting value of "search" variable from "script.js".

if (isset($_POST['search'])) {
	$Name = $_POST['search'];
	$Query = "SELECT * FROM uzytkownicy WHERE login LIKE '%$Name%' LIMIT 3";
	$ExecQuery = MySQLi_query($con, $Query);
	while ($Result = MySQLi_fetch_array($ExecQuery)) {?>
		<div onclick='fill("<?php echo $Result['login']; ?>")'><a><?php echo $Result['login']; ?></a>
		<?php
	}
}
?>
</ul>