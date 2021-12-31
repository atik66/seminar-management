<?php
require_once 'header.php';
//print_r($_POST);


if(isset($_POST['save_book'])){
    $barcode=$_POST['barcode'];
    $isbn=$_POST['isbn'];
    $book_name =$_POST['book_name'];
    $book_author_name = $_POST['book_author_name'];
    $book_publication_name = $_POST['book_publication_name'];
    $edition=$_POST['edition'];
    $book_type=$_POST['book_type'];
    $entry_date=$_POST['entry_date'];
    $book_price = $_POST['book_price'];
  
    $book_page=$_POST['book_page'];

    $adder_name=$_POST['adder_name'];
    $lost=$_POST['lost'];


    
    $book_image=$_FILES['book_image']['name'];

    $image=explode('.',$book_image);
    $image_ext=end($image);
    $book_image=date('ymdhis.').$image_ext;

    $libraian_username = $_SESSION['libraian_username'];
    //echo $book_image;
   
  

   

   

   // echo $d;
    $e=0;
    $show=mysqli_query($con,"SELECT * FROM `book_individual` WHERE `barcode`='$barcode'");
    $col=mysqli_num_rows($show);
    $count=mysqli_query($con,"SELECT COUNT(`isbn`) as total from `book_individual` where `isbn`='$isbn'");



    
    $count_book=mysqli_fetch_assoc($count);
    //print_r( $count_book);
     $c =(int)$count_book['total'];

     //echo $c;
     
    
      //echo $e;

    $author=mysqli_query($con,query:"SELECT * FROM `book_cat` WHERE `book_author_name`='$book_author_name' AND `book_name`='$book_name'");
    $a_count=mysqli_num_rows($author);


    $isbn_check=mysqli_query($con,query:"SELECT * FROM `book` WHERE `isbn`='$isbn'");
    $is_isbn=mysqli_num_rows($isbn_check);
     



    if($col==0){
    $res=mysqli_query($con,query:"INSERT INTO `book_individual`(`barcode`,`isbn`, `book_page`,`entry_date`,`adder_name`,`lost`) VALUES ('$barcode','$isbn','$book_page','$entry_date','$adder_name','$lost')");
    if($e==0){
        $e=1;
    }
     $e=$c+$e;
     
     if($a_count==0){

         $booktype=mysqli_query($con,query:"INSERT INTO `book_cat`(`book_name`,`book_author_name`,`book_publication_name`,`book_type`) VALUES ('$book_name','$book_author_name','$book_publication_name','$book_type')");
     
     }

        $id=mysqli_query($con,"SELECT * FROM `book_cat` WHERE `book_name`='$book_name' AND `book_author_name`='$book_author_name'" );

        $row=mysqli_fetch_assoc($id);
          $chec_id=$row['chec_id'];

     
       


     

     if($is_isbn==0){

        $isbn_insert=mysqli_query($con,query:"INSERT INTO `book`(`isbn`,`chec_id`,`book_price`,`edition`,`book_image`,`total_book`,`available_book`) VALUES ('$isbn' ,'$chec_id', '$book_price','$edition','$book_image','1','1')");
     }

     if($is_isbn>0){

           $quant=mysqli_query($con,"SELECT * from `book` where `isbn`='$isbn'");
         $avail=mysqli_fetch_assoc($quant);
         $available=$avail['available_book'];
         
          $f=(int)$available+1;

          echo $f;
         
         mysqli_query($con,"UPDATE `book` set `total_book`='$e' ,`available_book`='$f' where `isbn`='$isbn'");
     }

     if($res){
         move_uploaded_file($_FILES['book_image']['tmp_name'],'../images/Books/'.$book_image);
         $success="BOOK Save";
     }

     else{
         $error="NOT SAVE";
     }

}
else{
    $error="you have a barcode of this book already";

}
}
?>
                <!-- content HEADER -->
                <!-- ========================================================= -->
                <div class="content-header">
                    <!-- leftside content header -->
                    <div class="leftside-content-header">
                        <ul class="breadcrumbs">
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
                            <li><a href="javascript:avoid()">Add Book</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">
                    <div class="col-sm-6 col-sm-offset-3">
                    <?php
              if(isset($success)){

              ?>
            <div class="alert alert-success" role="alert">
                 <?= $success?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span  aria-hidden="true">&times;</span>
  </button>
              </div>     
<?php
              }

              ?>

<?php
              if(isset($error)){

              ?>
            <div class="alert alert-danger" role="alert">
                 <?= $error?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span  aria-hidden="true">&times;</span>
  </button>
              </div>         
<?php
              }

              ?>

                    <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                                        <h5 class="mb-lg">Please enter Book Information</h5>
                                        <div class="form-group">
                                            <label for="barcode" class="col-sm-4 control-label">Barcode</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="barcode" placeholder="Barcode" name="barcode" required value="<?=isset($barcode) ? $barcode:''?>">
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label for="isbn" class="col-sm-4 control-label">ISBN</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="isbn" placeholder="ISBN" name='isbn' required value="<?=isset($isbn) ? $isbn:''?>">
                                            </div>
                                          </div>
                                        <div class="form-group">
                                            <label for="book_name" class="col-sm-4 control-label">Book Name</label>
                                            <div class="col-sm-8">
                                                <input type="book_name" class="form-control" id="book_name" placeholder="Book Name" name='book_name' required value="<?=isset($book_name) ? $book_name:''?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="book_image" class="col-sm-4 control-label">Book Image</label>
                                            <div class="col-sm-8">
                                                <input type="file"  id="book_image" placeholder="Book Image" name='book_image' required value="<?=isset($book_image) ? $book_image:''?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="book_author_name" class="col-sm-4 control-label">Book Author</label>
                                            <div class="col-sm-8">
                                            <input type="text" class="form-control" id="book_author_name" placeholder="Book Author " name='book_author_name' required value="<?=isset($book_author_name) ? $book_author_name:''?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="book_publication_name" class="col-sm-4 control-label">Book publication</label>
                                            <div class="col-sm-8">
                                                <input type="book_publication_name" class="form-control" id="book_publication_name" placeholder="book_publication_name" name='book_publication_name' required value="<?=isset($book_publication_name) ? $book_publication_name:''?>">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="edition" class="col-sm-4 control-label">Edition</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="edition" placeholder="edition" name='edition' required value="<?=isset($edition) ? $edition:''?>">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="barcode" class="col-sm-4 control-label">Book Type</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="book_type" placeholder="Book Type" name='book_type' required value="<?=isset($book_type) ? $book_type:''?>">
                                            </div>
                                          </div>

                                        <div class="form-group">
                                            <label for="book_purchase_date" class="col-sm-4 control-label">Entry date</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="book_purchase_date" placeholder="Entry_date"name='entry_date' required value="<?=isset($entry_date) ? $entry_date:''?>">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="book_price" class="col-sm-4 control-label">Price</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="book_price" placeholder="Price" name='book_price' required value="<?=isset($book_price) ? $book_price:''?>">
                                            </div>
                                        </div>

                                         
                                          <div class="form-group">
                                            <label for="barcode" class="col-sm-4 control-label">Book Page</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="book_page" placeholder="Book Page" name='book_page' required value="<?=isset($book_page) ? $book_page:''?>">
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <label for="adder_name" class="col-sm-4 control-label">Adder name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="adder_name" placeholder="adder name" name='adder_name' required  value="<?=isset($adder_name) ? $adder_name:''?>">
                                            </div>
                                          </div>

                                         
                                      

                                          <div class="form-group">
                                            <label for="lost" class="col-sm-4 control-label">Book lost</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="lost" placeholder="lost" name='lost' required>
                                            </div>
                                          </div>

                                          
                                          
                                          

                                          
                                        </div

                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-8">
                                                <button type="submit" name="save_book" class="btn btn-primary"><i class="fa fa-save"></i>Save Book</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
</div>
</div>
<?php

require_once 'footer.php'

?>