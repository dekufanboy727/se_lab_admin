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
        <title>Events Update</title>
        <link rel="icon" type="image/jpg" href="images/profile.jpg">
        <link rel="stylesheet" href="css/events_update.css">
    </head>

    <body>
        <?php
            //if (empty($_SESSION['logged_in']) == true)
            //{
                //echo "You are not Logged in";
                //header("Location: adminlogout.php");
           // }
            
            date_default_timezone_set('Asia/Kuching');
            //Adding Product Handler
            $name = $event_date = $event_link = $category_id = $event_time = $discount = $description = $shownid = $editid = $location = $eventpic = "";
            $nameerr = $event_dateerr = $event_linkerr = $category_iderr = $event_timeerr = $calorieerr = $descriptionerr = $productpicerr = $locationerr = $em = "";
            $validate = true;

            function test($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            // Edit Mode Initiate
            if(isset($_GET["event"])){
                $editid = $_GET["event"];
                $editsql = "SELECT * FROM events WHERE id = '$editid'";
                $editresult = mysqli_query($conn, $editsql) or die($mysqli_error($conn));
                if (mysqli_num_rows($editresult) > 0){
                    $editrow = mysqli_fetch_assoc($editresult);
                    $shownid = $editid;
                    $name = $editrow["event_name"];
                    $event_date = $editrow["event_date"];
                    $event_time = $editrow["event_time"];
                    $event_link = $editrow["event_link"];
                    $description = $editrow["description"];
                    $location = $editrow["event_location"];
                    $eventpic = $editrow["event_img"];
                }else{
                    $em = "0 results";
                }
            }

            //Upload Handler
            if (isset($_POST['updateEvent'])) {
                
                if(empty($_POST["name"]))
                {
                    $nameerr = "*Name is required!";
                    $validate = false;
                }else{
                    $name = test($_POST['name']);
                }

                if(empty($_POST["event_date"]))
                {
                    $event_dateerr = "*Date is required!";
                    $validate = false;
                }else{
                    $event_date = test($_POST['event_date']);
                }

                if(empty($_POST["event_time"]))
                {
                    $event_timeerr = "*Time is required!";
                    $validate = false;
                }else{
                    $event_time = test($_POST['event_time']);
                }

                if(empty($_POST["event_link"]))
                {
                    $event_linkerr = "*Link is required!";
                    $validate = false;
                }else{
                    $event_link = test($_POST['event_link']);
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

                if($validate == true){
                    $shownid = $_POST['eventid'];

                    $targetDir = "../event_images/";

                    $sql = "UPDATE events SET event_name ='$name', event_date = '$event_date', event_time = '$event_time', description = '$description', event_location = '$location', event_link = '$event_link'
                                WHERE id = '$shownid'";
                    if(mysqli_query($conn, $sql)){
                        $em = "Record successfully updated";

                        $name = $event_date = $event_link = $category_id = $event_time = $discount = $description = $shownid = $editid ="";
                        $nameerr = $event_dateerr = $category_iderr = $event_linkerr = $event_timeerr = $calorieerr = $descriptionerr = $productpicerr = $em = "";
                        
                    }else{
                        $em = "Record failed to update";
                        
                    }

                    if(!empty($_POST["uploadphoto"] ) ){
                        if ($_POST["uploadphoto"] === "yes"){
                            $filename = basename($_FILES["eventpic"]["name"]);
                            $targetFilePath = $targetDir . $filename;
                            $imagefileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                            $uploadOk = 1;
                            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'JPG', 'JPEG', 'PNG', 'GIF');

                            //Upload image
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
                                //delete old photo
                                $deleteid = $shownid;
                                $deletesql = "SELECT event_img FROM events WHERE id = '$deleteid'";
                                $deletephoto = mysqli_query($conn,$deletesql);
                                if (!empty($deletephoto)){
                                    $deletephotoresult = mysqli_fetch_assoc($deletephoto);
                                    unlink($deletephotoresult["event_img"]);
                                }
                                
                                //update to new photo
                                $updatesql2 = "UPDATE events SET event_img = '$targetFilePath' WHERE id = $shownid";

                                if(mysqli_query($conn, $updatesql2)){
                                    $em = "Picture for Event".$shownid." Updated";

                                    $name = $event_date = $event_link =$category_id = $event_time = $discount = $description = $shownid = $editid ="";
                                    $nameerr = $event_dateerr = $event_linkerr =$category_iderr = $event_timeerr = $calorieerr = $descriptionerr = $productpicerr = "";
                                    
                                }else{
                                    $em = "Update Photo Error";
                                }
                            }
                        }
                    }
                    $em = "Update Successful";
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
                            <span class="title">HelffCoffee</span>
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
                    <div class="event-details">
                        <div class="event-details-header">
                            <h2>Update Event Info</h2>
                        </div>
                        <div class = "row">
                                <span><?php echo $em; ?></span>
                        </div>

                        <form name="edit" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                            <input type="hidden" name="eventid" value="<?php echo $editid; ?>">
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-25">
                                    <label for="name">Name</label>
                                    <span><?php echo $nameerr;?></span>
                                </div>
                                <div class="col-75">
                                    <input type="text" name="name" id="name" placeholder="Event name..." value = "<?php echo $name?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="date">Event Date</label>
                                    <span><?php echo $event_dateerr;?></span>
                                </div>
                                <div class="col-75">
                                    <input type="text" name="event_date" id="event_date"  value = "<?php echo $event_date?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="period">Event Time</label>
                                    <span><?php echo $event_timeerr;?></span>
                                </div>
                                <div class="col-75">
                                    <input type="text" name="event_time" id="event_time"   value = "<?php echo ($event_time)?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="period">Event Link</label>
                                    <span><?php echo $event_linkerr;?></span>
                                </div>
                                <div class="col-75">
                                    <input type="text" name="event_link" id="event_link"   value = "<?php echo ($event_link)?>">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-25">
                                    <label for="description">Description</label>
                                    <span><?php echo $descriptionerr;?></span>
                                </div>
                                <div class="col-75">
                                    <textarea name="description" id="description" placeholder="Event description..."><?php echo $description?>"</textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-25">
                                    <label for="location">Location</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" name="location" id="location" placeholder="Event Location..." value = "<?php echo $location ?>">
                                </div>
                                <span><?php echo $locationerr ?> </span>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-25">
                                    <label for="eventpic">Event Image</label>
                                </div>
                                <div class="col-75">
                                    <img src="<?php echo $eventpic ?>" alt="picture of the product" height = "300" width = "300">
                                    <input type="file" id="eventpic" name="eventpic">
                                </div>
                            </div>
                            <div class = "row">
                                <div class="col-25">
                                    <p> Make Changes to the Photo? </p>
                                </div>
                                <div class="col-75">
                                    <label for="noupload" class="radio-container">No
                                        <input type="radio" id= "noupload" name = "uploadphoto" value ="no">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="yesupload" class="radio-container">Yes
                                        <input type="radio" id= "yesupload" name = "uploadphoto" value ="yes">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <input type="submit" value="Update" name = "updateEvent">
                                <a href="events.php"><input type="button" value="Cancel"></a>
                            </div>
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