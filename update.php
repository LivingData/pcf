<?php



  $con=mysqli_connect("localhost","root","","orderform");
   // Check connection
    if (mysqli_connect_errno()) {
    echo "Database connection failed: " . mysqli_connect_error();
    }
  //  $arr=json_decode($_POST);
$postlength=count($_POST['updatearr']);
$postlengthcorrected=$postlength-1;
//print_r($_POST);
print_r($postlength);
for ($x = 0; $x <= $postlengthcorrected; $x++) {
$arrnum=$_POST['updatearr'][$x];
  // print_r($postlengthcorrected." ");
  // print_r($arrnum);
    foreach($arrnum as $key=>$value){
                     if ($key=='Primary'){
                    //  print_r($value."  ");
                       $Primary=trim($value);
                       //print_r($value);
                     }
                         if ($key=='Job'){
                      //print_r($key);
                       $Job=trim($value);
                     }
                     if ($key=='Vendor'){
                      //print_r($key);
                       $Vendor=trim($value);
                     }
                     if ($key=='ItemNO'){
                      //print_r($key);
                       $ItemNO=trim($value);
                     }
                     if ($key=='ItemName'){
                      //print_r($key);
                       $ItemName=trim($value);
                     }
                     if ($key=='Qty'){
                      //print_r($key);
                       $Qty=trim($value);
                     }
                     if ($key=='UnitPrice'){
                      //print_r($key);
                       $UnitPrice=trim($value);
                      // print_r($UnitPrice);
                     }
                      if ($key=='Approve'){
                      //print_r($key);
                       $Approve=trim($value);
                       print_r($Approve. "  in array" );
                     }
    }/// end of foreach
    if (isset($Primary)){
  if ($Primary == ""){

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

 }
 else{
   if ($Approve==""){
    print_r("<-In approve.");
  $LineTotal=  $Qty *  $UnitPrice;
  //$queryreg=
  mysqli_query($con," UPDATE `orderform`.`neworders` SET `Job` = '$Job', `Vendor` = '$Vendor',
  `ItemNO` = '$ItemNO', `ItemName` = '$ItemName', `Qty` = '$Qty', `UnitPrice` = '$UnitPrice', `LineTotal` = '$LineTotal'  WHERE `neworders`.`Primary` ='$Primary';");
   }
    if ($Approve=="Approved"){
     // print_r("<-In approve.");
    //delete from neworders table
    mysqli_query($con," DELETE FROM `orderform`.`neworders` WHERE `neworders`.`Primary` ='$Primary';");
    //and move to approved table
      mysqli_query($con,"INSERT INTO `orderform`.`approved` (
`OrderNumber` ,
`Date Requested` ,
`Input By` ,
`Job` ,
`ItemNO` ,
`ItemName` ,
`Qty` ,
`UnitPrice` ,
`LineTotal` ,
`Vendor` ,
`Approved By`
)
VALUES (
NULL, '', '', '$Job', '$ItemNO', '$ItemName', '$Qty', '$UnitPrice', '$LineTotal', '$Vendor', ''
)");

    }

   }
}
    }

?>