<?php 

//Fajl za brisanje profile slike 
$konekcija = "konektor.php";
if(file_exists($konekcija)) {
	
	include_once($konekcija);
	
}
else {
	
	die("Doslo je do fatalne greske u sistemu ,uskoro cemo biti dostupni <br>");
}


if(isset($_SESSION['id'])) {
	
	
    $id = $_SESSION['id'];
 
   $fileName = "uploads/profile" . $id . "*";
   $fileGlob = glob($fileName);
   $fileExt = explode("." , $fileGlob[0]); 
   $extension = $fileExt[1];
   
   $file = "uploads/profile" . $id . "." . $extension; 
   
   
   if(!unlink($file)) {
	   
	   echo "Vasa slika nije izbrisana <br>";
	   
   }
   else {
	   
	   
	   echo "Vasa slika je izbrisana <br>";
	   
   }

$sql = "UPDATE `profileimg` SET `status` = :zero WHERE `userid` = :id";
	   $korisnici = $konektor->prepare($sql);
	   $korisnici->execute(array(
	   
	   ':id' => $id , 
	   ':zero' => 0
	   
	   ));



}
else {
	
	
	
	echo "Nemate pristup ovoj stranici! <br>";
}
