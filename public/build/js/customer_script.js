class CustomerForm {
  mode = "create";
  data = {};
  errors = {};

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeForm = document.getElementById("close_customer_form");

    this.handleSubmit = this.handleSubmit.bind(this)

    this.form.addEventListener("submit", (e) => {
      e.preventDefault();
      this.handleSubmit()
    });
  }

  // ---------------------------------------- INIT ----------------------------------------
  async init(mode = "create", data = {}) {
    this.resetForm();
    this.data = data;
    this.mode = mode;

    const formWrapper = document.createElement("div");
    formWrapper.id = "customer_form_wrapper";
    formWrapper.innerHTML = this.createForm();
    this.form.appendChild(formWrapper);
    this.initPlugins();
  }

  // ---------------------------------------- DOM ----------------------------------------
  createForm() {
    const isEdit = this.mode === "edit";

    const value = {
      code: "",
      status: "Active",
      name: "",
      address: "",
      contact_person: "",
      phone: "",
      email: "",
      bank_name: "",
      bank_account_number: "",
      bank_account_name: "",
      notes: "",
    }

    if (isEdit && this.data) {
      value.code = this.data.code || "";
      value.status = this.data.status || "Active";
      value.name = this.data.name || "";
      value.address = this.data.address || "";
      value.contact_person = this.data.contact_person || "";
      value.phone = this.data.phone || "";
      value.email = this.data.email || "";
      value.bank_name = this.data.bank_name || "";
      value.bank_account_number = this.data.bank_account_number || "";
      value.bank_account_name = this.data.bank_account_name || "";
      value.notes = this.data.notes || "";
    }

    const selectStatusOptions = ['Active', 'Inactive'].map(s => {
      return `<option value="${s}" ${value.status === s ? "selected" : ""}>${s}</option>`;
    });

    const dynamic = isEdit ?
      `
        <div class="col-md-6">
          <div class="mb-3">
            <label class="col-form-label">Customer Code</label>
              <input type="text" id="input_code" class="form-control btn-disabled" value="${value.code}" disabled>
          </div>
        </div>
      ` : ""
      ;

    return `
      <div>
        <div class="row">
          ${dynamic}
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Status<span class="text-danger">*</span></label>
              <select id="input_status" class="select form-control" style="text-transform: capitaliza;">
                <option value="" ${!value.status ? "selected" : ""}>-- Select Status --</option>
                ${selectStatusOptions}
              </select>
              <small id="input_status_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Customer Name<span class="text-danger">*</span></label>
              <input type="text" id="input_name" class="form-control btn-disabled" value="${value.name}">
              <small id="input_name_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Contact Person</label>
              <input type="text" id="input_contact_person" class="form-control btn-disabled" value="${value.contact_person}">
              <small id="input_contact_person_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Phone</label>
              <input type="text" id="input_phone" class="form-control btn-disabled" value="${value.phone}">
              <small id="input_phone_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Email</label>
              <input type="email" id="input_email" class="form-control btn-disabled" value="${value.email}">
              <small id="input_email_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Bank Name</label>
              <input type="text" id="input_bank_name" class="form-control btn-disabled" value="${value.bank_name}">
              <small id="input_bank_name_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Bank Account Number</label>
              <input type="text" id="input_bank_account_number" class="form-control btn-disabled" value="${value.bank_account_number}">
              <small id="input_bank_account_number_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Bank Account Name</label>
              <input type="text" id="input_bank_account_name" class="form-control btn-disabled" value="${value.bank_account_name}">
              <small id="input_bank_account_name_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label class="col-form-label">Address<span class="text-danger">*</span></label>
              <textarea class="form-control" id="input_address">${value.address}</textarea>
              <small id="input_address_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label class="col-form-label">Notes</label>
              <textarea class="form-control" id="input_notes">${value.notes}</textarea>
              <small id="input_notes_error" class="text-danger mt-1" style="display: none;"></small>
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
        dropdownParent: $('#c_customer_form')
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

    const status = this.form.querySelector("#input_status");
    const name = this.form.querySelector("#input_name");
    const contact_person = this.form.querySelector("#input_contact_person");
    const phone = this.form.querySelector("#input_phone");
    const email = this.form.querySelector("#input_email");
    const bank_name = this.form.querySelector("#input_bank_name");
    const bank_account_number = this.form.querySelector("#input_bank_account_number");
    const bank_account_name = this.form.querySelector("#input_bank_account_name");
    const address = this.form.querySelector("#input_address");
    const notes = this.form.querySelector("#input_notes");


    const payload = {
      status: status.value,
      name: name.value,
      contact_person: contact_person.value,
      phone: phone.value,
      email: email.value,
      bank_name: bank_name.value,
      bank_account_number: bank_account_number.value,
      bank_account_name: bank_account_name.value,
      address: address.value,
      notes: notes.value,
    };

    if (!payload.status) {
      this.errors["input_status_error"] = "Status is required."
    }

    if (!payload.name) {
      this.errors["input_name_error"] = "Customer Name is required."
    }

    if (!payload.address) {
      this.errors["input_address_error"] = "Address is required."
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

    console.log("Payload", payload);

    if (this.mode === "create") {
      try {
        const response = await fetch('/customers', {
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
          toastr.success(response.message || 'Customer created successfully!');
          $('#customer_list').DataTable().ajax.reload();
          if (this.closeForm) this.closeForm.click();
          console.log('Customer created:', result, result.data);
          this.resetForm()
        } else {
          console.error('Failed:', result.message || result.errors);
        }
      } catch (err) {
        toastr.error('An error occurred while creating Customer.');
        console.error('Error:', err);
      } finally {
        this.isFetching = false;
        this.hideLoading()
      }
    } else if (this.mode === "edit") {
      try {
        const response = await fetch(`/customers/${this.data.id}`, {
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
          toastr.success(response.message || 'Customer updated successfully!');
          $('#customer_list').DataTable().ajax.reload();
          if (this.closeForm) this.closeForm.click();
          console.log('Customer updated:', result, result.data);
          this.resetForm()
        } else {
          console.error('Failed:', result.message || result.errors);
        }
      } catch (err) {
        toastr.error('An error occurred while updating Customer.');
        console.error('Error:', err);
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
  const customerForm = new CustomerForm("c_customer_form");

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

    if (target.matches("#c_customer_add")) {
      const title = document.querySelector("#customer_form_title");
      title.textContent = "Create Customer";
      customerForm.resetForm();
      await customerForm.init("create");
    }

    if (target.matches(".c_customer_edit")) {
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
        const title = document.querySelector("#customer_form_title");
        customerForm.resetForm();
        title.textContent = "Edit Customer";
        await customerForm.init("edit", resJson.data);
      } else {
        console.log("Error on fetching customer for edit form");
      }
    }

    // Klik delete → inject url ke tombol confirm
    if (target.matches(".c_customer_delete")) {
      e.preventDefault();
      const url = target.getAttribute("data-url");
      const confirmBtn = document.getElementById("confirm_delete_customer");
      confirmBtn.setAttribute("data-url", url);
    }

    if (target.matches("#confirm_delete_customer")) {
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
          const modal = bootstrap.Modal.getInstance(document.getElementById("delete_customer_modal"));
          modal.hide();

          // DataTable → reload
          $('#customer_list').DataTable().ajax.reload();

          // Toastr success
          toastr.success(data.message || "Customer deleted successfully!");
        } else {
          toastr.error(data.message || "Failed to delete Customer.");
        }
      } catch (err) {
        toastr.error("Server error. Failed to delete Customer.");
        console.error(err);
      }
    }
  })
});