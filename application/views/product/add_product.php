<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/selectize.css')?>">
<div class="container-fluid">
	
	<div class="row-fluid">
		<a href=""><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar barang</a></small>
		<h2>Tambah barang baru</h2>
	</div>
	<div class="widget-box">
	<div class="widget-content">
		<form class="form-horizontal">
			<div class="row-fluid">
					<div class="control-group top-control">
						<div class="span6">
							<label for="" class="control-label">Nama Barang</label>
							<div class="controls">
								<input type="text" placeholder="Nama Barang" name="product_name" class="span12">
							</div>	
						</div>
						<div class="span3">
							<label class="control-label">Masuk Brankas</label>
							<div class="controls">
				                <input type="checkbox" onchange="warehouse(this)" name="product_warehouse">
				            </div>
						</div>
						<div class="span3">
							<label class="control-label">Kode Barcode Baru</label>
							<div class="controls">
								<input type="checkbox" name="">
							</div>
						</div>
					</div>
					<div class="control-group">
						<div class="span6">
							<label class="control-label">Kode Barcode</label>
							<div class="controls">
								<select name="product_barcode" id="product_barcode">
									<option>Value</option>
								</select>
							</div>
						</div>
						
					</div>
					<div class="control-group">
						<div class="span6">
							<label class="control-label">Tipe</label>
							<div class="controls">
								<select name="product_type" id="product_type" onchange="get_category(this)">
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
									<option value="">--Pilih tipe terlebih dahulu--</option>
								</select>
							</div>	
						</div>	
					</div>

					<div class="control-group">
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
								<select name="product_outlet" id="product_outlet" onchange="get_tray(this)">
									<option value="">--Pilih Outlet--</option>	
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
								<select name="product_tray" id="product_tray">
									<option value="">--Pilih Nampan--</option>
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
								<input type="number" placeholder="Harga Beli" name="product_purchase_price">
							</div>	
						</div>
						<div class="span6">
							<label for="" class="control-label">Harga Jual</label>
							<div class="controls">
								<input type="number" placeholder="Harga Jual" name="product_selling_price" id="product_selling_price">
							</div>	
						</div>	
					</div>

					<div class="control-group">
						<div class="span6">
							<label for="" class="control-label">Kadar</label>
							<div class="controls">
								<input type="number" placeholder="Kadar emas" name="product_amount">
							</div>	
						</div>
						<div class="span6">
							<label for="" class="control-label">Berat</label>
							<div class="controls">
								<input type="number" placeholder="Berat Perhiasan" name="product_weight">
							</div>	
						</div>
					</div>

					<div class="control-group">
							<label for="" class="control-label"><b>Spesifikasi</b></label>
							<div class="controls">
								<a class="btn btn-info bg_ls" onclick="add_spec()">Tambah Spesifikasi</a>
							</div>	
						</div>
						
					<div class="control-group top-control">
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
        </form>
    </div>
    </div>
</div>
<script src="<?php echo base_url() ?>js/selectize.min.js"></script>
<script src="<?php echo base_url() ?>js/webcam.min.js"></script>

<script>
	$(document).ready(function(){
		$('#product_barcode').selectize();
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
     		$('#product_selling_price').val('');
     		$('#product_selling_price').attr("disabled","disabled");
     	}
     	else{
     		$('#product_tray').removeAttr("disabled");
     		$('#product_outlet').removeAttr("disabled");
     		$('#product_selling_price').removeAttr("disabled");
     	}
     }

     //ADDING SPECIFICATIONS OF JEWELLERY
     function add_spec(){
     	$('#specifications').append("<div class='controls'><select name='diamond_type[]'><option>--Jenis Diamond--</option><?php foreach ($diamond_types as $diamond_type): ?><option value='<?php echo $diamond_type->code?>''><?php echo $diamond_type->name?></option><?php endforeach ?></select><input type='number' placeholder='Jumlah Diamond' name='stone_amount[]'><input type='number' placeholder='Jumlah Karat' name='stone_weight[]'></div>")
     }


     //AJAX FUNCTIONS PRIOR TO GENERATING BARCODE
     function get_category(el){
     	if($(el).val()=='x'){
			$('#category').empty();
            $('#category').append("<option value=''>--Pilih Tipe Terlebih Dahulu--</option>");
            $("input[name='model_code[0]']").val('');
            $("input[name='model_code[1]']").val('');
		}     	
		else if($(el).val()!=''){
			$.ajax({
              url: "<?php echo base_url('configuration/get_category_data/')?>" + $(el).val(),
              type: 'GET',
              cache : false,
              success: function(result){
              	if (result != 'Belum ada kategori') {
              		$('#category').empty();
              		$('#category').append(result);
              		$("input[name='model_code[1]']").val($('#category').val());

              	}
              	else{
              		$('#category').empty();
              		$('#category').append("<option value=''>--Tidak ada kategori--</option>");	
              		$("input[name='model_code[1]']").val('');
              	}
              	$("input[name='model_code[0]']").val($(el).val());
              }
			});
		}
		
     }

     function fill_category(el){
     	if($(el).val()!=''){
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

     //AJAX FUNCTION TO GENERATE BARCODE
     function generate_barcode(el){
     	var count = 1;
     	$('#product_code').val('');
     	$('#product_code').val($("input[name='model_code[0]']").val()+$("input[name='model_code[1]']").val()+$("input[name='model_code[2]']").val()+'00001' );

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
		      		$('#product_tray').append("<option value=''>--Tidak ada nampan--</option>");	
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