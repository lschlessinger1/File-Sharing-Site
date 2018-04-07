<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit; // we call exit here so that the script will stop executing before the connection is broken
} else {
    $username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<head>
<!--[if lt IE 9]>
<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<meta charset="utf-8"/>
<title>File Sharing Site: Main</title>
<style>
body {
  width: 760px; /* how wide to make your web page */
  background-color: teal; /* what color to make the background */
  margin: 0 auto;
  padding: 0;
  font:12px/16px Verdana, sans-serif; /* default font */
}

div#main{
  background-color: #FFF;
  margin: 0;
  padding: 10px;
}

h1#lead {
  text-align: center;
}

a#delete-files {
  float: right;
  text-decoration: none;
  padding: 5px;
  color: red;
  margin-right: 10px;
}

a#logout {
  float: right;
  /*  https://www.w3schools.com/css/css_border.asp */
  border: 2px solid gray;
  border-radius: 5px;
  text-decoration: none;
  padding: 5px;
  /* END CITATION */
}

td {
  padding:  10px 25px 10px 25px;
}
</style>
</head>
<body><div id="main">
  <div id="header">
      <h1 id="lead">File Sharing Site</h1>
      <p>Hello, <?php echo $username; ?>!</p>
      <a id="logout" href="logout.php">Log out</a>
      <a id="delete-files" href="delete_files.php">Delete all files</a>
  </div>
  <br>
  <div id="file-upload">
    <h2>Upload File</h2>
    <form enctype="multipart/form-data" action="uploader.php" method="POST">
      <p>
        <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
        <label for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadfile_input" required />
      </p>
      <p>
        <input type="submit" value="Upload File" />
      </p>
    </form>
  </div>
  <br>
  <div id="user-files">
      <h2>Files</h2>
        <!-- https://www.w3schools.com/html/html_tables.asp -->
        <table>
          <tr>
            <th>File name (click to view)</th>
            <th>Delete</th>
          </tr>

          <?php
          $num_files = 0;
          // https://www.w3schools.com/php/func_directory_readdir.asp
          $format = "/srv/uploads/%s";
          $dir_path  = sprintf($format, $username);
          if (is_dir($dir_path)) {
              if ($dh = opendir($dir_path)) {
                  while (($file = readdir($dh)) !== false) {
                      if ($file == "." || $file == "..") {
                          continue;
                      }
                      echo "<tr>";
                      echo "<td><a href='view.php?f=" . htmlentities($file) . "'>" . htmlentities($file) . "</a></td>";
                      echo "<td><a href='delete.php?f=" . htmlentities($file) . "'>Delete</a></td>";
                      echo "</tr>";
                      $num_files++;
                  }
                  closedir($dh);
              }
          }
          // END CITATION
          ?>
        </table>
        <!-- END CITATION -->
        <p>
        <?php
        if ($num_files == 0) {
            echo "Try uploading some files";
        } else {
            echo "You have $num_files file(s).";
        }
        ?>
        </p>
  </div>

</div></body>
</html>
