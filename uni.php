<?php
require 'inc/dbh.php';
if (isset($_GET['id'])){
    $sql = "DELETE FROM students WHERE id = :id";
    $stm = $dbh->prepare($sql) or die('SQL err');
    $stm->execute($_GET);
}
$stm = $dbh->prepare('SELECT * FROM students;') or die('SQL err');
$stm->execute();
$students = $stm->fetchAll();

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.rtl.min.css">
    <title>Document</title>
</head>
<body dir="rtl">
<div class="container mt-2">
    <table class="table table-bordered table-striped table-hover table-dark">
        <tr>
            <th>
                id
            </th>
            <th>
                name (username)
            </th>
            <th>
                email
            </th>
            <th>
                tel
            </th>
            <th>
                -
            </th>
        </tr>
        <?php foreach ($students as $student): ?>
            <tr>
                <td>
                    <?php echo $student['id']; ?>
                </td>
                <td>
                    <?php echo $student['name']; ?>
                    (<?php echo $student['username']; ?>)
                </td>
                <td>
                    <?php echo $student['email']; ?>
                </td>
                <td>
                    <?php echo $student['tel']; ?>
                </td>
                <th>
                    <a href="?id=<?php echo $student['id']; ?>" class="btn btn-danger">
                        &times;
                    </a>
                    <a href="studentEdit.php?id=<?php echo $student['id']; ?>" class="btn btn-primary">
                        Edit
                    </a>
                </th>
            </tr>
        <?php endforeach; ?>
    </table>
    <form action="studentStore.php" method="post">
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <label for="name">
                        Name
                    </label>
                    <input type="text" id="name" name="name" value="" placeholder="Name" class="form-control">
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <label for="username">
                        Username
                    </label>
                    <input type="text" id="username" name="usernamex" value="" placeholder="Username" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <label for="tel">
                        Mobile
                    </label>
                    <input type="tel" id="tel" name="tel" value="" placeholder="Mobile" class="form-control">
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <label for="email">
                        Email
                    </label>
                    <input type="email" id="email" name="email" value="" placeholder="Email" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="addr">
                Address
            </label>
            <textarea name="address" id="addr" class="form-control"  rows="3"></textarea>
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
