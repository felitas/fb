<div class="container-fluid">
        <div class="row-fluid">
            <a href="<?php echo base_url('configuration/category') ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar kategori</a>
            <h2>Edit Kategori <?php echo ucfirst($category->name) ?></h2>
        </div>
        <?php echo form_open('configuration/edit_category/'.$category->id, array('class'=>'form-horizontal','id'=>'category_form')) ?>
        <div class="widget-box closed-add" id="append_category">
        <div class="widget-content">
                <div class="control-group top-control">
                    <div class="row-fluid">
                        <label class="control-label">Tipe Produk</label>
                        <div class="controls">
                            <select class="span12" name="category_type">
                                <?php foreach ($types as $type): ?>
                                    <option value="<?php echo $type->id ?>" <?php echo ($category->type_id==$type->id)?'selected':'' ?> ><?php echo $type->name?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="control-group top-control">
                    <div class="row-fluid">
                        <div class="span6">
                            <label class="control-label">Kode Kategori</label>
                                <div class="controls">
                                    <input type="text" placeholder="Masukkan kode untuk kategori (1 Huruf/Angka)" name="category_code" class="span12"  value="<?php echo $category->code?>">
                                </div>
                        </div>
                        
                        <div class="span6">
                            <label class="control-label">Nama Kategori</label>
                            <div class="controls">
                                <input type="text" placeholder="Masukkan nama kategori" name="category_name" class="span12" value="<?php echo $category->name?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions text-center">
                    <input type="Submit" name="submit" class="btn btn-info" value="Submit">
                </div>
            </div>
        </div>
        <?php echo form_close()?>
</div>
<script src="<?php echo base_url() ?>js/jquery.validate.js"></script> 
<script>
$(document).ready(function(){
        $('#category_form').validate({
            rules:{
                category_code: {required: true, maxlength:1},
                category_name: {required: true}
            }
        });

    });
    
</script>