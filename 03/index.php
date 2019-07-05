<?php
require_once 'include/PHPTAL.php';

// tworzymy obiekt nowego szablonu
$template = new PHPTAL('template.html');

// uruchamiamy i wyswietlamy szablon
try {
    echo $template->execute();
}
catch (Exception $e){
    echo $e;
}
?>