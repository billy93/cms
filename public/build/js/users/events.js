class UserForm {
  isInit = true;
  mode = "create";
  data = {};
  roles = [];
  errors = {};

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeForm = document.getElementById("close_user_form");

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

    if (target.matches("input[data-type='currency']")) {
      let value = e.target.value.replace(/[^\d,]/g, '');
      let parts = value.split(',');
      let integerPart = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
      target.value = parts[1] !== undefined ? `${integerPart},${parts[1]}` : integerPart;
    }
  }

  // ---------------------------------------- FETCHER ----------------------------------------
  async fetchRoles() {
    this.isFetching = true;
    this.showLoading();
    return fetch("/roles/all", {
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
        this.roles = res.data;
      })
      .catch(err => {
        console.error("Fetch roles error:", err);
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

    await this.fetchRoles();

    const formWrapper = document.createElement("div");
    formWrapper.id = "user_form_wrapper";
    formWrapper.innerHTML = this.createForm();
    this.form.appendChild(formWrapper);
    this.initPlugins();
    this.isInit = false;
    this.hideLoading();
  }

  createForm() {
    const isEdit = this.mode === "edit";

    const value = {
      name: "",
      email: "",
      password: "",
      newPassword: "",
      confirmPassword: "",
      phone: "",
      location: "",
      status: "Active",
      role_id: "",
    }

    if (isEdit && this.data) {
      value.name = this.data.name || "";
      value.email = this.data.email || "";
      value.phone = this.data.phone || "";
      value.location = this.data.location || "";
      value.status = this.data.status || "";
      value.role_id = this.data.role_id || "";

    }

    const selectStatusOptions = [
      "Active",
      "Inactive",
      "Suspended"
    ].map(v => {
      return `<option value="${v}" ${value.status === v ? "selected" : ""}>${v}</option>`;
    })

    const selectRoleOptions = this.roles.map(r => {
      return `<option value="${r.id}" ${value.role_id === r.id ? "selected" : ""}>${r.name}</option>`;
    });

    const pwField = !isEdit ? `
      <div class="col-md-6">
        <div class="mb-3">
          <label class="col-form-label">Password<span class="text-danger">*</span></label>
          <input type="password" id="input_user_password" class="form-control" value="${value.password}">
          <small id="input_user_password_error" class="text-danger mt-1" style="display: none;"></small>
        </div>
      </div>
    `: "";

    return `
      <div>
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Name<span class="text-danger">*</span></label>
              <input type="text" id="input_user_name" class="form-control" value="${value.name}">
              <small id="input_user_name_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>

          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Email<span class="text-danger">*</span></label>
              <input type="email" id="input_user_email" class="form-control" value="${value.email}">
              <small id="input_user_email_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>

          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Phone</label>
              <input type="tel" id="input_user_phone" class="form-control" value="${value.phone}">
              <small id="input_user_phone_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>

          ${pwField}

          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Location</label>
              <input type="text" id="input_user_location" class="form-control" value="${value.location}">
              <small id="input_user_location_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>

          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Status<span class="text-danger">*</span></label>
              <select id="input_user_status" class="form-select select">
                ${selectStatusOptions.join("")}
              </select>
              <small id="input_user_status_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>

          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Role</label>
              <select id="input_user_role_id" class="form-select select">
                <option value="" ${!value.role_id ? "selected" : ""}>-- Select Role --</option>
                ${selectRoleOptions.join("")}
              </select>
              <small id="input_user_role_id_error" class="text-danger mt-1" style="display: none;"></small>
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
        dropdownParent: $('#c_user_canvas_form')
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
    this.roles = [];
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
        field: "input_user_name",
        required: true,
        message: "Name is required."
      },
      {
        field: "input_user_email",
        required: true,
        message: "Email is required."
      },
      {
        field: "input_user_phone",
        required: false,
        message: "Phone is required."
      },
      {
        field: "input_user_password",
        password: true,
        required: this.mode === "create" ? true : false,
        message: "Password is required."
      },
      {
        field: "input_user_location",
        required: false,
        message: "Location is required."
      },
      {
        field: "input_user_status",
        required: true,
        message: "Status is required."
      },
      {
        field: "input_user_role_id",
        id: true,
        required: false,
        message: "Role is required."
      }
    ];

    // Loop semua input
    inputs.forEach(input => {
      const el = this.form.querySelector("#" + input.field);
      let value = el ? el.value.trim() : "";
      console.log(input);

      if (input.password) {
        if (this.mode === "create") payload[input.field.replace("input_user_", "")] = value;
      } else if (input.id) {
        payload[input.field.replace("input_user_", "")] = parseInt(value) || null;
      } else {
        payload[input.field.replace("input_user_", "")] = value;
      }

      if (!value && input.required) {
        this.errors[input.field + "_error"] = input.message;
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
    console.log(payload);
    console.log(this.errors);
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
        const response = await fetch('/users', {
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
          showToast("success", response.message || 'User created successfully!');
          $('#user_list').DataTable().ajax.reload();
          if (this.closeForm) this.closeForm.click();
          this.resetForm()
        } else {
          showToast("error", result.message || result.errors);
        }
      } catch (err) {
        showToast("error", 'An error occurred while creating User.');
      } finally {
        this.isFetching = false;
        this.hideLoading()
      }
    } else if (this.mode === "edit") {
      try {
        const response = await fetch(`/users/${this.data.id}`, {
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
          showToast("success", response.message || 'User updated successfully!');
          $('#user_list').DataTable().ajax.reload(null, false);
          if (this.closeForm) this.closeForm.click();
          this.resetForm()
        } else {
          showToast("error", result.message || result.errors);
        }
      } catch (err) {
        showToast("error", 'An error occurred while updating User.');
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
  const USER_CANVAS = document.querySelector("#c_user_canvas");
  const USER_MODAL = document.querySelector("#c_user_modal");
  const USER_FORM = USER_CANVAS?.querySelector("form#c_user_canvas_form")
    ? new UserForm("c_user_canvas_form")
    : null;
  const USER_CANVAS_BS = USER_CANVAS ? new bootstrap.Offcanvas(USER_CANVAS) : null;
  const USER_MODAL_BS = USER_MODAL ? new bootstrap.Modal(USER_MODAL) : null;

  document.addEventListener("click", async e => {
    let target = e.target;

    // CREATE
    if (target.matches("#c_user_create_btn")) {
      e.preventDefault();
      if (USER_CANVAS_BS && USER_FORM && !IS_FETCHING) {
        const title = USER_CANVAS.querySelector("#c_user_canvas_title");
        title.textContent = "Create User";
        USER_CANVAS_BS.show();
        USER_FORM.resetForm();
        await USER_FORM.init("create");
      }
    }

    // EDIT
    if (target.closest(".c_user_edit_btn")) {
      target = target.closest(".c_user_edit_btn");
      e.preventDefault();
      if (!USER_CANVAS_BS || !USER_FORM || IS_FETCHING) return;
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
        console.log("EDIT", resJson.data);

        if (response.ok && resJson.success) {
          const title = USER_CANVAS.querySelector("#c_user_canvas_title");
          title.textContent = "Edit User";
          USER_CANVAS_BS.show();
          USER_FORM.resetForm();
          await USER_FORM.init("edit", resJson.data);
        } else {
          showToast("error", resJson.message || "Failed to fetch user data for editing.");
        }
      } catch (error) {
        console.log(error);

        showToast("error", 'An error occurred while fetching the user data for editing.');
      } finally {
        IS_FETCHING = false;
      }
    }

    // DELETE
    else if (target.closest(".c_user_delete_btn")) {
      target = target.closest(".c_user_delete_btn");
      e.preventDefault();
      if (!USER_MODAL_BS || IS_FETCHING) return;
      const url = target.dataset.url;
      const confirmBtn = USER_MODAL.querySelector("#c_user_modal_confirm_btn");
      confirmBtn.dataset.url = url;
      USER_MODAL_BS.show();
    }

    // CONFIRM DELETE 
    else if (target.matches("#c_user_modal_confirm_btn")) {
      e.preventDefault();
      if (!USER_CANVAS_BS || !USER_FORM || IS_FETCHING) return;
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
          $('#user_list').DataTable().ajax.reload(null, false);
          showToast("success", resJson.message || "User deleted successfully.");
          USER_MODAL_BS.hide();
        } else {
          showToast("error", resJson.message || "Failed to delete user.");
        }
      } catch (error) {
        showToast("error", "An error occurred while deleting the user.");
      } finally {
        IS_FETCHING = false;
      }
    }
  })
});