<?php
require_once 'header.php';
?>
                <!-- content HEADER -->
                <!-- ========================================================= -->
                <div class="content-header">
                    <!-- leftside content header -->
                    <div class="leftside-content-header">
                        <ul class="breadcrumbs">
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">

<div class="col-sm-12">
    <h4 class="section-subtitle"><b>Issue Book</b></h4>
    <div class="panel">
        <div class="panel-content">
            <div class="table-responsive">
                <table id="basic-table" class=" table-bordered 
                data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Book Name</th>
                        <th>Book edition</th>
                        <th>Book Image</th>
                        <th>Issue Date</th>
                        <th>Fine</th>
                    </thead>
                    <tbody>
                   <?php
                    
                    //print_r ($_SESSION);
                    $student_id=$_SESSION['student_id'];
                    
                      $result= mysqli_query($con,query:"SELECT * from `issue-books` where `student_id`='$student_id' AND `book_return_time`!='null'");
                       

                     while($row=mysqli_fetch_assoc($result)){
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
                   <td><?=$book['book_name']?></td>
                   <td><?=$check_id['edition']?></td>
                   <td><img  src="../images/Books/<?=$check_id['book_image']?>"  width="100" height="100"></td>
                   <td><?=$row['issue_date']?></td>
                   <td><?=$row['fine']?></td>
                     </tr>
                        <?php
        


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

require_once 'footer.php';

?>