<?php
// W zależności od otrzymanych parametrów (np. metodą GET):
//  1. Odbierz dane i zapisz na serwerze
// lub
//  2. Pobierz najnowsze wiadomości i je zwróć do skryptu.
	if(isSet($_POST['autor'])){
  $autor = $_POST['autor'];
	}
	if(isSet($_POST['wiadomosc'])){
  $wiadomosc = $_POST['wiadomosc'];
  }
  if($autor == "" && $autor == ""){
    echo "Brak parametru.";
  }
  else {
    echo $autor." ".$wiadomosc;
  }
  

?>