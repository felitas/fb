<style>
    .image-frame{
        height: 150px !important;
        width: 150px !important;
        margin: auto;
    }
</style>
<div class="container">
    <div class="grid">
        <div class="row">
            <div class="cell">
                <h3 style="display:inline-block"><small><a href="<?php echo base_url('sales') ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar sales</a></small></h3>

            </div>
        </div>

        <div class="row form-title" style="margin-bottom: 0">     
            <div class="cell">
                <h1 style="margin-bottom: 20px;">Edit Sales <?php echo ucfirst($sales->name) ?></h1>
                <hr class="bg-primary"> 
            </div>
        </div>

    <?php //echo form_open_multipart('sales/add_sales',array('data-role' =>  'validator','data-on-error-input' => 'notifyOnErrorInput','data-show-error-hint' => 'false')) ?>
    <?php echo form_open_multipart('sales/edit_sales/'.$sales->id,array('data-role' =>  'validator','data-on-error-input' => 'notifyOnErrorInput','data-show-error-hint' => 'false')) ?>
        <div class="row">
            <div class="cell">
                <a href="<?php echo base_url().$sales->photo ?>" rel="group" class="fancybox"><img src="<?php echo base_url().$sales->photo ?>?timestamp=<?php echo rand(0,999999) ?>" data-role="fitImage" data-format="cycle"></a>
            </div>
        </div>    
        <div class="row cells2">
            <div class="cell">
                <label>Nama</label>
                <div class="input-control text full-size" data-role="input">
                    <input type="text" placeholder="Nama Lengkap" name="sales_name" value="<?php echo $sales->name ?>" data-validate-func="required" data-validate-hint="Nama sales harus diisi">
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
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
                    
                    <a class="button info bg-primary btn-teal" href="javascript:void(take_snapshot())"><span class="mif mif-camera"></span> Take Snapshot</a>
                </div>
                <div class="cell text-center">
                    <div id="my_result" style="margin:auto"></div>    
                </div>
                
                
            </div>    
        <?php endif ?>
        

        <div class="row cells2">
            <div class="cell">
                <label>No. Telp</label>
                <div class="input-control text full-size" data-role="input">
                    <input type="text" placeholder="Nomor Telephone Sales" name="sales_phone" value="<?php echo $sales->phone ?>">
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
            </div>
            <div class="cell">
                <label>E-mail</label>
                <div class="input-control text full-size" data-role="input" >
                    <input type="text" placeholder="Email Sales" name="sales_email" value="<?php echo $sales->email ?>">
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="cell">
                <label>Alamat</label>
                <div class="input-control textarea full-size" data-role="input" data-text-auto-resize="true">
                    <textarea placeholder="Alamat Sales" name="sales_address"><?php echo $sales->address ?></textarea>
                </div>
            </div>
        </div>

        <div class="row cells2">
            <div class="cell">
                <label>Username</label>
                <div class="input-control text full-size" data-role="input" style="margin-top: 9px;">
                    <input type="text" placeholder="Username Sales" onblur="check_username(this)" value="<?php echo $sales->username ?>" name="sales_username" data-validate-func="required" data-validate-hint="Username harus diisi">
                    
                </div>
            </div>
            <div class="cell">
                <label class="switch">
                    <input type="checkbox" onchange="change_password(this)">
                    <span class="check"></span>
                    <span class="caption"> Ubah Password</span>
                </label>
                <div class="input-control password full-size" data-role="input" style="display: none">
                    <input type="password" id="password" placeholder="Password" name="sales_password">
                    <button class="button helper-button reveal"><span class="mif-looks"></span></button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="cell">
                <label>Tempat Bekerja</label>
                <div class="input-control select full-size">
                    <select data-validate-func="required" data-validate-hint="Nama toko harus diisi" name="sales_outlet">
                        <option value="" selected="selected">--Pilih Outlet--</option>
                        <?php foreach ($outlets as $outlet): ?>
                            <option value="<?php echo $outlet->id ?>" <?php echo ($outlet->id == $sales->outlet_id) ? 'selected' : '' ?>><?php echo $outlet->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>    
            </div>
        </div>

        <div class="row">
            <div class="cell text-center">
               <input type="submit" name="submit" class="button bg-primary" value="Submit">
            </div>
        </div>
    </form>
        
    </div>
</div>


<link rel="stylesheet" href="<?php echo base_url() ?>fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url() ?>fancybox/source/jquery.fancybox.pack.js"></script>

<script>
    $(document).ready(function(){
        $('.fancybox').fancybox();
    });
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