<?php 


   //Kreiranje fajla za pretrazivanje korisnika
    
	
	  $konekcija = "konektor.php";
if(file_exists($konekcija)) {
	
	include_once($konekcija);
	
}
else {
	
	die("Doslo je do fatalne greske u sistemu ,uskoro cemo biti dostupni <br>");
} 

	
	
	if(isset($_POST['submit'])) {
		
		$search = $_POST['search'];
		$filter = $_POST['filter'];
		
		if($filter == "") {
			
			$sql = "SELECT * FROM `korisnici` WHERE `fullname` LIKE '%$search%'";
			$data = $konektor->query($sql);
			if($data->rowCount() > 0) {
				
				$fdata = $data->fetchAll(PDO::FETCH_OBJ);
				foreach($fdata as $k) {
					
					echo $k->fullname . "<br>"; 
					
					
				}
				
				
			}
			else {
				
				echo "You don't have any result! <br>";
			}

		}
		
		if($filter == "firstname") {
			
			$sql = "SELECT * FROM `korisnici` WHERE `firstname` LIKE '%$search%'";
			$data = $konektor->query($sql);
			if($data->rowCount() > 0) {
				
				$fdata = $data->fetchAll(PDO::FETCH_OBJ);
				foreach($fdata as $k) {
					
					echo $k->firstname . "<br>"; 
					
					
				}
				
				
			}
			else {
				
				echo "You don't have any result! <br>";
			}

		}
		
		if($filter == "lastname") {
			
			$sql = "SELECT * FROM `korisnici` WHERE `lastname` LIKE '%$search%'";
			$data = $konektor->query($sql);
			if($data->rowCount() > 0) {
				
				$fdata = $data->fetchAll(PDO::FETCH_OBJ);
				foreach($fdata as $k) {
					
					echo $k->lastname . "<br>"; 
					
					
				}
				
				
			}
			else {
				
				echo "You don't have any result! <br>";
			}

		}
	
		
	}
	
	
	
	