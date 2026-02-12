document.addEventListener("DOMContentLoaded", () => {
  if ($('#billing_option_list').length > 0) {
    $('#billing_option_list').DataTable({
      "serverSide": true,
      "bFilter": false,
      "bInfo": false,
      "ordering": true,
      "autoWidth": true,
      "order": [[0, "asc"]],
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
        const $wrapper = $(settings.nTableWrapper);
        $wrapper.find('.dataTables_paginate').appendTo('.billing_option_list_datatable_paginate');
        $wrapper.find('.dataTables_length').appendTo('.billing_option_list_datatable_length');
      },
      ajax: {
        url: $('#billing_option_list').data('url'),
        type: "GET",
        data: function (d) {
          d.customer_id = CUSTOMER_ID;
        }
      },
      columns: [
        {
          data: 'cp_name',
          render: function (data, type, row) {
            return `<div><strong>${data || "-"}</strong><br><small class="text-muted">${row.cp_title_division || "-"}</small></div>`;
          }
        },
        { data: 'cp_email' },
        {
          data: 'cp_office_number',
          render: function (data, type, row) {
            return `Office: ${data || "-"}<br>Mob: ${row.cp_mobile_number || "-"}`;
          }
        },
        { data: 'address' },
        {
          data: 'is_overseas',
          render: function (data) {
            return data ? '<span class="badge bg-info">Yes</span>' : '<span class="badge bg-secondary">No</span>';
          }
        },
        {
          data: 'actions',
          name: 'actions',
          orderable: false,
          searchable: false,
        }
      ],
    });
  }
});
