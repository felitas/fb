
<div class="container-fluid">
    <div class="row-fluid">
        <a href="<?php echo base_url('sales') ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar sales</a>
        <h2>Tambah Sales Baru</h2>
    </div>
    <div class="widget-box">
    <div class="widget-content nopadding">
    <?php echo form_open_multipart('sales/add_sales',array('class'=>'form-horizontal','id'=>'salesform')) ?>    
    <div class="row-fluid">
        <div class="span12">
            <div class="control-group top-control">
                <div class="span6">
                    <label for="" class="control-label">Nama Sales</label>
                    <div class="controls">
                        <input type="text" placeholder="Nama Lengkap Sales" name="sales_name" class="span12">
                    </div>
                </div>
                <div class="span6">
                    <label for="" class="control-label">Username</label>
                    <div class="controls">
                        <input type="text" placeholder="Username Sales" onblur="check_username(this)" name="sales_username" id="sales_username" class="span11"> 
                    </div>    
                </div>
            </div>
            <div class="control-group">
                <div class="span6">
                    <label for="" class="control-label">Upload Photo</label>
                    <div class="controls">
                        <input type="file" name="">
                    </div>
                </div>
                <div class="span6">
                    <label for="" class="control-label">Password</label>
                    <div class="controls">
                        <input type="password" placeholder="Password Sales" name="sales_password" class="span11"> 
                    </div>        
                </div>
            </div>
            <div class="control-group">
            <?php if (!$is_mobile): ?>
                <div class="span6">
                    <label for="" class="control-label">Ambil Foto</label>
                    <div class="controls">
                        <input type="checkbox" onchange="show_cam(this)">
                    </div>    
                </div>
            <?php endif ?>        
                <div class="span6">
                    <label for="" class="control-label">Email</label>
                    <div class="controls">
                        <input type="email" placeholder="Email Sales" name="sales_email" class="span11"> 
                    </div>
                </div>
            </div>
            <div class="control-group text-center" id="snapshot" style="display: none">
                <div class="span6">
                    <div id="my_camera" style="width:320px; height:240px; margin:auto"></div>
                    <a style="margin-top: 10px;margin-bottom: 10px;" class="btn btn-info bg_ls" href="javascript:void(take_snapshot())"><span class="mif mif-camera"></span> Ambil Foto</a>    
                </div>
                <div class="span6">
                    <div id="my_result" style="margin:auto"></div>        
                </div>            
                
            </div>
            
            <div class="control-group">
                <div class="span6">
                    <label for="" class="control-label">No. Telepon</label>
                    <div class="controls">
                        <input type="text" placeholder="Nomor Telephone Sales" name="sales_phone" class="span12"> 
                    </div>    
                </div>
                <div class="span6">
                    <label for="" class="control-label">Tempat Bekerja</label>
                    <div class="controls">
                        <select name="sales_outlet" id="" class="span11">
                            <option value="" selected="selected">--Pilih Outlet--</option>
                            <?php foreach ($outlets as $outlet): ?>
                                <option value="<?php echo $outlet->id ?>"><?php echo $outlet->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="span6">
                    <label for="" class="control-label">Kode Sales</label>
                    <div class="controls">
                        <input type="text" placeholder="Kode sebagai identitas sales" name="sales_code" id="sales_code" class="span12" onblur="check_code(this)"> 
                    </div>    
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Alamat</label>
                <div class="controls">
                    <textarea name="sales_address" placeholder="Alamat Sales" id="" cols="30" rows="6" class="span11"></textarea> 
                </div>
            </div>
        </div>
        
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="form-actions text-center">
                <input type="submit" name="submit" class="btn btn-info" value="Submit">
            </div>
        </div>    
    </div>
    <?php echo form_close() ?>
    </div></div>
</div>

<script src="<?php echo base_url() ?>js/webcam.min.js"></script>
<script src="<?php echo base_url() ?>js/jquery.validate.js"></script> 

<script>
    $(document).ready(function(){
        $('#salesform').validate({
            rules:{
                sales_name:"required",
                sales_username:"required",
                sales_password:"required",
                sales_code:"required"
            }
        });
    });
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
                    $.gritter.add({
                        title: 'Error !',
                        text: 'Username sudah terpakai',
                        sticky: false
                    });
                    $('#sales_username').val('');
                }else{
                    $.gritter.add({
                        class_name:'gritter-light',
                        title: 'Success !',
                        text: 'Username bisa dipakai',
                        sticky: false
                    });
                }
              }
            });    
        }
    }
</script>
<script>
    function check_code(el){
        if($(el).val() != ''){
            $.ajax({
              url: "<?php echo base_url('sales/check_sales_code/')?>" + $(el).val(),
              type: 'GET',
              cache : false,
              success: function(result){
                if(result == 'taken'){
                    $.gritter.add({
                        title: 'Error !',
                        text: 'Code sudah diambil',
                        sticky: false
                    });
                    $('#sales_code').val('');
                }else{
                    $.gritter.add({
                        class_name:'gritter-light',
                        title: 'Success !',
                        text: 'Code bisa dipakai',
                        sticky: false
                    });
                }
              }
            });    
        }
    }
</script>
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