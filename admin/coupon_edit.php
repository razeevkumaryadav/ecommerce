<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
        $code = $_POST['code'];
        $minvol = $_POST['minvol'];
        $maxvol = $_POST['maxvol'];
        $discount = $_POST['discount'];

		try{
			$stmt = $conn->prepare("UPDATE discountrate SET code=:code,minvol=:minvol,maxvol=:maxvol,discount=:discount WHERE id=:id");
			$stmt->execute(['code'=>$code,'minvol'=>$minvol,'maxvol'=>$maxvol,'discount'=>$discount, 'id'=>$id]);
			$_SESSION['success'] = 'Coupon updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit coupon form first';
	}

	header('location: coupon.php');

?>