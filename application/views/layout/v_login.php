<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>plantilla/assets/images/favicon.ico">
    <title>login</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url() ?>plantilla/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>plantilla/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?= base_url() ?>plantilla/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url(<?= base_url() ?>plantilla/assets/images/background/login-register1.jpg);">        
            <div class="login-box card">
            <div class="card-body">
               <?php 
                if($this->session->flashdata('usuario_incorrecto'))
                {
                ?>
                <div class="alert alert-danger">
                 <p><?=$this->session->flashdata('usuario_incorrecto')?></p>
                </div>
                <?php
                }
                 
                      
                ?>
               
                <form class="form-horizontal form-material" id="login_form1" 
                        action="<?php echo base_url();?>logusuario" method="post" >
                    <h3 class="box-title m-b-20" style="text-align: center;">Sistema Inventario Polaris</h3>
                   
                    <div class="alert alert-danger"  id="msg-error" style="display: none;"> 
                       <i class="ti-face-sad"></i> 
                       <strong> ¡Importante!</strong>  
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        <div  id="list_errorsA"></div>
                    </div> 
                     <?= form_hidden('token',$token)  ?>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="username" required="" placeholder="Usuario"> </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" placeholder="Password"> </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Entrar</button>
                        </div>
                    </div>
             
                </form>
                <form class="form-horizontal" id="recoverform" action="index.html">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email"> </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
        
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= base_url() ?>plantilla/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url() ?>plantilla/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?= base_url() ?>plantilla/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?= base_url() ?>plantilla/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?= base_url() ?>plantilla/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?= base_url() ?>plantilla/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?= base_url() ?>plantilla/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?= base_url() ?>plantilla/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url() ?>plantilla/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?= base_url() ?>plantilla/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>


  <script>
    $(document).ready(function() {
     //console.log('funciona')
       
    });


     $('#login_form').submit(function(e) {
      e.preventDefault();
      var url    = '<?php echo base_url() ?>verificar_usuario';
      var data = $('#login_form').serialize();
            $.ajax({
                  type: 'ajax',
                  method: 'post',
                  url: url,
                  data: data,
                  dataType: 'json',
                  beforeSend: function() {
                       console.log("enviando....");
                    }
                 })
                  .done(function(data){
                     console.log(data);
                      /*if (data.comprobador){
                       console.log(data.comprobador);
                        // $("#msg-error").hide();
                         $('#msg-error').removeClass('alert-danger');
                         $('#msg-error').addClass('alert-success');
                         $("#list_errorsA").html('Redireccionando...');
                         $('#mensaje').show().fadeIn().delay(5000).fadeOut('slow');

                       
                    
                      } else {
                         $("#msg-error").show();
                         $("#list_errorsA").html(data.validacion);

                         }*/
                     
                     
                  })
                  .fail(function(data){
                     //sweetalertclickerror();
                     console.log(data);
                  }) 
                  .always(function(){
                    //refrescar_tbl();
                  });
               
     });
   </script>
</html>
