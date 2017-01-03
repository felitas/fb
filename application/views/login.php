<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login - Fajar Baru</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
    <link href="<?php echo base_url() ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/bootstrap-responsive.min.css" rel="stylesheet"><!--Matrix-->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/matrix-login.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>css/jquery.gritter.css" /><!--Matrix Notification-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>    
    
    <script src="<?php echo base_url() ?>js/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery.ui.custom.js"></script><!--Matrix-->
    <script src="<?php echo base_url();?>js/bootstrap-wysihtml5.js"></script><!--Matrix-->
    <script src="<?php? echo base_url();?>js/matrix.login.js"></script> 
    <script src="<?php echo base_url();?>js/jquery.gritter.min.js"></script> <!--Matrix Notification-->

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
      #loginbox{
        padding-top: 5%;
      }
      #loginform, .control-group{
        background-color: #fff !important;
      }
      .form-actions,#loginform{
        border:none;
      }
      input, .add-on{
        border: 1px solid #002f8e !important;
      }
      .btn-success:hover{
        background-color: rgba(52, 152, 219,1.0) !important;
        border-color: rgba(52, 152, 219,1.0) !important;
      }
      input[type="submit"]{
        padding: 7px 20px 7px !important;
        background-color: #002f8e !important
      }


    </style>

  </head>
  <body>
  <div id="loginbox">
        <?php echo form_open('accounts/login', array('id'=>'loginform','class'=>'form-vertical')) ?>
              <div class="control-group normal_text"> <img src="<?php echo base_url('assets/FajarBaru.png') ?>" alt="Fajar Baru" height="60%" width="60%"/></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lb"><i class="fa fa-user"> </i></span><input type="text" placeholder="Username" name="username" required="1" />
                        </div>
                    </div>
                </div>
                <div class="control-group" style="padding-bottom: 10px !important">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lb"><i class="fa fa-lock"></i></span><input type="password" placeholder="Password" name="password" required="1" />
                        </div>
                    </div>
                </div>
                <div class="form-actions text-center">
                    <input type="submit" name="submit" class="btn btn-success" value="Log In">
                </div>
          <?php echo form_close()?>
        </div>
  </body>

  <script>
    $(document).ready(function(){
        <?php if($this->session->flashdata('login')): ?>
            <?php echo $this->session->flashdata('login') ?>
        <?php endif; ?>
    });

  </script>
</html>