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

                    <form action="">
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-25">
                                <label for="name">Name</label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="name" id="name" placeholder="Event name...">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="date">Date</label>
                            </div>
                            <div class="col-75">
                                <input type="datetime-local" name="date" id="date" placeholder="Event date...">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="period">Period</label>
                            </div>
                            <div class="col-75">
                                <input type="time" name="period" id="period" placeholder="Event period...">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="category_id">Affected Category ID</label>
                            </div>
                            <div class="col-75">
                                <select name="category_id" id="category_id">
                                    <option value="0" selected disabled>Select Category ID</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="discount">Discount</label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="discount" id="discount" placeholder="RM">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="description">Description</label>
                            </div>
                            <div class="col-75">
                                <textarea name="descripton" id="description" placeholder="Event description..."></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <input type="submit" value="Update">
                        </div>
                    </form>

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