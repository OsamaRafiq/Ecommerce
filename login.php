<?php
session_start();
if(isset($_POST['btnLogIn']))
{
    include('connection.php');
    $email=$_POST['email'];
    $password=$_POST['password'];

    $query="SELECT * FROM `customer` WHERE `cust_email`='$email' && `cust_password`='$password'";
    $result=mysqli_query($conn,$query);
    if($result)
    {
       if(mysqli_num_rows($result)>0)
       {
            $row=mysqli_fetch_assoc($result);
            $_SESSION["customer"]=$row['cust_name'];
            $_SESSION["customerID"]=$row['cust_id'];
           header('location:index.php');
       }
    }else{
        echo "<script>alert('Invalid Credentials');</script>";
    }
}
include('header.php');



?>

<!-- inner page section -->
<section class="inner_page_head">
         <div class="container_fuild">
            <div class="row">
               <div class="col-md-12">
                  <div class="full">
                     <h3>Log In</h3>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end inner page section -->
      <!-- why section -->
      <section class="why_section layout_padding">
         <div class="container">
         
            <div class="row">
               <div class="col-lg-8 offset-lg-2">
                  <div class="full">
                     <form method="post">
                        <fieldset>
                          
                           <input type="email" placeholder="Enter your email address" name="email" required />
                           <input type="password" placeholder="Enter Password" name="password" required />
                          
                           <input type="submit" value="LogIn" name="btnLogIn" />
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end why section -->
      <!-- arrival section -->
      <section class="arrival_section">
         <div class="container">
            <div class="box">
               <div class="arrival_bg_box">
                  <img src="images/arrival-bg.png" alt="">
               </div>
               <div class="row">
                  <div class="col-md-6 ml-auto">
                     <div class="heading_container remove_line_bt">
                        <h2>
                           #NewArrivals
                        </h2>
                     </div>
                     <p style="margin-top: 20px;margin-bottom: 30px;">
                        Vitae fugiat laboriosam officia perferendis provident aliquid voluptatibus dolorem, fugit ullam sit earum id eaque nisi hic? Tenetur commodi, nisi rem vel, ea eaque ab ipsa, autem similique ex unde!
                     </p>
                     <a href="">
                     Shop Now
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- end arrival section -->
      <?php
include('footer.php');
?>