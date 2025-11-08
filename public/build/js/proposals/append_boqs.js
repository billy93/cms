class AppendBoqForm {
  isInit = true;
  selectedItem = [];
  isDisableSubmit = true;

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.dataTableUrl = document.getElementById('boq-route').dataset.url;
    this.closeForm = document.getElementById("c_proposal_append_boq_canvas_close_btn");
    this.initDataTable = this.initDataTable.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleDocumentChange = this.handleDocumentChange.bind(this);
    this.handleDocumentSubmit = this.handleDocumentSubmit.bind(this);

    this.form.addEventListener("submit", (e) => {
      e.preventDefault();
      this.handleSubmit()
    });

    document.addEventListener("change", this.handleDocumentChange);
    document.addEventListener("submit", this.handleDocumentSubmit, true);
  }

  // ---------------------------------------- HANDLER GLOBAL ----------------------------------------
  async handleDocumentChange(e) {
    const target = e.target;

    if (target.matches("#select_all_proposal_append_boq_list")) {
      const checked = target.checked;

      document.querySelectorAll('#proposal_append_boq_list input.row-check').forEach(el => {
        el.checked = checked;

        if (checked) {
          this.selectedItem.push({
            id: el.value,
            code: el.dataset.code
          });
        } else {
          this.selectedItem = this.selectedItem.filter(obj => obj.id !== el.value);
        }
      });

      const unique = new Map(this.selectedItem.map(item => [item.id, item]));
      this.selectedItem = Array.from(unique.values());
      this.updateSelectedEl();
    } else if (target.matches("#proposal_append_boq_list input.row-check")) {
      const checked = target.checked;

      if (!checked) {
        document.querySelector("#select_all_proposal_append_boq_list").checked = false;
        this.selectedItem = this.selectedItem.filter(obj => obj.id !== target.value)
      } else {
        this.selectedItem.push({
          id: target.value,
          code: target.dataset.code
        });
      }

      const unique = new Map(this.selectedItem.map(item => [item.id, item]));
      this.selectedItem = Array.from(unique.values());
      this.updateSelectedEl();
    }
  }

  handleDocumentSubmit(e) {
    const target = e.target;

    if (target.matches("#c_proposal_append_boq_list_search_form")) {
      e.preventDefault();
      e.stopPropagation();
      this.initDataTable(true);
    }
  }

  // ---------------------------------------- INIT ----------------------------------------
  async init(data = {}) {
    this.resetForm();
    this.showLoading();
    this.data = data;

    const formWrapper = document.createElement("div");
    formWrapper.id = "proposal_append_boq_form_wrapper";
    formWrapper.innerHTML = this.createForm();
    this.form.appendChild(formWrapper);
    this.initDataTable();
    this.isInit = false;
    this.hideLoading();
  }

  // ---------------------------------------- DOM ----------------------------------------
  createForm() {
    return `
      <div>
        <h5 class="mb-1">Selected BOQ Codes:</h5>
        <ul id="selected_proposal_append_boq" class="mt-2"><li class="no-selected-tag">No Selected BoQ</li></ul>
      </div>
      <div class="col-md-12 mb-2 pt-2" style="border-top: 1px solid var(--bs-border-color);">
        <form class="icon-form mb-3 mb-sm-0" id="c_proposal_append_boq_list_search_form">
          <span class="form-icon" style="z-index: 0;"><i class="ti ti-search"></i></span>
          <input type="text" class="form-control" placeholder="Search BoQ" id="c_proposal_append_boq_list_search_input">
        </form>
      </div>
      <div style="border: 1px solid #e8e8e8; border-radius: 6px;">
        <div class="table-responsive custom-table">
          <table class="table" id="proposal_append_boq_list" data-url="${this.dataTableUrl}">
            <thead class="thead-light">
              <tr>
                <th class="td-break no-sort" rowspan="2" style="position: sticky; z-index: 1;">
                  <label class="checkboxs">
                    <input type="checkbox" id="select_all_proposal_append_boq_list">
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
              <div class="proposal-append-table-boq-length"></div>
            </div>
          </div>
          <div class="col-md-6 flex-grow-1">
            <div class="proposal-append-table-boq-paginate"></div>
          </div>
        </div>
      </div>
      <small id="proposal-append-boq-error" class="text-danger mt-1" style="display: none;"></small>
      <div class="d-flex align-items-center justify-content-end mt-4">
        <a href="javascript:void(0)" class="btn btn-light me-2" data-bs-dismiss="offcanvas">Cancel</a>
        <button type="submit" class="btn btn-primary" ${this.isDisableSubmit ? "disabled" : ""}>Save</button>
      </div>
    `;
  }

  updateSelectedEl() {
    const el = document.querySelector("#selected_proposal_append_boq");
    if (el) {
      if (this.selectedItem.length) {
        this.isDisableSubmit = false;
        document.querySelector("#proposal_append_boq_form_wrapper button[type='submit']").disabled = false;
        el.innerHTML = this.selectedItem
          .map(obj => `<li class="selected-tag">${obj.code}</li>`)
          .join("");
      } else {
        this.isDisableSubmit = true;
        document.querySelector("#proposal_append_boq_form_wrapper button[type='submit']").disabled = true;
        el.innerHTML = `<li class="no-selected-tag">No Selected BoQ</li>`;
      }
    }
  }

  initDataTable(resetPage = false) {
    const self = this;
    const $table = $('#proposal_append_boq_list');

    if ($.fn.DataTable.isDataTable($table)) {
      $table.DataTable().ajax.reload(null, resetPage); // false = jangan reset pagination
      return;
    }

    $table.DataTable({
      "serverSide": true,
      "bFilter": false,
      "bInfo": false,
      "ordering": true,
      // "autoWidth": true,
      "order": [[0, "desc"]],
      "language": {
        search: ' ',
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
        const $table = $(settings.nTable).closest('.dataTables_wrapper');
        $table.find('.dataTables_paginate').appendTo('.proposal-append-table-boq-paginate');
        $table.find('.dataTables_length').appendTo('.proposal-append-table-boq-length');
      },
      ajax: {
        url: $('#proposal_append_boq_list').data('url'),
        type: "GET",
        data: function (d) {
          d.search = self.form.querySelector("#c_proposal_append_boq_list_search_input")?.value || "";
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
            const checked = self.selectedItem.some(obj => +obj.id === data);
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
    this.selectedItem = [];
    this.isDisableSubmit = true;
    this.form.innerHTML = "";
    this.loadingEl = null;
  }

  // ----------------------------------------------- TRIGER -----------------------------------------------
  async handleSubmit() {
    if (this.isDisableSubmit) return;
    this.showLoading();

    const errEl = document.querySelector("#proposal-append-boq-error");
    errEl.textContent = "";
    errEl.style.display = "none";

    if (!this.selectedItem.length) {
      const errEl = document.querySelector("#proposal-append-boq-error");
      errEl.textContent = "Required at least one BOQ selected!";
      errEl.style.display = "block";
      this.hideLoading()
      return;
    }

    let proposalId = null;
    const payload = {
      boq_ids: this.selectedItem.map(obj => obj.id)
    }

    try {
      if (PROPOSAL_ID) {
        proposalId = PROPOSAL_ID
      }
    } catch (error) { }

    try {
      const response = await fetch(`/boqs/replicate/${proposalId}`, {
        method: 'PATCH',
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
        body: JSON.stringify(payload)
      });

      const result = await response.json();

      if (response.ok && result.success) {
        $('#boq_list').DataTable().ajax.reload();
        showToast("success", response.message || 'BoQ(s) addeed successfully!');
        if (this.closeForm) this.closeForm.click();
        this.resetForm()
      } else {
        this.isDisableSubmit = false;
        showToast("error", `${result.errors?.boq_ids || result.message}`);
      }
    } catch (err) {
      this.isDisableSubmit = false;
      showToast("error", 'An error occurred while adding BoQ(s).');
    } finally {
      this.hideLoading()
    }
  }
}

// ----------------------------------------------- TRIGER -----------------------------------------------

document.addEventListener("DOMContentLoaded", () => {
  const PROPOSAL_APPEND_BOQ_CANVAS = document.querySelector("#c_proposal_append_boq_canvas");
  const PROPOSAL_APPEND_BOQ_FORM = PROPOSAL_APPEND_BOQ_CANVAS?.querySelector("form#c_proposal_append_boq_canvas_form")
    ? new AppendBoqForm("c_proposal_append_boq_canvas_form")
    : null;
  const PROPOSAL_APPEND_BOQ_CANVAS_BS = PROPOSAL_APPEND_BOQ_CANVAS ? new bootstrap.Offcanvas(PROPOSAL_APPEND_BOQ_CANVAS) : null;

  document.addEventListener("click", async e => {
    const target = e.target;

    if (target.matches("#c_append_boq_btn")) {
      if (PROPOSAL_APPEND_BOQ_CANVAS_BS && PROPOSAL_APPEND_BOQ_FORM && !IS_FETCHING) {
        PROPOSAL_APPEND_BOQ_CANVAS_BS.show();
        PROPOSAL_APPEND_BOQ_FORM.resetForm();

        await PROPOSAL_APPEND_BOQ_FORM.init();
      }
    }
  })
});