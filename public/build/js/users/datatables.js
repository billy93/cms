document.addEventListener("DOMContentLoaded", () => {
  const USER_LIST_SEARCH_FORM = document.querySelector("#c_user_list_search_form");
  const USER_LIST_SEARCH_INPUT = document.querySelector("#c_user_list_search_input");

  if (USER_LIST_SEARCH_FORM && USER_LIST_SEARCH_INPUT) {
    USER_LIST_SEARCH_FORM.addEventListener("submit", (e) => {
      e.preventDefault();
      $('#user_list').DataTable().ajax.reload();
    });
  }

  let showCheckbox = true;

  try {
    if (HIDE_USER_DATATABLE_CHECKBOX) { // Put it on top of other script on the page (dynamic can bet set or unset)
      showCheckbox = false;
    }
  } catch (err) { }

  if ($('#user_list').length > 0) {
    $('#user_list').DataTable({
      "serverSide": true,
      "bFilter": false,
      "bInfo": false,
      "ordering": true,
      "autoWidth": true,
      "order": [[7, "desc"]],
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
        url: $('#user_list').data('url'),
        type: "GET",
        data: function (d) {
          d.search = USER_LIST_SEARCH_INPUT?.value || "";
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
            const checked = SELECTED_USER_DATATABLES_ROWS.some(obj => +obj.id === data);
            return `
							<label class="checkboxs">
								<input type="checkbox" class="row-check" ${checked ? "checked" : ""} value="${data}" data-email="${row.email}">
								<span class="checkmarks"></span>
							</label>
						`;
          }
        },
        { data: 'name' },
        { data: 'email' },
        { data: 'phone' },
        { data: 'location' },
        { data: 'role' },
        {
          data: 'status',
          render: function (data, type, row) {
            if (type === 'display') {
              switch (data) {
                case 'Active': return '<span class="badge badge-status bg-success">Active</span>';
                case 'Suspended': return '<span class="badge badge-status bg-danger">Suspended</span>';
                case 'Inactive': return '<span class="badge badge-status bg-secondary">Inactive</span>';
                default: return '<span class="badge badge-status bg-dark">Unknown</span>';
              }
            }
            return data;
          }
        },
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
      columnDefs: [
        {
          targets: 0, // kolom pertama
          createdCell: function (td, cellData, rowData, row, col) {
            $(td).css({
              position: 'sticky',
              zIndex: 1,
              backgroundColor: '#fff'
            });
          }
        },
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
      ]
    });
  }
});