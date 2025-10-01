class BoqForm {
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
    'Quantity',
    'Number of nights',
    'Number of rooms',
    'Number of hours',
    'Number of days',
    'Number of items',
    'Number of participants',
    'Number of unit',
    'Number of package',
    'pcs'
  ];

  selectFormType = `
    <div class="mb-3">
      <label class="col-form-label">BOQ Type <span class="text-danger">*</span></label>
      <select class="form-select" id="boq_type" required>
        <option value="A" selected>Type A - Satu paket event</option>
        <option value="B">Type B - Harga paket per orang</option>
        <option value="C">Type C - Paket Incentive Trips</option>
        <option value="D">Type D - Incentive Trips (umum)</option>
      </select>
    </div>
  `;

  descField() {
    let value = "";
    if (this.mode === "edit") value = this.data.description;

    return `
      <div class="mb-3">
        <label class="col-form-label">Description of products and services <span class="text-danger">*</span></label>
        <textarea class="form-control" id="description">${value}</textarea>
        <small id="description_error" class="text-danger mt-1" style="display: none;"></small>
      </div>
    `;
  }

  feeFields() {

    let managementFeeNominal = "";
    let managementFeePercent = "";
    let vatRateValue = "";

    if (this.mode === "edit") {
      const type = this.data.management_fee_type;

      if (type === "nominal") {
        managementFeeNominal = this.data.management_fee;
      } else if (type === "percent") {
        managementFeePercent = this.data.management_fee;
      }

      vatRateValue = this.data.vat_rate.toString();
    }

    return `
    <div class="mb-3">
      <label>Management Fee</label>
      <div class="input-group mb-2">
        <input type="text" class="form-control number-input no-default" id="management_fee_value" placeholder="Nominal" value="${managementFeeNominal}">
        <span class="input-group-text">atau</span>
        <input type="text" class="form-control number-input no-default" id="management_fee_percent" placeholder="%" value="${managementFeePercent}">
        <span class="input-group-text">%</span>
      </div>
      <small class="text-muted">Manual Entry: bisa dengan menentukan prosentasi atau menentukan nominal nya</small>
    </div>
    <div class="mb-3">
      <label>Sales Amount</label>
      <input type="text" class="form-control" id="sales_amount" value="0" readonly>
    </div>
    <div class="mb-3">
      <label>VAT</label>
      <select class="form-select" id="vat_percent">
        <option value="1" ${vatRateValue === "1" ? "selected" : ""}>1%</option>
        <option value="11" ${vatRateValue === "11" ? "selected" : ""}>11%</option>
      </select>
      <small id="vat_percent_error" class="text-danger mt-1" style="display: none;"></small>
      <small class="text-muted">Manual - Pilihan 1% atau 11%</small>
    </div>
    <div class="mb-3">
      <label>VAT Amount</label>
      <input type="text" class="form-control" id="vat_amount" value="0" readonly>
    </div>
    <div class="mb-3">
      <label>Invoice Amount</label>
      <input type="text" class="form-control" id="invoice_amount" value="0" readonly>
    </div>
  `;
  }

  submitBtn = `
    <div class="d-flex align-items-center justify-content-end mt-4">
      <a href="javascript:void(0)" id="inner_close_boq_form" class="btn btn-light me-2" data-bs-dismiss="offcanvas">Cancel</a>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  `;

  types = ["A", "B", "C", "D"];
  type = "A";
  mode = "create";
  data = {};

  products = [];
  isFetching = false;

  cRowCount = 0;
  cRowArr = [];
  dRowCount = 0;
  dRowArr = [];

  errors = {};

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeForm = document.getElementById("close_boq_form");

    // container buat type (A, B, C, D)
    this.typeContainer = document.createElement("div");
    this.typeContainer.id = "form_type_container";

    // template select
    this.selectFormTypeTemplate = document.createElement("template");
    this.selectFormTypeTemplate.innerHTML = this.selectFormType;
    this.submitBtnTemplate = document.createElement("template");
    this.submitBtnTemplate.innerHTML = this.submitBtn;

    this.handleDocumentChange = this.handleDocumentChange.bind(this);
    this.handleDocumentInput = this.handleDocumentInput.bind(this);
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
    document.addEventListener("blur", this.handleDocumentBlur, true);
    document.addEventListener("click", this.handleDocumentClick);
  }

  // ---------------------------------------- HANDLER GLOBAL ----------------------------------------
  handleDocumentChange(e) {
    const target = e.target;

    // Title select logic
    if (target.matches(".title-select")) {
      const input = target.parentElement.querySelector(".title-value-input");
      if (input) {
        if (target.value === "") {
          input.disabled = true;
          input.value = "";
        } else {
          input.disabled = false;
          if (input.value === "") input.value = 0;
        }
      }
    }

    // Sub-header select logic
    if (target.matches(".sub-header-select")) {
      const nextInput = target.nextElementSibling;
      if (nextInput) nextInput.value = "";
    }
  }

  handleDocumentInput(e) {
    const target = e.target;

    if (target.matches('input[type="text"].number-input')) {
      let val = target.value;

      if (target.classList.contains("no-decimal")) {
        val = val.replace(/\D/g, "").replace(/^0+(?=\d)/, "");
      } else {
        val = val.replace(/[^0-9.]/g, "").replace(/(\..*)\./g, "$1");
        if (val === ".") val = "0.";
        val = val.replace(/^0+([1-9])/, "$1");
      }
      target.value = val;
    }

    // Auto calculate specific type B inputs
    if (
      target.matches(
        "#qty_adult, #price_adult, #qty_child, #price_child, #qty_infant, #price_infant, .title-value-input, .amount-input"
      )
    ) {
      this.recalculate();
    }

    // Type C Subheader Input to clear select
    if (target.matches(".sub-header-input")) {
      const prevSelect = target.previousElementSibling;
      if (prevSelect) prevSelect.value = "";
    }
  }

  handleDocumentBlur(e) {
    const target = e.target;

    if (target.matches('input[type="text"].number-input:not(.no-default)')) {
      if (target.value.trim() === "") {
        target.value = "0";
      }
    }
  }

  handleDocumentClick(e) {
    const target = e.target;

    if (target.matches("#add_row_btn")) {
      const tbody = this.typeContainer.querySelector("#products_services_body");
      if (tbody) {
        const [row, errorRow] = this.createRow();
        tbody.appendChild(row);
        tbody.appendChild(errorRow);
      }
    }
  }

  // ---------------------------------------- ADDITIONAL EVENT HANDLERS ----------------------------------------
  feeFieldsEvents() {
    const description = this.typeContainer.querySelector("#description")
    const basicPrice = this.typeContainer.querySelector("#basic_price");

    const managementFeeValueEl = this.typeContainer.querySelector("#management_fee_value");
    const managementFeePercentEl = this.typeContainer.querySelector("#management_fee_percent");
    const vatPercentEl = this.typeContainer.querySelector("#vat_percent");


    if (this.mode === "edit") {
      if (this.type === "A") {
        description.value = this.data.description;
        basicPrice.value = this.data.items[0].unit_price;
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

        const tbody = this.typeContainer.querySelector("#products_services_body");

        this.data.items.forEach((item) => {
          if (tbody) {
            const [row, errorRow] = this.createRow(item.id);
            tbody.appendChild(row);
            tbody.appendChild(errorRow);
          }
        });
      }
    }

    basicPrice?.addEventListener("input", () => this.recalculate());

    managementFeeValueEl.addEventListener("input", () => {
      managementFeePercentEl.value = "";
      this.recalculate();
    });
    managementFeePercentEl.addEventListener("input", () => {
      managementFeeValueEl.value = "";
      this.recalculate();
    });
    vatPercentEl.addEventListener("input", () => this.recalculate());

    this.recalculate()
  }

  // ---------------------------------------- FETCHER ----------------------------------------
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
        throw err;
      })
      .finally(() => {
        this.isFetching = false
        this.hideLoading();
      });
  }


  // ---------------------------------------- INIT ----------------------------------------

  // static async create(formId, mode = "create") {
  //   const instance = new BoqForm(formId);
  //   await instance.init(mode);
  //   return instance;
  // }

  async init(mode = "create", data = {}) {
    this.resetForm();
    this.data = data;
    this.mode = mode;

    try {
      await this.fetchProducts();
    } catch (error) {
      console.error("Fetch products failed:", error);
    }

    if (mode === "create") {
      const selectNode = this.selectFormTypeTemplate.content.cloneNode(true);
      this.form.appendChild(selectNode);
      this.form.appendChild(this.typeContainer);

      this.selectFormTypeEl = this.form.querySelector("#boq_type");
      this.selectFormTypeEl.addEventListener("change", async (e) => {
        if (this.isFetching) return;

        this.type = e.target.value;
        this.clearRowsData();
        this.renderType();

        if (this.type === "C" || this.type === "D") {
          try {
            await this.fetchProducts();
          } catch (error) {
            console.error("Fetch products failed:", error);
          }

          const tbody = this.typeContainer.querySelector("#products_services_body");
          if (tbody) {
            const [row, errorRow] = this.createRow();
            tbody.appendChild(row);
            tbody.appendChild(errorRow);
          }
        }
      });


      this.renderType();
    }

    if (mode === "edit") {
      this.type = data.form_type[data.form_type.length - 1].toUpperCase();

      console.log("Init dalam mode edit, skip render select. Form Type : ", this.type);
      this.form.appendChild(this.typeContainer);
      this.renderType();

    }


    if ((mode === "create" || mode === "edit") && this.typeContainer) {
      const submitBtnNode = this.submitBtnTemplate.content.cloneNode(true);
      this.form.appendChild(submitBtnNode);
    }
  }

  // ---------------------------------------- DOM ----------------------------------------
  renderType() {
    this.typeContainer.innerHTML = "";

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
    let amount_input_value = "";

    if (this.mode === "edit") {
      const data = this.data?.items?.find(obj => obj.id === id);

      if (data) {
        const isFromData = data.product_id !== null;

        header_input = data.header || "";

        if (isFromData) {
          subheader_select_value = data.product_id;
        } else {
          subheader_input_value = data.subheader;
        }

        t1key = data.title1_key || "";
        t1val = data.title1_value || "";
        t2key = data.title2_key || "";
        t2val = data.title2_value || "";
        t3key = data.title3_key || "";
        t3val = data.title3_value || "";
        t4key = data.title4_key || "";
        t4val = data.title4_value || "";
        amount_input_value = data.unit_price || "0"
      }
      console.log("DATA", data)
    }
    console.log("XXX", header_input, subheader_input_value, subheader_select_value, t1key, t2key, t3key, t4key);

    const tr = document.createElement('tr');
    let header = `<td><input id="header_${id}" type="text" class="form-control" placeholder="Header" value="${header_input}"></td>`;
    let subheader = `<td><input id="subheader_${id}" type="text" class="form-control" placeholder="Sub Header" value="${subheader_input_value}"></td>`

    if (this.type === "C") {
      header = `
        <td>
          <select id="header_${id}" class="form-select header-select">
            <option value="" ${!header_input ? "selected" : ""}>-- Select Header --</option>
            ${this.headers.map(h => `<option value="${h}" ${h === header_input ? "selected" : ""}>${h}</option>`).join('')}
          </select>
          <small id="item_header_${id}_error" class="text-danger mt-1" style="display: none;"></small>
        </td>
      `;

      subheader = `
        <td>	
          <select id="subheader_select_${id}" class="form-select sub-header-select">
            <option value="" ${!subheader_select_value ? "selected" : ""}>-- Select Sub Header --</option>
            ${this.products.map(t => `<option value="${t.id}" ${t.id === subheader_select_value ? "selected" : ""}>${t.name}</option>`).join('')}
          </select>
          <input id="subheader_${id}" type="text" class="form-control sub-header-input mt-1" placeholder="Sub Header" value=${subheader_input_value}>
        </td>
      `;
    }

    tr.id = rowId;
    tr.innerHTML = `
      ${header}
      ${subheader}
      <td>
        <select id="title1_key_${id}" class="form-select title-select">
          <option value="" ${!t1key ? "selected" : ""}>-- Select Title1 --</option>
          ${this.titles.map(t => `<option value="${t}" ${t === t1key ? "selected" : ""}>${t}</option>`).join('')}
        </select>
        <input id="title1_value_${id}" type="text" class="form-control number-input no-decimal title-value-input mt-1 no-decimal" placeholder="Value" value="${t1val}" ${!t1key ? "disabled" : ""}>
        <small id="title1_value_${id}_error" class="text-danger mt-1" style="display: none;"></small>
      </td>
      <td>
        <select id="title2_key_${id}" class="form-select title-select">
          <option value="" ${!t2key ? "selected" : ""}>-- Select Title2 --</option>
          ${this.titles.map(t => `<option value="${t}" ${t === t2key ? "selected" : ""}>${t}</option>`).join('')}
        </select>
        <input id="title2_value_${id}" type="text" class="form-control number-input no-decimal title-value-input mt-1 no-decimal" placeholder="Value" value="${t2val}" ${!t2key ? "disabled" : ""}>
        <small id="title2_value_${id}_error" class="text-danger mt-1" style="display: none;"></small>
      </td>
      <td>
        <select id="title3_key_${id}" class="form-select title-select">
          <option value="" ${!t3key ? "selected" : ""}>-- Select Title3 --</option>
          ${this.titles.map(t => `<option value="${t}" ${t === t3key ? "selected" : ""}>${t}</option>`).join('')}
        </select>
        <input id="title3_value_${id}" type="text" class="form-control number-input no-decimal title-value-input mt-1 no-decimal" placeholder="Value" value="${t3val}" ${!t3key ? "disabled" : ""}>
        <small id="title3_value_${id}_error" class="text-danger mt-1" style="display: none;"></small>
      </td>
      <td>
        <select id="title4_key_${id}" class="form-select title-select">
          <option value="" ${!t4key ? "selected" : ""}>-- Select Title4 --</option>
          ${this.titles.map(t => `<option value="${t}" ${t === t4key ? "selected" : ""}>${t}</option>`).join('')}
        </select>
        <input id="title4_value_${id}" type="text" class="form-control number-input no-decimal title-value-input mt-1 no-decimal" placeholder="Value" value="${t4val}" ${!t4key ? "disabled" : ""}>
        <small id="title4_value_${id}_error" class="text-danger mt-1" style="display: none;"></small>
      </td> 
      <td><input id="amount_${id}" type="text" class="form-control number-input no-decimal amount-input" value="${amount_input_value}"></td>
      <small id="item_amount_${id}_error" class="text-danger mt-1" style="display: none;"></small>
      <td><input id="subtotal_${id}" type="text" class="form-control" value="0" readonly></td>
      <td class="actions"><button type="button" class="btn btn-sm btn-danger remove-row-btn"><i class="ti ti-trash"></i></button></td>
    `;

    const errorTr = document.createElement('tr');
    errorTr.innerHTML = `
      <td colspan="8">
        <small id="items_${id}_error" class="text-danger" style="display:none;"></small>
      </td>
    `;

    tr.querySelector(".remove-row-btn").addEventListener("click", () => {
      tr.remove();
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
      basic = parseFloat(this.typeContainer.querySelector('#basic_price').value) || 0;
    } else if (this.type === 'B') {
      const adult = parseInt(this.typeContainer.querySelector('#qty_adult').value || 0) * parseFloat(this.typeContainer.querySelector('#price_adult').value || 0);
      const child = parseInt(this.typeContainer.querySelector('#qty_child').value || 0) * parseFloat(this.typeContainer.querySelector('#price_child').value || 0);
      const infant = parseInt(this.typeContainer.querySelector('#qty_infant').value || 0) * parseFloat(this.typeContainer.querySelector('#price_infant').value || 0);
      this.typeContainer.querySelector('#subtotal_adult').value = this.formatRupiah(adult);
      this.typeContainer.querySelector('#subtotal_child').value = this.formatRupiah(child);
      this.typeContainer.querySelector('#subtotal_infant').value = this.formatRupiah(infant);
      basic = adult + child + infant;
    } else if (this.type === 'C' || this.type === 'D') {
      const subtotalArr = [];
      const arr = this.type === 'C' ? [...this.cRowArr] : [...this.dRowArr];
      console.log(this.type, this.cRowCount, this.cRowArr, this.dRowCount, this.dRowArr)
      for (let i = 0; i <= arr.length - 1; i++) {
        const idx = arr[i];
        const t1El = this.typeContainer.querySelector(`#title1_value_${idx}`);
        const t2El = this.typeContainer.querySelector(`#title2_value_${idx}`);
        const t3El = this.typeContainer.querySelector(`#title3_value_${idx}`);
        const t4El = this.typeContainer.querySelector(`#title4_value_${idx}`);
        const amountEl = this.typeContainer.querySelector(`#amount_${idx}`);
        const subtotalEl = this.typeContainer.querySelector(`#subtotal_${idx}`);

        const titles = [t1El, t2El, t3El, t4El].map(el => parseInt(el?.value) || 0);
        const amount = parseFloat(amountEl?.value) || 0;

        // cek kalau semua title = 0
        const isNoMultiplier = titles.every(v => v === 0);

        // kalau kosong dianggap 1 biar multipliernya jalan
        const subtotal = isNoMultiplier ? 0 : titles.reduce((acc, v) => acc * (v || 1), 1) * amount;
        subtotalArr.push(subtotal);

        if (subtotalEl) {
          subtotalEl.value = this.formatRupiah(subtotal);
        }
      }

      const total = subtotalArr.reduce((acc, curr) => acc + curr, 0);
      this.typeContainer.querySelector(`#total_amount`).value = this.formatRupiah(total);
      basic = total;
    }

    let feeNominal = parseFloat(this.typeContainer.querySelector(`#management_fee_value`).value) || 0;
    let feePercent = parseFloat(this.typeContainer.querySelector(`#management_fee_percent`).value) || 0;
    let vatPercent = parseFloat(this.typeContainer.querySelector(`#vat_percent`).value) || 0;
    let fee = this.calcManagementFee(basic, feePercent, feeNominal);
    let sales = basic + fee;
    let vat = sales * (vatPercent / 100);
    let invoice = sales + vat;

    if (this.type === 'B') {
      this.typeContainer.querySelector(`#basic_price`).value = this.formatRupiah(basic);
    }

    this.typeContainer.querySelector(`#sales_amount`).value = this.formatRupiah(sales);
    this.typeContainer.querySelector(`#vat_amount`).value = this.formatRupiah(vat);
    this.typeContainer.querySelector(`#invoice_amount`).value = this.formatRupiah(invoice);
  }

  renderTypeA() {
    this.typeContainer.innerHTML = `
      <div>
        ${this.descField()}
        <!-- Pricing Model -->
        <div class="mb-3">
          <label class="col-form-label">Pricing Model</label>
          <div class="card p-3">
            <div class="mb-3">
              <label>Basic Price <span class="text-danger">*</span></label>
              <input type="text" class="form-control number-input" id="basic_price" value="0">
              <small id="basic_price_error" class="text-danger mt-1" style="display: none;"></small>
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
      const adult = this.data.items.find(obj => obj.subheader === "Adult");
      const child = this.data.items.find(obj => obj.subheader === "Children");
      const infant = this.data.items.find(obj => obj.subheader === "Infant");

      adultQty = adult.title1_value;
      childQty = child.title1_value;
      infantQty = infant.title1_value;
      adultPrice = adult.unit_price;
      childPrice = child.unit_price;
      infantPrice = infant.unit_price;
    }
    this.typeContainer.innerHTML = `
      <div>
        ${this.descField()}
        <!-- Pricing Model -->
        <div class="mb-3">
          <label class="col-form-label">Pricing Model</label>
          <div class="card p-3">
            <label class="mb-2">Basic Price</label>
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
                  <td><input type="text" class="form-control" id="subtotal_adult" value="0" readonly></td>
                </tr>
                <tr>
                  <td>Child</td>
                  <td>
                    <input type="text" class="form-control number-input no-decimal" name="qty_child" id="qty_child" value="${childQty}">
                    <small id="qty_child_error" class="text-danger mt-1" style="display: none;"></small>
                  </td>
                  <td><input type="text" class="form-control number-input" name="price_child" id="price_child" value="${childPrice}"></td>
                  <td><input type="text" class="form-control" id="subtotal_child" value="0" readonly></td>
                </tr>
                <tr>
                  <td>Infant</td>
                  <td>
                    <input type="text" class="form-control number-input no-decimal" name="qty_infant" id="qty_infant" value="${infantQty}">
                    <small id="qty_infant_error" class="text-danger mt-1" style="display: none;"></small>
                  </td>
                  <td><input type="text" class="form-control number-input" name="price_infant" id="price_infant" value="${infantPrice}"></td>
                  <td><input type="text" class="form-control" id="subtotal_infant" value="0" readonly></td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="3" class="text-end">Total</th>
                  <th><input type="text" class="form-control" id="basic_price" readonly></th>
                </tr>
              </tfoot>
            </table>
            <small id="items_error" class="text-danger mt-1" style="display: none;"></small>
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
    this.typeContainer.innerHTML = `
      <div>
        ${this.descField()}
        <!-- Products and Services Table -->
        <div class="mb-3">
            <label class="col-form-label">Products and Services</label>
            <div class="card p-3">
                <div class="table-responsive" style="overflow-x:auto;">
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
                                <th>Sub Header</th>
                                <th>Title 1</th>
                                <th>Title 2</th>
                                <th>Title 3</th>
                                <th>Title 4</th>
                                <th>Amount</th>
                                <th>Sub Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="products_services_body">
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="7" class="text-end">Total</th>
                                 <th><input type="text" class="form-control" id="total_amount" value="0" readonly></th>
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
      </div>
    `;

    this.feeFieldsEvents();
  }

  showLoading() {
    if (!this.loadingEl) {
      this.loadingEl = document.createElement("div");
      this.loadingEl.className = "boq-loading-overlay";
      this.loadingEl.innerHTML = `
      <div class="boq-spinner"></div>
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
    this.type = "A";
    this.data = {};
    this.products = [];
    this.clearRowsData();
    this.form.innerHTML = "";

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
        const el = this.typeContainer.querySelector(`#${v}`);
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
    const payload = {};


    const description = this.typeContainer.querySelector(`#description`);
    if (!description || !description.value.trim()) {
      this.errors[`description_error`] = "Description is required."
    } else {
      payload.description = description.value.trim();
    }

    const basicPrice = this.typeContainer.querySelector(`#basic_price`);
    if (this.type === "A") {
      if (!basicPrice || !parseFloat(basicPrice.value)) {
        this.errors[`basic_price_error`] = "Basic price is required."
      } else {
        payload.total_amount_items = parseFloat(basicPrice.value);
      }
    } else if (this.type === "B") {
      payload.items = [];
      const adultQty = this.typeContainer.querySelector('#qty_adult');
      const childQty = this.typeContainer.querySelector('#qty_child');
      const infantQty = this.typeContainer.querySelector('#qty_infant');
      const adultPrice = this.typeContainer.querySelector('#price_adult');
      const childPrice = this.typeContainer.querySelector('#price_child');
      const infantPrice = this.typeContainer.querySelector('#price_infant');

      if (adultPrice && parseFloat(adultPrice.value)) {
        if (!adultQty || !parseInt(adultQty.value)) {
          this.errors["qty_adult_error"] = "Adult qty is required."
        } else {
          payload.items.push({
            subheader: "Adult",
            amount: parseFloat(adultPrice.value),
            qty: parseInt(adultQty.value)
          });
        }
      }

      if (childPrice && parseFloat(childPrice.value)) {
        if (!childQty || !parseInt(childQty.value)) {
          this.errors["qty_child_error"] = "Child qty is required."
        } else {
          payload.items.push({
            subheader: "Child",
            amount: parseFloat(childPrice.value),
            qty: parseInt(childQty.value)
          });
        }
      }

      if (infantPrice && parseFloat(infantPrice.value)) {
        if (!infantQty || !parseInt(infantQty.value)) {
          this.errors["qty_infant_error"] = "Infant qty is required."
        } else {
          payload.items.push({
            subheader: "Infant",
            amount: parseFloat(infantPrice.value),
            qty: parseInt(infantQty.value)
          });
        }
      }

      if (!payload.items.length) {
        this.errors["items_error"] = "Required: at least one category item must be specified.";
      }
    } else if (this.type === "C" || this.type === "D") {
      payload.items = [];

      const arr = this.type === 'C' ? [...this.cRowArr] : [...this.dRowArr];

      for (let i = 0; i < arr.length; i++) {
        const idx = arr[i];

        const headerEl = this.typeContainer.querySelector(`#header_${idx}`);
        const subheaderEl = this.typeContainer.querySelector(`#subheader_${idx}`);
        const subheaderSelectEl = this.typeContainer.querySelector(`#subheader_select_${idx}`);
        const amountEl = this.typeContainer.querySelector(`#amount_${idx}`);

        // Title key/value elements
        const t1KeyEl = this.typeContainer.querySelector(`#title1_key_${idx}`);
        const t1ValEl = this.typeContainer.querySelector(`#title1_value_${idx}`);
        const t2KeyEl = this.typeContainer.querySelector(`#title2_key_${idx}`);
        const t2ValEl = this.typeContainer.querySelector(`#title2_value_${idx}`);
        const t3KeyEl = this.typeContainer.querySelector(`#title3_key_${idx}`);
        const t3ValEl = this.typeContainer.querySelector(`#title3_value_${idx}`);
        const t4KeyEl = this.typeContainer.querySelector(`#title4_key_${idx}`);
        const t4ValEl = this.typeContainer.querySelector(`#title4_value_${idx}`);

        const item = {
          header: headerEl?.value || '',
          subheader: subheaderEl?.value || '',
          product_id: subheaderSelectEl?.value || null,
          amount: parseFloat(amountEl?.value) || 0,
          title1_key: t1KeyEl?.value || null,
          title1_value: t1ValEl?.value ? parseInt(t1ValEl.value) : null,
          title2_key: t2KeyEl?.value || null,
          title2_value: t2ValEl?.value ? parseInt(t2ValEl.value) : null,
          title3_key: t3KeyEl?.value || null,
          title3_value: t3ValEl?.value ? parseInt(t3ValEl.value) : null,
          title4_key: t4KeyEl?.value || null,
          title4_value: t4ValEl?.value ? parseInt(t4ValEl.value) : null
        };

        if (!item.header.trim()) {
          this.errors[`item_header_${idx}_error`] = "Header is required."
        }

        if (amountEl?.value === null) {
          this.errors[`item_amount_${idx}_error`] = "Amount is required."
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
            this.errors[`${pair.label}_value_${idx}_error`] = `${pair.label}_value is required and must not be 0 (zero)`;
          }
          if (pair.key && pair.value !== null) {
            hasAtLeastOne = true;
          }
        }

        if (!hasAtLeastOne) {
          this.errors[`items_${idx}_error`] = `Required at least one title key-value pair one row ${idx}.`;
        }

        payload.items.push(item);
      }

      if (!payload.items.length) {
        this.errors["items_error"] = "Required: at least one product or service item must be specified.";
      }
    }

    const managementFeeValueEl = this.typeContainer.querySelector("#management_fee_value");
    const managementFeePercentEl = this.typeContainer.querySelector("#management_fee_percent");
    const vatPercentEl = this.typeContainer.querySelector(`#vat_percent`);
    let managementFee = 0;
    let managementFeeType = "percent";

    if (managementFeeValueEl && parseFloat(managementFeeValueEl.value)) {
      managementFee = parseFloat(managementFeeValueEl.value);
      managementFeeType = "nominal";
    }
    if (managementFeePercentEl && parseFloat(managementFeePercentEl.value)) {
      managementFee = parseFloat(managementFeePercentEl.value);
    }
    if (vatPercentEl && ["1", "11"].includes(vatPercentEl.value)) {
      payload.vat_rate = parseInt(vatPercentEl.value);
    } else {
      this.errors["vat_percent_error"] = "Invalid VAT rate."
    }

    payload.management_fee = managementFee;
    payload.management_fee_type = managementFeeType;

    return payload;
  }

  async handleSubmit() {
    if (this.isFetching) return;
    this.isFetching = true;
    this.showLoading();

    const suffix = this.type.toLowerCase();
    const formType = `type-${suffix}`;

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

    payload.form_type = formType;
    console.log("Payload", payload);

    if (this.mode === "create") {
      try {
        const response = await fetch('/boqs', {
          method: 'POST',
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
          },
          body: JSON.stringify(payload)
        });

        const result = await response.json();
        console.log(result);

        if (response.ok && result.success) {
          toastr.success(response.message || 'BOQ created successfully!');
          $('#boq_list').DataTable().ajax.reload();
          if (this.closeForm) this.closeForm.click();
          console.log('BOQ created:', result, result.data);
        } else {
          console.error('Failed:', result.message || result.errors);
        }
      } catch (err) {
        toastr.error('An error occurred while creating BOQ.');
        console.error('Error:', err);
      } finally {
        this.isFetching = false;
        this.hideLoading()
      }
    } else if (this.mode === "edit") {
      try {
        const response = await fetch(`/boqs/${this.data.id}`, {
          method: 'PUT',
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
          },
          body: JSON.stringify(payload)
        });

        const result = await response.json();
        console.log(result);

        if (response.ok && result.success) {
          toastr.success(response.message || 'BOQ updated successfully!');
          $('#boq_list').DataTable().ajax.reload();
          if (this.closeForm) this.closeForm.click();
          console.log('BOQ updated:', result, result.data);
        } else {
          console.error('Failed:', result.message || result.errors);
        }
      } catch (err) {
        toastr.error('An error occurred while updating BOQ.');
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
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const createBoqBtn = document.querySelector("#c_boq_add");
  const boqForm = new BoqForm("c_boq_form");

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


  createBoqBtn.addEventListener("click", async (e) => {
    await boqForm.init("create");
  });

  document.addEventListener("click", async e => {
    const target = e.target;

    if (target.matches(".c_boq_edit")) {
      // const id = target.getAttribute("data-id");
      const url = target.getAttribute("data-url");

      const res = await fetch(url, {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
      })

      const resJson = await res.json();
      console.log(resJson.data);


      if (res.ok) {
        await boqForm.init("edit", resJson.data);
      } else {
        console.log("Error on fetching boq for edit form");
      }
    }

    // Klik delete → inject url ke tombol confirm
    if (target.matches(".c_boq_delete")) {
      e.preventDefault();
      const url = target.getAttribute("data-url");
      const confirmBtn = document.getElementById("confirm_delete_boq");
      confirmBtn.setAttribute("data-url", url);
    }

    if (target.matches("#confirm_delete_boq")) {
      e.preventDefault();

      const url = target.getAttribute("data-url");
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

      try {
        const response = await fetch(url, {
          method: "DELETE",
          headers: {
            "X-CSRF-TOKEN": csrfToken,
            "Accept": "application/json"
          }
        });

        const data = await response.json();

        if (data.success) {
          // Tutup modal
          const modal = bootstrap.Modal.getInstance(document.getElementById("delete_boq_modal"));
          modal.hide();

          // DataTable → reload
          $('#boq_list').DataTable().ajax.reload();


          // Toastr success
          toastr.success(data.message || "BOQ deleted successfully!");
        } else {
          toastr.error(data.message || "Failed to delete BOQ.");
        }
      } catch (err) {
        toastr.error("Server error. Failed to delete BOQ.");
        console.error(err);
      }
    }
  });
});
