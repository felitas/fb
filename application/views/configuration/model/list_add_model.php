<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">

<div class="container-fluid">
	<div class="row-fluid">
		<a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a>
        <a id="add_link" class="pull-right" style="cursor: pointer;">Tambah model baru <span class="fa fa-plus-circle"></span></a>
        <h2>Daftar Model</h2>
	</div>
	<!--Form Add category-->
	<?php echo form_open('configuration/model',array('class'=>'form-horizontal','id'=>'model_form'))?>
	<div class="widget-box closed-add" id="append_model" style="display: none">
	<div class="widget-title">
			<h5>Tambah Model Baru</h5>
	</div>
	<div class="widget-content">
			<div class="control-group top-control">
				<div class="row-fluid">
					<div class="span6">
						<label class="control-label">Kode Model</label>
							<div class="controls">
				                <input type="text" placeholder="Masukkan kode untuk model (2 Huruf/Angka)" name="model_code" class="span12">
							</div>
					</div>
					
					<div class="span6">
						<label class="control-label">Nama Model</label>
						<div class="controls">
			                <input type="text" placeholder="Masukkan nama koleksi" name="model_name" class="span12">
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
			<table class="table table-bordered" id="table_model" data-paging="true" data-page-size="100" data-filter="#filter">
				
				<thead>
					<tr>
						<th data-type="numeric">No</th>
						<th data-type="numeric">Kode Model</th>
						<th data-hide="phone">Nama Model</th>
						<th data-hide="phone">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if($models!=NULL): ?>
						<?php $i=1; ?>
						<?php foreach($models as $model): ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $model->code ?></td>
							<td><?php echo $model->name ?></td>
							<!-- <td>
								<?php #$outlet = $this->crud_model->get_by_condition('outlets', array('id'=>$customer->outlet_id))->row('name');
									#echo $outlet;
								?>
							</td> -->
							<td><a href="<?php echo base_url('configuration/edit_model/'.$model->id) ?>"><span class="mif mif-pencil"></span> Edit</a> - <a href="#" onclick="delete_model('<?php echo $model->id ?>','<?php echo $model->code ?>')"><span class="mif mif-bin"></span> Hapus</a></td>
						</tr>
						<?php $i++; ?>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="4"><h3  class="text-center">Table kosong</h3></td>
						</tr>
					<?php endif; ?>

				</tbody>
						
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
        $('#table_model').footable();
        $('#model_form').validate({
        	rules:{
        		model_code:{required:true,maxlength:2},
        		model_name:"required"
        	}
        });
        <?php if($this->session->flashdata('model')): ?>
            <?php echo $this->session->flashdata('model'); ?>
        <?php endif; ?>
    });

    $('#add_link').click(function(){
    	if($('#append_model').hasClass('closed-add')){
    		$('#append_model').show();	
			$('#append_model').removeClass('closed-add');
    	}
    	else{
    		$('#append_model').hide();	
			$('#append_model').addClass('closed-add');
    	}
    	
    });
    
	function delete_model(id,name){
		alertify.confirm("Apakah anda yakin ingin menghapus model "+name+" ?",
		  function(){
		    window.location.assign("<?php echo base_url() ?>configuration/delete_model/"+id);
		  },
		  function(){
		    $.gritter.add({
		    	title: 'Gagal !', text: 'Kategori gagal dihapus', time:1500
		    });
		  });
	}
</script>