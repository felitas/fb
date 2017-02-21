<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<style>
	.btn-info,.btn-danger,.btn-success{
		font-size: 11px;
		width: 70%;
		
	}
	#action{
		text-align: center;
	}
</style>
<div class="container-fluid">
	<div class="row-fluid">
		<a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a>
        <a id="add_link" class="pull-right" style="cursor: pointer;">Tambah target sales baru <span class="fa fa-plus-circle"></span></a>
        <h2>Daftar Target Sales</h2>
	</div>
	<!--Form Add category-->
	<?php echo form_open('configuration/sales_target',array('class'=>'form-horizontal','id'=>'target_form'))?>
	<div class="widget-box closed-add" id="append_target" style="display: none">
	<div class="widget-title">
			<h5>Tambah Target Baru</h5>
	</div>
	<div class="widget-content">
			<div class="control-group top-control">
				<div class="row-fluid">
					<div class="span6">
						<label class="control-label">Nama target</label>
							<div class="controls">
				                <input type="text" placeholder="Masukkan nama untuk target ini" name="target_name" class="span12">
							</div>
					</div>
					
					<div class="span6">
						<label class="control-label">Jumlah transaksi berhasil/Bulan</label>
						<div class="controls">
			                <input type="text" placeholder="Masukkan target jumlah transaksi minimum" name="target_amount" class="span12">
						</div>
					</div>
				</div>
				<div class="row-fluid">	
					<label class="control-label">Deskripsi target</label>
					<div class="controls">
		                <textarea class="span12" name="target_desc" placeholder="Keterangan dari bonus atau hasil target"></textarea>
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
			<table class="table table-bordered" id="table_target" data-paging="true" data-page-size="100" data-filter="#filter">
				
				<thead>
					<tr>
						<th data-type="numeric">No</th>
						<th>Nama Target</th>
						<th data-hide="phone">Jumlah transaksi berhasil</th>
						<th data-hide="phone">Deskripsi</th>
						<th data-hide="phone">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if($targets!=NULL): ?>
						<?php $i=1; ?>
						<?php foreach($targets as $target): ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $target->name ?></td>
							<td><?php echo $target->target ?></td>
							<td><?php echo $target->description ?></td>
							<td><a href="<?php echo base_url('configuration/edit_target/'.$target->id) ?>">Edit</a><a href="#" onclick="delete_target('<?php echo $target->id ?>','<?php echo $target->name ?>')">Hapus</a></td>
						</tr>
						<?php $i++; ?>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="5"><h3  class="text-center">Table kosong</h3></td>
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
        $('#table_target').footable();
        $('#target_form').validate({
        	rules:{
        		target_name:"required",
        		target_amount:"required"
        	}
        });
        <?php if($this->session->flashdata('target')): ?>
            <?php echo $this->session->flashdata('target'); ?>
        <?php endif; ?>
    });

    $('#add_link').click(function(){
    	if($('#append_target').hasClass('closed-add')){
    		$('#append_target').show();	
			$('#append_target').removeClass('closed-add');
    	}
    	else{
    		$('#append_target').hide();	
			$('#append_target').addClass('closed-add');
    	}
    });
    
	function delete_target(id,name){
		alertify.confirm("Apakah anda yakin ingin menghapus target "+name+" ?",
		  function(){
		    window.location.assign("<?php echo base_url() ?>configuration/delete_target/"+id);
		  },
		  function(){
		    $.gritter.add({
		    	title: 'Gagal !', text: 'Target gagal dihapus', time:1500
		    });
		  });
	}

</script>