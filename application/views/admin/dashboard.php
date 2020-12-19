 
    <!--================Category Product Area =================-->
    <section class="cat_product_area section-top border_top">
        <div class="container">
            <div class="row">			
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets p_filter_widgets sidebar_box_shadow">
                            <div class="l_w_title">
                                <h4 style=" text-align: center; "><b>Costumes & Equipments Filter</b></h4>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    </li>  
									<li>
									  <input type="radio" id="all" class="sort" name="gender" value="all" checked="checked">
									  <label for="all">All</label><br>
                                    </li>
                                    <li>
										<input type="radio" id="costumes" class="sort" name="gender" value="costumes">
										<label for="male">Costumes</label><br>
                                    </li>
                                    <li>
									  <input type="radio" id="equipments" class="sort" name="gender" value="equipments">
									  <label for="female">Sports Equipments</label><br>
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product_top_bar d-flex justify-content-between align-items-center">
                                <div class="single_product_menu product_bar_item">
                                    <h2>Costumes & Equipments</h2>
                                </div>
                                <div class="product_top_bar_iner product_bar_item d-flex">
                                    <div class="product_bar_single">
                                       <!-- <select class="wide">
                                            <option data-display="Default sorting">Default sorting</option>
                                            <option value="1">Some option</option>
                                            <option value="2">Another option</option>
                                            <option value="3">Potato</option>
                                        </select> -->
                                    </div>
                                    <div class="product_bar_single">
									<?php if( $admin_id == 1) {?>
										<button type="button" class="btn btn_3 btn-info btn-lg" data-toggle="modal" data-target="#addCostumeModal">Add Item</button>
                                    <?php }?>
									</div>
                                </div>
                            </div>
							<div class="input-group">
								<input type="text"  name="search" id="search_text" class="form-control" placeholder="Search this blog">
								<div class="input-group-append">
								  <button class="btn btn-secondary" type="button">
									<i class="fa fa-search"></i>
								  </button>
								</div>
							</div>
                        </div>
						<div id="result" class=""></div>
						<?php if (sizeof($costumes) > 0) : ?>
							<?php foreach($costumes as $costume) : ?>
							
								<div class="col-lg-4 col-sm-6 <?php echo $costume->item_type?>">
									<div class="single_category_product">
										<div class="single_category_img">
											<?php 
												echo '<img style=" height: 254px; object-fit: cover; " class="rounded mx-auto d-block img-thumbnail"  src="data:image/jpeg;base64,'.base64_encode($costume->image ).'"/>'; 
											?>
											<div class="category_social_icon">
												<ul>
													<li><a href="<?php echo base_url('single_costume/edit/').$costume->id; ?>"><i class="ti-pencil-alt"></i></a></li>
												</ul>
											</div>
											<div class="category_product_text">
												<a href="<?php echo base_url('single_costume/view/').$costume->id; ?> ">
													<h5> <?php echo $costume->name ?> </h5>
												</a>
												<?php echo ($costume->item_type === 'Costume' ? '
													<p>₱'.number_format($costume->rental_prize, 2 ).'</p>
												': ''); ?>
												<label>qty:<?php echo number_format( $costume->qty )  ?> </labelP>
												
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>

                        <div class="col-lg-12 text-center">
                            <a href="#" class="btn_2">Back to top</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!--================ Add Product =================-->	

<!-- Modal -->
	<div id="addCostumeModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"> </h4>
				</div>
				<div class="col-lg-12 modal-body">
					<div class="tracking_box_inner">
						<?php echo form_open_multipart('inventory/upload'); ?>
							<div class="col-md-12 form-group box">
								<div class="js--image-preview"></div>
								<div class="input-field">
									<label class="active">Photos</label>
									<div class="input-images-1" style="padding-top: .5rem;"></div>
								</div>
								<span style="font-size: 12px; color: #868282;">(Maximum of 1MB File Size)</span>
								<p id="demo"></p>
							</div>
						<div class="col-md-12 form-group">
							<input type="text" class="form-control" id="costume_name" name="item_name" placeholder="Item Name" required>
						</div>
						<div class="col-md-12 form-group">
							<input type="number" class="form-control" id="costume_qty" name="item_qty" placeholder="Qty.." required>  
						</div>
						<div class="col-md-12 form-group p_star">
							<label>Item Type: </label>
							<div class="radio col-md-12 form-group p_star">				
								<label><input id="cs" type="radio" name="item_type" value="Costume" >Costume</label>
							<label><input  id="sp" type="radio" name="item_type" value="Sports Equipment">Sports Equipment</label>
							</div>
						</div>
						<div class="col-md-12 form-group p_star">
							<label>For: </label>
							<div class="radio col-md-12 form-group p_star">
								<label><input id="men" type="radio" name="for_gender" value="Male" >MEN</label>
								<label><input  id="women" type="radio" name="for_gender" value="Female">WOMEN</label>
								<label><input id="cs" type="radio" name="for_gender" value="Both" >BOTH</label>
							</div>
						</div>
						<div class="col-md-12 form-group">
							<label id="prize-label">Rental Price</label>
							<input type="number" class="form-control" id="costume_prize" value="0" name="item_prize" required>
						</div>
						<div class="col-md-12 form-group">
							<textarea type="text" class="form-control" id="description" name="description" placeholder="Definition" required></textarea>
						</div>
						<div class="col-md-12 form-group">
							<button  type="	" value="submit" class="btn_3 handle-save-item save ">Save</button>
						</div>
						</form>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

<script>




$(document).ready(function(){ 

	$( '#search_text' ).keyup( function(){
		
		var text = $(this).val();
		res = new Array();
		
		if( text != '' ){
			
			$.ajax({
				 method: "POST",
				 // url: "/pescao/inventory/item_lost",
				 url: "/pescao/inventory/search",
				 data: { search : text},
				dataType: 'text',
				 success: function(data){
					res = data;
					//$('#result').html(typeof(data));
					console.log(res);
				 }
			});
			
		} else {
			$('#result').html('');
		}
		
	});

	
	$(".handle-save-item").click(function(e) {
		
		let val = $('input[type="file"]').val()
		
		if( val == '' ){	
			alert( 'Picture must not empty!' );
			e.preventDefault();
		} 
	});


  // $(".btn_3").click(function () {
    // alert("Hello!");
  // });


	$('.input-images-1').imageUploader();


	$("#sp").click(function(){
		//$('#costume_prize').val('0');
		$('#prize-label').hide();
		$('#costume_prize').hide();
	});
	
	$("#cs").click(function(){
		$('#costume_prize').show();
	});
	
	   $('.sort').click(function () {
		console.log( $(this).val() );
			if( $(this).val() == "costumes" ){
				 $('.Equipment').hide();
				 $('.Costume').show();
				 // $count =$('.Female').length;
				 // document.getElementById("sort").innerHTML = "Womens "+"("+ $count+")";
			}
			if( $(this).val() == "equipments" ){
				 $('.Equipment').show();
				 $('.Costume').hide();
				 // $count =$('.Male').length;
				 // document.getElementById("sort").innerHTML = "Mens "+"("+ $count+")";
			}
			if( $(this).val() == "all" ){
				 $('.Equipment').show();
				 $('.Costume').show();
				 // document.getElementById("sort").innerHTML = "All "+"("+ $count+")";
			}
			 
		   });
	
	
});

</script>
