
<div class="container-fluid">
        <div class="row-fluid">
            <a href="<?php echo base_url('configuration/currency') ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar kurs</a>
            <h2>Edit Kurs <?php echo ucfirst($currency->name) ?></h2>
        </div>
        <?php echo form_open('configuration/update_currency/'.$currency->id, array('class'=>'form-horizontal')) ?>
        <div class="widget-box">	 
            <div class="widget-content">
                <div class="control-group top-control">
                    <label class="control-label">Nama Kurs</label>
                    <div class="controls">
                        <input type="text" placeholder="Nama Kurs" name="update_currency_name" value="<?php echo $currency->name ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Nilai Kurs (dalam Rupiah)</label>
                    <div class="controls">
                        <input type="number" placeholder="Nilai dari kurs baru dalam rupiah" name="update_currency_value" value="<?php echo $currency->value?>">
                    </div>
                </div>
                <div class="form-actions text-center">
                    <input type="Submit" name="submit" class="btn btn-primary" value="Submit"> 
                </div>
            </div>
        </div>
        <?php echo form_close() ?>

        <h2>Riwayat Nilai Kurs <?php echo ucfirst($currency->name) ?></h2>
        <div class="widget-box">     
            <div class="widget-content">
                <div class="table-responsive toggle-circle-filled">
                    <table class="table table-bordered" data-page-size="10" id="table_kurs">
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
</div>



<script>
$(document).ready(function(){
    $('#table_kurs').footable();
});
</script>