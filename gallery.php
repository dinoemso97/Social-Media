<?php 

   //Kreiranje fajla galerije 
   
   echo "<h2>Galerija</h2>";
   
  $konekcija = "konektor.php";
if(file_exists($konekcija)) {
	
	include_once($konekcija);
	
}
else {
	
	die("Doslo je do fatalne greske u sistemu ,uskoro cemo biti dostupni <br>");
} 

$sql = "SELECT * FROM `gallery` ORDER BY `orderGall`";
$gallery = $konektor->query($sql);
$fgallery = $gallery->fetchAll(PDO::FETCH_OBJ);
foreach($fgallery as $gall) {
	
	echo "<img src='gallery/". $gall->name ."' width='300'/>";
	echo "<h3>".$gall->descGall."</h3>" ; 
	$id = $gall->id; 
	
	echo "<a href='config.php?id=". $id ."' style='text-decoration: none;'><input type='submit' name='delete' value='DELETE'/></a><br><br>";
	
	
	
}

   
   
   
   
   
   
   
?>

<form method="POST" action="index.php?opcija=galleryinc" enctype="multipart/form-data">
<table>

<tr>
<td>
<input type="text" name="nameofpic" placeholder=" Dodaj ime slike"/>
</td>
</tr>

<tr>
<td>
<input type="text" name="descofpic" placeholder=" Dodaj opis slike"/>
</td>
</tr>

<tr>
<td>
<input type="file" name="file"/>
</td>
</tr>

<tr>
<td>
<input type="submit" name="upload" value="UPLOAD"/>
</td>
</tr>


</table>
</form>