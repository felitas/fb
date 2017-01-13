
<div class="container-fluid">
        <div class="row-fluid">
            <a href="<?php echo base_url('configuration/diamond_type') ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar tipe diamond</a>
            <h2>Edit Tipe Diamond <?php echo ucfirst($diamond_type->name) ?></h2>
        </div>
        <?php echo form_open('configuration/edit_diamond_type/'.$diamond_type->id, array('class'=>'form-horizontal','id'=>'diamond_type_form')) ?>
        <div class="widget-box">	 
            <div class="widget-content">
                <div class="control-group top-control">
                <div class="row-fluid">
                    <div class="span6">
                        <label class="control-label">Kode Tipe Diamond</label>
                        <div class="controls">
                            <input type="text" placeholder="Masukkan 2 karakter kode untuk tipe produk" name="diamond_type_code" class="span12" value="<?php echo $diamond_type->code?>">
                        </div>
                    </div>
                    <div class="span6">
                        <label class="control-label">Tipe Diamond</label>
                        <div class="controls">
                            <input type="text" placeholder="Masukkan keterangan tipe produk" name="diamond_type_name" class="span12" value="<?php echo $diamond_type->name?>">
                        </div>
                    </div>
                </div>
                <div class="form-actions text-center">
                    <input type="Submit" name="submit" class="btn btn-primary" value="Submit"> 
                </div>
            </div>
        </div>
        <?php echo form_close() ?>
</div>
<script src="<?php echo base_url() ?>js/jquery.validate.js"></script> 
<script>
$(document).ready(function(){
        $('#diamond_type_form').validate({
            rules:{
                diamond_type_code: {required: true, maxlength:2},
                diamond_type_name: {required: true}
            }
        });

    });
    
</script>