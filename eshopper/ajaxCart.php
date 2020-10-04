<?php
	session_start();
	// session_destroy();
	include 'connect.php';

	//shopping cart
	$data = [];
	if (isset($_POST["id"])) {
		$data['id']    = $_POST['id'];
		$data['price'] = $_POST['price'];
		$data['title'] = $_POST['title'];
		$data['img']   = $_POST['img'];
		$data['qty']   = 1;

		if (!isset($_SESSION['cart']) || $_SESSION['cart'] == null) {
			$_SESSION['cart'][$_POST['id']] = $data;
		} else {
			if (array_key_exists($_POST['id'] , $_SESSION['cart'])) {
				$_SESSION['cart'][$_POST['id']]['qty'] += 1;
			} else {
				$_SESSION['cart'][$_POST['id']] = $data;
			}
		}

		if (isset($_SESSION['cart'])) {
			$countProduct = count($_SESSION['cart']);
			echo $countProduct;
		}

		//print_r($_SESSION['cart']);

	} 
?> 

<?php
	//delete cart X
	if (isset($_POST['id_delete'])) {
		$id_delete = $_POST['id_delete'];
		unset($_SESSION['cart'][$id_delete]);
	}
?>	

<?php
	//Update qty +
	if (isset($_POST['id_up'])) {
		$id_up = $_POST['id_up'];
		//echo $id_up;

		// echo "<pre>"; 
		// print_r($_SESSION['cart'][$_POST['id_up']]['qty']);
		// echo "</pre>";

		$up = [];
		$up['subTotal'] = 0;
		foreach ($_SESSION['cart'] as $list) {
			$up['subTotal'] += ($list['qty'] * $list['price']);

			if ($id_up == $list['id']) {
				$_SESSION['cart'][$id_up]['qty'] = $_SESSION['cart'][$id_up]['qty'] + 1;
				//print_r($_SESSION['cart'][$id_up]['qty']);
				$up['qty'] = $_SESSION['cart'][$id_up]['qty'];
				$up['totalPrice'] = number_format(($_SESSION['cart'][$id_up]['price'] * $_SESSION['cart'][$id_up]['qty'])).'đ';
				$up['subTotal'] += $_SESSION['cart'][$id_up]['price'];
				//print_r($up);
				//$price = $_SESSION['cart'][$id_up]['price'];
				//echo $qty.'oke'.$price;
				
				

			}

		}
		echo json_encode($up);	 

	}
?>

<?php
	//Update qty -
	if (isset($_POST['id_down'])) {
		$id_down = $_POST['id_down'];
		//echo $id_down;

		// echo "<pre>"; 
		// print_r($_SESSION['cart'][$_POST['id_down']]['qty']);
		// echo "</pre>";

		$down = [];
		$down['subTotal'] = 0;
		foreach ($_SESSION['cart'] as $list) {
			$down['subTotal'] += ($list['qty'] * $list['price']);
			if ($id_down == $list['id']) {
				$_SESSION['cart'][$id_down]['qty'] = $_SESSION['cart'][$id_down]['qty'] - 1;
				//print_r($_SESSION['cart'][$id_down]['qty']);
				$down['qty'] = $_SESSION['cart'][$id_down]['qty'];
				$down['totalPrice'] = number_format(($_SESSION['cart'][$id_down]['price'] * $_SESSION['cart'][$id_down]['qty'])).'đ';
				$down['subTotal'] -= $_SESSION['cart'][$id_down]['price'];

				//print_r($down);
				
			}

			if ($list['qty'] == 0 && $id_down == $list['id']) {
				unset($_SESSION['cart'][$id_down]);
			}
		}
		echo json_encode($down); 

	}
?>

