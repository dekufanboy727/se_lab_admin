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
    <link rel="stylesheet" href="css/home_style.css">
    <link rel="stylesheet" href="css/profile_style.css">
    <link rel="stylesheet" href="css/form_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Marhey:wght@300;400&display=swap" rel="stylesheet">
    <title>Helf Coffee Official Website</title>

    <style>
        .container{
            display:block;
            background-color: burlywood;
            margin:auto;
            width: 50%;
            height: 650px;
            max-width: 100%;
        }

        .form-control input{
            border: 2px solid #e6e6e6;
            border-radius: 4px;
            width: 120%;
            font-size: 12px;
        }

        .form-control{
            padding-right:130px;
            margin-right: 20px;
            display: inline-block;
            
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

        <?php if(!isset($_SESSION['logged_in'])) : ?>
        <a href="user_login.php" class="login">Login</a>
        <?php endif ?>

        <?php if(isset($_SESSION['logged_in'])) : ?>
        <a href="index.php?status=loggedout " class="login">Logout</a>
        <a href="profile.php" class="login">Profile</a> 
        <?php endif ?>

        <nav class="pages">
            <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="menu_best_seller.php">Menu</a></li>
                <li><a href="#">Events</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>        
    </div>
    </div>
    <?php

        $current_email = $_SESSION['email'];
        $sql =  $conn->query("SELECT * FROM customer WHERE email = $current_email ");       

        if($sql->num_rows>0){
            
            while($data = $sql->fetch_assoc()){

          
    ?>
    


    <div class = "container">
     <h1>User Profile</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form" id="form">
                <div class="form-control">
                    <label>Name</label>
                    <input type="text" id="name" name="name" value="<?=$name?>" placeholder="<?php echo $data['name'] ?>">

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




        </form>    

        <?php
             }
        }

        ?>

    </div>


    <script type="text/javascript" src="js/userRegisterValidation.js"></script>
</body>
</html>
