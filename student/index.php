<?php
require_once 'header.php'
?>
                <!-- content HEADER -->
                <!-- ========================================================= -->
                
                    <!--BOX Style 1-->
               
                    <!--BOX Style 1-->
                    <?php
                   $result=mysqli_query($con,"SELECT count(barcode) FROM `book_individual`");
                   $row=mysqli_num_rows($result);

                    $available=mysqli_query($con,"SELECT count(barcode) from book_individual where `status`='0'");

                    $available_book=mysqli_num_rows($available);

                    

                  ?>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="panel widgetbox wbox-1 bg-darker-2 color-light">
                            <a href="history.php">
                                <div class="panel-content">
                                    <h1 class="title color-light-1"> <i class="fa fa-book"></i>Book</h1>
                                    <h5 class="subtitle">total reading books</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!--BOX Style 1-->

                   

              <?php
                 $reserve=mysqli_query($con,"SELECT * from `reservation`");  
                 $reservation=mysqli_fetch_assoc($reserve);
                 ?>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="panel widgetbox wbox-1 bg-lighter-2 color-light">
                            <a href="request.php">
                                <div class="panel-content">
                                    <h1 class="title color-darker-2"> <i class="fa fa-user"></i></h1>
                                    <h4 class="subtitle color-darker-1">Book Request History</h4>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!--BOX Style 1-->
                   <!-- <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="panel widgetbox wbox-1 bg-light color-darker-2">
                            <a href="#">
                                <div class="panel-content">
                                    <h1 class="title"> Total </h1>
                                    <h4 class="subtitle"></h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div> -->
</div>
</div>
<?php

require_once 'footer.php'

?>