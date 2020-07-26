<?php 

//Kreiranje fajla register 


$username = "";
$pass = "";
$repass="";
$fname = "";
$lname="";
$email = "";
$fullname="";
$datum="";
$gender="";
$code ="";

$usernameErr = "";
$passErr = "";
$repassErr="";
$fnameErr = "";
$lnameErr ="";
$emailErr = "";
$genderErr="";


if(isset($_POST['submit'])) {
	
	if(!empty($_POST['username'])) {
		
		if(strlen($_POST['username']) < 50) {
			
			$qKor = "SELECT * FROM `korisnici` WHERE `username` = :username";
			$korisnici = $konektor->prepare($qKor);
			$korisnici->execute(array(
			
			':username' => $_POST['username']
			
			));
			if($korisnici->rowCount()) {
				
				
				$usernameErr .= "Korisnicko ime koje ste unijeli vec postoji na nasoj stranici, molimo vas pokusajte ponovo <br>";
				
				
			}
			else {
				
				
				$username = $_POST['username'];
				
			}
			
			
			
			
			
			
			
		}
		else {
			
			
			$usernameErr .= "Vase korisnicko ime je preveliko <br>";
		}
		
		
	}
	else {
		
		
		$usernameErr .= "Morate ukucati Vase korisnicko ime <br>";
	}
	
	if(!empty($_POST['pass'])) {
		
		
		
		
		
	}
	else {
		
		
		$passErr .= "Morate ukcati Vasu lozinku <br>";
	}
	
	
	
	if(!empty($_POST['repass'])) {
		
		
	  	
		
	}
	else {
		
		
		$repassErr .= "Morate ukucati Vasu ponovljenu lozinku <br>";
		
	}
	
	if(isset($_POST['pass']) && isset($_POST['repass'])) {
		
		
		if($_POST['pass'] != $_POST['repass']) {
			
			$repassErr .= "Vase lozinke se ne poklapaju";
			
			
		}
else {
	
	
	$pass = $_POST['pass'];
}		
		
	}
	
	if(!empty($_POST['fname'])) {
		
		$fname = $_POST['fname'];
		
	}
	else {
		
		$fnameErr .= "Morate ukucati Vase ime <br>";
	}
	
	if(!empty($_POST['lname'])) {
		
		$lname = $_POST['lname'];
		
	}
	else {
		
		$lnameErr .= "Morate ukucati Vase prezime <br>";
	}
	
	$fullname = $fname . " " . $lname; 
	
	
	
	
	
	
	
	
	
	if(!empty($_POST['email'])) {
		
		if(filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL)) {
			
			$qKor = "SELECT * FROM `korisnici` WHERE `email` = :email";
			$korisnici = $konektor->prepare($qKor);
			$korisnici->execute(array(
			
			':email' => $_POST['email']
			
			));
			if($korisnici->rowCount()) {
				
				
				$emailErr .= "Email adresa koju ste unijeli vec postoji na nasoj stranici, molimo vas pokusajte ponovo <br>";
				
				
			}
			else {
				
				
				$email = $_POST['email'];
				
			}
			
		}
		else {
			
			
			$emailErr .= "Vasa email adresa nije validna! <br>";
		}
		
		
	}
	else {
		
		
		$emailErr .= "Morate ukucati Vasu email adresu <br>";
	}
	
	
	$dan = $_POST['dan'];
	$mjesec = $_POST['mjesec'];
	$godina = $_POST['godina'];
	
	$datum = $dan . " " . $mjesec . " " . $godina; 
	
	
	if(!empty($_POST['gender'])) {
		
		
		$gender = $_POST['gender'];
		
	}
	else {
		
		$genderErr .= "Morate izabrati spol! <br>";
		
	}
	
	$str = "dsjkpweakljfdsklfmklfs78932404234";
    $str = str_shuffle($str);
    $str = substr($str, 0 , 10);	
	
	
	//Kreiranje konacne petlje 
	
	
	if($usernameErr == "" && $passErr == "" && $repassErr == "" && 
	$fnameErr == ""&& $lnameErr == ""
	&& $emailErr == "" && $genderErr == "") {
		
		
		$sql = "INSERT INTO `korisnici` SET 
		
		   `username` = :username , 
		   `password` = :pass , 
		   `firstname` = :fname , 
		   `lastname` = :lname , 
		   `fullname` = :fullname , 
		   `email` = :email , 
		   `date` = :datum , 
		   `gender` = :gender , 
		   `unknown` = :code 
		   
		
		
		";
		$korisnici = $konektor->prepare($sql);
		$korisnici->execute(array(
		
		':username' => $username , 
		':pass' => $pass , 
		':fname' => $fname , 
		':lname' => $lname , 
		':fullname' => $fullname , 
		':email' => $email , 
		':datum' => $datum , 
		':gender' => $gender , 
		':code' => $str
		
		
		
		
		));
		
		require "PHPMejl/PHPMailerAutoload.php";
		
		$mejl = new PHPMailer(); 
		
		$mejl->isSMTP(); 
		$mejl->SMTPDebug = 0; 
		$mejl->Debugoutput = "html"; 

        $mejl->Host = "smtp.gmail.com";
        $mejl->Port = 587; 
        $mejl->SMTPAuth = true; 
        $mejl->SMTPSecure = "tls"; 

        $mejl->Username = "emsodino07@gmail.com";
        $mejl->Password = "softver12345";

        $mejl->setFrom("emsodino07@gmail.com","Dino");
        $mejl->addReplyTo($email , $fname);
        $mejl->addAddress($email , $fname);

        $mejl->Subject = "Poruka sa kontakt forme";
        $mejl->Body = "
		
		Kako bi nastavili sa validnom registeracijom potvrdite Vasu email adresu na ovom <a href='http://localhost/folderexercise-8/confirm.php?email=$email&counkn=$code'>LINKU</a>
		
		"; 
        $mejl->isHTML(true);

        if($mejl->send()) {
			
			echo "Uspjesno ste poslali poruku <br>";
			
		}
		else {
	
	 echo "Vasa poruka nije poslana <br>";
}	

        //Kreiranje parametara za profilnu sliku 
		/*
		 $sql = "SELECT * FROM `korisnici` WHERE `username` = :username AND 
		 `email` = :email AND `fullname` = :fullname";
		 $profile = $konektor->prepare($sql);
		 $profile->execute(array(
		 
		 ':username' => $username , 
		 ':email' => $email , 
		 ':fullname' => $fullname
		 
		 ));
 		if($profile->rowCount() > 0) {
			
			$fprofile = $profile->fetchAll(PDO::FETCH_OBJ);
			foreach($fprofile as $p) {
				
				$id = $p->id; 
				
				
			}
			
			$qPic = "INSERT INTO `profileimg` SET 
			
			`userid` = :id , 
			`status` = :zero
			
			";
			$picture = $konektor->prepare($qPic);
			$picture->execute(array(
			
			':id' => $id , 
			':zero' => 0
			
			
			));
			
			
		}
		else {
			
			
			echo "You have an error! <br>";
		}
	
		*/
	
		
		
	}
	
	
}


?> 

<form method="POST" action="index.php?opcija=register">
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
<td><input type="password" name="repass" placeholder=" Ponovite lozinku"/>
<?php
if($repass == "") {
	
	echo $repassErr; 
	
	
}
?>
</td>
</tr>


<tr>
<td><input type="text" name="fname" placeholder=" Vase ime"/>
<?php
if($fname == "") {
	
	echo $fnameErr; 
	
	
}
?>
</td>
</tr>

<tr>
<td><input type="text" name="lname" placeholder=" Vase prezime"/>
<?php
if($lname == "") {
	
	echo $lnameErr; 
	
	
}
?>
</td>
</tr>


<tr>
<td><input type="text" name="email" placeholder=" Email adresa"/>
<?php
if($email == "") {
	
	echo $emailErr; 
	
	
}
?>
</td>
</tr>


<tr>
<td>
Datum rođenja
<select name="dan">
<?php
for($dan = 1; $dan <= 31; $dan++) {
	
	
	?><option><?php echo $dan; ?></option><?php
	
} 
?>
</select>

<select name="mjesec">
<?php
for($mjesec = 1; $mjesec <= 12; $mjesec++) {
	
	
	?><option><?php 
   
      if($mjesec == 1) {
		  
		 echo " Januar"; 
		  
	  }

     if($mjesec == 2) {
		  
		 echo " Februar"; 
		  
	  }
	   
	   if($mjesec == 3) {
		  
		 echo " Mart"; 
		  
	  }
	  
	  if($mjesec == 4) {
		  
		 echo " April"; 
		  
	  }

     if($mjesec == 5) {
		  
		 echo " Maj"; 
		  
	  }
	   
	   if($mjesec == 6) {
		  
		 echo " Juni"; 
		  
	  }
	  
	  if($mjesec == 7) {
		  
		 echo " Juli"; 
		  
	  }

     if($mjesec == 8) {
		  
		 echo " August"; 
		  
	  }
	   
	   if($mjesec == 9) {
		  
		 echo " Septembar"; 
		  
	  }
	  
	  if($mjesec == 10) {
		  
		 echo " Oktobar"; 
		  
	  }

     if($mjesec == 11) {
		  
		 echo " Novembar"; 
		  
	  }
	   
	   if($mjesec == 12) {
		  
		 echo " Decembar"; 
		  
	  }

	?></option><?php
	
} 
?>
</select>

<select name="godina">
<?php
for($godina = 1935; $godina <= 2018; $godina++) {
	
	
	?><option><?php echo $godina; ?></option><?php
	
} 
?>
</select>


</td>
</tr>


<tr>
<td>Musko<input type="radio" name="gender" value="male"/></td>
</tr>

<tr>
<td>Zensko<input type="radio" name="gender" value="female"/>
<?php
if($gender == "") {
	
	echo $genderErr; 
	
}
?>
</td>
</tr>





<tr>
<td><input type="submit" name="submit" value=" Registrujte se"/>
</td>
</tr>


</table>
</form>