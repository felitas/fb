<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">

<div class="container-fluid">
	<div class="row-fluid">
		<a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a>
        <a id="add_link" class="pull-right" style="cursor: pointer;">Tambah kategori baru <span class="fa fa-plus-circle"></span></a>
        <h2>Daftar Kategori Barang</h2>
	</div>
	<!--Form Add category-->
	<?php echo form_open('configuration/category',array('class'=>'form-horizontal','id'=>'category_form'))?>
	<div class="widget-box closed-add" id="append_category" style="display: none">
	<div class="widget-title">
			<h5>Tambah Kategori Baru</h5>
	</div>
	<div class="widget-content">
			<div class="control-group top-control">
				<div class="row-fluid">
					<label class="control-label">Tipe Produk</label>
					<div class="controls">
		                <select class="span12" name="category_type" id="category_type">
		                	<?php foreach ($types as $type): ?>
		                		<option value="<?php echo $type->code ?>"><?php echo $type->name?></option>
		                	<?php endforeach ?>
		                </select>
					</div>
				</div>
			</div>
			<div class="control-group top-control">
				<div class="row-fluid">
					<div class="span6">
						<label class="control-label">Kode Kategori</label>
							<div class="controls">
				                <input type="text" placeholder="Masukkan kode untuk kategori (1 Huruf/Angka)" name="category_code" class="span12" onblur="check_category_code(this)">
							</div>
					</div>
					
					<div class="span6">
						<label class="control-label">Nama Kategori</label>
						<div class="controls">
			                <input type="text" placeholder="Masukkan nama kategori" name="category_name" class="span12">
						</div>
					</div>
				</div>
			</div>
			<div class="form-actions text-center">
				<input type="Submit" name="submit" class="btn btn-info" value="Submit">
			</div>
		</div>
	</div>
	<?php echo form_close()?>
	<!--End Form-->
	<!--widget box for the table for category list-->
	<div class="widget-box">
	<div class="widget-content">
		<div class="row-fluid">
    		<div class="control-group">
                <input type="text" placeholder="Cari..." id="filter" class="span12">
            </div>
			<div class="table-responsive toggle-circle-filled">
			<table class="table table-bordered" id="table_category" data-paging="true" data-page-size="100" data-filter="#filter">
				
				
					<?php if($types!=NULL):?>
						<?php foreach($types as $type):?>
						<thead>
							<tr>
								<th colspan="5" style="text-align: left;background-color: #2e363f !important;border-color:#2e363f !important; color: #fff;"><h5>Tipe Barang : <?php echo $type->name?></h5></th>
							</tr>
							<tr>
								<th data-type="numeric">No</th>
								<th data-type="numeric">Kode Kategori</th>
								<th data-type="numeric">Kategori</th>
								<th data-hide="phone">Tipe</th>
								<th data-hide="phone">Action</th>
							</tr>
						</thead>
							<?php if($categories!=NULL): ?>
								<?php $i=1; ?>
								<?php foreach($categories as $category): ?>
									<?php if($category->type_code==$type->code):?>
									<tbody>
									<tr>
										<td><?php echo $i ?></td>
										<td><?php echo $category->code ?></td>
										<td><?php echo $category->name ?></td>
										<td><?php echo $type->name ?></td>
										<td><a href="<?php echo base_url('configuration/edit_category/'.$category->id) ?>"><span class="mif mif-pencil"></span> Edit</a> - <a href="#" onclick="delete_category('<?php echo $category->id ?>','<?php echo $category->name ?>')"><span class="mif mif-bin"></span> Hapus</a></td>
									</tr>
									</tbody>
									<?php $i++; ?>
									<?php endif;?>
								<?php endforeach; ?>
							<?php else: ?>
								<tbody>
									<tr>
										<td colspan="5"><h3  class="text-center">Table kosong</h3></td>
									</tr>
								</tbody>
							<?php endif; ?>
						<?php endforeach;?>
					<?php else: ?>
						
						<tbody>
							<tr>
								<td colspan="4"><h3  class="text-center">Table kosong</h3></td>
							</tr>
						</tbody>
					<?php endif;?>	
				<tfoot>
					<tr>
						<td colspan="5">
							<div class="pagination pagination-centered"></div>
						</td>
					</tr>
				</tfoot>
			</table>
			</div>
			
		</div>
	</div>
	</div>
	<!--End widget box-->
</div>

<script src="<?php echo base_url() ?>js/alertify.min.js"></script>
<script src="<?php echo base_url() ?>js/jquery.validate.js"></script> 

<script>
	

    $(document).ready(function(){
        $('#table_category').footable();
        $('#category_form').validate({
        	rules:{
        		category_code:{required:true,maxlength:1},
        		category_name:"required"
        	}
        });
        <?php if($this->session->flashdata('category')): ?>
            <?php echo $this->session->flashdata('category'); ?>
        <?php endif; ?>
    });

    $('#add_link').click(function(){
    	if($('#append_category').hasClass('closed-add')){
    		$('#append_category').show();	
			$('#append_category').removeClass('closed-add');
    	}
    	else{
    		$('#append_category').hide();	
			$('#append_category').addClass('closed-add');
    	}
    	
    });
    //CALL DELETE MODAL
	function delete_category(id,name){
		alertify.confirm("Apakah anda yakin ingin menghapus kategori "+name+" ?",
		  function(){
		    window.location.assign("<?php echo base_url() ?>configuration/delete_category/"+id);
		  },
		  function(){
		    $.gritter.add({
		    	title: 'Gagal !', text: 'Kategori gagal dihapus', time:1500
		    });
		  });
	}
	//AJAX
	function check_category_code(el){
        if($(el).val() != ''){
            $.ajax({
              url: "<?php echo base_url('configuration/check_category_code/')?>" + $('#category_type').val()+"/"+$(el).val(),
              type: 'GET',
              cache : false,
              success: function(result){
                if(result == 'taken'){
                    $.gritter.add({
                        title: 'Error !',
                        text: 'Kode kategori sudah terpakai',
                        time: 1500
                    });
                    $(el).val('');
                    $(el).parent().addClass('error');
                    setTimeout(function(){$(el).parent().removeClass('error')},3000);
                }else{
                    $.gritter.add({
                        class_name:'gritter-light',
                        title: 'Available !',
                        text: 'Kode kategori '+$(el).val()+' bisa dipakai',
                        time: 1500
                    });
                    $(el).parent().addClass('success');
                }
               
                
              }
            
            });    
        }
    }
</script>