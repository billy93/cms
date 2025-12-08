class PdfTemplateForm {
  isInit = true;
  mode = "create";
  data = {};
  errors = {};
  isFetching = false;

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeForm = document.getElementById("close_template_form");
    this.handleSubmit = this.handleSubmit.bind(this);

    this.form.addEventListener("submit", (e) => {
      e.preventDefault();
      this.handleSubmit();
    });
  }

  // ---------------------------------------- INIT ----------------------------------------
  async init(mode = "create", data = {}) {
    this.resetForm();
    this.showLoading();
    this.data = data;
    this.mode = mode;

    const formWrapper = document.createElement("div");
    formWrapper.id = "template_form_wrapper";
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
      type: "",
      description: "",
      html_content: "",
      is_active: true,
      variables: []
    };

    if (isEdit && this.data) {
      value.name = this.data.name || "";
      value.type = this.data.type || "";
      value.description = this.data.description || "";
      value.html_content = this.data.html_content || "";
      value.is_active = typeof this.data.is_active === 'boolean' ? this.data.is_active : true;
      value.variables = this.data.variables || [];
    }

    const selectTypeOptions = ['proposal', 'invoice'].map(t => {
      return `<option value="${t}" ${value.type === t ? "selected" : ""}>${t.charAt(0).toUpperCase() + t.slice(1)}</option>`;
    });

    let variablesHtml = '';
    if (value.variables.length) {
      variablesHtml = value.variables.map(v => this.createVariableRow(v.name, v.label)).join('');
    }

    return `
      <div>
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Template Name<span class="text-danger">*</span></label>
              <input type="text" id="input_template_name" class="form-control" value="${value.name}">
              <small id="input_template_name_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Template Type<span class="text-danger">*</span></label>
              <select id="input_template_type" class="form-control">
                <option value="">Select Type</option>
                ${selectTypeOptions}
              </select>
              <small id="input_template_type_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label class="col-form-label">Description</label>
              <textarea id="input_template_description" class="form-control" rows="3">${value.description}</textarea>
              <small id="input_template_description_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label class="col-form-label">Template Variables</label>
              <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                <div id="template_variables_container">
                  ${variablesHtml}
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary" id="add_variable_btn">
                  <i class="ti ti-plus me-1"></i>Add Variable
                </button>
              </div>
              <small class="text-muted">Variables can be used in HTML content as @{{variable_name}}</small>
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <label class="col-form-label mb-0">HTML Content<span class="text-danger">*</span></label>
                <button type="button" class="btn btn-sm btn-outline-secondary" id="insert_variable_btn">
                  <i class="ti ti-code"></i> Insert Variable
                </button>
              </div>
              <textarea id="input_template_html_content" class="form-control font-monospace" rows="12" style="font-size: 13px;">${value.html_content}</textarea>
              <small id="input_template_html_content_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3 form-check">
              <input type="checkbox" id="input_template_is_active" class="form-check-input" ${value.is_active ? 'checked' : ''}>
              <label class="form-check-label" for="input_template_is_active">Active</label>
              <small id="input_template_is_active_error" class="text-danger mt-1" style="display: none;"></small>
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

  createVariableRow(name = '', label = '') {
    return `
      <div class="variable-row mb-2">
        <div class="row g-2">
          <div class="col-5">
            <input type="text" class="form-control form-control-sm variable-name" placeholder="Variable name (e.g., customer_name)" value="${name}">
          </div>
          <div class="col-5">
            <input type="text" class="form-control form-control-sm variable-label" placeholder="Label (e.g., Customer Name)" value="${label}">
          </div>
          <div class="col-2">
            <button type="button" class="btn btn-sm btn-outline-danger remove-variable-btn w-100">
              <i class="ti ti-trash"></i>
            </button>
          </div>
        </div>
      </div>
    `;
  }

  showLoading() {
    if (!this.loadingEl) {
      this.loadingEl = document.createElement("div");
      this.loadingEl.className = "c-form-loading-overlay";
      this.loadingEl.innerHTML = `<div class="c-form-spinner"></div>`;
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

  initPlugins() {
    // SELECT2 (if using select with class="select", no need when using class="form-select")
    if (window.$ && $.fn.select2) {
      $('.select').select2({
        width: '100%',
        dropdownParent: $('#c_template_canvas_form')
      });

      // bridge event agar change bisa dideteksi
      $('.select').on('select2:select', function () {
        this.dispatchEvent(new Event('change', { bubbles: true }));
      });
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
      { field: "input_template_name", required: true, message: "Template name is required." },
      { field: "input_template_type", required: true, message: "Template type is required." },
      { field: "input_template_description", required: false },
      { field: "input_template_html_content", required: true, message: "HTML content is required." },
      { field: "input_template_is_active", isCheckbox: true, required: false },
    ];

    inputs.forEach(id => {
      const el = this.form.querySelector("#" + id.field);
      let value = el ? (id.isCheckbox ? el.checked : el.value.trim()) : "";

      if (id.isCheckbox) {
        payload[id.field.replace("input_template_", "")] = value;
      } else {
        payload[id.field.replace("input_template_", "")] = value;
      }

      if (!value && id.required) {
        this.errors[id.field + "_error"] = id.message;
      }
    });

    // Collect variables
    const variables = [];
    const variableRows = this.form.querySelectorAll('.variable-row');
    variableRows.forEach(row => {
      const name = row.querySelector('.variable-name').value.trim();
      const label = row.querySelector('.variable-label').value.trim();
      if (name && label) {
        variables.push({ name, label });
      }
    });

    payload.variables = variables.length > 0 ? variables : null;

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
      this.hideLoading();
      return;
    }

    if (this.mode === "create") {
      try {
        const response = await fetch('/pdf-templates', {
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
          showToast("success", result.message || 'Template created successfully!');
          templateDataTable.ajax.reload();
          if (this.closeForm) this.closeForm.click();
          this.resetForm();
        } else {
          showToast("error", result.message || result.errors);
        }
      } catch (err) {
        showToast("error", 'An error occurred while creating template.');
      } finally {
        this.isFetching = false;
        this.hideLoading();
      }
    } else if (this.mode === "edit") {
      try {
        const response = await fetch(`/pdf-templates/${this.data.id}`, {
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
          showToast("success", result.message || 'Template updated successfully!');
          templateDataTable.ajax.reload(null, false);
          if (this.closeForm) this.closeForm.click();
          this.resetForm();
        } else {
          showToast("error", result.message || result.errors);
        }
      } catch (err) {
        showToast("error", 'An error occurred while updating template.');
      } finally {
        this.isFetching = false;
        this.hideLoading();
      }
    }
  }
}

// ----------------------------------------------- TRIGGERS -----------------------------------------------

document.addEventListener("DOMContentLoaded", () => {
  const TEMPLATE_CANVAS = document.querySelector("#c_template_canvas");
  const TEMPLATE_MODAL = document.querySelector("#c_template_modal");
  const TEMPLATE_FORM = TEMPLATE_CANVAS?.querySelector("form#c_template_canvas_form")
    ? new PdfTemplateForm("c_template_canvas_form")
    : null;
  const TEMPLATE_CANVAS_BS = TEMPLATE_CANVAS ? new bootstrap.Offcanvas(TEMPLATE_CANVAS) : null;
  const TEMPLATE_MODAL_BS = TEMPLATE_MODAL ? new bootstrap.Modal(TEMPLATE_MODAL) : null;

  document.addEventListener("click", async e => {
    let target = e.target;

    // CREATE
    if (target.matches("#c_template_create_btn")) {
      e.preventDefault();
      if (TEMPLATE_CANVAS_BS && TEMPLATE_FORM && !IS_FETCHING) {
        const title = TEMPLATE_CANVAS.querySelector("#c_template_canvas_title");
        title.textContent = "Create PDF Template";
        TEMPLATE_CANVAS_BS.show();
        TEMPLATE_FORM.resetForm();
        await TEMPLATE_FORM.init("create");
      }
    }

    // EDIT
    else if (target.closest(".c_template_edit_btn")) {
      target = target.closest(".c_template_edit_btn");
      e.preventDefault();
      if (!TEMPLATE_CANVAS_BS || !TEMPLATE_FORM || IS_FETCHING) return;
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
        });

        const resJson = await response.json();

        if (response.ok && resJson.success) {
          const title = TEMPLATE_CANVAS.querySelector("#c_template_canvas_title");
          title.textContent = "Edit PDF Template";
          TEMPLATE_CANVAS_BS.show();
          TEMPLATE_FORM.resetForm();
          await TEMPLATE_FORM.init("edit", resJson.data);
        } else {
          showToast("error", resJson.message || "Failed to fetch template data for editing.");
        }
      } catch (error) {
        showToast("error", 'An error occurred while fetching the template data for editing.');
      } finally {
        IS_FETCHING = false;
      }
    }

    // DELETE
    else if (target.closest(".c_template_delete_btn")) {
      target = target.closest(".c_template_delete_btn");
      e.preventDefault();
      if (!TEMPLATE_MODAL_BS || IS_FETCHING) return;
      const url = target.dataset.url;
      const confirmBtn = TEMPLATE_MODAL.querySelector("#c_template_modal_confirm_btn");
      confirmBtn.dataset.url = url;
      TEMPLATE_MODAL_BS.show();
    }

    // CONFIRM DELETE
    else if (target.matches("#c_template_modal_confirm_btn")) {
      e.preventDefault();
      if (!TEMPLATE_MODAL_BS || IS_FETCHING) return;
      IS_FETCHING = true;

      try {
        const url = target.dataset.url;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        const response = await fetch(url, {
          method: "DELETE",
          headers: {
            "X-CSRF-TOKEN": csrfToken,
            "Accept": "application/json"
          }
        });
        const resJson = await response.json();

        if (response.ok && resJson.success) {
          templateDataTable.ajax.reload(null, false);
          showToast("success", resJson.message || "Template deleted successfully.");
          TEMPLATE_MODAL_BS.hide();
        } else {
          showToast("error", resJson.message || "Failed to delete template.");
        }
      } catch (error) {
        showToast("error", "An error occurred while deleting the template.");
      } finally {
        IS_FETCHING = false;
      }
    }

    // PREVIEW
    else if (target.closest(".c_template_preview_btn")) {
      target = target.closest(".c_template_preview_btn");
      e.preventDefault();
      if (IS_FETCHING) return;
      IS_FETCHING = true;

      const templateId = target.dataset.id;

      try {
        const response = await fetch('/pdf-templates/preview', {
          method: 'POST',
          headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
          },
          body: JSON.stringify({ template_id: templateId })
        });

        const resJson = await response.json();

        if (response.ok && resJson.success) {
          displayPreview(resJson.data);
          const previewModal = new bootstrap.Modal(document.getElementById('c_template_preview_modal'));
          previewModal.show();
        } else {
          showToast("error", resJson.message || "Failed to preview template.");
        }
      } catch (error) {
        showToast("error", "An error occurred while previewing the template.");
      } finally {
        IS_FETCHING = false;
      }
    }

    // ADD VARIABLE
    else if (target.matches("#add_variable_btn") || target.closest("#add_variable_btn")) {
      e.preventDefault();
      const container = document.getElementById('template_variables_container');
      if (container && TEMPLATE_FORM) {
        container.insertAdjacentHTML('beforeend', TEMPLATE_FORM.createVariableRow());
      }
    }

    // REMOVE VARIABLE
    else if (target.matches(".remove-variable-btn") || target.closest(".remove-variable-btn")) {
      e.preventDefault();
      const row = target.closest('.variable-row');
      if (row) row.remove();
    }

    // INSERT VARIABLE
    else if (target.matches("#insert_variable_btn") || target.closest("#insert_variable_btn")) {
      e.preventDefault();
      insertVariableToTextarea();
    }

    // COPY HTML FROM PREVIEW
    else if (target.matches("#c_template_preview_copy_btn")) {
      e.preventDefault();
      const html = document.getElementById('c_template_preview_content').innerHTML;
      navigator.clipboard.writeText(html).then(() => {
        showToast('success', 'HTML copied to clipboard');
      }).catch(() => {
        showToast('error', 'Failed to copy HTML');
      });
    }

    // FILTER BY TYPE
    else if (target.matches(".c_template_filter") || target.closest(".c_template_filter")) {
      target = target.closest(".c_template_filter") || target;
      e.preventDefault();
      currentFilterType = target.dataset.type || '';
      templateDataTable.ajax.reload();
    }
  });
});

// ---------------------------------------- HELPER FUNCTIONS ----------------------------------------

function insertVariableToTextarea() {
  const variables = [];
  document.querySelectorAll('.variable-row').forEach(row => {
    const name = row.querySelector('.variable-name').value.trim();
    if (name) {
      variables.push(name);
    }
  });

  if (variables.length === 0) {
    showToast('error', 'Please add at least one variable first');
    return;
  }

  const result = prompt('Select variable to insert:\n\n' + variables.join('\n') + '\n\nEnter variable name:');

  if (result && result.trim()) {
    const varName = result.trim();
    const textarea = document.getElementById('input_template_html_content');
    if (textarea) {
      const cursorPos = textarea.selectionStart;
      const textBefore = textarea.value.substring(0, cursorPos);
      const textAfter = textarea.value.substring(cursorPos);

      textarea.value = textBefore + '{{' + varName + '}}' + textAfter;

      const newPos = cursorPos + varName.length + 4;
      textarea.setSelectionRange(newPos, newPos);
      textarea.focus();
    }
  }
}

function displayPreview(data) {
  let sampleDataHtml = '<ul class="list-unstyled mb-0">';
  for (const [key, value] of Object.entries(data.sample_data)) {
    sampleDataHtml += `<li><strong>{{${key}}}:</strong> ${value}</li>`;
  }
  sampleDataHtml += '</ul>';
  document.getElementById('c_template_preview_sample_data').innerHTML = sampleDataHtml;
  document.getElementById('c_template_preview_content').innerHTML = data.html;
}
