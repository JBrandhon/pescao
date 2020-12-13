  <?php //print_r( $status[0]['status'] ); ?>
  <!--================Single Product Area =================-->
  <div class="product_image_area section-top section_padding">
    <div class="container">
	  <div class="row s_product_inner">
		<div class="col-lg-5">
		  <div class="product_slider_img">
			<div id="vertical">
			  <div data-thumb="img/product_details/prodect_details_1.png">

				<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
				  <div class="carousel-inner">
					<?php					
						for ($x = 0; $x < count($single_costume); $x++) {
						$active = "";
						if($x == 0){$active = "active";}
						?>
						 <div class="carousel-item <?php echo $active ?>">
							 <?php 
								echo '<img style="width: 100%; height: 448px; object-fit: cover; " class="rounded mx-auto d-block img-thumbnail" src="data:image/jpeg;base64,'.base64_encode( $single_costume[$x]['image'] ).'"/>'; 
							?>
						 </div>
						 
					<?php	}
					?>
				  </div>
				  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				  </a>
				</div>	
			  </div>
			</div>
		  </div>
		</div>
		<div class="col-lg-5 offset-lg-1">
		  <div class="s_product_text">
			<h3><?php echo $single_costume[0]['name'] ?></h3>
			 <?php echo( $single_costume[0]['item_type'] == "Sports Equipment" ? '' : ' <h2>₱ '. $single_costume[0]['rental_prize'] .' </h2> ' ) ?> 
			<ul class="list">
			  <li>
				<a class="active" href="#">
				  <span>Category</span> : <?php echo $single_costume[0]['item_type'] ?></a>
			  </li>
			  <li>
				<a href="#"> <span>Availibility</span> : <?php echo( $single_costume[0]['qty'] > 0 ? ' In Stock,  '.$single_costume[0]['qty'].' remaining' : 'Out of Stock' ) ?></a>
			  </li>
			</ul>
			<p>
			<?php echo $single_costume[0]['description'] ?>
			</p>
			<div class="card_area">
			<?php  
			
			//echo 'Test', $status[0]['status'];
			
			//echo $isUserLoggedIn;
			
			echo ( $isUserLoggedIn ? '
				<form id="cart">
					<input value="'.$single_costume[0]['id'].'" name="itemId" hidden>
					<input value="'.$single_costume[0]['rental_prize'].'" name="rental_prize" hidden>
					<div class="product_count d-inline-block">
						<span onclick="decrement()"  class="inumber-decrement"> <i class="ti-minus"></i></span>
						<input class="input-number" id="qty" name="qty" type="number" value="0" readonly  >
						<span onclick="increment()"  class="number-increment"> <i class="ti-plus"></i></span>
					</div>
					<div class="add_to_cart">
						'.( ( (  $status && $status[0]['status'] == 'Unprocessed') ) ? '<button type="submit" class="btn_3"> Add to cart</button>' : '<div class="alert alert-danger" role="alert">
					 <a href="/pescao/checkout/cart"> Register </a> '.($single_costume[0]['item_type'] == "Sports Equipment" ? 'borrower' : 'rentor' ).' please before adding item into cart.
					</div>' ).'
				   </div>
				  </form>
			
			' : ''); ?>
			</div>
		  </div>
		</div>
	  </div>
    </div>
  </div>
  <!--================End Single Product Area =================-->
  <!--<script src=" <?php //echo base_url('assets/js/jquery-1.12.1.min.js'); ?> "></script> -->
  <script>
  
	function increment() {
		if( $('#qty').val() == <?php echo $single_costume[0]['qty'] ?> ){
			
		}else{
			 document.getElementById("qty").stepUp(); 
		}
	 
	}
	function decrement() {
		if( $('#qty').val() < 1 ){
			
		}else{
			document.getElementById("qty").stepDown();; 
		}
	 
	}
	
	
	
	$('form#cart').submit(function(e) {
		
		if( $('#qty').val() == 0 ){
			alert('Please specify number of items to be rented.');
			return false;
		}
		
			var form = $(this);

			e.preventDefault();

			$.ajax({
				type: "POST",
				url: "<?php echo site_url('addtocart/save'); ?>",
				data: form.serialize(), // <--- THIS IS THE CHANGE
				dataType: "html",
				success: function(data){
					console.log(data);
					 window.history.back();
					alert("Added to cart.")
				},
				error: function() { alert("Error posting feed."); }
		   });
		

	});
  </script>
