<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit; // we call exit here so that the script will stop executing before the connection is broken
} else {
    $current_username = $_SESSION['username'];
}

// https://www.w3schools.com/php/func_directory_readdir.asp
$dir_path = sprintf("/srv/uploads/%s", $current_username);
if (is_dir($dir_path)) {
    if ($dh = opendir($dir_path)) {
        while (($file = readdir($dh)) !== false) {
            if ($file == "." || $file == "..") {
                continue;
            }
            // delete file
            unlink($dir_path . '/' . $file);
        }
        closedir($dh);
    }
}
// END CITATION

header("Location: main.php");
?>
