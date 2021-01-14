
<!--================Category Product Area =================-->
<section class="cat_product_area section-top border_top">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="row">
               <div class="col-lg-12">
                  <div class="product_top_bar d-flex justify-content-between align-items-center">
                     <div class="single_product_menu product_bar_item">
                        <h2>Guest Users</h2>
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
									<?php if ($user->user_status == 'guest' && $user->id != 1 && $user->status != 0  ) : ?>
										  <tr id="<?php echo $user->id ?>" name="pname">
											 <td class='fname'><?php echo ucwords($user->first_name).' '.ucwords($user->last_name) ?></td>
											 <td class='username'><?php echo $user->username ?></td>
											 <td class='gender'><?php echo $user->gender ?></td>
											 <td class='email'><?php echo $user->email ?></td>
											 <td class='phone'><?php echo $user->phone ?></td>
											 <td>
												<?php echo $user->user_permission != 'approve' ? '<button onclick="update( '.$user->id.' )" type="button" class="btn approve-guest"><i class="fa fa-check" style="color: #007bff;"></i></button>' : '' ?>
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
<script type="text/javascript">

	/*$(".edit").click(function() {
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
	});*/
	
	function update(id){	
		$.ajax({
			 type: "POST",
			 url: "http://localhost/pescao/admin/update_guestacc",
			 data: {'id':id} ,
			 success: function(success){
				$('.approve-guest').css('display','none');
				alert('Guest Approved');
			 }
		});
	}
	
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
