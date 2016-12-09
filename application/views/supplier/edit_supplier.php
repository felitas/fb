<div class="container-fluid">
    <div class="row-fluid">
        <a href="<?php echo base_url('supplier') ?>"><span class="fa fa-arrow-circle-o-left"></span>Kembali ke daftar supplier</a>
        <h2>Edit Supplier</h2>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <?php echo form_open('supplier/edit_supplier/'.$supplier->id,array('class'=>'form-horizontal')) ?>
            <div class="control-group">
                <label for="" class="control-label">Nama Supplier</label>
                <div class="controls">
                    <input type="text" placeholder="Nama Supplier" name="supplier_name" value="<?php echo $supplier->name ?>" class="tip-bottom">
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">No. Telepon</label>
                <div class="controls">
                    <input type="text" placeholder="Nomor Telepon Supplier" name="supplier_phone" value="<?php echo $supplier->phone ?>" class="tip-bottom">
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Email</label>
                <div class="controls">
                    <input type="email" placeholder="Email Supplier" name="supplier_email" value="<?php echo $supplier->email ?>" class="tip-bottom">
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Alamat</label>
                <div class="controls">
                    <textarea name="supplier_address" placeholder="Alamat Supplier" id="" cols="30" rows="10"><?php echo $supplier->address ?></textarea>
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Keterangan</label>
                <div class="controls">
                    <input type="text" placeholder="Keterangan Supplier" name="supplier_desc" value="<?php echo $supplier->description ?>" class="tip-bottom">
                </div>
            </div>
            <div class="form-actions">
                <input type="submit" name="submit" class="btn btn-info" value="Submit">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
    function notifyOnErrorInput(input){
        var message = input.data('validateHint');
        $.Notify({
            caption: 'Error',
            content: message,
            type: 'alert'
        });
    }

    <?php if($this->session->flashdata('supplier')): ?>

       <?php echo $this->session->flashdata('supplier') ?>

    <?php endif; ?>
</script>