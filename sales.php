<?php
	include 'includes/session.php';

	if(isset($_GET['pay'])){
		//$payid = $_GET['pay'];
		$payid = uniqid();;
		$date = date('Y-m-d');
		// $total = $_POST['totalpayable'];
		// $paid = $_POST['payAmount'];
		// $due = $_POST['dueAmount'];
		$total = $_POST['total'];
		$paid = $_POST['paid'];
		$due = $_POST['due'];

		$conn = $pdo->open();

		try{
			
			$stmt = $conn->prepare("INSERT INTO sales (user_id, pay_id, sales_date,total,paid,due) VALUES (:user_id, :pay_id, :sales_date,:total, :paid,:due)");
			$stmt->execute(['user_id'=>$user['id'], 'pay_id'=>$payid, 'sales_date'=>$date,'total'=>$total,'paid'=>$paid,'due'=>$due]);
			$salesid = $conn->lastInsertId();
			
			try{
				$stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user_id");
				$stmt->execute(['user_id'=>$user['id']]);

				foreach($stmt as $row){
					$stmt = $conn->prepare("INSERT INTO details (sales_id, product_id, quantity) VALUES (:sales_id, :product_id, :quantity)");
					$stmt->execute(['sales_id'=>$salesid, 'product_id'=>$row['product_id'], 'quantity'=>$row['quantity']]);
				}

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