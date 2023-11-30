<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-stats">
          <div class="container-fluid">
            <div class="row row-cols-4">
              <div class="col-sm-2 col-lg-2">
                <label class="form-control-label bmd-label-floating">สถานที่ปฎิบัติงาน</label>
                <select id="company_code" name="companyInput" class="form-control selectpicker" data-style="ripple-none select-with-transition" data-width="100%" title="-- กรุณาเลือก --">
                </select>
              </div>

              <div class="col-sm-2 col-lg-2">
                <label class="form-control-label bmd-label-floating">สังกัด</label>
                <select id="orgInput" name="orgInput" class="form-control selectpicker" data-style="ripple-none select-with-transition" data-width="100%" title="-- กรุณาเลือก --">
                </select>
              </div>

              <div class="col-sm-2 col-lg-2">
                <label class="form-control-label bmd-label-floating">โรงงาน</label>
                <select id="locationInput" name="" class="form-control selectpicker" data-style="ripple-none select-with-transition" data-width="100%" title="-- กรุณาเลือก --">

                </select>
              </div>

              <div class="col-sm-2 col-lg-2">
                <label class="form-control-label bmd-label-floating">สถานะรายการ</label>
                <select id="statusInput" name="statusInput" class="form-control selectpicker" data-style="ripple-none select-with-transition" data-width="100%" title="-- กรุณาเลือก --">
                  <option value="Online" id="Online">Online</option>
                  <option value="Offiline" id="Offiline">Offiline</option>
                  <option value="Close" id="Close">Close</option>
                </select>

                </select>
              </div>
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-search">ค้นหา</button>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="table-container">
              <div class="table-responsive-lg">
                <table id='testData' class="table table-hover table-bordered display">
                  <!-- <table id='testData' class="table table-hover table-bordered display"> -->

                  <thead>
                    <div class="card-category d-flex justify-content-between align-items-center">

                      <p></p>
                      <p>รายการประกาศงาน</p>
                      <p></p>
                    </div>

                    <tr>
                      <th class="text-center">ลำดับ</th>
                      <th class="text-center">Position ID</th>
                      <th class="text-center">ตำแหน่งงาน</th>
                      <th class="text-center">สังกัด</th>
                      <th class="text-center">สถานที่ทำงาน</th>
                      <th class="text-center">วันที่ลงประกาศ</th>
                      <th class="text-center">จำนวนวันที่เหลือ</th>
                      <th class="text-center">Report</th>
                      <th class="text-center">สถานะรายการ</th>
                      <th class="text-center col-action">
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    print '<tr class="no-data">';
                    print '<td colspan="11" class="text-danger text-center">ไม่พบข้อมูล</tr>';
                    print '</tr>';
                    ?>
                  </tbody>
                </table>
              </div>
            </div>

          </div>

          <!-- <div class="col-12">
            <div class="table-container" id='listDiv'>
              <table id="documentData" class="table table-hover table-bordered display">
                <thead>
                  <tr>
                    <th class="text-center">ลำดับ</th>
                    <th class="text-center">Position ID</th>
                    <th class="text-center">ตำแหน่งงาน</th>
                    <th class="text-center">สังกัด</th>
                    <th class="text-center">สถานที่ทำงาน</th>
                    <th class="text-center">วันที่ลงประกาศ</th>
                    <th class="text-center">จำนวนวันที่เหลือ</th>
                    <th class="text-center">Report</th>
                    <th class="text-center">สถานะรายการ</th>
                  </tr>
                </thead>

              </table>

            </div>
          </div> -->

        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    // $(document).ready(fn.get_Company);
    // $(document).ready(fn.get_Location);
    // $(document).ready(fn.get_Org);
    $(document).on('click', '.btn-search', fn.search)
    // $(document).ready(fn.test());
    fn.test();
    $(document).on('change', '#companyInput', function() {
      // test = document.getElementById("companyInput").value 
      // console.log('companyInput => ' + test);
      fn.test();
    })

  })



  var fn = {

    // get_Company: function() {
    //   var obj = $(this);
    //   var HTML = "";
    //   i = 0;
    //   // console.log('Testcompany');
    //   $.ajax({
    //     type: 'GET',
    //     // url: base_url('sample/search_emp'),
    //     // url: window.location + '/search_emp',
    //     url: window.location + '/getCompany',

    //     success: function(res, textStatus, jqXHR) {
    //       // console.log(res);
    //       //   document.getElementById('companyInput').innerHTML;
    //       $.each(res.success.data, function(index, value) {
    //         HTML += '<option value="' + value.company_code + '">' + value.company_code + " : " + value.company_name + '</option>';
    //       });
    //       $("#companyInput").html(HTML).selectpicker('refresh');
    //     },
    //     error: function() {
    //       console.log('error');
    //     }


    //   });
    // },

    // get_Location: function() {
    //   var obj = $(this);
    //   var HTML = "";
    //   i = 0;
    //   // console.log('Testlompany');
    //   $.ajax({
    //     type: 'GET',
    //     // url: base_url('/JobCreate/getlocation'),
    //     // url: '<?php echo base_url("jobList/getLocation"); ?>',
    //     url: window.location + '/getLocation',
    //     success: function(res, textStatus, jqXHR) {
    //       // console.log(res);
    //       // document.getElementById('locationInput').innerHTML;
    //       $.each(res.success.data, function(index, value) {
    //         HTML += '<option value="' + value.location_code + '">' + value.location_code + " : " + value.location_name + '</option>';
    //       });
    //       $("#locationInput").html(HTML).selectpicker('refresh');
    //     },
    //     error: function() {
    //       console.log('error')
    //     }


    //   });
    // },
    // get_Org: function(params) { //done
    //   var obj = $(this);
    //   var HTML = "";
    //   i = 0;
    //   // console.log('test');
    //   $.ajax({
    //     type: 'GET',
    //     url: window.location.href + '/org_name', // dropdow ตรวจสอบรายการ
    //     success: function(res, textStatus, jqXHR) {
    //       // console.log(res);
    //       // if (res.success.data == false) {
    //       //   alert("ไม่พบข้อมูล");
    //       // } else {
    //       // document.getElementById('txtdropPO').innerHTML = 'รายการใบขอสั่งซื้อที่สร้าง';
    //       $.each(res.success.data, function(index, value) {
    //         // console.log(res)
    //         HTML += '<option value="' + value.org_name + '" >' + value.org_name + '</option>';
    //       });

    //       $("#orgInput").html('').append(HTML).selectpicker('refresh');
    //       // }
    //     },
    //     error: function() {
    //       console.log('error');
    //     }

    //   });
    // },

    test: function() {
      // var companyInput = document.getElementById("company_code").value ? document.getElementById("company_code") : false;
      // var orgInput = document.getElementById("orgInput").value == "" ? document.getElementById("orgInput") : false;
      // var plantInput = document.getElementById("locationInput").value == "" ? document.getElementById("locationInput") : false;
      datatesting = [];
      if (document.getElementById("company_code").value) {
        datatesting['company'] = document.getElementById("company_code").value;
      }
      if (document.getElementById("locationInput").value) {
        datatesting['plant'] = document.getElementById("locationInput").value;
      }
      if (document.getElementById("orgInput").value) {
        datatesting['org'] = document.getElementById("orgInput").value;
      }
      console.log(datatesting);
      $.ajax({
        type: 'POST',
        url: window.location + '/test', // dropdow ตรวจสอบรายการ
        data: {
          'a': 'a',
          'datatesting': datatesting
        },
        success: function(res, textStatus, jqXHR) {
          // console.log(res.success.data);
          datatest = res.success.data;
          company = "";
          plant = "";
          org = "";
          $.each(datatest.company, function(index, value) {
            company += '<option value="' + value.company_code + '">' + value.company_code + " : " + value.company_name + '</option>';
          });
          $.each(datatest.location, function(index, value) {
            plant += '<option value="' + value.location_code + '">' + value.location_code + " : " + value.location_name + '</option>';
          });
          $.each(datatest.org, function(index, value) {
            org += '<option value="' + value.org_name + '" >' + value.org_name + '</option>';
          });


          if (document.getElementById("company_code").value) {
            console.log('company_code => ' + document.getElementById("company_code").value);
          } else {
            console.log('company_code => NULL');
            $("#company_code").html(company).selectpicker('refresh');
          }
          if (document.getElementById("locationInput").value) {
            console.log('locationInput => ' + document.getElementById("locationInput").value);
          } else {
            console.log('locationInput => NULL');
            $("#locationInput").html(plant).selectpicker('refresh');
          }
          if (document.getElementById("orgInput").value) {
            console.log('orgInput => ' + document.getElementById("orgInput").value);
          } else {
            console.log('orgInput => NULL');
            $("#orgInput").html(org).selectpicker('refresh');
          }

        },
        error: function() {
          console.log('error');
        }

      });
    },


    search: function(params) {
      var obj = $(this);
      var company = document.getElementById("company_code").value != "" ? document.getElementById("company_code").value : "";
      var org = document.getElementById("orgInput").value != "" ? document.getElementById("orgInput").value : "";
      var location = document.getElementById("locationInput").value != "" ? document.getElementById("locationInput").value : "";
      var status = document.getElementById("statusInput").value != "" ? document.getElementById("statusInput").value : "";
      alert(company);
      console.log('company_code => ' + document.getElementById("company_code").value);
      // i = 0;
      $.ajax({
        type: 'GET',
        url: window.location.href + '/getData',

        data: {
          'org_name': org,
          'location': location,
          'status': status,
          'company': company,
        },
        success: function(res, textStatus, jqXHR) {
          // console.log(res);
          var HTML = '';
          $.each(res.success.data, function(index, value) {
            // $("#inputProjectName").val(value.projectName);
            // $.each(value.items, function(index, items) {
            $("#inputProjectName").val(value.projectName);
            HTML += '<tr data-id="' + value.job_Number + '" >' +
              // '<td class="text-center ">' + (++i) + '</td>' +
              '<td class="text-center" >' + value.id + '</td>' +
              '<td class="text-center">' + value.postion_id + '</td>' +
              '<td class="text-center">' + value.positon_name + '</td>' +
              '<td class="text-center">' + value.org_name + '</td>' +
              '<td class="text-center">' + value.company_code + '</td>' +
              '<td class="text-center">' + value.start_date + '</td>' +
              '<td class="text-center">' + value.end_date + '</td>' +
              '<td class="text-center">' + value.repost + '</td>' +
              '<td class="text-center">' + value.status + '</td>'


            '</tr>';
            HTML += '</tr>';

            // })
          });
          $('#testData > tbody').html('').append(HTML);

       


        },
        error: function() {}
      });
    },














    // search1: function(params) {
    //   var id = obj.closest('tr').data('id');
    //   var company = document.getElementById("company_code").value != "" ? document.getElementById("company_code").value : "";
    //   var org = document.getElementById("orgInput").value != "" ? document.getElementById("orgInput").value : "";
    //   var location = document.getElementById("locationInput").value != "" ? document.getElementById("locationInput").value : "";
    //   setColumn = fn.getColumn();
    //   console.log(testttt)
    //   fn.testshow();
    //   var table = $("#testData").DataTable({
    //     destroy: true,
    //     "ajax": {
    //       type: 'GET',
    //       url: window.location.href + '/add',
    //       data: {
    //         'id': id
    //       },
    //       dataType: 'json',
    //       dataSrc: "success.data",
    //     },
    //     columns: setColumn,
    //     pagingType: 'full_numbers',
    //     "autoWidth": false,
    //   });
    // },
    // getColumn: function() {
    //   var columns = [];


    //   columns.push({
    //     data: "id",
    //     className: 'id-item text-center',
    //   })

    //   columns.push({
    //     data: "postion_id",
    //     className: 'text-center',
    //   })
    //   columns.push({
    //     data: "positon_name",
    //     className: 'text-center',
    //   })
    //   columns.push({
    //     data: "org_name",
    //     className: 'text-center',
    //   })
    //   columns.push({
    //     data: "company_code",
    //     className: 'text-center',
    //   })
    //   columns.push({
    //     data: "start_date",
    //     className: 'text-center'
    //   })
    //   columns.push({
    //     data: "end_date",
    //     className: 'text-center'
    //   })
    //   columns.push({
    //     data: "repost",
    //     className: 'text-center'
    //   })
    //   columns.push({
    //     data: "status",
    //     className: 'text-center'
    //   })
    //   columns.push({
    //     data: null,
    //     render: function(data) {
    //       return '<button type="button" rel="tooltip" title="verified" class="btn btn-success btn-fab btn-fab-mini btn-round btn-verified"  style="width: 28px; height: 28px;">' +
    //         '<i class="material-icons">verified</i>' +

    //         '</button>'
    //     },
    //     className: 'text-center'
    //   })
    // }
  }
</script>