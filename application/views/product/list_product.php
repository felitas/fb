<!--Both are css for alertify-->
<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">
<!--FOR FANCYBOX-->
<link  href="<?php echo base_url() ?>fancybox/source/jquery.fancybox.css" rel="stylesheet">

<style>
	.red{
		color: red !important;
	}
	.btn-info,.btn-danger{
		font-size: 11px;
		width: 60%;
	}
</style>
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
			        <input type="text" placeholder="Cari produk berdasarkan nama / tipe / kode / berat / tray / harga / status / lokasi" id="filter" class="span12">
			    </div>
				<div class="table-responsive toggle-circle-filled">
					<table class="table table-bordered" id="table_product" data-filter="#filter" data-page-size="20">
						<thead>
							<tr>
								<th data-type="numeric">No.</th>
								<th>Foto</th>
								<th>Nama</th>
								<th data-hide="phone" data-toggle="phone">Tipe</th>
								<!-- <th data-hide="phone" data-toggle="phone">Kategori</th> -->
								<!-- <th data-hide="phone" data-toggle="phone">Koleksi</th> -->
								<th data-hide="phone" data-toggle="phone">Kode Barang</th>
								<th data-hide="phone" data-toggle="phone">Kadar</th>
								<th data-hide="phone" data-toggle="phone">Berat</th>
								
								<th data-hide="phone" data-toggle="phone">Tray</th>
								<th data-hide="phone" data-toggle="phone">Harga Beli</th>
								<th data-hide="phone" data-toggle="phone">Harga Jual</th>
								<th data-hide="phone" data-toggle="phone">Status</th>
								<th data-hide="phone" data-toggle="phone">Lokasi</th>
								<th data-hide="phone" data-toggle="phone">Action</th>

							</tr>
						</thead>
						<tbody>
							<?php if($products!=NULL): ?>
								<?php $i = 1; ?>
								<?php foreach($products as $product): ?>
									<tr>
										<td><?php echo $i ?></td>
										<td><a id="product_image" href="<?php echo base_url().$product->photo ?>"><img width="30" src="<?php echo base_url().$product->photo ?>" alt=""/></a></td>
										<td><?php echo $product->name ?></td>
										<td><?php echo $product->type ?></td>
										<!-- <td><?php #echo $product->category ?></td> -->
										<!-- <td><?php #echo $product->model ?></td> -->
										<td><?php echo $product->product_code ?></td>
										<td><?php echo $product->gold_amount ?> %</td>
										<td><?php echo $product->weight ?> gram</td>
								
										<td><?php echo $product->tray ?></td>
										<td><?php echo 'Rp '. number_format($product->purchase_price,2,',','.') ?></td>
										<td><?php echo 'Rp '. number_format($product->sell_price,2,',','.') ?></td>
										<td>

											<p class="<?php echo ($product->status!='available')? 'red':'' ?>"><?php echo $product->status ?></p>
												
										</td>
										<td><?php echo $product->outlet ?></td>
										<td><a class="btn btn-info" href="<?php echo base_url('product/edit_product/'.$product->product_code) ?>">Edit</a><a class="btn btn-danger" href="#" onclick="delete_product('<?php echo $product->id ?>','<?php echo $product->name ?>')">Hapus</a></td>
									</tr>
								<?php $i++; ?>
								<?php endforeach ?>
							
							<?php else:?>
								<tr>
									<td colspan="13" class="text-center"><h3 class="text-center">Table kosong</h3></td>
								</tr>
							<?php endif; ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="13">
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
<script src="<?php echo base_url() ?>fancybox/source/jquery.fancybox.js"></script>

<script>
	function delete_product(id,name){
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
	    $("#product_image").fancybox();
	});
	
</script>