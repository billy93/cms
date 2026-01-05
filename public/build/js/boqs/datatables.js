document.addEventListener("DOMContentLoaded", () => {
  const BOQ_LIST_SEARCH_FORM = document.querySelector("#c_boq_list_search_form");
  const BOQ_LIST_SEARCH_INPUT = document.querySelector("#c_boq_list_search_input");

  if (BOQ_LIST_SEARCH_FORM && BOQ_LIST_SEARCH_INPUT) {
    BOQ_LIST_SEARCH_FORM.addEventListener("submit", (e) => {
      e.preventDefault();
      $('#boq_list').DataTable().ajax.reload();
    });
  }

  let showCheckbox = true;

  try {
    if (HIDE_BOQ_DATATABLE_CHECKBOX) {
      showCheckbox = false;
    }
  } catch (err) { }

  try {
    if (PROPOSAL_STATUS === "Win") {
      showCheckbox = false;
    }
  } catch (err) { }

  if ($('#boq_list').length > 0) {
    $('#boq_list').DataTable({
      "serverSide": true,
      "bFilter": false,
      "bInfo": false,
      "ordering": true,
      "autoWidth": false,
      "language": {
        search: '',
        sLengthMenu: '_MENU_',
        searchPlaceholder: "Search",
        info: "_START_ - _END_ of _TOTAL_ items",
        "lengthMenu": "Show _MENU_ entries",
        paginate: {
          next: 'Next <i class="fa fa-angle-right"></i>',
          previous: '<i class="fa fa-angle-left"></i> Prev'
        },
      },
      initComplete: function (settings, json) {
        const $table = $(settings.nTable).closest('.dataTables_wrapper');
        $table.find('.dataTables_paginate').appendTo('.table-boq-paginate');
        $table.find('.dataTables_length').appendTo('.table-boq-length');
      },
      ajax: {
        url: $('#boq_list').data('url'),
        type: "GET",
        data: function (d) {
          d.search = BOQ_LIST_SEARCH_INPUT?.value || "";
        },
        dataSrc: function (json) {
          return json.data;
        }
      },
      columns: [
        {
          data: 'id',
          visible: showCheckbox ? true : false,
          orderable: false,
          render: function (data, type, row) {
            const checked = SELECTED_BOQ_DATATABLES_ROWS.some(obj => obj.id == data);
            return `
							<label class="checkboxs">
								<input type="checkbox" class="row-check" ${checked ? "checked" : ""} value="${data}" data-code="${row.code}">
								<span class="checkmarks"></span>
							</label>
						`;
          }
        },
        { data: 'code' },
        { data: 'sales_code', orderable: false },
        { data: 'description', orderable: false },
        { data: 'qty', orderable: false },
        { data: 'freq', orderable: false },
        { data: 'unit_price', orderable: false },
        { data: 'selling_price', orderable: false },
        { data: 'total_price', orderable: false },
        { data: 'grand_total', orderable: false },
        { data: 'actions', name: 'actions', orderable: false, searchable: false }
      ],
      columnDefs: [
        {
          targets: 0,
          createdCell: function (td, cellData, rowData, row, col) {
            $(td).css({
              position: 'sticky',
              zIndex: 1,
              backgroundColor: '#fff'
            });
          }
        },
      ]
    });
  }
});