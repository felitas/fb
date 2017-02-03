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
                      <?php echo $mutation->from_outlet ?>
                    </div>    
                </div>
                <div class="span6">
                    <label class="control-label">Tujuan</label>
                    <div class="controls">
                      <?php echo $mutation->to_outlet ?>
                    </div>  
                </div>
            </div>
            <!--HEADER ENDS-->
            <div class="control-group">    
                <label class="control-label">Kode Produk</label>
                <div class="controls">
                  <input type="text" placeholder="Scan atau ketik kode produk yang telah diterima" name="product_code" class="span11"">
                </div>    
            </div>    

            <div class="control-group">                
                <div class="controls">
                    <div class="span11">
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

<?php if($this->session->flashdata('mutation')): ?>
   <?php echo $this->session->flashdata('mutation') ?>
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

//vars for get product func
var no = 1;
var product_code = [];
</script>