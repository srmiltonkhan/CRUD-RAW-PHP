<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Md. Milton Khan">
    <title>View Record</title>
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
    ?>
    <div class="container">
            <fieldset>
                <legend>Personal Expense View:</legend>
                <table>
                    <tr>
                        <td>Date</td>
                        <td><?php echo $expense_date;?></td>
                    </tr>
                     <tr>
                        <td>Name</td>
                        <td><?php echo $expenses_head;?></td>
                    </tr>
                    <tr>
                        <td>remark</td>
                         <td><?php echo $remark;?></td>
                    </tr>
                    
                    <tr>
                        <td>Daily Cost Amount:</td>
                        <td><?php echo $cost_amt;?></td>
                    </tr>
                    <tr>
                    	<td><a href="index.php">Go Home</a></td>
                    </tr>
                </table>
                </legend>
            </fieldset>
    </div>
</body>

</html>
