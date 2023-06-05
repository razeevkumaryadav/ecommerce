<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">
		<?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
	      <!-- Main content -->
		  <div id="msg"><div>
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<h1 class="page-header">YOUR CART</h1>
	        		<div class="box box-solid">
	        			<div class="box-body">
						
		        		<table class="table table-bordered">
		        			<thead>
		        				<th></th>
		        				<th>Photo</th>
		        				<th>Name</th>
		        				<th>Price</th>
								<th>Available(in kg)</th>
		        				<th width="20%">Quantity(kg)</th>
		        				<th>Subtotal</th>
		        			</thead>
		        			<tbody id="tbody">
		        			</tbody>
		        		</table>
	        			</div>
	        		</div>
	        		<?php
	        			if(isset($_SESSION['user'])){
	        				// echo "
	        				// 	<div id='paypal-button'></div>
	        				// ";

							echo '<a href="#addnew" data-toggle="modal" class="btn btn-success btn-sm btn-flat" id="checkout"><i class="fa fa-plus"></i> Check Out</a>';
	        			}
	        			else{
	        				echo "
	        					<h4>You need to <a href='login.php'>Login</a> to checkout.</h4>
	        				";
	        			}
	        		?>
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
		  <?php include 'cart_modal.php'; ?>
	     
	    </div>
	  </div>
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
var total = 0;
$(function(){
	$(document).on('click', '.cart_delete', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'cart_delete.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.minus', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		if(qty>1){
			qty--;
		}
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.add', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		qty++;
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	getDetails();
	getTotal();

});
// $(document).ready(function () {
//   $("form").submit(function (event) {
// 	var total = $('#totalpayable').val();
// 	var paid = $('#payAmount').val();
// 	var due = $('#dueAmount').val();

// 	$.ajax({
// 			type: 'POST',
// 			url: 'sales.php',
// 			data: {
				
// 				total :total,
// 				paid:paid,
// 				due:due
// 			},
// 			dataType: 'json',
// 			success: function(response){
// 				console.log('response',response)
// 			},
// 			error:function(xhr, status, error)
// 			{
// 				//var err = JSON.parse(error.responseText);
// 				console.log("error",error,status,xhr)
// 			}


//   })
// });
// })
// $(document).on('click','#pay', function(e)
// {
// 	e.preventDefault();
// 	var total = $('#totalpayable').val();
// 	var paid = $('#payAmount').val();
// 	var due = $('#dueAmount').val();

// 	$.ajax({
// 			type: 'POST',
// 			url: 'sales.php',
// 			data: {
// 				// qty: sumqty,
// 				// coupon: coupon,
// 				total :total,
// 				paid:paid,
// 				due:due
// 			},
// 			dataType: 'json',
// 			success: function(response){
// 				 // console.log({response});
// 				if(response.success){
// 					//$("#apply").attr( "disabled", "disabled" );
// 					// getDetails();
// 					// getCart();
// 					// getTotal();
// 					// var total = document.getElementById("total").innerHTML;
// 					//  var totals = $("#totals").val();
// 					//  totals = parseFloat(totals);
// 					//  var dis = parseFloat(response.discount);
// 					//  console.log('dis',dis);
// 					//  if(dis > 0)
// 					//  {
// 					// 	//var dis = parseFloat(response.discount)
// 					// 	total = ( totals - parseFloat((dis/100)*totals)).toFixed(2)
// 					//  }
// 					//  console.log('final tota',total);
// 					//  if(total >0 )
// 					// {$("#totals").val(total);}
// 				}
// 				else{
// 					// var el = $('<div>')
//                     //         el.addClass("alert alert-danger err-msg").text(response.error)
//                     //         _this.prepend(el)
//                     //         el.show('slow')
// 					location.reload();
				
// 				}
// 			}
// 		});

// }
// )
$(document).on('click','#apply',function(e)
{
	var sumqty = 0;
    $(".qty").each(function(){
        sumqty += +$(this).val();
      
    });
    var coupon = $('#coupon').val();
	$.ajax({
			type: 'POST',
			url: 'apply_coupon.php',
			data: {
				qty: sumqty,
				coupon: coupon,
			},
			dataType: 'json',
			success: function(response){
				
				if(response.success){
					$("#apply").attr( "disabled", "disabled" );
				
					 var totals = $("#totals").val();
					 totals = parseFloat(totals);
					 var dis = parseFloat(response.discount);
					 console.log('dis',dis);
					 if(dis > 0)
					 {
						//var dis = parseFloat(response.discount)
						total = ( totals - parseFloat((dis/100)*totals)).toFixed(2)
					 }
					 console.log('final tota',total);
					 if(total >0 )
					{$("#totals").val(total);}
				}
				else{
				
					location.reload();
					
				}
			}
		});
	});

	$(document).on('click','#checkout',function(e)
	{
		var totals = $('#totals').val();
		$('#totalpayable').val(totals);
	});

	

	$('#payAmount').change(function(){
		var totals =  parseFloat($('#totals').val());
		  var qty = parseFloat($('.qty').val());
		  var payAmount =  parseFloat($('#payAmount').val());
		  if(qty >1000 && (totals/2) >= payAmount)
		  {
			alert('your pay amount should be at least 50%');
			$("#pay").attr( "disabled", "disabled" );

		  }
		  else
		  {
			$("#pay").removeAttr( "disabled", "disabled" );

		  }
		    
		//var payAmount = $('#payAmount').val();
        var due = (totals - payAmount).toFixed(2);
		$('#dueAmount').val(due);
	});
	
	


function getDetails(){
	$.ajax({
		type: 'POST',
		url: 'cart_details.php',
		dataType: 'json',
		success: function(response){
			$('#tbody').html(response);
			getCart();
		}
	});
}

function getTotal(){
	$.ajax({
		type: 'POST',
		url: 'cart_total.php',
		dataType: 'json',
		success:function(response){
			total = response;
		}
	});
}
</script>
<!-- Paypal Express -->
<!-- <script>
paypal.Button.render({
    env: 'sandbox', // change for production if app is live,

	client: {
        sandbox:    'ASb1ZbVxG5ZFzCWLdYLi_d1-k5rmSjvBZhxP2etCxBKXaJHxPba13JJD_D3dTNriRbAv3Kp_72cgDvaZ',
        //production: 'AaBHKJFEej4V6yaArjzSx9cuf-UYesQYKqynQVCdBlKuZKawDDzFyuQdidPOBSGEhWaNQnnvfzuFB9SM'
    },

    commit: true, // Show a 'Pay Now' button

    style: {
    	color: 'gold',
    	size: 'small'
    },

    payment: function(data, actions) {
        return actions.payment.create({
            payment: {
                transactions: [
                    {
                    	//total purchase
                        amount: { 
                        	total: total, 
                        	currency: 'USD' 
                        }
                    }
                ]
            }
        });
    },

    onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function(payment) {
			window.location = 'sales.php?pay='+payment.id;
        });
    },

}, '#paypal-button');
</script> -->
</body>
</html>