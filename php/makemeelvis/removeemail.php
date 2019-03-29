<?php
$dbc = mysqli_connect('localhost', 'root', 'root', 'elvis_store') or die("Error Connection");
$email = $_POST["email"];
$query = "Delete from email_list where 1=1 and " .
    "email ='" . $email . "'";
$result = mysqli_query($dbc, $query);
mysqli_close($dbc);
