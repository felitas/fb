<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title ?> - Kemenangan</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
    <link href="<?php echo base_url() ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/bootstrap-responsive.min.css" rel="stylesheet"><!--Matrix-->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap-wysihtml5.css" /> <!--Matrix-->
    <link href="<?php echo base_url() ?>css/matrix-style.css" rel="stylesheet"><!--Matrix-->
    <link href="<?php echo base_url() ?>css/matrix-media.css" rel="stylesheet"><!--Matrix-->
    <link href="<?php echo base_url() ?>css/footable.core.css" type="text/css" rel="stylesheet"><!--Footable-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>    
    

    <script src="<?php echo base_url() ?>js/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.ui.custom.js"></script><!--Matrix-->
    <script src="<?php echo base_url();?>js/script.js"></script>
    <script src="<?php echo base_url();?>js/matrix.js"></script><!--Matrix-->
    <script src="<?php echo base_url();?>js/matrix.interface.js"></script><!--Matrix-->
    <script src="<?php echo base_url();?>js/wysihtml5-0.3.0.js"></script>  <!--Matrix-->
    <script src="<?php echo base_url();?>js/bootstrap-wysihtml5.js"></script><!--Matrix-->
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

      .segoe{
        font-family: 'Segoe UI';
        font-size: 12px;
        line-height: 30px;
      }
      .bg-primary{
        background-color: <?php echo $configuration->primary_color ?> !important;
        color: white !important;
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
    .navbar a,#sidebar > ul > li > a{
      color: #fff !important;
    }
    .dropdown-menu{
      background-color: #000 !important;
      margin-top: -1px;
    }


  
    </style>

  </head>
  <body>
  <div id="header"></div>
  <!--top-Header-menu-->
  <div id="user-nav" class="navbar">
    <ul class="nav">
      <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><span class="text">Welcome <?php echo $this->session->user_name ?></span><b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">My Profile</a></li>
          <li><a href="login.html">Log Out</a></li>
        </ul>
      </li>
      <li class=""><a title="" href="login.html"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
    </ul>
  </div>
  <!--close-top-Header-menu--> 


  <!--sidebar-menu-->
  <div id="sidebar"><a href="<?php echo base_url('home') ?>" class="visible-phone"><i class="fa fa-home"></i> Home</a>
    <ul>
      <li><a href="<?php echo base_url('home') ?>"><i class="fa fa-home"></i><span>Home</span></a> </li>
      <li class="submenu"> <a href="#"><i class="fa fa-shopping-bag"></i><span>Penjualan</span></a>
        <ul>
          <li><a href="">Daftar Penjualan</a></li>
          <li><a href="">Penjualan Baru</a></li>
          <li><a href="">Daftar Booking</a></li>
          <li><a href="">Booking Baru</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="fa fa-shopping-cart"></i><span>Pembelian</span></a>
        <ul>
          <li><a href="">Daftar Pembelian</a></li>
          <li><a href="">Pembelian Baru</a></li>
          <li><a href="">Daftar Buyback</a></li>
          <li><a href="">Buyback Baru</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="fa fa-bank"></i><span>Outlet</span></a>
        <ul>
          <li><a href="<?php echo base_url('outlets') ?>">Daftar Outlet</a></li>
          <li><a href="<?php echo base_url('outlets/add_outlet') ?>">Outlet Baru</a></li>
          <li><a href="<?php echo base_url('sales') ?>">Daftar Sales</a></li>
          <li><a href="<?php echo base_url('sales/add_sales') ?>">Sales Baru</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="fa fa-cubes"></i><span>Inventori</span></a>
        <ul>
          <li><a href="error403.html">Daftar Barang</a></li>
          <li><a href="<?php echo base_url('product/add_product') ?>l">Input Barang</a></li>
          <li><a href="error405.html">Kirim</a></li>
          <li><a href="error500.html">Terima</a></li>
          <li><a href="<?php echo base_url('category') ?>">Kategori</a></li>
          <li><a href="<?php echo base_url('model') ?>">Model</a></li>
          <li><a href="<?php echo base_url('tray') ?>">Daftar Baki</a></li>
          <li><a href="error500.html">Stok Opnam</a></li>

        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="fa fa-address-book"></i><span>Kontak</span></a>
        <ul>
          <li><a href="<?php echo base_url('customer') ?>">Daftar Customer</a></li>
          <li><a href="<?php echo base_url('supplier') ?>">Daftar Supplier</a></li>
          <li><a href="<?php echo base_url('customer/add_customer') ?>">Tambah Customer</a></li>
          <li><a href="<?php echo base_url('supplier/add_supplier') ?>">Tambah Supplier</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="fa fa-gear"></i><span>Konfigurasi</span></a>
        <ul>
          <li><a href="error403.html">Toko</a></li>
          <li><a href="<?php echo base_url('configuration/Currency') ?>">Kurs</a></li>
          <li><a href="<?php echo base_url('configuration/gold_amount') ?>">Gold</a></li>
          <li><a href="error500.html">Diamond</a></li>
          <li><a href="error500.html">Promo</a></li>
          <li><a href="<?php echo base_url('configuration/color') ?>">Tampilan</a></li>
          <li><a href="error500.html">Sales</a></li>
          <li><a href="error500.html">Member</a></li>
        </ul>
      </li>
      <li class="content"> <span>Monthly Bandwidth Transfer</span>
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
      </li>
    </ul>
  </div>
  <!--sidebar-menu-->
  <!--main-container-part-->
  <div id="content">
    <?php echo $body ?>
  </div>
  <!--end-main-container-part-->
  
  <footer style="height: 50px"></footer>
  </body>
</html>