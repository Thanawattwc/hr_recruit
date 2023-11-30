<div class="content" data-module="<?php print $this->router->fetch_class(); ?>">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-stats" style="padding: 3%;">
          <div class="row">
            <div class="col-4">
              <p>
                <strong>ตำแหน่ง</strong> : <?php print_r($data[0]['positon_name']); ?>
              </p>
            </div>
            <div class="col-4">
              <p>
                <strong>สังกัด</strong> : <?php print_r($data[0]['org_name']); ?>
              </p>
            </div>
            <div class="col-4" style="text-align:right;">
              <input id="job_number" name="job_number" value="<?php print_r($data[0]['job_number']); ?>" disabled />
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
            <div style="width:100%; text-align:right;">
              <input type="button" class="btn btn-danger btn-pdf" id="load_PDF" value="PDF2"></input>
              <button type="button" class="btn btn-warning btn-portal">โอนย้ายภายใน</button>
              <button type="button" class="btn btn-primary btn-referral">แนะนำคนภายนอก</button>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal-container">
  <div class="modal fade" id="modal-portal" tabindex="1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Internal Recruit แนวปฏิบัติการสรรหาบุคลากรจากภายใน</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <u><strong>วัตถุประสงค์ของโครงการ</strong></u>
          <ul>
            <li>เพื่อให้พนักงานมีโอกาสเจริญก้าวหน้าในหน้าที่การงาน มีโอกาสใช้ความสามารถที่มีอยู่ในหลากหลายหน่วยงาน</li>
          </ul>
          <u><strong>ข้อพิจารณาในการสมัคร</strong></u>
          <ul>
            <li>ตำแหน่งงานว่างของกลุ่มมิตรผลระดับ 4-10 ที่เปิดรับสมัครในระบบ Mymitrphol เท่านั้น</li>
            <li>พนักงานที่สนใจควรอยู่ในคุณสมบัติ ดังนี้ เป็นพนักงานประจำ ระดับ 4-10 ขึ้นไป</li>
            <li>มีอายุงานในสังกัดปัจจุบันไม่น้อยกว่า 1 ปี</li>
            <li>มีความรู้ ประสบการณ์ ความสามารถ เหมาะสมกับตำแหน่งที่เปิดรับสมัคร</li>
          </ul>
          <u><strong>ขั้นตอนการสมัคร</strong></u>
          <ul>
            <li>พนักงานที่มีความประสงค์จะสมัครโอนย้ายไปในตำแหน่งงานที่ลงประกาส ขอให้พิจารณาในคุณสมบัติที่ระบุไว้ให้ชัดเจน และกรอกข้อมูลตามไฟล์แนบและส่งมาในเมล์ถึงเจ้าหน้าที่สรรหาที่ดูแลตำแหน่งงานนั้นๆ จากระบบ MyMitrphol</li>
          </ul>
          <u><strong>ขั้นตอนการดำเนินการ</strong></u>
          <ul>
            <li>เมื่อทีมสรรหาของแต่ละบริษัทได้รับ Email ของพนักงานเรียบร้อย ศูนย์สรรหาบุคลากรจะรวบรวมรายชื่อพนักงานทั้งหมดที่ต้องการโอนย้ายไปแต่ละตำแหน่งมาพิจารณาในข้อมูลเบื้องต้น และโทรติดต่อพนักงานเพื่อสอบถาม ความรู้ ประสบการณ์ และแจ้งให้พนักงานทราบต่อไปถึงขั้นตอนในการทดสอบ สัมภาษณ์งาน และเสนอ HRC พิจารณาในขั้นตอนสุดท้าย</li>
          </ul>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-danger btn-closeModel" data-dismiss="modal" value="ไม่ยอมรับ">
          <input type="button" class="btn btn-primary btn-confirm" value="ยอมรับ">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal-container">
  <div class="modal fade" id="modal-referral" tabindex="1" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Employee Referral Program</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <u><strong>วัตถุประสงค์ของโครงการ</strong></u>
          <ul>
            <li>เพื่อเพิ่มช่องทางการสรรหาและทางเลือกของผู้สมัครงาน ผ่านประสบการณ์จากพนักงานในองค์กร เพื่อส่งเสริมให้พนักงานเป็น Mitr Phol Employer Brand Ambassador</li>
          </ul>
          <u><strong>ข้อพิจารณาในการสมัคร</strong></u>
          <ul>
            <li>ผู้แนะนำ : เป็นพนักงานประจำของกลุ่มมิตรผล ตั้งแต่ระดับ 1-9 ยกเว้นพนักงานที่รับผิดชอบสรรหาพนักงาน</li>
            <li>ผู้สมัครงาน : ในตำแหน่งพนักงานประจำระดับ 4-10 ที่ลงประกาศในระบบ Mymitrphol และเท่านั้น</li>
            <li>โดยผู้แนะนำสามารถ download ข้อมูลตำแหน่งงานแบบ PDF เพื่อส่งต่อให้เพื่อนหรือคนรู้จัก หรือ ถ้าผู้แนะนำมีประวัติของผู้สมัครที่เหมาะสมกับตำแหน่งงานสามารถแนบมาในระบบได้เลย</li>
            <li>เมื่อทีมสรรหาของแต่ละบริษัทได้รับ Email ของผู้แนะนำเรียบร้อย จะคัดเลือกปะวัติที่เหมาะสมส่งให้ Hiring manager สัมภาษณ์และพิจารณาตามขั้นตอนต่อไป</li>
          </ul>
          <u><strong>รางวัลและเงื่อนไข</strong></u>
          <ul>
            <li>เมื่อผู้สมัครงานผ่านการคัดเลือกเข้าทำงานและผ่านทดลองงาน ผู้แนะนำจึงจะได้รับค่าตอบแทนเป็น Gift Card หรือ Gift Voucher (ขึ้นอยู่กับงบประมาณฝ่ายบุคคลของแต่ละธุรกิจ) ต่อ ผู้สมัครที่ผ่านทดลองงาน 1 คน </li>
            <li>ในกรณีที่ผู้สมัครส่งใบสมัครผ่านทางช่องทางอื่นในตำแหน่งเดียวกันและเจ้าหน้าที่ฝ่ายบุคคลต้นสังกัดที่ดูแลการสรรหาได้เคยเชิญสัมภาษณ์แล้ว จะไม่ถือว่าเป็นการแนะนำผ่านตามโครงการ Employee Referral Program และผู้แนะนำจะไม่ได้รับค่าตอบแทนจากการแนะนำ</li>
          </ul>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-danger btn-closeModel" data-dismiss="modal" value="ไม่ยอมรับ">
          <input type="button" class="btn btn-primary btn-confirm" value="ยอมรับ">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal-container">
  <div class="modal fade" id="modal-detail" tabindex="2" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="card card-stats card-in-modal">
          <div class="modal-header">
            <h4 class="modal-title" id="detail_title"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <form accept-charset="utf-8" method="POST">
              <div class="row">
                <div class="form-group form-select bmd-form-group col-12" id="empfind">
                  <label class="form-control-label bmd-label-floating" for="txtUsername">ค้นหา</span></label>
                  <select id="txtUsername" name="username" class="selectpicker with-ajax" data-style="ripple-none select-with-transition" data-width="100%" data-live-search="true" title="รายชื่อ" required>
                  </select>
                </div>
                <div class="col-12" style="display: none;" id="empData">
                  <div class="row">
                    <div class="form-group col-3">
                      <label class="form-control-label" for="input_emp_id">รหัสพนักงาน</label>
                      <input class="form-control" id="input_emp_id" name="emp_id" readonly="readonly">
                    </div>

                    <div class="form-group col-6">
                      <label class="form-control-label" for="input_full_name">ชื่อ-สกุล</label>
                      <input class="form-control" id="input_full_name" name="full_name" readonly="readonly">
                    </div>

                    <div class="form-group col-3">
                      <label class="form-control-label" for="input_user_name">username</label>
                      <input class="form-control" id="input_user_name" name="user_name" readonly="readonly">
                    </div>

                    <div class="form-group col-12">
                      <label class="form-control-label" for="input_department">สังกัด</label>
                      <input class="form-control" id="input_department" name="department" readonly="readonly">
                    </div>

                    <div class="form-group col-12">
                      <label class="form-control-label" for="input_position_name">ตำแหน่ง</label>
                      <input class="form-control" id="input_position_name" name="position_name" readonly="readonly">
                    </div>

                    <div class="form-group col-6">
                      <label class="form-control-label" for="input_email">email</label>
                      <input class="form-control" id="input_email" name="email" readonly="readonly">
                    </div>

                    <div class="form-group col-6">
                      <label class="form-control-label" for="input_phone">เบอร์โทร</label>
                      <input class="form-control" id="input_phone" name="phone" max="20">
                    </div>
                    <div class="form-group col-2">
                      <label class="form-control-label" for="input_company_code">รหัสบริษัท</label>
                      <input class="form-control" id="input_company_code" name="company_code" readonly="readonly">
                    </div>

                    <div class="form-group col-4">
                      <label class="form-control-label" for="input_company_name">ชื่อบริษัท</label>
                      <input class="form-control" id="input_company_name" name="company_name" readonly="readonly">
                    </div>

                    <div class="form-group col-2">
                      <label class="form-control-label" for="input_plant_code">รหัสโรงงาน</label>
                      <input class="form-control" id="input_plant_code" name="plant_code" readonly="readonly">
                    </div>

                    <div class="form-group col-4">
                      <label class="form-control-label" for="input_plant_name">ชื่อโรงงาน</label>
                      <input class="form-control" id="input_plant_name" name="plant_name" readonly="readonly" disabled>
                    </div>
                  </div>
                </div>
                <input id="inputType" type="hidden" style="width:100%" disabled />
                <div class="form-group col-12">
                  <div class="form-group form-file-upload form-file-simple bmd-form-group">
                    <label class="form-control-label bmd-label-floating" for="input_cv">แนบ CV</label>
                    <input type="file" multiple="" class="inputFileHidden" id="input_cv" name="input_cv">
                    <div class="input-group">
                      <input type="text" class="form-control inputFileVisible">
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-fab btn-round btn-primary">
                          <span class="material-icons">attach_file</span>
                        </button>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                </div>
                <div class="col-6 text-left">
                  <input type="button" class="btn btn-danger btn-closeModel" data-dismiss="modal" value="ยกเลิก">
                  <input type="button" class="btn btn-primary btn-send" value="ส่งรายการ">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('click', '#load_PDF', function() {
      window.open(base_url('Detail/convertpdf?id=' + <?php print_r($data[0]['id']); ?>), "_blank");
    })

    $(document).on('click', '.btn-referral', function() {
      $("#inputType").val("0");
      $('#modal-referral').modal('show');
    })
    $(document).on('click', '.btn-portal', function() {
      $("#inputType").val("1");
      $('#modal-portal').modal('show');
    })
    $(document).on('click', '.btn-confirm', function() {
      if ($("#inputType").val() == '0') {
        $('#modal-referral').modal('hide');
        document.getElementById("detail_title").innerHTML = "รายละเอียดพนักงานที่จะแนะนำ"
      } else if ($("#inputType").val() == '1') {
        $('#modal-portal').modal('hide');
        document.getElementById("detail_title").innerHTML = "รายละเอียดพนักงานที่จะโอนย้าย"
      }
      fn.getEmpData();
      $('#modal-detail').modal('show');
    })

    $(document).on('click', '.btn-send', function() {
      fn.sendData();
    })
    
  })

  var fn = {
 

    sendData: function() {
      sendData = {
        "job_number": $('#job_number').val(),
        "emp_id": $('#input_emp_id').val(),
        "fullname": $('#input_full_name').val(),
        "user_name": $('#input_user_name').val(),
        "email": $('#input_email').val(),
        "phone": $('#input_phone').val(),
        "company_code": $('#input_company_code').val(),
        "company_name": $('#input_company_name').val(),
        "plant_code": $('#input_plant_code').val(),
        "plant_name": $('#input_plant_name').val(),
        "org_name": $('#input_department').val(),
        "position_name": $('#input_position_name').val(),
        "file_path": "path/filename.pdf",
        "portal": $('#inputType').val(),
      }


      $.ajax({
        type: "POST",
        url: base_url("/detail/send"),
        data: sendData,
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