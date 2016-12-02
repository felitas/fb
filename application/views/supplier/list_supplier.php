<link href="<?php echo base_url() ?>css/footable.core.css" type="text/css" rel="stylesheet">
<div class="container">
	<div class="grid">
		<div class="row">
	        <div class="cell">
	            <h3 style="display: inline-block;"><small><a href="<?php echo base_url() ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Menu</a></small></h3>
	            <h3 style="display:inline-block;float:right;"><small><a href="<?php echo base_url('supplier/add_supplier') ?>">Tambah Supplier <span class="fa fa-arrow-circle-o-right"></span></a></small></h3>
	        </div>
	    </div>
		<div class="row form-title">
	        <div class="cell">
	            <h1 style="margin-bottom: 20px;">Daftar Supplier</h1>
	            <hr class="bg-primary">    
	        </div>
	    </div>
	    <div class="row">
	    	<div class="cell">
	    		<div class="input-control text full-size">
                    <input type="text" placeholder="Cari supplier" id="filter" >
                </div>
	    	</div>
	    </div>
		<div class="row">
			<div class="cell">
				<div class="table-responsive toggle-circle-filled">
				<table class="table table-condensed" id="supplier_table" data-filter="#filter" data-page-size="10">
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
								<td colspan="7" class="text-center"><h3>Table kosong</h3></td>
							</tr>
						<?php endif ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>
<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">
<script src="<?php echo base_url() ?>js/footable.js"></script>
<script src="<?php echo base_url() ?>js/footable.filter.js"></script>
<script src="<?php echo base_url() ?>js/footable.paginate.js"></script>
<script src="<?php echo base_url() ?>js/footable.sort.js" type="text/javascript"></script>

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
		    $.Notify({caption: 'Gagal !', content: 'Supplier gagal dihapus', type: 'alert'});
		  });
	}
</script>