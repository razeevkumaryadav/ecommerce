
<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$name = $_POST['name'];
        $code = $_POST['code'];
        $minvol = $_POST['minvol'];
        $maxvol = $_POST['maxvol'];
        $discount = $_POST['discount'];
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM discountrate WHERE code=:code");
		$stmt->execute(['code'=>$code]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Coupon already exist';
		}
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO discountrate (code,minvol,maxvol,discount) VALUES (:code,:minvol,:maxvol,:discount)");
				$stmt->execute(['code'=>$code,'minvol'=>$minvol,'maxvol'=>$maxvol,'discount'=>$discount]);
				$_SESSION['success'] = 'Coupon added successfully';
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up Coupon form first';
	}

	header('location: coupon.php');

?>