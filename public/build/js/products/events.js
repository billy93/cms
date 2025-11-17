class ProductForm {
  isInit = true;
  mode = "create";
  data = {};
  categories = [];
  suppliers = [];
  errors = {};

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeForm = document.getElementById("close_product_form");

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
  async fetchCategories() {
    this.isFetching = true;
    this.showLoading();
    return fetch("/categories/all", {
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
        this.categories = res.data;
      })
      .catch(err => {
        console.error("Fetch categories error:", err);
      })
      .finally(() => {
        this.isFetching = false
        if (!this.isInit) this.hideLoading();
      });
  }

  async fetchSuppliers() {
    this.isFetching = true;
    this.showLoading();
    return fetch("/suppliers/all", {
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
        this.suppliers = res.data;
      })
      .catch(err => {
        console.error("Fetch suppliers error:", err);
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

    await this.fetchCategories();
    await this.fetchSuppliers();

    const formWrapper = document.createElement("div");
    formWrapper.id = "product_form_wrapper";
    formWrapper.innerHTML = this.createForm();
    this.form.appendChild(formWrapper);
    this.initPlugins();
    this.isInit = false;
    this.hideLoading();
  }

  createForm() {
    const isEdit = this.mode === "edit";
    console.log(this.categories, this.suppliers);

    const value = {
      code: "",
      name: "",
      description: "",
      unit: "",
      base_cost: "",
      supplier_id: "",
      category_ids: []
    }

    if (isEdit && this.data) {
      value.code = this.data.code || "";
      value.name = this.data.name || "";
      value.description = this.data.description || "";
      value.unit = this.data.unit || "";
      value.base_cost = this.data.base_cost || "";
      value.supplier_id = this.data.supplier_id || "";

      if (this.data.categories && Array.isArray(this.data.categories)) {
        value.category_ids = this.data.categories.map(c => c.id);
      } else {
        value.category_ids = [];
      }
    }

    const selectSupplierOptions = this.suppliers.map(s => {
      return `<option value="${s.id}" ${value.supplier_id === s.id ? "selected" : ""}>${s.name}</option>`;
    });
    console.log(selectSupplierOptions);

    // const selectCategoryOptions = this.categories.map(c => {
    //   const selected = value.category_ids.includes(c.id) ? "selected" : "";
    //   return `<option value="${c.id}" ${selected}>${c.name}</option>`;
    // });

    // Multi select2
    // <div class="col-md-6">
    //   <div class="mb-3">
    //     <label class="col-form-label">Categories<span class="text-danger">*</span></label>
    //     <select id="input_product_category_ids" class="form-select select2" multiple>
    //       ${selectCategoryOptions.join("")}
    //     </select>
    //     <small id="input_product_category_ids_error" class="text-danger mt-1" style="display: none;"></small>
    //   </div>
    // </div>

    const codeField = isEdit ? `
      <div class="col-md-6">
        <div class="mb-3">
          <label class="col-form-label">Product Code<span class="text-danger">*</span></label>
          <input type="text" id="input_product_code" class="form-control" value="${value.code}" ${isEdit ? "disabled" : ""}>
          <small id="input_product_code_error" class="text-danger mt-1" style="display: none;"></small>
        </div>
      </div>
    `: "";

    return `
      <div>
        <div class="row">
          ${codeField}
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Product Name<span class="text-danger">*</span></label>
              <input type="text" id="input_product_name" class="form-control" value="${value.name}">
              <small id="input_product_name_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>

          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Unit<span class="text-danger">*</span></label>
              <input type="text" id="input_product_unit" class="form-control" value="${value.unit}">
              <small id="input_product_unit_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>

          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Value<span class="text-danger">*</span></label>
              <input type="text" id="input_product_base_cost" class="form-control" value="${value.base_cost}" data-type="currency">
              <small id="input_product_base_cost_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>

          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Supplier<span class="text-danger">*</span></label>
              <select id="input_product_supplier_id" class="form-select select">
                <option value="">-- Select Supplier --</option>
                ${selectSupplierOptions.join("")}
              </select>
              <small id="input_product_supplier_id_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          
          <div class="col-md-12">
            <label class="col-form-label">Categories<span class="text-danger">*</span></label>
            <div class="row mb-3">
              ${this.categories.map(c => `
                <div class="col-md-4">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="cat_${c.id}" value="${c.id}" ${value.category_ids.includes(c.id) ? "checked" : ""}>
                    <label class="form-check-label" for="cat_${c.id}">${c.name}</label>
                  </div>
                </div>
              `).join('')}
            </div>
            <small id="input_product_category_ids_error" class="text-danger mt-1" style="display: none;"></small>
          </div>

          <div class="col-md-12">
            <div class="mb-3">
              <label class="col-form-label">Description</label>
              <textarea class="form-control" id="input_product_description" rows="3">${value.description}</textarea>
              <small id="input_product_description_error" class="text-danger mt-1" style="display: none;"></small>
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
        dropdownParent: $('#c_product_canvas_form')
      });
    }

    // 🔹 Untuk multi select (categories)
    // $('.select2').select2({
    //   width: '100%',
    //   dropdownParent: $('#c_product_canvas_form'),
    //   placeholder: '-- Select Categories --',
    //   allowClear: true
    // });

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
    this.categories = [];
    this.suppliers = [];
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

    const payload = {
      code: "",
      name: "",
      unit: "",
      base_cost: "",
      supplier_id: null,
      category_ids: [],
      description: ""
    };

    const inputs = [
      {
        field: "input_product_name",
        required: true,
        message: "Product Name is required."
      },
      {
        field: "input_product_unit",
        required: true,
        message: "Unit is required."
      },
      {
        field: "input_product_base_cost",
        required: true,
        message: "Base Cost is required."
      },
      {
        field: "input_product_supplier_id",
        required: false,
        message: "Supplier is required."
      },
      {
        field: "input_product_description",
        required: false,
        message: "Description is required."
      }
    ];

    // Loop semua input
    inputs.forEach(input => {
      const el = this.form.querySelector("#" + input.field);
      let value = el ? el.value.trim() : "";

      payload[input.field.replace("input_product_", "")] = value;

      if (!value && input.required) {
        this.errors[input.field + "_error"] = input.message;
      }
    });

    // Handle checkbox categories
    const checkedCategories = Array.from(
      this.form.querySelectorAll('input[type="checkbox"][id^="cat_"]:checked')
    ).map(el => parseInt(el.value));

    payload.category_ids = checkedCategories;

    if (checkedCategories.length === 0) {
      this.errors["input_product_category_ids_error"] = "At least one category must be selected.";
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
        const response = await fetch('/products', {
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
          showToast("success", response.message || 'Product created successfully!');
          $('#product_list').DataTable().ajax.reload();
          if (this.closeForm) this.closeForm.click();
          this.resetForm()
        } else {
          showToast("error", result.message || result.errors);
        }
      } catch (err) {
        showToast("error", 'An error occurred while creating Product.');
      } finally {
        this.isFetching = false;
        this.hideLoading()
      }
    } else if (this.mode === "edit") {
      try {
        const response = await fetch(`/products/${this.data.id}`, {
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
          showToast("success", response.message || 'Product updated successfully!');
          $('#product_list').DataTable().ajax.reload(null, false);
          if (this.closeForm) this.closeForm.click();
          this.resetForm()
        } else {
          showToast("error", result.message || result.errors);
        }
      } catch (err) {
        showToast("error", 'An error occurred while updating Product.');
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
  const PRODUCT_CANVAS = document.querySelector("#c_product_canvas");
  const PRODUCT_MODAL = document.querySelector("#c_product_modal");
  const PRODUCT_FORM = PRODUCT_CANVAS?.querySelector("form#c_product_canvas_form")
    ? new ProductForm("c_product_canvas_form")
    : null;
  const PRODUCT_CANVAS_BS = PRODUCT_CANVAS ? new bootstrap.Offcanvas(PRODUCT_CANVAS) : null;
  const PRODUCT_MODAL_BS = PRODUCT_MODAL ? new bootstrap.Modal(PRODUCT_MODAL) : null;

  // const modal = bootstrap.Modal.getInstance(document.getElementById("delete_product_modal"));
  // modal.hide();

  document.addEventListener("click", async e => {
    let target = e.target;

    // CREATE
    if (target.matches("#c_product_create_btn")) {
      e.preventDefault();
      if (PRODUCT_CANVAS_BS && PRODUCT_FORM && !IS_FETCHING) {
        const title = PRODUCT_CANVAS.querySelector("#c_product_canvas_title");
        title.textContent = "Create Product";
        PRODUCT_CANVAS_BS.show();
        PRODUCT_FORM.resetForm();
        await PRODUCT_FORM.init("create");
      }
    }

    // EDIT
    if (target.closest(".c_product_edit_btn")) {
      target = target.closest(".c_product_edit_btn");
      e.preventDefault();
      if (!PRODUCT_CANVAS_BS || !PRODUCT_FORM || IS_FETCHING) return;
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
          const title = PRODUCT_CANVAS.querySelector("#c_product_canvas_title");
          title.textContent = "Edit Product";
          PRODUCT_CANVAS_BS.show();
          PRODUCT_FORM.resetForm();
          await PRODUCT_FORM.init("edit", resJson.data);
        } else {
          showToast("error", resJson.message || "Failed to fetch product data for editing.");
        }
      } catch (error) {
        console.log(error);

        showToast("error", 'An error occurred while fetching the product data for editing.');
      } finally {
        IS_FETCHING = false;
      }
    }

    // DELETE
    else if (target.closest(".c_product_delete_btn")) {
      target = target.closest(".c_product_delete_btn");
      e.preventDefault();
      if (!PRODUCT_MODAL_BS || IS_FETCHING) return;
      const url = target.dataset.url;
      const confirmBtn = PRODUCT_MODAL.querySelector("#c_product_modal_confirm_btn");
      confirmBtn.dataset.url = url;
      PRODUCT_MODAL_BS.show();
    }

    // CONFIRM DELETE 
    else if (target.matches("#c_product_modal_confirm_btn")) {
      e.preventDefault();
      if (!PRODUCT_CANVAS_BS || !PRODUCT_FORM || IS_FETCHING) return;
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
          $('#product_list').DataTable().ajax.reload(null, false);
          showToast("success", resJson.message || "Product deleted successfully.");
          PRODUCT_MODAL_BS.hide();
        } else {
          showToast("error", resJson.message || "Failed to delete product.");
        }
      } catch (error) {
        showToast("error", "An error occurred while deleting the product.");
      } finally {
        IS_FETCHING = false;
      }
    }
  })
});