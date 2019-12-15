<?php 
// Include Components File
require_once('components.php');
// Include DB File
require_once('db.php');

$conn = connectDB();

// Operation
 if(isset($_POST['create'])){
     createData();
 }

 if(isset($_POST['update'])){
     updateData();
 }

 if(isset($_POST['delete'])){
     deleteRecord();
 }

 if (isset($_POST['delete-all'])) {
     deleteAll();
 }


 function createData(){
    $bookname = textboxValue("book_name");
    $bookpublisher = textboxValue("book_publisher");
    $bookprice = textboxValue("book_price");
 

    // Check if data are inputed into the TextBox Function
    if($bookname && $bookpublisher && $bookprice){
 
        $sql = "INSERT INTO books (book_name, book_publisher, book_price) VALUES ('$bookname','$bookpublisher','$bookprice')";
 
        if(mysqli_query($GLOBALS['conn'], $sql)){
            TextNode("success", "Library data inputed successufully...");
        }else{
            echo "Error";
        }
 
    }else{
            TextNode("error", "Fill in the input box");
    }
}

// Input data into database
function textboxValue($value){
    $textbox = mysqli_real_escape_string($GLOBALS['conn'], trim($_POST[$value]));
    if(empty($textbox)){
        return false;
    }else{
        return $textbox;
    }
}
 

//Get data from database

function getData(){
    $sql = "SELECT * FROM books";

    $result = mysqli_query($GLOBALS['conn'], $sql);

    if(mysqli_num_rows($result) > 0){
       return $result;
    }
}
 

// Update data in the database
function updateData(){
    $id = textboxValue("book_id");
    $bookname = textboxValue("book_name");
    $bookpublisher = textboxValue("book_publisher");
    $bookprice = textboxValue("book_price");

    if ($bookname && $bookpublisher && $bookprice) {
        $sql = "UPDATE books SET book_name='$bookname', book_publisher='$bookpublisher', book_price='$bookprice' WHERE id='$id';";

        if (mysqli_query($GLOBALS['conn'], $sql)) {
            TextNode("success", "Library store book data updated successfully...");
        }else{
            TextNode("error", "Library store book unable to update...");
        }
    }else{
        TextNode("error", "Update data using the edit icon");
    }
}

// Delete data from database

function deleteRecord(){
     $id = (int)textboxValue("book_id");

      $sql = "DELETE FROM books WHERE id=$id";

      if (mysqli_query($GLOBALS["conn"], $sql)) {
        TextNode("success", "Library store book data deleted successfully...");
      }else{
        TextNode("error", "Library store book unable to delete...");

      }
}

// Create the delete all button when data is >=5
function deleteAllBtn(){
    $data = getData();
    $i = 0;
    if ($data) {
        while ($row = mysqli_fetch_assoc($data)) {
            $i++;
            if ($i >= 5) {
                buttonElement("deleteAll-btn","btn btn-danger","<i class='fas fa-trash'></i> Delete All", "delete-all", "");
                return;
            }
        }
    }
}

function deleteAll(){
    $sql = "DROP TABLE books";

    if (mysqli_query($GLOBALS["conn"], $sql)) {
        TextNode("success", "All Library store book deleted successfully...");
        connectDB();
    }else{
        TextNode("error", "All Library store book unable to delete...");
    }
}

// Set input ID 
function setID(){
    $getid = getData();
    $id = 0;
    if($getid){
        while ($row = mysqli_fetch_assoc($getid)){
            $id = $row['id'];
        }
    }
    return ($id + 1);
}

// Message Output
function TextNode($classname, $msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}
 