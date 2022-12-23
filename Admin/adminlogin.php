<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="icon" type="image/jpg" href="images/profile.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/admin_login.css">
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

    //No error in input
    //Check whether the admin exists 
    if (!empty($_POST["email"]) && !empty($_POST["pass"])) {
        $sql = "SELECT * FROM admin WHERE email ='$email' AND pass ='$pass'"; //Find the admin acc
        $isFound = mysqli_query($conn, $sql); //Check is it exists

        //Found the admin
        if (mysqli_num_rows($isFound) == 1) {
            //echo "Login successful";
            //Redirecting admin to home menu
            $_SESSION['logged_in'] = true;
            header("Location: index.php");
        } else {
            //echo "Login unsuccessful";
            $error = "Incorrect email or password! Please try again.";
        }
    }

    ?>

    <div class="header">
        <a href="#"><img src="images/v35_12.png" alt="logo"></a>
        <a href="#"><button class="btn" title="Go back to home page"><i class="fas fa-times"></i></button></a>
    </div>

    <div class="content">
        <div class="container">
            <div class="title">Log In</div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form" id="form">
                <div class="form-control">
                    <label>Email</label>
                    <input type="text" id="email" name="email" placeholder="Enter your email">
                    <div class="icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $emailErr; ?></span>
                </div>
                <div class="form-control">
                    <label>Password</label>
                    <input type="password" id="pass" name="pass" placeholder="Enter your password" title="Must contain one uppercase, one lower case, one special character ( ! @ # $ % ^ & * ), numbers and no space, and at least 6 digits length">
                    <div class="icon">
                        <i class="fas fa-key"></i>
                    </div>
                    <i class="fas fa-eye" id="togglePassword" onclick="togglePassword()"></i>
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $passErr; ?></span>
                </div>
                <div class="form-control" style="margin: 0;">
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $error; ?></span>
                </div>

                <div class="button" id="button">
                    <input type="reset" value="Clear" onclick="myReset()">
                    <input type="submit" value="Log In">
                </div>
            </form>
        </div>
        <!--End class container-->
    </div>

    <script type="text/javascript" src="adminloginValidation.js"></script>

</body>

</html>