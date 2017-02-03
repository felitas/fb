<!--Both are css for alertify-->
<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">
<style>
	.red{
		color: red !important;
	}
</style>
<div class="container-fluid">
	<div class="row-fluid">
    	<a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a>
    	<h2>Daftar Pengiriman Barang</h2>
	</div>
	<div class="widget-box">
	<div class="widget-content">
		<div class="row-fluid">
				<div class="control-group">
			        <input type="text" placeholder="Cari..." id="filter" class="span12">
			    </div>
		</div>
	    <div class="table-responsive toggle-circle-filled">
	    	<table class="table table-bordered" id="table_sent" data-filter="#filter" data-page-size="5">
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
					<!-- ADMIN CAN SEE ALL THE MUTATION HAPPENING -->
					<?php if($role=='admin'):?>
						<?php if($all_sents!=NULL): ?>
							<?php $i=1; ?>
							<?php foreach($all_sents as $sent): ?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $sent->code ?></td>
								<td><?php echo date('d-M-Y H:i:s',strtotime($sent->date)) ?></td>
								<td><?php echo $sent->product_qty?></td>
								<td><?php echo $sent->from_outlet ?></td>
								<td><?php echo $sent->to_outlet ?></td>
								<td><p class="<?php echo ($sent->status=='Pending')? 'red':'' ?>"><?php echo $sent->status ?></p></td>
								<td><a href="<?php echo base_url('mutation/edit_mutation/'.$sent->code) ?>"><span class="mif mif-pencil"></span> Edit</a> - <a href="#" onclick="delete_mutation('<?php echo $sent->id ?>','<?php echo $sent->code ?>')"><span class="mif mif-bin"></span> Hapus</a></td>
							</tr>
							<?php $i++; ?>
							<?php endforeach; ?>
						<?php else:?>
							<tr>
								<td colspan="10" class="nocontent"><h3>Table kosong</h3></td>
							</tr>
						<?php endif;?>
					<!--IF NOT ADMIN-->
					<?php else: ?>
						<?php if($sent_transactions!=NULL): ?>
							<?php $i=1; ?>
							<?php foreach($sent_transactions as $sent_transaction): ?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $sent_transaction->code ?></td>
								<td><?php echo date('d-M-Y H:i:s',strtotime($sent_transaction->date)) ?></td>
								<td><?php echo $sent_transaction->product_qty?></td>
								<td><?php echo $sent_transaction->from_outlet ?></td>
								<td><?php echo $sent_transaction->to_outlet ?></td>
								<td><p class="<?php echo ($sent_transaction->status=='Pending')? 'red':'' ?>"><?php echo $sent_transaction->status ?></p></td>
								<td><a href="<?php echo base_url('mutation/edit_mutation/'.$sent_transaction->code) ?>"><span class="mif mif-pencil"></span> Edit</a> - <a href="#" onclick="delete_mutation('<?php echo $sent_transaction->id ?>','<?php echo $sent_transaction->code ?>')"><span class="mif mif-bin"></span> Hapus</a></td>
							
								
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
	<div class="row-fluid">
    	<h2>Daftar Penerimaan Barang</h2>
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
				<!-- ADMIN CAN SEE ALL THE MUTATION HAPPENING -->
					<?php if($role=='admin'):?>
						<?php if($all_sents!=NULL): ?>
							<?php $i=1; ?>
							<?php foreach($all_receiveds as $received): ?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $received->code ?></td>
								<td><?php echo date('d-M-Y H:i:s',strtotime($received->date)) ?></td>
								<td><?php echo $received->product_qty?></td>
								<td><?php echo $received->from_outlet ?></td>
								<td><?php echo $received->to_outlet ?></td>
								<td><p class="<?php echo ($received->status=='Pending')? 'red':'' ?>"><?php echo $received->status ?></p></td>
								<td><a href="<?php echo base_url('mutation/receive_item/'.$received->code) ?>" class="btn btn-success">Accept</a> <a href="#" class="btn btn-danger" onclick="delete_mutation('<?php echo $received->id ?>','<?php echo $received->code ?>')">Hapus</a></td>
							</tr>
							<?php $i++; ?>
							<?php endforeach; ?>
						<?php else:?>
							<tr>
								<td colspan="10" class="nocontent"><h3>Table kosong</h3></td>
							</tr>
						<?php endif;?>
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
								<td><p class="<?php echo ($received_transaction->status=='Pending')? 'red':'' ?>"><?php echo $received_transaction->status ?></p></td>
								<td><a href="<?php echo base_url('mutation/receive_item/'.$received_transaction->code) ?>" class="btn btn-success">Accept</a></td>
								
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