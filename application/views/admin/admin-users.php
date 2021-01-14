
<!--================Category Product Area =================-->
<section class="cat_product_area section-top border_top">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="row">
               <div class="col-lg-12">
                  <div class="product_top_bar d-flex justify-content-between align-items-center">
                     <div class="single_product_menu product_bar_item">
                        <h2>Admin Users</h2>
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
							<div class="form-group mt-3">
								<a href="<?php echo base_url('admin/registration'); ?>" class="btn_3 button-contactForm">Add New User</a>
							</div>
						</div>
                     </div>
                  </div>
               </div>
			   <div class="col-lg-12">
					<table id="dtBasicExample" class="table table-bordered">
					   <thead>
						  <tr>
							<th scope="col">Full Name</th>
							<th scope="col">Username</th>
							<th scope="col">Gender</th>
							<th scope="col">Email</th>
							<th scope="col">Phone</th>
							<th scope="col">Action</th>
						  </tr>
					   </thead>
					   <tbody>
						 
							 <?php if (sizeof($users) > 0 ) : ?>
								 <?php foreach($users as $user) : ?>
									<?php if ($user->id != 1 && $user->status == true && $user->user_status != 'guest' ) : ?>
										  <tr id="<?php echo $user->id ?>" name="pname">
											 <td class='fname'><?php echo ucwords($user->first_name).' '.ucwords($user->last_name) ?></td>
											 <td class='username'><?php echo $user->username ?></td>
											 <td class='gender'><?php echo $user->gender ?></td>
											 <td class='email'><?php echo $user->email ?></td>
											 <td class='phone'><?php echo $user->phone ?></td>
											 <td>
												<button type="button" class="btn"><i class="ti-pencil-alt edit" style="color: #007bff;"></i></button>
												<button onclick="Delete( <?php echo $user->id ?> )" type="button" class="btn"><i class="ti-trash" style="color: red;"></i></button>
											 </td>
										  </tr>		
									 <?php endif; ?>
								<?php endforeach; ?>
							 <?php endif; ?>
						  
					   </tbody>
					</table>
				</div>
            </div>
         </div>
      </div>
   </div>
</section>

		<!-- Modal -->
	<div id="EditUserModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"> </h4>
		  </div>

			  <div class="col-lg-12 modal-body">
				  <div class="tracking_box_inner">
					<form class="row contact_form" action="<?php echo base_url('/admin/edit'); ?>" method="post" novalidate="novalidate">
						<input type="text" name="ID" class="ID" value="" hidden> </input>
						<div class="col-md-6 form-group p_star">
						<label> First Name: </label>
							<input class="form-control first_name" type="text" name="first_name" placeholder="First Name"  required />
						</div>
						<div class="col-md-6 form-group p_star">
						<label> Last Name: </label>
							<input class="form-control last_name" type="text" name="last_name" placeholder="Last Name"  required />
						</div>
						<div class="col-md-6 form-group p_star">
						<label> Email: </label>
							<input class="form-control email" type="email" name="email" placeholder="Email"  required />
						</div>
						<div class="col-md-6 form-group p_star">
						<label> Username: </label>
							<input class="form-control username" type="text" name="username" placeholder="Username"  required />
						</div>
						<div class="col-md-6 form-group p_star">
						<label> New Password: </label>
							<input class="form-control pass" type="password" id="npass" name="npass" placeholder=" New Password" required/ >
						</div>
						<div class="col-md-6 form-group p_star">
						<label> Confirm Password: </label>
							<input class="form-control pass" type="password" id="cpass" name="pass" placeholder=" Old Password"  required />
						</div>
						<div class="col-md-12 form-group p_star">
							<label>Gender: </label>
							<div class="radio col-md-12 form-group p_star">
								<label>
									<input class="Male" type="radio" name="gender" value="Male" />
									Male
								</label>
								<label>
									<input class="Female" type="radio" name="gender" value="Female" />
									Female
								</label>
							</div>
						</div>
						<div class="col-md-12 form-group p_star">
						<label> Phone Number: </label>
							<input class="form-control phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
					type = "number"
					maxlength = "11" name="phone" placeholder="Phone"  required />
						</div>
						<div class="col-md-12 form-group">
							<div class="creat_account d-flex align-items-center">
							</div>
							<br>
							<span id='message'></span>
							<br>
							<button type="submit" name="signupSubmit" value="CREATE ACCOUNT" class="btn_3 update_user">
								Update Account
							</button>
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


<script type="text/javascript">

	$(".edit").click(function() {
		$row = $(this).closest("tr");    // Find the row
		
		const ID = $(this).closest('tr').attr('id');
		const fname= $row.find(".fname").text();
		$name = fname.split(' ');

		$('.first_name').val( $name[0] ); 
		$('.username').val( $row.find(".username").text() ); 
		
		$('.last_name').val( $name[1] ); 
		$('.' + $row.find(".gender").text() ).prop('checked',true);
		$('.email').val($row.find(".email").text() ); 
		
		$('.phone').val($row.find(".phone").text() ); 
		$('.ID').val(ID); 

		$('#EditUserModal').modal('show');
	});
	
	function Delete(id){
		
		console.log( 'i am here', id );
		 var postData = {
			  'id' : id,
			};

			$.ajax({
				 type: "POST",
				 url: "http://localhost/pescao/admin/deleteUser",
				 data: {'id':id} , //assign the var here 
				 success: function(msg){
					 document.getElementById(id).style.display = "none";
				 }
			});
			
	}

	$('#npass, #cpass').on('keyup', function () {
		
	  if ($('#npass').val() == $('#cpass').val()) {
		  
		$('#message').html('Matching').css('color', 'green');
		 $(':input[type="submit"]').prop('disabled', false);
	  } else {
		  
		$('#message').html('Not Matching').css('color', 'red');
		$(':input[type="submit"]').prop('disabled', true);
	  
	  }
	});
		
</script>
