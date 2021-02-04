<!DOCTYPE HTML>
<html>
<head>
    <title>Read One Record</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

    <div class="container">

        <div class="page-header">
            <h1>Read a Record</h1>
        </div>

        <?php
        $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

        include '../config/database.php';

        try {
            $query = "SELECT id, type, name, content, ttl FROM recordA WHERE id = ? LIMIT 0,1";
            $stmt = $conn->prepare( $query );

            $stmt->bindParam(1, $id);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $type = $row['type'];
            $name = $row['name'];
            $content = $row['content'];
            $ttl = $row['ttl'];
        }

        catch(PDOException $exception){
            die('ERROR: ' . $exception->getMessage());
        }
        ?>

        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Type</td>
                <td><?php echo $type; ?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo $name; ?></td>
            </tr>
            <tr>
                <td>Content</td>
                <td><?php echo $content; ?></td>
            </tr>
            <tr>
                <td>Ttl</td>
                <td><?php echo $ttl; ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href='index.php' class='btn btn-danger'>Back to read records</a>
                </td>
            </tr>
        </table>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>