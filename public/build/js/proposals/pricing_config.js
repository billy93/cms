// ---------------------------------------- PRICING CONFIG FORM CLASS ----------------------------------------
class PricingConfigForm {
  isInit = true;
  isFetching = false;
  data = {};
  errors = {};
  pricingType = "";

  // Predefined headers for Type B
  headers = [
    'Accommodation', 'Activities', 'Airport Assistance', 'Air tickets',
    'Documentation', 'Entrance ticket', 'Excursion', 'F&B Restaurants',
    'Front of House', 'Goodie Bags', 'Gratitudes', 'Insurance',
    'Land transportation', 'Lighting', 'Manpower', 'MC', 'Media Relation',
    'Meeting Package', 'Merchandise', 'Multimedia', 'Paramedic', 'Production',
    'Production Support', 'Rail tickets', 'Security Service', 'Software',
    'Sound System', 'Speaker', 'Stationery', 'Streaming', 'Survey', 'Talents',
    'Team Building', 'Travel Documents', 'Traveling kits', 'Venue',
    'Man Power', 'Talent', 'Others', 'Meals Arrangement'
  ];

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeBtn = document.getElementById("c_pricing_model_canvas_close_btn");

    this.handleDocumentKeydown = this.handleDocumentKeydown.bind(this);
    this.handleDocumentInput = this.handleDocumentInput.bind(this);
    this.handleDocumentChange = this.handleDocumentChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);

    this.form.addEventListener("submit", (e) => {
      e.preventDefault();
      this.handleSubmit();
    });

    document.addEventListener("keydown", this.handleDocumentKeydown);
    document.addEventListener("input", this.handleDocumentInput);
    document.addEventListener("change", this.handleDocumentChange);
  }

  // ---------------------------------------- EVENT HANDLERS ----------------------------------------

  handleDocumentKeydown(e) {
    const target = e.target;
    if (target.matches(`.pm-number-input`)) {
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
    if (target.matches(`.pm-number-input`)) {
      const before = target.value;
      const caret = target.selectionStart;

      const norm = normalizeFormatRupiah(before);
      const formatted = formatRupiahDisplay(norm);

      target.value = formatted;

      const delta = formatted.length - before.length;
      target.setSelectionRange(caret + delta, caret + delta);
      this.recalculateSummary()
    } else if (target.matches(".pm-order-input")) {
      let val = target.value;
      val = val.replace(/[^0-9]/g, "");
      if (/^0\d/.test(val)) val = val.replace(/^0+/, "");
      target.value = val;
    }
  }

  handleDocumentChange(e) {
    const target = e.target;

    // Pricing Model type change - re-render form
    if (target.matches("#input_proposal_pricing_model")) {
      this.pricingType = target.value;
      this.resetErrorFields();
      this.renderForm();
    }

    // Management Fee Type change - update suffix and recalculate
    if (target.matches("#input_proposal_management_fee_type")) {
      const suffix = this.form.querySelector("#pm_fee_suffix");

      if (suffix) {
        suffix.textContent = target.value === 'percent' ? '%' : 'Rp.';
      }
      this.recalculateSummary()
    }

    // VAT Rate change - recalculate
    if (target.matches("#input_proposal_vat_rate")) {
      this.recalculateSummary()
    }
  }

  // ---------------------------------------- INIT ----------------------------------------
  async init(data) {
    this.resetForm();
    this.showLoading();
    this.data = data;
    this.pricingType = data.pricing_model || "";

    this.renderForm();
    this.isInit = false;
    this.hideLoading();
  }

  // ---------------------------------------- RENDER ----------------------------------------
  renderForm() {
    const pricingModelOptions = ['A', 'B', 'C'].map(type =>
      `<option value="${type}" ${this.pricingType === type ? 'selected' : ''}>Type ${type}${type === 'A' ? ' - Simple' : ' - With Headers'}</option>`
    ).join('');

    let dynamicContent = '';
    if (!this.pricingType) {
      dynamicContent = `
        <div class="alert alert-info">
          <i class="ti ti-info-circle me-2"></i>
          Please select a pricing model type to configure.
        </div>
      `;
    } else if (this.pricingType === 'A') {
      dynamicContent = this.renderTypeA();
    } else if (this.pricingType === 'B') {
      dynamicContent = this.renderTypeB();
    } else if (this.pricingType === 'C') {
      dynamicContent = this.renderTypeA();
    }

    this.form.innerHTML = `
      <div class="mb-4">
        <label class="form-label fw-semibold">Pricing Model Type <span class="text-danger">*</span></label>
        <select id="input_proposal_pricing_model" class="form-select select">
          <option value="">-- Select Type --</option>
          ${pricingModelOptions}
        </select>
        <small id="input_proposal_pricing_model_error" class="text-danger mt-1" style="display: none;"></small>
      </div>

      ${dynamicContent}

      <div class="d-flex justify-content-end mt-4 pt-3 border-top">
        <button type="button" class="btn btn-light me-2" data-bs-dismiss="offcanvas">Cancel</button>
        <button type="submit" class="btn btn-primary">Save Configuration</button>
      </div>
    `;

    this.initPlugins();
  }

  renderTypeA() {
    const calculations = this.calculateTotals();

    return `
      <div class="alert alert-warning mb-4">
        <strong>Type A - Simple Pricing</strong><br>
        No grouping required. All BOQs will be listed flat.
      </div>

      ${this.renderFeeFields()}

      <div class="mt-4">
        <label class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
        <textarea
          id="input_proposal_pricing_model_description"
          class="form-control"
          rows="4"
          placeholder="Enter description for this pricing model..."
        >${this.data.pricing_model_description || ''}</textarea>
        <small id="input_proposal_pricing_model_description_error" class="text-danger mt-1" style="display: none;"></small>
      </div>

      <h6 class="fw-semibold mt-4 mb-3">BOQs in this Proposal</h6>
      <div class="table-responsive">
        <table class="table table-bordered mb-0">
          <thead>
            <tr>
              <th style="width: 100%;">BOQ Code</th>
              <th class="text-end">Amount</th>
            </tr>
          </thead>
          <tbody>
            ${this.data.boqs.map(boq => `
              <tr>
                <td>${boq.code}</td>
                <td class="text-end">Rp ${formatRupiahDisplay(boq.total_amount_items?.replace(".", ",") ?? 0)}</td>
              </tr>
            `).join('')}
          </tbody>
          ${this.renderSummaryRows(calculations)}
        </table>
      </div>
    `;
  }

  renderTypeB() {
    const calculations = this.calculateTotals();

    return `
      <div class="alert alert-warning mb-4">
        <strong>Type B - Headers & Subheaders</strong><br>
        Assign headers from predefined list and add subheaders for each BOQ.
      </div>

      ${this.renderFeeFields()}
      
      <h6 class="fw-semibold mt-4 mb-3">Assign Headers to BOQs</h6>
      <div class="table-responsive">
        <table class="table table-bordered mb-0">
          <thead>
            <tr>
              <th style="min-width: 160px;">BOQ Code</th>
              <th style="min-width: 160px;">Header</th>
              <th style="min-width: 160px;">Subheader</th>
              <th style="width: 90px;">Order</th>
              <th style="min-width: 180px;" class="text-end">Amount</th>
            </tr>
          </thead>
          <tbody>
            ${this.data.boqs.map((boq, idx) => `
              <tr>
                <td>${boq.code}</td>
                <td>
                  <select class="form-select select input_proposal_boq_header" data-boq-id="${boq.id}">
                    <option value="">-- Select Header --</option>
                    ${this.headers.map(h => `
                      <option value="${h}" ${boq.header === h ? 'selected' : ''}>${h}</option>
                    `).join('')}
                  </select>
                </td>
                <td>
                  <input type="text" class="form-control input_proposal_boq_subheader" data-boq-id="${boq.id}" value="${boq.subheader || ''}" placeholder="Enter subheader...">
                </td>
                <td>
                  <input type="text" class="form-control input_proposal_boq_header_order" data-boq-id="${boq.id}" value="${boq.header_order || idx}">
                </td>
                <td class="text-end">Rp. ${formatRupiahDisplay(boq.total_amount_items?.replace(".", ",") ?? 0)}</td>
              </tr>
            `).join('')}
          </tbody>
          ${this.renderSummaryRows(calculations)}
        </table>
      </div>
    `;
  }

  renderFeeFields() {
    const feeType = this.data.management_fee_type || 'percent';
    const feeValue = this.data.management_fee || 0;
    const vatRate = this.data.vat_rate || 11;

    return `
      <hr class="my-4">
      <h6 class="fw-semibold mb-3">Fee Configuration</h6>
      <div class="row">
        <div class="col-md-4 mb-3">
          <label class="form-label">Management Fee Type <span class="text-danger">*</span></label>
          <select id="input_proposal_management_fee_type" class="form-select select">
            <option value="percent" ${feeType === 'percent' ? 'selected' : ''}>Percentage (%)</option>
            <option value="nominal" ${feeType === 'nominal' ? 'selected' : ''}>Nominal (Rp)</option>
          </select>
          <small id="input_proposal_management_fee_type_error" class="text-danger mt-1" style="display: none;"></small>
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">Management Fee <span class="text-danger">*</span></label>
          <div class="input-group">
            <input type="text" class="form-control pm-number-input" id="input_proposal_management_fee" value="${feeType === "percent" ? formatRupiahDisplay(feeValue.replace(".", ",")) : formatRupiahDisplay(feeValue.replace(".", ","))}">
            <span class="input-group-text" id="pm_fee_suffix">${feeType === 'percent' ? '%' : 'Rp.'}</span>
          </div>
          <small id="input_proposal_management_fee_error" class="text-danger mt-1" style="display: none;"></small>
        </div>
        <div class="col-md-4 mb-3">
          <label class="form-label">VAT Rate <span class="text-danger">*</span></label>
          <select id="input_proposal_vat_rate" class="form-select select">
            <option value="1" ${vatRate == 1 ? 'selected' : ''}>1%</option>
            <option value="11" ${vatRate == 11 ? 'selected' : ''}>11%</option>
          </select>
          <small id="input_proposal_vat_rate_error" class="text-danger mt-1" style="display: none;"></small>
        </div>
      </div>
    `;
  }

  // ---------------------------------------- CALCULATIONS ----------------------------------------
  calculateTotals() {
    // Total from BOQs
    const total = this.data.boqs.reduce((sum, boq) => {
      return sum + parseFloat(boq.total_amount_items || 0);
    }, 0);

    // Get management fee values
    const feeTypeInput = this.form.querySelector("#input_proposal_management_fee_type");
    const feeValueInput = this.form.querySelector("#input_proposal_management_fee");
    const vatRateInput = this.form.querySelector("#input_proposal_vat_rate");

    const feeType = feeTypeInput?.value || this.data.management_fee_type || 'percent';
    let feeValue = 0;

    if (feeValueInput) {
      feeValue = parseFloat(normalizeFormatRupiah(feeValueInput.value)) || 0;
    } else {
      feeValue = parseFloat(this.data.management_fee) || 0;
    }

    const vatRate = parseInt(vatRateInput?.value || this.data.vat_rate || 11);

    // Calculate management fee amount (rounded to 2 decimals)
    let managementFeeAmount = 0;
    if (feeType === 'percent') {
      managementFeeAmount = Math.round((total * feeValue) / 100 * 100) / 100;
    } else {
      managementFeeAmount = Math.round(feeValue * 100) / 100;
    }

    // Subtotal = Total + Management Fee (rounded to 2 decimals)
    const subtotal = Math.round((total + managementFeeAmount) * 100) / 100;

    // VAT Amount (rounded to 2 decimals)
    const vatAmount = Math.round((subtotal * vatRate) / 100 * 100) / 100;

    // Invoice Amount = Subtotal + VAT (rounded to 2 decimals)
    const invoiceAmount = Math.round((subtotal + vatAmount) * 100) / 100;

    return {
      total: Math.round(total * 100) / 100,
      managementFeeAmount,
      feeType,
      feeValue,
      subtotal,
      vatAmount,
      vatRate,
      invoiceAmount
    };
  }

  renderSummaryRows(calculations) {
    const colspan = this.pricingType === 'B' ? 4 : 1;

    return `
      <tfoot>
        <tr>
          <th class="text-end" colspan="${colspan}">Basic Price Sum</th>
          <th class="text-end" id="pm_grand_total">Rp. ${formatRupiahDisplay(calculations.total.toString().replace(".", ","))}</th>
        </tr>
        <tr>
          <th class="text-end" colspan="${colspan}" style="font-weight: normal">Management Fee</th>
          <th class="text-end" id="pm_management_fee_amount" style="font-weight: normal">Rp. ${formatRupiahDisplay(calculations.managementFeeAmount.toString().replace(".", ","))}</th>
        </tr>
        <tr>
          <th class="text-end" colspan="${colspan}">Sales Amount</th>
          <th class="text-end" id="pm_subtotal">Rp. ${formatRupiahDisplay(calculations.subtotal.toString().replace(".", ","))}</th>
        </tr>
        <tr>
          <th class="text-end" colspan="${colspan}" style="font-weight: normal">VAT Amount</th>
          <th class="text-end" id="pm_vat_amount" style="font-weight: normal">Rp. ${formatRupiahDisplay(calculations.vatAmount.toString().replace(".", ","))}</th>
        </tr>
        <tr style="background-color: #f8f9fa;">
          <th class="text-end" colspan="${colspan}">Total Amount</th>
          <th class="text-end" id="pm_invoice_amount">Rp. ${formatRupiahDisplay(calculations.invoiceAmount.toString().replace(".", ","))}</th>
        </tr>
      </tfoot>
    `;
  }

  recalculateSummary() {
    const calculations = this.calculateTotals();

    // Update summary row values
    const totalEl = this.form.querySelector("#pm_grand_total");
    const managementFeeAmountEl = this.form.querySelector("#pm_management_fee_amount");
    const subtotalEl = this.form.querySelector("#pm_subtotal");
    const vatAmountEl = this.form.querySelector("#pm_vat_amount");
    const invoiceAmountEl = this.form.querySelector("#pm_invoice_amount");

    if (totalEl) totalEl.textContent = `Rp ${formatRupiahDisplay(calculations.total.toString().replace(".", ","))}`;
    if (managementFeeAmountEl) managementFeeAmountEl.textContent = `Rp ${formatRupiahDisplay(calculations.managementFeeAmount.toString().replace(".", ","))}`;
    if (subtotalEl) subtotalEl.textContent = `Rp ${formatRupiahDisplay(calculations.subtotal.toString().replace(".", ","))}`;
    if (vatAmountEl) vatAmountEl.textContent = `Rp ${formatRupiahDisplay(calculations.vatAmount.toString().replace(".", ","))}`;
    if (invoiceAmountEl) invoiceAmountEl.textContent = `Rp ${formatRupiahDisplay(calculations.invoiceAmount.toString().replace(".", ","))}`;
  }

  initPlugins() {
    if (window.$ && $.fn.select2) {
      $('.select').select2({ width: '100%', dropdownParent: $('#c_pricing_model_canvas') });
      $('.select').on('select2:select', function () {
        this.dispatchEvent(new Event('change', { bubbles: true }));
      });
    }
  }

  // ---------------------------------------- HELPERS ----------------------------------------
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
    this.data = {};
    this.form.innerHTML = "";
    this.loadingEl = null;
    this.errors = {};
    this.pricingType = "";
  }

  // ---------------------------------------- VALIDATION ----------------------------------------
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
      pricing_model: this.pricingType,
      management_fee_type: "",
      management_fee: "",
      vat_rate: "",
      pricing_model_description: "",
    };

    const inputs = [
      {
        field: "input_proposal_pricing_model",
        required: true,
        message: "Pricing model type is required."
      },
      {
        field: "input_proposal_management_fee_type",
        required: true,
        message: "Management fee type is required."
      },
      {
        field: "input_proposal_management_fee",
        required: true,
        message: "Management fee is required."
      },
      {
        field: "input_proposal_vat_rate",
        required: true,
        message: "VAT rate is required."
      },
      {
        field: "input_proposal_pricing_model_description",
        required: this.pricingType === "A" ? true : false,
        message: "Description is required."
      }
    ];


    // Loop semua input
    inputs.forEach(input => {
      const el = this.form.querySelector("#" + input.field);
      let value = el ? el.value.trim() : "";

      // Strip trailing comma for price field to match backend regex
      if (input.field === 'input_proposal_management_fee' && value.endsWith(',')) {
        value = value.slice(0, -1);
      } else if (input.field === 'input_proposal_vat_rate') {
        value = parseInt(value);
      }

      payload[input.field.replace("input_proposal_", "")] = value;

      if (!value && input.required) {
        this.errors[input.field + "_error"] = input.message;
      }
    });

    // Collect BOQ data for Type B
    if (this.pricingType === 'B') {
      const boqs = [];
      const headerSelects = this.form.querySelectorAll(".input_proposal_boq_header");

      headerSelects.forEach(select => {
        const boqId = select.dataset.boqId;
        const header = select.value || null;

        const subheaderInput = this.form.querySelector(`.input_proposal_boq_subheader[data-boq-id="${boqId}"]`);
        const orderInput = this.form.querySelector(`.input_proposal_boq_header_order[data-boq-id="${boqId}"]`);

        boqs.push({
          boq_id: parseInt(boqId),
          header: header,
          subheader: subheaderInput?.value || null,
          header_order: parseInt(orderInput?.value) || 0,
        });
      });

      payload.boqs = boqs;
    }

    return payload;
  }

  // ---------------------------------------- SUBMIT ----------------------------------------
  async handleSubmit() {
    if (this.isFetching) return;
    this.isFetching = true;
    this.showLoading();

    const payload = this.validateFields();
    const errKeys = Object.keys(this.errors);
    console.log(payload);

    if (errKeys.length) {
      errKeys.forEach(v => {
        const el = document.getElementById(v);
        if (el) {
          el.innerText = this.errors[v];
          el.style.display = "block";
        }
      });
      this.isFetching = false;
      this.hideLoading();
      return;
    }


    try {
      const response = await fetch(`/proposals/${this.data.id}/pricing-model`, {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
        body: JSON.stringify(payload),
      });

      const result = await response.json();
      if (!response.ok || !result.success) {
        showToast("error", result.message || "Failed to save pricing model.");
        return;
      }

      showToast("success", "Pricing configuration saved!");
      if (this.closeBtn) this.closeBtn.click();
      this.resetForm();

      // Update pricing section without reload
      this.updatePricingSection(result.data);

    } catch (err) {
      showToast("error", 'An error occurred while saving pricing model.');
    } finally {
      this.isFetching = false;
      this.hideLoading();
    }
  }

  updatePricingSection(proposal) {
    const pricingInfoEl = document.getElementById('pricing_model_info');
    if (!pricingInfoEl) return;

    const managementFeeDisplay = proposal.management_fee_type === 'percent'
      ? `${formatRupiahDisplay(proposal.management_fee?.replace('.', ',') ?? 0)}%`
      : `Rp. ${formatRupiahDisplay(proposal.management_fee.replace('.', ',') ?? 0)}`;

    pricingInfoEl.innerHTML = `
      <div class="row">
        <div class="col-md-3">
          <strong>Pricing Model</strong>
          <p class="mb-0">${proposal.pricing_model ? 'Type ' + proposal.pricing_model : 'Not configured'}</p>
        </div>
        <div class="col-md-3">
          <strong>Management Fee</strong>
          <p class="mb-0">${managementFeeDisplay}</p>
        </div>
        <div class="col-md-3">
          <strong>VAT Rate</strong>
          <p class="mb-0">${proposal.vat_rate ?? 11}%</p>
        </div>
      </div>
    `;
  }
}

// ---------------------------------------- TRIGGER ----------------------------------------
document.addEventListener("DOMContentLoaded", () => {
  const PRICING_CANVAS = document.querySelector("#c_pricing_model_canvas");
  const PRICING_FORM = PRICING_CANVAS?.querySelector("form#c_pricing_model_canvas_form")
    ? new PricingConfigForm("c_pricing_model_canvas_form")
    : null;
  const PRICING_CANVAS_BS = PRICING_CANVAS ? new bootstrap.Offcanvas(PRICING_CANVAS) : null;

  let IS_FETCHING = false;

  document.addEventListener("click", async e => {
    let target = e.target;

    // CONFIGURE PRICING MODEL
    if (target.matches("#c_pricing_model_configure_btn") || target.closest("#c_pricing_model_configure_btn")) {
      target = target.closest("#c_pricing_model_configure_btn") || target;
      e.preventDefault();

      if (!PRICING_CANVAS_BS || !PRICING_FORM || IS_FETCHING) return;
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
          PRICING_CANVAS_BS.show();
          PRICING_FORM.resetForm();
          await PRICING_FORM.init(resJson.data);
        } else {
          showToast("error", resJson.message || "Failed to fetch proposal data.");
        }
      } catch (error) {
        console.error(error);
        showToast("error", "An error occurred while fetching proposal data.");
      } finally {
        IS_FETCHING = false;
      }
    }
  });
});
