<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>amshuhu signup</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	
	<!-- // 	function myfunction(){
    // const x=document.getElementById("password");
    // const y=document.getElementById("confirmpassword");
    // if(x.type==='password'){
    //     x.type="text";
    // }
    // else{
    //     x.type="password";
    // }
    // if(y.type==='password'){
    //     y.type="text";
    // }
    // else{
    //     y.type="password";
    // }
    
    
} -->
	
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
        <h2>CREATE NEW USER</h2>
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
                    <label for="username" >Username</label>
                </div>
            
                    <input type="text" placeholder="enter name" name="username" id="username" >
                  
                </div>
                <div class="inputfield">
                    <div class="labeling">
                    <label for="emailid" >Email</label>
                </div>
             
                    <input type="email" placeholder="enter email" name="emailid" id="emailid">
                
                </div>
                <div class="inputfield">
                    <div class="labeling">
                    <label for="password" >Password</label>
                </div>
               
                    <input type="password" placeholder="enter password" name="password" id="password">
                    
                    <div class="showpassword">
                        <label>Show Password</label>
                        <input type="checkbox" onclick="myfunction()" id="showpassword" >
                    </div> 
                </div>
                
                <div class="inputfield">
                    <div class="labeling">
                    <label for="confirmpassword" >Confirm Password</label>
                </div>
               
                    <input type="password" placeholder="Re-enter password" name="confirmpassword" id="confirmpassword">
                      
                </div>
                
                
                    <button type="submit" name="submit"   class="button" >Signup</button>
                    <span>Already a user?<a href="one.php">login</a></span>
                
            </form>
    </div>
    <!-- <script src="signup.js"></script> -->
</body>
</html>

<?php
session_start();
include("sql.php");

if(isset($_POST['submit'])){
	$name = $_POST['username'];
	$email = $_POST['emailid'];
	$password = $_POST['password'];
	$confirmpassword = $_POST['confirmpassword'];
     
	$stmt = $conn->prepare("SELECT * FROM signupphp WHERE email=:email");
 $stmt->bindParam(':email',$email);
 $stmt->execute();
 $count = $stmt->fetchColumn();
    
    if(empty($name)||empty($email)||empty($password)||empty($confirmpassword))
	{
		$_SESSION['error'] = "All fields are required";
	}
    elseif($count > 0)
	 {
        $_SESSION['error'] = "Email already exists";
    } 
	elseif ($password != $confirmpassword)
	 {
        $_SESSION['error'] = "Password does not match.";
    }else{
	
    // $password = "my_password";
    $hashpassword = password_hash($password, PASSWORD_DEFAULT);
	$sql ="INSERT INTO signupphp (name, email, password)
  VALUES ('$name','$email','$hashpassword')";
 
  $conn->exec($sql);
  $_SESSION['success'] = "Signup successful!";
	}
header('Location: signup.php');
exit();
}
?>