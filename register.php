<?php
session_start();
?>
<!DOCTYPE html>
<head>
<!--[if lt IE 9]>
<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<meta charset="utf-8"/>
<title>File Sharing Site: Register</title>
<style>
body {
  width: 760px; /* how wide to make your web page */
  background-color: teal; /* what color to make the background */
  margin: 0 auto;
  padding: 0;
  font:12px/16px Verdana, sans-serif; /* default font */
}

div#main {
  background-color: #FFF;
  margin: 0;
  padding: 10px;
}
</style>
</head>
<body><div id="main">
<h1>Register</h1>

<?php
if (isset($_POST['username']) && !empty($_POST['username'])) {
    // username set, now check is it's a valid username
    $new_username = $_POST['username'];
    // check that username is valid
    // Get the username and make sure it is valid
    if (!preg_match('/^[\w_\-]+$/', $new_username)) {
        $safe_username = htmlentities($new_username);
        echo "<p><strong>$safe_username is invalid</strong></p>";
    } else {
        // valid user, try to add new user
        // http://php.net/manual/en/function.file-put-contents.php
        $user_file = 'users/users.txt';
        $content   = PHP_EOL . $new_username;
        if (file_put_contents($user_file, $content, FILE_APPEND | LOCK_EX) !== false) {
            // END CITATION
            $_SESSION['username'] = $new_username;
            header("Location: main.php");
            exit;
        } else {
            echo "Error: Could not write username $new_username to file";
        }
    }
} else {
    if (isset($_POST['username'])) {
        echo "<p><strong>Please enter a username</strong></p>";
    }
}
?>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
  <p>
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required />
  </p>
  <p>
    <input type="submit" value="Register" />
  </p>
</form>

<p><a href="login.php">Log In</a></p>

</div></body>
</html>
