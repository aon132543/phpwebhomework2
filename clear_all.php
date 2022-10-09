<?php
session_start();
if(isset($_SESSION["cart"])){
    unset($_SESSION["cart"]);
    $_SESSION["cart"] = array();
}
?>
<script>
    window.alert("นำสินค้าออกจากตะกร้าทั้งหมดเรียบร้อย");
    window.location.replace("show_product.php");
</script>