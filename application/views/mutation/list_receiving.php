<!--Both are css for alertify-->
<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">
<style>
	.red{
		color: red !important;
		font-weight: bold;
	}
	.green{
		color: green !important;
		font-weight: bold;
	}
	.btn-info,.btn-danger,.btn-success{
		font-size: 11px;
		width: 70%;
		
	}
</style>
<div class="container-fluid">
	<div class="row-fluid">
    	<a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar mutasi</a>
    	<h2><?php echo $title?></h2>
	</div>
	<div class="widget-box">
	<div class="widget-content">
			<div class="row-fluid">
				<div class="control-group">
			        <input type="text" placeholder="Cari..." id="filter" class="span12">
			    </div>
			</div>
	    <div class="cell table-responsive toggle-circle-filled">
	    	<table class="table table-bordered" id="table_received" data-filter="#filter" data-page-size="5">
	    		<thead>
					<tr>
						<th data-type="numeric">No</th>
						<th>Kode Mutasi</th>
						<th>Tanggal</th>
						<th data-hide="phone">Jumlah Barang</th>
						<th data-hide="phone">Asal</th>
						<th data-hide="phone">Tujuan</th>
						<th data-hide="phone">Status</th>
						<th data-hide="phone">Action</th>
					</tr>
				</thead>

				<tbody>
				<!-- ADMIN CAN SEE ALL THE RECEIVING MUTATION HAPPENING -->
					<?php if($role=='admin'):?>
						<?php if($all_receiveds!=NULL): ?>
							<?php $i=1; ?>
							<?php foreach($all_receiveds as $received): ?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $received->code ?></td>
								<td><?php echo date('d-M-Y H:i:s',strtotime($received->date)) ?></td>
								<td><?php echo $received->product_qty?></td>
								<td><?php echo $received->from_outlet ?></td>
								<td><?php echo $received->to_outlet ?></td>
								<td><p class="<?php echo ($received->status=='Pending')? 'red':'green' ?>"><?php echo $received->status ?></p></td>
								<td>
									<?php if($received->status == 'Pending'): ?>
										<a href="<?php echo base_url('mutation/receive_item/'.$received->code) ?>" class="btn btn-success">Accept</a> 
									<?php endif?>
									<a href="#" class="btn btn-danger" onclick="delete_mutation('<?php #echo $received->id ?>','<?php echo $received->code ?>')">Hapus</a></td>
							</tr>
							<?php $i++; ?>
							<?php endforeach; ?>
						<?php else:?>
							<tr>
								<td colspan="10" class="nocontent"><h3>Table kosong</h3></td>
							</tr>
						<?php endif;?>
				<!--end admin-->		
				<!--IF NOT ADMIN-->
					<?php else: ?>
						<?php if($received_transactions!=NULL): ?>
							<?php $i=1; ?>
							<?php foreach($received_transactions as $received_transaction): ?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $received_transaction->code ?></td>
								<td><?php echo date('d-M-Y H:i:s',strtotime($received_transaction->date)) ?></td>
								<td><?php echo $received_transaction->product_qty ?></td>
								<td><?php echo $received_transaction->from_outlet ?></td>
								<td><?php echo $received_transaction->to_outlet ?></td>
								<td><p class="<?php echo ($received_transaction->status=='Pending')? 'red':'green' ?>"><?php echo $received_transaction->status ?></p></td>
								<td>
									<?php if($received_transaction->status == 'Pending'): ?><a href="<?php echo base_url('mutation/receive_item/'.$received_transaction->code) ?>" class="btn btn-success">Accept</a><?php endif; ?>
								</td>
								
							</tr>
							<?php $i++; ?>
							<?php endforeach; ?>
						<?php else:?>
							<tr>
								<td colspan="10" class="nocontent"><h3>Table kosong</h3></td>
							</tr>
						<?php endif; ?>
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
<script src="<?php echo base_url() ?>js/alertify.min.js"></script>
<script>

    $(document).ready(function(){
        <?php if($this->session->flashdata('mutation')): ?>
            <?php echo $this->session->flashdata('mutation') ?>
        <?php endif; ?>

        $('#table_sent').footable();
        $('#table_received').footable();
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