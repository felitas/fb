<div class="container-fluid">
    <div class="row-fluid">
        <a href="<?php echo base_url('loan') ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar transaksi gadai</a>
        <h2>Transaksi Gadai baru</h2>
    </div>
    <div class="widget-box">
    <div class="widget-content nopadding">
        <div class="row-fluid">
            
                <?php echo form_open('loan/new_loan', array('class'=>'form-horizontal')) ?>
                <div class="control-group top-control">
                    <div class="span6">
                        <label class="control-label">Kode Gadai</label>
                        <div class="controls">
                            <input type="text" name="loan_code" value="<?php echo $loan_code ?>" readonly="readonly">
                            <input type="hidden" name="hidden_code" value="<?php echo $hidden_code ?>">
                            <input type="hidden" name="hidden_count" value="<?php echo $hidden_count ?>">            
                        </div>    
                    </div>
                    <div class="span6">
                        <label class="control-label">Sales</label>
                        <div class="controls">
                            <select name="sale_sales" id="sale_sales" class="span11">
                                <?php if ($sales==''): ?>
                                    <option value="x">Tidak ada sales di outlet ini</option>    
                                <?php else:?>
                                    <option value="choose">--Pilih Sales--</option>
                                    <?php foreach ($sales as $row): ?>
                                        <option value="<?php echo $row->workers_code ?>"><?php echo $row->name ?> - <?php echo $row->workers_code?></option>
                                    <?php endforeach ?>
                                <?php endif;?>
                            </select>
                        </div>    
                    </div>  
                </div>

                <div class="control-group">                    
                    <div class="span6">
                        <label class="control-label">Kode Customer</label>
                        <div class="controls">
                            <input type="text" name="customer_code" placeholder="Masukkan kode pelanggan" id="customer_code" onblur="get_customer(this)" class="span12">
                        </div>            
                    </div>
                    <div class="span6">
                        <label class="control-label">Customer Baru</label>
                        <div class="controls">
                            <input type="checkbox" name="new_customer" onchange="data_new_customer(this)">
                            <input type="hidden" name="hidden_customer_code" id="hidden_customer_code">
                            <input type="hidden" name="hidden_customer_count" id="hidden_customer_count">
                        </div>            
                    </div>                    
                </div>
                
            <!--///////////////////////FIELDS SHOWING CUSTOMER DATA//////////////////////////////////////////////-->
            <div class="control-group new-customer hide-field">
                <div class="span6">
                    <label class="control-label">Nama Customer</label>
                    <div class="controls">
                        <input type="text" placeholder="Nama Customer" name="customer_name" class="span12" id="customer_name">
                    </div>    
                </div>
                <div class="span6">
                    <label class="control-label">Tipe Customer</label>
                    <div class="controls">
                        <select name="customer_type" id="customer_type" class="span11">
                            <option value="Regular">Customer Biasa</option>
                            <option value="Member">Member</option>
                        </select>
                    </div>  
                </div>
            </div>

            <div class="control-group new-customer hide-field">
                <div class="span6">
                    <label for="" class="control-label">Email</label>
                    <div class="controls">
                        <input type="email" placeholder="Email Customer" name="customer_email" class="span12" id="customer_email">
                    </div>    
                </div>
                <div class="span6">
                    <label class="control-label">No. Telepon</label>
                    <div class="controls">
                        <input type="text" placeholder="Nomor Telepon Customer" name="customer_phone" class="span11" id="customer_phone">
                    </div>
                </div>   
            </div>

            <div class="control-group new-customer hide-field">
                <div class="span6">
                    <label for="" class="control-label">Alamat</label>
                    <div class="controls">
                        <textarea placeholder="Alamat Customer" name="customer_address" class="span12" id="customer_address"></textarea>
                    </div>
                </div>
                <div class="span6">
                    <label class="control-label">Tanggal Lahir</label>
                    <div class="controls">
                        <input type="date" name="customer_birthday" class="span11" id="customer_birthday">
                    </div>        
                </div>
            </div>
            <!--///////////////////////END DATA NEW CUSTOMER//////////////////////////////////////////////-->
            
                <div class="form-actions text-center">
                    <input type="submit" name="submit" class="btn btn-info" value="Submit">
                </div>
                <?php echo form_close(); ?>
            </div>
        
    </div>
    </div>
</div>

<script>
    <?php if($this->session->flashdata('customer')): ?>

       <?php echo $this->session->flashdata('customer') ?>

    <?php endif; ?>
    //FUNCTION TO INSERT NEW CUSTOMER DATA
    function data_new_customer(el){
        if($(el).is(":checked")){
            $('#customer_code').val('');
            $('#customer_name').val('');
            $('#customer_type').val('Regular').attr('selected',true);
            $('#customer_email').val('');
            $('#customer_phone').val('');
            $('#customer_address').val('');
            $('#customer_birthday').val('');
            $.ajax({
              url: "<?php echo base_url('customer/get_new_customer_code/')?>" + $(el).val(),
              type: 'GET',
              cache : false,
              success: function(result){
                
                    var data = JSON.parse(result);
                    
                    $('#customer_code').val(data.customer_code);
                    $('#hidden_customer_code').val(data.hidden_customer_code);
                    $('#hidden_customer_count').val(data.hidden_customer_count);
                    
                }
            
            });
        }
        else{
            $('#customer_code').val('');
            $('#hidden_customer_code').val('');
            $('#hidden_customer_count').val('');
            $('#customer_name').val('');
            $('#customer_type').val('Regular').attr('selected',true);
            $('#customer_email').val('');
            $('#customer_phone').val('');
            $('#customer_address').val('');
            $('#customer_birthday').val('');
        }
    }

</script>
<script type="text/javascript">
    //FUNCTION TO GET CUSTOMER DATA WHEN THE CODE IS INSERTED
    var snd = new Audio('<?php echo base_url() ?>assets/barcode.wav');
    function get_customer(el){
        if($(el).val() != ''){
            snd.play();
            $.ajax({
              url: "<?php echo base_url('customer/get_customer/')?>" + $(el).val(),
              type: 'GET',
              cache : false,
              success: function(result){
                if(result == 'not found'){
                    $.gritter.add({
                        title: 'Error',
                        text: 'Customer Tidak Ditemukan',
                        time:1200
                    });
                    $('#customer_name').val('');
                    $('#customer_type').val('');
                    $('#customer_email').val('');
                    $('#customer_phone').val('');
                    $('#customer_address').val('');
                    $('#customer_birthday').val('');
                }else{
                    var data = JSON.parse(result);
                    
                    $('#customer_name').val(data.name);
                    $('#customer_phone').val(data.phone);
                    $('#customer_email').val(data.email);
                    $('#customer_type').val(data.type).attr('selected',true);
                    $('#customer_birthday').val(data.birthday);
                    $('#customer_address').val(data.address);   

                }   
                    
                
                
              }
            
            });
        }
    }

</script>