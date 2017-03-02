<!--Both are css for alertify-->
<link rel="stylesheet" href="<?php echo base_url() ?>css/alertify.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/default.min.css">
<!--selectize-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/selectize.css')?>">
<style type="text/css">
    .btn-warning{
        float: right !important;
        color: white !important;
        background-color: rgba(26, 188, 156,1.0) !important;
    }
    .btn-warning:hover{
        background-color: rgba(52, 152, 219,1.0) !important;   
    }
    .item-title{
        background-color: #f1c40f !important;
    }
    #itemform{
        margin-top: 0px !important;
    }
    .selectize-control{
        margin-left: 0px !important;
    }
</style>

<div class="container-fluid">
    <div class="row-fluid">
        <a href="<?php echo base_url('loan') ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar transaksi gadai</a>
        <h2>Update Gadai <?php echo $loan->loan_code?></h2>
    </div>
    <div class="widget-box">
    <div class="widget-content">
        <div class="row-fluid">
            <div class="span6">
                <table class="table table-invoice">
                    <tbody>
                        <tr>
                          <td class="width30" style="border-top: none !important;">Kode Transaksi</td>
                          <td class="width70" style="border-top: none !important;"><strong><?php echo $loan->loan_code?></strong></td>
                        </tr>
                        <tr>
                          <td>Issue Date</td>
                          <td><strong><?php echo $loan->date_start?></strong></td>
                        </tr>
                        <tr>
                          <td>Due Date</td>
                          <td><?php echo $loan->date_due?></td>
                        </tr>
                        <tr>
                          <td class="width30">Status</td>
                            <td class="width70"><?php echo $loan->status?></td>
                        </tr>
                        <tr>
                          <td class="width30">Sales</td>
                            <td class="width70"><?php echo $loan->sales_name?></td>
                        </tr>
                        <tr>
                          <td class="width30">Kode Customer</td>
                            <td class="width70"><?php echo $loan->customer_code?></td>
                        </tr>
                        <tr>
                          <td class="width30">Nama Customer</td>
                            <td class="width70"><?php echo $loan->customer_name?></td>
                        </tr>
                        <tr>
                          <td class="width30">Total Barang</td>
                            <td class="width70"><?php echo $loan->total_item?></td>
                        </tr>
                        <tr>
                          <td class="width30">Total Pinjaman</td>
                            <td class="width70"><?php echo 'Rp '. number_format($loan->total_loan,2,',','.') ?></td>
                        </tr>
                        <tr>
                          <td class="width30">Keterangan</td>
                            <td class="width70"><?php echo $loan->description ?></td>
                        </tr>
                        <tr>
                          <td class="width30">Foto</td>
                            <td class="width70"><img width="30" src="<?php echo base_url().$loan->items_photo ?>" alt=""/></td>
                        </tr>
                   </tbody>
               </table>
            </div>
            <div class="span6">
                <?php echo form_open('loan/update_loan'.'/'.$loan->loan_code, array('class'=>'form-horizontal', 'id'=>'loanform')) ?>
                <div class="widget-title">
                    <h5>Perpanjang Gadai</h5>    
                </div>
                
                <div class="control-group top-control">
                    <label class="control-label">Sales</label>
                    <div class="controls">
                        <select name="loan_sales" id="loan_sales" class="span11">
                            <?php if ($sales==''): ?>
                                <option value="x">Tidak ada sales di outlet ini</option>    
                            <?php else:?>
                                <option value="">Masukkan kode/nama sales</option>
                                <?php foreach ($sales as $row): ?>
                                    <option value="<?php echo $row->workers_code ?>"><?php echo $row->name ?> - <?php echo $row->workers_code?></option>
                                <?php endforeach ?>
                            <?php endif;?>
                        </select>
                    </div>    
                </div>
                <div class="control-group">
                    <label class="control-label">Due Date</label>
                    <div class="controls">
                        <input type="date" name="loan_due" class="span11" value="<?php echo $loan->date_due?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Status</label>
                    <div class="controls">
                        <select name="loan_status" class="span11">
                            <option value="On Going" <?php echo ($loan->status == 'On Going') ? 'selected' : '' ?>>On Going</option>
                            <option value="Lunas" <?php echo ($loan->status == 'Lunas') ? 'selected' : '' ?>>Lunas</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label">Keterangan</label>
                    <div class="controls">
                        <textarea name="loan_description" class="span11"></textarea>
                    </div>
                </div>
                <!--FORM FOOTER-->
                <div class="form-actions text-center">
                        <input type="submit" name="submit" class="btn btn-info" value="Submit">
                </div>
                <?php echo form_close(); ?>
            </div><!--CLOSE DIV SPAN6-->
        </div>  
        
    </div><!--widget content close-->
    </div><!--widget box close-->


    <!--WIDGET BOX FOR HISTORY-->
    <div class="widget-box">
        <div class="widget-title">
            <h5>Update History</h5>
        </div>
        <div class="widget-content">
            <div class="row-fluid">
                <div class="table-responsive toggle-circle-filled">
                    <table class="table table-bordered" id="table_history" data-filter="#filter" data-page-size="10">
                        <thead>
                            <th data-type="numeric">Date</th>
                            <th>Kode Sales</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th data-hide="phone">Keterangan</th>
                        </thead>
                        <tbody>
                            <?php if($loan_histories!=NULL):?>
                                <?php foreach($loan_histories as $history):?>
                                    <tr>
                                        <td><?php echo date('d-M-Y H:i:s',strtotime($history->date))?></td>
                                        <td><?php echo $history->workers_code?></td>
                                        <td><?php echo date('d-M-Y',strtotime($history->date_due))?></td>
                                        <td><?php echo $history->status?></td>
                                        <td><?php echo $history->description?></td>
                                    </tr>
                                <?php endforeach?>
                            <?php else:?>
                                <tr>
                                    <td colspan="5" class="nocontent"><h3>Table kosong</h3></td>
                                </tr>
                            <?php endif?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
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
<script src="<?php echo base_url() ?>js/alertify.min.js"></script>
<script src="<?php echo base_url() ?>js/jquery.validate.js"></script> 
<script src="<?php echo base_url() ?>js/selectize.min.js"></script>
<script src="<?php echo base_url() ?>js/webcam.min.js"></script>
<script>
    $(document).ready(function(){
        $('#table_history').footable();
        $('#loan_sales').selectize();
        $('#loanform').validate({
            ignore: [],
            rules:{
                loan_sales:"required",
                loan_due:"required"
            }
        });
    });

    <?php if($this->session->flashdata('loan')): ?>

       <?php echo $this->session->flashdata('loan') ?>

    <?php endif; ?>
</script>
