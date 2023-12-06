<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('POS') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('DigiMart') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="/">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="false">
                    <i class="tim-icons icon-settings" ></i>
                    <span class="nav-link-text" >{{ __('Master') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'supplier') class="active " @endif>
                            <a href="/Supplier">
                                <i class="tim-icons icon-delivery-fast"></i>
                                <p>{{ __('Supplier') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'product') class="active " @endif>
                            <a href="/Produk">
                                <i class="tim-icons icon-app"></i>
                                <p>{{ __('Produk') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'customer') class="active " @endif>
                            <a href="/Customer">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ __('Customer') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @if ($pageSlug == 'sales') class="active " @endif>
                <a href="/Sales">
                    <i class="tim-icons icon-cart"></i>
                    <p>{{ __('Sales') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
