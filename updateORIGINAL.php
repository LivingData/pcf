<?php



  $con=mysqli_connect("localhost","root","","orderform");
   // Check connection
    if (mysqli_connect_errno()) {
    echo "Database connection failed: " . mysqli_connect_error();
    }
$postlength=count($_POST);

for ($x = 0; $x <= $postlength; $x++) {
 $Primary=trim($_POST['Primary'][$x]);
 $Job = trim($_POST['Job'][$x]);
 $Vendor = trim($_POST['Vendor'][$x]);
 $ItemNO=trim($_POST['ItemNO'][$x]);
 $ItemName=trim($_POST['ItemName'][$x]);
 $Qty=trim($_POST['Qty'][$x]);
 $UnitPrice=trim($_POST['UnitPrice'][$x]);
 //$Approve=$_POST['approve'];
  




// If ($Primary&&$Vendor&&$ItemNO&&$ItemName&&$Qty&&$UnitPrice)
 if (isset($Primary))
{
  if ($Primary == "")
  {

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

  $LineTotal=  $Qty *  $UnitPrice;
  //$queryreg=
  mysqli_query($con," UPDATE `orderform`.`neworders` SET `Job` = '$Job', `Vendor` = '$Vendor',
  `ItemNO` = '$ItemNO', `ItemName` = '$ItemName', `Qty` = '$Qty', `UnitPrice` = '$UnitPrice', `LineTotal` = '$LineTotal'  WHERE `neworders`.`Primary` ='$Primary';");
 }
}


}
////After orders have been added and updated return all orders.

   // mysql_select_db("orderform")or die ("couldn't find db");

    $result = mysqli_query($con,"SELECT * FROM neworders");
     $array = array ();

$i = 0;
while ($row = mysqli_fetch_array($result)) {

//$array['Users'][$i++] = $row;
//array_push($array,$row);
//echo json_encode($array);
$array[]=$row;
}
$json = json_encode($array);

echo $json;
?>