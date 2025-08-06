<!DOCTYPE html>

@if (Route::is(['layout-mini']))
<html lang="en" data-layout="mini">
@elseif (Route::is(['layout-horizontal-single']))
	<html lang="en" data-layout="horizontal-single">
@elseif (Route::is(['layout-without-header']))
	<html lang="en" data-layout="without-header">
@elseif (Route::is(['layout-detached']))
    <html lang="en" data-layout="detached">
@elseif (Route::is(['layout-dark']))
    <html lang="en" data-theme="dark">
@else
	<html lang="en">
@endif

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Streamline your business with our advanced CRM template. Easily integrate and customize to manage sales, support, and customer interactions efficiently. Perfect for any business size">
    <meta name="keywords"
        content="Advanced CRM template, customer relationship management, business CRM, sales optimization, customer support software, CRM integration, customizable CRM, business tools, enterprise CRM solutions">
    <meta name="author" content="Dreams Technologies">
    <meta name="robots" content="index, follow">
    @if (Route::is(['activities']))
        <title>Activities | PCMI</title>
    @endif
    @if (Route::is(['activity-calls']))
        <title>Activities Calls | PCMI</title>
    @endif
    @if (Route::is(['activity-mail']))
        <title>Activities Mail | PCMI</title>
    @endif
    @if (Route::is(['activity-meeting']))
        <title>Activities Meeting | PCMI</title>
    @endif
    @if (Route::is(['activity-task']))
        <title>Activities Task | PCMI</title>
    @endif
    @if (Route::is(['analytics']))
        <title>Analytics | PCMI</title>
    @endif
    @if (Route::is(['appearance']))
        <title>Appearance | PCMI</title>
    @endif
    @if (Route::is(['audio-call']))
        <title>Audio Call | PCMI</title>
    @endif
    @if (Route::is(['ban-ip-address']))
        <title>Ban Ip Address | PCMI</title>
    @endif
    @if (Route::is(['bank-accounts']))
        <title>Bank Accounts | PCMI</title>
    @endif
    @if (Route::is(['blank-page']))
        <title>Blank Page | PCMI</title>
    @endif
    @if (Route::is(['calendar']))
        <title>Calendar | PCMI</title>
    @endif
    @if (Route::is(['call-history']))
        <title>Call History | PCMI</title>
    @endif
    @if (Route::is(['calls']))
        <title>Calls | PCMI</title>
    @endif
    @if (Route::is(['campaign-archieve']))
        <title>Campaign Archieve | PCMI</title>
    @endif
    @if (Route::is(['campaign-complete']))
        <title>Campaign Complete | PCMI</title>
    @endif
    @if (Route::is(['campaign']))
        <title>Campaign | PCMI</title>
    @endif
    @if (Route::is(['chart-apex']))
        <title>Chart Apex | PCMI</title>
    @endif
    @if (Route::is(['chart-c3']))
        <title>Chart C3 | PCMI</title>
    @endif
    @if (Route::is(['chart-flot']))
        <title>Chart Flot | PCMI</title>
    @endif
    @if (Route::is(['chart-js']))
        <title>Chart Js | PCMI</title>
    @endif
    @if (Route::is(['chart-morris']))
        <title>Chart Morris | PCMI</title>
    @endif
    @if (Route::is(['chart-peity']))
        <title>Chart Peity | PCMI</title>
    @endif
    @if (Route::is(['chat']))
        <title>Chat | PCMI</title>
    @endif
    @if (Route::is(['cities']))
        <title>Cities | PCMI</title>
    @endif
    @if (Route::is(['coming-soon']))
        <title>Coming Soon | PCMI</title>
    @endif
    @if (Route::is(['companies-grid']))
        <title>Companies Grid | PCMI</title>
    @endif
    @if (Route::is(['companies']))
        <title>Companies | PCMI</title>
    @endif
    @if (Route::is(['company-details']))
        <title>Company Details | PCMI</title>
    @endif
    @if (Route::is(['company-reports']))
        <title>Company Report | PCMI</title>
    @endif
    @if (Route::is(['company-settings']))
        <title>Company Settings | PCMI</title>
    @endif
    @if (Route::is(['connected-apps']))
        <title>Connected Apps | PCMI</title>
    @endif
    @if (Route::is(['contact-details']))
        <title>Contact Details | PCMI</title>
    @endif
    @if (Route::is(['contact-grid']))
        <title>Contact Grid | PCMI</title>
    @endif
    @if (Route::is(['contact-messages']))
        <title>Contact Message | PCMI</title>
    @endif
    @if (Route::is(['contact-reports']))
        <title>Contact Reports | PCMI</title>
    @endif
    @if (Route::is(['contact-stage']))
        <title>Contact Stage | PCMI</title>
    @endif
    @if (Route::is(['contacts']))
        <title>Contacts | PCMI</title>
    @endif
    @if (Route::is(['contracts-grid']))
        <title>Contracts Grid | PCMI</title>
    @endif
    @if (Route::is(['contracts']))
        <title>Contracts | PCMI</title>
    @endif
    @if (Route::is(['countries']))
        <title>Countries | PCMI</title>
    @endif
    @if (Route::is(['currencies']))
        <title>Currencies | PCMI</title>
    @endif
    @if (Route::is(['custom-fields']))
        <title>Custom Fields | PCMI</title>
    @endif
    @if (Route::is(['data-tables']))
        <title>Data Tables | PCMI</title>
    @endif
    @if (Route::is(['deal-reports']))
        <title>Deals Reports | PCMI</title>
    @endif
    @if (Route::is(['deals-dashboard']))
        <title>Deals Dashboard | PCMI</title>
    @endif
    @if (Route::is(['deals-details']))
        <title>Deals Details | PCMI</title>
    @endif
    @if (Route::is(['deals-kanban']))
        <title>Deals Kanban | PCMI</title>
    @endif
    @if (Route::is(['deals']))
        <title>Deals | PCMI</title>
    @endif
    @if (Route::is(['delete-request']))
        <title>Delete Request | PCMI</title>
    @endif
    @if (Route::is(['email-settings']))
        <title>Email Settings | PCMI</title>
    @endif
    @if (Route::is(['email-verification','email-verification-2','email-verification-3']))
        <title>Email Verification | PCMI</title>
    @endif
    @if (Route::is(['email']))
        <title>Email | PCMI</title>
    @endif
    @if (Route::is(['error-404']))
        <title>Error 404 | PCMI</title>
    @endif
    @if (Route::is(['error-500']))
        <title>Error 500 | PCMI</title>
    @endif
    @if (Route::is(['estimations-kanban']))
        <title>Estimation Kanban | PCMI</title>
    @endif
    @if (Route::is(['estimations']))
        <title>Estimations | PCMI</title>
    @endif
    @if (Route::is(['faq']))
        <title>Faq | PCMI</title>
    @endif
    @if (Route::is(['file-manager']))
        <title>File Manager | PCMI</title>
    @endif
    @if (Route::is(['forgot-password','forgot-password-2','forgot-password-3']))
        <title>Forgot Password | PCMI</title>
    @endif
    @if (Route::is(['form-basic-inputs']))
        <title>Form Basic Inputs | PCMI</title>
    @endif
    @if (Route::is(['form-checkbox-radios']))
        <title>Form Checkbox Radios | PCMI</title>
    @endif
    @if (Route::is(['form-elements']))
        <title>Form Elements | PCMI</title>
    @endif
    @if (Route::is(['form-fileupload']))
        <title>Form Fileupload | PCMI</title>
    @endif
    @if (Route::is(['form-floating-labels']))
        <title>Form Floating Labels | PCMI</title>
    @endif
    @if (Route::is(['form-grid-gutters']))
        <title>Form Grid Gutters | PCMI</title>
    @endif
    @if (Route::is(['form-horizontal']))
        <title>Form Horizontal | PCMI</title>
    @endif
    @if (Route::is(['form-input-groups']))
        <title>Form Input Groups | PCMI</title>
    @endif
    @if (Route::is(['form-mask']))
        <title>Form Mask | PCMI</title>
    @endif
    @if (Route::is(['form-select']))
        <title>Form Select | PCMI</title>
    @endif
    @if (Route::is(['form-select2']))
        <title>Form Select2 | PCMI</title>
    @endif
    @if (Route::is(['form-validation']))
        <title>Form Validation | PCMI</title>
    @endif
    @if (Route::is(['form-vertical']))
        <title>Form Vertical | PCMI</title>
    @endif
    @if (Route::is(['form-wizard']))
        <title>Form Wizard | PCMI</title>
    @endif
    @if (Route::is(['gdpr-cookies']))
        <title>Gdpr cookies | PCMI</title>
    @endif
    @if (Route::is(['icon-feather']))
        <title>Icon Feather | PCMI</title>
    @endif
    @if (Route::is(['icon-flag']))
        <title>Icon Flag | PCMI</title>
    @endif
    @if (Route::is(['icon-fontawesome']))
        <title>Icon Fontawesome | PCMI</title>
    @endif
    @if (Route::is(['icon-ionic']))
        <title>Icon Ionic | PCMI</title>
    @endif
    @if (Route::is(['icon-material']))
        <title>Icon Material | PCMI</title>
    @endif
    @if (Route::is(['icon-pe7']))
        <title>Icon pe7 | PCMI</title>
    @endif
    @if (Route::is(['icon-simpleline']))
        <title>Icon Simpleline | PCMI</title>
    @endif
    @if (Route::is(['icon-themify']))
        <title>Icon Themify | PCMI</title>
    @endif
    @if (Route::is(['icon-typicon']))
        <title>Icon Typicon | PCMI</title>
    @endif
    @if (Route::is(['icon-weather']))
        <title>Icon Weather | PCMI</title>
    @endif
    @if (Route::is(['index']))
        <title>Dashboard | PCMI</title>
    @endif
    @if (Route::is(['industry']))
        <title>Industry | PCMI</title>
    @endif
    @if (Route::is(['invoice-grid']))
        <title>Invoice Grid | PCMI</title>
    @endif
    @if (Route::is(['invoice-settings']))
        <title>Invoice Settings | PCMI</title>
    @endif
    @if (Route::is(['invoices']))
        <title>Invoice | PCMI</title>
    @endif
    @if (Route::is(['language']))
        <title>Language | PCMI</title>
    @endif
    @if (Route::is(['language-web']))
        <title>Language Web | PCMI</title>
    @endif
    @if (Route::is(['lead-reports']))
        <title>Lead Reports | PCMI</title>
    @endif
    @if (Route::is(['leads-dashboard']))
        <title>Leads Dashboard | PCMI</title>
    @endif
    @if (Route::is(['leads-details']))
        <title>Leads Details | PCMI</title>
    @endif
    @if (Route::is(['leads-kanban']))
        <title>Leads Kanban | PCMI</title>
    @endif
    @if (Route::is(['leads']))
        <title>Leads | PCMI</title>
    @endif
    @if (Route::is(['localization']))
        <title>Locatization | PCMI</title>
    @endif
    @if (Route::is(['lock-screen']))
        <title>Lock Screen | PCMI</title>
    @endif
    @if (Route::is(['login','login-2','login-3']))
        <title>Login | PCMI</title>
    @endif
    @if (Route::is(['lost-reason']))
        <title>Lost Reason | PCMI</title>
    @endif
    @if (Route::is(['manage-users']))
        <title>Manage users | PCMI</title>
    @endif
    @if (Route::is(['membership-addons']))
        <title>Membership Addons | PCMI</title>
    @endif
    @if (Route::is(['membership-plans']))
        <title>Membership Plans | PCMI</title>
    @endif
    @if (Route::is(['membership-transactions']))
        <title>Membership Transactions | PCMI</title>
    @endif
    @if (Route::is(['notes']))
        <title>Notes | PCMI</title>
    @endif
    @if (Route::is(['notifications']))
        <title>Notification | PCMI</title>
    @endif
    @if (Route::is(['pages']))
        <title>Pages | PCMI</title>
    @endif
    @if (Route::is(['pages-list']))
        <title>Pages | PCMI</title>
    @endif
    @if (Route::is(['payment-gateways']))
        <title>Payment Gateways | PCMI</title>
    @endif
    @if (Route::is(['payments']))
        <title>Payments | PCMI</title>
    @endif
    @if (Route::is(['permission']))
        <title>Permission | PCMI</title>
    @endif
    @if (Route::is(['pipeline']))
        <title>Pipeline | PCMI</title>
    @endif
    @if (Route::is(['preference']))
        <title>Perference | PCMI</title>
    @endif
    @if (Route::is(['prefixes']))
        <title>Prefixes | PCMI</title>
    @endif
    @if (Route::is(['printers']))
        <title>Printers | PCMI</title>
    @endif
    @if (Route::is(['profile']))
        <title>Profile | PCMI</title>
    @endif
    @if (Route::is(['project-dashboard']))
        <title>Project Dashboard | PCMI</title>
    @endif
    @if (Route::is(['project-details']))
        <title>Project Details | PCMI</title>
    @endif
    @if (Route::is(['project-grid']))
        <title>Project Grid | PCMI</title>
    @endif
    @if (Route::is(['project-reports']))
        <title>Project Reports | PCMI</title>
    @endif
    @if (Route::is(['project']))
        <title>Projects | PCMI</title>
    @endif
    @if (Route::is(['proposals-grid']))
        <title>Proposals Gird | PCMI</title>
    @endif
    @if (Route::is(['proposals']))
        <title>Proposals | PCMI</title>
    @endif
    @if (Route::is(['register','register-2','register-3']))
        <title>Register | PCMI</title>
    @endif
    @if (Route::is(['reset-password','reset-password-2','reset-password-3']))
        <title>Reset Password | PCMI</title>
    @endif
    @if (Route::is(['roles-permissions']))
        <title>Roles Permissions | PCMI</title>
    @endif
    @if (Route::is(['security']))
        <title>Security | PCMI</title>
    @endif
    @if (Route::is(['sms-gateways']))
        <title>Sms Gateways | PCMI</title>
    @endif
    @if (Route::is(['sources']))
        <title>Sources | PCMI</title>
    @endif
    @if (Route::is(['states']))
        <title>States | PCMI</title>
    @endif
    @if (Route::is(['storage']))
        <title>Storage | PCMI</title>
    @endif
    @if (Route::is(['success','success-2','success-3']))
        <title>Success | PCMI</title>
    @endif
    @if (Route::is(['tables-basic']))
        <title>Tables Basic | PCMI</title>
    @endif
    @if (Route::is(['task-reports']))
        <title>Task Reports | PCMI</title>
    @endif
    @if (Route::is(['tasks-completed']))
        <title>Tasks Completed | PCMI</title>
    @endif
    @if (Route::is(['tasks-important']))
        <title>Tasks Important | PCMI</title>
    @endif
    @if (Route::is(['tasks']))
        <title>Tasks | PCMI</title>
    @endif
    @if (Route::is(['tax-rates']))
        <title>Tax Rates | PCMI</title>
    @endif
    @if (Route::is(['testimonials']))
        <title>Testimonials | PCMI</title>
    @endif
    @if (Route::is(['tickets']))
        <title>Tickets | PCMI</title>
    @endif
    @if (Route::is(['todo']))
        <title>Todo | PCMI</title>
    @endif
    @if (Route::is(['two-step-verification','two-step-verification-2','two-step-verification-3']))
        <title>Two Step Verification | PCMI</title>
    @endif
    @if (Route::is(['ui-accordion']))
        <title>UI Accordion | PCMI</title>
    @endif
    @if (Route::is(['ui-alerts']))
        <title>UI Alerts | PCMI</title>
    @endif
    @if (Route::is(['ui-avatar']))
        <title>UI Avatar | PCMI</title>
    @endif
    @if (Route::is(['ui-badges']))
        <title>UI Badges | PCMI</title>
    @endif
    @if (Route::is(['ui-borders']))
        <title>UI Borders | PCMI</title>
    @endif
    @if (Route::is(['ui-breadcrumb']))
        <title>UI Breadcrumb | PCMI</title>
    @endif
    @if (Route::is(['ui-buttons-group']))
        <title>UI Buttons Group | PCMI</title>
    @endif
    @if (Route::is(['ui-buttons']))
        <title>UI Buttons | PCMI</title>
    @endif
    @if (Route::is(['ui-cards']))
        <title>UI Cards | PCMI</title>
    @endif
    @if (Route::is(['ui-carousel']))
        <title>UI Carousel | PCMI</title>
    @endif
    @if (Route::is(['ui-clipboard']))
        <title>UI Clipboard | PCMI</title>
    @endif
    @if (Route::is(['ui-colors']))
        <title>UI Colors | PCMI</title>
    @endif
    @if (Route::is(['ui-counter']))
        <title>UI Counter | PCMI</title>
    @endif
    @if (Route::is(['ui-drag-drop']))
        <title>UI Drag Drop | PCMI</title>
    @endif
    @if (Route::is(['ui-dropdowns']))
        <title>UI Dropdowns | PCMI</title>
    @endif
    @if (Route::is(['ui-grid']))
        <title>UI Grid | PCMI</title>
    @endif
    @if (Route::is(['ui-images']))
        <title>UI Images | PCMI</title>
    @endif
    @if (Route::is(['ui-lightbox']))
        <title>UI Lightbox | PCMI</title>
    @endif
    @if (Route::is(['ui-media']))
        <title>UI Media | PCMI</title>
    @endif
    @if (Route::is(['ui-modals']))
        <title>UI Modals | PCMI</title>
    @endif
    @if (Route::is(['ui-nav-tabs']))
        <title>UI Nav Tabs | PCMI</title>
    @endif
    @if (Route::is(['ui-offcanvas']))
        <title>UI Offcanvas | PCMI</title>
    @endif
    @if (Route::is(['ui-pagination']))
        <title>UI Pagination | PCMI</title>
    @endif
    @if (Route::is(['ui-placeholders']))
        <title>UI Placeholders | PCMI</title>
    @endif
    @if (Route::is(['ui-popovers']))
        <title>UI Popovers | PCMI</title>
    @endif
    @if (Route::is(['ui-progress']))
        <title>UI Progress | PCMI</title>
    @endif
    @if (Route::is(['ui-rangeslider']))
        <title>UI Rangslider | PCMI</title>
    @endif
    @if (Route::is(['ui-rating']))
        <title>UI Rating | PCMI</title>
    @endif
    @if (Route::is(['ui-ribbon']))
        <title>UI Ribbon | PCMI</title>
    @endif
    @if (Route::is(['ui-scrollbar']))
        <title>UI Scrollbar | PCMI</title>
    @endif
    @if (Route::is(['ui-spinner']))
        <title>UI Spinner | PCMI</title>
    @endif
    @if (Route::is(['ui-stickynote']))
        <title>UI Stickynote | PCMI</title>
    @endif
    @if (Route::is(['ui-sweetalerts']))
        <title>UI Sweetalerts | PCMI</title>
    @endif
    @if (Route::is(['ui-text-editor']))
        <title>UI Text Editor | PCMI</title>
    @endif
    @if (Route::is(['ui-timeline']))
        <title>UI Timeline | PCMI</title>
    @endif
    @if (Route::is(['ui-toasts']))
        <title>UI Toasts | PCMI</title>
    @endif
    @if (Route::is(['ui-tooltips']))
        <title>UI Tooltips | PCMI</title>
    @endif
    @if (Route::is(['ui-typography']))
        <title>UI Typography | PCMI</title>
    @endif
    @if (Route::is(['ui-video']))
        <title>UI Video | PCMI</title>
    @endif
    @if (Route::is(['under-maintenance']))
        <title>Under Maintenance | PCMI</title>
    @endif
    @if (Route::is(['video-call']))
        <title>Video Call | PCMI</title>
    @endif

    @include('layout.partials.head')
</head>

@if (
    !Route::is([
        'under-maintenance',
        'two-step-verification-3',
        'two-step-verification-2',
        'two-step-verification',
        'success-3',
        'success-2',
        'success',
        'reset-password-3',
        'reset-password-2',
        'reset-password',
        'register-3',
        'register-2',
        'register',
        'login-3',
        'login-2',
        'lock-screen',
        'coming-soon',
        'index',
    ]))
@endif

<body>
    @if (Route::is(['layout-mini']))
        <body class="mini-sidebar">
    @endif
    @if (Route::is(['layout-horizontal-single']))
        <body class="menu-horizontal">
    @endif
    @if (Route::is(['layout-rtl']))
        <body class="layout-mode-rtl">
    @endif
    
    @if (Route::is(['audio-call', 'chart-apex', 'chart-c3', 'chart-flot', 'chart-js', 'chart-morris', 'chart-peity']))
        <div id="global-loader">
            <div class="whirly-loader"> </div>
        </div>
    @endif
    @if (Route::is(['chat']))

        <body class="main-chat-blk">
    @endif
    @if (Route::is([
            'two-step-verification-3',
            'two-step-verification-2',
            'two-step-verification',
            'success-3',
            'success-2',
            'success',
            'reset-password-3',
            'reset-password-2',
            'reset-password',
            'register-3',
            'register-2',
            'register',
            'login-3',
            'login-2',
            'lock-screen',
            'index',
        ]))

        <body class="account-page">
    @endif
    @if (Route::is(['coming-soon']))

        <body class="comming-soon bg-white">
    @endif
    @if (Route::is(['error-404', 'error-500', 'under-maintenance']))

        <body class="error-page">
    @endif
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        @if (Route::is(['deals-dashboard', 'leads-dashboard', 'project-dashboard']))
            <div class="preloader">
                <span class="loader"></span>
            </div>
        @endif
        @if (
            !Route::is([
                'under-maintenance',
                'two-step-verification-3',
                'two-step-verification-2',
                'two-step-verification',
                'success-3',
                'success-2',
                'success',
                'reset-password-3',
                'reset-password-2',
                'reset-password',
                'register-3',
                'register-2',
                'register',
                'login-3',
                'login-2',
                'lock-screen',
                'coming-soon',
                'email-verification',
                'email-verification-2',
                'email-verification-3',
                'error-404',
                'error-500',
                'forgot-password',
                'forgot-password-2',
                'forgot-password-3',
                'index',
            ]))
            @include('layout.partials.header')
            @include('layout.partials.sidebar')
        @endif
        @yield('content')
    </div>
    <!-- /Main Wrapper -->

    @include('layout.partials.footer-scripts')
    @stack('scripts')
</body>

</html>
