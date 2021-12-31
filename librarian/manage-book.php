<?php
require_once 'header.php'
?>
                <!-- content HEADER -->
                <!-- ==========================================  <div class="content-header">
                    !-- leftside content header -->
                    <div class="content-header">
                    <!-- leftside content header -->
                    <div class="leftside-content-header">
                        <ul class="breadcrumbs">
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                            <li><a href="javascript:avoid()">Manage Book</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =
            
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">
                <div class="col-sm-12">
                <h4 class="section-subtitle"><b>All students</b></h4>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                                <table id="basic-table" class="data-table table table-striped nowrap table-hover table-bordered " cellspacing="0" width="50%">
                                    <thead>
                                    <tr>
                                        <th>Barcode</th>
                                        <th>ISBN</th>
                                        <th>Book Name</th>
                                        <th>Book Image</th>
                                        <th>Author Name</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                    </thead>
                                  <tbody>
                                      <?php
                                       $result=  mysqli_query($con, query: "SELECT `book`.`isbn`,`book`.`book_image`,`book`.`edition`,`book`.`total_book`,`book`.`available_book`,`book_cat`.`book_name`,`book_cat`.`book_author_name`,`book_cat`.`book_publication_name`,`book_individual`.`barcode` FROM `book` JOIN `book_cat` ON book.chec_id=book_cat.chec_id JOIN `book_individual` ON book_individual.isbn=book.isbn");
                                       while($row=mysqli_fetch_assoc($result)){
                                           ?>
                                           <tr>
                                           <td><?=$row['barcode'] ?></td>   
                                           <td><?=$row['isbn'] ?></td>
                                             <td><?=$row['book_name'] ?></td>
                                             <td><img style="width: 50px" src="../images/books/<?=$row['book_image'] ?>" alt=""></td>
                                             
                                             <td><?=$row['book_author_name'] ?></td>
                                             <td>
                                                 <a href="javascript:avoid(0)" class="btn btn-info" data-toggle="modal" data-target="#book-<?=$row['barcode']?>"><i class="fa fa-eye"></i></a>
                                                 <a href="" class="btn btn-warning" data-toggle="modal" data-target="#book-update-<?=$row['barcode']?>"><i class="fa fa-pencil"></i></a>
                                                
                                             </td>
                                          </tr>

                                           <?php
                                       }
                                      ?>
                                      <tr>
                                          <td> </td>
                                      </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                 
            </div>
             <!-- Modal -->
                                 <?php
                                       $result=  mysqli_query($con, query: "SELECT `book`.`isbn`,`book`.`book_image`,`book`.`edition`,`book`.`total_book`,`book`.`available_book`,`book_cat`.`book_name`,`book_cat`.`book_author_name`,`book_cat`.`book_publication_name`,`book_individual`.`barcode` ,`book_individual`.book_page FROM `book` JOIN `book_cat` ON book.chec_id=book_cat.chec_id JOIN `book_individual` ON book_individual.isbn=book.isbn");
                                       while($row=mysqli_fetch_assoc($result)){
                                           ?>
             <div class="modal fade" id="book-<?=$row['barcode']?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header state modal-info">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="modal-info-label"><i class="fa fa-info"></i>Book Info</h4>
                                        </div>
                                        <div class="modal-body">
                                           <table class="table table-bordered">
                                               <tr>
                                               <th>Book Name</th>
                                               <td><?=$row['book_name'] ?></td>
                                               </tr>
                                               <tr>
                                               <th>Book Image</th>
                                               <td>
                                                   <img style="width:40; height:50; " src="../images/books/<?=$row['book_image']?>"></td>
                                             </tr>
                                            
                                             <tr>
                                             <th>Author Name</th> 
                                             <td><?=$row['book_author_name'] ?></td>
                                           
                                             </tr>
                                             <tr>
                                            
                                               <th>Publication Name</th>
                                               <td><?=$row['book_publication_name'] ?></td>
                                             
                                       
                                             </tr>
                                             <tr>
                                             <th>Book Edition</th>
                                             <td><?=$row['edition'] ?></td>
                                            </tr>

                                             <tr>
                                             <th>Book Page</th>
                                             <td><?=$row['book_page'] ?></td>
                                            </tr>

                                             <tr>
                                             <th>Book Quantity</th>
                                             <td><?=$row['total_book'] ?></td>
                                            
                                        
                                             </tr>
                                             <th>Available Quantity</th>
                                             <td><?=$row['available_book'] ?></td>
                                           </table> 
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php
                                       }
                                      ?>

                     <!-- Modal -->
                             <?php
                                       $result=  mysqli_query($con, query: "SELECT `book`.`isbn`,`book`.`book_image`,`book`.`edition`,`book`.`total_book`,`book`.`available_book`,`book_cat`.`book_name`,`book_cat`.`book_author_name`,`book_cat`.`book_publication_name`,`book_individual`.`barcode` FROM `book` JOIN `book_cat` ON book.chec_id=book_cat.chec_id JOIN `book_individual` ON book_individual.isbn=book.isbn");
                                       while($row=mysqli_fetch_assoc($result)){

                                    $id=$row['barcode'];
                                    $book_info= mysqli_query($con, query:"SELECT `book`.`isbn`,`book`.`book_image`,`book`.`edition`,`book`.`total_book`,`book`.`available_book`,`book_cat`.`book_name`,`book_cat`.`book_author_name`,`book_cat`.`book_publication_name`,`book_individual`.`barcode` FROM `book` JOIN `book_cat` ON book.chec_id=book_cat.chec_id JOIN `book_individual` ON book_individual.isbn=book.isbn WHERE  `barcode`='$id'");
                                    $book_info_row= mysqli_fetch_assoc($book_info);

                                 ?>
             <div class="modal fade" id="book-update-<?=$row['barcode']?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header state modal-info">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="modal-info-label"><i class="fa fa-info"></i>Book Update</h4>
                                        </div>
                         <div class="modal-body">
                             
                             <div class="panel">
                                 <div class="panel-content">
                                 <div class="row">
                                 <div class="col-md-12">
                                    <form method="post" action="">
                                       
                                    <div class="form-group">
                                            <label for="book_name" >Book Name</label>
                                            
                                                <input type="book_name" class="form-control" id="book_name" placeholder="Book Name" name='book_name' required value=" <?=  $book_info_row['book_name']?>">

                                                <input type="hidden" class="form-control" value=" <?=  $book_info_row['barcode']?>"  required  name='barcode'  >
                                                <input type="hidden" class="form-control" id="book_author_name" placeholder="ISBN" name='isbn' required value=" <?=  $book_info_row['isbn']?>">
                                        </div>
                                      
                                    
                                         

                                        <div class="form-group">
                                            <label for="book_author_name" >Book Author</label>
                                            
                                                <input type="book_author_name" class="form-control" id="book_author_name" placeholder="book_author_name" name='book_author_name' required value=" <?=  $book_info_row['book_author_name']?>">
                                            
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="book_publication_name">Book publication</label>
                                            
                                                <input type="book_publication_name" class="form-control" id="book_publication_name" placeholder="book_publication_name" name='book_publication_name' required value=" <?=  $book_info_row['book_publication_name']?>">
                                         
                                        </div>

                                         
                                        <div class="form-group">
                                            <label for="available_book">Book quantity</label>
                                           
                                                <input type="available_book" class="form-control" id="total_book" placeholder="total_book" name='total_book' required value=" <?=  $book_info_row['total_book']?>">
                                         
                                        </div>

        
                                        <div class="form-group">
                                            <label for="available_book" >Book avaible</label>
                                           
                                                <input type="available_book" class="form-control" id="available_book" placeholder="available_book" name='available_book' required >
                                          
                                           </div>

                                          
                                       </div>
                                        <div class="form-group">
                                            <button type="submit" name="update-book" class="btn btn-primary"><i class="fa fa-save"></i>Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                            
                <?php
                    
                
                     }
                     if(isset($_POST['update-book'])){

                        $id =$_POST['barcode'];
                        $isbn=$_POST['isbn'];
                        echo $isbn;

                        $chec=mysqli_query($con,"SELECT * from `book` where `isbn`='$isbn' ");
                        $check=mysqli_fetch_assoc($chec);
                        $check_id=$check['chec_id'];

                        $book_name =$_POST['book_name'];
                        $book_author_name= $_POST['book_author_name'];
                        $book_publication_name = $_POST['book_publication_name'];
                        $book_qty = $_POST['total_book'];
                        $book_available_qty = $_POST['available_book'];
                    
                        
                       
                    
                        $librarian_username = $_SESSION['librarian_username'];
                        //echo $book_image;
                    
                        $res=mysqli_query($con,query:"UPDATE `book_cat` SET `book_name`='$book_name',`book_author_name`='$book_author_name',`book_publication_name`='$book_publication_name' WHERE `chec_id`='$check_id' ");
                        $res1=mysqli_query($con,query:"UPDATE `book` SET `total_book`='$book_qty',`available_book`=' $book_available_qty' WHERE `isbn`='$isbn' ");
                    
                         if($res && $res1){
                            header('location: manage-book.php');
                         }
                    
                         
                    
                    }


                         ?>
            =============== -->
              



<?php

require_once 'footer.php'

?>