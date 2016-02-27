<?php
session_start();

include_once('connect.php');

$conn->select_db("ao");

$user = strtolower($_POST["user"]);
$query = ('SELECT hash, verified FROM users WHERE (uname = "' . $user . '")');

$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $userHash = $row["hash"];
    $veri = $row["verified"];
}


if ($userHash != crypt($_POST["pass"], $userHash)) {
    echo 0;
}
else if ($veri == 0) {
    echo 1;
}
else if(($userHash == crypt($_POST["pass"], $userHash)) && $veri == 1) {
    $expiry = time() + (60 * 60 * 24 * 7); // 7 day expiry on cookies
    setcookie("loggedIn", "true", $expiry, "/", "ao.jamescorsi.com");
    setcookie("user", $_POST["user"], $expiry, "/", "ao.jamescorsi.com");
    $_SESSION['user'] = $_POST['user'];
    echo 2;
}

$conn->close();
?>