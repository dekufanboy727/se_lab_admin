<?php
    session_start();
    include 'dbConnection.php';

    if(!empty($_GET['status'])){
        session_destroy();
        unset($_SESSION['email']);
        unset($_SESSION['id']);
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Marhey:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Helf Coffee Official Website</title> 

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
        <div class="profile_btn">
            <?php
            $email = $_SESSION['email'];
           
            ?>
            <a><?php echo $email ?></a>
            <i class="fa fa-user-circle" aria-hidden="true"></i>
            <div class="dropdown-content">
                <a href="profile.php">User Profile</i><i class="fa fa-id-card" aria-hidden="true"></i></a>
                <a href="#">My Orders<i class="fa fa-cutlery" aria-hidden="true"></i></a>
                <a href="index.php?status=loggedout">Logout<i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </div>
            
        </div>
        <?php endif ?>

        <nav class="pages">
            <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="menu_best_seller.php">Menu</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="contact_us.php">Contact</a></li>
            </ul>
        </nav>        
    </div>

    <div class="menu_bar">
        <img src="images/user_bg.jpg" alt="Best Seller Bg" style="bottom: 430px;">
    </div>

    <?php

        $current_id = $_SESSION['id'];
        $sql =  $conn->query("SELECT * FROM customer WHERE id = $current_id ");       

        if($sql->num_rows > 0){
            
            while($data = $sql->fetch_assoc()){

          
    ?>
    <div class="blur"></div>
    
    <div class="content_container" >

    <div class = "form_container">
        <h1 class="title" >User Profile</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form" id="form">
            <div class="input_container">
                <div class="user_input">
                    <label class="input_field" >&nbsp;Name&nbsp;</label>
                    <input type="text" id="name" name="name" value="<?php echo $data['name'] ?>" placeholder="<?php echo $data['name'] ?>">

                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $nameErr; ?></span>
                </div>

                <div class="user_input">
                    <label class="input_field">&nbsp;Email&nbsp;</label>
                    <input type="text" id="email" name="email" value="<?php echo $data['email'] ?>" placeholder="<?php echo $data['email'] ?>">

                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $emailErr; ?></span>
                </div>
            
                <div class="user_input">
                    <label class="input_field">&nbsp;Password&nbsp;</label>
                    <input type="password" id="password" name="password" value="<?php echo $data['password'] ?>">

                    <i class="fa fa-eye" id="togglePassword" onclick="togglePassword()"></i>
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $passwordErr; ?></span>
                </div>
            </div>
        
            <div class="input_container">
                <div class="user_input">
                    <label class="input_field">&nbsp;Address&nbsp;</label>
                    <input type="text" id="address" name="address" value="<?php echo $data['address'] ?>" placeholder="<?php echo $data['address'] ?>">

                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $addressErr; ?></span>
                </div>

                <div class="user_input">
                    <label class="input_field">&nbsp;Phone Number&nbsp;</label>
                    <input type="text" id="phone" name="phone" value="<?php echo $data['phone'] ?>" placeholder="<?php echo $data['phone'] ?>">

                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $phoneErr; ?></span>
                </div>

                <div class="user_input">
                    <label class="input_field">&nbsp;Confirm Password&nbsp;</label>
                    <input type="password" id="password2" name="password2" placeholder="Re-enter your password">

                    <i class="fa fa-eye" id="togglePassword2" onclick="togglePassword2()"></i>
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $password2Err; ?></span>
                </div>
            </div>
            <br>
            <button class="submit" type="submit" value="Register">Edit</button>

        </form>    

        <?php
             }
        }

        ?>

    </div>
    
    </div>

    <div class="orders" id="scroll">
        <ul>
            <li><a class="active2" href="menu_best_seller.php">My Orders</a></li>
        </ul>
    </div>

    <div class="order_container" >
        <table class="order_details">
                <thead>
                    <tr>
                        <th>Order No.</th>
                        <th>Date & Time</th>
                        <th>Collection Method</th>
                        <th>Pickup Time</th>
                        <th>Order Status</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>12/12/2022 12:00</td>
                        <td>Delivery</td>
                        <td>13:00</td>
                        <td>Delivered</td>
                        <td>RM50</td>
                        <td><div onclick="togglePopup_1()"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></div></td>
                    </tr>

                    <tr>
                        <td>1</td>
                        <td>12/12/2022 12:00</td>
                        <td>Delivery</td>
                        <td>13:00</td>
                        <td>Delivered</td>
                        <td>RM50</td>
                        <td><i class="fa fa-chevron-circle-right" onclick="togglePopup_1()" aria-hidden="true"></i></td>
                    </tr>

                    <tr>
                        <td>1</td>
                        <td>12/12/2022 12:00</td>
                        <td>Delivery</td>
                        <td>13:00</td>
                        <td>Delivered</td>
                        <td>RM50</td>
                        <td><i class="fa fa-chevron-circle-right" onclick="togglePopup_1()" aria-hidden="true"></i></td>
                    </tr>

                    <tr>
                        <td>1</td>
                        <td>12/12/2022 12:00</td>
                        <td>Delivery</td>
                        <td>13:00</td>
                        <td>Delivered</td>
                        <td>RM50</td>
                        <td><i class="fa fa-chevron-circle-right"  onclick="togglePopup_1()" aria-hidden="true"></i></td>
                    </tr>
                </tbody>
        </table>     
    </div>

    <div class="popup" id="popup-1">

        <div class="overlay" onclick="togglePopup_1()"></div>
        <div class="content">
            <table class="popup_items">
                <thead>
                    <tr>
                        <th colspan="2">Product Purchased</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr>
                        <td><img src="images/Gu_Mor_Kak.JPG" ></td>
                        <td>happy</td>
                        <td>RM10</td>
                        <td>2</td>
                        <td>RM20</td>
                    </tr>
                    <tr>
                        <td><img src="images/Gu_Mor_Kak.JPG" ></td>
                        <td>happy</td>
                        <td>RM10</td>
                        <td>2</td>
                        <td>RM20</td>
                    </tr>		
                    <tr>
                        <td colspan="4" style="text-align: right;">Subtotal</td>
                        <td>
                            RM20
                        </td>
                    </tr> 
                    <tr>
                        <td colspan="4" style="text-align: right;">Delivery Fee</td>
                        <td id= "delivery_fee">
                            RM8
                        </td>
                    </tr> 
                        <tr>
                        <td colspan="4" style="text-align: right;">Total</td>
                        <td>
                            RM20
                        </td>
                    </tr>
                </tbody>
            </table>            
        </div>

    </div>

    <script>
        function togglePopup_1(){
            document.getElementById("scroll").scrollIntoView();
            document.getElementById("popup-1").classList.toggle("active");
        }
    </script>
    <script type="text/javascript" src="js/userEditValidation.js"></script>
</body>
</html>
