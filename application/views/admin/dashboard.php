 
    <!--================Category Product Area =================-->
    <section class="cat_product_area section-top border_top">
        <div class="container">
            <div class="row">			
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets p_filter_widgets sidebar_box_shadow">
                            <div class="l_w_title">
                                <h4 style=" text-align: center; "><b>Categories</b></h4>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    </li>  
									<li>
									  <input onclick="()"; type="radio" id="all" class="sort" name="gender" value="all" checked="checked">
									  <label for="all">All</label><br>
                                    </li>
                                    <!--<li>
										<input type="radio" id="costumes" class="sort" name="gender" value="costumes">
										<label for="male">Costumes</label><br>
                                    </li>
                                    <li>
									  <input type="radio" id="equipments" class="sort" name="gender" value="equipments">
									  <label for="female">Sports Equipments</label><br>
									</li>-->
									<li>
										<input type="radio" id="barong" class="sort" name="gender" value="barong">
										<label for="male">Barong</label><br>
                                    </li>
									<li>
										<input type="radio" id="dalit-custome" class="sort" name="gender" value="dalit costume">
										<label for="male">Dalit Costume</label><br>
                                    </li>
									<li>
										<input type="radio" id="accesories" class="sort" name="gender" value="accesories">
										<label for="male">Accesories</label><br>
                                    </li>
									<li>
										<input type="radio" id="male-attr" class="sort" name="gender" value="male attire">
										<label for="male">Male Attire</label><br>
                                    </li>
									<li>
										<input type="radio" id="female-atr" class="sort" name="gender" value="female attire">
										<label for="male">Female Attire</label><br>
                                    </li>
									<li>
										<input type="radio" id="gown" class="sort" name="gender" value="gown">
										<label for="male">Gown</label><br>
                                    </li>
									
									<input id="value-hidden-category" hidden>
									
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
							<div class="input-group" style=" margin: 20px 0;">
								<input type="text" style=" border-radius: .25rem; margin-left: 400px; margin-right: 10px;"  name="search" id="search_text" class="form-control" placeholder="Search">
								<button class="search_btn"
									style="border-radius: .25rem;		
									display: inline-block;
									padding: 5px 15px;
															background-color: #2f7dfc;
									border: 1px solid #f4f4f4;
									font-size: 15px;
									color: #fff;
									font-weight: 400;
									border: 1px solid #2f7dfc;
									-webkit-transition: 0.5s;
									transition: 0.5s;" 
									class="search-button"><i class="fas fa-search"></i> Search
								</button>
							</div>
                        </div>
						<div class="search-page-controller" style="display: contents;" >
						</div>
						<div class="main-page-controller" style="display: contents;" >
							<div class="main-page" style="display: contents;">
								<?php if (sizeof($costumes) > 0) : ?>
									<?php foreach($costumes as $costume) : 
									
									if( $costume->item_status != 'damage'){
									?>
									
										<div class="col-lg-4 col-sm-6  <?php echo $costume->item_type?>">
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
														<label>Quantity: <?php echo number_format( $costume->qty )  ?> </labelP>
														
													</div>
												</div>
											</div>
										</div>
											
									<?php } endforeach; ?>
								<?php endif; ?>
							</div>
							<?php if (sizeof($costumes) > 0) : ?>
								<div class="col-lg-12 page-link-ctrl text-center">
									<div class="page-link"><?php echo $this->pagination->create_links(); ?></div>
								</div>
							<?php endif; ?>
						</div>
                        <div class="col-lg-12 page-link-ctrl text-center">
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
							<label>Category:</label>
							<select name="category" class="form-control category-ctrl">
								<option value="nodata">--Choose--</option>
								<option value="barong"> Barong</option>
								<option value="dalit costume">Dalit Costume</option>
								<option value="accesories">Accesories</option>
								<option value="male attire">Male Attire</option>
								<option value="female attire">Female Attire</option>
								<option value="gown">Gown</option>
							</select>
						</div>
						<div class="col-md-12 form-group p_star">
							<label>For: </label>
							<div class="radio col-md-12 form-group p_star">
								<label><input id="men" type="radio" name="for_gender" value="male" >Male</label>
								<label><input  id="women" type="radio" name="for_gender" value="female">Female</label>
								<!--<label><input id="cs" type="radio" name="for_gender" value="Both" >BOTH</label>-->
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

	

	$('#search_text').val('');
	
	$( '.search_btn' ).click( function(){

		var text = $('#search_text').val();
		
		if( text != '' ){
			$('.main-page-controller').hide();	
			$('.search-page-controller').show();
			$.ajax({
				 method: "POST",
				 url: "/pescao/inventory/search",
				 data: { 'search' : text,
						 'page'	: 1 },
				 success: function(data){
					$('.search-page-controller').html(data);
				 }
			});
			
		} else {
			$('.search-page-controller').hide();
			$('.main-page-controller').show();
		}
		
	});

	$(document).on('click', '.pagination_link_search', function(){
		var text 	= $('#search_text').val();
		 var page 	= $(this).attr("id"); 

		if( text != '' ){
			$('.main-page-controller').hide();	
			$('.search-page-controller').show();
			$.ajax({
				 method: "POST",
				 url: "/pescao/inventory/search",
				 data: { 'search' : text,
						 'page'	: page },
				 success: function(data){
					$('.search-page-controller').html(data);
				 }
			});
			
		} else {
			$('.search-page-controller').hide();
			$('.main-page-controller').show();
		}
	});

	$('#example').DataTable( {
        "pagingType": "full_numbers"
    } );
	$(".handle-save-item").click(function(e) {
		let test = $('.category-ctrl :selected').text();
		if( test == '--Choose--' ){
			alert( 'Pick Category!' );
			
			$('.category-ctrl').css("border","1px solid red");
			e.preventDefault();
		}
		
		let val = $('input[type="file"]').val()
		
		if( val == '' ){	
			alert( 'Picture must not empty!' );
			e.preventDefault();
		} 
	});

	$('.input-images-1').imageUploader();


	$("#sp").click(function(){
		$('#prize-label').hide();
		$('#costume_prize').hide();
	});
	
	$("#cs").click(function(){
		$('#costume_prize').show();
	});
	
	$('.sort').click(function () {
		var data			=  $(this).val();
		$('#value-hidden-category').val(data);
		if(  data == 'all' ){
			$('.search-page-controller').hide();
			$('.main-page').show();
		}
		
		if( data != '' && data != 'all' ){
			$('.main-page').hide();
			$.ajax({
				 method: "POST",
				 url: "/pescao/inventory/search_category",
				 data: { 
						'val'	: data,
						'page'	: 1
					},
				 success: function(data){
	
					$('.search-page-controller').show();
					$('.search-page-controller').html(data);
					$('.main-page-controller').hide();
				 }
			});
			
		} else {
			$('#result').html('');
			$('.main-page-controller').show();
		}
	});
	
	$(document).on('click', '.pagination_link', function(){  

        var page 	= $(this).attr("id"); 
		var val 	= $('#value-hidden-category').val();  

		if(  val == 'all' ){
			$('.search-page-controller').hide();
			$('.main-page').show();
		}
		
		if( val != '' && val != 'all' ){
			$('.main-page').hide();
			$.ajax({
				 method: "POST",
				 url: "/pescao/inventory/search_category",
				data: { 
					'val'	: val,
					'page'	: page
				},
				success: function(data){
					$('.search-page-controller').show();
					$('.search-page-controller').html(data);
					$('.main-page-controller').hide();
				 }
			});
			
		} else {
			$('#result').html('');
			$('.main-page-controller').show();
		}
		   
      }); 
});

</script>