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
    <title>Add Event</title>
    <link rel="icon" type="image/jpg" href="images/profile.jpg">
    <link rel="stylesheet" href="css/events_update.css"> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
</head>

<body>
    <?php //Session Control
       if (empty($_SESSION['logged_in']) == true)
        {
          echo "You are not Logged in";
          header("Location: adminlogout.php");
        }
        
        //Adding Product Handler
        $name = $date = $category_id = $time = $discount = $description = $location = $link = "";
        $nameerr = $dateerr = $category_iderr = $timeerr = $descriptionerr = $productpicerr = $locationerr = $em =  $linkerr ="";
        $validate = true;

        function test($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //Upload Handler
        if (isset($_POST['createEvent']) && isset($_FILES["eventpic"])) {
            
            if(empty($_POST["name"]))
            {
                $nameerr = "*Name is required!";
                $validate = false;
            }else{
                $name = test($_POST['name']);
            }

            if(empty($_POST["date"]))
            {
                $dateerr = "*Date is required!";
                $validate = false;
            }else{
                $date = test($_POST['date']);
            }

            if(empty($_POST["time"]))
            {
                $timeerr = "*End date is required!";
                $validate = false;
            }else{
                $time = test($_POST['time']);
            }

            if(empty($_POST["description"]))
            {
                $descriptionerr = "*Description is required!";
                $validate = false;
            }else{
                $description = test($_POST['description']);
            }

            if(empty($_POST["location"]))
            {
                $locationerr = "*Location is required!";
                $validate = false;
            }else{
                $location = test($_POST['location']);
            }

            if(empty($_POST["link"]))
            {
                $linkerr = "*Link is required!";
                $validate = false;
            }else{
                $link = test($_POST['link']);
            }


            if($validate == true){


                $targetDir = "../event_images/";
                $filename = basename($_FILES["eventpic"]["name"]);
                $targetFilePath = $targetDir . $filename;
                $imagefileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                $uploadOk = 1;
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'JPG', 'PNG', 'JPEG', 'GIF');

                // Insert into Database
                if(empty($_FILES["eventpic"])){
                    $uploadOk = 0;
                    $em = "Please Select A Picture to Upload";
                    
                }else if(file_exists($targetFilePath)){
                    $uploadOk = 0;
                    $em = "Your filename already exists";
    
                }else if(!in_array($imagefileType, $allowTypes)){
                    $uploadOk = 0;
                    $em = "Your file is not an image, only JPG, JPEG, PNG and GIF allowed";
    
                }else if($_FILES["eventpic"]["size"] > 500000000){
                    $uploadOk = 0;
                    $em = "Your file is too large";
    
                }else if(!move_uploaded_file($_FILES["eventpic"]["tmp_name"], $targetFilePath)){
                    $uploadOk = 0;
                    $em ="There was an error in uploading your file";
                }else{
                    $sql = "INSERT INTO events (event_name, event_date, event_time, description, event_location, event_img, event_link) 
                                VALUES('$name', '$date', '$time', '$description', '$location', '$targetFilePath', '$link')";
                    if(mysqli_query($conn, $sql)){
                        $em = "Record successfully uploaded";
                    }else{
                        $em = "Record failed to upload";
                    }
                }
                $em = "Add Successful";
                header( "Location: events.php");
            }else{
                $em = "record not added";
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
                <li class="hovered active">
                    <a href="events.php">
                        <span class="icon">
                            <ion-icon name="sparkles-outline"></ion-icon>
                        </span>
                        <span class="title">Events</span>
                    </a>
                </li>
                <li>
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

            <div class="event">
                <div class="event-details" id = "event-details">
                    <div class="event-details-header">
                        <h2>Add New Event</h2>
                    </div>

                    <form name="add" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-25">
                                <label for="name">Name</label>
                                <span><?php echo $nameerr;?></span>
                            </div>
                            <div class="col-75">
                                <input type="text" name="name" id="name" placeholder="Event name...">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="date">Date</label>
                                <span><?php echo $dateerr;?></span>
                            </div>
                            <div class="col-75">
                                <input type="text" name="date" id="date" placeholder="Event date...">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="period">Time</label>
                                <span><?php echo $timeerr;?></span>
                            </div>
                            <div class="col-75">
                                <input type="text" name="time" id="time" placeholder="Event time period...">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="period">Link</label>
                                <span><?php echo $linkerr;?></span>
                            </div>
                            <div class="col-75">
                                <input type="text" name="link" id="link" placeholder="Event link...">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="description">Description</label>
                                <span><?php echo $descriptionerr;?></span>
                            </div>
                            <div class="col-75">
                                <textarea name="description" id="description" placeholder="Event description..."></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-25">
                                <label for="name">Location</label>
                                <span><?php echo $locationerr;?></span>
                            </div>
                            <div class="col-75">
                                <input type="text" name="location" id="location" placeholder="Location name...">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-25">
                                <label for="eventpic">Event Image</label>
                            </div>
                            <div class="col-75">
                                <input type="file" id="eventpic" name="eventpic">
                            </div>
                            <span><?php echo $em ?> </span>
                        </div>
                        <br>
                        <div class="row">
                            <input type="submit" value="Add this Event" name = "createEvent">
                            <a href="events.php"><input type="button" value="Cancel"></a>
                        </div>
                        <br>
                    </form>
                    <div class = "row">
                        <span><?php echo $em; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

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

        // Close the dropdown if the user clicks outside of it
        window.onclick = function (event) {
            if (!event.target.matches('.dropbtn')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

        // update status to database https://www.youtube.com/watch?v=zc1F50TeyIY
        //status_update(value, id)
        function status_update(value, id) {
            let url = window.location;
            window.location.href = url + "?id=" + id + "&status=" + value;
        }
    </script>

</body>

</html>
