<?php
session_start();
if(isset($_SESSION['customer']))
{
if(!in_array($_GET['id'],$_SESSION['cart']))
{
    array_push($_SESSION['cart'],$_GET['id']);
    array_push($_SESSION['quantity'],1);
    $_SESSION['msg']="Added Successfully";
    header('location:products.php');
}else{
   
    $_SESSION['msg']="Item is already in the cart";
    header('location:products.php');
}
}else{
    header('location:login.php');
}


?>