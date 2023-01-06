<?php
    session_start();
    include 'dbConnection.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/form_style.css">
        <link href="https://fonts.googleapis.com/css2?family=Marhey:wght@300;400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Helf Coffee Official Website</title>
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
        $_SESSION['email'] = $email;  
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

        $sql1 = "SELECT * FROM admin WHERE email ='$email' AND pass ='$pass'"; //Find the admin acc
        $isFound = mysqli_query($conn, $sql1); //Check is it exists

        //Found the admin
        if (mysqli_num_rows($isFound) == 1) {
            //echo "Login successful";
            //Redirecting admin to home menu
            $_SESSION['logged_in'] = true;
            $record = mysqli_fetch_assoc($isFound);
            $_SESSION['admin_id'] = $record['admin_id'];
            header("Location: ../Admin/index.php");
            
        } else {
            //echo "Login unsuccessful";
            $error = "Incorrect email or password! Please try again.";
        }
    }

    ?>

        <div class="logo">
            <a href="index.php"><img src="images/helf_coffee_logo.png" alt="Helf Coffee Logo" style="width: 250px" href="index.php"></a>
        </div>

        <div class="container">
            <div class="title">Log In</div>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form" id="form">

                    <div class="user_input">
                        <label class="input_field">&nbsp; Email &nbsp;</label>
                        <input type="text" id="email" name="email" placeholder="Enter your email">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                        <br>
                        <small>Error Message</small>
                        <span style="color:#e74c3c;font-size: smaller;"><?php echo $emailErr; ?></span>
                    </div>

                    <div class="user_input">
                        <label class="input_field">&nbsp; Password &nbsp;</label>
                        <input type="password" id="pass" name="pass" placeholder="Enter your password" title="Must contain one uppercase, one lower case, one special character ( ! @ # $ % ^ & * ), numbers and no space, and at least 6 digits length">
                        <i class="fa fa-eye" id="togglePassword" onclick="togglePassword()"></i>
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                        <br>
                        <small>Error Message</small>
                        <span style="color:#e74c3c;font-size: smaller;"><?php echo $passErr; ?></span>
                    </div>

                    <div class="user_input" style="margin: 0;">
                        <small>Error Message</small>
                        <span style="color:#e74c3c;font-size: smaller;"><?php echo $error; ?></span>
                    </div>

                    <button class="submit" type="submit" value="Log In">Log In</button>

                    <p>Don't have an account? <a href="user_register.php">Sign up now</a></p>
			    </form>

        </div>
        <script type="text/javascript" src="js/userloginValidation.js"></script>
    </body>
</html>
