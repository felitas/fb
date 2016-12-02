<div class="container">
    <?php echo form_open('outlets/edit_outlet/'.$outlet->id, array('data-role' =>  'validator','data-on-error-input' => 'notifyOnErrorInput','data-show-error-hint' => 'false')) ?>
    <div class="grid">
        <div class="row">
            <div class="cell">
                <h3><small><a href=""><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar outlet</a></small></h3>
            </div>
        </div>

        <div class="row form-title">	 
            <div class="cell">
            	<h1 style="margin-bottom: 20px;">Edit Outlet <?php echo ucfirst($outlet->name) ?></h1>
                <hr class="bg-primary">	
            </div>
        </div>
    	
    	<div class="row cells2">
    		<div class="cell">
    			<label>Nama Toko</label>
                <div class="input-control text full-size">
                    <input type="text" placeholder="Nama Toko" name="outlet_name" value="<?php echo $outlet->name ?>" data-validate-func="required" data-validate-hint="Nama toko harus diisi">
                </div>
    		</div>
    		<div class="cell">
    			<label>Kode Toko</label>
                <div class="input-control text full-size">
                    <input type="text" placeholder="Masukkan Kode Toko (2 Karakter)" value="<?php echo $outlet->code ?>" title="Contoh : KM" name="outlet_code" data-validate-func="required, maxlength" data-validate-arg=",2" data-validate-hint="Kode toko harus 2 huruf">
                </div>
    		</div>
    	</div>

    	<div class="row">
        	<div class="cell">
        		<label>Nama Store Manager</label>
        		<div class="input-control text full-size" data-role="input">
    			    <input type="text" placeholder="Nama Lengkap Store Manager" name="outlet_manager" value="<?php echo $outlet->store_manager ?>">
    			    <button class="button helper-button clear"><span class="mif-cross"></span></button>
    			</div>
        	</div>
        </div>

    	<div class="row">
        	<div class="cell">
        		<label>No. Telp</label>
        		<div class="input-control text full-size" data-role="input">
    			    <input type="text" placeholder="Nomor Telephone Outlet" name="outlet_phone" value="<?php echo $outlet->phone ?>">
    			    <button class="button helper-button clear"><span class="mif-cross"></span></button>
    			</div>
        	</div>
        </div>

        <div class="row">
        	<div class="cell">
        		<label>Alamat</label>
        		<div class="input-control textarea full-size" data-role="input" data-text-auto-resize="true">
    			    <textarea name="outlet_address" placeholder="Alamat Toko"><?php echo $outlet->address ?></textarea>
    			</div>
        	</div>
        </div>

        <div class="row cells2">
            <div class="cell">
                <label>Username</label>
    			<div class="input-control text full-size" data-role="input"  style="margin-top: 9px;">
    			    <input type="text" placeholder="Username Outlet" value="<?php echo $outlet->username ?>" name="outlet_username" onblur="check_username(this)" data-validate-func="required" data-validate-hint="Username harus diisi">
    			</div>
            </div>

            <div class="cell">
                <label class="switch">
                    <input type="checkbox" onchange="change_password(this)">
                    <span class="check"></span>
                    <span class="caption"> Ubah Password</span>
                </label>
    			<div class="input-control password full-size" data-role="input" style="display: none">
    			    <input type="password" placeholder="Password" id="password" name="outlet_password">
    			    <button class="button helper-button reveal"><span class="mif-looks"></span></button>
    			</div>
        	</div>
        </div>

        <div class="row cells2">
        	<div class="cell">
        		<label>Margin Toko</label>
    			<div class="input-control text full-size" data-role="input">
    			    <input type="number" placeholder="Perbedaan Dasar Harga dengan Toko Utama" name="outlet_margin" value="<?php echo $outlet->margin ?>" data-validate-func="required,min,max" data-validate-arg=",0,100" data-validate-hint="Margin toko harus diisi min: 0, max: 100">
    			    <button class="button" style="border-color: rgba(127, 140, 141,1.0); cursor: default;"><span class="fa fa-percent" aria-hidden="true"></span></button>  
    			</div>
        	</div>
        </div>

    	<div class="row">
            <div class="cell text-center">
        	   <input type="Submit" name="submit" class="button info bg-primary btn-teal" value="Submit">
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
function change_password(el){
    if($(el).is(":checked") ){
        $('#password').parent().show();
    }else{
        $('#password').parent().hide();
        $('#password').val('');            
    }
  }

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