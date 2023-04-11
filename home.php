<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <?php
session_start(); 
?>
    <nav>
        <div class="brand">
        <img src="amslogo.png" alt="amshuhu" width="50px" height="45px"></div>
        <div class="menu">
            <a href="home.php">Home</a>
            <a href="signup.php">Signup</a>
            <a href="one.php">Login</a>
            <a href="profile.php">Profile</a>
            <a href="#">Logout</a>
        </div>
    </nav>
    <div class="homecontain">
        <h2>WELCOME <?php echo $_SESSION['username'];  ?></h2>
    </div>
    
</body>
</html>