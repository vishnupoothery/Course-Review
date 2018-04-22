<?php
$server = 'localhost';
$username = 'b160688cs';
$password = 'b160688cs';
$database = 'db_b160688cs';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}