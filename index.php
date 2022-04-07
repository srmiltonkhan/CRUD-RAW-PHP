<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operation Row PHP</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    require_once "db_config.php";
    // Attempt select query execution
    $sql = "SELECT * FROM  person_info";

    if ($result = mysqli_query($link, $sql)) {

        if (mysqli_num_rows($result) > 0) {
    ?>
    <div class="container">
        <?php
                if (isset($_GET['msg'])) {
                    echo '<span style="color: orangered; font-weight: bold;">' . $_GET['msg'] . '</span>';
                }
                ?>
        <button class="btn"> <a href="create.php">Add</a></button>
        <table>
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                        $body_data = "";
                        while ($row = mysqli_fetch_array($result)) {
                            $body_data .= '<tr>';
                            $body_data .= '<td>' . $row['id'] . '</td>';
                            $body_data .= '<td>' . $row['name'] . '</td>';
                            $body_data .= '<td>' . $row['age'] . '</td>';
                            $body_data .= '<td>
                                                <button> <a href="update.php?id=' . $row['id'] . '"  title="Edit Record">Edit </a></button>
                                                <button><a href="delete.php?id=' . $row['id'] . '"  title="Delete Record">Delete </a> </button>
                                            </td>';
                            $body_data .= '</tr>';
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