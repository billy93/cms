class AppendBoqForm {
  mode = "create";
  selectedItem = [];
  errors = {};

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.dataTableUrl = document.getElementById('boq-container').dataset.url;
    this.closeForm = document.getElementById("close_proposal_form");
    this.initDataTable = this.initDataTable.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);

    this.handleDocumentChange = this.handleDocumentChange.bind(this);
    this.form.addEventListener("submit", (e) => {
      e.preventDefault();
      // this.handleSubmit()
    });

    // Attach global listener sekali
    document.addEventListener("change", this.handleDocumentChange);
  }


  // ---------------------------------------- HANDLER GLOBAL ----------------------------------------
  async handleDocumentChange(e) {
    const target = e.target;

    if (target.matches("#select-all-append-boq")) {
      const checked = target.checked;

      if (!checked) {
        this.selectedItem = []
      }

      document.querySelectorAll('#append_boq_list input.row-check').forEach(el => {
        el.checked = checked;

        if (checked) {
          this.selectedItem.push({
            id: el.value,
            code: el.dataset.code
          });
        }
      });

      this.updateSelectedEl();
    }
  }

  // ---------------------------------------- INIT ----------------------------------------
  async init(data = {}) {
    this.resetForm();
    this.data = data;

    const formWrapper = document.createElement("div");
    formWrapper.id = "append_boq_form_wrapper";
    formWrapper.innerHTML = this.createForm();
    this.form.appendChild(formWrapper);
    this.initPlugins();
    this.initDataTable();
    $('#append_boq_list').DataTable().ajax.reload();

  }

  // ---------------------------------------- DOM ----------------------------------------
  createForm() {
    return `
      <div>
        <h5 class="mb-1">Selected BOQ Codes:</h5>
        <ul id="selected-append-boq"><li class="no-selected-tag">No Selected BoQ</li></ul>
      </div>
      <div style="border: 1px solid #e8e8e8; border-radius: 6px;">
        <div class="table-responsive custom-table">
          <table class="table" id="append_boq_list" data-url="${this.dataTableUrl}">
            <thead class="thead-light">
              <tr>
                <th class="td-break no-sort" rowspan="2">
                    <label class="checkboxs"><input type="checkbox" id="select-all-append-boq"><span class="checkmarks"></span></label>
                </th>
                <th class="td-break" rowspan="2">ID</th>
                <th class="td-break" rowspan="2">BOQ Code</th>
                <th class="td-break" rowspan="2">BOQ Type</th>
                <th class="td-break" rowspan="2">Description</th>
                <th class="td-break" rowspan="2">Created</th>
                <th colspan="8">Items</th>
                <th class="td-break" rowspan="2">Basic Price</th>
                <th class="td-break" rowspan="2">Management Fee</th>
                <th class="td-break" rowspan="2">Sales Amount</th>
                <th class="td-break" rowspan="2">VAT Rate</th>
                <th class="td-break" rowspan="2">VAT</th>
                <th class="td-break" rowspan="2">Invoice Amount</th>
                <th class="td-break" rowspan="2" class="no-sort">Action</th>
              </tr>
              <tr>
                <th>Header</th>
                <th>Subheader</th>
                <th>Unit Price</th>
                <th>Title1</th>
                <th>Title2</th>
                <th>Title3</th>
                <th>Title4</th>
                <th>Multiplier</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
        <div class="row align-items-center" style="row-gap: 1em; padding: 10px 15px;">
          <div class="col-md-6">
            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
              <div class="datatable-info"></div>
              <div class="append-table-boq-length"></div>
            </div>
          </div>
          <div class="col-md-6 flex-grow-1">
            <div class="append-table-boq-paginate"></div>
          </div>
        </div>
      </div>
      <div class="d-flex align-items-center justify-content-end mt-4">
        <a href="javascript:void(0)" class="btn btn-light me-2" data-bs-dismiss="offcanvas">Cancel</a>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    `;
  }

  updateSelectedEl() {
    const el = document.querySelector("#selected-append-boq");

    if (el) {
      if (this.selectedItem.length) {
        el.innerHTML = this.selectedItem
          .map(obj => `<li class="selected-tag">${obj.code}</li>`)
          .join("");
      } else {
        el.innerHTML = `<li class="no-selected-tag">No Selected BoQ</li>`;
      }
    }
  }

  initDataTable() {
    $('#append_boq_list').DataTable({
      "serverSide": true,
      "bFilter": false,
      "bInfo": false,
      "ordering": true,
      "autoWidth": true,
      "order": [[0, "desc"]],
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
      initComplete: function (settings, json) {
        const $table = $(settings.nTable).closest('.dataTables_wrapper');
        $table.find('.dataTables_paginate').appendTo('.append-table-boq-paginate');
        $table.find('.dataTables_length').appendTo('.append-table-boq-length');
      },
      "ajax": {
        "url": $('#append_boq_list').data('url'),
        "type": "GET",
        "dataSrc": function (json) {
          return json.data;
        }
      },
      columns: [
        {
          data: 'id',
          orderable: false,
          searchable: false,
          render: function (data, type, row) {
            return `
							<label class="checkboxs">
								<input type="checkbox" class="row-check" value="${data}" data-code="${row.code}">
								<span class="checkmarks"></span>
							</label>
						`;
          }
        },
        { data: 'id', visible: false },
        { data: 'code' },
        { data: 'form_type' },
        { data: 'description', className: 'desc-col' },
        {
          data: 'created_at',
          render: function (data, type) {
            return type === 'display' ? moment(data).format('DD-MMM-YYYY') : data;
          }
        },
        { data: 'header', orderable: false },
        { data: 'subheader', orderable: false },
        {
          data: 'unit_price',
          orderable: false,
          render: function (data) {
            return data;
          }
        },
        { data: 'item_title1', orderable: false },
        { data: 'item_title2', orderable: false },
        { data: 'item_title3', orderable: false },
        { data: 'item_title4', orderable: false },
        {
          data: 'multiplier_total',
          orderable: false,
          render: function (data) {
            return data;
          }
        },
        {
          data: 'total_amount_items',
          render: function (data) {
            return data;
          }
        },
        {
          data: 'management_fee',
          orderable: false,
          render: (data) => {
            return this.formatRupiah(data);
          }
        },
        {
          data: 'sales_amount',
          render: (data) => {
            return this.formatRupiah(data);
          }
        },
        {
          data: 'vat_rate',
          render: function (data, type) {
            return type === 'display' ? data + "%" : data;
          }
        },
        {
          data: 'vat',
          render: (data) => {
            return this.formatRupiah(data);
          }
        },
        {
          data: 'invoice_amount',
          render: (data) => {
            return this.formatRupiah(data);
          }
        },
        {
          data: 'actions',
          orderable: false
        }
      ]
    });
  }

  initPlugins() {
  }

  showLoading() {
    if (!this.loadingEl) {
      this.loadingEl = document.createElement("div");
      this.loadingEl.className = "c-form-loading-overlay";
      this.loadingEl.innerHTML = `
      <div class="c-form-spinner"></div>
    `;
      Object.assign(this.loadingEl.style, {
        position: "absolute",
        top: 0,
        left: 0,
        width: "100%",
        height: "100%",
        background: "rgba(255,255,255,0.7)",
        display: "flex",
        justifyContent: "center",
        alignItems: "center",
        zIndex: 9999
      });
      this.form.appendChild(this.loadingEl);
    }
    this.loadingEl.style.display = "flex";
  }

  hideLoading() {
    if (this.loadingEl) {
      this.loadingEl.style.display = "none";
    }
  }

  resetForm() {
    this.mode = "create";
    this.data = {};
    this.projects = [];
    this.form.innerHTML = "";
    this.errors = {};
  }

  // ---------------------------------------- HELPERS ----------------------------------------
  formatRupiah(angka) {
    if (angka === null || angka === undefined || angka === '') return '';

    const num = Number(angka);
    if (isNaN(num)) return '';

    // Cek apakah ada desimal
    const hasDecimal = angka.toString().includes('.') || angka.toString().includes(',');
    return num.toLocaleString('id-ID', {
      minimumFractionDigits: hasDecimal ? 2 : 0,
      maximumFractionDigits: hasDecimal ? 2 : 0
    });
  }

  // ---------------------------------------- DATA & SUBMISSION ----------------------------------------
  resetErrorFields() {
    const errKeys = Object.keys(this.errors);
    if (errKeys.length) {
      errKeys.forEach(v => {
        const el = this.form.querySelector(`#${v}`);
        if (el) {
          el.innerText = "";
          el.style.display = "none";
        }
      });
    }
    this.errors = {};
  }

  validateFields() {
    this.resetErrorFields();

    const project_id = this.form.querySelector("#input_project_id");
    const type_of_sales_code = this.form.querySelector("#input_type_of_sales_code");
    const year_of_sales = this.form.querySelector("#input_year_of_sales");
    const date_from = this.form.querySelector("#input_date_from");
    const date_to = this.form.querySelector("#input_date_to");
    const destination = this.form.querySelector("#input_destination");
    const city = this.form.querySelector("#input_city");
    const activity = this.form.querySelector("#input_activity");
    const status = this.form.querySelector("#input_status");


    const payload = {
      project_id: parseInt(project_id.value) || null,
      type_of_sales_code: type_of_sales_code.value,
      year_of_sales: year_of_sales.value,
      date_from: date_from.value ? moment(date_from.value, 'DD/MM/YY').format('YYYY-MM-DD') : date_from.value,
      date_to: date_to.value ? moment(date_to.value, 'DD/MM/YY').format('YYYY-MM-DD') : date_to.value,
      destination: destination.value,
      city: city.value.trim(),
      activity: activity.value,
      status: status.value,
    };

    if (!payload.project_id) {
      this.errors["input_project_id_error"] = "Project is required."
    }

    if (!payload.type_of_sales_code) {
      this.errors["input_type_of_sales_code_error"] = "Type of Sales Code is required."
    }

    if (!payload.date_from) {
      this.errors["input_date_from_error"] = "Start Date is required."
    }

    if (!payload.date_to) {
      this.errors["input_date_to_error"] = "End Date is required."
    }

    if (!payload.destination) {
      this.errors["input_destination_error"] = "Destination is required."
    }

    if (!payload.city) {
      this.errors["input_city_error"] = "City is is required."
    }

    if (!payload.activity) {
      this.errors["input_activity_error"] = "Activity is required."
    }

    if (!payload.status) {
      this.errors["input_status_error"] = "Status is required."
    }

    return payload;
  }

  async handleSubmit() {
    if (this.isFetching) return;
    this.isFetching = true;
    this.showLoading();

    const payload = this.validateFields();
    const errKeys = Object.keys(this.errors);
    if (errKeys.length) {
      errKeys.forEach(v => {
        const el = document.getElementById(v);
        if (el) {
          el.innerText = this.errors[v];
          el.style.display = "block";
        }
      });
      this.isFetching = false;
      this.hideLoading()
      return;
    }

    console.log("Payload", payload);

    if (this.mode === "create") {
      try {
        const response = await fetch('/proposals', {
          method: 'POST',
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
          },
          body: JSON.stringify(payload)
        });

        const result = await response.json();

        if (response.ok && result.success) {
          toastr.success(response.message || 'Proposal created successfully!');
          $('#proposal_list').DataTable().ajax.reload();
          if (this.closeForm) this.closeForm.click();
          console.log('Proposal created:', result, result.data);
        } else {
          console.error('Failed:', result.message || result.errors);
        }
      } catch (err) {
        toastr.error('An error occurred while creating Proposal.');
        console.error('Error:', err);
      } finally {
        this.isFetching = false;
        this.hideLoading()
      }
    } else if (this.mode === "edit") {
      try {
        const response = await fetch(`/proposals/${this.data.id}`, {
          method: 'PUT',
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
          },
          body: JSON.stringify(payload)
        });

        const result = await response.json();

        if (response.ok && result.success) {
          toastr.success(response.message || 'Proposal updated successfully!');
          $('#proposal_list').DataTable().ajax.reload();

          // This function defined on projects.show.blade (for project detail page)
          try {
            loadProjectData(projectId)
          } catch (error) { }

          if (this.closeForm) this.closeForm.click();
          console.log('Proposal updated:', result, result.data);
        } else {
          console.error('Failed:', result.message || result.errors);
        }
      } catch (err) {
        toastr.error('An error occurred while updating Proposal.');
        console.error('Error:', err);
      } finally {
        this.isFetching = false;
        this.hideLoading()
      }
    } else {
      alert("Form mode is invalid, it shouldbe either \"create\" or \"edit\".");
      this.isFetching = false;
      this.hideLoading();
    }

    this.resetForm()
  }
}

// ----------------------------------------------- TRIGER -----------------------------------------------

document.addEventListener("DOMContentLoaded", () => {
  const appendBoqForm = new AppendBoqForm("c_append_boq_form");

  toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "3000",
    "extendedTimeOut": "1000",
    "hideDuration": "300",
    "showDuration": "300",
    "toastClass": "toast show alert alert-success"
  }

  document.addEventListener("click", async e => {
    const target = e.target;

    if (target.matches("#c_append_boq")) {
      appendBoqForm.resetForm();
      await appendBoqForm.init();
    }
  })
});