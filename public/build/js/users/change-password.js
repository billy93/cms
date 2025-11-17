class ChangePasswordForm {
  isInit = true;
  errors = {};
  url = "";

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeForm = document.getElementById("close_user_change_password_modal");
    this.handleSubmit = this.handleSubmit.bind(this)
    this.form.addEventListener("submit", (e) => {
      e.preventDefault();
      this.handleSubmit()
    });
  }

  // ---------------------------------------- INIT ----------------------------------------
  async init(url) {
    this.resetForm();
    this.showLoading();
    this.url = url;

    const formWrapper = document.createElement("div");
    formWrapper.id = "user_change_password_form_wrapper";
    formWrapper.innerHTML = this.createForm();
    this.form.appendChild(formWrapper);
    this.isInit = false;
    this.hideLoading();
  }

  createForm() {
    return `
      <div  style="padding: var(--bs-modal-padding);">
        <div class="col-md-12">
          <div class="mb-3">
            <label class="col-form-label">Password<span class="text-danger">*</span></label>
            <input type="password" id="input_user_cp_password" class="form-control">
            <small id="input_user_cp_password_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
        <div class="col-md-12">
          <div class="mb-3">
            <label class="col-form-label">New Password<span class="text-danger">*</span></label>
            <input type="password" id="input_user_cp_new_password" class="form-control">
            <small id="input_user_cp_new_password_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
        <div class="col-md-12">
          <div class="mb-3">
            <label class="col-form-label">Confirm Password<span class="text-danger">*</span></label>
            <input type="password" id="input_user_cp_confirm_password" class="form-control">
            <small id="input_user_cp_confirm_password_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
      </div>
      <div class="modal-footer d-flex align-items-center justify-content-end">
        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
  `;
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
    this.url = "";
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
        field: "input_user_cp_password",
        required: true,
        message: "Password is required."
      },
      {
        field: "input_user_cp_new_password",
        required: true,
        message: "New Password is required."
      },
      {
        field: "input_user_cp_confirm_password",
        required: true,
        message: "Confirm Password is required."
      },
    ];

    // Loop semua input
    inputs.forEach(input => {
      const el = this.form.querySelector("#" + input.field);
      let value = el ? el.value.trim() : "";

      payload[input.field.replace("input_user_cp_", "")] = value;

      if (!value && input.required) {
        this.errors[input.field + "_error"] = input.message;
      }
    });

    return payload;
  }


  async handleSubmit() {
    if (this.isFetching) return;
    const self = this;
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

    try {
      const response = await fetch(this.url, {
        method: 'PATCH',
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
        body: JSON.stringify(payload)
      });

      const result = await response.json();

      if (response.ok && result.success) {
        showToast("success", response.message || 'User password updated successfully!');
        if (this.closeForm) this.closeForm.click();
        this.resetForm()
      } else {
        showToast("error", result.message || result.errors);

        self.resetErrorFields();
        if (result.errors?.password) self.errors.input_user_cp_password_error = result.errors.password[0];
        if (result.errors?.new_password) self.errors.input_user_cp_new_password_error = result.errors.new_password[0];
        if (result.errors?.confirm_password) self.errors.input_user_cp_confirm_password_error = result.errors.confirm_password[0];

        const errKeys = Object.keys(this.errors);

        if (errKeys.length) {
          errKeys.forEach(v => {
            const el = document.getElementById(v);
            if (el) {
              el.innerText = this.errors[v];
              el.style.display = "block";
            }
          });
        }
      }
    } catch (err) {
      console.log(err);

      showToast("error", 'An error occurred while updating user password.');
    } finally {
      this.isFetching = false;
      this.hideLoading()
    }
  }
}

// ----------------------------------------------- TRIGER -----------------------------------------------

document.addEventListener("DOMContentLoaded", () => {
  const USER_CHANGE_PASSWORD_MODAL = document.querySelector("#c_user_change_password_modal");
  const USER_CHANGE_PASSWORD_FORM = USER_CHANGE_PASSWORD_MODAL?.querySelector("form#c_user_change_password_form")
    ? new ChangePasswordForm("c_user_change_password_form")
    : null;
  const USER_CHANGE_PASSWORD_MODAL_BS = USER_CHANGE_PASSWORD_FORM ? new bootstrap.Modal(USER_CHANGE_PASSWORD_MODAL) : null;

  document.addEventListener("click", async e => {
    let target = e.target;

    if (target.matches(".c_user_change_password_btn")) {
      e.preventDefault();
      const url = target.dataset.url;
      console.log(url);

      if (USER_CHANGE_PASSWORD_MODAL_BS && USER_CHANGE_PASSWORD_FORM && !IS_FETCHING) {
        USER_CHANGE_PASSWORD_FORM.resetForm();
        await USER_CHANGE_PASSWORD_FORM.init(url);
        USER_CHANGE_PASSWORD_MODAL_BS.show();
      }
    }
  })
});