<?php

function connectDB(){
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "loginsystem";
    
    // Connect to database
    $conn = mysqli_connect($host,$username,$password,$dbname);

    // Query to create Database

    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    
    // Query Connection and DB
    if (mysqli_query($conn, $sql)) {
        $conn = mysqli_connect($host,$username,$password,$dbname);
        
        $sql = "
                        CREATE TABLE IF NOT EXISTS books(
                            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            book_name VARCHAR (25) NOT NULL,
                            book_publisher VARCHAR (20),
                            book_price FLOAT 
                        );
        ";


        if(mysqli_query($conn, $sql)){
            return $conn;
        }else{
            echo "Database table cannot be created...";
        }
    }else{
        echo "Error encountered whilst connect to the database" . mysqli_error($conn);
    }
    
    
}

