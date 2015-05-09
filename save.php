<?php
 $Job = $_POST['Job'];
 $Vendor = $_POST['Vendor'];
 $ItemNO=$_POST['ItemNO'];
 $ItemName=$_POST['ItemName'];
 $Qty=$_POST['Qty'];
 $UnitPrice=$_POST['UnitPrice'];




 If ($Vendor&&$ItemNO&&$ItemName&&$Qty&&$UnitPrice)
   {


 $connect=mysql_connect("localhost","root","") or die("Couldn't Connect!");
    mysql_select_db("orderform")or die ("couldn't find db");

 //   $querycompare=mysql_query("SELECT*FROM 'orderform'.'neworders' WHERE MATCH(Vendor,ItemNo) AGAINST('$Vendor','$ItemNO') ");
   // if (mysql_num_rows($querycompare)!=0)
   //   {
   //    echo "Item was already ordered.";
   //   };
  //  else
  //  {
    $LineTotal=  $Qty *  $UnitPrice;

  $queryreg=mysql_query("  INSERT INTO `orderform`.`neworders` (
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
   //}
      };
   
?>