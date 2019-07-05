<?php
$con = MySQLi_connect("localhost","root","","uzytkownicy_tesla");
if (MySQLi_connect_errno()) {
echo "Failed to connect to MySQL: " . MySQLi_connect_error();
}
?>