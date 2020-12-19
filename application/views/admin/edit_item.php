<div class="product_image_area section-top section_padding">
 <?php echo form_open_multipart('inventory/edit');?>
    <div class="container">
	  <div class="row s_product_inner">
		<div class="col-lg-5">
		  <div class="product_slider_img">
			<div id="vertical">
			<div data-thumb="img/product_details/prodect_details_1.png">
				<div class="input-field">
				</div>
						<label class="active">Add Photos</label>
						<div class="input-images-1" style="padding-top: .5rem; margin-bottom: 30px">
						<span style="font-size: 12px; color: #868282;">(Maximum of 1MB File Size)</span></div>
						<label class="active">Photos <span>(hover to remove photo)</span></label>
						<div class="image-uploader has-files">
						<div class="uploaded" >
						<input class="item-delete" value="" name="deleteItem" hidden/>
					<?php
						for ($x = 0; $x < count($img); $x++) {?>
							<div class="uploaded-image">
								<?php  echo '<img style="width: 100%; object-fit: cover; " class="rounded mx-auto d-block img-thumbnail" src="data:image/jpeg;base64,'.base64_encode( $img[$x]['image'] ).'"/>'; ?>
								<input class="item-value" value="<?php echo $img[$x]['id'] ?>" name="iditem"  hidden/>
								<div class="delete-image"><i class="material-icons">clear</i></div>
							</div>
					<?php	}
					?>
						</div>
					</div>

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
					<input name="product-id" value="<?php echo $single_costume[0]['id'] ?>" id="item_id" name="itemId" hidden>
					<div class="product_count d-inline-block">
						<span onclick="decrement()"  class="inumber-decrement"> <i class="ti-minus"></i></span>
						<input class="input-number" name="qty" id="item_qty" type="number" value="<?php echo $single_costume[0]['qty'] ?>" readonly>
						<span onclick="increment()"  class="inumber-decrement"> <i class="ti-plus"></i></span>
					</div>
					<div class="alert alert-primary" role="alert" style="margin: 14px;">
					  There are currently <?php echo $single_costume[0]['qty'] ?> pieces of this item remaining.
					</div>
					<div class="add_to_cart">
						<button type="submit" value="submit" id="save" class="genric-btn handle-save-item info circle"> Save</button>
					</div>
			   </div>
			</div>
		  </div>
		</div>
	  </div>
    </div>
</form>
<script src="assets/app.js"></script>

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
  
	<style>
	
		.draganddropedit{
			position: absolute;
			top: 10px;
			right: 0;
			z-index: 999;
		}
		.draganddropedit a{
			padding: 15px;
		}
	
		.hide-content{
			display: none;
		}
		
		.hide-me{
			display: none;
		}
		
		.edit-images .image-uploader{
			min-height: 350px;
		}
		
		.image-ctrl{
			position: relative;
			display: inline-block;
		}
		
		.image-ctrl:hover .edit {
			display: block;
		}

		.edit {
			padding-top: 7px;	
			padding-right: 7px;
			position: absolute;
			right: 0;
			top: 0;
			display: none;
		}

		.edit a {
			color: #000;
		}

		.box {
		  position: relative;
		  background: #ffffff;
		  width: 100%;
		}

		.box-header {
		  color: #444;
		  display: block;
		  padding: 10px;
		  position: relative;
		  border-bottom: 1px solid #f4f4f4;
		  margin-bottom: 10px;
		}

		.box-tools {
		  position: absolute;
		  right: 10px;
		  top: 5px;
		}

		.dropzone-wrapper {
		  border: 2px dashed #91b0b3;
		  color: #92b0b3;
		  position: relative;
		  height: 350px;
		}

		.dropzone-desc {
		  position: absolute;
		  margin: 0 auto;
		  left: 0;
		  right: 0;
		  text-align: center;
		  width: 40%;
		  top: 150px;
		  font-size: 16px;
		}

		.dropzone,
		.dropzone:focus {
		  position: absolute;
		  outline: none !important;
		  width: 100%;
		  height: 350px;
		  cursor: pointer;
		  opacity: 0;
		  z-index: 999;
		}

		.dropzone-wrapper:hover,
		.dropzone-wrapper.dragover {
		  background: #ecf0f5;
		}

		.preview-zone {
		  text-align: center;
		}

		.preview-zone .box {
		  box-shadow: none;
		  border-radius: 0;
		  margin-bottom: 0;
		}
		
		.box-body img{
			width: 100%;
			height: 350px;
			object-fit: cover;
		}

	</style>
  
  
  <script>
 jQuery(document).ready(function($){ 
	
	
	var del= [];
	$('.delete-image').click( function(){
		$(this).parent().fadeOut();
		
		console.log($(this).prev().val());
		del.push( $(this).prev().val() );
		var t = del.toString();
		
		$('.item-delete').val( t );

	})



	$('.input-images-1').imageUploader();
	
	$('.image-ctrl').click( function(){
		
		$(this).addClass('hide-image');
		
		$(this).before( '<div class="uploadOuter"><span class="dragBox" >Darg and Drop image here<input type="file" onChange="dragNdrop(event)"  ondragover="drag()" ondrop="drop()" id="uploadFile"/></div>' );
		
	})

	$("#sp").click(function(){
		$('#prize-label').hide();
		$('#costume_prize').hide();
	});
	
	$("#cs").click(function(){
		$('#costume_prize').show();
	});
	
	   $('.sort').click(function () {
		console.log( $(this).val() );
			if( $(this).val() == "costumes" ){
				 $('.Equipment').hide();
				 $('.Costume').show();
				 // $count =$('.Female').length;
				 // document.getElementById("sort").innerHTML = "Womens "+"("+ $count+")";
			}
			if( $(this).val() == "equipments" ){
				 $('.Equipment').show();
				 $('.Costume').hide();
				 // $count =$('.Male').length;
				 // document.getElementById("sort").innerHTML = "Mens "+"("+ $count+")";
			}
			if( $(this).val() == "all" ){
				 $('.Equipment').show();
				 $('.Costume').show();
				 // document.getElementById("sort").innerHTML = "All "+"("+ $count+")";
			}
			 
		   });
	
	
});


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
	

  
	/*jQuery('#save').click(function(e) {
		
		$total_envintory_qty = Number( $( "#item_qty" ).val() ) + <?php echo +$rq ?> ;
		
		let img = $('.edit-image').attr('src');
		alert( img );
		
		var lang = [];
		
		$( ".img-id" ).each(function( index ) {
		  lang.push($(this).val());
		});
		
		console.log( lang );
		
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
				//window.history.back();
				alert("Changes Saved.")
			},
			error: function() { alert("Error posting feed."); }
	   });

	});*/
	function readFile(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      var htmlPreview =
        '<img class="edit-image" width="200" src="' + e.target.result + '" />';
      var wrapperZone = $(input).parent();
      var previewZone = $(input).parent().parent().find('.preview-zone');
      var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

      wrapperZone.removeClass('dragover');
      previewZone.removeClass('hidden');
      boxZone.empty();
      boxZone.append(htmlPreview);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

function reset(e) {
  e.wrap('<form>').closest('form').get(0).reset();
  e.unwrap();
}

$(".dropzone").change(function() {
  readFile(this);
});

$('.dropzone-wrapper').on('dragover', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).addClass('dragover');
});

$('.dropzone-wrapper').on('dragleave', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).removeClass('dragover');
});

$('.remove-preview').on('click', function() {
  var boxZone = $(this).parents('.preview-zone').find('.box-body');
  var previewZone = $(this).parents('.preview-zone');
  var dropzone = $(this).parents('.form-group').find('.dropzone');
  boxZone.empty();
  previewZone.addClass('hidden');
  reset(dropzone);
});

  </script>

