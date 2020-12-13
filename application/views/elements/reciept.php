<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='css/' />
	<link rel="stylesheet" href=" <?php echo base_url('assets/reciept/css/style.css'); ?>">
	<link rel="stylesheet" href=" <?php echo base_url('assets/reciept/css/pint.css'); ?>">

	<script type='text/javascript' src=''></script>
	<!-- <script type='text/javascript' src='js/example.js'></script> -->
</head>

<body>
	<div id="page-wrap">

		<textarea id="header">INVOICE</textarea>
		
		<div id="identity">
		   <?php $temp = 0 ?>
		   <input type="text" class="form-control" id="id" name="ID" value="<?php echo ( sizeof($rentee) > 0  ? $rentee[0]['id'] : '' ) ?>" hidden/>
           <?php echo $rentee[0]['last_name']. ' '. $rentee[0]['first_name'] ?>
		   <br>
           <?php echo $rentee[0]['address'] ?>
		   <br>
           <?php echo $rentee[0]['phone'] ?>
			<br>
			<br>

            <div id="logo">

              <div id="logohelp">
                <input id="imageloc" type="text" size="50" value="" /><br />
                (max width: 540px, max height: 100px)
              </div>
			  <img style="max-width: 100%;width: auto;height: 92px;margin: 0 72px 14px 0;" id="image" src="<?php echo base_url('assets/img/Northwestern_Mindanao_State_College_of_Science_and_Technology.png'); ?> " alt="logo">
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">
		<h2 id="customer-title" >PESCAO </h2>
 
            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td><?php echo $rentee[0]['reciept_number'] ?></td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td id="date"></td>
                </tr>

            </table>
		
		</div>
		
		<table id="items">
		
		  <tr>
		      <th>Item</th>
		      <th>Description</th>
		      <th>Item Type</th>
		      <th>Unit Cost</th>
		      <th>Quantity</th>
		      <th>Price</th>
		  </tr>
		  
			<?php if (sizeof($cart) > 0) : ?>
				<?php foreach($cart as $item) : ?>
					 <tr class="item-row">
						  <td class="item-name"><div class="delete-wpr"><?php echo $item['name'] ?></div></td>
						  <td class="item-name"><div class="delete-wpr"><?php echo $item['description'] ?></div></td>
						  <td class="item-name"><div class="delete-wpr"><?php echo $item['item_type'] ?></div></td>
						  <td class="item-name"><div class="delete-wpr">₱<?php echo number_format($item['rental_prize']) ?></div></td>
						  <td class="item-name"><div class="delete-wpr"><?php echo $item['rented_qty'] ?></div></td>
						  <td class="item-name"><div class="delete-wpr payable">₱<?php echo number_format($item['payable']); $temp += $item['payable'];?></div></td>

					  </tr>
				
				<?php endforeach; ?>
			 <?php endif; ?>


		  <tr>
		      <td colspan="3" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due</td>
		      <td class="total-value balance"><div class="due"><?php echo $temp; ?></div></td>
		  </tr>
		  <tr>
		      <td colspan="3" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Date Return :</td>
		      <td class="total-value balance"><div class="due"></div></td>
		  </tr>
		  <tr>
		      <td colspan="3" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Penalty :</td>
		      <td class="total-value balance"><div class="due"></div></td>
		  </tr>
		  <tr>
		      <td colspan="3" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Total :</td>
		      <td class="total-value balance"><div class="due"></div></td>
		  </tr>
		
		</table>
		
		<div id="terms">
		  <h5>Terms</h5>
		  <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
		</div>
		<button  onclick="window.print()">Print this page</button>
	
	</div>
	
</body>


<script src=" <?php echo base_url('assets/js/jquery-1.12.1.min.js'); ?> "></script>
<script>
n =  new Date();
	y = n.getFullYear();
	m = n.getMonth() + 1;
	d = n.getDate();
	document.getElementById("date").innerHTML = m + "/" + d + "/" + y;
	
	$(document).ready(function(){

		$("#checkout").click(function(){ 
			$id = $( "#id" ).val();
			var postData = {
			  'id' : $id
			};
			
			$.ajax({
				 type: "POST",
				 url: "/pescao/checkout/saveCheckout",
				 data: postData , //assign the var here 
				 success: function(test){
					  window.location.replace("/pescao/admin/dashboard");
					  console.log(test);
				 }
			});
		}); 
			
	});

</script>



</html>