<?php
	include 'includes/session.php';

	$id = $_POST['id'];

	$conn = $pdo->open();

	$output = array('list'=>'');

	$stmt = $conn->prepare("SELECT *, details.quantity as qty FROM details LEFT JOIN products ON products.id=details.product_id LEFT JOIN sales ON sales.id=details.sales_id WHERE details.sales_id=:id");
	$stmt->execute(['id'=>$id]);

	$total = 0;
	foreach($stmt as $row){
		$output['transaction'] = $row['pay_id'];
		$output['date'] = date('M d, Y', strtotime($row['sales_date']));
		$paid = $row['paid'];
		$due =$row['due'];
		$salesTotal =$row['total'];
		$subtotal = $row['price']*$row['qty'];
		$total += $subtotal;
		$discount = $total - $salesTotal;
		$output['list'] .= "
			<tr class='prepend_items'>
				<td>".$row['name']."</td>
				<td>&#36; ".number_format($row['price'], 2)."</td>
				<td>".$row['qty']."</td>
				<td>&#36; ".number_format($subtotal, 2)."</td>
			</tr>
		";
	}
	
	$output['total'] = '<b>&#36; '.number_format($total, 2).'<b>';
	$output['paid']= '<b>&#36; '.number_format($paid, 2).'<b>';
	$output['due']= '<b>&#36; '.number_format($due, 2).'<b>';
	$output['discount']= '<b>&#36; '.number_format($discount, 2).'<b>';
	$pdo->close();
	echo json_encode($output);

?>