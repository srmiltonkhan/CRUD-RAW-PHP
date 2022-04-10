<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Md. Milton Khan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Record</title>
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
        $expense_date = $_POST['expense_date'];
        $expenses_head = $_POST['expenses_head'];
        $remark = $_POST['remark'];
        $cost_amt = $_POST['cost_amt'];

        $sql = "INSERT INTO `daily_expenses`(`expense_date`, `expenses_head`, `remark`, `cost_amt`) VALUES ('$expense_date','$expenses_head','$remark','$cost_amt')";
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
                <legend>Personal Daily Expense:</legend>
                <table>
                    <tr>
                        <td>Date</td>
                        <td><input type="date" name="expense_date" required=""></td>
                    </tr>
                     <tr>
                        <td>Name</td>
                        <td><input type="text" name="expenses_head" required=""></td>
                    </tr>
                    <tr>
                        <td>remark</td>
                        <td> <textarea name="remark"></textarea> </td>
                    </tr>
                    
                    <tr>
                        <td>Daily Cost Amount:</td>
                        <td><input type="number" name="cost_amt" required=""></td>
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
