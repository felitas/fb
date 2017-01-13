<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">
<link href="<?php echo base_url() ?>css/footable.core.css" type="text/css" rel="stylesheet">
<div class="container-fluid">
	<div class="row-fluid">
		<a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a>
        <a id="add_link" style="cursor: pointer;" class="pull-right">Tambah baki baru <span class="fa fa-plus-circle"></span></a>
        <h2>Daftar Nampan</h2>
	</div>
	<!--Form Add Tray-->
	<?php echo form_open('Tray/add_tray',array('class'=>'form-horizontal','id'=>'tray_form'))?>
	<div class="widget-box closed-add" id="append_tray" style="display: none">
	<div class="widget-title">
			<h5>Tambah Nampan Baru</h5>
	</div>
	<div class="widget-content">
		<div class="row-fluid">
			<div class="span12">
				<div class="control-group top-control">
					<label class="control-label">Kode Nampan</label>
					<div class="controls">
		                <input type="text" placeholder="Masukkan kode untuk baki baru" name="new_tray" class="span12">
					</div>
				</div>
				<div class="control-group top-control">
					<label class="control-label">Keterangan</label>
					<div class="controls">
						<textarea name="tray_desc" class="span12"></textarea>
					</div>
				</div>
			
			
				<div class="form-actions text-center">
					<input type="Submit" name="submit" class="btn btn-info" value="Submit">
				</div>
			</div>
		</div>
	</div>
	</div>
	<?php echo form_close()?>
	<!--End Form-->
	<div class="widget-box">
	<div class="widget-content">
		<div class="row-fluid">
    		<div class="control-group">
                <input type="text" placeholder="Cari..." id="filter" >
            </div>
			<div class="table-responsive toggle-circle-filled">
			<table class="table table-bordered" id="table_tray" data-page-size="10" data-filter="#filter">
				<thead>
					<tr>
						<th data-type="numeric">No</th>
						<th data-type="numeric">Kode Baki</th>
						<th data-hide="phone">Keterangan</th>
						<th data-hide="phone">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if($trays!=NULL): ?>
						<?php $i=1; ?>
						<?php foreach($trays as $tray): ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $tray->code ?></td>
							<td><?php echo $tray->description ?></td>
							<!-- <td>
								<?php #$outlet = $this->crud_model->get_by_condition('outlets', array('id'=>$customer->outlet_id))->row('name');
									#echo $outlet;
								?>
							</td> -->
							<td><a href="<?php echo base_url('tray/edit_tray/'.$tray->id) ?>"><span class="mif mif-pencil"></span> Edit</a> - <a href="#" onclick="delete_tray('<?php echo $tray->id ?>','<?php echo $tray->code ?>')"><span class="mif mif-bin"></span> Hapus</a></td>
						</tr>
						<?php $i++; ?>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="4"><h3  class="text-center">Table kosong</h3></td>
						</tr>
					<?php endif; ?>

				</tbody>
			</table>
			</div>
			
		</div>
	</div>
	</div>
</div>

<script src="<?php echo base_url() ?>js/alertify.min.js"></script>
<script src="<?php echo base_url() ?>js/jquery.validate.js"></script>

<script>
	

    $(document).ready(function(){
        <?php if($this->session->flashdata('tray')): ?>
            <?php echo $this->session->flashdata('tray') ?>
        <?php endif; ?>
        $('#table_tray').footable();
        $('#tray_form').validate({
        	rules:{
        		new_tray:"required"
        	}	
        });
    });

    $('#add_link').click(function(){
    	if($('#append_tray').hasClass('closed-add')){
    		$('#append_tray').show();	
			$('#append_tray').removeClass('closed-add');
    	}
    	else{
    		$('#append_tray').hide();	
			$('#append_tray').addClass('closed-add');	
    	}
    	
    });
    
	function delete_tray(id,code){
		alertify.confirm("Apakah anda yakin ingin menghapus Baki "+code+"?",
		  function(){
		    window.location.assign("<?php echo base_url() ?>Tray/delete_tray/"+id);
		  },
		  function(){
		    $.gritter.add({
				 		title:	'Gagal!',
				 		text:	'Tray gagal dihapus!',
				 		sticky: false
			});
		  });
	}
</script>