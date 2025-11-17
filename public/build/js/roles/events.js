class RoleForm {
  isInit = true;
  selectedPermissions = [];
  selectedMenus = [];
  mode = "create";
  data = {};
  errors = {};

  constructor (formId) {
    this.form = document.getElementById(formId);
    this.dataTablePermissionUrl = document.getElementById('permission-route').dataset.url;
    this.dataTableMenuUrl = document.getElementById('menu-route').dataset.url;
    this.closeForm = document.getElementById("close_role_form");
    this.initDataTablePermission = this.initDataTablePermission.bind(this);
    this.initDataTableMenu = this.initDataTableMenu.bind(this);
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

  handleDocumentSubmit(e) {
    const target = e.target;

    if (target.matches("#c_role_canvas_permission_list_search_form")) {
      e.preventDefault();
      e.stopPropagation();
      this.initDataTablePermission(true);
    } else if (target.matches("#c_role_canvas_menu_list_search_form")) {
      e.preventDefault();
      e.stopPropagation();
      this.initDataTableMenu(true);
    }
  }

  async handleDocumentChange(e) {
    const target = e.target;

    if (target.matches("#role_canvas_permission_list #select_all_role_canvas_permission")) {
      const checked = target.checked;

      document.querySelectorAll('#role_canvas_permission_list input.row-check').forEach(el => {
        el.checked = checked;

        if (checked) {
          this.selectedPermissions.push({
            id: +el.value,
            route: el.dataset.route
          });
        } else {
          this.selectedPermissions = this.selectedPermissions.filter(obj => obj.id !== +el.value);
        }
      });

      const unique = new Map(this.selectedPermissions.map(item => [item.id, item]));
      this.selectedPermissions = Array.from(unique.values());
      this.updateSelectedEl();
    } else if (target.matches("#role_canvas_permission_list input.row-check")) {
      const checked = target.checked;

      if (!checked) {
        document.querySelector("#role_canvas_permission_list #select_all_role_canvas_permission").checked = false;
        this.selectedPermissions = this.selectedPermissions.filter(obj => obj.id !== +target.value)
      } else {
        this.selectedPermissions.push({
          id: +target.value,
          route: target.dataset.route
        });
      }

      const unique = new Map(this.selectedPermissions.map(item => [item.id, item]));
      this.selectedPermissions = Array.from(unique.values());
      this.updateSelectedEl();
    } else if (target.matches("#role_canvas_menu_list #select_all_role_canvas_menu")) {
      const checked = target.checked;

      document.querySelectorAll('#role_canvas_menu_list input.row-check').forEach(el => {
        el.checked = checked;

        if (checked) {
          this.selectedMenus.push({
            id: +el.value,
            name: el.dataset.name
          });
        } else {
          this.selectedMenus = this.selectedMenus.filter(obj => obj.id !== +el.value);
        }
      });

      const unique = new Map(this.selectedMenus.map(item => [item.id, item]));
      this.selectedMenus = Array.from(unique.values());
      this.updateSelectedEl();
    } else if (target.matches("#role_canvas_menu_list input.row-check")) {
      const checked = target.checked;

      if (!checked) {
        document.querySelector("#role_canvas_menu_list #select_all_role_canvas_menu").checked = false;
        this.selectedMenus = this.selectedMenus.filter(obj => obj.id !== +target.value)
      } else {
        this.selectedMenus.push({
          id: +target.value,
          name: target.dataset.name
        });
      }

      const unique = new Map(this.selectedMenus.map(item => [item.id, item]));
      this.selectedMenus = Array.from(unique.values());
      this.updateSelectedEl();
    }
  }

  // ---------------------------------------- INIT ----------------------------------------
  async init(mode = "create", data = {}) {
    this.resetForm();
    this.showLoading();
    this.data = data;
    this.mode = mode;

    const formWrapper = document.createElement("div");
    formWrapper.id = "role_form_wrapper";
    formWrapper.innerHTML = this.createForm();
    this.form.appendChild(formWrapper);
    this.initDataTablePermission();
    this.initDataTableMenu();
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
      this.selectedPermissions = this.data.permissions?.map(obj => {
        return {
          id: obj.id,
          route: obj.route
        }
      }) || [];
      this.selectedMenus = this.data.menus?.map(obj => {
        return {
          id: obj.id,
          name: obj.name
        }
      }) || [];
    }

    let selectedPermissionEl = "<li class='no-selected-tag'>No Selected Permission(s)</li>";
    let selectedMenuEl = "<li class='no-selected-tag'>No Selected Menu(s)</li>";

    if (this.selectedPermissions.length) {
      selectedPermissionEl = this.selectedPermissions
        .map(obj => `<li class="selected-tag">${obj.route}</li>`)
        .join("");
    }

    if (this.selectedMenus.length) {
      selectedMenuEl = this.selectedMenus
        .map(obj => `<li class="selected-tag">${obj.name}</li>`)
        .join("");
    }

    return `
      <div>
        <div class="row">
          <div class="col-md-12">
            <div class="mb-3">
              <label class="col-form-label">Name<span class="text-danger">*</span></label>
              <input type="text" id="input_role_name" class="form-control" value="${value.name}">
              <small id="input_role_name_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-12">
            <div class="mb-3">
              <label class="col-form-label">Description</label>
              <textarea class="form-control" id="input_role_description">${value.description}</textarea>
              <small id="input_role_description_error" class="text-danger mt-1" style="display: none;"></small>
            </div>
          </div>
          <div class="col-md-12">
            <div>
              <label class="col-form-label">Permission(s)</label>
              <ul id="selected_role_canvas_permission" class="mt-2">
                ${selectedPermissionEl}
              </ul>
            </div>
            <div class="col-md-12 mb-2 mt-2 pt-2" style="border-top: 1px solid var(--bs-border-color);">
              <form class="icon-form mb-3 mb-sm-0" id="c_role_canvas_permission_list_search_form">
                <span class="form-icon" style="z-index: 0;"><i class="ti ti-search"></i></span>
                <input type="text" class="form-control" placeholder="Search Permission" id="c_role_canvas_permission_list_search_input">
              </form>							
            </div>	
            <div class="table-responsive custom-table" style="border: 1px solid #e8e8e8; border-radius: 6px;">
              <table class="table" id="role_canvas_permission_list" data-url="${this.dataTablePermissionUrl}">
                <style>
                  #role_canvas_permission_list tr > th, 
                  #role_canvas_permission_list tr > td {
                    padding: 12px 30px;
                  } 
                  #role_canvas_permission_list tr > th:first-child, 
                  #role_canvas_permission_list tr > td:first-child {
                    left: 0;
                    padding: 12px;
                  }
                  #role_canvas_permission_list th:nth-child(2), 
                  #role_canvas_permission_list td:nth-child(2) {
                    padding-left: 0;
                  } 
                  #selected_role_canvas_permission {
                    display: flex;  
                    flex-wrap: wrap;
                    list-style: none;
                    gap: 6px; 
                  }
                  #selected_role_canvas_permission .selected-tag {
                    padding: 2px 6px;
                    border-radius: 5px;
                    background: #aaa;
                    color: #fff;
                    font-size: 12px;
                  }
                  #selected_role_canvas_permission .no-selected-tag {
                    text-align: center;
                    flex-grow: 1;
                    padding: 2px 6px;  
                    color: #6f6f6f;
                    font-size: 12px;
                  }
                </style>
                <thead class="thead-light">
                  <tr>
                    <th class="td-break no-sort fit" style="position: sticky; z-index: 1;">
                      <label class="checkboxs">
                        <input type="checkbox" id="select_all_role_canvas_permission">
                        <span class="checkmarks"></span>
                      </label>
                    </th>
                    <th>Route Name</th>
                    <th>Method</th>
                    <th>Path</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
            <div class="row align-items-center" style="row-gap: 1em; padding: 10px 15px;">
              <div class="col-md-6">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                  <div class="datatable-info"></div>
                  <div class="role-canvas-table-permission-length"></div>
                </div>
              </div>
              <div class="col-md-6 flex-grow-1">
                <div class="role-canvas-table-permission-paginate"></div>
              </div>
            </div>
          </div>
          <div class="col-md-12 mt-3 pt-3">
            <div class="mt-3 pt-3" style="border-top: 1px solid var(--bs-border-color);">
              <label class="col-form-label">Menu(s)</label>
              <ul id="selected_role_canvas_menu" class="mt-2">
                ${selectedMenuEl}
              </ul>
            </div>
            <div class="col-md-12 mb-2 mt-2 pt-2" style="border-top: 1px solid var(--bs-border-color);">
              <form class="icon-form mb-3 mb-sm-0" id="c_role_canvas_menu_list_search_form">
                <span class="form-icon" style="z-index: 0;"><i class="ti ti-search"></i></span>
                <input type="text" class="form-control" placeholder="Search Menu" id="c_role_canvas_menu_list_search_input">
              </form>							
            </div>	
            <div class="table-responsive custom-table" style="border: 1px solid #e8e8e8; border-radius: 6px;">
              <table class="table" id="role_canvas_menu_list" data-url="${this.dataTableMenuUrl}">
                <style>
                  #role_canvas_menu_list tr > th, 
                  #role_canvas_menu_list tr > td {
                    padding: 12px 30px;
                  } 
                  #role_canvas_menu_list tr > th:first-child, 
                  #role_canvas_menu_list tr > td:first-child {
                    left: 0;
                    padding: 12px;
                  }
                  #role_canvas_menu_list th:nth-child(2), 
                  #role_canvas_menu_list td:nth-child(2) {
                    padding-left: 0;
                  } 
                  #selected_role_canvas_menu {
                    display: flex;  
                    flex-wrap: wrap;
                    list-style: none;
                    gap: 6px; 
                  }
                  #selected_role_canvas_menu .selected-tag {
                    padding: 2px 6px;
                    border-radius: 5px;
                    background: #aaa;
                    color: #fff;
                    font-size: 12px;
                  }
                  #selected_role_canvas_menu .no-selected-tag {
                    text-align: center;
                    flex-grow: 1;
                    padding: 2px 6px;  
                    color: #6f6f6f;
                    font-size: 12px;
                  }
                </style>
                <thead class="thead-light">
                  <tr>
                    <th class="td-break no-sort fit" style="position: sticky; z-index: 1;">
                      <label class="checkboxs">
                        <input type="checkbox" id="select_all_role_canvas_menu">
                        <span class="checkmarks"></span>
                      </label>
                    </th>
                    <th>Name</th>
                    <th>Route Name</th>
                    <th>Method</th>
                    <th>Path</th>
                    <th>Order Index</th>
                    <th>Visibility</th>
                    <th>Icon</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
            <div class="row align-items-center" style="row-gap: 1em; padding: 10px 15px;">
              <div class="col-md-6">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                  <div class="datatable-info"></div>
                  <div class="role-canvas-table-menu-length"></div>
                </div>
              </div>
              <div class="col-md-6 flex-grow-1">
                <div class="role-canvas-table-menu-paginate"></div>
              </div>
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


  updateSelectedEl() {
    const el1 = this.form.querySelector("#selected_role_canvas_permission");
    const el2 = this.form.querySelector("#selected_role_canvas_menu");
    if (el1) {
      if (this.selectedPermissions.length) {
        el1.innerHTML = this.selectedPermissions
          .map(obj => `<li class="selected-tag">${obj.route}</li>`)
          .join("");
      } else {
        el1.innerHTML = `<li class="no-selected-tag">No Selected Permission(s)</li>`;
      }
    }
    if (el2) {
      if (this.selectedMenus.length) {
        el2.innerHTML = this.selectedMenus
          .map(obj => `<li class="selected-tag">${obj.name}</li>`)
          .join("");
      } else {
        el2.innerHTML = `<li class="no-selected-tag">No Selected Menu(s)</li>`;
      }
    }
  }

  initDataTablePermission(resetPage = false) {
    const self = this;
    const $table = $('#role_canvas_permission_list');

    if ($.fn.DataTable.isDataTable($table)) {
      $table.DataTable().ajax.reload(null, resetPage); // false = jangan reset pagination
      return;
    }

    const dt = $table.DataTable({
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
        $table.find('.dataTables_paginate').appendTo('.role-canvas-table-permission-paginate');
        $table.find('.dataTables_length').appendTo('.role-canvas-table-permission-length');
      },
      ajax: {
        url: $('#role_canvas_permission_list').data('url'),
        type: "GET",
        data: function (d) {
          d.search = self.form.querySelector("#c_role_canvas_permission_list_search_input")?.value || "";
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
            const checked = self.selectedPermissions.some(obj => +obj.id === data);
            return `
							<label class="checkboxs">
								<input type="checkbox" class="row-check" ${checked ? "checked" : ""} value="${data}" data-route="${row.route}">
								<span class="checkmarks"></span>
							</label>
						`;
          }
        },
        { data: 'route' },
        {
          data: 'method',
          render: function (data, type) {
            if (type === 'display') {
              switch (data.toLowerCase()) {
                case 'post':
                case 'put':
                case 'patch':
                  return `<span class="badge badge-status bg-secondary">${data}</span>`;
                case 'get': return `<span class="badge badge-status bg-success">${data}</span>`;
                case 'delete': return `<span class="badge badge-status bg-danger">${data}</span>`;
                default: return '<span class="badge badge-status bg-dark">Invalid</span>';
              }
            }
            return data;
          }
        },
        { data: 'path' },
      ],
      columnDefs: [
        {
          targets: 0, // kolom pertama
          createdCell: function (td, cellData, rowData, row, col) {
            $(td).css({
              position: 'sticky',
              zIndex: 1,
              backgroundColor: '#fff'
            });
          }
        },
      ]
    });

    dt.on('draw.dt', () => {
      const pageRows = document.querySelectorAll('#role_canvas_permission_list input.row-check');
      const selectAllBtn = document.querySelector("#select_all_role_canvas_permission");

      if (selectAllBtn) {
        if ([...pageRows].every(el => el.checked)) {
          selectAllBtn.checked = true;
        } else {
          selectAllBtn.checked = false;
        }
      }

      ([...pageRows]).forEach(el => {
        if (this.selectedPermissions.find(obj => obj.id === +el.value)) {
          el.checked = true;
        } else {
          el.checked = false;
        }
      });
    });
  }


  initDataTableMenu(resetPage = false) {
    const self = this;
    const $table = $('#role_canvas_menu_list');

    if ($.fn.DataTable.isDataTable($table)) {
      $table.DataTable().ajax.reload(null, resetPage); // false = jangan reset pagination
      return;
    }

    const dt = $table.DataTable({
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
        $table.find('.dataTables_paginate').appendTo('.role-canvas-table-menu-paginate');
        $table.find('.dataTables_length').appendTo('.role-canvas-table-menu-length');
      },
      ajax: {
        url: $('#role_canvas_menu_list').data('url'),
        type: "GET",
        data: function (d) {
          d.search = self.form.querySelector("#c_role_canvas_menu_list_search_input")?.value || "";
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
            const checked = self.selectedMenus.some(obj => +obj.id === data);
            return `
							<label class="checkboxs">
								<input type="checkbox" class="row-check" ${checked ? "checked" : ""} value="${data}" data-name="${row.name}">
								<span class="checkmarks"></span>
							</label>
						`;
          }
        },
        { data: 'name' },
        { data: 'route' },
        {
          data: 'method',
          render: function (data, type) {
            if (type === 'display') {
              switch (data.toLowerCase()) {
                case 'post':
                case 'put':
                case 'patch':
                  return `<span class="badge badge-status bg-secondary">${data}</span>`;
                case 'get': return `<span class="badge badge-status bg-success">${data}</span>`;
                case 'delete': return `<span class="badge badge-status bg-danger">${data}</span>`;
                default: return '<span class="badge badge-status bg-dark">Invalid</span>';
              }
            }
            return data;
          }
        },
        { data: 'path' },
        { data: 'order_index' },
        {
          data: 'is_visible',
          render: function (data, type) {
            if (type == "display") {
              return data ? 'ON' : 'OFF';
            }
            return data
          }
        },
        {
          data: 'icon',
          render: function (data, type) {
            return type === 'display' ? data ? `<div class="btn btn-sm btn-outline-info"><i class="${data}"></i></div>` : "" : data;
          }
        },
      ],
      columnDefs: [
        {
          targets: 0, // kolom pertama
          createdCell: function (td, cellData, rowData, row, col) {
            $(td).css({
              position: 'sticky',
              zIndex: 1,
              backgroundColor: '#fff'
            });
          }
        },
      ]
    });

    dt.on('draw.dt', () => {
      const pageRows = document.querySelectorAll('#role_canvas_menu_list input.row-check');
      const selectAllBtn = document.querySelector("#select_all_role_canvas_menu");

      if (selectAllBtn) {
        if ([...pageRows].every(el => el.checked)) {
          selectAllBtn.checked = true;
        } else {
          selectAllBtn.checked = false;
        }
      }

      ([...pageRows]).forEach(el => {
        if (this.selectedMenus.find(obj => obj.id === +el.value)) {
          el.checked = true;
        } else {
          el.checked = false;
        }
      });
    });
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
    this.selectedPermissions = [];
    this.selectedMenus = [];
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

    const payload = {
      permission_ids: this.selectedPermissions.map(obj => obj.id),
      menu_ids: this.selectedMenus.map(obj => obj.id)
    };

    const inputs = [
      {
        field: "input_role_name",
        required: true,
        message: "Name is required."
      },
      {
        field: "input_role_description",
        required: false,
        message: "Description is required."
      },
    ];

    inputs.forEach(id => {
      const el = this.form.querySelector("#" + id.field);
      let value = el ? el.value.trim() : "";

      payload[id.field.replace("input_role_", "")] = value;

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
        const response = await fetch('/roles', {
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
          showToast("success", response.message || 'Role created successfully!');
          $('#role_list').DataTable().ajax.reload();
          if (this.closeForm) this.closeForm.click();
          this.resetForm()
        } else {
          showToast("error", result.message || result.errors);
        }
      } catch (err) {
        showToast("error", 'An error occurred while creating Role.');
      } finally {
        this.isFetching = false;
        this.hideLoading()
      }
    } else if (this.mode === "edit") {
      try {
        const response = await fetch(`/roles/${this.data.id}`, {
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
          showToast("success", response.message || 'Role updated successfully!');
          $('#role_list').DataTable().ajax.reload(null, false);
          if (this.closeForm) this.closeForm.click();
          this.resetForm();
        } else {
          showToast("error", result.message || result.errors);
        }
      } catch (err) {
        showToast("error", 'An error occurred while updating Role.');
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
  const ROLE_CANVAS = document.querySelector("#c_role_canvas");
  const ROLE_MODAL = document.querySelector("#c_role_modal");
  const ROLE_FORM = ROLE_CANVAS?.querySelector("form#c_role_canvas_form")
    ? new RoleForm("c_role_canvas_form")
    : null;
  const ROLE_CANVAS_BS = ROLE_CANVAS ? new bootstrap.Offcanvas(ROLE_CANVAS) : null;
  const ROLE_MODAL_BS = ROLE_MODAL ? new bootstrap.Modal(ROLE_MODAL) : null;

  document.addEventListener("click", async e => {
    let target = e.target;

    // CREATE
    if (target.matches("#c_role_create_btn")) {
      e.preventDefault();
      if (ROLE_CANVAS_BS && ROLE_FORM && !IS_FETCHING) {
        const title = ROLE_CANVAS.querySelector("#c_role_canvas_title");
        title.textContent = "Create Role";
        ROLE_CANVAS_BS.show();
        ROLE_FORM.resetForm();
        await ROLE_FORM.init("create");
      }
    }

    // EDIT
    if (target.closest(".c_role_edit_btn")) {
      target = target.closest(".c_role_edit_btn");
      e.preventDefault();
      if (!ROLE_CANVAS_BS || !ROLE_FORM || IS_FETCHING) return;
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
          const title = ROLE_CANVAS.querySelector("#c_role_canvas_title");
          title.textContent = "Edit Role";
          ROLE_CANVAS_BS.show();
          ROLE_FORM.resetForm();
          await ROLE_FORM.init("edit", resJson.data);
        } else {
          showToast("error", resJson.message || "Failed to fetch role data for editing.");
        }
      } catch (error) {
        showToast("error", 'An error occurred while fetching the role data for editing.');
      } finally {
        IS_FETCHING = false;
      }
    }

    // DELETE
    else if (target.closest(".c_role_delete_btn")) {
      target = target.closest(".c_role_delete_btn");
      e.preventDefault();
      if (!ROLE_MODAL_BS || IS_FETCHING) return;
      const url = target.dataset.url;
      const confirmBtn = ROLE_MODAL.querySelector("#c_role_modal_confirm_btn");
      confirmBtn.dataset.url = url;
      ROLE_MODAL_BS.show();
    }

    // CONFIRM DELETE 
    else if (target.matches("#c_role_modal_confirm_btn")) {
      e.preventDefault();
      if (!ROLE_CANVAS_BS || !ROLE_FORM || IS_FETCHING) return;
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
          $('#role_list').DataTable().ajax.reload(null, false);
          showToast("success", resJson.message || "Role deleted successfully.");
          ROLE_MODAL_BS.hide();
        } else {
          showToast("error", resJson.message || "Failed to delete role.");
        }
      } catch (error) {
        showToast("error", "An error occurred while deleting the role.");
      } finally {
        IS_FETCHING = false;
      }
    }
  })
});