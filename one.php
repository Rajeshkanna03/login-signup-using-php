
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>amshuhu login</title>
    <link rel="stylesheet" href="one.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	
<!-- // 		function myfunction(){
//     const x=document.getElementById("password");
//     if(x.type==='password'){
//         x.type="text";
//     }
//     else{
//         x.type="password";
// 	}
// } -->
</head>
<body>
    <nav>
        <div class="brand">
            <img src="amslogo.png" alt="amshuhu" width="50px" height="45px"></div>
        <div class="menu">
            
            <a href="signup.php">Signup</a>
            <a href="one.php">Login</a>
          
        </div>
    </nav>
        <div class="container">
        <div class="loginform">
        <h2>LOGIN HERE</h2>
        </div> 
		<?php 
session_start(); 
if(isset($_SESSION['error'])) {
    echo '<div class="errordanger">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']); 
} else if(isset($_SESSION['success'])) {
    echo '<div class="errorsuccess">'.$_SESSION['success'].'</div>';
    unset($_SESSION['success']); 
}
?>
            <form class="form" action="" method="post" id="form">
                <div class="inputfield">
                    <div class="labeling">
                    <label for="emailid">Email</label>
                </div>
                    <input type="email" placeholder="enter email" name="emailid" id="emailid">
                </div>
                <div class="inputfield">
                    <div class="labeling">
                    <label for="password" >Password</label>
                </div>
                    <input type="password" placeholder="enter password" name="mypassword" id="password">   
                </div>
                <div class="showpassword">
                    <label>Show Password</label>
                    <input type="checkbox" onclick="myfunction()">
                </div>
                <div  class="forgot">
                    <a href="forgot.php">Forgot password?</a>
                </div>
                    <button type="submit" name="submit" class="button">Login</button>
                    <span class="newuser">New user?<a href="signup.php">Signup</a></span>
                
            </form>
    </div>
</body>
</html>

<?php
session_start();
include('sql.php');


if(isset($_POST['submit'])){
	$email = $_POST['emailid'];
	$password = $_POST['mypassword'];

	if(empty($email)||empty($password))
	{
		$_SESSION['error'] = "All fields are required";
		header('Location: one.php');
	}
   
	$stmt = $conn->prepare("SELECT * FROM signupphp WHERE email=:email");
    $stmt->bindParam(':email',$email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();

    if($count > 0 && password_verify($password,$row['password'])){
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        header('Location: home.php');
    }else{
        $_SESSION['error'] = "Invalid email or password!";
        header('Location: one.php');
        
    }
}
exit();
?>

