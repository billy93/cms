class CategoryForm {
  isInit = true;
  mode = "create";
  data = {};
  errors = {};

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeForm = document.getElementById("close_category_form");

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
    formWrapper.id = "category_form_wrapper";
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
      description: "",

    }

    if (isEdit && this.data) {
      value.name = this.data.name || "";
      value.description = this.data.description || "";
    }

    return `
      <div>
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Name<span class="text-danger">*</span></label>
              <input type="text" id="input_category_name" class="form-control" value="${value.name}">
              <small id="input_category_name_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Description</label>
              <input type="text" id="input_category_description" class="form-control" value="${value.description}">
              <small id="input_category_description_error" class="text-danger mt-1" style="display: none;"></small>
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

  initPlugins() { }

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
        field: "input_category_name",
        required: true,
        message: "Name is required."
      },
      {
        field: "input_category_description",
        required: false,
        message: "Description is required."
      },
    ];

    inputs.forEach(id => {
      const el = this.form.querySelector("#" + id.field);
      let value = el ? el.value.trim() : "";

      payload[id.field.replace("input_category_", "")] = value;

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
        const response = await fetch('/categories', {
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
          showToast("success", response.message || 'Category created successfully!');
          $('#category_list').DataTable().ajax.reload();
          if (this.closeForm) this.closeForm.click();
          this.resetForm()
        } else {
          showToast("error", result.message || result.errors);
        }
      } catch (err) {
        showToast("error", 'An error occurred while creating Category.');
      } finally {
        this.isFetching = false;
        this.hideLoading()
      }
    } else if (this.mode === "edit") {
      try {
        const response = await fetch(`/categories/${this.data.id}`, {
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
          showToast("success", response.message || 'Category updated successfully!');
          $('#category_list').DataTable().ajax.reload(null, false);
          if (this.closeForm) this.closeForm.click();
          this.resetForm();
        } else {
          showToast("error", result.message || result.errors);
        }
      } catch (err) {
        showToast("error", 'An error occurred while updating Category.');
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
  const CATEGORY_CANVAS = document.querySelector("#c_category_canvas");
  const CATEGORY_MODAL = document.querySelector("#c_category_modal");
  const CATEGORY_FORM = CATEGORY_CANVAS?.querySelector("form#c_category_canvas_form")
    ? new CategoryForm("c_category_canvas_form")
    : null;
  const CATEGORY_CANVAS_BS = CATEGORY_CANVAS ? new bootstrap.Offcanvas(CATEGORY_CANVAS) : null;
  const CATEGORY_MODAL_BS = CATEGORY_MODAL ? new bootstrap.Modal(CATEGORY_MODAL) : null;

  document.addEventListener("click", async e => {
    let target = e.target;

    // CREATE
    if (target.matches("#c_category_create_btn")) {
      e.preventDefault();
      if (CATEGORY_CANVAS_BS && CATEGORY_FORM && !IS_FETCHING) {
        const title = CATEGORY_CANVAS.querySelector("#c_category_canvas_title");
        title.textContent = "Create Category";
        CATEGORY_CANVAS_BS.show();
        CATEGORY_FORM.resetForm();
        await CATEGORY_FORM.init("create");
      }
    }

    // EDIT
    if (target.closest(".c_category_edit_btn")) {
      target = target.closest(".c_category_edit_btn");
      e.preventDefault();
      if (!CATEGORY_CANVAS_BS || !CATEGORY_FORM || IS_FETCHING) return;
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
          const title = CATEGORY_CANVAS.querySelector("#c_category_canvas_title");
          title.textContent = "Edit Category";
          CATEGORY_CANVAS_BS.show();
          CATEGORY_FORM.resetForm();
          await CATEGORY_FORM.init("edit", resJson.data);
        } else {
          showToast("error", resJson.message || "Failed to fetch category data for editing.");
        }
      } catch (error) {
        showToast("error", 'An error occurred while fetching the category data for editing.');
      } finally {
        IS_FETCHING = false;
      }
    }

    // DELETE
    else if (target.closest(".c_category_delete_btn")) {
      target = target.closest(".c_category_delete_btn");
      e.preventDefault();
      if (!CATEGORY_MODAL_BS || IS_FETCHING) return;
      const url = target.dataset.url;
      const confirmBtn = CATEGORY_MODAL.querySelector("#c_category_modal_confirm_btn");
      confirmBtn.dataset.url = url;
      CATEGORY_MODAL_BS.show();
    }

    // CONFIRM DELETE 
    else if (target.matches("#c_category_modal_confirm_btn")) {
      e.preventDefault();
      if (!CATEGORY_CANVAS_BS || !CATEGORY_FORM || IS_FETCHING) return;
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
          $('#category_list').DataTable().ajax.reload(null, false);
          showToast("success", resJson.message || "Category deleted successfully.");
          CATEGORY_MODAL_BS.hide();
        } else {
          showToast("error", resJson.message || "Failed to delete category.");
        }
      } catch (error) {
        showToast("error", "An error occurred while deleting the category.");
      } finally {
        IS_FETCHING = false;
      }
    }
  })
});