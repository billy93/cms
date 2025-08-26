<?php $page = 'categories'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    @component('components.breadcrumb')
                        @slot('title')
                            Product Categories
                        @endslot
                        @slot('item1')
                            Products
                        @endslot
                        @slot('item2')
                            categories
                        @endslot
                    @endcomponent

                    <div class="card">
                        <div class="card-header">
                            <!-- Search -->
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <div class="icon-form mb-3 mb-sm-0">
                                        <span class="form-icon"><i class="ti ti-search"></i></span>
                                        <input type="text" class="form-control" id="search-categories" placeholder="Search Categories">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="d-flex align-items-center flex-wrap row-gap-2 justify-content-sm-end">
                                        <div class="dropdown me-2">
                                            <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown"><i class="ti ti-package-export me-2"></i>Export</a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-file-type-pdf text-danger me-1"></i>Export as PDF</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-file-type-xls text-green me-1"></i>Export as Excel</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_add_category"><i class="ti ti-square-rounded-plus me-2"></i>Add New Category</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Search -->
                        </div>

                        <div class="card-body">
                            <!-- Filter -->
                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2 mb-4">
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="dropdown me-2">
                                        <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown"><i class="ti ti-sort-ascending-2 me-2"></i>Sort</a>
                                        <div class="dropdown-menu dropdown-menu-start">
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item sort-option" data-sort="asc">
                                                        <i class="ti ti-circle-chevron-right me-1"></i>Ascending
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item sort-option" data-sort="desc">
                                                        <i class="ti ti-circle-chevron-right me-1"></i>Descending
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item sort-option" data-sort="recent">
                                                        <i class="ti ti-circle-chevron-right me-1"></i>Recently Added
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center flex-wrap row-gap-2">
                                    <div class="view-icons">
                                        <a href="javascript:void(0);" class="active"><i class="ti ti-list-tree"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Filter -->

                            <!-- Categories List -->
                            <div class="table-responsive custom-table">
                                <table class="table" id="categories-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <!-- <th class="no-sort">
                                                <label class="checkboxs"><input type="checkbox" id="select-all"><span class="checkmarks"></span></label>
                                            </th> -->
                                            <th>Name</th>
                                            <!-- <th>Products Count</th> -->
                                            <th>Created Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="categories-tbody">
                                        <!-- Categories will be loaded here via AJAX -->
                                    </tbody>
                                </table>
                            </div>
                            <!-- /Categories List -->

                            <!-- Pagination -->
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="datatable-length"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="datatable-paginate"></div>
                                </div>
                            </div>
                            <!-- /Pagination -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->

    @include('components.model-popup')
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let currentPage = 1;
    let searchTerm = '';
    let sortBy = 'created_at';
    let sortOrder = 'desc';

    function showAlert(type, message) {
        if(type === 'success') {
            alert('Success: ' + message);
        } else {
            alert('Error: ' + message);
        }
    }
        

    // Load categories
    function loadCategories() {
        $.ajax({
            url: '/api/categories/all',
            method: 'GET',
            data: {
                page: currentPage,
                search: searchTerm,
                sort_by: sortBy,
                sort_order: sortOrder
            },
            headers: {
                'Accept': 'application/json'
            },
            success: function(response) {
                if (response.success) {
                    renderCategories(response.data);
                    renderPagination(response.pagination);
                }
            },
            error: function(xhr) {
                console.error('Error loading categories:', xhr);
                showAlert('error', 'Failed to load categories');
            }
        });
    }

    // Render categories in table
    function renderCategories(categories) {
        let tbody = $('#categories-tbody');
        tbody.empty();

        if (categories.length === 0) {
            tbody.append(`
                <tr>
                    <td colspan="6" class="text-center">No categories found</td>
                </tr>
            `);
            return;
        }

        categories.forEach(function(category) {
            let row = `
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="ms-2">
                                <h6 class="fw-medium">${category.name}</h6>
                            </div>
                        </div>
                    </td>
                    <td>${new Date(category.created_at).toLocaleDateString()}</td>
                    <td>
                        <span class="badge bg-success">Active</span>
                    </td>
                    <td class="text-end">
                        <div class="dropdown table-action">
                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item edit-category" href="#" data-id="${category.id}">
                                    <i class="ti ti-edit me-2"></i>Edit
                                </a>
                                <a class="dropdown-item delete-category" href="#" data-id="${category.id}">
                                    <i class="ti ti-trash me-2"></i>Delete
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            `;
            tbody.append(row);
        });
    }

    // Render pagination
    function renderPagination(pagination) {
        let infoHtml = `Showing ${((pagination.current_page - 1) * pagination.per_page) + 1} to ${Math.min(pagination.current_page * pagination.per_page, pagination.total)} of ${pagination.total} entries`;
        $('.datatable-length').html(infoHtml);

        let linksHtml = '';
        if(pagination.last_page > 1) {
            linksHtml += '<ul class="pagination">';
            
            // Previous button
            if(pagination.current_page > 1) {
                linksHtml += `<li class="page-item"><a class="page-link" href="#" onclick="goToPage(${pagination.current_page - 1})">Previous</a></li>`;
            }

            // Page numbers
            for(let i = 1; i <= pagination.last_page; i++) {
                if(i === pagination.current_page) {
                    linksHtml += `<li class="page-item active"><a class="page-link" href="#">${i}</a></li>`;
                } else {
                    linksHtml += `<li class="page-item"><a class="page-link" href="#" onclick="goToPage(${i})">${i}</a></li>`;
                }
            }

            // Next button
            if(pagination.current_page < pagination.last_page) {
                linksHtml += `<li class="page-item"><a class="page-link" href="#" onclick="goToPage(${pagination.current_page + 1})">Next</a></li>`;
            }
            
            linksHtml += '</ul>';
        }
        $('.datatable-paginate').html(linksHtml);
    }

    // Go to page function
    window.goToPage = function(page) {
        currentPage = page;
        loadCategories();
    }

    // Search functionality
    $('#search-categories').on('keyup', function() {
        searchTerm = $(this).val();
        currentPage = 1;
        loadCategories();
    });

    // Sort functionality
    $('.sort-option').on('click', function(e) {
        e.preventDefault();
        let sort = $(this).data('sort');
        
        if (sort === 'asc') {
            sortBy = 'name';
            sortOrder = 'asc';
        } else if (sort === 'desc') {
            sortBy = 'name';
            sortOrder = 'desc';
        } else if (sort === 'recent') {
            sortBy = 'created_at';
            sortOrder = 'desc';
        }
        
        currentPage = 1;
        loadCategories();
    });

    // Add category form submission
    $(document).on('submit', '#add-category-form', function(e) {
        e.preventDefault();
        
        let formData = {
            name: $('#category_name').val()
        };

        $.ajax({
            url: '/api/categories/store',
            method: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            success: function(response) {
                if (response.success) {
                    //toastr.success(response.message);
                    showAlert('success', response.message);
                    $('#offcanvas_add_category').offcanvas('hide');
                    $('#add-category-form')[0].reset();
                    loadCategories();
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    Object.keys(errors).forEach(function(key) {
                        showAlert('error', errors[key][0]);
                    });
                } else {
                    showAlert('error', 'Failed to create category');
                }
            }
        });
    });

    // Edit category
    $(document).on('click', '.edit-category', function(e) {
        e.preventDefault();
        let categoryId = $(this).data('id');
        
        $.ajax({
            url: `/api/categories/show/${categoryId}`,
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            },
            success: function(response) {
                if (response.success) {
                    $('#edit_category_id').val(response.data.id);
                    $('#edit_category_name').val(response.data.name);
                    $('#offcanvas_edit_category').offcanvas('show');
                }
            },
            error: function(xhr) {
                showAlert('error', 'Failed to load category data');
            }
        });
    });

    // Update category form submission
    $(document).on('submit', '#edit-category-form', function(e) {
        e.preventDefault();
        
        let categoryId = $('#edit_category_id').val();
        let formData = {
            name: $('#edit_category_name').val()
        };

        $.ajax({
            url: `/api/categories/update/${categoryId}`,
            method: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    // toastr.success(response.message);
                    $('#offcanvas_edit_category').offcanvas('hide');
                    loadCategories();
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    Object.keys(errors).forEach(function(key) {
                        showAlert('error', errors[key][0]);
                    });
                } else {
                    showAlert('error', 'Failed to update category');
                }
            }
        });
    });

    // Delete category
    $(document).on('click', '.delete-category', function(e) {
        e.preventDefault();
        let categoryId = $(this).data('id');
        
        if (confirm('Are you sure you want to delete this category?')) {
            $.ajax({
                url: `/api/categories/delete/${categoryId}`,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                },
                success: function(response) {
                    if (response.success) {
                        showAlert('success', response.message);
                        loadCategories();
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        showAlert('error', xhr.responseJSON.message);
                    } else {
                        showAlert('error', 'Failed to delete category');
                    }
                }
            });
        }
    });

    // Select all functionality
    $('#select-all').on('change', function() {
        $('.category-checkbox').prop('checked', $(this).is(':checked'));
    });

    // Load categories on page load
    loadCategories();
});
</script>
@endpush