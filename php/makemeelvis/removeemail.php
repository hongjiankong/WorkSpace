<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Make Me Elvis - Remove Email</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
    <img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
    <p>Enter an email address to remove.</p>
    <?php
    $action=$_SERVER["PHP_SELF"];
    ?>
    <form method="post" action="<?php echo $action;?>">
        <?php
$dbc = mysqli_connect('localhost', 'root', 'root', 'elvis_store') or die("Error Connection");

if(isset($_POST["Remove"])){
foreach ($_POST["todelete"] as $deleteId) {
   $query = "Delete from email_list where 1=1 and " .
       "id =$deleteId";
   $result = mysqli_query($dbc, $query);
}
}


$query = "select * from email_list";
$result = mysqli_query($dbc, $query);
while($row=mysqli_fetch_array($result)){
echo  "<input type='checkbox' value='".$row["id"]."' name='todelete[]'>";
echo $row["first_name"];
echo '      '.$row["last_name"];
echo '      '.$row["email"];
echo "</br>";
}

mysqli_close($dbc);
 ?>
        <input type="submit" name="Remove" value="Remove" />
    </form>
</body>

</html>