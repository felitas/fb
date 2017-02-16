<div class="container-fluid">
        <div class="row-fluid">
            <a href="<?php echo base_url('configuration/customer_settings') ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar grade customer</a>
            <h2>Edit Grade <?php echo $grade->name?></h2>
        </div>
        <?php echo form_open('configuration/edit_grade/'.$grade->id, array('class'=>'form-horizontal','id'=>'grade_form')) ?>
        <!--Form Add category-->
        
        <div class="widget-box closed-add" id="append_model">
        <div class="widget-content">
            <div class="control-group top-control">
                <div class="row-fluid">
                    <label class="control-label">Nama Grade</label>
                        <div class="controls">
                            <input type="text" placeholder="Masukkan nama untuk grade ini" name="grade_name" class="span12" value="<?php echo $grade->name?>">
                        </div>
                </div>
                <div class="row-fluid"> 
                    <label class="control-label">Nominal Total Transaksi Untuk Mencapai Grade</label>
                    <div class="controls">
                        <input type="number" placeholder="Masukkan nama untuk grade ini" name="grade_amount" class="span12" value="<?php echo $grade->target?>">
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
    $('#grade_form').validate({
        rules:{
            grade_name:"required",
            grade_amount:"required"
        }
    });
    
});
</script>