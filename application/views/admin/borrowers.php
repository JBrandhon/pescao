
<!--================Category Product Area =================-->
<section class="cat_product_area section-top border_top">
   <div class="container">
      <div class="row">
        <!-- <div class="col-lg-3">
            <div class="left_sidebar_area">
               // <?php
                  // $this->load->view('elements/side_bar');
                  // ?>
            </div>
         </div> -->
         <div class="col-lg-12">
            <div class="row">
               <div class="col-lg-12">
                  <div class="product_top_bar d-flex justify-content-between align-items-center">
                     <div class="single_product_menu product_bar_item" style="display: flex;width: 100%; justify-content: space-between;">
                        <h2>Borrowers</h2>
						<div style="text-align: end;">
							<button class="btn-print btn_3 " type="submit">Print</button>
						</div>
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
				   <table id="dtBasicExample" class="table" width="100%">
					   <thead>
						  <tr>
							<th scope="col">Full Name</th>
							<th scope="col">Email</th>
							<th scope="col">Phone</th>
							<th scope="col">Address</th>
							<th scope="col">Status</th>
							<th scope="col">User Status</th>
							<th scope="col">Action</th>
						  </tr>
					   </thead>
				   <tbody>
						<?php if (sizeof($rentors) > 0 ) : ?>
							<?php foreach($rentors as $rentee) : 
								
								if( $rentee->user_status != 'guest' ){
							?>
								 <td class='fname'><?php echo ucwords($rentee->first_name).' '.ucwords($rentee->last_name) ?></td>
								 <td class='email'><?php echo $rentee->email ?></td>
								 <td class='phone'><?php echo $rentee->phone ?></td>
								 <td class='address'><?php echo $rentee->address ?></td>
								 <td class='status'><?php echo ($rentee->status == 'Paid' ? 'Returned' : 'Borrowed') ?></td>
								 <td class='user_status'><?php echo $rentee->user_status ?></td>
								 <td>
								  <?php if ($rentee->status != 'Paid' ) : ?>
									<a href="<?php echo base_url('rentor/billing_details/').$rentee->reciept_number; ?> " type="button" class="btn"><i class="ti-shopping-cart" style="color: #007bff;"></i></a>
									<?php endif; ?>
									<a target="_blank" href="<?php echo base_url('/rentor/reciept/').$rentee->reciept_number; ?> " type="button" class="btn"><i class="ti-printer" style="color: #007bff;"></i></a>
								 </td>
							  </tr>			
							
							<?php } 
							endforeach; 
						endif; ?>
					  
				   </tbody>
				   </table>
				</div>
            </div>
         </div>
      </div>
   </div>
</section>
<style>

	.btn-print{
		border: 1px solid #333;
		color: #333;
		background-color: #fff;
		text-transform: capitalize;
	}
	.btn-print:hover{
		background-color: #333;

	}
	
</style>
  <!--<script src=" <?php //echo base_url('assets/js/jquery-1.12.1.min.js'); ?> "></script> -->
<script type="text/javascript">

	$(document).ready(function () {
		$('.btn-print').click(function () {
			window.print();
			return false;
		});
	  $('#dtBasicExample').DataTable();
	  $('.dataTables_length').addClass('bs-select ');
	});

	function Delete(id){
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

</script>
