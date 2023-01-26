<?php
require 'inc/dbh.php';
//print_r($_REQUEST);
$sql = "INSERT INTO `foods` (`name`, `student_id`) 
VALUES (:name, :student_id);";
$stm = $dbh->prepare($sql);
$stm->execute($_REQUEST);
header('location: foods.php');
