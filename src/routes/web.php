<?php


use App\Http\Controllers\AddPhoneController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Charts\SalesChartController;
use App\Http\Controllers\Employee\Auth\EmployeeEmailVerify;
use App\Http\Controllers\Employee\Auth\LoginController as EmployeeLoginController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubscriptionController;
use App\Models\Employee;
use App\Models\Outlet;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/run', function () {
    Artisan::call('cache:clear');
    // Artisan::call('storage:link');
    // Artisan::call('key:generate');
    return 'done';
});

Route::get('/charts', 'Charts\SalesChartController@index');
Route::get('/', function () {
    return redirect('/login');
});

// Demo routes
Route::get('/invoice', 'HomeController@invoice');
// Route::get('/datatables', 'PagesController@datatables');
// Route::get('/ktdatatables', 'PagesController@ktDatatables');
// Route::get('/select2', 'PagesController@select2');
// Route::get('/icons/custom-icons', 'PagesController@customIcons');
// Route::get('/icons/flaticon', 'PagesController@flaticon');
// Route::get('/icons/fontawesome', 'PagesController@fontawesome');
// Route::get('/icons/lineawesome', 'PagesController@lineawesome');
// Route::get('/icons/socicons', 'PagesController@socicons');
// Route::get('/icons/svg', 'PagesController@svg');


// Employee Login & Verification
Route::namespace("Employee")->prefix('employee')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('employee.login');
        Route::post('/login', 'LoginController@login')->name('employee.login');
        Route::post('logout', 'LoginController@logout')->name('employee.logout');
        Route::post('email/verification/resend', [EmployeeEmailVerify::class, 'resend'])->name('employee_verification.resend');
        Route::get('email/verify', [EmployeeEmailVerify::class, 'show'])->name('employee_verification.notice');
        Route::get('email/{id}/{hash}', [EmployeeEmailVerify::class, 'verify'])->name('employee_verification.verify');
    });
});

// User Verification
Route::get('verify/notice', [VerificationController::class, 'show'])->name('verification.show');
Route::get('verify/email', [VerificationController::class, 'verify_email'])->name('verification.email');
Route::get('verify/email/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.email.verify');

Route::get('verify/phone/send', [VerificationController::class, 'send_phone_code'])->name('verification.send.code');
Route::get('verify/phone/code', [VerificationController::class, 'add_phone_code'])->name('verification.add.code');
Route::get('verify/phone/resend', [VerificationController::class, 'send_phone_code'])->name('verification.resend');
Route::post('verify/phone/check', [VerificationController::class, 'verify_code'])->name('verification.check');
Route::post('phone/otp', [OtpController::class, 'send_otp'])->name('otp.send');

Route::get('add/phone', [AddPhoneController::class, 'show'])->name('add-phone.show');
Route::post('add/phone/code', [AddPhoneController::class, 'send_code'])->name('add-phone.code');
Route::post('add/phone/store', [AddPhoneController::class, 'store'])->name('add-phone.store');

Route::post('phone/login', [LoginController::class, 'phone_login'])->name('phone.login');
Route::post('employee/phone/login', [EmployeeLoginController::class, 'phone_login'])->name('employee.phone.login');


Route::group(
    ['middleware' => ['auth:web,employee', 'verified', 'authGate', 'prevent_back_button']],
    function () {
        Route::get('get-customer', 'ProductController@get_customer');
        Route::get('get-employee', 'EmployeeController@get_employee');

        Route::get('live-search', 'ProductController@live_search');
        Route::get('/product-cost', 'ProductController@get_cost');
        Route::get('/supplier-products', 'SupplierController@get_product');
        Route::post('outlets/tickets/add-ticket-ajax', 'TicketController@add_ticket_ajax')->name('tickets.add-ticket-ajax');
        //ros
        Route::group(['middleware' => ['outletAuth']], function () {

            //printing
            Route::get('outlets/products-print', 'ExportOptionController@products')->name('print.products');
            Route::get('outlets/product-stock-print', 'ExportOptionController@product_stock')->name('print.product_stock');
            //printing
            Route::get('outlets/sales-order-print', 'ExportOptionController@sales_order')->name('print.sales_order');
            Route::get('outlets/purchase-order-print', 'ExportOptionController@purchase_order')->name('print.purchase_order');
            Route::get('outlets/low-stock-print', 'ExportOptionController@low_stock')->name('print.low_stock');
            Route::get('outlets/return-history-print', 'ExportOptionController@return_history')->name('print.return_history');
            Route::get('outlets/lost-stolen-history-print', 'ExportOptionController@lost_stolen_history')->name('print.lost_stolen_history');
            Route::get('outlets/supplier-return-history-print', 'ExportOptionController@supplier_return_history')->name('print.supplier_return_history');
            Route::get('outlets/categories-print', 'ExportOptionController@categories')->name('print.categories');
            Route::get('outlets/companies-print', 'ExportOptionController@companies')->name('print.companies');
            Route::get('outlets/suppliers-print', 'ExportOptionController@suppliers')->name('print.suppliers');
            Route::get('outlets/supplier-accounts-print', 'ExportOptionController@supplier_accounts')->name('print.supplier_accounts');
            Route::get('outlets/supplier-transactions-print', 'ExportOptionController@supplier_transactions')->name('print.supplier_transactions');
            Route::get('outlets/customers-print', 'ExportOptionController@customers')->name('print.customers');
            Route::get('outlets/customer-accounts-print', 'ExportOptionController@customer_accounts')->name('print.customer_accounts');
            Route::get('outlets/customer-transactions-print', 'ExportOptionController@customer_transactions')->name('print.customer_transactions');
            Route::get('outlets/employees-print', 'ExportOptionController@employees')->name('print.employees');
            Route::get('outlets/products-report-print', 'ExportOptionController@products_report')->name('print.products_report');
            Route::get('outlets/expense-categories-print', 'ExportOptionController@expense_categories')->name('print.expense_categories');
            Route::get('outlets/expense-transactions-print', 'ExportOptionController@expense_transactions')->name('print.expense_transactions');
            // Route::get('/outlets/supplier-accounts/print-suplier-transaction/{id}', [SupplierAccountController::class, 'print_transaction']);
            // Route::get('/outlets/customer-accounts/print-customer-transaction/{id}', [CustomerAccountController::class, 'print_transaction']);
            Route::get('/outlets/expense-transaction/print-expense-transaction/{id}', 'ExpenseTransactionController@print_transaction');


            Route::get('outlets/dashboard', 'DashboardController@index')->name('outlets.dashboard');
            Route::get('outlets/summary-print', 'DashboardController@summary')->name('outlets.summary');

            //sales
            Route::resource('outlets/sales', 'SalesOrderController')->except('create', 'show', 'edit', 'update', 'destroy');
            Route::get('outlets/sales-orders', 'SalesOrderController@sales_orders')->name('sales-orders');
            Route::post('outlets/sales-orders', 'SalesOrderController@filter')->name('sales_order.filter');
            Route::get('outlets/sales-order-details/{id}', 'SalesOrderController@show_order_details')->name('sales-order-details');
            Route::get('get-hold-orders', 'SalesOrderController@get_hold_orders');
            Route::delete('holder-orders/delete/{id}', 'SalesOrderController@delete_hold_order')->name('hold-order.destroy');
            Route::get('get-orders', 'SalesOrderController@get_orders');
            Route::get('get-product-data', 'SalesOrderController@get_product_data');
            Route::get('outlets/gen-invoice/{id}', 'GenerateInvoiceController@generate')->name('gen-invoice');

            //product
            // Route::get('outlets/products/manage-product', 'ProductController@manage')->name('manage-product');
            Route::resource('outlets/products', 'ProductController');
            Route::get('products-in-cart', 'ProductController@products_in_cart');
            Route::get('outlets/standard-product', 'ProductController@get_standard_product')->name('standard-product');
            Route::post('outlets/standard-product', 'ProductController@store_standard_product')->name('standard-product.store');
            Route::resource('outlets/product-metas', 'ProductMetaController');
            Route::resource('outlets/variations', 'VariationController');
            Route::resource('outlets/product-variations', 'ProductVariationController');
            Route::resource('outlets/variation-attributes', 'VariationAttributeController');
            Route::get('get-variation-attributes', 'VariationAttributeController@get_attributes');
            Route::resource('outlets/product-variations', 'ProductVariationController');

            Route::get('outlets/barcode/generate', 'BarcodeController@generate')->name('barcode.generate');
            Route::resource('outlets/purchase-orders', 'InventoryPurchaseOrderController')->except('store');
            Route::post('outlets/purchase-orders/filter', 'InventoryPurchaseOrderController@filter')->name('purchase-orders.filter');
            Route::get('outlets/purchase-orders/return/history', 'InventoryPurchaseOrderController@return_history')->name('purchase-orders.return');
            Route::get('outlets/purchase-orders/supplier-return/history', 'InventoryPurchaseOrderController@return_supplier_history')->name('purchase-orders.supplier-return');
            Route::get('outlets/purchase-orders/other/history', 'InventoryPurchaseOrderController@other_history')->name('purchase-orders.other');
            Route::get('outlets/downloads/product-csv', 'DownloadController@product_csv')->name('download.product-csv');
            Route::post('outlets/import/products', 'ProductController@file_import')->name('products.import');

            Route::resource('outlets/product-stock', 'ProductStockController')->except('show');
            Route::get('outlets/product-stock/add-old-stock', 'ProductStockController@create_old_stock')->name('product-stock.create-old-stock');
            Route::post('outlets/product-stock/add-old-stock', 'ProductStockController@store_old_stock')->name('product-stock.store-old-stock');

            Route::get('outlets/product-stock/low-stock', 'ProductStockController@low_stock')->name('product-stock.low-stock');
            Route::post('outlets/product-stock/low-stock', 'ProductStockController@low_stock')->name('low-stock.filter');
            Route::get('outlets/product-stock/update-stock', 'ProductStockController@edit_stock')->name('product-stock.update-stock');
            Route::post('outlets/product-stock/update-stock/store', 'ProductStockController@update_stock')->name('update-stock.store');

            //category
            Route::resource('outlets/categories', 'CategoryController');
            Route::get('outlets/standard-category', 'CategoryController@get_standard_category')->name('standard-category');
            Route::post('outlets/standard-category', 'CategoryController@store_standard_category')->name('standard-category.store');
            Route::post('outlets/add-category', 'CategoryController@add_category_ajax')->name('categories.add-category');
            Route::get('get-category', 'CategoryController@get_category');
            Route::get('outlets/downloads/category-csv', 'DownloadController@category_csv')->name('download.category-csv');
            Route::post('outlets/import/categories', 'CategoryController@file_import')->name('categories.import');

            //Company
            Route::resource('outlets/companies', 'CompanyController');
            Route::get('outlets/standard-company', 'CompanyController@get_standard_company')->name('standard-company');
            Route::post('outlets/standard-company', 'CompanyController@store_standard_company')->name('standard-company.store');
            Route::post('outlets/add-company', 'CompanyController@add_company_ajax')->name('companies.add-company');
            Route::get('get-company', 'CompanyController@get_company');
            Route::get('outlets/downloads/company-csv', 'DownloadController@company_csv')->name('download.company-csv');
            Route::post('outlets/import/companies', 'CompanyController@file_import')->name('companies.import');


            ///////////Cash Book Start////////////
            Route::resource('outlets/payment-categories', Cashbook\PaymentCategoryController::class);
            Route::get('outlets/cashbook', 'Cashbook\CashbookController@index')->name('cashbook.index');
            Route::post('outlets/cashbook/filter', 'Cashbook\CashbookController@index')->name('cashbook.filter');
            Route::post('outlets/cashbook', 'Cashbook\CashbookController@store')->name('cashbook.store');

            ///////////Cash Book End////////////

            ///////////////////////////////////////////////////////////
            //////----------------AIRLINES START--------------////////

            //Parties
            Route::resource('outlets/parties', Airlines\PartyController::class);
            Route::get('outlets/parties-print', 'ExportOptionController@parties')->name('print.parties');
            Route::post('outlets/add-party', 'Airlines\PartyController@add_party_ajax')->name('parties.add-party');
            Route::get('get-party', 'Airlines\PartyController@get_party');

            //Party accounts
            Route::resource('outlets/party-accounts', 'Airlines\PartyAccountController')->except(['edit', 'update', 'destroy']);
            Route::get('outlets/party-account-print', 'ExportOptionController@party_accounts')->name('print.party-accounts');
            Route::get('outlets/party-accounts/print/{id}', 'Airlines\PartyAccountController@print_transaction')->name('print.single-party-transaction');

            Route::get('outlets/party-transaction', 'Airlines\PartyAccountController@summary')->name('party-transactions');
            Route::post('outlets/party-transaction', 'Airlines\PartyAccountController@summary')->name('party-transactions.filter');
            Route::get('outlets/party-transaction-print', 'ExportOptionController@party_transactions')->name('print.party-transactions');


            //Outlet Taxes
            Route::resource('outlets/outlet-taxes', Airlines\TaxController::class);
            Route::get('get-tax', 'Airlines\TaxController@get_tax');

            //Outlet Commissions
            Route::resource('outlets/outlet-commissions', Airlines\CommissionController::class);
            Route::get('get-commission', 'Airlines\CommissionController@get_commission');
            Route::post('outlets/add-commission', 'Airlines\CommissionController@add_commission_ajax')->name('outlet-commissions.add-commission');

            //Outlet Discount
            Route::resource('outlets/outlet-discounts', Airlines\DiscountController::class);
            Route::get('get-discount', 'Airlines\DiscountController@get_discount');

            //Airlines Order
            Route::resource('outlets/airline-orders', Airlines\AirlineOrderController::class);
            Route::get('api/airline-orders/json', 'Airlines\AirlineOrderController@ordersJson');


            //Airlines Tickets
            Route::resource('outlets/airline-tickets', Airlines\AirlineTicketController::class);
            Route::get('api/airline-tickets/json', 'Airlines\AirlineTicketController@ticketsJson');

            //////----------------AIRLINES END---------------////////
            ////////////////////////////////////////////////////////


            //Supplier
            Route::resource('outlets/suppliers', 'SupplierController');
            Route::get('outlets/assign-company', 'SupplierController@assign_company_create')->name('assign-company.create');
            Route::post('outlets/assign-company', 'SupplierController@assign_company_store')->name('assign-company.store');
            Route::get('outlets/get-supplier-companies', 'SupplierController@get_supplier_companies');
            Route::get('outlets/get-not-supplier-companies', 'SupplierController@get_not_supplier_companies');
            Route::resource('outlets/supplier-accounts', 'SupplierAccountController')->except('edit', 'update', 'delete');
            Route::post('outlets/add-supplier', 'SupplierController@add_supplier_ajax')->name('suppliers.add-supplier');
            Route::post('outlets/search-supplier', 'SupplierController@search_supplier')->name('suppliers.search-supplier');
            Route::post('outlets/add-products-supplier', 'SupplierController@add_products_supplier')->name('suppliers.add-products-supplier');
            Route::get('get-supplier', 'SupplierController@get_supplier');
            Route::get('get-product-supplier', 'SupplierController@get_product_supplier');
            Route::get('supplier/get-credit-orders', 'SupplierAccountController@get_credit_orders');
            Route::get('outlets/supplier-transaction', 'SupplierAccountController@summary')->name('supplier-transaction');
            Route::post('outlets/supplier-transaction', 'SupplierAccountController@filter')->name('supplier-transaction.filter');
            Route::get('outlets/downloads/supplier-csv', 'DownloadController@supplier_csv')->name('download.supplier-csv');
            Route::post('outlets/import/suppliers', 'SupplierController@file_import')->name('suppliers.import');
            Route::get('outlets/supplier-accounts/print/{id}', 'SupplierAccountController@print_transaction')->name('print.supplier-transaction');


            //Customers
            Route::resource('outlets/customers', 'CustomerController');
            Route::resource('outlets/customer-accounts', 'CustomerAccountController')->except('edit', 'update', 'delete');
            Route::get('outlets/customer-transaction', 'CustomerTransactionController@index')->name('customer-transaction');
            Route::post('outlets/customer-transaction', 'CustomerTransactionController@filter')->name('customer-transaction.filter');
            Route::get('get-customer', 'CustomerController@get_customer');
            Route::post('outlets/add-customer', 'CustomerController@add_customer_ajax')->name('add-customer');
            Route::get('get-credit-orders', 'CustomerAccountController@get_credit_orders');
            Route::get('outlets/customer-accounts/print-customer-transaction/{id}', 'CustomerAccountController@print_transaction')->name('print.customer_transaction');


            //Expense Category
            Route::resource('outlets/expenses/expense-category', 'ExpenseCategoryController');
            Route::get('outlets/standard-expense-category', 'ExpenseCategoryController@get_standard_expense_category')->name('standard-expense-category');
            Route::post('outlets/standard-expense-category', 'ExpenseCategoryController@store_standard_expense_category')->name('standard-expense-category.store');
            Route::post('outlets/expenses/add-expense-category', 'ExpenseCategoryController@add_expense_category_ajax')->name('expense-category.add-expense-category');
            Route::get('get-expense-category', 'ExpenseCategoryController@get_expense_category');
            Route::get('outlets/downloads/expense-category-csv', 'DownloadController@expense_category_csv')->name('download.expense-category-csv');
            Route::post('outlets/import/expense_categories', 'ExpenseCategoryController@file_import')->name('expense-categories.import');


            //Expense Transaction
            Route::resource('outlets/expenses/expense-transaction', 'ExpenseTransactionController');
            Route::post('outlets/expenses/expense-transaction/filter', 'ExpenseTransactionController@expenseByCategory')->name('expense-transaction.expenseByCategory');

            //Payment Types
            Route::resource('outlets/payment-types', 'PaymentTypeController');
            Route::get('outlets/standard-payment-types', 'PaymentTypeController@get_standard_payment_types')->name('standard-payment-types');
            Route::post('outlets/standard-payment-types', 'PaymentTypeController@store_standard_payment_types')->name('standard-payment-types.store');

            //Payment Methods
            Route::resource('outlets/payment-methods', 'PaymentMethodController');
            Route::get('outlets/standard-payment-methods', 'PaymentMethodController@get_standard_payment_methods')->name('standard-payment-methods');
            Route::post('outlets/standard-payment-methods', 'PaymentMethodController@store_standard_payment_methods')->name('standard-payment-methods.store');


            //Outlet Payment Transaction
            Route::resource('outlets/outlet-payment-transactions', 'OutletPaymentTransactionController');
            Route::get('outlets/outlet-balance-sheet', 'OutletPaymentTransactionController@balanceSheet')->name('outlet-balance-sheet');
            Route::post('outlets/outlet-cash-transfer', 'OutletPaymentTransactionController@cashTransfer')->name('outlet-cash-transfer');

            //Outlet Settings
            Route::put('outlets/settings', [SettingController::class, 'updatePosSetting'])->name('pos-settings.update');

            //Outlet Registration
            Route::resource('outlets/registration', 'OutletRegistrationController');

            //Employee
            Route::resource('outlets/employees', 'EmployeeController');

            // Reports

            // Zakat Calculator

            Route::get('outlets/reports/zakat-calculator', 'Reports\ZakatController@calculateZakat')->name('zakat-calculator');

            //sales report
            Route::get('outlets/reports/daily-summary', 'Reports\DailySummary@filterData')->name('daily-summary');
            Route::post('outlets/reports/daily-summary', 'Reports\DailySummary@filterData')->name('daily_summary.filter');
            Route::get('outlets/reports/sales-report', 'Reports\SalesReport@filterData')->name('sales_report');
            Route::post('outlets/reports/sales-report', 'Reports\SalesReport@filterData')->name('sales_report.filter');

            //sales purchase profit
            Route::get('outlets/reports/sales-purchase-profit', 'Reports\SalesPurchaseProfit@index')->name('sales-purchase-profit');

            //purchase report
            Route::get('outlets/reports/purchase-report', 'Reports\PurchaseReport@filterData')->name('purchase_report');
            Route::post('outlets/reports/purchase-report', 'Reports\PurchaseReport@filterData')->name('purchase_report.filter');

            //expense report
            Route::get('outlets/reports/expense-report', 'Reports\ExpenseReport@filterData')->name('expense_report');
            Route::post('outlets/reports/expense-report', 'Reports\ExpenseReport@filterData')->name('expense_report.filter');
            Route::get('outlets/reports/expense-report/{fromDate}/{toDate}/{id}', 'Reports\ExpenseReport@expense_category_transaction')->name('expense_report.expense_category_transaction');


            //customer report
            Route::get('outlets/reports/customer-report', 'Reports\CustomerReport@filterData')->name('customer-report.filter');

            //product report
            Route::get('outlets/reports/product-report', 'Reports\ProductReport@filterData')->name('product-report');
            Route::post('outlets/reports/product-report', 'Reports\ProductReport@filterData')->name('product-report.filter');
            Route::get('/outlets/reports/product-report/{fromDate}/{toDate}/{product_id}', 'Reports\ProductReport@product_sales')->name('product-report.product_sales');

            //transaction report
            Route::get('outlets/reports/transaction-report', 'Reports\TransactionReport@filterData')->name('transaction-report.filter');

            //supplier report
            Route::get('outlets/reports/supplier-report', 'Reports\SupplierReport@filterData')->name('supplier-report.filter');

            //supplier report
            Route::get('outlets/reports/category-report', 'Reports\CategoryReport@filterData')->name('category-report.filter');

            //company report
            Route::get('outlets/reports/company-report', 'Reports\CompanyReport@filterData')->name('company-report.filter');


            //Employee Management

            //Employee Login
            Route::resource('outlets/employee-login', 'EmployeeLoginController');

            //Roles
            Route::resource('outlets/roles', 'RolesController');
            Route::get('outlets/permissions', 'PermissionsController@index')->name('permissions');

            //Tickets
            Route::resource('outlets/tickets', 'TicketController')->except('delete');

            //Ticket Response
            Route::post('ticket_response', 'TicketResponseController@store')->name('ticket_response.store');

            Route::get('get-payment-method', 'UserController@get_payment_method');
            Route::get('outlets/sms-reminder', 'SmsReminderController@index')->name('sms-reminder');
            Route::post('outlets/sms-reminder', 'SmsReminderController@send_sms')->name('sms-reminder.send');

            Route::resource('outlets/campaigns', 'CampaignController');
            Route::get('outlets/sms-marketing', 'SmsMarketingController@campaign')->name('sms-marketing');
            //barcode printing
            Route::get('outlets/barcode/print-product-barcode', 'BarcodeController@index')->name('barcode.print-product-barcode');
            Route::get('outlets/barcode/add-print-quantity/{id}', 'BarcodeController@add_print_quantity')->name('barcode.add-quantity');
            Route::post('outlets/barcode/print', 'BarcodeController@print_barcode')->name('barcode.print');

            ///subscription-plan
            Route::get('outlets/subscription-details', [SubscriptionController::class, 'index'])->name('subscription.index');
            Route::post('/subscription/create', [SubscriptionController::class, 'create']);
            Route::get('/subscription-plan/{id}', function ($id) {
                $plan = DB::table('plans')->where('id', $id)->first();
                return response()->json($plan);
            });

            //Get plan Promo
            Route::get('/get-promo/{id}/{promo_key}', function ($id, $promo_key) {
                $subscriptions = DB::table('subscriptions')->where('promo_code', $promo_key)->count();
                // return $subscriptions;
                $promo = DB::table('promos')->leftJoin('promo_validities', 'promo_validities.promo_id', 'promos.id')
                    ->where('promos.promo_key', $promo_key)
                    ->where('promo_validities.plan_id', $id)
                    ->where('promo_validities.total_allow_promotions', '>=', $subscriptions)
                    ->where('promo_validities.promo_status', 'active')
                    ->whereDate('promo_validities.promo_start_date', '<=', Carbon::today()->format('Y-m-d h:i:s'))
                    ->whereDate('promo_validities.promo_end_date', '>=', Carbon::today()->format('Y-m-d h:i:s'))
                    ->select('promos.promo_type', 'promos.promo_value')
                    ->first();
                // return $promo;
                if ($promo) {
                    return $promo;
                }
                return response($promo, 404);
            });


            //HR

            //Employee Salary
            Route::resource('outlets/hr/employee-salary', 'EmployeeSalaryController');
            Route::resource('outlets/employee-transactions', 'EmployeeTransactionController');
            //Attendance
            Route::resource('outlets/hr/employee-attendance', 'AttendanceController');
            Route::get('outlets/hr/view-attendance/{id}', 'AttendanceController@show')->name('employee-attendance.view');
            Route::post('outlets/hr/employee-attendance/filter', 'AttendanceController@filter')->name('employee-attendance.filter');

            //Employee Attendance Meta Transaction
            Route::resource('outlets/hr/employee-attendance-meta', 'EmployeeAttendanceMetaTransactionController');
            Route::get('get-employee-salary-data', 'EmployeeSalaryController@get_salary_data');

            //Notification
            Route::put('outlets/notification/{notification_id}/{outlet_id}', 'NotificationController@read')->name('notification.read');

            Route::get('smart-invoice/invoices', 'SmartInvoice\InvoiceController@invoices')->name('invoice.list');
            Route::get('smart-invoice/invoice/print/{id}', 'SmartInvoice\InvoiceController@invoice_print')->name('invoice.print');
            Route::get('smart-invoice/select-template', 'SmartInvoice\InvoiceController@index')->name('invoice.index');
            Route::get('smart-invoice/wizard', 'SmartInvoice\InvoiceController@wizard')->name('invoice.wizard');
            // Route::get('smart-invoice/invoice-data', 'SmartInvoice\InvoiceController@invoice_data')->name('invoice.invoice-data');
            Route::post('smart-invoice/invoice-data/{invoice_id?}', 'SmartInvoice\InvoiceController@invoice_data')->name('invoice.invoice-data');

            Route::post('smart-invoice/save-invoice-data', 'SmartInvoice\InvoiceController@store_invoice_data')->name('invoice.save-invoice-data');

            Route::get('outlets/settings', 'SettingController@index')->name('settings.index');
        });



        //Outlets
        Route::get('get-state', 'OutletController@getState');
        Route::get('get-city', 'OutletController@getCity');
        Route::get('/outlets/open-outlet', 'OutletController@open_outlet');
        Route::resource('outlets', 'OutletController');

        //Users
        //Route::get('outlets/users/add-payment', 'CustomerAccountController@create');
        Route::resource('outlets/users', 'UserController');
        Route::patch('outlets/users/update-employee/{id}', 'UserController@update_employee')->name('update-employee');
    }


);
// Route::get('phone-format', function () {
//     return PhoneFormatter::format_number('03163203940');
// });

// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'DashboardController@quickSearch')->name('quick-search');


// Auth::routes(['verify' => true]);
Auth::routes();



// Route::view('/verification', 'auth.verification_email');

// Route::get("/alfa-transaction", function (Request $request) {
//     return view('alfa-handshake');
// });
// Route::get("/alfa-return", function (Request $request) {
//     $auth_token = $request->AuthToken;
//     return view('alfa-transaction', compact('auth_token'));
// });
// Route::post("/alfa-post", function (Request $request) {
//     dd($request->all());
// });



// Route::get('/autocomplete', 'ProductController@autocomplete')->name('autocomplete');
