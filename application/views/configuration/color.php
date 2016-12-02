<script src="<?php echo base_url() ?>js/jscolor.min.js"></script>
<div class="container">
	<div class="grid">
		<div class="row">
	        <div class="cell">
	            <h3><small><a href="<?php echo base_url('home') ?>"><span class="fa fa-arrow-circle-o-left"></span> Kembali ke Menu</a></small></h3>
	        </div>
	    </div>
		<div class="row form-title">
	        <div class="cell">
	            <h1 style="margin-bottom: 20px;">Pengaturan Tampilan</h1>
	            <hr class="bg-primary">    
	        </div>
	    </div>
	    <div class="row">
	    	<div class="cell">
	    		

			<label>Warna (HEX Color, Contoh : 2C3E50) : </label>
    			<div class="input-control text full-size" data-role="input">
    			    <input class="jscolor {closable:true,closeText:'Close',onFineChange:'update(this)'}" onchange="update_val(this.jscolor)" value="<?php echo $configuration->primary_color ?>">
    			</div>
			
	    	</div>
	    </div>
	</div>
</div>

<script>
function update(jscolor) {
    $('.navbar').css('backgroundColor','#'+jscolor);
    $('.bg-primary').css('backgroundColor','#'+jscolor);
}
function update_val(jscolor) {
    $.ajax({
      url: "<?php echo base_url('configuration/change_color/')?>" + jscolor,
      type: 'GET',
      cache : false,
      success: function(result){
        if(result == 'success'){
        	$.Notify({
                caption: 'Berhasil !',
                content: 'Warna berhasil diubah',
                type: 'info'
            });
        }
        
      }
    
    });
}
</script>
<script>
	function delete_outlet(id,name){
		alertify.confirm("Apakah anda yakin ingin menghapus Toko "+name,
		  function(){
		    window.location.assign("<?php echo base_url() ?>outlets/delete_outlet/"+id);
		  },
		  function(){
		    $.Notify({caption: 'Gagal !', content: 'Toko gagal dihapus', type: 'alert'});
		  });
	}

	<?php if($this->session->userdata('success')): ?>

       <?php echo $this->session->userdata('success') ?>

    <?php endif; ?>
</script>