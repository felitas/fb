<div class="container-fluid">
        <div class="row-fluid">
            <a href="<?php echo base_url('configuration/sales_target') ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar target</a>
            <h2>Edit Target <?php echo $target->name?></h2>
        </div>
        <?php echo form_open('configuration/edit_target/'.$target->id, array('class'=>'form-horizontal','id'=>'target_form')) ?>
        <!--Form Add category-->
        
        <div class="widget-box closed-add" id="append_model">
        <div class="widget-content">
            <div class="control-group top-control">
                <div class="row-fluid">
                    <div class="span6">
                        <label class="control-label">Nama target</label>
                            <div class="controls">
                                <input type="text" placeholder="Masukkan nama untuk target ini" name="target_name" class="span12" value="<?php echo $target->name?>">
                            </div>
                    </div>
                    
                    <div class="span6">
                        <label class="control-label">Jumlah transaksi berhasil/Bulan</label>
                        <div class="controls">
                            <input type="text" placeholder="Masukkan target jumlah transaksi minimum" name="target_amount" class="span12" value="<?php echo $target->target?>">
                        </div>
                    </div>
                </div>
                <div class="row-fluid"> 
                    <label class="control-label">Deskripsi target</label>
                    <div class="controls">
                        <textarea class="span12" name="target_desc" placeholder="Keterangan dari bonus atau hasil target"><?php echo $target->description?></textarea>
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
    $('#target_form').validate({
        rules:{
            target_name:"required",
            target_amount:"required"
        }
    });
    
});
</script>