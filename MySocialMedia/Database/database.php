<?php 


//PDO Drajveri i kreiranje baze podataka za socijalnu mrežu 

$PDO = new PDO('mysql: host=localhost;,','root','');

$database = "CREATE DATABASE `social-media`";
$PDOdatabase = $PDO->query($database);



//Kreiranje tabela u bazi podataka 

$table1 = "CREATE TABLE `social-media`.`users`(


    id int(11) not null PRIMARY KEY AUTO_INCREMENT, 
	name varchar(128) not null , 
	surname varchar(128) not null , 
	fullname varchar(256) not null ,
	username varchar(128) not null , 
	email varchar(128) not null , 
	password varchar(128) not null , 
	birthday varchar(256) not null , 
	gender varchar(128) not null , 
	unknown varchar(128) not null , 
	confirm_em int(11) not null
);"; 

$PDOtable1 = $PDO->query($table1);




