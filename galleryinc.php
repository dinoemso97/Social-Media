<?php 

     $konekcija = "konektor.php";
if(file_exists($konekcija)) {
	
	include_once($konekcija);
	
}
else {
	
	die("Doslo je do fatalne greske u sistemu ,uskoro cemo biti dostupni <br>");
}   
  
  
  if(isset($_POST['upload'])) {
	  
	  $filename = $_POST['nameofpic'];
	  
	  if(empty($filename)) {
		  
		  
		$filename = "gallery";  
		  
	  }
	  else {
		  
		  
		  
		  $filename = strtolower(str_replace("","-", $filename));
	  }
	  
	  $filedesc = $_POST['descofpic'];
	  
	  
	  $file = $_FILES['file'];
	  
	  $fileName = $file['name'];
	  $fileType = $file['type'];
	  $fileSize = $file['size'];
	  $fileError = $file['error'];
	  $fileTmp = $file['tmp_name'];
	  
	  $fileExt = explode('.',$fileName);
	  $extension = strtolower(end($fileExt));
	  
	  $allowed = array("jpg","gif","png","jpeg");
	  
	  if(in_array($extension , $allowed)) {
		  
		  if($fileError == 0) {
			  
			  if($fileSize < 1000000) {
				  
				  $fileNewName = $filename . "." . uniqid(" ",true) . "." . $extension ; 
				  $fileDest = "gallery/" . $fileNewName; 
				  
				  //Kreiranje upita 
				  
				  $sql = "SELECT * FROM `gallery`";
				  $gallery = $konektor->query($sql);
				  $rowCount = $gallery->rowCount(); 
				  $order = $rowCount + 1; 
				  
				  $query = "INSERT INTO `gallery` SET 
				  
				  `name` = :name , 
				  `descGall` = :desc , 
				  `orderGall` = :order
				  
				  
				  
				  ";
				$galerija = $konektor->prepare($query);
				$galerija->execute(array(
				
				':name' => $fileNewName , 
				':desc' => $filedesc , 
				':order' => $order
				
				));
				  
				  
				  
				  
				  move_uploaded_file($fileTmp  ,$fileDest);
				  header("Location: index.php?opcija=gallery");
				  
				  
			  }
			  else {
				  
				  
				  echo "Size of your picture is to big! <br>";
			  }
			  
			  
		  }
		  else {
			  
			  
			  echo "You have an error! <br>";
		  }
		  
		  
	  }
	  else {
		  
		  
		  echo "Your picture dosen't have corresponding extension <br>";
		  
	  }
	  
	  
	  
	  
	  
  }
  
  
  



?>
