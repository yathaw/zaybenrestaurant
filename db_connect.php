<?php 
$servername = "localhost";
$dbname="zayben_pure";
$user = "root";
$passwd = "";

$dsn = "mysql:host=$servername;dbname=$dbname";

$pdo = new PDO($dsn, $user, $passwd); 
try 
{
	
	$conn = $pdo;
	
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connected successfully";

}
catch(PDOException $e)
{
echo "Connection failed: " . $e->getMessage();
}


?>