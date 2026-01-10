class ProposalForm {
  headers = [
    'Accommodation',
    'Activities, Outdoor',
    'Airport Assistance',
    'Air tickets',
    'Documentation',
    'Entrance ticket - Shows and Entertainment',
    'Entrance ticket - Places of interest',
    'Excursion',
    'F&B Restaurants',
    'Front of House',
    'Goodie Bags',
    'Gratitudes',
    'Insurance',
    'Land transportation',
    'Lighting',
    'Manpower',
    'MC',
    'Media Relation',
    'Meeting and Conference Kits',
    'Meeting Package',
    'Merchandise',
    'Multimedia',
    'Paramedic and First Aids',
    'Rail tickets',
    'Sales and Promotion Materials',
    'Security Service & Fire',
    'Software',
    'Sound System',
    'Speaker',
    'Stationery',
    'Streaming',
    'Survey',
    'Talents',
    'Team Building',
    'Travel Documents',
    'Traveling kits',
    'Venue'
  ];

  titles = [
    'Qty',
    'Number of nights',
    'Number of rooms',
    'Number of hours',
    'Number of days',
    'Number of items',
    'Number of participants',
    'Number of unit',
    'Number of package',
    'Pcs',
    'Person'
  ];

  staticFields() {
    const isEditing = this.mode === "edit";
    const value = {
      project_id: "",
      code: "",
      pricing_model: "A",
      status: "Draft",
      description: "",
      note: "",
    }

    if (isEditing && this.data) {
      value.project_id = this.data.project_id || "";
      value.code = this.data.code || "";
      value.pricing_model = this.data.pricing_model || "";
      value.status = this.data.status || "";
      value.description = this.data.pricing_model_description || "";
      value.note = this.data.note || "";
    }
    this.type = value.pricing_model;

    let isDisableProjectId = false;

    try {
      // Used on project.detail page
      if (!value.project_id && PROJECT_ID) {
        value.project_id = PROJECT_ID;
        isDisableProjectId = true;
      }
    } catch (error) { }

    const selectProjectOptions = this.projects.map(p => {
      return `<option value="${p.id}" ${value.project_id === p.id ? "selected" : ""}>${p.name}</option>`;
    });

    const selectStatusOptions = [
      'Draft', 'Submitted', 'Win', 'Lose', 'Cancelled'].map(s => {
        return `<option value="${s}" ${value.status === s ? "selected" : ""}>${s}</option>`;
      });

    const projectIdField = `
        <div class="col-md-6">
          <div class="mb-3">
            <div class="d-flex align-items-center justify-content-between">
              <label class="col-form-label">Project Name <span class="text-danger">*</span></label>
            </div>
            <select id="input_proposal_project_id" class="select form-control" ${isDisableProjectId ? "disabled" : ""}>
              <option value="" ${!value.project_id ? "selected" : ""}>-- Select Project --</option>
              ${selectProjectOptions}
            </select>
            <small id="input_proposal_project_id_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
      `;

    const dynamicField = !isEditing ?
      projectIdField :
      ` 
        ${projectIdField}
        <div class="col-md-6">
          <div class="mb-3">
            <label class="col-form-label">Proposal Code</label>
              <input type="text" id="input_proposal_code" class="form-control btn-disabled" value="${value.code}" disabled>
          </div>
        </div>
      `;

    const noteField = isEditing && value.status === "Lose" ? `
      <div id="field_note_wrapper">
        <div class="col-md-12">
          <div class="mb-3">
            <label class="col-form-label">Note <span class="text-danger">*</span></label>
            <textarea class="form-control" id="input_proposal_note">${value.note}</textarea>
            <small id="input_proposal_note_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
      </div>
    `:
      "<div id='field_note_wrapper' style='display: none;'></div>";

    return `
      <div class="row">
        ${dynamicField}
        <div class="col-md-6">
            <label class="col-form-label">Pricing Model <span class="text-danger">*</span></label>
            <select class="select form-select" id="input_proposal_pricing_model">
              <option value="A" ${!value.pricing_model || value.pricing_model === "A" ? "selected" : ""}>Type A - Satu paket event</option>
              <option value="B" ${value.pricing_model === "B" ? "selected" : ""}>Type B - Harga paket per orang</option>
              <option value="C" ${value.pricing_model === "C" ? "selected" : ""}>Type C - Paket Incentive Trips</option>
              <option value="D" ${value.pricing_model === "D" ? "selected" : ""}>Type D - Incentive Trips (umum)</option>
            </select>
            <small id="input_proposal_pricing_model_error" class="text-danger mt-1" style="display: none;"></small>
        </div>
        <div class="col-md-6">
          <div class="mb-3">
            <label class="col-form-label">Status <span class="text-danger">*</span></label>
            <select id="input_proposal_status" class="select form-control" style="text-transform: capitalize;" ${!isEditing ? "disabled" : ""}>
              <option value="" ${!value.status ? "selected" : ""}>-- Select Status --</option>
              ${selectStatusOptions}
            </select>
            <small id="input_proposal_status_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
        ${noteField}
        </div>
        <div class="mb-3">
          <label class="col-form-label">Description <span class="text-danger">*</span></label>
          <textarea class="form-control" id="input_proposal_pricing_model_description">${value.description}</textarea>
          <small id="input_proposal_pricing_model_description_error" class="text-danger mt-1" style="display: none;"></small>
        </div>
      </div>
    `;
  }

  feeFields() {
    const vatRate = parseFloat(this.data?.vat_rate) || "";
    let managementFeeValue = 0;
    let managementFeeType = "";

    if (this.mode === "edit" && this.data) {
      managementFeeType = this.data.management_fee_type || "";
      managementFeeValue = formatRupiahDisplay(this.data.management_fee?.toString().replace('.', ',') || "0");
    }

    return `
      <div class="row">
        <div class="col-md-6 mb-3">
          <label>Management Fee Type</label>
          <select class="form-select" id="input_proposal_management_fee_type">
            <option value="" ${!managementFeeType ? 'selected' : ''}>-- Select Type --</option>
            <option value="percent" ${managementFeeType === 'percent' ? 'selected' : ''}>Percent (%)</option>
            <option value="nominal" ${managementFeeType === 'nominal' ? 'selected' : ''}>Nominal (Rp)</option>
          </select>
          <small id="input_proposal_management_fee_type_error" class="text-danger mt-1" style="display: none;"></small>
        </div>
        <div class="col-md-6 mb-3">
          <label>Management Fee</label>
          <input type="text" class="form-control number-input" id="input_proposal_management_fee" placeholder="Value" value="${managementFeeValue}">
          <small id="input_proposal_management_fee_error" class="text-danger mt-1" style="display: none;"></small>
        </div>
        <div class="col-md-6 mb-3">
          <label>Sales Amount</label>
          <input type="text" class="form-control" id="input_proposal_sales_amount" value="0" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label>VAT Rate</label>
          <select class="select form-select" id="input_proposal_vat_rate">
            <option value="" ${!vatRate ? 'selected' : ''}>-- Select VAT --</option>
            <option value="1" ${vatRate === 1 ? 'selected' : ''}>1%</option>
            <option value="11" ${vatRate === 11 ? 'selected' : ''}>11%</option>
          </select>
          <small id="input_proposal_vat_rate_error" class="text-danger mt-1" style="display: none;"></small>
        </div>
        <div class="col-md-6 mb-3">
          <label>VAT Amount</label>
          <input type="text" class="form-control" id="input_proposal_vat_amount" value="0" readonly>
        </div>
        <div class="col-md-6 mb-3">
          <label>Invoice Amount</label>
          <input type="text" class="form-control" id="input_proposal_invoice_amount" value="0" readonly>
        </div>
      </div>
    `;
  }

  submitBtn = `
    <div class="d-flex align-items-center justify-content-end mt-4">
      <a href="javascript:void(0)" class="btn btn-light me-2" data-bs-dismiss="offcanvas">Cancel</a>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  `;

  isInit = true;
  types = ["A", "B", "C", "D"];
  type = "A";
  mode = "create";
  data = {};

  products = [];
  projects = [];
  isFetching = false;

  cRowCount = 0;
  cRowArr = [];
  dRowCount = 0;
  dRowArr = [];

  errors = {};

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeForm = document.getElementById("c_poposal_canvas_close_btn");

    // container buat type (A, B, C, D)
    this.pricingModelContainer = document.createElement("div");
    this.submitBtnTemplate = document.createElement("template");
    this.submitBtnTemplate.innerHTML = this.submitBtn;

    this.handleDocumentChange = this.handleDocumentChange.bind(this);
    this.handleDocumentInput = this.handleDocumentInput.bind(this);
    this.handleDocumentKeyDown = this.handleDocumentKeyDown.bind(this);
    this.handleDocumentBlur = this.handleDocumentBlur.bind(this);
    this.handleDocumentClick = this.handleDocumentClick.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this)

    this.form.addEventListener("submit", (e) => {
      e.preventDefault();
      this.handleSubmit()
    });

    // Attach global listener sekali
    document.addEventListener("change", this.handleDocumentChange);
    document.addEventListener("input", this.handleDocumentInput);
    document.addEventListener("keydown", this.handleDocumentKeyDown);
    document.addEventListener("blur", this.handleDocumentBlur, true);
    document.addEventListener("click", this.handleDocumentClick);
  }

  // ---------------------------------------- HANDLER GLOBAL ----------------------------------------
  handleDocumentKeyDown(e) {
    const target = e.target;
    if (target.matches(`.number-input`)) {
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

  async handleDocumentChange(e) {
    const target = e.target;

    // BOQ Type
    if (target.matches("#input_proposal_pricing_model")) {
      if (this.isFetching) return;

      this.type = e.target.value;
      this.resetErrorFields();
      this.clearRowsData();
      this.renderType();

      if (this.type === "C" || this.type === "D") {
        await this.fetchProducts();

        const tbody = this.pricingModelContainer.querySelector("#products_services_body");
        if (tbody) {
          const [row, errorRow] = this.createRow();
          tbody.appendChild(row);
          tbody.appendChild(errorRow);
        }
      }
      this.initPlugins();
    }

    // Title select logic
    if (target.matches(".title-select")) {
      const input = target.parentElement.querySelector(".title-value-input");
      if (input) {
        if (target.value === "") {
          input.disabled = true;
          input.value = "";
        } else {
          input.disabled = false;
          if (input.value === "") input.value = 1;
        }
      }
    }

    // Sub-header select logic
    if (target.matches(".sub-header-select") && this.type === "C") {
      const no = target.id[target.id.length - 1];
      const subheaderInput = this.pricingModelContainer.querySelector(`#subheader_input_${no}`);
      const productPrice = this.pricingModelContainer.querySelector(`#product_price_${no}`);
      const sellingPrice = this.pricingModelContainer.querySelector(`#selling_price_${no}`);

      if (subheaderInput) subheaderInput.value = "";

      const productId = parseInt(target.value);
      const product = this.products?.find(p => p.id === productId);
      const productPriceActive = formatRupiahDisplay(product?.active_price_version?.price?.toString().replace(".", ",") || 0);
      if (productPrice) productPrice.value = !target.value ? "" : productPriceActive;
      if (sellingPrice) sellingPrice.value = productPriceActive;

      this.recalculate();
    }

    if (
      target.matches(
        "#input_proposal_management_fee_type, #input_proposal_vat_rate, .title-select"
      )
    ) {
      this.recalculate();
    }

    if (target.matches("#input_proposal_status")) {
      const noteInputWrapper = this.form.querySelector("#field_note_wrapper");

      if (noteInputWrapper) {
        if (target.value === "Lose") {
          noteInputWrapper.innerHTML = `
            <div class="col-md-12">
              <div class="mb-3">
                <label class="col-form-label">Note <span class="text-danger">*</span></label>
                <textarea class="form-control" id="input_proposal_note">${this.data?.note || ""}</textarea>
                <small id="input_proposal_note_error" class="text-danger mt-1" style="display: none;"></small>
              </div>
            </div>
          `;
          noteInputWrapper.style.display = "block";
        } else {
          noteInputWrapper.style.display = "none";
          noteInputWrapper.innerHTML = "";
        }
      }
    }
  }

  handleDocumentInput(e) {
    const target = e.target;

    if (target.matches(`.number-input`)) {
      if (target.classList.contains("no-decimal")) {

        let val = target.value;
        val = val.replace(/\D/g, "").replace(/^0+(?=\d)/, "");
        if (val === "") val = "0";
        target.value = val;
      } else {
        const before = target.value;
        const caret = target.selectionStart;

        const norm = normalizeFormatRupiah(before);
        const formatted = formatRupiahDisplay(norm);

        target.value = formatted;

        const delta = formatted.length - before.length;
        const newCaret = caret + delta > 0 ? caret + delta : 0;
        target.setSelectionRange(newCaret, newCaret);
      }
    }

    // Auto calculate specific type B inputs
    if (
      target.matches(
        "#qty_adult, #price_adult, #qty_child, #price_child, #qty_infant, #price_infant, .title-value-input, .selling-price-input, #input_proposal_management_fee"
      )
    ) {
      this.recalculate();
    }

    // Type C Subheader Input to clear select
    if (target.matches(".sub-header-input")) {
      const no = target.id[target.id.length - 1];
      const productPriceEl = this.pricingModelContainer.querySelector(`#product_price_${no}`);
      const subheaderSelectEl = this.pricingModelContainer.querySelector(`#subheader_select_${no}`);

      if (productPriceEl) productPriceEl.value = "";
      if (subheaderSelectEl) subheaderSelectEl.value = "";

      this.initPlugins()
      this.recalculate();
    }
  }

  handleDocumentBlur(e) {
    const target = e.target;

    // if (target.matches('input[type="text"].number-input:not(.)')) {
    //   if (target.value.trim() === "") {
    //     target.value = "0";
    //   }
    // }
  }

  handleDocumentClick(e) {
    const target = e.target;

    if (target.matches("#add_row_btn")) {
      const tbody = this.pricingModelContainer.querySelector("#products_services_body");
      if (tbody) {
        const [row, errorRow] = this.createRow();
        tbody.appendChild(row);
        tbody.appendChild(errorRow);

        this.initPlugins();
      }
    }
  }

  // ---------------------------------------- ADDITIONAL EVENT HANDLERS ----------------------------------------
  feeFieldsEvents() {
    const description = this.form.querySelector("#input_proposal_pricing_model_description")

    if (this.mode === "edit") {
      if (this.type === "A") {
        description.value = this.data.pricing_model_description || "";
      } else if (["C", "D"].includes(this.type)) {
        const ids = this.data.items.map(obj => obj.id);
        const max = Math.max(...ids);

        if (this.type === "C") {
          this.cRowCount = max;
          this.cRowArr = ids;
        } else {
          this.dRowCount = max;
          this.dRowArr = ids;
        }

        const tbody = this.pricingModelContainer.querySelector("#products_services_body");

        this.data.items.forEach((item) => {
          if (tbody) {
            const [row, errorRow] = this.createRow(item.id);
            tbody.appendChild(row);
            tbody.appendChild(errorRow);
          }
        });
      }
    }

    this.recalculate()
  }

  // ---------------------------------------- FETCHER ----------------------------------------
  async fetchProjects() {
    this.isFetching = true;
    this.showLoading();
    return fetch("/projects/all", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
      },
    })
      .then(response => {
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        return response.json();
      })
      .then(res => {
        this.projects = res.data;
      })
      .catch(err => {
        console.error("Fetch projects error:", err);
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
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
      },
    })
      .then(response => {
        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
        return response.json();
      })
      .then(res => {
        this.products = res.data;
      })
      .catch(err => {
        console.error("Fetch products error:", err);
      })
      .finally(() => {
        this.isFetching = false
        if (!this.isInit) this.hideLoading();
      });
  }


  // ---------------------------------------- INIT ----------------------------------------
  async init(mode = "create", data = {}) {
    this.resetForm();
    this.showLoading();
    this.data = data;
    this.mode = mode;

    await Promise.all([this.fetchProjects(), this.fetchProducts()]);

    const container = document.createElement("div");
    container.id = "top-nav-container";
    container.classList.add("row");
    container.innerHTML = this.staticFields();

    this.form.appendChild(container);
    this.form.appendChild(this.pricingModelContainer);
    this.renderType();

    if ((mode === "create" || mode === "edit") && this.pricingModelContainer) {
      const submitBtnNode = this.submitBtnTemplate.content.cloneNode(true);
      this.form.appendChild(submitBtnNode);
    }

    this.initPlugins();
    this.isInit = false;
    this.hideLoading();
  }

  // ---------------------------------------- DOM ----------------------------------------
  renderType() {
    this.pricingModelContainer.innerHTML = "";

    switch (this.type) {
      case "A":
        this.renderTypeA();
        break;
      case "B":
        this.renderTypeB();
        break;
      case "C":
      case "D":
        this.renderTypeCD();
        break;
    }
  }

  createRow(_id) {
    const suffix = this.type.toLowerCase();
    let id, rowId;

    if (this.type === "C") {
      id = _id ?? ++this.cRowCount;
      rowId = `row_${id}`;
      this.cRowArr = [...new Set([...this.cRowArr, id])];
    } else if (this.type === "D") {
      id = _id ?? ++this.dRowCount;
      rowId = `row_${id}`;
      this.dRowArr = [...new Set([...this.dRowArr, id])];
    }

    let header_input = "";
    let subheader_select_value = "";
    let subheader_input_value = "";
    let t1key = "";
    let t1val = "";
    let t2key = "";
    let t2val = "";
    let t3key = "";
    let t3val = "";
    let t4key = "";
    let t4val = "";
    let product_price = "";
    let selling_price = "0";

    if (this.mode === "edit" && this.data && _id) {
      const item = this.data.items?.find(obj => obj.id === _id);

      if (item) {
        header_input = item.header || "";

        if (item.product_id) {
          subheader_select_value = item.product_id;
        } else {
          subheader_input_value = item.subheader;
        }

        t1key = item.title1_key || "";
        t1val = item.title1_value || "";
        t2key = item.title2_key || "";
        t2val = item.title2_value || "";
        t3key = item.title3_key || "";
        t3val = item.title3_value || "";
        t4key = item.title4_key || "";
        t4val = item.title4_value || "";

        let productPrice = 0;
        if (item.product_price_version_id) {
          productPrice = item.product?.price_versions?.find(v => v.id = item.product_price_version_id)?.price || 0;
        } else {
          productPrice = item.product?.active_price_version?.price || 0;
        }

        product_price = item.product_id ? formatRupiahDisplay(productPrice.toString().replace('.', ',')) : "";
        selling_price = formatRupiahDisplay((item.selling_price || 0).toString().replace('.', ','));
      }
    }

    const tr = document.createElement('tr');
    let header = `<td><input id="header_${id}" type="text" class="form-control" placeholder="Header" value="${header_input}"></td>`;
    let subheader = `<td><input id="subheader_input_${id}" type="text" class="form-control" placeholder="Sub Header" value="${subheader_input_value}"></td>`

    if (this.type === "C") {
      header = `
        <td>
          <select id="header_${id}" class="select form-select header-select">
            <option value="" ${!header_input ? "selected" : ""}>-- Select Header --</option>
            ${this.headers.map(h => `<option value="${h}" ${h === header_input ? "selected" : ""}>${h}</option>`).join('')}
          </select>
          <small id="item_header_${id}_error" class="text-danger mt-1" style="display: none;"></small>
        </td>
      `;

      subheader = `
        <td>	
          <select id="subheader_select_${id}" class="select form-select sub-header-select">
            <option value="" ${!subheader_select_value ? "selected" : ""}>-- Select Sub Header --</option>
            ${this.products.map(t => `<option value="${t.id}" ${t.id === subheader_select_value ? "selected" : ""}>${t.name}</option>`).join('')}
          </select>
          <input id="subheader_input_${id}" type="text" class="form-control sub-header-input mt-1" placeholder="Sub Header" value=${subheader_input_value}>
        </td>
      `;
    }

    tr.id = rowId;
    tr.innerHTML = `
      ${header}
      ${subheader}
      <td>
        <select id="title1_key_${id}" class="select form-select title-select">
          <option value="" ${!t1key ? "selected" : ""}>-- Select Title1 --</option>
          ${this.titles.map(t => `<option value="${t}" ${t === t1key ? "selected" : ""}>${t}</option>`).join('')}
        </select>
        <input id="title1_value_${id}" type="text" class="form-control number-input title-value-input mt-1 no-decimal" placeholder="Value" value="${t1val}" ${!t1key ? "disabled" : ""}>
        <small id="title1_value_${id}_error" class="text-danger mt-1" style="display: none;"></small>
      </td>
      <td>
        <select id="title2_key_${id}" class="select form-select title-select">
          <option value="" ${!t2key ? "selected" : ""}>-- Select Title2 --</option>
          ${this.titles.map(t => `<option value="${t}" ${t === t2key ? "selected" : ""}>${t}</option>`).join('')}
        </select>
        <input id="title2_value_${id}" type="text" class="form-control number-input title-value-input mt-1 no-decimal" placeholder="Value" value="${t2val}" ${!t2key ? "disabled" : ""}>
        <small id="title2_value_${id}_error" class="text-danger mt-1" style="display: none;"></small>
      </td>
      <td>
        <select id="title3_key_${id}" class="select form-select title-select">
          <option value="" ${!t3key ? "selected" : ""}>-- Select Title3 --</option>
          ${this.titles.map(t => `<option value="${t}" ${t === t3key ? "selected" : ""}>${t}</option>`).join('')}
        </select>
        <input id="title3_value_${id}" type="text" class="form-control number-input title-value-input mt-1 no-decimal" placeholder="Value" value="${t3val}" ${!t3key ? "disabled" : ""}>
        <small id="title3_value_${id}_error" class="text-danger mt-1" style="display: none;"></small>
      </td>
      <td>
        <select id="title4_key_${id}" class="select form-select title-select">
          <option value="" ${!t4key ? "selected" : ""}>-- Select Title4 --</option>
          ${this.titles.map(t => `<option value="${t}" ${t === t4key ? "selected" : ""}>${t}</option>`).join('')}
        </select>
        <input id="title4_value_${id}" type="text" class="form-control number-input title-value-input mt-1 no-decimal" placeholder="Value" value="${t4val}" ${!t4key ? "disabled" : ""}>
        <small id="title4_value_${id}_error" class="text-danger mt-1" style="display: none;"></small>
      </td> 
      <td><input id="product_price_${id}" type="text" class="form-control number-input" value="${product_price}" disabled="disabled"}></td>
      <td>
        <input id="selling_price_${id}" type="text" class="form-control number-input selling-price-input" value="${selling_price}">
        <small id="selling_price_${id}_error" class="text-danger mt-1" style="display: none;"></small>
      </td>
      <td><input id="subtotal_${id}" type="text" class="form-control" value="0" readonly></td>
      <td class="actions"><button type="button" class="btn btn-sm btn-danger remove-row-btn"><i class="ti ti-trash"></i></button></td>
    `;

    const errorTr = document.createElement('tr');
    errorTr.style.display = "none";
    errorTr.classList.add("tr-error");
    errorTr.innerHTML = `
      <td colspan="10">
        <small id="items_${id}_error" class="text-danger" style="display:none;"></small>
      </td>
    `;

    tr.querySelector(".remove-row-btn").addEventListener("click", () => {
      tr.remove();
      errorTr.remove();
      if (suffix == "c") {
        this.cRowArr = this.cRowArr.filter(v => v !== id);
      } else if (suffix == "d") {
        this.dRowArr = this.dRowArr.filter(v => v !== id);
      }
      this.recalculate();
    });

    return [tr, errorTr];
  }

  clearRowsData() {
    this.cRowCount = 0;
    this.cRowArr = [];
    this.cRowCount = 0;
    this.dRowArr = [];
  }

  recalculate() {
    let basic = 0;

    if (this.type === "A") {
      basic = parseFloat(normalizeFormatRupiah(this.pricingModelContainer.querySelector('#input_proposal_basic_price')?.value).replace(",", ".")) || 0;
    } else if (this.type === 'B') {
      const adult = parseInt(this.pricingModelContainer.querySelector('#qty_adult').value || 0) * parseFloat(normalizeFormatRupiah(this.pricingModelContainer.querySelector('#price_adult')?.value).replace(",", "."));
      const child = parseInt(this.pricingModelContainer.querySelector('#qty_child').value || 0) * parseFloat(normalizeFormatRupiah(this.pricingModelContainer.querySelector('#price_child')?.value).replace(",", "."));
      const infant = parseInt(this.pricingModelContainer.querySelector('#qty_infant').value || 0) * parseFloat(normalizeFormatRupiah(this.pricingModelContainer.querySelector('#price_infant')?.value).replace(",", "."));
      this.pricingModelContainer.querySelector('#subtotal_adult').value = formatRupiahDisplay(adult.toFixed(2).replace(".", ","));
      this.pricingModelContainer.querySelector('#subtotal_child').value = formatRupiahDisplay(child.toFixed(2).replace(".", ","));
      this.pricingModelContainer.querySelector('#subtotal_infant').value = formatRupiahDisplay(infant.toFixed(2).replace(".", ","));
      basic = adult + child + infant;
    } else if (this.type === 'C' || this.type === 'D') {
      let totalAmountItems = 0;
      const arr = this.type === 'C' ? [...this.cRowArr] : [...this.dRowArr];
      // console.log(this.type, this.cRowCount, this.cRowArr, this.dRowCount, this.dRowArr)
      for (let i = 0; i <= arr.length - 1; i++) {
        const idx = arr[i];
        const t1El = this.pricingModelContainer.querySelector(`#title1_value_${idx}`);
        const t2El = this.pricingModelContainer.querySelector(`#title2_value_${idx}`);
        const t3El = this.pricingModelContainer.querySelector(`#title3_value_${idx}`);
        const t4El = this.pricingModelContainer.querySelector(`#title4_value_${idx}`);
        const sellingPriceEl = this.pricingModelContainer.querySelector(`#selling_price_${idx}`);
        const subtotalEl = this.pricingModelContainer.querySelector(`#subtotal_${idx}`);
        const titles = [t1El, t2El, t3El, t4El].map(el => parseInt(el?.value) || 0);
        let amount = parseFloat(normalizeFormatRupiah(sellingPriceEl?.value).replace(",", ".")) || 0;
        const isNoMultiplier = titles.every(v => v === 0);
        // console.log(isNoMultiplier, t1El.value, t2El.value, t3El.value, t4El.value, "XXX");

        // kalau kosong dianggap 1 biar multipliernya jalan
        const subtotal = isNoMultiplier ? 0 : titles.reduce((acc, v) => acc * (v || 1), 1) * amount;
        totalAmountItems += subtotal;

        if (subtotalEl) {
          subtotalEl.value = formatRupiahDisplay(subtotal.toString().replace(".", ","));
        }
      }

      basic = totalAmountItems;
      this.pricingModelContainer.querySelector(`#total_amount_items`).value = formatRupiahDisplay(totalAmountItems.toString().replace(".", ","));
    }

    let feeType = this.pricingModelContainer.querySelector(`#input_proposal_management_fee_type`).value;
    let feeValue = parseFloat(normalizeFormatRupiah(this.pricingModelContainer.querySelector(`#input_proposal_management_fee`)?.value || 0).replace(",", "."));
    let fee = feeType === 'nominal' ? feeValue : (basic * (feeValue / 100));
    let vatPercent = parseFloat(normalizeFormatRupiah(this.pricingModelContainer.querySelector(`#input_proposal_vat_rate`)?.value || 0).replace(",", "."));
    let sales = basic + fee;
    let vat = sales * (vatPercent / 100);
    let invoice = sales + vat;

    if (this.type === 'B') {
      this.pricingModelContainer.querySelector(`#input_proposal_basic_price`).value = formatRupiahDisplay(basic.toString().replace(".", ","));
    }

    this.pricingModelContainer.querySelector(`#input_proposal_sales_amount`).value = formatRupiahDisplay(sales.toString().replace(".", ","));
    this.pricingModelContainer.querySelector(`#input_proposal_vat_amount`).value = formatRupiahDisplay(vat.toString().replace(".", ","));
    this.pricingModelContainer.querySelector(`#input_proposal_invoice_amount`).value = formatRupiahDisplay(invoice.toString().replace(".", ","));
  }

  renderTypeA() {
    this.pricingModelContainer.innerHTML = `
      <div>
        <!-- Pricing Model -->
        <div class="mb-3">
          <label class="col-form-label">Pricing Model</label>
          <div class="card p-3">
            <div class="mb-3">
              <label>Basic Price <span class="text-danger">*</span></label>
              <input type="text" class="form-control number-input" id="input_proposal_basic_price" value="${formatRupiahDisplay(this.data?.total_amount_items?.toString().replace('.', ',') || 0)}">
              <small id="input_proposal_basic_price_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
            ${this.feeFields()}
          </div>
        </div>
        <div class="mt-3" id="note">
          <span class="text-danger"><b>Note</b><br>
          <i>1. BOQ Type A adalah untuk proposal penawaran berupa satu paket event yang ditawarkan dengan tanpa rincian harga</i></span>
        </div>
      </div>
    `;

    this.feeFieldsEvents();
  }

  renderTypeB() {
    let adultQty = "0";
    let adultPrice = "0";
    let childQty = "0";
    let childPrice = "0";
    let infantQty = "0";
    let infantPrice = "0";

    if (this.mode === "edit") {
      const adult = this.data.items?.find(obj => obj.description === "Adult");
      const child = this.data.items?.find(obj => obj.description === "Child");
      const infant = this.data.items?.find(obj => obj.description === "Infant");

      adultQty = adult?.title1_value || "0";
      childQty = child?.title1_value || "0";
      infantQty = infant?.title1_value || "0";
      adultPrice = formatRupiahDisplay((adult?.selling_price || 0).toString().replace('.', ','));
      childPrice = formatRupiahDisplay((child?.selling_price || 0).toString().replace('.', ','));
      infantPrice = formatRupiahDisplay((infant?.selling_price || 0).toString().replace('.', ','));
    }
    this.pricingModelContainer.innerHTML = `
      <div>
        <!-- Pricing Model -->
        <div class="mb-3">
          <label class="col-form-label">Pricing Model</label>
          <div class="card p-3">
            <label class="mb-2">Basic Price</label>
            <div class="mb-3">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Category</th>
                    <th>Qty</th>
                    <th>Price per Person</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Adult</td>
                    <td>
                      <input type="text" class="form-control number-input no-decimal" name="qty_adult" id="qty_adult" value="${adultQty}">
                      <small id="qty_adult_error" class="text-danger mt-1" style="display: none;"></small>
                    </td>
                    <td><input type="text" class="form-control number-input" name="price_adult" id="price_adult" value="${adultPrice}"></td>
                    <td><input type="text" class="form-control number-input" id="subtotal_adult" value="0" readonly></td>
                  </tr>
                  <tr>
                    <td>Child</td>
                    <td>
                      <input type="text" class="form-control number-input no-decimal" name="qty_child" id="qty_child" value="${childQty}">
                      <small id="qty_child_error" class="text-danger mt-1" style="display: none;"></small>
                    </td>
                    <td><input type="text" class="form-control number-input" name="price_child" id="price_child" value="${childPrice}"></td>
                    <td><input type="text" class="form-control number-input" id="subtotal_child" value="0" readonly></td>
                  </tr>
                  <tr>
                    <td>Infant</td>
                    <td>
                      <input type="text" class="form-control number-input no-decimal" name="qty_infant" id="qty_infant" value="${infantQty}">
                      <small id="qty_infant_error" class="text-danger mt-1" style="display: none;"></small>
                    </td>
                    <td><input type="text" class="form-control number-input" name="price_infant" id="price_infant" value="${infantPrice}"></td>
                    <td><input type="text" class="form-control number-input" id="subtotal_infant" value="0" readonly></td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="3" class="text-end">Total</th>
                    <th><input type="text" class="form-control number-input" id="input_proposal_basic_price" readonly></th>
                  </tr>
                </tfoot>
              </table>
              <small id="items_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
            ${this.feeFields()}
          </div>
        </div>
        <div class="mt-3" id="note">
          <span class="text-danger"><b>Note</b><br>
          <i>1. BOQ Type B digunakan untuk harga paket yang berdasarkan jumlah orang</i></span>
        </div>
      </div>
    `;

    this.feeFieldsEvents();
  }

  renderTypeCD() {
    this.pricingModelContainer.innerHTML = `
      <!-- Products and Services Table -->
      <div class="mb-3">
        <label class="col-form-label">Products and Services</label>
        <div class="card p-3" style="overflow: hidden;">
          <div class="table-responsive">
            <style>
              #products_services_table td {
                min-width: 200px;
              }

              #products_services_table td.actions {
                min-width: auto;
                text-align: center;
              }

              #products_services_table input:disabled {
                background-color: #ededed;
              }
            </style>
            <table class="table table-bordered" id="products_services_table">
              <thead>
                <tr>
                  <th>Header</th>
                  <th>Sub Header (Product)</th>
                  <th>Title 1</th>
                  <th>Title 2</th>
                  <th>Title 3</th>
                  <th>Title 4</th>
                  <th>Base Price</th>
                  <th>Selling Price</th>
                  <th>Sub Total</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="products_services_body">
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="7" class="text-end">Total</th>
                  <th><input type="text" class="form-control" id="total_amount_items" value="0" readonly></th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
            <small id="items_error" class="text-danger mt-1 mb-3" style="display: none;"></small>
          </div>
          <button type="button" class="btn btn-sm btn-success" id="add_row_btn" style="margin-top: 12px;"><i class="ti ti-plus"></i> Add Row</button>
        </div>
      </div>
      ${this.feeFields()}
      <div class="mt-3" id="note">
          <span class="text-danger"><b>Note</b><br>
          <i>1. BOQ Type C digunakan untuk harga paket yang umum digunakan untuk Incentive Trips</i></span>
          <!-- <i>1. BOQ Type C digunakan untuk harga paket yang umum digunakan untuk Incentive Trips<br>
          2. One Header can consists of many Sub Header</i></span> -->
      </div>
    `;

    this.feeFieldsEvents();
  }

  initPlugins() {
    if (window.$ && $.fn.select2) {
      $('.select').select2({
        width: '100%',
        dropdownParent: $('#c_proposal_canvas_form')
      });

      // bridge event agar change bisa dideteksi
      $('.select').on('select2:select', function () {
        this.dispatchEvent(new Event('change', { bubbles: true }));
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
    this.mode = "create";
    this.type = "A";
    this.data = {};
    this.products = [];
    this.projects = [];
    this.clearRowsData();
    this.form.innerHTML = "";
    this.errors = {};
    this.loadingEl = null;

    //   // Remove global listener
    //   document.removeEventListener("change", this.handleDocumentChange);
    //   document.removeEventListener("input", this.handleDocumentInput);
    //   document.removeEventListener("blur", this.handleDocumentBlur, true);
    //   document.removeEventListener("click", this.handleDocumentClick);
  }

  // ---------------------------------------- HELPERS ----------------------------------------
  calcManagementFee(basic, percent, nominal) {
    if (percent) return basic * (percent / 100);
    if (nominal) return nominal;
    return 0;
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
          const trError = el.closest(".tr-error");
          if (trError) {
            trError.style.display = "none";
          }
        }
      });
    }
    this.errors = {};
  }

  validateFields() {
    this.resetErrorFields();
    const payload = {
      project_id: "",
      code: "",
      pricing_model: this.type,
      status: "",
      pricing_model_description: "",
      note: "",

    };

    const statusEl = this.form.querySelector("#input_proposal_status");

    const inputs = [
      {
        field: "input_proposal_project_id",
        required: true,
        message: "Project is required."
      },
      {
        field: "input_proposal_code",
        required: false,
        message: "Proposal code is required."
      },
      {
        field: "input_proposal_pricing_model",
        required: true,
        message: "Pricing Model is required."
      },
      {
        field: "input_proposal_status",
        required: true,
        message: "Status is required."
      },
      {
        field: "input_proposal_pricing_model_description",
        required: true,
        message: "Description is required."
      },
      {
        field: "input_proposal_note",
        exclude: statusEl.value !== "Lose",
        required: statusEl.value === "Lose",
        message: "Note is required."
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
      }
    ];

    // Loop static input
    inputs.forEach(input => {
      const el = this.form.querySelector("#" + input.field);
      let value = el ? el.value.trim() : "";

      if (!input.exclude) {
        payload[input.field.replace("input_proposal_", "")] = value;
      }

      if (input.field === "input_proposal_vat_rate" && !["1", "11"].includes(value)) {
        this.errors[input.field + "_error"] = "VAT rate must be 1 or 11.";
      }
      if (!value && input.required && !input.exclude) {
        this.errors[input.field + "_error"] = input.message;
      }
    });

    const total_amount_items = this.pricingModelContainer.querySelector(`#input_proposal_basic_price`);

    if (this.type === "A") {
      if (!total_amount_items?.value?.trim()) {
        this.errors[`input_proposal_basic_price_error`] = "Basic price is required."
      } else {
        payload.total_amount_items = total_amount_items?.value?.trim() || "";
        if (payload.total_amount_items.endsWith(',')) {
          payload.total_amount_items = payload.total_amount_items.slice(0, -1);
        }
      }
    } else if (this.type === "B") {
      payload.items = [];
      const categories = [
        { name: 'Adult', qtyEl: this.pricingModelContainer.querySelector('#qty_adult'), priceEl: this.pricingModelContainer.querySelector('#price_adult') },
        { name: 'Child', qtyEl: this.pricingModelContainer.querySelector('#qty_child'), priceEl: this.pricingModelContainer.querySelector('#price_child') },
        { name: 'Infant', qtyEl: this.pricingModelContainer.querySelector('#qty_infant'), priceEl: this.pricingModelContainer.querySelector('#price_infant') }
      ];

      categories.forEach(cat => {
        const qtyVal = parseInt(cat.qtyEl?.value) || 0;
        const priceVal = parseFloat(normalizeFormatRupiah(cat.priceEl?.value || "0").replace(",", ".")) || 0;

        if (priceVal > 0 && qtyVal === 0) {
          this.errors[`qty_${cat.name.toLowerCase()}_error`] = `${cat.name} qty is required.`;
        }

        if (qtyVal > 0) {
          payload.items.push({
            description: cat.name,
            selling_price: cat.priceEl?.value,
            qty: qtyVal
          });
        }
      });

      if (!payload.items.length) {
        this.errors["items_error"] = "Required: at least one category item must be specified.";
      }
    } else if (this.type === "C" || this.type === "D") {
      payload.items = [];

      const arr = this.type === 'C' ? [...this.cRowArr] : [...this.dRowArr];

      for (let i = 0; i < arr.length; i++) {
        const id = arr[i];

        const headerEl = this.pricingModelContainer.querySelector(`#header_${id}`);
        const subheaderInputEl = this.pricingModelContainer.querySelector(`#subheader_input_${id}`);
        const subheaderSelectEl = this.pricingModelContainer.querySelector(`#subheader_select_${id}`);
        const sellingPriceEl = this.pricingModelContainer.querySelector(`#selling_price_${id}`);

        // Title key/value elements
        const t1KeyEl = this.pricingModelContainer.querySelector(`#title1_key_${id}`);
        const t1ValEl = this.pricingModelContainer.querySelector(`#title1_value_${id}`);
        const t2KeyEl = this.pricingModelContainer.querySelector(`#title2_key_${id}`);
        const t2ValEl = this.pricingModelContainer.querySelector(`#title2_value_${id}`);
        const t3KeyEl = this.pricingModelContainer.querySelector(`#title3_key_${id}`);
        const t3ValEl = this.pricingModelContainer.querySelector(`#title3_value_${id}`);
        const t4KeyEl = this.pricingModelContainer.querySelector(`#title4_key_${id}`);
        const t4ValEl = this.pricingModelContainer.querySelector(`#title4_value_${id}`);

        const item = {
          header: headerEl?.value?.trim() || '',
          subheader: subheaderInputEl?.value?.trim() || '',
          product_id: subheaderSelectEl?.value || null,
          selling_price: sellingPriceEl?.value?.trim() || null,
          title1_key: t1KeyEl?.value?.trim() || null,
          title1_value: t1ValEl?.value ? parseInt(t1ValEl.value) : null,
          title2_key: t2KeyEl?.value?.trim() || null,
          title2_value: t2ValEl?.value ? parseInt(t2ValEl.value) : null,
          title3_key: t3KeyEl?.value?.trim() || null,
          title3_value: t3ValEl?.value ? parseInt(t3ValEl.value) : null,
          title4_key: t4KeyEl?.value?.trim() || null,
          title4_value: t4ValEl?.value ? parseInt(t4ValEl.value) : null
        };

        if (!item.header.trim()) {
          this.errors[`item_header_${id}_error`] = "Header is required."
        }

        if (!item.selling_price) {
          this.errors[`selling_price_${id}_error`] = "Amount is required."
        }

        // 🔍 validasi key/value
        const keyValuePairs = [
          { key: item.title1_key, value: item.title1_value, label: 'title1' },
          { key: item.title2_key, value: item.title2_value, label: 'title2' },
          { key: item.title3_key, value: item.title3_value, label: 'title3' },
          { key: item.title4_key, value: item.title4_value, label: 'title4' },
        ];

        let hasAtLeastOne = false;

        for (const pair of keyValuePairs) {
          if (pair.key && !pair.value) {
            this.errors[`${pair.label}_value_${id}_error`] = `${pair.label}_value is required and must not be 0 (zero)`;
          }
          if (pair.key && pair.value !== null) {
            hasAtLeastOne = true;
          }
        }

        if (!hasAtLeastOne) {
          this.errors[`items_${id}_error`] = `Required at least one title key-value pair on row ${id}.`;
        }

        payload.items.push(item);
      }

      if (!payload.items.length) {
        this.errors["items_error"] = "Required: at least one product or service item must be specified.";
      }
    }

    return payload;
  }

  async handleSubmit() {
    if (this.isFetching) return;
    this.isFetching = true;
    this.showLoading();

    const payload = this.validateFields();
    console.log(payload, this.errors);
    const errKeys = Object.keys(this.errors);
    if (errKeys.length) {
      errKeys.forEach(v => {
        const el = document.getElementById(v);
        if (el) {
          el.innerText = this.errors[v];
          el.style.display = "block";
          const trError = el.closest(".tr-error");
          if (trError) {
            trError.style.display = "";
          }
        }
      });
      this.isFetching = false;
      this.hideLoading()
      return;
    }

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
          try {
            // Used on project.detail page
            loadProjectData(PROJECT_ID)
          } catch (error) { }

          $('#proposal_list').DataTable().ajax.reload();
          showToast("success", response.message || 'Proposal created successfully!');
          if (this.closeForm) this.closeForm.click();
          this.resetForm()
        } else {
          showToast("error", `${result.message || result.errors}`);
        }
      } catch (err) {
        showToast("error", 'An error occurred while creating proposal.');
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
          try {
            // Used on project.detail page
            loadProjectData(PROJECT_ID)
          } catch (error) { }

          $('#proposal_list').DataTable().ajax.reload(null, false);
          showToast("success", response.message || 'Proposal updated successfully!');
          if (this.closeForm) this.closeForm.click();
          this.resetForm()
        } else {
          showToast("error", `${result.message || result.errors}`);
        }
      } catch (err) {
        showToast("error", 'An error occurred while updating BOQ.');
      } finally {
        this.isFetching = false;
        this.hideLoading()
      }
    } else {
      alert("Form mode is invalid, it shouldbe either \"create\" or \"edit\".");
      this.isFetching = false;
      this.hideLoading();
    }
  }
}

// ----------------------------------------------- TRIGER -----------------------------------------------
document.addEventListener("DOMContentLoaded", () => {
  const PROPOSAL_CANVAS = document.querySelector("#c_proposal_canvas");
  const PROPOSAL_MODAL = document.querySelector("#c_proposal_modal");
  const PROPOSAL_FORM = PROPOSAL_CANVAS?.querySelector("form#c_proposal_canvas_form")
    ? new ProposalForm("c_proposal_canvas_form")
    : null;
  const PROPOSAL_CANVAS_BS = PROPOSAL_CANVAS ? new bootstrap.Offcanvas(PROPOSAL_CANVAS) : null;
  const PROPOSAL_MODAL_BS = PROPOSAL_MODAL ? new bootstrap.Modal(PROPOSAL_MODAL) : null;

  document.addEventListener("click", async e => {
    let target = e.target;

    // CREATE
    if (target.matches("#c_proposal_create_btn")) {
      e.preventDefault();
      if (PROPOSAL_CANVAS_BS && PROPOSAL_FORM && !IS_FETCHING) {
        const title = PROPOSAL_CANVAS.querySelector("#c_proposal_canvas_title");
        title.textContent = "Create Proposal";
        PROPOSAL_FORM.resetForm();
        PROPOSAL_CANVAS_BS.show();
        await PROPOSAL_FORM.init("create");
      }
    }

    // EDIT
    if (target.closest(".c_proposal_edit_btn")) {
      target = target.closest(".c_proposal_edit_btn");
      e.preventDefault();
      if (!PROPOSAL_CANVAS_BS || !PROPOSAL_FORM || IS_FETCHING) return;
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
        })

        const resJson = await response.json();

        if (response.ok && resJson.success) {
          const title = PROPOSAL_CANVAS.querySelector("#c_proposal_canvas_title");
          title.textContent = "Edit Proposal";
          PROPOSAL_FORM.resetForm();
          PROPOSAL_CANVAS_BS.show();
          await PROPOSAL_FORM.init("edit", resJson.data);
        } else {
          showToast("error", resJson.message || "Failed to fetch proposal data for editing.");
        }
      } catch (error) {
        console.log(error);

        showToast("error", 'An error occurred while fetching the proposal data for editing.');
      } finally {
        IS_FETCHING = false;
      }
    }

    // DELETE
    else if (target.closest(".c_proposal_delete_btn")) {
      target = target.closest(".c_proposal_delete_btn");
      e.preventDefault();
      if (!PROPOSAL_MODAL_BS || IS_FETCHING) return;
      const url = target.dataset.url;
      const confirmBtn = PROPOSAL_MODAL.querySelector("#c_proposal_modal_confirm_btn");
      confirmBtn.dataset.url = url;
      PROPOSAL_MODAL_BS.show();
    }

    // CONFIRM DELETE 
    else if (target.matches("#c_proposal_modal_confirm_btn")) {
      e.preventDefault();
      if (!PROPOSAL_CANVAS_BS || !PROPOSAL_FORM || IS_FETCHING) return;
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
            // Used on project.detail page
            loadProjectData(PROJECT_ID)
          } catch (error) { }

          $('#proposal_list').DataTable().ajax.reload(null, false);
          showToast("success", resJson.message || "Proposal deleted successfully.");
          PROPOSAL_MODAL_BS.hide();
        } else {
          showToast("error", resJson.message || "Failed to delete proposal.");
        }
      } catch (error) {
        showToast("error", "An error occurred while deleting the proposal.");
      } finally {
        IS_FETCHING = false;
      }
    }
  })
});