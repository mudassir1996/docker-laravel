 @can('dashboard_screen')
 @can('dashboard_access')
 <li class="menu-item  {{ (request()->is('outlets/dashboard')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('outlets.dashboard')}}" class="menu-link ">
         <i class="menu-icon  fas fa-tachometer-alt"></i>
         <span class="menu-text">Dashboard</span></a></li>
 @endcan
 @endcan

 @can('sales_screen')
 @can('sales_access')
 <li class="menu-item {{ (request()->is('outlets/sales-orders*') || request()->is('outlets/sales-order-details*') || request()->is('outlets/sales')) ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle">
         <i class="menu-icon fas fa-cash-register"></i>
         <span class="menu-text">Sales</span><i class="menu-arrow"></i></a>
     <div class="menu-submenu "><span class="menu-arrow"></span>
         <ul class="menu-subnav">
             <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span class="menu-text">Sales</span></span></li>
             @can('sales_create')
             <li class="menu-item {{ (request()->is('outlets/sales')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('sales.index')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Sales Dashboard</span></a></li>
             @endcan
             <li class="menu-item {{ (request()->is('outlets/sales-orders') || request()->is('outlets/sales-order-details*')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('sales-orders')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Sales Orders</span></a></li>
         </ul>
     </div>
 </li>
 @endcan
 @endcan


 @can('products_screen')
 @can('product_access')
 <li class="menu-item {{ (request()->is('outlets/products*')) ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i class="menu-icon fas fa-shopping-cart"></i><span class="menu-text">Product</span><i class="menu-arrow"></i></a>
     <div class="menu-submenu "><span class="menu-arrow"></span>
         <ul class="menu-subnav">
             @can('product_access')
             <li class="menu-item {{ (request()->is('outlets/products')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('products.index')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">All Products</span></a></li>
             @endcan
             @can('product_create')
             <li class="menu-item {{ (request()->is('outlets/products/create')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('products.create')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add Product</span></a></li>
             @endcan
         </ul>
     </div>
 </li>
 @endcan
 @endcan
 @can('products_screen')
 @can('stock_access')
 <li class="menu-item {{ (request()->is('outlets/product-stock*')) ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i class="menu-icon fas fa-boxes"></i><span class="menu-text">Product Stock</span><i class="menu-arrow"></i></a>
     <div class="menu-submenu "><span class="menu-arrow"></span>
         <ul class="menu-subnav">
             @can('stock_access')
             <li class="menu-item {{ (request()->is('outlets/product-stock')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('product-stock.index')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">In Stock</span></a></li>
             @endcan
             @can('stock_access')
             <li class="menu-item {{ (request()->is('outlets/product-stock/create')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('product-stock.create')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add Stock</span></a></li>
             @endcan
             @can('stock_access')
             <li class="menu-item {{ (request()->is('outlets/product-stock/low-stock')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('product-stock.low-stock')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Low Stock</span></a></li>
             @endcan
             @can('stock_access')
             <li class="menu-item {{ (request()->is('outlets/product-stock/update-stock')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('product-stock.update-stock')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Update Stock</span></a></li>
             @endcan
         </ul>
     </div>
 </li>
 @endcan
 @endcan
 @can('products_screen')
 @can('po_access')
 <li class="menu-item {{ (request()->is('outlets/purchase-orders*')) ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i class="menu-icon fas fa-clipboard-list"></i><span class="menu-text">Inventory</span><i class="menu-arrow"></i></a>
     <div class="menu-submenu "><span class="menu-arrow"></span>
         <ul class="menu-subnav">
             @can('po_access')
             <li class="menu-item {{ (request()->is('outlets/purchase-orders')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('purchase-orders.index')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Purchase Orders list</span></a></li>
             @endcan
             @can('po_create')
             <li class="menu-item {{ (request()->is('outlets/purchase-orders/create')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('purchase-orders.create')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Create Purchase Order</span></a></li>
             @endcan
             @can('po_create')
             <li class="menu-item {{ (request()->is('outlets/purchase-orders/return/history')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('purchase-orders.return')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Return History</span></a></li>
             @endcan
             @can('po_create')
             <li class="menu-item {{ (request()->is('outlets/purchase-orders/supplier-return/history')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('purchase-orders.supplier-return')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Return to Supplier History</span></a></li>
             @endcan
             @can('po_create')
             <li class="menu-item {{ (request()->is('outlets/purchase-orders/other/history')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('purchase-orders.other')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Lost/Stolen History</span></a></li>
             @endcan
         </ul>
     </div>
 </li>
 @endcan
 @endcan

 @can('expense_screen')
 @if(auth()->user()->can('expense_category_access') || auth()->user()->can('expense_transaction_access'))
 <li class="menu-item {{ (request()->is('outlets/expenses*')) ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i class="menu-icon fas fa-wallet"></i><span class="menu-text">Expense</span><i class="menu-arrow"></i></a>
     <div class="menu-submenu "><span class="menu-arrow"></span>
         <ul class="menu-subnav">
             @can('expense_category_access')
             <li class="menu-item  {{ (request()->is('outlets/expenses/expense-category*')) ? 'menu-item-open menu-item-active' : '' }} menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Expense Category</span><i class="menu-arrow"></i></a>
                 <div class="menu-submenu "><span class="menu-arrow"></span>
                     <ul class="menu-subnav">
                         @can('expense_category_access')
                         <li class="menu-item {{ (request()->is('outlets/expenses/expense-category')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('expense-category.index')}}" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Expense Category List</span></a></li>
                         @endcan
                         @can('expense_category_create')
                         <li class="menu-item {{ (request()->is('outlets/expenses/expense-category/create')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('expense-category.create')}}" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Add Expense Category</span></a></li>
                         @endcan
                     </ul>
                 </div>
             </li>
             @endcan
             @can('expense_transaction_access')
             <li class="menu-item  {{ (request()->is('outlets/expenses/expense-transaction*')) ? 'menu-item-open menu-item-active' : '' }} menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Expense Transaction</span><i class="menu-arrow"></i></a>
                 <div class="menu-submenu "><span class="menu-arrow"></span>
                     <ul class="menu-subnav">
                         @can('expense_transaction_access')
                         <li class="menu-item {{ (request()->is('outlets/expenses/expense-transaction')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('expense-transaction.index')}}" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Expense Transaction List</span></a></li>
                         @endcan
                         @can('expense_transaction_create')
                         <li class="menu-item {{ (request()->is('outlets/expenses/expense-transaction/create')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('expense-transaction.create')}}" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Add Expense Transaction</span></a></li>
                         @endcan
                     </ul>
                 </div>
             </li>
             @endcan
         </ul>
     </div>
 </li>
 @endif
 @endif

 @can('category_screen')
 @can('category_access')
 <li class="menu-item {{ (request()->is('outlets/categories*')) ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i class="menu-icon fas fa-list-alt "></i><span class="menu-text">Category</span><i class="menu-arrow"></i></a>
     <div class="menu-submenu "><span class="menu-arrow"></span>
         <ul class="menu-subnav">
             <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span class="menu-text">Category</span></span></li>
             @can('category_access')
             <li class="menu-item {{ (request()->is('outlets/categories')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('categories.index')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">All Categories</span></a></li>
             @endcan
             @can('category_create')
             <li class="menu-item {{ (request()->is('outlets/categories/create')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('categories.create')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add Category</span></a></li>
             @endcan
         </ul>
     </div>
 </li>
 @endcan
 @endcan

 @can('company_screen')
 @can('company_access')
 <li class="menu-item {{ (request()->is('outlets/companies*')) ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i class="menu-icon fas fa-building"></i><span class="menu-text">Company</span><i class="menu-arrow"></i></a>
     <div class="menu-submenu "><span class="menu-arrow"></span>
         <ul class="menu-subnav">
             <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span class="menu-text">Company</span></span></li>
             @can('company_access')
             <li class="menu-item {{ (request()->is('outlets/companies')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('companies.index')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">All Companies</span></a></li>
             @endcan
             @can('company_create')
             <li class="menu-item {{ (request()->is('outlets/companies/create')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('companies.create')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add Company</span></a></li>
             @endcan
         </ul>
     </div>
 </li>
 @endcan
 @endcan

 @can('supplier_screen')
 @can('supplier_access')
 <li class="menu-item {{ (request()->is('outlets/suppliers*')) ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i class="menu-icon fas fa-truck-moving"></i><span class="menu-text">Supplier</span><i class="menu-arrow"></i></a>
     <div class="menu-submenu "><span class="menu-arrow"></span>
         <ul class="menu-subnav">
             <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span class="menu-text">Supplier</span></span></li>
             @can('supplier_access')
             <li class="menu-item {{ (request()->is('outlets/suppliers')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('suppliers.index')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">All Suppliers</span></a></li>
             @endcan
             @can('supplier_create')
             <li class="menu-item {{ (request()->is('outlets/suppliers/create')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('suppliers.create')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add Supplier</span></a></li>
             @endcan
             @can('supplier_account_access')
             <li class="menu-item {{ (request()->is('outlets/supplier-accounts*')) ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Suppler Account</span><i class="menu-arrow"></i></a>
                 <div class="menu-submenu "><span class="menu-arrow"></span>
                     <ul class="menu-subnav">
                         @can('supplier_account_access')
                         <li class="menu-item {{ request()->is('outlets/supplier-accounts') ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('supplier-accounts.index')}}" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">All Accounts</span></a></li>
                         @endcan
                         <li class="menu-item {{ (request()->is('outlets/customer-transaction')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('customer-transaction')}}" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Transaction Summary</span></a></li>
                         @can('supplier_transaction_create')
                         <li class="menu-item {{ (request()->is('outlets/supplier-accounts/create')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('supplier-accounts.create')}}" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Add Payment</span></a></li>
                         @endcan
                     </ul>
                 </div>
             </li>
             @endcan
         </ul>
     </div>
 </li>
 @endcan
 @endcan
 @can('customer_screen')
 @if(auth()->user()->can('customer_access') || auth()->user()->can('customer_account_access'))
 <li class="menu-item {{ (request()->is('outlets/customers*') || request()->is('outlets/customer-accounts*') || request()->is('outlets/customer-transaction*')) ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i class="menu-icon fas fa-user"></i><span class="menu-text">Customer</span><i class="menu-arrow"></i></a>
     <div class="menu-submenu "><span class="menu-arrow"></span>
         <ul class="menu-subnav">
             <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span class="menu-text">Customer</span></span></li>
             @can('customer_access')
             <li class="menu-item {{ (request()->is('outlets/customers')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('customers.index')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">All Customers</span></a></li>
             @endcan
             @can('customer_create')
             <li class="menu-item {{ (request()->is('outlets/customers/create')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('customers.create')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add Customer</span></a></li>
             @endcan
             @can('customer_account_access')
             <li class="menu-item {{ (request()->is('outlets/customer-accounts*') || request()->is('outlets/customer-transaction*')) ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Customer Account</span><i class="menu-arrow"></i></a>
                 <div class="menu-submenu "><span class="menu-arrow"></span>
                     <ul class="menu-subnav">
                         @can('customer_account_access')
                         <li class="menu-item {{ (request()->is('outlets/customer-accounts')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('customer-accounts.index')}}" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">All Accounts</span></a></li>
                         @endcan
                         @can('customer_account_create')
                         <li class="menu-item {{ (request()->is('outlets/customer-transaction')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('customer-transaction')}}" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Transaction Summary</span></a></li>
                         @endcan
                         @can('customer_account_create')
                         <li class="menu-item {{ (request()->is('outlets/customer-accounts/create')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('customer-accounts.create')}}" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Add Payment</span></a></li>
                         @endcan
                     </ul>
                 </div>
             </li>
             @endcan
         </ul>
     </div>
 </li>
 @endif
 @endcan

 @can('reports_screen')
 @can('reports_access')
 @if ($premium)
 <li class="menu-item {{ (request()->is('outlets/reports*')) ? 'menu-item-open menu-item-active' : '' }} menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><span class="svg-icon menu-icon">
             <!--begin::Svg Icon | path:media/svg/icons/Shopping/Chart-pie.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                 <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                     <rect x="0" y="0" width="24" height="24"></rect>
                     <path d="M4.00246329,12.2004927 L13,14 L13,4.06189375 C16.9463116,4.55399184 20,7.92038235 20,12 C20,16.418278 16.418278,20 12,20 C7.64874861,20 4.10886412,16.5261253 4.00246329,12.2004927 Z" fill="#000000" opacity="0.3"></path>
                     <path d="M3.0603968,10.0120794 C3.54712466,6.05992157 6.91622084,3 11,3 L11,11.6 L3.0603968,10.0120794 Z" fill="#000000"></path>
                 </g>
             </svg>
             <!--end::Svg Icon-->
         </span><span class="menu-text">Reports</span><i class="menu-arrow"></i></a>
     <div class="menu-submenu "><span class="menu-arrow"></span>
         <ul class="menu-subnav">
             <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span class="menu-text">Reports</span></span></li>
             @can('daily_summary')
             <li class="menu-item {{ (request()->is('outlets/reports/daily-summary')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('daily-summary')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Daily Summary</span></a></li>
             @endcan
             @can('sales_report')
             <li class="menu-item {{ (request()->is('outlets/reports/sales-report')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('sales_report.filter')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Sales Report</span></a></li>
             @endcan
             @can('purchase_report')
             <li class="menu-item {{ (request()->is('outlets/reports/purchase-report')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('purchase_report.filter')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Purchase Report</span></a></li>
             @endcan
             @can('product_report')
             <li class="menu-item {{ (request()->is('outlets/reports/product-report*')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('product-report.filter')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Product Report</span></a></li>
             @endcan
             @can('expense_report')
             <li class="menu-item {{ (request()->is('outlets/reports/expense-report*')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('expense_report')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Expense Report</span></a></li>
             @endcan
             {{--<li class="menu-item {{ (request()->is('outlets/reports/sales-purchase-profit')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('sales-purchase-profit')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Sales Purchase Profit</span></a>
 </li>
 <li class="menu-item {{ (request()->is('outlets/reports/transaction-report')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('transaction-report.filter')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Transaction Report</span></a></li>
 <li class="menu-item {{ (request()->is('outlets/reports/supplier-report')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('supplier-report.filter')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Supplier Report</span></a></li>
 <li class="menu-item {{ (request()->is('outlets/reports/category-report')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('category-report.filter')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Category Report</span></a></li>
 <li class="menu-item {{ (request()->is('outlets/reports/company-report')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('company-report.filter')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Company Report</span></a></li> --}}
 </ul>
 </div>
 </li>
 @else
 <li class="menu-item" aria-haspopup="true" data-toggle="tooltip" title="This page is for premium users." data-menu-toggle="hover"><a href="#" class="menu-link">
         <span class="menu-icon">
             <span class="fas fa-crown text-warning font-size-md"></span>
         </span>
         <span class="menu-text">Reports</span>

     </a>
 </li>
 @endif
 @endcan

 @endcan

 @can('employee_screen')
 @can('employee_access')
 <li class="menu-item {{ (request()->is('outlets/employees*')) ? 'menu-item-open menu-item-active' : '' }}  menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i class="menu-icon fas fa-user-tie"></i><span class="menu-text">Employee</span><i class="menu-arrow"></i></a>
     <div class="menu-submenu "><span class="menu-arrow"></span>
         <ul class="menu-subnav">
             <li class="menu-item  menu-item-parent" aria-haspopup="true"><span class="menu-link"><span class="menu-text">Employee</span></span></li>
             @can('employee_access')
             <li class="menu-item {{ (request()->is('outlets/employees')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('employees.index')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">All Employees</span></a></li>
             @endcan
             @can('employee_create')
             <li class="menu-item {{ (request()->is('outlets/employees/create')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('employees.create')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add Employee</span></a></li>
             @endcan
         </ul>
     </div>
 </li>
 @endcan
 @endcan

 @can('employee_management')
 @if ($premium)
 @if(auth()->user()->can('employee_login_access') || auth()->user()->can('role_access') || auth()->user()->can('permission_access'))
 <li class="menu-item {{ (request()->is('outlets/employee-login*') || request()->is('outlets/roles*') || request()->is('outlets/permissions')) ? 'menu-item-open menu-item-active' : '' }} menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i class="menu-icon fas fa-users"></i><span class="menu-text">Employee Management</span><i class="menu-arrow"></i></a>
     <div class="menu-submenu "><span class="menu-arrow"></span>
         <ul class="menu-subnav">
             @can('employee_login_access')
             <li class="menu-item {{ (request()->is('outlets/employee-login*')) ? 'menu-item-open menu-item-active' : '' }} menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Login</span><i class="menu-arrow"></i></a>
                 <div class="menu-submenu "><span class="menu-arrow"></span>
                     <ul class="menu-subnav">
                         @can('employee_login_access')
                         <li class="menu-item {{ (request()->is('outlets/employee-login')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('employee-login.index')}}" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Manage Login</span></a></li>
                         @endcan
                         @can('employee_login_create')
                         <li class="menu-item {{ (request()->is('outlets/employee-login/create')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('employee-login.create')}}" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Add Login</span></a></li>
                         @endcan
                     </ul>
                 </div>
             </li>
             @endcan
             @can('role_access')
             <li class="menu-item  {{ (request()->is('outlets/roles*')) ? 'menu-item-open menu-item-active' : '' }} menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle"><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Roles</span><i class="menu-arrow"></i></a>
                 <div class="menu-submenu "><span class="menu-arrow"></span>
                     <ul class="menu-subnav">
                         @can('role_access')
                         <li class="menu-item {{ (request()->is('outlets/roles')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('roles.index')}}" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Manage Roles</span></a></li>
                         @endcan
                         @can('role_create')
                         <li class="menu-item {{ (request()->is('outlets/roles/create')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('roles.create')}}" class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Add Role</span></a></li>
                         @endcan
                     </ul>
                 </div>
             </li>
             @endcan
             {{-- @can('permission_access')
             <li class="menu-item {{ (request()->is('outlets/permissions')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('permissions')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Permissions</span></a>
 </li>
 @endcan --}}
 </ul>
 </div>
 </li>
 @endif
 @else
 <li class="menu-item" aria-haspopup="true" data-toggle="tooltip" title="This page is for premium users." data-menu-toggle="hover"><a href="#" class="menu-link">
         <span class="menu-icon">
             <span class="fas fa-crown text-warning font-size-md"></span>
         </span>
         <span class="menu-text">Reports</span>

     </a>
 </li>
 @endif
 @endcan

 @can('ticket_access')
 <li class="menu-item  {{ (request()->is('outlets/tickets*')) ? 'menu-item-open menu-item-active' : '' }} menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover"><a href="#" class="menu-link menu-toggle">
         <i class="menu-icon fas fa-info-circle"></i>
         <span class="menu-text">Support Tickets</span><i class="menu-arrow"></i></a>
     <div class="menu-submenu "><span class="menu-arrow"></span>
         <ul class="menu-subnav">
             @can('ticket_access')
             <li class="menu-item {{ (request()->is('outlets/tickets')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('tickets.index')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Ticket List</span></a></li>
             @endcan

             @can('ticket_create')
             <li class="menu-item {{ (request()->is('outlets/tickets/create')) ? 'menu-item-active' : '' }}" aria-haspopup="true"><a href="{{route('tickets.create')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i><span class="menu-text">Add Ticket</span></a></li>
             @endcan
         </ul>
     </div>
 </li>
 @endcan