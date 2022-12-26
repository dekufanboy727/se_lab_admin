


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home_style.css">
    <link rel="stylesheet" href="css/form_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Marhey:wght@300;400&display=swap" rel="stylesheet">
    <title>Helf Coffee Official Website</title>
    <style>
        body{
            background-color: #e6d2c1;
        }

    </style>  
    
</head>
<body>
    <div class="nav_bar">
        <div class="logo">
            <a href="index.html"><img src="images/helf_coffee_logo.png" alt="Helf Coffee Logo" style="width: 130px" href="index.html"></a>
        </div>

        <a href="user_login.php" class="login">Login</a>

        <nav class="pages">
            <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="menu_best_seller.html">Menu</a></li>
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
                    <input type="text" id="name" name="name" placeholder="Enter your full name">

                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $nameErr; ?></span>
                </div>
                <div class="form-control">
                    <label>Email</label>
                    <input type="text" id="email" name="email" placeholder="Enter your email">

                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $emailErr; ?></span>
                </div>
                <div class="form-control">
                    <label>Address</label>
                    <input type="text" id="address" name="address" placeholder="Enter your address">

                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $addressErr; ?></span>
                </div>
                <div class="form-control">
                    <label>Password</label>
                    <input type="text" id="password" name="password" placeholder="Enter your password">

                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                    <span style="color:#e74c3c;font-size: smaller;"><?php echo $passwordErr; ?></span>
                </div>

            </form>    
        </div>





</body>
</html>