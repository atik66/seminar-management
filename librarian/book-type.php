<?php
require_once 'header.php';


?>             <!-- content HEADER -->
                <!-- ========================================================= -->
                <div class="content-header">
                    <!-- leftside content header -->
                    <div class="leftside-content-header">
                        <ul class="breadcrumbs">
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                            <li><a href="javascript:avoid()">book-type</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
           <div class="row animated fadeInUp">
              <div class="col-sm-12">
                 <div class='panel'>
                    <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-inline"  method="POST">
                                    
                                        <div class="form-group">

                                      
              
                                       <input type="text" class="form-control" placeholder="book_type" name="book_type">
                                        

                                          
                                        </div>
                       
                                        <div class="form-group">
                                            <button type="submit" name="search" class="btn btn-primary">search</button>
                                        </div>
                                            </from>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>

              

            <div class="row animated fadeInUp">
              <div class="col-sm-12">
                 <div class='panel'>
                    <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">
                                <div class="table-responsive">
                                <table id="basic-table" class="data-table table table-striped nowrap table-hover table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Book Name</th>
                                        <th>Books Image</th>
                                        <th>author</th>
                                        <th>Total quantity</th>
                                        <th>available</th>
                                       
                                        
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

    if(isset($_POST['search'])){
              $id=$_POST['book_type'];
$result =mysqli_query($con,query:"SELECT * FROM `book_cat` where `book_type` like '$id'");

while($row=mysqli_fetch_assoc($result)){

  $isbn=$row['chec_id'];

  $book_information=mysqli_query($con,"SELECT * from `book` where `chec_id`='$isbn'");
  $books=mysqli_fetch_assoc($book_information);

?>
<tr>
<td><?=$row['book_name']?></td>
<td><img src='../images/Books/<?=$books['book_image']?>' height='100' width='100'></td>
<td><?=$row['book_name']?></td>
<td><?=$books['total_book']?></td>
<td><?=$books['available_book']?></td>

                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>



<?php
}
 
}

?>




<?php

require_once 'footer.php'

?>