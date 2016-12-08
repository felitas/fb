<div id="content-header">
    <div id="breadcrumb"> 
    	<a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a>
    	<a href="<?php echo base_url('outlets/add_outlet') ?>">Tambah Outlet <span class="fa fa-arrow-circle-o-right"></span></a>
    </div>
    <h1 style="margin-bottom: 20px;">Daftar Outlet</h1>
</div>
<div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
		<div class="input-control text full-size">
            <input type="text" placeholder="Cari Outlet" id="filter" >
        </div>
	    <div class="cell table-responsive toggle-circle-filled">
				<table class="table hovered border table-condensed" id="table_outlet" data-filter="#filter" data-page-size="10">
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
	function delete_outlet(id,name){
		alertify.confirm("Apakah anda yakin ingin menghapus Toko "+name,
		  function(){
		    window.location.assign("<?php echo base_url() ?>outlets/delete_outlet/"+id);
		  },
		  function(){
		    $.Notify({caption: 'Gagal !', content: 'Toko gagal dihapus', type: 'alert'});
		  });
	}

	$(document).ready(function(){
		<?php if($this->session->flashdata('outlet')): ?>

	       <?php echo $this->session->flashdata('outlet') ?>

	    <?php endif; ?>

	    alert('felita');

	    $('#table_outlet').footable();


	});

	
</script>