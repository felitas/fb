<div class="container-fluid">
	<div class="row-fluid">
    	<a href="<?php echo base_url('loan') ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke daftar transaksi gadai</a>
    	<h2>Detail Gadai <?php echo $loan->loan_code?></h2>
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
        		<div class="widget-title">
        			<h5>Data Customer</h5>
        		</div>
        		<table class="table table-bordered table-invoice">
                  <tbody>
	                    <tr>
	                      <td class="width30">Kode Customer</td>
	                      <td class="width70"><strong><?php echo $loan->customer_code?></strong></td>
	                    </tr>
	                    <tr>
	                      <td>Nama</td>
	                      <td><strong><?php echo $loan->customer_name?></strong></td>
	                    </tr>
	                    <tr>
	                      <td>No. Ktp</td>
	                      <td><?php echo $loan->customer_ktp?></td>
	                    </tr>
	                    <tr>
	                      <td>No. Telp</td>
	                      <td><?php echo $loan->customer_phone?></td>
	                    </tr>
	                    <tr>
		                  <td class="width30">Alamat</td>
		                    <td class="width70"><?php echo $loan->customer_address?></td>
		                </tr>
		                <tr>
		                  <td class="width30">Email</td>
		                    <td class="width70"><?php echo $loan->customer_email?></td>
		                </tr>
                   </tbody>
                  
                </table>
        	</div>  
        </div>
        <div class="row-fluid">
        	<div class="span12">
            	<div class="table-responsive toggle-circle-filled">
                <table class="table table-bordered" id="table_loan" data-filter="#filter" data-page-size="10">
                  <thead>
                    
                      <th>Nama Barang</th>
                      <th data-hide="phone">Berat</th>
                      <th data-hide="phone">Kadar Emas</th>
                      <th>Pinjaman</th>
                      <th>Bunga</th>
                      <th data-hide="phone">Keterangan</th>
                    
                  </thead>
                  <tbody>
                  	<?php foreach($loan_details as $detail):?>
                  		<tr>
                  			<td><?php echo $detail->item_name?></td>
                  			<td><?php echo $detail->weight?> gr</td>
                  			<td><?php echo $detail->gold_amount?>%</td>
                  			<td><?php echo 'Rp '. number_format($detail->loan_price,2,',','.') ?></td>
                  			<td><?php echo $detail->interest_rate?>%</td>
                  			<td><?php echo $detail->description?></td>
                  		</tr>
                  	<?php endforeach?>
                  </tbody>
                  <tfoot>
	                    <tr>
	                        <td colspan="6">
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
<script>

    $(document).ready(function(){
        <?php if($this->session->flashdata('loan')): ?>
            <?php echo $this->session->flashdata('loan') ?>
        <?php endif; ?>
        $('#table_loan').footable();
        $('#table_history').footable();
    });
</script>