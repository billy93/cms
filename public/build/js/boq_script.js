class BoqForm {
  headers = [
    'Accommodation', 'Activities , Outdoor', 'Airport Assistance', 'Air tickets', 'Documentation', 'Entrance ticket - Shows and Entertainment', 'Entrance ticket - Places of interest', 'Excursion', 'F&B Restaurants', 'Front of House', 'Goodie Bags', 'Gratitudes', 'Insurance', 'Land transportation', 'Lighting', 'Manpower', 'MC', 'Media Relation', 'Meeting and Conference Kits', 'Meeting Package', 'Merchandise', 'Multimedia', 'Paramedic and First Aids', 'Rail tickets', 'Sales and Promotion Materials', 'Security Service & Fire', 'Software', 'Sound System', 'Speaker', 'Stationery', 'Streaming', 'Survey', 'Talents', 'Team Building', 'Travel Documents', 'Traveling kits', 'Venue'
  ];

  titles = [
    'Quantity', 'Number of nights', 'Number of rooms', 'Number of hours', 'Number of days', 'Number of items', 'Number of participants', 'Number of unit', 'Number of package', 'Unit Price'
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

  descField = `
    <!-- Description of products and services -->
    <div class="mb-3">
      <label class="col-form-label">Description of products and services <span class="text-danger">*</span></label>
      <textarea class="form-control" id="description"></textarea>
      <small id="description_error" class="text-danger mt-1" style="display: none;"></small>
    </div>
  `;

  feeFields = `
    <div class="mb-3">
      <label>Management Fee</label>
      <div class="input-group mb-2">
        <input type="text" class="form-control number-input no-default" id="management_fee_value" placeholder="Nominal">
        <span class="input-group-text">atau</span>
        <input type="text" class="form-control number-input no-default" id="management_fee_percent" placeholder="%">
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
        <option value="1" selected>1%</option>
        <option value="11">11%</option>
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

  submitBtn = `
    <div class="d-flex align-items-center justify-content-end mt-4">
      <a href="javascript:void(0)" class="btn btn-light me-2" data-bs-dismiss="offcanvas">Cancel</a>
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  `;

  types = ["A", "B", "C", "D"];
  type = "A";

  products = [];
  isFetching = false;

  cRowCount = 0;
  cRowArr = [];
  dRowCount = 0;
  dRowArr = [];

  errors = {};

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeForm = document.getElementById("close_boq_add");

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
    if (e.target.matches("#add_row_btn")) {
      const tbody = this.typeContainer.querySelector("#products_services_body");
      if (tbody) tbody.appendChild(this.createRow());
    }
  }

  // ---------------------------------------- ADDITIONAL EVENT HANDLERS ----------------------------------------
  feeFieldsEvents() {
    const managementFeeValueEl = this.typeContainer.querySelector("#management_fee_value");
    const managementFeePercentEl = this.typeContainer.querySelector("#management_fee_percent");
    const vatPercentEl = this.typeContainer.querySelector("#vat_percent");

    managementFeeValueEl.addEventListener("input", () => {
      managementFeePercentEl.value = "";
      this.recalculate();
    });
    managementFeePercentEl.addEventListener("input", () => {
      managementFeeValueEl.value = "";
      this.recalculate();
    });
    vatPercentEl.addEventListener("input", () => this.recalculate());
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

  async init(mode = "create") {
    this.mode = mode;
    this.form.innerHTML = "";

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
          tbody.innerHTML = "";
          tbody.appendChild(this.createRow());
        }
      });


      this.renderType();
    }

    if (mode === "edit") {
      console.log("Init dalam mode edit, skip render select");
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

  createRow() {
    const suffix = this.type.toLowerCase();
    let id, rowId;

    if (this.type === "C") {
      id = ++this.cRowCount;
      rowId = `row_${this.cRowCount}`;
      this.cRowArr = [...new Set([...this.cRowArr, this.cRowCount])];
    } else if (this.type === "D") {
      id = ++this.dRowCount;
      rowId = `row_${this.dRowCount}`;
      this.dRowArr = [...new Set([...this.dRowArr, this.dRowCount])];
    }

    const tr = document.createElement('tr');
    let subheader = `<td><input id="subheader_${id}" type="text" class="form-control" placeholder="Sub Header"></td>`

    if (this.type === "C") {
      subheader = `
        <td>	
          <select id="subheader_select_${id}" class="form-select sub-header-select">
            <option value="">-- Select Header --</option>
            ${this.products.map(t => `<option value="${t.id}">${t.name}</option>`).join('')}
          </select>
          <input id="subheader_${id}" type="text" class="form-control sub-header-input mt-1" placeholder="Sub Header">
        </td>
      `;
    }

    tr.id = rowId;
    tr.innerHTML = `
      <td>
        <select id="header_${id}" class="form-select header-select">
          <option value="">-- Select Header --</option>
          ${this.headers.map(h => `<option value="${h}">${h}</option>`).join('')}
        </select>
      </td>
      ${subheader}
      <td>
        <select id="title1_key_${id}" class="form-select title-select">
          <option value="">-- Select Title1 --</option>
          ${this.titles.map(t => `<option value="${t}">${t}</option>`).join('')}
        </select>
        <input id="title1_value_${id}" type="text" class="form-control number-input no-decimal title-value-input mt-1 no-decimal" placeholder="Value" disabled>
      </td>
      <td>
        <select id="title2_key_${id}" class="form-select title-select">
          <option value="">-- Select Title2 --</option>
          ${this.titles.map(t => `<option value="${t}">${t}</option>`).join('')}
        </select>
        <input id="title2_value_${id}" type="text" class="form-control number-input no-decimal title-value-input mt-1 no-decimal" placeholder="Value" disabled>
      </td>
      <td>
        <select id="title3_key_${id}" class="form-select title-select">
          <option value="">-- Select Title3 --</option>
          ${this.titles.map(t => `<option value="${t}">${t}</option>`).join('')}
        </select>
        <input id="title3_value_${id}" type="text" class="form-control number-input no-decimal title-value-input mt-1 no-decimal" placeholder="Value" disabled>
      </td>
      <td>
        <select id="title4_key_${id}" class="form-select title-select">
          <option value="">-- Select Title4 --</option>
          ${this.titles.map(t => `<option value="${t}">${t}</option>`).join('')}
        </select>
        <input id="title4_value_${id}" type="text" class="form-control number-input no-decimal title-value-input mt-1 no-decimal" placeholder="Value" disabled>
      </td>
      <td><input id="amount_${id}" type="text" class="form-control number-input no-decimal amount-input" min="0" value="0"></td>
      <td><input id="subtotal_${id}" type="text" class="form-control" value="0" readonly></td>
      <td class="actions"><button type="button" class="btn btn-sm btn-danger remove-row-btn"><i class="ti ti-trash"></i></button></td>
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

    return tr;
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
        ${this.descField}
        <!-- Pricing Model -->
        <div class="mb-3">
          <label class="col-form-label">Pricing Model</label>
          <div class="card p-3">
            <div class="mb-3">
              <label>Basic Price <span class="text-danger">*</span></label>
              <input type="text" class="form-control number-input" id="basic_price" value="0">
              <small id="basic_price_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
            ${this.feeFields}
          </div>
        </div>
        <div class="mt-3" id="note">
          <span class="text-danger"><b>Note</b><br>
          <i>1. BOQ Type A adalah untuk proposal penawaran berupa satu paket event yang ditawarkan dengan tanpa rincian harga</i></span>
        </div>
      </div>
    `;

    const basicPrice = this.typeContainer.querySelector("#basic_price");
    basicPrice.addEventListener("input", () => this.recalculate());
    this.feeFieldsEvents();
  }

  renderTypeB() {
    this.typeContainer.innerHTML = `
      <div>
        ${this.descField}
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
                    <input type="text" class="form-control number-input no-decimal" name="qty_adult" id="qty_adult" value="0">
                    <small id="qty_adult_error" class="text-danger mt-1" style="display: none;"></small>
                  </td>
                  <td><input type="text" class="form-control number-input" name="price_adult" id="price_adult" value="0"></td>
                  <td><input type="text" class="form-control" id="subtotal_adult" value="0" readonly></td>
                </tr>
                <tr>
                  <td>Child</td>
                  <td>
                    <input type="text" class="form-control number-input no-decimal" name="qty_child" id="qty_child" value="0">
                    <small id="qty_child_error" class="text-danger mt-1" style="display: none;"></small>
                  </td>
                  <td><input type="text" class="form-control number-input" name="price_child" id="price_child" value="0"></td>
                  <td><input type="text" class="form-control" id="subtotal_child" value="0" readonly></td>
                </tr>
                <tr>
                  <td>Infant</td>
                  <td>
                    <input type="text" class="form-control number-input no-decimal" name="qty_infant" id="qty_infant" value="0">
                    <small id="qty_infant_error" class="text-danger mt-1" style="display: none;"></small>
                  </td>
                  <td><input type="text" class="form-control number-input" name="price_infant" id="price_infant" value="0"></td>
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
            ${this.feeFields}
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
        ${this.descField}
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
                    <table class="table table-bordered mb-3" id="products_services_table">
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
                </div>
                <button type="button" class="btn btn-sm btn-success" id="add_row_btn" style="margin-top: 12px;"><i class="ti ti-plus"></i> Add Row</button>
            </div>
        </div>
        ${this.feeFields}
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
        this.errors["items_error"] = "Required at least one category item specified."
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
    console.log(this.errors);
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
    }
  }
}

document.addEventListener("DOMContentLoaded", () => {
  const createBoqBtn = document.querySelector("#c_boq_add");
  const boqForm = new BoqForm("addBOQ");

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
});
