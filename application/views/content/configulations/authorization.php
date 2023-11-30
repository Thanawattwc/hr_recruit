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
                      <th class="text-left" data-text-th="หน้าที่ในระบบ" data-text-en="Title"></th>
                      <th class="text-left" data-text-th="สิทธิ์ในการใช้งานระบบ" data-text-en="Privileges"></th>
                      <th class="text-center" data-text-th="วันที่สร้าง" data-text-en="Create Date"></th>
                      <th class="text-center" data-text-th="แก้ไขล่าสุด" data-text-en="Last Modified"></th>
                      <th class="text-center col-default" data-method="set_user_role" data-text-th="บทบาทสำหรับผู้ใช้" data-text-en="Roles for Users"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if (is_array($data) && count($data))
                      {
												$i = 1;
												
                        foreach ($data as $key => $value)
                        {
                          $detail = json_decode($value['detail'], true);

                          if (!$detail)
                          {
                            $authorization_detail = $value['detail'];
                          }
                          else
                          {
                            $authorization_detail = '';
                            foreach ($detail as $permission => $privilege)
                            {
                              $authorization_detail .= ucwords(str_replace('_', ' ', $permission)) . ' [ ' . ucwords(str_replace('_', ' ', implode(' | ', $privilege))) . ' ]<br>';
                            }
                          }

                          print '<tr data-id="' . $value['id'] . '">';
                          print '<td class="text-center col-record">' . $i . '</td>';
													print '<td class="text-center ignore-column col-action">';
													
                          if ($authorization_detail != 'Full Access')
                          {
                            print '<button type="button" class="btn btn-info btn-fab btn-fab-mini btn-round btn-edit" title="' . $this->lang->line('label_edit') . '" data-toggle="modal" data-method="edit">';
                            print '<i class="far fa-edit"></i>';
                            print '</button>';
                            print '<button type="button" class="btn btn-danger btn-fab btn-fab-mini btn-round btn-delete" title="' . $this->lang->line('label_delete') . '" data-method="delete">';
                            print '<i class="far fa-trash-alt"></i>';
                            print '</button>';
													}
													
                          print '</td>';
													print '<td class="text-left name">' . $value['name'] . '</td>';

													if ($authorization_detail != 'Full Access')
													{
														print '<td class="text-left detail" data-json-convert="true">' . $authorization_detail . '</td>';
													}
													else
													{
														print '<td class="text-left detail">' . $authorization_detail . '</td>';
													}

                          $create_date = $this->thaidate->date('d F Y H:i:s', strtotime($value['create_date']));
													$last_modified = $this->thaidate->date('d F Y H:i:s', strtotime($value['last_modified']));
													
                          if($this->application->language == 'en')
                          {
                            $create_date = date('d F Y H:i:s', strtotime($value['create_date']));
                            $last_modified = date('d F Y H:i:s', strtotime($value['last_modified']));
													}
													
                          print '<td class="text-center create_date" data-date-format="DD MMMM YYYY HH:mm:ss">' . $create_date . '</td>';
                          print '<td class="text-center last_modified" data-date-format="DD MMMM YYYY HH:mm:ss">' . $last_modified . '</td>';
													print '<td class="text-center is_default" data-method="set_user_role">';
													print '<div class="togglebutton">';
													print '<label>';
													
													$is_default = ($value['is_default'] == 1) ? ' checked' : '';
													$is_disabled = ($authorization_detail == 'Full Access') ? ' disabled' : '';

													if (_ALL_EMPLOYEE_USAGE_)
													{
														print '<input type="radio" name="is_default"' . $is_default . $is_disabled .'>';
													}
													else
													{
														print '<input type="checkbox" name="is_default"' . $is_default . $is_disabled .'>';
													}
													
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
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="card card-stats card-in-modal">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">add_circle_outline</i>
            </div>
            <div class="card-category d-flex justify-content-between align-items-center">
              <p data-text-th="เพิ่มข้อมูลสิทธิ์การใช้งานระบบ" data-text-en="Add new authorization"></p>
            </div>
          </div>
          <form id="add" class="form" method="POST" action="<?php print base_url($content . '/add');?>" autocomplete="off" data-plugin="validate">
            <div class="modal-body">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating" for="name" data-text-th="หน้าที่ในระบบ" data-text-en="Roles"> <span class="text-danger">*</span></label>
                <input name="name" type="text" class="form-control" data-required-th="กรอกหน้าที่ในระบบ" data-required-en="Please, Enter Role title" required>
              </div>
              <div class="form-group form-select bmd-form-group">
                <label class="form-control-label bmd-label-floating" for="authorizations" data-text-th="สิทธิ์ในการใช้งานระบบ" data-text-en="Privileges"> <span class="text-danger">*</span></label>
                <select name="authorizations[]" class="selectpicker" data-style="ripple-none select-with-transition" data-width="100%" data-live-search="true" data-required-th="กำหนดสิทธิ์ในการใช้งานระบบ" data-required-en="Please, Select privileges" multiple required>
                  <?php
                    foreach ($module as $key => $value)
                    {
                      print '<option value="' . $key . '" data-privileges="' . implode(', ', $value) . '">' . ucwords(str_replace('_', ' ', $key)) . '</option>';
                    }
                  ?>
                </select>
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
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="card card-stats card-in-modal">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="far fa-edit"></i>
            </div>
            <div class="card-category d-flex justify-content-between align-items-center">
              <p data-text-th="แก้ไขข้อมูลสิทธิ์การใช้งานระบบ" data-text-en="Edit authorization"></p>
            </div>
          </div>
          <form id="edit" class="form" method="POST" action="<?php print base_url($content . '/edit');?>" autocomplete="off" data-plugin="validate">
            <div class="modal-body">
              <div class="form-group bmd-form-group">
                <label class="bmd-label-floating" for="name" data-text-th="หน้าที่ในระบบ" data-text-en="Roles"> <span class="text-danger">*</span></label>
                <input name="name" type="text" class="form-control" data-required-th="กรอกหน้าที่ในระบบ" data-required-en="Enter, Role title" required>
                <input name="id" type="hidden">
                <input name="is_default" type="hidden">
              </div>
              <div class="form-group form-select bmd-form-group">
                <label class="form-control-label bmd-label-floating" for="authorizations" data-text-th="สิทธิ์ในการใช้งานระบบ" data-text-en="Privileges"> <span class="text-danger">*</span></label>
                <select name="authorizations[]" class="selectpicker" data-style="ripple-none select-with-transition" data-width="100%" data-live-search="true" data-required-th="กำหนดสิทธิ์ในการใช้งานระบบ" data-required-en="Please, Select privileges" multiple required>
                  <?php
                    foreach ($module as $key => $value)
                    {
                      print '<option value="' . $key . '" data-privileges="' . implode(', ', $value) . '">' . ucwords(str_replace('_', ' ', $key)) . '</option>';
                    }
                  ?>
                </select>
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
	$(document).on('change', 'input[name="is_default"]', fn.set_user_role);
	$(document).on('click', '.select-all', function(){
		$(this).closest('.card-permission').find('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
	});
	$(document).on('click', 'input[type="checkbox"]', function(){
		if (!$(this).prop('checked')) {
			$(this).closest('.card-permission').find('.select-all').prop('checked', false);
		}
	});

	$.each($('select[name="authorizations[]"] > option'), function (index, value) {
		var name = $('.sidebar-wrapper').find('[data-id="' + $(value).val() + '"]').data('module');
		if (name) {
			$(value).text(name);
		}
		else {
			$(value).remove();
		}
	});

	$('select[name="authorizations[]"]').selectpicker('refresh');

	$('select[name="authorizations[]"]').selectpicker().on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
		var obj = $(e.target[clickedIndex]);
		var authorization_val = obj.val();
		var authorization_name = obj.text();
		var HTML = '';

		if (isSelected) {
			var privilege = obj.data('privileges').split(', ');
			HTML += '<div class="card card-permission" id="perm-' + authorization_val + '" data-id="' + authorization_val + '">' +
				'<div class="card-body text-left">' +
				'<button type="button" class="close">' +
				'<span>&times;</span>' +
				'</button>' +
				'<h5 class="card-title text-left">' + authorization_name +
				'<div class="form-check form-check-inline">' +
				'<label class="form-check-label">' +
				'<input class="form-check-input select-all" type="checkbox"> <?php print $this->lang->line('label_select_all'); ?>' +
				'<span class="form-check-sign">' +
				'<span class="check"></span>' +
				'</span>' +
				'</label>' +
				'</div>' +
				'</h5>';

			$.each(privilege, function (key, value) {
				if (!value) {
					value = 'view';
				}

				HTML += '<div class="form-check form-check-inline w-33">' +
					'<label class="form-check-label">' +
					'<input class="form-check-input" type="checkbox" name="detail[' + authorization_val + '][]" value="' + value + '" required> ' + value.replace(/_/g, ' ').ucwords() +
					'<span class="form-check-sign">' +
					'<span class="check"></span>' +
					'</span>' +
					'</label>' +
					'</div>';
			});
			
			HTML += '</div>' +
				'</div>';

			$('.modal.show .modal-body').append(HTML);
		}
		else {
			$('#perm-' + authorization_val).remove();
		}
	});

	$(document).on('click', '.card-permission .close', function () {
		var container = $(this).closest('form');
		var id = $(this).closest('.card-permission').data('id');

		$('#perm-' + id).remove();
		$(container).find('select[name="authorizations[]"] > option[value="' + id + '"]').prop('selected', false);

		var selected = $(container).find('select[name="authorizations[]"]').val();
		$(container).find('select[name="authorizations[]"]').selectpicker('val', selected).trigger('change');
	});

	$('.table-container table > tbody > tr[data-id="1"] > .col-action > .btn').remove();
});

var fn = {
	add: function () {
		var modal = $('#modal-add');
		modal.modal('show');

		modal.on('hidden.bs.modal', function () {
			$('.card-permission').remove();
		});
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

				var authorization_detail = JSON.parse(res.success.data[0].detail);
				var authorizations = [];
				var permission_all_privileges = [];

				$.each(authorization_detail, function (permission, privilege) {
					var name = $('.sidebar-wrapper').find('[data-id="' + permission + '"]').data('module');
					
					authorizations.push(permission);
					permission_all_privileges.push(permission);

					if ($('select[name="authorizations[]"]').find('option[value="' + permission + '"]').length) {
						var privileges = $('select[name="authorizations[]"]').find('option[value="' + permission + '"]').data('privileges').split(', ');
						var HTML = '<div class="card card-permission" id="perm-' + permission + '" data-id="' + permission + '">' +
							'<div class="card-body text-left">' +
							'<button type="button" class="close">' +
							'<span>&times;</span>' +
							'</button>' +
							'<h5 class="card-title text-left">' + name +
							'<div class="form-check form-check-inline">' +
							'<label class="form-check-label">' +
							'<input class="form-check-input select-all" type="checkbox"> <?php print $this->lang->line('label_select_all'); ?>' +
							'<span class="form-check-sign">' +
							'<span class="check"></span>' +
							'</span>' +
							'</label>' +
							'</div>' +
							'</h5>';

						$.each(privileges, function (key, value) {
							var checked = '';
							if (privilege.indexOf(value) != -1) {
								checked = ' checked';
							}
							else {
								permission_all_privileges.indexOf(permission) !== -1 && permission_all_privileges.splice(permission_all_privileges.indexOf(permission), 1);
							}

							if (!value) {
								value = 'view';
								checked = ' checked';
							}

							HTML += '<div class="form-check form-check-inline w-33">' +
								'<label class="form-check-label">' +
								'<input class="form-check-input" type="checkbox" name="detail[' + permission + '][]" value="' + value + '"' + checked + '> ' + value.replace(/_/g, ' ').ucwords() +
								'<span class="form-check-sign">' +
								'<span class="check"></span>' +
								'</span>' +
								'</label>' +
								'</div>';
						});

						HTML += '</div>' +
							'</div>';

						$('#modal-edit .modal-body').append(HTML);

						$.each(permission_all_privileges, function (key, value) {
							$('#perm-' + value).find('.select-all').prop('checked', true);
						});
					}
				});

				appFn.fillInput(res.success.data[0], modal);

				modal.find('select[name="authorizations[]"]').selectpicker('val', authorizations).trigger('change');

				modal.modal('show');

				modal.on('hidden.bs.modal', function () {
					$('.card-permission').remove();
				});
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
			message: '<?php print $this->lang->line('label_confirm_delete'); ?>',
      buttons: {
        confirm: {
          label: '<?php print $this->lang->line('label_delete'); ?>',
          className: 'btn-danger'
        },
        cancel: {
          label: '<?php print $this->lang->line('label_cancel'); ?>'
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
	set_user_role: function () {
		var obj = $(this);
		var id = obj.closest('tr').data('id');
		var active = (obj.is(':checked') == true) ? 1 : 0;
		$.ajax({
			type: 'POST',
			url: window.location.href + '/set_user_role',
			data: {
				'id': id,
				'is_default': active
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

    if ($('.table-container table > tbody > tr[data-id]').length < 2) {
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