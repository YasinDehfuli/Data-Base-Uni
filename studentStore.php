<?php
require 'inc/dbh.php';
//print_r($_REQUEST);
$sql = "INSERT INTO `students` (`name`, `email`, `username`, `tel`, `address`) 
VALUES (:name, :email, :usernamex, :tel, :address);";
$stm = $dbh->prepare($sql);
$stm->execute($_REQUEST);
header('location: uni.php');
