
 <?php $temp = 0 ?>
<?php if (sizeof($records) > 0 ) : ?>
	<?php foreach($records as $record) : ?>
		<?php if ( $record['status'] == 'Paid' ) : ?>
			<?php  
				$temp += $record['payable'];
			?>
		<?php endif; ?>
	<?php endforeach; ?>
<?php endif; ?>
<!--================Category Product Area =================-->
<section class="cat_product_area section-top border_top">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="row">
               <div class="col-lg-12">
                  <div class="product_top_bar d-flex justify-content-between align-items-center" style="margin:0">
                     <div class="single_product_menu product_bar_item">
                        <h2>Rentors Report</h2>
                     </div>
                     <div class="product_top_bar_iner product_bar_item d-flex">
                        <div class="product_bar_single">
							<div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
								<i class="fa fa-calendar"></i>&nbsp;
								<span></span> <i class="fa fa-caret-down"></i>
							</div>
						</div>
					</div>
				</div>
				<div style="text-align: end;">
					<button class="btn-print btn_3 " type="submit">Print</button>
				</div>
			   <div class="col-lg-12" >
				   <table id="dtBasicExample" class="table table-bordered">
					   <thead>
						  <tr>
							<th class="th-sm" scope="col">Full Name</th>
							<th class="th-sm" scope="col">Phone Number</th>
							<th class="th-sm" scope="col">Address</th>
							<th class="th-sm" scope="col">Item Name</th>
							<th class="th-sm" scope="col">Borrowed Quantity</th>
							<th class="th-sm" scope="col">Borrowed Date</th>
							<!--<th class="th-sm" scope="col">Payable</th>-->
							<th class="th-sm" scope="col">Status</th>
							<th class="th-sm" scope="col">User Status</th>
						  </tr>
					   </thead>
				   <tbody>
					 
					<?php if (sizeof($records) > 0 ) : ?>
						<?php foreach($records as $record) : 
							if($record['user_status'] == 'guest' ) {
						?>						
						  <tr name="pname">
							 <td class='fname'><?php echo ucwords($record['first_name']).' '.ucwords($record['last_name']) ?></td>
							 <td class='phone'><?php echo $record['phone'] ?></td>
							 <td class='phone'><?php echo $record['address'] ?></td>
							 <td class='phone'><?php echo $record['item_name'] ?></td>
							 <td class='phone'><?php echo $record['rented_qty'] ?></td>
							 <td class='phone'><?php echo $record['from'] ?></td>
							 <!--<td class='phone'>₱<?php //echo number_format( $record['payable'], 2 ) ?></td>-->
							 <td class='phone'><?php echo ($record['status'] == 'Paid' ? 'Returned' : 'Borrowed' ) ?></td>
							 <td class='phone'><?php echo $record['user_status'] ?></td>
						  </tr>									
						<?php } endforeach; ?>
					<?php endif; ?>
					  
				   </tbody>
				   </table>
				 </div>
			   
            </div>
         </div>
      </div>
   </div>
</section>

  <!--<script src=" <?php //echo base_url('assets/js/jquery-1.12.1.min.js'); ?> "></script> -->
  

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

<script type="text/javascript">

$(function() {

const selectElement = document.querySelector('#reportrange span');

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
		console.log( start.format('YYYY-MM-D') );
		console.log( end.format('YYYY-MM-D') );
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
		sortReport(  start.format('YYYY-MM-D') ,  end.format('YYYY-MM-D') );
		
		
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
		   // 'All':'',
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});

	$(document).ready(function () {
		
		$('.btn-print').click(function () {
			window.print();
			return false;
		});
		
	  $('#dtBasicExample').DataTable();
	  $('.dataTables_length').addClass('bs-select ');
	});


	$(".edit").click(function() {
		$row = $(this).closest("tr");    // Find the row
		
		const ID = $(this).closest('tr').attr('id');
		const fname= $row.find(".fname").text();
		$name = fname.split(' ');

		$('.first_name').val( $name[0] ); 
		$('.last_name').val( $name[1] ); 
		$('.' + $row.find(".gender").text() ).prop('checked',true);
		$('.email').val($row.find(".email").text() ); 
		
		$('.phone').val($row.find(".phone").text() ); 
		$('.ID').val(ID); 

		$('#EditUserModal').modal('show');
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
	function sortReport(start , end){
		var postData = {
		  'start' : start,
		  'end' : end,
		};

		$.ajax({
			 url: "http://localhost/pescao/admin/borrower_sort_report",
			 type: "POST",
			 data: postData , //assign the var here 
			 success: function (data, text) {
									
				panelInfo = [];
				
				
				
				//...
				jQuery.each(jQuery.parseJSON(data), function(index, value){
					
					//var num					= value.payable;
					//var convertedPayable	= '₱' + parseInt( num ).toLocaleString() + '.00';
					
					var status 		= value.status; 
					var br_status	= 'Borrowed';
					
					if( status === 'Paid' ){
						br_status = 'Returned';
					}
						
					
					panelInfo.push({ 
						FullName: value.FullName, 
						address: value.address, 
						from: value.from, 
						item_name: value.item_name, 
						//payable: convertedPayable, 
						phone: value.phone, 
						rented_qty: value.rented_qty, 
						status: br_status, 
						user_status :  value.user_status 
					});
					
				})
									
				const result = panelInfo.map(({ 
									FullName, 
									phone, 
									address, 
									item_name, 
									rented_qty, 
									from, 
									//payable, 
									status, 
									user_status 
							}) => [
									FullName, 
									phone, 
									address, 
									item_name, 
									rented_qty, 
									from,
									//payable, 
									status, 
									user_status
							]);
				console.log( 'This is the Result => ', result );
				
				var table = $('#dtBasicExample').DataTable();
				
				var rows = table
					.clear()
					.draw();
				for(a=0;a<result.length;a++){
					var rowNode = table
						.row.add( result[a] )
						.draw()
						.node();
						
				console.log( rowNode );

				}

			},
			error: function (request, status, error) {
				console.log(err);
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
