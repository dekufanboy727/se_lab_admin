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
    <title>Events</title>
    <link rel="icon" type="image/jpg" href="images/profile.jpg">
    <link rel="stylesheet" href="css/events.css">
</head>

<body>
    <?php //Session Control
    if (empty($_SESSION['logged_in']) == true) {
        echo "You are not Logged in";
        header("Location: adminlogout.php");
    }

    $notice = "";
    //Event Deletion
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET['event']) == true) {
            $deleteid = $_GET['event'];
            $sql3 = "DELETE FROM events WHERE id = '$deleteid'";
            $result = mysqli_query($conn, $sql3);
            if ($result === true)
                $notice = "The event is deleted!";
            header("Location: events.php");
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

            <div class="table-box">
                <div class="events-table">
                    <div class="events-table-header">
                        <h2>Events</h2>
                        <a href="event_add.php" class="btn">Add new event</a>
                    </div>
                    <div class="events-table-content">
                        <table id="example" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Start DateTime</th>
                                    <th>End DateTime</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php
                            //Output delete successfully
                            echo '<p align=center style="font-size:20px;font-family: Monaco;">';
                            echo $notice;
                            echo '</p>';

                            //Tabulating Products
                            $sql = mysqli_query($conn, "select * from events");
                            ?>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($sql) > 0) {
                                    while ($row = mysqli_fetch_assoc($sql)) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td id="event_name"><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['start_date'] ?></td>
                                            <td><?php echo $row['end_date'] ?></td>
                                            <td><?php echo $row['description'] ?></td>
                                            <?php
                                            echo '<td><a href="event_update.php?event=' . $row['id'] . '"><ion-icon name="create"></a></td>';
                                            echo '<td><a href="javascript: myDeleteConfirmationFunction(' . $row['id'] . ')"  alt = "delete" class="delete-button"><ion-icon name="trash-outline"></ion-icon></a></td>';
                                            ?>
                                        </tr>
                                <?php      }
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Start DateTime</th>
                                    <th>End DateTime</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
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
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    
    <script>
        // MenuToggle
        let toggle = document.querySelector('.toggle');
        let navigation = document.querySelector('.navigation');
        let main = document.querySelector('.main');

        toggle.onclick = function() {
            navigation.classList.toggle('active');
            main.classList.toggle('active');
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
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

        function mySearchFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("example");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function myDeleteConfirmationFunction(uid) {
            if (confirm('Are You Sure to Delete this Record?')) {
                window.location.href = 'events.php?event=' + uid;
            }
        }
    </script>

</body>

</html>