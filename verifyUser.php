<?php
include_once('includes/connect.php');
$user = $_GET['user'];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die ("Connection failed: " . $conn->connect_error);
}

$sql = 'UPDATE users SET verified=1 WHERE uname="' . $user . '"';

if ($conn->query($sql) === TRUE) {
    echo 'Verification successful!  Welcome to the community!';
    echo '<script type="text/javascript">
    setTimeout(function() {
      window.location.href="/"
    }, 2000);
    </script>';
}
else {
    echo 'Error: ' . $sql . '<br>' . $conn->error . '<br><br>Please contact the <a href="mailto:james@jamesnc.me">webmaster</a>.';
}
?>