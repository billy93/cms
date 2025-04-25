@if (Route::is([
        'horizontal-timeline',
        'ui-accordion',
        'ui-alerts',
        'ui-avatar',
        'ui-badges',
        'ui-borders',
        'ui-breadcrumb',
        'ui-buttons',
        'ui-buttons-group',
        'ui-cards',
        'ui-carousel',
        'ui-colors',
        'ui-grid',
        'ui-images',
        'ui-lightbox',
        'ui-media',
        'ui-modals',
        'ui-nav-tabs',
        'ui-notification',
        'ui-offcanvas',
        'ui-pagination',
        'ui-placeholders',
        'ui-popovers',
        'ui-progress',
        'ui-toasts',
        'ui-typography',
        'ui-video',
        'ui-dropdowns',
    ]))
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-title">
            <h4>{{ $title }}</h4>
        </div>
    </div>
    <!-- /Page Header -->
@endif
@if (Route::is([
        'chart-apex',
        'chart-c3',
        'chart-flot',
        'chart-js',
        'chart-morris',
        'chart-peity',
        'icon-feather',
        'icon-flag',
        'icon-fontawesome',
        'icon-ionic',
        'icon-material',
        'icon-pe7',
        'icon-simpleline',
        'icon-themify',
        'icon-typicon',
        'icon-weather',
        'ui-counter',
        'ui-clipboard',
        'ui-drag-drop',
        'ui-rangeslider',
        'ui-rating',
        'ui-ribbon',
        'ui-scrollbar',
        'ui-spinner',
        'ui-stickynote',
        'ui-sweetalerts',
        'ui-text-editor',
        'ui-timeline',
        'ui-tooltips',
        'form-basic-inputs',
        'form-checkbox-radios',
        'form-fileupload',
        'form-floating-labels',
        'form-grid-gutters',
        'form-horizontal',
        'form-input-groups',
        'form-mask',
        'form-select',
        'form-select2',
        'form-validation',
        'form-vertical',
        'form-wizard',
        'data-tables',
    ]))
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">{{ $title }}</h3>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
@endif

@if (Route::is([
        'contacts',
        'activities',
        'activity-mail',
        'analytics',
        'activity-calls',
        'activity-meeting',
        'activity-task',
        'appearance',
        'ban-ip-address',
        'calls',
        'campaign-archieve',
        'campaign-complete',
        'campaign',
        'cities',
        'companies-grid',
        'companies',
        'company-details',
        'company-reports',
        'company-settings',
        'connected-apps',
        'contact-details',
        'contact-grid',
        'contact-messages',
        'contact-reports',
        'contact-messages',
        'deals-details',
        'deals-kanban',
        'contact-stage',
        'countries',
        'currencies',
        'custom-fields',
        'deal-reports',
        'deals',
        'delete-request',
        'email-settings',
        'faq',
        'gdpr-cookies',
        'industry',
        'invoice-settings',
        'lead-reports',
        'leads-details',
        'leads-kanban',
        'notifications',
        'pages-list',
        'preference',
        'prefixes',
        'printers',
        'profile',
        'project-details',
        'project-grid',
        'project-reports',
        'projects',
        'tickets',
        'testimonials',
        'tax-rates',
        'tasks',
        'tasks-important',
        'tasks-completed',
        'task-reports',
        'storage',
        'states',
        'sources',
        'sms-gateways',
        'security',
        'roles-permissions',
        'proposals-grid',
        'contracts-grid',
        'estimations-kanban',
        'proposals',
        'contracts',
        'estimations',
        'invoices',
        'payments',
    ]))
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-8">
                @if (
                    !Route::is([
                        'analytics',
                        'appearance',
                        'ban-ip-address',
                        'cities',
                        'company-details',
                        'company-settings',
                        'connected-apps',
                        'deals-details',
                        'countries',
                        'currencies',
                        'custom-fields',
                        'email-settings',
                        'faq',
                        'gdpr-cookies',
                        'invoice-settings',
                        'leads-details',
                        'leads-kanban',
                        'notifications',
                        'preference',
                        'prefixes',
                        'printers',
                        'profile',
                        'project-details',
                      
                        'testimonials',
                        'tax-rates',
                        'storage',
                        'states',
                        'sms-gateways',
                        'security',
                        'roles-permissions',
                    ]))
                    <h4 class="page-title">{{ $title }} <span class="count-title">{{ $item1 }}</span></h4>
                @endif
                @if (Route::is([
                        'analytics',
                        'appearance',
                        'ban-ip-address',
                        'cities',
                        'company-details',
                        'company-settings',
                        'connected-apps',
                        'deals-details',
                        'countries',
                        'currencies',
                        'custom-fields',
                        'email-settings',
                        'faq',
                        'gdpr-cookies',
                        'invoice-settings',
                        'leads-details',
                        'leads-kanban',
                        'notifications',
                        'preference',
                        'prefixes',
                        'printers',
                        'profile',
                        'project-details',
                       
                        'testimonials',
                        'tax-rates',
                        'storage',
                        'states',
                        'sms-gateways',
                        'security',
                        'roles-permissions',
                    ]))
                    <h4 class="page-title">{{ $title }}</h4>
                @endif
            </div>
            <div class="col-4 text-end">
                <div class="head-icons">
                    <a href="{{ $item2 }}" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-original-title="Refresh"><i class="ti ti-refresh-dot"></i></a>
                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-original-title="Collapse" id="collapse-header"><i class="ti ti-chevrons-up"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
@endif

@if(Route::is(['deals-dashboard','leads-dashboard','project-dashboard']))
<div class="page-header">
    <div class="row align-items-center ">
        <div class="col-md-4">
            <h3 class="page-title">{{$title}}</h3>
        </div>
        <div class="col-md-8 float-end ms-auto">
            <div class="d-flex title-head">
                <div class="daterange-picker d-flex align-items-center justify-content-center">
                    <div class="form-sort me-2">
                        <i class="ti ti-calendar"></i>
                        <input type="text" class="form-control  date-range bookingrange">
                    </div>	
                    <div class="head-icons mb-0">
                        <a href="{{$item1}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Refresh"><i class="ti ti-refresh-dot"></i></a>
                        <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Collapse" id="collapse-header"><i class="ti ti-chevrons-up"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif