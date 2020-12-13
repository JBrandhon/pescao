
    <!--================login_part Area =================-->
    <section class="login_part section-top section_padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <img id="image" src=" <?php echo base_url('assets/img/Northwestern_Mindanao_State_College_of_Science_and_Technology.png'); ?> " alt="logo" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
							<?php if(!empty($error_msg)) {?>
								<div class="error-msg" style="padding: 15px 20px;border: 1px solid #f44a40;text-align: center;"><?php echo $error_msg; ?></div>
                            <?php } ?>
							<h3 style="margin: 30px 0">Welcome Back ! <br>
                                Please Sign in now</h3>
                            <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" name="username" class="form-control" id="name" value=""
                                        placeholder="Username">
									  <?php echo form_error('username','<p class="help-block">','</p>'); ?>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" id="password" name="password" value=""
                                        placeholder="Password">
									<?php echo form_error('password','<p class="help-block">','</p>'); ?>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="creat_account d-flex align-items-center">
                                    </div>
                                    <button type="submit" name="loginSubmit" value="LOGIN" class="btn_3">
                                        log in
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
    <!--================login_part end =================-->
