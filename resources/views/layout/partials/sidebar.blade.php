<!-- Sidebar -->
<div class="sidebar" id="sidebar">
        <div class="modern-profile p-3 pb-0">
				
                <div class="sidebar-nav mb-3">
                        <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified bg-transparent"
                                role="tablist">
                                <li class="nav-item"><a class="nav-link active border-0" href="#">Menu</a></li>
                                <li class="nav-item"><a class="nav-link border-0" href="{{url('chat')}}">Chats</a></li>
                                <li class="nav-item"><a class="nav-link border-0" href="{{url('email')}}">Inbox</a></li>
                        </ul>
                </div>
        </div>
        <div class="sidebar-header p-3 pb-0 pt-2">
                
                <div class="d-flex align-items-center justify-content-between menu-item mb-3">
                        <div class="me-3">
                                <a href="{{url('calendar')}}" class="btn btn-icon border btn-menubar">
                                        <i class="ti ti-layout-grid-remove"></i>
                                </a>
                        </div>
                        <div class="me-3">
                                <a href="{{url('chat')}}" class="btn btn-icon border btn-menubar position-relative">
                                        <i class="ti ti-brand-hipchat"></i>
                                </a>
                        </div>
                        <div class="me-3 notification-item">
                                <a href="{{url('activities')}}" class="btn btn-icon border btn-menubar position-relative me-1">
                                        <i class="ti ti-bell"></i>
                                        <span class="notification-status-dot"></span>
                                </a>
                        </div>
                        <div class="me-0">
                                <a href="{{url('email')}}" class="btn btn-icon border btn-menubar">
                                        <i class="ti ti-message"></i>
                                </a>
                        </div>
                </div>
        </div>
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="clinicdropdown">
                    <a href="{{ url('profile') }}">
                        <img src="{{ URL::asset('/build/img/profiles/avatar-14.jpg') }}" class="img-fluid" alt="Profile">
                        <div class="user-names">
                            <h5>Adrian Davies</h5>
                            <h6>Tech Lead</h6>
                        </div>
                    </a>
                </li>
            </ul>
            <ul>
                <li>
                    <h6 class="submenu-hdr">Main Menu</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('deals-dashboard', 'leads-dashboard', 'project-dashboard') ? 'subdrop active' : '' }}">
                                <i class="ti ti-layout-2"></i><span>Dashboard</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a class="{{ Request::is('deals-dashboard') ? 'active' : '' }}"
                                        href="{{ url('deals-dashboard') }}">Deals Dashboard</a></li>
                                <li><a class="{{ Request::is('leads-dashboard') ? 'active' : '' }}"
                                        href="{{ url('leads-dashboard') }}">Leads Dashboard</a></li>
                                <li><a class="{{ Request::is('project-dashboard') ? 'active' : '' }}"
                                        href="{{ url('project-dashboard') }}">Project Dashboard</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('chat', 'calendar', 'email', 'todo', 'notes', 'file-manager', 'video-call', 'audio-call', 'call-history', 'social-feed', 'kanban-view', 'invoice', 'invoice-details') ? 'subdrop active' : '' }}"><i
                                    class="ti ti-brand-airtable"></i><span>Application</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a class="{{ Request::is('chat') ? 'active' : '' }}"
                                        href="{{ url('chat') }}">Chat</a></li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);"
                                        class="{{ Request::is('video-call', 'audio-call', 'call-history') ? 'subdrop active' : '' }}">Call<span
                                            class="menu-arrow inside-submenu"></span></a>
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
                <li>
                        <h6 class="submenu-hdr">Layout</h6>
                        <ul>
                                <li>
                                        <a href="{{url('layout-mini')}}" class="{{ Request::is('layout-mini') ? 'active' : '' }}">
                                                <i class="ti ti-layout-navbar"></i><span>Mini</span>
                                        </a>
                                </li>
                                <li>
                                        <a href="{{url('layout-horizontal-single')}}" class="{{ Request::is('layout-horizontal-single') ? 'active' : '' }}">
                                                <i class="ti ti-layout-navbar-inactive"></i><span>Horizontal Single</span>
                                        </a>
                                </li>
                                <li>
                                        <a href="{{url('layout-without-header')}}" class="{{ Request::is('layout-without-header') ? 'active' : '' }}">
                                                <i class="ti ti-layout-sidebar"></i><span>Without Header</span>
                                        </a>
                                </li>
                                <li>
                                        <a href="{{url('layout-rtl')}}" class="{{ Request::is('layout-rtl') ? 'active' : '' }}">
                                                <i class="ti ti-text-direction-rtl"></i><span>RTL</span>
                                        </a>
                                </li>
                                <li>
                                        <a href="{{url('layout-detached')}}" class="{{ Request::is('layout-detached') ? 'active' : '' }}">
                                                <i class="ti ti-details"></i><span>Detached</span>
                                        </a>
                                </li>
                                <li>
                                        <a href="{{url('layout-dark')}}" class="{{ Request::is('layout-dark') ? 'active' : '' }}">
                                                <i class="ti ti-details"></i><span>Dark</span>
                                        </a>
                                </li>
                        </ul>
                </li>
                <li>
                    <h6 class="submenu-hdr">CRM</h6>
                    <ul>
                        <li>
                            <a class="{{ Request::is('contacts', 'contact-grid', 'contact-details') ? 'active' : '' }}"
                                href="{{ url('contacts') }}"><i class="ti ti-user-up"></i><span>Contacts</span></a>
                        </li>
                        <li>
                            <a class="{{ Request::is('companies', 'companies-grid', 'company-details') ? 'active' : '' }}"
                                href="{{ url('companies') }}"><i
                                    class="ti ti-building-community"></i><span>Companies</span></a>
                        </li>
                        <li>
                            <a class="{{ Request::is('deals', 'deals-kanban', 'deals-details') ? 'active' : '' }}"
                                href="{{ url('deals') }}"><i class="ti ti-medal"></i><span>Deals</span></a>
                        </li>
                        <li>
                            <a class="{{ Request::is('leads', 'leads-details', 'leads-kanban') ? 'active' : '' }}"
                                href="{{ url('leads') }}"><i class="ti ti-chart-arcs"></i><span>Leads</span></a>
                        </li>
                        <li>
                            <a class="{{ Request::is('pipeline') ? 'active' : '' }}" href="{{ url('pipeline') }}"><i
                                    class="ti ti-timeline-event-exclamation"></i><span>Pipeline</span></a>
                        </li>
                        <li>
                            <a class="{{ Request::is('campaign', 'campaign-complete', 'campaign-archieve') ? 'active' : '' }}"
                                href="{{ url('campaign') }}"><i
                                    class="ti ti-brand-campaignmonitor"></i><span>Campaign</span></a>
                        </li>
                        <li>
                            <a class="{{ Request::is('projects', 'project-details', 'project-grid') ? 'active' : '' }}"
                                href="{{ url('projects') }}"><i class="ti ti-atom-2"></i><span>Projects</span></a>
                        </li>
                        <li>
                            <a class="{{ Request::is('tasks', 'tasks-completed', 'tasks-important') ? 'active' : '' }}"
                                href="{{ url('tasks') }}"><i class="ti ti-list-check"></i><span>Tasks</span></a>
                        </li>
                        <li>
                            <a class="{{ Request::is('proposals', 'proposals-grid') ? 'active' : '' }}"
                                href="{{ url('proposals') }}">
                                <i class="ti ti-file-star"></i><span>Proposals</span></a>
                        </li>
                        <li>
                            <a class="{{ Request::is('contracts', 'contracts-grid') ? 'active' : '' }}"
                                href="{{ url('contracts') }}">
                                <i class="ti ti-file-check"></i><span>Contracts</span></a>
                        </li>
                        <li>
                            <a class="{{ Request::is('estimations', 'estimations-kanban') ? 'active' : '' }}"
                                href="{{ url('estimations') }}">
                                <i class="ti ti-file-report"></i><span>Estimations</span></a>
                        </li>
                        <li>
                            <a class="{{ Request::is('invoices', 'invoice-grid') ? 'active' : '' }}"
                                href="{{ url('invoices') }}">
                                <i class="ti ti-file-invoice"></i><span>Invoices</span></a>
                        </li>
                        <li>
                            <a class="{{ Request::is('payments') ? 'active' : '' }}" href="{{ url('payments') }}">
                                <i class="ti ti-report-money"></i><span>Payments</span></a>
                        </li>
                        <li>
                            <a class="{{ Request::is('analytics') ? 'active' : '' }}" href="{{ url('analytics') }}"><i
                                    class="ti ti-chart-bar"></i><span>Analytics</span></a>
                        </li>
                        <li>
                            <a class="{{ Request::is('activities', 'activity-calls', 'activity-mail', 'activity-meeting', 'activity-task') ? 'active' : '' }}"
                                href="{{ url('activities') }}"><i
                                    class="ti ti-bounce-right"></i><span>Activities</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <h6 class="submenu-hdr">Reports</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('lead-reports', 'deal-reports', 'contact-reports', 'company-reports', 'project-reports', 'task-reports') ? 'subdrop active' : '' }}">
                                <i class="ti ti-file-invoice"></i><span>Reports</span><span class="menu-arrow"></span>
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
                    </ul>
                </li>
                <li>
                    <h6 class="submenu-hdr">CRM Settings</h6>
                    <ul>
                        <li><a class="{{ Request::is('sources') ? 'active' : '' }}" href="{{ url('sources') }}"><i
                                    class="ti ti-artboard"></i><span>Sources</span></a></li>
                        <li><a class="{{ Request::is('lost-reason') ? 'active' : '' }}"
                                href="{{ url('lost-reason') }}"><i class="ti ti-message-exclamation"></i><span>Lost
                                    Reason</span></a></li>
                        <li><a class="{{ Request::is('contact-stage') ? 'active' : '' }}"
                                href="{{ url('contact-stage') }}"><i class="ti ti-steam"></i><span>Contact
                                    Stage</span></a></li>
                        <li><a class="{{ Request::is('industry') ? 'active' : '' }}" href="{{ url('industry') }}"><i
                                    class="ti ti-building-factory"></i><span>Industry</span></a></li>
                        <li><a class="{{ Request::is('calls') ? 'active' : '' }}" href="{{ url('calls') }}"><i
                                    class="ti ti-phone-check"></i><span>Calls</span></a></li>
                    </ul>
                </li>
                <li>
                    <h6 class="submenu-hdr">User Management</h6>
                    <ul>
                        <li><a class="{{ Request::is('manage-users') ? 'active' : '' }}"
                                href="{{ url('manage-users') }}"><i class="ti ti-users"></i><span>Manage
                                    Users</span></a></li>
                        <li><a class="{{ Request::is('roles-permissions','permission') ? 'active' : '' }}"
                                href="{{ url('roles-permissions') }}"><i class="ti ti-navigation-cog"></i><span>Roles
                                    & Permissions</span></a></li>
                        <li><a class="{{ Request::is('delete-request') ? 'active' : '' }}"
                                href="{{ url('delete-request') }}"><i class="ti ti-flag-question"></i><span>Delete
                                    Request</span></a></li>
                    </ul>
                </li>
                <li>
                    <h6 class="submenu-hdr">Membership</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('membership-plans', 'membership-addons', 'membership-transactions') ? 'subdrop active' : '' }}">
                                <i class="ti ti-file-invoice"></i><span>Membership</span><span
                                    class="menu-arrow"></span>
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
                    </ul>
                </li>
                <li>
                    <h6 class="submenu-hdr">Content</h6>
                    <ul>
                        <li><a class="{{ Request::is('pages') ? 'active' : '' }}" href="{{ url('pages') }}"><i
                                    class="ti ti-page-break"></i><span>Pages</span></a></li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('countries', 'states', 'cities') ? 'subdrop active' : '' }}">
                                <i class="ti ti-map-pin-pin"></i><span>Location</span><span class="menu-arrow"></span>
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
                        <li><a class="{{ Request::is('testimonials') ? 'active' : '' }}"
                                href="{{ url('testimonials') }}"><i
                                    class="ti ti-quote"></i><span>Testimonials</span></a></li>
                        <li><a class="{{ Request::is('faq') ? 'active' : '' }}" href="{{ url('faq') }}"><i
                                    class="ti ti-question-mark"></i><span>FAQ</span></a></li>
                    </ul>
                </li>
                <li>
                    <h6 class="submenu-hdr">Support</h6>
                    <ul>
                        <li><a class="{{ Request::is('contact-messages') ? 'active' : '' }}"
                                href="{{ url('contact-messages') }}"><i class="ti ti-page-break"></i><span>Contact
                                    Messages</span></a></li>
                        <li><a class="{{ Request::is('tickets') ? 'active' : '' }}" href="{{ url('tickets') }}"><i
                                    class="ti ti-ticket"></i><span>Tickets</span></a></li>
                    </ul>
                </li>
                <li>
                    <h6 class="submenu-hdr">Settings</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('profile', 'security', 'notifications', 'connected-apps') ? 'subdrop active' : '' }}">
                                <i class="ti ti-settings-cog"></i><span>General Settings</span><span
                                    class="menu-arrow"></span>
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
                                class="{{ Request::is('company-settings', 'localization', 'prefixes', 'preference', 'appearance', 'language', 'language-web') ? 'subdrop active' : '' }}">
                                <i class="ti ti-world-cog"></i><span>Website Settings</span><span
                                    class="menu-arrow"></span>
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
                                class="{{ Request::is('invoice-settings', 'printers', 'custom-fields') ? 'subdrop active' : '' }}">
                                <i class="ti ti-apps"></i><span>App Settings</span><span class="menu-arrow"></span>
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
                                class="{{ Request::is('email-settings', 'sms-gateways', 'gdpr-cookies') ? 'subdrop active' : '' }}">
                                <i class="ti ti-device-laptop"></i><span>System Settings</span><span
                                    class="menu-arrow"></span>
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
                                class="{{ Request::is('payment-gateways', 'bank-accounts', 'tax-rates', 'currencies') ? 'subdrop active' : '' }}">
                                <i class="ti ti-moneybag"></i><span>Financial Settings</span><span
                                    class="menu-arrow"></span>
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
                                class="{{ Request::is('storage', 'ban-ip-address') ? 'subdrop active' : '' }}">
                                <i class="ti ti-flag-cog"></i><span>Other Settings</span><span
                                    class="menu-arrow"></span>
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
                <li>
                    <h6 class="submenu-hdr">Pages</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is('index', 'register', 'forgot-password', 'reset-password', 'email-verification', 'two-step-verification', 'lock-screen') ? 'subdrop active' : '' }}">
                                <i class="ti ti-lock-square-rounded"></i><span>Authentication</span><span
                                    class="menu-arrow"></span>
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
                                class="{{ Request::is('error-404', 'error-500') ? 'subdrop active' : '' }}">
                                <i class="ti ti-error-404"></i><span>Error Pages</span><span
                                    class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a class="{{ Request::is('error-404') ? 'active' : '' }}"
                                        href="{{ url('error-404') }}">404 Error</a></li>
                                <li><a class="{{ Request::is('error-500') ? 'active' : '' }}"
                                        href="{{ url('error-500') }}">500 Error</a></li>
                            </ul>
                        </li>
                        <li><a class="{{ Request::is('blank-page') ? 'active' : '' }}"
                                href="{{ url('blank-page') }}"><i class="ti ti-apps"></i><span>Blank Page</span></a>
                        </li>
                        <li><a class="{{ Request::is('coming-soon') ? 'active' : '' }}"
                                href="{{ url('coming-soon') }}"><i class="ti ti-device-laptop"></i><span>Coming
                                    Soon</span></a></li>
                        <li><a class="{{ Request::is('under-maintenance') ? 'active' : '' }}"
                                href="{{ url('under-maintenance') }}"><i class="ti ti-moneybag"></i><span>Under
                                    Maintenance</span></a></li>
                    </ul>
                </li>
                <li>
                    <h6 class="submenu-hdr">UI Interface</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="{{ Request::is(
                                    'ui-alerts',
                                    'ui-accordion',
                                    'ui-avatar',
                                    'ui-badges',
                                    'ui-borders',
                                    'ui-buttons',
                                    'ui-buttons-group',
                                    'ui-breadcrumb',
                                    'ui-cards',
                                    'ui-carousel',
                                    'ui-colors',
                                    'ui-dropdowns',
                                    'ui-grid',
                                    'ui-images',
                                    'ui-lightbox',
                                    'ui-media',
                                    'ui-modals',
                                    'ui-offcanvas',
                                    'ui-pagination',
                                    'ui-popovers',
                                    'ui-progress',
                                    'ui-placeholders',
                                    'ui-rangeslider',
                                    'ui-spinner',
                                    'ui-sweetalerts',
                                    'ui-nav-tabs',
                                    'ui-toasts',
                                    'ui-tooltips',
                                    'ui-typography',
                                    'ui-video',
                                    'ui-sortable',
                                    'ui-swiperjs'
                                )
                                    ? 'subdrop active'
                                    : '' }}">
                                <i class="ti ti-adjustments-check"></i><span>Base UI</span><span
                                    class="menu-arrow"></span>
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
                                class="{{ Request::is('ui-ribbon', 'ui-clipboard', 'ui-drag-drop', 'ui-rangeslider', 'ui-rating', 'ui-text-editor', 'ui-counter', 'ui-scrollbar', 'ui-stickynote', 'ui-timeline') ? 'subdrop active' : '' }}">
                                <i class="ti ti-box-align-bottom"></i><span>Advanced UI</span><span
                                    class="menu-arrow"></span>
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
                                class="{{ Request::is('chart-apex', 'chart-js', 'chart-morris', 'chart-flot', 'chart-peity', 'chart-c3') ? 'subdrop active' : '' }}"><i
                                    class="ti ti-chart-donut-2"></i>
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
                                class="{{ Request::is('icon-fontawesome', 'icon-feather', 'icon-ionic', 'icon-material', 'icon-pe7', 'icon-simpleline', 'icon-themify', 'icon-weather', 'icon-typicon', 'icon-flag', 'icon-tabler', 'icon-bootstrap', 'icon-remix') ? 'subdrop active' : '' }}"><i
                                    class="ti ti-icons"></i>
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
                            <a href="javascript:void(0);"
                                class="{{ Request::is('form-basic-inputs', 'form-pickers', 'form-checkbox-radios', 'form-input-groups', 'form-grid-gutters', 'form-select', 'form-mask', 'form-fileupload', 'form-horizontal', 'form-vertical', 'form-floating-labels', 'form-validation', 'form-wizard', 'form-select2') ? 'subdrop active' : '' }}">
                                <i class="ti ti-forms"></i><span>Forms</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);"
                                        class="{{ Request::is('form-basic-inputs', 'form-checkbox-radios', 'form-input-groups', 'form-grid-gutters', 'form-select', 'form-mask', 'form-fileupload') ? 'subdrop active' : '' }}">Form
                                        Elements<span class="menu-arrow inside-submenu"></span></a>
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
                                        class="{{ Request::is('form-horizontal', 'form-vertical', 'form-floating-labels') ? 'subdrop active' : '' }}">Layouts<span
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
                                class="{{ Request::is('tables-basic', 'data-tables') ? 'subdrop active' : '' }}"><i
                                    class="ti ti-table"></i><span>Tables</span><span class="menu-arrow"></span></a>
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
                                ><i class="ti ti-map"></i><span>Maps</span>
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
                    </ul>
                </li>
                <li>
                    <h6 class="submenu-hdr">Help</h6>
                    <ul>
                        <li><a href="javascript:void(0);"><i
                                    class="ti ti-file-type-doc"></i><span>Documentation</span></a></li>
                        <li><a href="javascript:void(0);"><i class="ti ti-arrow-capsule"></i><span>Changelog
                                    v2.1.9</span></a></li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="ti ti-brand-databricks"></i><span>Multi
                                    Level</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="javascript:void(0);">Level 1.1</a></li>
                                <li class="submenu submenu-two"><a href="javascript:void(0);">Level 1.2<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Level 2.1</a></li>
                                        <li class="submenu submenu-two submenu-three"><a
                                                href="javascript:void(0);">Level 2.2<span
                                                    class="menu-arrow inside-submenu inside-submenu-two"></span></a>
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
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
