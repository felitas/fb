<div id="content-header">
    <div id="breadcrumb"> 
    	<a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a>
    	<a href="<?php echo base_url('customer/add_customer') ?>">Tambah Customer <span class="fa fa-arrow-circle-o-right"></span></a>
    </div>
    <h1 style="margin-bottom: 20px;">Daftar Customer</h1>
</div>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="input-control text full-size">
		        <input type="text" placeholder="Cari Customer" id="filter" >
		    </div>
		    <div class="cell table-responsive toggle-circle-filled">
		    	<table class="table hovered border table-condensed" id="table_customer" data-filter="#filter" data-page-size="10">
		    		<thead>
						<tr>
							<th data-type="numeric">No</th>
							<th>Nama</th>
							<th data-hide="phone">Tipe</th>
							<th data-hide="phone">Telephone</th>
							<th data-hide="phone">Email</th>
							<th data-hide="phone">Alamat</th>
							<th data-hide="phone">Outlet</th>
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
								<td><?php echo $customer->type ?></td>
								<td><a href="tel:<?php echo $customer->phone ?>"><?php echo $customer->phone ?></a></td>
								<td><?php echo $customer->email ?></td>
								<td><?php echo $customer->address ?></td>
								<td>
									<?php $outlet = $this->crud_model->get_by_condition('outlets', array('id'=>$customer->outlet_id))->row('name');
										echo $outlet;
									?>
								</td>
								<td><a href="<?php echo base_url('customer/edit_customer/'.$customer->id) ?>"><span class="mif mif-pencil"></span> Edit</a> - <a href="#" onclick="delete_customer('<?php echo $customer->id ?>','<?php echo $customer->name ?>')"><span class="mif mif-bin"></span> Hapus</a></td>
							</tr>
							<?php $i++; ?>
							<?php endforeach; ?>
						<?php else:?>
							<tr>
								<td colspan="8" class="text-center"><h3>Table kosong</h3></td>
							</tr>
						<?php endif; ?>
					</tbody>	
		    	</table>
		    </div>
		</div>
	</div>
</div>

<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">
<script src="<?php echo base_url() ?>js/alertify.min.js"></script>
<script src="<?php echo base_url() ?>js/footable.js"></script>
<script src="<?php echo base_url() ?>js/footable.filter.js"></script>
<script src="<?php echo base_url() ?>js/footable.paginate.js"></script>
<script src="<?php echo base_url() ?>js/footable.sort.js" type="text/javascript"></script>

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
		    $.Notify({caption: 'Gagal !', content: 'Customer gagal dihapus', type: 'alert'});
		  });
	}
</script>