document.addEventListener("DOMContentLoaded", () => {
  const PROJECT_LIST_SEARCH_FORM = document.querySelector("#c_project_list_search_form");
  const PROJECT_LIST_SEARCH_INPUT = document.querySelector("#c_project_list_search_input");

  if (PROJECT_LIST_SEARCH_FORM && PROJECT_LIST_SEARCH_INPUT) {
    PROJECT_LIST_SEARCH_FORM.addEventListener("submit", (e) => {
      e.preventDefault();
      $('#project_list').DataTable().ajax.reload();
    });
  }

  let showCheckbox = true;

  try {
    if (HIDE_PROJECT_DATATABLE_CHECKBOX) { // Put it on top of other script on the page (dynamic can bet set or unset)
      showCheckbox = false;
    }
  } catch (err) { }

  if ($('#project_list').length > 0) {
    $('#project_list').DataTable({
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
        url: $('#project_list').data('url'),
        type: "GET",
        data: function (d) {
          d.search = PROJECT_LIST_SEARCH_INPUT?.value || "";
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
            const checked = SELECTED_PROJECT_DATATABLES_ROWS.some(obj => +obj.id === data);
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
        { data: 'customer_name' },
        { data: 'ref_doc_no' },
        {
          data: 'start_date',
          render: function (data, type, row) {
            return type === 'display' && data ? moment(data).format('DD MMM YYYY') : "-";
          }
        },
        {
          data: 'end_date',
          render: function (data, type, row) {
            return type === 'display' && data ? moment(data).format('DD MMM YYYY') : "-";
          }
        },
        {
          data: 'due_date',
          render: function (data, type, row) {
            return type === 'display' && data ? moment(data).format('DD MMM YYYY') : "-";
          }
        },
        {
          data: 'status',
          render: function (data, type, row) {
            if (type === 'display') {
              switch (data) {
                case 'Active': return '<span class="badge badge-status bg-success">Active</span>';
                case 'Inactive': return '<span class="badge badge-status bg-dark">Inactive</span>';
                default: return '<span class="badge badge-status bg-secondary">Unknown</span>';
              }
            }
            return data;
          }
        },
        {
          data: 'actions',
          orderable: false,
          searchable: false
        }
      ]
    });
  }
});