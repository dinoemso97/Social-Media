<?php 

//Kreiranje fajla index 




$konekcija = "konektor.php";
if(file_exists($konekcija)) {
	
	include_once($konekcija);
	
}
else {
	
	die("Doslo je do fatalne greske u sistemu ,uskoro cemo biti dostupni <br>");
}

//Prevod stranice 






session_start(); 


if(isset($_SESSION['id'])) {
	
	//Sesija postoji
	
	
	?>
	<a href="index.php">POCETNA</a> |
	<a href="index.php?opcija=profil">MOJ PROFIL</a> | 
	<a href="index.php?opcija=naslovna">NASLOVNA</a> |
	<a href="index.php?opcija=poruka">PORUKE</a> |
	<a href="index.php?opcija=podesavanja">PODESAVANJA</a> |
	<a href="index.php?opcija=logout">ODJAVA</a>
	<hr>
	<?php 
	
	if(isset($_GET['opcija'])) {
		
	$opcija = $_GET['opcija'] . ".php";
if(file_exists($opcija)) {
	
	include_once($opcija);
	
}	
else {
	
	echo "Stranica koju ste trazili nije dostupna, uskoro cemo biti dostupni <br>";
}
		
	}
	else {
		
		
		echo "POCETNA STRANICA <BR>";
	}
	
	
	
	
	
}
else {
	
	//Sesija ne postoji
	?>
	<a href="index.php">POCETNA</a> |
	<a href="index.php?opcija=register">REGISTRUJTE SE</a> |
	<a href="index.php?opcija=login">PRIJAVITE SE</a> |
	<a href="index.php?opcija=kontakt">KONTAKTIRAJTE NAS</a><hr>
	<a href="index.php?lang=en">English</a> | <a href="index.php?lang=bs">Bosnian</a><br><br>
	<?php 
	
	if(isset($_GET['opcija'])) {
		
	$opcija = $_GET['opcija'] . ".php";
if(file_exists($opcija)) {
	
	include_once($opcija);
	
}	
else {
	
	echo "Stranica koju ste trazili nije dostupna, uskoro cemo biti dostupni <br>";
}
		
	}
	else {
		
		
		echo "POCETNA STRANICA <BR>";
	}
	
	
	
	
}