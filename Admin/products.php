<?php
 session_start();
 if(!isset($_SESSION['admin']))
 {
    header('location:login.php');
 }
 include('header.php');
 include('../connection.php');
 $query="Select * from Category";
 $result=mysqli_query($conn,$query);
 
 $pquery="Select * from Product join Category on Product.pro_cat=Category.cat_id";
 $presult=mysqli_query($conn,$pquery);
 ?>


    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body row">
          <div class="col-12">
           <form method="post" enctype="multipart/form-data" action="DbProduct.php">
           <div class="form-group">
              <label for="inputName">Product Name</label>
              <input type="text" id="inputName" name="proName" class="form-control" />
            </div>
            <div class="form-group">
              <label for="inputName">Product Price</label>
              <input type="number" id="inputName" name="proPrice" class="form-control" />
            </div>
            <div class="form-group">
              <label for="inputName">Product Quantity</label>
              <input type="number" id="inputName" name="proQuantity" class="form-control" />
            </div>
            <div class="form-group">
              <label for="inputName">Product Category</label>
              <select name="proCategory">
                  <?php
                  while($row=mysqli_fetch_assoc($result))
                  {
                  ?>
                  <option value="<?php echo $row['cat_id'];?>"><?php echo $row['cat_name'];?></option>
                  <?php
                  }
                  ?>
            </select>
            </div>
            <div class="form-group">
              <label for="inputName">Product Image</label>
              <input type="file" id="inputName" class="form-control" name="image"/>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary" value="Add Product" name="btnAdd">
            </div>
           </form>
          </div>
        </div>
      </div>
      <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Product Id</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Category</th>
                    <th>Product Quantity</th>
                    <th>Product Image</th>
                  </tr>
                  </thead>
                  <tbody>
<?php
while($prow=mysqli_fetch_assoc($presult))
{
?>
                  <tr>
                    <td><?php echo $prow['pro_id'];?></td>
                    <td><?php echo $prow['pro_name'];?></td>
                    <td><?php echo $prow['pro_price'];?></td>
                    <td><?php echo $prow['cat_name'];?></td>
                    <td><?php echo $prow['pro_quantity'];?></td>
                    <td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($prow['pro_image'])?>" width="100px"height="100px"/></td>
                  </tr>
                  <?php
}
                  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Product Id</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Category</th>
                    <th>Product Quantity</th>
                    <th>Product Image</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



<?php
 include('footer.php');

 ?>