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
            font-size: 14px;
        }

        .form-control{
            padding-right:153px;
            margin:auto;
            display: inline-block;
            
        }

        .dropdown-content {
            display: none;
            background-color: #4C5D70;
            width: 120px;
            box-shadow: 5px 5px 8px grey;
            z-index: 1;
            border-radius: 30px;
            
            
            
        }

        .dropdown-content a {
            color: #E8CBB1;
            padding: 5px 5px;
            text-decoration: none;
            display: block;
        }

        .login:hover .dropdown-content {
            display: block;
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

            $session_id = $_SESSION['id'];
             $edit = mysqli_query($conn, "UPDATE customer SET name = '$name',email = '$email',phone='$phone',address='$address',password='$password' WHERE id = '$session_id' ");
            
             if($edit){
                mysqli_close($conn);
                header('location: profile.php');
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
        <div class="login">
            <a>Profile</a>
            <div class="dropdown-content">
            <a href="profile.php">Profile Page</a>
            <a href="#">Orders</a>
            <a href="#">Notifications</a>
            </div>
        </div>
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

        $current_id = $_SESSION['id'];
        $sql =  $conn->query("SELECT * FROM customer WHERE id = $current_id ");       

        if($sql->num_rows > 0){
            
            while($data = $sql->fetch_assoc()){

          
    ?>
    


    <div class = "container">
     <h1>User Profile</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form" id="form">
                <div class="form-control">
                    <label>Name</label>
                    <input type="text" id="name" name="name" value="<?php echo $data['name'] ?>" placeholder="<?php echo $data['name'] ?>">

                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $nameErr; ?></span>
                </div>
                <div class="form-control">
                    <label>Email</label>
                    <input type="text" id="email" name="email" value="<?php echo $data['email'] ?>" placeholder="<?php echo $data['email'] ?>">

                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $emailErr; ?></span>
                </div>
                <div class="form-control">
                    <label>Address</label>
                    <input type="text" id="address" name="address" value="<?php echo $data['address'] ?>" placeholder="<?php echo $data['address'] ?>">

                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $addressErr; ?></span>
                </div>
                <div class="form-control">
                    <label>Phone Number</label>
                    <input type="text" id="phone" name="phone" value="<?php echo $data['phone'] ?>" placeholder="<?php echo $data['phone'] ?>">

                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $phoneErr; ?></span>
                </div>
                <div class="form-control">
                    <label>Password</label>
                    <input type="password" id="password" name="password" value="<?php echo $data['password'] ?>">

                    <i class="fa fa-eye" id="togglePassword" onclick="togglePassword()"></i>
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $passwordErr; ?></span>
                </div>

                <div class="form-control">
                    <label>Confirm Password</label>
                    <input type="password" id="password2" name="password2" placeholder="Re-enter your password">

                    <i class="fa fa-eye" id="togglePassword2" onclick="togglePassword2()"></i>
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $password2Err; ?></span>
                </div>

                <div class="button" id="button">
                <input type="submit" value="Edit">
                </div>
                <div class="form-control"></div>
                <div class="form-control"></div>

        </form>    

        <?php
             }
        }

        ?>

    </div>


    <script type="text/javascript" src="js/userEditValidation.js"></script>
</body>
</html>
