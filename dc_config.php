<?php

$servername = "201.38.172.137";
$username = "root";
$password = "Al0c@rioca18";
$dbname = "bderpsisgef";

//$servername = "localhost";
//$username = "root";
//$password = "al0c@rioca";
//$dbname = "bderpsisgef";

try {
    	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    	die("OOPs algo deu errado");
    }
 
?>
