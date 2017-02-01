<!--Both are css for alertify-->
<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">

<div class="container-fluid">
	<div class="row-fluid">
    	<a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a>
    	<a href="<?php echo base_url('customer/add_customer') ?>" class="pull-right">Tambah Customer <span class="fa fa-arrow-circle-o-right"></span></a>
    	<h2>Daftar Customer</h2>
	</div>
	<div class="widget-box">
	<div class="widget-content">
		<div class="row-fluid">
			<div class="span12">
				<div class="control-group">
			        <input type="text" placeholder="Cari Customer" id="filter" class="span12">
			    </div>
			    <div class="table-responsive toggle-circle-filled">
			    	<table class="table table-bordered" id="table_customer" data-filter="#filter" data-page-size="10">
			    		<thead>
							<tr>
								<th data-type="numeric">No</th>
								<th>Nama</th>
								<th>Tanggal Lahir</th>
								<th data-hide="phone">Tipe</th>
								<th data-hide="phone">Telephone</th>
								<th data-hide="phone">Email</th>
								<th data-hide="phone">Alamat</th>
								<th data-hide="phone">Outlet</th>
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
									<td><?php echo $customer->name ?></td>
									<td>
										<?php if($customer->birthday!=NULL):?>
											<?php echo date('d M Y',strtotime($customer->birthday)) ?>
										<?php else:?>
											<?php echo '-' ?>
										<?php endif;?>
									</td>
									<td><?php echo $customer->type ?></td>
									<td><a href="tel:<?php echo $customer->phone ?>"><?php echo $customer->phone ?></a></td>
									<td><?php echo $customer->email ?></td>
									<td><?php echo $customer->address ?></td>
									<td>
										<?php $outlet = $this->crud_model->get_by_condition('outlets', array('id'=>$customer->outlet_id))->row('name');
											echo $outlet;
										?>
									</td>
									<?php if($role=='admin'):?>
										<td data-hide="phone"><?php echo $customer->grade ?></td>
									<?php endif?>
									<td><a href="<?php echo base_url('customer/edit_customer/'.$customer->id) ?>"><span class="mif mif-pencil"></span> Edit</a> - <a href="#" onclick="delete_customer('<?php echo $customer->id ?>','<?php echo $customer->name ?>')"><span class="mif mif-bin"></span> Hapus</a></td>
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
        <?php if($this->session->flashdata('customer')): ?>
            <?php echo $this->session->flashdata('customer') ?>
        <?php endif; ?>

        $('#table_customer').footable();
    });

    
	function delete_customer(id,name){
		alertify.confirm("Apakah anda yakin ingin menghapus customer "+name+"?",
		  function(){
		    window.location.assign("<?php echo base_url() ?>customer/delete_customer/"+id);
		  },
		  function(){
		    $.gritter.add({
		    	title: 'Gagal!',
		    	text: 'Customer tidak jadi dihapus',
		    	sticky: false
		    });
		  });
	}
</script>