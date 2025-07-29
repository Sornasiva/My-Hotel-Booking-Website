<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<style>
    body{
    margin: 0px;
    padding: 0px;
    height: 100vh;
    background-repeat: no-repeat;
    background-image: url("registerbgimage.jpg");
    background-size: cover;
    background-position: center;
    display: flex;
    font-family: Arial, sans-serif;
}
.header1{
    width: 100vw;
    height: 100px;
    /* background-color: darkturquoise; */
    color: red;
    cursor: pointer;
    text-align: center;
    position: fixed;
    margin-top: 0px;
    padding: 2px;
    font-weight: 60px;
    font-size: 30px;
}
.container{
     width: 500px;
    height: 470px;
    position: relative;
    background-color: rgba(245, 245, 245, 0.514);
    margin-top: 140px;
    margin-left: 390px;
    position: fixed;
    /* opacity: 0.6; */
}
.container form{
    text-align: justify;
    font-weight: 32px;
    padding: 100px;
    font-size: 20px;
}
.container form input{
    width: 170px;
    height: 20px;
}
.container form button{
    position: relative;
    height: 60px;
    width: 160px;
    margin: 50px;
    margin-left: 70px;
    margin-top: 20px;
    color: white;
    font-weight: bold;
    font-size: 18px;
    background-color: orangered;
    border-radius: 20px;
}
.links{
    margin-top: 16px;
    display: flex;
    /* justify-content: space-between; */
}
.links a{
    text-decoration: none;
    color: darkblue;
    font-size: 18px;
}
.links a:hover{
    text-decoration: underline;
}
</style>
<?php
    $emailErr = "";
    $passwordErr = "";
    $email = "";
    $password = "";
    $success = "";
?>
<body>
    <div class="header1">
        <h1>Hotel Booking Login Page</h1>
    </div>
    <div class="container">
         <p style="color: green;"><?php  echo $success; ?></p>
        <form onsubmit="return validateForm()" novalidate method="POST">
            <strong>Email_ID : </strong><input type="email" name="email" placeholder="Your Valid Email" required><br><br>
            <span style="color: red;">*<?php echo $emailErr; ?></span><br>
            <strong>Password : </strong><input type="password" name="password" placeholder="Your Password" required><br><br>
            <span style="color: red;">*<?php echo $passwordErr; ?></span><br>
            <button type="submit">Login</button>
            <div class="links">
                <a href="forgotpwd.html">Forgot Password?</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="register.php">Register</a>
            </div>
        </form>
    </div>
</body>
<script>
    function validateForm()
    {
        const email = document.getElementById("email");
        const password = document.getElementById("password");

        if(!email.value || !password.value)
        {
            email.setCustomValidity("Please enter your email.");
            email.reportValidity();
            return false;
        }
        else
        {
            email.setCustomValidity("");
        }
        return true;
    }
</script>
</html>
<?php
    session_start();
    include 'config/db.php';
    $emailErr = "";
    $passwordErr = "";
    $email = "";
    $password = "";
    $success = "";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $valid = true;
        if(empty($_POST["email"]))
        {
            $emailErr = "Email is required";
            $valid = false;
        }
        elseif(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)) //check email format 
        {
            $emailErr = "Invalid Email Format";
            $valid = false;
        }
        else
        {
            $email = trim($_POST["email"]);
        }

        if(empty($_POST["password"]))
        {
            $passwordErr = "Password is required";
            $valid = false;
        }
        else
        {
            $password = password_hash($_POST["password"],PASSWORD_DEFAULT);
        }
        if($valid)
        {
            $stmt = $conn->prepare("Insert into login (email,password) values (?,?)");
            $stmt->bind_param("ss",$email,$password);
            if($stmt->execute())
            {
                $success = "Login Successfully";
            }
            else
            {
                $emailErr = "Email Already Exists or error occured";
            }
        }
    }
?>