<?php

if (!isset($_SESSION['user_data'])) {
  $fullname = '';
  $email = '';
  $positionName = '';
  $telephone = '';
  $role = 'user';
} else {
  $fullname = $_SESSION['user_data']['user_info']['fullname']['th'];
  $email = $_SESSION['user_data']['user_info']['email'];
  $telephone = $_SESSION['user_data']['user_info']['telephone']['direct'];
  $positionName = $_SESSION['user_data']['job_info']['position']['name']['th'];
  $role = trim($_SESSION['user_data']['role']);
}
if ($role === 'dev' || $role === 'admin' || $role === 'hr') {
  // if (!isset($_GET['edit'])) {

  // if (!isset($_GET['id'])) {
  //   $org_name = "";
  //   $positon_name = "";
  // } else {
  //   $org_name = $data[0]['org_name'];
  //   $positon_name = $data[0]['positon_name'];
  // }
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
                <form>
                  <div class="row">
                    <div class="col-6">
                      <label for="inputStartDate" class="form-control-label">วันที่ลงประกาศ</label>
                      <input id="inputStartDate" type="date" class="form-control" min="2023-01-01" data-provide="datepicker" />
                    </div>
                    <div class="col-6" id="divEnddate" style="display: none;">
                      <label for="inputEndDate" class="form-control-label">วันที่สิ้นสุดประกาศ</label>
                      <input id="inputEndDate" type="date" class="form-control" min="2023-01-01" data-provide="datepicker" disabled />
                    </div>
                    <div class="col-12" style="border-style: inset">
                      <nav class="navbar navbar-dark bg-primary " style="display: flex; justify-content: center;">
                        HR Contract
                      </nav>
                      <div class="row">
                        <div class="col-6">
                          <label for="inputOwnerEmail" class="form-control-label">Email</label>
                          <input id="inputOwnerEmail" type="text" class="form-control" disabled value="<?php print $email ?>" />
                        </div>
                        <div class="col-6">
                          <label for="inputOwnerFullName" class="form-control-label">ชื่อ-สกุล</label>
                          <input id="inputOwnerFullName" type="text" class="form-control" disabled value="<?php print $fullname ?>" />
                        </div>
                        <div class="col-6">
                          <label for="inputOwnerPositionName" class="form-control-label">ตำแหน่ง</label>
                          <input id="inputOwnerPositionName" type="text" class="form-control" disabled value="<?php print $positionName ?>" />
                        </div>
                        <div class="col-4">
                          <label for="inputOwnerPhone" class="form-control-label">เบอร์ติดต่อ</label>
                          <input id="inputOwnerPhone" type="text" class="form-control" value="<?php print $telephone ?>" />
                        </div>
                        <div class="col-2">
                          <div>
                            <label class="form-control-label" for=""></label>
                          </div>
                          <div>
                            <input type="checkbox" id="checkboxOwner" class="form-control-label">
                            <label class="form-control-label" for="checkboxOwner">เปลี่ยนผู้ดูแล</label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-12" style="border-style: inset;">
                      <nav class="navbar navbar-dark bg-primary " style="display: flex; justify-content: center;">
                        Position Detail
                      </nav>
                      <div class="row">
                        <div class="col-6">
                          <label for="inputCompany" class="form-control-label">บริษัท</label>
                          <select id="inputCompany" class="form-control selectpicker" data-style="ripple-none select-with-transition" title="บริษัท">
                          </select>
                        </div>
                        <div class="col-6">
                          <label for="inputPlant" class="form-control-label">โรงงาน</label>
                          <select id="inputPlant" class="form-control selectpicker" data-style="ripple-none select-with-transition" title="โรงงาน">
                          </select>
                        </div>
                        <div class="col-12">
                          <label for="inputOrg" class="form-control-label">สังกัด</label>
                          <input id="inputOrg" type="text" class="form-control" />
                        </div>
                        <div class="col-2">
                          <label for="inputPositionId" class="form-control-label">รหัสตำแหน่ง</label>
                          <input id="inputPositionId" type="text" class="form-control" max="8" />
                        </div>
                        <div class="col-8">
                          <label for="inputPositionName" class="form-control-label">ตำแหน่ง</label>
                          <input id="inputPositionName" type="text" class="form-control" />
                        </div>
                        <div class="col-2">
                          <div>
                            <input type="checkbox" id="checkboxPotal" class="form-control-label" value='1' checked disabled>
                            <label class="form-control-label" for="checkboxPotal">โอนย้ายภายใน</label>
                          </div>
                          <div>
                            <input type="checkbox" id="checkboxReferral" class="form-control-label" value='0'>
                            <label class="form-control-label" for="checkboxReferral">แนะนำคนภายนอก</label>
                          </div>
                        </div>
                        <div class="col-12" id="divBudget" style="display: none;">
                          <div class="row">
                            <div class="col-3">
                              <label for="inputCCA" class="form-control-label">Cost Center</label>
                              <input id="inputCCA" type="text" class="form-control" max="10" />
                            </div>
                            <div class="col-3">
                              <label for="inputGL" class="form-control-label">GL</label>
                              <input id="inputGL" type="text" class="form-control" max="6" />
                            </div>
                            <div class="col-3">
                              <label for="inputIO" class="form-control-label">Internal Order</label>
                              <input id="inputIO" type="text" class="form-control" max="12" />
                            </div>
                            <div class="col-3">
                              <div>
                                <label class="form-control-label" for=""></label>
                              </div>
                              <div>
                                <input type="checkbox" id="checkboxBudget" class="form-control-label" value='0'>
                                <label class="form-control-label" for="checkboxBudget">มีงบประมาณ</label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- <div class="col-12">
                            <label for="inputFile" class="form-control-label">File</label>
                            <input id="inputFile" type="file" class="form-control" />
                          </div> -->
                      </div>
                    </div>

                    <div class="col-12" style="border-style: inset">
                      <nav class="navbar navbar-dark bg-primary " style="display: flex; justify-content: center;">
                        Description / Qualification and Experience
                      </nav>
                      <div class="container mt-6 mb-4">
                        <div>
                          <textarea id="inputPositionDetail"></textarea>
                        </div>
                      </div>
                    </div>

                    <div class="col-12" style="width:100%;text-align:center;">
                      <button type="button" class="btn btn-primary btn-save" id="btnSave">สร้างประกาศ</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  // } else {
  ?>

  <!-- <div class="content" data-module="<?php print $this->router->fetch_class(); ?>">
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
                  <form>
                    <div class="row">
                      <div class="col-6">
                        <label for="inputStartDate" class="form-control-label">วันที่ลงประกาศ</label>
                        <input id="inputStartDate" type="date" class="form-control" min="2023-01-01" data-provide="datepicker" value="<?php print_r(date('Y-m-d', strtotime($data[0]['start_date']))); ?>" disabled />
                      </div>
                      <div class="col-6">
                        <label for="inputEndDate" class="form-control-label">วันที่สิ้นสุดประกาศ</label>
                        <input id="inputEndDate" type="date" class="form-control" min="2023-01-01" data-provide="datepicker" value="<?php print_r(date('Y-m-d', strtotime($data[0]['end_date']))); ?>" disabled />
                      </div>
                      <div class="col-12" style="border-style: inset">
                        <nav class="navbar navbar-dark bg-primary " style="display: flex; justify-content: center;">
                          HR Contract
                        </nav>
                        <div class="row">
                          <div class="col-6">
                            <label for="inputOwnerEmail" class="form-control-label">Email</label>
                            <input id="inputOwnerEmail" type="text" class="form-control" disabled value="<?php print_r($data[0]['owner_email']); ?>" />
                          </div>
                          <div class="col-6">
                            <label for="inputOwnerFullName" class="form-control-label">ชื่อ-สกุล</label>
                            <input id="inputOwnerFullName" type="text" class="form-control" disabled value="<?php print_r($data[0]['owner_fullname']); ?>" />
                          </div>
                          <div class="col-6">
                            <label for="inputOwnerPositionName" class="form-control-label">ตำแหน่ง</label>
                            <input id="inputOwnerPositionName" type="text" class="form-control" disabled value="<?php print_r($data[0]['owner_postion_name']); ?>" />
                          </div>
                          <div class="col-4">
                            <label for="inputOwnerPhone" class="form-control-label">เบอร์ติดต่อ</label>
                            <input id="inputOwnerPhone" type="text" class="form-control" value="<?php print_r($data[0]['owner_phone_number']); ?>" />
                          </div>
                          <div class="col-2">
                            <div>
                              <label class="form-control-label" for=""></label>
                            </div>
                            <div>
                              <input type="checkbox" id="checkboxOwner" class="form-control-label">
                              <label class="form-control-label" for="checkboxOwner">เปลี่ยนผู้ดูแล</label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-12" style="border-style: inset;">
                        <nav class="navbar navbar-dark bg-primary " style="display: flex; justify-content: center;">
                          Position Detail
                        </nav>
                        <div class="row">
                          <div class="col-6">
                            <label for="inputCompany" class="form-control-label">บริษัท</label>
                            <select id="inputCompany" class="form-control selectpicker" data-style="ripple-none select-with-transition" title="บริษัท">
                            </select>
                          </div>
                          <div class="col-6">
                            <label for="inputPlant" class="form-control-label">โรงงาน</label>
                            <select id="inputPlant" class="form-control selectpicker" data-style="ripple-none select-with-transition" title="โรงงาน">
                            </select>
                          </div>
                          <div class="col-12">
                            <label for="inputOrg" class="form-control-label">สังกัด</label>
                            <input id="inputOrg" type="text" class="form-control" value="<?php print_r($data[0]['org_name']); ?>" />
                          </div>
                          <div class="col-2">
                            <label for="inputPositionId" class="form-control-label">รหัสตำแหน่ง</label>
                            <input id="inputPositionId" type="text" class="form-control" max="8" value="<?php print_r($data[0]['postion_id']); ?>" />
                          </div>
                          <div class="col-8">
                            <label for="inputPositionName" class="form-control-label">ตำแหน่ง</label>
                            <input id="inputPositionName" type="text" class="form-control" value="<?php print_r($data[0]['positon_name']); ?>" />
                          </div>
                          <div class="col-2">
                            <div>
                              <input type="checkbox" id="checkboxPotal" class="form-control-label" value='1' checked disabled>
                              <label class="form-control-label" for="checkboxPotal">โอนย้ายภายใน</label>
                            </div>
                            <div>
                              <input type="checkbox" id="checkboxReferral" class="form-control-label" <?php $job_referral = $data[0]['job_referral'];
                                                                                                      print("value='$job_referral' ");
                                                                                                      print($job_referral == "1" ? " checked " : " ");
                                                                                                      ?>>
                              <label class="form-control-label" for="checkboxReferral">แนะนำคนภายนอก</label>
                            </div>
                          </div>
                          <div class="col-12" id="divBudget" style="display: <?php print($job_referral == "0" ? "none" : "block"); ?>;">
                            <div class="row">
                              <div class="col-3">
                                <label for="inputCCA" class="form-control-label">Cost Center</label>
                                <input id="inputCCA" type="text" class="form-control" max="10" value="<?php print_r($data[0]['cost_center']); ?>" />
                              </div>
                              <div class="col-3">
                                <label for="inputGL" class="form-control-label">GL</label>
                                <input id="inputGL" type="text" class="form-control" max="6" value="<?php print_r($data[0]['gl_code']); ?>" />
                              </div>
                              <div class="col-3">
                                <label for="inputIO" class="form-control-label">Internal Order</label>
                                <input id="inputIO" type="text" class="form-control" max="12" value="<?php print_r($data[0]['internal_order']); ?>" />
                              </div>
                              <div class="col-3">
                                <div>
                                  <label class="form-control-label" for=""></label>
                                </div>
                                <div>
                                  <input type="checkbox" id="checkboxBudget" class="form-control-label" <?php $budget = $data[0]['budget'];
                                                                                                        print("value='$budget' ");
                                                                                                        print($budget == "1" ? " checked " : " ");
                                                                                                        ?>>
                                  <label class="form-control-label" for="checkboxBudget">มีงบประมาณ</label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                          </div>
                        </div>
                      </div>

                      <div class="col-12" style="border-style: inset">
                        <nav class="navbar navbar-dark bg-primary " style="display: flex; justify-content: center;">
                          Description / Qualification and Experience
                        </nav>
                        <div class="container mt-6 mb-4">
                          <div>
                            <textarea id="inputPositionDetail"></textarea>
                          </div>
                        </div>
                      </div>

                      <div class="col-12" style="width:100%;text-align:center;">
                        <button type="button" class="btn btn-primary btn-update">แก้ไขประกาศ</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $(document).on('click', '.btn-update', function() {
          startDate = new Date(document.getElementById("inputStartDate").value);
          startDate = fn.formatDate(startDate);
          endDate = new Date(document.getElementById("inputEndDate").value);
          endDate = fn.formatDate(endDate);
          $.ajax({
            type: 'POST',
            url: base_url('/hr_recruit/hr/jobCreate/update_job'),
            // url: base_url('/hr/jobCreate/update_job'),
            data: {
              'id': '<?php print $data[0]['id']; ?>',
              'job_number': '<?php print $data[0]['job_number']; ?>',
              'start_date': startDate,
              'end_date': endDate,
              'job_portal': 1,
              'job_referral': document.getElementById("checkboxReferral").value,
              'company_code': document.getElementById("inputCompany").value,
              'plant_code': document.getElementById("inputPlant").value,
              'org_name': document.getElementById("inputOrg").value,
              'postion_id': document.getElementById("inputPositionId").value.trim(),
              'positon_name': document.getElementById("inputPositionName").value,
              'owner_email': document.getElementById("inputOwnerEmail").value,
              'owner_fullname': document.getElementById("inputOwnerFullName").value,
              'owner_postion_name': document.getElementById("inputOwnerPositionName").value,
              'owner_phone_number': document.getElementById("inputOwnerPhone").value,
              'cost_center': document.getElementById("inputCCA").value.trim(),
              'gl_code': document.getElementById("inputGL").value.trim(),
              'internal_order': document.getElementById("inputIO").value.trim(),
              'budget': document.getElementById("checkboxBudget").value,
              'position_detail': tinyMCE.get('inputPositionDetail').getContent(),
            },
            success: function(res, textStatus, jqXHR) {
              // console.log(res);
              fn.success(res, textStatus, jqXHR);
              window.location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
              console.log(jqXHR)
              console.log(errorThrown)
            }
          });
        })
      })
    </script> -->
<?php
  // }
} else {
  header("Location:" . base_url('/login'));
}
?>

<script type="text/javascript">
  $(document).ready(function() {

    tinymce.init({
      selector: 'textarea',
      // plugins: "advlist anchor autolink autoresize autosave charmap code codesample directionality emoticons fullscreen help image importcss insertdatetime link lists media nonbreaking pagebreak preview quickbars save searchreplace table tinydrive visualblocks visualchars wordcount",
      // plugins: "help link lists quickbars table wordcount",
      plugins: "link lists quickbars table wordcount",
      toolbar_mode: 'floating',
      menubar: 'edit format table',
      menu: {
        edit: {
          title: 'Edit',
          items: 'undo redo restoredraft | cut copy paste pastetext removeformat'
        },
      },
      setup: function(editor) {
        editor.on('init', function(e) {
          <?php if (isset($_GET['edit']) || isset($_GET['id'])) { ?>
            editor.setContent('<?php print_r($data[0]['position_detail']) ?>');
          <?php } ?>
        });
      },
      branding: false,
      toolbar: "fontfamily fontsize backcolor forecolor bold italic strikethrough underline bullist numlist alignleft aligncenter alignright alignjustify indent outdent lineheight",
      // toolbar: "aligncenter alignjustify alignleft alignnone alignright| anchor | blockquote blocks | backcolor | bold | copy | cut | fontfamily fontsize forecolor h1 h2 h3 h4 h5 h6 hr indent | italic | language | lineheight | newdocument | outdent | paste pastetext | print | redo | remove removeformat | selectall | strikethrough | styles | subscript superscript underline | undo | visualaid | a11ycheck advtablerownumbering typopgraphy anchor restoredraft casechange charmap checklist code codesample addcomment showcomments ltr rtl editimage fliph flipv imageoptions rotateleft rotateright emoticons export footnotes footnotesupdate formatpainter fullscreen help image insertdatetime link openlink unlink bullist numlist media mergetags mergetags_list nonbreaking pagebreak pageembed permanentpen preview quickimage quicklink quicktable cancel save searchreplace spellcheckdialog spellchecker | table tablecellprops tablecopyrow tablecutrow tabledelete tabledeletecol tabledeleterow tableinsertdialog tableinsertcolafter tableinsertcolbefore tableinsertrowafter tableinsertrowbefore tablemergecells tablepasterowafter tablepasterowbefore tableprops tablerowprops tablesplitcells tableclass tablecellclass tablecellvalign tablecellborderwidth tablecellborderstyle tablecaption tablecellbackgroundcolor tablecellbordercolor tablerowheader tablecolheader | tableofcontents tableofcontentsupdate | template typography | insertfile | visualblocks visualchars | wordcount",
      // help_tabs: [{
      //   name: 'custom_shortcuts',
      //   title: 'ปุ่มลัด',
      //   items: [{
      //     type: 'htmlpanel',
      //     html: '<table class="tox-dialog__table mce-item-table" data-alloy-tabstop="true" data-mce-tabindex="-1" data-mce-selected="1"><thead><tr><th>รายละเอียด</th><th>ปุ่ม</th></tr></thead><tbody><tr><td>ตัวหนา</td><td>Ctrl + B</td></tr><tr><td>ตัวเอียง</td><td>Ctrl + I</td></tr><tr><td>เส้นใต้</td><td>Ctrl + U</td></tr><tr><td>Select all</td><td>Ctrl + A</td></tr><tr><td>Redo</td><td>Ctrl + Y or Ctrl + Shift + Z</td></tr><tr><td>Undo</td><td>Ctrl + Z</td></tr>',
      //   }]
      // }, ],

      // หา font จาก https://fonts.google.com/?subset=thai แก้ไขทั้ง tinyMce และ pdf
      // jobCreate, Detail, Pdf, FontVariables
      // content_style: "@import url('https://fonts.googleapis.com/css2?family=Sarabun'); @import url('https://fonts.googleapis.com/css2?family=Garuda');",
      content_style: "@import url('https://fonts.googleapis.com/css2?family=Sarabun'););",
      font_family_formats: "Angsana New=angsana; Tahoma=tahoma,arial,helvetica,sans-serif; Thai Sarabun=sarabun; Garuda=garuda; Browallia = browallia; Cordia = cordia;",
    });
    fn.get_Company();
    fn.get_Plant();
    $(document).on('click', '#checkboxOwner', function() {
      if ($(this).is(":checked")) {
        $("#checkboxOwner").val(1);
        document.getElementById("inputOwnerEmail").removeAttribute("disabled");
        document.getElementById("inputOwnerFullName").removeAttribute("disabled");
        document.getElementById("inputOwnerPositionName").removeAttribute("disabled");
        document.getElementById("inputOwnerPhone").removeAttribute("disabled");
      } else {
        $("#checkboxOwner").val(0);
      }
    })

    $(document).on('click', '#checkboxReferral', function() {
      if ($(this).is(":checked")) {
        $("#checkboxReferral").val(1);
        document.getElementById("divBudget").style.display = "block"
      } else {
        $("#checkboxReferral").val(0);
        document.getElementById("divBudget").style.display = "none"
      }
    })
    $(document).on('click', '#checkboxBudget', function() {
      if ($(this).is(":checked")) {
        $("#checkboxBudget").val(1);
      } else {
        $("#checkboxBudget").val(0);
      }
    })
    $(document).on('click', '.btn-save', function() {
      fn.gen_runno();
    })

    <?php if (isset($_GET['edit'])) { ?>
      $("#btnSave").removeClass().addClass("btn btn-primary btn-update");
      $('#btnSave').text('แก้ไขประกาศ');
      document.getElementById("divEnddate").style.display = "block"
      $("#inputStartDate").val("<?php print_r(date('Y-m-d', strtotime($data[0]['start_date']))); ?>");
      $("#inputEndDate").val("<?php print_r(date('Y-m-d', strtotime($data[0]['end_date']))); ?>");

      $("#inputOwnerEmail").val("<?php print_r($data[0]['owner_email']) ?>");
      $("#inputOwnerFullName").val("<?php print_r($data[0]['owner_fullname']) ?>");
      $("#inputOwnerPositionName").val("<?php print_r($data[0]['owner_postion_name']) ?>");
      $("#inputOwnerPhone").val("<?php print_r($data[0]['owner_phone_number']) ?>");

      $("#inputOrg").val("<?php print_r($data[0]['org_name']) ?>");
      $("#inputPositionId").val("<?php print_r($data[0]['postion_id']) ?>");
      $("#inputPositionName").val("<?php print_r($data[0]['positon_name']) ?>");
      job_referral = '<?php print_r($data[0]['job_referral']) ?>';
      $("#checkboxReferral").val(job_referral);
      if (job_referral == "1") {
        $("#checkboxReferral").attr('checked', 'checked')
        document.getElementById("divBudget").style.display = "block"
      } else {
        document.getElementById("divBudget").style.display = "none"
      }
      $("#inputCCA").val("<?php print_r($data[0]['cost_center']) ?>");
      $("#inputGL").val("<?php print_r($data[0]['gl_code']) ?>");
      $("#inputIO").val("<?php print_r($data[0]['internal_order']) ?>");
      budget = '<?php print_r($data[0]['budget']) ?>';
      $("#checkboxBudget").val(budget);
      if (budget == "1") {
        $("#checkboxBudget").attr('checked', 'checked')
      }

      $(document).on('click', '.btn-update', function() {
        startDate = new Date(document.getElementById("inputStartDate").value);
        startDate = fn.formatDate(startDate);
        endDate = new Date(document.getElementById("inputEndDate").value);
        endDate = fn.formatDate(endDate);
        // console.log('url = ' + base_url('/hr/update_job'));
        // console.log('id = <?php print $data[0]['id']; ?>');
        // console.log('job_number = <?php print $data[0]['job_number']; ?>');
        // console.log("ownerEmail = " + document.getElementById("inputOwnerEmail").value);
        // console.log("ownerFullName = " + document.getElementById("inputOwnerFullName").value);
        // console.log("ownerPositionName = " + document.getElementById("inputOwnerPositionName").value);
        // console.log("ownerPhone  = " + document.getElementById("inputOwnerPhone").value);
        // console.log("company = " + document.getElementById("inputCompany").value);
        // console.log("plant = " + document.getElementById("inputPlant").value);
        // console.log("org = " + document.getElementById("inputOrg").value);
        // console.log("positionId = " + document.getElementById("inputPositionId").value);
        // console.log("positionName = " + document.getElementById("inputPositionName").value);
        // console.log("positionDetail = " + tinyMCE.get('inputPositionDetail').getContent());
        // console.log("referral = " + document.getElementById("checkboxReferral").value);
        // console.log("portal = 1");
        // console.log("cca = " + document.getElementById("inputCCA").value);
        // console.log("gl = " + document.getElementById("inputGL").value);
        // console.log("io = " + document.getElementById("inputIO").value);
        // console.log("budget = " + document.getElementById("checkboxBudget").value);
        // console.log("startDate =" + startDate);
        // console.log("endDate =" + endDate);
        $.ajax({
          type: 'POST',
          // url: base_url('/hr_recruit/hr/jobCreate/update_job'),
          url: base_url('/hr/jobCreate/update_job'),
          data: {
            'id': '<?php print $data[0]['id']; ?>',
            'job_number': '<?php print $data[0]['job_number']; ?>',
            'start_date': startDate,
            'end_date': endDate,
            'job_portal': 1,
            'job_referral': document.getElementById("checkboxReferral").value,
            'company_code': document.getElementById("inputCompany").value,
            'plant_code': document.getElementById("inputPlant").value,
            'org_name': document.getElementById("inputOrg").value,
            'postion_id': document.getElementById("inputPositionId").value.trim(),
            'positon_name': document.getElementById("inputPositionName").value,
            'owner_email': document.getElementById("inputOwnerEmail").value,
            'owner_fullname': document.getElementById("inputOwnerFullName").value,
            'owner_postion_name': document.getElementById("inputOwnerPositionName").value,
            'owner_phone_number': document.getElementById("inputOwnerPhone").value,
            'cost_center': document.getElementById("inputCCA").value.trim(),
            'gl_code': document.getElementById("inputGL").value.trim(),
            'internal_order': document.getElementById("inputIO").value.trim(),
            'budget': document.getElementById("checkboxBudget").value,
            'position_detail': tinyMCE.get('inputPositionDetail').getContent(),
          },
          success: function(res, textStatus, jqXHR) {
            // console.log(res);
            fn.success(res, textStatus, jqXHR);
            window.location.reload();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR)
            console.log(errorThrown)
          }
        });
      })
    <?php } else if (isset($_GET['id'])) { ?>
      $("#inputOrg").val("<?php print_r($data[0]['org_name']) ?>");
      $("#inputPositionId").val("<?php print_r($data[0]['postion_id']) ?>");
      $("#inputPositionName").val("<?php print_r($data[0]['positon_name']) ?>");
      // $("#").val('<?php print_r($data[0]['position_detail']) ?>');
    <?php } ?>

  })
  Date.isLeapYear = function(year) {
    return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0));
  };
  Date.getDaysInMonth = function(year, month) {
    return [31, (Date.isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
  };
  Date.prototype.isLeapYear = function() {
    return Date.isLeapYear(this.getFullYear());
  };
  Date.prototype.getDaysInMonth = function() {
    return Date.getDaysInMonth(this.getFullYear(), this.getMonth());
  };
  Date.prototype.addMonths = function(value) {
    var n = this.getDate();
    this.setDate(1);
    this.setMonth(this.getMonth() + value);
    this.setDate(Math.min(n, this.getDaysInMonth()));
    return this;
  };





  var fn = {

    get_Company: function() {
      var HTML = "";
      $.ajax({
        type: 'GET',
        // url: base_url('/hr_recruit/hr/jobCreate/getCompany'),
        url: base_url('/hr/jobCreate/getCompany'),
        success: function(res, textStatus, jqXHR) {
          $.each(res.success.data, function(index, value) {
            HTML += '<option value="' + value.company_code + '">' + value.company_code + " : " + value.company_name + '</option>';
          });
          $("#inputCompany").html(HTML).selectpicker('refresh');
          <?php if (isset($_GET['edit'])) { ?>
            $("#inputCompany").val("<?php print $data[0]['company_code'] ?>").selectpicker('refresh');
          <?php } ?>
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.debug(jqXHR);
          console.debug(errorThrown);
          fn.error(jqXHR, textStatus, errorThrown);
        }


      });
    },

    get_Plant: function() {
      var HTML = "";
      $.ajax({
        type: 'GET',
        // url: base_url('/hr_recruit/hr/jobCreate/getPlant'),
        url: base_url('/hr/jobCreate/getPlant'),
        success: function(res, textStatus, jqXHR) {
          $.each(res.success.data, function(index, value) {
            HTML += '<option value="' + value.plant_code + '">' + value.plant_code + " : " + value.plant_name + '</option>';
          });
          $("#inputPlant").html(HTML).selectpicker('refresh');
          <?php if (isset($_GET['edit'])) { ?>
            $("#inputPlant").val("<?php print $data[0]['plant_code'] ?>").selectpicker('refresh');
          <?php } ?>
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.debug(jqXHR);
          console.debug(errorThrown);
          fn.error(jqXHR, textStatus, errorThrown);
        }


      });
    },

    gen_runno: function(params) {
      $.ajax({
        type: 'POST',
        // url: base_url('/hr_recruit/hr/jobCreate/gen_runno'),
        url: base_url('/hr/jobCreate/gen_runno'),
        data: {
          'company_code': document.getElementById("inputCompany").value,
        },
        success: function(res, textStatus, jqXHR) {
          $.each(res.success.data, function(index, value) {
            console.log(value);
            var company_code = value.company_code;
            var year = value.year;
            var month = value.month;
            var day = value.day;
            var number = ("000" + value.number).slice(-3);

            var run_number = "J" + company_code + year + month + day + "N" + number;
            console.log("Gen : " + run_number);
            $("#jobNumber").val(run_number)
            fn.sendDetail(run_number);
          })
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.debug(jqXHR);
          console.debug(errorThrown);
        }
      });
    },

    sendDetail: function(params) {
      startDate = document.getElementById("inputStartDate").value;
      endDate = new Date(startDate).addMonths(1);
      endDate = fn.formatDate(endDate);
      startDate = new Date(startDate);
      startDate = fn.formatDate(startDate);

      var inputStartDate = document.getElementById("inputStartDate").value != "" ? document.getElementById("inputStartDate").value : "";
      var inputOwnerEmail = document.getElementById("inputOwnerEmail").value != "" ? document.getElementById("inputOwnerEmail").value : "false";
      var inputOwnerFullName = document.getElementById("inputOwnerFullName").value != "" ? document.getElementById("inputOwnerFullName").value : "false";
      var inputOwnerPositionName = document.getElementById("inputOwnerPositionName").value != "" ? document.getElementById("inputOwnerPositionName").value : "false";
      var inputOwnerPhone = document.getElementById("inputOwnerPhone") !== "" ? document.getElementById("inputOwnerPhone").value : "false";
      var inputCompany = document.getElementById("inputCompany").value != "" ? document.getElementById("inputCompany").value : "false";
      var inputPlant = document.getElementById("inputPlant").value != "" ? document.getElementById("inputPlant").value : "false";
      var inputOrg = document.getElementById("inputOrg").value != "" ? document.getElementById("inputOrg").value : "false";
      var inputPositionId = document.getElementById("inputPositionId") !== "" ? document.getElementById("inputPositionId").value : "false";

      var inputPositionName = document.getElementById("inputPositionName").value != "" ? document.getElementById("inputPositionName").value : "false";
      var inputPositionDetail = document.getElementById("inputPositionDetail").value != "" ? document.getElementById("inputPositionDetail").value : "false";


      if (inputStartDate == "" ||
        inputOwnerEmail == "" ||
        inputOwnerFullName == "" ||
        inputOwnerPositionName == "" ||
        inputOwnerPhone == "" ||
        inputCompany == "" ||
        inputPlant == "" ||
        inputOrg == "" ||
        inputPositionId == "" ||
        inputPositionName == "xxxxxxxxxxxxxxxxxxxxxxxxxx" &&
        inputPositionDetail == ""
      ) {
        alert("กรุณากรอกข้อมูลให้ครบถ้วน !!!");
      } 
    

      $.ajax({
        type: 'POST',
        url: base_url('/hr_recruit/hr/jobCreate/create_job'),
        //url: base_url('/hr/jobCreate/create_job'),
        // data: dataSet,
        data: {
          'job_number': params,
          'start_date': startDate,
          'end_date': endDate,
          'job_portal': 1,
          'job_referral': document.getElementById("checkboxReferral").value,
          'company_code': document.getElementById("inputCompany").value,
          'plant_code': document.getElementById("inputPlant").value,
          'org_name': document.getElementById("inputOrg").value,
          'postion_id': document.getElementById("inputPositionId").value.trim(),
          'positon_name': document.getElementById("inputPositionName").value,
          'owner_email': document.getElementById("inputOwnerEmail").value,
          'owner_fullname': document.getElementById("inputOwnerFullName").value,
          'owner_postion_name': document.getElementById("inputOwnerPositionName").value,
          'owner_phone_number': document.getElementById("inputOwnerPhone").value,
          'cost_center': document.getElementById("inputCCA").value.trim(),
          'gl_code': document.getElementById("inputGL").value.trim(),
          'internal_order': document.getElementById("inputIO").value.trim(),
          'budget': document.getElementById("checkboxBudget").value,
          'position_detail': tinyMCE.get('inputPositionDetail').getContent(),
        },

        success: function(res, textStatus, jqXHR) {
          // console.log(res);
          fn.success(res, textStatus, jqXHR);
          window.location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(jqXHR)
          console.log(errorThrown)
        }
      });

    },


    formatDate: function(date) {
      date = new Date(date);
      year = date.getFullYear();
      month = date.getMonth() + 1;
      day = date.getDate();
      month = month.length < 2 ? "0" + month : month;
      day = day.length < 2 ? "0" + day : day;
      dateReturn = year + "-" + month + "-" + day;
      return dateReturn
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