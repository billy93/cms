class BankForm {
  isInit = true;
  mode = "create";
  data = {};
  errors = {};

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeForm = document.getElementById("close_bank_form");
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
    formWrapper.id = "bank_form_wrapper";
    formWrapper.innerHTML = this.createForm();
    this.form.appendChild(formWrapper);
    this.initPlugins();
    this.isInit = false;
    this.hideLoading();
  }

  createForm() {
    const isEdit = this.mode === "edit";

    const value = {
      bank_code: "",
      bank_name: "",
      bank_address: "",
      bank_brand: "",
    }

    if (isEdit && this.data) {
      value.bank_code = this.data.bank_code || "";
      value.bank_name = this.data.bank_name || "";
      value.bank_address = this.data.address || "";
      value.bank_brand = this.data.bank_brand || "";
    }

    const selectStatusOptions = ['Active', 'Inactive'].map(s => {
      return `<option value="${s}" ${value.status === s ? "selected" : ""}>${s}</option>`;
    });

    const bankCodeField = isEdit ? `
      <div class="col-md-6">
        <div class="mb-3">
          <label class="col-form-label">Code<span class="text-danger">*</span></label>
          <input type="text" id="input_bank_code" class="form-control" value="${value.bank_code}" disabled>
        </div>
      </div>
    ` : "";

    return `
      <div>
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Bank Code<span class="text-danger">*</span></label>
              <input type="text" id="input_bank_code" class="form-control" value="${value.bank_code}" ${isEdit ? "disabled" : ""}>
              <small id="input_bank_code_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Bank Name<span class="text-danger">*</span></label>
              <input type="text" id="input_bank_name" class="form-control" value="${value.bank_name}">
              <small id="input_bank_name_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Bank Address</label>
              <input type="text" id="input_bank_address" class="form-control" value="${value.bank_address}" data-type="currency">
              <small id="input_bank_address_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Bank Brand<span class="text-danger">*</span></label>
              <input type="tel" id="input_bank_brand" class="form-control" value="${value.bank_brand}" data-type="currency">
              <small id="input_bank_brand_error" class="text-danger mt-1" style="display: none;"></small>
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
        dropdownParent: $('#c_bank_canvas_form')
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
        field: "input_bank_code",
        required: true,
        message: "Bank Code is required."
      },
      {
        field: "input_bank_name",
        required: true,
        message: "Bank Name is required."
      },
      {
        field: "input_bank_brand",
        required: false,
        message: "Bank Brand is required."
      },
    ];

    inputs.forEach(id => {
      const el = this.form.querySelector("#" + id.field);
      let value = el ? el.value.trim() : "";

      if (value && id.date) {
        value = moment(value, 'DD/MM/YY').format('YYYY-MM-DD')
      }

      payload[id.field.replace("input_", "")] = value;

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
        const response = await fetch('/banks', {
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
          showToast("success", response.message || 'Bank created successfully!');
          $('#bank_list').DataTable().ajax.reload();
          if (this.closeForm) this.closeForm.click();
          this.resetForm()
        } else {
          showToast("error", result.message || result.errors);
        }
      } catch (err) {
        showToast("error", 'An error occurred while creating Bank.');
      } finally {
        this.isFetching = false;
        this.hideLoading()
      }
    } else if (this.mode === "edit") {
      try {
        const response = await fetch(`/banks/${this.data.id}`, {
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
          showToast("success", response.message || 'Bank updated successfully!');
          $('#bank_list').DataTable().ajax.reload(null, false);
          if (this.closeForm) this.closeForm.click();
          this.resetForm();
          console.log(result);

        } else {
          showToast("error", result.message || result.errors);
        }
      } catch (err) {
        showToast("error", 'An error occurred while updating Bank.');
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
  const BANK_CANVAS = document.querySelector("#c_bank_canvas");
  const BANK_MODAL = document.querySelector("#c_bank_modal");
  const BANK_FORM = BANK_CANVAS?.querySelector("form#c_bank_canvas_form")
    ? new BankForm("c_bank_canvas_form")
    : null;
  const BANK_CANVAS_BS = BANK_CANVAS ? new bootstrap.Offcanvas(BANK_CANVAS) : null;
  const BANK_MODAL_BS = BANK_MODAL ? new bootstrap.Modal(BANK_MODAL) : null;
  document.addEventListener("click", async e => {
    let target = e.target;

    // CREATE
    if (target.matches("#c_bank_create_btn")) {
      e.preventDefault();
      if (BANK_CANVAS_BS && BANK_FORM && !IS_FETCHING) {
        const title = BANK_CANVAS.querySelector("#c_bank_canvas_title");
        title.textContent = "Create Bank";
        BANK_CANVAS_BS.show();
        BANK_FORM.resetForm();
        await BANK_FORM.init("create");
      }
    }

    // EDIT
    if (target.closest(".c_bank_edit_btn")) {
      target = target.closest(".c_bank_edit_btn");
      e.preventDefault();
      if (!BANK_CANVAS_BS || !BANK_FORM || IS_FETCHING) return;
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
          const title = BANK_CANVAS.querySelector("#c_bank_canvas_title");
          title.textContent = "Edit Bank";
          BANK_CANVAS_BS.show();
          BANK_FORM.resetForm();
          await BANK_FORM.init("edit", resJson.data);
        } else {
          showToast("error", resJson.message || "Failed to fetch bank data for editing.");
        }
      } catch (error) {
        console.log(error);

        showToast("error", 'An error occurred while fetching the bank data for editing.');
      } finally {
        IS_FETCHING = false;
      }
    }

    // DELETE
    else if (target.closest(".c_bank_delete_btn")) {
      target = target.closest(".c_bank_delete_btn");
      e.preventDefault();
      if (!BANK_MODAL_BS || IS_FETCHING) return;
      const url = target.dataset.url;
      const confirmBtn = BANK_MODAL.querySelector("#c_bank_modal_confirm_btn");
      confirmBtn.dataset.url = url;
      BANK_MODAL_BS.show();
    }

    // CONFIRM DELETE 
    else if (target.matches("#c_bank_modal_confirm_btn")) {
      e.preventDefault();
      if (!BANK_CANVAS_BS || !BANK_FORM || IS_FETCHING) return;
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
          $('#bank_list').DataTable().ajax.reload(null, false);
          showToast("success", resJson.message || "Bank deleted successfully.");
          BANK_MODAL_BS.hide();
        } else {
          showToast("error", resJson.message || "Failed to delete bank.");
        }
      } catch (error) {
        showToast("error", "An error occurred while deleting the bank.");
      } finally {
        IS_FETCHING = false;
      }
    }
  })
});