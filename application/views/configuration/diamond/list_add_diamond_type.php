<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">
<link href="<?php echo base_url() ?>css/footable.core.css" type="text/css" rel="stylesheet">
<div class="container-fluid">
	<div class="row-fluid">
		<a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a>
        <a id="add_link" style="cursor: pointer;" class="pull-right">Tambah tipe diamond baru <span class="fa fa-plus-circle"></span></a>
        <h2><?php echo $title?></h2>
	</div>
	<!--Form Add Tray-->
	<?php echo form_open('configuration/list_add_diamond_type',array('class'=>'form-horizontal'))?>
	<div class="widget-box closed-add" id="append_tray" style="display: none">
	<div class="widget-title">
			<h5>Tambah tipe diamond baru</h5>
	</div>
	<div class="widget-content">
		<div class="control-group top-control">
			<div class="row-fluid">
				<div class="span6">
					<label class="control-label">Kode Tipe Diamond</label>
					<div class="controls">
		                <input type="text" placeholder="Masukkan kode untuk tipe diamond" name="diamond_code" class="span12">
					</div>
				</div>
				<div class="span6">
					<label class="control-label">Nama Diamond</label>
					<div class="controls">
		                <input type="text" placeholder="Masukkan nama diamond" name="diamond_name" class="span12">
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
						<th data-type="numeric">Kode Tipe</th>
						<th data-hide="phone">Nama Tipe Diamond</th>
						<th data-hide="phone">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if($diamonds!=NULL): ?>
						<?php $i=1; ?>
						<?php foreach($diamonds as $diamond): ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $diamond->code ?></td>
							<td><?php echo $diamond->name ?></td>
							<!-- <td>
								<?php #$outlet = $this->crud_model->get_by_condition('outlets', array('id'=>$customer->outlet_id))->row('name');
									#echo $outlet;
								?>
							</td> -->
							<td><a href="<?php echo base_url() ?>"><span class="mif mif-pencil"></span> Edit</a> - <a href="#" onclick="delete_tray('<?php echo $diamond->id ?>','<?php echo $diamond->code ?>')"><span class="mif mif-bin"></span> Hapus</a></td>
						</tr>
						<?php $i++; ?>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="3"><h3  class="text-center">Table kosong</h3></td>
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

<script>
	

    $(document).ready(function(){
        <?php if($this->session->flashdata('tray')): ?>
            <?php echo $this->session->flashdata('tray') ?>
        <?php endif; ?>
        $('#table_tray').footable();
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
		alertify.confirm("Apakah anda yakin ingin menghapus tipe diamond "+code+"?",
		  function(){
		    window.location.assign("<?php echo base_url() ?>Configuration/delete_diamond_type/"+id);
		  },
		  function(){
		    $.gritter.add({
				 		title:	'Gagal!',
				 		text:	'Tipe diamond gagal dihapus!',
				 		sticky: false
			});
		  });
	}
</script>