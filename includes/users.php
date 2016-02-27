<?php

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
include_once('connect.php');

$sql = 'SELECT uname, email FROM users';

if ($conn->connect_error)
    die("Failed to load user data: " . $conn->connect_error);

if ($query = $conn->query($sql)) {
    $a = array(json_encode($query->fetch_array()));
    while ($row = $query->fetch_array())
        array_push($a, json_encode($row));
}

echo json_encode($a);
} else {
    echo 'Access forbidden.';
}

?>