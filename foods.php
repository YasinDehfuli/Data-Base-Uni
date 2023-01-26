<?php
require 'inc/dbh.php';

if (isset($_GET['id'])){
    $sql = "DELETE FROM foods WHERE id = :id ;";
    $stm = $dbh->prepare($sql) or die('SQL err');
    $stm->execute($_GET);
}

$stm = $dbh->prepare('SELECT COUNT(*) AS "c" FROM foods;')
or die('SQL err');
$stm->execute();
$count = $stm->fetch();

$start = 0;
if (isset($_GET['page'])){
    $page = (int) $_GET['page'];
    if ( $page <= 0 || $page >= $count[0] ){
        $start = 0;
    }else{
        $start = ( $page -1)*10;
    }
}else{
    $page = 1;
}
$stm = $dbh->prepare('SELECT * FROM students;') or die('SQL err');
$stm->execute();
$students = $stm->fetchAll();
$stm = $dbh->prepare('SELECT f.*,s.username FROM foods f 
LEFT JOIN students s on s.id = f.student_id LIMIT ' . (int) $start . ',10;')
or die('SQL err');
$stm->execute();
$foods = $stm->fetchAll();

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
    <div class="row">
        <div class="col">
            تعداد کل:
            <?php echo $count[0]; ?>
        </div>
        <div class="col">
            تعداد نمایش:
            <?php echo count($foods); ?>
        </div>
        <div class="col"></div>
    </div>
    <table class="table table-bordered table-striped table-hover table-dark">
        <tr>
            <th>
                id
            </th>
            <th>
                name
            </th>
            <th>
                student
            </th>
            <th>-</th>
        </tr>
        <?php foreach ($foods as $food): ?>
            <tr>
                <td>
                    <?php echo $food['id']; ?>
                </td>
                <td>
                    <?php echo $food['name']; ?>
                </td>
                <td>
                    <?php echo $food['username']; ?>
                </td>

                <th>
                    <a href="?id=<?php echo $food['id']; ?>" class="btn btn-danger">
                        &times;
                    </a>
                </th>
            </tr>
        <?php endforeach; ?>
    </table>

    <form action="foodStore.php" method="post">
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
                    <select name="student_id" id="username" class="form-control">
                        <?php foreach ($students as $student): ?>
                            <option value="<?php echo $student['id'] ?>">
                                <?php echo $student['name'] . ' (' . $student['username'] . ')' ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="mt-2">
            <button class="btn btn-primary">
                Save
            </button>
        </div>
    </form>


    <div class="text-center my-2">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if ($page > 1): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page-1; ?>">Previous</a></li>
                <?php else: ?>
                    <li class="page-item disabled"><a class="page-link" ">Previous</a></li>
                <?php endif; ?>

                <?php
                $max = ceil($count[0] / 10);
                for ($i = 1; $i <= ceil($count[0] / 10); $i++): ?>

                <li class="page-item">
                    <a href="?page=<?php echo $i; ?>" class="page-link <?php
                    if ($page == $i)
                        echo 'active';
                    ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
                <?php endfor; ?>
                <?php if ($page >= $max): ?>
                    <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
                <?php else: ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php  echo $page+1 ?>">Next</a></li>
                <?php endif; ?>
            </ul>
        </nav>

    </div>
</div>
</body>
</html>
