<?php 

//Kreiranje fjla za uploudovanje slike profila 

$konekcija = "konektor.php";
if(file_exists($konekcija)) {
	
	include_once($konekcija);
	
}
else {
	
	die("Doslo je do fatalne greske u sistemu ,uskoro cemo biti dostupni <br>");
}

if(isset($_SESSION['id'])) {
	

	
	
	
	/*
	if(isset($_POST['uploads'])) {
		
		$id = $_SESSION['id'];
		
		
		$file = $_FILES['file'];
		
		$fileName = $file['name'];
		$fileType = $file['type'];
		$fileError = $file['error'];
		$fileSize = $file['size'];
		$fileTmp = $file['tmp_name'];
		
		$fileExt = explode('.',$fileName);
		
		$extension = strtolower(end($fileExt));
		
		$allowed = array('jpg','png','jpeg','gif');
		
		
		
		if(in_array($extension , $allowed)) {
			
			if($fileError == 0) {
				
				if($fileSize < 1000000) {
					
					$fileNewName = "profile" . $id . "." . $extension; 
                    $fileDest = "uploads/" . $fileNewName; 
					move_uploaded_file($fileTmp , $fileDest);
					
					$sql = "UPDATE `profileimg` SET `status` = :one WHERE `userid` = :id";
					$profile = $konektor->prepare($sql);
					$profile->execute(array(
					
					':one' => 1 , 
					':id' => $id
					
					
					));
					header("Location: index.php?opcija=profil");
					
					
					
                   					
					
					
					
					
				}
				else {
					
					
					echo "Your picture have much memory for us site, please check another picture! <br>";
				}
				
				
				
			}
			else {
				
				
				echo "You have an error! <br>";
				
			}
			
			
			
			
		}
		else {
			
			
			echo "Your file don't have corresponding extension! <br>";
		}
		
		
		
		
	}
	
	
	*/
}
else {
	
	
	
	echo "Nemate pristup ovoj stranici <br>";
	
}