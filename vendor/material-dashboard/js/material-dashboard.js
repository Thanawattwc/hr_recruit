(function () {
  var isWindows = navigator.platform.indexOf('Win') > -1 ? true : false;
  var isMobile = window.orientation > -1 ? true : false;

  if (isWindows) {
    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();
    $('html').addClass('perfect-scrollbar-on');
  } else {
    $('html').addClass('perfect-scrollbar-off');
  }
})();

var lang = $('html').attr('lang');
var locale = moment.locale(lang);
var breakCards = true;
var searchVisible = 0;
var transparent = true;
var transparentDemo = true;
var fixedTop = false;
var mobile_menu_visible = 0;
var mobile_menu_initialized = false;
var toggle_initialized = false;
var bootstrap_nav_initialized = false;
var seq = 0;
var delays = 80;
var durations = 500;
var seq2 = 0;
var delays2 = 80;
var durations2 = 500;

var xhr;
var _orgAjax = $.ajaxSettings.xhr;

$.ajaxSettings.xhr = function () {
  xhr = _orgAjax();
  return xhr;
};

$(document).ready(function () {
  window_width = $(window).width();
  $('body').bootstrapMaterialDesign();
  $sidebar = $('.sidebar');
  $('[rel="tooltip"]').tooltip();
  $('.form-control').on('focus', function () {
    $(this).parent('.input-group').addClass('input-group-focus');
  }).on('blur', function () {
    $(this).parent('.input-group').removeClass('input-group-focus');
  });

  if ($('[data-fancybox]').length) {
    $('[data-fancybox]').fancybox({
      protect: true
    });
  }
  $('input[type="checkbox"][required="true"], input[type="radio"][required="true"]').on('click', function () {
    if ($(this).hasClass('error')) {
      $(this).closest('div').removeClass('has-error');
    }
  });

  md.initSidebarsCheck();
  md.initMinimizeSidebar();
  md.checkSidebarImage();
  md.initDatetimepickers();
  md.initFileInput();
  md.initSelectBox();
  md.initTagsInput();
  md.initCurrencyInput();
  md.initNumberInput();
  md.initDataTable();
  md.initFormModal();
  md.initFormValidate();
  md.initPagination();
  md.initDataExport();

  if ($('textarea.auto-size').length) {
    $('textarea.auto-size').autosize();
  }

  if ($('.table-container').length) {
    var column = $('.table-container table > thead > tr').find('th').length;

    $('.table-container table > tfoot > tr').find('td:first-child').attr('colspan', column);
  }
});

$(document).on('click', '.navbar-toggler', function () {
  $toggle = $(this);
  if (mobile_menu_visible == 1) {
    $('html').removeClass('nav-open');
    $('.close-layer').remove();
    setTimeout(function () {
      $toggle.removeClass('toggled');
    }, 400);
    mobile_menu_visible = 0;
  } else {
    setTimeout(function () {
      $toggle.addClass('toggled');
    }, 430);
    var $layer = $('<div class="close-layer"></div>');
    if ($('body').find('.main-panel').length != 0) {
      $layer.appendTo('.main-panel');
    } else if (($('body').hasClass('off-canvas-sidebar'))) {
      $layer.appendTo('.wrapper-full-page');
    }
    setTimeout(function () {
      $layer.addClass('visible');
    }, 100);
    $layer.click(function () {
      $('html').removeClass('nav-open');
      mobile_menu_visible = 0;
      $layer.removeClass('visible');
      setTimeout(function () {
        $layer.remove();
        $toggle.removeClass('toggled');
      }, 400);
    });
    $('html').addClass('nav-open');
    mobile_menu_visible = 1;
  }
});

$(window).resize(function () {
  md.initSidebarsCheck();
  seq = seq2 = 0;
  setTimeout(function () {
    md.initDashboardPageCharts();
  }, 500);
});

var md = {
  misc: {
    navbar_menu_visible: 0,
    active_collapse: true,
    disabled_collapse_init: 0,
  },
  checkSidebarImage: function () {
    $sidebar = $('.sidebar');
    image_src = $sidebar.data('image');
    if (image_src !== undefined) {
      sidebar_container = '<div class="sidebar-background" style="background-image: url(' + image_src + ') "/>';
      $sidebar.append(sidebar_container);
    }
  },
  initDataExport: function () {
    if ($('[data-export]').length) {
      var LOADING_HTML = '<div class="loading-ovarlay"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></di></div>';

      if ($('body > .loading-ovarlay').length < 1) {
        $('body').append(LOADING_HTML);
      }

      $(document).on('click', '[data-export]', function (e) {
        var ele = $(this);

        $('body > .loading-ovarlay').fadeIn(250, function () {
          var type = ele.data('export-type');
          var target = ele.data('export');

          if ($('.table-search input.search').val() != '') {
            var url = $('.table-search input.search').closest('.table-container').data('search-url');
            var keyword = $('.table-search input.search');
            var term = keyword.val();
            var data = appFn.getRecord(url, {
              keyword: term
            });
          }
          else {
            var url = ele.data('export-url');
            var data = appFn.getRecord(url, {});
          }

          var table = $(target).clone();
          var filename = $('.content .card-header > .card-category > p:first-child').text();
          var record_data = [];
          var i = 1;

          $.each(data, function (key, value) {
            var HTML_DATA = appFn.insertRecord(value, null, true);
            HTML_DATA.find('.col-record').text(i);

            if (HTML_DATA.find('td.tcode').length) {
              var tcode = HTML_DATA.find('td.tcode > span').data('original-title');
              HTML_DATA.find('td.tcode').text(tcode);
            }

            if (HTML_DATA.find('td[data-photo-preview]').length) {
              var src = HTML_DATA.find('td[data-photo-preview] img').attr('src');
              HTML_DATA.find('td[data-photo-preview]').text(src);
            }

            record_data.push(HTML_DATA);
            i++;
          });

          table.find('tbody').html(record_data);

          $('<div></div>').attr('id', 'table-export').css({
            'position': 'absolute',
            'top': '-90000000px'
          }).html(table).appendTo('body');

          $('#table-export').find('table > tfoot').remove();

          $('#table-export > table').tableHTMLExport({
            type: type,
            filename: filename + '.' + type,
            ignoreColumns: '.col-action, .col-active, .ignore-column',
            ignoreRows: '.ignore-row',
          });

          $(this).fadeOut(250, function () {
            $('#table-export').remove();
          });
        });

        e.preventDefault();
      });
    }
  },
  initPagination: function () {
    if ($('.table-container[data-pagination="true"]').length) {

      var no_data = 'No data.';

      if (lang == 'th') {
        no_data = 'ไม่มีข้อมูล';
      }
      // $.each($('.table-container[data-pagination="true"]'), function (i, value) {
      var dTable = $('.table-container[data-pagination="true"]');
      var dTableHeader = dTable.find('table > thead > tr');
      var dTableRecords = dTable.find('table > tbody > tr');
      var perPages = dTable.data('pagination-perpage');
      var url = dTable.data('pagination-url') || '';
      var totalColumn = dTableHeader.find('th').length;
      var noDataHTML = '<tr class="no-data" style=""><td colspan="' + totalColumn + '" class="text-danger text-center">' + no_data + '</td></tr>';
      var data = appFn.getRecord(url, { count: true });
      var totalRecords = data[0].count;
      var totalPages = Math.ceil(totalRecords / perPages);

      data = appFn.getRecord(url, {
        limit: 0,
        offset: perPages
      });

      var record_data = [];
      var i = 1;

      $.each(data, function (key, value) {
        var HTML_DATA = appFn.insertRecord(value);
        HTML_DATA.find('.col-record').text(i);
        record_data.push(HTML_DATA);
        i++;
      });

      dTableRecords.remove();
      dTable.find('table > tbody').html(record_data);
      dTable.find('table > tfoot .current-page').text(1);

      if (totalRecords == 0) {
        dTable.find('table > tfoot .total-records').text(totalRecords).addClass('text-danger').removeClass('text-info');
      }
      else {
        dTable.find('table > tfoot .total-records').text(totalRecords).addClass('text-info').removeClass('text-danger');
      }

      if (totalPages == 0) {
        dTable.find('table > tfoot .total-pages').text(1);
      }
      else {
        dTable.find('table > tfoot .total-pages').text(totalPages);
      }

      dTableRecords.fadeIn(250);

      dTable.data('page', 1);

      var HTML = '<div class="row table_option">' +
        '<div class="col-12 col-sm-6 col-lg-8 d-flex justify-content-center justify-content-sm-start">' +
        '<div class="text-left">' +
        '<ul class="pagination"></ul>' +
        '</div>' +
        '</div>';

      HTML += '</div>';

      dTable.prepend(HTML);
      var dTableOptions = {
        totalPages: totalPages,
        visiblePages: 5,
        first: false,
        last: false,
        nextClass: 'page-item next',
        prevClass: 'page-item prev',
        lastClass: 'page-item last',
        firstClass: 'page-item first',
        pageClass: 'page-item',
        linkClass: 'page-link',
        prev: '<i class="fa fa-angle-left"></i>',
        next: '<i class="fa fa-angle-right"></i>',
        onPageClick: function (event, page) {
          $('body > .loading-ovarlay').fadeIn(250, function () {
            var currPage = page.page;
            var startRecords = (currPage - 1) * perPages;

            data = appFn.getRecord(url, {
              limit: startRecords,
              offset: perPages
            });

            var record_data = [];
            var i = 1;

            $.each(data, function (key, value) {
              var HTML_DATA = appFn.insertRecord(value);
              HTML_DATA.find('.col-record').text((startRecords + i));
              record_data.push(HTML_DATA);
              i++;
            });

            dTable.find('table > tbody > tr').remove();
            dTable.find('table > tbody').html(record_data);
            dTable.find('table > tfoot .current-page').text(currPage);
            dTable.find('table > tbody > tr').fadeIn(250);
            dTable.data('page', currPage);

            $(this).fadeOut(250);
          });
        }
      }

      var dTablePagination = dTable.find('.pagination');

      if (totalRecords > 0) {
        dTablePagination.twbsPagination(dTableOptions);

        if (totalPages >= 10) {
          dTablePagination.twbsPagination('destroy');
          dTablePagination.twbsPagination($.extend({}, dTableOptions, {
            first: '<i class="fa fa-angle-double-left"></i>',
            last: '<i class="fa fa-angle-double-right"></i>'
          }));
        }
      }
      else {
        dTable.find('table > tbody').html(noDataHTML);
      }

      $(document).on('dTable.refresh', '.table-container', function () {
        if ((dTable.data('search')) && (dTable.find('.table-search input.search').val() != '')) {
          if (dTable.find('table > tbody > tr.current').length > 0) {
            dTable.find('table > tbody > tr').not('.current').remove();
            dTable.find('table > tbody > tr').removeClass('d-none current');
          }

          dTable.find('.table-search input.search').val('').trigger('change');
          dTable.find('.table-search input.search').closest('.form-group').find('.form-control-feedback').html('<i type="submit" class="material-icons">search</i>');
          dTable.find('table > tfoot .search-display').addClass('d-none');
          dTable.find('table > tfoot .pages-display').removeClass('d-none');
          dTable.find('.pagination').show();
        }

        let content = dTable.find('table > tbody > tr:last-child').clone();
        let data = appFn.getRecord(url, { count: true });
        let totalRecords = data[0].count;
        let perPages = dTable.data('pagination-perpage');
        let currPage = dTable.data('page');
        let totalPages = Math.ceil(totalRecords / perPages);
        let page = (currPage > totalPages) ? totalPages : currPage;

        if (totalRecords > 0) {
          dTablePagination.twbsPagination('destroy');

          if (totalPages >= 10) {
            dTablePagination.twbsPagination($.extend({}, dTableOptions, {
              startPage: page,
              totalPages: totalPages,
              first: '<i class="fa fa-angle-double-left"></i>',
              last: '<i class="fa fa-angle-double-right"></i>'
            }));
          }
          else {
            dTablePagination.twbsPagination($.extend({}, dTableOptions, {
              startPage: page,
              totalPages: totalPages,
              first: false,
              last: false
            }));
          }

          let startRecords = (page - 1) * perPages;
          let data = appFn.getRecord(url, {
            limit: startRecords,
            offset: perPages
          });

          var record_data = [];
          var i = 1;

          $.each(data, function (key, value) {
            var HTML_DATA = appFn.insertRecord(value);
            HTML_DATA.find('.col-record').text((startRecords + i));
            record_data.push(HTML_DATA);
            i++;
          });

          dTable.find('table > tbody > tr').remove();
          dTable.find('table > tbody').html(record_data);
          dTable.find('table > tbody > tr').fadeIn(250);

          dTable.find('table > tfoot .total-records').removeClass('text-danger');
          dTable.find('table > tfoot .total-records').addClass('text-info');
        }
        else {
          dTable.find('table > tbody').html(noDataHTML);
          dTablePagination.twbsPagination('destroy');
          dTable.find('table > tfoot .total-records').addClass('text-danger');
          dTable.find('table > tfoot .total-records').removeClass('text-info');
        }

        dTable.data('page', page);
        dTable.find('table > tfoot .current-page').text(page);
        dTable.find('table > tfoot .total-pages').text(totalPages);
        dTable.find('table > tfoot .total-records').text(totalRecords);
      });

      if (dTable.data('search')) {
        var search_placeholder = 'Search...';

        if (lang == 'th') {
          search_placeholder = 'ค้นหา...';
        }

        var LOADING_HTML = '<div class="loading-ovarlay"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></di></div>';

        if ($('body > .loading-ovarlay').length < 1) {
          $('body').append(LOADING_HTML);
        }

        var HTML = '<div class="col-12 col-sm-6 col-lg-4 d-flex justify-content-center justify-content-sm-end">' +
          '<div class="table-search">' +
          '<div class="form-group bmd-form-group has-feedback bmd-form-group-sm">' +
          '<label class="bmd-label-floating">' + search_placeholder + '</label>' +
          '<input type="search" class="form-control form-control-sm search" placeholder="">' +
          '<span class="form-control-feedback">' +
          '<i type="submit" class="material-icons">search</i>' +
          '</span>' +
          '</div>' +
          '</div>' +
          '</div>';

        dTable.find('.table_option').append(HTML);

        dTable.find('.table-search input.search').closest('.form-group').find('.form-control-feedback').css('pointer-events', 'auto');

        $(document).on('click', '.form-control-feedback > i[type="submit"]', function (e) {
          if (dTable.find('.table-search input.search').val() == '') {
            dTable.find('.table-search input.search').focus();
          }
          else {
            var event = $.Event('keypress', { key: 'Enter' });
            dTable.find('.table-search input.search').trigger(event);
            dTable.find('.table-search input.search').closest('.form-group').find('.form-control-feedback').html('<i type="reset" class="material-icons">clear</i>').css('pointer-events', 'auto');
          }
        });

        $(document).on('click', '.form-control-feedback > i[type="reset"]', function (e) {
          $('body > .loading-ovarlay').fadeIn(250, function () {
            dTable.find('.table-search input.search').val('').trigger('change');
            dTable.find('.table-search input.search').closest('.form-group').find('.form-control-feedback').html('<i type="submit" class="material-icons">search</i>');

            if (dTable.find('table > tbody > tr.current').length > 0) {
              dTable.find('table > tbody > tr').not('.current').remove();
              dTable.find('table > tbody > tr').removeClass('d-none current');
            }

            dTable.find('table > tfoot .search-display').addClass('d-none');
            dTable.find('table > tfoot .pages-display').removeClass('d-none');
            dTable.find('.pagination').show();

            $(this).fadeOut(250);
          });
        });

        $(document).on('keyup', '.table-search input.search', function (e) {
          if ($(this).val() == '') {
            $('.form-control-feedback > i[type="reset"]').trigger('click');
          }
        });

        $(document).on('keypress', '.table-search input.search', function (e) {
          var url = dTable.data('search-url');
          var keyword = $(this);
          var term = keyword.val();

          if (e.key == 'Enter') {
            if (term != '') {
              $('body > .loading-ovarlay').fadeIn(250, function () {
                dTable.find('.table-search input.search').closest('.form-group').find('.form-control-feedback').html('<i type="reset" class="material-icons">clear</i>').css('pointer-events', 'auto');
                var search_data = appFn.getRecord(url, {
                  keyword: term
                });

                if (dTable.find('table > tbody > tr.current').length > 0) {
                  dTable.find('table > tbody > tr').not('.current').remove();
                }

                dTable.find('table > tbody > tr').addClass('d-none current');

                if (search_data.length > 0) {
                  var record_data = [];
                  var i = 1;

                  $.each(search_data, function (key, value) {
                    var HTML_DATA = appFn.insertRecord(value);
                    HTML_DATA.removeClass('d-none current');
                    HTML_DATA.find('.col-record').text(i);
                    record_data.push(HTML_DATA);
                    i++;
                  });

                  dTable.find('table > tbody').append(record_data);
                  dTable.find('table > tfoot .search-results').text(record_data.length).removeClass('text-danger').addClass('text-success');
                  dTable.find('table > tfoot .search-keyword').text(term);
                  dTable.find('table > tfoot .search-display').removeClass('d-none');
                  dTable.find('table > tfoot .pages-display').addClass('d-none');
                }
                else {
                  dTable.find('table > tbody').append(noDataHTML);
                  dTable.find('table > tfoot .search-results').text(0).removeClass('text-success').addClass('text-danger');
                  dTable.find('table > tfoot .search-keyword').text(term);
                  dTable.find('table > tfoot .search-display').removeClass('d-none');
                  dTable.find('table > tfoot .pages-display').addClass('d-none');
                }

                $('body > .loading-ovarlay').fadeOut(250);
              });
            }
            else {
              dTable.find('.table-search input.search').closest('.form-group').find('.form-control-feedback').html('<i type="submit" class="material-icons">search</i>').css('pointer-events', 'auto');
            }

            dTable.find('.pagination').hide();
          }
        });
      }
    }
  },
  initSelectBox: function () {
    if ($('.selectpicker').length) {
      var search_placeholder = 'Search...';

      if (lang == 'th') {
        search_placeholder = 'ค้นหา...';
      }
      $('.selectpicker').selectpicker({
        title: ' ',
        liveSearchPlaceholder: search_placeholder
      });
    }
    $(document).on('show.bs.select', function (e) {
      var value = $(e.target).selectpicker('val');
      var obj = $(e.target).closest('.form-select');
      var is_multiple = $(e.target).attr('multiple');

      if (typeof is_multiple !== 'undefined') {
        value = (value.length > 0) ? true : false;
      }
      else {
        value = (value) ? true : false;
      }

      obj.find('.bmd-label-floating').css({
        'top': '-.85rem',
        'left': '0',
        'font-size': '.6875rem',
        'color': '#2196f3'
      });
    });
    $(document).on('hide.bs.select', function (e, clickedIndex, isSelected, previousValue) {
      var value = $(e.target).selectpicker('val');
      var obj = $(e.target).closest('.form-select');
      var is_multiple = $(e.target).attr('multiple');

      if (typeof is_multiple !== 'undefined') {
        value = (value.length > 0) ? true : false;
      }
      else {
        value = (value) ? true : false;
      }

      if (value == true) {
        obj.find('.bmd-label-floating').css({
          'color': '#333'
        });
      }
      else {
        obj.find('.bmd-label-floating').css({
          'top': '.6125rem',
          'left': '0',
          'color': '#333',
          'font-size': '.875rem'
        });
      }
    });
    $(document).on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
      var value = $(e.target).selectpicker('val');
      var obj = $(e.target).closest('.form-select');
      var is_multiple = $(e.target).attr('multiple');

      if (typeof is_multiple !== 'undefined') {
        value = (value.length > 0) ? true : false;
      }
      else {
        value = (value) ? true : false;
      }

      if (value == true) {
        obj.find('.bmd-label-floating').css({
          'top': '-.85rem',
          'left': '0',
          'font-size': '.6875rem'
        });

        obj.find('.filter-option-inner-inner').show();

        if (obj.hasClass('has-danger')) {
          obj.removeClass('has-danger');
        }
      } else {
        obj.find('.bmd-label-floating').css({
          'top': '.6125rem',
          'left': '0',
          'color': '#333',
          'font-size': '.875rem'
        });

        obj.find('.filter-option-inner-inner').hide();
      }
    });
  },
  initDatetimepickers: function () {
    if ($('.datetimepicker').length) {
      $('.datetimepicker').each(function () {
        var lang = $(this).data('datetimepicker-lang') || 'en';
        var yearOffset = 0;
        var format = $(this).data('datetimepicker-format') || 'Y-m-d H:i';
        var minDate = $(this).data('datetimepicker-min-date') || false;
        var maxDate = $(this).data('datetimepicker-max-date') || false;

        $.datetimepicker.setLocale(lang);

        if (lang == 'th') {
          yearOffset = 543;
        }

        $(this).attr('type', 'text').datetimepicker({
          format: format,
          formatTime: 'H:i',
          step: 5,
          yearStart: 1800,
          yearEnd: 2800,
          roundTime: 'ceil',
          lang: lang,
          yearOffset: yearOffset,
          datepicker: true,
          timepicker: true,
          defaultSelect: false,
          minDate: minDate,
          maxDate: maxDate,
          onSelectDate: function (ct, element) {
            $(element).trigger('changed.datepicker');

            if ($(element).data('datetimepicker-max-date')) {
              var relateTarget = $(element).data('datetimepicker-max-date');

              if ($(relateTarget).val() == '') {
                $(relateTarget).val($(element).val()).trigger('change');
              }
            }

            if ($(element).data('datetimepicker-min-date')) {
              var relateTarget = $(element).data('datetimepicker-min-date');

              if ($(relateTarget).val() == '') {
                $(relateTarget).val($(element).val()).trigger('change');
              }
            }
          },
          onSelectTime: function (ct, element) {
            $(element).trigger('changed.timepicker');

            if ($(element).data('datetimepicker-max-date')) {
              var relateTarget = $(element).data('datetimepicker-max-date');

              if ($(relateTarget).val() == '') {
                $(relateTarget).val($(element).val()).trigger('change');
              }
            }

            if ($(element).data('datetimepicker-min-date')) {
              var relateTarget = $(element).data('datetimepicker-min-date');

              if ($(relateTarget).val() == '') {
                $(relateTarget).val($(element).val()).trigger('change');
              }
            }

            if ($(element).data('datetimepicker-max-time')) {
              var relateTarget = $(element).data('datetimepicker-max-time');

              if ($(relateTarget).val() == '') {
                $(relateTarget).val($(element).val()).trigger('change');
              }
            }

            if ($(element).data('datetimepicker-min-time')) {
              var relateTarget = $(element).data('datetimepicker-min-time');

              if ($(relateTarget).val() == '') {
                $(relateTarget).val($(element).val()).trigger('change');
              }
            }
          },
          onShow: function (ct, element) {
            if ($(element).data('datetimepicker-min-date')) {
              var relateTarget = $(element).data('datetimepicker-min-date');

              this.setOptions({
                minDate: $(relateTarget).val() ? $(relateTarget).val() : false,
                formatDate: format
              });
            }

            if ($(element).data('datetimepicker-max-date')) {
              var relateTarget = $(element).data('datetimepicker-max-date');

              this.setOptions({
                maxDate: $(relateTarget).val() ? $(relateTarget).val() : false,
                formatDate: format
              });
            }

            if ($(element).data('datetimepicker-min-time')) {
              var relateTarget = $(element).data('datetimepicker-min-time');

              this.setOptions({
                minTime: $(relateTarget).val() ? $(relateTarget).val() : false,
                formatTime: format
              });
            }

            if ($(element).data('datetimepicker-max-time')) {
              var relateTarget = $(element).data('datetimepicker-max-time');

              this.setOptions({
                maxTime: $(relateTarget).val() ? $(relateTarget).val() : false,
                formatTime: format
              });
            }

            if ($(element).data('datetimepicker-time-step')) {
              var step = $(element).data('datetimepicker-time-step');

              this.setOptions({
                step: step
              });
            }

            if ($(element).data('datetimepicker-mask')) {
              var mask = $(element).data('datetimepicker-mask');

              this.setOptions({
                mask: mask
              });
            }

            if ($(element).data('datetimepicker-allow-time')) {
              var allowTime = $(element).data('datetimepicker-allow-time');
              allowTime = allowTime.replace(' ', '').split(',');

              this.setOptions({
                allowTimes: allowTime
              });
            }
          }
        });

        if ((format.toLowerCase().indexOf('y') == -1) && (format.toLowerCase().indexOf('m') == -1) && (format.toLowerCase().indexOf('d') == -1) && (format.toLowerCase().indexOf('F') == -1) && (format.toLowerCase().indexOf('n') == -1) && (format.toLowerCase().indexOf('l') == -1) && (format.toLowerCase().indexOf('j') == -1)) {
          $(this).datetimepicker('setOptions', {
            datepicker: false
          });
        }

        if ((format.toLowerCase().indexOf('h') == -1) && (format.toLowerCase().indexOf('g') == -1) && (format.toLowerCase().indexOf('a') == -1) && (format.toLowerCase().indexOf('i') == -1) && (format.toLowerCase().indexOf('s') == -1)) {
          $(this).datetimepicker('setOptions', {
            timepicker: false
          });
        }
      });
    }
  },
  initFileInput: function () {
    $(document).on('keypress', '.form-file-upload .input-group .inputFileVisible', function (e) {
      e.preventDefault();
      return false;
    });
    $(document).on('click', '.form-file-upload .input-group .inputFileVisible, .form-file-upload .input-group .input-group-btn button', function (e) {
      $(this).closest('.form-file-upload').find('.inputFileHidden').trigger('click');
      $(this).closest('.form-file-upload').find('.inputFileVisible').blur();
    });
    $(document).on('change', '.form-file-upload .inputFileHidden', function () {
      var totalFile = $(this).get(0).files.length;
      var filename = '';
      if (totalFile > 0) {
        for (var i = 0; i < totalFile; i++) {
          if (i < (totalFile - 1)) {
            filename += $(this).get(0).files.item(i).name + ', ';
          } else {
            filename += $(this).get(0).files.item(i).name;
          }
        }
      }
      $(this).closest('.form-file-upload').find('.inputFileVisible').val(filename).trigger('change');
      if (filename) {
        $(this).closest('.form-file-upload').find('.inputFileVisible').focus();
      } else {
        $(this).closest('.form-file-upload').find('.inputFileVisible').blur();
      }
    });
  },
  initTagsInput: function () {
    if ($('.tagsinput').length && $('.tagsinput').tagsinput()) {
      if ($('.tagsinput').data('color')) {
        color = $('.tagsinput').data('color');
        $('.bootstrap-tagsinput').addClass(color + '-badge');
      }
      else {
        $('.bootstrap-tagsinput').addClass('primary-badge');
      }
      $('.bootstrap-tagsinput > input').on('focus', function (e) {
        $(this).closest('.bmd-form-group').addClass('is-focused');
      });
      $('.bootstrap-tagsinput > input').on('focusout', function (e) {
        var ele = $(this).closest('.bmd-form-group');
        var value = ele.find('.tagsinput').val();
        if (value != '') {
          ele.addClass('is-filled').removeClass('is-focused');
        }
        else {
          ele.removeClass('is-filled').removeClass('is-focused');
        }
      });
    }
  },
  initCurrencyInput: function () {
    if ($('input[type="currency"]').length) {
      $('input[type="currency"]').attr('type', 'text').inputmask('numeric', {
        radixPoint: '.',
        groupSeparator: ',',
        digits: 2,
        autoGroup: true,
        digitsOptional: false,
        placeholder: '0',
        rightAlign: false,
        autoUnmask: true,
        showMaskOnHover: false,
        showMaskOnFocus: true,
        oncleared: function () {
          $(this).val('');
        }
      });
    }
  },
  initNumberInput: function () {
    if ($('input[type="number"]').length) {
      $('input[type="number"]').each(function () {
        var placeholder = $(this).data('placeholder') || '';
        $(this).attr('type', 'text').inputmask('numeric', {
          radixPoint: ($(this).data('decimal')) ? '.' : '',
          groupSeparator: ',',
          digits: $(this).data('decimal') || 0,
          autoGroup: true,
          digitsOptional: false,
          placeholder: placeholder,
          rightAlign: false,
          autoUnmask: true,
          showMaskOnHover: false,
          showMaskOnFocus: true,
          oncleared: function () {
            $(this).val('');
          }
        });
      });
    }
  },
  initDataTable: function () {
    if ($('table[data-plugin="dataTables"]').length) {
      $('table[data-plugin="dataTables"]').DataTable({
        'dom': '<"top"<"row d-flex align-items-center"<"col-4 table-button d-flex justify-content-start"><"col-4 d-flex justify-content-center"p><"col-4 d-flex justify-content-end"f>>>rt<"bottom"<"row d-flex align-items-center"<"col-6 d-flex justify-content-start"B><"col-6 d-flex justify-content-end"i>>>',
        'buttons': [
          {
            extend: 'excelHtml5',
            exportOptions: {
              columns: ':not(.col-action)'
            }
          },
          {
            extend: 'pdfHtml5',
            exportOptions: {
              columns: ':not(.col-action)'
            }
          },
        ],
        'pageLength': 15,
        'responsive': true,
        'initComplete': function () {
          var api = this.api();
          var container = api.table().container();

          if (this.data('length')) {
            api.page.len(this.data('page-length')).draw();
          }

          if (this.data('button')) {
            var btnTitle = this.data('button');
            var btnAction = this.data('button-action');
            var btn = '<a class="btn btn-primary" href="' + btnAction + '" title="' + btnTitle + '"><i class="fas fa-plus-circle"></i> ' + btnTitle + '</a>';
            $(container).find('.table-button').append(btn);
          }
        }
      });
    }
  },
  initFormModal: function () {
    $(document).on('show.bs.modal', function (e) {
      if ($(e.target).find('form').length) {
        var target = $(e.target);

        target.find('form').find(':submit').prop('disabled', true);

        target.on('paste', 'textarea, :text, :password', function (e) {
          target.find('form').find(':submit').prop('disabled', false);
        });

        target.on('keydown', 'textarea, :text, :password, [type="email"], [type="number"], [type="currency"]', function (e) {
          target.find('form').find(':submit').prop('disabled', false);
        });

        target.on('change', 'select, :radio, :checkbox, :file', function (e) {
          target.find('form').find(':submit').prop('disabled', false);
        });

        target.on('changed.datepicker', '.datetimepicker', function (e) {
          target.find('form').find(':submit').prop('disabled', false);
        });

        target.on('changed.timepicker', '.datetimepicker', function (e) {
          target.find('form').find(':submit').prop('disabled', false);
        });

        target.on('changed.bs.select', '.selectpicker', function (e, clickedIndex, isSelected, previousValue) {
          target.find('form').find(':submit').prop('disabled', false);
        });
      }
    });

    $(document).on('shown.bs.modal', function (e) {
      if ($(e.target).find('form').length) {
        var target = $(e.target);

        target.find('form').find('textarea, input:text, input:password').first().focus();
      }
    });

    $(document).on('hide.bs.modal', function (e) {
      if ($(e.target).find('form').length) {
        var target = $(e.target);
        target.find('form')[0].reset();
        target.find('.form-group').removeClass('is-filled is-focused');
        if (target.find('.datetimepicker').length) {
          target.find('.datetimepicker').datetimepicker('reset');
        }
        if (target.find(':checkbox').length) {
          target.find(':checkbox').prop('checked', false);
        }
        if (target.find('form').find('select').length) {
          target.find('form').find('select').val('').trigger('change').closest('.form-select').find('.bmd-label-floating').css({
            'top': '.6125rem',
            'left': '0',
            'color': '#333',
            'font-size': '.875rem'
          });
        }
        if (target.find('form').find('select.with-ajax').length) {
          target.find('form').find('select.with-ajax').html('');
        }
        target.find('form').find(':submit').prop('disabled', true);
      }

      if ($(e.target).find('.progress-loading').length) {
        $(e.target).find('.progress-loading').fadeOut(250, function () {
          $(this).remove();
        });
      }
    });
  },
  initFormValidate: function () {
    if ($('form[data-plugin="validate"]').length) {
      $('form[data-plugin="validate"]').each(function () {
        $.validator.messages.required = '';

        var validObj = $(this).validate({
          ignore: '.ignore-error',
          errorPlacement: function (error, element) {
            var error = error.addClass('text-danger');

            if ($(element).closest('.form-group').hasClass('input-group')) {
              var width = $(element).next().width();
              error.css({
                'right': width + 'px',
              });
            }

            $(element).closest('.form-group').append(error);
          },
          highlight: function (element, errorClass, validClass) {
            var type = $(element).attr('type');
            if ((type == 'radio') || (type == 'checkbox')) {
              var elementsName = $(element).attr('name');
              var elements = $('input[name="' + elementsName + '"]');
              $.each(elements, function (index, obj) {
                $(obj).closest('.form-check').addClass('has-danger');
              });
            }
            else {
              $(element).closest('.form-group').addClass('has-danger');
            }
            var tab_content = $(element).closest('.tab-content');
            if ($(tab_content).find(".tab-pane.active:has(div.has-danger)").length == 0) {
              $(tab_content).find(".tab-pane:has(div.has-danger)").each(function (index, value) {
                var id = $(value).attr("id");
                $('a[href="#' + id + '"]').tab('show');
                return false;
              });
            }
          },
          unhighlight: function (element, errorClass, validClass) {
            var type = $(element).attr('type');
            if ((type == 'radio') || (type == 'checkbox')) {
              var elementsName = $(element).attr('name');
              var elements = $('input[name="' + elementsName + '"]');
              $.each(elements, function (index, obj) {
                $(obj).closest('.form-check').removeClass('has-danger');
              });
            }
            else {
              $(element).closest('.form-group').removeClass('has-danger');
            }
          },
          submitHandler: function (form) {
            $(form).find(':submit').prop('disabled', true);
            $(form).find('.btn[data-dismiss="modal"]').prop('disabled', true);

            $(form).ajaxSubmit({
              beforeSubmit: function () {
                var processing = 'Processing...';

                if (lang == 'th') {
                  processing = 'กำลังดำเนินการ...';
                }

                var progressHTML = '<div class="progress-loading">' +
                  '<div class="progress bg-transparent">' +
                  '<div class="progress-bar progress-bar-striped bg-info progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">' +
                  '<span class="progress-status">' + processing + '</span>' +
                  '</div>' +
                  '</div>' +
                  '</div>';
                $(progressHTML).appendTo('.modal-container .modal.show .modal-content');
              },
              xhr: function () {
                var xhr = $.ajaxSettings.xhr();

                xhr.upload.addEventListener('progress', function (evt) {
                  if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = Math.round(percentComplete * 100);

                    $('.progress-bar').css({
                      width: percentComplete + '%'
                    });
                  }
                }, false);

                xhr.addEventListener('progress', function (evt) {
                  if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = Math.round(percentComplete * 100);

                    $('.progress-bar').css({
                      width: percentComplete + '%'
                    });
                  }
                }, false);

                var requestURL = this.url;

                xhr.onreadystatechange = function () {
                  if (xhr.readyState > 1) {
                    if (xhr.responseURL != requestURL) {
                      location.reload(true);
                    }
                  }
                };

                return xhr;
              },
              success: function (data, textStatus, jqXHR) {
                if ($(form).attr('id') == 'edit-profile') {
                  userFn.ajaxSuccess(data, textStatus, jqXHR, form);
                }
                else {
                  fn.ajaxSuccess(data, textStatus, jqXHR, form);
                }

                $(form).find('.btn[data-dismiss="modal"]').prop('disabled', false);
                $('.progress-loading').fadeOut(250, function () {
                  $(this).remove();
                });
              },
              error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 500) {
                  var err_msg = 'Sorry, System is inconvience.<br>Please, Contact system administrator.';
                  if (jqXHR.responseJSON.error.message) {
                    err_msg = jqXHR.responseJSON.error.message;
                  }

                  $.notifyClose();
                  $.notify({
                    icon: 'notification_important',
                    message: err_msg
                  },
                    {
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
                }
                else {
                  if ($(form).attr('id') == 'edit-profile') {
                    userFn.ajaxError(jqXHR, textStatus, errorThrown, form);
                  }
                  else {
                    fn.ajaxError(jqXHR, textStatus, errorThrown, form);
                  }
                }

                $(form).find(':submit').prop('disabled', false);
                $(form).find('.btn[data-dismiss="modal"]').prop('disabled', false);
                $('.progress-loading').fadeOut(250, function () {
                  $(this).remove();
                });
              }
            });

            return false;
          }
        });
        $(document).on('hide.bs.modal', function (e) {
          validObj.resetForm();
        });
        $(document).on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
          if (!$.isEmptyObject(validObj.submitted)) {
            validObj.form();
          }
        });
        $(document).on('focusout', '.bootstrap-tagsinput > input', function (e) {
          if (!$.isEmptyObject(validObj.submitted)) {
            validObj.form();
          }
        });
        $(document).on('itemAdded, itemRemoved', '.tagsinput', function (e) {
          if (!$.isEmptyObject(validObj.submitted)) {
            validObj.form();
          }
        });
        $(document).on('change', 'input:file', function (e) {
          if (!$.isEmptyObject(validObj.submitted)) {
            validObj.form();
          }
        });
        $(document).on('show.bs.select', '.selectpicker.with-ajax', function (e) {
          $(e.target).closest('.form-select').find('.bs-searchbox input').val('').trigger('keyup');
        });
      });
    }
  },
  initSliders: function () {
    var slider = document.getElementById('sliderRegular');
    noUiSlider.create(slider, {
      start: 40,
      connect: [true, false],
      range: {
        min: 0,
        max: 100
      }
    });
    var slider2 = document.getElementById('sliderDouble');
    noUiSlider.create(slider2, {
      start: [20, 60],
      connect: true,
      range: {
        min: 0,
        max: 100
      }
    });
  },
  initSidebarsCheck: function () {
    if ($(window).width() <= 991) {
      if ($sidebar.length != 0) {
        md.initRightMenu();
      }
    }
  },
  initDashboardPageCharts: function () {
    if ($('#dailySalesChart').length != 0 || $('#completedTasksChart').length != 0 || $('#websiteViewsChart').length != 0) {
      dataDailySalesChart = {
        labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
        series: [
          [12, 17, 7, 17, 23, 18, 38]
        ]
      };
      optionsDailySalesChart = {
        lineSmooth: Chartist.Interpolation.cardinal({
          tension: 0
        }),
        low: 0,
        high: 50,
        chartPadding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        },
      }
      var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);
      md.startAnimationForLineChart(dailySalesChart);
      dataCompletedTasksChart = {
        labels: ['12p', '3p', '6p', '9p', '12p', '3a', '6a', '9a'],
        series: [
          [230, 750, 450, 300, 280, 240, 200, 190]
        ]
      };
      optionsCompletedTasksChart = {
        lineSmooth: Chartist.Interpolation.cardinal({
          tension: 0
        }),
        low: 0,
        high: 1000,
        chartPadding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        }
      }
      var completedTasksChart = new Chartist.Line('#completedTasksChart', dataCompletedTasksChart, optionsCompletedTasksChart);
      md.startAnimationForLineChart(completedTasksChart);
      var dataWebsiteViewsChart = {
        labels: ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
        series: [
          [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895]
        ]
      };
      var optionsWebsiteViewsChart = {
        axisX: {
          showGrid: false
        },
        low: 0,
        high: 1000,
        chartPadding: {
          top: 0,
          right: 5,
          bottom: 0,
          left: 0
        }
      };
      var responsiveOptions = [
        ['screen and (max-width: 640px)', {
          seriesBarDistance: 5,
          axisX: {
            labelInterpolationFnc: function (value) {
              return value[0];
            }
          }
        }]
      ];
      var websiteViewsChart = Chartist.Bar('#websiteViewsChart', dataWebsiteViewsChart, optionsWebsiteViewsChart, responsiveOptions);
      md.startAnimationForBarChart(websiteViewsChart);
    }
  },
  initMinimizeSidebar: function () {
    $('#minimizeSidebar').click(function () {
      var $btn = $(this);
      if (md.misc.sidebar_mini_active == true) {
        $('body').removeClass('sidebar-mini');
        md.misc.sidebar_mini_active = false;
      } else {
        $('body').addClass('sidebar-mini');
        md.misc.sidebar_mini_active = true;
      }
      var simulateWindowResize = setInterval(function () {
        window.dispatchEvent(new Event('resize'));
      }, 180);
      setTimeout(function () {
        clearInterval(simulateWindowResize);
      }, 1000);
    });
  },
  checkScrollForTransparentNavbar: debounce(function () {
    if ($(document).scrollTop() > 260) {
      if (transparent) {
        transparent = false;
        $('.navbar-color-on-scroll').removeClass('navbar-transparent');
      }
    } else {
      if (!transparent) {
        transparent = true;
        $('.navbar-color-on-scroll').addClass('navbar-transparent');
      }
    }
  }, 17),
  initRightMenu: debounce(function () {
    $sidebar_wrapper = $('.sidebar-wrapper');
    if (!mobile_menu_initialized) {
      $navbar = $('nav').find('.navbar-collapse').children('.navbar-nav');
      if ($navbar.length) {
        mobile_menu_content = '';
        nav_content = $navbar.html();
        nav_content = '<ul class="nav navbar-nav nav-mobile-menu">' + nav_content + '</ul>';
        if ($('nav').find('.navbar-form').length) {
          navbar_form = $('nav').find('.navbar-form').get(0).outerHTML;
        }
        else {
          navbar_form = $('nav').find('.navbar-form').get(0);
        }
        $sidebar_nav = $sidebar_wrapper.find(' > .nav');
        $nav_content = $(nav_content);
        $navbar_form = $(navbar_form);
        $nav_content.insertBefore($sidebar_nav);
        $navbar_form.insertBefore($nav_content);
        $('.sidebar-wrapper .dropdown .dropdown-menu > li > a').click(function (event) {
          event.stopPropagation();
        });
        window.dispatchEvent(new Event('resize'));
        mobile_menu_initialized = true;
      }
    } else {
      if ($(window).width() > 991) {
        $sidebar_wrapper.find('.navbar-form').remove();
        $sidebar_wrapper.find('.nav-mobile-menu').remove();
        mobile_menu_initialized = false;
      }
    }
  }, 200),
  startAnimationForLineChart: function (chart) {
    chart.on('draw', function (data) {
      if (data.type === 'line' || data.type === 'area') {
        data.element.animate({
          d: {
            begin: 600,
            dur: 700,
            from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
            to: data.path.clone().stringify(),
            easing: Chartist.Svg.Easing.easeOutQuint
          }
        });
      } else if (data.type === 'point') {
        seq++;
        data.element.animate({
          opacity: {
            begin: seq * delays,
            dur: durations,
            from: 0,
            to: 1,
            easing: 'ease'
          }
        });
      }
    });
    seq = 0;
  },
  startAnimationForBarChart: function (chart) {
    chart.on('draw', function (data) {
      if (data.type === 'bar') {
        seq2++;
        data.element.animate({
          opacity: {
            begin: seq2 * delays2,
            dur: durations2,
            from: 0,
            to: 1,
            easing: 'ease'
          }
        });
      }
    });
    seq2 = 0;
  }
}

var appFn = {
  ajaxResponse: function (data, ele) {
    console.log(data);
    console.log(ele);
  },
  fillInput: function (data, ele) {
    $.each(data, function (key, value) {
      value = (value !== false) ? value : '';
      if (ele.find('[name="' + key + '"]').hasClass('selectpicker') && !ele.find('[name="' + key + '"]').hasClass('with-ajax')) {
        ele.find('[name="' + key + '"]').selectpicker('val', value);
      }
      else if (ele.find('[name="' + key + '"]').is(':file')) {
        if (value) {
          value = base_url(value) + '?hash=' + Math.random().toString(24);

          var ms_file_ext = ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

          ele.find('[data-preview-file="' + key + '"]').attr('href', value);

          if (ms_file_ext.indexOf(value.split('.').pop().toLowerCase()) !== -1) {
            var file_viewer = 'https://view.officeapps.live.com/op/embed.aspx?src=' + value;

            ele.find('[data-preview-file="' + key + '"]').data('src', file_viewer);
          }

          ele.find('[data-preview-file="' + key + '"]').show();
        }
        else {
          ele.find('[data-preview-file="' + key + '"]').hide();
        }
      }
      else if (ele.find('[name="' + key + '"]').hasClass('datetimepicker')) {
        var format = ele.find('[name="' + key + '"]').data('date-format');

        if (moment.locale() == 'th') {
          value = moment(value).add(543, 'y').format(format);
        }
        else {
          value = moment(value).format(format);
        }

        ele.find('[name="' + key + '"]').val(value).trigger('change');
      }
      else if (ele.find('[name="' + key + '"]').is(':checkbox') || ele.find('[name="' + key + '"]').is(':radio')) {
        ele.find('[name="' + key + '"]').prop('checked', value);
      }
      else {
        if (!ele.find('[name="' + key + '"]').hasClass('selectpicker') && !ele.find('[name="' + key + '"]').hasClass('with-ajax')) {
          ele.find('[name="' + key + '"]').val(value).trigger('change');
        }
      }
    });
  },
  updateRecord: function (data, id) {
    $.each(data, function (key, value) {
      value = (value !== false) ? value : '';
      if ($('[data-id="' + id + '"]').find('[name="' + key + '"]').is(':checkbox') || $('[data-id="' + id + '"]').find('[name="' + key + '"]').is(':radio')) {
        value = (value == '0') ? false : true;
        $('[data-id="' + id + '"]').find('[name="' + key + '"]').prop('checked', value);
      }
      else {
        if ($('[data-id="' + id + '"]').find('.' + key).is('[data-date-format]')) {
          var format = $('[data-id="' + id + '"]').find('.' + key).data('date-format');
          if (moment.locale() == 'th') {
            value = moment(value).add(543, 'y').format(format);
          }
          else {
            value = moment(value).format(format);
          }
        }

        if ($('[data-id="' + id + '"]').find('.' + key).is('[data-photo-preview]')) {
          value = '<a data-fancybox="record" data-preview-file="' + key + '" href="' + base_url(value) + '" class="thumbnail-wrapper">' +
            '<img src="' + base_url(value) + '">' +
            '</a>';
        }

        if ($('[data-id="' + id + '"]').find('.' + key).is('[data-json-convert]')) {
          var json_data = JSON.parse(value);
          var data = '';
          $.each(json_data, function (title, detail) {
            data += title.replace(/_/g, ' ').ucwords() + ' [ ' + detail.join(' | ').ucwords() + ' ]<br>';
          });

          value = data;
        }

        if ($('[data-id="' + id + '"]').find('.' + key).is('[data-json-format]')) {
          var json_data = JSON.parse(value);
          value = '<pre class="text-wrap text-break">' + JSON.stringify(json_data, undefined, 2) + '</pre>';
        }

        $('[data-id="' + id + '"]').find('.' + key).html(value);
      }
    });
  },
  insertRecord: function (data, content, export_data = false) {
    var content = content || $('.table-container table > tbody > tr:last-child').clone();

    content.attr('data-id', data.id).find('.col-record').text(($('.col-record').length + 1));

    $.each(data, function (key, value) {
      value = (value !== false) ? value : '';
      if (content.find('[name="' + key + '"]').is(':checkbox') || content.find('[name="' + key + '"]').is(':radio')) {
        value = (value == '0') ? false : true;
        content.find('[name="' + key + '"]').prop('checked', value);
      }
      else {
        if (content.find('.' + key).is('[data-date-format]')) {
          var format = content.find('.' + key).data('date-format');
          if (moment.locale() == 'th') {
            value = moment(value).add(543, 'y').format(format);
          }
          else {
            value = moment(value).format(format);
          }
        }

        if (content.find('.' + key).is('[data-json-convert]')) {
          try {
            var json_data = JSON.parse(value);
            var data = '';
            $.each(json_data, function (title, detail) {
              data += title.replace(/_/g, ' ').ucwords() + ' [ ' + detail.join(' | ').ucwords() + ' ]<br>';
            });

            value = data;
          } catch (e) {
            content.find('.' + key).closest('tr[data-id]').find('.col-action > .btn').remove();
            value = value;
          }

        }

        if (content.find('.' + key).is('[data-json-format]')) {
          var json_data = JSON.parse(value);
          value = '<pre class="text-wrap text-break">' + JSON.stringify(json_data, undefined, 2) + '</pre>';
        }
        
        if (export_data == false) {
          if (content.find('.' + key).is('[data-photo-preview]')) {
            value = '<a data-fancybox="record" data-preview-file="' + key + '" href="' + base_url(value) + '" class="thumbnail-wrapper">' +
              '<img src="' + base_url(value) + '">' +
              '</a>';
          }
        }

        content.find('td.' + key).html(value);
      }
    });

    if (content.find('[data-method="set_user_role"]').length && data.id == 1) {
      content.find('[name="is_default"]').prop('disabled', true);
    }
    else {
      content.find('[name="is_default"]').prop('disabled', false);
    }

    return content;
  },
  getRecord: function (url, data, beforeSend) {
    var results = [];
    $.ajax({
      type: 'POST',
      url: url,
      data: data,
      async: false,
      beforeSend: beforeSend,
      xhr: function () {
        var xhr = $.ajaxSettings.xhr();

        xhr.upload.addEventListener('progress', function (evt) {
          if (evt.lengthComputable) {
            var percentComplete = evt.loaded / evt.total;
            percentComplete = Math.round(percentComplete * 100);
          }
        }, false);

        xhr.addEventListener('progress', function (evt) {
          if (evt.lengthComputable) {
            var percentComplete = evt.loaded / evt.total;
            percentComplete = Math.round(percentComplete * 100);
          }
        }, false);

        var requestURL = this.url;

        xhr.onreadystatechange = function () {
          if (xhr.readyState > 1) {
            if (xhr.responseURL != requestURL) {
              location.reload(true);
            }
          }
        };

        return xhr;
      },
      success: function (res, textStatus, jqXHR) {
        if (jqXHR.status == 200) {
          results = res.success.data;
        }
      }
    });

    return results;
  }
}

function refreshAnimation(tabs, index) {
  total_steps = tabs.find('li').length;
  move_distance = tabs.width() / total_steps;
  step_width = move_distance;
  move_distance *= index;

  $current = index + 1;

  if ($current == 1) {
    move_distance -= 8;
  } else if ($current == total_steps) {
    move_distance += 8;
  }

  tabs.find('.moving-tab').css('width', step_width);
  $('.moving-tab').css({
    'transform': 'translate3d(' + move_distance + 'px, 0, 0)',
    'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'
  });
}

function debounce(func, wait, immediate) {
  var timeout;
  return function () {
    var context = this,
      args = arguments;
    clearTimeout(timeout);
    timeout = setTimeout(function () {
      timeout = null;
      if (!immediate) func.apply(context, args);
    }, wait);
    if (immediate && !timeout) func.apply(context, args);
  };
};