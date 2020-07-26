<?php 

//Kreiranje baze podataka i tabele u bazi 

$database = new PDO('mysql: host=localhost;','root','');

$sqlDB = "CREATE DATABASE `exercise-7`";
$data_base = $database->query($sqlDB);





$sqlTB1 = "CREATE TABLE `exercise-7`.`korisnici` (

   id int(11) not null PRIMARY KEY AUTO_INCREMENT , 
   username varchar(128) not null , 
   password varchar(128) not null , 
   firstname varchar(128) not null , 
   lastname varchar(128) not null , 
   fullname varchar(256) not null , 
   email varchar(128) not null , 
   date varchar(128) not null , 
   gender varchar(128) not null , 
   unknown varchar(128) not null , 
   confirm_em int(11) not null



);";
$table1 = $database->query($sqlTB1);



$sqlTB2 = "CREATE TABLE `exercise-7`.`profileimg` (

   id int(11) not null PRIMARY KEY AUTO_INCREMENT , 
   status int(11) not null , 
   userid int(11) not null



);";
$table2 = $database->query($sqlTB2);



$sqlTB3 = "CREATE TABLE `exercise-7`.`gallery` (

   id int(11) not null PRIMARY KEY AUTO_INCREMENT , 
   name varchar(128) not null , 
   subject varchar(128) not null , 
   descGall varchar(128) not null , 
   orderGall int(11) not null



);";
$table3 = $database->query($sqlTB3);


$sqlTB4 = "CREATE TABLE `exercise-7`.`objave` (

   id int(11) not null PRIMARY KEY AUTO_INCREMENT , 
   tekst text not null , 
   user varchar(128) not null , 
   userid varchar(128) not null , 
   datum TIMESTAMP not null ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP



);";
$table4 = $database->query($sqlTB4);


$sqlTB5 = "CREATE TABLE `exercise-7`.`razgovor` (

   id int(11) not null PRIMARY KEY AUTO_INCREMENT , 
   subject varchar(128) not null



);";
$table5 = $database->query($sqlTB5);



$sqlTB6 = "CREATE TABLE `exercise-7`.`poruke` (

   id int(11) not null PRIMARY KEY AUTO_INCREMENT , 
   from_user varchar(128) not null , 
   to_user varchar(128) not null , 
   razgovor_id int(11) not null , 
   subject int(11) not null , 
   tekst text not null , 
   datum TIMESTAMP not null ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP



);";
$table6 = $database->query($sqlTB6);








