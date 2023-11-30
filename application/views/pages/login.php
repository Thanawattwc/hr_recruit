<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php print base_url('assets/img/apple-icon.png'); ?>">
    <link rel="icon" type="image/png" href="<?php print base_url('images/favicon.png?v=0.17'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
      MITR PHOL GROUP
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php print base_url('font/font-face.css'); ?>" rel="stylesheet">
    <link href="<?php print base_url('vendor/fontawesome/css/all.css'); ?>" rel="stylesheet">
    <link href="<?php print base_url('vendor/material-dashboard/css/material-dashboard.css'); ?>" rel="stylesheet">
    <link href="<?php print base_url('vendor/animate/animate.css'); ?>" rel="stylesheet">
    <link href="<?php print base_url('css/custom-theme.css'); ?>" rel="stylesheet">
  </head>

  <body>
    <div class="wrapper wrapper-full-page">
      <div class="page-header login-page header-filter" filter-color="black" style="background-image: url('<?php print base_url('images/background/page-login.jpg'); ?>'); background-size: cover; background-position: top center;">
        <div class="container">
          <div class="col-lg-4 col-md-6 col-sm-6 ml-auto mr-auto">
            <form class="form" method="post" action="<?php print base_url('login/validate'); ?>" data-plugin="validate" autocomplete="off">
              <div class="card card-login card-hidden">
                <div class="card-header card-header-primary text-center">
                  <h4 class="card-title">
                    <img src="<?php print base_url('images/logo.png'); ?>" class="img-fluid" alt="AttenDee">
                  </h4>
                  <p class="card-description text-center">Supply Chain</p>
                </div>
                <div class="card-body">
                  <div class="form-group bmd-form-group input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                          <i class="material-icons">face</i>
                      </span>
                    </div>
                    <label for="exampleUsername" class="bmd-label-floating">Username</label>
                    <input type="text" class="form-control" id="txtUsername" name="username" required>
                  </div>
                  <div class="form-group bmd-form-group input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                          <i class="material-icons">lock_outline</i>
                      </span>
                    </div>
                    <label for="exampleUsername" class="bmd-label-floating">Password</label>
                    <input type="password" class="form-control" id="txtPassword" name="password" required>
                  </div>
                </div>
                <div class="card-footer justify-content-center">
                  <button type="submit" class="btn btn-primary btn-lg">Sign In</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="<?php print base_url('vendor/jquery/jquery-3.3.1.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php print base_url('vendor/popper/popper.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php print base_url('vendor/material-dashboard/js/bootstrap-material-design.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php print base_url('vendor/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php print base_url('vendor/moment/js/moment-with-locales.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php print base_url('vendor/sweetalert/js/sweetalert2.all.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php print base_url('vendor/jquery-validation/js/jquery.validate.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php print base_url('vendor/jquery-form/jquery.form.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php print base_url('vendor/arrive/js/arrive.min.js'); ?>" type="text/javascript"></script>
    <script src="<?php print base_url('vendor/bootstrap-notify/js/bootstrap-notify.js'); ?>" type="text/javascript"></script>
    <script src="<?php print base_url('vendor/material-dashboard/js/material-dashboard.js'); ?>" type="text/javascript"></script>
    <script src="<?php print base_url('js/function.js'); ?>" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('.card').removeClass('card-hidden');
      });

      var fn = {
        ajaxSuccess: function(res, textStatus, jqXHR)
        {
          $.notifyClose();
          location.reload();
        },
        ajaxError: function(jqXHR, textStatus, errorThrown)
        {
          res = jqXHR.responseJSON;
          $.notifyClose();
          $.notify({
            icon: 'notification_important',
            message: res.error.message
          },
          {
            newest_on_top: true,
            type: 'danger',
            timer: 4000,
            placement: {
              from: 'top',
              align: 'center'
            },
            animate: {
              enter: 'animated bounceIn',
              exit: 'animated bounceOut'
            }
          });
        }
      };
    </script>
  </body>
</html>