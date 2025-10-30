class ProposalForm {
  mode = "create";
  data = {};
  projects = [];
  errors = {};

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeForm = document.getElementById("close_proposal_form");

    this.handleSubmit = this.handleSubmit.bind(this)

    this.form.addEventListener("submit", (e) => {
      e.preventDefault();
      this.handleSubmit()
    });
  }

  // ---------------------------------------- FETCHER ----------------------------------------
  async fetchProjects() {
    this.isFetching = true;
    this.showLoading();
    return fetch("/projects/all", {
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
        console.log(res.data);
        this.projects = res.data;
      })
      .catch(err => {
        console.error("Fetch projects error:", err);
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
    await this.fetchProjects();

    const formWrapper = document.createElement("div");
    formWrapper.id = "proposal_form_wrapper";
    formWrapper.innerHTML = this.createForm();
    this.form.appendChild(formWrapper);
    this.initPlugins();
  }

  // ---------------------------------------- DOM ----------------------------------------
  createForm() {
    const isEdit = this.mode === "edit";

    const value = {
      project_id: "",
      code: "",
      type_of_sales_code: "FIT",
      year_of_sales: "",
      date_from: "",
      date_to: "",
      destination: "Indonesia",
      city: "",
      activity: "",
      status: ""
    }

    if (isEdit && this.data) {
      value.project_id = this.data.project_id || "";
      value.code = this.data.code || "";
      value.type_of_sales_code = this.data.type_of_sales_code || "FIT";
      value.year_of_sales = this.data.year_of_sales || "";
      value.date_from = this.data.date_from || "";
      value.date_to = this.data.date_to || "";
      value.destination = this.data.destination || "Indonesia";
      value.city = this.data.city || "";
      value.activity = this.data.activity || "";
      value.status = this.data.status || "";
    }

    let isDisable = false;

    try {
      if (PROJECT_ID) {
        value.project_id = PROJECT_ID;
        isDisable = true;
      }
    } catch (error) { }

    const selectProposalOptions = this.projects.map(p => {
      return `<option value="${p.id}" ${value.project_id === p.id ? "selected" : ""}>${p.code}</option>`;
    });

    const selectDestinationOptions = ['Indonesia', 'Overseas'].map(d => {
      return `<option value="${d}" ${value.destination === d ? "selected" : ""}>${d}</option>`;
    })

    const selectActivityOptions = [
      'Awarding',
      'Conference and Seminar',
      'Exhibitions',
      'Gala Dinner',
      'Gathering',
      'Holidays',
      'Incentive Trip',
      'Meeting',
      'Product Launching',
      'Shareholders Meeting (RUPS)',
      'Workshop',
      'Others'
    ].map(a => {
      return `<option value="${a}" ${value.activity === a ? "selected" : ""}>${a}</option>`;
    });

    const selectStatusOptions = [
      'Draft', 'Submitted', 'Approved', 'Rejected', 'Cancelled'].map(s => {
        return `<option value="${s}" ${value.status === s ? "selected" : ""}>${s}</option>`;
      });

    const projectIdField = `
        <div class="col-md-12">
          <div class="mb-3">
            <div class="d-flex align-items-center justify-content-between">
              <label class="col-form-label">Project<span class="text-danger">*</span></label>
            </div>
            <select id="input_project_id" class="select form-control" ${isDisable ? "disabled" : ""}>
              <option value="" ${!value.project_id ? "selected" : ""}>-- Select Project --</option>
              ${selectProposalOptions}
            </select>
            <small id="input_project_id_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
      `;

    const dynamic = this.mode === "create" ?
      projectIdField :
      ` 
        ${projectIdField}
        <div class="col-md-6">
          <div class="mb-3">
            <label class="col-form-label">Proposal Code</label>
              <input type="text" id="input_code" class="form-control btn-disabled" value="${value.code}" disabled>
          </div>
        </div>
      `;

    return `
      <div>
        <div class="row">
          ${dynamic}
          <div class="col-md-6">
            <div class="mb-3">
              <div class="d-flex align-items-center justify-content-between">
                <label class="col-form-label">Type of Sales code<span class="text-danger">*</span></label>
              </div>
              <select id="input_type_of_sales_code" class="select form-control">
                <option value="FIT" ${value.type_of_sales_code === "FIT" ? "selected" : ""}>FIT</option>
                <option value="Non FIT" ${value.type_of_sales_code === "Non FIT" ? "selected" : ""}>Non FIT</option>
              </select>
              <small id="input_type_of_sales_code_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Year of Sales</label>
              <div class="icon-form">
                <span class="form-icon"><i class="ti ti-calendar-event"></i></span>
                <input id="input_year_of_sales" type="text" class="form-control yearpicker" placeholder="DD/MM/YY" value="${value.year_of_sales}">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Start Date<span class="text-danger">*</span></label>
              <div class="icon-form">
                <span class="form-icon"><i class="ti ti-calendar-event"></i></span>
                <input id="input_date_from" type="text" class="form-control datetimepicker" placeholder="DD/MM/YY" value="${value.date_from}">
              </div>
              <small id="input_date_from_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">End Date<span class="text-danger">*</span></label>
              <div class="icon-form">
                <span class="form-icon"><i class="ti ti-calendar-event"></i></span>
                <input id="input_date_to" type="text" class="form-control datetimepicker" placeholder="DD/MM/YY" value="${value.date_to}">
              </div>
              <small id="input_date_to_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Destination<span class="text-danger">*</span></label>
              <select id="input_destination" class="select form-control">
                ${selectDestinationOptions}
              </select>
              <small id="input_destination_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">City<span class="text-danger">*</span></label>
              <input type="text" id="input_city" class="form-control" value="${value.city}">
              <small id="input_city_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Activity<span class="text-danger">*</span></label>
              <select id="input_activity" class="select form-control">
                <option value="" ${!value.activity ? "selected" : ""}>-- Select Activity --</option>
                ${selectActivityOptions}
              </select>
              <small id="input_activity_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
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
        dropdownParent: $('#c_proposal_form')
      });
    }

    // DATETIMEPICKER (tanggal normal)
    if ($('.datetimepicker').length && $.fn.datetimepicker) {
      $('.datetimepicker').each(function () {
        const el = $(this);
        const rawValue = el.val(); // misal: 2025-10-24T07:14:38.000000Z

        // Deteksi apakah format ISO valid
        const isIso = rawValue && moment(rawValue, moment.ISO_8601, true).isValid();
        const parsedDate = isIso ? moment(rawValue) : null;

        // Inisialisasi datetimepicker
        el.datetimepicker({
          format: 'DD/MM/YY',
          date: parsedDate || null, // tampilkan tanggal awal jika ada
        });

        // Kalau nilai awal ISO → ubah tampilannya jadi DD/MM/YY
        if (isIso) {
          el.val(parsedDate.format('DD/MM/YY'));
        }
      });
    }

    // YEAR PICKER (khusus tahun aja)
    if ($('.yearpicker').length && $.fn.datetimepicker) {
      $('.yearpicker').datetimepicker({
        format: 'YYYY',
        viewMode: 'years',
      });
    }

    // SUMMERNOTE
    if ($('.summernote').length && $.fn.summernote) {
      $('.summernote').summernote({ height: 150 });
    }

    // TAGS INPUT
    if ($('.input-tags').length && $.fn.tagsinput) {
      $('.input-tags').tagsinput();
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
    this.projects = [];
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

    const project_id = this.form.querySelector("#input_project_id");
    const type_of_sales_code = this.form.querySelector("#input_type_of_sales_code");
    const year_of_sales = this.form.querySelector("#input_year_of_sales");
    const date_from = this.form.querySelector("#input_date_from");
    const date_to = this.form.querySelector("#input_date_to");
    const destination = this.form.querySelector("#input_destination");
    const city = this.form.querySelector("#input_city");
    const activity = this.form.querySelector("#input_activity");
    const status = this.form.querySelector("#input_status");


    const payload = {
      project_id: parseInt(project_id.value) || null,
      type_of_sales_code: type_of_sales_code.value,
      year_of_sales: year_of_sales.value,
      date_from: date_from.value ? moment(date_from.value, 'DD/MM/YY').format('YYYY-MM-DD') : date_from.value,
      date_to: date_to.value ? moment(date_to.value, 'DD/MM/YY').format('YYYY-MM-DD') : date_to.value,
      destination: destination.value,
      city: city.value.trim(),
      activity: activity.value,
      status: status.value,
    };

    if (!payload.project_id) {
      this.errors["input_project_id_error"] = "Project is required."
    }

    if (!payload.type_of_sales_code) {
      this.errors["input_type_of_sales_code_error"] = "Type of Sales Code is required."
    }

    if (!payload.date_from) {
      this.errors["input_date_from_error"] = "Start Date is required."
    }

    if (!payload.date_to) {
      this.errors["input_date_to_error"] = "End Date is required."
    }

    if (!payload.destination) {
      this.errors["input_destination_error"] = "Destination is required."
    }

    if (!payload.city) {
      this.errors["input_city_error"] = "City is is required."
    }

    if (!payload.activity) {
      this.errors["input_activity_error"] = "Activity is required."
    }

    if (!payload.status) {
      this.errors["input_status_error"] = "Status is required."
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
        const response = await fetch('/proposals', {
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
          // This function defined on projects.show.blade (for project detail page)
          try {
            loadProjectData(PROJECT_ID)
          } catch (error) { }

          toastr.success(response.message || 'Proposal created successfully!');
          $('#proposal_list').DataTable().ajax.reload();
          if (this.closeForm) this.closeForm.click();
        } else {
          console.error('Failed:', result.message || result.errors);
        }
      } catch (err) {
        toastr.error('An error occurred while creating Proposal.');
        console.error('Error:', err);
      } finally {
        this.isFetching = false;
        this.hideLoading()
      }
    } else if (this.mode === "edit") {
      try {
        const response = await fetch(`/proposals/${this.data.id}`, {
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
          // This function defined on projects.show.blade (for project detail page)
          try {
            loadProjectData(PROJECT_ID)
          } catch (error) { }
          toastr.success(response.message || 'Proposal updated successfully!');
          $('#proposal_list').DataTable().ajax.reload();
          if (this.closeForm) this.closeForm.click();
        } else {
          console.error('Failed:', result.message || result.errors);
        }
      } catch (err) {
        toastr.error('An error occurred while updating Proposal.');
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

    this.resetForm()
  }
}

// ----------------------------------------------- TRIGER -----------------------------------------------

document.addEventListener("DOMContentLoaded", () => {
  const proposalForm = new ProposalForm("c_proposal_form");

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

    if (target.matches("#c_proposal_add")) {
      const title = document.querySelector("#proposal_form_title");
      title.textContent = "Create Proposal";
      proposalForm.resetForm();
      await proposalForm.init("create");
    }

    if (target.matches(".c_proposal_edit")) {
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
        const title = document.querySelector("#proposal_form_title");
        proposalForm.resetForm();
        title.textContent = "Edit Proposal";
        await proposalForm.init("edit", resJson.data);
      } else {
        console.log("Error on fetching proposal for edit form");
      }
    }

    // Klik delete → inject url ke tombol confirm
    if (target.matches(".c_proposal_delete")) {
      e.preventDefault();
      const url = target.getAttribute("data-url");
      const confirmBtn = document.getElementById("confirm_delete_proposal");
      confirmBtn.setAttribute("data-url", url);
    }

    if (target.matches("#confirm_delete_proposal")) {
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
          const modal = bootstrap.Modal.getInstance(document.getElementById("delete_proposal_modal"));
          modal.hide();

          // DataTable → reload
          $('#proposal_list').DataTable().ajax.reload();

          // This function defined on projects.show.blade (for project detail page)
          try {
            loadProjectData(PROJECT_ID)
          } catch (error) { }

          // Toastr success
          toastr.success(data.message || "Proposal deleted successfully!");
        } else {
          toastr.error(data.message || "Failed to delete Proposal.");
        }
      } catch (err) {
        toastr.error("Server error. Failed to delete Proposal.");
        console.error(err);
      }
    }
  })
});