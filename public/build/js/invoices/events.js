class InvoiceForm {
  isInit = true;
  selectedBoqs = [];
  isSubmitting = false;
  mode = "create";
  proposal = {};
  data = {};
  errors = {};

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeForm = document.getElementById("c_invoice_canvas_close_btn");
    this.handleSubmit = this.handleSubmit.bind(this);

    this.handleDocumentChange = this.handleDocumentChange.bind(this);
    this.form.addEventListener("submit", (e) => {
      e.preventDefault();
      this.handleSubmit()
    });

    document.addEventListener("change", this.handleDocumentChange);
  }

  // ---------------------------------------- GLOBAL HANDLER ----------------------------------------
  async handleDocumentChange(e) {
    const target = e.target;

    if (target.matches("#invoice_canvas_boq_list #select_all_invoice_boq")) {
      const checked = target.checked;

      if (!checked) {
        this.selectedBoqs = [];
      }

      document.querySelectorAll('#invoice_canvas_boq_list input.row-check').forEach(el => {
        el.checked = checked;

        if (checked) {
          this.selectedBoqs.push({
            id: el.value,
            code: el.dataset.code
          });
        }
      });

      const unique = new Map(this.selectedBoqs.map(item => [item.id, item]));
      this.selectedBoqs = Array.from(unique.values());
      this.updateSelectedEl();
    } else if (target.matches("#invoice_canvas_boq_list input.row-check")) {
      const checked = target.checked;

      if (!checked) {
        document.querySelector("#invoice_canvas_boq_list #select_all_invoice_boq").checked = false;
        this.selectedBoqs = this.selectedBoqs.filter(obj => obj.id !== target.value)
      } else {
        this.selectedBoqs.push({
          id: target.value,
          code: target.dataset.code
        });
      }

      const unique = new Map(this.selectedBoqs.map(item => [item.id, item]));
      this.selectedBoqs = Array.from(unique.values());
      this.updateSelectedEl();
    }
  }

  // ---------------------------------------- INIT ----------------------------------------
  async init(mode = "create", proposal = {}, data = {}) {
    this.resetForm();
    this.showLoading();
    this.mode = mode;
    this.proposal = proposal;
    this.data = data;

    const formWrapper = document.createElement("div");
    formWrapper.innerHTML = this.generateForm();
    this.form.appendChild(formWrapper);
    this.initDataTable();
    this.initPlugins();
    this.isInit = false;
    this.hideLoading();
  }

  // ---------------------------------------- DOM ----------------------------------------
  generateForm() {

    let value = {
      project_name: "",
      customer_name: "",
      proposal_code: "",
      type: "Full",
      status: "Unpaid",
      invoice_date: "",
      due_date: "",
      bill_to: "",
      ship_to: "",
      payment_method: "",
      note: "",
    }

    // Create With Proposal Data 
    if (this.proposal && this.mode === "create") {
      value.project_name = this.proposal.project?.name || "";
      value.customer_name = this.proposal.project?.customer?.name || "";
      value.proposal_code = this.proposal.code || "";
    }

    if (this.data && this.mode === "edit") {
      value.project_name = this.data.proposal?.project?.name || "";
      value.customer_name = this.data.customer?.name || "";
      value.proposal_code = this.data.proposal?.code || "";
      value.type = this.data?.type || "Full";
      value.status = this.data?.status || "Unpaid";
      value.invoice_date = this.data?.invoice_date || "";
      value.due_date = this.data?.due_date || "";
      value.bill_to = this.data?.bill_to || "";
      value.ship_to = this.data?.ship_to || "";
      value.payment_method = this.data?.payment_method || "";
      value.note = this.data?.note || "";

      if (this.data.boqs && this.data.boqs.length) {
        this.selectedBoqs = this.data.boqs.map(boq => ({
          id: boq.id.toString(),
          code: boq.code
        }));
      }
    }

    let selectedBoqEl = "<li class='no-selected-tag'>No Selected BoQ</li>";

    if (this.selectedBoqs.length) {
      selectedBoqEl = this.selectedBoqs
        .map(obj => `<li class="selected-tag">${obj.code}</li>`)
        .join("");
    }

    const selectTypeOptions = ["Full", "Partial"].map(t => {
      return `<option value="${t}" ${t === value.type ? "selected" : ""}>${t}</option>`;
    });

    const selectStatusOptions = ["Unpaid", "Paid", "Cancelled"].map(t => {
      return `<option value="${t}" ${t === value.status ? "selected" : ""}>${t}</option>`;
    });

    return `
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label class="col-form-label">Project Name</label>
            <div class="icon-form">
              <span class="form-icon"><i class="ti ti-calendar-event"></i></span>
              <input type="text" id="input_invoice_project_name" class="form-control btn-disabled" value="${value.project_name}" disabled>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="col-form-label">Customer<span class="text-danger">*</span></label>
            <div class="icon-form">
              <span class="form-icon"><i class="ti ti-calendar-event"></i></span>
              <input type="text" id="input_invoice_customer" class="form-control btn-disabled" value="${value.customer_name}" disabled>
            </div>
            <small id="input_invoice_customer_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="col-form-label">Proposal Code<span class="text-danger">*</span></label>
            <div class="icon-form">
              <span class="form-icon"><i class="ti ti-calendar-event"></i></span>
              <input type="text" id="input_invoice_proposal_code" class="form-control btn-disabled" value="${value.proposal_code}" disabled>
            </div>
            <small id="input_invoice_proposal_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="col-form-label">Type<span class="text-danger">*</span></label>
            <select id="input_invoice_type" class="select form-control">
              ${selectTypeOptions}
            </select>
            <small id="input_invoice_type_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="col-form-label">Status<span class="text-danger">*</span></label>
            <select id="input_invoice_status" class="select form-control">
              ${selectStatusOptions}
            </select>
            <small id="input_invoice_status_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="col-form-label">Invoice Date<span class="text-danger">*</span></label>
            <div class="icon-form">
              <span class="form-icon"><i class="ti ti-calendar-event"></i></span>
              <input id="input_invoice_invoice_date" type="text" class="form-control datetimepicker" placeholder="DD/MM/YY" value="${value.invoice_date}">
            </div>
            <small id="input_invoice_invoice_date_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="col-form-label">Due Date<span class="text-danger">*</span></label>
            <div class="icon-form">
              <span class="form-icon"><i class="ti ti-calendar-event"></i></span>
              <input id="input_invoice_due_date" type="text" class="form-control datetimepicker" placeholder="DD/MM/YY" value="${value.due_date}">
            </div>
            <small id="input_invoice_due_date_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
        <div class="col-md-12" id="invoice_canvas_boq_section">
          <div>
            <label class="col-form-label">BoQ(s)</label>
            <ul id="selected_invoice_canvas_boq" class="mt-2 mb-2">${selectedBoqEl}</ul>
          </div>
          <div style="border: 1px solid #e8e8e8; border-radius: 6px;">
            <div class="table-responsive custom-table">
              <table class="table" id="invoice_canvas_boq_list">
                <thead class="thead-light">
                  <tr>
                    <th class="td-break no-sort" style="position: sticky; z-index: 1;">
                      <label class="checkboxs">
                        <input type="checkbox" id="select_all_invoice_boq">
                        <span class="checkmarks"></span>
                      </label>
                    </th>
                    <th class="td-break">BOQ Code</th>
                    <th class="td-break">Basic Price</th>
                    <th class="td-break">Management Fee</th>
                    <th class="td-break">Sales Amount</th>
                    <th class="td-break">VAT Rate</th>
                    <th class="td-break">VAT</th>
                    <th class="td-break">Invoice Amount</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
            <div class="row align-items-center" style="row-gap: 1em; padding: 10px 15px;">
              <div class="col-md-6">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                  <div class="datatable-info"></div>
                  <div class="invoice-canvas-table-boq-length"></div>
                </div>
              </div>
              <div class="col-md-6 flex-grow-1">
                <div class="invoice-canvas-table-boq-paginate"></div>
              </div>
            </div>
          </div>
          <small id="invoice_boq_error" class="text-danger mt-1" style="display: none;"></small>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="col-form-label">Bill To</label>
            <input type="text" id="input_invoice_bill_to" class="form-control" value="${value.bill_to}">
            <small id="input_invoice_bill_to_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="col-form-label">Ship To</label>
            <input type="text" id="input_invoice_ship_to" class="form-control" value="${value.ship_to}">
            <small id="input_invoice_ship_to_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="col-form-label">Payment Method</label>
            <input type="text" id="input_invoice_payment_method" class="form-control" value="${value.payment_method}">
            <small id="input_invoice_payment_method_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
        <div class="col-md-12">
          <div class="mb-3">
            <label class="col-form-label">Notes</label>
            <textarea class="form-control" id="input_invoice_note">${value.note}</textarea>
            <small id="input_invoice_note_error" class="text-danger mt-1" style="display: none;"></small>
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
    const el = this.form.querySelector("#selected_invoice_canvas_boq");
    if (el) {
      if (this.selectedBoqs.length) {
        el.innerHTML = this.selectedBoqs
          .map(obj => `<li class="selected-tag">${obj.code}</li>`)
          .join("");
      } else {
        el.innerHTML = `<li class="no-selected-tag">No Selected BoQ</li>`;
      }
    }
  }

  initDataTable() {
    const self = this;
    const $table = $('#invoice_canvas_boq_list');
    let data = [];

    if (this.proposal && this.proposal.boqs && this.mode === "create") {
      data = this.proposal?.boqs?.filter(boq => !boq.invoice_id);
    } else if (this.data?.proposal?.boqs && this.mode === "edit") {
      data = this.data.proposal.boqs.filter(boq => !boq.invoice_id || this.data.boqs.some(b => b.id === boq.id));
    }

    // 🔹 Kalau DataTable sudah ada → cuma update data-nya
    if ($.fn.DataTable.isDataTable($table)) {
      const dt = $table.DataTable();
      const currentPage = dt.page(); // simpan halaman sekarang

      dt.clear();
      dt.rows.add(data);
      dt.draw(false); // false = jangan reset pagination
      dt.page(currentPage).draw('page'); // balik ke halaman yang sama
      return; // selesai, gak usah reinit
    }

    // 🚀 Kalau belum ada → inisialisasi pertama kali
    $table.DataTable({
      bFilter: false,
      bInfo: false,
      ordering: true,
      order: [[0, "desc"]],
      language: {
        search: ' ',
        sLengthMenu: '_MENU_',
        searchPlaceholder: "Search",
        info: "_START_ - _END_ of _TOTAL_ items",
        lengthMenu: "Show _MENU_ entries",
        emptyTable: "No BOQs available for billing.",
        paginate: {
          next: 'Next <i class="fa fa-angle-right"></i>',
          previous: '<i class="fa fa-angle-left"></i> Prev'
        },
      },
      initComplete: function (settings, json) {
        const $wrapper = $(settings.nTable).closest('.dataTables_wrapper');
        $wrapper.find('.dataTables_paginate').appendTo('.invoice-canvas-table-boq-paginate');
        $wrapper.find('.dataTables_length').appendTo('.invoice-canvas-table-boq-length');
      },
      data,
      columns: [
        {
          data: 'id',
          render: function (data, type, row) {
            const checked = self.selectedBoqs.some(obj => +obj.id === data);
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
          data: 'total_amount_items',
          render: data => formatRupiah(data)
        },
        {
          data: 'management_fee',
          orderable: false,
          render: (data, type, row) => {
            if (type === 'display') {
              let amount = data;
              if (row.management_fee_type === 'percent') {
                amount = (row.total_amount_items * data) / 100;
              }
              return formatRupiah(amount);
            }
            return data;
          }
        },
        {
          data: 'sales_amount',
          render: data => formatRupiah(data)
        },
        {
          data: 'vat_rate',
          render: (data, type) => (type === 'display' ? data + "%" : data)
        },
        {
          data: 'vat',
          render: data => formatRupiah(data)
        },
        {
          data: 'invoice_amount',
          render: data => formatRupiah(data)
        },
      ]
    });
  }


  initPlugins() {
    if (window.$ && $.fn.select2) {
      $('.select').select2({
        width: '100%',
        dropdownParent: $('#c_invoice_canvas_form')
      });
    }

    if ($('.datetimepicker').length && $.fn.datetimepicker) {
      $('.datetimepicker').each(function () {
        const el = $(this);
        const rawValue = el.val();
        const isIso = rawValue && moment(rawValue, moment.ISO_8601, true).isValid();
        const parsedDate = isIso ? moment(rawValue) : null;

        el.datetimepicker({
          format: 'DD/MM/YY',
          date: parsedDate || null,
        });

        if (isIso) {
          el.val(parsedDate.format('DD/MM/YY'));
        }
      });
    }
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
    this.isInit = true;
    this.selectedBoqs = [];
    this.isSubmitting = false;
    this.mode = "create";
    this.proposal = {};
    this.data = {};
    this.errors = {};
    this.form.innerHTML = "";
    this.loadingEl = null;
  }

  // ---------------------------------------- DATA & SUBMISSION ----------------------------------------
  resetErrorFields() {
    const errKeys = Object.keys(this.errors);
    if (errKeys.length) {
      errKeys.forEach(v => {
        const el = this.form.querySelector(`#${v}`);
        if (el) {
          el.textContent = "";
          el.style.display = "none";
        }
      });
    }
    this.errors = {};
  }

  validateFields() {
    this.resetErrorFields();
    const payload = {};

    payload.proposal_id = this.proposal?.id || null;
    payload.customer_id = this.proposal?.project?.customer?.id || null;
    payload.boq_ids = this.selectedBoqs.map(obj => obj.id);

    if (this.mode === "edit") {
      payload.proposal_id = this.data?.proposal_id || null;
      payload.customer_id = this.data?.customer_id || null;
    }

    if (!payload.proposal_id) {
      this.errors["input_invoice_proposal_error"] = "Proposal ID is required.";
    }

    if (!payload.customer_id) {
      this.errors["input_invoice_customer_error"] = "Customer ID is required.";
    }

    if (!payload.boq_ids.length) {
      this.errors["invoice_boq_error"] = "Please select at least one BOQ.";
    }

    const inputs = [
      {
        field: "input_invoice_type",
        required: true
      },
      {
        field: "input_invoice_status",
        required: true
      },
      {
        field: "input_invoice_invoice_date",
        date: true,
        required: true,
      },
      {
        field: "input_invoice_due_date",
        date: true,
        required: true,
      },
      {
        field: "input_invoice_bill_to",
        required: false
      },
      {
        field: "input_invoice_ship_to",
        required: false
      },
      {
        field: "input_invoice_payment_method",
        required: false
      },
      {
        field: "input_invoice_note",
        required: false
      },
    ];

    inputs.forEach(id => {
      const el = this.form.querySelector("#" + id.field);
      let value = el ? el.value.trim() : "";

      if (value && id.date) {
        value = moment(value, 'DD/MM/YY').format('YYYY-MM-DD')
      }

      payload[id.field.replace("input_invoice_", "")] = value;

      if (!value && id.required) {
        this.errors[id.field + "_error"] = "This field is required.";
      }
    });

    return payload;
  }

  async handleSubmit() {
    if (this.isSubmitting) return;
    this.isSubmitting = true;
    this.showLoading();

    const payload = this.validateFields();
    const errKeys = Object.keys(this.errors);

    if (errKeys.length) {
      errKeys.forEach(v => {
        const el = this.form.querySelector("#" + v);
        if (el) {
          el.innerText = this.errors[v];
          el.style.display = "block";
        }
      });
      this.hideLoading();
      this.initDataTable();
      this.isSubmitting = false;

      return;
    }

    if (this.mode === "create") {
      try {
        const response = await fetch("/invoices", {
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
          try {
            // On proposal.detail page
            loadProposalData(PROPOSAL_ID);
          } catch (error) { }

          $('#proposal_list').DataTable().ajax.reload(); // On proposal index page 
          showToast("success", result.message || 'Invoice created successfully!');
          if (this.closeForm) this.closeForm.click();
          this.resetForm();
        } else {
          showToast("error", `${result.errors?.boq_ids || result.message}`);
        }
      } catch (err) {
        showToast("error", 'An error occurred while creating Invoice.');
      } finally {
        this.isSubmitting = false;
        this.hideLoading()
      }
    } else if (this.mode === "edit") {
      try {
        const response = await fetch(`/invoices/${this.data.id}`, {
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
          try {
            // On proposal.detail page
            loadProposalData(PROPOSAL_ID);
          } catch (error) { }

          $('#invoice_list').DataTable().ajax.reload(null, false);
          showToast("success", result.message || 'Invoice created successfully!');
          if (this.closeForm) this.closeForm.click();
          this.resetForm();
        } else {
          showToast("error", `${result.errors?.boq_ids || result.message}`);
        }
      } catch (err) {
        showToast("error", 'An error occurred while creating Invoice.');
      } finally {
        this.isSubmitting = false;
        this.hideLoading()
      }
    }
  }
}

// ----------------------------------------------- TRIGER -----------------------------------------------
document.addEventListener("DOMContentLoaded", () => {
  const INVOICE_CANVAS = document.querySelector("#c_invoice_canvas");
  const INVOICE_MODAL = document.querySelector("#c_invoice_modal");
  const INVOICE_FORM = INVOICE_CANVAS?.querySelector("form#c_invoice_canvas_form")
    ? new InvoiceForm("c_invoice_canvas_form")
    : null;
  const INVOICE_CANVAS_BS = INVOICE_CANVAS ? new bootstrap.Offcanvas(INVOICE_CANVAS) : null;
  const INVOICE_MODAL_BS = INVOICE_MODAL ? new bootstrap.Modal(INVOICE_MODAL) : null;

  document.addEventListener("click", async e => {
    let target = e.target;

    // CREATE
    if (target.matches("#c_invoice_create_btn")) {
      e.preventDefault();
      if (INVOICE_CANVAS_BS && INVOICE_FORM && !IS_FETCHING) {
        IS_FETCHING = true;

        try {
          const url = target.dataset.url;
          const resopnse = await fetch(url, {
            headers: {
              "Accept": "application/json",
            },
          });
          const resJson = await resopnse.json();

          if (resopnse.ok && resJson.success) {
            const proposal = resJson.data;
            INVOICE_CANVAS_BS.show();
            INVOICE_FORM.resetForm();
            await INVOICE_FORM.init("create", proposal);
          } else {
            showToast("error", resJson.message || "Failed to retrieve proposal data for invoice creation.");
          }
        } catch (error) {
          showToast("error", "An error occurred while retrieving proposal data for invoice creation.");
        } finally {
          IS_FETCHING = false;
        }
      }
    }

    // EDIT
    else if (target.closest(".c_invoice_edit_btn")) {
      target = target.closest(".c_invoice_edit_btn");
      e.preventDefault();
      if (INVOICE_CANVAS_BS && INVOICE_FORM && !IS_FETCHING) {
        IS_FETCHING = true;

        try {
          const url = target.dataset.url;
          const resopnse = await fetch(url, {
            headers: {
              "Accept": "application/json",
            }
          });
          const resJson = await resopnse.json();

          if (resopnse.ok && resJson.success) {
            const invoice = resJson.data;
            INVOICE_CANVAS_BS.show();
            INVOICE_FORM.resetForm();
            await INVOICE_FORM.init("edit", {}, invoice);
          } else {
            showToast("error", resJson.message || "Failed to fetch invoice data for editing.");
          }
        } catch (error) {
          showToast("error", "An error occurred while retrieving invoice data for invoice creation.");
        } finally {
          IS_FETCHING = false;
        }
      }
    }

    // DELETE
    else if (target.closest(".c_invoice_delete_btn")) {
      target = target.closest(".c_invoice_delete_btn");
      e.preventDefault();
      if (INVOICE_MODAL && INVOICE_MODAL_BS) {
        const url = target.dataset.url;
        const confirmBtn = INVOICE_MODAL.querySelector("#c_invoice_modal_confirm_btn");
        confirmBtn.dataset.url = url;
        INVOICE_MODAL_BS.show();
      }
    }

    // CONFIRM DELETE 
    else if (target.matches("#c_invoice_modal_confirm_btn")) {
      e.preventDefault();
      if (INVOICE_MODAL_BS && !IS_FETCHING) {
        IS_FETCHING = true;

        try {
          const url = target.dataset.url;
          const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

          const resopnse = await fetch(url, {
            method: "DELETE",
            headers: {
              "X-CSRF-TOKEN": csrfToken,
              "Accept": "application/json"
            }
          });
          const resJson = await resopnse.json();

          if (resopnse.ok && resJson.success) {
            try {
              // On proposal.detail page
              loadProposalData(PROPOSAL_ID);
            } catch (error) { }

            $('#invoice_list').DataTable().ajax.reload(null, false);
            showToast("success", resJson.message || "Invoice deleted successfully.");
            INVOICE_MODAL_BS.hide();
          } else {
            showToast("error", resJson.message || "Failed to delete invoice.");
          }
        } catch (error) {
          showToast("error", "An error occurred while deleting the invoice.");
        } finally {
          IS_FETCHING = false;
        }
      }
    }
  })
});