<?php 

//Povezivanje sa bazom podataka i hvatanje greske 

try{
	
	$konektor = new PDO('mysql: host=localhost; dbname=exercise-7;','root','');
	$konektor->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	
}
catch(PDOException $e) {
	
	echo $e->getMessage(); 
	die();
	
	
}