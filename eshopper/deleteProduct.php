<?php
	include "connect.php";

	if (isset($_GET['id_user']) && isset($_GET['id_product'])) {
		
		$id_user = $_GET['id_user'];
		$id_product = $_GET['id_product'];
		echo $id_user.$id_product;

		$sql = "DELETE FROM product WHERE id_user = ".$id_user." && id_product = ".$id_product." ";

		if ($con->query($sql)) {
			header("location:product.php?id=".$id_user."");
		} else {
			echo "<h1>Có lỗi xảy ra</h1>";
		}
	}
?>