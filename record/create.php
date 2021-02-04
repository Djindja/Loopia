<!DOCTYPE HTML>
<html>
<head>
    <title>Create a Record</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

    <div class="container">

    <div class="page-header">
        <h1>Create a Record</h1>
    </div>

    <?php
    if($_POST){

        include 'config/database.php';

        try{
            $query = "INSERT INTO recordA SET type=:type, name=:name, content=:content, ttl=:ttl";

            $stmt = $conn->prepare($query);

            $type = $_POST['type'];
            $name = $_POST['name'];
            $content = $_POST['content'];
            $ttl = $_POST['ttl'];

            $stmt->bindParam(':type', $type);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':ttl', $ttl);

            if($stmt->execute()){
                echo "<div class='alert alert-success'>Record was saved.</div>";
            }else{
                echo "<div class='alert alert-danger'>Unable to save record.</div>";
            }

        }

        catch(PDOException $exception){
            die('ERROR: ' . $exception->getMessage());
        }
    }
    ?>

    <form action="create.php" method="post">
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Type</td>
                <td><input type='text' name='type' class='form-control' required placeholder="Enter type" /></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><textarea name='name' class='form-control' required placeholder="Enter name"></textarea></td>
            </tr>
            <tr>
                <td>Content</td>
                <td><input type='text' name='content' class='form-control' required placeholder="Enter content"/></td>
            </tr>
            <tr>
                <td>Number</td>
                <td><input type='number' name='ttl' class='form-control' placeholder="Enter number"/></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type='submit' value='Save' class='btn btn-primary' />
                    <a href='index.php' class='btn btn-danger'>Back to read records</a>
                </td>
            </tr>
        </table>
    </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>