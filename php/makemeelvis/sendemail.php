<?php
if (!empty($suject) && !empty($elvismail)) {
    $dbc = mysqli_connect('localhost', 'root', 'root', 'elvis_store') or die("Error Connection");
    $query = "select * from email_list";
    $result = mysqli_query($dbc, $query);

    $suject = $_POST["subject"];
    $elvismail = $_POST["elvismail"];

    while ($rows = mysqli_fetch_array($result)) {
        $firstname = $rows["first_name"];
        $last_name = $rows["last_name"];
        $email = $rows["email"];
        mail($email, $suject, $elvismail);
    }
    mysqli_close($dbc);
} else {
}
