<?php 

//Kreiranje fajla poruke 

?>
<a href="index.php?opcija=inbox">INBOKS</a> | <a href="index.php?opcija=outbox">OUTBOKS</a><br><br>

<h2>Kreiraj i posalji poruku</h2>

<?php

 $err = "";


  if(isset($_POST['submit'])) {
	  
	  
	  
	  $korisnici = $_POST['korisnici'];
	  
	  if(!empty($_POST['subject'])) {
		  
		  $subject = $_POST['subject'];
		  
		  
	  }
	  else {
		  
		  $err .= " Niste ukucali naslov razgovora! <br>";
		  
	  }
	  
	  if($korisnici == "") {
		  
		  
		  $err .= "Niste odabrali  nijednog korisnika!! <br>";
		  
	  }
	 if($korisnici == "name") {
		  
		  $sql = "SELECT * FROM `korisnici`";
          $korisnici = $konektor->query($sql);
		  if($korisnici->rowCount() != 0) {
          $fkorisnici = $korisnici->fetchAll(PDO::FETCH_OBJ);
          foreach($fkorisnici as $kor) {
	
	      $username = $kor->fullname; 
	
	
}
		  
		  
		  $sql = "SELECT * FROM `korisnici` WHERE `fullname` = :name";
		  $users = $konektor->prepare($sql);
		  $users->execute(array(
		  
		  ':name' => "name"
		  
		  ));
		  
		  if($users->rowCount() == 1) {
			  
			  //Kod se izvrsava
		  }
		  else if($users->rowCount() == 0) {
			  
			  $err .= "Korisnik kome zelite poslati poruku trenutno nije dostupan! <br>";
			  
			  
		  }
		  }
		  else {
			  
			  
			  echo "Dogodila se greska <br>";
		  }
		  
	  }
	  
	  if(!empty($_POST['message'])) {
		  
		$message = $_POST['message'];  
		  
		  
	  }
	  else {
		  
		  $err .= "Niste ukucali sami tekst poruke! <br>";
	  }
	  
	  if($err == "") {
		  
		  $sql = "SELECT * FROM `korisnici` WHERE `id` = :id";
		  $korisnici = $konektor->prepare($sql);
		  $korisnici->execute(array(
		  
		  ':id' => $_SESSION['id']
		  
		  
		  ));
		  $fkorisnici = $korisnici->fetchAll(PDO::FETCH_OBJ);
		  foreach($fkorisnici as $kor) {
			  
			  
			$fullname = $kor->fullname;  
		  }
		  
		  $qRaz = "INSERT INTO `razgovor` SET 
		  
		  `subject` = :subject
		  
		  ";
		  $razgovor = $konektor->prepare($qRaz);
		  $razgovor->execute(array(
		  
		  ':subject' => $subject
		  
		  ));
		  
		  $query = "SELECT * FROM `razgovor` WHERE `subject` = :subject";
		  $razz = $konektor->prepare($query);
		  $razz->execute(array(
		  
		  ':subject' => $subject
		  
		  ));
		  $frazz = $razz->fetchAll(PDO::FETCH_OBJ);
		  foreach($frazz as $raz) {
			  
			  
			$razgovor_id = $raz->id;   
			  
		  }
		  
		  $qPor = "INSERT INTO `poruke` SET 
		  
		  `from_user` = :from , 
		  `to_user` = :to , 
		  `razgovor_id` = :raz_id , 
		  `subject` = :subject , 
		  `tekst` = :tekst 
  
		  ";
		  $poruke = $konektor->prepare($qPor);
		  $poruke->execute(array(
		  
		  ':from' => $fullname ,
		  ':to' => $username , 
		  ':raz_id' => $razgovor_id , 
		  ':subject' => $subject , 
		  ':tekst' => $message
		  
		  
		  ));
		  
		  echo "Vasa poruka je uspjesno poslana! <br>";
		  
		  
		  
	  }
	  else {
		  
		  echo $err; 
		  
	  }
	 
	  
	  
	  
	  
  } 

?>

<form method="POST" action="index.php?opcija=poruka">
<table>

<tr>
<td><input type="text" name="subject" cols="40" placeholder=" Naslov razgovora.."/></td>
</tr>

<tr>
<td>
<select name="korisnici">
<option value="">Izaberi korisnika</option>
<?php

$sql = "SELECT * FROM `korisnici`";
$korisnici = $konektor->query($sql);
$fkorisnici = $korisnici->fetchAll(PDO::FETCH_OBJ);
foreach($fkorisnici as $kor) {
	?>

	<option value="name">
	<?php
	
	echo $kor->fullname . "<br>"; 
	?>
	</option>

	<?php
	
}


?>
	</select>
</td>
</tr>


<tr>
<td><textarea name="message" cols="60" rows="7" placeholder=" Napisi tekst poruke.."></textarea></td>
</tr>

<tr>
<td><input type="submit" name="submit" value="Posalji"/></td>
</tr>
</table>
</form>