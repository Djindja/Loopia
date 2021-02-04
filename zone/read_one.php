<!DOCTYPE HTML>
<html>
<head>
    <title>Read One Zone</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

    <div class="container">

        <?php
        $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

        include '../config/database.php';

        try {
            $query = "SELECT id, name FROM zone WHERE id = ? LIMIT 0,1";
            $stmt = $conn->prepare( $query );

            $stmt->bindParam(1, $id);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $id = $row['id'];
            $name = $row['name'];
        }

        catch(PDOException $exception){
            die('ERROR: ' . $exception->getMessage());
        }
        ?>

        <?php if($id !== null): ?>
        <h1>Read Zone</h1>
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Id</td>
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo $name; ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href='index.php' class='btn btn-danger'>Back to read zones</a>
                </td>
            </tr>
        </table>
        <?php else :
            header("HTTP/1.0 404 Not Found");
            echo "<h1>404 Not Found</h1>";
            echo "The page that you have requested could not be found.";
            exit();
        endif; ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>