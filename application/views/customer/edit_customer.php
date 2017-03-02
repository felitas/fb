
<div class="container-fluid">
    <div class="row-fluid">
        <a href="<?php echo base_url('customer') ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar customer</a>
        <h2>Edit Customer</h2>
    </div>
    <div class="widget-box">
    <div class="widget-content nopadding">
        <div class="row-fluid">
            <div class="span12">
                <?php echo form_open('customer/edit_customer/'.$customer->id, array('class'=>'form-horizontal')) ?>
                <div class="control-group top-control">
                    <label for="" class="control-label">Nama Customer</label>
                    <div class="controls">
                        <input type="text" placeholder="Nama Customer" name="customer_name" value="<?php echo $customer->name ?>" class="span11">
                    </div>
                </div>
                <div class="control-group">
                    <div class="span6">
                        <label for="" class="control-label">No KTP</label>
                        <div class="controls">
                            <input type="text" placeholder="No KTP customer" name="customer_ktp" value="<?php echo $customer->ktp ?>" class="span11">
                        </div>    
                    </div>
                    <div class="span6">
                        <label for="" class="control-label">Birthday</label>
                        <div class="controls">
                            <input type="date" name="customer_birthday" value="<?php echo $customer->birthday ?>" class="span11">
                        </div>    
                    </div>                    
                </div>
                <div class="control-group">
                    <div class="span6">
                        <label class="control-label">Jenis Customer</label>
                        <div class="controls">
                            <select name="customer_type" id="" class="span12">
                                <option value="Regular" <?php echo ($customer->type == 'Regular') ? 'selected' : '' ?> >Customer Biasa</option>
                                <option value="Member" <?php echo ($customer->type == 'Member') ? 'selected' : '' ?> >Member</option>
                            </select>
                        </div>
                    </div>
                    <?php if($role=='admin'):?>
                    <div class="span6">
                        <div class="control-group">
                            <label for="" class="control-label">Grade</label>
                            <div class="controls">
                                <select name="customer_grade" id="" class="span11">
                                    <?php foreach ($grades as $grade): ?>
                                        <option value="<?php echo $grade->id?>" <?php echo ($customer->grade == $grade->id) ? 'selected' : '' ?>><?php echo $grade->name?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php endif?>
                    
                    
                </div>

                <div class="control-group">
                    <div class="span6">
                        <label class="control-label">No. Telepon</label>
                        <div class="controls">
                            <input type="text" placeholder="Nomor Telepon Customer" name="customer_phone" value="<?php echo $customer->phone ?>" class="span12">
                        </div>    
                    </div>
                    <div class="span6">
                        <div class="control-group">
                            <label for="" class="control-label">Email</label>
                            <div class="controls">
                                <input type="email" placeholder="Email Customer" name="customer_email" value="<?php echo $customer->email ?>" class="span11">
                            </div>
                        </div>  
                    </div>
                </div>

                <div class="control-group">
                    <label for="" class="control-label">Alamat</label>
                    <div class="controls">
                        <textarea placeholder="Alamat Customer" name="customer_address" class="span11"><?php echo $customer->address?></textarea>
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