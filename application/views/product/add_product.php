<div class="container">
	<div class="grid">
		<div class="row">
			<div class="cell">
				<h3><small><a href=""><span class="fa fa-arrow-circle-o-left"></span>Kembali ke daftar barang</a></small></h3>
			</div>
		</div>

		<div class="row form-title">
			<div class="cell">
				<h1 style="margin-bottom: 20px">Tambah barang baru</h1>
				<hr class="bg-primary">
			</div>
		</div>

		<div class="row cells8">
			<div class="cell colspan7">
				<label for="">Nama Barang</label>
				<div class="input-control text full-size">
					<input type="text" placeholder="Nama Barang" name="product_name" data-validate-func="required" data-validate-hint="Nama barang harus diisi">
				</div>
			</div>
			<div class="cell">
				<label class="input-control checkbox place-right" style="margin-top: 20px;">
					
				    <input type="checkbox">
				    <span class="check"></span>
				    <span class="caption">Buyback</span>
				</label> 
			</div>
		</div>
		
		<div class="row cells2">
			<div class="cell">
				<label for="">Kode Produk</label>
				<div class="input-control text full-size">
					<input type="text" placeholder="Kode Produk" name="product_code" readonly="readonly">
				</div>
			</div>
			<div class="cell">
				<label for="">Kode Model</label>
				<div class="input-control text full-size">
					<input type="text" placeholder="Kode Model" name="product_model_code">
				</div>
			</div>
		</div>

		<div class="row cells2">
			<div class="cell">
				<label for="">Baki</label>
				<div class="input-control select full-size">
					<select name="product_tray" id="" data-validate-func="required" data-validate-hint="Baki harus dipilih">
						<option value="">--Pilih Tipe--</option>
					</select>
				</div>
			</div>
			<div class="cell">
				<label for="">Tipe</label>
				<div class="input-control select full-size">
					<select name="product_type" id="" data-validate-func="required" data-validate-hint="Jenis barang harus diisi">
						<option value="">--Pilih Tipe--</option>
						<option value="1">Emas</option>
						<option value="2">Berlian</option>
					</select>
				</div>
			</div>
		</div>

		<div class="row cells2">
			<div class="cell">
				<!-- Category -->
				<label for="">Kategori</label>
				<div class="input-control select full-size">
					<select name="product_category" id="" data-validate-func="required" data-validate-hint="Kategori harus diisi">
						<option value="">--Pilih Kategori--</option>
					</select>
				</div>				
			</div>
			<div class="cell">
				<!-- Model -->
				<label for="">Model</label>
				<div class="input-control select full-size">
					<select name="product_model" id="" data-validate-func="required" data-validate-hint="Model harus diisi">
						<option value="">--Pilih Model--</option>
					</select>
				</div>
			</div>
		</div>

		<div class="row cells2">
			<div class="cell">
				<label for="">Harga Beli</label>
				<div class="input-control text full-size">
					<input type="text" placeholder="Harga Beli" name="product_purchase_price">
				</div>
			</div>
			<div class="cell">
				<label for="">Harga Jual</label>
				<div class="input-control text full-size">
					<input type="text" placeholder="Harga Jual" name="product_selling_price">
				</div>
			</div>
		</div>

		<div class="row cells2">
			<div class="cell">
				<label for="">Kadar</label>
				<div class="input-control text full-size">
					<input type="text" placeholder="Kadar" name="product_amount">
				</div>
			</div>
			<div class="cell">
                <label>Upload Photo</label>
                <div class="input-control file full-size" data-role="input">
                    <input type="file" accept="image/*" name="capture" id="capture" capture="camera">
                    <button class="button btn-file"><span class="mif-camera"></span></button>
                </div>
			</div>
		</div>
		<?php if (!$is_mobile): ?>
            <div class="row">
                <div class="cell">
                    <label class="switch">
                        <input type="checkbox" onchange="show_cam(this)">
                        <span class="check"></span>
                        <span class="caption">Ambil Foto</span>
                    </label>
                </div>
            </div>
            <div class="row cells2" id="snapshot" style="display: none">

                <div class="cell text-center">
                    <div id="my_camera" style="width:320px; height:240px; margin:auto"></div>
                    
                    <a class="button info bg-primary btn-teal" href="javascript:void(take_snapshot())"><span class="mif mif-camera"></span> Ambil Foto</a>
                </div>
                <div class="cell text-center">
                    <div id="my_result" style="margin:auto"></div>    
                </div>
                
                
            </div>    
        <?php endif ?>
        
		<div class="row">
            <div class="cell text-center">
        	   <input type="submit" name="submit" class="button bg-primary" value="Submit">
            </div>
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

    function notifyOnErrorInput(input){
        var message = input.data('validateHint');
        $.Notify({
            caption: 'Error',
            content: message,
            type: 'alert'
        });
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