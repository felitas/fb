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
        <h2>Edit Target Perolehan Poin Member</h2>
	</div>
	<!--Form edit pengaturan-->
	<?php echo form_open('configuration/edit_member_points/'.$point->id,array('class'=>'form-horizontal','id'=>'point_form'))?>
	<div class="widget-box">
	
	<div class="widget-content">
			<div class="control-group top-control">
				<div class="row-fluid">
					<label class="control-label">Nama Target</label>
						<div class="controls">
			                <input type="text" placeholder="Masukkan nama target poin member" name="point_name" class="span12" value="<?php echo $point->name?>">
						</div>
				</div>
				<div class="row-fluid">
					<div class="span7">
						<label class="control-label">Target kelipatan transaksi</label>
						<div class="controls">
			                <input type="number" placeholder="Masukkan nominal target transaksi dalam rupiah" name="point_target" class="span12" value="<?php echo $point->target?>">
						</div>
					</div>	
					<div class="span5">
						<label class="control-label">Jumlah poin yang didapat</label>
						<div class="controls">
			                <input type="number" placeholder="Masukkan jumlah poin" name="point_amount" class="span12" value="<?php echo $point->amount?>">
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


</script>