<?php //print_r($status[0]['status']) ?>
  <!--================Checkout Area =================-->
<section class="product_image_area section-top section_padding">
	<div class="container">
		<div class="billing_details">
			<div class="row">
				<div class="col-lg-8">
					<h3>Billing Details</h3>
					<form class="row contact_form" action="#" method="post" novalidate="novalidate">
						<input type="text" class="form-control" id="id" name="ID" value="<?php echo ( sizeof($rentee) > 0  ? $rentee[0]['id'] : '' ) ?>" hidden/>
						<input type="text" class="form-control" id="reciept_number" name="reciept_number" value="<?php echo ( sizeof($rentee) > 0  ? $rentee[0]['reciept_number'] : '' ) ?>" hidden/>
						<div class="col-md-6 form-group p_star">
							<span id="label_f">First name </span>
							<input type="text" class="form-control" id="first" name="name" value="<?php echo ( sizeof($rentee) > 0  ? $rentee[0]['first_name'] : '' ) ?>" />
							<div id="danger_f" class="alert alert-danger" role="alert" style="display: none;">This is field is required.</div>
						</div>
						<div class="col-md-6 form-group p_star">
							<span id="label_l">Last name</span>
							<input type="text" class="form-control" id="last" name="name"  value="<?php echo ( sizeof($rentee) > 0  ? $rentee[0]['last_name'] : '' ) ?>"/>
							<div id="danger_l" class="alert alert-danger" role="alert" style="display: none;">
							This is field is required.
							</div>
						</div>
						<div class="col-md-6 form-group p_star">
							<span id="label_p">Phone number</span>
							<input  class="form-control" id="number" name="number"  
							oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
							type = "number"
							maxlength = "11"
							value="<?php echo ( sizeof($rentee) > 0  ? $rentee[0]['phone'] : '' ) ?>" />
							<div id="danger_p" class="alert alert-danger" role="alert" style="display: none;">
							Please provide a valid phone number.
							</div>
						</div>
						<div class="col-md-6 form-group p_star">
							<span id="label_e">Email Address</span>
							<input type="email" class="form-control" id="email" name="compemailany"  value="<?php echo ( sizeof($rentee) > 0  ? $rentee[0]['email'] : '' ) ?>"/>
							<div id="danger_e" class="alert alert-danger" role="alert" style="display: none;">
							Please provide a valid email address.
							</div>
						</div>
						<div class="col-md-6 form-group p_star">
							<span id="label_a">Address</span>
							<input type="text" class="form-control" id="city" name="city"  value="<?php echo ( sizeof($rentee) > 0  ? $rentee[0]['address'] : '' ) ?>"/>
							<div id="danger_a" class="alert alert-danger" role="alert" style="display: none;">
							This is field is required.
							</div>
						</div>
						<div class="col-md-6 form-group p_star">
							<span id="label_a">User Status</span>
							<select class="form-control" id="exampleFormControlSelect1">
							  <?php if( sizeof($rentee) > 0 ){?>
								<option ><?php echo $rentee[0]['user_status']; ?></option>
							  <?php } ?>
							  <option value="guest">Guest</option>
							  <option value="staff/faculty">Staff/Faculty</option>
							</select>
							<div id="danger_us" class="alert alert-danger" role="alert" style="display: none;">
								This is field is required.	
							</div>
						</div>
					</form>
				</div>
				<div class="col-lg-4">
					<div class="order_box">
						<div class="col-lg-12"  style="display:flex">
							<h2 class="col" >Your Item</h2>
							<h2 class="col" ><i><?php echo ( sizeof($rentee) > 0  ? $rentee[0]['reciept_number'] : '' ) ?></i></h2>
						</div>
						<ul class="list">
							
							
							<li>
								<a href="#">Item<span>
								
							
								
								<?php if( sizeof($rentee) == 0 ){
								 	echo 'Sub Total';
								} else if( sizeof($rentee) > 0 && $rentee[0]['user_status'] != 'guest' ){
									echo 'Item Total';									
								} else {
									echo 'Sub Total';
								} ?>
								
								
								</span></a>
							</li>
							
							<?php
							
							$sum = 0;

							if ( sizeof($cart) > 0) : ?>
								<?php foreach($cart as $item) : 
								
									$sum += $item['payable'];
								?>
								<li>
									<a style=" <?php echo $rentee[0]['user_status'] != 'guest' ? 'display: flex; justify-content: space-between;' : '' ?> margin-top: 20px" href="<?php echo base_url('single_costume/view/').$item['item_id'] ?>"><?php echo $item['name']?> 
										
											
										<?php 	
											if( $rentee[0]['user_status'] == 'guest' ){	
												
												echo '<span style="width: unset;" class="middle" >';
													echo '₱'.number_format( $item['rental_prize'], 2 ).' x '. $item['rented_qty'];
												 echo '</span>';
												?>
													<input class="payable" value = "<?php echo number_format( $item['payable'] ) ?>" hidden />
													<span id="payable" class="last">₱<?php echo number_format( $item['payable'], 2 ) ?></span>
												<?php
											} else {
												echo '<span style="width: unset;" class="middle" >';
												echo ' x '. $item['rented_qty'];
												echo '</span>';
											}												
										?>
										
									</a>	
								</li>
								<?php endforeach; ?>
							<?php endif;?>
						</ul>
						
							<ul class="list list_2">
								<?php
								
								if ( !empty($rentee) && $rentee[0]['user_status'] == 'guest') { ?>
									<li><a href="#">Total<span class="all-total" >₱<?php echo number_format( $sum, 2 )?> </span></a></li>
								<?php }?>
							</ul>
						<?php 
						
						//echo sizeof($cart);
						//echo $status[0]['status'];
	
						if ( $status && $status[0]['status'] !== 'Unpaid' ) : ?>
							<div style="padding:0; margin-top: 20px" class="alert alert-check" role="alert">
								<a class="btn_3 add-to-cart" style=" font-size: 12px;" href="/pescao/admin/dashboard"> Add something into your cart. </a> 
							</div>
						<?php endif; ?>
						<?php
							
							
							if( sizeof($cart) > 0 && $status[0]['status'] === 'Unpaid' ){
								echo '<div> <a class="btn_3 btn-returnItem" id="return" href="#" style=" font-size: 12px;">Return Items</a> </div> ';
								echo '<div class="button-group-area mt-1"><a style="padding: 9px 42px;" href="/pescao/rentor/item_lost/'.$rentee[0]["reciept_number"].'" class="btn_3 genric-btn danger-border">Report Item Lost</a></div>';
							}else{
								echo ( sizeof($cart) > 0 ? '<a target="_blank" class="btn_3 btn-registercheckout" id="checkout"  href="/pescao/rentor/reciept/'.$recieptId.'">Proceed to Checkout</a>' : '' ) ;
								echo( $recieptId == '' ? '  <a class="btn_3 " id="register" href="/pescao/admin/dashboard" style=" font-size: 12px;">Register to Checkout Items</a>' : '');
							}

						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<style>
		.btn-registercheckout{
			background-color: #fff;
			border: 1px solid #f57224;
			color: #f57224;
		}
		.btn-registercheckout:hover{
			background-color: #f57224;
			border: 1px solid #f57224;
		}
		.add-to-cart:hover,
		.btn-returnItem:hover{
			background-color: #fff;
			color: #2f7dfc!important;
		}
</style>

  <!--<script src=" <?php //echo base_url('assets/js/jquery-1.12.1.min.js'); ?> "></script> -->
  <script>
	$(document).ready(function(){
			
		//var elementExists = document.getElementById("payable");
		//if( elementExists ){
			//var number = parseInt( $(".payable" ).val() );
			
			//console.log( number );
			
			//document.getElementById("payable").innerHTML = '₱'+number.toLocaleString()+'.00';	
			
		//}

		function validateEmail(email) {
		  const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		  return re.test(email);
		}
		
		$("#register").click(function(e){   
				
				$f_name 		= $( "#first" ).val();
				$l_name 		= $( "#last" ).val();
				$phone 			= $( "#number" ).val();
				$email 			= $( "#email" ).val() ;
				$address 		= $( "#city" ).val();
				$user_status	= $("#exampleFormControlSelect1").val();	
				$itemId 		= $( "#itemId" ).val();
				$qty 			= $( "#qty" ).val();
				$rental_prize 	= $( "#rental_prize" ).val();
				
				if( $f_name == "" ){
					//$("#label_f").hide();
					$("#danger_f").show();
					return false;
				}
				if( $l_name == "" ){
					//$("#label_l").hide();
					$("#danger_l").show();
					return false;
				}
				let re = new RegExp(/^(09|\+639)\d{9}$/g);
				if( $phone  == "" ||  !$phone.match(re) ){
					//$("#label_p").hide();
					$("#danger_p").show();
					return false;
				}else{
					
				}
				if( !validateEmail( $( "#email" ).val() ) ){
					//alert('Invalid Email');
					$("#label_e").hide();
					$("#danger_e").show();
					return false;
				}
				
				if( $address  == "" ){
					//$("#label_a").hide();
					$("#danger_a").show();
					return false;
				}
				
				if( $user_status  == "" ){
					//$("#label_a").hide();
					$("#danger_us").show();
					return false;
				}
				

		 var postData = {
			  'first_name' : $f_name,
			  'last_name'  : $l_name,
			  'address'    : $address,
			  'phone'      : $phone,
			  'email'      : $email,
			  'city'       : $address,
			  'user_status' : $user_status,
			  'itemId'     : $itemId,
			  'qty'        : $qty,
			  'rental_prize': $rental_prize,
			};
			
			console.log( postData );
			
			$.ajax({
				 type: "POST",
				 url: "/pescao/checkout/rentee",
				 data: postData , //assign the var here 
				 success: function(test){
					  //window.location.replace("/pescao/admin/dashboard");
					  console.log(test);
				 }
			});
			
		});
		
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
		
 		$("#return").click(function(){ 
			
			alert( 'Im A cart' );
			
			$id = $( "#id" ).val();
			$reciept_number = $( "#reciept_number" ).val();
			var postData = {
			  'id' : $id,
			  'reciept_number' : $reciept_number,
			};
			
			$.ajax({
				 type: "POST",
				 url: "/pescao/inventory/returnItem",
				 data: postData , //assign the var here 
				 success: function(test){
					  window.location.replace("/pescao/admin/dashboard");
					  console.log(test);
				 }
			});
		});  
		
	});
</script>
