class BoqForm {
  isInit = true;
  mode = "create";
  data = {};
  products = [];
  proposals = [];
  isFetching = false;
  rowCount = 0;
  rowArr = [];
  errors = {};

  units = [
    'Kg',
    'Bag',
    'Month',
    'Night',
    'Room',
    'Hour',
    'Day',
    'Item',
    'Participant',
    'Unit',
    'Package',
    'Pcs',
    'Person',
    'Time',
    'Event',
    'Pairs'
  ];

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeForm = document.getElementById("c_boq_canvas_close_btn");

    this.validateFields = this.validateFields.bind(this);
    this.handleDocumentChange = this.handleDocumentChange.bind(this);
    this.handleDocumentKeydown = this.handleDocumentKeydown.bind(this);
    this.handleDocumentInput = this.handleDocumentInput.bind(this);
    this.handleDocumentBlur = this.handleDocumentBlur.bind(this);
    this.handleDocumentClick = this.handleDocumentClick.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);

    this.form.addEventListener("submit", (e) => {
      e.preventDefault();
      this.handleSubmit();
    });

    document.addEventListener("change", this.handleDocumentChange);
    document.addEventListener("keydown", this.handleDocumentKeydown);
    document.addEventListener("input", this.handleDocumentInput);
    document.addEventListener("blur", this.handleDocumentBlur, true);
    document.addEventListener("click", this.handleDocumentClick);
  }


  async handleDocumentChange(e) {
    const target = e.target;
    if (target.matches(`.boq-product-select`)) {
      const rowId = target.dataset.rowId;
      const productId = parseInt(target.value);
      const product = this.products.find(p => p.id === productId);
      const unitPriceEl = this.form.querySelector(`#input_boq_item_unit_price_${rowId}`);
      const sellingPriceEl = this.form.querySelector(`#input_boq_item_selling_price_${rowId}`);
      const qtyUnitEl = this.form.querySelector(`#input_boq_item_qty_unit_${rowId}`);
      const descEl = this.form.querySelector(`#input_boq_item_description_${rowId}`);

      if (product) {
        const price = product.active_price_version?.price || "";
        if (unitPriceEl) {
          unitPriceEl.value = formatRupiahDisplay(price.toString().replace('.', ','));
        }
        if (sellingPriceEl) {
          sellingPriceEl.value = formatRupiahDisplay(price.toString().replace('.', ','));
        }
        if (qtyUnitEl) {
          if (qtyUnitEl.tagName === 'SELECT') {
            const prodUnitLower = (product.unit || "").toLowerCase();
            const match = Array.from(qtyUnitEl.options).find(opt => opt.value.toLowerCase() === prodUnitLower);
            const valToSet = match ? match.value : "";
            $(qtyUnitEl).val(valToSet).trigger('change');
          } else {
            qtyUnitEl.value = product.unit || "";
          }
        }
        if (descEl) descEl.value = product.description || "";
      } else {
        if (unitPriceEl) unitPriceEl.value = "0";
        if (sellingPriceEl) {
          sellingPriceEl.value = "0";
        }
        if (qtyUnitEl) {
          if (qtyUnitEl.tagName === 'SELECT') $(qtyUnitEl).val('').trigger('change');
          else qtyUnitEl.value = "";
        }
        if (descEl) descEl.value = "";
      }
      this.recalculate();
    }
  }

  handleDocumentKeydown(e) {
    const target = e.target;
    if (target.matches(`.selling-price-input`)) {
      if (e.ctrlKey || e.metaKey || e.altKey) return;

      const k = e.key;

      if (
        k === "Backspace" ||
        k === "Delete" ||
        k === "ArrowLeft" ||
        k === "ArrowRight" ||
        k === "Home" ||
        k === "End" ||
        k === "Tab"
      ) return;

      if (!/[\d,]/.test(k)) e.preventDefault();
    }
  }

  handleDocumentInput(e) {
    const target = e.target;
    if (target.matches(`.selling-price-input`)) {

      const before = target.value;
      const caret = target.selectionStart;

      const norm = normalizeFormatRupiah(before);
      const formatted = formatRupiahDisplay(norm);

      target.value = formatted;

      const delta = formatted.length - before.length;
      target.setSelectionRange(caret + delta, caret + delta);
      this.recalculate();
    } else if (target.matches(".boq-number-input")) {
      let val = target.value;
      val = val.replace(/[^0-9]/g, "");
      target.value = val;
      this.recalculate();
    }
  }

  handleDocumentBlur(e) {
    // No default value enforcement to allow validation to work
  }

  handleDocumentClick(e) {
    const target = e.target;
    if (target.matches(`#boq_add_item_btn`)) {
      this.addRow();
    } else if (target.closest(`.boq-remove-item-btn`)) {
      const btn = target.closest(`.boq-remove-item-btn`);
      const rowId = btn.dataset.rowId;
      const rowEl = this.form.querySelector(`#boq_item_row_${rowId}`);
      if (rowEl) rowEl.remove();
      this.rowArr = this.rowArr.filter(id => id != rowId);
      this.recalculate();
    }
  }

  async fetchProposals() {
    this.isFetching = true;
    this.showLoading();
    return fetch("/proposals/all", {
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
      }
    })
      .then(response => {
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        return response.json();
      })
      .then(res => this.proposals = res.data)
      .catch(err => {
        console.error("Fetch proposals error:", err);
      })
      .finally(() => {
        this.isFetching = false
        if (!this.isInit) this.hideLoading();
      });
  }

  async fetchProducts() {
    this.isFetching = true;
    this.showLoading();
    return fetch("/products/all", {
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
      }
    })
      .then(response => {
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        return response.json();
      })
      .then(res => this.products = res.data)
      .catch(err => {
        console.error("Fetch categories error:", err);
      })
      .finally(() => {
        this.isFetching = false
        if (!this.isInit) this.hideLoading();
      });
  }

  async init(mode = "create", data = {}) {
    this.resetForm();
    this.showLoading();
    this.mode = mode;
    this.data = data;

    await Promise.all([this.fetchProducts(), this.fetchProposals()]);

    this.renderForm();
    this.initPlugins();
    this.isInit = false;
    this.hideLoading();
  }

  renderForm() {
    const isEdit = this.mode === "edit"
    let isDisableProposalField = false
    const value = {
      code: "",
      proposal_id: "",
    }

    if (isEdit && this.data) {
      value.code = this.data.code || "";
      value.proposal_id = this.data.proposal_id || "";
    }

    try {
      if (!value.proposal_id && PROPOSAL_ID) {
        value.proposal_id = PROPOSAL_ID;
      }
    } catch (error) { }

    try {
      if (PROPOSAL_ID) {
        isDisableProposalField = true;
      }
    } catch (error) { }

    this.form.innerHTML = `
      <div class="row">
        ${isEdit ? `
          <div class="col-md-6 mb-3">
            <label class="form-label">BOQ Code</label>
            <input type="text" class="form-control" value="${value.code}" disabled>
          </div>
        ` : ""}
        <div class="col-md-6 mb-3">
          <label class="form-label">Proposal</label>
          <select class="select form-select" id="input_boq_proposal_id" ${isDisableProposalField ? "disabled" : ""}>
            <option value="" ${!value.proposal_id ? "selected" : ""}>-- Select Proposal --</option>
            ${this.proposals.map(p => `<option value="${p.id}" ${value.proposal_id == p.id ? "selected" : ""}>${p.code}</option>`).join("")}
          </select>
          <small id="input_boq_proposal_id_error" class="text-danger mt-1" style="display: none;"></small>
        </div>
      </div>

      <div class="card p-3 mt-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="mb-0">Items</h5>
          <button type="button" class="btn btn-success btn-sm" id="boq_add_item_btn"><i class="ti ti-plus"></i> Add Item</button>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 25%;">Product</th>
                <th style="width: 25%;">Description</th>
                <th>Qty</th>
                <th>Freq</th>
                <th>Unit Price</th>
                <th>Selling Price</th>
                <th>Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody id="boq_items_body"></tbody>
            <tfoot>
              <tr>
                <th colspan="5" class="text-end">Grand Total</th>
                <th id="boq_grand_total_display">0</th>
                <th></th>
              </tr>
            </tfoot>
          </table>
          <small id="boq_items_error" class="text-danger mt-1" style="display: none;"></small>
        </div>
      </div>

      <div class="d-flex justify-content-end mt-4">
        <button type="button" class="btn btn-light me-2" data-bs-dismiss="offcanvas">Cancel</button>
        <button type="submit" class="btn btn-primary">Save BOQ</button>
      </div>
    `;

    if (isEdit && this.data.items) {
      this.data.items.forEach(item => this.addRow(item));
    } else {
      this.addRow();
    }
  }

  addRow(itemData = null) {
    const id = ++this.rowCount;
    this.rowArr.push(id);
    const tbody = this.form.querySelector("#boq_items_body");
    const tr = document.createElement("tr");
    tr.id = `boq_item_row_${id}`;

    const unitOptions = this.units.map(u => `<option value="${u}" ${itemData && itemData.qty_unit === u ? "selected" : ""}>${u}</option>`).join("");
    const freqUnitOptions = this.units.map(u => `<option value="${u}" ${itemData && itemData.freq_unit === u ? "selected" : ""}>${u}</option>`).join("");

    tr.innerHTML = `
      <td>
        <select class="select boq-product-select" data-row-id="${id}" id="input_boq_item_product_id_${id}">
          <option value="">-- Select Product --</option>
          ${this.products.map(p => `<option value="${p.id}" ${itemData && itemData.product_id == p.id ? "selected" : ""}>${p.name}</option>`).join("")}
        </select>
        <small id="input_boq_item_product_id_${id}_error" class="text-danger mt-1" style="display: none;"></small>
      </td>
      <td>
        <textarea class="form-control form-control" id="input_boq_item_description_${id}" rows="3" style="min-width: 200px;">${itemData ? itemData.description : ""}</textarea>
        <small id="input_boq_item_description_${id}_error" class="text-danger mt-1" style="display: none;"></small>
      </td>
      <td>
        <div class="input-group" style="min-width: 100px; flex-wrap: wrap; gap: 8px;">
          <div>
            <input type="text" class="form-control boq-number-input" id="input_boq_item_qty_${id}" value="${itemData ? itemData.qty : 1}" style="width: 100%; height: auto;">
            <small id="input_boq_item_qty_${id}_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
          <div style="width: 100%;">
            <select class="form-select text-center select" id="input_boq_item_qty_unit_${id}" style="width: 100%;" disabled>
              <option value="" ${!itemData?.qty_unit ? "selected" : ""}>-- Select Unit --</option>
              ${unitOptions}
            </select>
            <small id="input_boq_item_qty_unit_${id}_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
      </td>
      <td>
        <div class="input-group" style="min-width: 100px; flex-wrap: wrap; gap: 8px;">
          <div>
            <input type="text" class="form-control boq-number-input" id="input_boq_item_freq_${id}" value="${itemData ? itemData.freq : 1}" style="width: 100%; height: auto;">
            <small id="input_boq_item_freq_${id}_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
          <div style="width: 100%;">
            <select class="form-select text-center select" id="input_boq_item_freq_unit_${id}" style="width: 100%;">
              <option value="" ${!itemData?.freq_unit}>-- Select Unit --</option>
              ${freqUnitOptions}
            </select>
            <small id="input_boq_item_freq_unit_${id}_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
      </td>
      <td style="min-width: 180px;"><input type="text" class="form-control form-control" id="input_boq_item_unit_price_${id}" value="${itemData ? formatRupiahDisplay(itemData.product?.active_price_version?.price.toString().replace('.', ',')) : 0}" disabled style="width: 100%;"></td>
      <td style="min-width: 180px;">
        <input type="text" class="form-control form-control selling-price-input" id="input_boq_item_selling_price_${id}" value="${itemData ? formatRupiahDisplay(itemData.selling_price.toString().replace('.', ',')) : 0}" style="width: 100%;">
        <small id="input_boq_item_selling_price_${id}_error" class="text-danger mt-1" style="display: none;"></small>
      </td>
      <td id="boq_item_total_${id}">0</td>
      <td class="text-center"><button type="button" class="btn btn-danger btn-sm boq-remove-item-btn" data-row-id="${id}"><i class="ti ti-trash"></i></button></td>
    `;
    tbody.appendChild(tr);
    this.initPlugins();
    this.recalculate();
  }

  recalculate() {
    let grandTotal = 0;
    this.rowArr.forEach(id => {
      const qty = parseFloat(this.form.querySelector(`#input_boq_item_qty_${id}`)?.value) || "";
      const freq = parseFloat(this.form.querySelector(`#input_boq_item_freq_${id}`)?.value) || "";
      const sellingPriceStr = this.form.querySelector(`#input_boq_item_selling_price_${id}`)?.value || "";
      const sellingPrice = parseFloat(normalizeFormatRupiah(sellingPriceStr).replace(/[^0-9,-]+/g, "").replace(",", ".")) || "";

      const total = (qty || 1) * (freq || 1) * sellingPrice;
      grandTotal += total;

      const totalEl = this.form.querySelector(`#boq_item_total_${id}`);
      if (totalEl) totalEl.innerText = formatRupiahDisplay(total.toString().replace('.', ','));
    });
    const grandTotalEl = this.form.querySelector("#boq_grand_total_display");
    if (grandTotalEl) grandTotalEl.innerText = formatRupiahDisplay(grandTotal.toString().replace('.', ','));
  }

  initPlugins() {
    if (window.$ && $.fn.select2) {
      $('.select').select2({ width: '100%', dropdownParent: $('#c_boq_canvas') });
      $('.select').on('select2:select', function () {
        this.dispatchEvent(new Event('change', { bubbles: true }));
      });
    }
  }

  showLoading() {
    if (!this.loadingEl) {
      this.loadingEl = document.createElement("div");
      this.loadingEl.className = "c-form-loading-overlay";
      this.loadingEl.innerHTML = `<div class="c-form-spinner"></div>`;
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
      const target = document.getElementById("c_boq_canvas_form") || this.form;
      target.appendChild(this.loadingEl);
    }
    this.loadingEl.style.display = "flex";
  }

  hideLoading() {
    if (this.loadingEl) this.loadingEl.style.display = "none";
  }

  resetForm() {
    this.isInit = true;
    this.mode = "create";
    this.isFetching = false;
    this.data = {};
    this.products = [];
    this.proposals = [];
    this.rowCount = 0;
    this.rowArr = [];
    this.errors = {};
    this.form.innerHTML = "";
    this.loadingEl = null;
  }

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

    const payload = {
      proposal_id: "",
      items: []
    };

    const inputs = [
      {
        field: "input_boq_proposal_id",
        required: false,
        message: "Proposal ID is required."
      },
    ];

    inputs.forEach(input => {
      const el = this.form.querySelector("#" + input.field);
      let value = el ? el.value.trim() : "";

      payload[input.field.replace("input_boq_", "")] = value;

      if (!value && input.required) {
        this.errors[input.field + "_error"] = input.message;
      }
    });

    if (this.rowArr.length === 0) {
      this.errors.boq_items_error = "BOQ must have at least 1 items."
    }

    this.rowArr.forEach((id, index) => {
      const obj = {
        product_id: this.form.querySelector(`#input_boq_item_product_id_${id}`).value,
        description: this.form.querySelector(`#input_boq_item_description_${id}`).value,
        qty: this.form.querySelector(`#input_boq_item_qty_${id}`).value,
        freq: this.form.querySelector(`#input_boq_item_freq_${id}`).value,
        freq_unit: this.form.querySelector(`#input_boq_item_freq_unit_${id}`).value,
        selling_price: this.form.querySelector(`#input_boq_item_selling_price_${id}`).value,
      }

      // Strip trailing comma for selling_price to match backend regex
      if (obj.selling_price && obj.selling_price.endsWith(',')) {
        obj.selling_price = obj.selling_price.slice(0, -1);
      }

      payload.items.push(obj);

      const qty_unit = this.form.querySelector(`#input_boq_item_qty_unit_${id}`).value;

      if (!obj.product_id) {
        this.errors[`input_boq_item_product_id_${id}_error`] = "Product is required.";
      };
      if (!obj.qty || parseInt(obj.qty) < 1) {
        this.errors[`input_boq_item_qty_${id}_error`] = "Qty must be at least 1.";
      }
      if (!obj.freq || parseInt(obj.freq) < 1) {
        this.errors[`input_boq_item_freq_${id}_error`] = "Freq must be at least 1.";
      }
      if (!qty_unit) {
        this.errors[`input_boq_item_qty_unit_${id}_error`] = "Qty unit is required.";
      }
      if (!obj.freq_unit) {
        this.errors[`input_boq_item_freq_unit_${id}_error`] = "Freq unit is required.";
      }
      if (!obj.selling_price) {
        this.errors[`input_boq_item_selling_price_${id}_error`] = "Selling price is required.";
      }
    });

    return payload;
  }

  async handleSubmit() {
    if (this.isFetching) return;
    this.isFetching = true;
    this.showLoading();

    const payload = this.validateFields();
    console.log(payload);

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

    const isEdit = this.mode === "edit";
    const url = !isEdit ? "/boqs" : `/boqs/${this.data.id}`;
    const method = !isEdit ? "POST" : "PUT";

    try {
      const r = await fetch(url, {
        method,
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
        body: JSON.stringify(payload)
      });
      const res = await r.json();
      if (res.success) {
        showToast("success", res.message || (isEdit ? "BOQ updated successfully" : "BOQ created successfully"));
        if (isEdit) {
          $('#boq_list').DataTable().ajax.reload(null, false);
        } else {
          $('#boq_list').DataTable().ajax.reload();
        }
        if (this.closeForm) this.closeForm.click();
        this.resetForm();
      } else {
        showToast("error", res.message || res.errors);
      }
    } catch (e) {
      showToast("error", "An error occurred");
    } finally {
      this.isFetching = false;
      this.hideLoading();
    }
  }
}

// ----------------------------------------------- TRIGER -----------------------------------------------
document.addEventListener("DOMContentLoaded", () => {
  const BOQ_CANVAS = document.querySelector("#c_boq_canvas");
  const BOQ_MODAL = document.querySelector("#c_boq_modal");
  const BOQ_FORM = BOQ_CANVAS?.querySelector("form#c_boq_canvas_form")
    ? new BoqForm("c_boq_canvas_form")
    : null;
  const BOQ_CANVAS_BS = BOQ_CANVAS ? new bootstrap.Offcanvas(BOQ_CANVAS) : null;
  const BOQ_MODAL_BS = BOQ_MODAL ? new bootstrap.Modal(BOQ_MODAL) : null;
  const BOQ_MODAL_TITLE = BOQ_MODAL?.querySelector("#c_boq_modal_title");
  const BOQ_MODAL_BODY = BOQ_MODAL?.querySelector(".modal-body");
  const BOQ_CONFIRM_BTN = BOQ_MODAL?.querySelector("#c_boq_modal_confirm_btn");
  const MODAL_MESSAGES = {
    unbind: {
      success: "BoQ has been unbound successfully.",
      failure: "Failed to unbind BoQ.",
      error: 'An error occurred while unbinding BoQ.'
    },
    delete: {
      success: "BOQ deleted successfully!",
      failure: "Failed to delete BOQ.",
      error: 'An error occurred while deleting BOQ.'
    },
    "bulk-unbind": {
      success: "Selected BoQ(s) have been unbound successfully.",
      failure: "Failed to unbind selected BoQ(s).",
      error: 'An error occurred while unbinding selected BoQ(s).'
    },
    "bulk-delete": {
      success: "Selected BoQ(s) deleted successfully!",
      failure: "Failed to delete selected BoQ(s).",
      error: 'An error occurred while deleting selected BoQ(s).'
    }
  };

  function updateBulkBtn() {
    const deleteBtn = document.querySelector("#c_boq_bulk_delete_btn");
    const unbindBtn = document.querySelector("#c_boq_bulk_unbind_btn");
    if (SELECTED_BOQ_DATATABLES_ROWS.length) {
      if (deleteBtn) {
        deleteBtn.style.display = "block";
        deleteBtn.disabled = false;
      }
      if (unbindBtn) {
        unbindBtn.style.display = "block";
        unbindBtn.disabled = false;
      }
    } else {
      if (deleteBtn) {
        deleteBtn.style.display = "none";
        deleteBtn.disabled = true;
      }
      if (unbindBtn) {
        unbindBtn.style.display = "none";
        unbindBtn.disabled = true;
      }
    }
  }

  document.addEventListener("click", async e => {
    const target = e.target;

    // CREATE
    if (target.matches("#c_boq_create_btn")) {
      e.preventDefault();
      if (BOQ_CANVAS_BS && BOQ_FORM && !IS_FETCHING) {
        const title = BOQ_CANVAS.querySelector("#c_boq_canvas_title");
        title.textContent = "Create BoQ";
        BOQ_CANVAS_BS.show();
        BOQ_FORM.resetForm();
        await BOQ_FORM.init("create");
      }
    }

    // EDIT
    if (target.matches(".c_boq_edit_btn")) {
      e.preventDefault();
      if (BOQ_CANVAS_BS && BOQ_FORM && !IS_FETCHING) {
        IS_FETCHING = true;
        const url = target.dataset.url;
        try {
          const response = await fetch(url, {
            method: "GET",
            headers: {
              "Content-Type": "application/json",
              "Accept": "application/json",
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
          });
          const resJson = await response.json();

          if (response.ok && resJson.success) {
            const title = BOQ_CANVAS.querySelector("#c_boq_canvas_title");
            title.textContent = "Edit BoQ";
            BOQ_CANVAS_BS.show();
            BOQ_FORM.resetForm();
            await BOQ_FORM.init("edit", resJson.data);
          } else {
            showToast("error", resJson.message || "Failed to fetch BoQ data.");
          }
        } catch (error) {
          showToast("error", 'An error occurred while fetching data.');
        } finally {
          IS_FETCHING = false;
        }
      }
    }

    // UNBIND SINGLE
    else if (target.matches(".c_boq_unbind_btn")) {
      e.preventDefault();
      if (BOQ_MODAL && BOQ_MODAL_BS) {
        const id = target.dataset.id;
        const url = target.dataset.url;
        BOQ_MODAL_TITLE.textContent = "Confirm Unbind BoQ";
        BOQ_MODAL_BODY.textContent = "Are you sure you want to unbind this BoQ?";
        BOQ_CONFIRM_BTN.textContent = "Yes, Unbind";
        BOQ_CONFIRM_BTN.setAttribute("data-id", id);
        BOQ_CONFIRM_BTN.setAttribute("data-url", url);
        BOQ_CONFIRM_BTN.setAttribute("data-action", "unbind");
        BOQ_MODAL_BS.show();
      }
    }

    // UNBIND BULK
    else if (target.matches("#c_boq_bulk_unbind_btn")) {
      e.preventDefault();
      if (BOQ_MODAL && BOQ_MODAL_BS) {
        const url = target.dataset.url;
        BOQ_MODAL_TITLE.textContent = "Confirm Bulk Unbind";
        BOQ_MODAL_BODY.textContent = "Are you sure you want to unbind selected BoQ(s)?";
        BOQ_CONFIRM_BTN.textContent = "Yes, Unbind";
        BOQ_CONFIRM_BTN.setAttribute("data-url", url);
        BOQ_CONFIRM_BTN.setAttribute("data-action", "bulk-unbind");
        BOQ_MODAL_BS.show();
      }
    }

    // DELETE SINGLE
    else if (target.matches(".c_boq_delete_btn")) {
      e.preventDefault();
      if (BOQ_MODAL && BOQ_MODAL_BS) {
        const id = target.dataset.id;
        const url = target.dataset.url;
        BOQ_MODAL_TITLE.textContent = "Confirm Delete BoQ";
        BOQ_MODAL_BODY.textContent = "Are you sure you want to delete this BoQ?";
        BOQ_CONFIRM_BTN.textContent = "Yes, Delete";
        BOQ_CONFIRM_BTN.setAttribute("data-id", id);
        BOQ_CONFIRM_BTN.setAttribute("data-url", url);
        BOQ_CONFIRM_BTN.setAttribute("data-action", "delete");
        BOQ_MODAL_BS.show();
      }
    }

    // DELETE BULK 
    else if (target.matches("#c_boq_bulk_delete_btn")) {
      e.preventDefault();
      if (BOQ_MODAL && BOQ_MODAL_BS) {
        const url = target.dataset.url;
        BOQ_MODAL_TITLE.textContent = "Confirm Bulk Delete";
        BOQ_MODAL_BODY.textContent = "Are you sure you want to delete selected BoQ(s)?";
        BOQ_CONFIRM_BTN.textContent = "Yes, Delete";
        BOQ_CONFIRM_BTN.setAttribute("data-url", url);
        BOQ_CONFIRM_BTN.setAttribute("data-action", "bulk-delete");
        BOQ_MODAL_BS.show();
      }
    }

    // CONFIRM UNBIND & DELETE
    else if (target.matches("#c_boq_modal_confirm_btn")) {
      e.preventDefault();
      if (BOQ_MODAL_BS && IS_FETCHING) return;
      IS_FETCHING = true;
      const action = target.dataset.action;
      if ((action === "bulk-unbind" || action === "bulk-delete") && !SELECTED_BOQ_DATATABLES_ROWS.length) {
        showToast("error", "No BoQ selected.");
        IS_FETCHING = false;
        return;
      }
      try {
        let url = target.dataset.url;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        const options = {
          headers: { "X-CSRF-TOKEN": csrfToken, "Accept": "application/json" }
        };
        if (action == "unbind" || action == "bulk-unbind") options.method = "PATCH";
        else if (action == "delete" || action == "bulk-delete") options.method = "DELETE";

        if (action === "bulk-unbind") {
          options.headers["Content-Type"] = "application/json";
          options.body = JSON.stringify({ boq_ids: SELECTED_BOQ_DATATABLES_ROWS.map(obj => obj.id) });
        } else if (action === "bulk-delete") {
          const ids = SELECTED_BOQ_DATATABLES_ROWS.map(obj => obj.id).join(',');
          url += `?boq_ids=${ids}`;
        }

        const response = await fetch(url, options);
        const data = await response.json();
        if (response.ok && data.success) {
          if (action === "unbind" || action === "delete") {
            const id = target.dataset.id;
            SELECTED_BOQ_DATATABLES_ROWS = SELECTED_BOQ_DATATABLES_ROWS.filter(obj => obj.id !== id);
          } else {
            SELECTED_BOQ_DATATABLES_ROWS = [];
          }
          updateBulkBtn();
          $('#boq_list').DataTable().ajax.reload(null, false);
          BOQ_MODAL_BS.hide();
          showToast("success", data.message || MODAL_MESSAGES[action].success);
        } else {
          showToast("error", data.message || MODAL_MESSAGES[action].failure);
        }
      } catch (err) {
        showToast("error", MODAL_MESSAGES[action].error);
      } finally {
        IS_FETCHING = false;
      }
    }
  });

  document.addEventListener("change", async e => {
    const target = e.target;
    if (target.matches("#boq_list #select_all_boq_list")) {
      const checked = target.checked;
      document.querySelectorAll('#boq_list input.row-check').forEach(el => {
        el.checked = checked;
        if (checked) {
          SELECTED_BOQ_DATATABLES_ROWS.push({ id: el.value, code: el.dataset.code });
        } else {
          SELECTED_BOQ_DATATABLES_ROWS = SELECTED_BOQ_DATATABLES_ROWS.filter(obj => obj.id !== el.value);
        }
      });
      const unique = new Map(SELECTED_BOQ_DATATABLES_ROWS.map(item => [item.id, item]));
      SELECTED_BOQ_DATATABLES_ROWS = Array.from(unique.values());
      updateBulkBtn();
    } else if (target.matches("#boq_list input.row-check")) {
      const checked = target.checked;
      if (!checked) {
        document.querySelector("#boq_list #select_all_boq_list").checked = false;
        SELECTED_BOQ_DATATABLES_ROWS = SELECTED_BOQ_DATATABLES_ROWS.filter(obj => obj.id !== target.value);
      } else {
        SELECTED_BOQ_DATATABLES_ROWS.push({ id: target.value, code: target.dataset.code });
      }
      const unique = new Map(SELECTED_BOQ_DATATABLES_ROWS.map(item => [item.id, item]));
      SELECTED_BOQ_DATATABLES_ROWS = Array.from(unique.values());
      updateBulkBtn();
    }
  });
});
