<?php 

//Fajl za mogucnost promjene korisnickog imena 
$konekcija = "konektor.php";
if(file_exists($konekcija)) {
	
	include_once($konekcija);
	
}
else{
	
	
	die("Doslo je do fatalne greske u sistemu uskoro cemo biti dostupni <br>");
	
}
if(isset($_SESSION['id'])) {
	
	if(isset($_POST['submit'])) {
		
		
		if(!empty($_POST['username']) && !empty($_POST['newusername'])) {
			
			$username = $_POST['username'];
			$newusername = $_POST['newusername'];
			
			$sql = "SELECT * FROM `korisnici` WHERE `id` = :id";
			$korisnici = $konektor->prepare($sql);
			$korisnici->execute(array(
			
			':id' => $_SESSION['id']
			
			));
			if($korisnici->rowCount() > 0) {
				
				
				if(strlen($newusername) < 50) {
					
					
					$sql = "UPDATE `korisnici` SET `username` = :username WHERE 
					`id` = :id";
					$ime = $konektor->prepare($sql);
					$ime->execute(array(
					
					':username' => $newusername  , 
					':id' => $_SESSION['id']
					
					));
					
					
				}
				else {
					
					
					echo "Username must have lower than 50 characters! <br>";
				}
				
			}
			else {
				
				
				echo "You have an error! <br>";
			}
			
			
		}
		
		
	}
	
	


?>

<form method="POST" action="index.php?opcija=username">
<table>

<tr>
<td>Trenutno korisnicko ime</td>
<td><input type="text" name="username"/></td>
</tr>


<tr>
<td>Novo korisnicko ime</td>
<td><input type="text" name="newusername"/></td>
</tr>

<tr>
<td><input type="submit" name="submit" value="CHANGE"/></td>
</tr>

</table>
</form>
<?php
}
else {
	
	
	
	
	
	
}