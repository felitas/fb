<!--Both are css for alertify-->
<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">

<div class="container-fluid">
	<div class="row-fluid">
    	<a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a>
    	<a href="<?php echo base_url('supplier/add_supplier') ?>" class="pull-right">Tambah Supplier <span class="fa fa-arrow-circle-o-right"></span></a>
    	<h2>Daftar Supplier</h2>
	</div>
	<div class="widget-box">
	<div class="widget-content">
		<div class="row-fluid">
			<div class="span12">
		    	<div class="input-control text full-size">
			        <input type="text" placeholder="Cari Supplier" id="filter" >
			    </div>
				<div class="cell table-responsive toggle-circle-filled">
					<table class="table table-bordered" id="supplier_table" data-filter="#filter" data-page-size="10">
						<thead>
							<tr>
								<th data-type="numeric">No</th>
								<th>Nama</th>
								<th data-hide="phone">Telephone</th>
								<th data-hide="phone">Email</th>
								<th data-hide="phone">Alamat</th>
								<th data-hide="phone">Keterangan</th>
								<th data-hide="phone">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if($suppliers!=NULL): ?>
								<?php $i=1; ?>
								<?php foreach($suppliers as $supplier): ?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $supplier->name ?></td>
									<td><a href="tel:<?php echo $supplier->phone ?>"><?php echo $supplier->phone ?></a></td>
									<td><?php echo $supplier->email ?></td>
									<td><?php echo $supplier->address ?></td>
									<td><?php echo $supplier->description ?></td>
									<td><a href="<?php echo base_url('supplier/edit_supplier/'.$supplier->id) ?>"><span class="mif mif-pencil"></span> Edit</a> - <a href="#" onclick="delete_supplier('<?php echo $supplier->id ?>','<?php echo $supplier->name ?>')"><span class="mif mif-bin"></span> Hapus</a></td>
								</tr>
								<?php $i++;?>
								<?php endforeach; ?>
							<?php else:?>
								<tr>
									<td colspan="7" class="text-center nocontent"><h3>Table kosong</h3></td>
								</tr>
							<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>

<script src="<?php echo base_url() ?>js/alertify.min.js"></script>

<script>
    $(document).ready(function(){
        <?php if($this->session->flashdata('supplier')): ?>
            <?php echo $this->session->flashdata('supplier') ?>
        <?php endif; ?>

        $('#supplier_table').footable();
    });

    
	function delete_supplier(id,name){
		alertify.confirm("Apakah anda yakin ingin menghapus Supplier "+name,
		  function(){
		    window.location.assign("<?php echo base_url() ?>supplier/delete_supplier/"+id);
		  },
		  function(){
		    $.gritter.add({
		 		title:	'Gagal!',
		 		text:	'Supplier tidak jadi dihapus',
		 		sticky: false,

		 	});		
		  });
	}
</script>