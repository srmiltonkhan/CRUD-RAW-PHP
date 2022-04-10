<?php
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    require_once "db_config.php";
    $id =  $_GET['id'];
    $sql = "DELETE FROM `daily_expenses` WHERE id =  $id";

    if (mysqli_query($link, $sql)) {
        $msg = urlencode("Record delete successfully");
        header("location: index.php?msg=" . $msg);
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}