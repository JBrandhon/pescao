
<section class="cat_product_area section-top border_top">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="row">
               <div class="col-lg-12">
                  <div class="product_top_bar d-flex justify-content-between align-items-center">
                     <div class="single_product_menu product_bar_item" style="display: contents;">
                        <h2>Report</h2>
						<div>
							<button class="btn-print btn_3 " type="submit">Print</button>
						</div>
                     </div>
               </div>
			   <div class="col-lg-12" >
				   <table id="dtBasicExample" class="table table-bordered">
					   <thead>
						  <tr>
							<th class="th-sm" scope="col">Item Name</th>
							<th class="th-sm" scope="col">Remaining Quantity</th>
							<th class="th-sm" scope="col">Total Item Quantity</th>
							<th class="th-sm" scope="col">Total Item Lost</th>
							<th class="th-sm" scope="col">Rental Prize</th>
							<th class="th-sm" scope="col">Revenue</th>
						  </tr>
					   </thead>
				   <tbody>
					  
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

<script type="text/javascript">

$(function() {

	$(document).ready(function () {
		
		$('.btn-print').click(function () {
			var pageTitle = 'Page Title',
				stylesheet = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css',
				win = window.open('', 'Print', 'width=500,height=300');
			win.document.write('<html><head><title>' + pageTitle + '</title>' +
				'<link rel="stylesheet" href="' + stylesheet + '">' +
				'</head><body>' + $('.table')[0].outerHTML + '</body></html>');
			win.document.close();
			win.print();
			win.close();
			return false;
		});
		
		$('#dtBasicExample').DataTable();
		$('.dataTables_length').addClass('bs-select ');
	});


	
		 var postData = {
			  'start' : 'test',
			  'end' : 'test',
			};
			//console.log(postData);
			$.ajax({
				 url: "http://localhost/pescao/admin/item_lost_report",
				 type: "POST",
				 data: postData , //assign the var here 
				 success: function (data, text) {
					//..
					
					console.log( 'Data => ',jQuery.parseJSON(data) );
					panelInfo = [];
					
					jQuery.each(jQuery.parseJSON(data), function(index, value){
						
						var remaining_quantity				= value.remaining_quantity;
						var total_item_qty					= value.total_item_qty;
						var total_item_lost					= value.total_item_lost;
						var rental_prize					= value.rental_prize;
						var revenue							= value.revenue;
						var convertedRental_prize			= '₱' + parseInt( rental_prize ).toLocaleString() + '.00';
						var convertedTotal_item_lost		= total_item_lost == null ? value.total_item_lost : parseInt( total_item_lost ).toLocaleString();
						var convertedTotal_item_qty			= parseInt( total_item_qty ).toLocaleString();
						var convertedRemaining_quantity		= parseInt( remaining_quantity ).toLocaleString();
						var convertedrevenue				= value.revenue == null ? '₱0.00' : '₱' + parseInt( revenue ).toLocaleString() + '.00';
						
						panelInfo.push({ item_name: value.item_name, remaining_quantity: convertedRemaining_quantity, total_item_qty: convertedTotal_item_qty, total_item_lost: convertedTotal_item_lost, rental_prize: convertedRental_prize, revenue: convertedrevenue });
						
					})
					
					console.log( 'parse => ', panelInfo );
				
					const result = panelInfo.map(({ item_name, remaining_quantity, total_item_qty, total_item_lost, rental_prize, revenue }) => [item_name, remaining_quantity, total_item_qty, total_item_lost, rental_prize, revenue]);
					console.log( result );

					
					var table = $('#dtBasicExample').DataTable();
					
					var rows = table
						.clear()
						.draw();
					for(a=0;a<result.length;a++){
						var rowNode = table
							.row.add( result[a] )
							.draw()
							.node();

					}

					
				},
				error: function (request, status, error) {
					console.log(err);
				}
				   
			});
			
	
});

</script>
