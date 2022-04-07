<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Md. Milton Khan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input_name = $_POST['name'];
        $input_age = $_POST['age'];

        $sql = "INSERT INTO `person_info`( `name`, `age`) VALUES ( '$input_name', '$input_age')";
        if (mysqli_query($link,  $sql)) {
            $msg = urlencode("Record saved successfully");
            header("location: index.php?msg=" . $msg);
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
        mysqli_close($link);
    }

    ?>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <fieldset>
                <legend>Personal Information:</legend>
                <table>
                    <tr>
                        <td>Name</td>
                        <td><input type="text" name="name"></td>
                    </tr>
                    <tr>
                        <td>Age</td>
                        <td><input type="number" name="age"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Save"></td>
                    </tr>
                </table>
                </legend>
            </fieldset>
        </form>
    </div>
</body>

</html>
