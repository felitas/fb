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
        <h2>Daftar Pengaturan Perolehan Poin Member</h2>
	</div>
	<!--Form Add pengaturan baru-->
	<?php echo form_open('configuration/member_points',array('class'=>'form-horizontal','id'=>'point_form'))?>
	<div class="widget-box closed-add" id="append_point" style="display: none">
	<div class="widget-title">
			<h5>Tambah Target Poin Member Baru</h5>
	</div>
	<div class="widget-content">
			<div class="control-group top-control">
				<div class="row-fluid">
					<label class="control-label">Nama Target</label>
						<div class="controls">
			                <input type="text" placeholder="Masukkan nama target poin member" name="point_name" class="span12">
						</div>
				</div>
				<div class="row-fluid">
					<div class="span7">
						<label class="control-label">Target kelipatan transaksi</label>
						<div class="controls">
			                <input type="number" placeholder="Masukkan nominal target transaksi dalam rupiah" name="point_target" class="span12">
						</div>
					</div>	
					<div class="span5">
						<label class="control-label">Jumlah poin yang didapat</label>
						<div class="controls">
			                <input type="number" placeholder="Masukkan jumlah poin" name="point_amount" class="span12">
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
	<!--widget box for the table for customer grade list-->
	<div class="widget-box">
	<div class="widget-content">
		<div class="row-fluid">
    		<div class="control-group">
                <input type="text" placeholder="Cari..." id="filter" class="span12">
            </div>
			<div class="table-responsive toggle-circle-filled">
			<table class="table table-bordered" id="table_point" data-paging="true" data-page-size="100" data-filter="#filter">
				
				<thead>
					<tr>
						<th data-type="numeric">No</th>
						<th>Nama Target</th>
						<th data-hide="phone">Point setiap kelipatan</th>
						<th data-hide="phone">Jumlah point didapat</th>
						<th data-hide="phone">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if($point_targets!=NULL): ?>
						<?php $i=1; ?>
						<?php foreach($point_targets as $point): ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $point->name ?></td>
							<td><?php echo 'Rp '. number_format($point->target,2,',','.') ?></td>
							<td><?php echo $point->amount ?></td>
							<td id="action"><a href="<?php echo base_url('configuration/edit_member_points/'.$point->id) ?>" class="btn btn-info">Edit</a></td>
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
        $('#table_point').footable();
        $('#point_form').validate({
        	rules:{
        		point_name:"required",
        		point_target:"required",
        		point_amount:"required"
        	}
        });
        <?php if($this->session->flashdata('member_point')): ?>
            <?php echo $this->session->flashdata('member_point'); ?>
        <?php endif; ?>
    });

    $('#add_link').click(function(){
    	if($('#append_point').hasClass('closed-add')){
    		$('#append_point').show();	
			$('#append_point').removeClass('closed-add');
    	}
    	else{
    		$('#append_point').hide();	
			$('#append_point').addClass('closed-add');
    	}
    });
    
	function delete_target(id,name){
		alertify.confirm("Apakah anda yakin ingin menghapus target poin member"+name+" ?",
		  function(){
		    window.location.assign("<?php echo base_url() ?>configuration/delete_member_point/"+id);
		  },
		  function(){
		    $.gritter.add({
		    	title: 'Gagal !', text: 'Target poin member gagal dihapus', time:1500
		    });
		  });
	}

</script>