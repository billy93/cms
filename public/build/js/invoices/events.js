class InvoiceForm {
  isInit = true;
  selectedItems = [];
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

    // Watch invoice type change
    if (target.matches("#input_invoice_type")) {
      this.handleInvoiceTypeChange(target.value);
    }

    if (target.matches("#invoice_canvas_proposal_item_list #select_all_invoice_proposal_item")) {
      const checked = target.checked;

      if (!checked) {
        this.selectedItems = [];
      }

      document.querySelectorAll('#invoice_canvas_proposal_item_list input.row-check').forEach(el => {
        el.checked = checked;

        if (checked) {
          this.selectedItems.push({
            id: el.value,
            description: el.dataset.description
          });
        }
      });

      const unique = new Map(this.selectedItems.map(item => [item.id, item]));
      this.selectedItems = Array.from(unique.values());
      this.updateSelectedEl();
      this.checkAndAutoChangeType();
    } else if (target.matches("#invoice_canvas_proposal_item_list input.row-check")) {
      const checked = target.checked;

      if (!checked) {
        document.querySelector("#invoice_canvas_proposal_item_list #select_all_invoice_proposal_item").checked = false;
        this.selectedItems = this.selectedItems.filter(obj => obj.id !== target.value)
      } else {
        this.selectedItems.push({
          id: target.value,
          description: target.dataset.description
        });
      }

      const unique = new Map(this.selectedItems.map(item => [item.id, item]));
      this.selectedItems = Array.from(unique.values());
      this.updateSelectedEl();
      this.checkAndAutoChangeType();
    }
  }

  checkAndAutoChangeType() {
    let isAllSelected = true;

    if (this.proposal?.items?.length) {
      const currentItems = this.selectedItems.map(v => +v.id)
      const proposalItems = this.proposal.items.map(v => v.id)
      proposalItems.forEach(b => {
        if (!currentItems.includes(b)) {
          isAllSelected = false
        }
      })
    }

    const typeSelect = this.form.querySelector("#input_invoice_type");

    if (typeSelect && isAllSelected) {
      $(typeSelect).val("Full").trigger('change.select2');
      this.handleInvoiceTypeChange("Full");
    }
  }

  getProposalItemTableHTML() {
    if (this.data && this.mode === "edit" && this.data.items?.length) {
      this.selectedItems = this.data.items.map(item => ({
        id: item.id.toString(),
        description: item.description
      }));
    }

    let selectedProposalEl = "<li class='no-selected-tag'>No Selected Items</li>";

    if (this.selectedItems.length) {
      selectedProposalEl = this.selectedItems
        .map(obj => `<li class="selected-tag">${obj.description}</li>`)
        .join("");
    }

    return `
      <div>
        <label class="col-form-label">BoQ(s)</label>
        <ul id="selected_invoice_canvas_proposal_item" class="mt-2 mb-2">${selectedProposalEl}</ul>
      </div>
      <div style="border: 1px solid #e8e8e8; border-radius: 6px;">
        <div class="table-responsive custom-table">
          <table class="table" id="invoice_canvas_proposal_item_list">
            <thead class="thead-light">
              <tr>
                <th class="td-break no-sort" style="position: sticky; z-index: 1;">
                  <label class="checkboxs">
                    <input type="checkbox" id="select_all_invoice_proposal_item">
                    <span class="checkmarks"></span>
                  </label>
                </th>
                <th class="td-break" style="width: 100%;">Item Description</th>
                <th class="td-break">Total Price</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
        <div class="row align-items-center" style="row-gap: 1em; padding: 10px 15px;">
          <div class="col-md-6">
            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
              <div class="datatable-info"></div>
              <div class="invoice-canvas-table-proposal-item-length"></div>
            </div>
          </div>
          <div class="col-md-6 flex-grow-1">
            <div class="invoice-canvas-table-proposal-item-paginate"></div>
          </div>
        </div>
      </div>
      <small id="invoice_proposal_item_error" class="text-danger mt-1" style="display: none;"></small>
    `;
  }

  handleInvoiceTypeChange(type) {
    const proposalItemSection = document.getElementById("invoice_canvas_proposal_item_section");
    const alertInfo = document.getElementById("invoice_type_alert_container");

    // Update alert info
    if (alertInfo) {
      if (type === "Full") {
        alertInfo.innerHTML = `
          <div class="alert alert-info">
            <i class="ti ti-info-circle me-2"></i>
            Full Invoice: All available Items will be automatically included.
          </div>`;
      } else {
        alertInfo.innerHTML = `
          <div class="alert alert-info">
            <i class="ti ti-info-circle me-2"></i>
            Partial Invoice: Please select specific Items to include in this invoice.
          </div>`;
      }
    }

    $(proposalItemSection).empty();

    if (type === "Full") {
      this.selectedItems = [];
    } else {
      $(proposalItemSection).append(this.getProposalItemTableHTML());
      // Initialize DataTable for Partial
      this.initDataTable();
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
    this.initPlugins();
    this.isInit = false;
    this.hideLoading();

    // Trigger initial invoice type change to set correct visibility
    const typeSelect = this.form.querySelector("#input_invoice_type");
    if (typeSelect) {
      this.handleInvoiceTypeChange(typeSelect.value);
    }
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
    }

    // Check if 'Full' type allowed
    // Full is allowed only if there are NO other active invoices.
    let isFullAllowed = true;
    const allInvoices = this.proposal?.invoices || [];
    const currentInvoiceId = this.mode === 'edit' ? this.data?.id : null;

    const otherActiveInvoices = allInvoices.filter(inv => {
      // Ignore current invoice
      if (currentInvoiceId && +inv.id === +currentInvoiceId) return false;
      // Ignore cancelled invoices (optional, but typical)
      if (inv.status === 'Cancelled') return false;
      return true;
    });

    if (otherActiveInvoices.length > 0) {
      isFullAllowed = false;
      // Force type to Partial if Full was selected/defaulted but not allowed
      if (value.type === 'Full') {
        value.type = 'Partial';
      }
    }

    let typeOptions = isFullAllowed ? ["Full", "Partial"] : ["Partial"];

    // Type A: Only "Full" allowed
    if (this.proposal?.pricing_model === 'A' || this.data?.proposal?.pricing_model === 'A') {
      typeOptions = ["Full"];
      value.type = "Full";
    }

    const selectTypeOptions = typeOptions.map(t => {
      return `<option value="${t}" ${t === value.type ? "selected" : ""}>${t}</option>`;
    });

    const selectStatusOptions = ["Unpaid", "Paid", "Cancelled"].map(t => {
      return `<option value="${t}" ${t === value.status ? "selected" : ""}>${t}</option>`;
    });

    return `
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label class="col-form-label">Project Name<span class="text-danger">*</span></label>
            <input type="text" id="input_invoice_project_name" class="form-control btn-disabled" value="${value.project_name}" disabled>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="col-form-label">Customer<span class="text-danger">*</span></label>
            <input type="text" id="input_invoice_customer" class="form-control btn-disabled" value="${value.customer_name}" disabled>
            <small id="input_invoice_customer_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="col-form-label">Proposal Code<span class="text-danger">*</span></label>
            <input type="text" id="input_invoice_proposal_code" class="form-control btn-disabled" value="${value.proposal_code}" disabled>
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
        <div class="col-md-12 mb-3" id="invoice_type_alert_container"></div>
        <div class="col-md-12 mb-3" id="invoice_canvas_proposal_item_section">
          ${value.type === "Full" ? "" : this.getProposalItemTableHTML()}
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
    const el = this.form.querySelector("#selected_invoice_canvas_proposal_item");
    if (el) {
      if (this.selectedItems.length) {
        el.innerHTML = this.selectedItems
          .map(obj => `<li class="selected-tag">${obj.description}</li>`)
          .join("");
      } else {
        el.innerHTML = `<li class="no-selected-tag">No Selected Item</li>`;
      }
    }
  }

  initDataTable() {
    const self = this;
    const $table = $('#invoice_canvas_proposal_item_list');
    let data = [];

    if (this.proposal && this.proposal.items && this.mode === "create") {
      data = this.proposal?.items?.filter(item => !item.invoice_id);
    } else if (this.data?.proposal?.items && this.mode === "edit") {
      data = this.data.proposal.items.filter(item => !item.invoice_id || this.data.items.some(b => b.id === item.id));
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
        emptyTable: "No Items available for billing.",
        paginate: {
          next: 'Next <i class="fa fa-angle-right"></i>',
          previous: '<i class="fa fa-angle-left"></i> Prev'
        },
      },
      initComplete: function (settings, json) {
        const $wrapper = $(settings.nTable).closest('.dataTables_wrapper');
        $wrapper.find('.dataTables_paginate').appendTo('.invoice-canvas-table-proposal-item-paginate');
        $wrapper.find('.dataTables_length').appendTo('.invoice-canvas-table-proposal-item-length');
      },
      data,
      columns: [
        {
          data: 'id',
          render: function (data, type, row) {
            const checked = self.selectedItems.some(obj => +obj.id === data);
            return `
            <label class="checkboxs">
              <input type="checkbox" class="row-check" ${checked ? "checked" : ""} value="${data}" data-description="${row.description}">
              <span class="checkmarks"></span>
            </label>
          `;
          }
        },
        { data: 'description' },
        {
          data: 'total_price',
          render: data => formatRupiahDisplay(data.toString().replace(".", ","))
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

      // bridge event agar change bisa dideteksi
      $('.select').on('select2:select', function () {
        this.dispatchEvent(new Event('change', { bubbles: true }));
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
    this.selectedItems = [];
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

    // Only send item_ids for Partial invoice type
    if (payload.type === "Partial") {
      payload.item_ids = this.selectedItems.map(obj => obj.id);

      // Validate Item selection for Partial type
      if (!payload.item_ids.length) {
        this.errors["invoice_proposal_item_error"] = "Please select at least one Item for partial invoice.";
      }
    }
    // For Full type, don't send item_ids - backend will auto-select all

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
          showToast("error", `${result.errors?.item_ids || result.message}`);
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
          showToast("error", `${result.errors?.item_ids || result.message}`);
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
          const proposal_id = target.dataset.proposal_id
          const invoiceUrl = target.dataset.url;

          try {
            proposal_id = PROPOSAL_ID;
          } catch (error) { }


          const [invoiceRes, proposalRes] = await Promise.all([
            fetch(invoiceUrl, {
              headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
              },
            }),
            fetch(`/proposals/${proposal_id}`, {
              headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
              },
            })
          ]);

          const [invoiceJson, proposalJson] = await Promise.all([
            invoiceRes.json(),
            proposalRes.json()
          ]);

          if (
            invoiceRes.ok && invoiceJson.success &&
            proposalRes.ok && proposalJson.success
          ) {
            const invoice = invoiceJson.data;
            const proposal = proposalJson.data;
            INVOICE_CANVAS_BS.show();
            INVOICE_FORM.resetForm();
            await INVOICE_FORM.init("edit", proposal, invoice);
          } else {
            if (!invoiceRes.ok || !invoiceJson.success) {
              showToast("error", invoiceJson?.message || "Failed to fetch invoice data.");
            } else if (!proposalRes.ok || !proposalJson.success) {
              showToast("error", proposalJson?.message || "Failed to fetch proposal data.");
            } else {
              showToast("error", "Failed to fetch required data.");
            }
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