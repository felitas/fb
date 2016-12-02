<div class="container">
    <div class="grid">

        <div class="row">
            <div class="cell">
                <h3 style="display:inline-block"><small><a href="<?php echo base_url('customer') ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar customer</a></small></h3>
            </div>
        </div>

        <div class="row form-title" style="margin-bottom: 0">     
            <div class="cell">
                <h1 style="margin-bottom: 20px;">Edit Customer <?php echo ucfirst($customer->name) ?></h1>
                <hr class="bg-primary"> 
            </div>
        </div>

        <?php echo form_open('customer/edit_customer/'.$customer->id,array('data-role' =>  'validator','data-on-error-input' => 'notifyOnErrorInput','data-show-error-hint' => 'false')) ?>

        <div class="row cells2">
            <div class="cell">
                <label>Nama Customer</label>
                <div class="input-control text full-size">
                    <input type="text" placeholder="Nama Customer" name="customer_name" value="<?php echo $customer->name ?>" data-validate-func="required" data-validate-hint="Nama customer harus diisi">
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
            </div>
            <div class="cell">
                <label>Jenis Customer</label>
                <div class="input-control select full-size">
                    <select name="customer_type" data-validate-func="required" data-validate-hint="Jenis customer harus diisi">
                        <option value="Regular" <?php echo ($customer->type == 'Regular') ? 'selected' : '' ?> >Customer Biasa</option>
                        <option value="Member" <?php echo ($customer->type == 'Member') ? 'selected' : '' ?> >Member</option>
                    </select>
                </div>         
            </div>
        </div>

        <div class="row cells2">
            <div class="cell">
                <label>No. Telp</label>
                <div class="input-control text full-size" data-role="input">
                    <input type="text" placeholder="Nomor Telephone Customer" name="customer_phone" value="<?php echo $customer->phone ?>">
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
            </div>
            <div class="cell">
                <label>E-mail</label>
                <div class="input-control text full-size" data-role="input" >
                    <input type="text" placeholder="Email Customer" name="customer_email" value="<?php echo $customer->email ?>">
                    <button class="button helper-button clear"><span class="mif-cross"></span></button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="cell">
                <label>Alamat</label>
                <div class="input-control textarea full-size" data-role="input" data-text-auto-resize="true">
                    <textarea name="customer_address"><?php echo $customer->address ?></textarea>
                </div>
            </div>
        </div>  

        <div class="row">
            <div class="cell text-center">
                <input type="submit" class="button bg-primary" name="submit" value="Submit">
            </div>
        </div>

        <?php echo form_close(); ?>

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

    <?php if($this->session->flashdata('customer')): ?>

       <?php echo $this->session->flashdata('customer') ?>

    <?php endif; ?>
</script>