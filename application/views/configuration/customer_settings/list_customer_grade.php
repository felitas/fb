<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<style type="text/css">
	.btn-info{
		width: 50%;
	}
	#action{
		text-align: center;
	}
</style>
<div class="container-fluid">
	<div class="row-fluid">
		<a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a>
        <a id="add_link" class="pull-right" style="cursor: pointer;">Tambah target point member baru <span class="fa fa-plus-circle"></span></a>
        <h2>Daftar Target Poin Customer</h2>
	</div>
	<!--widget box for the table for customer grade list-->
	<div class="widget-box">
	<div class="widget-content">
		<div class="row-fluid">
    		<div class="control-group">
                <input type="text" placeholder="Cari..." id="filter" class="span12">
            </div>
			<div class="table-responsive toggle-circle-filled">
			<table class="table table-bordered" id="table_grade" data-paging="true" data-page-size="100" data-filter="#filter">
				
				<thead>
					<tr>
						<th data-type="numeric">No</th>
						<th>Nama Target</th>
						<th data-hide="phone">Target Transaksi Customer</th>
						<th data-hide="phone">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if($grades!=NULL): ?>
						<?php $i=1; ?>
						<?php foreach($grades as $grade): ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $grade->name ?></td>
							<td><?php echo 'Rp '. number_format($grade->target,2,',','.') ?></td>
							<td id="action"><a href="<?php echo base_url('configuration/edit_grade/'.$grade->id) ?>" class="btn btn-info">Edit</a></td>
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
						<td colspan="4">
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
        $('#table_grade').footable();
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