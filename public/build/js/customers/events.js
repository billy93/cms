class CustomerForm {
  isInit = true;
  mode = "create";
  data = {};
  errors = {};

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeForm = document.getElementById("close_customer_form");

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
    formWrapper.id = "customer_form_wrapper";
    formWrapper.innerHTML = this.createForm();
    this.form.appendChild(formWrapper);
    this.initPlugins();
    this.isInit = false;
    this.hideLoading();
  }

  createForm() {
    const isEdit = this.mode === "edit";

    const value = {
      code: "",
      status: "Active",
      name: "",
      address: "",
      contact_person: "",
      phone: "",
      email: "",
      bank_name: "",
      bank_account_number: "",
      bank_account_name: "",
      notes: "",
    }

    if (isEdit && this.data) {
      value.code = this.data.code || "";
      value.status = this.data.status || "Active";
      value.name = this.data.name || "";
      value.address = this.data.address || "";
      value.contact_person = this.data.contact_person || "";
      value.phone = this.data.phone || "";
      value.email = this.data.email || "";
      value.bank_name = this.data.bank_name || "";
      value.bank_account_number = this.data.bank_account_number || "";
      value.bank_account_name = this.data.bank_account_name || "";
      value.notes = this.data.notes || "";
    }

    const selectStatusOptions = ['Active', 'Inactive'].map(s => {
      return `<option value="${s}" ${value.status === s ? "selected" : ""}>${s}</option>`;
    });

    const dynamic = isEdit ?
      `
        <div class="col-md-6">
          <div class="mb-3">
            <label class="col-form-label">Customer Code</label>
              <input type="text" id="input_customer_code" class="form-control btn-disabled" value="${value.code}" disabled>
          </div>
        </div>
      ` : ""
      ;

    return `
      <div>
        <div class="row">
          ${dynamic}
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Status<span class="text-danger">*</span></label>
              <select id="input_customer_status" class="select form-control" style="text-transform: capitaliza;">
                <option value="" ${!value.status ? "selected" : ""}>-- Select Status --</option>
                ${selectStatusOptions}
              </select>
              <small id="input_customer_status_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Customer Name<span class="text-danger">*</span></label>
              <input type="text" id="input_customer_name" class="form-control btn-disabled" value="${value.name}">
              <small id="input_customer_name_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Contact Person</label>
              <input type="text" id="input_customer_contact_person" class="form-control btn-disabled" value="${value.contact_person}">
              <small id="input_customer_contact_person_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Phone<span class="text-danger">*</span></label>
              <input type="text" id="input_customer_phone" class="form-control btn-disabled" value="${value.phone}">
              <small id="input_customer_phone_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Email</label>
              <input type="email" id="input_customer_email" class="form-control btn-disabled" value="${value.email}">
              <small id="input_customer_email_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Bank Name</label>
              <input type="text" id="input_customer_bank_name" class="form-control btn-disabled" value="${value.bank_name}">
              <small id="input_customer_bank_name_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Bank Account Number</label>
              <input type="text" id="input_customer_bank_account_number" class="form-control btn-disabled" value="${value.bank_account_number}">
              <small id="input_customer_bank_account_number_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Bank Account Name</label>
              <input type="text" id="input_customer_bank_account_name" class="form-control btn-disabled" value="${value.bank_account_name}">
              <small id="input_customer_bank_account_name_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label class="col-form-label">Address<span class="text-danger">*</span></label>
              <textarea class="form-control" id="input_customer_address">${value.address}</textarea>
              <small id="input_customer_address_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label class="col-form-label">Notes</label>
              <textarea class="form-control" id="input_customer_notes">${value.notes}</textarea>
              <small id="input_customer_notes_error" class="text-danger mt-1" style="display: none;"></small>
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
    if (window.$ && $.fn.select2) {
      $('.select').select2({
        width: '100%',
        dropdownParent: $('#c_customer_canvas_form')
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
    this.data = {};
    this.form.innerHTML = "";
    this.errors = {};
    this.loadingEl = null;
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

    const payload = {};

    const inputs = [
      {
        field: "input_customer_name",
        required: true,
        message: "Name is required."
      },
      {
        field: "input_customer_status",
        required: false,
        message: "Status is required."
      },
      {
        field: "input_customer_contact_person",
        required: false,
        message: "Contact Person is required."
      },
      {
        field: "input_customer_phone",
        required: true,
        message: "Phone is required."
      },
      {
        field: "input_customer_email",
        required: false,
        message: "Email is required."
      },
      {
        field: "input_customer_bank_name",
        required: false,
        message: "Bank Name is required."
      },
      {
        field: "input_customer_bank_account_number",
        required: false,
        message: "Bank Name is required."
      },
      {
        field: "input_customer_bank_account_name",
        required: false,
        message: "Bank Name is required."
      },
      {
        field: "input_customer_bank_account_name",
        required: false,
        message: "Bank Name is required."
      },
      {
        field: "input_customer_address",
        required: true,
        message: "Address is required."
      },
      {
        field: "input_customer_notes",
        required: false,
        message: "Notes is required."
      },
    ];

    inputs.forEach(id => {
      const el = this.form.querySelector("#" + id.field);
      let value = el ? el.value.trim() : "";

      payload[id.field.replace("input_customer_", "")] = value;

      if (!value && id.required) {
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
        if (el) {
          el.innerText = this.errors[v];
          el.style.display = "block";
        }
      });
      this.isFetching = false;
      this.hideLoading()
      return;
    }

    if (this.mode === "create") {
      try {
        const response = await fetch('/customers', {
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
          showToast("success", response.message || 'Customer created successfully!');
          $('#customer_list').DataTable().ajax.reload();
          if (this.closeForm) this.closeForm.click();
          this.resetForm()
        } else {
          showToast("error", result.message || result.errors);
        }
      } catch (err) {
        showToast("error", 'An error occurred while creating Customer.');
      } finally {
        this.isFetching = false;
        this.hideLoading()
      }
    } else if (this.mode === "edit") {
      try {
        const response = await fetch(`/customers/${this.data.id}`, {
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
          showToast("success", response.message || 'Customer updated successfully!');
          $('#customer_list').DataTable().ajax.reload(null, false);
          if (this.closeForm) this.closeForm.click();
          this.resetForm();
          console.log(result);

        } else {
          showToast("error", result.message || result.errors);
        }
      } catch (err) {
        showToast("error", 'An error occurred while updating Customer.');
      } finally {
        this.isFetching = false;
        this.hideLoading();
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
  const CUSTOMER_CANVAS = document.querySelector("#c_customer_canvas");
  const CUSTOMER_MODAL = document.querySelector("#c_customer_modal");
  const CUSTOMER_FORM = CUSTOMER_CANVAS?.querySelector("form#c_customer_canvas_form")
    ? new CustomerForm("c_customer_canvas_form")
    : null;
  const CUSTOMER_CANVAS_BS = CUSTOMER_CANVAS ? new bootstrap.Offcanvas(CUSTOMER_CANVAS) : null;
  const CUSTOMER_MODAL_BS = CUSTOMER_MODAL ? new bootstrap.Modal(CUSTOMER_MODAL) : null;

  document.addEventListener("click", async e => {
    let target = e.target;

    // CREATE
    if (target.matches("#c_customer_create_btn")) {
      e.preventDefault();
      if (CUSTOMER_CANVAS_BS && CUSTOMER_FORM && !IS_FETCHING) {
        const title = CUSTOMER_CANVAS.querySelector("#c_customer_canvas_title");
        title.textContent = "Create Customer";
        CUSTOMER_CANVAS_BS.show();
        CUSTOMER_FORM.resetForm();
        await CUSTOMER_FORM.init("create");
      }
    }

    // EDIT
    if (target.closest(".c_customer_edit_btn")) {
      target = target.closest(".c_customer_edit_btn");
      e.preventDefault();
      if (!CUSTOMER_CANVAS_BS || !CUSTOMER_FORM || IS_FETCHING) return;
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
          const title = CUSTOMER_CANVAS.querySelector("#c_customer_canvas_title");
          title.textContent = "Edit Customer";
          CUSTOMER_CANVAS_BS.show();
          CUSTOMER_FORM.resetForm();
          await CUSTOMER_FORM.init("edit", resJson.data);
        } else {
          showToast("error", resJson.message || "Failed to fetch customer data for editing.");
        }
      } catch (error) {
        console.log(error);

        showToast("error", 'An error occurred while fetching the customer data for editing.');
      } finally {
        IS_FETCHING = false;
      }
    }

    // DELETE
    else if (target.closest(".c_customer_delete_btn")) {
      target = target.closest(".c_customer_delete_btn");
      e.preventDefault();
      if (!CUSTOMER_MODAL_BS || IS_FETCHING) return;
      const url = target.dataset.url;
      const confirmBtn = CUSTOMER_MODAL.querySelector("#c_customer_modal_confirm_btn");
      confirmBtn.dataset.url = url;
      CUSTOMER_MODAL_BS.show();
    }

    // CONFIRM DELETE 
    else if (target.matches("#c_customer_modal_confirm_btn")) {
      e.preventDefault();
      if (!CUSTOMER_CANVAS_BS || !CUSTOMER_FORM || IS_FETCHING) return;
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
          $('#customer_list').DataTable().ajax.reload(null, false);
          showToast("success", resJson.message || "Customer deleted successfully.");
          CUSTOMER_MODAL_BS.hide();
        } else {
          showToast("error", resJson.message || "Failed to delete customer.");
        }
      } catch (error) {
        showToast("error", "An error occurred while deleting the customer.");
      } finally {
        IS_FETCHING = false;
      }
    }
  })
});