<?php
if (!isset($_SESSION['user_data'])) {
  $fullname = '';
  $role = 'user';
} else {
  // $fullname = '';
  // $role = 'Admin';
  $fullname = $_SESSION['user_data']['user_info']['fullname']['th'];
  $role = trim($_SESSION['user_data']['role']);
}
if ($role === 'admin' || $role === 'hr' || $role === 'user') {
// ?>
  <div class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-12">
          <div class="card card-stats">
            <div class="card-category d-flex justify-content-between align-items-center">
              <p></p>
              <p><?php print $title; ?></p>
              <p></p>
            </div>
            <form class="form">
              <div class="card-header card-header-primary card-header-icon">
                <div class="container">
                  <div class="form-group form-select bmd-form-group col-12">
                    <div class="row">
                      <!-- <div class="col-12">
                                            <div class="row"> -->

                      <div class="col-12" style="border-style: inset;">
                        <div class="row">
                          <div class="col-12" style="border-left: 6px solid blue;">
                            <p></p>
                          </div>
                          <div class="col-12">
                            <div class="row">
                              <div class="col-1" id="companyDiv">
                                <label for="companyInput">บริษัท</label>
                              </div>
                              <div class="col-5" id="companyDiv">
                                <select id="companyInput" name="companyInput" class="form-control selectpicker" data-style="ripple-none select-with-transition" data-width="100%" title="บริษัท">
                                  <option value="" disabled>-- กรุณาเลือก --</option>
                                  <!-- <option value="1010">มิตรผล</option> -->
                                </select>
                              </div>
                              <div class="col-1" id="plantDiv">
                                <label for="plantInput">โรงงาน</label>
                              </div>
                              <div class="col-5" id="plantDiv">
                                <select id="plantInput" name="plantInput" class="form-control selectpicker" data-style="ripple-none select-with-transition" data-width="100%" title="โรงงาน">
                                  <option value="" disabled>-- กรุณาเลือก --</option>
                                  <!-- <option value="0001">เพลินจิต</option> -->
                                </select>
                              </div>
                              <div class="col-1" id="createrByDiv">
                                <label for="createrByInput">Name</label>
                              </div>
                              <div class="col-11" id="createrByDiv">
                                <input id='createrByInput' style="border-style: none; width:100%" readonly />
                              </div>
                              <div class="col-1" id="createrPositionDiv">
                                <label for="createrPositionInput">Position</label>
                              </div>
                              <div class="col-11" id="createrPositionDiv">
                                <input id='createrPositionInput' style="border-style: none; width:100%" readonly />
                              </div>
                              <div class="col-1" id="createrEmailDiv">
                                <label for="createrEmailInput">HR Email</label>
                              </div>
                              <div class="col-11" id="createrEmailDiv">
                                <select id="createrEmailInput" name="Email" class="form-control selectpicker" data-style="ripple-none select-with-transition" data-width="100%" title="Email">
                                  <option value="00023246">bunnawitp@mitrphol.com</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <p></p>
                          </div>
                        </div>
                      </div>

                      <div class="col-12" style="border-style: inset;">
                        <div class="row">
                          <div class="col-12" style="border-left: 6px solid blue;">
                            <p></p>
                          </div>
                          <div class="col-1" id="positionIdDiv">
                            <label for="positionIdInput">ID</label>
                          </div>
                          <div class="col-2" id="positionIdDiv">
                            <input id='positionIdInput' style="width:100%" />
                          </div>
                          <div class="col-1" id="positionNameDiv">
                            <label for="positionNameInput">Name</label>
                          </div>
                          <div class="col-8" id="positionNameDiv">
                            <input id='positionNameInput' style="width:100%" />
                          </div>
                          <div class="col-1" id="actOrgDiv">
                            <label for="actOrgInput">สังกัด</label>
                          </div>
                          <div class="col-11" id="actOrgDiv">
                            <input id='actOrgInput' style="width:100%" />
                          </div>
                          <div class="col-12">
                            <p></p>
                          </div>
                        </div>
                      </div>
                      <p></p>
                      <div class="col-12" style="border-style: inset;">
                        <div class="row">
                          <div class="col-12" style="border-left: 6px solid blue;">
                            <p></p>
                          </div>
                          <div class="col-1" id="startDateDiv">
                            <label for="startDateInput">Start</label>
                          </div>
                          <div class="col-5" id="startDateDiv">
                            <input id='startDateInput' style="width:100%" type="date" />
                          </div>
                          <div class="col-1" id="endDateDiv">
                            <label for="endDateInput">End</label>
                          </div>
                          <div class="col-5" id="endDateDiv">
                            <input id='endDateInput' style="width:100%" type="date" />
                          </div>
                          <div class="col-2" id="msFormDiv">
                            <label for="msFormInput">Link Microsoft Form</label>
                          </div>
                          <div class="col-10" id="msFormDiv">
                            <input id='msFormInput' style="width:100%" />
                          </div>
                          <div class="col-12">
                            <p></p>
                          </div>
                        </div>
                      </div>
                      <div class="col-12" style="border-style: inset;">
                        <button type="button" class="btn btn-primary col-12 btn-addRowA">เพิ่ม รายละเอียดงาน</button>
                        <div class="row" id="rowA"></div>
                      </div>
                      <div class="col-12" style="border-style: inset;">
                        <button type="button" class="btn btn-primary col-12 btn-addRowB">เพิ่ม คุณสมบัติ</button>
                        <div class="row" id="rowB"></div>
                      </div>
                      <div class="col-12" style="border-style: inset;">
                        test
                        <input type="file" name="fileToUpload" id="fileToUpload" />
                      </div>

                      <div class="col-12" style="border-style: inset;">

                        <div class="container mt-4 mb-4">
                          <div class="row justify-content-md-center">
                            <div class="col-md-12 col-lg-8">
                              <div class="form-group">
                                <textarea id="editor"></textarea>
                              </div>
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                          </div>
                        </div>

                      </div>
                      <div class="col-12" style="border-style: inset;">

                        <div class="container mt-4 mb-4">
                          <div class="row justify-content-md-center">
                            <div class="col-md-12 col-lg-8">
                              <div class="form-group">
                                <textarea id="editor"></textarea>
                              </div>
                              <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                          </div>
                        </div>

                      </div>

                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger btn-close" data-dismiss="modal">ปิด</button>
                        <button type="button" class="btn btn-primary btn-confirm">ยืนยัน</button>
                      </div>
                    </div>
                  </div>

                </div>

              </div>
              <div class="card-footer">
                <div class="container">
                  <div class="row">
                    <div class="col-4">
                    </div>
                    <div class="col-2" id="NumberDiv">
                      <input id='NumberInput' style="border-style: none;" readonly />
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } else {
  print('test');
}
?>
<script type="text/javascript">
  $(document).ready(function() {

    tinymce.init({
      selector: 'textarea',
      plugins: 'lists, link, image',
      toolbar: 'h1 h2 bold italic blockquote bullist numlist',
      menubar: false,
      // plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      // toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      // tinycomments_mode: 'embedded',
      // tinycomments_author: 'Author name',
      // mergetags_list: [{
      //         value: 'First.Name',
      //         title: 'First Name'
      //     },
      //     {
      //         value: 'Email',
      //         title: 'Email'
      //     },
      // ]
    });
    // tinymce.init({
    //     selector: 'textarea',
    // skin: 'bootstrap',
    // plugins: 'lists, link, image, media',
    // toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor',
    // menubar: false,
    // content_css: false, 
    // skin: false
    // });

    console.log("<?php

                  // print_r($_SESSION['user_data']); 
                  // if (!isset($_SESSION['user_data'])) {
                  //     $fullname = '';
                  //     $role = 'user';
                  // } else {
                  //     // $fullname = '';
                  //     // $role = 'Admin';
                  //     $fullname = $_SESSION['user_data']['user_info']['fullname']['th'];
                  //     $role = trim($_SESSION['user_data']['role']);
                  // }
                  // print_r($fullname);
                  ?>");
    // sessionUserData = 
    fullname = "<?php print_r($_SESSION['user_data']['user_info']['fullname']['th']); ?>";
    position = "<?php print_r($_SESSION['user_data']['job_info']['position']['name']['th']); ?>";

    date = fn.formatDate(Date());
    $("#NumberInput").val("DT" + date + "D" + "0001");
    $("#createrPositionInput").val(position);
    $("#createrByInput").val(fullname);
    document.getElementById("createrEmailInput").value = "00023246"
    $("#positionIdInput").val(document.getElementById("createrEmailInput").value);

    localStorage.setItem('countRowA', 0);
    localStorage.setItem('countRowB', 0);
    $(document).on('click', '.btn-addRowA', function() {
      fn.countRow("countRowA");
      fn.addRow("A");
    });
    $(document).on('click', '.btn-addRowB', function() {
      fn.countRow("countRowB");
      fn.addRow("B");
    })
    $(document).on('click', '.btA', function() {
      var id = $(this).attr('id')
      fn.delRow(id);
    })
    $(document).on('click', '.btB', function() {
      var id = $(this).attr('id')
      fn.delRow(id);
    })
    fn.getCompany();
    fn.getLocation();
  })
  var fn = {
    getCompany: function() {
      $.ajax({
        type: 'GET',
        url: base_url('sample/getCompany'),
        success: function(res, textStatus, jqXHR) {
          HTML = "";
          $.each(res.success.data, function(index, value) {
            HTML += '<option value="' + value.company_code + '">' + value.company_code + " : " + value.company_name + '</option>';
          });
          $("#companyInput").html(HTML).selectpicker('refresh');
        },
      });
    },
    getLocation: function() {
      $.ajax({
        type: 'GET',
        url: base_url('sample/getLocation'),
        success: function(res, textStatus, jqXHR) {
          HTML = "";
          $.each(res.success.data, function(index, value) {
            HTML += '<option value="' + value.location_code + '">' + value.location_code + " : " + value.location_name + '</option>';
          });
          $("#plantInput").html(HTML).selectpicker('refresh');
        },
      });
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

    addRow: function(divType) {
      divAll = document.createElement("Div");
      divBtn = document.createElement("Div");
      divTar = document.createElement("Div");
      divRow = document.createElement("Div");
      tar = document.createElement("textarea");
      btn = document.createElement("button");
      countRow = localStorage.getItem('countRow' + divType)
      divAll.className = "col-12";
      divBtn.className = "col-1";
      divTar.className = "col-11";
      divRow.className = "row"

      tar.className = "col-12";

      btn.innerHTML = countRow;
      btn.className = 'btn-danger bt' + divType;
      btn.type = 'button';

      btn.setAttribute('id', divType + countRow);
      tar.setAttribute('id', 'textarea' + divType + countRow);
      divAll.setAttribute('id', 'div' + divType + countRow);
      divRow.appendChild(divBtn).appendChild(btn);
      divRow.appendChild(divTar).appendChild(tar);
      divAll.appendChild(divRow);


      document.getElementById("row" + divType).appendChild(divAll);
      $("#Test" + divType + countRow).val('Test' + divType + countRow);
      $('#textarea' + divType + countRow).val('textarea' + divType + countRow);

    },

    countRow: function(divRow) {
      countRow = localStorage.getItem(divRow);
      countRow = parseInt(countRow) + 1;
      localStorage.setItem(divRow, countRow);
    },

    delRow: function(id) {
      const element = document.getElementById("div" + id);
      element.remove();
    }

  }
</script>