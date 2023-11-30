<!doctype html>
<html lang="th">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" href="<?php print base_url('images/icon-150x150.png'); ?>">
  <link rel="icon" type="image/png" href="<?php print base_url('images/favicon.png'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>
    <?php
    if ($_SERVER['CI_ENV'] !== 'production') {
      print '(' . strtoupper($_SERVER['CI_ENV']) . ') ';
    }
    print _APPLICATION_NAME_;
    ?> | Mitr Phol Group
  </title>

  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no" name="viewport">
  <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?php print base_url('font/font-face.css'); ?>" rel="stylesheet">
  <link href="<?php print base_url('vendor/fontawesome/css/all.css'); ?>" rel="stylesheet">
  <link href="<?php print base_url('vendor/chartist-js/css/chartist.css'); ?>" rel="stylesheet">
  <link href="<?php print base_url('vendor/mdb/css/mdb.css'); ?>" rel="stylesheet">
  <link href="<?php print base_url('vendor/bootstrap/css/bootstrap.css'); ?>" rel="stylesheet">
  <link href="<?php print base_url('vendor/fancybox/css/jquery.fancybox.css'); ?>" rel="stylesheet">
  <link href="<?php print base_url('vendor/datetimepicker/css/jquery.datetimepicker.css'); ?>" rel="stylesheet">
  <link href="<?php print base_url('vendor/flag/css/flag-icon.css'); ?>" rel="stylesheet">
  <link href="<?php print base_url('vendor/material-dashboard/css/material-dashboard.css'); ?>" rel="stylesheet">
  <link href="<?php print base_url('vendor/animate/animate.css'); ?>" rel="stylesheet">
  <link href="<?php print base_url('css/custom-theme.css'); ?>" rel="stylesheet">
  <link href="<?php print base_url('css/styles.css'); ?>" rel="stylesheet">
  <link href="<?php print base_url('css/sweetalert2.min.css'); ?>" rel="stylesheet">




  <!-- <script src="<?php print base_url('vendor/tinymce/tinymce.min.js'); ?>" type="text/javascript"></script> -->
  <script src="<?php print base_url('vendor/jquery/jquery-3.3.1.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/holder/holder.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/popper/popper.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/sammy/sammy.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/material-dashboard/js/bootstrap-material-design.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/moment/js/moment-with-locales.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/sweetalert/js/sweetalert2.all.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/jquery-validation/js/jquery.validate.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/jquery-validation/js/additional-methods.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/fancybox/js/jquery.fancybox.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/jquery-form/jquery.form.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/bootstrap-wizard/js/jquery.bootstrap.wizard.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/bootstrap-select/js/bootstrap-select.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/bootstrap-select/js/ajax-bootstrap-select.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/datetimepicker/js/jquery.datetimepicker.full.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/jquery-sortable/jquery-sortable.js'); ?>" type="text/javascript"></script>
  <!-- <script src="<?php print base_url('vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js'); ?>" type="text/javascript"></script> -->
  <script src="<?php print base_url('vendor/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/bootstrap-jasny/js/jasny-bootstrap.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/inputmask/jquery.inputmask.bundle.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/fullcalendar/js/fullcalendar.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/jvectormap/js/jquery-jvectormap.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/noUiSlider/js/nouislider.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/twbsPagination/jquery.twbsPagination.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/arrive/js/arrive.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/chartist-js/js/chartist.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/chartist-js/plugin/chartist-plugin-accessibility.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/chartist-js/plugin/chartist-plugin-pointlabels.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/chart-js/Chart.bundle.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/bootstrap-notify/js/bootstrap-notify.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/bootbox/bootbox.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/jquery-qrcode/jquery-qrcode-0.14.0.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/datatable/datatables.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/jquery-autosize/autosize.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/jsPDF/jspdf.min.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/jsPDF/fonts/thaisansneue-regular-webfont-normal.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/jsPDF/jspdf.plugin.autotable.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/jquery-table-export/tableHTMLExport.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('vendor/material-dashboard/js/material-dashboard.js'); ?>" type="text/javascript"></script>

  <!-- <script src="<?php print base_url('js/html2canvas.js'); ?>" type="text/javascript"></script> -->
  <script src="<?php print base_url('js/prototype.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('js/function.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('js/component.js'); ?>" type="text/javascript"></script>
  <script src="<?php print base_url('js/sweetalert2.all.min.js'); ?>" type="text/javascript"></script>
</head>

<body>
  <div class="wrapper">
    <?php $this->load->view('_shared/sidebar'); ?>
    <div class="main-panel">
      <?php $this->load->view('_shared/navbar'); ?>
      <?php $this->load->view('content/' . $content); ?>
    </div>
  </div>
  <!-- <script type="text/javascript">
  $(document).ready(function() {
    $.each($('[data-text-th][data-text-en]'), function(index, value) {
      var label_text = $(this).data('text-' + lang);

      if($(this).find('*').length) {
        if($(this).find('[data-text-th][data-text-en]')) {
          var msg = $(this).find('[data-text-th][data-text-en]').data('text-' + lang);

          $(this).find('[data-text-th][data-text-en]').text(msg);
        }

        var label_html = $(this).html();

        label_text += ' ' + label_html;
      }

      $(this).html(label_text);
    });

    $.each($('[data-required-th][data-required-en]'), function(index, value) {
      var required_msg = $(this).data('required-' + lang);

      $(this).data('msg-required', required_msg);
    });
  });
  </script> -->
</body>

</html>