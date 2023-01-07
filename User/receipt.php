<?php
    session_start();
    include 'dbConnection.php';

    if(!empty($_GET['status'])){
        session_destroy();
        unset($_SESSION['email']);
        unset($_SESSION['id']);
        header('Location: index.php');
    }

    if (isset($_GET['return'])) {
    
  
        $email = $_SESSION['email'];    
        

            $to = 'helfcoffee1@gmail.com';
            $subject = 'New Order Notification';         
            $headers = "From: helfcoffee1@gmail.com";
            $content =" New order has been placed by customer:" .$email.  "\n Please proceed to admin's dashboard to update order status";
            
            $to2 =  $email;
            $subject2 = 'Order Successfully Placed';         
            $headers2 = "From: helfcoffee1@gmail.com";
            $content2 =" Dear :" .$email. "\n Your order has been successfully placed on Helf Coffee and admin has been notified, please await for your order's arrival.\n Thank you";


            


            if (mail($to, $subject, $content, $headers) && mail($to2, $subject2, $content2, $headers2)){

                echo("<script> alert('Order successfully placed!')  </script>");

            }else{
                echo ("<script> alert('There was an error in placing your order, please try again ')  </script>");
            }

            $orderid = $_SESSION['orderid'];
            $sql2 = "INSERT INTO transaction(order_id) VALUES('$orderid')";

            if ($conn->query($sql2) === FALSE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
                return false;
            }
            
            unset($_SESSION['orderid']);
            unset($_SESSION['datetime']);
            unset($_SESSION['dmethod']);
            unset($_SESSION['total_amount']);

            $sql = "DELETE FROM cart_temp";
            if ($conn->query($sql) === FALSE) {
                   echo "Error: " . $sql . "<br>" . $conn->error;
                   return false;
             }else{
                header('Location: index.php?success=yes');
             }

    
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/receipt_style.css">
        <link href="https://fonts.googleapis.com/css2?family=Marhey:wght@300;400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Helf Coffee Official Website</title>
    </head>
    <body>
        <div class="logo">
            <a href="index.php"><img src="images/helf_coffee_logo.png" alt="Helf Coffee Logo" style="width: 250px" href="index.php"></a>
        </div>
        <div class="container">
            <h2>Customer Receipt</h2>
        </div>

        <div class="receipt_container">
            <div class="details">
                <?php   
                    $sql = "SELECT * FROM orders";
                    $result = $conn->query($sql);
                    while($data = mysqli_fetch_array($result)) 
                    {

                        $receipt = $data['order_id'];
                        $_SESSION['orderid'] = $receipt;
                        $date = $data['order_date'];
                    }
                ?>
                <div class="delivery_dt">
                    <h2><?php echo $date; ?></h2>
                    <small>Delivery Date Time</small>
                </div>
                <div class="order_num">
                    <h2>#<?php echo $receipt?></h2>
                    <small>Order Number</small>
                </div>   
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                <?php

                    $sql= "SELECT * FROM cart_temp";
                    $result = $conn->query($sql);
                    $sub_order = 0;
                    $dmethod = $_SESSION['dmethod'];
                    $total_order = 0;

                    while($data = mysqli_fetch_array($result)) 
                    {
                        $product_id = $data['product_id'];

                        $sub_order = $sub_order + $data['total_price'];

                        ?>
                        <tr>            
                        <td><?php echo $data['product_name']; ?></td>
                        <td>RM<?php echo number_format($data['price'], 2);?></td>
                        <td><?php echo $data['quantity']; ?></td>
                        <td>RM<?php echo number_format($data['total_price'], 2);?></td>
                        </tr>

                        <?php

                        if($dmethod == "Self-Pickup"){                       
                            $fee = 0;
                        }else{
                            $fee = 8;
                        }    
                        
                        $total_order = $sub_order + $fee;
                    }

                    ?>			
                    <tr>
                        <td colspan="3" style="text-align: right;">Subtotal</td>
                        <td>
                            RM<?php echo number_format($sub_order, 2);?>
                        </td>
                    </tr> 
                    <tr>
                        <td colspan="3" style="text-align: right;">Delivery Fee</td>
                        <td>
                            RM<?php echo number_format($fee, 2);?>
                        </td>
                    </tr> 
                    <tr>
                        <td colspan="3s" style="text-align: right;">Total</td>
                        <td>
                            RM<?php echo number_format($total_order, 2);?>
                        </td>
                    </tr> 
                    
                </tbody>
            </table>
        </div>
        <div class="container">
            <button class="confirm"><a href="receipt.php?return='1'">Confirm</a></button>
        </div>
    </body>
</html>
