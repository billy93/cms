class SupplierForm {
  isInit = true;
  mode = "create";
  data = {};
  errors = {};

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeForm = document.getElementById("close_supplier_form");

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
    formWrapper.id = "supplier_form_wrapper";
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
      name: "",
      address: "",
      contact_person: "",
      phone: "",
      email: "",
      tax_number: "",
      bank_name: "",
      bank_account_number: "",
      bank_account_name: "",
      status: "",
      notes: "",
    }

    if (isEdit && this.data) {
      value.code = this.data.code || "";
      value.name = this.data.name || "";
      value.address = this.data.address || "";
      value.contact_person = this.data.contact_person || "";
      value.phone = this.data.phone || "";
      value.email = this.data.email || "";
      value.tax_number = this.data.tax_number || "";
      value.bank_name = this.data.bank_name || "";
      value.bank_account_number = this.data.bank_account_number || "";
      value.bank_account_name = this.data.bank_account_name || "";
      value.status = this.data.status || "";
      value.notes = this.data.notes || "";
    }

    const selectStatusOptions = ['Active', 'Inactive'].map(s => {
      return `<option value="${s}" ${value.status === s ? "selected" : ""}>${s}</option>`;
    });

    const supplierCodeField = isEdit ? `
      <div class="col-md-6">
        <div class="mb-3">
          <label class="col-form-label">Code<span class="text-danger">*</span></label>
          <input type="text" id="input_supp_code" class="form-control" value="${value.name}" disabled>
        </div>
      </div>
    ` : "";

    return `
      <div>
        <div class="row">
          ${supplierCodeField}
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Name<span class="text-danger">*</span></label>
              <input type="text" id="input_supp_name" class="form-control" value="${value.name}">
              <small id="input_supp_name_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Address<span class="text-danger">*</span></label>
              <input type="text" id="input_supp_address" class="form-control" value="${value.address}">
              <small id="input_supp_address_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Contact Person</label>
              <input type="text" id="input_supp_contact_person" class="form-control" value="${value.contact_person}" data-type="currency">
              <small id="input_supp_contact_person_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Phone<span class="text-danger">*</span></label>
              <input type="tel" id="input_supp_phone" class="form-control" value="${value.phone}" data-type="currency">
              <small id="input_supp_phone_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Email</label>
              <input type="email" id="input_supp_email" class="form-control" value="${value.email}" data-type="currency">
              <small id="input_supp_email_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Tax No.</label>
              <input type="text" id="input_supp_tax_number" class="form-control" value="${value.tax_number}" data-type="currency">
              <small id="input_supp_tax_number_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Bank Name</label>
              <input type="text" id="input_supp_bank_name" class="form-control" value="${value.bank_name}" data-type="currency">
              <small id="input_supp_bank_name_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Bank Account Number</label>
              <input type="text" id="input_supp_bank_account_number" class="form-control" value="${value.bank_account_number}" data-type="currency">
              <small id="input_supp_bank_account_number_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Bank Account Name</label>
              <input type="text" id="input_supp_bank_account_name" class="form-control" value="${value.bank_account_name}" data-type="currency">
              <small id="input_supp_bank_account_name_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <div class="d-flex align-items-center justify-content-between">
                <label class="col-form-label">Status<span class="text-danger">*</span></label>
              </div>
              <select id="input_supp_status" class="select">
                <option value="" ${!value.status ? "selected" : ""}>-- Select Status --</option>
                ${selectStatusOptions}
              </select>
              <small id="input_supp_status_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label class="col-form-label">Notes</label>
              <textarea class="form-control" id="input_supp_notes">${value.notes}</textarea>
              <small id="input_supp_notes_error" class="text-danger mt-1" style="display: none;"></small>
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
      console.log("ASS");

      $('.select').select2({
        width: '100%',
        dropdownParent: $('#c_supplier_canvas_form')
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
        field: "input_supp_name",
        required: true,
        message: "Name is required."
      },
      {
        field: "input_supp_address",
        required: true,
        message: "Address is required."
      },
      {
        field: "input_supp_contact_person",
        required: false,
        message: "Contact Person is required."
      },
      {
        field: "input_supp_phone",
        required: true,
        message: "Phone is required."
      },
      {
        field: "input_supp_email",
        required: false,
        message: "Email is required."
      },
      {
        field: "input_supp_tax_number",
        required: false,
        message: "Tax No. is required."
      },
      {
        field: "input_supp_bank_name",
        required: false,
        message: "Bank Name is required."
      },
      {
        field: "input_supp_bank_account_number",
        required: false,
        message: "Bank Acc. No. is required."
      },
      {
        field: "input_supp_bank_account_name",
        required: false,
        message: "Bank Acc. Name is required."
      },
      {
        field: "input_supp_status",
        required: true,
        message: "Status is required."
      },
      {
        field: "input_supp_notes",
        required: false,
        message: "Notes is required."
      },
    ];

    inputs.forEach(id => {
      const el = this.form.querySelector("#" + id.field);
      let value = el ? el.value.trim() : "";

      if (value && id.date) {
        value = moment(value, 'DD/MM/YY').format('YYYY-MM-DD')
      }

      payload[id.field.replace("input_supp_", "")] = value;

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
        const response = await fetch('/suppliers', {
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
          showToast("success", response.message || 'Supplier created successfully!');
          $('#supplier_list').DataTable().ajax.reload();
          if (this.closeForm) this.closeForm.click();
          this.resetForm()
        } else {
          showToast("error", result.message || result.errors);
        }
      } catch (err) {
        showToast("error", 'An error occurred while creating Supplier.');
      } finally {
        this.isFetching = false;
        this.hideLoading()
      }
    } else if (this.mode === "edit") {
      try {
        const response = await fetch(`/suppliers/${this.data.id}`, {
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
          showToast("success", response.message || 'Supplier updated successfully!');
          $('#supplier_list').DataTable().ajax.reload(null, false);
          if (this.closeForm) this.closeForm.click();
          this.resetForm();
          console.log(result);

        } else {
          showToast("error", result.message || result.errors);
        }
      } catch (err) {
        showToast("error", 'An error occurred while updating Supplier.');
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
  const SUPPLIER_CANVAS = document.querySelector("#c_supplier_canvas");
  const SUPPEIR_MODAL = document.querySelector("#c_supplier_modal");
  const SUPPLIER_FORM = SUPPLIER_CANVAS?.querySelector("form#c_supplier_canvas_form")
    ? new SupplierForm("c_supplier_canvas_form")
    : null;
  const SUPPLIER_CANVAS_BS = SUPPLIER_CANVAS ? new bootstrap.Offcanvas(SUPPLIER_CANVAS) : null;
  const SUPPLIER_MODAL_BS = SUPPEIR_MODAL ? new bootstrap.Modal(SUPPEIR_MODAL) : null;

  // const modal = bootstrap.Modal.getInstance(document.getElementById("delete_SUPPEIR_modal"));
  // modal.hide();

  document.addEventListener("click", async e => {
    let target = e.target;

    // CREATE
    if (target.matches("#c_supplier_create_btn")) {
      e.preventDefault();
      if (SUPPLIER_CANVAS_BS && SUPPLIER_FORM && !IS_FETCHING) {
        const title = SUPPLIER_CANVAS.querySelector("#c_supplier_canvas_title");
        title.textContent = "Create Supplier";
        SUPPLIER_CANVAS_BS.show();
        SUPPLIER_FORM.resetForm();
        await SUPPLIER_FORM.init("create");
      }
    }

    // EDIT
    if (target.closest(".c_supplier_edit_btn")) {
      target = target.closest(".c_supplier_edit_btn");
      e.preventDefault();
      if (!SUPPLIER_CANVAS_BS || !SUPPLIER_FORM || IS_FETCHING) return;
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
          const title = SUPPLIER_CANVAS.querySelector("#c_supplier_canvas_title");
          title.textContent = "Edit Supplier";
          SUPPLIER_CANVAS_BS.show();
          SUPPLIER_FORM.resetForm();
          await SUPPLIER_FORM.init("edit", resJson.data);
        } else {
          showToast("error", resJson.message || "Failed to fetch supplier data for editing.");
        }
      } catch (error) {
        console.log(error);

        showToast("error", 'An error occurred while fetching the supplier data for editing.');
      } finally {
        IS_FETCHING = false;
      }
    }

    // DELETE
    else if (target.closest(".c_supplier_delete_btn")) {
      target = target.closest(".c_supplier_delete_btn");
      e.preventDefault();
      if (!SUPPLIER_MODAL_BS || IS_FETCHING) return;
      const url = target.dataset.url;
      const confirmBtn = SUPPEIR_MODAL.querySelector("#c_supplier_modal_confirm_btn");
      confirmBtn.dataset.url = url;
      SUPPLIER_MODAL_BS.show();
    }

    // CONFIRM DELETE 
    else if (target.matches("#c_supplier_modal_confirm_btn")) {
      e.preventDefault();
      if (!SUPPLIER_CANVAS_BS || !SUPPLIER_FORM || IS_FETCHING) return;
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
          $('#supplier_list').DataTable().ajax.reload(null, false);
          showToast("success", resJson.message || "Supplier deleted successfully.");
          SUPPLIER_MODAL_BS.hide();
        } else {
          showToast("error", resJson.message || "Failed to delete supplier.");
        }
      } catch (error) {
        showToast("error", "An error occurred while deleting the supplier.");
      } finally {
        IS_FETCHING = false;
      }
    }
  })
});