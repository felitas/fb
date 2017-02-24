<!--Both are css for alertify-->
<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">
<!--selectize-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/selectize.css')?>">
<style type="text/css">
    .btn-warning{
        float: right !important;
        color: white !important;
        background-color: rgba(26, 188, 156,1.0) !important;
    }
    .btn-warning:hover{
        background-color: rgba(52, 152, 219,1.0) !important;   
    }
    .item-title{
        background-color: #f1c40f !important;
    }
</style>

<div class="container-fluid">
    <div class="row-fluid">
        <a href="<?php echo base_url('loan') ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar transaksi gadai</a>
        <h2>Transaksi Gadai baru</h2>
    </div>
    <?php echo form_open('loan/new_loan', array('class'=>'form-horizontal')) ?>
    <div class="widget-box">
    <div class="widget-content nopadding">
        <div class="row-fluid">
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
                            <select name="loan_sales" id="loan_sales" class="span11">
                                <?php if ($sales==''): ?>
                                    <option value="x">Tidak ada sales di outlet ini</option>    
                                <?php else:?>
                                    <option value="choose">Ketik/Scan Kode Sales</option>
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
                        <label class="control-label">Date</label>
                        <div class="controls">
                            <input type="date" name="loan_start" class="span12" id="dateStart">
                        </div>
                    </div>
                    <div class="span6">
                        <label class="control-label">Due Date</label>
                        <div class="controls">
                            <input type="date" name="loan_due" class="span11" id="dateDue">
                        </div>
                    </div>
                </div>
                <?php if (!$is_mobile): ?>
                <div class="control-group">                
                    <div class="span6">
                        <label for="" class="control-label">Upload Photo</label>
                        <div class="controls">
                            <input type="file" accept="image/*" name="capture" id="capture" capture="camera">
                        </div>  
                    </div>
                    <div class="span6">
                        <label class="control-label">Ambil Foto</label>
                        <div class="controls">
                            <input type="checkbox" onchange="show_cam(this)">
                            <span class="check"></span>
                        </div>
                    </div>
                </div>
                <!--CAN ONLY TAKE PHOTO WITH LAPTOP WEBCAM-->
                <div class="control-group text-center" id="snapshot" style="display: none">
                    <div class="span6">
                        <div id="my_camera" style="width:320px; height:240px; margin:auto"></div>
                        <a style="margin-top: 10px;margin-bottom: 10px;" class="btn btn-info bg_ls" href="javascript:void(take_snapshot())"><span class="mif mif-camera"></span> Ambil Foto</a>    
                    </div>
                    <div class="span6">
                        <div id="my_result" style="margin:auto"></div>        
                    </div> 
                </div>
            
                <?php endif ?>

        </div>
    </div>

    <div class="widget-title">
        <h5>Data Customer</h5>
    </div>
    <div class="widget-content nopadding">
        <div class="row-fluid">
                <div class="control-group top-control">                    
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
        </div>
    </div>
    <!--////////////////////////////////////////DATA LOAN ITEMS//////////////////////////////////////////////-->
    <div class="widget-title">
        <h5>Daftar Item</h5>
        <h5 class="btn btn-warning" onclick="addItem(this)">+ Tambah Item</h5>
    </div>
    <div class="widget-content nopadding" id="itemform">
        <input type="hidden" name="item_count" value="1" id="item_count" readonly="readonly">
        <div class="widget-title item-title">
            <h5>Item 1</h5>
        </div>
        <div class="row-fluid itemdata">
            <div class="control-group top-control">
                    <label for="" class="control-label">Nama item</label>
                    <div class="controls">
                        <input type="text" name="item_name" placeholder="Nama item yang akan digadai" class="span11">
                    </div>
            </div>
            

            <div class="control-group">
                <div class="span6">
                    <label class="control-label">Berat</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <input type="number" step="any" name="item_weight[]" placeholder="Berat item" class="span12">
                            <span class="add-on">gr</span>
                        </div>
                    </div>    
                </div>
                <div class="span6">
                    <label class="control-label">Kadar</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <input type="number" step="any" name="item_gold_amount[]" placeholder="Kadar emas item" class="span12">
                            <span class="add-on">%</span>
                        </div>
                        
                    </div>    
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Keterangan</label>
                <div class="controls">
                    <input type="text" name="item_description[]" placeholder="keterangan dari item yang digadai" class="span11">    
                </div>
            </div>
            <div class="control-group">
                <div class="span6">
                    <label class="control-label">Pinjaman</label>
                    <div class="controls">    
                        <div class="input-prepend"> 
                            <span class="add-on">Rp</span>
                            <input type="number" step="any" name="loan_price[]" class="span12" placeholder="Pinjaman yang didapat">
                        </div>
                    </div>    
                </div>
                <div class="span6">
                    <label class="control-label">Bunga</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <input type="number" step="any" name="interest_rate[]" class="span12" placeholder="Bunga pinjaman">
                            <span class="add-on">%</span>    
                        </div>
                        
                    </div>    
                </div>
            </div>
        </div><!--row fluid close-->
    </div><!--widget content close-->
    <div class="row-fluid">
        <!--FORM FOOTER-->
        <div class="form-actions text-center">
                <input type="submit" name="submit" class="btn btn-info" value="Submit">
        </div>
    </div><!--row fluid close-->
    </div><!--widget box close-->
    <?php echo form_close(); ?>
</div>
<script src="<?php echo base_url() ?>js/alertify.min.js"></script>
<script src="<?php echo base_url() ?>js/jquery.validate.js"></script> 
<script src="<?php echo base_url() ?>js/selectize.min.js"></script>
<script src="<?php echo base_url() ?>js/webcam.min.js"></script>
<script>
    $(document).ready(function(){
        $('#table_sale').footable();
        $('#loan_sales').selectize();
    });

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
<script type="text/javascript">
    //TURN ON THE WEB CAM TO TAKE PHOTO OF PRODUCT
    function show_cam(el){
        if($(el).is(":checked") ){
            $('#snapshot').show();
            Webcam.attach('#my_camera');
            $('#capture').attr('disabled','disabled');
        }else{
            $('#snapshot').hide();
            $('#capture').removeAttr('disabled');
            Webcam.reset();            
        }
     }

    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            document.getElementById('my_result').innerHTML = '<img src="'+data_uri+'"/>';
            Webcam.upload( data_uri, "<?php echo base_url('product/upload') ?>", function(code, text) {
            } );    
        } );
        
    }    
</script>
<script type="text/javascript">
    //SET ALL THE DATE TO TODAY
    function setInputDate(_id){
        var _dat = document.querySelector(_id);
        var hoy = new Date(),
            d = hoy.getDate(),
            m = hoy.getMonth()+1, 
            y = hoy.getFullYear(),
            data;

        if(d < 10){
            d = "0"+d;
        };
        if(m < 10){
            m = "0"+m;
        };

        data = y+"-"+m+"-"+d;
        _dat.value = data;
    };
    setInputDate('#dateStart');
    setInputDate('#dateDue');
</script>
<script type="text/javascript">
    //DUPLICATE THE ITEM FIELDS
    function addItem(el){
        var count = parseInt($('#item_count').val())+1;
        $('#item_count').val(count);
        $('#itemform').append('<div class="widget-title item-title"><h5>Item '+count+'</h5></div>')
        $('.itemdata').clone().appendTo('#itemform');
    }
</script>