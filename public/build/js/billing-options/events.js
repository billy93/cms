class BillingOptionForm {
  isInit = true;
  mode = "create";
  data = {};
  errors = {};

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeForm = document.getElementById("c_bill_addr_canvas_close_btn");

    this.handleDocumentInput = this.handleDocumentInput.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this)

    this.form.addEventListener("submit", (e) => {
      e.preventDefault();
      this.handleSubmit()
    });

    document.addEventListener("input", this.handleDocumentInput);
  }

  async handleDocumentInput(e) {
    const target = e.target;
  }

  // ---------------------------------------- INIT ----------------------------------------
  async init(mode = "create", data = {}) {
    this.resetForm();
    this.showLoading();
    this.data = data;
    this.mode = mode;

    const formWrapper = document.createElement("div");
    formWrapper.id = "bill_addr_form_wrapper";
    formWrapper.innerHTML = this.createForm();
    this.form.appendChild(formWrapper);
    this.initPlugins();
    this.isInit = false;
    this.hideLoading();
  }

  createForm() {
    const isEdit = this.mode === "edit";

    const value = {
      cp_name: "",
      cp_title_division: "",
      cp_email: "",
      cp_office_number: "",
      cp_mobile_number: "",
      address: "",
      is_overseas: 0,
    }

    if (isEdit && this.data) {
      value.cp_name = this.data.cp_name || "";
      value.cp_title_division = this.data.cp_title_division || "";
      value.cp_email = this.data.cp_email || "";
      value.cp_office_number = this.data.cp_office_number || "";
      value.cp_mobile_number = this.data.cp_mobile_number || "";
      value.address = this.data.address || "";
      value.is_overseas = this.data.is_overseas ? 1 : 0;
    }

    return `
      <div>
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Contact Person Name<span class="text-danger">*</span></label>
              <input type="text" id="input_bill_cp_name" class="form-control" value="${value.cp_name}">
              <small id="input_bill_cp_name_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Title / Division</label>
              <input type="text" id="input_bill_cp_title_division" class="form-control" value="${value.cp_title_division}">
              <small id="input_bill_cp_title_division_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Email</label>
              <input type="email" id="input_bill_cp_email" class="form-control" value="${value.cp_email}">
              <small id="input_bill_cp_email_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Office Number</label>
              <input type="text" id="input_bill_cp_office_number" class="form-control" value="${value.cp_office_number}">
              <small id="input_bill_cp_office_number_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Mobile Number</label>
              <input type="text" id="input_bill_cp_mobile_number" class="form-control" value="${value.cp_mobile_number}">
              <small id="input_bill_cp_mobile_number_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Is Overseas?</label>
              <select id="input_bill_is_overseas" class="form-control">
                <option value="0" ${value.is_overseas === 0 ? "selected" : ""}>No</option>
                <option value="1" ${value.is_overseas === 1 ? "selected" : ""}>Yes</option>
              </select>
              <small id="input_bill_is_overseas_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label class="col-form-label">Address<span class="text-danger">*</span></label>
              <textarea class="form-control" id="input_bill_address">${value.address}</textarea>
              <small id="input_bill_address_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-end mt-4">
          <a href="javascript:void(0)" class="btn btn-light me-2" data-bs-dismiss="offcanvas">Cancel</a>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    `;
  }

  initPlugins() {
    // Select2 if needed
  }

  showLoading() {
    if (!this.loadingEl) {
      this.loadingEl = document.createElement("div");
      this.loadingEl.className = "c-form-loading-overlay";
      this.loadingEl.innerHTML = `<div class="c-form-spinner"></div>`;
      Object.assign(this.loadingEl.style, {
        position: "absolute", top: 0, left: 0, width: "100%", height: "100%",
        background: "rgba(255,255,255,0.7)", display: "flex", justifyContent: "center",
        alignItems: "center", zIndex: 9999
      });
      this.form.appendChild(this.loadingEl);
    }
    this.loadingEl.style.display = "flex";
  }

  hideLoading() {
    if (this.loadingEl) this.loadingEl.style.display = "none";
  }

  resetForm() {
    this.isInit = true;
    this.mode = "create";
    this.data = {};
    this.form.innerHTML = "";
    this.errors = {};
    this.loadingEl = null;
  }

  resetErrorFields() {
    const errKeys = Object.keys(this.errors);
    if (errKeys.length) {
      errKeys.forEach(v => {
        const el = this.form.querySelector(`#${v}`);
        if (el) { el.innerText = ""; el.style.display = "none"; }
      });
    }
    this.errors = {};
  }

  validateFields() {
    this.resetErrorFields();
    const payload = { customer_id: CUSTOMER_ID };
    const inputs = [
      { field: "input_bill_cp_name", required: true, message: "Name is required." },
      { field: "input_bill_cp_title_division", required: false },
      { field: "input_bill_cp_email", required: false },
      { field: "input_bill_cp_office_number", required: false },
      { field: "input_bill_cp_mobile_number", required: false },
      { field: "input_bill_is_overseas", required: true },
      { field: "input_bill_address", required: true, message: "Address is required." },
    ];

    inputs.forEach(id => {
      const el = this.form.querySelector("#" + id.field);
      let value = el ? el.value.trim() : "";
      payload[id.field.replace("input_bill_", "")] = value;
      if (!value && id.required && id.message) {
        this.errors[id.field + "_error"] = id.message;
      }
    });

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
        if (el) { el.innerText = this.errors[v]; el.style.display = "block"; }
      });
      this.isFetching = false;
      this.hideLoading()
      return;
    }

    const url = this.mode === "create" ? '/billing-options' : `/billing-options/${this.data.id}`;
    const method = this.mode === "create" ? 'POST' : 'PUT';

    try {
      const response = await fetch(url, {
        method: method,
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
        body: JSON.stringify(payload)
      });

      const result = await response.json();

      if (response.ok && result.success) {
        showToast("success", result.message || 'Billing address saved successfully!');
        $('#billing_option_list').DataTable().ajax.reload(null, false);
        if (this.closeForm) this.closeForm.click();
        this.resetForm()
      } else {
        showToast("error", result.message || "Failed to save billing address.");
      }
    } catch (err) {
      showToast("error", 'An error occurred while saving billing address.');
    } finally {
      this.isFetching = false;
      this.hideLoading()
    }
  }
}

// ----------------------------------------------- TRIGGER -----------------------------------------------

document.addEventListener("DOMContentLoaded", () => {
  const BILL_ADDR_CANVAS = document.querySelector("#c_bill_addr_canvas");
  const BILL_ADDR_MODAL = document.querySelector("#c_bill_addr_modal");
  const BILL_ADDR_FORM = BILL_ADDR_CANVAS?.querySelector("form#c_bill_addr_canvas_form")
    ? new BillingOptionForm("c_bill_addr_canvas_form")
    : null;
  const BILL_ADDR_CANVAS_BS = BILL_ADDR_CANVAS ? new bootstrap.Offcanvas(BILL_ADDR_CANVAS) : null;
  const BILL_ADDR_MODAL_BS = BILL_ADDR_MODAL ? new bootstrap.Modal(BILL_ADDR_MODAL) : null;

  document.addEventListener("click", async e => {
    let target = e.target;

    // CREATE
    if (target.matches("#c_bill_addr_create_btn")) {
      e.preventDefault();
      if (BILL_ADDR_CANVAS_BS && BILL_ADDR_FORM) {
        const title = BILL_ADDR_CANVAS.querySelector("#c_bill_addr_canvas_title");
        title.textContent = "Create Billing Address";
        BILL_ADDR_CANVAS_BS.show();
        await BILL_ADDR_FORM.init("create");
      }
    }

    // EDIT
    if (target.closest(".c_bill_addr_edit_btn")) {
      target = target.closest(".c_bill_addr_edit_btn");
      e.preventDefault();
      if (!BILL_ADDR_CANVAS_BS || !BILL_ADDR_FORM) return;

      const url = target.dataset.url;
      try {
        const response = await fetch(url, {
          method: "GET",
          headers: { "Accept": "application/json" },
        })
        const resJson = await response.json();
        if (response.ok && resJson.success) {
          const title = BILL_ADDR_CANVAS.querySelector("#c_bill_addr_canvas_title");
          title.textContent = "Edit Billing Address";
          BILL_ADDR_CANVAS_BS.show();
          await BILL_ADDR_FORM.init("edit", resJson.data);
        }
      } catch (error) { showToast("error", 'Failed to fetch billing address data.'); }
    }

    // DELETE
    else if (target.closest(".c_bill_addr_delete_btn")) {
      target = target.closest(".c_bill_addr_delete_btn");
      e.preventDefault();
      if (!BILL_ADDR_MODAL_BS) return;
      const url = target.dataset.url;
      const confirmBtn = BILL_ADDR_MODAL.querySelector("#c_bill_addr_modal_confirm_btn");
      confirmBtn.dataset.url = url;
      BILL_ADDR_MODAL_BS.show();
    }

    // CONFIRM DELETE 
    else if (target.matches("#c_bill_addr_modal_confirm_btn")) {
      e.preventDefault();
      try {
        const url = target.dataset.url;
        const response = await fetch(url, {
          method: "DELETE",
          headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            "Accept": "application/json"
          }
        });
        const resJson = await response.json();
        if (response.ok && resJson.success) {
          $('#billing_option_list').DataTable().ajax.reload(null, false);
          showToast("success", resJson.message || "Address deleted successfully.");
          BILL_ADDR_MODAL_BS.hide();
        }
      } catch (error) { showToast("error", "Failed to delete address."); }
    }
  })
});
