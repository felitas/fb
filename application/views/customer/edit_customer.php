<div id="content-header">
    <div id="breadcrumb">
        <a href="<?php echo base_url('customer') ?>">
        <span class="fa-arrow-circle-o-left"></span>Kembali ke daftar customer
        </a>
    </div>
</div>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <?php echo form_open('customer/edit_customer/'.$customer->id, array('class'=>'form-horizontal')) ?>
            <div class="control-group">
                <label for="" class="control-label">Nama Customer</label>
                <div class="controls">
                    <input type="text" placeholder="Nama Customer" name="customer_name" value="<?php echo $customer->name ?>" class="tip-bottom">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Jenis Customer</label>
                <div class="controls">
                    <select name="" id="">
                        <option value="Regular" <?php echo ($customer->type == 'Regular') ? 'selected' : '' ?> >Customer Biasa</option>
                        <option value="Member" <?php echo ($customer->type == 'Member') ? 'selected' : '' ?> >Member</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">No. Telepon</label>
                <div class="controls">
                    <input type="text" placeholder="Nomor Telepon Customer" name="customer_phone" value="<?php echo $customer->phone ?>" class="tip-bottom">
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Email</label>
                <div class="controls">
                    <input type="email" placeholder="Email Customer" name="customer_email" value="<?php echo $customer->email ?>" class="tip-bottom">
                </div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Alamat</label>
                <div class="controls">
                    <textarea placeholder="Alamat Customer" name="customer_address"><?php echo $customer->address?></textarea>
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

    <?php if($this->session->flashdata('customer')): ?>

       <?php echo $this->session->flashdata('customer') ?>

    <?php endif; ?>
</script>