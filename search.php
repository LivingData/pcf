<?php



$con=mysqli_connect("localhost","root","","orderform");
   // Check connection
    if (mysqli_connect_errno()) {
    echo "Database connection failed: " . mysqli_connect_error();
    }
   // mysql_select_db("orderform")or die ("couldn't find db");
   
   if (isset($_POST['submitted'])){

 $Job=mysqli_real_escape_string($con,trim($_POST['Job']));
 $Person = mysqli_real_escape_string($con,trim($_POST['Person']));
 $Vendor = mysqli_real_escape_string($con,trim($_POST['Vendor']));
 $ItemNo=mysqli_real_escape_string($con,trim($_POST['ItemNo']));
 $ItemName=mysqli_real_escape_string($con,trim($_POST['ItemName']));
}

    
    $result = mysqli_query($con,"SELECT * FROM neworders WHERE `Job` LIKE '$Job' OR `Vendor` LIKE '$Vendor' OR `ItemNo` LIKE '$ItemNo' OR `ItemName` LIKE '$ItemName'");
     $array = array ();

$i = 0;
while ($row = mysqli_fetch_array($result)) {

//$array['Users'][$i++] = $row;
//array_push($array,$row);
//echo json_encode($array);
$array[]=$row;
}

$arrayreverse = array_reverse($array)  ;

$json = json_encode($arrayreverse);

echo $json;


?>