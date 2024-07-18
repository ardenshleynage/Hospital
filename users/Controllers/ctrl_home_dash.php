<?php
include ("../dao/dao_users.php");
$allservicesDAO = new ServiceDash();

$num = $allservicesDAO->ServiceNumber();


$pdo = new PDO('mysql:host=localhost;dbname=hospital', 'root', '');

$checksql = "SELECT * FROM `employee`";
$checkstmt = $pdo->prepare($checksql);
$checkstmt->execute();
// Utilisation de rowCount() pour obtenir le nombre de lignes retournées par la requête
$num_emp = $checkstmt->rowCount();

$checksql = "SELECT * FROM `patient`";
$checkstmt = $pdo->prepare($checksql);
$checkstmt->execute();
// Utilisation de rowCount() pour obtenir le nombre de lignes retournées par la requête
$num_pat = $checkstmt->rowCount();


?>