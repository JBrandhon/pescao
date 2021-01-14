
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
                            <h3>Create Guest Profile</h3>
                            <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                                <div class="col-md-12 form-group p_star">
									<input class="form-control" type="text" name="first_name" placeholder="First Name" value="<?php echo !empty($user['first_name'])?$user['first_name']:''; ?>" required>
									<?php echo form_error('first_name','<p class="help-block">','</p>'); ?>
                                </div>
                                <div class="col-md-12 form-group p_star">
									<input class="form-control" type="text" name="last_name" placeholder="Last Name" value="<?php echo !empty($user['last_name'])?$user['last_name']:''; ?>" required>
									<?php echo form_error('last_name','<p class="help-block">','</p>'); ?>
                                </div> 
								<div class="col-md-12 form-group p_star">
									<input class="form-control" type="text" name="username" placeholder="Username" value="<?php echo !empty($user['username'])?$user['username']:''; ?>" required>
									<?php echo form_error('username','<p class="help-block">','</p>'); ?>
                                </div>
                                <div class="col-md-12 form-group p_star">
									<input class="form-control" type="email" name="email" placeholder="Email" value="<?php echo !empty($user['email'])?$user['email']:''; ?>" required>
									<?php echo form_error('email','<p class="help-block">','</p>'); ?>
                                </div> 
                                <div class="col-md-12 form-group p_star">
									<input class="form-control" type="password" name="password" placeholder="Password"  required>
									<?php echo form_error('password','<p class="help-block">','</p>'); ?>
                                </div>
								<div class="col-md-12 form-group p_star">
									<input class="form-control" type="password" name="conf_password" placeholder="Confirm Password"  required>
									<?php echo form_error('conf_password','<p class="help-block">','</p>'); ?>
                                </div>
								<div class="col-md-12 form-group p_star">
									<label>Sex: </label>
									<?php 
									if(!empty($user['gender']) && $user['gender'] == 'Female'){ 
										$fcheck = 'checked="checked"'; 
										$mcheck = ''; 
									}else{ 
										$mcheck = 'checked="checked"'; 
										$fcheck = ''; 
									} 
									?>
									<div class="radio col-md-12 form-group p_star">
										<label>
											<input type="radio" name="gender" value="Male" <?php echo $mcheck; ?>>
											Male
										</label>
										<label>
											<input type="radio" name="gender" value="Female" <?php echo $fcheck; ?>>
											Female
										</label>
									</div>
								</div>
								<div class="col-md-12 form-group p_star">
									<input class="form-control" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
					type = "number"
					maxlength = "11" name="phone" placeholder="Phone" value="<?php echo !empty($user['phone'])?$user['phone']:''; ?>" required>
									<?php echo form_error('phone','<p class="help-block">','</p>'); ?>
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="creat_account d-flex align-items-center">
                                    </div>
                                    <button type="submit" name="signupSubmit" value="CREATE ACCOUNT" class="btn_3">
                                        Create Account
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


