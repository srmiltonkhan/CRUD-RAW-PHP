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
    $expense_date = $expenses_head = $remark = $cost_amt = $id = "";
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $id = $_GET["id"];

        // Attempt select query execution
        $sql = "SELECT * FROM `daily_expenses` WHERE id = $id";
        $result = mysqli_query($link, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_array($result);
            $expense_date = $row['expense_date'];
            $expenses_head = $row['expenses_head'];
            $remark = $row['remark'];
            $cost_amt = $row['cost_amt'];
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $update_expense_date = $_POST['expense_date'];
        $update_expenses_head = $_POST['expenses_head'];
        $update_remark = $_POST['remark'];
        $update_cost_amt = $_POST['cost_amt'];

        $sql = "UPDATE `daily_expenses` SET `expense_date`='$update_expense_date',`expenses_head`='$update_expenses_head',`remark`='$update_remark',`cost_amt`='$update_cost_amt'  WHERE `id`= $id";
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
                        <td>Date</td>
                        <td><input type="date" name="expense_date" value="<?php echo  $expense_date?>" required=""></td>
                    </tr>
                     <tr>
                        <td>Name</td>
                        <td><input type="text" name="expenses_head" value="<?php echo  $expenses_head?>" required=""></td>
                    </tr>
                    <tr>
                        <td>remark</td>
                        <td> <textarea name="remark"><?php echo  $remark?></textarea> </td>
                    </tr>
                    
                    <tr>
                        <td>Daily Cost Amount:</td>
                        <td><input type="number" name="cost_amt" value="<?php echo  $cost_amt?>" required=""></td>
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
