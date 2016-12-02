<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="<?php echo base_url() ?>js/jquery-1.12.4.min.js"></script>
</head>
<body>

	<?php echo form_open() ?>

	Berat Emas: <input type="text" name="berat_emas" id="berat_emas">

	Harga Emas per gram: <input type="text" name="harga_emas" id="harga_emas">

	<button onclick="limit()">Hitung</button>

	<?php echo form_close() ?>

	<script>
		function limit(){
			
			var berat = $('#berat_emas').val();
			var harga = $('#harga_emas').val();

			var total = berat*harga;

			var limit = 0.75 * total;

			alert(limit);

			alert(total);
		}
	</script>

</body>
</html>