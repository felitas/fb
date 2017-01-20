<link rel="stylesheet" href="<?php echo base_url() ?>css/select2.css" />

<select name="" id="test">
          <option value="">WAN</option>
          <option value="">FEL</option>
        </select>
<script src="<?php echo base_url() ?>js/select2.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){

    $('#test').select2();
  });

  </script>