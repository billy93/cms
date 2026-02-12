document.addEventListener("DOMContentLoaded", () => {
  const INVOICE_LIST_SEARCH_FORM = document.querySelector("#c_invoice_list_search_form");
  const INVOICE_LIST_SEARCH_INPUT = document.querySelector("#c_invoice_list_search_input");

  if (INVOICE_LIST_SEARCH_FORM && INVOICE_LIST_SEARCH_INPUT) {
    INVOICE_LIST_SEARCH_FORM.addEventListener("submit", (e) => {
      e.preventDefault();
      $('#invoice_list').DataTable().ajax.reload();
    });
  }

  let showCheckbox = true;

  try {
    if (HIDE_INVOICE_DATATABLE_CHECKBOX) { // Put it on top of other script on the page (dynamic can bet set or unset)
      showCheckbox = false;
    }
  } catch (err) { }

  if ($('#invoice_list').length > 0) {
    $('#invoice_list').DataTable({
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
        $('.dataTables_paginate').appendTo('.invoice_list_datatable_paginate');
        $('.dataTables_length').appendTo('.invoice_list_datatable_length');
      },
      ajax: {
        url: $('#invoice_list').data('url'),
        type: "GET",
        data: function (d) {
          d.search = INVOICE_LIST_SEARCH_INPUT?.value || "";
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
            const checked = SELECTED_INVOICE_DATATABLES_ROWS.some(obj => +obj.id === data);
            return `
							<label class="checkboxs">
								<input type="checkbox" class="row-check" ${checked ? "checked" : ""} value="${data}" data-code="${row.code}">
								<span class="checkmarks"></span>
							</label>
						`;
          }
        },
        { data: 'code', orderable: false },
        { data: 'invoice_number', orderable: false },
        { data: 'project_name', orderable: false },
        { data: 'proposal_code', orderable: false },
        { data: 'sales_code', orderable: false },
        {
          data: 'invoice_date',
          render: function (data, type, row) {
            return type === 'display' ? moment(data).format('DD-MMM-YYYY') : data;
          }
        },
        {
          data: 'due_date',
          render: function (data, type, row) {
            return type === 'display' ? moment(data).format('DD-MMM-YYYY') : data;
          }
        },
        { data: 'invoice_amount', className: 'text-end' },
        {
          data: 'billing_type',
          render: function (data, type, row) {
            if (type === 'display') {
              switch (data) {
                case 'Partly Payment': return '<span class="badge badge-status bg-secondary">Partly Payment</span>';
                case 'Full Amount': return '<span class="badge badge-status bg-success">Full Amount</span>';
                default: return `<span class="badge badge-status bg-secondary">${data || 'Unknown'}</span>`;
              }
            }
            return data;
          }
        }, {
          data: 'status',
          render: function (data, type, row) {
            if (type === 'display') {
              switch (data) {
                case 'PREPARED': return '<span class="badge badge-status bg-info">Prepared</span>';
                case 'SENT': return '<span class="badge badge-status bg-primary">Sent</span>';
                case 'REVISED': return '<span class="badge badge-status bg-warning">Revised</span>';
                case 'VOID': return '<span class="badge badge-status bg-danger">Void</span>';
                case 'Paid': return '<span class="badge badge-status bg-success">Paid</span>';
                default: return `<span class="badge badge-status bg-secondary">${data || 'Unknown'}</span>`;
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