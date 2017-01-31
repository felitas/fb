<!--Both are css for alertify-->
<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">

<div class="container-fluid">
	<div class="row-fluid">
    	<a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a>
    	<a href="<?php echo base_url('mutation/add_mutation') ?>" class="pull-right">Kirim Barang <span class="fa fa-arrow-circle-o-right"></span></a>
    	<h2>Daftar Pengiriman Barang</h2>
	</div>
	<div class="widget-box">
	<div class="widget-content">
		<div class="row-fluid">
			<div class="span12">
				<div class="control-group">
			        <input type="text" placeholder="Cari..." id="filter" >
			    </div>
			    <div class="cell table-responsive toggle-circle-filled">
			    	<table class="table table-bordered" id="table_mutation" data-filter="#filter" data-page-size="10">
			    		<thead>
							<tr>
								<th data-type="numeric">No</th>
								<th>Kode Mutasi</th>
								<th>Tanggal</th>
								<th data-hide="phone">Jumlah Barang</th>
								<th data-hide="phone">Asal</th>
								<th data-hide="phone">Tujuan</th>
								<th data-hide="phone">Status</th>
								<?php if($role=='admin'):?>
									<th data-hide="phone">Action</th>
								<?php endif?>
							</tr>
						</thead>
						<tbody>
							<?php if($mutations!=NULL): ?>
								<?php $i=1; ?>
								<?php foreach($mutations as $mutation): ?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $mutation->code ?></td>
									<td><?php echo $mutation->date ?></td>
									
									<td><?php echo $mutation->outlet_from ?></td>
									<td><?php echo $mutation->outlet_to ?></td>
									<td><?php echo $mutation->status ?></td>
									
									<?php if($role=='admin'):?>
										<td><a href="<?php echo base_url('mutation/edit_mutation/'.$mutation->code) ?>"><span class="mif mif-pencil"></span> Edit</a> - <a href="#" onclick="delete_mutation('<?php echo $mutation->id ?>','<?php echo $mutation->code ?>')"><span class="mif mif-bin"></span> Hapus</a></td>
									<?php endif?>
									
								</tr>
								<?php $i++; ?>
								<?php endforeach; ?>
							<?php else:?>
								<tr>
									<td colspan="10" class="nocontent"><h3>Table kosong</h3></td>
								</tr>
							<?php endif; ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="10">
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

    $(document).ready(function(){
        <?php if($this->session->flashdata('mutation')): ?>
            <?php echo $this->session->flashdata('mutation') ?>
        <?php endif; ?>

        $('#table_mutation').footable();
    });

    
	function delete_customer(id,code){
		alertify.confirm("Apakah anda yakin ingin menghapus data mutasi "+code+"?",
		  function(){
		    window.location.assign("<?php echo base_url() ?>mutation/delete_mutation/"+id);
		  },
		  function(){
		    $.gritter.add({
		    	title: 'Gagal!',
		    	text: 'Data mutasi tidak jadi dihapus',
		    	sticky: false
		    });
		  });
	}
</script>