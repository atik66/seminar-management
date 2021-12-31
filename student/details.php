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
                                       
                                        <th>Bar code</th>
                                                                               
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($_GET['id'])){
                                          // print_r($_GET['id']);
                                            $isbn=$_GET['id'];
                                      
                               $result=mysqli_query($con,"SELECT * from `book_individual` where `status`='0' AND `isbn`='$isbn'");
                                    while($row=mysqli_fetch_assoc($result)){
                                          
                                              
                                      ?>
                                   
                                   
                                      <tr>

                                       <td><?=$row['barcode']?></td>
                                       <td><a href="details.php?idd=<?=$row['barcode']?>" class="btn btn-primary"> Request</a></td>

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

if(isset($_GET['idd'])){

    $student_id=$_SESSION['student_id'];
    $barcode=$_GET['idd']; 
   
    $s=mysqli_query($con,"SELECT * from book_individual where `barcode`='$barcode'");

   $status =mysqli_fetch_assoc($s);
   $ok=(int)$status['status'];
   if(!$ok){   
      $puipil=mysqli_query($con,"SELECT  MAX(`datetime`) as cal from `reservation` where `student_id`='$student_id'");
      $set_puipil=mysqli_fetch_assoc($puipil);
             $old=$set_puipil['cal'];
             $old1=date("d-m-y",strtotime($old));
              $d=(int)$old1;
              $old1=date("m-d-y",strtotime($old));
               $m=(int)$old1;
               $old1=date("y-d-m",strtotime($old));
               $y=(int)$old1;

             
                      
              
              $new=date("d-m-y");
              $nd=(int)$new;
              $new=date("m-d-y");
              $nm=(int)$new;
              $new=date("y-d-m");
              $ny=(int)$new;
 
              
          



            if($nd-$d>7){  
    
    mysqli_query($con,"INSERT INTO `reservation`(`student_id`, `barcode`) VALUES ('$student_id','$barcode')");
    ?>
             <script> alert('request successful!!') ;
             
            </script>

<?php
        }
        
        else{
            if($nm>$m){
                mysqli_query($con,"INSERT INTO `reservation`(`student_id`, `barcode`) VALUES ('$student_id','$barcode')");

            }

            else{
                if($ny>$y){

                  mysqli_query($con,"INSERT INTO `reservation`(`student_id`, `barcode`) VALUES ('$student_id','$barcode')");
                }

                else{
                    ?>

                <script> alert('You have already requested a book') ;</script>

<?php

                }

            }
?>
            
<?php

        }    


}

    else{
        ?>
        
      <script> alert('this book already requested') </script>
    <?php
    }

  }
                    



   

?>






<?php

require_once 'footer.php'

?>