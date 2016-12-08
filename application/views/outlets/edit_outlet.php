<div id="content-header">
    <div id="breadcrumb"> <a href="<?php echo base_url('outlets') ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar outlet</a></div>
    <h1 style="margin-bottom: 20px;">Edit Outlet <?php echo ucfirst($outlet->name) ?></h1>
</div>
<div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <?php echo form_open('outlets/edit_outlet/'.$outlet->id, array('class'=>'form-horizontal')) ?>
        <div class="control-group">
            <label class="control-label">Nama Toko</label>
            <div class="controls">
              <input type="text" placeholder="Nama Toko" name="outlet_name" title="Go to Home" class="tip-bottom" value="<?php echo $outlet->name ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Kode Toko</label>
            <div class="controls">
              <input type="text" placeholder="Masukkan Kode Toko (2 Karakter)" title="Contoh : KM" name="outlet_code" value="<?php echo $outlet->code ?>">
            </div>
        </div>    
        <div class="control-group">
            <label class="control-label">Nama Manager Toko</label>
            <div class="controls">
              <input type="text" placeholder="Nama Lengkap Store Manager" name="outlet_manager" value="<?php echo $outlet->store_manager ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">No. Telp</label>
            <div class="controls">
              <input type="text" placeholder="Nomor Telephone Outlet" name="outlet_phone" value="<?php echo $outlet->phone ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Alamat</label>
            <div class="controls">
              <textarea name="outlet_address" placeholder="Alamat Toko"><?php echo $outlet->address ?></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Username</label>
            <div class="controls">
              <input type="text" placeholder="Username Outlet" name="outlet_username" onblur="check_username(this)" value="<?php echo $outlet->username ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Password</label>
            <div class="controls">
              <input type="password" placeholder="Password" name="outlet_password">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Margin Toko</label>
            <div class="controls">
                <div class="input-append">
                    <input type="number" placeholder="Perbedaan Dasar Harga dengan Toko Utama" name="outlet_margin" class="span11">
                    <span class="add-on">%</span>     
                </div>
            </div>
        </div>
        <div class="form-actions">
            <input type="Submit" name="submit" class="btn btn-info" value="Submit">
        </div>
        <?php echo form_close() ?>
    </div>
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