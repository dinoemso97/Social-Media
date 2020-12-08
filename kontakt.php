<?php 

//Kreiranje fajla register 


$name = "";
$email = "";
$message = "";


$nameErr = "";
$emailErr = "";
$messageErr = "";


if(isset($_POST['submit'])) {
	
	
	if(!empty($_POST['name'])) {
		
		$name = $_POST['name'];
		
	}
	else {
		
		
		$nameErr .= "Morate ukucati Vase ime i prezime <br>";
		
	}
	
	if(!empty($_POST['email'])) {
		
		$email = $_POST['email'];
		
	}
	else {
		
		
		$emailErr .= "Morate ukucati Vasu email adresu <br>";
		
	}
	
	if(!empty($_POST['message'])) {
		
		$message = $_POST['message'];
		
	}
	else {
		
		
		$messageErr .= "Morate postaviti pitanje! <br>";
		
	}
	
	$foldername = "attachment/" . basename($_FILES['file']['name']);
	move_uploaded_file($_FILES['file']['tmp_name'] , $foldername);
	
	
	//Kreiranje konance petlje 
	
	if($nameErr == "" && $emailErr == "" && $messageErr == "") {
		
		
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
        $mejl->Password = "";

        $mejl->setFrom($email , $name);
        $mejl->addReplyTo("emsodino07@gmail.com" , "Dino");
        $mejl->addAddress("emsodino07@gmail.com","Dino");
		$mejl->addAttachment($foldername);

        $mejl->Subject = "Poruka sa kontakt forme";
        $mejl->Body = $message; 
        $mejl->isHTML(true);

        if($mejl->send()) {
			
			echo "Uspjesno ste poslali poruku <br>";
			
		}	
else {
	
	 echo "Vasa poruka nije poslana <br>";
}		
		
		
		
	}
	
	
}


?> 

<form method="POST" action="index.php?opcija=kontakt" enctype="multipart/form-data">
<table>

<tr>
<td><input type="text" name="name" placeholder="Vase ime i prezime"/>
<?php
if($name == "") {
	
	echo $nameErr; 
	
	
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
<td><textarea name="message" cols="50" rows="6"></textarea>
<?php
if($message == "") {
	
	echo $messageErr; 
	
	
}
?>
</td>
</tr>

<tr>
<td>Posaljite nam sliku ili fajl? <input type="file" name="file"/></td>
</tr>




<tr>
<td><input type="submit" name="submit" value="Posaljite pitanje"/>
</td>
</tr>


</table>
</form>
