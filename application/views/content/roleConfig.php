<?php
if (!isset($_SESSION['user_data'])) {
  $role = 'user';
} else {
  $role = trim($_SESSION['user_data']['role']);
}
if ($role === 'dev' || $role === 'admin') {

?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-stats">
            <div id="divTable" class="table-container col-12">
              <div id="frm">
                <table id='dataList' class="table table-hover table-bordered" style="width:100%">
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal-container">
    <div class="modal fade" id="modal_edit" tabindex="1" role="" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="card card-stats card-in-modal">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">add_circle_outline</i>
              </div>
              <div class="card-category d-flex justify-content-between align-items-center">
                <p>แก้ไขข้อมูลผู้ใช้งานระบบ</p>
              </div>
            </div>
            <form id="form_edit" class="form" method="POST" action="<?php print base_url('roleConfig/user'); ?>">
              <div class="modal-body">
                <div class="container">
                  <div class="row" style="padding: 0; margin: 0;">
                    <div class="form-group form-select bmd-form-group col-12" style="display: none;">
                      <label for="editId" class="form-control-label">ID</label>
                      <input type="text" class="form-control" id="editId">
                    </div>
                    <div class="form-group form-select bmd-form-group col-12">
                      <label for="editFullName" class="form-control-label">ชื่อ-สกุล</label>
                      <input type="text" class="form-control" id="editFullName">
                    </div>
                    <div class="form-group form-select bmd-form-group col-12">
                      <label for="editPosition" class="form-control-label">ชื่อตำแหน่ง</label>
                      <input type="text" class="form-control" id="editPosition">
                    </div>
                    <div class="form-group form-select bmd-form-group col-12">
                      <label for="editUsername" class="form-control-label">username</label>
                      <input type="text" class="form-control" id="editUsername">
                    </div>
                    <div class="form-group form-select bmd-form-group col-12">
                      <label for="editEmail" class="form-control-label">email</label>
                      <input type="text" class="form-control" id="editEmail">
                    </div>
                    <div class="form-group form-select bmd-form-group col-12">
                      <label for="editPhone" class="form-control-label">เบอร์ติดต่อ</label>
                      <input type="text" class="form-control" id="editPhone">
                    </div>
                    <div class="form-group form-select bmd-form-group col-12">
                      <label class="form-control-label" for="editRole">สิทธิ์เข้าถึง</label>
                      <select id="editRole" class="form-control selectpicker" data-style="ripple-none select-with-transition" data-width="100%" title="สิทธิ์เข้าใช้งาน">
                        <option value="" disabled>-- กรุณาเลือก --</option>
                        <option value="dev">Developer</option>
                        <option value="admin">Administrator</option>
                        <option value="hr">บุคคล</option>
                      </select>
                    </div>
                  </div>

                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger btn-reload" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary btn-update">แก้ไข</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal-container">
    <div class="modal fade" id="modal_add" tabindex="1" role="" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="card card-stats card-in-modal">
            <div class="card-header card-header-primary card-header-icon">
              <div class="card-icon">
                <i class="material-icons">add_circle_outline</i>
              </div>
              <div class="card-category d-flex justify-content-between align-items-center">
                <p>เพิ่มสิทธิ์เข้าใช้ระบบ</p>
              </div>
            </div>
            <form id="form_add" class="form" method="POST" action="<?php print base_url('roleConfig/user'); ?>">
              <div class="modal-body">
                <div class="container">
                  <div class="row" style="padding: 0; margin: 0;">
                    <div class="form-group form-select bmd-form-group col-12" id="empfind">
                      <label class="form-control-label bmd-label-floating" for="txtUsername">ค้นหา</span></label>
                      <select id="txtUsername" name="username" class="selectpicker with-ajax" data-style="ripple-none select-with-transition" data-width="100%" data-live-search="true" title="รายชื่อ" required>
                      </select>
                    </div>
                    <div class="form-group form-select bmd-form-group col-12">
                      <label for="addFullName" class="form-control-label">ชื่อ-สกุล</label>
                      <input type="text" class="form-control" id="addFullName">
                    </div>
                    <div class="form-group form-select bmd-form-group col-12">
                      <label for="addPosition" class="form-control-label">ชื่อตำแหน่ง</label>
                      <input type="text" class="form-control" id="addPosition">
                    </div>
                    <div class="form-group form-select bmd-form-group col-12">
                      <label for="addUsername" class="form-control-label">username</label>
                      <input type="text" class="form-control" id="addUsername">
                    </div>
                    <div class="form-group form-select bmd-form-group col-12">
                      <label for="addEmail" class="form-control-label">email</label>
                      <input type="text" class="form-control" id="addEmail">
                    </div>
                    <div class="form-group form-select bmd-form-group col-12">
                      <label for="addPhone" class="form-control-label">เบอร์ติดต่อ</label>
                      <input type="text" class="form-control" id="addPhone">
                    </div>
                    <div class="form-group form-select bmd-form-group col-12">
                      <label class="form-control-label" for="addRole">สิทธิ์เข้าถึง</label>
                      <select id="addRole" class="form-control selectpicker" data-style="ripple-none select-with-transition" data-width="100%" title="สิทธิ์เข้าใช้งาน">
                        <option value="" disabled>-- กรุณาเลือก --</option>
                        <option value="dev">Developer</option>
                        <option value="admin">Administrator</option>
                        <option value="hr">บุคคล</option>
                      </select>
                    </div>
                  </div>

                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger btn-reload" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary btn-send">เพิ่มสิทธิ์เข้าใช้ระบบ</button>
                  </div>
                </div>
              </div>
            </form>
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
    fn.getData();
    $(document).on('click', '.btn-showadd', function() {
      fn.show_add();
    })
    $(document).on('click', '.btn-update', function() {
      fn.edit();
    })
    $(document).on('click', '.btn-send', function() {
      fn.add();
    })

  })


  var fn = {
    getData: function() {
      fn.createTable();
      $.ajax({
        type: 'GET',
        url: window.location.href + '/getData',
        dataType: 'json',
        dataSrc: "success.data",
        success: function(res, textStatus, jqXHR) {
          dataset = res.success.data
          fn.setTable(dataset, "dataList")
          $("#dataList tbody").on('dblclick', 'tr', function() {
            table = $("#dataList").DataTable();
            var data = table.row(this).data();
            fn.show_edit(data);
          });
        },
        error: function(jqXHR, textStatus, errorThrown) {}
      })
    },
    setTable: function(dataset = [], tableId = "", ) {
      setColumn = fn.setColumn(dataset[0]);
      $("#" + tableId).DataTable({
        destroy: true,
        data: dataset,
        columns: setColumn,
        pagingType: 'full_numbers',
        autoWidth: false,
      });
    },
    setColumn: function(dataset = []) {
      columns = [];
      col = Object.keys(dataset);
      $.each(col, function(index, colName) {
        if (colName == "fullname") {
          titlename = "ชื่อ-สกุล";
        } else if (colName == "position_name") {
          titlename = "ตำแหน่ง";
        } else if (colName == "Phone") {
          titlename = "เบอร์ติดต่อ";
        } else if (colName == "role") {
          titlename = "สิทธิ์";
        } else {
          titlename = colName;
        }
        if (colName != 'id') {
          columns.push({
            data: colName,
            title: titlename,
            className: 'text-center',
          })
        }
      })
      return columns;
    },
    createTable: function() {
      document.getElementById("frm").remove();
      table = document.createElement("table");
      table.className = "table table-hover table-bordered";
      table.style.cssText = "width:100%";
      table.setAttribute('id', 'dataList');
      form = document.createElement("div");
      form.setAttribute('id', 'frm');
      form.appendChild(table);
      divbutton = document.createElement("div");
      divbutton.className = "col-12";
      divbutton.setAttribute('id', 'divbutton');
      button = document.createElement("button");
      button.className = "btn btn-primary text-center col-12 btn-showadd";
      button.innerHTML = "เพิ่มสิทธิ์เข้าใช้ระบบ";
      divbutton.appendChild(button);
      form.appendChild(divbutton);
      document.getElementById("divTable").appendChild(form);
    },

    show_edit: function(data) {
      // console.log(data);
      $("#editId").val(data.id);
      $("#editFullName").val(data.fullname);
      $("#editPosition").val(data.position_name);
      $("#editUsername").val(data.username);
      $("#editEmail").val(data.email);
      $("#editPhone").val(data.Phone);
      $("#editRole").val(data.role).selectpicker('refresh');
      $('#modal_edit').modal('show');
    },
    show_add: function() {
      fn.getEmpData();
      $('#modal_add').modal('show');
    },
    getEmpData: function() {
      $('.selectpicker.with-ajax').selectpicker().ajaxSelectPicker({
        ajax: {
          url: "",
          type: 'POST',
          data: {
            keyword: "{{{q}}}"
          }
        },
        locale: {
          searchPlaceholder: 'ค้นหา',
          statusNoResults: 'ไม่พบข้อมูล',
          statusSearching: 'กำลังค้นหา...',
          statusInitialized: 'ค้นหาด้วย ชื่อ นามสกุล อีเมล ตำแหน่ง',
          currentlySelected: 'ที่เรียกอยู่ในปัจจุบัน'
        },
        preprocessData: function(res) {
          var results = [];
          results = $.map(res.success.data, function(value) {
            value.text = value.user_info.fullname.th + " | " + value.job_info.position.name.th;
            value.value = value.user_info.username;
            value.data = {
              emp_id: value.user_info.id,
              full_name: value.user_info.fullname.th,
              user_name: value.user_info.username,
              email: value.user_info.email,
              phone: value.user_info.telephone.direct,
              company_code: value.job_info.company.id,
              company_name: value.job_info.company.name,
              plant_code: value.job_info.company.branch.id,
              plant_name: value.job_info.company.branch.name,
              department: value.job_info.position.department.th,
              position_name: value.job_info.position.name.th,
            };
            return value;
          });

          return results;
        }
      }).on('changed.bs.select', function(e, clickedIndex, isSelected, previousValue) {
        $("#addFullName").val($(this).find('option:selected').data('full_name')).trigger('change');
        $("#addPosition").val($(this).find('option:selected').data('position_name')).trigger('change');
        $("#addUsername").val($(this).find('option:selected').data('user_name')).trigger('change');
        $("#addEmail").val($(this).find('option:selected').data('email')).trigger('change');
        $("#addPhone").val($(this).find('option:selected').data('phone')).trigger('change');
      });
    },

    edit: function() {
      fullName = $("#editFullName").val();
      position = $("#editPosition").val();
      username = $("#editUsername").val();
      email = $("#editEmail").val();
      phone = $("#editPhone").val();
      role = $("#editRole").val();
      id = $("#editId").val();

      $.ajax({
        type: 'POST',
        url: window.location.href + '/updateData',
        data: {
          "fullName": fullName,
          "position": position,
          "username": username,
          "email": email,
          "phone": phone,
          "role": role,
          "id": id,
        },
        success: function(res, textStatus, jqXHR) {
          // console.log(res);
          fn.success(res, textStatus, jqXHR);
          window.location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(jqXHR);
          console.log(errorThrown);
          fn.error(jqXHR, textStatus, errorThrown);
        }
      })
    },
    add: function() {
      fullName = $("#addFullName").val();
      position = $("#addPosition").val();
      username = $("#addUsername").val();
      email = $("#addEmail").val();
      phone = $("#addPhone").val();
      role = $("#addRole").val();
      $.ajax({
        type: 'POST',
        url: window.location.href + '/addData',
        data: {
          "fullName": fullName,
          "position": position,
          "username": username,
          "email": email,
          "phone": phone,
          "role": role,
        },
        success: function(res, textStatus, jqXHR) {
          // console.log(res);
          fn.success(res, textStatus, jqXHR);
          window.location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(jqXHR);
          console.log(errorThrown);
          fn.error(jqXHR, textStatus, errorThrown);
        }
      })
    },



    ajaxSuccess: function(res, textStatus, jqXHR, form) {
      fn.success(res, textStatus, jqXHR);
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