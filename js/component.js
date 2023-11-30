$(document).ready(function () {
  $(document).on('app.perm', function () {
    var app_menu = $('.nav-item[data-id]');
    var app_perm = get_cookie('app_perm');
    var app_module = [];
    var app_method = [];
    var user_perm = [];
    
    try {
      app_perm = JSON.parse(app_perm);

      $.each(app_menu, function (index, value) {
        app_module.push($(value).data('id'));
      });

      $.each($('[data-method]'), function (index, value) {
        app_method.push($(value).data('method'));
      });

      $.each(app_perm, function (key, value) {
        user_perm.push(key);
      });

      var disabled_module = app_module.filter(x => !user_perm.includes(x));

      $.each(disabled_module, function (index, value) {
        $('.nav > .nav-item[data-id="' + value + '"]').remove();
      });

      var disabled_method = app_method.filter(x => !app_perm[$('.content').data('module')].includes(x));

      $.each(disabled_method, function (index, value) {
        $('[data-method="' + value + '"]').remove();
      });

      var collapse = $('.collapse');

      $.each(collapse, function (index, value) {
        var id = $(this).attr('id');
        var has_submenu = $(this).find('ul.nav > li.nav-item').length;

        if (has_submenu == 0) {
          $('.nav-link[data-toggle="collapse"][href="#' + id + '"]').closest('li.nav-item').remove();
        }
      });

      if ($('.col-action').length) {
        var isEmpty = false;

        $.each($('.col-action'), function (index, value) {
          if ($(this).is(':empty')) {
            isEmpty = true;
          }
          else {
            isEmpty = false;
            return false;
          }
        });

        if (isEmpty === true) {
          $('.col-action').remove();
        }
      }

      $('.sidebar-wrapper > ul.nav, [data-method]').show();
    } catch (e) {
      $('.sidebar-wrapper > ul.nav, [data-method]').show();
    }
  });
});