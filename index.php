<?php 
// Include Components File
require_once('controllers/components.php');
// Include Operations File
require_once('controllers/controllers.php')
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <title>CRUDAPP</title>
</head>
<body>
   
<section>
<div class="container text-center">
    <h1 class="py-4"><i class="fas fa-swatchbook"></i> Book Store</h1>
</div>

<div class="d-flex justify-content-center">
    <form action="" method="post" class="w-50">
        <div class="pt-2">
           <?php inputElement("<i class='fas fa-id-badge'></i>","ID","book_id",setID()); ?>          
        </div>
        <div class="pt-2">
           <?php inputElement("<i class='fas fa-book'></i>","Book Name","book_name",""); ?>
        </div>
        <div class="row pt2">
            <div class="col">
              <?php inputElement("<i class='fas fa-people-carry'></i>","Publisher","book_publisher",""); ?>
            </div>
            <div class="col">
            <?php inputElement("<i class='fas fa-dollar-sign'></i>","Price","book_price",""); ?>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <?php buttonElement("btn-create","btn btn-success", "<i class='fas fa-plus'></i>","create","data-toggle='tooltip' data-placement='tooltip' title='Create'"); ?>
            <?php buttonElement("btn-read","btn btn-primary", "<i class='fas fa-sync'></i>","read","data-toggle='tooltip' data-placement='tooltip' title='Read'"); ?>
            <?php buttonElement("btn-update","btn btn-light border", "<i class='fas fa-pen-alt'></i>","update","data-toggle='tooltip' data-placement='tooltip' title='Update'"); ?>
            <?php buttonElement("btn-delete","btn btn-danger", "<i class='fas fa-trash-alt'></i>","delete","data-toggle='tooltip' data-placement='tooltip' title='Delete'"); ?>
            <?php deleteAllBtn() ?>
        </div>
    </form>
</div>

<div class="container rounded">
<div class="d-flex table-data">
    <table class="table table-stripped table-col">
        <thead class="thead-col">
          <tr>
              <th>ID</th>
              <th>Book Name</th>
              <th>Publisher</th>
              <th>Price</th>
              <th>Edit</th>
          </tr>
        </thead>
        <tbody id="tbody">
            <?php
               if (isset($_POST['read'])) {
                   $result = getData();

                   if($result){
                       while($row = mysqli_fetch_assoc($result)){?>
                          
                         <tr>
                            <td data-id="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></td>
                            <td data-id="<?php echo $row['id']; ?>"><?php echo $row['book_name']; ?></td>
                            <td data-id="<?php echo $row['id']; ?>"><?php echo $row['book_publisher']; ?></td>
                            <td data-id="<?php echo $row['id']; ?>"><?php echo "$" . $row['book_price']; ?></td>
                            <td><i class="fas fa-edit editbtn" data-id="<?php echo $row['id']; ?>"></i></td>
                         </tr>

                          <?php 
                       }
                   }
               }
            ?>
        </tbody>
    </table>
</div>
</div>

</section>

</body>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/app.js"></script>
</html>