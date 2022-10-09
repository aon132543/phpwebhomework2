
<?php
echo "ตระกร้าสินค้าของคุณ";
$servername="localhost";
$username="root";
$password="";
$dbname="shop";
$con=mysqli_connect($servername,$username,$password,$dbname);
if(!$con) die("Connnect mysql database fail!!".mysqli_connect_error());
$sql1 = "SELECT * FROM order_product";
$allCus=mysqli_query($con,$sql1);
if(mysqli_num_rows($allCus)>0){
  
    while($row=mysqli_fetch_assoc($allCus)){
            echo "<hr/>";
            $order = $row['id'];
            echo "<h3>คุณ ".$row['fname']." นามสกุล ".$row['lname']."</h3>";
            echo "<p>เบอร์โทร : ".$row['mobile']."</p>";
            echo "<p> ที่อยู่ : ".$row['address']."</p>";
            echo "<p>หมายเลขคำสั่งซื้อ : ".$row['id']."</p>";
            echo "<p>วันที่ : ".$row['date']."</p>";
            

             $sql2="SELECT  * FROM  order_details INNER JOIN product ON product.id = order_details.product_id
                    INNER JOIN order_product ON order_details.order_id = order_product.id WHERE order_product.id = $order";
            $productList=mysqli_query($con,$sql2);
          
            if(mysqli_num_rows($productList)>0){
                $total = 0;
                   echo "<table border=1>
                    <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>description</th>
                    <th>price</th>
                    </tr>";
                while($row=mysqli_fetch_assoc($productList)){
                    echo "<tr>
                    <td>".$row["product_id"]."</td>
                    <td>".$row["name"]."</td>
                    <td>".$row["description"]."</td>
                    <td>".$row["price"]."</td>
                    <tr>";
                    $total += $row["price"];
                }
                 echo "</table>";
                 echo "<h3>รวม $total บาท</h3>";
                 echo "<hr/>";
            }else{
                echo "0 results";
            }
    }
   
}else{
    echo "0 results";
}
echo "<h2><a href='show_product.php'>สั่งสินค้าอีกครั้ง</a></h2>";
?>