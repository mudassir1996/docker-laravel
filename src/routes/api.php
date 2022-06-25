<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Desktop\BusinessController;
use App\Http\Controllers\Api\Desktop\BusinessScreenController;
use App\Http\Controllers\Api\Desktop\CategoryController;
use App\Http\Controllers\Api\Desktop\CityController;
use App\Http\Controllers\Api\Desktop\CompanyController;
use App\Http\Controllers\Api\Desktop\CountryController;
use App\Http\Controllers\Api\Desktop\CustomerController;
use App\Http\Controllers\Api\Desktop\EmployeeController;
use App\Http\Controllers\Api\Desktop\EmployeeLoginController;
use App\Http\Controllers\Api\Desktop\ExpenseCategoryController;
use App\Http\Controllers\Api\Desktop\ExpenseTransactionController;
use App\Http\Controllers\Api\Desktop\OutletController;
use App\Http\Controllers\Api\Desktop\OutletPaymentTransactionController;
use App\Http\Controllers\Api\Desktop\PaymentMethodController;
use App\Http\Controllers\Api\Desktop\PaymentTypeController;
use App\Http\Controllers\Api\Desktop\PermissionController;
use App\Http\Controllers\Api\Desktop\ProductController;
use App\Http\Controllers\Api\Desktop\ProductStockController;
use App\Http\Controllers\Api\Desktop\PurchaseController;
use App\Http\Controllers\Api\Desktop\RoleController;
use App\Http\Controllers\Api\Desktop\SalesController;
use App\Http\Controllers\Api\Desktop\ScreensController;
use App\Http\Controllers\Api\Desktop\StateController;
use App\Http\Controllers\Api\Desktop\SupplierController;
use App\Http\Controllers\Api\ExpenseApiController;
use App\Http\Controllers\Api\FcmController;
use App\Http\Controllers\Api\Mobile\CashbookController;
use App\Http\Controllers\Api\Mobile\CustomerController as MobileCustomerController;
use App\Http\Controllers\Api\Mobile\OutletController as MobileOutletController;
use App\Http\Controllers\Api\Mobile\PaymentCategoryController;
use App\Http\Controllers\Api\Mobile\SupplierController as MobileSupplierController;
use App\Http\Controllers\Api\NotificationApiController;
use App\Http\Controllers\Api\PaymentApiController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/get-otp/{phone}', [AuthController::class, 'get_otp']);
Route::post('/otp/login', [AuthController::class, 'otp_login']);

//Protected routes
Route::middleware(['auth:sanctum'])->group(function () {
    // Route::get('/all-products', function () {
    //     $products = Product::select('id', 'product_title')->get();
    //     return response()->json($products);
    // });
    Route::get('/outlet-summary/{id}/{date}', [ApiController::class, 'dashboardData']);
    Route::get('/my-outlets', [ApiController::class, 'my_outlets']);
    Route::get('/recent-orders/{id}', [ApiController::class, 'recent_orders']);
    Route::get('/orders/{id}/{date}', [ApiController::class, 'ordersData']);
    Route::get('/employees/{id}', [ApiController::class, 'employees']);
    Route::get('/expenses/{id}', [ExpenseApiController::class, 'expenses']);
    Route::get('/expense-categories/{id}', [ExpenseApiController::class, 'expense_categories']);
    Route::get('/expense-transactions/{id}/{date?}/{expense_category_id?}', [ExpenseApiController::class, 'expense_transactions']);
    Route::post('/expense-categories/create/{id}', [ExpenseApiController::class, 'expense_categories_create']);
    Route::post('/expense-transactions/create/{id}', [ExpenseApiController::class, 'expense_transaction_create']);

    Route::get('/payment-type/{id}', [PaymentApiController::class, 'payment_type']);
    Route::get('/payment-method/{id}/{payment_type_id?}', [PaymentApiController::class, 'payment_method']);

    Route::get('/unread-notifications/{outlet_id}', [NotificationApiController::class, 'get_unread_notification']);
    Route::get('/notifications/{outlet_id}', [NotificationApiController::class, 'get_notification']);
    Route::get('/notifications/mark-as-read/{outlet_id}', [NotificationApiController::class, 'mark_read_notification']);


    Route::post('/verification/verify', [AuthController::class, 'phone_verify']);
    Route::post('/verification/resend', [AuthController::class, 'verification_resend']);
    Route::post('/fcm-token', [FcmController::class, 'store']);


    Route::post('/outlet/create', [MobileOutletController::class, 'create']);

    Route::get('/countries', [MobileOutletController::class, 'get_countries']);
    Route::get('/states/{country_id}', [MobileOutletController::class, 'get_states']);
    Route::get('/cities/{state_id}', [MobileOutletController::class, 'get_cities']);
    Route::get('/business', [MobileOutletController::class, 'get_business']);

    //Payment Categories
    Route::get('/payment-categories/{id}', [PaymentCategoryController::class, 'index']);
    Route::post('/payment-categories/{id}', [PaymentCategoryController::class, 'payment_categories_create']);

    //Cashbook
    Route::get('/cashbook/{id}', [CashbookController::class, 'index']);
    Route::post('/cashbook/{id}', [CashbookController::class, 'store']);

    //Supplier
    Route::get('/suppliers/{id}', [MobileSupplierController::class, 'index']);
    Route::post('/suppliers/{id}', [MobileSupplierController::class, 'store']);

    //Customer
    Route::get('/customers/{id}', [MobileCustomerController::class, 'index']);
    Route::post('/customers/{id}', [MobileCustomerController::class, 'store']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

///////////////////////desktop api/////////////////////////////////

Route::post('/desktop-login', [AuthController::class, 'desktop_login']);
Route::post('/desktop/employee-login', [AuthController::class, 'employee_login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('desktop')->group(function () {

        Route::get('my-outlets', [OutletController::class, 'index']);
        Route::get('outlet-status', [OutletController::class, 'outlet_status']);
        Route::get('screens', [ScreensController::class, 'index']);
        Route::get('business', [BusinessController::class, 'index']);
        Route::get('business-screens', [BusinessScreenController::class, 'index']);

        ////Category
        Route::get('categories', [CategoryController::class, 'index']);
        Route::post('categories/create', [CategoryController::class, 'store']);
        Route::post('categories/update', [CategoryController::class, 'update']);

        ////Company
        Route::get('companies', [CompanyController::class, 'index']);
        Route::post('companies/create', [CompanyController::class, 'store']);
        Route::post('companies/update', [CompanyController::class, 'update']);

        ////Products
        Route::get('products', [ProductController::class, 'index']);
        Route::post('products/create', [ProductController::class, 'store']);
        Route::post('products/update', [ProductController::class, 'update']);

        ////Product Stock
        Route::get('product-stock', [ProductStockController::class, 'index']);
        Route::post('product-stock/create', [ProductStockController::class, 'store']);
        Route::post('product-stock/update', [ProductStockController::class, 'update']);

        ////Suppliers
        Route::get('suppliers', [SupplierController::class, 'index']);
        Route::post('suppliers/create', [SupplierController::class, 'store']);
        Route::post('suppliers/update', [SupplierController::class, 'update']);

        ////Supplier Companies
        Route::get('supplier-companies', [SupplierController::class, 'supplier_companies']);
        Route::post('supplier-companies/create', [SupplierController::class, 'supplier_companies_store']);
        Route::post('supplier-companies/update', [SupplierController::class, 'supplier_companies_update']);

        ////Supplier Accounts
        Route::get('supplier-accounts', [SupplierController::class, 'supplier_accounts']);
        Route::post('supplier-accounts/create', [SupplierController::class, 'supplier_accounts_store']);
        Route::post('supplier-accounts/update', [SupplierController::class, 'supplier_accounts_update']);

        ////Customers
        Route::get('customers', [CustomerController::class, 'index']);
        Route::post('customers/create', [CustomerController::class, 'store']);
        Route::post('customers/update', [CustomerController::class, 'update']);

        ////Customer Account
        Route::get('customer-accounts', [CustomerController::class, 'customer_accounts']);
        Route::post('customer-accounts/create', [CustomerController::class, 'customer_accounts_store']);
        Route::post('customer-accounts/update', [CustomerController::class, 'customer_accounts_update']);

        /////Employees
        Route::get('employees', [EmployeeController::class, 'index']);
        Route::post('employees/create', [EmployeeController::class, 'store']);
        Route::post('employees/update', [EmployeeController::class, 'update']);

        ////Expense Category
        Route::get('expense-category', [ExpenseCategoryController::class, 'index']);
        Route::post('expense-category/create', [ExpenseCategoryController::class, 'store']);
        Route::post('expense-category/update', [ExpenseCategoryController::class, 'update']);

        ////Expense Transaction
        Route::get('expense-transaction', [ExpenseTransactionController::class, 'index']);
        Route::post('expense-transaction/create', [ExpenseTransactionController::class, 'store']);
        Route::post('expense-transaction/update', [ExpenseTransactionController::class, 'update']);

        ////Sales Orders
        Route::get('sales-orders', [SalesController::class, 'index']);
        Route::post('sales-orders/create', [SalesController::class, 'store']);
        Route::post('sales-orders/update', [SalesController::class, 'update']);

        ////Sales Order Details
        Route::get('sales-order-details', [SalesController::class, 'sales_order_details']);
        Route::post('sales-order-details/create', [SalesController::class, 'sales_order_details_store']);
        Route::post('sales-order-details/update', [SalesController::class, 'sales_order_details_update']);

        ////Purchase Orders
        Route::get('purchase-orders', [PurchaseController::class, 'index']);
        Route::post('purchase-orders/create', [PurchaseController::class, 'store']);
        Route::post('purchase-orders/update', [PurchaseController::class, 'update']);

        ////Purchase Order Details
        Route::get('purchase-order-details', [PurchaseController::class, 'purchase_order_details']);
        Route::post('purchase-order-details/create', [PurchaseController::class, 'purchase_order_details_store']);
        Route::post('purchase-order-details/update', [PurchaseController::class, 'purchase_order_details_update']);

        //payment types
        Route::get('payment-types', [PaymentTypeController::class, 'index']);
        Route::post('payment-types/create', [PaymentTypeController::class, 'store']);
        Route::post('payment-types/update', [PaymentTypeController::class, 'update']);

        //payment methods
        Route::get('payment-methods', [PaymentMethodController::class, 'index']);
        Route::post('payment-methods/create', [PaymentMethodController::class, 'store']);
        Route::post('payment-methods/update', [PaymentMethodController::class, 'update']);

        //outlet payment transactions
        Route::get('outlet-payment-transactions', [OutletPaymentTransactionController::class, 'index']);
        Route::post('outlet-payment-transactions/create', [OutletPaymentTransactionController::class, 'store']);
        // Route::post('payment-methods/update', [PaymentMethodController::class, 'update']);

        // Permissions & Roles
        Route::get('permissions', [PermissionController::class, 'index']);

        Route::get('roles', [RoleController::class, 'index']);
        Route::post('roles/create', [RoleController::class, 'store']);
        Route::post('roles/update', [RoleController::class, 'update']);

        Route::get('permission-roles', [RoleController::class, 'get_permission_roles']);
        Route::post('permission-roles/create', [RoleController::class, 'set_permission_roles']);
        Route::post('permission-roles/update', [RoleController::class, 'update_permission_roles']);

        Route::get('employee-roles', [RoleController::class, 'employee_roles']);
        Route::get('employee-login', [EmployeeLoginController::class, 'index']);

        Route::get('countries', [CountryController::class, 'index']);
        Route::get('cities', [CityController::class, 'index']);
        Route::get('states', [StateController::class, 'index']);
    });
});


// Route::post('upload-image', function (Request $request) {
//     if ($request->hasFile('image')) {
//         //getting the image name
//         $image_full_name = $request->image->getClientOriginalName();
//         $image_name_arr = explode('.', $image_full_name);
//         $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];

//         //storing image at public/storage/products/$image_name
//         $request->image->storeAs('test', $image_name, 'public');
//     } else {
//         $image_name = 'placeholder.jpg';
//     }

//     return $request->image;
// });

// Route::get('vue-products', function () {
//     $products = Product::search()->latest()->paginate(10);
//     return  $products;
// });

Route::get('/business_types', function () {
    $business_types = DB::table('businesses')->get();
    return response(["BusinessType" => $business_types]);
    // });
});
