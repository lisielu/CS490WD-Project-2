<?php
include 'connection.php';
$return = "fail"; //the value that is returned to Ajax

if (isset($_POST['name']) && isset($_POST['password'])) {
    $username = $_POST['name'];
    $password = md5($_POST['password']); //sencrypt it
    
    $stupid= $connection;

    $query = "SELECT * FROM Customer WHERE ID='" . $username . "' AND Password='" . $password . "'";
    $result = mysqli_query($connection,$query);
    if ($result) {
        $row_count = mysqli_num_rows($result);
        if ($row_count == 1) { //start a session
            $row = mysqli_fetch_array($result);
            session_start(); //we start a session
            $_SESSION['start'] = time(); 
            $_SESSION["username"] = $row["ID"];  
            ini_set('session.use_only_cookies',1); 
            $return=  "success"; //login succeeded
        }
    }
}

    echo $return;
