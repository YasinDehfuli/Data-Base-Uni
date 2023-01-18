<?php
require 'inc/dbh.php';
$sql = "INSERT INTO `students` (`name`, `email`, `username`, `tel`, `address`) 
VALUES (:name, :email, :username, :tel, :address);";
$stm = $dbh->prepare($sql);
$stm->execute($_REQUEST);
header('location: uni.php');
//print_r($_REQUEST);