<!DOCTYPE html>
<html>
<head> 
     <meta charset="utf-8"/>
	 <meta name="viewport" content="width= device-width, initial-scale= 1.0"/>
	 <link rel="stylesheet" type="text/css" href="style.css"/>
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/4.0.0/cropper.min.css"/>
</head>
<body>
<?php 

//Krerianje fajla MOJ PROFIL 

if(isset($_GET['pid'])) {
	
	$qKor = "SELECT * FROM `korisnici` WHERE `id` = :id";
	$korisnici = $konektor->prepare($qKor);
	$korisnici->execute(array(
	
	
	':id' => $_GET['pid']
	
	));
	
	
}
else {
	
	$qKor = "SELECT * FROM `korisnici` WHERE `id` = :id";
	$korisnici = $konektor->prepare($qKor);
	$korisnici->execute(array(
	
	
	':id' => $_SESSION['id']
	
	));
	
}

if(isset($_SESSION['id'])) {
	
	if($korisnici->rowCount() > 0) {
		
		$fkorisnici = $korisnici->fetchAll(PDO::FETCH_OBJ);
		foreach($fkorisnici as $kor) {
			
			
			?>
			<div class="container">
			<canvas id="canvas">
			   
			</canvas>
			</div>
			<div id="result">
			</div>
			<div class="form">
			<input type="file" name="file" id="img_file"/>
			<button id="crop" type="submit">Crop the photo</button>
			</div>
			<?php
			
			/*
			echo "Dobro dosli <b>" . $kor->firstname ."</b>, ovo je Vaš profil <br>";
			echo "<h1>". $kor->fullname ."</h1>";
			//Kreiranje parametara za sliku 
			
			$sql = "SELECT * FROM `korisnici` WHERE `id` = :id";
			$korisnici = $konektor->prepare($sql);
			$korisnici->execute(array(
			
			
			':id' => $_SESSION['id']
			
			));
			
			if($korisnici->rowCount() > 0) {
				
				$fkorisnici = $korisnici->fetchAll(PDO::FETCH_OBJ);
				foreach($fkorisnici as $fkor) {
					
					$id = $fkor->id; 
					
				}
				
				$qKor = "SELECT * FROM `profileimg` WHERE `userid` = :id";
				$user = $konektor->prepare($qKor);
				$user->execute(array(
				
				':id' => $id
				
				));
				
				$fuser = $user->fetchAll(PDO::FETCH_OBJ);
				foreach($fuser as $u) {
					
					$status = $u->status; 
					
					if($status == 1) {
						
						$fileName = "uploads/profile" . $id . "*";
                        $fileGlob = glob($fileName);
                        $fileExt = explode("." , $fileGlob[0]); 
                        $extension = $fileExt[1];
						
						echo "<img src='uploads/profile". $id .".". $extension."?". mt_rand() ."'/>";
						
					}
					else if($status == 0) {
						
						echo "<img src='uploads/profiledefault.jpg'/>";
						
					}
					
					
				}
				
			}
			else {
				
				
				
				echo "You have an error! <br>";
			}
			
			
			
			
			
			?>
			<!--
			<form method="POST" action="index.php?opcija=uploads" enctype="multipart/form-data">
			<input type="file" name="file"/>
			<input type="submit" name="uploads" value="UPLOAD"/>
			<a href="index.php?opcija=gallery">Idite na svoju galeriju</a><br>
			</form>
			
			<form method="POST" action="index.php?opcija=deleteprofilepic" enctype="multipart/form-data">
			
			<input type="submit" name="submit" value="DELETE"/>
			
			</form>
			-->
			
			
			<?php
			*/
			echo "Korisnicko ime:<h3>". $kor->username ."</h3>" . " " ."Email adresa:<h3>". $kor->email ."</h3>";
			
		}
	
		
		
	}
		else {
		
		echo "Dogodila se greska! <br>";
		
	}
	
	
}
else {
	
	echo "Nemate pristup ovoj stranici!! <br>";
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/4.0.0/cropper.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	// preparing canvas variables
	var $canvas = $('#canvas'),
		context = $canvas.get(0).getContext('2d');

	// waiting for a file to be selected
	$('#img_file').on('change',function(){
		
		if (this.files && this.files[0]) {
			// checking if a file is selected

			if ( this.files[0].type.match(/^image\//) ) {
				// valid image file is selected
				// process image
				// process the image
				var reader = new FileReader();

				reader.onload = function(e){					
					var img = new Image();
					img.onload = function() {						
						context.canvas.width = img.width;
						context.canvas.height = img.height;
						context.drawImage(img, 0, 0);

						// instantiate cropper
						var cropper = $canvas.cropper({
							aspectRatio: 16 / 9
						});
					};
					img.src = e.target.result;
				};

				$('#crop').click(function(){
					var croppedImage = $canvas.cropper('getCroppedCanvas').toDataURL('image/jpg');
					$('#result').append($('<img>').attr('src', croppedImage));
					console.log(croppedImage);
				});

				// reading the selected file
				reader.readAsDataURL(this.files[0]);


			} else {
				alert('Invalid file type');
			}
		} else {
			alert('Please select a file.');
		}
	});

});

</script>
</body>
</html>