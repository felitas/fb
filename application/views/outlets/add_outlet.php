<div class="container-fluid">
    <div class="row-fluid">
        <a href="<?php echo base_url('outlets') ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar outlet</a>
        <h2>Tambah Outlet Baru</h2>
    </div>
    <div class="widget-box">
    <div class="widget-content nopadding">
        <div class="row-fluid">
          <div class="span12">
            <?php echo form_open('outlets/add_outlet', array('class'=>'form-horizontal')) ?>
            <div class="control-group top-control">
                <div class="span6">
                    <label class="control-label">Nama Toko</label>
                    <div class="controls">
                      <input type="text" placeholder="Nama Toko" name="outlet_name">
                    </div>    
                </div>
                <div class="span6">
                    <label class="control-label">Username</label>
                    <div class="controls">
                      <input type="text" placeholder="Username Outlet" name="outlet_username" onblur="check_username(this)">
                    </div>  
                </div>
                
            </div>
            <div class="control-group">
                <div class="span6">
                    <label class="control-label">Kode Toko</label>
                    <div class="controls">
                      <input type="text" placeholder="Masukkan Kode Toko (2 Karakter)" title="Contoh : KM" name="outlet_code">
                    </div>    
                </div>
                
                <div class="span6">
                    <label class="control-label">Password</label>
                    <div class="controls">
                      <input type="password" placeholder="Password" name="outlet_password">
                    </div>
                </div>
            </div>    
            <div class="control-group">
                <div class="span6">
                    <label class="control-label">Nama Manager Toko</label>
                    <div class="controls">
                      <input type="text" placeholder="Nama Lengkap Store Manager" name="outlet_manager">
                    </div>    
                </div>
                <div class="span6">
                    <label class="control-label">Margin Toko</label>
                    <div class="controls">
                        <div class="input-append">
                            <input type="number" placeholder="Perbedaan Dasar Harga dengan Toko Utama" name="outlet_margin" class="span11">
                            <span class="add-on">%</span>     
                        </div>
                    </div>   
                </div>
                
            </div>
            <div class="control-group">
                <label class="control-label">No. Telp</label>
                <div class="controls">
                  <input type="text" placeholder="Nomor Telephone Outlet" name="outlet_phone">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Alamat</label>
                <div class="controls">
                  <textarea name="outlet_address" placeholder="Alamat Toko"></textarea>
                </div>
            </div>
            <div class="form-actions text-center">
                <input type="Submit" name="submit" class="btn btn-info" value="Submit">
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
    </div>
  </div>    
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