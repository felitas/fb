<!--Both are css for alertify-->
<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">
<!--selectize-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/selectize.css')?>">

<div class="container-fluid">
    <div class="row-fluid">
        <a href="<?php echo base_url('sale') ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar penjualan</a>
        <h2>Penjualan</h2>
    </div>
    <div class="widget-box">
    <div class="widget-content nopadding">
        <div class="row-fluid">
            
            <?php echo form_open('sale/new_sale', array('class'=>'form-horizontal')) ?>
            <div class="control-group top-control">
                <div class="span6">
                    <label class="control-label">Kode Penjualan</label>
                    <div class="controls">
                        <input type="text" name="sale_code" value="<?php echo $sale_code ?>" readonly="readonly">
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
                    <label class="control-label">Customer Baru</label>
                    <div class="controls">
                        <input type="checkbox" name="new_customer" onchange="data_new_customer(this)">
                        <input type="hidden" name="hidden_customer_code" id="hidden_customer_code">
                        <input type="hidden" name="hidden_customer_count" id="hidden_customer_count">
                    </div>            
                </div>
                <div class="span6">
                    <label class="control-label">Kode Customer</label>
                    <div class="controls">
                        <input type="text" name="customer_code" placeholder="Masukkan kode pelanggan" id="customer_code" onblur="get_customer(this)" class="span11">
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
            
            <div class="control-group">    
                <label class="control-label">Kode Produk</label>
                <div class="controls">
                  <input type="text" placeholder="Scan atau ketik kode produk" name="product_code" class="span11" onblur="get_product(this)">
                </div>        
            </div>    

            <div class="control-group">                
                <div class="span12">
                    <div class="table-responsive toggle-circle-filled">
                        <table class="table table-bordered" id="table_sale" data-filter="#filter" data-page-size="20">
                            <thead>
                                <tr>
                                    <th data-type="numeric">No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama</th>
                                    <th data-hide="phone" data-toggle="phone">Foto</th>
                                    <th data-hide="phone" data-toggle="phone">Kadar</th>
                                    <th data-hide="phone" data-toggle="phone">Berat</th>
                                    <th data-hide="phone" data-toggle="phone">Harga</th>
                                    <th data-hide="phone" data-toggle="phone">Diskon</th>
                                    <th data-hide="phone" data-toggle="phone">Harga Deal</th>
                                    <th data-hide="phone" data-toggle="phone">Subtotal</th>
                                    <th data-hide="phone" data-toggle="phone"></th>
                                </tr>
                            </thead>
                            <tbody id="table_body">
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="9"><strong class="pull-right">Total </strong></td>
                                    <td colspan="2">Rp <span id="total_price">0</span></td>
                                </tr>
                                
                            </tfoot>    
                        </table>
                    </div>
                </div>
            </div>

            <div class="form-actions text-center">
                <input type="hidden" name="total_price" id="hidden_total">
                <input type="Submit" name="submit" class="btn btn-info" value="Submit">
            </div>
            <?php echo form_close(); ?>
            
        </div>
    </div>
    </div>
</div>
<script src="<?php echo base_url() ?>js/alertify.min.js"></script>
<script src="<?php echo base_url() ?>js/jquery.validate.js"></script> 
<script src="<?php echo base_url() ?>js/selectize.min.js"></script>
<script>
    $(document).ready(function(){
        $('#table_sale').footable();
        $('#sale_sales').selectize();
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
<script>
    var snd = new Audio('<?php echo base_url() ?>assets/barcode.wav');
    //vars for get product func
    var no = 1;
    var product_code = [];
    function get_product(el){
            if($(el).val() != ''){
                snd.play();
                $.ajax({
                  url: "<?php echo base_url('product/get_product_by_code/')?>"+$(el).val()+"/"+$('#from_outlet').val(),
                  type: 'GET',
                  cache : false,
                  success: function(result){
                    if(result == 'not found'){
                        $.gritter.add({
                            title: 'Error',
                            text: 'Barang Tidak Ditemukan',
                            time: 1500
                        });
                    }else{
                        var data = JSON.parse(result);
                    
                        if(product_code.indexOf(data.id) > -1){
                           $.gritter.add({
                                title: 'Error',
                                text: 'Barang sudah terdaftar',
                                time: 1500
                            });
                        }else{
                            $('#table_body').append("<tr id='row_"+data.id+"'><td>"+no+"</td><td>"+data.product_code+"</td><td>"+data.name+"</td><td><img width='20' src='<?php echo base_url() ?>"+data.photo+"'></td><td>"+data.gold_amount+"%</td><td>"+data.weight+"</td><td>Rp <span id='price_"+data.id+"'>"+data.sell_price+"</span></td><td>Rp <span id='potongan_"+data.id+"'></span></td><td>Rp <input type='number' name='deal[]' value='' id='deal_"+data.id+"' onblur='calc_price("+data.id+")'></td><td>Rp <span id='total_"+data.id+"'>"+data.sell_price+"</span></td><input type='hidden' name='product_code[]' value='"+data.product_code+"'><input type='hidden' name='product_price[]' value='"+data.sell_price+"'><td><a onclick='remove_row("+data.id+")' style='cursor:pointer'>&times;</a></td></tr>");

                            var total = $('#total_price').html();
                            var price = data.sell_price;
                            price = price.replace(/\./g,'');
                            total = total.replace('.','');
                            total = +total + +price;
                            $('#total_price').empty();
                            $('#total_price').html(total);
                            $('#hidden_total').val(total);
                            product_code.push(data.id);
                            no++;

                            
                        }
                            
                    }
                    $(el).val('');
                    $(el).focus();  
                    
                    
                    
                  }
                
                });
            }
    }
    //RUN WHEN HARGA DEAL FIELD IS FILLED AND FOCUSED OUT
    function calc_price(id){
        var price = $('#price_'+id).html();     
        var subtotal = $('#total_'+id).html();
        var total = $('#total_price').html();
        
        var deal = $('#deal_'+id).val();
        
        total = total.replace(/\./g, '');
        subtotal = subtotal.replace(/\./g, '');

        price = +price - +deal;
        total = +total - +subtotal;
        
        if(deal >= 0){
            total = +total + +deal;
            $('#total_'+id).empty();
            $('#total_'+id).html(deal);
            $('#total_price').empty();
            $('#total_price').html(total);
            $('#hidden_total').val(total);
        }else{
            $('#deal_'+id).val('');
        }
        


    }
    //RUN WHEN THE X BUTTON BESIDE EACH ROW IS PRESSED
    function remove_row(id){
        alertify.confirm("Apakah anda yakin ingin menghapus barang ini ? ",
              function(){
                var index = product_code.indexOf(id.toString());
                if(index > -1){
                    product_code.splice(index,1);
                }
                var subtotal = $('#total_'+id).html();
                var total = $('#total_price').html();
                total = total.replace(/\./g, '');
                subtotal = subtotal.replace(/\./g, '');
                total = +total - +subtotal;
                $('#total_price').html(total);
                $('#hidden_total').val(total);
                $('#row_'+id).remove();
              },
              function(){
                $.gritter.add({title: 'Gagal !', text: 'Produk gagal dihapus', time: 1500});
              });       
        
    }
</script>