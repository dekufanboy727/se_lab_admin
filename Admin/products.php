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
    <title>Products</title>
    <link rel="icon" type="image/jpg" href="images/profile.jpg">
    <link rel="stylesheet" type="text/css" href="css/products.css">
    <script src="https://kit.fontawesome.com/4fdfa3530e.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php //Session Control
        if (empty($_SESSION['logged_in']) == true)
        {
            echo "You are not Logged in";
            header("Location: adminlogout.php");
        }

        $notice = "";
        //Product Deletion
        if($_SERVER["REQUEST_METHOD"] == "GET")
        {
            if(isset($_GET['product']) == true){
                $deleteid = $_GET['product'];
                $sql3 = "DELETE FROM product WHERE product_id = '$deleteid'";
                $result = mysqli_query($conn,$sql3);
                if($result === true)
                    $notice = "A product is deleted!";
                    unlink($result["product_img"]);
                    header("Location: products.php");
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
                <li class="hovered active">
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
                <div class="products-table">
                    <div class="products-table-header">
                        <h2>Products</h2>
                        <a href="product_add.php" class="btn"><i class="fa-solid fa-plus"></i> Add New Product</a>
                    </div>
                    <div class="products-table-content">
                        <table id="example" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price (RM)</th>
                                    <th>Quantity</th>
                                    <th>Calorie (kcal)</th>
                                    <th>Best seller</th>
                                    <th>Pixel</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <?php
                                //Output delete successfully
                                echo '<p align=center style="font-size:20px;font-family: Monaco;">';
                                echo $notice;
                                echo '</p>';

                                //Tabulating Products
                                $sql = mysqli_query($conn, "select * from product");
                            ?>
                            <tbody>
                            <?php
                                if (mysqli_num_rows($sql) > 0) {
                                    while ($row = mysqli_fetch_assoc($sql)) {
                                        $sql1 = mysqli_query($conn, "select * from product_type where id ='".$row['product_type']."';");
                                        $row1 = mysqli_fetch_assoc($sql1)
                            ?>
                                        <tr>
                                            <td><?php echo '<img src="'.$row["product_img"].'" height ="100" width = "100">' ?></td>
                                            <td><?php echo $row1['type_name']?></td>
                                            <td id = "product_name"><?php echo $row['product_name'] ?></td>
                                            <td><?php echo $row['product_desc'] ?></td>
                                            <td><?php echo $row['price'] ?></td>
                                            <td><?php echo $row['product_quan'] ?></td>
                                            <td><?php echo $row['product_cal'] ?></td>
                                            <td><?php echo $row['best_seller'] ?></td>
                                            <td><?php echo $row['pixel'] ?></td>
                                            <?php 
                                                echo '<td><a href="product_edit.php?product='.$row['product_id'].'"><i class="fa-solid fa-pen-to-square"></i></a></td>';
                                                echo '<td><a href="javascript: myDeleteConfirmationFunction('.$row['product_id'].')"  alt = "delete" class="delete-button"><i class="fa-regular fa-trash-can"></i></a></td>';
                                            ?>
                                        </tr>
                                <?php      }
                                } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Image</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price (RM)</th>
                                    <th>Quantity</th>
                                    <th>Calorie (kcal)</th>
                                    <th>Best seller</th>
                                    <th>Pixel</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
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

        toggle.onclick = function () {
            navigation.classList.toggle('active');
            main.classList.toggle('active');
        }

        function myDeleteConfirmationFunction(uid) {
            if (confirm('Are You Sure to Delete this Record?'))
            {
                window.location.href = 'products.php?product=' + uid;
            }
        }
    </script>
</body>

</html>
