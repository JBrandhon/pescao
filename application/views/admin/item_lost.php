<?php //print_r($cart) ?>
			<div class="section-top-border">
				<div class="">
					<div style= "width: 88% !important; margin: 0 auto !important;" class="progress-table">
						<div style="text-align: center;" class="table-head" >
							<div class="serial">#</div>
							<div class="country">Item Name</div>
							<div class="visit">Quantity</div>
							<div class="percentage">Specify Item Lost</div>
						</div>
						<?php 
							$count = 0;
								if (sizeof($cart) > 0) : 
							?>
							<?php foreach($cart as $item) : ?>
								<div class="table-row">
									<div class="serial"><?php echo $count+=1; ?></div>
									<div class="visit"><?php echo $item['name']; ?></div>
									<div class="visit"><?php echo $item['rented_qty']; ?></div>
									<div class="percentage">
										<div class="">

											<div class="input-group inline-group">
											  <div class="input-group-prepend">
												<button class="btn btn-outline-secondary btn-minus">
												  <i class="fa fa-minus"></i>
												</button>
											  </div>
											  <input type="number" id="<?php echo $item['item_id']; ?>" style="text-align: center;" class="form-control quantity" min="0" max ="<?php echo $item['rented_qty']; ?>" name="quantity" value="0" type="number">
											  <input id="s<?php echo $item['item_id']; ?>" value="<?php echo $item['reciept_number']; ?>" hidden >
											  <div class="input-group-append">
												<button class="btn btn-outline-secondary btn-plus">
												  <i class="fa fa-plus"></i>
												</button>
											  </div>
											</div>

										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
							<div class="table-row">
								<div class="serial"></div>
									<div class="country"></div>
									<div class="visit"></div>
									<div class="percentage">
										<div class="cupon_text float-right">
											<button type="submit" id="item_lost_btn" class="genric-btn info circle" href="#">Saved Lost Item/s</button>
										 </div>
									</div>
							</div>
					</div>
				</div>
			</div>
	<script>
	
	$(document).ready(function() {
		$sum = 0;
		 $(':button[type="submit"]').prop('disabled', true);
		 $(':button[type="submit"]').hide();
			 $('.btn-outline-secondary').click(function() {
				$('.quantity').each(function(index, value) {
					$temp =  parseInt(value.value);
					$sum += $temp;
					// console.log($sum);
					if(  $sum > 0 ){
						console.log($sum);
						$(':button[type="submit"]').prop('disabled', false);
						 $(':button[type="submit"]').show();
					}else{
						console.log($sum);
						 $(':button[type="submit"]').prop('disabled', true);
						 $(':button[type="submit"]').hide();
					}
				});
				$sum = 0;
			 });
		 });
	 
	 			
	
		$('.btn-plus, .btn-minus').on('click', function(e) {
		  const isNegative = $(e.target).closest('.btn-minus').is('.btn-minus');
		  const input = $(e.target).closest('.input-group').find('input');
		  if (input.is('input')) {
			input[0][isNegative ? 'stepDown' : 'stepUp']()
		  }
		})
	
		$('#item_lost_btn').click(function(e) {
		  let postData =[];
		$('.quantity').each(function(index, value) {
			$id = 's'+value.id;
			 var obj = { 
					item_id:value.id,
					quantity:value.value,
					reciept_number: $( '#'+$id ).val(),
				};
				if(value.value>0){
					postData.push(obj);
				}
				
		});
		
		console.log( postData );
					
			$.ajax({
				 type: "POST",
				 url: "/pescao/inventory/item_lost",
				 data: { data : postData}, //assign the var here 
				 success: function(test){
					 parent.history.back();
					  // window.location.replace("/pescao/admin/dashboard");
					  console.log(test);
				 }
			});
		

	});
		
	</script>