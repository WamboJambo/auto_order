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
    include_once('../connect.php');
    $sql = 'SELECT fname, lname FROM users WHERE uname="' . $_SESSION['user'] . '"';

    $query = $conn->query($sql);
    $query = $query->fetch_array();
    
    $address = $_POST['address'];

    $data = json_encode(array("first_name" => $query['fname'], "last_name" => $query['lname'], "address" => array("street_number" => $address[0], "street_name" => $address[1], "city" => $address[2], "state" => $address[3], "zip" => $address[4])));

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, ($GLOBALS['uri'] . '?key=' . $GLOBALS['api_key']));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_HEADER, FALSE);
    curl_setopt($curl, CURLOPT_POST, TRUE);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    $response = json_decode(curl_exec($curl), true);
    curl_close($curl);

    if ($response['message'] == "Customer created") {
        echo 0;
        $sql = 'UPDATE users SET bank_id="' . $response['objectCreated']['_id'] . '" WHERE uname="' . $_SESSION['user'] . '"';
        $query = $conn->query($sql);
    } else {
        echo $response['message'];
    }
    
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
        $response = file_get_contents($url);
        if ($response)
            echo $response;
        else 
            echo 'Invalid ID';
    }
}

function updateAccount() {
    include_once('../connect.php');
    $sql = 'SELECT bank_id FROM users WHERE uname="' . $_SESSION['user'] . '"';

    $query = $conn->query($sql);
    $query = $query->fetch_array();

    $address = $_POST['address'];

    $data = json_encode(array("address" => array("street_number" => $address[0], "street_name" => $address[1], "city" => $address[2], "state" => $address[3], "zip" => $address[4])));

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, ($GLOBALS['uri'] . '/' . $query['bank_id'] . '?key=' . $GLOBALS['api_key']));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_HEADER, FALSE);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    $response = json_decode(curl_exec($curl), true);
    curl_close($curl);

    if ($response['message'] == "Accepted customer update") {
        echo 0;
    } else {
        echo $response['message'];
    }

}

?>