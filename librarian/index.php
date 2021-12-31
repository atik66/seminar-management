<?php
require_once 'header.php'
?>
                <!-- content HEADER -->
                <!-- ========================================================= -->
                
                    <!--BOX Style 1-->
                  <?php
                   $result=mysqli_query($con,"SELECT * FROM `students`");
                   $row=mysqli_num_rows($result);
                  ?>

                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="panel widgetbox wbox-1 bg-darker-1">
                            <a href="student.php">
                                <div class="panel-content">
                                  
                                    <h1 class="title color-w"><i class="fa fa-users"></i> <?=$row?></h1>
                                    <h4 class="subtitle color-lighter-1"> Total Student</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!--BOX Style 1-->
                    <?php
                   $result=mysqli_query($con,"SELECT count(barcode) FROM `book_individual`");
                   $row=mysqli_num_rows($result);

                    $available=mysqli_query($con,"SELECT count(barcode) as total from book_individual where `status`='0'");

                    $available_books=mysqli_fetch_assoc($available);
                    $available_book=$available_books['total'];

                    

                  ?>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="panel widgetbox wbox-1 bg-darker-2 color-light">
                            <a href="manage-book.php">
                                <div class="panel-content">
                                    <h1 class="title color-light-1"> <i class="fa fa-book"></i> <?=$available_book?> </h1>
                                    <h4 class="subtitle">Avaible BOOKs</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!--BOX Style 1-->

                                      
                   
                    <!--BOX Style 1-->
                   <?php
                 $num=mysqli_query($con,"SELECT COUNT(`id`) as total from `reservation` where `status`='0'");
                 $count=mysqli_fetch_assoc($num);
                 $total=$count['total'];
?>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="panel widgetbox wbox-1 bg-lighter-2 color-light">
                            <a href="see_request.php">
                                <div class="panel-content">
                                    <h1 class="title color-darker-2"> <i class="fa fa-book"><?=$total?></i></h1>
                                    <h4 class="subtitle color-darker-1">Number of request</h4>
                                </div>
                            </a>
                        </div>
                    </div>
</div>
</div>
<?php

require_once 'footer.php'

?>