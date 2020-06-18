<a href="<?php echo base_url('admin/logout'); ?>" class="logout">Logout</a>
       
	  <div class="col-lg-12">
          <div class="tracking_box_inner">
            <p>To track your order please enter your Order ID in the box below and press the "Track" button. This was
              given
              to you on your receipt and in the confirmation email you should have received.</p>
            <?php echo form_open_multipart('inventory/upload'); ?>
              <div class="col-md-12 form-group">
                <input type="file" name="userfile" class="form-control"></input>
              </div>
              <div class="col-md-12 form-group">
                <input type="text" class="form-control" id="costume_name" name="costume_name" placeholder="Costume Name">
              </div>
              <div class="col-md-12 form-group">
                <input type="number" class="form-control" id="costume_qty" name="costume_qty" placeholder="Qty..">
              </div>
              <div class="col-md-12 form-group">
                <input type="number" class="form-control" id="costume_prize" name="costume_prize" placeholder="Rental Prize">
              </div>
              <div class="col-md-12 form-group">
                <button type="submit" value="submit" class="btn_3">Save</button>
              </div>
            </form>
          </div>
        </div>

    <!--================Category Product Area =================-->
    <section class="cat_product_area section-top border_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
    
                       <aside class="left_widgets p_filter_widgets sidebar_box_shadow">
                            <div class="l_w_title">
                                <h3>Browse Categories</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    <li>
                                        <a href="#">Edit Costumes</a>
                                    </li>
                                    <li class="sub-menu">
                                        <a href="#Electronics" class=" d-flex justify-content-between">
                                            Generate Report
                                            <div class="right ti-plus"></div>
                                        </a>
                                        <ul>
                                            <li>
                                                <a href="#Electronics">Rented Costumes</a>
                                            </li>
                                            <li>
                                                <a href="#Electronics">Weekly</a>
                                            </li>
											<li>
                                                <a href="#Electronics">Semester</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#Electronics">Rented Costumes</a>
                                    </li>
                                    <li>
                                        <a href="#Electronics">Available Costumes</a>
                                    </li>
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
                                    <h2>Costumes (...)</h2>
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
                                       <button type="submit" class="btn_3">
                                        Add Costume
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single_category_product">
                                <div class="single_category_img">
                                    <img src="<?php echo base_url('assets/img/category/category_1.png'); ?>" alt="">
                                    <div class="category_social_icon">
                                        <ul>
                                            <li><a href="#"><i class="ti-pencil-alt"></i></a></li>
                                            
                                        </ul>
                                    </div>
                                    <div class="category_product_text">
                                        <a href="<?php echo base_url('/single-costume'); ?> "><h5>Long Sleeve TShirt</h5></a>
                                        <p>$150.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="col-lg-4 col-sm-6">
                            <div class="single_category_product">
                                <div class="single_category_img">
                                    <img src="<?php echo base_url('assets/img/category/category_2.png'); ?>" alt="">
                                    <div class="category_social_icon">
                                        <ul>
                                            <li><a href="#"><i class="ti-pencil-alt"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="category_product_text">
                                        <a href="<?php echo base_url('/single-costume'); ?>"><h5>Long Sleeve TShirt</h5></a>
                                        <p>$150.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>                        <div class="col-lg-4 col-sm-6">
                            <div class="single_category_product">
                                <div class="single_category_img">
                                    <img src="<?php echo base_url('assets/img/category/category_3.png'); ?>" alt="">
                                    <div class="category_social_icon">
                                        <ul>
                                            <li><a href="#"><i class="ti-pencil-alt"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="category_product_text">
                                        <a href="<?php echo base_url('/single-costume'); ?>"><h5>Long Sleeve TShirt</h5></a>
                                        <p>$150.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <a href="#" class="btn_2">More Items</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->

    
    <!-- subscribe_area part start-->
    <section class="instagram_photo">
        <div class="container-fluid>
            <div class="row">
                <div class="col-lg-12">
                    <div class="instagram_photo_iner">
                        <div class="single_instgram_photo">
                            <img src="img/instagram/inst_1.png" alt="">
                            <a href="#"><i class="ti-instagram"></i></a> 
                        </div>
                        <div class="single_instgram_photo">
                            <img src="img/instagram/inst_2.png" alt="">
                            <a href="#"><i class="ti-instagram"></i></a> 
                        </div>
                        <div class="single_instgram_photo">
                            <img src="img/instagram/inst_3.png" alt="">
                            <a href="#"><i class="ti-instagram"></i></a> 
                        </div>
                        <div class="single_instgram_photo">
                            <img src="img/instagram/inst_4.png" alt="">
                            <a href="#"><i class="ti-instagram"></i></a> 
                        </div>
                        <div class="single_instgram_photo">
                            <img src="img/instagram/inst_5.png" alt="">
                            <a href="#"><i class="ti-instagram"></i></a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::subscribe_area part end::-->