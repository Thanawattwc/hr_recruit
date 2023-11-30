<?php
if (!isset($_SESSION['user_data'])) {
  $role = 'user';
} else {
  $role = trim($_SESSION['user_data']['role']);
}
if ($role === 'dev' || $role === 'admin' || $role === 'hr') {

?>
  <div class="content" data-module="<?php print $this->router->fetch_class(); ?>">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-stats">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-category d-flex justify-content-between align-items-center">
                <p></p>
                <p><?php print $title; ?></p>
                <p></p>
              </div>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12">
                    <div class="card card-stats" style="padding: 3%;">
                      <div class="row">
                        <div class="media-body">
                          <p>
                            <strong>หมายเลขประกาศ</strong> : <?php print_r($data[0]['job_number']); ?>
                          </p>
                        </div>
                      </div>

                      <div class="row row-xs">
                        <div class="col-sm-6 col-lg-3">
                          <div class="card card-status">
                            <div class="media">

                              <div class="media-body">
                                <p>

                                  <strong>ตำแหน่ง</strong> : <?php print_r($data[0]['positon_name']); ?>
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6 col-lg-3 mg-t-10 mg-sm-t-0">
                          <div class="card card-status">
                            <div class="media">

                              <div class="media-body">
                                <p>
                                  <strong>สังกัด</strong> : <?php print_r($data[0]['org_name']); ?>
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
                          <div class="card card-status">
                            <div class="media">

                              <div class="media-body">
                                <p>
                                  <strong>หมายเลขประกาศ</strong> : <?php print_r($data[0]['job_number']); ?>
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
                          <div class="card card-status">
                            <div class="media">
                              <i class="icon ion-ios-analytics-outline tx-pink"></i>
                              <div class="media-body">
                                <p>
                                  <strong>สถานะประกาศ</strong> :
                                  <?php
                                  $status = $data[0]['status'];
                                  $color = ($status == "Online" ? "green" : ($status == "Offline" ? "red" : "gray"));
                                  print_r('<strong style="color: ' . $color . ';">' . $status . '</strong>');
                                  ?>
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <?php print_r($data[0]['position_detail']); ?>
                      </div>
                      <div class="col-12">
                        <h4><strong>Contact HR</strong></h4>
                        <p>
                          <strong>ตำแหน่ง</strong> : <?php print_r($data[0]['owner_postion_name']); ?>
                          <strong>ชื่อ-สกุล</strong> : <?php print_r($data[0]['owner_fullname']); ?>
                          <strong>email</strong> : <?php print_r($data[0]['owner_email']); ?>
                          <strong>เบอร์ติดต่อ</strong> : <?php print_r($data[0]['owner_phone_number']); ?>
                        </p>
                      </div>
                      <div style="width:100%; text-align:center;">
                        <?php
                        if ($status == 'Online') {
                          print('<button type="button" class="btn btn-danger btn-offline">Offline</button>');
                          print('<button type="button" class="btn btn-light btn-close">Close</button>');
                          print('<button type="button" class="btn btn-warning btn-edit">Edit</button>');
                        } else if ($status == 'Offline') {
                          print('<button type="button" class="btn btn-success btn-online">Online</button>');
                          print('<button type="button" class="btn btn-light btn-close">Close</button>');
                          print('<button type="button" class="btn btn-primary btn-copy">Copy</button>');
                          print('<button type="button" class="btn btn-warning btn-edit">Edit</button>');
                        } else if ($status == 'Close') {
                          print('<button type="button" class="btn btn-primary btn-copy">Copy</button>');
                          print('<button type="button" class="btn btn-success btn-repost">Repost</button>');
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal-container">
    <div class="modal fade" id="modal-confirm" tabindex="1" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">ยืนยันที่จะปรับสถานะ</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <input id="inputStatus" style="display: none;" />
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-danger btn-closeModel" data-dismiss="modal" value="ไม่ยืนยัน">
            <input type="button" class="btn btn-primary btn-confirm" value="ยืนยัน">
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
} else {
  header("Location:" . base_url('/login'));
}
?>





<script type="text/javascript">
  $(document).ready(function() {

    $(document).on('click', '.btn-online', function() {
      $("#inputStatus").val("Online");
      $('#modal-confirm').modal('show');
    })
    $(document).on('click', '.btn-offline', function() {
      $("#inputStatus").val("Offline");
      $('#modal-confirm').modal('show');
    })
    $(document).on('click', '.btn-close', function() {
      $("#inputStatus").val("Close");
      $('#modal-confirm').modal('show');
    })
    $(document).on('click', '.btn-confirm', function() {
      Status = $("#inputStatus").val();
      fn.updateStatus(Status);
    })
    $(document).on('click', '.btn-copy', function() {
      location.replace(base_url('/hr/jobCreate?id=' + <? print_r($data[0]['id']); ?>));
    })
    $(document).on('click', '.btn-edit', function() {
      location.replace(base_url('/hr/jobCreate?edit=' + <? print_r($data[0]['id']); ?>));
    })
    $(document).on('click', '.btn-repost', function() {
      fn.updateRepost();
    })
  })

  var fn = {
    popupConfirm: function() {
      $('#modal-confirm').modal('show');
    },
    updateStatus: function(param) {
      id = <? print_r($data[0]['id']); ?>;
      status = param;

      $.ajax({
        type: "POST",
        // url: base_url("/hr_recruit/hr/Detail_hr/update_status"),
        url: base_url("/hr/Detail_hr/update_status"),
        data: {
          "id": id,
          "status": status,
        },
        success: function(res, textStatus, jqXHR) {
          console.log(res.success.data);
          location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(jqXHR);
          console.log(errorThrown);
        },
      })
    },
    updateRepost: function() {
      id = <? print_r($data[0]['id']); ?>;

      $.ajax({
        type: "POST",
        // url:  base_url("/hr_recruit/hr/Detail_hr/repost"),
        url: base_url("/hr/Detail_hr/repost"),
        data: {
          "id": id,
        },
        success: function(res, textStatus, jqXHR) {
          res_id = res.success.data;
          // location.replace(base_url('/hr_recruit/hr/detail_hr?id=' + res_id));
          location.replace(base_url('/hr/detail_hr?id=' + res_id));
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(jqXHR);
          console.log(errorThrown);
        },
      })
    },

    formatDate: function(date) {
      var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
      if (month.length < 2)
        month = '0' + month;
      if (day.length < 2)
        day = '0' + day;
      return [year, month, day].join('');
    },
    specialChar: function(string) {
      var specialChars = "<>@!#$%^&*()_+[]{}?:;|'\"\\,./~`-=";
      for (i = 0; i < specialChars.length; i++) {
        if (string.indexOf(specialChars[i]) > -1) {
          return true
        }
      }
      return false;
    },
    ajaxSuccess: function(res, textStatus, jqXHR, form) {
      $.notifyClose();
      var action = $(form).attr('id');
      window.location.reload();
    },
    ajaxError: function(jqXHR, textStatus, errorThrown) {
      fn.error(jqXHR, textStatus, errorThrown);
    },
    error: function(jqXHR, textStatus, errorThrown) {
      res = jqXHR.responseJSON;
      $.notifyClose();
      $.notify({
        icon: 'notification_important',
        message: res
      }, {
        newest_on_top: true,
        type: 'danger',
        delay: 1000,
        timer: 3000,
        placement: {
          from: 'top',
          align: 'center'
        },
        animate: {
          enter: 'animated bounceIn',
          exit: 'animated bounceOut'
        }
      });
    },
    success: function(res, textStatus, jqXHR) {
      $.notifyClose();
      $.notify({
        icon: 'notifications',
        message: res.success.message
      }, {
        newest_on_top: true,
        type: 'success',
        delay: 1000,
        timer: 500,
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


  }
</script>