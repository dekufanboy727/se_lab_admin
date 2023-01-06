<?php
session_start();

global $conn;

include "dbConnection.php"

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="icon" type="image/jpg" href="images/profile.jpg">
    <link rel="stylesheet" href="css/settings.css">
</head>

<body>
    <?php //Session Control
        if (empty($_SESSION['logged_in']) == true)
        {
            echo "You are not Logged in";
            header("Location: adminlogout.php");
        }

        //Adding Admin Handler
        $name = $email = $password = $phone = $address = $shownid = $editid = "";
        $nameerr = $emailerr = $passworderr = $phoneerr = $addresserr = $em = "";
        $validate = true;

        //Form Input Filter
        function test($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Edit Admin Mode Initiate
        if(isset($_SESSION["admin_id"])){
            $editid = $_SESSION["admin_id"];
            $editsql = "SELECT * FROM admin WHERE admin_id = '$editid'";
            $editresult = mysqli_query($conn, $editsql) or die($mysqli_error($conn));
            if (mysqli_num_rows($editresult) > 0){
                $editrow = mysqli_fetch_assoc($editresult);
                $shownid = $editid;
                $name = $editrow["username"];
                $password = $editrow["pass"];
                $email = $editrow["email"];
                $phone = $editrow["phone_num"];
                $address = $editrow["address"];

            }else{
                $em = "0 results";
            }
        }

        //Update Handler
        if (isset($_POST['edit'])) {

            if(empty($_POST["name"]))
            {
                $nameerr = "*Name is required!";
                $validate = false;
                
            }else{
                $name = test($_POST['name']);
            }

            if(empty($_POST["email"]))
            {
                $emailerr = "*Email is required!";
                $validate = false;
                
            }else{
                $email = test($_POST['email']);
            }

            if(empty($_POST["password"]))
            {
                $passworderr = "*Passsword is required!";
                $validate = false;
            
            }else{
                $password = test($_POST['password']);
            }

            if(empty($_POST["phone"]))
            {
                $phoneerr = "*Phone Number is required!";
                $validate = false;
                
            }else{
                $phone = test($_POST['phone']);
            }

            if(empty($_POST["address"]))
            {
                $addresserr = "*Address is required!";
                $validate = false;
                
            }else{
                $address = test($_POST['address']);
            }

            if($validate == true)
            {   
                $shownid = $_POST['adminid'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];

                if($nameerr == "" && $emailerr == "" && $passworderr == "" && $phoneerr == "" && $addresserr == ""){

                    // Insert into Database
                    $updatesql = "UPDATE admin SET username = '$name', pass = '$password', email = '$email', phone_num = '$phone', address = '$address'
                                 WHERE admin_id = $shownid";

                    if(mysqli_query($conn, $updatesql)){
                        $em = "Record ".$shownid." Updated";

                        $name = $password = $email = $phone = $address = "";

                        $nameerr = $passworderr = $emailerr = $phoneerr = $addresserr = "";

                    }else{
                        $em = mysqli_error($conn);
                    }
                }   
            }
        }
    ?>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="cafe-outline"></ion-icon>
                        </span>
                        <span class="title">HelfCoffee</span>
                    </a>
                </li>
                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="orders.php">
                        <span class="icon">
                            <ion-icon name="cart-outline"></ion-icon>
                        </span>
                        <span class="title">Orders</span>
                    </a>
                </li>
                <li>
                    <a href="products.php">
                        <span class="icon">
                            <ion-icon name="fast-food-outline"></ion-icon>
                        </span>
                        <span class="title">Products</span>
                    </a>
                </li>
                <li>
                    <a href="transaction.php">
                        <span class="icon">
                            <ion-icon name="cash-outline"></ion-icon>
                        </span>
                        <span class="title">Transaction</span>
                    </a>
                </li>
                <li>
                    <a href="events.php">
                        <span class="icon">
                            <ion-icon name="sparkles-outline"></ion-icon>
                        </span>
                        <span class="title">Events</span>
                    </a>
                </li>
                <li class="hovered active">
                    <a href="settings.php">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="adminlogout.php">
                        <span class="icon">
                            <ion-icon name="exit-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="user">
                    <img src="images/profile.jpg">
                </div>
            </div>

            <div class="profile">
                <div class="profile-details">
                    <div class="profile-details-header">
                        <h2>Personal Info</h2>
                    </div>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="edit" method="post">
                        <input type="hidden" name="adminid" value="<?php echo $editid; ?>">
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-25">
                                <label for="name">Name</label>
                                <span><?php echo $nameerr ?></span>
                            </div>
                            <div class="col-75">
                                <input type="text" name="name" id="name" placeholder="Your name..." <?php echo 'value ="'.$name.'"'; ?>>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="email">Email</label>
                                <span><?php echo $emailerr ?></span>
                            </div>
                            <div class="col-75">
                                <input type="text" name="email" id="email" placeholder="Your email..." <?php echo 'value ="'.$email.'"'; ?>>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="password">Password</label>
                                <span><?php echo $passworderr ?></span>
                            </div>
                            <div class="col-75">
                                <input type="password" name="password" id="password" placeholder="******" <?php echo 'value ="'.$password.'"'; ?>>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="password">Phone</label>
                                <span><?php echo $phoneerr ?></span>
                            </div>
                            <div class="col-75">
                                <input type="text" name="phone" id="phone" placeholder="+60..." <?php echo 'value ="'.$phone.'"'; ?>>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="Address">Address</label>
                                <span><?php echo $addresserr ?></span>
                            </div>
                            <div class="col-75">
                                <textarea name="address" id="address" placeholder="Your address..." ><?php echo $address; ?></textarea>
                            </div>
                        </div>
                        <br>
                        <div class = "row">
                            <span><?php echo $em; ?></span>
                        </div>
                        <br>
                        <div class="row">
                            <input type="submit" name="edit" value = "update">
                        </div>
                    </form>
                    
                </div>
            </div>

        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>

    <script>
        // MenuToggle
        let toggle = document.querySelector('.toggle');
        let navigation = document.querySelector('.navigation');
        let main = document.querySelector('.main');

        toggle.onclick = function () {
            navigation.classList.toggle('active');
            main.classList.toggle('active');
        }
    </script>

</body>

</html>
