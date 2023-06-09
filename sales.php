<?php
	include 'includes/session.php';

	if(isset($_POST['totalpayable'])){
		//$payid = $_GET['pay'];
		$payid = uniqid();;
		$date = date('Y-m-d');
		$total = $_POST['totalpayable'];
		$paid = $_POST['payAmount'];
		$due = $_POST['dueAmount'];
		// $total = $_POST['total'];
		// $paid = $_POST['paid'];
		// $due = $_POST['due'];

		$conn = $pdo->open();

		try{
			
			$stmt = $conn->prepare("INSERT INTO sales (user_id, pay_id, sales_date,total,paid,due) VALUES (:user_id, :pay_id, :sales_date,:total, :paid,:due)");
			$stmt->execute(['user_id'=>$user['id'], 'pay_id'=>$payid, 'sales_date'=>$date,'total'=>$total,'paid'=>$paid,'due'=>$due]);
			$salesid = $conn->lastInsertId();
			
			try{
				$stmt = $conn->prepare("SELECT *,cart.quantity as qty FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user_id");
				$stmt->execute(['user_id'=>$user['id']]);
                 $cartqty = 0;
				 $cartproductid =0;
				foreach($stmt as $row){
					$stmt = $conn->prepare("INSERT INTO details (sales_id, product_id, quantity) VALUES (:sales_id, :product_id, :quantity)");
					$stmt->execute(['sales_id'=>$salesid, 'product_id'=>$row['product_id'], 'quantity'=>$row['qty']]);

					$cartqty=$row['qty'];
					$cartproductid=$row['product_id'];
				}
             
				// get the quantity of the products
				//$productqty =0;
				$stmt = $conn->prepare("SELECT quantity  FROM  products  WHERE id=:id");
				$stmt->execute(['id'=>$cartproductid]);
				foreach($stmt as $rows){
                  $productqty = $rows['quantity'];
				  $difqty = $productqty - $cartqty;

				  $stmt = $conn->prepare("UPDATE products SET quantity=:quantity WHERE id=:id");
			      $stmt->execute(['quantity'=>$difqty, 'id'=>$cartproductid]);
				}
				//end of the products
				$stmt = $conn->prepare("DELETE FROM cart WHERE user_id=:user_id");
				$stmt->execute(['user_id'=>$user['id']]);

				$_SESSION['success'] = 'Transaction successful. Thank you.';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	
	header('location: profile.php');
	
?>