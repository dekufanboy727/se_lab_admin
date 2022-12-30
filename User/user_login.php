<?php
    session_start();
    
 ?>
 

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

    //Declarations
    $email = $pass = "";
    $emailErr = $passErr = "";
    $error = "";

    //Validate the form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Validate email
        if (empty($_POST["email"])) {
            $emailErr = "*Email is required!";
        } else {
            $email = $_POST["email"];
        }

        //Validate Password
        if (empty($_POST["pass"])) {
            $passErr = "*Password is required!";
        } else {
            $pass = test($_POST["pass"]);
        }
    }

    function test($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (!empty($_POST["email"]) && !empty($_POST["pass"])) {
        $sql = "SELECT * FROM customer WHERE email ='$email' AND password ='$pass'"; //Find the customer acc
        $result = mysqli_query($conn,$sql); //Check is it exists
        
        if (mysqli_num_rows($result) == 1) {

            while($result2 = mysqli_fetch_assoc($result)){
                $_SESSION['id'] = $result2['id'];
            }
            
            $_SESSION['logged_in'] = true;
            header("Location: index.php");
            
        } else {
            //echo "Login unsuccessful";
            $error = "Incorrect email or password! Please try again.";
        }
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
            <div class="title">Log In</div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form" id="form">
                <div class="form-control">
                    <label>Email</label>
                    <input type="text" id="email" name="email" placeholder="Enter your email">
                    <div class="icon">
                        
                    </div>
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $emailErr; ?></span>
                </div>
                <div class="form-control">
                    <label>Password</label>
                    <input type="password" id="pass" name="pass" placeholder="Enter your password" title="Must contain one uppercase, one lower case, one special character ( ! @ # $ % ^ & * ), numbers and no space, and at least 6 digits length">
                    
                    <i class="fa fa-eye" id="togglePassword" onclick="togglePassword()"></i>
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $passErr; ?></span>
                </div>
                <div class="form-control" style="margin: 0;">
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $error; ?></span>
                </div>

                <div class="button" id="button">
                    <input type="submit" value="Log In">
                </div>
                <div class="form-control"></div>
                <div class="form-control"></div>
            </form>
            <p>Don't have an account? <a href="user_register.php">Sign up now</a>  </p>

        </div>





    <script type="text/javascript" src="js/userloginValidation.js"></script>
</body>
</html>
