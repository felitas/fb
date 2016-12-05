<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title ?> - Kemenangan</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
    <link href="<?php echo base_url() ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/metro.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/metro-icons.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/metro-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/metro-schemes.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/docs.css" rel="stylesheet">

    
    

    <script src="<?php echo base_url() ?>js/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>js/metro.js"></script>
    <script src="<?php echo base_url();?>js/script.js"></script>
    
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

      /*Navbars*/
      .dropdown-toggle,.non-drop{
        padding-left: 6% !important;
        padding-top: 5% !important;
        padding-bottom: 5% !important;
      }
      .sidebar2>li>a{
        background-color: #2e363f !important;
        color: #fff;
      }
      .sidebar2 li{
        border-top: none;
      }
      .sidebar2,.sidebar2>li{
        border-top: 1px solid #37414b; 
        border-bottom: 1px solid #1f262d;
        border-left: none;
      }
      .sidebar2{
        background-color: #2e363f !important;
        position: fixed;
        height: 100% !important;
        width: 17%;
        z-index: 6;
      }
      
      .sidebar2 li li:not(:hover) a{
        background-color: #1e242b !important;
        color: white;
      }

      .sidebar2 li:hover a{
        background-color: #0f3a76 !important;
      }
      .d-menu li:hover a{
        background-color: #2C6BC2 !important;
      }


      .d-menu>li>a{
        padding-left: 8% !important;
      }
      .menu-text{
        font-size: 12px;
      }
      .menu-icon{
        display: inline-block;
        width: 25px;
      }
      /*End of navbar setting*/
      @media(max-width: 425px){
        .tile-large,.tile,.tile-wide{
          width: 150px;
          height: 150px;
        }
        .tile-group{
          width: 320px !important;
          margin: 0 3% !important;
        }
      }

      .tile-group{
        margin: 0 12%;
      }
      .tile-group-title{
        color: black !important;
        text-transform: uppercase;
      }

      .input-control input, .input-control textarea, .input-control select{
        border-color: rgba(127, 140, 141,1.0);
      }
      .btn-file{
        border-color: rgba(127, 140, 141,1.0);
      }
      .btn-teal:hover{
        background-color: white !important;
        -webkit-transition: all 0.3s ease-in;
        -moz-transition: all 0.3s ease-in;
        transition: all 0.3s ease-in;
        color: <?php echo $configuration->primary_color ?> !important;
        border: 1px solid <?php echo $configuration->primary_color ?> !important;
        font-weight: bold
      }
      .form-title{
        padding-bottom: 10px;
        padding-top: 5px;
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


  
    </style>

  </head>
  <body>
  <div class="grid condensed" style="margin-top: 0px;">
    <div class="row cells6">
      <div class="cell colspan1">
        <ul class="sidebar2">
            <li><a href="<?php echo base_url('home') ?>" class="menu-a non-drop"><div class="menu-icon"><i class="fa fa-home" aria-hidden="true"></i></div> <span class="menu-text">Home</span></a></li>
            <li>
                <a class="dropdown-toggle" href="#"><div class="menu-icon"><i class="fa fa-money" aria-hidden="true"></i></div> <span class="menu-text">Penjualan</span></a>
                <ul class="d-menu" data-role="dropdown">
                  <li><a><div class="menu-icon"><i class="fa fa-file-text" aria-hidden="true"></i></div> <span class="menu-text"> Daftar Penjualan</span></a></li>
                  <li><a><div class="menu-icon"><i class="fa fa-plus-square" aria-hidden="true"></i></div> <span class="menu-text"> Penjualan Baru</span></a></li>
                  <li><a><div class="menu-icon"><i class="fa fa-check-square" aria-hidden="true"></i></div> <span class="menu-text">Daftar Booking</span></a></li>
                  <li><a><div class="menu-icon"><i class="fa fa-check-square-o" aria-hidden="true"></i></div> <span class="menu-text">Booking Baru</span></a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#"><div class="menu-icon"><i class="fa fa-shopping-basket" aria-hidden="true"></i></div> <span class="menu-text">Pembelian</span></a>
                <ul class="d-menu" data-role="dropdown">
                  <li><a><div class="menu-icon"><i class="fa fa-file-text" aria-hidden="true"></i></div> <span class="menu-text"> Daftar Pembelian</span></a></li>
                  <li><a><div class="menu-icon"><i class="fa fa-cart-plus" aria-hidden="true"></i></div> <span class="menu-text"> Pembelian Baru</span></a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#"><div class="menu-icon"><i class="fa fa-mail-reply" aria-hidden="true"></i></div> <span class="menu-text">Buyback</span></a>
                <ul class="d-menu" data-role="dropdown">
                  <li><a><div class="menu-icon"><i class="fa fa-file-text" aria-hidden="true"></i></div> <span class="menu-text">Daftar Buyback</span></a></li>
                  <li><a><div class="menu-icon"><i class="fa fa-plus-square" aria-hidden="true"></i></div> <span class="menu-text">Buyback Baru</span></a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#"><div class="menu-icon"><i class="fa fa-cubes" aria-hidden="true"></i></div> <span class="menu-text">Inventori</span></a>
                <ul class="d-menu" data-role="dropdown">
                  <li><a><div class="menu-icon"><i class="fa fa-file-text" aria-hidden="true"></i></div> <span class="menu-text">Daftar Barang</span></a></li>
                  <li><a href="<?php echo base_url('product/add_product') ?>"><div class="menu-icon"><i class="fa fa-plus-square" aria-hidden="true"></i></div> <span class="menu-text">Input Barang</span></a></li>
                  <li><a><div class="menu-icon"><i class="fa fa-file-text" aria-hidden="true"></i></div> <span class="menu-text">Daftar Mutasi</span></a></li>
                  <li><a><div class="menu-icon"><i class="fa fa-send" aria-hidden="true"></i></div> <span class="menu-text">Kirim Barang</span></a></li>
                  <li><a><div class="menu-icon"><i class="fa fa-truck" aria-hidden="true"></i></div> <span class="menu-text">Terima Barang</span></a></li>
                  <li><a><div class="menu-icon"><i class="fa fa-archive" aria-hidden="true"></i></div> <span class="menu-text">Stok Opnam</span></a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#"><div class="menu-icon"><i class="fa fa-phone" aria-hidden="true"></i></div> <span class="menu-text">Kontak</span></a>
                <ul class="d-menu" data-role="dropdown">
                  <li><a><div class="menu-icon"><i class="fa fa-user-circle" aria-hidden="true"></i></div> <span class="menu-text">Kostumer</span></a></li>
                  <li><a><div class="menu-icon"><i class="fa fa-university" aria-hidden="true"></i></div> <span class="menu-text">Supplier</span></a></li>
                  <li><a><div class="menu-icon"><i class="fa fa-plus-square" aria-hidden="true"></i></div> <span class="menu-text">Tambah Kontak</span></a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#"><div class="menu-icon"><i class="fa fa-wrench" aria-hidden="true"></i></div> <span class="menu-text">Konfigurasi</span></a>
                <ul class="d-menu" data-role="dropdown">
                  <li><a><div class="menu-icon"><i class="fa fa-file-text" aria-hidden="true"></i></div> <span class="menu-text">Daftar Baki</span></a></li>
                  <li><a><div class="menu-icon"><i class="fa fa-tags" aria-hidden="true"></i></div> <span class="menu-text">Kategori Barang</span></a></li>
                  <li><a><div class="menu-icon"><i class="fa fa-puzzle-piece" aria-hidden="true"></i></div> <span class="menu-text">Model Barang</span></a></li>
                </ul>
            </li>

        </ul>      
      </div>
      <div class="cell colspan5">
        <ul class="h-menu">          
          <li class="place-right no-hovered">
              <a href="#" class="dropdown-toggle">Welcome, <?php echo $this->session->user_name?></a>
              <ul  class="d-menu" data-role="dropdown">
                  <li><a href="#">About</a></li>
                  <li><a href="#">Partners</a></li>
              </ul>
          </li>
        </ul>
        
        <?php echo $body ?>      
      </div>
    </div>
  </div>
  

  
  
  <button onclick="toggleMetroCharm('#charm_currency')" id="kurstoggle" class="button bg-primary"><span class="icon mif-dollar2 mif-2x" style="margin-bottom: 4px;"></span>Kurs</button>
  <?php $currencies = $this->crud_model->get_data('currency')->result();?>
  <div data-role="charm" data-position="bottom" id="charm_currency">
      <table class="table" style="margin-top: 0px;">
          <thead id="currency_head">
            <tr>
              <?php foreach ($currencies as $currency):?>
                  <td style="color: #fff;text-transform:uppercase;"><?php echo $currency->name; ?></td>
              <?php endforeach; ?>
            </tr>  
          </thead>
          <tbody>
            <tr>
              <?php foreach ($currencies as $currency):?>
                  <td><?php echo 'Rp '. number_format($currency->value,2,',','.') ?></td>
              <?php endforeach; ?>
            </tr>  
          </tbody>
      </table>
  </div>

  <footer style="height: 50px"></footer>

    <script>
      
    </script>
  </body>
</html>