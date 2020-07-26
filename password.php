<?php 

//Kreiranje fajla za zamjenu lozinke 


 	  $konekcija = "konektor.php";
if(file_exists($konekcija)) {
	
	include_once($konekcija);
	
}
else {
	
	die("Doslo je do fatalne greske u sistemu ,uskoro cemo biti dostupni <br>");
} 

if(isset($_SESSION['id'])) {
	
	if(isset($_POST['submit'])) {
		
		
		if(!empty($_POST['pass']) && !empty($_POST['newpass']) && !empty($_POST['repass'])) {
			
			
			$pass = $_POST['pass'];
			$newpass = $_POST['newpass'];
			$repass = $_POST['repass'];
			
			$sql = "SELECT * FROM `korisnici` WHERE `id` = :id";
			$korisnici = $konektor->prepare($sql);
			$korisnici->execute(array(
			
			':id' => $_SESSION['id']
			
			));
			if($korisnici->rowCount() > 0) {
				
				$fkorisnici = $korisnici->fetchAll(PDO::FETCH_OBJ);
				foreach($fkorisnici as $kor) {
					
					$password = $kor->password; 
					
				}
				
				if($password == $pass) {
					
					if(strlen($newpass) > 5) {
						
						if($newpass == $repass) {
							
							$sql = "UPDATE `korisnici` SET `password` = :pass 
							WHERE `id` = :id";
							$lozinka = $konektor->prepare($sql);
							$lozinka->execute(array(
							
							':pass' => $newpass , 
							':id' => $_SESSION['id']
							
							));
							
							
						}
						else {
							
							
							echo "Your password is not match! <br>";
							
						}
						
						
					}
					else {
						
						
						echo "Your new password is not enough strong, must be 5 or more characters! <br>";
					}
					
					
					
				}
				else {
					
					
					echo "That password is not your currently password <br>";
					
				}
				
				
			}
			else {
				
				
				echo "You have an error! <br>";
			}
			
			
			
			
		}
		else {
			
			
			echo "You must have type all fields";
			
		}
		
		
		
		
	}
?>


<form method="POST" action="index.php?opcija=password">
<table>

<tr>
<td>Trenutna lozinka</td>
<td><input type="text" name="pass"/></td>
</tr>

<tr>
<td>Nova lozinka</td>
<td><input type="password" name="newpass"/></td>
</tr>

<tr>
<td>Ponovite novu lozinku</td>
<td><input type="password" name="repass"/></td>
</tr>

<tr>
<td><input type="submit" name="submit" value="CHANGE"/></td>
</tr>

</table>
</form>
<?php 

}
else {
	
	
	echo "You don't have any access to be here! <br>";
	
	
}