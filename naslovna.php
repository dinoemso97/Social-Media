<?php 


//Kreiranje naslovne stranice i objave drugih korisnika 

echo "<h1>Dobro dosli na vremensku liniju</h1><br>";
?>
<form method="POST" action="index.php?opcija=search">
<input type="text" name="search" placeholder=" Pretrazi korisnike.."/>
<select name="filter">
<option value="">Select filter</option>
<option value="fullname">First name</option>
<option value="lastname">Last name</option>
</select>
<input type="submit" name="submit" value="SEARCH"/>
</form>
<hr>
<h3>Vase objave i objave drugih korisnika</h3>

<form method="POST" action="index.php?opcija=objave">
<table>

<tr>
<td><textarea name="body" placeholder =" O cemu razmisljas.." cols="60" rows="5"></textarea></td>
</tr>

<tr>
<td><input type="submit" name="submitObjave" value="OBJAVI"/></td>
</tr>


</table>
</form>

<?php

$sql = "SELECT 

  
    `objave`.`id` as `objave_id` , 
	`objave`.`tekst` as `objave_tekst` , 
	`objave`.`user` as `objave_user` , 
	`objave`.`userid` as `objaveuser_id` , 
	`objave`.`datum` as `objave_datum` , 
	
	`korisnici`.`id` as `korisnici_id` , 
	`korisnici`.`fullname` as `kor_fullname` 
	
	FROM `korisnici` , `objave` 
	
	WHERE `korisnici`.`id` = `objave`.`userid` 
	AND `korisnici`.`fullname` = `objave`.`user` 
	
	GROUP BY `objave`.`id`
	ORDER BY `objave`.`datum` DESC 
";

$objave = $konektor->query($sql);
$fobjave = $objave->fetchAll(PDO::FETCH_OBJ);
foreach($fobjave as $f) {
	
	echo "<h3>". $f->kor_fullname ."</h3>"; 
	echo  $f->objave_tekst ."<br><br>";
	echo  $f->objave_datum ."<br><br>";
	
	
}




