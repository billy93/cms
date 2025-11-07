class ProjectForm {
  mode = "create";
  data = {};
  customers = [];
  errors = {};

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeForm = document.getElementById("close_project_form");

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
  async fetchCustomers() {
    this.isFetching = true;
    this.showLoading();
    return fetch("/customers/all", {
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
        this.customers = res.data;
      })
      .catch(err => {
        console.error("Fetch customers error:", err);
      })
      .finally(() => {
        this.isFetching = false
        this.hideLoading();
      });
  }

  // ---------------------------------------- INIT ----------------------------------------
  async init(mode = "create", data = {}) {
    this.resetForm();
    this.data = data;
    this.mode = mode;

    // await this.fetchProducts();
    await this.fetchCustomers();

    const formWrapper = document.createElement("div");
    formWrapper.id = "project_form_wrapper";
    formWrapper.innerHTML = this.createForm();
    this.form.appendChild(formWrapper);
    this.initPlugins();
  }

  createForm() {
    const isEdit = this.mode === "edit";

    const value = {
      customer_id: "",
      code: "",
      name: "",
      ref_doc_no: "",
      value: "",
      start_date: "",
      end_date: "",
      due_date: "",
      description: "",
      status: "",
    }

    if (isEdit && this.data) {
      value.customer_id = this.data.customer_id || "";
      value.code = this.data.code || "";
      value.name = this.data.name || "";
      value.ref_doc_no = this.data.ref_doc_no || "";
      value.value = this.data.value || "";
      value.start_date = this.data.start_date
        ? moment(this.data.start_date).format("YYYY-MM-DD")
        : "";
      value.end_date = this.data.end_date
        ? moment(this.data.end_date).format("YYYY-MM-DD")
        : "";
      value.due_date = this.data.due_date
        ? moment(this.data.due_date).format("YYYY-MM-DD")
        : "";
      value.description = this.data.description || "";
      value.status = this.data.status || "";

    }

    const selectCustomerOptions = this.customers.map(c => {
      return `<option value="${c.id}" ${value.customer_id === c.id ? "selected" : ""}>${c.name}</option>`;
    });

    const selectStatusOptions = ['Active', 'Inactive'].map(s => {
      return `<option value="${s}" ${value.status === s ? "selected" : ""}>${s}</option>`;
    });

    const dynamic = !isEdit ? `
      <div class="col-md-6">
        <div class="mb-3">
          <div class="d-flex align-items-center justify-content-between">
            <label class="col-form-label">Status<span class="text-danger">*</span></label>
          </div>
          <select id="input_status" class="select">
            <option value="" ${!value.status ? "selected" : ""}>-- Select Status --</option>
            ${selectStatusOptions}
          </select>
          <small id="input_status_error" class="text-danger mt-1" style="display: none;"></small>
        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3">
          <div class="d-flex align-items-center justify-content-between">
            <label class="col-form-label">Customer<span class="text-danger">*</span></label>
          </div>
          <select id="input_customer_id" class="select ">
            <option value="" ${!value.customer_id ? "selected" : ""}>-- Select Customer --</option>
            ${selectCustomerOptions}
          </select>
          <small id="input_customer_id_error" class="text-danger mt-1" style="display: none;"></small>
        </div>
      </div> 
    ` :
      `
      <div class="col-md-6">
        <div class="mb-3">
          <label class="col-form-label">Project Code</label>
            <input type="text" id="input_code" class="form-control btn-disabled" value="${value.code}" disabled>
        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-3">
          <div class="d-flex align-items-center justify-content-between">
            <label class="col-form-label">Status<span class="text-danger">*</span></label>
          </div>
          <select id="input_status" class="select">
            <option value="" ${!value.status ? "selected" : ""}>-- Select Status --</option>
            ${selectStatusOptions}
          </select>
          <small id="input_status_error" class="text-danger mt-1" style="display: none;"></small>
        </div>
      </div>
      <div class="col-md-12">
        <div class="mb-3">
          <div class="d-flex align-items-center justify-content-between">
            <label class="col-form-label">Customer<span class="text-danger">*</span></label>
          </div>
          <select id="input_customer_id" class="select ">
            <option value="" ${!value.customer_id ? "selected" : ""}>-- Select Customer --</option>
            ${selectCustomerOptions}
          </select>
          <small id="input_customer_id_error" class="text-danger mt-1" style="display: none;"></small>
        </div>
      </div>
    `;

    return `
      <div>
        <div class="row">
          ${dynamic}
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Name<span class="text-danger">*</span></label>
              <input type="text" id="input_name" class="form-control" value="${value.name}">
              <small id="input_name_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Ref Doc. No.<span class="text-danger">*</span></label>
              <input type="text" id="input_ref_doc_no" class="form-control" value="${value.ref_doc_no}">
              <small id="input_ref_doc_no_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Value<span class="text-danger">*</span></label>
              <input type="text" id="input_value" class="form-control" value="${value.value}" data-type="currency">
              <small id="input_value_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Start Date<span class="text-danger">*</span></label>
              <div class="icon-form">
                <span class="form-icon"><i class="ti ti-calendar-event"></i></span>
                <input id="input_start_date" type="text" class="form-control datetimepicker" placeholder="DD/MM/YY" value="${value.start_date}">
              </div>
              <small id="input_start_date_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">End Date<span class="text-danger">*</span></label>
              <div class="icon-form">
                <span class="form-icon"><i class="ti ti-calendar-event"></i></span>
                <input id="input_end_date" type="text" class="form-control datetimepicker" placeholder="DD/MM/YY" value="${value.end_date}">
              </div>
              <small id="input_end_date_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Due Date<span class="text-danger">*</span></label>
              <div class="icon-form">
                <span class="form-icon"><i class="ti ti-calendar-event"></i></span>
                <input id="input_due_date" type="text" class="form-control datetimepicker" placeholder="DD/MM/YY" value="${value.due_date}">
              </div>
              <small id="input_due_date_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label class="col-form-label">Project Description</label>
              <textarea class="form-control" id="input_description">${value.description}</textarea>
              <small id="input_description_error" class="text-danger mt-1" style="display: none;"></small>
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
    // SELECT2 (if using select with class="select", no need when using class="form-select")
    if (window.$ && $.fn.select2) {
      $('.select').select2({
        width: '100%',
        dropdownParent: $('#c_project_form')
      });
    }
    console.log("X");

    if ($('.datetimepicker').length && $.fn.datetimepicker) {
      $('.datetimepicker').each(function () {
        console.log("A");

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
    this.mode = "create";
    this.data = {};
    this.customers = [];
    this.form.innerHTML = "";
    this.errors = {};
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

    const customer_id = this.form.querySelector("#input_customer_id");
    const name = this.form.querySelector("#input_name");
    const description = this.form.querySelector("#input_description");
    const status = this.form.querySelector("#input_status");


    const payload = {
      customer_id: parseInt(customer_id.value) || null,
      name: name.value,
      description: description.value,
      status: status.value,
    };

    const inputs = [
      {
        field: "input_customer_id",
        required: true,
        message: "Project is required."
      },
      {
        field: "input_name",
        required: true,
        message: "Name is required."
      },
      {
        field: "input_ref_doc_no",
        required: true,
        message: "Ref Doc. No. is required."
      },
      {
        field: "input_value",
        required: true,
        message: "Value is required."
      },
      {
        field: "input_start_date",
        date: true,
        required: true,
        message: "Start Date is required."
      },
      {
        field: "input_end_date",
        date: true,
        required: true,
        message: "End Date is required."
      },
      {
        field: "input_due_date",
        date: true,
        required: true,
        message: "Due Date is required."
      }, {
        field: "input_status",
        required: true,
        message: "Status is required."
      },
      {
        field: "input_description",
        required: false,
        message: "Description is required."
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
    console.log(">>>", payload)

    if (this.mode === "create") {
      try {
        const response = await fetch('/projects', {
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
          showToast("success", response.message || 'Project created successfully!');
          $('#project_list').DataTable().ajax.reload();
          if (this.closeForm) this.closeForm.click();
          this.resetForm()
        } else {
          showToast("error", `${result.message || result.errors}`);
        }
      } catch (err) {
        showToast("error", 'An error occurred while creating Project.');
      } finally {
        this.isFetching = false;
        this.hideLoading()
      }
    } else if (this.mode === "edit") {
      try {
        const response = await fetch(`/projects/${this.data.id}`, {
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
          showToast("success", response.message || 'Project updated successfully!');
          $('#project_list').DataTable().ajax.reload();
          if (this.closeForm) this.closeForm.click();
          this.resetForm()
        } else {
          showToast("error", `${result.message || result.errors}`);
        }
      } catch (err) {
        showToast("error", 'An error occurred while updating Project.');
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
  const projectForm = new ProjectForm("c_project_form");

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

  document.addEventListener("click", async e => {
    const target = e.target;

    if (target.matches("#c_project_add")) {
      const title = document.querySelector("#project_form_title");
      title.textContent = "Create Project";
      projectForm.resetForm();
      await projectForm.init("create");
    }

    if (target.matches(".c_project_edit")) {
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

      if (res.ok) {
        const title = document.querySelector("#project_form_title");
        projectForm.resetForm();
        title.textContent = "Edit Project";
        await projectForm.init("edit", resJson.data);
      } else {
        showToast("error", resJson.message || "Failed to fetch Project data for editing.");
      }
    }

    // Klik delete → inject url ke tombol confirm
    if (target.matches(".c_project_delete")) {
      e.preventDefault();
      const url = target.getAttribute("data-url");
      const confirmBtn = document.getElementById("confirm_delete_project");
      confirmBtn.setAttribute("data-url", url);
    }

    if (target.matches("#confirm_delete_project")) {
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
          const modal = bootstrap.Modal.getInstance(document.getElementById("delete_project_modal"));
          modal.hide();

          // DataTable → reload
          $('#project_list').DataTable().ajax.reload();

          // Toastr success
          showToast("success", data.message || "Project deleted successfully!");
        } else {
          showToast("error", data.message || "Failed to delete Project.");
        }
      } catch (err) {
        showToast("error", "Server error. Failed to delete Project.");
      }
    }
  })
});