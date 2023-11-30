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
                <select id="org_name" name="org_name" class="form-control selectpicker" data-style="ripple-none select-with-transition" data-width="100%" title="-- กรุณาเลือก --">
                </select>
              </div>

              <div class="col-sm-2 col-lg-2">
                <label class="form-control-label bmd-label-floating">โรงงาน</label>
                <select id="plant_code" name="plant_code" class="form-control selectpicker" data-style="ripple-none select-with-transition" data-width="100%" title="-- กรุณาเลือก --">
                </select>
              </div>

              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-search">ค้นหา</button>
              </div>
            </div>
          </div>


          <div class="col-12">
            <div class="table-container" id='listDiv'>
              <table id="documentData" class="table table-hover table-bordered display">
              </table>
            </div>
          </div>




        </div>
      </div>
    </div>

  </div>
</div>



<script type="text/javascript">
  $(document).ready(function() {
    fn.getData();
    fn.getMaster();
    $(document).on('click', '.btn-search', fn.find)
    $(document).on('change', '#company_code', function() {
      fn.getMaster("company_code");
    });
    $(document).on('change', '#plant_code', function() {
      fn.getMaster("plant_code");
    });
    $(document).on('change', '#org_name', function() {
      fn.getMaster("org_name");
    });
  })


  var fn = {
    getData: function() {
      page = base_url("<?php echo "/" . $page; ?>/getData");
      $.ajax({
        type: 'GET',
        url: page,
        dataType: 'json',
        success: function(res, textStatus, jqXHR) {
          dataset = res.success.data
          fn.setTable(dataset, "documentData")
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(jqXHR);
          console.log(errorThrown);
        },
      })
    },
    setTable: function(dataset = [], tableId = "") {
      setColumn = fn.setColumn(dataset[0]);
      $("#" + tableId).DataTable({
        destroy: true,
        data: dataset,
        columns: setColumn,
        pagingType: 'full_numbers',
        autoWidth: false,
      });
      $("#" + tableId + " tbody").on('dblclick', 'tr', function() {
        table = $("#documentData").DataTable();
        var data = table.row(this).data();
        window.open(base_url('detail?id=' + data.id), "_blank");
      });
    },
    setColumn: function(dataset = []) {
      columns = [];
      col = Object.keys(dataset);
      $.each(col, function(index, colName) {
        if (colName != 'id') {
          columns.push({
            data: colName,
            title: colName,
            className: 'text-center',
          })
        }
      })
      return columns;
    },
    find: function() {
      var company = document.getElementById("company_code").value != "" ? document.getElementById("company_code").value : "";
      var org_name = document.getElementById("org_name").value != "" ? document.getElementById("org_name").value : "";
      var plant_code = document.getElementById("plant_code").value != "" ? document.getElementById("plant_code").value : "";
      $.ajax({
        type: 'GET',
        url: base_url("<?php echo "/" . $page; ?>/getData"),
        data: {
          "company_code": company,
          "org_name": org_name,
          "plant_code": plant_code,
        },
        success: function(res, textStatus, jqXHR) {
          dataset = res.success.data
          fn.setTable(dataset, "documentData")
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(jqXHR);
          console.log(errorThrown);
        },
      })
    },
    // getMaster: function(params) {
    //   var company_code = document.getElementById("company_code").value != "" ? document.getElementById("company_code").value : "";
    //   var org_name = document.getElementById("org_name").value != "" ? document.getElementById("org_name").value : "";
    //   var plant_code = document.getElementById("plant_code").value != "" ? document.getElementById("plant_code").value : "";
    //   testData = ['company_code', 'org_name', 'plant_code', 'status'];
    //   $.ajax({
    //     type: 'GET',
    //     url: base_url("<?php echo "/" . $page; ?>/getMaster"),
    //     data: {
    //       "company_code": company_code,
    //       "org_name": org_name,
    //       "plant_code": plant_code,
    //       "find": params,
    //     },
    //     success: function(res, textStatus, jqXHR) {
    //       select_company_code = "";
    //       select_org_name = "";
    //       select_plant_code = "";
    //       if (params != "company_code") {
    //         select_company_code = '<option value="">ไม่เลือก</option>';
    //         $.each(res.success.data.company_code, function(index, value) {
    //           select_company_code += '<option value="' + value.company_code + '">' + value.company_code + '</option>';
    //         });
    //         $("#company_code").html(select_company_code).selectpicker('refresh');
    //         $("#company_code").val(company_code).selectpicker('refresh');
    //       }
    //       if (params != "org_name") {
    //         select_org_name = '<option value="">ไม่เลือก</option>';
    //         $.each(res.success.data.org_name, function(index, value) {
    //           select_org_name += '<option value="' + value.org_name + '">' + value.org_name + '</option>';
    //         });
    //         $("#org_name").html(select_org_name).selectpicker('refresh');
    //         $("#org_name").val(org_name).selectpicker('refresh');
    //       }
    //       if (params != "plant_code") {
    //         select_location_code = '<option value="">ไม่เลือก</option>';
    //         $.each(res.success.data.plant_code, function(index, value) {
    //           select_plant_code += '<plant_code value="' + value.plant_code + '">' + value.plant_code + '</option>';
    //         });
    //         $("#plant_code").html(select_location_code).selectpicker('refresh');
    //         $("#plant_code").val(location_code).selectpicker('refresh');
    //       }
    //     },
    //     error: function(jqXHR, textStatus, errorThrown) {},
    //   })
    // },
    getMaster: function(params) {
      var company_code = document.getElementById("company_code").value != "" ? document.getElementById("company_code").value : "";
      var org_name = document.getElementById("org_name").value != "" ? document.getElementById("org_name").value : "";
      var plant_code = document.getElementById("plant_code").value != "" ? document.getElementById("plant_code").value : "";
      testData = ['company_code', 'org_name', 'plant_code', 'status'];
      $.ajax({
        type: 'GET',
        url: base_url("<?php echo "/" . $page; ?>/getMaster"),
        // url:  window.location + 'jobList/getMaster', //base_url("<?php echo "/" . $page; ?>/getMaster"),
        data: {
          "company_code": company_code,
          "org_name": org_name,
          "plant_code": plant_code,
          "find": params,
        },
        success: function(res, textStatus, jqXHR) {
          select_company_code = "";
          select_org_name = "";
          select_plant_code = "";
          if (params != "company_code") {
            select_company_code = '<option value="">ไม่เลือก</option>';
            $.each(res.success.data.company_code, function(index, value) {
              select_company_code += '<option value="' + value.company_code + '">' + value.company_code + ' : ' + value.company_name + '</option>';
            });
            $("#company_code").html(select_company_code).selectpicker('refresh');
            $("#company_code").val(company_code).selectpicker('refresh');
          }
          if (params != "org_name") {
            select_org_name = '<option value="">ไม่เลือก</option>';
            $.each(res.success.data.org_name, function(index, value) {
              select_org_name += '<option value="' + value.org_name + '">' + value.org_name + '</option>';
            });
            $("#org_name").html(select_org_name).selectpicker('refresh');
            $("#org_name").val(org_name).selectpicker('refresh');
          }
          if (params != "plant_code") {
            select_plant_code = '<option value="">ไม่เลือก</option>';
            $.each(res.success.data.plant_code, function(index, value) {
              select_plant_code += '<option value="' + value.plant_code + '">' + value.plant_code +  ' : ' + value.plant_name + '</option>';
            });
            $("#plant_code").html(select_plant_code).selectpicker('refresh');
            $("#plant_code").val(plant_code).selectpicker('refresh');
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {},
      })
    },
  }
</script>