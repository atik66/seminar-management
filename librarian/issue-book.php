<?php
require_once 'header.php';


if(isset($_POST['issue-book'])){
  
   $student_id=$_POST['student_id'];
   $book_id=$_POST['book_id'];
   $issue_date=$_POST['issue_date'];

   $result=mysqli_query($con,query:"INSERT INTO `issue-books`(`student_id`, `book_id`, `issue_date`) VALUES ('$student_id','$book_id','$issue_date')");

   mysqli_query($con,"UPDATE `book_individual` set `status`='1' where `barcode`='$book_id' ");


  

      $res=mysqli_query($con,"SELECT * from `book_individual` where `barcode`='$book_id'");
      $check_isbn =mysqli_fetch_assoc($res);
      $isbn_number=$check_isbn['isbn'];



if($result){
    mysqli_query($con,"UPDATE `book` SET `available_book`=`available_book`-1 WHERE `isbn`='$isbn_number'");
?>

<script type='text/javascript'> alert('Book is issued');</script>
<?php
}

else{
    ?>

    <script type='text/javascript'> alert('Book is not issued');</script>

<?php

}


}


?>
                <!-- content HEADER -->
                <!-- ========================================================= -->
                <div class="content-header">
                    <!-- leftside content header -->
                    <div class="leftside-content-header">
                        <ul class="breadcrumbs">
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                            <li><a href="javascript:avoid()">Issue Book</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
           <div class="row animated fadeInUp">
              <div class="col-sm-6 col-sm-offset-3">
                 <div class='panel'>
                    <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-inline"  method="POST">
                                    
                                        <div class="form-group">



                                           
                                            <select  class="form-control" name="student_id">
                                              <option value="">select</option>
                                              <?php

                                              $result =mysqli_query($con,query:"SELECT * FROM `students` WHERE  `status`='1'");

                                              while($row=mysqli_fetch_assoc($result)){
                                                  print_r($result);
                                                  ?>
                                                <option value="<?=$row['id']?>"><?=ucwords($row['fname']." ".$row['lname']). ' -('. $row['roll'].')'?> </option>
                                            <?php
                                              }

                                               ?>
                                              
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <button type="submit" name="search" class="btn btn-primary">search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <?php
                            if(isset($_POST['search'])){
                                 // print_r($_POST);
                                   $id=$_POST['student_id'];

                                   $result =mysqli_query($con,query:"SELECT * FROM `students` WHERE `id`='$id' AND `status`='1'");
                                   $row=mysqli_fetch_assoc($result);

                                   //print_r($row);
                            

?>


<div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method='POST'>
                                       
                                        <div class="form-group">
                                            <label for="name">student Name</label>
                                            <input type="text" class="form-control" id="name" value="<?=ucwords($row['fname']." ".$row['lname'])?>" readonly >
                                            <input type='hidden' value="<?=$row['id']?>" name='student_id'>
                                        </div>
                                        

                                       <div class='form-group'>

                                         <lebel>Book</lebel>
                                         <select  class="form-control" name="book_id">
                                              <option value="">select</option>
                                              <?php

                                              $result =mysqli_query($con,query:"SELECT * FROM `book_individual` WHERE `status`='0'");

                                              while($row=mysqli_fetch_assoc($result)){
                                                       $isbn=$row['isbn'];
                                                    
                                                    $resi=mysqli_query($con,"SELECT * FROM `book` where `isbn`='$isbn'");
                                                    $row1=mysqli_fetch_assoc($resi);
                                                    $chec_id=$row1['chec_id'];

                                                    $book=mysqli_query($con,"SELECT * from book_cat where `chec_id`='$chec_id'");
                                                    $book_name=mysqli_fetch_assoc($book);





                                                  ?>
                                                <option value="<?=$row['barcode']?>"><?=$book_name['book_name'].'-'.$row['barcode']?> </option>
                                            <?php
                                              }

                                               ?>
                                              
                                            </select>


                            </div>



                           <div class='form-group'>

                                         <lebel>Issue Book Date</lebel>
                                         
                                          <input class='form-control' name='issue_date' type='text' value="<?=date('d-m-y')?>">

                                            </div>

                                        <div class="form-group">
                                            <button type="submit" name='issue-book' class="btn btn-primary">Save Issue Book</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                            <?php

                            
                            
                                }  
                            ?>

                                   
                
                 
                  
             </div>   
      </div>
     
    </div>
 </div>

<?php

require_once 'footer.php'

?>