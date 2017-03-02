<div class="container-fluid">
    <div class="row-fluid">
        <a href="<?php echo base_url('customer') ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar customer</a>
        <h2>Tambah Customer Baru</h2>
    </div>
    <div class="widget-box">
    <div class="widget-content nopadding">
        <div class="row-fluid">
            
                <?php echo form_open('customer/add_customer', array('class'=>'form-horizontal', 'id'=>'customerform')) ?>
                <div class="control-group top-control">
                    <label class="control-label">Nama Customer</label>
                    <div class="controls">
                        <input type="text" placeholder="Nama Customer" name="customer_name" class="span11">
                    </div>
                </div>
                <div class="control-group">
                    <div class="row-fluid">
                        <div class="span6">
                            <label class="control-label">No KTP</label>
                            <div class="controls">
                                <input type="text" name="customer_ktp" class="span12" placeholder="Nomor KTP customer">
                            </div>            
                        </div>    
                        <div class="span6">
                            <label class="control-label">Tanggal Lahir</label>
                            <div class="controls">
                                <input type="date" name="customer_birthday" class="span11">
                            </div>
                        </div>
                    </div>                   
                </div>

                <div class="control-group">
                    <div class="row-fluid">
                        <div class="span6">
                            <label class="control-label">Jenis Customer</label>
                            <div class="controls">
                                <select name="customer_type" id="" class="span12">
                                    <option value="Regular">Customer Biasa</option>
                                    <option value="Member">Member</option>
                                </select>
                            </div>  
                        </div>
                        <div class="span6">
                            <?php if($role=='admin'):?>
                                    <label for="" class="control-label">Grade</label>
                                    <div class="controls">
                                        <select name="customer_grade" id="" class="span11">    
                                            <?php foreach ($grades as $grade): ?>
                                                <option value="<?php echo $grade->id?>"><?php echo $grade->name?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                            <?php else:?>
                                <input type="hidden" name="customer_grade" value="1">
                            <?php endif?>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="row-fluid">
                        <div class="span6">
                            <label for="" class="control-label">Email</label>
                            <div class="controls">
                                <input type="email" placeholder="Email Customer" name="customer_email" class="span12">
                            </div>        
                        </div>
                        <div class="span6">
                            <label class="control-label">No. Telepon</label>
                            <div class="controls">
                                <input type="text" placeholder="Nomor Telepon Customer" name="customer_phone" class="span11">
                            </div>        
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label for="" class="control-label">Alamat</label>
                    <div class="controls">
                        <textarea placeholder="Alamat Customer" name="customer_address" class="span11"></textarea>
                    </div>                           
                </div>
 
                
                <div class="form-actions text-center">
                    <input type="submit" name="submit" class="btn btn-info" value="Submit">
                </div>
                <?php echo form_close(); ?>
            </div>
        
    </div>
    </div>
</div>
<script src="<?php echo base_url() ?>js/jquery.validate.js"></script>
<script>
$(document).ready(function(){
    $('#customerform').validate({
        rules:{
            customer_name: "required",
            customer_ktp: "required",
            customer_birthday: "required",
            customer_type: "required",
            customer_address: "required"
        }
    });
});
    <?php if($this->session->flashdata('customer')): ?>

       <?php echo $this->session->flashdata('customer') ?>

    <?php endif; ?>
</script>