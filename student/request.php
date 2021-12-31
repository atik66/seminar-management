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
                                        <th>Book Name</th>
                                        <th>Bar code</th>
                                        
                                        <th>Image</th>
                                        <th>Edition</th> 
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                         $student_id=$_SESSION['student_id'];
                                        
                                         $reserve=mysqli_query($con,"SELECT * from `reservation`");
                                         while($reservation=mysqli_fetch_assoc($reserve)){
                                         $student=$reservation['student_id'];
                                        // print_r ($student); 
                                    if($student_id==$student){
                                       
                                    $book_barcode=$reservation['barcode'];
                                    $books=mysqli_query($con,"SELECT * from `book_individual` where `barcode`='$book_barcode'");
                                    $check=mysqli_fetch_assoc($books); 
                                    $book_isbn=$check['isbn'];
                                    $books=mysqli_query($con,"SELECT * from `book` where `isbn`='$book_isbn'");
                                    $check=mysqli_fetch_assoc($books);
                                    $chec_id=$check['chec_id'];
                                    $checking=mysqli_query($con,"SELECT * from `book_cat` where `chec_id`='$chec_id'");
                                    $name=mysqli_fetch_assoc($checking);

                          ?>
                                   
                                    <tr>
                                      <td><?=$name['book_name']?></td>   
                                      <td><?=$reservation['barcode']?></td>
                                    
                                      
                                      <td> <img src='../images/Books/<?=$check['book_image']?>' height='100' width='100'></td>
                                      <td><?=$check['edition']?></td>
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

require_once 'footer.php'

?>