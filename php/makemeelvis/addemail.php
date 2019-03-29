<?php
$dbc = mysqli_connect('localhost', 'root', 'root', 'elvis_store') or die("Error Connection");

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$query = "insert into email_list(first_name,last_name,email)" .
    "Values('$firstname','$lastname','$email')";
$result = mysqli_query($dbc, $query);

echo $firstname;
mysqli_close($dbc);
