<?php

include_once('connect.php');

/**
 * Makes a user account creation request and inserts into database if successful
 * 
 * @author James Corsi <jncorsi99@yahoo.com>
 */

$email = $_POST['email'];
$userPassword = $_POST['pass'];
$user = $_POST['user'];

// secure hashing of passwords using bcrypt, needs PHP 5.3+
// see http://codahale.com/how-to-safely-store-a-password/

// salt for bcrypt needs to be 22 base64 characters (but just [./0-9A-Za-z]), see http://php.net/crypt
$salt = substr(strtr(base64_encode(openssl_random_pseudo_bytes(22)), '+', '.'), 0, 22);

// 2y is the bcrypt algorithm selector, see http://php.net/crypt
// 12 is the workload factor (around 300ms on my Core i7 machine), see http://php.net/crypt
$hash = crypt($userPassword, '$2y$12$' . $salt);

// we can now use the generated hash as the argument to crypt(), since it too will contain $2y$12$... with a variation of the hash. No need to store the salt anymore, just the hash is enough!
// $hash == crypt($userPassword, $hash); // true
// $hash == crypt('bar', $hash); // false

if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error); 

$sql = 'INSERT INTO users VALUES ("' . $user . '","' . $email . '","' . $_POST['fname'] . '","' . $_POST['lname'] . '","' . $hash . '", "0")';

if ($conn->query($sql) === TRUE) {
    echo $_POST['fname'] . ' ' . $_POST['lname'] . ' created an account with username ' . $user . '. Thank you for registering with Auto Order! You will be redirected in a few moments; please check for a verification email to your registered email address to continue with account registration. If you do not see the email appear in your inbox, don\'t forget to check your spam messages and contact the <a href="mailto:james@jamesnc.me">webhost</a> if you still cannot find the email.';


    $pos = strpos($email, '@');
    $address = substr($email, $pos + 1);
 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$header = 'Account verification for ' . $_POST['fname'] . ' ' . $_POST['lname'];
$message = 'Thank you for creating an account at Auto Order! Please click <a href="http://ao.jamescorsi.com/verifyUser.php?user=' . $user . '">this verification link</a> to complete signup.';
$headers = 'From: mailer@plazabridge.me' . "\r\n" . 
    'Reply-To: mailer@plazabridge.me' . "\r\n" . 
    'X-Mailer: PHP/' . phpversion() . "\r\n" . 
    'Content-type:text/html; charset=utf-8' . "\r\n";

$mail = mail($email, $header, $message, $headers);
if ($mail) {
    echo '<br><br>Email sent successfully!';
} else {
    echo '<br><br>Email sending failed. Please contact the <a href="mailto:james@jamesnc.me">webhost</a>.';
}

$conn->close();

?>