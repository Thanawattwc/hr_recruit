<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-stats">
          <button class="btn text-center btn-primary col-12 btn-all">รายงานภาพรวมการลงประกาศงาน </button>
          <button class="btn text-center btn-primary col-12 btn-referral">รายงานการแนะนำบุคคลภายนอก</button>
          <button class="btn text-center btn-primary col-12 btn-portal">รายงานขอโอนย้ายภายใน</button>
          <div class="col-12">
            <div class="table-container">
              <table id="TableA" class="table table-hover table-bordered display">
              </table>
            </div>
            
            <!-- --------------เดิมอยู่ใน note pad วางตรงนี้----------------------- -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>





<script type="text/javascript">
  $(document).ready(function() {
    // fn.getData(); //report ภาพรวม
    // fn.getDataportal(); //report โอนย้ายภายใน
    // fn.getDataA();
    // test = localStorage.getItem('detailId');
    // alert(test);
    $(document).on('click', '.btn-all', function() {
      fn.getDataA('all');
    });
    $(document).on('click', '.btn-referral', function() {
      fn.getDataA('referral');
    });
    $(document).on('click', '.btn-portal', function() {
      fn.getDataA('portal');
    });
    // $(document).on('click', '.btn-addRowA', function() {
    //   fn.countRow("countRowA");
    //   fn.testAddRow("A");
    // });
    // $(document).on('click', '.btn-addRowB', function() {
    //   fn.countRow("countRowB");
    //   fn.testAddRow("B");
    // })
    // $(document).on('click', '.btA', function() {
    //   var id = $(this).attr('id')
    //   fn.delTest(id);
    // })
    // $(document).on('click', '.btB', function() {
    //   var id = $(this).attr('id')
    //   fn.delTest(id);
    // })
  })
  var fn = {
    // testAddRow: function(divType) {
    //   divAll = document.createElement("Div");
    //   divBtn = document.createElement("Div");
    //   divTar = document.createElement("Div");
    //   divRow = document.createElement("Div");
    //   tar = document.createElement("textarea");
    //   btn = document.createElement("button");
    //   countRow = document.getElementById("countRow" + divType).value

    //   divAll.className = "col-12";
    //   divBtn.className = "col-1";
    //   divTar.className = "col-11";
    //   divRow.className = "row"

    //   tar.className = "col-12";

    //   btn.innerHTML = countRow;
    //   btn.className = 'btn-danger bt' + divType;

    //   btn.setAttribute('id', 'button' + divType + countRow);
    //   tar.setAttribute('id', 'textarea' + divType + countRow);
    //   divRow.appendChild(divBtn).appendChild(btn);
    //   divRow.appendChild(divTar).appendChild(tar);
    //   divAll.appendChild(divRow);


    //   document.getElementById("row" + divType).appendChild(divAll);
    //   $("#Test" + divType + countRow).val('Test' + divType + countRow);

    // },
    // countRow: function(divRow) {
    //   countRow = document.getElementById(divRow).value;
    //   countRow = parseInt(countRow) + 1;
    //   $("#" + divRow).val((countRow));
    // },
    // delTest: function(id) {
    //   alert(id);
    //   // $("#Test" + id).val(id+'xxxxxxxxxxxxx');
    //   // document.getElementById("countTestRow").removeChild(olddata);

    // },
    // portal: function(params) {
    //   var modal = $('#modal-portal1');
    //   var modal = $('#modal-portal');
    //   modal.modal('show');
    // },
    // portal1: function(params) {
    //   var modal = $('#modal-portal1');
    //   modal.modal('show');
    // },

    getDataA: function(params) {

      page = base_url("<?php echo "/" . $page; ?>/getList");
      $.ajax({
        type: 'GET',
        url: page,
        dataType: 'json',
        data: {
          'type': params,
        },
        success: function(res, textStatus, jqXHR) {
          dataset = res.success.data
          //console.log(dataset);
          fn.setTableA(dataset, "TableA")
        },
        error: function(jqXHR, textStatus, errorThrown) {}
      })
    },
    setTableA: function(dataset = [], tableId = "") {
      setColumn = fn.setColumnA(dataset[0]);
      $("#" + tableId).DataTable({
        destroy: true,
        data: dataset,
        columns: setColumn,
        pagingType: 'full_numbers',
        autoWidth: false,
        "dom": "<'row'<'col-sm-2 text-center'l><'col-sm-8'f><'col-sm-2'B>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "buttons": [{
          extend: 'excelHtml5',
          title: "รายการประกาศงาน (HR)",
        }, ],
      });
    },

    setColumnA: function(dataset = []) {
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






    getData: function() {
      page = base_url("<?php echo "/" . $page; ?>/getListoverall");
      $.ajax({
        type: 'GET',
        url: page,
        dataType: 'json',
        success: function(res, textStatus, jqXHR) {
          dataset = res.success.data
          //console.log(dataset);
          fn.setTable(dataset, "Table")
        },
        error: function(jqXHR, textStatus, errorThrown) {}
      })
    },
    setTable: function(dataset = [], tableId = "") {
      setColumn = fn.setColumn(dataset[0]);
      // //console.log(dataset);
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


    getDataportal: function() {
      page = base_url("<?php echo "/" . $page; ?>/getDataportal");
      $.ajax({
        type: 'GET',
        url: page,
        dataType: 'json',
        success: function(res, textStatus, jqXHR) {
          dataset = res.success.data
          //console.log(dataset);
          fn.setTablePortal(dataset, "Tableportal")
        },
        error: function(jqXHR, textStatus, errorThrown) {}
      })
    },
    setTablePortal: function(dataset = [], tableId = "") {
      setColumn = fn.setColumnPortal(dataset[0]);
      // //console.log(dataset);
      $("#" + tableId).DataTable({
        destroy: true,
        data: dataset,
        columns: setColumn,
        pagingType: 'full_numbers',
        autoWidth: false,
      });
    },

    setColumnPortal: function(dataset = []) {
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







  }
</script>