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
        if (empty($_SESSION['logged_in']) == true)
        {
            echo "You are not Logged in";
            header("Location: adminlogout.php");
        }
        
        date_default_timezone_set('Asia/Kuching');
        //Adding Product Handler
        $name = $start_date = $category_id = $end_date = $discount = $description = $shownid = $editid ="";
        $nameerr = $start_dateerr = $category_iderr = $end_dateerr = $calorieerr = $descriptionerr = $productpicerr = $em = "";
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
                $name = $editrow["name"];
                $start_date = $editrow["start_date"];
                $end_date = $editrow["end_date"];
                $description = $editrow["description"];
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

            if(empty($_POST["start_date"]))
            {
                $start_dateerr = "*Start date is required!";
                $validate = false;
            }else{
                $start_date = test($_POST['start_date']);
            }

            if(empty($_POST["end_date"]))
            {
                $end_dateerr = "*End date is required!";
                $validate = false;
            }else{
                $end_date = test($_POST['end_date']);
            }

            if(empty($_POST["description"]))
            {
                $descriptionerr = "*Description is required!";
                $validate = false;
            }else{
                $description = test($_POST['description']);
            }

            if($validate == true){
                $shownid = $_POST['eventid'];
                $name = $_POST['name'];
                $start_date = $_POST['start_date'];
                $end_date = $_POST['end_date'];
                $description = $_POST['description'];

                $sql = "UPDATE events SET name ='$name', start_date = '$start_date', end_date = '$end_date', description = '$description'
                            WHERE id = '$shownid'";
                if(mysqli_query($conn, $sql)){
                    $em = "Record successfully updated";

                    $name = $start_date = $category_id = $end_date = $discount = $description = $shownid = $editid ="";
                    $nameerr = $start_dateerr = $category_iderr = $end_dateerr = $calorieerr = $descriptionerr = $productpicerr = "";
                    
                }else{
                    $em = "Record failed to update";
                    
                }
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

                    <form name="edit" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
                                <label for="date">Start Date</label>
                                <span><?php echo $start_dateerr;?></span>
                            </div>
                            <div class="col-75">
                                <input type="datetime-local" name="start_date" id="start_date"  value = "<?php echo date("Y-m-d\TH:i:s", strtotime($start_date))?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="period">End Date</label>
                                <span><?php echo $end_dateerr;?></span>
                            </div>
                            <div class="col-75">
                                <input type="datetime-local" name="end_date" id="end_date"   value = "<?php echo date("Y-m-d\TH:i:s", strtotime($end_date))?>">
                            </div>
                        </div>
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
