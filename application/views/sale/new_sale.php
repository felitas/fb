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
                <div class="span4">
                    <label class="control-label">Kode Penjualan</label>
                    <div class="controls">
                        <input type="text" name="sale_code" value="<?php echo $sale_code ?>" readonly="readonly">
                        <input type="hidden" name="hidden_code" value="<?php echo $hidden_code ?>">
                        <input type="hidden" name="hidden_count" value="<?php echo $hidden_count ?>">            
                    </div>    
                </div>
                <div class="span4">
                    <label class="control-label">Kode Customer</label>
                    <div class="controls">
                        <input type="text" name="customer_code" placeholder="Scan atau masukkan kode pelanggan" id="customer_code" onblur="get_customer(this)">
                    </div>            
                </div>
                <div class="span4">
                    <label class="control-label">Customer Baru</label>
                    <div class="controls">
                        <input type="checkbox" name="new_customer" onchange="data_new_customer(this)">
                    </div>            
                </div>  
            </div>
            <!--///////////////////////DATA NEW CUSTOMER//////////////////////////////////////////////-->
            <div class="control-group">
                <div class="span6">
                    <label class="control-label">Nama Customer</label>
                    <div class="controls">
                        <input type="text" placeholder="Nama Customer" name="customer_name">
                    </div>    
                </div>
                <div class="span6">
                    <label class="control-label">Tipe Customer</label>
                    <div class="controls">
                        <select name="customer_type" id="">
                            <option value="Regular">Customer Biasa</option>
                            <option value="Member">Member</option>
                        </select>
                    </div>  
                </div>
            </div>

            <div class="control-group">
                <div class="span6">
                    <label for="" class="control-label">Email</label>
                    <div class="controls">
                        <input type="email" placeholder="Email Customer" name="customer_email">
                    </div>    
                </div>
                <div class="span6">
                    <label class="control-label">No. Telepon</label>
                    <div class="controls">
                        <input type="text" placeholder="Nomor Telepon Customer" name="customer_phone">
                    </div>
                </div>   
            </div>

            <div class="control-group">
                <div class="span6">
                    <label for="" class="control-label">Alamat</label>
                    <div class="controls">
                        <textarea placeholder="Alamat Customer" name="customer_address"></textarea>
                    </div>
                </div>
                <div class="span6">
                    <label class="control-label">Tanggal Lahir</label>
                    <div class="controls">
                        <input type="date" name="customer_birthday">
                    </div>        
                </div>
            </div>
            <!--///////////////////////END DATA NEW CUSTOMER//////////////////////////////////////////////-->
            <div class="control-group">    
                <label class="control-label">Kode Produk</label>
                <div class="controls">
                  <input type="text" placeholder="Scan atau ketik kode produk yang akan dikirim" name="product_code" class="span11" onblur="get_product(this)">
                </div>    
            </div>    

            <div class="control-group">                
                <div class="controls">
                    <div class="span11">
                        <div class="control-group" style="margin-bottom: 6px;">
                            <input type="text" placeholder="Cari..." id="filter" class="span12">
                        </div>
                        <div class="table-responsive toggle-circle-filled">
                            <table class="table table-bordered" id="table_sale" data-filter="#filter" data-page-size="20">
                                <thead>
                                    <tr>
                                        <th data-type="numeric">No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama</th>
                                        <!-- <th data-hide="phone" data-toggle="phone">Nampan</th> -->
                                        <th data-hide="phone" data-toggle="phone">Tipe</th>
                                        <th data-hide="phone" data-toggle="phone">Kategori</th>
                                        <th data-hide="phone" data-toggle="phone">Kadar</th>
                                        <th data-hide="phone" data-toggle="phone">Berat</th>
                                        <th data-hide="phone" data-toggle="phone">Foto</th>
                                        <th data-hide="phone" data-toggle="phone">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_body">
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="10">
                                            <div class="pagination pagination-centered"></div>
                                        </td>
                                    </tr>
                                </tfoot>    
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions text-center">
                <input type="Submit" name="submit" class="btn btn-info" value="Submit">
            </div>
            <?php echo form_close(); ?>
            
        </div>
    </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#table_sale').footable();
    });
    <?php if($this->session->flashdata('customer')): ?>

       <?php echo $this->session->flashdata('customer') ?>

    <?php endif; ?>
</script>
<script>
    //vars for get product func
    var no = 1;
    var product_code = [];
    function get_product(el){
            if($(el).val() != ''){
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
                    
                        if(product_code.indexOf(data.product_code) > -1){
                           $.gritter.add({
                                title: 'Error',
                                text: 'Barang sudah terdaftar',
                                time: 1500
                            });
                        }else{
                            $('#table_body').append("<tr><td>"+no+"</td><td>"+data.product_code+"</td><td>"+data.name+"</td><td>"+data.type+"</td><td>"+data.category+"</td><td>"+data.gold_amount+"</td><td>"+data.weight+"</td><td><img width='20' src='<?php echo base_url() ?>"+data.photo+"'></td><td>&times;</td>")
                            // $('#table_body').append("<tr><td>"+no+"</td><td><a class='photobox' href='<?php echo base_url() ?>"+data.photo+"'><img width='20' src='<?php echo base_url() ?>"+data.photo+"' alt=''/></a></td><td>"+data.product_code+"</td><td>"+data.name+"</td><td>"+data.tray+"</td><td>"+data.type+"</td><td>"+data.category+"</td><td>"+data.real_weight+"</td><td>"+data.rounded_weight+"</td><td>"+data.selling_price+"</td><td>"+data.amount_type+data.original+"->"+data.marked_up+"</td><td>"+data.outlet+"</td></tr>");

                            $('#mutationform').append("<input type='hidden' name='product_code[]' value='"+data.product_code+"'>");
                                 product_code.push(data.product_code);
                                 no++;
                            
                        }
                            
                    }
                    $(el).val('');
                    $(el).focus();  
                    
                    
                    
                  }
                
                });
            }
        }
</script>