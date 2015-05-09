<?php
$con=mysqli_connect("localhost","root","","orderform");
   // Check connection
    if (mysqli_connect_errno()) {
    echo "Database connection failed: " . mysqli_connect_error();
    }
   // mysql_select_db("orderform")or die ("couldn't find db");
$name =$_FILES['file']['name'];
$extension = strtolower(substr($name, strpos($name,'.') +1));
$size =$_FILES['file']['size'];

$type =$_FILES['file']['type'];

$tmp_name =$_FILES['file']['tmp_name'];
 echo $tmp_name ;
$handle= fopen($tmp_name,"r");
 $i=0 ;
 while (($fileop=fgetcsv($handle,1000,","))!== false)
{
  $i=$i+1;
if ($i>1){
  $Job = $fileop['0'];
 $Vendor = $fileop['1'];
 $ItemNO=$fileop['2'];
 $ItemName=$fileop['3'];
 $Qty=$fileop['4'];
 $UnitPrice=$fileop['5'];


   $LineTotal=  $Qty *  $UnitPrice;
  mysqli_query($con,"INSERT INTO `orderform`.`neworders` (
`Primary` ,
`Job` ,
`Vendor` ,
`ItemNo` ,
`ItemName` ,
`Qty` ,
`UnitPrice` ,
`LineTotal` ,
`Date` ,
`Notes`
)
VALUES (
NULL , '$Job', '$Vendor', '$ItemNO', '$ItemName', '$Qty', '$UnitPrice', '$LineTotal',
CURRENT_TIMESTAMP, ''
) ");
}//end of if statement

}


$max_size =2097152;



if (isset($name)){
 if(!empty($name)){
  if(($extension=='csv' ||$extension=='csv')&&($type=='text'||$type=='text') && $size<$max_size){

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

  }

?>