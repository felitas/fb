<!--Both are css for alertify-->
<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">

<div class="container-fluid">
    <div class="row-fluid">
        <a href="<?php echo base_url() ?>" ><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Home</a>
        <a class="pull-right" id="add_link" style="cursor: pointer;">Tambah kurs baru <span class="fa fa-plus-circle"></span></a>
        <h2>Daftar Nilai Kurs</h2>
    </div>

    <!--Field dollar insertion-->
    <?php echo form_open('configuration/currency_add', array('class' =>  'form-horizontal') )?>
    <div class="widget-box closed-add" id="append_kurs" style="display: none;">   
        <div class="widget-title">
            <h5>Tambah Kurs Baru</h5>
        </div>
        <div class="widget-content">
            <div class="control-group top-control">
                <label class="control-label">Nama Kurs Baru</label>
                <div class="controls">
                    <input type="text" placeholder="Masukkan Nama Kurs Baru" name="currency_name">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Nilai Kurs (dalam Rupiah)</label>
                <div class="controls">
                    <input type="number" placeholder="Nilai dari kurs baru dalam rupiah" name="currency_value">
                </div>
            </div>    
            <div class="form-actions text-center">
                <input type="Submit" name="submit" class="btn btn-primary" value="Submit"> 
            </div>
        </div>
    </div>
    <?php echo form_close() ?>
    <!--Form End-->

    <div class="widget-box">
        <div class="widget-content">
        
        <!--Daftar Kurs-->
        <div class="row-fluid">     
                <div class="table-responsive toggle-circle-filled">
                    <table class="table table-bordered" data-page-size="10" id="table_kurs">
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
    </div>
    <!--Widget Box Tabel Kurs End-->
    <h2>Riwayat Nilai Kurs</h2>
    <!--History Kurs-->
    <div class="widget-box">
        <div class="widget-content">     
            <div class="row-fluid">
                <div class="control-group">
                    <input type="text" placeholder="Cari..." id="filter" >
                </div>
        
                <div class="table-responsive toggle-circle-filled">
                    <table class="table table-bordered" data-page-size="10" id="table_history" data-filter="#filter">
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

    function delete_currency(id,name){
        alertify.confirm("Apakah anda ingin menghapus kurs "+name+"?",
            function(){ window.location.assign("<?php echo base_url()?>configuration/delete_currency/"+id); },
            function(){ $.gritter.add({
                        title:  'Gagal!',
                        text:   'Kurs gagal dihapus!',
                        sticky: false
            }); }
        );
    }

</script>