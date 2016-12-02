<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">
<link href="<?php echo base_url() ?>css/footable.core.css" type="text/css" rel="stylesheet">
<div class="container">
	<div class="grid">
		<div class="row">
	        <div class="cell">
	            <h3 style="display: inline-block;"><small><a href="<?php echo base_url() ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a></small></h3>
	            <h3 style="display:inline-block;float:right;"><small><a id="add_link" style="cursor: pointer;">Tambah Model baru <span class="fa fa-plus-circle"></span></a></small></h3>
	        </div>
	    </div>
	</div>
	<div class="grid condensed">
		<!--Form Add Tray-->
		<?php echo form_open('model/add_model', array('data-role' =>  'validator','data-on-error-input' => 'notifyOnErrorInput','data-show-error-hint' => 'false'))?>
		<div class="row closed-add" id="append_model" style="display: none">
			<h3 style="margin-bottom: 20px;">Tambah Model Baru</h3>
            <hr class="bg-primary">	
    		<div class="cell">
    			<label>Nama Model</label>
                <div class="input-control text full-size">
                    <input type="text" placeholder="Masukkan nama model" name="model_name" data-validate-func="required" data-validate-hint="Nama model harus diisi">
                </div>
                <label>Kode Model</label>
                <div class="input-control text full-size">
                    <input type="text" placeholder="Masukkan kode untuk model (5 Huruf/Angka)" name="model_code" data-validate-func="required,maxlength" data-validate-arg=",5" data-validate-hint="Kode model harus diisi max 5 karakter">
                </div>
                <label for="">Tipe</label>
				<div class="input-control select full-size">
					<select name="type" id="" onchange="get_category(this)" data-validate-func="required" data-validate-hint="Jenis barang harus diisi">
						<option value="">--Pilih Tipe--</option>
						<option value="1">Emas</option>
						<option value="2">Berlian</option>
					</select>
				</div>
				<label for="">Category</label>
				<div class="input-control select full-size">
					<select name="category_type" id="category" data-validate-func="required" data-validate-hint="Jenis barang harus diisi">
						<option value="">--Pilih Kategori--</option>
					</select>
				</div>
    		</div>
            <div class="cell text-center">
               <input type="Submit" name="submit" class="button bg-primary btn-teal" value="Submit"> 
            </div>
    	</div>
    	<?php echo form_close()?>
    	<!--End Form-->
	    <div class="row">
	    	<div class="cell">
	    		<h3 style="margin-bottom: 20px;">Model Emas</h3>
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
						<?php if($model_gold!=NULL): ?>
							<?php $i=1; ?>
							<?php foreach($model_gold as $row): ?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $row->name ?></td>
								<td><?php echo $row->code ?></td>
								<td><a href="#"><span class="mif mif-pencil"></span> Edit</a> - <a href="#"><span class="mif mif-bin"></span> Hapus</a></td>
							</tr>
							<?php $i++; ?>
							<?php endforeach; ?>
						<?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center"><h3>Table kosong</h3></td>
                            </tr>
                        <?php endif; ?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
		<div class="row">
	    	<div class="cell">
	    		<h3 style="margin-bottom: 20px;">Model Berlian</h3>
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
						<?php if($model_diamond!=NULL): ?>
							<?php $i=1; ?>
							<?php foreach($model_diamond as $row): ?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $row->name ?></td>
								<td><?php echo $row->code ?></td>
								<td><a href="#"><span class="mif mif-pencil"></span> Edit</a> - <a href="#"><span class="mif mif-bin"></span> Hapus</a></td>
							</tr>
							<?php $i++; ?>
							<?php endforeach; ?>
						<?php else : ?>
                                <tr>
                                    <td colspan="4" class="text-center"><h3>Table kosong</h3></td>
                                </tr>
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
    	if($('#append_model').hasClass('closed-add')){
    		$('#append_model').show();	
			$('#append_model').removeClass('closed-add');
    	}
    	else{
    		$('#append_model').hide();	
			$('#append_model').addClass('closed-add');
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

	function get_category(el){
		if($(el).val() != ''){
			$.ajax({
              url: "<?php echo base_url('model/get_category/')?>" + $(el).val(),
              type: 'GET',
              cache : false,
              success: function(result){
              	$('#category').empty();
                $('#category').append(result);
               
                
              }
            
            });
		}else{
			$('#category').empty();
            $('#category').append('<option value="">--Pilih Kategori--</option>');
		}
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