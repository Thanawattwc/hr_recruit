<div class="sidebar" data-color="light-blue" data-background-color="white">
  <div class="logo">
    <a href="#" class="simple-text logo-mini">
      <img src="<?php print base_url('images/icon-40x40.png'); ?>" alt="Mitr Phol Group">
    </a>
    <a href="<?php print base_url(); ?>" class="simple-text logo-normal">
      <?php
      print _APPLICATION_NAME_;
      // print_r($_SESSION);
      if (!isset($_SESSION['user_data'])) {
        $fullname = '';
        $role = 'user';
      } else {
        // $fullname = '';
        // $role = 'Admin';
        $fullname = $_SESSION['user_data']['user_info']['fullname']['th'];
        $role = trim($_SESSION['user_data']['role']);
        // print_r($_SESSION['user_data']);

      }
      ?>
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php print base_url('#'); ?>" data-title-th="รายการประกาศ" data-active="JobList Menu">
          <i class="far fa-list-alt"></i>
          <p>รายการประกาศ
          </p>
        </a>
      </li>
      <ul class="nav">
        <!-- <li class="nav-item">
          <a class="nav-link" href="<?php print base_url('Test'); ?>" data-title-th="Test" data-active="Test Menu">
            <i class="far fa-list-alt"></i>
            <p>Test
            </p>
          </a>
        </li> -->
        <?php
        // if ($role == 'user') {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php print base_url('/login'); ?>" data-title-th="login" data-active="login Menu">
            <i class="far fa-user"></i>
            <p>login
            </p>
          </a>
        </li>
        <?php
        // }
        ?>

        <?php
        // if ($role <> 'user') {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php print base_url('/logout'); ?>" data-title-th="logout" data-active="logout Menu" <?php print($role == 'user' ? 'style="display:none;"' : '') ?>>
            <i class="far fa-user"></i>
            <p>logout
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#hrConfig" title="HR Config" data-toggle="collapse" data-active="Hr Menu">
            <i class="fas fa-users-cog"></i>
            <p>HR Config <b class="caret"></b></p>
          </a>
          <div class="collapse" id="hrConfig">
            <ul class="nav">
              <li data-id="HRList" data-module="Display on Permission Page" class="nav-item">
                <a class="nav-link" href="<?php print base_url('hr/hrList'); ?>" title="สร้างประกาศงาน (HR)" data-active="HRList Menu">
                  <i class="far fa-list-alt"></i>
                  <span class="sidebar-normal"> รายการประกาศ (HR)</span>
                </a>
              </li>
              <li data-id="HRList" data-module="Display on Permission Page" class="nav-item">
                <a class="nav-link" href="<?php print base_url('hr/test'); ?>" title="test (HR)" data-active="Test Menu">
                  <i class="far fa-list-alt"></i>
                  <span class="sidebar-normal"> Test (HR)</span>
                </a>
              </li>
              <li data-id="JobCreate" data-module="Display on Permission Page" class="nav-item">
                <a class="nav-link" href="<?php print base_url('hr/jobCreate'); ?>" title="สร้างประกาศงาน" data-active="jobCreate Menu">
                  <i class="fas fa-address-card"></i>
                  <span class="sidebar-normal"> สร้างประกาศงาน </span>
                </a>
              </li>
              <!-- <li data-id="roleConfig" data-module="Display on Permission Page" class="nav-item">
                <a class="nav-link" href="<?php print base_url('hr/report'); ?>" title="รายงาน" data-active="report Menu">
                  <i class="fas fa-address-card"></i>
                  <span class="sidebar-normal"> รายงาน </span>
                </a>
              </li> -->
            </ul>
          </div>
        </li>
        <?php
        // };
        ?>

        <?php
        // if ($role === 'admin') {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="#adminConfig" title="Admin Config" data-toggle="collapse" data-active="Admin Menu">
            <i class="fas fa-users-cog"></i>
            <p>Admin Config <b class="caret"></b></p>
          </a>
          <div class="collapse" id="adminConfig">
            <ul class="nav">
              <li data-id="roleConfig" data-module="Display on Permission Page" class="nav-item">
                <a class="nav-link" href="<?php print base_url('admin/roleConfig'); ?>" title="ตั้งค่าสิทธิ์" data-active="roleConfig Menu">
                  <i class="fas fa-address-card"></i>
                  <span class="sidebar-normal"> ตั้งค่าสิทธิ์ </span>
                </a>
              </li>

              <li data-id="roleConfig" data-module="Display on Permission Page" class="nav-item">
                <a class="nav-link" href="<?php print base_url('admin/report'); ?>" title="รายงาน" data-active="report Menu">
                  <i class="fas fa-address-card"></i>
                  <span class="sidebar-normal"> รายงาน </span>
                </a>
              </li>
            </ul>

          </div>
        </li>
        <?php
        // }
        ?>

      </ul>
  </div>
</div>



<script type="text/javascript">
  $(document).ready(function() {
    $(document).trigger('app.perm');
    $.each($('.sidebar-wrapper .menu-title'), function(index, value) {
      var title = $(this).closest('a').data('title-' + lang);

      if ($(this).closest('.collapse').length) {
        var collapse = $(this).closest('.collapse').attr('id');
        var parent = $('a[href="#' + collapse + '"]').data('title-' + lang);
        if (typeof parent !== 'undefined') {
          $(this).closest('.nav-item').data('module', parent + ' > ' + title);
        } else {
          $(this).closest('.nav-item').data('module', title);
        }
      } else {
        $(this).closest('.nav-item').data('module', title);
      }

      $(this).text(title);
    });

    $('.nav-link[data-active="<?php print $active; ?>"]').closest('.nav-item').addClass('active').closest('.collapse').addClass('show').closest('.nav-item').addClass('active');

    Holder.addTheme('info', {
      bg: '#4fc3f7',
      fg: '#ffffff'
    });

  });

  var userFn = {
    ajaxSuccess: function(res, textStatus, jqXHR, form) {
      $.notifyClose();
      var action = $(form).attr('id');

      if (action == 'edit-profile') {
        $(form).closest('.modal').modal('hide');
        userFn.success(res, textStatus, jqXHR);

        if (res.success.data[0].name) {
          $('.sidebar > .sidebar-wrapper > .user > .user-info .fullname').text(res.success.data[0].name);
        }

        if (res.success.data[0].photo) {
          $('.sidebar > .sidebar-wrapper > .user > .photo > img').attr('src', res.success.data[0].photo + '?hash=' + Math.random().toString(24));
        }
      }
    },
    ajaxError: function(jqXHR, textStatus, errorThrown) {
      userFn.error(jqXHR, textStatus, errorThrown);
    },
    error: function(jqXHR, textStatus, errorThrown) {
      res = jqXHR.responseJSON;
      $.notifyClose();
      $.notify({
        icon: 'notification_important',
        message: res.error.message
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