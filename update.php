<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Md. Milton Khan">
    <title>Update Record</title>
    <style>
    .container {
        width: 80%;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    </style>
</head>

<body>
    <?php
    require_once "db_config.php";
    // Define variables and initialize with empty values
    $name = $age = $id = "";
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $id = $_GET["id"];

        // Attempt select query execution
        $sql = "SELECT * FROM `person_info` WHERE id = $id";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_array($result);
            $name = $row['name'];
            $age = $row['age'];
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $update_name = $_POST['name'];
        $update_age = $_POST['age'];
        $sql = "UPDATE `person_info` SET `name`='$update_name',`age`='$update_age' WHERE `id`= $id";
        if (mysqli_query($link, $sql)) {
            $msg = urlencode("Record updated successfully");
            header("location: index.php?msg=" . $msg);
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($link);
        }
    }

    ?>
    <div class="container">
        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
            <fieldset>
                <legend>Personal Information:</legend>
                <table>
                    <tr>
                        <td>Name</td>
                        <td><input type="text" name="name" value="<?php echo  $name ?>"></td>
                    </tr>
                    <tr>
                        <td>Age</td>
                        <td><input type="number" name="age" value="<?php echo  $age ?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Update"></td>
                    </tr>
                </table>
                </legend>
            </fieldset>
        </form>
    </div>
</body>

</html>
