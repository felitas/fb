<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">
<link href="<?php echo base_url() ?>css/footable.core.css" type="text/css" rel="stylesheet">
<div class="container">
	<div class="grid">
		<div class="row">
	        <div class="cell">
	            <h3 style="display: inline-block;"><small><a href="<?php echo base_url() ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a></small></h3>
	            <h3 style="display:inline-block;float:right;"><small><a id="add_link" style="cursor: pointer;">Tambah kadar emas <span class="fa fa-plus-circle"></span></a></small></h3>
	        </div>
	    </div>
	</div>
	<div class="grid condensed">
		<!--Form Add Tray-->
		<?php echo form_open('configuration/gold_amount')?>
		<div class="row cells2 closed-add" id="append_tray" style="display: none">
			<h3 style="margin-bottom: 20px;">Tambah Kadar Baru</h3>
            <hr class="bg-primary">	
    		<div class="cell">
    			<label>Kadar Emas</label>
                <div class="input-control text full-size">
                    <input type="text" placeholder="Masukkan kadar emas" name="original" data-validate-func="required" data-validate-hint="Kadar emas harus diisi">
                </div>
    		</div>
    		<div class="cell">
    			
    			<label>Kadar Emas (Markup)</label>
                <div class="input-control text full-size">
                    <input type="text" placeholder="Masukkan markup kadar emas" name="marked_up" data-validate-func="required" data-validate-hint="Markup harus diisi">
                </div>
    		</div>
            <div class="cell colspan2 text-center">
               <input type="Submit" name="submit" id="submit" class="button bg-primary btn-teal" value="Submit" disabled="disabled"> 
            </div>
    	</div>
    	<?php echo form_close()?>
    	<!--End Form-->
	    <div class="row">
	    	<div class="cell">
	    		<h3 style="margin-bottom: 20px;">Kadar Emas</h3>
				<hr class="bg-primary">	
	    		<div class="input-control text full-size">
                    <input type="text" placeholder="Cari..." id="filter" >
                </div>
	    	</div>
	    </div>
		<div class="row">
			<div class="cell">
				<div class="table-responsive toggle-circle-filled">
				<table class="table table-condensed" id="table_tray" data-page-size="10" data-filter="#filter">
					<thead>
						<tr>
							<th data-type="numeric">No</th>
							<th data-type="numeric">Kadar Emas</th>
							<th data-type="numeric">Markup Kadar Emas</th>
							<th data-hide="phone">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if($gold_amount!=NULL): ?>
							<?php $i=1; ?>
							<?php foreach($gold_amount as $row): ?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $row->original ?>%</td>
								<td><?php echo $row->marked_up ?>%</td>
								<td>edit delete</td>
							</tr>
							<?php $i++; ?>
							<?php endforeach; ?>
						<?php else: ?>
							<tr>
								<td colspan="3" class="text-center"><h3>Table kosong</h3></td>
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
<script src="<?php echo base_url() ?>js/footable.js"></script>
<script src="<?php echo base_url() ?>js/footable.filter.js"></script>
<script src="<?php echo base_url() ?>js/footable.paginate.js"></script>
<script src="<?php echo base_url() ?>js/footable.sort.js" type="text/javascript"></script>

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
			$('#submit').removeAttr('disabled');
    	}
    	else{
    		$('#append_tray').hide();	
			$('#append_tray').addClass('closed-add');	
			$('#submit').attr('disabled','disabled');
    	}
    	
    });
</script>