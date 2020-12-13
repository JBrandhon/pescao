<!--================Single Product Area =================-->
<div class="product_image_area section-top section_padding">
   <div class="container">
      <div class="row s_product_inner">
         <div class="col-lg-5">
            <div class="product_slider_img">
               <div id="vertical">
                  <div data-thumb="img/product_details/prodect_details_1.png">
                     <!-- CUSTOM JBG START -->
						<div class="js--image-preview"></div>
							<div class="input-field">
								<label class="active">Photos</label>
								<div class="input-images-1" style="padding-top: .5rem;"></div>
							</div>
					 
                     <!--CUSOTM JBG END -->	  
                  </div> 
               </div>
            </div>
         </div>
         <div class="col-lg-5 offset-lg-1">
            <div class="s_product_text">
               <div class="col-sm-6" style=" padding-left: 0px; ">
                  <div class="form-group">
                     <label>Item Name</label>
                     <input class="form-control" value="<?php echo $single_costume[0]['name'] ?>" name="item_name" id="item_name" type="text" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Item Name'" placeholder='<?php echo $single_costume[0]['name'] ?>' required>
                  </div>
               </div>
               <div class="col-sm-6" style=" padding-left: 0px; ">
                  <label>Item Type</label>
                  <div class="form-group">
                     <select  class="form-control" name="type" id="type" onchange="myFunction()">
                        <option value="Both" <?php echo ( $single_costume[0]['item_type'] == 'Both' ? 'selected':'' ) ?> >Both</option>
                        <option value="Costume" <?php echo ( $single_costume[0]['item_type'] == 'Costume' ? 'selected':'' ) ?> >Costume</option>
                        <option value="Sports Equipment" <?php echo ( $single_costume[0]['item_type'] == 'Sports Equipment' ? 'selected':'' ) ?> >Sports Equipment</option>
                        <option value="Both" <?php echo ( $single_costume[0]['item_type'] == 'Both' ? 'selected':'' ) ?> >Both</option>
                     </select>
                  </div>
               </div>
               <div class="col-sm-6" style=" padding-left: 0px; ">
                  <div class="form-group">
                     <label>Gender</label>
                     <select class="form-control" name="gender" id="gender">
                        <option value="Male" <?php echo ( $single_costume[0]['gender'] == 'Male' ? 'selected':'' ) ?> >Men</option>
                        <option value="Female" <?php echo ( $single_costume[0]['gender'] == 'Female' ? 'selected':'' ) ?> >Women</option>
                     </select>
                  </div>
               </div>
               <br>
               <br>
               <div id="prize"  class="col-sm-6" style=" padding-left: 0px; ">
                  <div class="form-group">
                     <labe>Rental Prize</labe>
                     <input class="form-control" value="<?php echo $single_costume[0]['rental_prize'] ?>" name="price" id="item_price" type="number" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Prize'" placeholder=' <?php echo $single_costume[0]['rental_prize'] ?>' required>
                  </div>
               </div>
               <div class="col-md-12" style=" padding-left: 0px; ">
                  <div class="form-group">
                     <label>Description</label>
                     <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9"
                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Description'"
                        placeholder='Enter Description'><?php  echo $single_costume[0]['description'] ?></textarea>
                  </div>
               </div>
               <div class="card_area">
                  <input value="<?php echo $single_costume[0]['id'] ?>" id="item_id" name="itemId" hidden>
                  <div class="product_count d-inline-block">
                     <span onclick="decrement()"  class="inumber-decrement"> <i class="ti-minus"></i></span>
                     <input class="input-number" name="qty" id="item_qty" type="number" value="<?php echo $single_costume[0]['qty'] ?>" readonly>
                     <span onclick="increment()"  class="inumber-decrement"> <i class="ti-plus"></i></span>
                  </div>
                  <div class="alert alert-primary" role="alert" style="margin: 14px;">
                     There are currently <?php echo $single_costume[0]['qty'] ?> pieces of this item remaining.
                  </div>
                  <div class="add_to_cart">
                     <button type="submit" id="save" class="genric-btn info circle"> Save</button>
                     <!-- <button type="submit" class="genric-btn danger-border circle"> Delete</button> -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>
<?php
   $rq = 0;
   if( !empty( $remaining_qty ) ){
   echo 'err';
   $rq =$remaining_qty[0]['qty'];
   }
   ?>
<!--================End Single Product Area =================-->
<script src=" <?php echo base_url('assets/js/jquery-1.12.1.min.js'); ?> "></script>
<script>

var j = jQuery.noConflict();
j(document).ready(function($){
	$('.input-images-1').imageUploader();
})


   function increment() {
   		 document.getElementById("item_qty").stepUp(); 
   }
   function decrement() {
   	if( $('#item_qty').val() == <?php echo $rq ?> ){
   		
   	}else{
   		document.getElementById("item_qty").stepDown();; 
   	}
    
   }
    
     jQuery.noConflict();
   function myFunction() {
     var x = document.getElementById("type").value;
   	console.log(x);
   	if( x == 'Costume' ){
   		$('#prize').show();
   	}
   	
   	if( x == 'Sports Equipment' ){
   		$('#prize').hide();
   	}
   	
   }
   
   jQuery( document ).ready(function() {
     var x = document.getElementById("type").value;
   	console.log(x);
   	if( x == 'Costume' ){
   		$('#prize').show();
   	}
   	
   	if( x == 'Sports Equipment' ){
   		$('#prize').hide();
   	}
   });
   
   
    
   jQuery('#save').click(function(e) {
   	
   	$total_envintory_qty = Number( $( "#item_qty" ).val() ) + <?php echo +$rq ?> ;
   
   	console.log( $total_envintory_qty );
   	var postData = {
   	  'name' :  $( "#item_name" ).val(),
   	  'item_type'  : $( "#type" ).val(),
   	  'qty'  : $( "#item_qty" ).val(),
   	  'type'    : $( "#type" ).val(),
   	  'description'    : $( "#message" ).val(),
   	  'rental'      : $( "#item_price" ).val(),
   	  'id'      : $( "#itemId" ).val(),
   	  'gender'      : $("#gender").val(),
   	  'item_id'      : $("#item_id").val(),
   	  'total_envintory_qty'      : $total_envintory_qty,
   	};
   	// e.preventDefault();
   
   	$.ajax({
   		type: "POST",
   		url: "<?php echo site_url('inventory/edit'); ?>",
   		data: postData, // <--- THIS IS THE CHANGE
   		dataType: "html",
   		success: function(data){
   			console.log(data);
   			 window.history.back();
   			alert("Changes Saved.")
   		},
   		error: function() { alert("Error posting feed."); }
      });
   
   });
    
</script>