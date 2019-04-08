<?php
  require_once('connectvars.php');

  $error_msg="";
  if (!isset($_COOKIE['user_id']) ) {

    if(isset($_POST['submit'])){
// Connect to the database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // Grab the user-entered log-in data
        $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
        if(!empty($user_username) && !empty($user_password)){
            $query="select user_id, username from mismatch_user where username='$user_username' and password=SHA('$user_password') ";
            $data=mysqli_query($dbc,$query);

            if(mysqli_num_rows($data)==1){
                $row=mysqli_fetch_array($data);
                $user_id = $row['user_id'];
                $user_name = $row['username'];
                setcookie('user_id',$user_id);
                setcookie('username',$user_name);
                $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
                header('Location: ' . $home_url);
        
            }else{
            // The username/password are incorrect so send the authentication headers
            $error_msg='<h2>Mismatch</h2>Sorry, you must enter a valid username and password to log in and access this page. If you ' .
                'aren\'t a registered member, please <a href="signup.php">sign up</a>.';
            }
        }else{
            $error_msg='Sorry, you must enter your username and password to log in and access this page.';    

        }
    }
  }
  ?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Mismatch - Log In</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <h3>Mismatch - Log In</h3>
    <?php 
        // Confirm the successful log-in
        if(empty($_COOKIE['user_id'])){
            echo '<p class="error">' . $error_msg . '</p>';    
?>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
            <legend>Log In</legend>
            <label for="username">Username:</label>
            <input type="text" name="username"
                value="<?php if (!empty($user_username)) echo $user_username; ?>" /><br />
            <label for="password">Password:</label>
            <input type="password" name="password" />
        </fieldset>
        <input type="submit" value="Log In" name="submit" />
    </form>

    <?php
        }
    else{
 // Confirm the successful log-in
 echo('<p class="login">You are logged in as ' . $_COOKIE['username'] . '.</p>');

    }
    
    ?> 
</body>

</html>