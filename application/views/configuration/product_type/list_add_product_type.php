<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">
<link href="<?php echo base_url() ?>css/footable.core.css" type="text/css" rel="stylesheet">
<div class="container-fluid">
	<div class="row-fluid">
		<a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a>
        <a id="add_link" style="cursor: pointer;" class="pull-right">Tambah tipe produk baru <span class="fa fa-plus-circle"></span></a>
        <h2><?php echo $title?></h2>
	</div>
	<!--Form Add Tray-->
	<?php echo form_open('configuration/product_type',array('class'=>'form-horizontal'))?>
	<div class="widget-box closed-add" id="append_type" style="display: none">
	<div class="widget-title">
			<h5>Tambah tipe produk baru</h5>
	</div>
	<div class="widget-content">
		<div class="control-group top-control">
			<div class="row-fluid">
				<div class="span6">
					<label class="control-label">Kode Tipe Produk</label>
					<div class="controls">
		                <input type="text" placeholder="Masukkan 1 huruf sebagai kode untuk tipe produk" name="product_type_code" class="span12">
					</div>
				</div>
				<div class="span6">
					<label class="control-label">Tipe Produk</label>
					<div class="controls">
		                <input type="text" placeholder="Masukkan keterangan tipe produk" name="product_type_name" class="span12">
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
			<table class="table table-bordered" id="table_type" data-page-size="10" data-filter="#filter">
				<thead>
					<tr>
						<th data-type="numeric">No</th>
						<th data-type="numeric">Kode Tipe Produk</th>
						<th data-hide="phone">Tipe Produk</th>
						<th data-hide="phone">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if($types!=NULL): ?>
						<?php $i=1; ?>
						<?php foreach($types as $type): ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $type->code ?></td>
							<td><?php echo $type->name ?></td>
							<!-- <td>
								<?php #$outlet = $this->crud_model->get_by_condition('outlets', array('id'=>$customer->outlet_id))->row('name');
									#echo $outlet;
								?>
							</td> -->
							<td><a href="<?php echo base_url('configuration/edit_product_type/'.$type->id) ?>"><span class="mif mif-pencil"></span> Edit</a> - <a href="#" onclick="delete_type('<?php echo $type->id ?>','<?php echo $type->code ?>')"><span class="mif mif-bin"></span> Hapus</a></td>
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

<script>
	

    $(document).ready(function(){
        <?php if($this->session->flashdata('type')): ?>
            <?php echo $this->session->flashdata('type') ?>
        <?php endif; ?>
        $('#table_type').footable();
    });

    $('#add_link').click(function(){
    	if($('#append_type').hasClass('closed-add')){
    		$('#append_type').show();	
			$('#append_type').removeClass('closed-add');
    	}
    	else{
    		$('#append_type').hide();	
			$('#append_type').addClass('closed-add');	
    	}
    	
    });
    
	function delete_type(id,code){
		alertify.confirm("Apakah anda yakin ingin menghapus tipe "+code+"?",
		  function(){
		    window.location.assign("<?php echo base_url() ?>Configuration/delete_product_type/"+id);
		  },
		  function(){
		    $.gritter.add({
				 		title:	'Gagal!',
				 		text:	'Tipe produk gagal dihapus!',
				 		sticky: false
			});
		  });
	}
</script>