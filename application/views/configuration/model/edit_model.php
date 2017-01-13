
<div class="container-fluid">
        <div class="row-fluid">
            <a href="<?php echo base_url('configuration/model') ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar koleksi</a>
            <h2>Edit Koleksi <?php echo $model->name?></h2>
        </div>
        <?php echo form_open('configuration/edit_model/'.$model->id, array('class'=>'form-horizontal','id'=>'model_form')) ?>
        <!--Form Add category-->
        
        <div class="widget-box closed-add" id="append_model">
        <div class="widget-content">
                <div class="control-group top-control">
                    <div class="row-fluid">
                        <div class="span6">
                            <label class="control-label">Kode Model</label>
                                <div class="controls">
                                    <input type="text" placeholder="Masukkan kode untuk model (2 Huruf/Angka)" name="model_code" class="span12" value="<?php echo $model->code?>">
                                </div>
                        </div>
                        
                        <div class="span6">
                            <label class="control-label">Nama Model</label>
                            <div class="controls">
                                <input type="text" placeholder="Masukkan nama koleksi" name="model_name" class="span12" value="<?php echo $model->name?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions text-center">
                    <input type="Submit" name="submit" class="btn btn-info" value="Submit">
                </div>
        </div>
        </div>
        
        <!--End Form-->
        <?php echo form_close() ?>
</div>
<script src="<?php echo base_url() ?>js/jquery.validate.js"></script> 
<script>
$(document).ready(function(){
        $('#model_form').validate({
            rules:{
                model_code: {required: true, maxlength:2, minlength:2},
                model_name: {required: true}
            }
        });

    });
    
</script>