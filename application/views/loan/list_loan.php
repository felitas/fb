<!--Both are css for alertify-->
<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">

<style type="text/css">
	.btn-info,.btn-danger{
		width: 60%;
		font-size: 11px;
	}
</style>

<div class="container-fluid">
	<div class="row-fluid">
    	<a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a>
    	<a href="<?php echo base_url('loan/new_loan') ?>" class="pull-right">Gadai Baru <span class="fa fa-arrow-circle-o-right"></span></a>
    	<h2>Daftar Transaksi Gadai</h2>
	</div>
	<div class="widget-box">
	<div class="widget-content">
		<div class="row-fluid">
			<div class="span12">
				<div class="control-group">
			        <input type="text" placeholder="Cari transaksi..." id="filter" class="span12">
			    </div>
			    <div class="table-responsive toggle-circle-filled">
			    	<table class="table table-bordered" id="table_loan" data-filter="#filter" data-page-size="10">
			    		<thead>
							<tr>
								<th data-type="numeric">No</th>
								<th>Kode Gadai</th>
								<th data-hide="phone">Kode Customer</th>
								<th data-hide="phone">Start</th>
								<th data-hide="phone">Due Date</th>
								<th data-hide="phone">Jumlah Barang</th>
								<th data-hide="phone">Total Pinjaman</th>
								<th data-hide="phone">Status</th>
								<th data-hide="phone">Keterangan</th>
								<?php if($role=='admin'):?>
									<th data-hide="phone">Outlet</th>
								<?php endif?>
								<th data-hide="phone">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if($loans!=NULL): ?>
								<?php $i=1; ?>
								<?php foreach($loans as $loan): ?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $loan->loan_code?></td>
									<td><?php echo $loan->customer_code ?></td>
									<td><?php echo $loan->date_start ?></td>
									<td><?php echo $loan->date_due ?></td>
									<td><?php echo $loan->total_item ?></td>
									<td><?php echo $loan->total_loan ?></td>
									<td><?php echo $loan->status ?></td>
									<td>
										<?php if($loan->description!=NULL):?>
											<?php echo $loan->description ?>
										<?php else:?>
											<?php echo '-' ?>
										<?php endif;?>
									</td>
									<?php if($role=='admin'):?>
										<td><?php echo $loan->outlet ?></td>
									<?php endif?>
									<td>
										<a href="<?php echo base_url('loan/edit_loan/'.$loan->code) ?>" class="btn btn-info">Edit</a>
										<?php if($role!='sales'):?>
											<a class="btn btn-danger" href="#" onclick="delete_loan('<?php echo $loan->id ?>','<?php echo $loan->code ?>')">Hapus</a>
										<?php endif?>
									</td>
								</tr>
								<?php $i++; ?>
								<?php endforeach; ?>
							<?php else:?>
								<tr>
									<td colspan="<?php echo ($role=='admin')?'11':'10' ?>" class="nocontent"><h3>Table kosong</h3></td>
								</tr>
							<?php endif; ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="<?php echo ($role=='admin')?'11':'10' ?>">
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
        <?php if($this->session->flashdata('loan')): ?>
            <?php echo $this->session->flashdata('loan') ?>
        <?php endif; ?>

        $('#table_loan').footable();
    });

    
	function delete_loan(id,code){
		alertify.confirm("Apakah anda yakin ingin menghapus transaksi gadai"+code+"?",
		  function(){
		    window.location.assign("<?php echo base_url() ?>loan/delete_loan/"+id);
		  },
		  function(){
		    $.gritter.add({
		    	title: 'Gagal!',
		    	text: 'Transaksi tidak jadi dihapus',
		    	sticky: false
		    });
		  });
	}
</script>