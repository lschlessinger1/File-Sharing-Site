<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: main.php");
    exit; // we call exit here so that the script will stop executing before the connection is broken
}
?>
<!DOCTYPE html>
<head>
<!--[if lt IE 9]>
<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<meta charset="utf-8"/>
<title>File Sharing Site: Login</title>
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
<h1>Log In</h1>
<?php
if (isset($_POST['username']) && !empty($_POST['username'])) {
    // username set, now check is it's a valid username
    $username_guess = $_POST['username'];

    $h = fopen("users/users.txt", "r");
    while (!feof($h)) {
        $username = trim(fgets($h));
        if ($username_guess == $username) {
            // valid user; success
            $_SESSION['username'] = $username;
            fclose($h);
            header("Location: main.php");
            exit; // we call exit here so that the script will stop executing before the connection is broken
        }
    }
    fclose($h);
    // invalid username
    $safe_username = htmlentities($username_guess);
    echo "<p><strong>$safe_username is an invalid username</strong></p>";
} else {
    if (isset($_POST['username'])) {
        echo "<p><strong>Please enter a username</strong></p>";
    }
}
?>

<form method="POST">
  <p>
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required/>
  </p>
  <p>
    <input type="submit" value="Log in" />
  </p>
</form>
<p><a href="register.php">Register</a></p>

</div></body>
</html>
