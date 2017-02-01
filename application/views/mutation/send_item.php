<script src="<?php echo base_url() ?>js/jquery.validate.js"></script> 
<div class="container-fluid">
    <div class="row-fluid">
        <a href="<?php echo base_url('mutation') ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar mutasi</a>
        <h2>Kirim Barang</h2>
    </div>
    <div class="widget-box">
    <div class="widget-content nopadding">
        <div class="row-fluid">
          <div class="span12">
            <?php echo form_open('mutation/send_mutation', array('class'=>'form-horizontal', 'id'=>'sendingform' )) ?>
            <div class="control-group top-control">
                <!--ADMIN HAS FREEDOM TO CHOOSE TO AND FROM WHERE THE MUTATION GOES-->
                <?php if($role=='admin'): ?>
                <div class="span6">
                    <label class="control-label">Asal</label>
                    <div class="controls">
                      <select name="from_outlet" id="from_outlet">
                            <option value="0">Brankas</option>
                          <?php foreach ($outlets_admin as $outlet_admin): ?>
                              <option value="<?php echo $outlet_admin->id?>"><?php echo $outlet_admin->name?></option>
                          <?php endforeach ?>
                      </select>
                    </div>    
                </div>
                <div class="span6">
                    <label class="control-label">Tujuan</label>
                    <div class="controls">
                      <select name="to_outlet">
                          <?php foreach ($outlets_admin as $outlet_admin): ?>
                              <option value="<?php echo $outlet_admin->id?>"><?php echo $outlet_admin->name?></option>
                          <?php endforeach ?>
                      </select>
                    </div>  
                </div>
                <!--END ADMIN PRIVILEGE-->
                <!--NORMAL STORE, CAN ONLY SEND FROM THEIR STORE-->
                <?php else:?>
                <div class="span6">
                    <input type="hidden" name="from_outlet" value="<?php echo $session_outlet?>" id="from_outlet">    
                    <label class="control-label">Tujuan</label>
                    <div class="controls">
                      <select name="to_outlet">
                          <?php foreach ($outlets as $outlet): ?>
                              <option value="<?php echo $outlet->id?>"><?php echo $outlet->name?></option>
                          <?php endforeach ?>
                      </select>
                    </div>
                </div>
                <?php endif?>
            </div>

            <div class="control-group">    
                <label class="control-label">Kode Produk</label>
                <div class="controls">
                  <input type="text" placeholder="Scan atau ketik kode produk" name="product_code" class="span10" onblur="get_product(this)">
                </div>    
            </div>    

            <div class="control-group">                
                <div class="controls">
                    <div class="span10">
                        <div class="control-group" style="margin-bottom: 6px;">
                            <input type="text" placeholder="Cari..." id="filter" class="span12">
                        </div>
                        <div class="table-responsive toggle-circle-filled">
                            <table class="table table-bordered" id="table_send" data-filter="#filter" data-page-size="20">
                                <thead>
                                    <tr>
                                        <th data-type="numeric">No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama</th>
                                        <th data-hide="phone">Nampan</th>
                                        <th data-hide="phone">Tipe</th>
                                        <th data-hide="phone">Kategori</th>
                                        <th data-hide="phone">Harga Jual</th>
                                        <th data-hide="phone">Kadar</th>
                                        <th data-hide="phone">Berat</th>
                                        <th data-hide="phone">Action</th>
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
            <?php echo form_close() ?>
        </div>
    </div>
    </div>
  </div>    
</div>

<script>
<?php if($this->session->flashdata('outlet')): ?>
   <?php echo $this->session->flashdata('outlet') ?>
<?php endif; ?>
$(document).ready(function(){
    $('#table_send').footable();
    $('#sendingform').validate({
        rules:{
            outlet_name: "required",
            outlet_username: "required",
            outlet_code:{
                required: true,
                maxlength: 2
            },
            outlet_password: "required"
        }
    });
});

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
                        $.gritter.add({
                            title: 'SUCCESS',
                            text: 'Barang sudah terdaftar',
                            time: 1500
                        });
                        // $('#table_body').append("<tr><td>"+no+"</td><td><a class='photobox' href='<?php echo base_url() ?>"+data.photo+"'><img width='20' src='<?php echo base_url() ?>"+data.photo+"' alt=''/></a></td><td>"+data.product_code+"</td><td>"+data.name+"</td><td>"+data.tray+"</td><td>"+data.type+"</td><td>"+data.category+"</td><td>"+data.real_weight+"</td><td>"+data.rounded_weight+"</td><td>"+data.selling_price+"</td><td>"+data.amount_type+data.original+"->"+data.marked_up+"</td><td>"+data.outlet+"</td></tr>");

                        // $('#form_mutation').append("<input type='hidden' name='product_code[]' value='"+data.product_code+"'>");
                        //     product_code.push(data.product_code);
                        //     no++;
                        
                    }
                        
                }
                $(el).val('');
                $(el).focus();  
                
                
                
              }
            
            });
        }
    }
</script>