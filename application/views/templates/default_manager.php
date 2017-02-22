<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title ?> - Fajar Baru</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
    <link href="<?php echo base_url() ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/bootstrap-responsive.min.css" rel="stylesheet"><!--Matrix-->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/jquery.gritter.css" /><!--Matrix Notification-->
    <link href="<?php echo base_url() ?>css/uniform.css" rel="stylesheet"><!--Matrix Uniform-->
    <link href="<?php echo base_url() ?>css/matrix-style.css" rel="stylesheet"><!--Matrix-->
    <link href="<?php echo base_url() ?>css/matrix-media.css" rel="stylesheet"><!--Matrix-->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap-wysihtml5.css" /> <!--Matrix-->
    <link href="<?php echo base_url() ?>css/footable.core.css" type="text/css" rel="stylesheet"><!--Footable-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>    
    

    <script src="<?php echo base_url() ?>js/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.ui.custom.js"></script><!--Matrix-->
    <script src="<?php echo base_url();?>js/script.js"></script><!--Get month name and get day name in Indonesian-->
    <script src="<?php echo base_url();?>js/matrix.js"></script><!--Matrix-->
    <script src="<?php echo base_url();?>js/wysihtml5-0.3.0.js"></script>  <!--Matrix-->
    <script src="<?php echo base_url();?>js/bootstrap-wysihtml5.js"></script><!--Matrix-->
    <script src="<?php echo base_url();?>js/jquery.gritter.min.js"></script> <!--Matrix Notification-->
    <script src="<?php echo base_url();?>js/jquery.uniform.js"></script> <!--Matrix Uniform-->
    <script src="<?php echo base_url() ?>js/footable.js"></script><!--Footable-->
    <script src="<?php echo base_url() ?>js/footable.filter.js"></script><!--Footable-->
    <script src="<?php echo base_url() ?>js/footable.paginate.js"></script><!--Footable-->
    <script src="<?php echo base_url() ?>js/footable.sort.js" type="text/javascript"></script><!--Footable-->

    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php $configuration = $this->crud_model->get_data('configuration')->row() ?>
    <style>
      #header h1{
        background: url("<?php echo base_url()?>assets/logo.png") no-repeat scroll 0 0 transparent !important;
      }
      h2{
        margin-bottom: 0px !important;
      }

      /*Gritter*/
      .gritter-close{
        background:url('<?php echo base_url()?>assets/gritter.png') no-repeat left top !important;
      }

      /**alertify modal**/
      .alertify .ajs-header{
        background:#efefef !important;
        border-bottom: 1px solid #CDCDCD !important;
        height: auto;
        padding: 8px 15px 5px;
        z-index: 99999;
      }
      .alertify .ajs-footer{
        background:#efefef !important;
        border-top: 1px solid #CDCDCD !important;
      }

      .alertify .ajs-footer .ajs-buttons .ajs-button.ajs-ok{
        background:#3FC380 !important;
        border-radius: 5px !important;
        color: #fff !important;
      }

      .alertify .ajs-footer .ajs-buttons .ajs-button.ajs-cancel{
        background:#EC644B !important;
        border-radius: 5px !important;
        color: #fff !important;
      }

      /** end of alertify **/
      body{
        line-height: 20px;
      }
      .row-fluid{
        font-size: 15px !important;
      }
      .bg-primary{
        background-color: <?php echo $configuration->primary_color ?> !important;
        color: white !important;
      }
      .footable > thead > tr > th{
        padding-top: 0px !important;
        font-size: 13px !important;
      }
      .nocontent>h3{
        text-align: center !important;
      }
      /*Toggle Currency pop up*/
      #kurstoggle{
        background-color: <?php echo $configuration->primary_color ?> !important;
        height: 70px;
        width: 70px;
        border-radius: 50%;
        position: fixed; 
        right: 20px; 
        z-index: 1; 
        top: 560px;
      }
      #charm_currency{
          height: 100px;        
          background-color: <?php echo $configuration->primary_color ?> !important;
      }
      #currency_head{
        border-bottom: 0px;
      }

    /*Navbar*/
    .navbar a,#sidebar > ul > li > a, #sidebar>ul>li>ul>li>a{
      color: #fff !important;
    }
    .dropdown-menu{
      background-color: #000 !important;
      margin-top: -1px;
    }
    .navbar .nav>li>.dropdown-menu:after{
      border:none !important;
    }
    .faicon{
      width: 20px !important;
    }
    /*Form*/
    .form-actions{
      background: transparent !important;
    }
    .top-control{
      border-top: none !important
    }
    @media (max-width: 970px){
     .control-group{
        border: none !important;
      } 
    }
    .circleimg{
      width: 170px;
      height: 170px;
      border-radius: 50%;
      margin: auto;
      margin-bottom: 10px;
    }
  
    </style>

  </head>
  <body>
  <div id="header">
    <h1><a href="<?php echo base_url();?>">Fajar Baru</a></h1>
  </div>
  <!--top-Header-menu-->
  <div id="user-nav" class="navbar">
    <ul class="nav">
      <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><span class="text">Welcome <?php echo $this->session->user_name ?></span> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">My Profile</a></li>
        </ul>
      </li>
      <li><a href="<?php echo base_url('accounts/logout') ?>"><i class="fa fa-power-off"></i> <span class="text">Logout</span></a></li>
    </ul>
  </div>
  <!--close-top-Header-menu--> 


  <!--sidebar-menu-->
  <div id="sidebar"><a href="<?php echo base_url('home') ?>" class="visible-phone"><i class="fa fa-home"></i> Home</a>
    <ul>
      <li><a href="<?php echo base_url('home') ?>"><i class="fa fa-home"></i><span>Home</span></a> </li>
      <li class="submenu"> <a href="#"><i class="fa fa-shopping-bag"></i><span>Penjualan</span></a>
        <ul>
          <li><a href="<?php echo base_url('sale')?>"><i class="fa fa-file-text faicon"></i> Daftar Penjualan</a></li>
          <li><a href="<?php echo base_url('sale/new_sale')?>"><i class="fa fa-plus-square faicon"></i> Penjualan Baru</a></li>
          <li><a href=""><i class="fa fa-calendar-check-o faicon"></i> Daftar Booking</a></li>
          <li><a href=""><i class="fa fa-check-square faicon"></i> Booking Baru</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="fa fa-shopping-cart"></i><span>Pembelian</span></a>
        <ul>
          <li><a href=""><i class="fa fa-file-text faicon"></i> Daftar Pembelian</a></li>
          <li><a href=""><i class="fa fa-cart-plus faicon"></i> Pembelian Baru</a></li>
          <li><a href=""><i class="fa fa-exchange faicon"></i> Daftar Buyback</a></li>
          <li><a href=""><i class="fa fa-arrows-h faicon"></i> Buyback Baru</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="fa fa-exchange"></i><span>Gadai</span></a>
        <ul>
          <li><a href="<?php echo base_url('loan')?>"><i class="fa fa-file-text faicon"></i> Daftar Gadai</a></li>
          <li><a href="<?php echo base_url('loan/new_loan')?>"><i class="fa fa-exchange faicon"></i> Gadai Baru</a></li>
        </ul>
      </li>
      <!--THE OUTLETS MENU IS NO USE for managers-->
      <li> <a href="<?php echo base_url('sales') ?>"><i class="fa fa-users"></i><span>Daftar Sales</span></a></li>
      <li class="submenu"> <a href="#"><i class="fa fa-cubes"></i><span>Inventori</span></a>
        <ul>
          <li><a href="<?php echo base_url('product') ?>"><i class="fa fa-file-text faicon"></i> Daftar Produk</a></li>
          <li><a href="<?php echo base_url('product/add_product') ?>"><i class="fa fa-plus-square faicon"></i> Input Produk</a></li>
          <li><a href="error500.html"><i class="fa fa-pencil-square faicon"></i> Stok Opnam</a></li>
          <li><a href="<?php echo base_url('tray') ?>"><i class="fa fa-file-text faicon"></i> Daftar Nampan</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="fa fa-archive"></i><span>Mutasi</span></a>
        <ul>
          <li><a href="<?php echo base_url('mutation/send_item')?>"><i class="fa fa-paper-plane faicon"></i> Kirim</a></li>
          <li><a href="<?php echo base_url('mutation/list_receiving')?>"><i class="fa fa-truck faicon faicon"></i> Terima</a></li>
          <li><a href="<?php echo base_url('mutation')?>"><i class="fa fa-truck faicon faicon"></i> Daftar Mutasi</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="fa fa-hand-stop-o"></i><span>Absensi</span></a>
        <ul>
          <li><a href="<?php echo base_url('customer') ?>"><i class="fa fa-vcard faicon"></i> Daftar Absensi</a></li>
          <li><a href="<?php echo base_url('customer/add_customer') ?>"><i class="fa fa-user-plus faicon"></i> Absensi Masuk</a></li>
          <li><a href="<?php echo base_url('supplier') ?>"><i class="fa fa-file-text faicon"></i> Absensi Keluar</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="fa fa-address-book"></i><span>Kontak</span></a>
        <ul>
          <li><a href="<?php echo base_url('customer') ?>"><i class="fa fa-user-circle faicon"></i> Daftar Customer</a></li>
          <li><a href="<?php echo base_url('customer/add_customer') ?>"><i class="fa fa-user-plus faicon"></i> Tambah Customer</a></li>
          <li><a href="<?php echo base_url('supplier') ?>"><i class="fa fa-file-text faicon"></i> Daftar Supplier</a></li>
        </ul>
      </li>
      
      <!-- <li class="content"> <span>Monthly Bandwidth Transfer</span>
        <div class="progress progress-mini progress-danger active progress-striped">
          <div style="width: 77%;" class="bar"></div>
        </div>
        <span class="percent">77%</span>
        <div class="stat">21419.94 / 14000 MB</div>
      </li>
      <li class="content"> <span>Disk Space Usage</span>
        <div class="progress progress-mini active progress-striped">
          <div style="width: 87%;" class="bar"></div>
        </div>
        <span class="percent">87%</span>
        <div class="stat">604.44 / 4000 MB</div>
      </li> -->
    </ul>
  </div>
  <!--sidebar-menu-->
  <!--main-container-part-->
  <div id="content">
    <div id="content-header">
      <div id="breadcrumb"> 
        <a href="<?php echo base_url() ?>" ><div class="tile-group-title"><div id="txt"></div></div></a>
      </div>
    </div>
    <?php echo $body ?>
  </div>
  <!--end-main-container-part-->
  
  <footer style="height: 50px"></footer>
  </body>
</html>
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