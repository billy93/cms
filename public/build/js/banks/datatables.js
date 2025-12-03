document.addEventListener("DOMContentLoaded", () => {
  const BANK_LIST_SEARCH_FORM = document.querySelector("#c_bank_list_search_form");
  const BANK_LIST_SEARCH_INPUT = document.querySelector("#c_bank_list_search_input");

  if (BANK_LIST_SEARCH_FORM && BANK_LIST_SEARCH_INPUT) {
    BANK_LIST_SEARCH_FORM.addEventListener("submit", (e) => {
      e.preventDefault();
      $('#bank_list').DataTable().ajax.reload();
    });
  }

  let showCheckbox = true;

  try {
    if (HIDE_BANK_DATATABLE_CHECKBOX) { // Put it on top of other script on the page (dynamic can bet set or unset)
      showCheckbox = false;
    }
  } catch (err) { }

  if ($('#bank_list').length > 0) {
    $('#bank_list').DataTable({
      "serverSide": true,
      "bFilter": false,
      "bInfo": false,
      "ordering": true,
      "autoWidth": true,
      "order": [[0, "desc"]],
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
      initComplete: (settings, json) => {
        $('.dataTables_paginate').appendTo('.datatable-paginate');
        $('.dataTables_length').appendTo('.datatable-length');
      },
      ajax: {
        url: $('#bank_list').data('url'),
        type: "GET",
        data: function (d) {
          d.search = BANK_LIST_SEARCH_INPUT?.value || "";
        },
        dataSrc: function (json) {
          console.log(json.data);

          return json.data;
        }
      },
      columns: [
        {
          data: 'id',
          visible: showCheckbox ? true : false,
          orderable: showCheckbox ? false : true,
          render: function (data, type, row) {
            const checked = SELECTED_BANK_DATATABLES_ROWS.some(obj => +obj.id === data);
            return `
							<label class="checkboxs">
								<input type="checkbox" class="row-check" ${checked ? "checked" : ""} value="${data}" data-code="${row.code}">
								<span class="checkmarks"></span>
							</label>
						`;
          }
        },
        { data: 'bank_code' },
        { data: 'bank_brand' },
        { data: 'bank_name' },
        { data: 'bank_address' },
        {
          data: 'actions',
          orderable: false,
          searchable: false
        }
      ],
      columnDefs: [
        {
          targets: [3],
          createdCell: function (td, cellData, rowData, row, col) {
            $(td).css('white-space', 'normal');
            $(td).css('min-width', '240px');
          }
        }
      ]
    });
  }
});