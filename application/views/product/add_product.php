<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/selectize.css')?>">
<div class="container-fluid">
	
	<div class="row-fluid">
		<a href="<?php echo base_url('product') ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar barang</a></small>
		<h2>Tambah barang baru</h2>
	</div>
	<div class="widget-box">
	<div class="widget-content">
		<?php echo form_open_multipart('product/add_product',array('class'=>'form-horizontal','id'=>'productform')) ?>    
			<div class="row-fluid">
					<div class="control-group top-control">
						<div class="span6">
							<label class="control-label">Kode Barcode</label>
							<div class="controls">
								<select name="product_barcode" id="product_barcode" onchange="get_barcode(this)">
									<option>--Pilih Kode Barcode--</option>
									<?php foreach ($codes as $code): ?>
										<option value="<?php echo $code->code?>"><?php echo $code->code?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="span3">
							<label class="control-label">Kode Barcode Baru</label>
							<div class="controls">
								<input type="checkbox" name="" id="new_barcode">
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
								<input type="text" placeholder="Nama Barang" name="product_name" class="span11">
							</div>	
						</div>
					</div>
					<!--NEW BARCODE FIELDS-->
					<div class="control-group new-barcode" style="display: none;">
						<div class="span6">
							<label class="control-label">Tipe</label>
							<div class="controls">
								<select name="product_type" id="product_type" onchange="fill_type(this)">
									<option value="x">--Pilih Tipe--</option>
									<?php foreach ($types as $type): ?>
										<option value="<?php echo $type->code?>"><?php echo $type->code?> - <?php echo $type->name?></option>	
									<?php endforeach ?>
								</select>
							</div>	
						</div>
						<div class="span6">
							<label for="" class="control-label">Kategori Barang</label>
							<div class="controls">
								<select name="product_category" id="category" onchange="fill_category(this)">
									<option value="x">--Pilih Kategori--</option>
									<?php foreach ($categories as $category): ?>
										<option value="<?php echo $category->code?>"><?php echo $category->code?> - <?php echo $category->name?></option>	
									<?php endforeach ?>
								</select>
							</div>	
						</div>	
					</div>

					<div class="control-group new-barcode" style="display: none;">
						<div class="span4">
							<label for="" class="control-label">Nama Koleksi</label>
							<div class="controls">
								<select name="product_model" id="product_model" onchange="fill_model(this)">
									<option value="">--Pilih Koleksi--</option>
									<?php foreach($models as $model): ?>
										<option value="<?php echo $model->code?>"><?php echo $model->code?> - <?php echo $model->name?></option>
									<?php endforeach?>
								</select>
							</div>	
						</div>
						<div class="span4">
							<label for="" class="control-label">Kode Barcode</label>
							<div class="controls">
								<input type="text" name="model_code[0]" readonly="readonly" class="span3">
								<input type="text" name="model_code[1]" readonly="readonly" class="span3">
								<input type="text" name="model_code[2]" readonly="readonly" class="span4">
							</div>	
						</div>
						<div class="span4">
							<a class="btn btn-info bg_ls span9" style="margin-top: 10px;" onclick="generate_barcode(this)">Generate Kode Produk</a>
						</div>
					</div>
					<!--END FIELDS-->
					<!--INPUT TYPE HIDDEN TO COUNT FOR JEWELLERY IN EACH BARCODE-->
					<input type="hidden" name="product_barcode_code" id="product_barcode_code">
					<input type="hidden" name="product_count" id="product_count">
					<!--END INPUT-->
					<div class="control-group">
						<div class="span12">
							<label for="" class="control-label">Kode Produk</label>
							<div class="controls">
								<input type="text" name="product_code" readonly="readonly" class="span11" placeholder="Kode Produk" id="product_code">
							</div>
						</div>	
					</div>
					<div class="control-group">
						<?php if ($role =='admin'):?>
						<div class="span6">
							<label for="" class="control-label">Outlets</label>
							<div class="controls">
								<select name="product_outlet" id="product_outlet" onchange="get_tray(this)" class="span12">
									<option value="0">--Pilih Outlet--</option>	
									<?php foreach ($outlets as $outlet): ?>
										<option value="<?php echo $outlet->id?>"><?php echo $outlet->name?></option>	
									<?php endforeach ?>
								</select>
							</div>	
						</div>
						<?php endif;?>
						<div class="span6">
							<label for="" class="control-label">Tray</label>
							<div class="controls">
								<select name="product_tray" id="product_tray" class="span12">
									<option value="0">--Pilih Nampan--</option>
									<?php foreach ($trays as $tray): ?>
										<option value="<?php echo $tray->id?>"><?php echo $tray->code?></option>	
									<?php endforeach ?>
								</select>
							</div>	
						</div>
					</div>

					

					<div class="control-group">
						<div class="span6">
							<label for="" class="control-label">Harga Beli</label>
							<div class="controls">
								<input type="number" placeholder="Harga Beli" name="product_purchase_price" class="span12">
							</div>	
						</div>
						<div class="span6">
							<label for="" class="control-label" class="span12">Harga Jual</label>
							<div class="controls">
								<input type="number" placeholder="Harga Jual" name="product_selling_price" id="product_selling_price" class="span12">
							</div>	
						</div>	
					</div>

					<div class="control-group">
						<div class="span6">
							<label for="" class="control-label">Kadar</label>
							<div class="controls">
								<input type="number" placeholder="Kadar emas" name="product_gold_amount" class="span12">
							</div>	
						</div>
						<div class="span6">
							<label for="" class="control-label">Berat</label>
							<div class="controls">
								<input type="number" placeholder="Berat Perhiasan" name="product_weight" class="span12">
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
<script src="<?php echo base_url() ?>js/webcam.min.js"></script>

<script>
	$(document).ready(function(){
		$('#product_barcode').selectize();
		//function to show all new barcoode fields
		$('#new_barcode').change(function(){
			if(this.checked){
				$('#product_barcode_row').hide();
				$('.new-barcode').show();
				$('#product_barcode')[0].selectize.disable();
			}
			else{
				$('#product_barcode_row').show();
				$('.new-barcode').hide();
				$('#product_barcode')[0].selectize.enable();
			}
		})
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
     		$('#product_tray').val('');
     		$('#product_tray').attr("disabled","disabled");
     		$('#product_outlet').val('');
     		$('#product_outlet').attr("disabled","disabled");
     	}
     	else{
     		$('#product_tray').removeAttr("disabled");
     		$('#product_outlet').removeAttr("disabled");
     	}
     }


     //ADDING SPECIFICATIONS OF JEWELLERY
     function add_spec(){
     	$('#specifications').append("<div class='controls'><select name='stone_type[]'><option>--Jenis Diamond--</option><?php foreach ($diamond_types as $diamond_type): ?><option value='<?php echo $diamond_type->code?>'><?php echo $diamond_type->name?></option><?php endforeach ?></select><input type='number' placeholder='Jumlah Diamond' name='stone_amount[]'><input type='number' placeholder='Jumlah Karat' name='stone_ct[]'></div>");
     }


     //AJAX FUNCTIONS PRIOR TO GENERATING BARCODE, FILLING THE TEXT FIELDS AND FETCHING THE DATA WITH AJAX
     function fill_type(el){
     	if($(el).val()=='x'){
            $("input[name='model_code[0]']").val('');
		}     	
		else if($(el).val()!=''){
            $("input[name='model_code[0]']").val($(el).val());
		}
		
     }

     function fill_category(el){
     	if($(el).val()=='x'){
            $("input[name='model_code[1]']").val('');
		}     	
		else if($(el).val()!=''){
            $("input[name='model_code[1]']").val($(el).val());
		}
     }

     function fill_model(el){
     	if($(el).val()!=''){
     		$("input[name='model_code[2]']").val($(el).val());
     	}
     	else{
     		$("input[name='model_code[2]']").val("");	
     	}	
     }
     //AJAX FUNCTION TO TAKE COUNT VALUE FROM SELECT OPTION
     function get_barcode(el){
     	$('#product_code').val();
     	$.ajax({
     		url: "<?php echo base_url('product/get_code_count/')?>" + $(el).val(),
            type: 'GET',
            cache : false,
            success: function(result){ 
            	count = +result + +1;
              	$('#product_count').val(count);
              	$('#product_code').val($(el).val()+'0000'+ $('#product_count').val());	
            }
     	});
     }
     //AJAX FUNCTION TO GENERATE BARCODE
     function generate_barcode(el){
     	var count = 1;
     	$('#product_code').val(); //empty the product code first
     	$('#product_barcode_code').val($("input[name='model_code[0]']").val()+$("input[name='model_code[1]']").val()+$("input[name='model_code[2]']").val());

     	
     	$.ajax({
              url: "<?php echo base_url('product/get_code_count/')?>" + $('#product_barcode_code').val(),
              type: 'GET',
              cache : false,
              success: function(result){
              	count = +result + +1;

              	$('#product_count').val(count);
              	if($("input[name='model_code[0]']").val()!=''){
		     		$('#product_code').val($("#product_barcode_code").val()+'0000'+ $('#product_count').val());	
		     	}
		     	else{
		     		$.gritter.add({
		     			title: 'Gagal',
		     			text: 'Belum ada kode barcode',
		     			time: 1500
		     		});
		     	}
              }
			});
     	
     	
     	

     }

     //AJAX FUNCTION TO GET TRAY FROM RELATED OUTLET
     function get_tray(el){
		if($(el).val() != ''){
			$.ajax({
              url: "<?php echo base_url('product/get_tray_data/')?>" + $(el).val(),
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