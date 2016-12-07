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
    <link href="<?php echo base_url() ?>css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/matrix-style.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/matrix-media.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/jquery.gritter.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>    

    <script src="<?php echo base_url() ?>js/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.ui.custom.js"></script>
    <script src="<?php echo base_url();?>js/script.js"></script>
    <script src="<?php echo base_url();?>js/matrix.js"></script>
    <script src="<?php echo base_url();?>js/matrix.dashboard.js"></script>
    <script src="<?php echo base_url();?>js/matrix.interface.js"></script>
    <script src="<?php echo base_url();?>js/matrix.popover.js"></script>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php $configuration = $this->crud_model->get_data('configuration')->row() ?>
    <style>
      body{
        line-height: 20px;
      }
      /**alertify modal**/
      .alertify .ajs-header{
        color: <?php echo $configuration->primary_color ?> !important;
        background: white !important;
        border-bottom: 1px solid <?php echo $configuration->primary_color ?> !important;
      }
      .alertify .ajs-footer{
        color: <?php echo $configuration->primary_color ?> !important;
        background: white !important;
        border-top: 1px solid <?php echo $configuration->primary_color ?> !important;
      }

      .alertify .ajs-footer .ajs-buttons .ajs-button.ajs-ok{
        background-color: <?php echo $configuration->primary_color ?> !important;
        color: white !important;
      }
      /** end of alertify **/

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


      .footable>thead>tr>th, .footable>thead>tr>td {       
        background-color : #ecf0f1 !important;
        border : 1px solid #999 !important;
        color: #000 !important;
      }

   

    .footable>tfoot>tr>th, .footable>tfoot>tr>td { 
      background-color : #ecf0f1 !important;
      border : 1px solid #999 !important;
    }
    .footable>tbody{
      border: 1px solid #999 !important;
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
      <li class="submenu"> <a href="#"><i class="fa fa-cubes"></i><span>Outlet</span></a>
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
          <li><a href="error404.html">Error 404</a></li>
          <li><a href="error405.html">Error 405</a></li>
          <li><a href="error500.html">Error 500</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="fa fa-cubes"></i><span>Kontak</span></a>
        <ul>
          <li><a href="error403.html">Error 403</a></li>
          <li><a href="error404.html">Error 404</a></li>
          <li><a href="error405.html">Error 405</a></li>
          <li><a href="error500.html">Error 500</a></li>
        </ul>
      </li>
      <li class="submenu"> <a href="#"><i class="fa fa-cubes"></i><span>Konfigurasi</span></a>
        <ul>
          <li><a href="error403.html">Error 403</a></li>
          <li><a href="error404.html">Error 404</a></li>
          <li><a href="error405.html">Error 405</a></li>
          <li><a href="error500.html">Error 500</a></li>
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
  <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>
  <!--End-breadcrumbs-->
  <!--Action boxes-->
    <div class="container-fluid">
    
        <?php echo $body ?>  
    </div>
    

      
    </div>
  </div>
  <!--end-main-container-part-->
  
  <footer style="height: 50px"></footer>
  </body>
</html>