<?php
header('Content-Type: application/json'); // Set header to return JSON strictly
include 'db.php';

$response = array('status' => 'error', 'message' => 'Unknown Error');

if(isset($_POST['register'])){

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check_user = "SELECT * FROM users WHERE email='$email' OR username='$username'";
    $result = mysqli_query($conn,$check_user);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        if ($row['email'] === $email) {
            $response['message'] = "Email already exists. Try another.";
        } else {
            $response['message'] = "Username is already taken. Try another.";
        }
    }else{
        $sql = "INSERT INTO `users`(`fullname`, `email`, `username`, `password`) 
        VALUES ('$fullname','$email','$username','$hashed_password')";

        if(mysqli_query($conn,$sql)){
            $response['status'] = 'success';
            $response['message'] = 'Registration Successful! Redirecting to login...';
        }else{
            $response['message'] = "Database Error: " . mysqli_error($conn);
        }
    }
}

echo json_encode($response);
exit();
?>
