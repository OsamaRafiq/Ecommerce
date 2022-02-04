<?php
session_start();
include('header.php');
include('connection.php');

$query="Select * from product where pro_id IN (".implode(',',$_SESSION['cart']).")";
$result=mysqli_query($conn,$query);
?>
<form method="post" action="saveCart.php">
    <?php echo $_SESSION['msg'];?>
<table class="table table-bordered">
    <tr>
        <th>Product Id</th>
        <th>Product Name</th>
        <th>Product Quantity</th>
        <th>Product Price</th>
        <th>Total Price</th>
        <th>Actions</th>
    </tr>
<?php
$index=0;
$total=0;
if($result)
{
while($row=mysqli_fetch_assoc($result))
{
?>
    <tr>
       <td><?php echo $row['pro_id'];?></td>
       <td><?php echo $row['pro_name'];?></td>
       <input type="hidden" name="indexes[]" value="<?php echo $index;?>"/>
       <td><input type="number" value="<?php echo $_SESSION['quantity'][$index];?>" min=1 name="quan<?php echo $index;?>"/></td>
       <td><?php echo $row['pro_price'];?></td>
       <td><?php echo $_SESSION['quantity'][$index]*$row['pro_price'];?></td>
       <td><a href="deleteCart.php?id=<?php echo $row['pro_id'];?>">Delete</a></td>
    </tr>
<?php

$total+=$_SESSION['quantity'][$index]*$row['pro_price'];
$_SESSION['total']=$total;
$index++;
}
}else{
    echo "<h1> No Item in the Cart</h1>";
}
?>
</table>
<?php echo "<h1>".$total."</h1>";?>
<input type="submit" value="Save Cart" name="btnSave"/>
<a href="clearCart.php" class="btn btn-danger">Clear Cart</a>
<a href="checkout.php" class="btn btn-success">Checkout</a>
</form>
<?php


include('footer.php');
?>