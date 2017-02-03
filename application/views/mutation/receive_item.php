<script src="<?php echo base_url() ?>js/jquery.validate.js"></script> 
<div class="container-fluid">
    <div class="row-fluid">
        <a href="<?php echo base_url('mutation') ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar mutasi</a>
        <h2>Terima Barang</h2>
    </div>
    <div class="widget-box">
    <div class="widget-content nopadding">
        <div class="row-fluid">
          <div class="span12">
            <?php echo form_open('mutation/receive_item', array('class'=>'form-horizontal', 'id'=>'mutationform' )) ?>
            <!--HEADER OF MUTATION : FROM AND TO -->
            <div class="control-group top-control">
                <div class="span6">
                    <label class="control-label">Asal</label>
                    <div class="controls">
                        <input type="text" name="from_outlet" readonly="readonly" value="<?php echo $mutation->from_outlet ?>">
                      
                    </div>    
                </div>
                <div class="span6">
                    <label class="control-label">Tujuan</label>
                    <div class="controls">
                      <input type="text" name="from_outlet" readonly="readonly" value="<?php echo $mutation->to_outlet ?>">
                    </div>  
                </div>
            </div>
            <!--HEADER ENDS-->
            <div class="control-group">    
                <label class="control-label">Kode Produk</label>
                <div class="controls">
                  <input type="text" placeholder="Scan atau ketik kode produk yang telah diterima" name="product_code" class="span11" onblur="get_product(this)">
                </div>    
            </div>    

            <div class="control-group">                
                <div class="controls">
                    <div class="span11">
                        <div class="control-group" style="margin-bottom: 6px;">
                            <input type="text" placeholder="Cari..." id="filter" class="span12">
                        </div>
                        <div class="table-responsive toggle-circle-filled">
                            <table class="table table-bordered" id="table_receive" data-filter="#filter" data-page-size="20">
                                <thead>
                                    <tr>
                                        <th data-type="numeric">No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama</th>
                                        <th data-hide="phone" data-toggle="phone">Nampan</th>
                                        <th data-hide="phone" data-toggle="phone">Tipe</th>
                                        <th data-hide="phone" data-toggle="phone">Kategori</th>
                                        <th data-hide="phone" data-toggle="phone">Kadar</th>
                                        <th data-hide="phone" data-toggle="phone">Berat</th>
                                        <th data-hide="phone" data-toggle="phone">Foto</th>
                                        <th data-hide="phone" data-toggle="phone">Status</th>
                                    </tr>
                                </thead>
                                <tbody id="table_body">
                                    <?php if($received_items!=NULL):?>
                                        <?php $i=1;?>
                                        <?php foreach($received_items as $item):?>
                                            <td><?php echo $i?></td>
                                            <td>
                                                <?php echo $item->product_code?>
                                                <input type="hidden" value="<?php echo $item->product_code ?>" name="missing_code[]" id="code_<?php echo $item->product_code ?>">
                                            </td>
                                            <td><?php echo $item->name?></td>
                                            <td id="tray_<?php echo $item->product_code ?>"></td>
                                            <td><?php echo $item->type?></td>
                                            <td><?php echo $item->category?></td>
                                            <td><?php echo $item->gold_amount?> %</td>
                                            <td><?php echo $item->weight?></td>
                                            <td><img src="<?php echo base_url().$item->photo?>" width="40px"> </td>
                                            <td id="<?php echo $item->product_code ?>"></td>
                                        <?php $i++?>
                                        <?php endforeach;?>
                                    <?php else:?>
                                    <?php endif?>
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
                <input type="hidden" name="mutation_code" value="<?php echo $received_items[0]->mutation_code ?>">
                <input type="Submit" name="submit" class="btn btn-info" value="Submit">
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
    </div>
  </div>    
</div>

<script>

<?php if($this->session->flashdata('mutation')): ?>
   <?php echo $this->session->flashdata('mutation') ?>
<?php endif; ?>

$(document).ready(function(){
    $('#table_receive').footable();
});
</script>
<script>
var product_code = [];
function get_product(el){
    if($(el).val() != ''){
        $.ajax({
          url: "<?php echo base_url('mutation/get_product_from_mutation/')?>" + $(el).val() + '/<?php echo $received_items[0]->mutation_code ?>',
          type: 'GET',
          cache : false,
          success: function(result){
            if(result == 'not found'){
                $.gritter.add({
                    title: 'Error',
                    text: 'Barang Tidak Ditemukan',
                    time:1500
                });
            }else{
                var data = JSON.parse(result);
            
                if(product_code.indexOf(data.product_code) > -1){
                    $.gritter.add({
                        title: 'Error',
                        text: 'Barang Sudah Terdaftar',
                        time:1500
                    });
                }else{
                    $('#'+data.product_code).append("<span class='fa fa-check'></span>");
                    $('#code_'+data.product_code).removeAttr('name');
                    $('#code_'+data.product_code).attr('name','checked_code[]');
                    $('#tray_'+data.product_code).append("<select name='tray[]' id=''><option value=''>Pilih Baki</option><?php foreach($trays as $tray): ?><option value='<?php echo $tray->id ?>'><?php echo $tray->code ?> <?php echo $tray->name ?></option><?php endforeach; ?></select>");
                    
                    
                }
                    
            }
            $(el).val('');
            $(el).focus();  
            
            
            
          }
        
        });
    }
}

</script>