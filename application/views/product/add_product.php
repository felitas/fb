<div class="container-fluid">
	
	<div class="row-fluid">
		<a href=""><span class="fa fa-arrow-circle-o-left"></span>Kembali ke daftar barang</a></small>
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
							<label for="" class="control-label">Kode Produk</label>
							<div class="controls">
								<input type="text" placeholder="Kode Produk" name="product_code" readonly="readonly">
							</div>	
						</div>
						<div class="span6">
							<label for="" class="control-label">Kode Model</label>
							<div class="controls">
								<input type="text" placeholder="Kode Model" name="product_model_code">
							</div>	
						</div>	
					</div>
					<div class="control-group">
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
						<div class="span6">
							<label for="" class="control-label">Tipe</label>
							<div class="controls">
								<select name="product_type" id="" data-validate-func="required" data-validate-hint="Jenis barang harus diisi">
									<option value="">--Pilih Tipe--</option>
									<option value="1">Emas</option>
									<option value="2">Berlian</option>
								</select>
							</div>	
						</div>	
					</div>

					<div class="control-group">
						<div class="span6">
							<label for="" class="control-label">Kategori</label>
							<div class="controls">
								<select name="product_category" id="" data-validate-func="required" data-validate-hint="Kategori harus diisi">
									<option value="">--Pilih Kategori--</option>
								</select>
							</div>	
						</div>
						<div class="span6">
							<label for="" class="control-label">Model</label>
							<div class="controls">
								<select name="product_model" id="" data-validate-func="required" data-validate-hint="Model harus diisi">
									<option value="">--Pilih Model--</option>
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
								<input type="number" placeholder="Harga Jual" name="product_selling_price">
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
								<a class="btn btn-info bg_ls">Tambah Spesifikasi</a>
							</div>	
						</div>
						
					<div class="control-group">
						<div class="span12">
							<div class="controls">
								<input type="number" placeholder="Jenis Batu" name="stone_type">
								<input type="number" placeholder="Jumlah Batu" name="stone_amount">
								<input type="number" placeholder="Jumlah Karat" name="stone_weight">
							</div>	
							<div class="controls">
								<input type="number" placeholder="Jenis Batu" name="stone_type">
								<input type="number" placeholder="Jumlah Batu" name="stone_amount">
								<input type="number" placeholder="Jumlah Karat" name="stone_weight">
							</div>
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
     	}
     	else{
     		$('#product_tray').removeAttr("disabled");
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