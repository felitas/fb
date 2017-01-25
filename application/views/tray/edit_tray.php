<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">
<link href="<?php echo base_url() ?>css/footable.core.css" type="text/css" rel="stylesheet">
<div class="container-fluid">
	<div class="row-fluid">
		<a href="<?php echo base_url('tray') ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar nampan</a>
        <h2>Edit Nampan <?php echo $tray->code ?></h2>
	</div>
	<!--Form Add Tray-->
	<?php echo form_open('Tray/edit_tray/'.$tray->id,array('class'=>'form-horizontal','id'=>'tray_form'))?>
	<div class="widget-box closed-add" id="append_tray">
	<div class="widget-content">
		<div class="row-fluid">
			<div class="span12">
				<div class="control-group top-control">
					<label class="control-label">Kode Nampan</label>
					<div class="controls">
		                <input type="text" placeholder="Masukkan kode untuk baki" name="new_tray" class="span12" value="<?php echo $tray->code?>">
					</div>
				</div>
				<div class="control-group top-control">
					<label class="control-label">Keterangan</label>
					<div class="controls">
						<textarea name="tray_desc" class="span12"><?php echo $tray->description?></textarea>
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
	
</div>

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

</script>