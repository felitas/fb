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
    	<a href="<?php echo base_url('absence') ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar absen</a>
    	<h2>Absensi</h2>
	</div>
	<div class="widget-box">
	<div class="widget-content">
		<div class="row-fluid">
			<div class="span12">
				<div class="control-group">
			        <input type="text" placeholder="Cari customer berdasarkan nama / tanggal lahir / tipe / telephone / email / alamat / outlet" id="filter" class="span12">
			    </div>
			    <div class="table-responsive toggle-circle-filled">
			    	<table class="table table-bordered" id="table_customer" data-filter="#filter" data-page-size="10">
			    		<thead>
							<tr>
								<th data-type="numeric">No</th>
								<th>Kode Pelanggan</th>
								<th>Nama</th>
								<th data-hide="phone">Tanggal Lahir</th>
								<th data-hide="phone">No.KTP</th>
								<th data-hide="phone">Tipe</th>
								<th data-hide="phone">Telephone</th>
								<th data-hide="phone">Email</th>
								<th data-hide="phone">Alamat</th>
								<?php if($role=='admin'):?>
									<th data-hide="phone">Grade</th>
								<?php endif?>
								<th data-hide="phone">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if($customers!=NULL): ?>
								<?php $i=1; ?>
								<?php foreach($customers as $customer): ?>
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $customer->customer_code?></td>
									<td><?php echo $customer->name ?></td>
									<td>
										<?php if($customer->birthday!=NULL):?>
											<?php echo date('d M Y',strtotime($customer->birthday)) ?>
										<?php else:?>
											<?php echo '-' ?>
										<?php endif;?>
									</td>
									<td><?php echo $customer->ktp?></td>
									<td><?php echo $customer->type ?></td>
									<td><a href="tel:<?php echo $customer->phone ?>"><?php echo $customer->phone ?></a></td>
									<td><?php echo $customer->email ?></td>
									<td><?php echo $customer->address ?></td>
									<?php if($role=='admin'):?>
										<td data-hide="phone"><?php echo $customer->customer_grade ?></td>
										<td><a href="<?php echo base_url('customer/edit_customer/'.$customer->id) ?>" class="btn btn-info">Edit</a><a class="btn btn-danger" href="#" onclick="delete_customer('<?php echo $customer->id ?>','<?php echo $customer->name ?>')">Hapus</a></td>
									<?php endif?>
								</tr>
								<?php $i++; ?>
								<?php endforeach; ?>
							<?php else:?>
								<tr>
									<td colspan="<?php echo ($role=='admin')?'11':'9' ?>" class="nocontent"><h3>Table kosong</h3></td>
								</tr>
							<?php endif; ?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="<?php echo ($role=='admin')?'11':'9' ?>">
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
        <?php if($this->session->flashdata('customer')): ?>
            <?php echo $this->session->flashdata('customer') ?>
        <?php endif; ?>

        $('#table_customer').footable();
    });
</script>