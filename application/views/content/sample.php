<div class="content" data-module="<?php print $this->router->fetch_class();?>">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-stats">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">assignment</i>
            </div>
            <div class="card-category d-flex justify-content-between align-items-center">
              <p><?php print $title;?></p>
              <button class="btn btn-primary btn-add" title="<?php print $this->lang->line('label_add'); ?>" data-toggle="modal" data-method="add">
                <i class="material-icons">add_circle_outline</i> <span class="d-none d-sm-inline"><?php print $this->lang->line('label_add'); ?></span>
              </button>
            </div>
          </div>
          <div class="col-12">
            <div class="table-container" data-pagination="true" data-pagination-url="<?php print base_url($content . '/pagination');?>" data-pagination-perpage="20" data-search="true" data-search-url="<?php print base_url($content . '/search');?>">
              <div class="table-responsive-lg">
                <table class="table table-striped table-hover table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center ignore-column col-action"></th>
                      <th class="text-left" data-text-th="หัวข้อ" data-text-en="Title"></th>
                      <th class="text-center" data-text-th="วันที่สร้าง" data-text-en="Create Date"></th>
                      <th class="text-center" data-text-th="แก้ไขล่าสุด" data-text-en="Last Modified"></th>
                      <th class="text-center ignore-column col-active" data-method="active" data-text-th="สถานะ" data-text-en="Status"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if (is_array($data) && count($data))
                      {
                        $i = 1;
                        foreach ($data as $key => $value)
                        {
                          print '<tr data-id="' . $value['id'] . '">';
                          print '<td class="text-center col-record">' . $i . '</td>';
                          print '<td class="text-center ignore-column col-action">';
                          print '<button type="button" class="btn btn-info btn-fab btn-fab-mini btn-round btn-edit" title="' . $this->lang->line('label_edit') . '" data-toggle="modal" data-method="edit">';
                          print '<i class="far fa-edit"></i>';
                          print '</button>';
                          print '<button type="button" class="btn btn-danger btn-fab btn-fab-mini btn-round btn-delete" title="' . $this->lang->line('label_delete') . '" data-method="delete">';
                          print '<i class="far fa-trash-alt"></i>';
                          print '</button>';
                          print '</td>';
                          print '<td class="text-left title">' . $value['title'] . '</td>';
                          print '<td class="text-center create_date" data-date-format="DD MMMM YYYY HH:mm:ss">' . $this->thaidate->date('d F Y H:i:s', strtotime($value['create_date'])) . '</td>';
                          print '<td class="text-center last_modified" data-date-format="DD MMMM YYYY HH:mm:ss">' . $this->thaidate->date('d F Y H:i:s', strtotime($value['last_modified'])) . '</td>';
                          print '<td class="text-center" data-method="active">';
                          print '<div class="togglebutton">';
                          print '<label>';
                          $is_active = ($value['is_active']) ? ' checked' : '';
                          print '<input type="checkbox" name="is_active"' . $is_active . '>';
                          print '<span class="toggle"></span>';
                          print '</label>';
                          print '</div>';
                          print '</td>';
                          print '</tr>';
                          $i++;
                        }
                      }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="7">
                        <?php print $this->lang->line('label_footer_table_page_display'); ?>
												<?php print $this->lang->line('label_footer_table_search_display'); ?>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          <div class="card-footer justify-content-start">
            <button class="btn btn-sm btn-dark-green" tabindex="0" type="button" data-export-url="<?php print base_url($content . '/pagination');?>" data-export=".table-container > .table-responsive-lg > table" data-export-type="csv">
              <i class="fas fa-file-csv"></i>
              <span><?php print $this->lang->line('label_export_csv'); ?></span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal-container">
  <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="card card-stats card-in-modal">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">add_circle_outline</i>
            </div>
            <div class="card-category d-flex justify-content-between align-items-center">
              <p><?php print $this->lang->line('label_add'); ?></p>
            </div>
          </div>
          <form id="add" class="form" method="post" action="<?php print base_url($content . '/add');?>" autocomplete="off" data-plugin="validate">
            <div class="modal-body">
              <div class="form-group bmd-form-group">
                <label class="form-control-label bmd-label-floating" for="title">หัวข้อ <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="title"  title="หัวข้อ" required>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><?php print $this->lang->line('label_cancel'); ?></button>
              <button type="submit" class="btn btn-primary"><?php print $this->lang->line('label_add'); ?></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="card card-stats card-in-modal">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="far fa-edit"></i>
            </div>
            <div class="card-category d-flex justify-content-between align-items-center">
              <p>แก้ไขมูล</p>
            </div>
          </div>
          <form id="edit" class="form" method="post" action="<?php print base_url($content . '/edit');?>" autocomplete="off" data-plugin="validate">
            <div class="modal-body">
              <div class="form-group bmd-form-group">
                <label class="form-control-label bmd-label-floating" for="title">หัวข้อ<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="title" title="หัวข้อ" required>
                <input name="id" type="hidden">
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal"><?php print $this->lang->line('label_cancel'); ?></button>
              <button type="submit" class="btn btn-primary"><?php print $this->lang->line('label_save'); ?></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
$(document).ready(function () {
  $(document).on('click', '.btn-add', fn.add);
  $(document).on('click', '.btn-edit', fn.edit);
  $(document).on('click', '.btn-delete', fn.delete);
  $(document).on('change', 'input[type="checkbox"][name="is_active"]', fn.active);
});

var fn = {
  add: function () {
    var modal = $('#modal-add');

    modal.modal('show');
  },
  edit: function () {
    var obj = $(this);
    var id = obj.closest('tr').data('id');
    var modal = $('#modal-edit');

    $.ajax({
      type: 'GET',
      url: modal.find('form').attr('action'),
      data: {
        'id': id
      },
      success: function (res, textStatus, jqXHR) {
        if (xhr.responseURL != this.url) {
          location.reload(true);
        }
        appFn.fillInput(res.success.data[0], modal);

        modal.modal('show');
      },
      error: function (jqXHR, textStatus, errorThrown) {
        fn.error(jqXHR, textStatus, errorThrown);
      }
    });
  },
  delete: function () {
    var obj = $(this);
    var id = obj.closest('tr').data('id');
    bootbox.confirm({
      message: 'ยืนยันการลบข้อมูล?',
      buttons: {
        confirm: {
          label: 'ลบ',
          className: 'btn-danger'
        },
        cancel: {
          label: 'ยกเลิก'
        }
      },
      closeButton: false,
      callback: function (result) {
        if (result) {
          $.ajax({
            type: 'POST',
            url: window.location.href + '/delete',
            data: {
              'id': id
            },
            success: function (res, textStatus, jqXHR) {
              if (xhr.responseURL != this.url) {
                location.reload(true);
              }
              if (jqXHR.status == 200) {
                $('[data-id="' + id + '"]').fadeOut(250, function () {
                  $('.table-container').trigger('dTable.refresh');
                  $(this).remove();
                });
              }
            },
            error: function (jqXHR, textStatus, errorThrown) {
              fn.error(jqXHR, textStatus, errorThrown);
            }
          });
        }
      }
    });
  },
  active: function () {
    var obj = $(this);
    var id = obj.closest('tr').data('id');
    var active = (obj.is(':checked') == true) ? 1 : 0;
    $.ajax({
      type: 'POST',
      url: window.location.href + '/active',
      data: {
        'id': id,
        'is_active': active
      },
      success: function (res, textStatus, jqXHR) {
        if (xhr.responseURL != this.url) {
          location.reload(true);
        }
        if (jqXHR.status == 200) {
          appFn.updateRecord(res.success.data[0], id);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        fn.error(jqXHR, textStatus, errorThrown);
        obj.prop('checked', !obj.prop('checked'));
      }
    });
  },
  ajaxSuccess: function (res, textStatus, jqXHR, form) {
    $.notifyClose();

    var action = $(form).attr('id');

    $(form).closest('.modal').modal('hide');
    fn.success(res, textStatus, jqXHR);

    if ($('.table-container table > tbody > tr[data-id]').length == 0) {
      window.location.reload();
    }

    if (action == 'edit') {
			var id = $(form).find('input[name="id"]').val();
      appFn.updateRecord(res.success.data[0], id);
    }
    else {
      $('.table-container').trigger('dTable.refresh');
    }
  },
  ajaxError: function (jqXHR, textStatus, errorThrown) {
    fn.error(jqXHR, textStatus, errorThrown);
  },
  error: function (jqXHR, textStatus, errorThrown) {
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
  success: function (res, textStatus, jqXHR) {
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