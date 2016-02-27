<?php
setcookie("loggedIn", "false", time() - 1, "/", "ao.jamescorsi.com");
setcookie("user", "", time() - 1, "/", "ao.jamescorsi.com");
unset($_SESSION['user']);
unset($_SESSION['id']);
header("Refresh:0; url=/home/");
?>