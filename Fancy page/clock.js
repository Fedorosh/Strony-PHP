var ktos = new Audio('niech ktoś.mp3');
function niech()
{
	ktos.currentTime = 0;
	ktos.play();
}
function odliczanie()
{
	var zegar = new Date();
	
	var dzien = zegar.getDate();
	if(dzien<10) dzien="0"+dzien;
	
	var miesiac = zegar.getMonth()+1;
	if(miesiac<10) miesiac="0"+miesiac;
	
	var rok = zegar.getFullYear();
	if(rok<10) rok="0"+rok;
	
	var godzina = zegar.getHours();
	if(godzina<10) godzina="0"+godzina;
	
	var minuta = zegar.getMinutes();
	if (minuta<10) minuta="0"+minuta;
	
	var sekunda = zegar.getSeconds();
	if (sekunda<10) sekunda="0"+sekunda; 
	
	document.getElementById("zegar").innerHTML = dzien+"-"+miesiac+"-"+rok+" | "+godzina+":"+minuta+":"+sekunda;
	
	setTimeout("odliczanie()",1000);
}