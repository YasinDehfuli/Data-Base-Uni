<?php
require 'inc/dbh.php';
$sql = "SELECT * FROM students WHERE id = :id";
$stm = $dbh->prepare($sql) or die('SQL err');
$stm->execute($_GET);
$student = $stm->fetch(PDO::FETCH_ASSOC );
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.rtl.min.css">
</head>
<body dir="rtl">
<div class="container">
    <form action="studentUpdate.php" method="post">
        <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <label for="name">
                        Name
                    </label>
                    <input type="text" id="name" name="name" value="<?php echo $student['name']; ?>" placeholder="Name" class="form-control">
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <label for="username">
                        Username
                    </label>
                    <input type="text" id="username" name="usernamex" value="<?php echo $student['username']; ?>" placeholder="Username" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <label for="tel">
                        Mobile
                    </label>
                    <input type="tel" id="tel" name="tel" value="<?php echo $student['tel']; ?>" placeholder="Mobile" class="form-control">
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <label for="email">
                        Email
                    </label>
                    <input type="email" id="email" name="email" value="<?php echo $student['email']; ?>" placeholder="Email" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="addr">
                Address
            </label>
            <textarea name="address" id="addr" class="form-control"  rows="3"><?php echo $student['address']; ?></textarea>
        </div>
        <div class="mt-2">
            <button class="btn btn-primary">
                Save
            </button>
        </div>
    </form>
</div>
</body>
</html>