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
						<div class="span6">
							<label class="control-label">Masuk Brankas</label>
							<div class="controls">
				                <input type="checkbox" onchange="warehouse(this)">
				                <span class="check"></span>
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
										<option value="<?php echo $type->id?>"><?php echo $type->code?> - <?php echo $type->name?></option>	
									<?php endforeach ?>
								</select>
							</div>	
						</div>
						<div class="span6">
							<label for="" class="control-label">Kategori Barang</label>
							<div class="controls">
								<select name="product_category" id="category">
									<option value="">--Pilih tipe terlebih dahulu--</option>
								</select>
							</div>	
						</div>	
					</div>

					<div class="control-group">
						<div class="span6">
							<label for="" class="control-label">Model</label>
							<div class="controls">
								<select name="product_model" id="">
									<option value="">--Pilih Model--</option>
									<?php foreach($models as $model): ?>
										<option value="<?php echo $model->id?>"><?php echo $model->code?> - <?php echo $model->name?></option>
									<?php endforeach?>
								</select>
							</div>	
						</div>
						<div class="span6">
							<label for="" class="control-label">Kode Model</label>
							<div class="controls">
								<input type="text" name="model_code[]" readonly="readonly" class="span3">
								<input type="text" name="model_code[]" readonly="readonly" class="span3">
								<input type="text" name="model_code[]" readonly="readonly" class="span3">
								<input type="text" name="model_code[]" readonly="readonly" class="span3">
							</div>	
						</div>	
					</div>
					<div class="control-group">
						<div class="span12">
							<label for="" class="control-label">Kode Produk</label>
							<div class="controls">
								<input type="text" name="product_code" readonly="readonly" class="span12" placeholder="Kode Produk">
							</div>
						</div>	
					</div>
					<div class="control-group">
						<?php if ($role =='admin'):?>
						<div class="span6">
							<label for="" class="control-label">Outlets</label>
							<div class="controls">
								<select name="product_outlet" id="product_outlet" onchange="get_tray(this)">
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
									<option value="">--Pilih Tray--</option>
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
		        	<input type="submit" name="submit" class="btn btn-primary" value="Submit">
		        </div>
		        </div>
		   	</div>
        </form>
    </div>
    </div>
</div>

<script src="<?php echo base_url() ?>js/webcam.min.js"></script>

<script>
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

     function warehouse(el){
     	if($(el).is(":checked")){
     		$('#product_tray').attr("disabled","disabled");
     		$('#product_outlet').attr("disabled","disabled");
     		$('#product_selling_price').attr("disabled","disabled");
     	}
     	else{
     		$('#product_tray').removeAttr("disabled");
     		$('#product_outlet').removeAttr("disabled");
     		$('#product_selling_price').removeAttr("disabled");
     	}
     }


     function add_spec(){
     	$('#specifications').append("<div class='controls'><select name='diamond_type[]'><option>--Jenis Diamond--</option><?php foreach ($diamond_types as $diamond_type): ?><option value='<?php echo $diamond_type->code?>''><?php echo $diamond_type->name?></option><?php endforeach ?></select><input type='number' placeholder='Jumlah Diamond' name='stone_amount[]'><input type='number' placeholder='Jumlah Karat' name='stone_weight[]'></div>")
     }

     function get_category(el){
     	if($(el).val()=='x'){
			$('#category').empty();
            $('#category').append("<option value=''>--Pilih Tipe Terlebih Dahulu--</option>");
		}     	
		else if($(el).val()!=''){
			$.ajax({
              url: "<?php echo base_url('product/get_category_data/')?>" + $(el).val(),
              type: 'GET',
              cache : false,
              success: function(result){
              	if (result != 'Belum ada kategori') {
              		$('#category').empty();
              		$('#category').append(result);
              	}
              	else{
              		$('#category').empty();
              		$('#category').append("<option value=''>--Tidak ada kategori--</option>");	
              	}
              }
			});
		}
		
     }

     function get_tray(el){
		if($(el).val() != ''){
			$.ajax({
              url: "<?php echo base_url('product/get_tray_data/')?>" + $(el).val(),
              type: 'GET',
              cache : false,
              success: function(result){
              	if (result != 'Toko ini belum punya baki') {
              		$('#product_tray').empty();
              		$('#product_tray').append("<option value=''>--Pilih Baki--</option>");
              		$('#product_tray').append(result);
              	}

				else{
		      		$('#product_tray').empty();
		      		$('#product_tray').append("<option value=''>--Tidak ada tray--</option>");	
		      	}
              }
			});
		}

	}


    <?php if($this->session->flashdata('product')): ?>

       <?php echo $this->session->flashdata('product') ?>

    <?php endif; ?>



</script>

<script language="JavaScript">
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            document.getElementById('my_result').innerHTML = '<img src="'+data_uri+'"/>';
            Webcam.upload( data_uri, "<?php echo base_url('product/upload') ?>", function(code, text) {
            } );    
        } );
        
    }
</script>