document.addEventListener("DOMContentLoaded", () => {
  const ROLE_LIST_SEARCH_FORM = document.querySelector("#c_role_list_search_form");
  const ROLE_LIST_SEARCH_INPUT = document.querySelector("#c_role_list_search_input");

  if (ROLE_LIST_SEARCH_FORM && ROLE_LIST_SEARCH_INPUT) {
    ROLE_LIST_SEARCH_FORM.addEventListener("submit", (e) => {
      e.preventDefault();
      $('#role_list').DataTable().ajax.reload();
    });
  }

  let showCheckbox = true;

  try {
    if (HIDE_ROLE_DATATABLE_CHECKBOX) { // Put it on top of other script on the page (dynamic can bet set or unset)
      showCheckbox = false;
    }
  } catch (err) { }

  if ($('#role_list').length > 0) {
    $('#role_list').DataTable({
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
        url: $('#role_list').data('url'),
        type: "GET",
        data: function (d) {
          d.search = ROLE_LIST_SEARCH_INPUT?.value || "";
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
            const checked = SELECTED_ROLE_DATATABLES_ROWS.some(obj => +obj.id === data);
            return `
							<label class="checkboxs">
								<input type="checkbox" class="row-check" ${checked ? "checked" : ""} value="${data}" data-code="${row.code}">
								<span class="checkmarks"></span>
							</label>
						`;
          }
        },
        { data: 'name' },
        { data: 'slug' },
        { data: 'description' },
        {
          data: 'created_at',
          render: function (data, type) {
            return type === 'display' ? moment(data).format('DD MMM YYYY') : data;
          }
        },
        {
          data: 'updated_at',
          render: function (data, type) {
            return type === 'display' ? moment(data).format('DD MMM YYYY') : data;
          }
        },
        {
          data: 'actions',
          orderable: false,
          searchable: false
        }
      ],
    });
  }
});