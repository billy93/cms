document.addEventListener("DOMContentLoaded", () => {
  const PROPOSAL_LIST_SEARCH_FORM = document.querySelector("#c_proposal_list_search_form");
  const PROPOSAL_LIST_SEARCH_INPUT = document.querySelector("#c_proposal_list_search_input");

  if (PROPOSAL_LIST_SEARCH_FORM && PROPOSAL_LIST_SEARCH_INPUT) {
    PROPOSAL_LIST_SEARCH_FORM.addEventListener("submit", (e) => {
      e.preventDefault();
      $('#proposal_list').DataTable().ajax.reload();
    });
  }

  let showCheckbox = true;

  try {
    if (HIDE_PROPOSAL_DATATABLE_CHECKBOX) { // Put it on top of other script on the page (dynamic can bet set or unset)
      showCheckbox = false;
    }
  } catch (err) { }

  if ($('#proposal_list').length > 0) {
    $('#proposal_list').DataTable({
      "serverSide": true,
      "bFilter": false,
      "bInfo": false,
      "ordering": true,
      "autoWidth": true,
      "order": [["0", "desc"]],
      "language": {
        search: ' ',
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
        url: $('#proposal_list').data('url'),
        type: "GET",
        data: function (d) {
          d.search = PROPOSAL_LIST_SEARCH_INPUT?.value || "";
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
            const checked = SELECTED_PROPOSAL_DATATABLES_ROWS.some(obj => +obj.id === data);
            return `
							<label class="checkboxs">
								<input type="checkbox" class="row-check" ${checked ? "checked" : ""} value="${data}" data-code="${row.code}">
								<span class="checkmarks"></span>
							</label>
						`;
          }
        },
        { data: 'code' },
        {
          data: 'created_at',
          render: function (data, type, row) {
            return type === 'display' ? moment(data).format('DD-MMM-YYYY') : data;
          }
        },
        {
          data: 'updated_at',
          render: function (data, type, row) {
            return type === 'display' ? moment(data).format('DD-MMM-YYYY') : data;
          }
        },
        {
          data: 'project_code',
          orderable: false,
        },
        {
          data: 'status',
          render: function (data, type, row) {
            if (type === 'display') {
              switch (data) {
                case 'Draft': return '<span class="badge badge-status bg-secondary">Draft</span>';
                case 'Submitted': return '<span class="badge badge-status bg-info">Submitted</span>';
                case 'Win': return '<span class="badge badge-status bg-success">Win</span>';
                case 'Lose': return '<span class="badge badge-status bg-danger">Lose</span>';
                case 'Cancelled': return '<span class="badge badge-status bg-dark">Cancelled</span>';
                default: return '<span class="badge badge-status bg-secondary">Unknown</span>';
              }
            }
            return data;
          }
        },
        {
          data: 'sales_code',
          render: function (data, type, row) {
            return data && data.trim() !== '' ? data : '-';
          }
        },
        { data: 'invoice_codes' },
        {
          data: 'generate_invoice',
          orderable: false,
          searchable: false
        },
        {
          data: 'actions',
          orderable: false,
          searchable: false
        }
      ],
      columnDefs: [
        // { targets: [15], width: '1%', className: 'text-nowrap' } // fit-content
      ]
    });
  }
});