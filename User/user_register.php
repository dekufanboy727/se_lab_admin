
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home_style.css">
    <link rel="stylesheet" href="css/form_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" >   
    <title>Helf Coffee Official Website</title>
    <style>
        body{
            background-color: #e6d2c1;
        }

    </style>  
    
</head>
<body>
<?php
    include 'dbConnection.php'; //include connection to the db

    $email = $password = $name = $address = $phone = $password2 = "";
    $emailErr = $passwordErr = $password2Err = $nameErr = $addressErr = $phoneErr =  "";
    $error = "";
    $validate = true;


    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $name = test($_POST['name']);
        $email = test($_POST['email']);
        $phone = test($_POST['phone']);
        $address = test($_POST['address']);
        $password = test($_POST['password']);
        $password2 = test($_POST['password2']);

        if (empty($_POST["name"])) {
            $nameErr = "*Name is required!";
            $validate = false;
        }else{
            $name = test($_POST['name']);
        }

        if (empty($_POST["email"])) {
            $emailErr = "*Email is required!";
            $validate = false;
        }else{
            $email = test($_POST['email']);
        }

        if (empty($_POST["phone"])) {
            $phoneErr = "*Phone is required!";
            $validate = false;
        }else{
            $phone = test($_POST['phone']);
        }

        if (empty($_POST["address"])) {
            $addressErr = "*Address is required!";
            $validate = false;
        }else{
            $address = test($_POST['address']);
        }
    
        if (empty($_POST["password"])) {
            $passwordErr = "*Password is required!";
            $validate = false;
        }else{
            $password = test($_POST['password']);
        }

        if (empty($_POST["password2"])) {
            $password2Err = "*Please re-enter your password!";
            $validate = false;
        }else{
            $password2 = test($_POST['password2']);
        }

        if($password2!=$password){
            $password2Err = "*Passwords do not match!";
            $validate = false;
        }

        if($validate == true){

            $sql_check = "SELECT * FROM customer WHERE email = '$email'";
            $result = mysqli_query($conn,$sql_check);

            if(mysqli_num_rows($result) > 0){
                $emailErr = "*Email already taken, please choose another email";

            }else{
                $sql = mysqli_query($conn, "INSERT INTO customer(name,email,phone,address,password) VALUES('$name','$email','$phone','$address','$password')");
                header("location: user_login.php");

            }

            
        }   

    }

    function test($data){
            
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>    


    <div class="nav_bar">
        <div class="logo">
            <a href="index.php"><img src="images/helf_coffee_logo.png" alt="Helf Coffee Logo" style="width: 130px" href="index.html"></a>
        </div>

        <a href="user_login.php" class="login">Login</a>

        <nav class="pages">
            <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="menu_best_seller.php">Menu</a></li>
                <li><a href="#">Events</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>        
    </div>   
        <div class="container">
            <div class="title">Customer Registration</div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form" id="form">
                <div class="form-control">
                    <label>Name</label>
                    <input type="text" id="name" name="name" value="<?=$name?>" placeholder="Enter your full name">

                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $nameErr; ?></span>
                </div>
                <div class="form-control">
                    <label>Email</label>
                    <input type="text" id="email" name="email" value="<?=$email?>" placeholder="Enter your email">

                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $emailErr; ?></span>
                </div>
                <div class="form-control">
                    <label>Address</label>
                    <input type="text" id="address" name="address" value="<?=$address?>" placeholder="Enter your address">

                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $addressErr; ?></span>
                </div>
                <div class="form-control">
                    <label>Phone Number</label>
                    <input type="text" id="phone" name="phone" value="<?=$phone?>" placeholder="Enter your phone number starting with +60">

                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $phoneErr; ?></span>
                </div>

                <div class="form-control">
                    <label>Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password">

                    <i class="fa fa-eye" id="togglePassword" onclick="togglePassword()"></i>
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $passwordErr; ?></span>
                </div>
                <div class="form-control">
                    <label>Confirm Password</label>
                    <input type="password" id="password2" name="password2" placeholder="Re-enter your password">

                    <i class="fa fa-eye" id="togglePassword" onclick="togglePassword()"></i>
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $password2Err; ?></span>
                </div>
                
                <div class="button" id="button">
                <input type="submit" value="Register">
                </div>
                <div class="form-control"></div>
                <div class="form-control"></div>
            </form>    
        </div>


    <script type="text/javascript" src="js/userRegisterValidation.js"></script>
</body>
</html>
