<?php $page = 'customers'; ?>
@extends('layout.mainlayout')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content">

        <div class="row">
            <div class="col-md-12">

                @component('components.breadcrumb')
                @slot('title')
                Customer Detail
                @endslot
                @slot('item1')
                123
                @endslot
                @slot('item2')
                customers
                @endslot
                @endcomponent

                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <h4 class="card-title mb-0" id="customer_name_title">Customer Detail</h4>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a href="{{ url('customers') }}" class="btn btn-secondary">
                                    <i class="ti ti-arrow-left me-2"></i>Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs nav-tabs-solid nav-justified" id="customerTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">
                                    <i class="ti ti-info-circle me-2"></i>Customer Info
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pics-tab" data-bs-toggle="tab" data-bs-target="#pics" type="button" role="tab">
                                    <i class="ti ti-users me-2"></i>PIC Management
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="customerTabContent">
                            <!-- Customer Info Tab -->
                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Customer Information</h5>
                                                <div class="card-actions">
                                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="editCustomerInfo()">
                                                        <i class="ti ti-edit me-1"></i>Edit
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="fw-bold">Customer Code</label>
                                                            <p id="customer_code_display">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="fw-bold">Customer Name</label>
                                                            <p id="customer_name_display">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="fw-bold">Contact Person</label>
                                                            <p id="contact_person_display">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="fw-bold">Phone</label>
                                                            <p id="phone_display">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="fw-bold">Email</label>
                                                            <p id="email_display">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="fw-bold">Status</label>
                                                            <p id="status_display">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="fw-bold">Address</label>
                                                            <p id="address_display">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="fw-bold">Bank Name</label>
                                                            <p id="bank_name_display">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="fw-bold">Bank Account Number</label>
                                                            <p id="bank_account_number_display">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="fw-bold">Bank Account Name</label>
                                                            <p id="bank_account_name_display">-</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="fw-bold">Notes</label>
                                                            <p id="notes_display">-</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- PIC Management Tab -->
                            <div class="tab-pane fade" id="pics" role="tabpanel">
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Person In Charge (PIC)</h5>
                                                <div class="card-actions">
                                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_pic">
                                                        <i class="ti ti-plus me-1"></i>Add PIC
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover" id="pics_table">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Position</th>
                                                                <th>Email</th>
                                                                <th>Phone</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="pics_tbody">
                                                            <!-- PIC data will be loaded here -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- /Page Wrapper -->

<!-- Add PIC Modal -->
<div class="modal custom-modal fade" id="add_pic" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New PIC</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_pic_form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Position</label>
                                <input type="text" class="form-control" name="position" placeholder="e.g. Manager, Director">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="select form-control" name="status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Notes</label>
                                <textarea class="form-control" name="notes" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Add PIC</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add PIC Modal -->

<!-- Edit PIC Modal -->
<div class="modal custom-modal fade" id="edit_pic" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit PIC</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_pic_form">
                    <input type="hidden" name="pic_id" id="edit_pic_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="edit_pic_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Position</label>
                                <input type="text" class="form-control" name="position" id="edit_pic_position">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="edit_pic_email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" id="edit_pic_phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="select form-control" name="status" id="edit_pic_status">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Notes</label>
                                <textarea class="form-control" name="notes" id="edit_pic_notes" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Update PIC</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit PIC Modal -->

<!-- Delete PIC Modal -->
<div class="modal fade" id="delete_pic" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <div class="avatar avatar-xl bg-danger-light rounded-circle mb-3">
                        <i class="ti ti-trash-x fs-36 text-danger"></i>
                    </div>
                    <h4 class="mb-2">Delete PIC?</h4>
                    <p class="mb-0">Are you sure you want to delete <br> this PIC?</p>
                    <div class="d-flex align-items-center justify-content-center mt-4">
                        <a href="javascript:void(0);" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</a>
                        <a href="javascript:void(0);" class="btn btn-danger" id="confirm_delete_pic">Yes, Delete it</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete PIC Modal -->

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let customerId = {{ request()->route('id') }};
    let selectedPicId = null;

    // Load customer data on page load
    loadCustomerData();
    loadPicsData();

    // Load customer data
    function loadCustomerData() {
        $.ajax({
            url: `/api/customers/${customerId}`,
            method: 'GET',
            success: function(response) {
                if(response.success) {
                    const customer = response.data;
                    displayCustomerInfo(customer);
                } else {
                    showAlert('error', 'Error loading customer data');
                }
            },
            error: function() {
                showAlert('error', 'Error loading customer data');
            }
        });
    }

    // Display customer info
    function displayCustomerInfo(customer) {
        $('#customer_name_title').text(customer.customer_name);
        $('#customer_code_display').text(customer.customer_code);
        $('#customer_name_display').text(customer.customer_name);
        $('#contact_person_display').text(customer.contact_person || '-');
        $('#phone_display').text(customer.phone || '-');
        $('#email_display').text(customer.email || '-');
        $('#status_display').html(`<span class="badge ${customer.status === 'active' ? 'bg-success' : 'bg-danger'}">${customer.status}</span>`);
        $('#address_display').text(customer.address || '-');
        $('#bank_name_display').text(customer.bank_name || '-');
        $('#bank_account_number_display').text(customer.bank_account_number || '-');
        $('#bank_account_name_display').text(customer.bank_account_name || '-');
        $('#notes_display').text(customer.notes || '-');
    }

    // Load PICs data
    function loadPicsData() {
        $.ajax({
            url: `/api/customers/${customerId}/pics`,
            method: 'GET',
            success: function(response) {
                if(response.success) {
                    renderPics(response.data);
                } else {
                    showAlert('error', 'Error loading PICs');
                }
            },
            error: function() {
                showAlert('error', 'Error loading PICs');
            }
        });
    }

    // Render PICs table
    function renderPics(pics) {
        let html = '';
        
        if (pics.length === 0) {
            html = '<tr><td colspan="6" class="text-center">No PICs found</td></tr>';
        } else {
            pics.forEach(function(pic) {
                const statusClass = pic.status === 'active' ? 'badge-pill badge-status bg-success' : 'badge-pill badge-status bg-danger';
                const statusText = pic.status === 'active' ? 'Active' : 'Inactive';
                
                html += `
                    <tr>
                        <td><strong>${pic.name}</strong></td>
                        <td>${pic.position || '-'}</td>
                        <td>${pic.email || '-'}</td>
                        <td>${pic.phone || '-'}</td>
                        <td><span class="badge ${statusClass}">${statusText}</span></td>
                        <td>
                            <div class="dropdown table-action">
                                <a href="#" class="action-icon" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" onclick="editPic(${pic.id})">
                                        <i class="ti ti-edit text-blue"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="#" onclick="deletePic(${pic.id})">
                                        <i class="ti ti-trash text-danger"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }
        
        $('#pics_tbody').html(html);
    }

    // Add PIC form submit
    $('#add_pic_form').submit(function(e) {
        e.preventDefault();
        
        $.ajax({
            url: `/api/customers/${customerId}/pics`,
            method: 'POST',
            data: $(this).serialize(),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            success: function(response) {
                if(response.success) {
                    $('#add_pic').modal('hide');
                    $('#add_pic_form')[0].reset();
                    showAlert('success', 'PIC added successfully');
                    loadPicsData();
                } else {
                    showAlert('error', response.message);
                }
            },
            error: function(xhr) {
                if(xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    for(let field in errors) {
                        errorMessage += errors[field][0] + '\n';
                    }
                    showAlert('error', errorMessage);
                } else {
                    showAlert('error', 'Error adding PIC: ' + xhr.statusText);
                }
            }
        });
    });

    // Edit PIC function
    window.editPic = function(picId) {
        $.ajax({
            url: `/api/customers/${customerId}/pics/${picId}`,
            method: 'GET',
            success: function(response) {
                if(response.success) {
                    const pic = response.data;
                    $('#edit_pic_id').val(pic.id);
                    $('#edit_pic_name').val(pic.name);
                    $('#edit_pic_position').val(pic.position);
                    $('#edit_pic_email').val(pic.email);
                    $('#edit_pic_phone').val(pic.phone);
                    $('#edit_pic_status').val(pic.status);
                    $('#edit_pic_notes').val(pic.notes);
                    $('#edit_pic').modal('show');
                }
            },
            error: function() {
                showAlert('error', 'Error loading PIC data');
            }
        });
    }

    // Edit PIC form submit
    $('#edit_pic_form').submit(function(e) {
        e.preventDefault();
        const picId = $('#edit_pic_id').val();
        
        $.ajax({
            url: `/api/customers/${customerId}/pics/${picId}`,
            method: 'PUT',
            data: $(this).serialize(),
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            success: function(response) {
                if(response.success) {
                    $('#edit_pic').modal('hide');
                    showAlert('success', 'PIC updated successfully');
                    loadPicsData();
                } else {
                    showAlert('error', response.message);
                }
            },
            error: function(xhr) {
                if(xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    for(let field in errors) {
                        errorMessage += errors[field][0] + '\n';
                    }
                    showAlert('error', errorMessage);
                } else {
                    showAlert('error', 'Error updating PIC: ' + xhr.statusText);
                }
            }
        });
    });

    // Delete PIC function
    window.deletePic = function(picId) {
        selectedPicId = picId;
        $('#delete_pic').modal('show');
    }

    // Confirm delete PIC
    $('#confirm_delete_pic').click(function() {
        if(selectedPicId) {
            $.ajax({
                url: `/api/customers/${customerId}/pics/${selectedPicId}`,
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                },
                success: function(response) {
                    if(response.success) {
                        $('#delete_pic').modal('hide');
                        showAlert('success', 'PIC deleted successfully');
                        loadPicsData();
                    } else {
                        showAlert('error', response.message);
                    }
                },
                error: function(xhr) {
                    showAlert('error', 'Error deleting PIC: ' + xhr.statusText);
                }
            });
        }
    });

    // Edit customer info function
    window.editCustomerInfo = function() {
        // Redirect to edit page or open edit modal
        window.location.href = `/customers/${customerId}/edit`;
    }

    // Show alert function
    function showAlert(type, message) {
        if(type === 'success') {
            alert('Success: ' + message);
        } else {
            alert('Error: ' + message);
        }
    }
});
</script>
@endpush 