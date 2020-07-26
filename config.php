<?php 

//Fajl za brisanje slika iz galerije 

  $konekcija = "konektor.php";
if(file_exists($konekcija)) {
	
	include_once($konekcija);
	
}
else {
	
	die("Doslo je do fatalne greske u sistemu ,uskoro cemo biti dostupni <br>");
} 

if(isset($_GET['id'])) {
	
	$sql = "DELETE FROM `gallery` WHERE `gallery`.`id` = :id";
	$config = $konektor->prepare($sql);
	$config->execute(array(
	
	':id' => $_GET['id']
	
	));
	header("Location: index.php?opcija=gallery");
	
	
	
	
}