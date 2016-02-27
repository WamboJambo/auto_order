<?php
session_start();

$uri = 'http://api.reimaginebanking.com/customers';
$api_key = '82df350d52cc505131c0b3393130ed4c';

/**
 * Contains all customer account related calls for the Capital One API to make it more AJAX accessible
 *
 * @author James Corsi <jncorsi99@yahoo.com>
 */

if (isset($_POST['todo']) && !empty($_POST['todo'])) {
    $todo = $_POST['todo'];

    switch ($todo) {
    case 'createAccount' : createAccount();
        break;
    case 'getAccount' : getAccount();
        break;
    case 'updateAccount' : updateAccount();
        break;
    default:
        echo 'Invalid option';
        break;
    }
}

function createAccount() {
    
}

function getAccount() {
    include_once('../connect.php');
    $sql = 'SELECT bank_id FROM users WHERE uname="' . $_SESSION['user'] . '"';

    $query = $conn->query($sql);
    $query = $query->fetch_array();

    if ($query['bank_id'] === NULL) {
        echo 'No account on record';
    } else {
        $url = ($GLOBALS['uri'] . '/' . $query['bank_id'] . '?key=' . $GLOBALS['api_key']);
        echo $url;
        $response = file_get_contents($url);
        if ($response)
            echo $response;
        else 
            echo 'Invalid ID';
    }
}

function updateAccount() {

}

?>