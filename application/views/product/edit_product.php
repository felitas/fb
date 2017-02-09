<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/selectize.css')?>">
<div class="container-fluid">
	
	<div class="row-fluid">
		<a href="<?php echo base_url('product') ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar barang</a></small>
		<h2>Edit Produk <?php echo $product->name?></h2>
	</div>
	<div class="widget-box">
	<div class="widget-content">
		<?php echo form_open_multipart('product/edit_product/'.$product->product_code,array('class'=>'form-horizontal','id'=>'productform')) ?>    
			<div class="row-fluid">
					<div class="control-group top-control">
						<div class="span9">
							<label for="" class="control-label">Kode Produk</label>
							<div class="controls">
								<input type="text" name="product_code" readonly="readonly" class="span11" placeholder="Kode Produk" id="product_code" value="<?php echo $product->product_code?>">
							</div>
						</div>	
						<div class="span3">
							<label class="control-label">Masuk Brankas</label>
							<div class="controls">
				                <input type="checkbox" onchange="warehouse(this)" name="product_warehouse">
				            </div>
						</div>
					</div>
					<div class="control-group" id="product_barcode_row">
						<div class="span12">
							<label for="" class="control-label">Nama Barang</label>
							<div class="controls">
								<input type="text" placeholder="Nama Barang" name="product_name" class="span11" value="<?php echo $product->name?>">
							</div>	
						</div>
					</div>
					
					<div class="control-group">
						
					</div>
					<div class="control-group" id="outlet_tray">
						<?php if ($role =='admin'):?>
						<div class="span6">
							<label for="" class="control-label">Outlets</label>
							<div class="controls">
								<select name="product_outlet" id="product_outlet" onchange="get_tray(this)" class="span12">
									<?php foreach ($outlets as $outlet): ?>
										<option value="<?php echo $outlet->id?>"<?php echo ($outlet->id == $product->outlet_id) ? 'selected' : '' ?>><?php echo $outlet->name?></option>	
									<?php endforeach ?>
								</select>
							</div>	
						</div>
						<?php endif;?>
						<div class="span6">
							<label for="" class="control-label">Tray</label>
							<div class="controls">
								<select name="product_tray" id="product_tray" class="span12">
									<?php foreach ($trays as $tray): ?>
										<option value="<?php echo $tray->id?>" <?php echo ($tray->id == $product->tray_id) ? 'selected' : '' ?> ><?php echo $tray->code?> - <?php echo $tray->description?></option>	
									<?php endforeach ?>
								</select>
							</div>	
						</div>
					</div>

					

					<div class="control-group">
						<div class="span6">
							<label for="" class="control-label">Harga Beli</label>
							<div class="controls">
								<input type="number" placeholder="Harga Beli" name="product_purchase_price" class="span12" value="<?php echo $product->purchase_price?>">
							</div>	
						</div>
						<div class="span6">
							<label for="" class="control-label" class="span12">Harga Jual</label>
							<div class="controls">
								<input type="number" placeholder="Harga Jual" name="product_selling_price" id="product_selling_price" class="span12" value="<?php echo $product->sell_price?>">
							</div>	
						</div>	
					</div>

					<div class="control-group">
						<div class="span6">
							<label for="" class="control-label">Kadar</label>
							<div class="controls">
								<input type="number" placeholder="Kadar emas" name="product_gold_amount" class="span12" value="<?php echo $product->gold_amount?>">
							</div>	
						</div>
						<div class="span6">
							<label for="" class="control-label">Berat</label>
							<div class="controls">
								<input type="number" placeholder="Berat Perhiasan" name="product_weight" class="span12" value="<?php echo $product->weight?>">
							</div>	
						</div>
					</div>

					
					
						
     				<div class="control-group" id="spec">
							<label for="" class="control-label"><b>Spesifikasi</b></label>
							<div class="controls">
								<a class="btn btn-info bg_ls" onclick="add_spec()">Tambah Spesifikasi</a>
							</div>	
					</div>	
					<div class="control-group">
						<div class="span12" id="specifications">
						<!--Later appended-->
						</div>
					</div>
				

					
				
				<div class="control-group">
						
					<label for="" class="control-label">Upload Photo</label>
					<div class="controls">
						<input type="file" accept="image/*" name="capture" id="capture" capture="camera">
					</div>	
						

				</div>
				<div class="control-group">
					<label class="control-label">Ambil Foto</label>
					<div class="controls">
		                <input type="checkbox" onchange="show_cam(this)">
		                <span class="check"></span>
		            </div>
				</div>
			
				<?php if (!$is_mobile): ?>
	            <div class="control-group text-center" id="snapshot" style="display: none">
	                <div class="span6">
	                    <div id="my_camera" style="width:320px; height:240px; margin:auto"></div>
	                    <a style="margin-top: 10px;margin-bottom: 10px;" class="btn btn-info bg_ls" href="javascript:void(take_snapshot())"><span class="mif mif-camera"></span> Ambil Foto</a>    
	                </div>
	                <div class="span6">
	                    <div id="my_result" style="margin:auto"></div>        
	                </div> 
	            </div>
	        	<?php endif ?>
	        
				<div class="form-actions text-center">
		        	<input type="submit" name="submit" class="btn btn-info" value="Submit">
		        </div>
		        </div>
		   	</div>
        <?php echo form_close() ?>
    </div>
    </div>
</div>
<script src="<?php echo base_url() ?>js/selectize.min.js"></script>
<script src="<?php echo base_url() ?>js/jquery.validate.js"></script> 
<script src="<?php echo base_url() ?>js/webcam.min.js"></script>

<script>
	$(document).ready(function(){
		//validate form
		$('#productform').validate({
	        rules:{
	            product_name: "required"
	        }
	    });
	});
	//TURN ON THE WEB CAM TO TAKE PHOTO OF PRODUCT
    function show_cam(el){
        if($(el).is(":checked") ){
            $('#snapshot').show();
            Webcam.attach('#my_camera');
            $('#capture').attr('disabled','disabled');
        }else{
            $('#snapshot').hide();
            $('#capture').removeAttr('disabled');
            Webcam.reset();            
        }
     }
     //IF MASUK BRANKAS IS CHECKED, NORMALIZE AND DISABLE ALL UNNECESSARY FIELDS
     function warehouse(el){
     	if($(el).is(":checked")){
     		$('#product_tray').empty();
     		$('#product_tray').val('0');
     		$('#product_outlet').val('0');
     		$('#product_tray').append("<option>Pilih Outlet terlebih dahulu</option>");
     		$('#product_tray').attr("readonly","readonly");
     		$('#product_outlet').attr("readonly","readonly");
     		$('#outlet_tray').hide();
     	}
     	else{
     		$('#product_tray').removeAttr("readonly");
     		$('#product_outlet').removeAttr("readonly");
     		$('#outlet_tray').show();
     	}
     }


     //ADDING SPECIFICATIONS OF JEWELLERY
     function add_spec(){
     	$('#specifications').append("<div class='controls'><select name='stone_type[]'><option>--Jenis Diamond--</option><?php foreach ($diamond_types as $diamond_type): ?><option value='<?php echo $diamond_type->code?>'><?php echo $diamond_type->name?></option><?php endforeach ?></select><input type='number' placeholder='Jumlah Diamond' name='stone_amount[]'><input type='number' placeholder='Jumlah Karat' name='stone_ct[]'></div>");
     }

     //AJAX FUNCTION TO GET TRAY FROM RELATED OUTLET
     function get_tray(el){
		if($(el).val() != ''){
			$.ajax({
              url: "<?php echo base_url('tray/get_tray_data/')?>" + $(el).val(),
              type: 'GET',
              cache : false,
              success: function(result){
              	if (result != 'Toko ini belum punya baki') {
              		$('#product_tray').empty();
              		$('#product_tray').append("<option value=''>--Pilih Nampan--</option>");
              		$('#product_tray').append(result);
              	}

				else{
		      		$('#product_tray').empty();
		      		$('#product_tray').append("<option value='0'>--Tidak ada nampan--</option>");	
		      	}
              }
			});
		}

	}


    <?php if($this->session->flashdata('product')): ?>

       <?php echo $this->session->flashdata('product') ?>

    <?php endif; ?>


    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            document.getElementById('my_result').innerHTML = '<img src="'+data_uri+'"/>';
            Webcam.upload( data_uri, "<?php echo base_url('product/upload') ?>", function(code, text) {
            } );    
        } );
        
    }
</script>