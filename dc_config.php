<?php

///$servername = "177.71.233.182";
//$username = "root";
//$password = "Al0c@rioca18";
//$dbname = "bderpsisgef";

$servername = "201.38.172.137";
$username = "root";
$password = "Al0c@rioca18";
$dbname = "bderpsisgef";
try {
    	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    	die("OOPs algo deu errado");
    }
 
?>
