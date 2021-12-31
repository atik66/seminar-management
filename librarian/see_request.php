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
                            <li><a href="javascript:avoid()">Student</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">

                <div class="col-sm-12">
                    <h4 class="section-subtitle"><b>All Student</b></h4>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                                <table id="basic-table"  class="data-table table  table-bordered table-striped nowrap table-hover" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                       
                                    <th>stduent </th>
                                        <th>student id</th>
                                        <th>Book Name</th>
                                        <th>Bar code</th>
                                        <th>Book Image</th>
                                        <th>Edition</th> 
                                        <th>Action</th>

                                       
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $reserve=mysqli_query($con,"SELECT * from `reservation`");
                                    while($reservation=mysqli_fetch_assoc($reserve)){
                                     if($reservation['status']=='0'){   
                                    $book_barcode=$reservation['barcode'];
                                    $student_id=$reservation['student_id'];
                                    $student_detail =mysqli_query($con,"SELECT * from `students` where `id`='$student_id'");
                                    $student=mysqli_fetch_assoc($student_detail);

                                    $books=mysqli_query($con,"SELECT * from `book_individual` where `barcode`='$book_barcode'");
                                    $check=mysqli_fetch_assoc($books); 
                                    $book_isbn=$check['isbn'];
                                    $books=mysqli_query($con,"SELECT * from `book` where `isbn`='$book_isbn'");
                                    $chec=mysqli_fetch_assoc($books);
                                    $chec_id=$chec['chec_id'];
                                    $checking=mysqli_query($con,"SELECT * from `book_cat` where `chec_id`='$chec_id'");
                                    $name=mysqli_fetch_assoc($checking);

                                   


                          ?>
                                   
                                    <tr>
                                    
                                       <td><?=$student['fname'].' '.$student['lname']?></td>
                                       <td><?=$student['roll']?></td>   
                                       <td><?=$name['book_name']?></td>   
                                       <td><?=$reservation['barcode']?></td>
                                      <td> <img src='../images/Books/<?=$chec['book_image']?>' height='100' width='100'></td>
                                      <td><?=$chec['edition']?></td>
                                      <td ><a href="see_request.php?reservation_id=<?=$reservation['id']?>&isbn=<?=$check['isbn']?>">Approve</a></td>
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


if(isset($_GET['reservation_id'])){

    $reservation_id=$_GET['reservation_id'];
  
   $res=mysqli_query($con,"SELECT * from `reservation` where `id`='$reservation_id'");
   $re=mysqli_fetch_assoc($res);
   
   $book_id=$re['barcode'];
  $student_id=$re['student_id'];
  $isbn=$_GET['isbn'];
  
 
  //print_r($book_id);
  //print_r($student_id);
  $issue_date=date('d-m-y');

  //print_r($issue_date);

    $result=mysqli_query($con,"INSERT INTO `issue-books`(`student_id`,`book_id`,`issue_date`) VALUES('$student_id','$book_id','$issue_date')");
   
    if($result){
    mysqli_query($con,"UPDATE `reservation` set `status`='1' where `student_id`='$student_id' AND `id`='$reservation_id'");
    
    mysqli_query($con,"UPDATE `book` set `available_book`=`available_book`-1 where `isbn`='$isbn'");
    
    mysqli_query($con,"UPDATE `book_individual` set `status`='1' where `barcode`='$book_id'");

    ?>


<script>
alert('book approved successfully');
history.back();
</script>
<?php
}
else{
?>
    <script>
    alert('book Not approved');
history.back();
</script>
<?php
}

}
?>




<?php

require_once 'footer.php'

?>