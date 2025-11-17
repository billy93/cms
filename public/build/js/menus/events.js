class MenuForm {
  isInit = true;
  mode = "create";
  menus = [];
  data = {};
  errors = {};

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeForm = document.getElementById("close_menu_form");

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

  // ---------------------------------------- FETCHER ----------------------------------------
  async fetchMenus() {
    this.isFetching = true;
    this.showLoading();
    return fetch("/menus/all", {
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
        const id = this.data?.id ?? null;
        this.menus = res.data.filter(obj => obj.id !== id);
      })
      .catch(err => {
        console.error("Fetch menus error:", err);
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

    await this.fetchMenus();

    const formWrapper = document.createElement("div");
    formWrapper.id = "menu_form_wrapper";
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
      icon: "",
      is_visible: true,
      order_index: 0
    }

    if (isEdit && this.data) {
      value.name = this.data.name || "";
      value.icon = this.data.icon || "";
      value.is_visible = typeof this.data.is_visible === 'boolean'
        ? this.data.is_visible
        : true;
      value.order_index = typeof value.order_index === 'number' ? value.order_index : 0;
    }

    return `
      <div>
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Name<span class="text-danger">*</span></label>
              <input type="text" id="input_menu_name" class="form-control" value="${value.name}">
              <small id="input_menu_name_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Icon</label>
              <input type="text" id="input_menu_icon" class="form-control" value="${value.icon}">
              <small id="input_menu_icon_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Order Idx.<span class="text-danger">*</span></label>
              <input type="number" id="input_menu_order_index" class="form-control" value="${value.order_index}" min="0" max="100">
              <small id="input_menu_order_index_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3 form-check">
                <input type="checkbox" id="input_menu_is_visible" class="form-check-input" ${value.is_visible ? 'checked' : ''}>
                <label class="form-check-label" for="input_menu_is_visible">Visibility<span class="text-danger">*</span></label>
                <small id="input_menu_is_visible_error" class="text-danger mt-1" style="display: none;"></small>
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
    this.menus = []
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
        field: "input_menu_name",
        required: true,
        message: "Name is required."
      },
      {
        field: "input_menu_icon",
        required: false,
        message: "Icon is required."
      },
      {
        field: "input_menu_order_index",
        required: true,
        message: "Order Index is required."
      },
      {
        field: "input_menu_is_visible",
        isCheckbox: true,
        required: true,
        message: "Visibility is required."
      },
    ];

    inputs.forEach(id => {
      const el = this.form.querySelector("#" + id.field);
      let value = el ? el.value.trim() : "";

      if (id.isCheckbox) {
        payload[id.field.replace("input_menu_", "")] = el.checked;
      } else {
        payload[id.field.replace("input_menu_", "")] = value;
      }

      if (!value && id.required) {
        this.errors[id.field + "_error"] = id.message;
      }
    });

    const orderIdxInt = parseInt(payload.order_index);

    if (orderIdxInt < 0) {
      payload.order_index = 0;
    } else {
      payload.order_index = orderIdxInt;
    }

    return payload;
  }

  async handleSubmit() {
    if (this.isFetching) return;
    this.isFetching = true;
    this.showLoading();

    const payload = this.validateFields();
    const errKeys = Object.keys(this.errors);
    console.log(payload);
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
        const response = await fetch('/menus', {
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
          showToast("success", response.message || 'Menu created successfully!');
          $('#menu_list').DataTable().ajax.reload();
          if (this.closeForm) this.closeForm.click();
          this.resetForm()
        } else {
          showToast("error", result.message || result.errors);
        }
      } catch (err) {
        showToast("error", 'An error occurred while creating Menu.');
      } finally {
        this.isFetching = false;
        this.hideLoading()
      }
    } else if (this.mode === "edit") {
      try {
        const response = await fetch(`/menus/${this.data.id}`, {
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
          showToast("success", response.message || 'Menu updated successfully!');
          $('#menu_list').DataTable().ajax.reload(null, false);
          if (this.closeForm) this.closeForm.click();
          this.resetForm();
        } else {
          showToast("error", result.message || result.errors);
        }
      } catch (err) {
        showToast("error", 'An error occurred while updating Menu.');
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
  const MENU_CANVAS = document.querySelector("#c_menu_canvas");
  const MENU_MODAL = document.querySelector("#c_menu_modal");
  const MENU_FORM = MENU_CANVAS?.querySelector("form#c_menu_canvas_form")
    ? new MenuForm("c_menu_canvas_form")
    : null;
  const MENU_CANVAS_BS = MENU_CANVAS ? new bootstrap.Offcanvas(MENU_CANVAS) : null;
  const MENU_MODAL_BS = MENU_MODAL ? new bootstrap.Modal(MENU_MODAL) : null;

  document.addEventListener("click", async e => {
    let target = e.target;

    // CREATE
    if (target.matches("#c_menu_create_btn")) {
      e.preventDefault();
      if (MENU_CANVAS_BS && MENU_FORM && !IS_FETCHING) {
        const title = MENU_CANVAS.querySelector("#c_menu_canvas_title");
        title.textContent = "Create Menu";
        MENU_CANVAS_BS.show();
        MENU_FORM.resetForm();
        await MENU_FORM.init("create");
      }
    }

    // EDIT
    if (target.closest(".c_menu_edit_btn")) {
      target = target.closest(".c_menu_edit_btn");
      e.preventDefault();
      if (!MENU_CANVAS_BS || !MENU_FORM || IS_FETCHING) return;
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
          const title = MENU_CANVAS.querySelector("#c_menu_canvas_title");
          title.textContent = "Edit Menu";
          MENU_CANVAS_BS.show();
          MENU_FORM.resetForm();
          await MENU_FORM.init("edit", resJson.data);
        } else {
          showToast("error", resJson.message || "Failed to fetch menu data for editing.");
        }
      } catch (error) {
        console.log(error);

        showToast("error", 'An error occurred while fetching the menu data for editing.');
      } finally {
        IS_FETCHING = false;
      }
    }

    // DELETE
    else if (target.closest(".c_menu_delete_btn")) {
      target = target.closest(".c_menu_delete_btn");
      e.preventDefault();
      if (!MENU_MODAL_BS || IS_FETCHING) return;
      const url = target.dataset.url;
      const confirmBtn = MENU_MODAL.querySelector("#c_menu_modal_confirm_btn");
      confirmBtn.dataset.url = url;
      MENU_MODAL_BS.show();
    }

    // CONFIRM DELETE 
    else if (target.matches("#c_menu_modal_confirm_btn")) {
      e.preventDefault();
      if (!MENU_CANVAS_BS || !MENU_FORM || IS_FETCHING) return;
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
          $('#menu_list').DataTable().ajax.reload(null, false);
          showToast("success", resJson.message || "Menu deleted successfully.");
          MENU_MODAL_BS.hide();
        } else {
          showToast("error", resJson.message || "Failed to delete menu.");
        }
      } catch (error) {
        showToast("error", "An error occurred while deleting the menu.");
      } finally {
        IS_FETCHING = false;
      }
    }
  })
});