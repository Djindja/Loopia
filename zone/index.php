<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>All Zones</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
    </style>

</head>
<body>

    <div class="container">

        <div class="page-header">
            <h1>Read Zones</h1>
        </div>

        <?php

    include '../config/database.php';

    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    $records_per_page = 5;

    $from_record_num = ($records_per_page * $page) - $records_per_page;

    $action = isset($_GET['action']) ? $_GET['action'] : "";

    if($action=='deleted'){
        echo "<div class='alert alert-success'>Record was deleted.</div>";
    }

    $query = "SELECT id, name FROM zone ORDER BY id DESC
    LIMIT :from_record_num, :records_per_page";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(":from_record_num", $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(":records_per_page", $records_per_page, PDO::PARAM_INT);
    $stmt->execute();

    $num = $stmt->rowCount();

    if($num>0){

        echo "<table class='table table-hover table-responsive table-bordered'>";

        echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Name</th>";
            echo "<th>Action</th>";
        echo "</tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

            extract($row);

            echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$name}</td>";
                echo "<td>";
                    echo "<a href='read_one.php?id={$id}' class='btn btn-info m-r-1em'>Read</a>";
                echo "</td>";
            echo "</tr>";
        }

        echo "</table>";

        echo "<a href='/index.php' class='btn btn-info' style='margin-bottom: 15px;'>Back to main page</a>";


        $query = "SELECT COUNT(*) as total_rows FROM zone";
        $stmt = $conn->prepare($query);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_rows = $row['total_rows'];

        $page_url="index.php?";
        include_once "../paging.php";
    }

    else{
        echo "<div class='alert alert-danger'>No records found.</div>";
    }
    ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>