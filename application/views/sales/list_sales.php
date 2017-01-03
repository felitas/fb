<div class="container-fluid">
	<div class="row-fluid">
    	<a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a>
    	<a href="<?php echo base_url('sales/add_sales') ?>" class="pull-right">Tambah Sales <span class="fa fa-arrow-circle-o-right"></span></a>
    	<h2 style="margin-bottom: 20px;">Daftar Sales</h2>
    	<hr>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="input-control text full-size">
		        <input type="text" placeholder="Cari Sales" id="filter" >
		    </div>
			<div class="cell table-responsive toggle-circle-filled">
				<table class="table hovered border table-condensed" id="table_sales" data-filter="#filter" data-page-size="10">
					<thead>
						<tr>
							<th data-type="numeric">No.</th>
							<th>Nama</th>
							<th data-hide="phone" data-toggle>Telephone</th>
							<th data-hide="phone">Email</th>
							<th data-hide="phone">Alamat</th>
							<th data-hide="phone">Outlet</th>
							<th data-hide="phone">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if($sales!=NULL): ?>
							<?php $i = 1; ?>
							<?php foreach($sales as $row): ?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $row->name ?></td>
									<td><a href="tel:<?php echo $row->phone ?>"><?php echo $row->phone ?></a></td>
									<td><?php echo $row->email ?></td>
									<td><?php echo $row->address ?></td>
									<td><?php echo $row->outlet_name ?></td>
									<td><a href="<?php echo base_url('sales/edit_sales/'.$row->id) ?>"><span class="mif mif-pencil"></span> Edit</a> - <a href="#" onclick="delete_sales('<?php echo $row->id ?>','<?php echo $row->name ?>')"><span class="mif mif-bin"></span> Hapus</a></td>
								</tr>
							<?php $i++; ?>
							<?php endforeach ?>
						
						<?php else:?>
							<tr>
								<td colspan="7" class="text-center"><h3>Table kosong</h3></td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>	
	</div>
</div>

<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">
<script src="<?php echo base_url() ?>js/alertify.min.js"></script>
<script src="<?php echo base_url() ?>js/footable.js"></script>
<script src="<?php echo base_url() ?>js/footable.filter.js"></script>
<script src="<?php echo base_url() ?>js/footable.paginate.js"></script>
<script src="<?php echo base_url() ?>js/footable.sort.js" type="text/javascript"></script>

<script>
	function delete_sales(id,name){
		alertify.confirm("Apakah anda yakin ingin menghapus Sales "+name,
		  function(){
		    window.location.assign("<?php echo base_url() ?>sales/delete_sales/"+id);
		  },
		  function(){
		    $.gritter.add({
		 		title:	'Gagal!',
		 		text:	'Sales tidak jadi dihapus',
		 		sticky: false,

		 	});		
		  });
	}
	$(document).ready(function(){
		<?php if($this->session->flashdata('sales')): ?>

	       <?php echo $this->session->flashdata('sales') ?>

	    <?php endif; ?>

	    $('#table_sales').footable();
	});
	
</script>