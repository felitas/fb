<div class="container">
    <?php echo form_open('outlets/add_outlet', array('data-role' =>  'validator','data-on-error-input' => 'notifyOnErrorInput','data-show-error-hint' => 'false')) ?>
    <div class="grid">
        <div class="row">
            <div class="cell">
                <h3><small><a href="<?php echo base_url('outlets') ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar outlet</a></small></h3>
            </div>
        </div>

        <div class="row form-title">	 
            <div class="cell">
            	<h1 style="margin-bottom: 20px;">Tambah Outlet Baru</h1>
                <hr class="bg-primary">	
            </div>
        </div>
    	
    	<div class="row cells2">
    		<div class="cell">
    			<label>Nama Toko</label>
                <div class="input-control text full-size">
                    <input type="text" placeholder="Nama Toko" name="outlet_name" data-validate-func="required" data-validate-hint="Nama toko harus diisi">
                </div>
    		</div>
    		<div class="cell">
    			<label>Kode Toko</label>
                <div class="input-control text full-size">
                    <input type="text" placeholder="Masukkan Kode Toko (2 Karakter)" title="Contoh : KM" name="outlet_code" data-validate-func="required,maxlength" data-validate-arg=",2" data-validate-hint="Kode toko harus 2 huruf">
                    
                </div>
    		</div>
    	</div>

    	<div class="row">
        	<div class="cell">
        		<label>Nama Store Manager</label>
        		<div class="input-control text full-size" data-role="input">
    			    <input type="text" placeholder="Nama Lengkap Store Manager" name="outlet_manager">
    			    <button class="button helper-button clear"><span class="mif-cross"></span></button>
    			</div>
        	</div>
        </div>

    	<div class="row">
        	<div class="cell">
        		<label>No. Telp</label>
        		<div class="input-control text full-size" data-role="input">
    			    <input type="text" placeholder="Nomor Telephone Outlet" name="outlet_phone" data-validate-func="digits" data-validate-hint="No. telp hanya terdiri dari angka">
    			</div>
        	</div>
        </div>

        <div class="row">
        	<div class="cell">
        		<label>Alamat</label>
        		<div class="input-control textarea full-size" data-role="input" data-text-auto-resize="true">
    			    <textarea name="outlet_address" placeholder="Alamat Toko"></textarea>
    			</div>
        	</div>
        </div>

        <div class="row cells2">
            <div class="cell">
                <label>Username</label>
    			<div class="input-control text full-size" data-role="input">
    			    <input type="text" placeholder="Username Outlet" name="outlet_username" onblur="check_username(this)" data-validate-func="required" data-validate-hint="Username harus diisi">
    			    
    			</div>
            </div>
            <div class="cell">
                <label>Password</label>
    			<div class="input-control password full-size" data-role="input">
    			    <input type="password" placeholder="Password" name="outlet_password" data-validate-func="required" data-validate-hint="Password harus diisi">
    			    
    			</div>
        	</div>
        </div>
<?php #max="100" min="0"  ?>
        <div class="row cells2">
        	<div class="cell">
        		<label>Margin Toko</label>
    			<div class="input-control text full-size" data-role="input">
    			    <input type="number" placeholder="Perbedaan Dasar Harga dengan Toko Utama" name="outlet_margin" data-validate-func="required,min,max" data-validate-arg=",0,100" data-validate-hint="Margin toko harus diisi min: 0, max: 100">
    			    <button class="button" style="border-color: rgba(127, 140, 141,1.0); cursor: default;"><span class="fa fa-percent" aria-hidden="true"></span></button>  
    			</div>
        	</div>
        </div>

    	<div class="row">
            <div class="cell text-center">
        	   <input type="Submit" name="submit" class="button bg-primary btn-teal" value="Submit">
            </div>
        </div>    
    </div>
    <?php echo form_close() ?>
</div>

<script>
    <?php if($this->session->flashdata('outlet')): ?>

       <?php echo $this->session->flashdata('outlet') ?>

    <?php endif; ?>
</script>
<script>

function check_username(el){
        if($(el).val() != ''){
            $.ajax({
              url: "<?php echo base_url('accounts/check_username/')?>" + $(el).val(),
              type: 'GET',
              cache : false,
              success: function(result){
                if(result == 'taken'){
                    $.Notify({
                        caption: 'Error !',
                        content: 'Username sudah terpakai',
                        type: 'alert'
                    });
                    $(el).val('');
                    $(el).parent().addClass('error');
                    setTimeout(function(){$(el).parent().removeClass('error')},3000);
                }else{
                    $(el).parent().addClass('success');
                }
               
                
              }
            
            });    
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
</script>