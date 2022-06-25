@can('dashboard_screen')
    @if (auth()->guard('web')->check() ||
        auth()->user()->can('dashboard_access'))
        <li class="menu-item  {{ request()->is('outlets/dashboard') ? 'menu-item-active' : '' }}" aria-haspopup="true"><a
                href="{{ route('outlets.dashboard') }}" class="menu-link">
                <i class="menu-icon  fas fa-tachometer-alt"></i>
                <span class="menu-text">Dashboard</span></a>
        </li>
    @endif
@endcan

{{-- <li class="menu-item {{ (request()->is('outlets/registration*')) ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><span class="svg-icon menu-icon">
            <!--begin::Svg Icon | path:media/svg/icons/Shopping/Cart2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"></rect>
                    <path d="M12,4.56204994 L7.76822128,9.6401844 C7.4146572,10.0644613 6.7840925,10.1217854 6.3598156,9.76822128 C5.9355387,9.4146572 5.87821464,8.7840925 6.23177872,8.3598156 L11.2317787,2.3598156 C11.6315738,1.88006147 12.3684262,1.88006147 12.7682213,2.3598156 L17.7682213,8.3598156 C18.1217854,8.7840925 18.0644613,9.4146572 17.6401844,9.76822128 C17.2159075,10.1217854 16.5853428,10.0644613 16.2317787,9.6401844 L12,4.56204994 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                    <path d="M3.28077641,9 L20.7192236,9 C21.2715083,9 21.7192236,9.44771525 21.7192236,10 C21.7192236,10.0817618 21.7091962,10.163215 21.6893661,10.2425356 L19.5680983,18.7276069 C19.234223,20.0631079 18.0342737,21 16.6576708,21 L7.34232922,21 C5.96572629,21 4.76577697,20.0631079 4.43190172,18.7276069 L2.31063391,10.2425356 C2.17668518,9.70674072 2.50244587,9.16380623 3.03824078,9.0298575 C3.11756139,9.01002735 3.1990146,9 3.28077641,9 Z M12,12 C11.4477153,12 11,12.4477153 11,13 L11,17 C11,17.5522847 11.4477153,18 12,18 C12.5522847,18 13,17.5522847 13,17 L13,13 C13,12.4477153 12.5522847,12 12,12 Z M6.96472382,12.1362967 C6.43125772,12.2792385 6.11467523,12.8275755 6.25761704,13.3610416 L7.29289322,17.2247449 C7.43583503,17.758211 7.98417199,18.0747935 8.51763809,17.9318517 C9.05110419,17.7889098 9.36768668,17.2405729 9.22474487,16.7071068 L8.18946869,12.8434035 C8.04652688,12.3099374 7.49818992,11.9933549 6.96472382,12.1362967 Z M17.0352762,12.1362967 C16.5018101,11.9933549 15.9534731,12.3099374 15.8105313,12.8434035 L14.7752551,16.7071068 C14.6323133,17.2405729 14.9488958,17.7889098 15.4823619,17.9318517 C16.015828,18.0747935 16.564165,17.758211 16.7071068,17.2247449 L17.742383,13.3610416 C17.8853248,12.8275755 17.5687423,12.2792385 17.0352762,12.1362967 Z" fill="#000000"></path>
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span><span class="menu-text">Outlets</span><i class="menu-arrow"></i></a>
    <div class="menu-submenu "><span class="menu-arrow"></span>
        <ul class="menu-subnav">

            <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span class="menu-text">Outlets</span></span></li>
            <li class="menu-item" aria-haspopup="true"><a href="{{route('outlets.index')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">All Outlets</span></a></li>
            <li class="menu-item {{ (request()->is('outlets/registration')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('registration.index')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Registration Details</span></a></li>
            <li class="menu-item {{ (request()->is('outlets/registration/create')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('registration.create')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add Registration Details</span></a></li>
        </ul>
    </div>
</li> --}}

@can('sales_screen')
    @if (auth()->guard('web')->check() ||
        auth()->user()->can('sales_access'))
        <li class="menu-item {{ request()->is('outlets/sales-orders*') || request()->is('outlets/sales-order-details*') || request()->is('outlets/sales') || request()->is('outlets/purchase-orders/return/history') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
            aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle">
                <i class="menu-icon fas fa-cash-register"></i>
                <span class="menu-text">Sales</span><i class="menu-arrow"></i></a>
            <div class="menu-submenu "><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('sales_create'))
                        <li class="menu-item {{ request()->is('outlets/sales') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true">
                            <a href="{{ route('sales.index') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span
                                    class="menu-text">POS</span></a>
                        </li>
                    @endif
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('sales_access'))
                        <li class="menu-item {{ request()->is('outlets/sales-orders') || request()->is('outlets/sales-order-details*') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('sales-orders') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Sales
                                    List</span></a></li>
                        <li class="menu-item {{ request()->is('outlets/purchase-orders/return/history') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('purchase-orders.return') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Return
                                    List</span></a></li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
@endcan

@can('airline_sales_screen')
    <li class="menu-item {{ request()->is('outlets/airline-orders*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
        aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                class="menu-icon flaticon2-list"></i><span class="menu-text">Orders</span><i class="menu-arrow"></i></a>
        <div class="menu-submenu "><span class="menu-arrow"></span>
            <ul class="menu-subnav">
                <li class="menu-item {{ request()->is('outlets/airline-orders/create') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('airline-orders.create') }}" class="menu-link "><i
                            class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Create
                            Order</span></a></li>
                <li class="menu-item {{ request()->is('outlets/airline-orders') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('airline-orders.index') }}" class="menu-link "><i
                            class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Order
                            List</span></a></li>
            </ul>
        </div>
    </li>
@endcan
@can('airline_screens')
    <li class="menu-item {{ request()->is('outlets/airline-tickets') ? 'menu-item-active' : '' }}" aria-haspopup="true">
        <a href="{{ route('airline-tickets.index') }}" class="menu-link "><i
                class="menu-icon fas fa-ticket-alt"><span></span></i><span class="menu-text">Ticket
                List</span></a>
    </li>
    <li class="menu-item {{ request()->is('outlets/parties*') || request()->is('outlets/party-accounts*') || request()->is('outlets/party-transaction*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
        aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                class="menu-icon fas fa-people-arrows"></i><span class="menu-text">Parties</span><i
                class="menu-arrow"></i></a>
        <div class="menu-submenu "><span class="menu-arrow"></span>
            <ul class="menu-subnav">
                <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span
                            class="menu-text">Supplier</span></span></li>
                <li class="menu-item {{ request()->is('outlets/parties/create') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('parties.create') }}" class="menu-link "><i
                            class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add
                            Party</span></a></li>
                <li class="menu-item {{ request()->is('outlets/parties') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('parties.index') }}" class="menu-link "><i
                            class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Party
                            List</span></a></li>
                <li class="menu-item {{ request()->is('outlets/party-accounts*') || request()->is('outlets/party-transaction*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
                    aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                            class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Party
                            Account</span><i class="menu-arrow"></i></a>
                    <div class="menu-submenu "><span class="menu-arrow"></span>
                        <ul class="menu-subnav">
                            <li class="menu-item {{ request()->is('outlets/party-accounts/create') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true"><a href="{{ route('party-accounts.create') }}"
                                    class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                        class="menu-text">Add Payment</span></a></li>
                            <li class="menu-item {{ request()->is('outlets/party-accounts') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true"><a href="{{ route('party-accounts.index') }}"
                                    class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span
                                        class="menu-text">Transaction List</span></a></li>
                            <li class="menu-item {{ request()->is('outlets/party-transaction') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true"><a href="{{ route('party-transactions') }}" class="menu-link "><i
                                        class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Party
                                        Transaction</span></a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </li>

    <li class="menu-item {{ request()->is('outlets/outlet-discounts*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
        aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                class="menu-icon flaticon-price-tag"></i><span class="menu-text">Outlet Discount</span><i
                class="menu-arrow"></i></a>
        <div class="menu-submenu "><span class="menu-arrow"></span>
            <ul class="menu-subnav">
                <li class="menu-item {{ request()->is('outlets/outlet-discounts/create') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('outlet-discounts.create') }}" class="menu-link "><i
                            class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add
                            Discount</span></a></li>
                <li class="menu-item {{ request()->is('outlets/outlet-discounts') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('outlet-discounts.index') }}" class="menu-link "><i
                            class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Outlet
                            Discount List</span></a></li>
            </ul>
        </div>
    </li>
    <li class="menu-item {{ request()->is('outlets/outlet-taxes*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
        aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                class="menu-icon flaticon-price-tag"></i><span class="menu-text">Outlet Tax</span><i
                class="menu-arrow"></i></a>
        <div class="menu-submenu "><span class="menu-arrow"></span>
            <ul class="menu-subnav">
                <li class="menu-item {{ request()->is('outlets/outlet-taxes/create') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('outlet-taxes.create') }}" class="menu-link "><i
                            class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add
                            Tax</span></a></li>
                <li class="menu-item {{ request()->is('outlets/outlet-taxes') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('outlet-taxes.index') }}" class="menu-link "><i
                            class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Outlet
                            Tax
                            List</span></a></li>
            </ul>
        </div>
    </li>
    <li class="menu-item {{ request()->is('outlets/outlet-commissions*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
        aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                class="menu-icon flaticon-price-tag"></i><span class="menu-text">Outlet Commission</span><i
                class="menu-arrow"></i></a>
        <div class="menu-submenu "><span class="menu-arrow"></span>
            <ul class="menu-subnav">
                <li class="menu-item {{ request()->is('outlets/outlet-commissions/create') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('outlet-commissions.create') }}" class="menu-link "><i
                            class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add
                            Commission</span></a></li>
                <li class="menu-item {{ request()->is('outlets/outlet-commissions') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('outlet-commissions.index') }}" class="menu-link "><i
                            class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Outlet
                            Commission List</span></a></li>
            </ul>
        </div>
    </li>
@endcan

@can('products_screen')
    @if (auth()->guard('web')->check() ||
        auth()->user()->can('product_access'))
        <li class="menu-item {{ request()->is('outlets/products*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
            aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                    class="menu-icon fas fa-shopping-cart"></i><span class="menu-text">Product</span><i
                    class="menu-arrow"></i></a>
            <div class="menu-submenu "><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('product_create'))
                        <li class="menu-item {{ request()->is('outlets/products/create') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('products.create') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add
                                    Product</span></a></li>
                    @endif
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('product_access'))
                        <li class="menu-item {{ request()->is('outlets/products') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('products.index') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Product
                                    List</span></a></li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
@endcan
@can('variation_screen')
    @if (auth()->guard('web')->check() ||
        auth()->user()->can('variation_access'))
        <li class="menu-item {{ request()->is('outlets/variations*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
            aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                    class="menu-icon fas fa-layer-group"></i><span class="menu-text">Variations</span><i
                    class="menu-arrow"></i></a>
            <div class="menu-submenu "><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('variation_create'))
                        <li class="menu-item {{ request()->is('outlets/variations/create') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('variations.create') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add
                                    Variation</span></a></li>
                    @endif
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('variation_access'))
                        <li class="menu-item {{ request()->is('outlets/variations') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('variations.index') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span
                                    class="menu-text">Variations
                                    List</span></a></li>
                    @endif
                </ul>
            </div>
        </li>
    @endif

    @if (auth()->guard('web')->check() ||
        auth()->user()->can('product_variation_access'))
        <li class="menu-item {{ request()->is('outlets/product-variations*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
            aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                    class="menu-icon fas fa-shopping-cart"></i><span class="menu-text">Product Variation</span><i
                    class="menu-arrow"></i></a>
            <div class="menu-submenu "><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('product_variation_create'))
                        <li class="menu-item {{ request()->is('outlets/product-variations/create') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('product-variations.create') }}"
                                class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                    class="menu-text">Add Product
                                    Variation</span></a></li>
                    @endif
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('product_variation_access'))
                        <li class="menu-item {{ request()->is('outlets/product-variations') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('product-variations.index') }}"
                                class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                    class="menu-text">Product
                                    Variation List</span></a></li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
@endcan
@can('product_stock_screen')
    @if (auth()->guard('web')->check() ||
        auth()->user()->can('stock_access'))
        <li class="menu-item {{ request()->is('outlets/product-stock*') && !request()->is('outlets/product-stock/update-stock') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
            aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                    class="menu-icon fas fa-boxes"></i><span class="menu-text">Product Stock</span><i
                    class="menu-arrow"></i></a>
            <div class="menu-submenu "><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('stock_create'))
                        <li class="menu-item {{ request()->is('outlets/product-stock/add-old-stock') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('product-stock.create-old-stock') }}"
                                class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                    class="menu-text">Add Old
                                    Stock</span></a></li>
                        <li class="menu-item {{ request()->is('outlets/product-stock/create') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('product-stock.create') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add
                                    Stock</span></a></li>
                    @endif
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('stock_access'))
                        <li class="menu-item {{ request()->is('outlets/product-stock') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('product-stock.index') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Stock
                                    List</span></a></li>
                        <li class="menu-item {{ request()->is('outlets/product-stock/low-stock') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('product-stock.low-stock') }}"
                                class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                    class="menu-text">Low
                                    Stock</span></a></li>
                    @endif

                </ul>
            </div>
        </li>
    @endif
@endcan





@can('expense_screen')
    @if (auth()->guard('web')->check() ||
        auth()->user()->can('expense_category_access') ||
        auth()->user()->can('expense_transaction_access'))
        <li class="menu-item {{ request()->is('outlets/expenses*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
            aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                    class="menu-icon fas fa-wallet"></i><span class="menu-text">Expense</span><i
                    class="menu-arrow"></i></a>
            <div class="menu-submenu "><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('expense_transaction_access'))
                        <li class="menu-item  {{ request()->is('outlets/expenses/expense-transaction*') ? 'menu-item-open menu-item-active' : '' }} menu-item-submenu"
                            aria-haspopup="true" data-menu-toggle="hover"><a href="#"
                                class="menu-link menu-toggle"><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Expense
                                    Transaction</span><i class="menu-arrow"></i></a>
                            <div class="menu-submenu "><span class="menu-arrow"></span>
                                <ul class="menu-subnav">
                                    @if (auth()->guard('web')->check() ||
                                        auth()->user()->can('expense_transaction_create'))
                                        <li class="menu-item {{ request()->is('outlets/expenses/expense-transaction/create') ? 'menu-item-active' : '' }}"
                                            aria-haspopup="true"><a href="{{ route('expense-transaction.create') }}"
                                                class="menu-link "><i
                                                    class="menu-bullet menu-bullet-dot"><span></span></i><span
                                                    class="menu-text">Add Expense</span></a></li>
                                    @endif
                                    @if (auth()->guard('web')->check() ||
                                        auth()->user()->can('expense_transaction_access'))
                                        <li class="menu-item {{ request()->is('outlets/expenses/expense-transaction') ? 'menu-item-active' : '' }}"
                                            aria-haspopup="true"><a href="{{ route('expense-transaction.index') }}"
                                                class="menu-link "><i
                                                    class="menu-bullet menu-bullet-dot"><span></span></i><span
                                                    class="menu-text">Expense List</span></a></li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                    @endif
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('expense_category_access'))
                        <li class="menu-item  {{ request()->is('outlets/expenses/expense-category*') ? 'menu-item-open menu-item-active' : '' }} menu-item-submenu"
                            aria-haspopup="true" data-menu-toggle="hover"><a href="#"
                                class="menu-link menu-toggle"><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Expense
                                    Category</span><i class="menu-arrow"></i></a>
                            <div class="menu-submenu "><span class="menu-arrow"></span>
                                <ul class="menu-subnav">
                                    @if (auth()->guard('web')->check() ||
                                        auth()->user()->can('expense_category_create'))
                                        <li class="menu-item {{ request()->is('outlets/expenses/expense-category/create') ? 'menu-item-active' : '' }}"
                                            aria-haspopup="true"><a href="{{ route('expense-category.create') }}"
                                                class="menu-link "><i
                                                    class="menu-bullet menu-bullet-dot"><span></span></i><span
                                                    class="menu-text">Add Expense Category</span></a></li>
                                    @endif
                                    @if (auth()->guard('web')->check() ||
                                        auth()->user()->can('expense_category_access'))
                                        <li class="menu-item {{ request()->is('outlets/expenses/expense-category') ? 'menu-item-active' : '' }}"
                                            aria-haspopup="true"><a href="{{ route('expense-category.index') }}"
                                                class="menu-link "><i
                                                    class="menu-bullet menu-bullet-dot"><span></span></i><span
                                                    class="menu-text">Expense Category List</span></a></li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
@endcan
@can('cashbook_screen')
    @if (auth()->guard('web')->check() ||
        auth()->user()->can('cashbook_access') ||
        auth()->user()->can('payment_categories_access'))
        <li class="menu-item {{ request()->is('outlets/payment-categories*') || request()->is('outlets/cashbook*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
            aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                    class="menu-icon fas fa-book-open"></i><span class="menu-text">Cashbook</span><i
                    class="menu-arrow"></i></a>
            <div class="menu-submenu "><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('cashbook_access'))
                        <li class="menu-item {{ request()->is('outlets/cashbook*') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('cashbook.index') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span
                                    class="menu-text">Cashbook</span></a></li>
                    @endif
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('payment_categories_access'))
                        <li class="menu-item  {{ request()->is('outlets/payment-categories*') ? 'menu-item-open menu-item-active' : '' }} menu-item-submenu"
                            aria-haspopup="true" data-menu-toggle="hover"><a href="#"
                                class="menu-link menu-toggle"><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Payment
                                    Categories</span><i class="menu-arrow"></i></a>
                            <div class="menu-submenu "><span class="menu-arrow"></span>
                                <ul class="menu-subnav">
                                    @if (auth()->guard('web')->check() ||
                                        auth()->user()->can('payment_categories_create'))
                                        <li class="menu-item {{ request()->is('outlets/payment-categories/create') ? 'menu-item-active' : '' }}"
                                            aria-haspopup="true"><a href="{{ route('payment-categories.create') }}"
                                                class="menu-link "><i
                                                    class="menu-bullet menu-bullet-dot"><span></span></i><span
                                                    class="menu-text">Add Payment
                                                    Category</span></a></li>
                                    @endif
                                    @if (auth()->guard('web')->check() ||
                                        auth()->user()->can('payment_categories_access'))
                                        <li class="menu-item {{ request()->is('outlets/payment-categories') ? 'menu-item-active' : '' }}"
                                            aria-haspopup="true"><a href="{{ route('payment-categories.index') }}"
                                                class="menu-link "><i
                                                    class="menu-bullet menu-bullet-dot"><span></span></i><span
                                                    class="menu-text">Payment
                                                    Categories List</span></a></li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                    @endif

                </ul>
            </div>
        </li>
    @endif
@endcan

@can('category_screen')
    @if (auth()->guard('web')->check() ||
        auth()->user()->can('category_access'))
        <li class="menu-item {{ request()->is('outlets/categories*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
            aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                    class="menu-icon fas fa-list-alt "></i><span class="menu-text">Category</span><i
                    class="menu-arrow"></i></a>
            <div class="menu-submenu "><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('category_create'))
                        <li class="menu-item {{ request()->is('outlets/categories/create') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('categories.create') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add
                                    Category</span></a></li>
                    @endif
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('category_access'))
                        <li class="menu-item {{ request()->is('outlets/categories') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('categories.index') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span
                                    class="menu-text">Categories
                                    List</span></a></li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
@endcan



@can('company_screen')
    @if (auth()->guard('web')->check() ||
        auth()->user()->can('company_access'))
        <li class="menu-item {{ request()->is('outlets/companies*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
            aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                    class="menu-icon fas fa-building"></i><span class="menu-text">Company</span><i
                    class="menu-arrow"></i></a>
            <div class="menu-submenu "><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('company_create'))
                        <li class="menu-item {{ request()->is('outlets/companies/create') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('companies.create') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add
                                    Company</span></a></li>
                    @endif
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('company_access'))
                        <li class="menu-item {{ request()->is('outlets/companies') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('companies.index') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span
                                    class="menu-text">Companies
                                    List</span></a></li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
@endcan

@can('supplier_screen')
    @if (auth()->guard('web')->check() ||
        auth()->user()->can('supplier_access') ||
        auth()->user()->can('supplier_account_access'))
        <li class="menu-item {{ request()->is('outlets/suppliers*') || request()->is('outlets/supplier-accounts*') || request()->is('outlets/supplier-transaction*') || request()->is('outlets/assign-company') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
            aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                    class="menu-icon fas fa-truck-moving"></i><span class="menu-text">Supplier</span><i
                    class="menu-arrow"></i></a>
            <div class="menu-submenu "><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('supplier_create'))
                        <li class="menu-item {{ request()->is('outlets/suppliers/create') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('suppliers.create') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add
                                    Supplier</span></a></li>
                    @endif
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('supplier_access'))
                        <li class="menu-item {{ request()->is('outlets/assign-company') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('assign-company.create') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Assign
                                    Company</span></a></li>

                        <li class="menu-item {{ request()->is('outlets/suppliers') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('suppliers.index') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Supplier
                                    List</span></a></li>
                    @endif
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('supplier_account_access'))
                        <li class="menu-item {{ request()->is('outlets/supplier-accounts*') || request()->is('outlets/supplier-transaction*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
                            aria-haspopup="true" data-menu-toggle="hover"><a href="#"
                                class="menu-link menu-toggle"><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Suppler
                                    Account</span><i class="menu-arrow"></i></a>
                            <div class="menu-submenu "><span class="menu-arrow"></span>
                                <ul class="menu-subnav">
                                    @if (auth()->guard('web')->check() ||
                                        auth()->user()->can('supplier_transaction_create'))
                                        <li class="menu-item {{ request()->is('outlets/supplier-accounts/create') ? 'menu-item-active' : '' }}"
                                            aria-haspopup="true"><a href="{{ route('supplier-accounts.create') }}"
                                                class="menu-link "><i
                                                    class="menu-bullet menu-bullet-dot"><span></span></i><span
                                                    class="menu-text">Add
                                                    Payment</span></a></li>
                                    @endif
                                    @if (auth()->guard('web')->check() ||
                                        auth()->user()->can('supplier_account_access'))
                                        <li class="menu-item {{ request()->is('outlets/supplier-accounts') ? 'menu-item-active' : '' }}"
                                            aria-haspopup="true"><a href="{{ route('supplier-accounts.index') }}"
                                                class="menu-link "><i
                                                    class="menu-bullet menu-bullet-dot"><span></span></i><span
                                                    class="menu-text">Transaction
                                                    List</span></a></li>
                                    @endif
                                    @if (auth()->guard('web')->check() ||
                                        auth()->user()->can('supplier_transaction_show'))
                                        <li class="menu-item {{ request()->is('outlets/supplier-transaction') ? 'menu-item-active' : '' }}"
                                            aria-haspopup="true"><a href="{{ route('supplier-transaction') }}"
                                                class="menu-link "><i
                                                    class="menu-bullet menu-bullet-dot"><span></span></i><span
                                                    class="menu-text">Supplier
                                                    Transaction</span></a></li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
@endcan





@can('employee_screen')
    @if (auth()->guard('web')->check() ||
        auth()->user()->can('employee_access'))
        <li class="menu-item {{ request()->is('outlets/employees*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
            aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                    class="menu-icon fas fa-user-tie"></i><span class="menu-text">Employee</span><i
                    class="menu-arrow"></i></a>
            <div class="menu-submenu "><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('employee_create'))
                        <li class="menu-item {{ request()->is('outlets/employees/create') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('employees.create') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add
                                    Employee</span></a></li>
                    @endif
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('employee_access'))
                        <li class="menu-item {{ request()->is('outlets/employees') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('employees.index') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span
                                    class="menu-text">Employees
                                    List</span></a></li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
@endcan

{{-- @can('payment_types_screen')
    <li class="menu-item {{ request()->is('outlets/payment-types') ? 'menu-item-active' : '' }}" aria-haspopup="true">
        <a href="{{ route('payment-types.index') }}" class="menu-link">
            <i class="menu-icon  far fa-credit-card"></i>
            <span class="menu-text">Payment Types</span></a>
    </li>
@endcan --}}
{{-- @can('payment_methods_screen')
    <li class="menu-item {{ request()->is('outlets/payment-methods*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
        aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                class="menu-icon fas fa-money-bill-alt"></i><span class="menu-text">Payment Method</span><i
                class="menu-arrow"></i></a>
        <div class="menu-submenu "><span class="menu-arrow"></span>
            <ul class="menu-subnav">
                <li class="menu-item {{ request()->is('outlets/payment-methods/create') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('payment-methods.create') }}" class="menu-link "><i
                            class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add
                            Method</span></a></li>
                <li class="menu-item {{ request()->is('outlets/payment-methods') ? 'menu-item-active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('payment-methods.index') }}" class="menu-link "><i
                            class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Payment
                            Method List</span></a></li>
            </ul>
        </div>
    </li>
@endcan --}}
@can('outlet_payment_screen')
    @if (auth()->guard('web')->check() ||
        auth()->user()->can('outlet_payment_access'))
        <li class="menu-item {{ request()->is('outlets/outlet-payment-transactions*') || request()->is('outlets/outlet-balance-sheet') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
            aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                    class="menu-icon fas fa-store"></i><span class="menu-text">Outlet Payments</span><i
                    class="menu-arrow"></i></a>
            <div class="menu-submenu "><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('outlet_payment_create'))
                        <li class="menu-item {{ request()->is('outlets/outlet-payment-transactions/create') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('outlet-payment-transactions.create') }}"
                                class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                    class="menu-text">Add Payment</span></a></li>
                    @endif
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('balance_sheet_access'))
                        <li class="menu-item {{ request()->is('outlets/outlet-balance-sheet') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('outlet-balance-sheet') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Balance
                                    Sheet</span></a></li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
@endcan



@can('ticket_screen')
    @if (auth()->guard('web')->check() ||
        auth()->user()->can('ticket_access'))
        <li class="menu-item  {{ request()->is('outlets/tickets*') ? 'menu-item-open menu-item-active' : '' }} menu-item-submenu"
            aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle">
                <i class="menu-icon fas fa-info-circle"></i>
                <span class="menu-text">Support Tickets</span><i class="menu-arrow"></i></a>
            <div class="menu-submenu "><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('ticket_create'))
                        <li class="menu-item {{ request()->is('outlets/tickets/create') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('tickets.create') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add
                                    Ticket</span></a></li>
                    @endif
                    @if (auth()->guard('web')->check() ||
                        auth()->user()->can('ticket_access'))
                        <li class="menu-item {{ request()->is('outlets/tickets') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('tickets.index') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Ticket
                                    List</span></a></li>
                    @endif
                </ul>
            </div>
        </li>
    @endif
@endcan

@can('settings_screen')
    @if (auth()->guard('web')->check() ||
        auth()->user()->can('settings_access'))
        <li class="menu-item  {{ request()->is('outlets/settings*') ? 'menu-item-active' : '' }} menu-item-submenu"
            aria-haspopup="true" data-menu-toggle="hover"><a href="{{ route('settings.index') }}"
                class="menu-link menu-toggle">
                <i class="menu-icon far fa-sun"></i>
                <span class="menu-text">Settings</span></a>

        </li>
    @endif
@endcan



<li class="menu-section ">
    <h4 class="menu-text text-warning">Premium</h4>
    <i class="menu-icon flaticon-more-v2"></i>
</li>



@if ($premium)

    @can('customer_screen')
        @if (auth()->guard('web')->check() ||
            auth()->user()->can('customer_access') ||
            auth()->user()->can('customer_account_access'))
            <li class="menu-item {{ request()->is('outlets/customers*') || request()->is('outlets/customer-accounts*') || request()->is('outlets/customer-transaction*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
                aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                        class="menu-icon fas fa-user"></i><span class="menu-text">Customer</span><i
                        class="menu-arrow"></i></a>
                <div class="menu-submenu "><span class="menu-arrow"></span>
                    <ul class="menu-subnav">
                        @if (auth()->guard('web')->check() ||
                            auth()->user()->can('customer_create'))
                            <li class="menu-item {{ request()->is('outlets/customers/create') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true"><a href="{{ route('customers.create') }}" class="menu-link "><i
                                        class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add
                                        Customer</span></a></li>
                        @endif
                        @if (auth()->guard('web')->check() ||
                            auth()->user()->can('customer_create'))
                            <li class="menu-item {{ request()->is('outlets/customers') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true"><a href="{{ route('customers.index') }}" class="menu-link "><i
                                        class="menu-bullet menu-bullet-line"><span></span></i><span
                                        class="menu-text">Customer
                                        List</span></a></li>
                        @endif
                        @if (auth()->guard('web')->check() ||
                            auth()->user()->can('customer_account_access'))
                            <li class="menu-item {{ request()->is('outlets/customer-accounts*') || request()->is('outlets/customer-transaction*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
                                aria-haspopup="true" data-menu-toggle="hover"><a href="#"
                                    class="menu-link menu-toggle"><i
                                        class="menu-bullet menu-bullet-line"><span></span></i><span
                                        class="menu-text">Customer
                                        Account</span><i class="menu-arrow"></i></a>
                                <div class="menu-submenu "><span class="menu-arrow"></span>
                                    <ul class="menu-subnav">
                                        @if (auth()->guard('web')->check() ||
                                            auth()->user()->can('customer_account_create'))
                                            <li class="menu-item {{ request()->is('outlets/customer-accounts/create') ? 'menu-item-active' : '' }}"
                                                aria-haspopup="true"><a href="{{ route('customer-accounts.create') }}"
                                                    class="menu-link "><i
                                                        class="menu-bullet menu-bullet-dot"><span></span></i><span
                                                        class="menu-text">Add Payment</span></a></li>
                                        @endif
                                        @if (auth()->guard('web')->check() ||
                                            auth()->user()->can('customer_account_access'))
                                            <li class="menu-item {{ request()->is('outlets/customer-accounts') ? 'menu-item-active' : '' }}"
                                                aria-haspopup="true"><a href="{{ route('customer-accounts.index') }}"
                                                    class="menu-link "><i
                                                        class="menu-bullet menu-bullet-dot"><span></span></i><span
                                                        class="menu-text">Transaction List</span></a></li>
                                        @endif
                                        @if (auth()->guard('web')->check() ||
                                            auth()->user()->can('customer_account_show'))
                                            <li class="menu-item {{ request()->is('outlets/customer-transaction') ? 'menu-item-active' : '' }}"
                                                aria-haspopup="true"><a href="{{ route('customer-transaction') }}"
                                                    class="menu-link "><i
                                                        class="menu-bullet menu-bullet-dot"><span></span></i><span
                                                        class="menu-text">Customer Transaction</span></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
        @endif
    @endcan
    @can('purchase_order_screen')
        @if (auth()->guard('web')->check() ||
            auth()->user()->can('po_access'))
            <li class="menu-item {{ (request()->is('outlets/purchase-orders*') && !request()->is('outlets/purchase-orders/return/history')) || request()->is('outlets/product-stock/update-stock') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
                aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                        class="menu-icon fas fa-clipboard-list"></i><span class="menu-text">Inventory</span><i
                        class="menu-arrow"></i></a>
                <div class="menu-submenu "><span class="menu-arrow"></span>
                    <ul class="menu-subnav">
                        @if (auth()->guard('web')->check() ||
                            auth()->user()->can('po_create'))
                            <li class="menu-item {{ request()->is('outlets/purchase-orders/create') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true"><a href="{{ route('purchase-orders.create') }}"
                                    class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                        class="menu-text">Create
                                        Purchase Order</span></a></li>
                        @endif
                        @if (auth()->guard('web')->check() ||
                            auth()->user()->can('po_access'))
                            <li class="menu-item {{ request()->is('outlets/purchase-orders') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true"><a href="{{ route('purchase-orders.index') }}"
                                    class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                        class="menu-text">Purchase Orders list</span></a></li>
                        @endif
                        @if (auth()->guard('web')->check() ||
                            auth()->user()->can('update_stock'))
                            <li class="menu-item {{ request()->is('outlets/product-stock/update-stock') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true"><a href="{{ route('product-stock.update-stock') }}"
                                    class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                        class="menu-text">Update Stock</span></a></li>
                        @endif
                        @if (auth()->guard('web')->check() ||
                            auth()->user()->can('po_access'))
                            <li class="menu-item {{ request()->is('outlets/purchase-orders/supplier-return/history') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true"><a href="{{ route('purchase-orders.supplier-return') }}"
                                    class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                        class="menu-text">Return to Supplier List</span></a></li>
                            <li class="menu-item {{ request()->is('outlets/purchase-orders/other/history') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true"><a href="{{ route('purchase-orders.other') }}"
                                    class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                        class="menu-text">Lost/Stolen List</span></a></li>
                        @endif
                    </ul>
                </div>
            </li>
        @endif
    @endcan
    @can('reports_screen')
        @if (auth()->guard('web')->check() ||
            auth()->user()->can('reports_access'))
            <li class="menu-item {{ request()->is('outlets/reports*') ? 'menu-item-open menu-item-active' : '' }} menu-item-submenu"
                aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><span
                        class="svg-icon menu-icon">
                        <!--begin::Svg Icon | path:media/svg/icons/Shopping/Chart-pie.svg--><svg
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path
                                    d="M4.00246329,12.2004927 L13,14 L13,4.06189375 C16.9463116,4.55399184 20,7.92038235 20,12 C20,16.418278 16.418278,20 12,20 C7.64874861,20 4.10886412,16.5261253 4.00246329,12.2004927 Z"
                                    fill="#000000" opacity="0.3"></path>
                                <path
                                    d="M3.0603968,10.0120794 C3.54712466,6.05992157 6.91622084,3 11,3 L11,11.6 L3.0603968,10.0120794 Z"
                                    fill="#000000"></path>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span><span class="menu-text">Reports</span><i class="menu-arrow"></i></a>
                <div class="menu-submenu "><span class="menu-arrow"></span>
                    <ul class="menu-subnav">
                        @if (auth()->guard('web')->check() ||
                            auth()->user()->can('daily_summary'))
                            <li class="menu-item {{ request()->is('outlets/reports/daily-summary') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true"><a href="{{ route('daily-summary') }}" class="menu-link "><i
                                        class="menu-bullet menu-bullet-line"><span></span></i><span
                                        class="menu-text">Daily
                                        Summary</span></a></li>
                        @endif
                        @if (auth()->guard('web')->check() ||
                            auth()->user()->can('sales_report'))
                            <li class="menu-item {{ request()->is('outlets/reports/sales-report') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true"><a href="{{ route('sales_report.filter') }}"
                                    class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                        class="menu-text">Sales
                                        Report</span></a></li>
                        @endif
                        @if (auth()->guard('web')->check() ||
                            auth()->user()->can('purchase_report'))
                            <li class="menu-item {{ request()->is('outlets/reports/purchase-report') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true"><a href="{{ route('purchase_report.filter') }}"
                                    class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                        class="menu-text">Purchase Report</span></a></li>
                        @endif
                        @if (auth()->guard('web')->check() ||
                            auth()->user()->can('product_report'))
                            <li class="menu-item {{ request()->is('outlets/reports/product-report*') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true"><a href="{{ route('product-report.filter') }}"
                                    class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                        class="menu-text">Product
                                        Report</span></a></li>
                        @endif
                        @if (auth()->guard('web')->check() ||
                            auth()->user()->can('expense_report'))
                            <li class="menu-item {{ request()->is('outlets/reports/expense-report*') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true"><a href="{{ route('expense_report') }}" class="menu-link "><i
                                        class="menu-bullet menu-bullet-line"><span></span></i><span
                                        class="menu-text">Expense
                                        Report</span></a></li>
                        @endif
                        @if (auth()->guard('web')->check() ||
                            auth()->user()->can('zakat_calculator'))
                            <li class="menu-item {{ request()->is('outlets/reports/zakat-calculator') ? 'menu-item-active' : '' }}"
                                aria-haspopup="true"><a href="{{ route('zakat-calculator') }}" class="menu-link "><i
                                        class="menu-bullet menu-bullet-line"><span></span></i><span
                                        class="menu-text">Zakat Calculator</span></a></li>
                        @endif
                        {{-- <li class="menu-item {{ (request()->is('outlets/reports/sales-purchase-profit')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('sales-purchase-profit')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Sales Purchase Profit</span></a></li>
                <li class="menu-item {{ (request()->is('outlets/reports/transaction-report')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('transaction-report.filter')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Transaction Report</span></a></li>
                <li class="menu-item {{ (request()->is('outlets/reports/supplier-report')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('supplier-report.filter')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Supplier Report</span></a></li>
                <li class="menu-item {{ (request()->is('outlets/reports/category-report')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('category-report.filter')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Category Report</span></a></li>
                <li class="menu-item {{ (request()->is('outlets/reports/company-report')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('company-report.filter')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Company Report</span></a></li> --}}
                    </ul>
                </div>
            </li>
        @endif
    @endcan
    @can('employee_management_screen')
        @if (auth()->guard('web')->check() ||
            auth()->user()->can('employee_login_access') ||
            auth()->user()->can('role_access') ||
            auth()->user()->can('permission_access'))
            <li class="menu-item {{ request()->is('outlets/employee-login*') || request()->is('outlets/roles*') || request()->is('outlets/permissions') ? 'menu-item-open menu-item-active' : '' }} menu-item-submenu"
                aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                        class="menu-icon fas fa-id-card-alt"></i><span class="menu-text">Employee Management</span><i
                        class="menu-arrow"></i></a>
                <div class="menu-submenu "><span class="menu-arrow"></span>
                    <ul class="menu-subnav">
                        @if (auth()->guard('web')->check() ||
                            auth()->user()->can('employee_login_access'))
                            <li class="menu-item {{ request()->is('outlets/employee-login*') ? 'menu-item-open menu-item-active' : '' }} menu-item-submenu"
                                aria-haspopup="true" data-menu-toggle="hover"><a href="#"
                                    class="menu-link menu-toggle"><i
                                        class="menu-bullet menu-bullet-line"><span></span></i><span
                                        class="menu-text">Login</span><i class="menu-arrow"></i></a>
                                <div class="menu-submenu "><span class="menu-arrow"></span>
                                    <ul class="menu-subnav">
                                        @if (auth()->guard('web')->check() ||
                                            auth()->user()->can('employee_login_create'))
                                            <li class="menu-item {{ request()->is('outlets/employee-login/create') ? 'menu-item-active' : '' }}"
                                                aria-haspopup="true"><a href="{{ route('employee-login.create') }}"
                                                    class="menu-link "><i
                                                        class="menu-bullet menu-bullet-dot"><span></span></i><span
                                                        class="menu-text">Add Login</span></a></li>
                                        @endif
                                        @if (auth()->guard('web')->check() ||
                                            auth()->user()->can('employee_login_access'))
                                            <li class="menu-item {{ request()->is('outlets/employee-login') ? 'menu-item-active' : '' }}"
                                                aria-haspopup="true"><a href="{{ route('employee-login.index') }}"
                                                    class="menu-link "><i
                                                        class="menu-bullet menu-bullet-dot"><span></span></i><span
                                                        class="menu-text">Manage Login</span></a></li>
                                        @endif

                                    </ul>
                                </div>
                            </li>
                        @endif
                        @if (auth()->guard('web')->check() ||
                            auth()->user()->can('role_access'))
                            <li class="menu-item  {{ request()->is('outlets/roles*') ? 'menu-item-open menu-item-active' : '' }} menu-item-submenu"
                                aria-haspopup="true" data-menu-toggle="hover"><a href="#"
                                    class="menu-link menu-toggle"><i
                                        class="menu-bullet menu-bullet-line"><span></span></i><span
                                        class="menu-text">Roles</span><i class="menu-arrow"></i></a>
                                <div class="menu-submenu "><span class="menu-arrow"></span>
                                    <ul class="menu-subnav">
                                        @if (auth()->guard('web')->check() ||
                                            auth()->user()->can('role_create'))
                                            <li class="menu-item {{ request()->is('outlets/roles/create') ? 'menu-item-active' : '' }}"
                                                aria-haspopup="true"><a href="{{ route('roles.create') }}"
                                                    class="menu-link "><i
                                                        class="menu-bullet menu-bullet-dot"><span></span></i><span
                                                        class="menu-text">Add Role</span></a></li>
                                        @endif
                                        @if (auth()->guard('web')->check() ||
                                            auth()->user()->can('role_access'))
                                            <li class="menu-item {{ request()->is('outlets/roles') ? 'menu-item-active' : '' }}"
                                                aria-haspopup="true"><a href="{{ route('roles.index') }}"
                                                    class="menu-link "><i
                                                        class="menu-bullet menu-bullet-dot"><span></span></i><span
                                                        class="menu-text">Manage Roles</span></a></li>
                                        @endif

                                    </ul>
                                </div>
                            </li>
                        @endif
                        {{-- <li class="menu-item {{ (request()->is('outlets/permissions')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('permissions')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Permissions</span></a></li> --}}
                    </ul>
                </div>
            </li>
        @endif
    @endcan
    @can('barcode_print_screen')
        @if (auth()->guard('web')->check() ||
            auth()->user()->can('barcode_print_access'))
            <li class="menu-item {{ request()->is('outlets/barcode/print-product-barcode') ? 'menu-item-active' : '' }}"
                aria-haspopup="true">
                <a href="{{ route('barcode.print-product-barcode') }}" class="menu-link">
                    <span class="menu-icon">
                        <span class="fas flaticon2-printer font-size-md"></span>
                    </span>
                    <span class="menu-text">Print Barcode</span>
                </a>
            </li>
        @endif
    @endcan
    @can('sms_reminder_screen')
        @if (auth()->guard('web')->check() ||
            auth()->user()->can('sms_reminder_access'))
            <li class="menu-item {{ request()->is('outlets/sms-reminder') ? 'menu-item-active' : '' }}"
                aria-haspopup="true">
                <a href="{{ route('sms-reminder') }}" class="menu-link">
                    <span class="menu-icon">
                        <span class="fas fa-paper-plane font-size-md"></span>
                    </span>
                    <span class="menu-text">Sms Reminder</span>
                </a>
            </li>
        @endif
    @endcan
    {{-- @can('sms_reminder_screen')
        @if (auth()->guard('web')->check() ||
    auth()->user()->can('sms_reminder_access'))
            <li class="menu-item {{ request()->is('outlets/campaigns*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
                aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                        class="menu-icon fas fa-clipboard-list"></i><span class="menu-text">Sms Marketing</span><i
                        class="menu-arrow"></i></a>
                <div class="menu-submenu "><span class="menu-arrow"></span>
                    <ul class="menu-subnav">

                        <li class="menu-item {{ request()->is('outlets/campaigns/create') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('campaigns.create') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add
                                    Campaign</span></a></li>
                        <li class="menu-item {{ request()->is('outlets/campaigns') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('campaigns.index') }}" class="menu-link "><i
                                    class="menu-bullet menu-bullet-line"><span></span></i><span
                                    class="menu-text">Campaigns list</span></a></li>
                    </ul>
                </div>
            </li>
        @endif
    @endcan --}}

    @can('hr_screen')
        <li class="menu-item {{ request()->is('outlets/hr*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
            aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                    class="menu-icon  fas fa-users"></i><span class="menu-text">HR</span><i class="menu-arrow"></i></a>
            <div class="menu-submenu "><span class="menu-arrow"></span>
                <ul class="menu-subnav">
                    <li class="menu-item {{ request()->is('outlets/hr/employee-salary*') ? 'menu-item-open menu-item-active' : '' }} menu-item-submenu"
                        aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                                class="menu-bullet menu-bullet-line"><span></span></i><span
                                class="menu-text">Salaries</span><i class="menu-arrow"></i></a>
                        <div class="menu-submenu "><span class="menu-arrow"></span>
                            <ul class="menu-subnav">
                                <li class="menu-item {{ request()->is('outlets/hr/employee-salary/create') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true"><a href="{{ route('employee-salary.create') }}"
                                        class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                            class="menu-text">Add Employee Salary</span></a></li>
                                <li class="menu-item {{ request()->is('outlets/hr/employee-salary') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true"><a href="{{ route('employee-salary.index') }}"
                                        class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                            class="menu-text">All Employees Salary</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item {{ request()->is('outlets/hr/employee-attendance') || request()->is('outlets/hr/employee-attendance/*') ? 'menu-item-open menu-item-active' : '' }} menu-item-submenu"
                        aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                                class="menu-bullet menu-bullet-line"><span></span></i><span
                                class="menu-text">Attendance</span><i class="menu-arrow"></i></a>
                        <div class="menu-submenu "><span class="menu-arrow"></span>
                            <ul class="menu-subnav">
                                <li class="menu-item {{ request()->is('outlets/hr/employee-attendance/create') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true"><a href="{{ route('employee-attendance.create') }}"
                                        class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                            class="menu-text">Mark Attendance</span></a></li>
                                <li class="menu-item {{ request()->is('outlets/hr/employee-attendance') || request()->is('outlets/hr/employee-attendance/filter') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true"><a href="{{ route('employee-attendance.index') }}"
                                        class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                            class="menu-text">View Attendance</span></a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item {{ request()->is('outlets/hr/employee-attendance-meta*') ? 'menu-item-open menu-item-active' : '' }} menu-item-submenu"
                        aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                                class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Attendance
                                Meta</span><i class="menu-arrow"></i></a>
                        <div class="menu-submenu "><span class="menu-arrow"></span>
                            <ul class="menu-subnav">
                                <li class="menu-item {{ request()->is('outlets/hr/employee-attendance-meta/create') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true"><a href="{{ route('employee-attendance-meta.create') }}"
                                        class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                            class="menu-text">Add Attendance Meta</span></a></li>
                                <li class="menu-item {{ request()->is('outlets/hr/employee-attendance-meta') ? 'menu-item-active' : '' }}"
                                    aria-haspopup="true"><a href="{{ route('employee-attendance-meta.index') }}"
                                        class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                            class="menu-text">Attendance Meta List</span></a></li>
                            </ul>
                        </div>
                    </li>
                    {{-- <li class="menu-item {{ (request()->is('outlets/hr/employee-salary')) ? 'menu-item-active' : '' }}  menu-item-submenu" aria-haspopup="true"><a href="#" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Employees Salary List</span></a></li>
                <div class="menu-submenu "><span class="menu-arrow"></span>
                    <ul class="menu-subnav">
                        <li class="menu-item {{ (request()->is('outlets/hr/employee-salary')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('employee-salary.index')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">All Employees Salary</span></a></li>
                        <li class="menu-item {{ (request()->is('outlets/hr/employee-salary/create')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('employee-salary.create')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add Employee Salary</span></a></li>
                    </ul>
                </div> --}}
                </ul>
            </div>
        </li>
    @endcan

    @can('employee_transaction_screen')
        @if (auth()->guard('web')->check() ||
            auth()->user()->can('employee_transaction_access'))
            <li class="menu-item {{ request()->is('outlets/employee-transactions*') ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu"
                aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i
                        class="menu-icon fas fa-clipboard-list"></i><span class="menu-text">Employee
                        Transactions</span><i class="menu-arrow"></i></a>
                <div class="menu-submenu "><span class="menu-arrow"></span>
                    <ul class="menu-subnav">

                        {{-- <li class="menu-item {{ (request()->is('outlets/employees-account/create')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('purchase-orders.create')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Create Purchase Order</span></a></li> --}}
                        <li class="menu-item {{ request()->is('outlets/employee-transactions') ? 'menu-item-active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('employee-transactions.index') }}"
                                class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span
                                    class="menu-text">Employee Transaction list</span></a></li>
                    </ul>
                </div>
            </li>
        @endif
    @endcan
@else
    @can('customer_screen')
        <li class="menu-item" aria-haspopup="true" data-toggle="tooltip" title="This page is for premium users."
            data-menu-toggle="hover"><a href="#" class="menu-link">
                <span class="menu-icon">
                    <span class="fas fa-crown text-warning font-size-md"></span>
                </span>
                <span class="menu-text">Customers</span>

            </a>
        </li>
    @endcan
    @can('purchase_order_screen')
        <li class="menu-item" aria-haspopup="true" data-toggle="tooltip" title="This page is for premium users."
            data-menu-toggle="hover"><a href="#" class="menu-link">
                <span class="menu-icon">
                    <span class="fas fa-crown text-warning font-size-md"></span>
                </span>
                <span class="menu-text">Inventory</span>

            </a>
        </li>
    @endcan
    @can('reports_screen')
        <li class="menu-item" aria-haspopup="true" data-toggle="tooltip" title="This page is for premium users."
            data-menu-toggle="hover"><a href="#" class="menu-link">
                <span class="menu-icon">
                    <span class="fas fa-crown text-warning font-size-md"></span>
                </span>
                <span class="menu-text">Reports</span>

            </a>
        </li>
    @endcan

    @can('employee_management_screen')
        <li class="menu-item" aria-haspopup="true" data-toggle="tooltip" title="This page is for premium users."
            data-menu-toggle="hover"><a href="#" class="menu-link">
                <span class="menu-icon">
                    <span class="fas fa-crown text-warning font-size-md"></span>
                </span>
                <span class="menu-text">Employee Management</span>

            </a>
        </li>
    @endcan

    @can('barcode_print_screen')
        <li class="menu-item" aria-haspopup="true" data-toggle="tooltip" title="This page is for premium users."
            data-menu-toggle="hover"><a href="#" class="menu-link">
                <span class="menu-icon">
                    <span class="fas fa-crown text-warning font-size-md"></span>
                </span>
                <span class="menu-text">Print Barcode</span>

            </a>
        </li>
    @endcan

    @can('sms_reminder_screen')
        <li class="menu-item" aria-haspopup="true" data-toggle="tooltip" title="This page is for premium users."
            data-menu-toggle="hover"><a href="#" class="menu-link">
                <span class="menu-icon">
                    <span class="fas fa-crown text-warning font-size-md"></span>
                </span>
                <span class="menu-text">Sms Reminder</span>

            </a>
        </li>
    @endcan
    @can('sms_reminder_screen')
        <li class="menu-item" aria-haspopup="true" data-toggle="tooltip" title="This page is for premium users."
            data-menu-toggle="hover"><a href="#" class="menu-link">
                <span class="menu-icon">
                    <span class="fas fa-crown text-warning font-size-md"></span>
                </span>
                <span class="menu-text">Sms Marketing</span>

            </a>
        </li>
    @endcan

    @can('hr_screen')
        <li class="menu-item" aria-haspopup="true" data-toggle="tooltip" title="This page is for premium users."
            data-menu-toggle="hover"><a href="#" class="menu-link">
                <span class="menu-icon">
                    <span class="fas fa-crown text-warning font-size-md"></span>
                </span>
                <span class="menu-text">HR</span>

            </a>
        </li>
    @endcan
    @can('employee_transaction_screen')
        <li class="menu-item" aria-haspopup="true" data-toggle="tooltip" title="This page is for premium users."
            data-menu-toggle="hover"><a href="#" class="menu-link">
                <span class="menu-icon">
                    <span class="fas fa-crown text-warning font-size-md"></span>
                </span>
                <span class="menu-text">Employee Transactions</span>

            </a>
        </li>
    @endcan
@endif
