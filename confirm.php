<?php 

$konekcija = "konektor.php";
if(file_exists($konekcija)) {
	
	include_once($konekcija);
	
}
else {
	
	die("Doslo je do fatalne greske u sistemu ,uskoro cemo biti dostupni <br>");
}


  if(!isset($_GET['email']) && !isset($_GET['counkn'])) {
	  
	  
	  echo "Imate gresku! <br>";
	  
	  
  }
  else {
	  
	  
	  $email = $_GET['email'];
	  $code = $_GET['counkn'];
	  
	  $sql = "SELECT * FROM `korisnici` WHERE `email` = :email AND `unknown` = :code AND `confirm_em` = :zero";
	  $korisnici = $konektor->prepare($sql);
	  $korisnici->execute(array(
	  
	  ':email' => $email , 
	  ':code' => $code , 
	  ':zero' => 0
	  
	  ));
	  if($korisnici->rowCount() > 0) {
		  
		  $sql = "UPDATE `korisnici` SET `confirm_em` = :one WHERE `email` = :email AND `unknown` = :code";
		  $korisnici = $konektor->prepare($sql);
		  $korisnici->execute(array(
		  
		   ':one' => 1 , 
		   ':code' => $code , 
		   ':email' => $email
		  
		  ));
		  header("Location: index.php?opcija=login");
		  
	  }
	  else {
		  
		  
		  echo "Imate ERROR! <br>";
	  }
	  
  }