<?php
session_start();
include('connection.php');
$today=date('Y-m-d');
$cust=$_SESSION['customerID'];
$total=$_SESSION['total'];
$Oquery="INSERT INTO `orders`(`order_date`, `cust_id`, `total_amount`) VALUES ('$today','$cust','$total')";
$Oresult=mysqli_query($conn,$Oquery);
if($Oresult)
{
    $orderId=mysqli_insert_id($conn);
    $query="Select * from product where pro_id IN (".implode(',',$_SESSION['cart']).")";
    $result=mysqli_query($conn,$query);
    $index=0;
    while($row=mysqli_fetch_assoc($result))
    {
        echo "<script>alert(".$row['pro_id'].");</script>";
        $p_id=$row['pro_id'];
        $p_name=$row['pro_name'];

        $p_name=str_replace("'","\'",$p_name);

        $p_price=$row['pro_price'];
        $p_quantity=$_SESSION['quantity'][$index];

        $iquery="INSERT INTO `invoice`(`order_id`, `pro_id`, `pro_name`, `pro_quantity`, `pro_price`) VALUES('$orderId','$p_id','$p_name','$p_quantity','$p_price')";
        $iresult=mysqli_query($conn,$iquery);
        if(!$iresult)
        {
            echo "Error in invoice ".mysqli_error($conn);
        }
        $index++;
    }
    //mail
    unset($_SESSION['cart']);
    unset($_SESSION['quantity']);
    unset($_SESSION['total']);
    $_SESSION['msg']="Order Placed successfully";
    header("location:index.php");
}else{
    echo "Error ".mysqli_error($conn);
}


?>