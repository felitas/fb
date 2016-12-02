<style type="text/css">
    .ket{
      width: 100px;
      display: inline-block;
    }
    .box-req{
      border: 3px solid #04BFBF;
    }
    .table.border,.table.bordered th, .table.bordered td,.table thead{
      border-color: #95a5a6;
    }
</style>
    <div class="container-fluid">
    <div class="grid">
      <div class="row">
        <div class="cell">
          <div class="tile-group" style="margin:0">
          <div class="tile-group-title"><div id="txt"></div></div>
            <div class="tile-container"><!--Container begin-->
              <div class="tile tile-big-x bg-white box-req">
                <div class="tile-content padding10">
                  <div class="tilehead fg-teal">
                      <h4 style="display: inline-block; float: left;"><span class="fa fa-sign-out"></span> Barang Sedang Dikirim</h4>
                      <table class="table border bordered hovered cell-hovered">
                        <thead>
                          <tr>
                            <td>Outlet Tujuan</td>
                            <td>Jumah Barang</td>
                            <td>Status</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td colspan="3" class="text-center">Tidak ada barang yang sedang dikirim</td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
              <div class="tile tile-big-x bg-white box-req">
                <div class="tile-content padding10">
                  <div class="tilehead fg-teal">
                      <h4 style="display: inline-block; float: left;"><span class="fa fa-sign-in"></span> Request Barang dari Outlet</h4>
                      <table class="table border bordered hovered cell-hovered">
                        <thead>
                          <tr>
                            <td>Outlet Tujuan</td>
                            <td>Jumah Barang</td>
                            <td>Status</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td colspan="3" class="text-center">Tidak ada request</td>
                          </tr>
                        </tbody>
                      </table>
                  </div>

                </div>
              </div>
              <div class="tile-wide bg-primary fg-white" data-role="tile">
                <div class="tile-content padding10">
                    <div class="tilehead" style="height: 40px;">
                        <h4 style="display: inline-block; float: left;"><span class="fa fa-dollar"></span> Kurs Hari Ini</h4>  
                        <a href="" class="button info btn-teal" style="float: right;">Edit</a>
                    </div>
                    <p><div class="ket">Dollar </div>: Rp 13.360 ,-</p>
                    <p><div class="ket">Gold </div>: Rp 568.000 ,- / gram</p>
                    
                </div>
              </div>
              <div class="tile-wide tile-wide-y bg-white box-req">
                <div class="tile-content padding10">
                  <div class="tilehead fg-teal">
                      <h4 style="display: inline-block; float: left;"><span class="mif-bubbles"></span> Notes</h4>  
                  </div>
                </div>
              </div>

            </div><!--Container ends-->
        </div>
        </div>
      </div>
    </div>
        
    </div>
<script type="text/javascript">
$(document).ready(function(){
  startTime();
});

  function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        var d = today.getDate();
        var D = today.getDay();
        var M = today.getMonth();
        var Y = today.getFullYear();
        h = checkTime(h);
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('txt').innerHTML =
        getDayName(D) + ", "+ d + " " + getMonthName(M) + " " + Y + " " + h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }

    <?php if($this->session->userdata('success')): ?>

       <?php echo $this->session->userdata('success') ?>

    <?php endif; ?>
</script>