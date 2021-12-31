<?php
require_once 'header.php'?>
          <div class="content-header">
                    <!-- leftside content header -->
                    <div class="leftside-content-header">
                        <ul class="breadcrumbs">
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Book</a></li>


                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">
                <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-content">
                                <form method="POST">
                                    <div class="row pt-md">
                                        <div class="form-group col-sm-9 col-lg-10">
                                                <span class="input-with-icon">
                                            <input type="text" name="bb" class="form-control" id="lefticon" style='text-align:center' placeholder="Book-Name/Book-Publication/Author" required>
                                            <i class="fa fa-search"></i>
                                        </span>
                                        </div>
                                        <div class="form-group col-sm-3  col-lg-2 ">
                                            <button type="submit" name="book"  class="btn btn-primary btn-block">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
</div>
                      <?php
                       if(isset($_POST['book'])){
                           $re=$_POST['bb'];
                         ?>
 <div class='col-sm-12'>

<div  class='panel'>

   <div class='panel-content'>

       <div class='row'>
           <?php
             $result=mysqli_query($con,"SELECT * FROM `book_cat` WHERE  `book_name` like '%$re%' OR `book_author_name` like '%$re%' OR `book_publication_name` like '%$re%' ");
             $total=mysqli_num_rows($result);
             
             if($total==0){
                ?>

                 <h1 style="color:orange;text-align:center;" > Sorry!! Book Not Found </h1>

                <?php
                
             }

             else{
                ///$result=mysqli_query($con,"SELECT * FROM book_cat");
                //$i=mysqli_num_rows($result);
              while($ans=mysqli_fetch_assoc($result)){
               $check=$ans['chec_id'];
   
               $res=mysqli_query($con,"SELECT * from `book` where `chec_id`='$check'");
   
                while($book_=mysqli_fetch_assoc($res)){
                $isbn_no=$book_['isbn'];
                $bar=mysqli_query($con,"SELECT * from `book_individual` where `isbn`='$isbn_no'");
   
                $bar_no=mysqli_fetch_assoc($bar);
   
                $resul=mysqli_query($con,"SELECT * from `book` where `isbn`='$isbn_no'");
   
                $row=mysqli_fetch_assoc($resul);
             

                 ?>
               <div class='col-sm-3 col-md-2'>

                <img src='../images/Books/<?=$book_['book_image']?>' height='100' width='100'>
               <p><h5><?=$ans['book_name'].'-'.$book_['edition']?></h5></p>
               <span><b style='color:orange'>Avalable : <?=$row['available_book']?></b></span><br>
               <a href="details.php?id=<?=$bar_no['barcode']?>" class="btn btn-primary"> Details</a>
                
                  </div>
                  <?php
           }

        }
             ?>

                  </div>


                  </div>


                  </div>

                  </div>



<?php
                             

                       }

                    }
                       else{
                    
                         ?>



<div class='col-sm-12'>

<div  class='panel'>

   <div class='panel-content'>

       <div class='row'>
           <?php
             $result=mysqli_query($con,"SELECT * FROM book_cat");
             //$i=mysqli_num_rows($result);
           while($ans=mysqli_fetch_assoc($result)){
            $check=$ans['chec_id'];

            $res=mysqli_query($con,"SELECT * from book where `chec_id`='$check'");

             while($book_=mysqli_fetch_assoc($res)){
             $isbn_no=$book_['isbn'];
             $bar=mysqli_query($con,"SELECT * from `book_individual` where `isbn`='$isbn_no'");

             $bar_no=mysqli_fetch_assoc($bar);

             $resul=mysqli_query($con,"SELECT * from `book` where `isbn`='$isbn_no'");

             $row=mysqli_fetch_assoc($resul);


                         ?>
               <div class='col-sm-3 col-md-2'>

               <img src='../images/Books/<?=$book_['book_image']?>' height='100' width='100'>
               <p><h5><?=$ans['book_name'].'-'.$book_['edition']?></h5></p>
               <span><b style='color:orange'>Avalable : <?=$row['available_book']?></b></span><br>
               <a href="details.php?id=<?=$bar_no['isbn']?>" class="btn btn-primary"> Details</a>
              
                  
                             
                  </div>
                  <?php
           
        }
    }
             ?>

                  </div>


                  </div>


                  </div>

                  </div>


<?php

                               
                       }
         


?>



  
  


              
 

</div>
<?require_once 'footer.php'
?>