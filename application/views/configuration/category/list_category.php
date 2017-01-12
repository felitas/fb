<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">
<link href="<?php echo base_url() ?>css/footable.core.css" type="text/css" rel="stylesheet">
<div class="container-fluid">
	<div class="row-fluid">
		<a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a>
        <a id="add_link" style="cursor: pointer;">Tambah kategori baru <span class="fa fa-plus-circle"></span></a>
        <h2>Daftar Kategori Barang</h2>
	</div>
	<!--Form Add category-->
	<?php echo form_open('configuration/list_add_category',array('class'=>'form-horizontal'))?>
	<div class="widget-box closed-add" id="append_tray" style="display: none">
	<div class="widget-title">
			<h5>Tambah Kategori Baru</h5>
	</div>
	<div class="widget-content">
		<div class="span6">
			<div class="control-group top-control">
				<label class="control-label">Nama Kategori</label>
				<div class="controls">
	                <input type="text" placeholder="Masukkan nama kategori" name="category_name" class="span12">
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="control-group top-control">
				<label class="control-label">Kode Kategori</label>
				<div class="controls">
	                <input type="text" placeholder="Masukkan kode untuk kategori (1 Huruf/Angka)" name="category_code" class="span12">
				</div>
			</div>
		</div>
	
		<div class="form-actions text-center">
			<input type="Submit" name="submit" class="btn btn-info" value="Submit">
		</div>
		
	</div>
	</div>
	<?php echo form_close()?>
	<!--End Form-->
	<!--widget box for the table for category list-->
	<div class="widget-box">
	<div class="widget-content">
		<div class="row-fluid">
    		<div class="control-group">
                <input type="text" placeholder="Cari..." id="filter" >
            </div>
			<div class="table-responsive toggle-circle-filled">
			<table class="table table-bordered" id="table_tray" data-page-size="10" data-filter="#filter">
				<thead>
					<tr>
						<th data-type="numeric">No</th>
						<th data-type="numeric">Kode Baki</th>
						<th data-hide="phone">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if($trays!=NULL): ?>
						<?php $i=1; ?>
						<?php foreach($trays as $tray): ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $tray->code ?></td>
							<!-- <td>
								<?php #$outlet = $this->crud_model->get_by_condition('outlets', array('id'=>$customer->outlet_id))->row('name');
									#echo $outlet;
								?>
							</td> -->
							<td><a href="<?php echo base_url('tray/edit_tray/'.$tray->id) ?>"><span class="mif mif-pencil"></span> Edit</a> - <a href="#" onclick="delete_tray('<?php echo $tray->id ?>','<?php echo $tray->code ?>')"><span class="mif mif-bin"></span> Hapus</a></td>
						</tr>
						<?php $i++; ?>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="3"><h3  class="text-center">Table kosong</h3></td>
						</tr>
					<?php endif; ?>

				</tbody>
			</table>
			</div>
			
		</div>
	</div>
	</div>
	<!--End widget box-->
	            
	    <div class="row">
	    	<div class="cell">
	    		<h3 style="margin-bottom: 20px;">Kategori Emas</h3>
				<hr class="bg-primary">	
	    		<div class="input-control text full-size">
                    <input type="text" placeholder="Cari..." id="filter" >
                </div>
	    	</div>
	    </div>
		<div class="row">
			<div class="cell">
				<div class="table-responsive toggle-circle-filled">
				<table class="table table-condensed category-table" data-page-size="10" data-filter="#filter">
					<thead>
						<tr>
							<th data-type="numeric">No</th>
							<th >Nama</th>
							<th data-hide="phone">Kode</th>
							<th data-hide="phone">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if($category_gold): ?>
							<?php $i=1; ?>
							<?php foreach($category_gold as $row): ?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $row->name ?></td>
								<td><?php echo $row->code ?></td>
								<td><a href="#"><span class="mif mif-pencil"></span> Edit</a> - <a href="#" ><span class="mif mif-bin"></span> Hapus</a></td>
							</tr>
							<?php $i++; ?>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
		<div class="row">
	    	<div class="cell">
	    		<h3 style="margin-bottom: 20px;">Kategori Berlian</h3>
				<hr class="bg-primary">	
	    		<div class="input-control text full-size">
                    <input type="text" placeholder="Cari..." id="filter" >
                </div>
	    	</div>
	    </div>
		<div class="row">
			<div class="cell">
				<div class="table-responsive toggle-circle-filled">
				<table class="table table-condensed category-table" data-page-size="10" data-filter="#filter">
					<thead>
						<tr>
							<th data-type="numeric">No</th>
							<th >Nama</th>
							<th data-hide="phone">Kode</th>
							<th data-hide="phone">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if($category_diamond): ?>
							<?php $i=1; ?>
							<?php foreach($category_diamond as $row): ?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $row->name ?></td>
								<td><?php echo $row->code ?></td>
								<td><a href="<?php echo base_url('category/edit_category/'.$row->id) ?>"><span class="mif mif-pencil"></span> Edit</a> - <a href="#" onclick="delete_category('<?php echo $row->id ?>','<?php echo $row->code ?>')"><span class="mif mif-bin"></span> Hapus</a></td>
							</tr>
							<?php $i++; ?>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url() ?>js/alertify.min.js"></script>
<script src="<?php echo base_url() ?>js/footable.js"></script>
<script src="<?php echo base_url() ?>js/footable.filter.js"></script>
<script src="<?php echo base_url() ?>js/footable.paginate.js"></script>
<script src="<?php echo base_url() ?>js/footable.sort.js" type="text/javascript"></script>

<script>
	

    $(document).ready(function(){
        <?php if($this->session->flashdata('category')): ?>
            <?php echo $this->session->flashdata('category') ?>
        <?php endif; ?>
        $('.category-table').footable();
    });

    $('#add_link').click(function(){
    	if($('#append_category').hasClass('closed-add')){
    		$('#append_category').show();	
			$('#append_category').removeClass('closed-add');
    	}
    	else{
    		$('#append_category').hide();	
			$('#append_category').addClass('closed-add');
    	}
    	
    });
    
	function delete_category(id,code){
		alertify.confirm("Apakah anda yakin ingin menghapus Customer "+name,
		  function(){
		    window.location.assign("<?php echo base_url() ?>customer/delete_customer/"+id);
		  },
		  function(){
		    $.Notify({caption: 'Gagal !', content: 'Customer gagal dihapus', type: 'alert'});
		  });
	}

	function notifyOnErrorInput(input){
        var message = input.data('validateHint');
        $.Notify({
            caption: 'Error',
            content: message,
            type: 'alert'
        });
    }
</script>