<div class="container-fluid">
    <div class="row-fluid">
        <a href="<?php echo base_url('customer') ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar customer</a>
        <h2>Tambah Customer Baru</h2>
    </div>
    <div class="widget-box">
    <div class="widget-content nopadding">
        <div class="row-fluid">
            <div class="span12">
                <?php echo form_open('customer/add_customer', array('class'=>'form-horizontal')) ?>
                <div class="control-group top-control">
                    <label class="control-label">Nama Customer</label>
                    <div class="controls">
                        <input type="text" placeholder="Nama Customer" name="customer_name">
                    </div>        
                </div>
                <div class="control-group top-control">
                    <label class="control-label">Tanggal Lahir</label>
                    <div class="controls">
                        <input type="date" name="customer_birthday">
                    </div>        
                </div>
                <div class="control-group">
                    <label class="control-label">Jenis Customer</label>
                    <div class="controls">
                        <select name="customer_type" id="">
                            <option value="Regular">Customer Biasa</option>
                            <option value="Member">Member</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">No. Telepon</label>
                    <div class="controls">
                        <input type="text" placeholder="Nomor Telepon Customer" name="customer_phone" class="tip-bottom">
                    </div>
                </div>
                <div class="control-group">
                    <label for="" class="control-label">Email</label>
                    <div class="controls">
                        <input type="email" placeholder="Email Customer" name="customer_email" class="tip-bottom">
                    </div>
                </div>
                <div class="control-group">
                    <label for="" class="control-label">Alamat</label>
                    <div class="controls">
                        <textarea placeholder="Alamat Customer" name="customer_address"></textarea>
                    </div>
                </div>
                <?php if($role=='admin'):?>
                    <div class="control-group">
                        <label for="" class="control-label">Grade</label>
                        <div class="controls">
                            <select name="customer_grade" id="">
                                <option value="regular">Regular</option>
                                <option value="gold">Gold</option>
                                <option value="platinum">Platinum</option>
                            </select>
                        </div>
                    </div>
                <?php endif?>
                <div class="form-actions text-center">
                    <input type="submit" name="submit" class="btn btn-info" value="Submit">
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    </div>
</div>

<script>
    <?php if($this->session->flashdata('customer')): ?>

       <?php echo $this->session->flashdata('customer') ?>

    <?php endif; ?>
</script>