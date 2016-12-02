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
     
      .navbar{
        background-color: <?php echo $configuration->primary_color ?>;
        height: 50px;
        border:none;
        border-radius: 0px;
      }
      .bg-primary{
        background-color: <?php echo $configuration->primary_color ?> !important;
        color: white !important;
      }
      .overlay{
        position: fixed;
        width: 100%;
        height: 0;
        z-index: 3;
        left: 0;
        top: 50px;
        opacity: 0;
        background-color:#fff;
        overflow-x: hidden;
        overflow-y: hidden;
        -webkit-box-shadow: 0 7px 10px 0 #9E9E9E;
        box-shadow: 0 7px 10px 0 #9E9E9E;
        transition: 0.2s ease-in;
      }
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
      @media (max-width: 1127px){
      .tile-group {
        margin:0 !important;
        float: left !important;
      }}
      @media(max-width: 500px){
        .navbar-brand{
          display: none;
        }
      }

      @media(max-width: 425px){
        .tile-large,.tile,.tile-wide{
          width: 150px;
          height: 150px;
        }
        .navbar-nav>li{
          width: 14.27% !important;
          text-align: center;
        }
        .navbar-nav{
          width: 100%;
        }
        .tile-group{
          width: 320px !important;
          margin: 0 3% !important;
        }
        #transaksi-container{
          margin:0 !important;
        }
        .navbar > .container-fluid{
          padding: 0 !important;
        }
      }
      .tile-group{
        margin: 0 12%;
      }
      .overlay-content{
        position: relative;
        top: 0%;
        width: 100%;
        text-align: center;
        margin-top: 20px;
      }
      .navbar-nav>li{
        border-right: 1px solid #fff;
      }
      .navbar-nav>li:hover{

        background-color: white !important;
        -webkit-transition: all 0.3s ease-in;
        -moz-transition: all 0.3s ease-in;
        transition: all 0.3s ease-in;
      }
      .navbar-nav>li:hover .menu-a {
        color: <?php echo $configuration->primary_color ?> !important;
      }
      .navbar-nav>li>a{
        color: white !important;
      }
      .navbar-brand{
        border-right: 1px solid #fff; 
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
      .buka>a:visited,.buka>a:focus,.buka>a:active,.buka>a:hover{
        color: <?php echo $configuration->primary_color ?> !important;
        background-color: #FFFFFF;
        -webkit-transition: all 0.3s ease-in;
        -moz-transition: all 0.3s ease-in;
        transition: all 0.3s ease-in;
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


  /* The side navigation menu */
   #mySidenav .fa
    {
      font-size:18px;
    }

    #mySidenav a
    {
      font-size:18px;
    }
    .sidenav {
        height: 100%; /* 100% Full-height */
        width: 220px; /* 0 width - change this with JavaScript */
        position: fixed; /* Stay in place */
        z-index: 30; /* Stay on top */
        left: -8px;
        background-color: #948a6a; /* Black*/
        overflow-x: hidden; /* Disable horizontal scroll */
        padding-top: 10px; /* Place content 60px from the top */
        transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */

    }

    #menu-button{
        color: #948a6a !important;
    }


    /* The navigation menu links */
    .sidenav .icon-navbar{
        display: inline-block;
        width: 27px;
        margin-left: -7px;
    }

    .sidenav a {
        padding: 12px 8px 12px 22px;
        text-decoration: none;
        font-size: 15px !important;
        color: #ecf0f1;
        display: block;
        transition: 0.3s
    }

    /* When you mouse over the navigation links, change their color */
    .sidenav a:hover, .offcanvas a:focus{
      background-color: rgba(0, 0, 0,0.5);
        color: #f1f1f1;
    }

    /* Position and style the close button (top right corner) */
    .sidenav .closebtn {
        position: absolute;
        top: 0;
        right: 10px;
        font-size: 36px;
        margin-left: 100px;
    }
    .sidenav .closebtn:hover{
      background-color: transparent;
      color: #bdc3c7;
    }

    </style>

  </head>
  <body>
  
  <header>
      <nav class="navbar navbar-default" style="margin-bottom: 0px !important;">
        <div class="container-fluid" style="padding-left: 15px; padding-right: 15px;">
          <!-- Brand and toggle get grouped for better mobile display -->

          <div class="navbar-header">
            
            <a class="navbar-brand" href="#">Logo</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
            <ul class="nav navbar-nav navbar-right" style="hidden-sm">
              <li class="dropdown">
                  <a class="menu-a" style="cursor: pointer;" href="#"><span class="icon mif-user" style="margin-bottom: 4px;"></span> <span class="menu-text">Welcome, <?php echo $this->session->user_name?></span></a>
              </li>
            </ul>
              
            
           <!--Main menu ul ends-->
             
          
        </div><!-- /.container-fluid -->
      </nav>
      <div id="mySidenav" class="sidenav">

        <a href="javascript:void(0)" class="closebtn" onclick="triggerMenu()" style="border-bottom: none;font-size:25px!important; display: none;">&times;</a>
        <a onclick="triggerMenu()" id="menu-button"><div class="icon-navbar"><i class="fa fa-bars" style="color: #fff!important; cursor: pointer" aria-hidden="true" ></i></div></a>
        <a href="<?php echo base_url() ?>"><div class="icon-navbar"><i class="fa fa-home" aria-hidden="true"></i></div><span class="menu-text">Home</span></a>
        <a href="#"><div class="icon-navbar"><i class="fa fa-calendar" aria-hidden="true"></i></div><span class="menu-text">Transaksi</span></a>
          <ul></ul>
        <a href="<?php echo base_url('new_budget/transaction') ?>"><div class="icon-navbar"><i class="fa fa-plus" aria-hidden="true"></i></div><span class="menu-text">Inventory</span></a>
        <a href="<?php echo base_url('giro') ?>"><div class="icon-navbar"><i class="fa fa-money" aria-hidden="true"></i></div><span class="menu-text">Toko</span></a>
        <a href="<?php echo base_url('main/cicilan_tahunan/') ?>"><div class="icon-navbar"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></div><span class="menu-text">Kontak</span></a>
        <a href="<?php echo base_url('main/all_transactions/') ?>"><div class="icon-navbar"><i class="fa fa-dollar" aria-hidden="true"></i></div><span class="menu-text">Konfigurasi</span></a> 
        
      </div>
  </header>
  

  <?php echo $body ?>
  
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