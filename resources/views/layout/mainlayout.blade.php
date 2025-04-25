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
        <title>Activities | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['activity-calls']))
        <title>Activities Calls | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['activity-mail']))
        <title>Activities Mail | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['activity-meeting']))
        <title>Activities Meeting | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['activity-task']))
        <title>Activities Task | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['analytics']))
        <title>Analytics | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['appearance']))
        <title>Appearance | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['audio-call']))
        <title>Audio Call | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ban-ip-address']))
        <title>Ban Ip Address | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['bank-accounts']))
        <title>Bank Accounts | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['blank-page']))
        <title>Blank Page | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['calendar']))
        <title>Calendar | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['call-history']))
        <title>Call History | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['calls']))
        <title>Calls | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['campaign-archieve']))
        <title>Campaign Archieve | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['campaign-complete']))
        <title>Campaign Complete | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['campaign']))
        <title>Campaign | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['chart-apex']))
        <title>Chart Apex | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['chart-c3']))
        <title>Chart C3 | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['chart-flot']))
        <title>Chart Flot | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['chart-js']))
        <title>Chart Js | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['chart-morris']))
        <title>Chart Morris | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['chart-peity']))
        <title>Chart Peity | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['chat']))
        <title>Chat | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['cities']))
        <title>Cities | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['coming-soon']))
        <title>Coming Soon | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['companies-grid']))
        <title>Companies Grid | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['companies']))
        <title>Companies | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['company-details']))
        <title>Company Details | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['company-reports']))
        <title>Company Report | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['company-settings']))
        <title>Company Settings | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['connected-apps']))
        <title>Connected Apps | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['contact-details']))
        <title>Contact Details | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['contact-grid']))
        <title>Contact Grid | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['contact-messages']))
        <title>Contact Message | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['contact-reports']))
        <title>Contact Reports | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['contact-stage']))
        <title>Contact Stage | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['contacts']))
        <title>Contacts | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['contracts-grid']))
        <title>Contracts Grid | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['contracts']))
        <title>Contracts | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['countries']))
        <title>Countries | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['currencies']))
        <title>Currencies | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['custom-fields']))
        <title>Custom Fields | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['data-tables']))
        <title>Data Tables | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['deal-reports']))
        <title>Deals Reports | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['deals-dashboard']))
        <title>Deals Dashboard | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['deals-details']))
        <title>Deals Details | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['deals-kanban']))
        <title>Deals Kanban | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['deals']))
        <title>Deals | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['delete-request']))
        <title>Delete Request | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['email-settings']))
        <title>Email Settings | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['email-verification','email-verification-2','email-verification-3']))
        <title>Email Verification | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['email']))
        <title>Email | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['error-404']))
        <title>Error 404 | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['error-500']))
        <title>Error 500 | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['estimations-kanban']))
        <title>Estimation Kanban | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['estimations']))
        <title>Estimations | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['faq']))
        <title>Faq | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['file-manager']))
        <title>File Manager | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['forgot-password','forgot-password-2','forgot-password-3']))
        <title>Forgot Password | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['form-basic-inputs']))
        <title>Form Basic Inputs | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['form-checkbox-radios']))
        <title>Form Checkbox Radios | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['form-elements']))
        <title>Form Elements | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['form-fileupload']))
        <title>Form Fileupload | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['form-floating-labels']))
        <title>Form Floating Labels | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['form-grid-gutters']))
        <title>Form Grid Gutters | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['form-horizontal']))
        <title>Form Horizontal | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['form-input-groups']))
        <title>Form Input Groups | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['form-mask']))
        <title>Form Mask | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['form-select']))
        <title>Form Select | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['form-select2']))
        <title>Form Select2 | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['form-validation']))
        <title>Form Validation | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['form-vertical']))
        <title>Form Vertical | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['form-wizard']))
        <title>Form Wizard | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['gdpr-cookies']))
        <title>Gdpr cookies | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['icon-feather']))
        <title>Icon Feather | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['icon-flag']))
        <title>Icon Flag | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['icon-fontawesome']))
        <title>Icon Fontawesome | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['icon-ionic']))
        <title>Icon Ionic | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['icon-material']))
        <title>Icon Material | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['icon-pe7']))
        <title>Icon pe7 | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['icon-simpleline']))
        <title>Icon Simpleline | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['icon-themify']))
        <title>Icon Themify | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['icon-typicon']))
        <title>Icon Typicon | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['icon-weather']))
        <title>Icon Weather | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['index']))
        <title>Dashboard | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['industry']))
        <title>Industry | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['invoice-grid']))
        <title>Invoice Grid | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['invoice-settings']))
        <title>Invoice Settings | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['invoices']))
        <title>Invoice | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['language']))
        <title>Language | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['language-web']))
        <title>Language Web | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['lead-reports']))
        <title>Lead Reports | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['leads-dashboard']))
        <title>Leads Dashboard | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['leads-details']))
        <title>Leads Details | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['leads-kanban']))
        <title>Leads Kanban | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['leads']))
        <title>Leads | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['localization']))
        <title>Locatization | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['lock-screen']))
        <title>Lock Screen | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['login','login-2','login-3']))
        <title>Login | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['lost-reason']))
        <title>Lost Reason | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['manage-users']))
        <title>Manage users | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['membership-addons']))
        <title>Membership Addons | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['membership-plans']))
        <title>Membership Plans | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['membership-transactions']))
        <title>Membership Transactions | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['notes']))
        <title>Notes | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['notifications']))
        <title>Notification | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['pages']))
        <title>Pages | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['pages-list']))
        <title>Pages | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['payment-gateways']))
        <title>Payment Gateways | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['payments']))
        <title>Payments | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['permission']))
        <title>Permission | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['pipeline']))
        <title>Pipeline | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['preference']))
        <title>Perference | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['prefixes']))
        <title>Prefixes | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['printers']))
        <title>Printers | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['profile']))
        <title>Profile | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['project-dashboard']))
        <title>Project Dashboard | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['project-details']))
        <title>Project Details | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['project-grid']))
        <title>Project Grid | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['project-reports']))
        <title>Project Reports | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['project']))
        <title>Projects | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['proposals-grid']))
        <title>Proposals Gird | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['proposals']))
        <title>Proposals | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['register','register-2','register-3']))
        <title>Register | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['reset-password','reset-password-2','reset-password-3']))
        <title>Reset Password | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['roles-permissions']))
        <title>Roles Permissions | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['security']))
        <title>Security | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['sms-gateways']))
        <title>Sms Gateways | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['sources']))
        <title>Sources | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['states']))
        <title>States | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['storage']))
        <title>Storage | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['success','success-2','success-3']))
        <title>Success | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['tables-basic']))
        <title>Tables Basic | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['task-reports']))
        <title>Task Reports | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['tasks-completed']))
        <title>Tasks Completed | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['tasks-important']))
        <title>Tasks Important | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['tasks']))
        <title>Tasks | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['tax-rates']))
        <title>Tax Rates | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['testimonials']))
        <title>Testimonials | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['tickets']))
        <title>Tickets | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['todo']))
        <title>Todo | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['two-step-verification','two-step-verification-2','two-step-verification-3']))
        <title>Two Step Verification | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-accordion']))
        <title>UI Accordion | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-alerts']))
        <title>UI Alerts | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-avatar']))
        <title>UI Avatar | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-badges']))
        <title>UI Badges | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-borders']))
        <title>UI Borders | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-breadcrumb']))
        <title>UI Breadcrumb | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-buttons-group']))
        <title>UI Buttons Group | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-buttons']))
        <title>UI Buttons | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-cards']))
        <title>UI Cards | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-carousel']))
        <title>UI Carousel | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-clipboard']))
        <title>UI Clipboard | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-colors']))
        <title>UI Colors | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-counter']))
        <title>UI Counter | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-drag-drop']))
        <title>UI Drag Drop | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-dropdowns']))
        <title>UI Dropdowns | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-grid']))
        <title>UI Grid | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-images']))
        <title>UI Images | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-lightbox']))
        <title>UI Lightbox | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-media']))
        <title>UI Media | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-modals']))
        <title>UI Modals | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-nav-tabs']))
        <title>UI Nav Tabs | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-offcanvas']))
        <title>UI Offcanvas | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-pagination']))
        <title>UI Pagination | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-placeholders']))
        <title>UI Placeholders | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-popovers']))
        <title>UI Popovers | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-progress']))
        <title>UI Progress | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-rangeslider']))
        <title>UI Rangslider | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-rating']))
        <title>UI Rating | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-ribbon']))
        <title>UI Ribbon | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-scrollbar']))
        <title>UI Scrollbar | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-spinner']))
        <title>UI Spinner | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-stickynote']))
        <title>UI Stickynote | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-sweetalerts']))
        <title>UI Sweetalerts | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-text-editor']))
        <title>UI Text Editor | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-timeline']))
        <title>UI Timeline | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-toasts']))
        <title>UI Toasts | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-tooltips']))
        <title>UI Tooltips | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-typography']))
        <title>UI Typography | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['ui-video']))
        <title>UI Video | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['under-maintenance']))
        <title>Under Maintenance | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
    @endif
    @if (Route::is(['video-call']))
        <title>Video Call | CRMS - Advanced Bootstrap 5 Admin Template for Customer Management</title>
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
</body>

</html>
