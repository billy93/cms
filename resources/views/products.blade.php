<?php $page = 'products'; ?>
@extends('layout.mainlayout')

@section('content')
<div class="page-wrapper">
    <div class="content">
        @component('components.breadcrumb')
            @slot('title') Products @endslot
            @slot('subtitle') Manage your products @endslot
            @slot('li_1') Dashboard @endslot
            @slot('li_2') Products @endslot
        @endcomponent

        <!-- Page Header -->
        <div class="page-header">
            <div class="add-item d-flex">
                <div class="page-title">
                    <h4>Product List</h4>
                    <h6>Manage your products</h6>
                </div>
            </div>
            <ul class="table-top-head">
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><i data-feather="file-text"></i></a>
                </li>
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><i data-feather="file"></i></a>
                </li>
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-feather="printer"></i></a>
                </li>
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh" onclick="loadProducts()"><i data-feather="rotate-ccw"></i></a>
                </li>
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i data-feather="chevron-up"></i></a>
                </li>
            </ul>
            <div class="page-btn">
                <a href="#" class="btn btn-added" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_add_product"><i data-feather="plus-circle" class="me-2"></i>Add New Product</a>
            </div>
        </div>
        <!-- /Page Header -->

        <div class="card table-list-card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-input">
                            <a href="" class="btn btn-searchset"><i data-feather="search"></i></a>
                        </div>
                    </div>
                    <div class="search-path">
                        <div class="d-flex align-items-center">
                            <a class="btn btn-filter" id="filter_search">
                                <i data-feather="filter"></i>
                                <span><i data-feather="x"></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="form-sort">
                        <i data-feather="sliders" class="info-img"></i>
                        <select class="select" id="sort-select">
                            <option value="name_asc">Sort by Name A-Z</option>
                            <option value="name_desc">Sort by Name Z-A</option>
                            <option value="created_desc">Sort by Newest</option>
                            <option value="created_asc">Sort by Oldest</option>
                        </select>
                    </div>
                </div>

                <!-- Filter -->
                <div class="card" id="filter_inputs" style="display: none;">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="input-blocks">
                                    <i data-feather="search" class="info-img"></i>
                                    <input type="text" placeholder="Search Product..." id="search-input">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="input-blocks">
                                    <select class="select" id="category-filter">
                                        <option value="">Choose Category</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="input-blocks">
                                    <select class="select" id="supplier-filter">
                                        <option value="">Choose Supplier</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="input-blocks">
                                    <a class="btn btn-filters ms-auto" id="apply-filters"> <i data-feather="search" class="me-2"></i> Search </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Filter -->

                <div class="table-responsive">
                    <table class="table datanew" id="products-table">
                        <thead>
                            <tr>
                                <th class="no-sort">
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all">
                                        <span class="checkmarks"></span>
                                    </label>
                                </th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Unit</th>
                                <th>Base Cost</th>
                                <th>Category</th>
                                <th>Supplier</th>
                                <th>Created Date</th>
                                <th class="no-sort">Action</th>
                            </tr>
                        </thead>
                        <tbody id="products-tbody">
                            <!-- Products will be loaded here via AJAX -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    <nav aria-label="Page navigation">
                        <ul class="pagination" id="pagination-container">
                            <!-- Pagination will be loaded here -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
$(document).ready(function() {
    let currentPage = 1;
    let currentSort = 'name_asc';
    let currentSearch = '';
    let currentCategoryFilter = '';
    let currentSupplierFilter = '';

    // Load initial data
    loadProducts();
    loadCategories();
    loadSuppliers();

    // Search functionality
    $('#search-input').on('keyup', debounce(function() {
        currentSearch = $(this).val();
        currentPage = 1;
        loadProducts();
    }, 300));

    // Sort functionality
    $('#sort-select').on('change', function() {
        currentSort = $(this).val();
        currentPage = 1;
        loadProducts();
    });

    // Filter functionality
    $('#apply-filters').on('click', function() {
        currentSearch = $('#search-input').val();
        currentCategoryFilter = $('#category-filter').val();
        currentSupplierFilter = $('#supplier-filter').val();
        currentPage = 1;
        loadProducts();
    });

    // Toggle filter
    $('#filter_search').on('click', function() {
        $('#filter_inputs').toggle();
    });

    // Select all checkbox
    $('#select-all').on('change', function() {
        $('.product-checkbox').prop('checked', $(this).prop('checked'));
    });

    // Reset form when offcanvas is hidden
    $('#offcanvas_add_product').on('hidden.bs.offcanvas', function () {
        $('#add-product-form')[0].reset();
    });

    $('#offcanvas_edit_product').on('hidden.bs.offcanvas', function () {
        $('#edit-product-form')[0].reset();
    });

    // Pagination click handler
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        if (page) {
            currentPage = page;
            loadProducts();
        }
    });

    // Add product form submission
    $('#add-product-form').on('submit', function(e) {
        e.preventDefault();
        
        let formData = {
            name: $('#product_name').val(),
            description: $('#product_description').val(),
            unit: 'pcs', // Default unit
            base_cost: $('#product_price').val(),
            category: $('#product_category_id').val(),
            supplier_id: $('#product_supplier_id').val(),
            sku: $('#product_sku').val(),
            stock_quantity: $('#product_stock_quantity').val(),
            is_active: $('#product_is_active').is(':checked') ? 1 : 0,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: '/api/products/store',
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#offcanvas_add_product').offcanvas('hide');
                    $('#add-product-form')[0].reset();
                    loadProducts();
                    toastr.success('Product added successfully!');
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                if (errors) {
                    let errorMessage = Object.values(errors).flat().join('\n');
                    toastr.error(errorMessage);
                }
            }
        });
    });

    // Edit product
    $(document).on('click', '.edit-product', function() {
        let productId = $(this).data('id');
        
        $.ajax({
            url: '/api/products/show/' + productId,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    let product = response.data;
                    $('#edit_product_id').val(product.id);
                    $('#edit_product_name').val(product.name);
                    $('#edit_product_description').val(product.description);
                    $('#edit_product_price').val(product.base_cost);
                    $('#edit_product_category_id').val(product.category);
                    $('#edit_product_supplier_id').val(product.supplier_id);
                    $('#edit_product_sku').val(product.sku);
                    $('#edit_product_stock_quantity').val(product.stock_quantity);
                    $('#edit_product_is_active').prop('checked', product.is_active == 1);
                    $('#offcanvas_edit_product').offcanvas('show');
                }
            }
        });
    });

    // Update product form submission
    $('#edit-product-form').on('submit', function(e) {
        e.preventDefault();
        
        let productId = $('#edit_product_id').val();
        let formData = {
            name: $('#edit_product_name').val(),
            description: $('#edit_product_description').val(),
            unit: 'pcs', // Default unit
            base_cost: $('#edit_product_price').val(),
            category: $('#edit_product_category_id').val(),
            supplier_id: $('#edit_product_supplier_id').val(),
            sku: $('#edit_product_sku').val(),
            stock_quantity: $('#edit_product_stock_quantity').val(),
            is_active: $('#edit_product_is_active').is(':checked') ? 1 : 0,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        $.ajax({
            url: '/api/products/update/' + productId,
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    $('#offcanvas_edit_product').offcanvas('hide');
                    loadProducts();
                    toastr.success('Product updated successfully!');
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                if (errors) {
                    let errorMessage = Object.values(errors).flat().join('\n');
                    toastr.error(errorMessage);
                }
            }
        });
    });

    // Delete product
    $(document).on('click', '.delete-product', function() {
        let productId = $(this).data('id');
        
        if (confirm('Are you sure you want to delete this product?')) {
            $.ajax({
                url: '/api/products/delete/' + productId,
                method: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        loadProducts();
                        toastr.success('Product deleted successfully!');
                    }
                },
                error: function(xhr) {
                    let message = xhr.responseJSON.message || 'Error deleting product';
                    toastr.error(message);
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
                sort: currentSort,
                search: currentSearch,
                category: currentCategoryFilter,
                supplier_id: currentSupplierFilter
            },
            success: function(response) {
                if (response.success) {
                    renderProducts(response.data);
                    renderPagination(response.pagination);
                }
            }
        });
    }

    // Load categories for filter
    function loadCategories() {
        let options = '<option value="">Choose Category</option>';
        options += '<option value="RAW_MATERIAL">Raw Material</option>';
        options += '<option value="FINISHED_GOODS">Finished Goods</option>';
        options += '<option value="SERVICE">Service</option>';
        $('#category-filter, #product_category_id, #edit_product_category_id').html(options);
    }

    // Load suppliers for filter
    function loadSuppliers() {
        $.ajax({
            url: '/api/suppliers/active',
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    let options = '<option value="">Choose Supplier</option>';
                    response.data.forEach(function(supplier) {
                        options += `<option value="${supplier.id}">${supplier.name}</option>`;
                    });
                    $('#supplier-filter, #product_supplier_id, #edit_product_supplier_id').html(options);
                }
            }
        });
    }

    // Render products table
    function renderProducts(products) {
        let html = '';
        
        if (products.length === 0) {
            html = '<tr><td colspan="9" class="text-center">No products found</td></tr>';
        } else {
            products.forEach(function(product) {
                html += `
                    <tr>
                        <td>
                            <label class="checkboxs">
                                <input type="checkbox" class="product-checkbox" value="${product.id}">
                                <span class="checkmarks"></span>
                            </label>
                        </td>
                        <td>${product.name}</td>
                        <td>${product.description || '-'}</td>
                        <td>${product.unit}</td>
                        <td>$${parseFloat(product.base_cost).toFixed(2)}</td>
                        <td><span class="badge badge-linesuccess">${product.category}</span></td>
                        <td>${product.supplier ? product.supplier.name : '-'}</td>
                        <td>${new Date(product.created_at).toLocaleDateString()}</td>
                        <td class="action-table-data">
                            <div class="edit-delete-action">
                                <a class="me-2 p-2 edit-product" href="#" data-id="${product.id}">
                                    <i data-feather="edit" class="feather-edit"></i>
                                </a>
                                <a class="confirm-text p-2 delete-product" href="#" data-id="${product.id}">
                                    <i data-feather="trash-2" class="feather-delete"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                `;
            });
        }
        
        $('#products-tbody').html(html);
        
        // Re-initialize feather icons for dynamically loaded content
        feather.replace();
    }

    // Render pagination
    function renderPagination(data) {
        let html = '';
        
        if (data.last_page > 1) {
            // Previous button
            if (data.current_page > 1) {
                html += `<li class="page-item"><a class="page-link" href="?page=${data.current_page - 1}">Previous</a></li>`;
            }
            
            // Page numbers
            for (let i = 1; i <= data.last_page; i++) {
                let activeClass = i === data.current_page ? 'active' : '';
                html += `<li class="page-item ${activeClass}"><a class="page-link" href="?page=${i}">${i}</a></li>`;
            }
            
            // Next button
            if (data.current_page < data.last_page) {
                html += `<li class="page-item"><a class="page-link" href="?page=${data.current_page + 1}">Next</a></li>`;
            }
        }
        
        $('#pagination-container').html(html);
    }

    // Utility functions
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Toast notifications are handled by toastr library
    
    // Initialize feather icons
    feather.replace();
});
</script>
@endpush