<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:user_page.php');

      }
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="r_styles.css">



</head>
<body>
   
<nav class="navbar">


        <div class="navbar__container">


            <a href="index.php" id="navbar__logo"> Project Z</a>
            
            <div class="navbar__toggle" id="mobile-menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
              </div>

            <ul class="navbar__menu">
                

                <li class="navbar__item">
                    <a href="AboutU.html" class="navbar__links">About Us</a>
                </li>

                <li class="navbar__item">
                    <a href="Contact.html" class="navbar__links">Contact</a>
                </li>

                <li class="navbar__item">
                    <a href="https://regentsportal.engagehosted.com/vle/" class="navbar__links">Engage Portal</a>
                </li>
                
                <li class="navbar__item">
                    <a href="https://sites.google.com/regents.ac.th/parents/home?authuser=0" class="navbar__links">Regent Website</a>
                </li>
                
                <li class="navbar__btn">
                    <a href="register_form.php" class="button">SignUp</a>
                </li>

         
            </ul>
        </div>
    </nav>



<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="register_form.php">register now</a></p>
   </form>


   <div class="logo">
          <img id="log_logo"src="images/formula-animate.svg" style="height: 60%;"/>
</div>

</div>

</body>
</html>