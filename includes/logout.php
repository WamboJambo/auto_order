<?php
setcookie("loggedIn", "false", time() - 1, "/", "ao.jamescorsi.com");
setcookie("user", "", time() - 1, "/", "ao.jamescorsi.com");
unset($_SESSION['user']);
header("Refresh:0; url=/home/");
?>