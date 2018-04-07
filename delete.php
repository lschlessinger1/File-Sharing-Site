<?php
session_start();

$filename = $_GET['f'];
$username = $_SESSION['username'];
$file     = sprintf("/srv/uploads/%s/%s", $username, $filename);
//https://www.w3schools.com/php/func_filesystem_unlink.asp
if (unlink($file)) {
    //  END CITATION
    header("Location: main.php");
    exit; // we call exit here so that the script will stop executing before the connection is broken
} else {
    echo ("Error deleting $file");
}
?>
