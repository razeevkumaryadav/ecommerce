<?php
	include 'includes/session.php';

	//if(isset($_POST['add'])){
	//	$id = $_POST['id'];
	//	$product = $_POST['product'];
        $count = 0;
        $discount = 0;
		$quantity = $_POST['qty'];
        $code =$_POST['coupon'];
		$conn = $pdo->open();
    
		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM discountrate WHERE code=:code");
		$stmt->execute(['code'=>$code]);
		$row = $stmt->fetch();

		if($row['numrows'] < 1 ){
			$_SESSION['error'] = 'coupon code does not exist';
			$resp['error']='coupon code does not exist';
           
		}
		else{
			try{
				//$stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:user, :product, :quantity)");
                $stmt = $conn->prepare("SELECT discount  FROM discountrate WHERE code=:code and minvol >=:qty and maxvol =<:qty");
				$stmt->execute(['code'=>$code,'qty'=>$quantity]);
                $row = $stmt->fetch();
				$_SESSION['success'] = 'Product added to cart';
				$resp['success']='Product added to cart';
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				$resp['error']=$e->getMessage();
			}
		}
        $count = $stmt->rowCount();
       // echo $count;
		//echo $row['discount'];
        if($count >0 && ($row['discount'] !=  null))
        {
            $discount = $row['discount'];
        }
		$resp['discount']=$discount;
		$pdo->close();
        // $discount = $stmt['discount'];
		// $dis = {'discount':$discount};
        echo json_encode($resp);
		//header('location: cart_view.php');
	//}

?>