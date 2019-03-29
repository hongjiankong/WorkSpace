<?php
if (isset($_POST['Submit'])) {
    $suject = $_POST["subject"];
    $elvismail = $_POST["elvismail"];
    $output_form = false;
    if (!empty($suject) && !empty($elvismail)) {
        $dbc = mysqli_connect('localhost', 'root', 'root', 'elvis_store') or die("Error Connection");
        $query = "select * from email_list";
        $result = mysqli_query($dbc, $query);

        while ($rows = mysqli_fetch_array($result)) {
            $firstname = $rows["first_name"];
            $last_name = $rows["last_name"];
            $email = $rows["email"];
            mail($email, $suject, $elvismail);
        }
        mysqli_close($dbc);
    } else {
        $output_form = true;
    }

    if ($output_form) {
        ?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <label for="subject">Subject of email:</label><br />
    <input id="subject" name="subject" type="text" size="30" value="<?php echo $suject;?>" /><br />
    <label for="elvismail">Body of email:</label><br />
    <textarea id="elvismail" name="elvismail" rows="8" cols="40">
        <?php echo $elvismail; ?>
    </textarea><br />
    <input type="submit" name="Submit" value="Submit" />
  </form>
<?php
    }
}
