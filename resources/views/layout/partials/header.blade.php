<!-- Header -->
<div class="header">

    <!-- Logo -->
    <div class="header-left active">
        <a href="{{url('index')}}" class="logo logo-normal">
            <img src="{{ URL::asset('build/img/logo.svg') }}" alt="Logo">
            <img src="{{ URL::asset('build/img/white-logo.svg') }}" class="white-logo" alt="Logo">
        </a>
        <a href="{{url('index')}}" class="logo-small">
            <img src="{{ URL::asset('build/img/logo-small.svg') }}" alt="Logo">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
            <i class="ti ti-arrow-bar-to-left"></i>
        </a>
    </div>
    <!-- /Logo -->

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <div class="header-user">
        <ul class="nav user-menu">
            
            <!-- Search -->
            <li class="nav-item nav-search-inputs me-auto">
                <div class="top-nav-search">
                    <a href="javascript:void(0);" class="responsive-search">
                        <i class="fa fa-search"></i>
                    </a>
                    <form action="#" class="dropdown">
                        <div class="searchinputs" id="dropdownMenuClickable">
                            <input type="text" placeholder="Search">
                            <div class="search-addon">
                                <button type="submit"><i class="ti ti-command"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <!-- /Search -->

            <!-- Horizontal Single -->
            <li>
                <div class="sidebar sidebar-horizontal" id="horizontal-single">
                    <div class="sidebar-menu">
                        <div class="main-menu">
                            <ul class="nav-menu">
                                <li class="menu-title">
                                    <span>Main</span>
                                </li>
                                <li class="submenu">
                                    <a href="javascript:void(0);" class="{{ Request::is('deals-dashboard', 'leads-dashboard', 'project-dashboard', 'dashboard', 'company', 'subscription', 'packages', 'domain', 'purchase-transaction') ? 'subdrop active' : '' }}">
                                        <i class="ti ti-layout-2"></i><span>Dashboard</span><span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        <li><a class="{{ Request::is('deals-dashboard') ? 'active' : '' }}"
                                            href="{{ url('deals-dashboard') }}">Deals Dashboard</a></li>
                                        <li><a class="{{ Request::is('leads-dashboard') ? 'active' : '' }}"
                                                href="{{ url('leads-dashboard') }}">Leads Dashboard</a></li>
                                        <li><a class="{{ Request::is('project-dashboard') ? 'active' : '' }}"
                                            href="{{ url('project-dashboard') }}">Project Dashboard</a></li>
                                        <li class="submenu">
                                            <a href="#" class="{{ Request::is('dashboard', 'company', 'subscription', 'packages', 'domain', 'purchase-transaction') ? 'active subdrop' : '' }}">
                                                <i class="ti ti-user-star"></i><span>Super Admin</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a class="{{ Request::is('dashboard') ? 'active' : '' }}" href="{{url('dashboard')}}">Dashboard</a></li>
                                                <li><a class="{{ Request::is('company') ? 'active' : '' }}" href="{{url('company')}}">Companies</a></li>
                                                <li><a class="{{ Request::is('subscription') ? 'active' : '' }}" href="{{url('subscription')}}">Subscriptions</a></li>
                                                <li><a class="{{ Request::is('packages') ? 'active' : '' }}" href="{{url('packages')}}">Packages</a></li>
                                                <li><a class="{{ Request::is('domain') ? 'active' : '' }}" href="{{url('domain')}}">Domain</a></li>
                                                <li><a class="{{ Request::is('purchase-transaction') ? 'active' : '' }}" href="{{url('purchase-transaction')}}">Purchase Transaction</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="submenu">
                                    <a href="javascript:void(0);"
                                        class="{{ Request::is('chat', 'calendar', 'email', 'todo', 'notes', 'file-manager', 'video-call', 'audio-call', 'call-history', 'social-feed', 'kanban-view', 'invoice', 'invoice-details') ? 'subdrop active' : '' }}"
                                    ><i class="ti ti-brand-airtable"></i><span>Application</span>
                                        <span class="menu-arrow"></span></a>
                                    <ul>
                                        <li><a class="{{ Request::is('chat') ? 'active' : '' }}"
                                            href="{{ url('chat') }}">Chat</a></li>
                                        <li class="submenu submenu-two">
                                            <a href="javascript:void(0);" class="{{ Request::is('video-call', 'audio-call', 'call-history') ? 'subdrop active' : '' }}">Call<span class="menu-arrow inside-submenu"></span></a>
                                            <ul>
                                                <li><a class="{{ Request::is('video-call') ? 'active' : '' }}"
                                                    href="{{ url('video-call') }}">Video Call</a></li>
                                                <li><a class="{{ Request::is('audio-call') ? 'active' : '' }}"
                                                        href="{{ url('audio-call') }}">Audio Call</a></li>
                                                <li><a class="{{ Request::is('call-history') ? 'active' : '' }}"
                                                    href="{{ url('call-history') }}">Call History</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="{{ Request::is('calendar') ? 'active' : '' }}"
                                            href="{{ url('calendar') }}">Calendar</a></li>
                                        <li><a class="{{ Request::is('email') ? 'active' : '' }}"
                                                href="{{ url('email') }}">Email</a></li>
                                        <li><a class="{{ Request::is('todo') ? 'active' : '' }}" href="{{ url('todo') }}">To
                                                Do</a></li>
                                        <li><a class="{{ Request::is('notes') ? 'active' : '' }}"
                                                href="{{ url('notes') }}">Notes</a></li>
                                        <li><a class="{{ Request::is('file-manager') ? 'active' : '' }}"
                                                href="{{ url('file-manager') }}">File Manager</a></li>
                                        <li><a class="{{ Request::is('social-feed') ? 'active' : '' }}" href="{{url('social-feed')}}">Social Feed</a></li>
                                        <li><a class="{{ Request::is('kanban-view') ? 'active' : '' }}" href="{{url('kanban-view')}}">Kanban</a></li>
                                        <li><a class="{{ Request::is('invoice', 'invoice-details') ? 'active' : '' }}" href="{{url('invoice')}}">Invoices</a></li>
                                    </ul>
                                </li>
                                <li class="submenu">
                                    <a href="javascript:void(0);" 
                                    class="{{ Request::is('layout-mini', 'layout-horizontal-single', 'layout-without-header', 'layout-rtl', 'layout-detached', 'layout-dark') ? 'active subdrop' : '' }}"
                                    >
                                        <i class="ti ti-layout-2"></i><span>layouts</span><span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        <li> <a href="{{url('layout-mini')}}" class="{{ Request::is('layout-mini') ? 'active' : '' }}">
                                            Mini
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url('layout-horizontal-single')}}" class="{{ Request::is('layout-horizontal-single') ? 'active' : '' }}">
                                                Horizontal Single
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url('layout-without-header')}}" class="{{ Request::is('layout-without-header') ? 'active' : '' }}">
                                                Without Header
                                        </a>
                                        </li>
                                        <li>
                                            <a href="{{url('layout-rtl')}}" class="{{ Request::is('layout-rtl') ? 'active' : '' }}">
                                                RTL
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url('layout-detached')}}" class="{{ Request::is('layout-detached') ? 'active' : '' }}">
                                                Detached
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{url('layout-dark')}}" class="{{ Request::is('layout-dark') ? 'active' : '' }}">
                                                Dark
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="submenu">
                                    <a href="#" class="{{ Request::is('contacts', 'contact-grid', 'contact-details', 'companies', 'companies-grid', 'company-details', 
                                    'deals', 'deals-kanban', 'deals-details', 'leads', 'leads-details', 'leads-kanban', 'pipeline', 'campaign', 'campaign-complete', 'campaign-archieve',
                                    'projects', 'project-details', 'project-grid', 'tasks', 'tasks-completed', 'tasks-important', 'proposals', 'proposals-grid', 
                                    'contracts', 'contracts-grid', 'estimations', 'estimations-kanban', 'invoices', 'invoice-grid', 'payments', 'analytics', 
                                    'activities', 'activity-calls', 'activity-mail', 'activity-meeting', 'activity-task', 'lost-reason', 'lost-reason', 'industry', 'calls' ) ? 'active' : '' }}">
                                        <i class="ti ti-ti ti-user-up"></i><span>Crm</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        <li>
                                            <a class="{{ Request::is('contacts', 'contact-grid', 'contact-details') ? 'active' : '' }}"
                                                href="{{ url('contacts') }}">Contacts</a>
                                        </li>
                                        <li>
                                            <a class="{{ Request::is('companies', 'companies-grid', 'company-details') ? 'active' : '' }}"
                                                href="{{ url('companies') }}">Companies</a>
                                        </li>
                                        <li>
                                            <a class="{{ Request::is('deals', 'deals-kanban', 'deals-details') ? 'active' : '' }}"
                                                href="{{ url('deals') }}">Deals</a>
                                        </li>
                                        <li>
                                            <a class="{{ Request::is('leads', 'leads-details', 'leads-kanban') ? 'active' : '' }}"
                                                href="{{ url('leads') }}">Leads</a>
                                        </li>
                                        <li>
                                            <a class="{{ Request::is('pipeline') ? 'active' : '' }}" href="{{ url('pipeline') }}">Pipeline</a>
                                        </li>
                                        <li>
                                            <a class="{{ Request::is('campaign', 'campaign-complete', 'campaign-archieve') ? 'active' : '' }}"
                                                href="{{ url('campaign') }}">Campaign</a>
                                        </li>
                                        <li>
                                            <a class="{{ Request::is('projects', 'project-details', 'project-grid') ? 'active' : '' }}"
                                                href="{{ url('projects') }}">Projects</a>
                                        </li>
                                        <li>
                                            <a class="{{ Request::is('tasks', 'tasks-completed', 'tasks-important') ? 'active' : '' }}"
                                                href="{{ url('tasks') }}">Tasks</a>
                                        </li>
                                        <li>
                                            <a class="{{ Request::is('proposals', 'proposals-grid') ? 'active' : '' }}"
                                                href="{{ url('proposals') }}">Proposals</a>
                                        </li>
                                        <li>
                                            <a class="{{ Request::is('contracts', 'contracts-grid') ? 'active' : '' }}"
                                                href="{{ url('contracts') }}">Contracts</a>
                                        </li>
                                        <li>
                                            <a class="{{ Request::is('estimations', 'estimations-kanban') ? 'active' : '' }}"
                                                href="{{ url('estimations') }}">Estimations</a>
                                        </li>
                                        <li>
                                            <a class="{{ Request::is('invoices', 'invoice-grid') ? 'active' : '' }}"
                                                href="{{ url('invoices') }}">Invoices</a>
                                        </li>
                                        <li>
                                            <a class="{{ Request::is('payments') ? 'active' : '' }}" href="{{ url('payments') }}">Payments</a>
                                        </li>
                                        <li>
                                            <a class="{{ Request::is('analytics') ? 'active' : '' }}" href="{{ url('analytics') }}">Analytics</a>
                                        </li>
                                        <li>
                                            <a class="{{ Request::is('activities', 'activity-calls', 'activity-mail', 'activity-meeting', 'activity-task') ? 'active' : '' }}"
                                                href="{{ url('activities') }}">Activities</a>
                                        </li>
                                        <li class="submenu">
                                            <a href="#" class="{{ Request::is('lost-reason', 'lost-reason', 'industry', 'calls') ? 'active subdrop' : '' }}">
                                                <span>Crm Settings</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a class="{{ Request::is('sources') ? 'active' : '' }}" href="{{ url('sources') }}"></a>
                                                </li>
                                                <li>
                                                    <a class="{{ Request::is('lost-reason') ? 'active' : '' }}"
                                                        href="{{ url('lost-reason') }}">Lost Reason
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="{{ Request::is('lost-reason') ? 'active' : '' }}"
                                                        href="{{ url('contact-stage') }}">Contact Stage</a>
                                                </li>
                                                <li>
                                                    <a class="{{ Request::is('industry') ? 'active' : '' }}" href="{{ url('industry') }}">Industry</a>
                                                </li>
                                                <li>
                                                    <a class="{{ Request::is('calls') ? 'active' : '' }}" href="{{ url('calls') }}">Calls</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="submenu">
                                    <a href="#" class="{{ Request::is('lead-reports', 'deal-reports', 'contact-reports', 'company-reports', 'project-reports', 'task-reports') ? 'subdrop active' : '' }}">
                                        <i class="ti ti-file-invoice"></i><span>Reports</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        <li><a class="{{ Request::is('lead-reports') ? 'active' : '' }}"
                                            href="{{ url('lead-reports') }}">Lead Reports</a></li>
                                        <li><a class="{{ Request::is('deal-reports') ? 'active' : '' }}"
                                                href="{{ url('deal-reports') }}">Deal Reports</a></li>
                                        <li><a class="{{ Request::is('contact-reports') ? 'active' : '' }}"
                                                href="{{ url('contact-reports') }}">Contact Reports</a></li>
                                        <li><a class="{{ Request::is('company-reports') ? 'active' : '' }}"
                                                href="{{ url('company-reports') }}">Company Reports</a></li>
                                        <li><a class="{{ Request::is('project-reports') ? 'active' : '' }}"
                                                href="{{ url('project-reports') }}">Project Reports</a></li>
                                        <li><a class="{{ Request::is('task-reports') ? 'active' : '' }}"
                                                href="{{ url('task-reports') }}">Task Reports</a></li>
                                    </ul>
                                </li>
                                
                                <li class="submenu">
                                    <a href="#"  class="{{ Request::is('manage-users', 'roles-permissions','permission', 'delete-request', 'membership-plans', 'membership-addons', 'membership-transactions',
                                    'countries', 'states', 'cities', 'testimonials', 'faq', 'contact-messages', 'tickets', 'blank-page', 'coming-soon', 'under-maintenance', 'ui-alerts',
                                    'ui-accordion', 'ui-avatar', 'ui-badges', 'ui-borders', 'ui-buttons', 'ui-buttons-group', 'ui-breadcrumb', 'ui-cards', 'ui-carousel',
                                    'ui-colors', 'ui-dropdowns', 'ui-grid', 'ui-images', 'ui-lightbox', 'ui-media', 'ui-modals', 'ui-offcanvas', 'ui-pagination', 'ui-popovers',
                                    'ui-progress', 'ui-placeholders', 'ui-rangeslider', 'ui-spinner', 'ui-sweetalerts', 'ui-nav-tabs', 'ui-toasts', 'ui-tooltips', 'ui-typography',
                                    'ui-video', 'ui-sortable', 'ui-swiperjs', 'ui-ribbon', 'ui-clipboard', 'ui-drag-drop', 'ui-rangeslider', 'ui-rating', 'ui-text-editor', 'ui-counter', 'ui-scrollbar', 
                                    'ui-stickynote', 'ui-timeline', 'chart-apex', 'chart-js', 'chart-morris', 'chart-flot', 'chart-peity', 'chart-c3', 'icon-fontawesome', 'icon-feather', 'icon-ionic', 
                                    'icon-material', 'icon-pe7', 'icon-simpleline', 'icon-themify', 'icon-weather', 'icon-typicon', 'icon-flag', 'icon-tabler', 'icon-bootstrap', 'icon-remix', 
                                    'form-basic-inputs', 'form-checkbox-radios', 'form-input-groups', 'form-grid-gutters', 'form-select', 'form-mask', 'form-fileupload', 'form-horizontal', 
                                    'form-vertical', 'form-floating-labels', 'tables-basic', 'data-tables', 'form-validation', 'form-select2', 'form-wizard', 'form-pickers', 'maps-vector', 'maps-leaflet') ? 'subdrop active' : '' }}">
                                        <i class="ti ti-page-break"></i><span>Pages</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        <li>
                                            <a class="{{ Request::is('manage-users') ? 'active' : '' }}"
                                            href="{{ url('manage-users') }}">Manage
                                                Users</a>
                                        </li>
                                        <li><a class="{{ Request::is('roles-permissions','permission') ? 'active' : '' }}"
                                                href="{{ url('roles-permissions') }}">Roles
                                                    & Permissions</a>
                                        </li>
                                        <li><a class="{{ Request::is('delete-request') ? 'active' : '' }}"
                                                href="{{ url('delete-request') }}">Delete
                                                    Request</a>
                                        </li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);"
                                                class="{{ Request::is('membership-plans', 'membership-addons', 'membership-transactions') ? 'subdrop active' : '' }}"
                                            >
                                                <span>Membership</span><span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a class="{{ Request::is('membership-plans') ? 'active' : '' }}"
                                                    href="{{ url('membership-plans') }}">Membership Plans</a></li>
                                                <li><a class="{{ Request::is('membership-addons') ? 'active' : '' }}"
                                                        href="{{ url('membership-addons') }}">Membership Addons</a></li>
                                                <li><a class="{{ Request::is('membership-transactions') ? 'active' : '' }}"
                                                        href="{{ url('membership-transactions') }}">Transactions</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);" class="{{ Request::is('countries', 'states', 'cities') ? 'subdrop active' : '' }}">
                                                <span>Location</span><span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a class="{{ Request::is('countries') ? 'active' : '' }}"
                                                    href="{{ url('countries') }}">Countries</a></li>
                                                <li><a class="{{ Request::is('states') ? 'active' : '' }}"
                                                        href="{{ url('states') }}">States</a></li>
                                                <li><a class="{{ Request::is('cities') ? 'active' : '' }}"
                                                        href="{{ url('cities') }}">Cities</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a class="{{ Request::is('testimonials') ? 'active' : '' }}"
                                            href="{{ url('testimonials') }}">Testimonials</a>
                                        </li>
                                        <li>
                                            <a class="{{ Request::is('faq') ? 'active' : '' }}" href="{{ url('faq') }}">FAQ</a>
                                        </li>
                                        <li><a class="{{ Request::is('contact-messages') ? 'active' : '' }}"
                                            href="{{ url('contact-messages') }}">Contact
                                                        Messages</a></li>
                                        <li>
                                            <a class="{{ Request::is('tickets') ? 'active' : '' }}" href="{{ url('tickets') }}">Tickets</a>
                                        </li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);">
                                                <span>Authentication</span><span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a class="{{ Request::is('index') ? 'active' : '' }}"
                                                    href="{{ url('index') }}">Login</a></li>
                                                <li><a class="{{ Request::is('register') ? 'active' : '' }}"
                                                        href="{{ url('register') }}">Register</a></li>
                                                <li><a class="{{ Request::is('forgot-password') ? 'active' : '' }}"
                                                        href="{{ url('forgot-password') }}">Forgot Password</a></li>
                                                <li><a class="{{ Request::is('reset-password') ? 'active' : '' }}"
                                                        href="{{ url('reset-password') }}">Reset Password</a></li>
                                                <li><a class="{{ Request::is('email-verification') ? 'active' : '' }}"
                                                        href="{{ url('email-verification') }}">Email Verification</a></li>
                                                <li><a class="{{ Request::is('two-step-verification') ? 'active' : '' }}"
                                                        href="{{ url('two-step-verification') }}">2 Step Verification</a></li>
                                                <li><a class="{{ Request::is('lock-screen') ? 'active' : '' }}"
                                                    href="{{ url('lock-screen') }}">Lock Screen</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);"
                                                class="{{ Request::is('error-404', 'error-500') ? 'subdrop active' : '' }}"
                                            >
                                                <span>Error Pages</span><span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a class="{{ Request::is('error-404') ? 'active' : '' }}"
                                                    href="{{ url('error-404') }}">404 Error</a></li>
                                                <li><a class="{{ Request::is('error-500') ? 'active' : '' }}"
                                                    href="{{ url('error-500') }}">500 Error</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="{{ Request::is('blank-page') ? 'active' : '' }}"
                                            href="{{ url('blank-page') }}">Blank Page</a>
                                        </li>
                                        <li><a class="{{ Request::is('coming-soon') ? 'active' : '' }}"
                                                href="{{ url('coming-soon') }}">Coming
                                                    Soon</a></li>
                                        <li><a class="{{ Request::is('under-maintenance') ? 'active' : '' }}"
                                            href="{{ url('under-maintenance') }}">Under
                                                Maintenance</a></li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);"
                                                class="{{ Request::is(
                                                    'ui-alerts', 'ui-accordion', 'ui-avatar', 'ui-badges', 'ui-borders', 'ui-buttons', 'ui-buttons-group', 'ui-breadcrumb', 'ui-cards',
                                                    'ui-carousel', 'ui-colors', 'ui-dropdowns', 'ui-grid', 'ui-images', 'ui-lightbox', 'ui-media', 'ui-modals', 'ui-offcanvas', 'ui-pagination',
                                                    'ui-popovers', 'ui-progress', 'ui-placeholders', 'ui-rangeslider', 'ui-spinner', 'ui-sweetalerts', 'ui-nav-tabs', 'ui-toasts', 'ui-tooltips',
                                                    'ui-typography', 'ui-video', 'ui-sortable', 'ui-swiperjs' ) ? 'subdrop active' : '' }}">
                                                <span>Base UI</span><span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a class="{{ Request::is('ui-alerts') ? 'active' : '' }}"
                                                    href="{{ url('ui-alerts') }}">Alerts</a></li>
                                                <li><a class="{{ Request::is('ui-accordion') ? 'active' : '' }}"
                                                        href="{{ url('ui-accordion') }}">Accordion</a></li>
                                                <li><a class="{{ Request::is('ui-avatar') ? 'active' : '' }}"
                                                        href="{{ url('ui-avatar') }}">Avatar</a></li>
                                                <li><a class="{{ Request::is('ui-badges') ? 'active' : '' }}"
                                                        href="{{ url('ui-badges') }}">Badges</a></li>
                                                <li><a class="{{ Request::is('ui-borders') ? 'active' : '' }}"
                                                        href="{{ url('ui-borders') }}">Border</a></li>
                                                <li><a class="{{ Request::is('ui-buttons') ? 'active' : '' }}"
                                                        href="{{ url('ui-buttons') }}">Buttons</a></li>
                                                <li><a class="{{ Request::is('ui-buttons-group') ? 'active' : '' }}"
                                                        href="{{ url('ui-buttons-group') }}">Button Group</a></li>
                                                <li><a class="{{ Request::is('ui-breadcrumb') ? 'active' : '' }}"
                                                        href="{{ url('ui-breadcrumb') }}">Breadcrumb</a></li>
                                                <li><a class="{{ Request::is('ui-cards') ? 'active' : '' }}"
                                                        href="{{ url('ui-cards') }}">Card</a></li>
                                                <li><a class="{{ Request::is('ui-carousel') ? 'active' : '' }}"
                                                        href="{{ url('ui-carousel') }}">Carousel</a></li>
                                                <li><a class="{{ Request::is('ui-colors') ? 'active' : '' }}"
                                                        href="{{ url('ui-colors') }}">Colors</a></li>
                                                <li><a class="{{ Request::is('ui-dropdowns') ? 'active' : '' }}"
                                                        href="{{ url('ui-dropdowns') }}">Dropdowns</a></li>
                                                <li><a class="{{ Request::is('ui-grid') ? 'active' : '' }}"
                                                        href="{{ url('ui-grid') }}">Grid</a></li>
                                                <li><a class="{{ Request::is('ui-images') ? 'active' : '' }}"
                                                        href="{{ url('ui-images') }}">Images</a></li>
                                                <li><a class="{{ Request::is('ui-lightbox') ? 'active' : '' }}"
                                                        href="{{ url('ui-lightbox') }}">Lightbox</a></li>
                                                <li><a class="{{ Request::is('ui-media') ? 'active' : '' }}"
                                                        href="{{ url('ui-media') }}">Media</a></li>
                                                <li><a class="{{ Request::is('ui-modals') ? 'active' : '' }}"
                                                        href="{{ url('ui-modals') }}">Modals</a></li>
                                                <li><a class="{{ Request::is('ui-offcanvas') ? 'active' : '' }}"
                                                        href="{{ url('ui-offcanvas') }}">Offcanvas</a></li>
                                                <li><a class="{{ Request::is('ui-pagination') ? 'active' : '' }}"
                                                        href="{{ url('ui-pagination') }}">Pagination</a></li>
                                                <li><a class="{{ Request::is('ui-popovers') ? 'active' : '' }}"
                                                        href="{{ url('ui-popovers') }}">Popovers</a></li>
                                                <li><a class="{{ Request::is('ui-progress') ? 'active' : '' }}"
                                                        href="{{ url('ui-progress') }}">Progress</a></li>
                                                <li><a class="{{ Request::is('ui-placeholders') ? 'active' : '' }}"
                                                        href="{{ url('ui-placeholders') }}">Placeholders</a></li>
                                                <li><a class="{{ Request::is('ui-rangeslider') ? 'active' : '' }}"
                                                        href="{{ url('ui-rangeslider') }}">Range Slider</a></li>
                                                <li><a class="{{ Request::is('ui-spinner') ? 'active' : '' }}"
                                                        href="{{ url('ui-spinner') }}">Spinner</a></li>
                                                <li><a class="{{ Request::is('ui-sweetalerts') ? 'active' : '' }}"
                                                        href="{{ url('ui-sweetalerts') }}">Sweet Alerts</a></li>
                                                <li><a class="{{ Request::is('ui-nav-tabs') ? 'active' : '' }}"
                                                        href="{{ url('ui-nav-tabs') }}">Tabs</a></li>
                                                <li><a class="{{ Request::is('ui-toasts') ? 'active' : '' }}"
                                                        href="{{ url('ui-toasts') }}">Toasts</a></li>
                                                <li><a class="{{ Request::is('ui-tooltips') ? 'active' : '' }}"
                                                        href="{{ url('ui-tooltips') }}">Tooltips</a></li>
                                                <li><a class="{{ Request::is('ui-typography') ? 'active' : '' }}"
                                                        href="{{ url('ui-typography') }}">Typography</a></li>
                                                <li><a class="{{ Request::is('ui-video') ? 'active' : '' }}"
                                                        href="{{ url('ui-video') }}">Video</a></li>
                                                <li><a class="{{ Request::is('ui-sortable') ? 'active' : '' }}"
                                                        href="{{url('ui-sortable')}}">Sortable</a></li>
                                                <li><a  class="{{ Request::is('ui-swiperjs') ? 'active' : '' }}"
                                                        href="{{url('ui-swiperjs')}}">Swiperjs</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);"
                                            class="{{ Request::is('ui-ribbon', 'ui-clipboard', 'ui-drag-drop', 'ui-rangeslider', 'ui-rating', 'ui-text-editor', 'ui-counter', 'ui-scrollbar', 'ui-stickynote', 'ui-timeline') ? 'subdrop active' : '' }}"
                                            >
                                                <span>Advanced UI</span><span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a class="{{ Request::is('ui-ribbon') ? 'active' : '' }}"
                                                    href="{{ url('ui-ribbon') }}">Ribbon</a></li>
                                                <li><a class="{{ Request::is('ui-clipboard') ? 'active' : '' }}"
                                                        href="{{ url('ui-clipboard') }}">Clipboard</a></li>
                                                <li><a class="{{ Request::is('ui-drag-drop') ? 'active' : '' }}"
                                                        href="{{ url('ui-drag-drop') }}">Drag & Drop</a></li>
                                                <li><a class="{{ Request::is('ui-rangeslider') ? 'active' : '' }}"
                                                        href="{{ url('ui-rangeslider') }}">Range Slider</a></li>
                                                <li><a class="{{ Request::is('ui-rating') ? 'active' : '' }}"
                                                        href="{{ url('ui-rating') }}">Rating</a></li>
                                                <li><a class="{{ Request::is('ui-text-editor') ? 'active' : '' }}"
                                                        href="{{ url('ui-text-editor') }}">Text Editor</a></li>
                                                <li><a class="{{ Request::is('ui-counter') ? 'active' : '' }}"
                                                        href="{{ url('ui-counter') }}">Counter</a></li>
                                                <li><a class="{{ Request::is('ui-scrollbar') ? 'active' : '' }}"
                                                        href="{{ url('ui-scrollbar') }}">Scrollbar</a></li>
                                                <li><a class="{{ Request::is('ui-stickynote') ? 'active' : '' }}"
                                                        href="{{ url('ui-stickynote') }}">Sticky Note</a></li>
                                                <li><a class="{{ Request::is('ui-timeline') ? 'active' : '' }}"
                                                        href="{{ url('ui-timeline') }}">Timeline</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);"
                                            class="{{ Request::is('chart-apex', 'chart-js', 'chart-morris', 'chart-flot', 'chart-peity', 'chart-c3') ? 'subdrop active' : '' }}"
                                            >
                                                <span>Charts</span><span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a class="{{ Request::is('chart-apex') ? 'active' : '' }}"
                                                    href="{{ url('chart-apex') }}">Apex Charts</a></li>
                                                <li><a class="{{ Request::is('chart-c3') ? 'active' : '' }}"
                                                        href="{{ url('chart-c3') }}">C3 Charts</a></li>
                                                <li><a class="{{ Request::is('chart-js') ? 'active' : '' }}"
                                                        href="{{ url('chart-js') }}">Chart Js</a></li>
                                                <li><a class="{{ Request::is('chart-morris') ? 'active' : '' }}"
                                                        href="{{ url('chart-morris') }}">Morris Charts</a></li>
                                                <li><a class="{{ Request::is('chart-flot') ? 'active' : '' }}"
                                                        href="{{ url('chart-flot') }}">Flot Charts</a></li>
                                                <li><a class="{{ Request::is('chart-peity') ? 'active' : '' }}"
                                                        href="{{ url('chart-peity') }}">Peity Charts</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);"
                                            class="{{ Request::is('icon-fontawesome', 'icon-feather', 'icon-ionic', 'icon-material', 'icon-pe7', 'icon-simpleline', 'icon-themify', 'icon-weather', 'icon-typicon', 'icon-flag', 'icon-tabler', 'icon-bootstrap', 'icon-remix') ? 'subdrop active' : '' }}"
                                            >
                                                <span>Icons</span><span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a class="{{ Request::is('icon-fontawesome') ? 'active' : '' }}"
                                                    href="{{ url('icon-fontawesome') }}">Fontawesome Icons</a></li>
                                                <li><a class="{{ Request::is('icon-feather') ? 'active' : '' }}"
                                                        href="{{ url('icon-feather') }}">Feather Icons</a></li>
                                                <li><a class="{{ Request::is('icon-ionic') ? 'active' : '' }}"
                                                        href="{{ url('icon-ionic') }}">Ionic Icons</a></li>
                                                <li><a class="{{ Request::is('icon-material') ? 'active' : '' }}"
                                                        href="{{ url('icon-material') }}">Material Icons</a></li>
                                                <li><a class="{{ Request::is('icon-pe7') ? 'active' : '' }}"
                                                        href="{{ url('icon-pe7') }}">Pe7 Icons</a></li>
                                                <li><a class="{{ Request::is('icon-simpleline') ? 'active' : '' }}"
                                                        href="{{ url('icon-simpleline') }}">Simpleline Icons</a></li>
                                                <li><a class="{{ Request::is('icon-themify') ? 'active' : '' }}"
                                                        href="{{ url('icon-themify') }}">Themify Icons</a></li>
                                                <li><a class="{{ Request::is('icon-weather') ? 'active' : '' }}"
                                                        href="{{ url('icon-weather') }}">Weather Icons</a></li>
                                                <li><a class="{{ Request::is('icon-typicon') ? 'active' : '' }}"
                                                        href="{{ url('icon-typicon') }}">Typicon Icons</a></li>
                                                <li><a class="{{ Request::is('icon-flag') ? 'active' : '' }}"
                                                        href="{{ url('icon-flag') }}">Flag Icons</a></li>
                                                <li><a class="{{ Request::is('icon-tabler') ? 'active' : '' }}"
                                                        href="{{url('icon-tabler')}}">Tabler Icons</a></li>
                                                <li><a class="{{ Request::is('icon-bootstrap') ? 'active' : '' }}"
                                                        href="{{url('icon-bootstrap')}}">Bootstrap Icons</a></li>
                                                <li><a class="{{ Request::is('icon-remix') ? 'active' : '' }}"
                                                        href="{{url('icon-remix')}}">Remix Icons</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);">
                                                <span>Forms</span><span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li class="submenu submenu-two">
                                                    <a href="javascript:void(0);"
                                                    class="{{ Request::is('form-basic-inputs', 'form-checkbox-radios', 'form-input-groups', 'form-grid-gutters', 'form-select', 'form-mask', 'form-fileupload',
                                                    'form-validation', 'form-select2', 'form-wizard', 'form-pickers') ? 'subdrop active' : '' }}"
                                                    >Form Elements<span class="menu-arrow inside-submenu"></span></a>
                                                    <ul>
                                                        <li><a class="{{ Request::is('form-basic-inputs') ? 'active' : '' }}"
                                                            href="{{ url('form-basic-inputs') }}">Basic Inputs </a></li>
                                                        <li><a class="{{ Request::is('form-checkbox-radios') ? 'active' : '' }}"
                                                                href="{{ url('form-checkbox-radios') }}">Checkbox & Radios </a></li>
                                                        <li><a class="{{ Request::is('form-input-groups') ? 'active' : '' }}"
                                                                href="{{ url('form-input-groups') }}">Input Groups </a></li>
                                                        <li><a class="{{ Request::is('form-grid-gutters') ? 'active' : '' }}"
                                                                href="{{ url('form-grid-gutters') }}"> Grid & Gutters </a></li>
                                                        <li><a class="{{ Request::is('form-select') ? 'active' : '' }}"
                                                                href="{{ url('form-select') }}">Form Select </a></li>
                                                        <li><a class="{{ Request::is('form-mask') ? 'active' : '' }}"
                                                                href="{{ url('form-mask') }}"> Input Masks </a></li>
                                                        <li><a class="{{ Request::is('form-fileupload') ? 'active' : '' }}"
                                                                href="{{ url('form-fileupload') }}">File Upload </a></li>
                                                    </ul>
                                                </li>
                                                <li class="submenu submenu-two">
                                                    <a href="javascript:void(0);"
                                                    class="{{ Request::is('form-horizontal', 'form-vertical', 'form-floating-labels') ? 'subdrop active' : '' }}"
                                                    >Layouts<span
                                                            class="menu-arrow inside-submenu"></span></a>
                                                    <ul>
                                                        <li><a class="{{ Request::is('form-horizontal') ? 'active' : '' }}"
                                                            href="{{ url('form-horizontal') }}">Horizontal Form </a></li>
                                                        <li><a class="{{ Request::is('form-vertical') ? 'active' : '' }}"
                                                                href="{{ url('form-vertical') }}"> Vertical Form </a></li>
                                                        <li><a class="{{ Request::is('form-floating-labels') ? 'active' : '' }}"
                                                                href="{{ url('form-floating-labels') }}">Floating Labels </a></li>
                                                    </ul>
                                                </li>
                                                <li><a class="{{ Request::is('form-validation') ? 'active' : '' }}"
                                                    href="{{ url('form-validation') }}"> Form Validation </a></li>
                                                <li><a class="{{ Request::is('form-select2') ? 'active' : '' }}"
                                                        href="{{ url('form-select2') }}">Select2 </a></li>
                                                <li><a class="{{ Request::is('form-wizard') ? 'active' : '' }}"
                                                        href="{{ url('form-wizard') }}">Form Wizard</a></li>
                                                <li><a class="{{ Request::is('form-pickers') ? 'active' : '' }}"
                                                        href="{{url('form-pickers')}}">Form Picker</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);"
                                            class="{{ Request::is('tables-basic', 'data-tables') ? 'subdrop active' : '' }}"
                                            ><span>Tables</span><span class="menu-arrow"></span></a>
                                            <ul>
                                                <li><a class="{{ Request::is('tables-basic') ? 'active' : '' }}"
                                                    href="{{ url('tables-basic') }}">Basic Tables </a></li>
                                                <li><a class="{{ Request::is('data-tables') ? 'active' : '' }}"
                                                    href="{{ url('data-tables') }}">Data Table </a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);"
                                            class="{{ Request::is('maps-vector', 'maps-leaflet') ? 'subdrop active' : '' }}"
                                            ><span>Maps</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a class="{{ Request::is('maps-vector') ? 'active' : '' }}"
                                                    href="{{url('maps-vector')}}">Vector</a>
                                                </li>
                                                <li>
                                                        <a class="{{ Request::is('maps-leaflet') ? 'active' : '' }}"
                                                        href="{{url('maps-leaflet')}}">Leaflet</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="javascript:void(0);"><span>Documentation</span></a></li>
                                        <li><a href="javascript:void(0);"><span>Changelog v2.2.2</span></a></li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);"><span>Multi Level</span><span class="menu-arrow"></span></a>
                                            <ul>
                                            <li><a href="javascript:void(0);">Level 1.1</a></li>
                                            <li class="submenu submenu-two"><a href="javascript:void(0);">Level 1.2<span class="menu-arrow inside-submenu"></span></a>
                                            <ul>
                                                <li><a href="javascript:void(0);">Level 2.1</a></li>
                                                <li class="submenu submenu-two submenu-three"><a href="javascript:void(0);">Level 2.2<span class="menu-arrow inside-submenu inside-submenu-two"></span></a>
                                                    <ul>
                                                        <li><a href="javascript:void(0);">Level 3.1</a></li>
                                                        <li><a href="javascript:void(0);">Level 3.2</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                    </ul>
                                </li>
                                <li class="submenu">
                                    <a href="#" class="{{ Request::is('profile', 'security', 'notifications', 'connected-apps', 'company-settings',
                                    'localization', 'prefixes', 'preference', 'appearance', 'language', 'language-web', 'invoice-settings', 'printers', 'custom-fields',
                                    'email-settings', 'sms-gateways', 'gdpr-cookies', 'payment-gateways', 'bank-accounts', 'tax-rates', 'currencies', 'storage', 'ban-ip-address') ? 'subdrop active' : '' }}">
                                        <i class="ti ti-settings-cog"></i><span>Settings</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul>
                                        <li class="submenu">
                                            <a href="javascript:void(0);"
                                            class="{{ Request::is('profile', 'security', 'notifications', 'connected-apps') ? 'subdrop active' : '' }}"
                                            ><span>General Settings</span><span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a class="{{ Request::is('profile') ? 'active' : '' }}"
                                                    href="{{ url('profile') }}">Profile</a></li>
                                                <li><a class="{{ Request::is('security') ? 'active' : '' }}"
                                                        href="{{ url('security') }}">Security</a></li>
                                                <li><a class="{{ Request::is('notifications') ? 'active' : '' }}"
                                                        href="{{ url('notifications') }}">Notifications</a></li>
                                                <li><a class="{{ Request::is('connected-apps') ? 'active' : '' }}"
                                                        href="{{ url('connected-apps') }}">Connected Apps</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);"
                                            class="{{ Request::is('company-settings', 'localization', 'prefixes', 'preference', 'appearance', 'language', 'language-web') ? 'subdrop active' : '' }}"
                                            >
                                                <span>Website Settings</span><span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a class="{{ Request::is('company-settings') ? 'active' : '' }}"
                                                    href="{{ url('company-settings') }}">Company Settings</a></li>
                                                <li><a class="{{ Request::is('localization') ? 'active' : '' }}"
                                                        href="{{ url('localization') }}">Localization</a></li>
                                                <li><a class="{{ Request::is('prefixes') ? 'active' : '' }}"
                                                        href="{{ url('prefixes') }}">Prefixes</a></li>
                                                <li><a class="{{ Request::is('preference') ? 'active' : '' }}"
                                                        href="{{ url('preference') }}">Preference</a></li>
                                                <li><a class="{{ Request::is('appearance') ? 'active' : '' }}"
                                                        href="{{ url('appearance') }}">Appearance</a></li>
                                                <li><a class="{{ Request::is('language', 'language-web') ? 'active' : '' }}"
                                                        href="{{ url('language') }}">Language</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);"
                                             class="{{ Request::is('invoice-settings', 'printers', 'custom-fields') ? 'subdrop active' : '' }}"
                                            >
                                                <span>App Settings</span><span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a class="{{ Request::is('invoice-settings') ? 'active' : '' }}"
                                                    href="{{ url('invoice-settings') }}">Invoice Settings</a></li>
                                                <li><a class="{{ Request::is('printers') ? 'active' : '' }}"
                                                        href="{{ url('printers') }}">Printers</a></li>
                                                <li><a class="{{ Request::is('custom-fields') ? 'active' : '' }}"
                                                        href="{{ url('custom-fields') }}">Custom Fields</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);" 
                                            class="{{ Request::is('email-settings', 'sms-gateways', 'gdpr-cookies') ? 'subdrop active' : '' }}"
                                            >
                                                <span>System Settings</span><span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a class="{{ Request::is('email-settings') ? 'active' : '' }}"
                                                    href="{{ url('email-settings') }}">Email Settings</a></li>
                                                <li><a class="{{ Request::is('sms-gateways') ? 'active' : '' }}"
                                                        href="{{ url('sms-gateways') }}">SMS Gateways</a></li>
                                                <li><a class="{{ Request::is('gdpr-cookies') ? 'active' : '' }}"
                                                        href="{{ url('gdpr-cookies') }}">GDPR Cookies</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);"
                                            class="{{ Request::is('payment-gateways', 'bank-accounts', 'tax-rates', 'currencies') ? 'subdrop active' : '' }}"
                                            >
                                                <span>Financial Settings</span><span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a class="{{ Request::is('payment-gateways') ? 'active' : '' }}"
                                                    href="{{ url('payment-gateways') }}">Payment Gateways</a></li>
                                                <li><a class="{{ Request::is('bank-accounts') ? 'active' : '' }}"
                                                        href="{{ url('bank-accounts') }}">Bank Accounts</a></li>
                                                <li><a class="{{ Request::is('tax-rates') ? 'active' : '' }}"
                                                        href="{{ url('tax-rates') }}">Tax Rates</a></li>
                                                <li><a class="{{ Request::is('currencies') ? 'active' : '' }}"
                                                        href="{{ url('currencies') }}">Currencies</a></li>
                                            </ul>
                                        </li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);"
                                            class="{{ Request::is('storage', 'ban-ip-address') ? 'subdrop active' : '' }}"
                                            >
                                                <span>Other Settings</span><span class="menu-arrow"></span>
                                            </a>
                                            <ul>
                                                <li><a class="{{ Request::is('storage') ? 'active' : '' }}"
                                                    href="{{ url('storage') }}">Storage</a></li>
                                                <li><a class="{{ Request::is('ban-ip-address') ? 'active' : '' }}"
                                                    href="{{ url('ban-ip-address') }}">Ban IP Address</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
            <!-- /Horizontal Single -->

            <!-- Nav List -->
            <li class="nav-item nav-list">
                <ul class="nav">
                    <li>
                        <div>
                            <a href="#" class="btn btn-icon border btn-menubar btnFullscreen">
                                <i class="ti ti-maximize"></i>
                            </a>
                        </div>
                    </li>
                    <li class="dark-mode-list">
                        <a href="javascript:void(0);" id="dark-mode-toggle" class="dark-mode-toggle">
                            <i class="ti ti-sun light-mode active"></i>
                            <i class="ti ti-moon dark-mode"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0);" class="btn btn-header-list" data-bs-toggle="dropdown">
                            <i class="ti ti-layout-grid-add"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end menus-info">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="menu-list">
                                        <li>
                                            <a href="contacts.html">
                                                <div class="menu-details">
                                                    <span class="menu-list-icon bg-violet">
                                                        <i class="ti ti-user-up"></i>
                                                    </span>
                                                    <div class="menu-details-content">
                                                        <p>Contacts</p>
                                                        <span>Add New Contact</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="pipeline.html">
                                                <div class="menu-details">
                                                    <span class="menu-list-icon bg-green">
                                                        <i class="ti ti-timeline-event-exclamation"></i>
                                                    </span>
                                                    <div class="menu-details-content">
                                                        <p>Pipline</p>
                                                        <span>Add New Pipline</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="activities.html">
                                                <div class="menu-details">
                                                    <span class="menu-list-icon bg-pink">
                                                        <i class="ti ti-bounce-right"></i>
                                                    </span>
                                                    <div class="menu-details-content">
                                                        <p>Activities</p>
                                                        <span>Add New Activity</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="analytics.html">
                                                <div class="menu-details">
                                                    <span class="menu-list-icon bg-info">
                                                        <i class="ti ti-analyze"></i>
                                                    </span>
                                                    <div class="menu-details-content">
                                                        <p>Analytics</p>
                                                        <span>Shows All Information</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="projects.html">
                                                <div class="menu-details">
                                                    <span class="menu-list-icon bg-danger">
                                                        <i class="ti ti-atom-2"></i>
                                                    </span>
                                                    <div class="menu-details-content">
                                                        <p>Projects</p>
                                                        <span>Add New Project</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="menu-list">
                                        <li>
                                            <a href="deals.html">
                                                <div class="menu-details">
                                                    <span class="menu-list-icon bg-info">
                                                        <i class="ti ti-medal"></i>
                                                    </span>
                                                    <div class="menu-details-content">
                                                        <p>Deals</p>
                                                        <span>Add New Deals</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="leads.html">
                                                <div class="menu-details">
                                                    <span class="menu-list-icon bg-secondary">
                                                        <i class="ti ti-chart-arcs"></i>
                                                    </span>
                                                    <div class="menu-details-content">
                                                        <p>Leads</p>
                                                        <span>Add New Leads</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="companies.html">
                                                <div class="menu-details">
                                                    <span class="menu-list-icon bg-tertiary">
                                                        <i class="ti ti-building-community"></i>
                                                    </span>
                                                    <div class="menu-details-content">
                                                        <p>Company</p>
                                                        <span>Add New Company</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="tasks.html">
                                                <div class="menu-details">
                                                    <span class="menu-list-icon bg-success">
                                                        <i class="ti ti-list-check"></i>
                                                    </span>
                                                    <div class="menu-details-content">
                                                        <p>Tasks</p>
                                                        <span>Add New Task</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="campaign.html">
                                                <div class="menu-details">
                                                    <span class="menu-list-icon bg-purple">
                                                        <i class="ti ti-brand-campaignmonitor"></i>
                                                    </span>
                                                    <div class="menu-details-content">
                                                        <p>Campaign</p>
                                                        <span>Add New Campaign</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="faq.html" class="btn btn-help">
                            <i class="ti ti-help-hexagon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="lead-reports.html" class="btn btn-chart-pie">
                            <i class="ti ti-chart-pie"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- /Nav List -->
            
            <!-- Chat -->
            <li class="nav-item nav-item-email nav-item-box">
                <a href="chat.html">
                    <i class="ti ti-message-circle-exclamation"></i>
                    <span class="badge rounded-pill">14</span>
                </a>
            </li>
            <!-- /Chat -->

            <!-- Notifications -->
            <li class="nav-item dropdown nav-item-box">
                <a href="javascript:void(0);" class="nav-link" data-bs-toggle="dropdown">
                    <i class="ti ti-bell"></i>
                    <span class="badge rounded-pill">13</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end notification-dropdown">
                    <div class="topnav-dropdown-header">
                        <h4 class="notification-title">Notifications</h4>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            <li class="notification-message">
                                <a href="activities.html">
                                    <div class="media d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img src="{{ URL::asset('build/img/profiles/avatar-02.jpg') }}" alt="Profile">
                                            <span class="badge badge-info rounded-pill"></span>
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details">Ray Arnold left 6 comments on Isla Nublar SOC2 compliance report</p>
                                            <p class="noti-time">Last Wednesday at 9:42 am</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href="activities.html">
                                    <div class="media d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img src="{{ URL::asset('build/img/profiles/avatar-03.jpg') }}" alt="Profile">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details">Denise Nedry replied to Anna Srzand</p>
                                            <p class="noti-sub-details">“Oh, I finished de-bugging the phones, but the system's compiling for eighteen minutes, or twenty.  So, some minor systems may go on and off for a while.”</p>
                                            <p class="noti-time">Last Wednesday at 9:42 am</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href="activities.html">
                                    <div class="media d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img alt="" src="{{ URL::asset('build/img/profiles/avatar-06.jpg') }}">
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details">John Hammond attached a file to Isla Nublar SOC2 compliance report</p>
                                            <div class="noti-pdf">
                                                <div class="noti-pdf-icon">
                                                    <span><i class="ti ti-chart-pie"></i></span>
                                                </div>
                                                <div class="noti-pdf-text">
                                                    <p>EY_review.pdf</p>
                                                    <span>2mb</span>
                                                </div>
                                            </div>
                                            <p class="noti-time">Last Wednesday at 9:42 am</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="activities.html" class="view-link">View all</a>
                        <a href="javascript:void(0);" class="clear-link">Clear all</a>
                    </div>
                </div>
            </li>
            <!-- /Notifications -->

            <!-- Profile Dropdown -->
            <li class="nav-item dropdown has-arrow main-drop">
                <a href="javascript:void(0);" class="nav-link userset" data-bs-toggle="dropdown">
                    <span class="user-info">
                        <span class="user-letter">
                            <img src="{{ URL::asset('build/img/profiles/avatar-20.jpg') }}" alt="Profile">
                        </span>
                        <span class="badge badge-success rounded-pill"></span>
                    </span>
                </a>
                <div class="dropdown-menu menu-drop-user">
                    <div class="profilename">
                        <a class="dropdown-item" href="index.html">
                            <i class="ti ti-layout-2"></i> Dashboard
                        </a>
                        <a class="dropdown-item" href="profile.html">
                            <i class="ti ti-user-pin"></i> My Profile
                        </a>
                        <a class="dropdown-item" href="login.html">
                            <i class="ti ti-lock"></i> Logout
                        </a>
                    </div>
                </div>
            </li>
            <!-- /Profile Dropdown -->

        </ul>
    </div>

    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="index.html">
                <i class="ti ti-layout-2"></i> Dashboard
            </a>
            <a class="dropdown-item" href="profile.html">
                <i class="ti ti-user-pin"></i> My Profile
            </a>
            <a class="dropdown-item" href="login.html">
                <i class="ti ti-lock"></i> Logout
            </a>
        </div>
    </div>
    <!-- /Mobile Menu -->

</div>
<!-- /Header -->