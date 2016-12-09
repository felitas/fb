
<div class="container-fluid">
    <div class="row-fluid">
        <a href="<?php echo base_url('supplier') ?>"><span class="fa fa-arrow-circle-o-left"></span>Kembali ke daftar supplier</a>
        <h2>Tambah Supplier</h2>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <?php echo form_open('supplier/add_supplier',array('class'=>'form-horizontal')) ?>
            <div class="control-group">
                <label for="" class="control-label">Nama Supplier</label>
                <div class="controls">
                    <input type="text" placeholder="Nama Supplier" name="supplier_name" class="tip-bottom">
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">No. Telepon</label>
                <div class="controls">
                    <input type="text" placeholder="Nomor Telepon Supplier" name="supplier_phone" class="tip-bottom">
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Email</label>
                <div class="controls">
                    <input type="email" placeholder="Email Supplier" name="supplier_email" class="tip-bottom">
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Alamat</label>
                <div class="controls">
                    <textarea name="supplier_address" placeholder="Alamat Supplier" id="" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Keterangan</label>
                <div class="controls">
                    <input type="text" placeholder="Keterangan Supplier" name="supplier_desc" class="tip-bottom">
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