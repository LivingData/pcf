<?php

$name =$_FILES['file']['name'];
$extension = strtolower(substr($name, strpos($name,'.') +1));
$size =$_FILES['file']['size'];

$type =$_FILES['file']['type'];

$tmp_name =$_FILES['file']['tmp_name'];

$max_size =2097152;



if (isset($name)){
 if(!empty($name)){
 $con=mysqli_connect("localhost","root","","orderform");
   // Check connection
    if (mysqli_connect_errno()) {
    echo "Database connection failed: " . mysqli_connect_error();
    }
   // mysql_select_db("orderform")or die ("couldn't find db");
    

  
  if(($extension=='jpg' ||$extension=='jpeg')&&($type=='image/jpeg'||$type=='image/jpg') && $size<$max_size){

  $location='uploads/';
  
 if (move_uploaded_file($tmp_name, $location.$name)){
     echo 'Uploaded';
  } else{
    echo 'There was an error.';
  }
 }

 } else{
  echo  'File must be jpg/jpeg and smaller than 2MB.';

 }
 
  $result = mysqli_query($con,"LOAD DATA INFILE 'c:/tmp/discounts_2.csv'
INTO TABLE neworders
FIELDS TERMINATED BY ',' ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS)";


}

?>