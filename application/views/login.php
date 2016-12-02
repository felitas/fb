<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login - Victory</title>

    <!-- Bootstrap -->
    
    
    <link href="<?php echo base_url() ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/metro.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/metro-icons.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/metro-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/metro-schemes.css" rel="stylesheet">

    <script src="<?php echo base_url() ?>js/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url() ?>js/metro.js"></script>
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>

      body{
        background: #f0eff0;
      }
      .card{
        text-align: center;
        border: 1px solid #3498db;

        
      }
      .card-header{
        background-color: #3498db;
        color: white;
        padding: 20px 0;
      }
      .card-header h2{
        margin:0;
      }
      .card-body{
        background-color: white;
        padding: 20px;
      }
      .btn-teal:hover{
        background-color: #30D5F1!important;
        -webkit-transition: all 0.3s ease-in;
        -moz-transition: all 0.3s ease-in;
        transition: all 0.3s ease-in;
      }
      form{
        width: 40%;
      }
      @media (max-width: 768px){
        form{
          width: 90% !important;
          margin:auto !important;
        }
      }
    </style>

  </head>
  <body>

    <div class="container">
      <div class="flex-grid" style="margin: 11% 0;">
      <div class="row flex-just-center">
        
      
        
        
        <?php echo form_open('accounts/login') ?>
        <div class="cell">
        
          <div class="card">
            <div class="card-header">
              <h2>Kemenangan</h2>  
            </div>
            <div class="card-body">
                <div class="cell" style="margin:auto">
                  <div class="input-control modern text iconic" data-role="input">
                    <input type="text" name="username" required="1">
                    <span class="label">Username</span>
                    <span class="informer">Please enter your username</span>
                    <span class="placeholder">Username</span>
                    <span class="icon mif-user"></span>
                  </div>
              
                <div class="cell" style="margin:auto">
                    <div class="input-control modern password iconic" data-role="input">
                      <input type="password" name="password" required="1">
                      <span class="label">Password</span>
                      <span class="informer">Please enter your password</span>
                      <span class="placeholder">Password</span>
                      <span class="icon mif-lock"></span>
                      <button class="button helper-button reveal"><span class="mif-looks"></span></button>
                    </div>
                </div>
              
                <div class="cell" style="margin:auto">
                  <input type="submit" name="submit" class="button info btn-teal" value="Log In" style="background-color: #3498DB">
                </div>
            </div>
          </div>
        <?php echo form_close() ?>
        </div>
        </div>
      </div>
    </div>
    
  </body>

  <script>

    <?php if($this->session->userdata('failed')): ?>

       <?php echo $this->session->userdata('failed') ?>

    <?php endif; ?>
  </script>
</html>