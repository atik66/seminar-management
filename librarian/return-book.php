<?php
require_once 'header.php';
require_once '../dbcon.php';
?>
                <!-- content HEADER -->
                <!-- ========================================================= -->
                <div class="content-header">
                    <!-- leftside content header -->
                    <div class="leftside-content-header">
                        <ul class="breadcrumbs">
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                            <li><a href="javascript:avoid()">Return Book</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">

                <div class="col-sm-12">
                    <h4 class="section-subtitle"><b>Return Book</b></h4>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                                <table id="basic-table" class="table-bordered data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Roll</th>
                                        <th>Phone</th>
                                        <th>Book id</th>
                                       
                                        <th>Book Image</th>
                                        <th>Book name</th>
                                        <th>Issue Date</th>
                                        <th>fine</th>
                                        
                                        <th>Return Book</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                $result =mysqli_query($con,query:"SELECT * from `issue-books`");

                                 while($row=mysqli_fetch_assoc($result)){
                            
                                  if($row['book_return_time']==null){
                                     
                                    $new=(int)date('d-m-y');
                                    $old=(int)date($row['issue_date']);
                                    

                                     
                                   $days=($new-$old);
                                    echo $days;

                                  if((int)$days-7){
                                    
                                    $a=($days-7);

                                    $fine=((int)(($a+7-1)/7)*5);

                                      }
                                    else{
                                   $fine=0;
                                  }
                                    
                                 $finedai=mysqli_query($con,"UPDATE `issue-books` set `fine`='$fine'");

                                  $student_id=$row['student_id'];
                                
                                 $student_details=mysqli_query($con,"SELECT * from `students` where `id`='$student_id'"); 
                                 $student=mysqli_fetch_assoc($student_details);
                                  
                                 $book_id=$row['book_id'];
                               
                                $check=mysqli_query($con,"SELECT * from `book_individual` where `barcode`='$book_id'");
                                $checkout=mysqli_fetch_assoc($check);
                                $isbn=$checkout['isbn'];
                                       
                                $chec=mysqli_query($con,"SELECT * from `book` where `isbn`='$isbn'");
                                $check_id=mysqli_fetch_assoc($chec);
                                $chec_id=$check_id['chec_id'];
                                $book_details=mysqli_query($con,"SELECT * from `book_cat` where `chec_id`='$chec_id'");
                                $book=mysqli_fetch_assoc($book_details);
                                

?>
                            
                     <tr>
                    <td><?=ucwords($student['fname']." ".$student['lname'])?></td>
                 <td><?=$student['roll']?></td>
                <td><?=$student['phone']?></td>
                <td><?=$checkout['barcode']?></td>
                <td><img src="../images/Books/<?=$check_id['book_image']?>" width="50" height="50"></td>
                <td><?=$book['book_name']?></td>
                <td><?=$row['issue_date']?></td>
                <td><?=$fine?></td>
                
                <td><a href="return-book.php?id=<?=$row['id']?>&book_id=<?=$row['book_id']?>&isbn=<?=$checkout['isbn']?>"> Return book</a></td>
                             </tr>
                             <?php
                             }
                            }
                             ?>
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
</div>

<?php


if(isset($_GET['id'])){

    

   $id=$_GET['id'];
   $book_id=$_GET['book_id'];
   $isbn=$_GET['isbn'];

  
   $date=date('d-m-y');
    $result=mysqli_query($con,"UPDATE `issue-books` SET `book_return_time`='$date' WHERE `id`='$id'");
   if($result){
    
 
    mysqli_query($con,"UPDATE `book_individual` SET `status`='0' WHERE `barcode`='$book_id'");
    mysqli_query($con,"UPDATE `book` SET `available_book`=`available_book`+1 WHERE `isbn`='$isbn'");
    mysqli_query($con,"UPDATE `reservation` set `status`='0' where `barcode`='$book_id'");


     ?>
<script>alert('book return successfully')
javascript:history.go(-1);
</script>
<?php



   }

  else{
?>
<script>alert('somethong wrong')

javascript:history.go(-1);
</script>
<?php



  }
 
 
}

?>
 
 
   





<?php

require_once 'footer.php'

?>