<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot</title>
    <link rel="stylesheet" href="forgot.css">
</head>
<body>
    <div class="logo">
        <img src="amslogo.png" alt="amshuhu" width="80px" height="80px">
    </div>

    <div class="container">
 
        <form action="" method="post">
        <div class="heading">
            <h2>FORGOT PASSWORD</h2>
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
        <div class="resetform">
            <label for="#">Emailid</label>
            <input type="email" placeholder="enter email" name="email" id="emailidforgot">
             
        </div>
        <div class="resetform">
            <label for="#">New password</label>
            <input type="password" placeholder="enter new password" name="newpassword" id="newpassword">
           
        </div>
        <div class="resetform">
            <label for="#">confirm password</label>
            <input type="password" placeholder="Re-enter password" name="confirmpassword" id="confirmnewpassword">
            
        </div>
        <button class="resetbutton" name="submit" type="submit">Submit</button>
        <span class="newuser">Remember?<a href="one.php">login now</a></span>
        </form>
    </div>
</body>
</html>

<?php
session_start();
include("sql.php");

if(isset($_POST['submit'])){
	$email = $_POST['email'];
	$password = $_POST['newpassword'];
    $confirmpass = $_POST['confirmpassword'];
    
    $stmt = $conn->prepare("SELECT * FROM signupphp WHERE email=:email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $count = $stmt->rowCount();
        

	if(empty($email)||empty($password)||empty($confirmpass))
	{
		$_SESSION['error'] = "All fields are required";
		
	}
    elseif($count<=0){
        $_SESSION['error'] = "Invalid email";
		
    }
    elseif ($password != $confirmpass)
	 {
        $_SESSION['error'] = "Password does not match";
    
    }
    else
    {
  
        $sql = "UPDATE signupphp SET password=:password WHERE email=:email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $_SESSION['success'] = "password changed";

	}
       header('Location: forgot.php');
    }

?>

