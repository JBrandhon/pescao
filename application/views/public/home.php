
    <!--================Category Product Area =================-->
    <section class="cat_product_area section-top border_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
    

                        <aside class="left_widgets p_filter_widgets sidebar_box_shadow">
                            <div class="l_w_title">
                                <h3>Product filters</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    <p>Gender</p>
                                    </li>  
									<li>
									  <input type="radio" id="female" class="gender" name="gender" value="all" checked="checked">
									  <label for="all">All</label><br>
                                    </li>
                                    <li>
										<input type="radio" id="male" class="gender" name="gender" value="male">
										<label for="male">Male</label><br>
                                    </li>
                                    <li>
									  <input type="radio" id="female" class="gender" name="gender" value="female">
									  <label for="female">Female</label><br>
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
                                    <h2 id="sort"></h2>
                                </div>
                            </div>
                        </div>
					<?php if (sizeof($images) > 0) : ?>
						<?php foreach($images as $image) : ?>
							<?php if ( $image->item_type == "Costume") : ?>
								<div class="col-lg-4 col-sm-6 <?php echo $image->sex ?> " >
									<div class="single_category_product">
										<div class="single_category_img">
											<?php 
												echo '<img style=" height: 254px; object-fit: cover; " class="rounded mx-auto d-block img-thumbnail" src="data:image/jpeg;base64,'.base64_encode($image->image ).'"/>'; 
											?>
											<div class="category_product_text">
												<a href="<?php echo base_url('single_costume/view/').$image->id ?> "><h5 style="color:#2f7dfc; font-weight: bold;"> <?php echo $image->name ?> </h5></a>
												<p>₱<?php echo number_format( $image->rental_prize )  ?> </p>
												<label>Qty: <?php echo number_format( $image->qty ) ?> </label>
											</div>
										</div>
									</div>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
	
                        </div>
                        <div class="col-lg-12 text-center">
                            <a href="#" class="btn_2">Back to top</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->

    <!--::subscribe_area part end::-->
	
  <!--<script src=" <?php //echo base_url('assets/js/jquery-1.12.1.min.js'); ?> "></script> -->
<script>
	$(document).ready(function(){ 
	
       $('.gender').click(function () {
		console.log( $(this).val() );
			if( $(this).val() == "female" ){
				 $('.Male').hide();
				 $('.Female').show();
				 $count =$('.Female').length;
				 document.getElementById("sort").innerHTML = "Womens "+"("+ $count+")";
			}
			if( $(this).val() == "male" ){
				 $('.Female').hide();
				 $('.Male').show();
				 $count =$('.Male').length;
				 document.getElementById("sort").innerHTML = "Mens "+"("+ $count+")";
			}
			if( $(this).val() == "all" ){
				 $('.Female').show();
				 $('.Male').show();
				 $count =$('.Male').length + $('.Female').length;
				 document.getElementById("sort").innerHTML = "All "+"("+ $count+")";
			}
		 
       });

	});
</script>