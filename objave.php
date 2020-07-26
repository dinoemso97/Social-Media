<?php 

//Kreiranje parametara za objave

 	  $konekcija = "konektor.php";
if(file_exists($konekcija)) {
	
	include_once($konekcija);
	
}
else {
	
	die("Doslo je do fatalne greske u sistemu ,uskoro cemo biti dostupni <br>");
} 

if(isset($_SESSION['id'])) {
	
	
	if(isset($_POST['submitObjave'])) {
		if(!empty($_POST['body'])) {
		
		$status = $_POST['body'];
		$datum = date("y-m-d"); 
		
		$sql = "SELECT * FROM `korisnici` WHERE `id` = :id";
		$korisnici = $konektor->prepare($sql);
		$korisnici->execute(array(
		
		':id' => $_SESSION['id']
		
		));
		
		$fkorisnici = $korisnici->fetchAll(PDO::FETCH_OBJ);
		foreach($fkorisnici as $k) {
			
			
			$id = $k->id; 
			$name = $k->fullname;
		}
		
		$qKor = "INSERT INTO `objave` SET 
		
		`tekst` = :tekst , 
		`user` = :name , 
		`userid` = :id , 
		`datum` = :datum
		
		
		";
		$korisnici = $konektor->prepare($qKor);
		$korisnici->execute(array(
		
		':tekst' => $status , 
		':name' => $name , 
		':id' => $id , 
		':datum' => $datum
		
		
		));
		header("Location: index.php?opcija=naslovna");
	}
	else {
		
		
		
		echo "You do not type anything! <br>";
	}
	}
	
	
	
	
}
else {
	
	
	echo "You don't have any access to be here <br>";
	
}

  
   