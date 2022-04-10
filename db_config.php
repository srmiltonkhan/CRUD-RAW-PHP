<?php
$link = mysqli_connect('localhost', 'root', '', 'db_daily_expenses');

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}