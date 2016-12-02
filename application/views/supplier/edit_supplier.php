<div class="container">
    <div class="grid">

        <div class="row">
            <div class="cell">
                <h3 style="display:inline-block"><small><a href="<?php echo base_url('supplier') ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar supplier</a></small></h3>
            </div>
        </div>
        <div class="row form-title" style="margin-bottom: 0">     
            <div class="cell">
                <h1 style="margin-bottom: 20px;">Edit Supplier <?php echo ucfirst($supplier->name) ?></h1>
                <hr class="bg-primary"> 
            </div>
        </div>
        <?php echo form_open('supplier/edit_supplier/'.$supplier->id,array('data-role' =>  'validator','data-on-error-input' => 'notifyOnErrorInput','data-show-error-hint' => 'false'));?>
        <div class="row">
            <div class="cell">
                <label>Nama Supplier</label>
                <div class="input-control text full-size">
                    <input type="text" placeholder="Nama Supplier" data-validate-func="required" data-validate-hint="Nama supplier harus diisi" name="supplier_name" value="<?php echo $supplier->name ?>">
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
            </div>
        </div>

        <div class="row cells2">
            <div class="cell">
                <label>No. Telp</label>
                <div class="input-control text full-size" data-role="input">
                    <input type="text" placeholder="Nomor Telephone Supplier" name="supplier_phone" data-validate-func="digits" data-validate-hint="No. telp hanya terdiri dari angka" value="<?php echo $supplier->phone ?>">
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
            </div>
            <div class="cell">
                <label>E-mail</label>
                <div class="input-control text full-size" data-role="input">
                    <input type="email" placeholder="Email Supplier" name="supplier_email" value="<?php echo $supplier->email ?>">
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="cell">
                <label>Alamat</label>
                <div class="input-control textarea full-size" data-role="input" data-text-auto-resize="true">
                    <textarea name="supplier_address"><?php echo $supplier->address ?></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="cell">
                <label>Keterangan</label>
                <div class="input-control text full-size">
                    <input type="text" placeholder="Keterangan Supplier" name="supplier_desc" value="<?php echo $supplier->description ?>">
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="cell text-center">
                <input type="Submit" class="button bg-primary" value="Submit" name="submit">
            </div>
        </div>

        <?php echo form_close()?>
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