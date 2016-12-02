<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Victory !</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
    <link href="<?php echo base_url() ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/metro.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/metro-icons.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/metro-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/metro-schemes.css" rel="stylesheet">

    <link href="<?php echo base_url() ?>css/docs.css" rel="stylesheet">

    
    

    <script src="<?php echo base_url() ?>js/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>js/metro.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
    .dropdown-toggle:before {
      display: none;
    }
      .segoe{
        font-family: 'Segoe UI';
        font-size: 12px;
        line-height: 30px;
      }
      .dropdown-menu{
        background-color: #04BFBF;
      }
     
      .navbar{
        background-color: #04BFBF;
        height: 50px;
        border:none;
        border-radius: 0px;
      }
      .navbar-collapse{
        background-color: #04BFBF !important;
      }
      .navbar-default .navbar-toggle:focus, .navbar-default .navbar-toggle:hover {
        background-color: #91e9e0;
        color: white;
      }
      @media (max-width: 767px){
      .navbar-nav .open .dropdown-menu {
        background-color: #04BFBF;
      }}
      
      .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover {
        background-color: #91e9e0;
      }


      .icon-bar{
        background-color: white !important;
      }
      .dropdown{
        border-bottom: 1px solid #91e9e0;
      }
      .overlay{
        position: fixed;
        width: 1366px;
        height: 0;
        z-index: 1;
        left: 0;
        top: 50px;
        background-color:#fff;
        overflow-x: scroll;
        overflow-y: hidden;
        -webkit-box-shadow: 0 7px 10px 0 #9E9E9E;
        box-shadow: 0 7px 10px 0 #9E9E9E;
        transition: 0.2s;
      }
      .overlay-content{
        position: relative;
        top: 0%;
        width: 1366px;
        text-align: center;
        margin-top: 20px;
      }
      .navbar-nav>li{
        border-right: 1px solid #CAFCD8;
      }
      .navbar-nav>li:hover{

        background-color: #91e9e0;
        -webkit-transition: all 0.3s ease-in;
        -moz-transition: all 0.3s ease-in;
        transition: all 0.3s ease-in;
      }
      .navbar-nav>li>a{
        color: white !important;
      }
      .navbar-brand{
        border-right: 1px solid #CAFCD8; 
        color: white !important;
      }
      .tile-group-title{
        color: black !important;
        text-transform: uppercase;
      }
      .buka{

        background-color: #FFFFFF !important;
        -webkit-transition: all 0.3s ease-in;
        -moz-transition: all 0.3s ease-in;
        transition: all 0.3s ease-in;
      }
      .buka>a:visited{
        color: #04BFBF !important;
        background-color: #FFFFFF;
        -webkit-transition: all 0.3s ease-in;
        -moz-transition: all 0.3s ease-in;
        transition: all 0.3s ease-in;
      }
      .dropdown-menu li a{
        color: white !important;
      }
    </style>

  </head>
  <body>
  
  <header>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Toko Kemenangan</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href=""><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-money" aria-hidden="true"></i> Transaksi <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Daftar Penjualan</a></li>
                <li><a href="#">Penjualan Baru</a></li>
                <li><a href="#">Booking Barang</a></li>
                <li><a href="#">Daftar Booking</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Daftar Pembelian</a></li>
                <li><a href="#">Beli Emas</a></li>
                <li><a href="#">Beli Diamond</a></li>              
                
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-dropbox" aria-hidden="true"></i> Inventory <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Daftar Barang</a></li>
                <li><a href="#">Daftar Baki</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Stok Opname</a></li>
                <li><a href="#">Kirim</a></li>
                <li><a href="#">Terima</a></li>              
                
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="icon mif-shop"></span> Outlets <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Daftar Outlet</a></li>
                <li><a href="#">Tambah Toko Baru</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Daftar Sales</a></li>
                <li><a href="#">Tambah Sales Baru</a></li>         
                
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-phone" aria-hidden="true"></i> Kontak <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Daftar Customer</a></li>
                <li><a href="#">Tambah Customer Baru</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Daftar Supplier</a></li>
                <li><a href="#">Tambah Supplier Baru</a></li>         
                
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog" aria-hidden="true"></i> Konfigurasi <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Toko</a></li>
                <li><a href="#">Gold</a></li>
                <li><a href="#">Diamond</a></li>
                <li><a href="#">Member</a></li>
                <li><a href="#">Sales</a></li>
                <li><a href="#">Promo</a></li>         
                
              </ul>
            </li>

            <li><a href=""><i class="fa fa-power-off"></i> Logout</a></li>
          </ul>
          
         
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </header>
  <div class="container">
    <?php echo $body ?>
  </div>
  
  <footer></footer>
    
  </body>
</html>