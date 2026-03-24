<?php
session_start();
include 'db.php'; // Include database connection to fetch full user details

if(!isset($_SESSION['username'])){
    header("Location: login.html");
    exit();
}

// Fetch the user's fullname from the database
$username = $_SESSION['username'];
$sql = "SELECT fullname FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$fullname = "";

if ($result && mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $fullname = $row['fullname'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .simple-dashboard {
            width: 80%;
            max-width: 800px;
            background: white;
            color: #333;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        .simple-dashboard h2 {
            color: #333;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .btn-logout {
            display: inline-block;
            padding: 10px 20px;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }

        .btn-logout:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>

    <div class="simple-dashboard">
        <h2>Dashboard</h2>
        
        <p>
            Welcome, <strong><?php echo htmlspecialchars($fullname); ?></strong> (<?php echo htmlspecialchars($username); ?>).
        </p>

        <a href="logout.php" class="btn-logout">Logout</a>
    </div>

</body>
</html>
