<div id="content-header">
    <div id="breadcrumb">
        <a href="<?php echo base_url('sales') ?>">
        <span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar sales
        </a>
    </div>
    <h1 style="margin-bottom: 20px;">Tambah Sales Baru</h1>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <?php echo form_open_multipart('sales/add_sales',array('class'=>'form-horizontal')) ?>    
            <div class="control-group">
                <label for="" class="control-label">Nama Sales</label>
                <div class="controls">
                    <input type="text" placeholder="Nama Lengkap Sales" name="sales_name" class="tip-bottom">
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Upload Photo</label>
                <div class="controls">
                    <input type="file" accept="image/*" name="capture" id="capture" capture="camera">
                </div>
            </div>
            <?php if (!$is_mobile): ?>
            <div class="control-group">
                <label for="" class="control-label">Ambil Foto</label>
                <div class="controls">
                    <input type="checkbox" onchange="show_cam(this)">
                </div>
            </div>
            <div class="control-group" id="snapshot" style="display: none">
                <div id="my_camera" style="width:320px; height:240px; margin:auto"></div>
                <a class="button info bg-primary btn-teal" href="javascript:void(take_snapshot())"><span class="mif mif-camera"></span> Ambil Foto</a>
                <div id="my_result" style="margin:auto"></div>    
            </div>
            <?php endif ?>        
            <div class="control-group">
                <label for="" class="control-label">No. Telepon</label>
                <div class="controls">
                    <input type="text" placeholder="Nomor Telephone Sales" name="sales_phone" class="tip-bottom"> 
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Email</label>
                <div class="controls">
                    <input type="text" placeholder="Email Sales" name="sales_email" class="tip-bottom"> 
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Alamat</label>
                <div class="controls">
                    <textarea name="sales_address" placeholder="Alamat Sales" id="" cols="30" rows="10"></textarea> 
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Username</label>
                <div class="controls">
                    <input type="text" placeholder="Username Sales" onblur="check_username(this)" name="sales_username" class="tip-bottom"> 
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Password</label>
                <div class="controls">
                    <input type="text" placeholder="Password Sales" name="sales_password" class="tip-bottom"> 
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Tempat Bekerja</label>
                <div class="controls">
                    <select name="sales_outlet" id="">
                        <option value="" selected="selected">--Pilih Outlet--</option>
                        <?php foreach ($outlets as $outlet): ?>
                            <option value="<?php echo $outlet->id ?>"><?php echo $outlet->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <input type="submit" name="submit" class="btn btn-info" value="Submit">
            </div>
            <?php echo form_close() ?>
        </div>    
    </div>
</div>

<script src="<?php echo base_url() ?>js/webcam.min.js"></script>

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

    <?php if($this->session->flashdata('sales')): ?>

       <?php echo $this->session->flashdata('sales') ?>

    <?php endif; ?>


</script>

<script language="JavaScript">
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            document.getElementById('my_result').innerHTML = '<img src="'+data_uri+'"/>';
            Webcam.upload( data_uri, "<?php echo base_url('sales/upload') ?>", function(code, text) {
            } );    
        } );
        
    }
</script>