<link href="<?php echo base_url() ?>css/footable.core.css" type="text/css" rel="stylesheet">
<div class="container">
    <div class="grid">
        <div class="row">
            <div class="cell">
                <h3 style="display: inline-block;"><small><a href="<?php echo base_url() ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a></small></h3>
                <h3 style="display:inline-block;float:right;"><small><a id="add_link" style="cursor: pointer;">Tambah kurs baru <span class="fa fa-plus-circle"></span></a></small></h3>
            </div>
        </div>
        <!--Field dollar insertion-->
        <div class="row closed-add" id="append_kurs" style="display: none;">	 
            <div class="cell">
            	<h3 style="margin-bottom: 20px;">Tambah Kurs Baru</h3>
                <hr class="bg-primary">	
            </div>
            <?php echo form_open('configuration/currency_add', array('data-role' =>  'validator','data-on-error-input' => 'notifyOnErrorInput','data-show-error-hint' => 'false')) ?>
            <div class="row cells2">
                <div class="cell">
                    <label>Nama Kurs Baru</label>
                    <div class="input-control text full-size">
                        <input type="text" placeholder="Masukkan Nama Kurs Baru" name="currency_name" data-validate-func="required" data-validate-hint="Nilai dollar harus diisi">
                    </div>
                </div>
                <div class="cell">
                   <label>Nilai Kurs (dalam Rupiah)</label>
                    <div class="input-control text full-size">
                        <input type="number" placeholder="Nilai dari kurs baru dalam rupiah" name="currency_value" data-validate-func="required" data-validate-hint="Nilai dollar harus diisi">
                    </div>
                </div>    
            </div>
            <div class="cell text-center">
                <input type="Submit" name="submit" class="button bg-primary btn-teal" value="Submit"> 
            </div>
            <?php echo form_close() ?>
        </div>
        <!--Form End-->
        <!--Daftar Kurs-->
        <div class="row">     
            <div class="cell">
                <h3 style="margin-bottom: 20px;">Daftar Nilai Kurs</h3>
                <hr class="bg-primary"> 
                <div class="table-responsive toggle-circle-filled">
                    <table class="table table-condensed" data-page-size="10" id="table_kurs">
                        <thead>
                            <tr>
                                <th>Nama Kurs</th>
                                <th>Nilai</th>
                                <th data-hide="phone">Update Terakhir</th>
                                <th data-hide="phone">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($currencies!=NULL) : ?>
                                <?php foreach($currencies as $currency):?>
                                <tr>
                                    <td><?php echo $currency->name ?></td>
                                    <td><?php echo 'Rp '. number_format($currency->value,2,',','.') ?></td>
                                    <td><?php echo date('d-M-Y H:i:s',strtotime($currency->last_update))?></td>
                                    <td><a href="<?php echo base_url('configuration/update_currency/'.$currency->id) ?>"><span class="mif mif-pencil"></span> Update</a> - <a href="#" onclick="delete_currency('<?php echo $currency->id ?>','<?php echo $currency->name ?>')"><span class="mif mif-bin"></span> Hapus</a></td>
                                </tr>
                                <?php endforeach;?>
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
        <!--Row Daftar Kurs End-->
        <!--History Kurs-->
        <div class="row">     
            <div class="cell">
                <h3 style="margin-bottom: 20px;">Riwayat Nilai Kurs</h3>
                <hr class="bg-primary"> 
        
                <div class="cell">
                    <div class="input-control text full-size">
                        <input type="text" placeholder="Cari..." id="filter" >
                    </div>
                </div>
        
                <div class="table-responsive toggle-circle-filled">
                    <table class="table table-condensed" data-page-size="10" id="table_history" data-filter="#filter">
                        <thead>
                            <tr>
                                <th>Nama Kurs</th>
                                <th>Nilai</th>
                                <th data-hide="phone">Tanggal Update</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($histories!=NULL) : ?>
                                <?php foreach($histories as $history):?>
                                <tr>
                                    <td><?php echo $history->name ?></td>
                                    <td><?php echo 'Rp '. number_format($history->value,2,',','.') ?></td>
                                    <td><?php echo date('d-M-Y H:i:s',strtotime($history->date)) ?></td>
                                </tr>
                                <?php endforeach;?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3" class="text-center"><h3>Table kosong</h3></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>    
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">

<script src="<?php echo base_url() ?>js/footable.js"></script>
<script src="<?php echo base_url() ?>js/footable.filter.js"></script>
<script src="<?php echo base_url() ?>js/footable.paginate.js"></script>
<script src="<?php echo base_url() ?>js/footable.sort.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>js/alertify.min.js"></script>

<script>
    $(document).ready(function(){
        $('#table_kurs').footable();
        $('#table_history').footable();
        <?php if($this->session->flashdata('currency')): ?>
           <?php echo $this->session->flashdata('currency') ?>
        <?php endif; ?>
    });
    $('#add_link').click(function(){
        if($('#append_kurs').hasClass('closed-add')){
            $('#append_kurs').removeClass('closed-add');
            $('#append_kurs').show();
            
        }
        else{
            $('#append_kurs').hide();
            $('#append_kurs').addClass('closed-add');
        }
    });
    
    function notifyOnErrorInput(input){
        var message = input.data('validateHint');
        $.Notify({
            caption: 'Error',
            content: message,
            type: 'alert'
        });
    }

    function delete_currency(id,name){
        alertify.confirm("Apakah anda ingin menghapus kurs "+name+"?",
            function(){ window.location.assign("<?php echo base_url()?>configuration/delete_currency/"+id); },
            function(){ $.Notify({caption: 'Gagal!', content:'Kurs batal dihapus', type:'alert'}); }
        );
    }

</script>