<link href="<?php echo base_url() ?>css/footable.core.css" type="text/css" rel="stylesheet">
<div class="container">
    <?php echo form_open('configuration/update_currency/'.$currency->id, array('data-role' =>  'validator','data-on-error-input' => 'notifyOnErrorInput','data-show-error-hint' => 'false')) ?>
    <div class="grid">
        <div class="row">
            <div class="cell">
                <h3><small><a href=""><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar kurs</a></small></h3>
            </div>
        </div>

        <div class="row">	 
            <div class="cell">
            	<h3 style="margin-bottom: 20px;">Edit Kurs <?php echo ucfirst($currency->name) ?></h3>
                <hr class="bg-primary">	
            </div>
            <div class="row cells2">
                <div class="cell">
                    <label>Nama Kurs</label>
                    <div class="input-control text full-size">
                        <input type="text" placeholder="Nama Kurs" name="update_currency_name" value="<?php echo $currency->name ?>" data-validate-func="required" data-validate-hint="Nama kurs harus diisi">
                    </div>
                </div>
                <div class="cell">
                    <label>Nilai Kurs (dalam Rupiah)</label>
                    <div class="input-control text full-size">
                        <input type="number" placeholder="Nilai dari kurs baru dalam rupiah" name="update_currency_value" data-validate-func="required" data-validate-hint="Nilai dollar harus diisi" value="<?php echo $currency->value?>">
                    </div>
                </div>
            </div>
            <div class="cell text-center">
                <input type="Submit" name="submit" class="button bg-primary btn-teal" value="Submit"> 
            </div>
        </div>
    	

        <div class="row">     
            <div class="cell">
                <h3 style="margin-bottom: 20px;">Riwayat Nilai Kurs <?php echo ucfirst($currency->name) ?></h3>
                <hr class="bg-primary"> 
                <div class="table-responsive toggle-circle-filled">
                    <table class="table table-condensed" data-page-size="10" id="table_kurs">
                        <thead>
                            <tr>
                                <th>Tanggal Update</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($histories!=NULL) : ?>
                                <?php foreach($histories as $history):?>
                                <tr>
                                    <td><?php echo date('d-M-Y H:i:s',strtotime($history->date)) ?></td>
                                    <td>Rp <?php echo $history->value?></td>
                                </tr>
                                <?php endforeach;?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="2" class="text-center"><h3>Table kosong</h3></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>    
            </div>
        </div>

    <?php echo form_close() ?>
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
    <?php if($this->session->flashdata('outlet')): ?>

       <?php echo $this->session->flashdata('outlet') ?>

    <?php endif; ?>
    $('#table_kurs').footable();
});



function notifyOnErrorInput(input){
    var message = input.data('validateHint');
    $.Notify({
        caption: 'Error',
        content: message,
        type: 'alert'
    });
}
</script>