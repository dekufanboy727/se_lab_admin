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
    <title>Add Product</title>
    <link rel="icon" type="image/jpg" href="images/profile.jpg">
    <link rel="stylesheet" href="css/products_edit.css">
</head>

<body>
    <?php //Session Control
        if (empty($_SESSION['logged_in']) == true)
        {
            echo "You are not Logged in";
            header("Location: adminlogout.php");
        }

        //Adding Product Handler
        $name = $price = $category = $quantity = $calorie = $description = "";
        $tempname = $tempprice = $tempcategory = $tempquantity = $tempcalorie = $tempdescription =  "";
        $nameerr = $priceerr = $categoryerr = $quantityerr = $calorieerr = $descriptionerr = $productpicerr = $em = "";
        $validate = true;

        //Upload Handler
        if (isset($_POST['create']) && !empty($_FILES['productpic'])) {
            
            if(empty($_POST["name"]))
            {
                $nameerr = "*Name is required!";
                $validate = false;
            }

            if(empty($_POST["price"]))
            {
                $priceerr = "*Price is required!";
                $validate = false;
            }

            if(empty($_POST["category"]))
            {
                $categoryerr = "*Category is required!";
                $validate = false;
            }

            if(empty($_POST["quantity"]))
            {
                $quantityerr = "*Quantity is required!";
                $validate = false;
            }

            if(empty($_POST["calorie"]))
            {
                $calorieerr = "*Calorie is required!";
                $validate = false;
            }

            if(empty($_POST["description"]))
            {
                $descriptionerr = "*Description is required!";
                $validate = false;
            }

            if($validate == true)
            {   
                $name = $_POST['name'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                $quantity = $_POST['quantity'];
                $calorie = $_POST['calorie'];
                $description = $_POST['description'];
            
                $targetDir = "../product_images/";
                $filename = basename($_FILES["productpic"]["name"]);
                $targetFilePath = $targetDir . $filename;
                $imagefileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                $uploadOk = 1;
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

                
                // Insert into Database
                if(empty($_FILES["productpic"])){
                    $uploadOk = 0;
                    $em = "Please Select A Picture to Upload";
                    
                }else if(file_exists($targetFilePath)){
                    $uploadOk = 0;
                    $em = "Your filename already exists";
    
                }else if(!in_array($imagefileType, $allowTypes)){
                    $uploadOk = 0;
                    $em = "Your file is not an image, only JPG, JPEG, PNG and GIF allowed";
    
                }else if($_FILES["productpic"]["size"] > 500000000){
                    $uploadOk = 0;
                    $em = "Your file is too large";
    
                }else if(!move_uploaded_file($_FILES["productpic"]["tmp_name"], $targetFilePath)){
                    $uploadOk = 0;
                    $em ="There was an error in uploading your file";
                }else{
                    $sql = "INSERT INTO product (product_name, price, product_type, product_desc, product_quan, product_cal, product_img) 
                            VALUES('$name', '$price', '$category', '$description', '$quantity', '$calorie','$targetFilePath')";
                    if(mysqli_query($conn, $sql)){
                        echo "File successfully uploaded";
                    }else{
                        echo "File failed to upload";
                    }
                }
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

            <div class="product">
                <div class="product-details">
                    <div class="product-details-header">
                        <h2>Add New Product</h2>
                    </div>

                    <form name="add" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-25">
                                <label for="name">Name</label>
                            </div>
                            <div class="col-75">
                                <input type="text" name="name" id="name" placeholder="Product name...">
                            </div>
                            <span><?php echo $nameerr ?> </span>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="price">Price</label>
                            </div>
                            <div class="col-75">
                                <input type="number" name="price" id="price" placeholder="RM..."  min="0.01" step = "0.01">
                            </div>
                            <span><?php echo $priceerr ?> </span>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="category">Category</label>
                            </div>
                            <div class="col-75">
                                <select name="category" id="category">
                                    <option value="0" selected disabled>Select Category</option>
                                    <?php
                                        $sql = "SELECT type_name, id FROM product_type";
                                        $result = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_assoc($result)) 
                                        {
                                            echo '<option value="'.$row['id'].'">'.$row['type_name'].'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <span><?php echo $categoryerr ?> </span>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="discount">Product Quantity</label>
                            </div>
                            <div class="col-75">
                                <input type="number" name="quantity" id="quantity" placeholder="Product quantity..." step ="1" min = "1">
                            </div>
                            <span><?php echo $quantityerr ?> </span>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="description">Product Calorie</label>
                            </div>
                            <div class="col-75">
                                <input type="number" name="calorie" id="calorie" placeholder="Product calorie..." step ="1" min = "1">
                            </div>
                            <span><?php echo $calorieerr ?> </span>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="period">Product Description</label>
                            </div>
                            <div class="col-75">
                                <textarea name="description" id="description" placeholder="Product description..."></textarea>
                            </div>
                            <span><?php echo $descriptionerr ?> </span>
                        </div>
                        <br>
                        <div class="row">
                        <div class="row">
                            <div class="col-25">
                                <label for="period">Product Image</label>
                            </div>
                            <div class="col-75">
                                <input type="file" id="productpic" name="productpic">
                            </div>
                            <span><?php echo $em ?> </span>
                        </div>
                        <br>
                        <div class="row">
                            <input type="submit" value="Add Product" name = "create">
                            <a href="products.php"><input type="button" value="Cancel" class="cancel-btn" ></a>
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
        window.onclick = function (product) {
            if (!product.target.matches('.dropbtn')) {
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
        
    </script>

</body>

</html>
