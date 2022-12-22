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
    <title>Orders</title>
    <link rel="icon" type="image/jpg" href="images/profile.jpg">
    <link rel="stylesheet" href="css/orders.css">
</head>

<body>
    <?php //Session Control
        if (empty($_SESSION['logged_in']) == true)
        {
            echo "You are not Logged in";
            header("Location: adminlogout.php");
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
                <li class="hovered active">
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
                    <a href="#">
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
                <div class="orders-table">
                    <div class="orders-table-header">
                        <h2>Orders</h2>
                    </div>
                    <div class="orders-table-content">
                        <table id="example" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Collection</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>22/7/2022 19:30:00</td>
                                    <td>RM50.50</td>
                                    <td>Takeaway</td>
                                    <td>Halzenut Latte</td>
                                    <td>Paid</td>
                                    <td>
                                        <select onchange="status_update(this.options[this.selectedIndex].value)"> <!-- this.options[this.selectedIndex].value, <?php echo $row['id'] ?> -->
                                            <option selected disabled>Update Status</option>
                                            <option value="preparing">Preparing</option>
                                            <option value="done">Done</option>
                                            <option value="calcel">Cancel</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>22/7/2022 19:30:00</td>
                                    <td>RM50.50</td>
                                    <td>Takeaway</td>
                                    <td>Halzenut Latte</td>
                                    <td>Paid</td>
                                    <td>
                                        <select onchange="status_update(this.options[this.selectedIndex].value)"> <!-- this.options[this.selectedIndex].value, <?php echo $row['id'] ?> -->
                                            <option selected disabled>Update Status</option>
                                            <option value="preparing">Preparing</option>
                                            <option value="done">Done</option>
                                            <option value="calcel">Cancel</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>22/7/2022 19:30:00</td>
                                    <td>RM50.50</td>
                                    <td>Takeaway</td>
                                    <td>Halzenut Latte</td>
                                    <td>Paid</td>
                                    <td>
                                        <select onchange="status_update(this.options[this.selectedIndex].value)"> <!-- this.options[this.selectedIndex].value, <?php echo $row['id'] ?> -->
                                            <option selected disabled>Update Status</option>
                                            <option value="preparing">Preparing</option>
                                            <option value="done">Done</option>
                                            <option value="calcel">Cancel</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>22/7/2022 19:30:00</td>
                                    <td>RM50.50</td>
                                    <td>Takeaway</td>
                                    <td>Halzenut Latte</td>
                                    <td>Paid</td>
                                    <td>
                                        <select onchange="status_update(this.options[this.selectedIndex].value)"> <!-- this.options[this.selectedIndex].value, <?php echo $row['id'] ?> -->
                                            <option selected disabled>Update Status</option>
                                            <option value="preparing">Preparing</option>
                                            <option value="done">Done</option>
                                            <option value="calcel">Cancel</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>22/7/2022 19:30:00</td>
                                    <td>RM50.50</td>
                                    <td>Takeaway</td>
                                    <td>Halzenut Latte</td>
                                    <td>Paid</td>
                                    <td>
                                        <select onchange="status_update(this.options[this.selectedIndex].value)"> <!-- this.options[this.selectedIndex].value, <?php echo $row['id'] ?> -->
                                            <option selected disabled>Update Status</option>
                                            <option value="preparing">Preparing</option>
                                            <option value="done">Done</option>
                                            <option value="calcel">Cancel</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>22/7/2022 19:30:00</td>
                                    <td>RM50.50</td>
                                    <td>Takeaway</td>
                                    <td>Halzenut Latte</td>
                                    <td>Paid</td>
                                    <td>
                                        <select onchange="status_update(this.options[this.selectedIndex].value)"> <!-- this.options[this.selectedIndex].value, <?php echo $row['id'] ?> -->
                                            <option selected disabled>Update Status</option>
                                            <option value="preparing">Preparing</option>
                                            <option value="done">Done</option>
                                            <option value="calcel">Cancel</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>22/7/2022 19:30:00</td>
                                    <td>RM50.50</td>
                                    <td>Takeaway</td>
                                    <td>Halzenut Latte</td>
                                    <td>Paid</td>
                                    <td>
                                        <select onchange="status_update(this.options[this.selectedIndex].value)"> <!-- this.options[this.selectedIndex].value, <?php echo $row['id'] ?> -->
                                            <option selected disabled>Update Status</option>
                                            <option value="preparing">Preparing</option>
                                            <option value="done">Done</option>
                                            <option value="calcel">Cancel</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>22/7/2022 19:30:00</td>
                                    <td>RM50.50</td>
                                    <td>Takeaway</td>
                                    <td>Halzenut Latte</td>
                                    <td>Paid</td>
                                    <td>
                                        <select onchange="status_update(this.options[this.selectedIndex].value)"> <!-- this.options[this.selectedIndex].value, <?php echo $row['id'] ?> -->
                                            <option selected disabled>Update Status</option>
                                            <option value="preparing">Preparing</option>
                                            <option value="done">Done</option>
                                            <option value="calcel">Cancel</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>22/7/2022 19:30:00</td>
                                    <td>RM50.50</td>
                                    <td>Takeaway</td>
                                    <td>Halzenut Latte</td>
                                    <td>Paid</td>
                                    <td>
                                        <select onchange="status_update(this.options[this.selectedIndex].value)"> <!-- this.options[this.selectedIndex].value, <?php echo $row['id'] ?> -->
                                            <option selected disabled>Update Status</option>
                                            <option value="preparing">Preparing</option>
                                            <option value="done">Done</option>
                                            <option value="calcel">Cancel</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>22/7/2022 19:30:00</td>
                                    <td>RM50.50</td>
                                    <td>Takeaway</td>
                                    <td>Halzenut Latte</td>
                                    <td>Paid</td>
                                    <td>
                                        <select onchange="status_update(this.options[this.selectedIndex].value)"> <!-- this.options[this.selectedIndex].value, <?php echo $row['id'] ?> -->
                                            <option selected disabled>Update Status</option>
                                            <option value="preparing">Preparing</option>
                                            <option value="done">Done</option>
                                            <option value="calcel">Cancel</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>22/7/2022 19:30:00</td>
                                    <td>RM50.50</td>
                                    <td>Takeaway</td>
                                    <td>Halzenut Latte</td>
                                    <td>Paid</td>
                                    <td>
                                        <select onchange="status_update(this.options[this.selectedIndex].value)"> <!-- this.options[this.selectedIndex].value, <?php echo $row['id'] ?> -->
                                            <option selected disabled>Update Status</option>
                                            <option value="preparing">Preparing</option>
                                            <option value="done">Done</option>
                                            <option value="calcel">Cancel</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>22/7/2022 19:30:00</td>
                                    <td>RM50.50</td>
                                    <td>Takeaway</td>
                                    <td>Halzenut Latte</td>
                                    <td>Paid</td>
                                    <td>
                                        <select onchange="status_update(this.options[this.selectedIndex].value)"> <!-- this.options[this.selectedIndex].value, <?php echo $row['id'] ?> -->
                                            <option selected disabled>Update Status</option>
                                            <option value="preparing">Preparing</option>
                                            <option value="done">Done</option>
                                            <option value="calcel">Cancel</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
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
        function status_update(value) {
            alert(value);
        }
    </script>

</body>

</html>