<div class="card">
    <div class="card-body pb-0 pt-2">
        <ul class="nav nav-tabs nav-tabs-bottom">
            <li class="nav-item me-3">
                <a href="{{url('profile')}}" class="nav-link px-0 {{ Request::is('connected-apps','notifications','profile','security') ? 'active' : '' }}">
                    <i class="ti ti-settings-cog me-2"></i> General Settings
                </a>
            </li>
            <li class="nav-item me-3">
                <a href="{{url('company-settings')}}" class="nav-link px-0 {{ Request::is('appearance','company-settings','language-web','language','localization','preference','prefixes') ? 'active' : '' }}">
                    <i class="ti ti-world-cog me-2"></i> Website Settings
                </a>
            </li>
            <li class="nav-item me-3">
                <a href="{{url('invoice-settings')}}" class="nav-link px-0 {{ Request::is('custom-fields','invoice-settings','printers') ? 'active' : '' }}">
                    <i class="ti ti-apps me-2"></i> App Settings
                </a>
            </li>
            <li class="nav-item me-3">
                <a href="{{url('email-settings')}}" class="nav-link px-0 {{ Request::is('email-settings','gdpr-cookies','sms-gateways') ? 'active' : '' }}">
                    <i class="ti ti-device-laptop me-2"></i> System Settings
                </a>
            </li>
            <li class="nav-item me-3">
                <a href="{{url('payment-gateways')}}" class="nav-link px-0 {{ Request::is('bank-accounts','currencies','payment-gateways','tax-rates') ? 'active' : '' }}">
                    <i class="ti ti-moneybag me-2"></i> Financial Settings
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('storage')}}" class="nav-link px-0 {{ Request::is('ban-ip-address','storage') ? 'active' : '' }}">
                    <i class="ti ti-flag-cog me-2"></i> Other Settings
                </a>
            </li>
        </ul>
    </div>
</div>