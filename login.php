<?php
session_start();
header('Content-Type: application/json'); // Return JSON for AJAX
include 'db.php';

$response = array('status' => 'error', 'message' => 'Unknown Error');

if(isset($_POST['login'])){

    $user = $_POST['user'];
    $password = $_POST['password'];

    // Using prepared statements is usually better, but keeping your logic identical
    $sql = "SELECT * FROM users WHERE username='$user' OR email='$user'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) == 1){

        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row['password'])){
            $_SESSION['username'] = $row['username'];
            $response['status'] = 'success';
            $response['message'] = 'Login Successful! Redirecting...';
            $response['redirect'] = 'welcome.php';
        }else{
            $response['message'] = "Incorrect Password";
        }

    }else{
        $response['message'] = "User not found";
    }

}

echo json_encode($response);
exit();
?>
