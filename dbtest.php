<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbh = new PDO("mysql:host=$servername;dbname=lara", $username, $password);
$stm =  $dbh->prepare('DELETE FROM customers WHERE id =  :id ');
$stm->execute(['id' => $_GET['id'] ]);

$stm = $dbh->prepare("SELECT * FROM customers");
$stm->execute();
$customers = $stm->fetchAll();
//$dbh->query('DELETE FROM customers WHERE id = '.$_GET['id']);
//$stm = $dbh->query("SELECT * FROM customers");
//$posts = $stm->fetchAll();
echo '<pre>';
print_r($customers);