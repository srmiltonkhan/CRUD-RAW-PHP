<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Md. Milton Khan">
    <title>Personal Expense App</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    require_once "db_config.php";
    // Attempt select query execution
    $sql = "SELECT * FROM  daily_expenses";

    if ($result = mysqli_query($link, $sql)) {
        ?>
            <div class="container">
           <button class="btn"> <a href="create.php">Add</a></button>
        <?php

        if (mysqli_num_rows($result) > 0) {
    ?>

        <?php
                if (isset($_GET['msg'])) {
                    echo '<span style="color: orangered; font-weight: bold;">' . $_GET['msg'] . '</span>';
                }
                ?>
     
        <table>
            <thead>
                <th>SL</th>
                <th>Date</th>
                <th>Expense Head</th>
                <th>Remark</th>
                <th>Cost Amount</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                        $body_data = "";
                        $i=1;
                        while ($row = mysqli_fetch_array($result)) {
                            $body_data .= '<tr>';
                            $body_data .= '<td>' . $i. '</td>';
                            $body_data .= '<td>' . $row['expense_date'] . '</td>';
                            $body_data .= '<td>' . $row['expenses_head'] . '</td>';
                            $body_data .= '<td>' . $row['remark'] . '</td>';
                            $body_data .= '<td>' . $row['cost_amt'] . '</td>';
                            $body_data .= '<td>
                                                <button><a href="view.php?id=' . $row['id'] . '"  title="View Record">View </a> </button>
                                                <button> <a href="update.php?id=' . $row['id'] . '"  title="Edit Record">Edit </a></button>
                                                <button><a href="delete.php?id=' . $row['id'] . '"  title="Delete Record">Delete </a> </button>
                                            </td>';
                            $body_data .= '</tr>';
                             $i++;
                        }
                        echo $body_data;
                       
                        ?>
            </tbody>
        </table>
    </div>
    <?php
            // Free result set
            mysqli_free_result($result);
        } else {
            echo '<div class="danger">No Record Found</div>';
        }
    } else {
        echo '<div class="danger">Something Wrong</div>';
    }
    // Close connection
    mysqli_close($link);
    ?>

</body>

</html>
