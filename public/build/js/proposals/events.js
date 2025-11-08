class ProposalForm {
  isInit = true;
  selectedBoqs = [];
  mode = "create";
  data = {};
  projects = [];
  errors = {};

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.closeForm = document.getElementById("c_poposal_canvas_close_btn");
    this.dataTableUrl = document.getElementById('boq-route').dataset.url;
    this.initDataTable = this.initDataTable.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this)
    this.handleDocumentChange = this.handleDocumentChange.bind(this);
    this.handleDocumentSubmit = this.handleDocumentSubmit.bind(this);

    this.form.addEventListener("submit", (e) => {
      e.preventDefault();
      this.handleSubmit()
    });

    document.addEventListener("change", this.handleDocumentChange);
    document.addEventListener("submit", this.handleDocumentSubmit, true);
  }

  // ---------------------------------------- GLOBAL HANDLER ----------------------------------------
  async handleDocumentChange(e) {
    const target = e.target;

    if (target.matches("#proposal_canvas_boq_list #select_all_proposal_canvas_boq")) {
      const checked = target.checked;

      document.querySelectorAll('#proposal_canvas_boq_list input.row-check').forEach(el => {
        el.checked = checked;

        if (checked) {
          this.selectedBoqs.push({
            id: el.value,
            code: el.dataset.code
          });
        } else {
          this.selectedBoqs = this.selectedBoqs.filter(obj => obj.id !== el.value);
        }
      });

      const unique = new Map(this.selectedBoqs.map(item => [item.id, item]));
      this.selectedBoqs = Array.from(unique.values());
      this.updateSelectedEl();
    } else if (target.matches("#proposal_canvas_boq_list input.row-check")) {
      const checked = target.checked;

      if (!checked) {
        document.querySelector("#proposal_canvas_boq_list #select_all_proposal_canvas_boq").checked = false;
        this.selectedBoqs = this.selectedBoqs.filter(obj => obj.id !== target.value)
      } else {
        this.selectedBoqs.push({
          id: target.value,
          code: target.dataset.code
        });
      }

      const unique = new Map(this.selectedBoqs.map(item => [item.id, item]));
      this.selectedBoqs = Array.from(unique.values());
      this.updateSelectedEl();
    } else if (target.matches("#input_status")) {
      const noteInputWrapper = this.form.querySelector("#input_note_wrapper");

      if (noteInputWrapper) {
        if (target.value === "Lose") {
          noteInputWrapper.innerHTML = `
            <div class="col-md-12">
              <div class="mb-3">
                <label class="col-form-label">Note<span class="text-danger">*</span></label>
                <textarea class="form-control" id="input_note"></textarea>
                <small id="input_note_error" class="text-danger mt-1" style="display: none;"></small>
              </div>
            </div>
          `;
          noteInputWrapper.style.display = "block";
        } else {
          noteInputWrapper.style.display = "none";
          noteInputWrapper.innerHTML = "";
        }
      }
    }
  }

  handleDocumentSubmit(e) {
    const target = e.target;

    if (target.matches("#c_proposal_canvas_boq_list_search_form")) {
      e.preventDefault();
      e.stopPropagation();
      this.initDataTable(true);
    }
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
        this.projects = res.data;
      })
      .catch(err => {
        console.error("Fetch projects error:", err);
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
    await this.fetchProjects();

    const formWrapper = document.createElement("div");
    formWrapper.id = "proposal_form_wrapper";
    formWrapper.innerHTML = this.createForm();
    this.form.appendChild(formWrapper);
    this.initDataTable();
    this.initPlugins();
    this.isInit = false;
    this.hideLoading();
  }

  // ---------------------------------------- DOM ----------------------------------------
  createForm() {
    const isEditing = this.mode === "edit";

    const value = {
      project_id: "",
      code: "",
      status: "Draft",
      note: "",
    }

    if (isEditing && this.data) {
      value.project_id = this.data.project_id || "";
      value.code = this.data.code || "";
      value.status = this.data.status || "";
      value.note = this.data.note || "";
    }

    let isDisableProjectId = false;

    try {
      // Used on project.detail page
      if (!value.project_id && PROJECT_ID) {
        value.project_id = PROJECT_ID;
        isDisableProjectId = true;
      }
    } catch (error) { }

    const selectProjectOptions = this.projects.map(p => {
      return `<option value="${p.id}" ${value.project_id === p.id ? "selected" : ""}>${p.code}</option>`;
    });

    const selectStatusOptions = [
      'Draft', 'Submitted', 'Win', 'Lose', 'Cancelled'].map(s => {
        return `<option value="${s}" ${value.status === s ? "selected" : ""}>${s}</option>`;
      });

    const projectIdField = `
        <div class="col-md-6">
          <div class="mb-3">
            <div class="d-flex align-items-center justify-content-between">
              <label class="col-form-label">Project<span class="text-danger">*</span></label>
            </div>
            <select id="input_project_id" class="select form-control" ${isDisableProjectId ? "disabled" : ""}>
              <option value="" ${!value.project_id ? "selected" : ""}>-- Select Project --</option>
              ${selectProjectOptions}
            </select>
            <small id="input_project_id_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
      `;

    const dynamicField = this.mode === "create" ?
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

    let boqList = "";

    if (!isEditing) {
      let selectedBoqEl = "<li class='no-selected-tag'>No Selected BoQ</li>";

      if (this.selectedBoqs.length) {
        selectedBoqEl = this.selectedBoqs
          .map(obj => `<li class="selected-tag">${obj.code}</li>`)
          .join("");
      }

      boqList = `
        <div class="col-md-12" id="proposal_canvas_boq_section">
          <div>
            <label class="col-form-label">BoQ(s)</label>
            <ul id="selected_proposal_canvas_boq" class="mt-2">${selectedBoqEl}</ul>
          </div>
          <div class="col-md-12 mb-2 mt-2 pt-2" style="border-top: 1px solid var(--bs-border-color);">
            <form class="icon-form mb-3 mb-sm-0" id="c_proposal_canvas_boq_list_search_form">
              <span class="form-icon" style="z-index: 0;"><i class="ti ti-search"></i></span>
              <input type="text" class="form-control" placeholder="Search BoQ" id="c_proposal_canvas_boq_list_search_input">
            </form>							
          </div>	
          <div style="border: 1px solid #e8e8e8; border-radius: 6px;">
            <div class="table-responsive custom-table">
              <table class="table" id="proposal_canvas_boq_list" data-url="${this.dataTableUrl}">
                <thead class="thead-light">
                  <tr>
                    <th class="td-break no-sort" rowspan="2" style="position: sticky; z-index: 1;">
                      <label class="checkboxs">
                        <input type="checkbox" id="select_all_proposal_canvas_boq">
                        <span class="checkmarks"></span>
                      </label>
                    </th>
                    <th class="td-break" rowspan="2">Proposal Code</th>
                    <th class="td-break" rowspan="2">BOQ Code</th>
                    <th class="td-break" rowspan="2">BOQ Type</th>
                    <th class="td-break" rowspan="2">Description</th>
                    <th colspan="8">Items</th>
                    <th class="td-break" rowspan="2">Basic Price</th>
                    <th class="td-break" rowspan="2">Management Fee</th>
                    <th class="td-break" rowspan="2">Sales Amount</th>
                    <th class="td-break" rowspan="2">VAT Rate</th>
                    <th class="td-break" rowspan="2">VAT</th>
                    <th class="td-break" rowspan="2">Invoice Amount</th>
                  </tr>
                  <tr>
                    <th>Header</th>
                    <th>Subheader</th>
                    <th>Unit Price</th>
                    <th>Title1</th>
                    <th>Title2</th>
                    <th>Title3</th>
                    <th>Title4</th>
                    <th>Multiplier</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
            <div class="row align-items-center" style="row-gap: 1em; padding: 10px 15px;">
              <div class="col-md-6">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                  <div class="datatable-info"></div>
                  <div class="proposal-canvas-table-boq-length"></div>
                </div>
              </div>
              <div class="col-md-6 flex-grow-1">
                <div class="proposal-canvas-table-boq-paginate"></div>
              </div>
            </div>
          </div>
        </div>
      `;
    }

    const noteField = isEditing && value.status === "Lose" ? `
      <div id="input_note_wrapper">
        <div class="col-md-12">
          <div class="mb-3">
            <label class="col-form-label">Note<span class="text-danger">*</span></label>
            <textarea class="form-control" id="input_note">${value.note}</textarea>
            <small id="input_note_error" class="text-danger mt-1" style="display: none;"></small>
          </div>
        </div>
      </div>
    `:
      "<div id='input_note_wrapper' style='display: none;'></div>";

    return `
      <div>
        <div class="row">
          ${dynamicField}
          <div class="col-md-6">
            <div class="mb-3">
              <label class="col-form-label">Status<span class="text-danger">*</span></label>
              <select id="input_status" class="select form-control" style="text-transform: capitaliza;" ${!isEditing ? "disabled" : ""}>
                <option value="" ${!value.status ? "selected" : ""}>-- Select Status --</option>
                ${selectStatusOptions}
              </select>
              <small id="input_status_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          ${noteField}
          ${boqList}
        </div>
        <div class="d-flex align-items-center justify-content-end mt-4">
          <a href="javascript:void(0)" class="btn btn-light me-2" data-bs-dismiss="offcanvas">Cancel</a>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    `;
  }

  updateSelectedEl() {
    const el = this.form.querySelector("#selected_proposal_canvas_boq");
    if (el) {
      if (this.selectedBoqs.length) {
        el.innerHTML = this.selectedBoqs
          .map(obj => `<li class="selected-tag">${obj.code}</li>`)
          .join("");
      } else {
        el.innerHTML = `<li class="no-selected-tag">No Selected BoQ</li>`;
      }
    }
  }

  initDataTable(resetPage = false) {
    const self = this;
    const $table = $('#proposal_canvas_boq_list');

    if ($.fn.DataTable.isDataTable($table)) {
      $table.DataTable().ajax.reload(null, resetPage); // false = jangan reset pagination
      return;
    }

    $table.DataTable({
      "serverSide": true,
      "bFilter": false,
      "bInfo": false,
      "ordering": true,
      "autoWidth": true,
      "order": [[0, "desc"]],
      "language": {
        search: '',
        sLengthMenu: '_MENU_',
        searchPlaceholder: "Search",
        info: "_START_ - _END_ of _TOTAL_ items",
        "lengthMenu": "Show _MENU_ entries",
        paginate: {
          next: 'Next <i class="fa fa-angle-right"></i>',
          previous: '<i class="fa fa-angle-left"></i> Prev'
        },
      },
      initComplete: function (settings, json) {
        const $wrapper = $(settings.nTable).closest('.dataTables_wrapper');
        $wrapper.find('.dataTables_paginate').appendTo('.proposal-canvas-table-boq-paginate');
        $wrapper.find('.dataTables_length').appendTo('.proposal-canvas-table-boq-length');
      },
      ajax: {
        url: $table.data('url'),
        type: "GET",
        data: function (d) {
          d.search = self.form.querySelector("#c_proposal_canvas_boq_list_search_input")?.value || "";
        },
        dataSrc: function (json) {
          return json.data;
        }
      },
      columns: [
        {
          data: 'id',
          orderable: false,
          render: function (data, type, row) {
            const checked = self.selectedBoqs.some(obj => +obj.id === data);
            return `
							<label class="checkboxs">
								<input type="checkbox" class="row-check" ${checked ? "checked" : ""} value="${data}" data-code="${row.code}">
								<span class="checkmarks"></span>
							</label>
						`;
          }
        },
        { data: 'proposal_code' },
        { data: 'code' },
        { data: 'form_type' },
        { data: 'description', className: 'desc-col' },
        { data: 'header', orderable: false },
        { data: 'subheader', orderable: false },
        {
          data: 'unit_price',
          orderable: false,
          render: function (data) {
            return data;
          }
        },
        { data: 'item_title1', orderable: false },
        { data: 'item_title2', orderable: false },
        { data: 'item_title3', orderable: false },
        { data: 'item_title4', orderable: false },
        {
          data: 'multiplier_total',
          orderable: false,
          render: function (data) {
            return data;
          }
        },
        {
          data: 'total_amount_items',
          render: function (data) {
            return data;
          }
        },
        {
          data: 'management_fee',
          orderable: false,
          render: (data) => {
            return formatRupiah(data);
          }
        },
        {
          data: 'sales_amount',
          render: (data) => {
            return formatRupiah(data);
          }
        },
        {
          data: 'vat_rate',
          render: function (data, type) {
            return type === 'display' ? data + "%" : data;
          }
        },
        {
          data: 'vat',
          render: (data) => {
            return formatRupiah(data);
          }
        },
        {
          data: 'invoice_amount',
          render: (data) => {
            return formatRupiah(data);
          }
        },
      ]
    });
  }

  initPlugins() {
    // SELECT2 (if using select with class="select", no need when using class="form-select")
    if (window.$ && $.fn.select2) {
      $('.select').select2({
        width: '100%',
        dropdownParent: $('#c_proposal_canvas_form')
      });

      // bridge event agar change bisa dideteksi
      $('.select').on('select2:select', function () {
        this.dispatchEvent(new Event('change', { bubbles: true }));
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

    // // YEAR PICKER (khusus tahun aja)
    // if ($('.yearpicker').length && $.fn.datetimepicker) {
    //   $('.yearpicker').datetimepicker({
    //     format: 'YYYY',
    //     viewMode: 'years',
    //   });
    // }

    // // SUMMERNOTE
    // if ($('.summernote').length && $.fn.summernote) {
    //   $('.summernote').summernote({ height: 150 });
    // }

    // // TAGS INPUT
    // if ($('.input-tags').length && $.fn.tagsinput) {
    //   $('.input-tags').tagsinput();
    // }
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
    this.selectedBoqs = [];
    this.mode = "create";
    this.data = {};
    this.projects = [];
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

    const project_id = this.form.querySelector("#input_project_id");
    const status = this.form.querySelector("#input_status");
    const note = this.form.querySelector("#input_note");


    const payload = {
      project_id: parseInt(project_id.value) || null,
      status: status.value,
      boq_ids: this.selectedBoqs.map(obj => obj.id)
    };

    if (!payload.project_id) {
      this.errors["input_project_id_error"] = "Project is required."
    }

    if (!payload.status) {
      this.errors["input_status_error"] = "Status is required."
    }

    if (this.mode === "edit") {
      payload.note = (note?.value || "").trim();

      if (payload.status === "Lose" && !payload.note) {
        this.errors["input_note_error"] = "Note is required."
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
          try {
            // Used on project.detail page
            loadProjectData(PROJECT_ID)
          } catch (error) { }

          $('#proposal_list').DataTable().ajax.reload();
          showToast("success", response.message || 'Proposal created successfully!');
          if (this.closeForm) this.closeForm.click();
          this.resetForm()
        } else {
          showToast("error", result.errors?.note[0] || result.message);
        }
      } catch (err) {
        showToast("error", 'An error occurred while creating Proposal.');
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
          try {
            // Used on project.detail page
            loadProjectData(PROJECT_ID)
          } catch (error) { }

          $('#proposal_list').DataTable().ajax.reload();
          showToast("success", response.message || 'Proposal updated successfully!');
          if (this.closeForm) this.closeForm.click();
          this.resetForm()
        } else {
          showToast("error", result.errors?.note[0] || result.message);
        }
      } catch (err) {
        showToast("error", 'An error occurred while updating Proposal.');
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
  const PROPOSAL_CANVAS = document.querySelector("#c_proposal_canvas");
  const PROPOSAL_MODAL = document.querySelector("#c_proposal_modal");
  const PROPOSAL_FORM = PROPOSAL_CANVAS?.querySelector("form#c_proposal_canvas_form")
    ? new ProposalForm("c_proposal_canvas_form")
    : null;
  const PROPOSAL_CANVAS_BS = PROPOSAL_CANVAS ? new bootstrap.Offcanvas(PROPOSAL_CANVAS) : null;
  const PROPOSAL_MODAL_BS = PROPOSAL_MODAL ? new bootstrap.Modal(PROPOSAL_MODAL) : null;

  document.addEventListener("click", async e => {
    let target = e.target;

    // CREATE
    if (target.matches("#c_proposal_create_btn")) {
      e.preventDefault();
      if (PROPOSAL_CANVAS_BS && PROPOSAL_FORM && !IS_FETCHING) {
        const title = PROPOSAL_CANVAS.querySelector("#c_proposal_canvas_title");
        title.textContent = "Create Proposal";
        PROPOSAL_CANVAS_BS.show();
        PROPOSAL_FORM.resetForm();
        await PROPOSAL_FORM.init("create");
      }
    }

    // EDIT
    if (target.closest(".c_proposal_edit_btn")) {
      target = target.closest(".c_proposal_edit_btn");
      e.preventDefault();
      if (!PROPOSAL_CANVAS_BS || !PROPOSAL_FORM || IS_FETCHING) return;
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
          const title = PROPOSAL_CANVAS.querySelector("#c_proposal_canvas_title");
          title.textContent = "Edit Proposal";
          PROPOSAL_CANVAS_BS.show();
          PROPOSAL_FORM.resetForm();
          await PROPOSAL_FORM.init("edit", resJson.data);
        } else {
          showToast("error", resJson.message || "Failed to fetch proposal data for editing.");
        }
      } catch (error) {
        console.log(error);

        showToast("error", 'An error occurred while fetching the proposal data for editing.');
      } finally {
        IS_FETCHING = false;
      }
    }

    // DELETE
    else if (target.closest(".c_proposal_delete_btn")) {
      target = target.closest(".c_proposal_delete_btn");
      e.preventDefault();
      if (!PROPOSAL_MODAL_BS || IS_FETCHING) return;
      const url = target.dataset.url;
      const confirmBtn = PROPOSAL_MODAL.querySelector("#c_proposal_modal_confirm_btn");
      confirmBtn.dataset.url = url;
      PROPOSAL_MODAL_BS.show();
    }

    // CONFIRM DELETE 
    else if (target.matches("#c_proposal_modal_confirm_btn")) {
      e.preventDefault();
      if (!PROPOSAL_CANVAS_BS || !PROPOSAL_FORM || IS_FETCHING) return;
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

          $('#proposal_list').DataTable().ajax.reload();
          showToast("success", resJson.message || "Proposal deleted successfully.");
          PROPOSAL_MODAL_BS.hide();
        } else {
          showToast("error", resJson.message || "Failed to delete proposal.");
        }
      } catch (error) {
        showToast("error", "An error occurred while deleting the proposal.");
      } finally {
        IS_FETCHING = false;
      }
    }
  })
});