<?php
include('../connection.php');
if(isset($_POST['btnAdd']))
{
    $name=$_POST['proName'];
    $price=$_POST['proPrice'];
    $quantity=$_POST['proQuantity'];
    $category=$_POST['proCategory'];

    $image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $query="INSERT INTO `product`(`pro_name`, `pro_price`, `pro_cat`, `pro_quantity`, `pro_image`) VALUES('$name','$price','$category','$quantity','$image')";
    $result=mysqli_query($conn,$query);
    if($result)
    {
        header("location:products.php");
    }else
    {
        echo "<script>alert('Product Not Added');</script>";
    }
}
?>