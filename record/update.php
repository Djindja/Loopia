<!DOCTYPE HTML>
<html>
<head>
    <title>Update a Record</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

    <div class="container">

        <div class="page-header">
            <h1>Update Record</h1>
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

        <?php

        if($_POST){

            try{

                $query = "UPDATE recordA
                            SET type=:type, name=:name, content=:content, ttl=:ttl
                            WHERE id = :id";

                $stmt = $conn->prepare($query);

                $type=$_POST['type'];
                $name=$_POST['name'];
                $content=$_POST['content'];
                $ttl=$_POST['ttl'];

                $stmt->bindParam(':type', $type);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':content', $content);
                $stmt->bindParam(':ttl', $ttl);
                $stmt->bindParam(':id', $id);

                if($stmt->execute()){
                    echo "<div class='alert alert-success'>Record was updated.</div>";
                }else{
                    echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                }

            }

            catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>

        <form action="<?php echo $_SERVER["PHP_SELF"] . "?id={$id}";?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Type</td>
                    <td><input type='text' name='type' value="<?php echo $type; ?>" class='form-control'/></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='name' value="<?php echo $name; ?>" class='form-control'/></td>
                </tr>
                <tr>
                    <td>Content</td>
                    <td><input type="text" name='content' value="<?php echo $content; ?>" class='form-control'/></td>
                </tr>
                <tr>
                    <td>Ttl</td>
                    <td><input type='number' name='ttl' value="<?php echo $ttl; ?>" class='form-control'/></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
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