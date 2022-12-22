<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Akaya+Telivigala&display=swap" rel="stylesheet" />
        <link href="./css/admin_login.css" rel="stylesheet" />
        <title>Document</title>
    </head>
    <body>
        <?php
            include 'dbConnection.php'; //include connection to the db

            //Declarations
            $email = $pass = "";
            $emailErr = $passErr ="";
            $error= "";

            //Validate the form
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                //Validate email
                if(empty($_POST["email"]))
                {
                    $emailErr = "*Email is required!";
                }
                else
                {
                    $email = $_POST["email"];
                }

                //Validate Password
                if(empty($_POST["pass"]))
                {
                    $passErr = "*Password is required!";
                }
                else
                {
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
            if (!empty($_POST["email"])&& !empty($_POST["pass"])) 
            {
                $sql = "SELECT * FROM admin WHERE email ='$email' AND pass ='$pass'"; //Find the admin acc
                $isFound = mysqli_query($conn,$sql); //Check is it exists
                
                //Found the admin
                if(mysqli_num_rows($isFound) == 1) 
                {   
                    //echo "Login successful";
                    //Redirecting admin to home menu
                    $_SESSION['logged_in'] = true;
                    header("Location: index.php");
                }   
                else
                {
                    //echo "Login unsuccessful";
                    $error = "Incorrect email or password! Please try again.";
                }
            }

        ?>
        <div class="v35_2">
            <div class="v35_3">
                <div class="v35_4"></div>
                <div class="v35_12"></div>
            </div>
            <div class="v36_13">

            </div>
            <span class="v37_14">Log In</span>
            <span class="v37_15">Welcome back Admin! Please enter your details</span>
            <span class="v37_26">Remember me</span>
            <span class="v37_30">Forgot password?</span>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                
                <div class="v37_19">
                    <div class="v37_17"></div>
                    <span class="v37_16">Email</span>
                    <input type="text" class="v37_17" name = "email" id="email"></input>
                    <span class="error"> <?php echo $emailErr; ?> </span>
                </div>
                <div class="v37_20">
                    <div class="v37_21"></div>
                    <span class="v37_23">Password</span>
                    <input type="password" class="v37_21" name = "pass" id="pass"></input>
                    <span class="error"> <?php echo $passErr; ?> </span>
                    <div class="v37_25"></div>
                </div>
                <div class="v37_34">
                    <span class = "error"><?php echo $error; ?></span>
                    <input type="submit" class="v37_32" value="Login"></input>  
                </div>
            </form>
            <div class="v37_28"></div>
        </div>
    </body>
</html>