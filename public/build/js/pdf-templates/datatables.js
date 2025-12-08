document.addEventListener("DOMContentLoaded", () => {
  const TEMPLATE_LIST_SEARCH_FORM = document.querySelector("#c_template_list_search_form");
  const TEMPLATE_LIST_SEARCH_INPUT = document.querySelector("#c_template_list_search_input");

  if (TEMPLATE_LIST_SEARCH_FORM && TEMPLATE_LIST_SEARCH_INPUT) {
    TEMPLATE_LIST_SEARCH_FORM.addEventListener("submit", (e) => {
      e.preventDefault();
      $('#template_list').DataTable().ajax.reload();
    });
  }

  let showCheckbox = true;

  try {
    if (HIDE_TEMPLATE_DATATABLE_CHECKBOX) {
      showCheckbox = false;
    }
  } catch (err) { }

  if ($('#template_list').length > 0) {
    templateDataTable = $('#template_list').DataTable({
      "serverSide": true,
      "bFilter": false,
      "bInfo": false,
      "ordering": true,
      "autoWidth": true,
      "order": [[5, "desc"]], // Order by created_at desc
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
        url: $('#template_list').data('url'),
        type: "GET",
        data: function (d) {
          d.search = TEMPLATE_LIST_SEARCH_INPUT?.value || "";
          // Add custom filter
          if (currentFilterType) {
            d.type = currentFilterType;
          }
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
            return `
              <label class="checkboxs">
                <input type="checkbox" class="row-check" value="${data}">
                <span class="checkmarks"></span>
              </label>
            `;
          }
        },
        { data: 'name' },
        {
          data: 'type_badge',
          orderable: true,
          searchable: true
        },
        {
          data: 'variables_count',
          orderable: false,
          searchable: false,
          render: function (data) {
            return `<span class="badge bg-secondary">${data} variable${data !== 1 ? 's' : ''}</span>`;
          }
        },
        {
          data: 'status_badge',
          orderable: true,
          searchable: false
        },
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
