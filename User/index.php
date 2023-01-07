<?php
    session_start();
    include 'dbConnection.php';

    if(!empty($_GET['status'])){
        session_destroy();
        unset($_SESSION['email']);
        unset($_SESSION['id']);
        header('Location: index.php');
    }

    if(!empty($_GET['success'])){

        echo "<script> alert('Order successfully placed and email has been sent out')  </script>";
    }
    
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Marhey:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Helf Coffee Official Website</title>
</head>
<body>
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
                <a href="profile.php#my_orders">My Orders<i class="fa fa-cutlery" aria-hidden="true"></i></a>
                <a href="index.php?status=loggedout">Logout<i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </div>
            
        </div>
        <?php endif ?>

        <nav class="pages">
            <ul>
                <li><a href="index.php#about_us">About Us</a></li>
                <li><a href="menu_best_seller.php">Menu</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="contact_us.php">Contact</a></li>
            </ul>
        </nav>        
    </div>

    
    <div class="bg">
        <img src="images/index_bg4.jpg">
    </div>

    <div class="container_bg">
        <div class="welcome_container">
            <div class="name">Helf Coffee</div>
            <div class="welcome">WELCOME TO OUR CAFE</div>
            <div class="welcome2">Where The Modern Meets The Vintage</div>
        </div>
    </div>
    <div class="blur"></div>

    
    
    <a name="about_us"></a>
    <div class="about_us">
        <div class="content">
        <div class="slider">
            <div class="slides">
                <input type="radio" name="radio-btn" id="radio1">
                <input type="radio" name="radio-btn" id="radio2">
                <input type="radio" name="radio-btn" id="radio3">

                <div class="slide first">
                    <img src="images/slide_1.jpeg"/>
                </div>
                <div class="slide">
                    <img src="images/slide_2.jpeg"/>
                </div>
                <div class="slide">
                    <img src="images/slide_3.jpeg"/>
                </div>

                <div class="nagivation-manual">
                    <label for="radio1" class="manual-btn"></label>
                    <label for="radio2" class="manual-btn"></label>
                    <label for="radio3" class="manual-btn"></label>
                </div>
            </div>
        </div>
            <div class="description_container">
                <div class="description">
                    <div class="title">About Us</div>
                    <p>Helf Coffee was established on the 18th of October 2021 by Ms Lim Xin Ying, which is a food business that specialises in pastries and coffee.
                        The establishment is unique in the sense that its decors are more retro-themed. This helps expose their younger audiences to relics of the past while also bringing a sense of nostalgia for the older generation to reminisce about their past.
                    </p>

                    <div class="info">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <p>115-G-01, Kedah Road Flat, Kompleks, Jalan Kedah, 10050 George Town, Penang</p>
                    </div>
                    <div class="info">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        <ul>
                            <li>Mon-Fri 10.00am-5.30pm</li>
                            <li>Sat 10.00am-12.30pm</li>
                        </ul>
                    </div>

                    <br><br>

                    <div class="deco_container">
                        Visit Us On
                        <div class="deco_bar1"></div>
                    </div>
                    <div class="social_container">
                        <div class="social" >
                            <a class="fa fa-facebook-square" href="https://www.facebook.com/helf.coffee" target="_blank" aria-hidden="true"></a>
                            <a class="fa fa-instagram" href="https://www.instagram.com/helf.coffee/" target="_blank" aria-hidden="true"></a>
                            <a class="fa fa-whatsapp" href="https://api.whatsapp.com/send?phone=60164453822&text=" target="_blank" aria-hidden="true"></a>
                            <a class="fa fa-twitter" href="https://twitter.com/helf_coffee/status/1606964609638072323" target="_blank" aria-hidden="true"></a>
                        </div>
                    </div>  
        
                </div>

            </div>
        </div>
    </div>

    <div class="best_seller_container">
        <div class="title2">Our Best Sellers</div>
        <p>Our menu comprises of items that is inspired by traditional Chinese cuisines that brings about the taste of nostalgia, combined with a hint of Western influence. 
        </p>           
        
        <div class="deco">
            <div class="deco_dot"></div>
            <div class="deco_dot"></div>
            <div class="deco_bar2"></div>
        </div>

        <div class="slider2">
            <div class="slides2">
                <input type="radio" name="radio-btn2" id="r1">
                <input type="radio" name="radio-btn2" id="r2">
                <input type="radio" name="radio-btn2" id="r3">

                <div class="slide2 first">
                    <img src="../product_images/Gu_Mor_Kak.JPG"/>
                    <div class="description_container2">
                        <h2>Gu Mor Kak</h2>
                        <p>“Gu Mor Kak” or Demon Cow’s Horn Biscuit is a chinese homemade traditional biscuit that is packed with savory rosated chicken fillings, 
                            with a thin layered crust wrapped around it. It’s crunchy textute and salty with a hint a sweetness flavour is exactly why Gu Mor Kak is one of our cafe’s signature pastries and best seller.</p>
                    </div>
                </div>
                <div class="slide2">
                    <img src="../product_images/Geh_Bo_Gok_Tat.JPG"/>
                    <div class="description_container2">
                        <h2>Geh Bo Gok Tat</h2>
                        <p>"Geh Bo Gok Tat" which translates to Hen Baked Tart is another tradisional, yet brand new and exciting combination of tart meets curry chicken, finished with a topping of cheese. This incredible yet long forgotten tasty is definately worth reminiscing.</p>
                    </div>
                </div>
                <div class="slide2">
                    <img src="../product_images/portuguese_tart.JPG"/>
                    <div class="description_container2">
                        <h2>Portuguese Tart</h2>
                        <p>Homemade Portuguese style egg tart baked with an outer layer of crust, fragant egg fillings and a layer of burnt cheese on top. It’s aromatic, sweet and satly fillings combined with the crusty outer layer is definately a must try.</p>
                    </div>
                </div>

                <div class="nagivation-manual2">
                    <label for="r1" class="manual-btn2"></label>
                    <label for="r2" class="manual-btn2"></label>
                    <label for="r3" class="manual-btn2"></label>
                </div>
            </div>
        </div>

        <a href="menu_best_seller.php" class="try">Try It Now!</a>
    </div>

    <div class="latest_events_container">
        <div class="title3">Our Latest Event</div>
        <p>Helf Coffee regularly holds kpop themed events, giving out freebis and vouchers to our loyal customers. Be sure to follow us on our social media pages so you won't miss out of any of them! 
        </p>

        <div class="deco">
            <div class="deco_dot2"></div>
            <div class="deco_dot2"></div>
            <div class="deco_bar3"></div>
        </div>

        <?php
        $sql = "SELECT * FROM events ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($conn,$sql);

             while($data = mysqli_fetch_array($result)){
        ?>
        <div class="events">
            <?php
            echo '<img src="'.( $data['event_img'] ).'"/>'
            ?>  
            <div class="event_details">
                <h3><?php echo $data['event_name']?></h3>
                <p><?php echo $data['description']?></p>
                <div class="info2" >
                    <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;&nbsp;
                    <?php
                    echo $data['event_date']
                    ?>
                </div>
                <div class="info2">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;&nbsp;
                    <?php
                    echo $data['event_time']
                    ?>    
                </div>
                <div class="info2">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;
                    <?php
                    echo $data['event_location']
                    ?>  
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <a href="events.php" class="learn_more" target="_blank">Find Out More!</a>
    </div>

    <footer>
        <div class="deco2" >
            Be Sure to Follow Us
        </div>
        <div class="social" >
            <a class="fa fa-facebook-square" href="https://www.facebook.com/helf.coffee" target="_blank" aria-hidden="true"></a>
            <a class="fa fa-instagram" href="https://www.instagram.com/helf.coffee/" target="_blank" aria-hidden="true"></a>
            <a class="fa fa-whatsapp" href="https://api.whatsapp.com/send?phone=60164453822&text=" target="_blank" aria-hidden="true"></a>
            <a class="fa fa-twitter" href="https://twitter.com/helf_coffee/status/1606964609638072323" target="_blank" aria-hidden="true"></a>
        </div>
    </footer>

    <script type="text/javascript">
        var counter = 1;
        setInterval(function(){
            document.getElementById('radio' + counter).checked = true;
            counter++;
            if(counter>3){
                counter=1
            }
        }, 5000);

        var i = 1;
        setInterval(function(){
            document.getElementById('r' + i).checked = true;
            i++;
            if(i>3){
                i=1
            }
        }, 5000);
    </script>
</body>
</html>
