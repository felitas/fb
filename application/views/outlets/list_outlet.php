<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">
<div class="container-fluid">
	<div class="row-fluid">
    	<a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a>
    	<a href="<?php echo base_url('outlets/add_outlet') ?>" class="pull-right">Tambah Outlet <span class="fa fa-arrow-circle-o-right"></span></a>
    	<h2>Daftar Outlet</h2>
	</div>
	<div class="widget-box">
    <div class="widget-content">
	    <div class="row-fluid">
	      <div class="span12">
			<div class="control-group">
	            <input type="text" placeholder="Cari Outlet" id="filter" class="span12">
	        </div>
		    <div class="table-responsive toggle-circle-filled">
					<table class="table table-bordered" id="table_outlet" data-filter="#filter" data-page-size="10">
						<thead>
							<tr>
								<th data-type="numeric">No.</th>
								<th data-hide="phone">Kode</th>
								<th >Nama</th>
								<th data-hide="phone">Telp</th>
								<th data-hide="phone">Alamat</th>
								<th data-hide="phone">Manager</th>
								<th data-hide="phone">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if($outlets !=NULL): ?>
								<?php $i = 1; ?>
								<?php foreach($outlets as $outlet): ?>
									<tr>
										<td><?php echo $i ?></td>
										<td><?php echo $outlet->code ?></td>
										<td><?php echo $outlet->name ?></td>
										<td><a href="tel:<?php echo $outlet->phone ?>"><?php echo $outlet->phone ?></a></td>
										<td><?php echo $outlet->address ?></td>
										<td><?php echo $outlet->store_manager ?></td>
										<td><a href="<?php echo base_url('outlets/edit_outlet/'.$outlet->id) ?>"><span class="mif mif-pencil"></span> Edit</a> - <a href="#" onclick="delete_outlet('<?php echo $outlet->id ?>','<?php echo $outlet->name ?>')"><span class="mif mif-bin"></span> Hapus</a></td>
									</tr>		
									<?php $i++; ?>
								<?php endforeach; ?>
							<?php else:?>
								<tr>
									<td colspan="7" class="nocontent"><h3>Table kosong</h3></td>
								</tr>
							<?php endif; ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="7">
									<div class="pagination pagination-centered"></div>
								</td>
							</tr>
						</tfoot>
					</table>
			</div>
		</div>
	</div>
	</div>
</div>
</div>


<script src="<?php echo base_url() ?>js/alertify.min.js"></script>

<script>
	function delete_outlet(id,name){
		alertify.confirm("Apakah anda yakin ingin menghapus Toko "+name+"?",
		  function(){
		    window.location.assign("<?php echo base_url() ?>outlets/delete_outlet/"+id);
		  },
		  function(){
		 	$.gritter.add({
		 		title:	'Gagal!',
		 		text:	'Toko tidak jadi dihapus',
		 		sticky: false,

		 	});		
		  });
	}

	$(document).ready(function(){
		<?php if($this->session->flashdata('outlet')): ?>

	       <?php echo $this->session->flashdata('outlet') ?>

	    <?php endif; ?>

	    $('#table_outlet').footable();


	});

	
</script>