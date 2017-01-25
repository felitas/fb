<!--Both are css for alertify-->
<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">

<div class="container-fluid">
	<div class="row-fluid">
    	<a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a>
    	<a href="<?php echo base_url('product/add_product') ?>" class="pull-right">Tambah Produk <span class="fa fa-arrow-circle-o-right"></span></a>
    	<h2>Daftar Produk</h2>
	</div>
	<div class="widget-box">
    <div class="widget-content">
		<div class="row-fluid">
			<div class="span12">
				<div class="control-group">
			        <input type="text" placeholder="Cari Sales" id="filter" >
			    </div>
				<div class="table-responsive toggle-circle-filled">
					<table class="table table-bordered" id="table_product" data-filter="#filter" data-page-size="10">
						<thead>
							<tr>
								<th data-type="numeric">No.</th>
								<th>Nama</th>
								<th data-hide="phone" data-toggle="phone">Kode Barcode</th>
								<th data-hide="phone" data-toggle="phone">Kode Barang</th>
								<th data-hide="phone" data-toggle="phone">Harga Beli</th>
								<th data-hide="phone" data-toggle="phone">Harga Jual</th>
								<th data-hide="phone" data-toggle="phone">Kadar</th>
								<th data-hide="phone" data-toggle="phone">Berat</th>
								<th data-hide="phone" data-toggle="phone">Outlet</th>
								<th data-hide="phone" data-toggle="phone">Tray</th>
								<th data-hide="phone" data-toggle="phone">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if($products!=NULL): ?>
								<?php $i = 1; ?>
								<?php foreach($products as $product): ?>
									<tr>
										<td><?php echo $i ?></td>
										<td><?php echo $product->name ?></td>
										<td><?php echo $product->barcode_code ?></td>
										<td><?php echo $product->product_code ?></td>
										<td><?php echo $product->purchase_price ?></td>
										<td><?php echo $product->sell_price ?></td>
										<td><?php echo $product->gold_amount ?> %</td>
										<td><?php echo $product->weight ?> gram</td>
										<td><?php echo $product->outlet_id ?></td>
										<td><?php echo $product->tray_code ?></td>
										<td><a href="<?php echo base_url('product/edit_product/'.$product->id) ?>"><span class="mif mif-pencil"></span> Edit</a> - <a href="#" onclick="delete_product('<?php echo $product->id ?>','<?php echo $product->name ?>')"><span class="mif mif-bin"></span> Hapus</a></td>
									</tr>
								<?php $i++; ?>
								<?php endforeach ?>
							
							<?php else:?>
								<tr>
									<td colspan="11" class="text-center"><h3 class="text-center">Table kosong</h3></td>
								</tr>
							<?php endif; ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="11">
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
	function delete_sales(id,name){
		alertify.confirm("Apakah anda yakin ingin menghapus produk "+name,
		  function(){
		    window.location.assign("<?php echo base_url() ?>product/delete_product/"+id);
		  },
		  function(){
		    $.gritter.add({
		 		title:	'Gagal!',
		 		text:	'Produk tidak jadi dihapus',
		 		sticky: false,

		 	});		
		  });
	}
	$(document).ready(function(){
		<?php if($this->session->flashdata('product')): ?>

	       <?php echo $this->session->flashdata('product') ?>

	    <?php endif; ?>

	    $('#table_product').footable();
	});
	
</script>