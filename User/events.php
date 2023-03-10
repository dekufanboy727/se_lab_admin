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
    <link rel="stylesheet" href="css/events_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Marhey:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Helf Coffee Official Website</title>
</head>
<body>
    <div class="nav_bar">
        <div class="logo">
            <a href="index.php"><img src="images/helf_coffee_logo.png" alt="Helf Coffee Logo" style="width: 130px" href="index.php"></a>
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
                <a href="profile.php#my_orders">My Orders<i class="fa fa-cutlery" aria-hidden="true"></i></a>
                <a href="index.php?status=loggedout">Logout<i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </div>
            
        </div>
        <?php endif ?>
        
        <nav class="pages">
            <ul>
                <li><a href="index.php#about_us">About Us</a></li>
                <li><a href="menu_best_seller.php">Menu</a></li>
                <li><a class="active" href="#">Events</a></li>
                <li><a href="contact_us.php">Contact</a></li>
            </ul>
        </nav>        
    </div>
    <div class="menu_bar">
        <img src="images/events_bg.jpg" alt="Best Seller Bg">
        <ul>
            <li><a class="active2" href="events.php">Events</a></li>
        </ul>
    </div>

    <div class="content_container">
        
        <?php
            $sql = $conn->query("SELECT * FROM events ORDER by id DESC");

            if($sql->num_rows > 0 ){

                while($data=$sql->fetch_assoc()){


        ?>    
        <div class="events">
            <?php
            echo '<img src="'.( $data['event_img'] ).'"/>'
            ?>            
            <div class="event_details">
                <h3><?php echo $data['event_name']?></h3>
                <p><?php echo $data['description']?></p>
                <div class="info" >
                    <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;
                    <?php
                    echo $data['event_date']
                    ?>
                </div>
                <div class="info">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;&nbsp;
                    <?php
                    echo $data['event_time']
                    ?>                
                </div>
                <div class="info">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;
                    <?php
                    echo $data['event_location']
                    ?>                
                </div>
    
                <a href="<?php echo $data['event_link']?>" class="learn_more" target="_blank">Learn More</a>
            </div>
        </div>
        <?php
            }
        }    
        ?>

    <footer>
        <div class="deco" >
            Be Sure to Follow Us
        </div>
        <div class="social" >
            <a class="fa fa-facebook-square" href="https://www.facebook.com/helf.coffee" target="_blank" aria-hidden="true"></a>
            <a class="fa fa-instagram" href="https://www.instagram.com/helf.coffee/" target="_blank" aria-hidden="true"></a>
            <a class="fa fa-whatsapp" href="https://api.whatsapp.com/send?phone=60164453822&text=" target="_blank" aria-hidden="true"></a>
            <a class="fa fa-twitter" href="https://twitter.com/helf_coffee/status/1606964609638072323" target="_blank" aria-hidden="true"></a>
        </div>
    </footer>
    </div>
</body>
</html>