class ProjectForm {
  isInit = true;
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

  handleDocumentKeydown(e) {
    const target = e.target;
    if (target.matches(".project-input-number[data-type='currency']")) {
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

  async handleDocumentInput(e) {
    const target = e.target;

    if (target.matches(".project-input-number[data-type='currency']")) {

      const before = target.value;
      const caret = target.selectionStart;

      const norm = normalizeFormatRupiah(before);
      const formatted = formatRupiahDisplay(norm);

      target.value = formatted;

      const delta = formatted.length - before.length;
      target.setSelectionRange(caret + delta, caret + delta);
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
        if (!this.isInit) this.hideLoading();
      });
  }

  // ---------------------------------------- INIT ----------------------------------------
  async init(mode = "create", data = {}) {
    this.resetForm();
    this.showLoading();
    this.data = data;
    this.mode = mode;

    // await this.fetchProducts();
    await this.fetchCustomers();

    const formWrapper = document.createElement("div");
    formWrapper.id = "project_form_wrapper";
    formWrapper.innerHTML = this.createForm();
    this.form.appendChild(formWrapper);
    this.initPlugins();
    this.isInit = false;
    this.hideLoading();
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
      type: "Regular",
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
      value.type = this.data.type || "Regular";

    }

    const selectCustomerOptions = this.customers.map(c => {
      return `<option value="${c.id}" ${value.customer_id === c.id ? "selected" : ""}>${c.name}</option>`;
    });

    const selectStatusOptions = ['Active', 'Inactive'].map(s => {
      return `<option value="${s}" ${value.status === s ? "selected" : ""}>${s}</option>`;
    });

    const selectTypeOptions = ['FIT', 'Regular'].map(t => {
      return `<option value="${t}" ${value.type === t ? "selected" : ""}>${t}</option>`;
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
            <label class="col-form-label">Type<span class="text-danger">*</span></label>
          </div>
          <select id="input_type" class="select">
            ${selectTypeOptions}
          </select>
          <small id="input_type_error" class="text-danger mt-1" style="display: none;"></small>
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
      <div class="col-md-6">
        <div class="mb-3">
          <div class="d-flex align-items-center justify-content-between">
            <label class="col-form-label">Type<span class="text-danger">*</span></label>
          </div>
          <select id="input_type" class="select">
            ${selectTypeOptions}
          </select>
          <small id="input_type_error" class="text-danger mt-1" style="display: none;"></small>
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
    `;

    return `
      <div>
        <div class="row">
          ${dynamic}
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Project Name<span class="text-danger">*</span></label>
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
              <input type="text" id="input_value" class="form-control project-input-number" value="${value.value}" data-type="currency">
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
    if (window.$ && $.fn.select2) {
      $('.select').select2({
        width: '100%',
        dropdownParent: $('#c_project_canvas_form')
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
          icons: {
            previous: 'ti ti-chevron-left',
            next: 'ti ti-chevron-right',
            up: 'ti ti-chevron-up',
            down: 'ti ti-chevron-down',
            close: 'ti ti-x'
          }
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
    this.customers = [];
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

    const customer_id = this.form.querySelector("#input_customer_id");
    const name = this.form.querySelector("#input_name");
    const description = this.form.querySelector("#input_description");
    const status = this.form.querySelector("#input_status");
    const type = this.form.querySelector("#input_type");


    const payload = {
      customer_id: parseInt(customer_id.value) || null,
      name: name.value,
      description: description.value,
      status: status.value,
      type: type.value,
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
        field: "input_type",
        required: true,
        message: "Type is required."
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

      // Strip trailing comma for number/currency fields to match backend regex
      if (id.field === 'input_value' && value.endsWith(',')) {
        value = value.slice(0, -1);
      }

      payload[id.field.replace("input_", "")] = value;

      if (!value && id.required) {
        this.errors[id.field + "_error"] = id.message;
      }
    });

    // Custom Date Validation
    if (payload.start_date && payload.end_date) {
      if (moment(payload.end_date).isSameOrBefore(payload.start_date)) {
        this.errors["input_end_date_error"] = "End Date must be greater than Start Date.";
      }
    }

    if (payload.start_date && payload.end_date && payload.due_date) {
      const start = moment(payload.start_date);
      const end = moment(payload.end_date);
      const due = moment(payload.due_date);

      if (due.isBefore(start) || due.isAfter(end)) {
        this.errors["input_due_date_error"] = "Due Date must be between Start Date and End Date.";
      }
    }

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
    console.log(payload);

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
          showToast("error", result.message || result.errors);
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
          $('#project_list').DataTable().ajax.reload(null, false);
          if (this.closeForm) this.closeForm.click();
          this.resetForm()
        } else {
          showToast("error", result.message || result.errors);
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
  const PROJECT_CANVAS = document.querySelector("#c_project_canvas");
  const PROJECT_MODAL = document.querySelector("#c_project_modal");
  const PROJECT_FORM = PROJECT_CANVAS?.querySelector("form#c_project_canvas_form")
    ? new ProjectForm("c_project_canvas_form")
    : null;
  const PROJECT_CANVAS_BS = PROJECT_CANVAS ? new bootstrap.Offcanvas(PROJECT_CANVAS) : null;
  const PROJECT_MODAL_BS = PROJECT_MODAL ? new bootstrap.Modal(PROJECT_MODAL) : null;

  // const modal = bootstrap.Modal.getInstance(document.getElementById("delete_project_modal"));
  // modal.hide();

  document.addEventListener("click", async e => {
    let target = e.target;

    // CREATE
    if (target.matches("#c_project_create_btn")) {
      e.preventDefault();
      if (PROJECT_CANVAS_BS && PROJECT_FORM && !IS_FETCHING) {
        const title = PROJECT_CANVAS.querySelector("#c_project_canvas_title");
        title.textContent = "Create Project (Ref to RFP)";
        PROJECT_CANVAS_BS.show();
        PROJECT_FORM.resetForm();
        await PROJECT_FORM.init("create");
      }
    }

    // EDIT
    if (target.closest(".c_project_edit_btn")) {
      target = target.closest(".c_project_edit_btn");
      e.preventDefault();
      if (!PROJECT_CANVAS_BS || !PROJECT_FORM || IS_FETCHING) return;
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
          const title = PROJECT_CANVAS.querySelector("#c_project_canvas_title");
          title.textContent = "Edit Project (Ref to RFP)";
          PROJECT_CANVAS_BS.show();
          PROJECT_FORM.resetForm();
          await PROJECT_FORM.init("edit", resJson.data);
        } else {
          showToast("error", resJson.message || "Failed to fetch project data for editing.");
        }
      } catch (error) {
        console.log(error);

        showToast("error", 'An error occurred while fetching the project data for editing.');
      } finally {
        IS_FETCHING = false;
      }
    }

    // DELETE
    else if (target.closest(".c_project_delete_btn")) {
      target = target.closest(".c_project_delete_btn");
      e.preventDefault();
      if (!PROJECT_MODAL_BS || IS_FETCHING) return;
      const url = target.dataset.url;
      const confirmBtn = PROJECT_MODAL.querySelector("#c_project_modal_confirm_btn");
      confirmBtn.dataset.url = url;
      PROJECT_MODAL_BS.show();
    }

    // CONFIRM DELETE 
    else if (target.matches("#c_project_modal_confirm_btn")) {
      e.preventDefault();
      if (!PROJECT_CANVAS_BS || !PROJECT_FORM || IS_FETCHING) return;
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

          $('#project_list').DataTable().ajax.reload(null, false);
          showToast("success", resJson.message || "Project deleted successfully.");
          PROJECT_MODAL_BS.hide();
        } else {
          showToast("error", resJson.message || "Failed to delete project.");
        }
      } catch (error) {
        showToast("error", "An error occurred while deleting the project.");
      } finally {
        IS_FETCHING = false;
      }
    }
  })
});