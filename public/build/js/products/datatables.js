document.addEventListener("DOMContentLoaded", () => {
  const PRODUCT_LIST_SEARCH_FORM = document.querySelector("#c_product_list_search_form");
  const PRODUCT_LIST_SEARCH_INPUT = document.querySelector("#c_product_list_search_input");

  if (PRODUCT_LIST_SEARCH_FORM && PRODUCT_LIST_SEARCH_INPUT) {
    PRODUCT_LIST_SEARCH_FORM.addEventListener("submit", (e) => {
      e.preventDefault();
      $('#product_list').DataTable().ajax.reload();
    });
  }

  let showCheckbox = true;

  try {
    if (HIDE_PROJECT_DATATABLE_CHECKBOX) { // Put it on top of other script on the page (dynamic can bet set or unset)
      showCheckbox = false;
    }
  } catch (err) { }

  if ($('#product_list').length > 0) {
    $('#product_list').DataTable({
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
        url: $('#product_list').data('url'),
        type: "GET",
        data: function (d) {
          d.search = PRODUCT_LIST_SEARCH_INPUT?.value || "";
        },
        dataSrc: function (json) {
          return json.data;
        }
      },
      columns: [
        {
          data: 'id',
          visible: showCheckbox ? true : false,
          orderable: showCheckbox ? false : true,
          render: function (data, type, row) {
            const checked = SELECTED_PRODUCT_DATATABLES_ROWS.some(obj => +obj.id === data);
            return `
							<label class="checkboxs">
								<input type="checkbox" class="row-check" ${checked ? "checked" : ""} value="${data}" data-code="${row.code}">
								<span class="checkmarks"></span>
							</label>
						`;
          }
        },
        { data: 'name' },
        { data: 'unit' },
        {
          data: 'base_cost',
          render: function (data, type, row) {
            return formatRupiah(data);
          }
        },
        { data: 'description' },
        {
          data: 'categories',
          render: function (data, type, row) {
            return type === 'display' && data ? `<div style="display: flex; flex-wrap: wrap; gap: 4px;">${data}</div>` : "-";
          }
        },
        { data: 'supplier_name' },
        {
          data: 'created_at',
          render: function (data, type, row) {
            return type === 'display' && data ? moment(data).format('DD MMM YYYY') : "-";
          }
        },
        {
          data: 'updated_at',
          render: function (data, type, row) {
            return type === 'display' && data ? moment(data).format('DD MMM YYYY') : "-";
          }
        },
        {
          data: 'actions',
          orderable: false,
          searchable: false
        }
      ],
      // columnDefs: [
      //   {
      //     targets: 5, // kolom ke-4 (0-based index)
      //     createdCell: function (td) {
      //       $(td).css({
      //         'display': 'flex',
      //         'flex-wrap': 'wrap',
      //         'max-width': '200px',
      //       });
      //     }
      //   }
      // ]
    });
  }
});