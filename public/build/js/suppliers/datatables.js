document.addEventListener("DOMContentLoaded", () => {
  const SUPPLIER_LIST_SEARCH_FORM = document.querySelector("#c_supplier_list_search_form");
  const SUPPLIER_LIST_SEARCH_INPUT = document.querySelector("#c_supplier_list_search_input");

  if (SUPPLIER_LIST_SEARCH_FORM && SUPPLIER_LIST_SEARCH_INPUT) {
    SUPPLIER_LIST_SEARCH_FORM.addEventListener("submit", (e) => {
      e.preventDefault();
      $('#supplier_list').DataTable().ajax.reload();
    });
  }

  let showCheckbox = true;

  try {
    if (HIDE_SUPPLIER_DATATABLE_CHECKBOX) { // Put it on top of other script on the page (dynamic can bet set or unset)
      showCheckbox = false;
    }
  } catch (err) { }

  if ($('#supplier_list').length > 0) {
    $('#supplier_list').DataTable({
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
        url: $('#supplier_list').data('url'),
        type: "GET",
        data: function (d) {
          d.search = SUPPLIER_LIST_SEARCH_INPUT?.value || "";
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
            const checked = SELECTED_SUPPLIER_DATATABLES_ROWS.some(obj => +obj.id === data);
            return `
							<label class="checkboxs">
								<input type="checkbox" class="row-check" ${checked ? "checked" : ""} value="${data}" data-code="${row.code}">
								<span class="checkmarks"></span>
							</label>
						`;
          }
        },
        { data: 'code' },
        { data: 'name' },
        { data: 'address' },
        { data: 'contact_person' },
        { data: 'phone' },
        { data: 'email' },
        { data: 'tax_number' },
        { data: 'bank_name' },
        { data: 'bank_account_number' },
        { data: 'bank_account_name' },
        {
          data: 'actions',
          orderable: false,
          searchable: false
        }
      ]
    });
  }
});