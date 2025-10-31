<?php $page = 'products'; ?>
@extends('layout.mainlayout')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content">

            <div class="row">
                <div class="col-md-12">

                    @component('components.breadcrumb')
                        @slot('title')
                            Products
                        @endslot
                        @slot('item1')
                            Products
                        @endslot
                        @slot('item2')
                            products
                        @endslot
                    @endcomponent

                    <div class="card">
                        <div class="card-header">
                            <!-- Search -->
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <div class="icon-form mb-3 mb-sm-0">
                                        <span class="form-icon"><i class="ti ti-search"></i></span>
                                        <input type="text" class="form-control" id="search-products" placeholder="Search Products">
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
                                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_add_product"><i class="ti ti-square-rounded-plus me-2"></i>Add New Product</a>
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

                            <!-- Products List -->
                            <div class="table-responsive custom-table">

                                <table class="table" id="products-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <!-- <th class="no-sort">
                                                <label class="checkboxs"><input type="checkbox" id="select-all"><span class="checkmarks"></span></label>
                                            </th> -->
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Unit</th>
                                            <th>Unit Price (IDR)</th>
                                            <th>Category</th>
                                            <th>Supplier</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="products-tbody">
                                        <!-- Products will be loaded here via AJAX -->
                                    </tbody>
                                </table>
                            </div>
                            <!-- /Products List -->

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
    let currentCategoryFilter = '';
    let currentSupplierFilter = '';

    function showAlert(type, message) {
        if(type === 'success') {
            alert('Success: ' + message);
        } else {
            alert('Error: ' + message);
        }
    }

    // Load initial data
    loadProducts();
    loadCategories();
    loadSuppliers();

    // Search functionality
    $('#search-products').on('keyup', function() {
        searchTerm = $(this).val();
        currentPage = 1;
        loadProducts();
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
        loadProducts();
    });

    // Filter functionality
    $('#category-filter').on('change', function() {
        currentCategoryFilter = $(this).val();
        currentPage = 1;
        loadProducts();
    });

    $('#supplier-filter').on('change', function() {
        currentSupplierFilter = $(this).val();
        currentPage = 1;
        loadProducts();
    });

    // Reset form when offcanvas is hidden
    $('#offcanvas_add_product').on('hidden.bs.offcanvas', function () {
        $('#add-product-form')[0].reset();
    });

    $('#offcanvas_edit_product').on('hidden.bs.offcanvas', function () {
        $('#edit-product-form')[0].reset();
    });

    // Add product form submission
    $(document).on('submit', '#add-product-form', function(e) {
        e.preventDefault();
        
        let formData = {
            name: $('#product_name').val(),
            description: $('#product_description').val(),
            unit: 'pcs', // Default unit
            base_cost: $('#product_price').val(),
            category_id: $('#product_category_id').val(),
            supplier_id: $('#product_supplier_id').val(),
            // sku: $('#product_sku').val(),
            stock_quantity: $('#product_stock_quantity').val(),
            // is_active: $('#product_is_active').is(':checked') ? 1 : 0
        };

        $.ajax({
            url: '/api/products/store',
            method: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    $('#offcanvas_add_product').offcanvas('hide');
                    $('#add-product-form')[0].reset();
                    loadProducts();
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    Object.keys(errors).forEach(function(key) {
                        showAlert('error', errors[key][0]);
                    });
                } else {
                    showAlert('error', 'Failed to create product');
                }
            }
        });
    });

    // Edit product
    $(document).on('click', '.edit-product', function(e) {
        e.preventDefault();
        let productId = $(this).data('id');
        
        $.ajax({
            url: `/api/products/show/${productId}`,
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            },
            success: function(response) {
                if (response.success) {
                    let product = response.data;
                    $('#edit_product_id').val(product.id);
                    $('#edit_product_name').val(product.name);
                    $('#edit_product_description').val(product.description);
                    $('#edit_product_price').val(product.base_cost);
                    $('#edit_product_category_id').val(product.category_id);
                    $('#edit_product_supplier_id').val(product.supplier_id);
                    // $('#edit_product_sku').val(product.sku);
                    $('#edit_product_stock_quantity').val(product.stock_quantity);
                    // $('#edit_product_is_active').prop('checked', product.is_active == 1);
                    $('#offcanvas_edit_product').offcanvas('show');
                }
            },
            error: function(xhr) {
                showAlert('error', 'Failed to load product data');
            }
        });
    });

    // Update product form submission
    $(document).on('submit', '#edit-product-form', function(e) {
        e.preventDefault();
        
        let productId = $('#edit_product_id').val();
        let formData = {
            name: $('#edit_product_name').val(),
            description: $('#edit_product_description').val(),
            unit: 'pcs', // Default unit
            base_cost: $('#edit_product_price').val(),
            category_id: $('#edit_product_category_id').val(),
            supplier_id: $('#edit_product_supplier_id').val(),
            // sku: $('#edit_product_sku').val(),
            stock_quantity: $('#edit_product_stock_quantity').val(),
            // is_active: $('#edit_product_is_active').is(':checked') ? 1 : 0
        };
        
        $.ajax({
            url: `/api/products/update/${productId}`,
            method: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            success: function(response) {
                if (response.success) {
                    showAlert('success', response.message);
                    $('#offcanvas_edit_product').offcanvas('hide');
                    loadProducts();
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    Object.keys(errors).forEach(function(key) {
                        showAlert('error', errors[key][0]);
                    });
                } else {
                    showAlert('error', 'Failed to update product');
                }
            }
        });
    });

    // Delete product
    $(document).on('click', '.delete-product', function(e) {
        e.preventDefault();
        let productId = $(this).data('id');
        
        if (confirm('Are you sure you want to delete this product?')) {
            $.ajax({
                url: `/api/products/delete/${productId}`,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                },
                success: function(response) {
                    if (response.success) {
                        showAlert('success', response.message);
                        loadProducts();
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        showAlert('error', xhr.responseJSON.message);
                    } else {
                        showAlert('error', 'Failed to delete product');
                    }
                }
            });
        }
    });

    // Load products function
    function loadProducts() {
        $.ajax({
            url: '/api/products/all',
            method: 'GET',
            data: {
                page: currentPage,
                search: searchTerm,
                sort_by: sortBy,
                sort_order: sortOrder,
                category_id: currentCategoryFilter,
                supplier_id: currentSupplierFilter
            },
            headers: {
                'Accept': 'application/json'
            },
            success: function(response) {
                if (response.success) {
                    renderProducts(response.data);
                    renderPagination(response.pagination);
                }
            },
            error: function(xhr) {
                console.error('Error loading products:', xhr);
                showAlert('error', 'Failed to load products');
            }
        });
    }

    // Load categories for filter
    function loadCategories() {
        $.ajax({
            url: '/api/products/categories',
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            },
            success: function(response) {
                if (response.success) {
                    let options = '<option value="">Choose Category</option>';
                    response.data.forEach(function(category) {
                        options += `<option value="${category.id}">${category.name}</option>`;
                    });
                    $('#category-filter, #product_category_id, #edit_product_category_id').html(options);
                }
            },
            error: function(xhr) {
                console.error('Error loading categories:', xhr);
            }
        });
    }

    // Load suppliers for filter
    function loadSuppliers() {
        $.ajax({
            url: '/api/suppliers/active/list',
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    let options = '<option value="">Choose Supplier</option>';
                    response.data.forEach(function(supplier) {
                        options += `<option value="${supplier.id}">${supplier.supplier_name}</option>`;
                    });
                    $('#supplier-filter, #product_supplier_id, #edit_product_supplier_id').html(options);
                }
            },
            error: function(xhr) {
                console.error('Error loading suppliers:', xhr);
            }
        });
    }

    // Render products in table
    function renderProducts(products) {
        let tbody = $('#products-tbody');
        tbody.empty();

        if (products.length === 0) {
            tbody.append(`
                <tr>
                    <td colspan="8" class="text-center">No products found</td>
                </tr>
            `);
            return;
        }

        products.forEach(function(product) {
            let row = `
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="ms-2">
                                <h6 class="fw-medium">${product.name}</h6>
                            </div>
                        </div>
                    </td>
                    <td>${product.description || '-'}</td>
                    <td>${product.unit}</td>
                <!--    <td>$${parseFloat(product.base_cost).toFixed(2)}</td> -->
                <td>${parseFloat(product.base_cost).toLocaleString('en-US', { minimumFractionDigits: 0 })}</td>

                    <td><span class="badge bg-light text-dark">${product.category ? product.category.name : '-'}</span></td>
                    <td>${product.supplier ? product.supplier.supplier_name : '-'}</td>
                 <!--   <td>${new Date(product.created_at).toLocaleDateString()}</td> --> 
                 <td>${formatDate(product.created_at)}</td>
                    <td class="text-end">
                        <div class="dropdown table-action">
                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item edit-product" href="#" data-id="${product.id}">
                                    <i class="ti ti-edit me-2"></i>Edit
                                </a>
                                <a class="dropdown-item delete-product" href="#" data-id="${product.id}">
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
        loadProducts();
    }

    // Select all functionality
    $('#select-all').on('change', function() {
        $('.product-checkbox').prop('checked', $(this).is(':checked'));
    });

    // Load data on page load
    loadCategories();
    loadSuppliers();
    loadProducts();

    // Format date function
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
    }
});
</script>
@endpush