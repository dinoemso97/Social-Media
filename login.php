<?php 

//Kreiranje fajla register 


$username = "";
$pass = "";

$usernameErr = "";
$passErr = "";



if(isset($_POST['submit'])) {
	
	if(!empty($_POST['username'])) {
		
		
			
			$qKor = "SELECT * FROM `korisnici` WHERE `username` = :username";
			$korisnici = $konektor->prepare($qKor);
			$korisnici->execute(array(
			
			':username' => $_POST['username']
			
			));
			if($korisnici->rowCount() == 1) {
				
				
				$username = $_POST['username'];
				
				
			}
			else if($korisnici->rowCount() >= 2) {
				
				
				$usernameErr .= "Doslo je sistemske greske,molimo vas obavijestite admina sajta <br>";
				
			}
			else {
				
				$usernameErr .= "Korisnicko ime koje ste unijeli nije tacno ili nije dostupno u nasoj bazi <br>";
			}
		
		
	}
	else {
		
		
		$usernameErr .= "Morate ukucati Vase korisnicko ime <br>";
	}
	
	
	if(!empty($_POST['pass'])) {
		
		
			
			$qKor = "SELECT * FROM `korisnici` WHERE `username` = :username AND 
			`password` = :pass";
			$korisnici = $konektor->prepare($qKor);
			$korisnici->execute(array(
			
			':username' => $_POST['username'] , 
			':pass' => $_POST['pass']
			
			));
			if($korisnici->rowCount() == 1) {
				
				
				$pass = $_POST['pass'];
				
				
			}
			else if($korisnici->rowCount() >= 2) {
				
				
				$passErr .= "Doslo je sistemske greske,molimo vas obavijestite admina sajta <br>";
				
			}
			else {
				
				$passErr .= "Lozinka nije ispravna! <br>";
			}
		
		
	}
	else {
		
		
		$usernameErr .= "Morate ukucati Vas lozinku <br>";
	}
	
	//Kreiranje konacne petlje 
	
	if(($usernameErr && $passErr) == "") {
		
		$fKorisnici = $korisnici->fetchAll(PDO::FETCH_OBJ);
		foreach($fKorisnici as $kor) {
			
			$nalog = $kor->id; 
			
			
		}
		
		
		$_SESSION['id'] = $nalog; 
		
		header("Location: index.php");
		
	}
	
	
	
	
}


?> 

<form method="POST" action="index.php?opcija=login">
<table>

<tr>
<td><input type="text" name="username" placeholder=" Korisnicko ime"/>
<?php
if($username == "") {
	
	echo $usernameErr; 
	
	
}
?>
</td>
</tr>


<tr>
<td><input type="password" name="pass" placeholder=" Vasa lozinka(min 5 char)"/>
<?php
if($pass == "") {
	
	echo $passErr; 
	
	
}
?>
</td>

</tr>






<tr>
<td><input type="submit" name="submit" value="Prijavite se"/>
</td>
</tr>


<tr>
<td><a href="index.php?opcija=recover_pass">Zaboravili ste lozinku?</a></td>
</tr>

</table>
</form>