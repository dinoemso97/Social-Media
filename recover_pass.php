<?php 

$konekcija = "konektor.php";
if(file_exists($konekcija)) {
	
	include_once($konekcija);
	
}
else {
	
	die("Doslo je do fatalne greske u sistemu ,uskoro cemo biti dostupni <br>");
}




?>
<!DOCTYPE html>
<html>
    <head>
	  <link rel="stylesheet" type="text/css" href="style.css"/>
	   <style>
	   
	     .reset-password {
			 
			 margin: 15% auto; 
			 display: block; 
			 text-align: center; 
			
			 
		 }
		 .form-control {
			 
			 
			 width: 400px; 
			 height: 30px; 
			 
		 }
		 
		 .btn {
			 
			 
			 width: 120px; 
			 height: 30px; 
			 margin-top: 10px; 
		 }
		 
	   </style>
	</head>
	<body>
	<?php 
	   if(!empty($_POST['email'])){
		   
		   $email = $_POST['email'];
		   
		   $sql = "SELECT `id` FROM `korisnici` WHERE `email` = :email";
		   $korisnici = $konektor->prepare($sql);
		   $korisnici->execute(array(
		   
		   ':email' => $email
		   
		   ));
		   if($korisnici->rowCount() > 0) {
			   
			  $token = "dasjkdjaskdljaskdlaksd37283djkasdask"; 
			  $token = str_shuffle($token);
			  $token = substr($token , 0 , 10);
			  
			  $query = "UPDATE `korisnici` SET `unknown` = :token  
			 WHERE `email` = :email";
			  $korisnici = $konektor->prepare($query);
			  $korisnici->execute(array(
			  
			  ':token' => $token ,  
			  ':email' => $email
			  
			  ));
			   exit(json_encode(array("status" => 1 , "msg" => "Check your email inbox")));
		   }
		   else {
			   
			   exit(json_encode(array("status" => 0, "msg" => "Please eneter your email adress")));
			   
		   }
		   
	   }
	    
	   
	?>
	<div class="reset-password">
	<input class="form-control" id="email" placeholder=" Email adress"/>
	
<br>
	<input type="button" class="btn btn-primary" value="Reset password"/>
	<br><br>
	<p id="response"></p>
	</div>
	
	
	<script
			  src="http://code.jquery.com/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous">
			  
	</script>
	<script type="text/javascript">
	   
	     var email = $("#email");
		 
		 $(document).ready(function () {
			 
			 $(".btn-primary").on("click", function () {
				 
				 
				 if(email.val() != "") {
					 
					 email.css("border", "1px solid green");
					 
					 $.ajax({
						 
						 url: 'recover_pass.php' , 
						 method: 'POST' , 
						 dataType: 'json' , 
						 data: {	 
					email: email.val()	 
						 },
                    success: function (response) {
						
						if(!response.success) {
							
						$('#response').html(response.msg).css("color" , "red");	
							
						}
						
					}						 
						  
						 
						 
					 });
					 
				 }
				 else {
					 
					 email.css("border", "1px solid red");
					 
				 }
				 
				 
			 });
			 
			 
			 
			 
		 });
	
	</script>
	</body>
</html>