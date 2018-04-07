<?php
session_start();

// Get the filename and make sure it is valid
$filename = basename($_FILES['uploadedfile']['name']);
if (!preg_match('/^[\w_\.\-]+$/', $filename)) {
    echo "Invalid filename";
    exit;
}

// Get the username and make sure it is valid
$username = $_SESSION['username'];
if (!preg_match('/^[\w_\-]+$/', $username)) {
    echo "Invalid username";
    exit;
}

// https://stackoverflow.com/questions/2303372/create-a-folder-if-it-doesnt-already-exist
$dir_path = sprintf("/srv/uploads/%s", $username);
if (!file_exists($dir_path)) {
    mkdir($dir_path, 0777, true);
}
// END CITATION
$format = "/srv/uploads/%s/%s";
$full_path = sprintf($format, $username, $filename);

if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path)) {
    header("Location: upload_success.html");
    exit;
} else {
    echo $_FILES['uploadedfile']['error'];
    header("Location: upload_failure.html");
    exit;
}
?>
