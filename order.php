<?php
session_start();
$fname= $_POST["fname"];
$lname= $_POST["lname"];
$address= $_POST["address"];
$mobile= $_POST["mobile"];

$t=time();
$t = date("Y-m-d",$t);

$servername="localhost";
$username="root";
$password="";
$dbname="shop";
$con=mysqli_connect($servername,$username,$password,$dbname);
if(!$con) die("Connnect mysql database fail!!".mysqli_connect_error());
//echo "Connect mysql successfully!";
$sql="INSERT INTO order_product (fname, lname,address,mobile,date)";
$sql.="VALUES ('$fname', '$lname', '$address','$mobile','$t');";
//echo $sql;
if (mysqli_query($con, $sql)) {
    $last_id = mysqli_insert_id($con);
    //echo "New record created successfully. Last inserted ID is: " . $last_id;
    // loop in session cart and insert each item to database
    $sql1="INSERT INTO order_details (order_id,product_id) VALUES ";
    for($i=0;$i<count($_SESSION["cart"]);$i++){
        $item_id=$_SESSION["cart"][$i]['id'];
        $sql1.="('$last_id','$item_id')";
        if($i<count($_SESSION["cart"])-1)
         $sql1.=",";
        else
         $sql.=";";
    }
    //echo $sql1;
    if(mysqli_query($con,$sql1)){
      echo "<script language=\"JavaScript\">";
      echo "alert('เพิ่มสินค้าเรียบร้อย');";
      echo "location.href='showcart.php'";
      echo "</script>";

    }
    else {"เกิดข้อผิดพลาดในการสั่งซื้อ";}
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
  }
  
  mysqli_close($con);
//$result=mysqli_query($con,$sql);
//$numrow=mysqli_num_rows($result);
?>