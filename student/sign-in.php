

  <?php
    require_once '../dbcon.php';
session_start();

if(isset($_SESSION['student_login'])){
    header('location: index.php');
 
 }
 

    
     if(isset($_POST['login'])){

          $email=$_POST['email'];
          $password=$_POST['password'];

     $result=$email_check=mysqli_query($con ,query:"SELECT * FROM `students` WHERE `email`='$email' OR `username`='$email'");
      // echo $result;
      
      if(mysqli_num_rows($result)==1){
      $row = mysqli_fetch_assoc($result);
       if(password_verify($password,$row['password'])){
           if($row['status']==1){
               
            $_SESSION['student_login']=$email;
            $_SESSION['student_id']=$row['id'];
            header('location:index.php');
              
            }
           else{
               $error="Your status inactive";
           }
       }
       else{
           $pass_error="password invalid";
       }
     
      }
    else{
      $error="The email or username not valid";
    }

     }

?>


<!doctype html>
<html lang="en" class="fixed accounts sign-in">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>library_managment</title>
  
    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/vendor/animate.css/animate.css">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assets/stylesheets/css/style.css">
</head>

<body>
<div class="wrap">
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body animated slideInDown">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--LOGO-->
        <div style="left:10px" class="logo">
            <h1 style="margin:11px" >LIBRARY MANAGMENT</h1>
            <?php
              if(isset($error)){

              ?>
            <div class="alert alert-danger" role="alert">
                 <?= $error?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span  aria-hidden="true">&times;</span>
  </button>
              </div>         
<?php
              }


?>

<?php
              if(isset($pass_error)){

              ?>
            <div class="alert alert-danger" role="alert">
                 <?= $pass_error?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span  aria-hidden="true">&times;</span>
  </button>
              </div>         
<?php
              }

              ?>

        </div>
        <div class="box">
            <!--SIGN IN FORM-->
            <div class="panel mb-none">
                <div class="panel-content bg-scale-0">
                    <form method="POST" action="<?= $_SERVER["PHP_SELF"]?>">
                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control" id="email" placeholder="Email/Username" name="email">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                <i class="fa fa-key"></i>
                            </span>
                        </div>
                        <div class="form-group">
                            <div class="checkbox-custom checkbox-primary">
                                <input type="checkbox" id="remember-me" value="option1" checked>
                                <label class="check" for="remember-me">Remember me</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Sign in" class="btn btn-primary btn-block" name="login">
                           
                        </div>
                        <div class="form-group text-center">
                            <a href="pages_forgot-password.html">Forgot password?</a>
                            <hr/>
                             <span>Don't have an account?</span>
                            <a href="register.php" class="btn btn-block mt-sm">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
</div>
<!--BASIC scripts-->
<!-- ========================================================= -->
<script src="../assets/vendor/jquery/jquery-1.12.3.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/vendor/nano-scroller/nano-scroller.js"></script>
<!--TEMPLATE scripts-->
<!-- ========================================================= -->
<script src="../assets/javascripts/template-script.min.js"></script>
<script src="../assets/javascripts/template-init.min.js"></script>
<!-- SECTION script and examples-->
<!-- ========================================================= -->
</body>



</html>
