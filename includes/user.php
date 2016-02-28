<?php
session_start();


if (isset($_POST['todo']) && !empty($_POST['todo'])) {
    $todo = $_POST['todo'];

    switch ($todo) {
    case 'updateUname' : updateUname();
        break;
    case 'updateEmail' : updateEmail();
        break;
    case 'updatePass' : updatePass();
        break;
    default:
        echo 'Invalid option';
        break;
    }
}

function updateUname() {
    include_once('connect.php');

    if (isset($_POST['uname']) && !empty($_POST['uname'])) {
        $sql = 'UPDATE users SET uname="' . $_POST['uname'] . '" WHERE uname="' . $_SESSION['user'] . '"';
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION['user'] = $_POST['uname'];
            echo 0;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Malformed POST request.";
    }
}

function updateEmail() {
    include_once('connect.php');
    
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $sql = 'UPDATE users SET email="' . $_POST['email'] . '" WHERE uname="' . $_SESSION['user'] . '"';
        
        if ($conn->query($sql) === TRUE) {
            echo 0;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Malformed POST request.";
    }  
}

function updatePass() {
    include_once('connect.php');

    if (isset($_POST['pass']) && !empty($_POST['pass'])) {
        $salt = substr(strtr(base64_encode(openssl_random_pseudo_bytes(22)), '+', '.'), 0, 22);
        $hash = crypt($userPassword, '$2y$12$' . $salt);

        $sql = 'UPDATE users SET hash="' . $hash . '" WHERE uname="' . $_SESSION['user'] . '"';

        if ($conn->query($sql) === TRUE) {
            echo 0;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Malformed POST request.";
    }
}

?>