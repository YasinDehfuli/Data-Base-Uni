<?php
require 'inc/dbh.php';

function emailValid($email){
    $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/';
    if (preg_match($regex, $email)) {
        return true;
    } else {
        return  false;
    }
}
$sql = "UPDATE students SET
name = :name,
username = :usernamex,
email = :email,
tel = :tel,
address = :address
WHERE id = :id ;";

if(!emailValid($_REQUEST['email'])) {
   die('invalid email');
}
$stm = $dbh->prepare($sql) or die('SQL err');
$stm->execute($_REQUEST);
header('location: uni.php');