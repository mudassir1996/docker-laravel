<?php

namespace App\Http\Controllers;

use App\Models\Airlines\Party;
use App\Models\Airlines\PartyAccount;
use App\Models\CustomerAccount;
use App\Models\ExpenseTransaction;
use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Outlet;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Sales\SalesOrder;
use App\Models\Sales\SalesOrderDetail;
use App\Models\Supplier;
use App\Models\SupplierAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExportOptionController extends Controller
{
    public function products()
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $products = DB::table('products')
            ->select('products.*', 'companies.company_title', 'categories.category_title', 'outlets.outlet_title', 'employees.employee_name', 'product_stocks.units_in_stock', 'product_stocks.retail_price')
            ->leftJoin('companies', 'products.company_id', '=', 'companies.id')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->leftJoin('outlets', 'products.outlet_id', '=', 'outlets.id')
            ->leftJoin('product_stocks', 'products.id', '=', 'product_stocks.product_id')
            ->leftJoin('employees', 'products.created_by', '=', 'employees.id')
            ->where('products.outlet_id', session('outlet_id'))
            ->get();
        return view('pages.print.products_export', compact('products', 'outlet'));
    }

    public function product_stock()
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $product_stocks = DB::table('product_stocks')
            ->select('product_stocks.*', 'outlets.outlet_title', 'employees.employee_name', 'products.product_title')
            ->leftJoin('products', 'product_stocks.product_id', '=', 'products.id')
            ->leftJoin('outlets', 'product_stocks.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'product_stocks.created_by', '=', 'employees.id')
            ->where('product_stocks.outlet_id', session('outlet_id'))
            ->orderBy('product_stocks.id', 'desc')
            ->get();

        return view('pages.print.product_stock_export', compact('product_stocks', 'outlet'));
    }
    public function sales_order()
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $sales_orders = SalesOrder::filter()
            ->join('customers', 'sales_orders.customer_id', '=', 'customers.id')
            ->join('outlets', 'sales_orders.outlet_id', '=', 'outlets.id')
            ->join('employees', 'sales_orders.created_by', '=', 'employees.id')
            ->join('sales_order_details', 'sales_orders.id', '=', 'sales_order_details.sales_order_id')
            ->join('products', 'sales_order_details.product_id', 'products.id')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('payment_methods', 'sales_orders.payment_method_id', '=', 'payment_methods.id')
            ->join('payment_types', 'sales_orders.payment_type', '=', 'payment_types.id')
            ->select(
                'sales_orders.*',
                'customers.customer_name',
                'payment_methods.payment_title',
                'outlets.outlet_title',
                'employees.employee_name',
                'payment_types.title as payment_type_title',
            )
            ->where('sales_orders.outlet_id', session('outlet_id'))
            ->orderBy('sales_orders.id', 'desc')
            ->get();
        return view('pages.print.sales_order_export', compact('sales_orders', 'outlet'));
    }

    public function purchase_order()
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $purchase_orders = InventoryPurchaseOrder::filter()
            ->select(
                'inventory_purchase_orders.*',
                'outlets.outlet_title',
                'employees.employee_name',
                'suppliers.supplier_title',
                'payment_methods.payment_title',
                'payment_types.title as payment_type_title',
                'inventory_purchase_order_details.purchased_quantity'
            )
            ->leftJoin('outlets', 'inventory_purchase_orders.outlet_id', '=', 'outlets.id')
            ->leftJoin('inventory_purchase_order_details', 'inventory_purchase_orders.id', '=', 'inventory_purchase_order_details.inventory_purchase_order_id')
            ->leftJoin('payment_types', 'inventory_purchase_orders.payment_type', '=', 'payment_types.id')
            ->leftJoin('payment_methods', 'inventory_purchase_orders.payment_method_id', '=', 'payment_methods.id')
            ->leftJoin('employees', 'inventory_purchase_orders.created_by', '=', 'employees.id')
            ->leftJoin('suppliers', 'inventory_purchase_orders.supplier_id', '=', 'suppliers.id')
            ->where('inventory_purchase_orders.outlet_id', session('outlet_id'))
            ->whereIn('inventory_purchase_orders.po_status', ['delivered', 'shipped', 'requested', 'in-process'])
            ->orderBy('inventory_purchase_orders.id', 'desc')
            ->get();

        return view('pages.print.purchase_order_export', compact('purchase_orders', 'outlet'));
    }

    public function low_stock()
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $low_stocks = ProductStock::getLowStock()
            ->leftJoin('products', 'product_stocks.product_id', '=', 'products.id')
            ->leftJoin('companies', 'products.company_id', '=', 'companies.id')
            ->leftJoin('outlets', 'product_stocks.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'product_stocks.created_by', '=', 'employees.id')
            ->select('product_stocks.*', 'outlets.outlet_title', 'employees.employee_name', 'products.product_title', 'companies.company_title')
            ->where('product_stocks.outlet_id', session('outlet_id'))
            ->orderBy('product_stocks.id', 'desc')
            ->get();

        return view('pages.print.low_stock_export', compact('low_stocks', 'outlet'));
    }

    public function return_history()
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $return_orders = InventoryPurchaseOrder::leftJoin('suppliers', 'inventory_purchase_orders.supplier_id', '=', 'suppliers.id')
            ->leftJoin('outlets', 'inventory_purchase_orders.outlet_id', '=', 'outlets.id')
            // ->leftJoin('inventory_purchase_order_details', 'inventory_purchase_orders.id', '=', 'inventory_purchase_order_details.inventory_purchase_order_id')
            ->leftJoin('employees', 'inventory_purchase_orders.created_by', '=', 'employees.id')
            ->leftJoin('payment_methods', 'inventory_purchase_orders.payment_method_id', '=', 'payment_methods.id')
            ->selectRaw('inventory_purchase_orders.*')
            ->selectRaw('suppliers.supplier_title')
            ->selectRaw('payment_methods.payment_title')
            ->selectRaw('outlets.outlet_title')
            ->selectRaw('employees.employee_name')
            ->where('inventory_purchase_orders.outlet_id', session('outlet_id'))
            ->where('inventory_purchase_orders.po_status', 'returned')
            ->get();

        return view('pages.print.return_history_export', compact('return_orders', 'outlet'));
    }
    public function lost_stolen_history()
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $lost_stolen_orders = InventoryPurchaseOrder::leftJoin('outlets', 'inventory_purchase_orders.outlet_id', '=', 'outlets.id')
            // ->leftJoin('inventory_purchase_order_details', 'inventory_purchase_orders.id', '=', 'inventory_purchase_order_details.inventory_purchase_order_id')
            ->leftJoin('employees', 'inventory_purchase_orders.created_by', '=', 'employees.id')
            ->leftJoin('payment_methods', 'inventory_purchase_orders.payment_method_id', '=', 'payment_methods.id')
            ->selectRaw('inventory_purchase_orders.*')
            // ->selectRaw('suppliers.supplier_title')
            ->selectRaw('payment_methods.payment_title')
            ->selectRaw('outlets.outlet_title')
            ->selectRaw('employees.employee_name')
            ->whereIn('inventory_purchase_orders.po_status', ['lost', 'stolen', 'expired', 'invalid-entry'])
            ->where('inventory_purchase_orders.outlet_id', session('outlet_id'))
            ->get();

        return view('pages.print.lost_stolen_history_export', compact('lost_stolen_orders', 'outlet'));
    }

    public function supplier_return_history()
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $supplier_return_orders = InventoryPurchaseOrder::leftJoin('suppliers', 'inventory_purchase_orders.supplier_id', '=', 'suppliers.id')
            ->leftJoin('outlets', 'inventory_purchase_orders.outlet_id', '=', 'outlets.id')
            // ->leftJoin('inventory_purchase_order_details', 'inventory_purchase_orders.id', '=', 'inventory_purchase_order_details.inventory_purchase_order_id')
            ->leftJoin('employees', 'inventory_purchase_orders.created_by', '=', 'employees.id')
            ->leftJoin('payment_methods', 'inventory_purchase_orders.payment_method_id', '=', 'payment_methods.id')
            ->selectRaw('inventory_purchase_orders.*')
            ->selectRaw('suppliers.supplier_title')
            ->selectRaw('payment_methods.payment_title')
            ->selectRaw('outlets.outlet_title')
            ->selectRaw('employees.employee_name')
            ->whereIn('inventory_purchase_orders.po_status', ['return-to-supplier'])
            ->where('inventory_purchase_orders.outlet_id', session('outlet_id'))
            ->get();
        // dd($supplier_return_orders);

        return view('pages.print.supplier_return_history_export', compact('supplier_return_orders', 'outlet'));
    }

    public function categories()
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $categories = DB::table('categories')
            ->select('categories.*', 'outlets.outlet_title', 'employees.employee_name')
            ->leftJoin('outlets', 'categories.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'categories.created_by', '=', 'employees.id')
            ->where('categories.outlet_id', session('outlet_id'))
            ->get();



        return view('pages.print.categories_export', compact('categories', 'outlet'));
    }

    public function companies()
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $companies = DB::table('companies')
            ->select('companies.*', 'outlets.outlet_title', 'employees.employee_name')
            ->leftJoin('outlets', 'companies.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'companies.created_by', '=', 'employees.id')
            ->where('companies.outlet_id', session('outlet_id'))
            ->get();



        return view('pages.print.companies_export', compact('companies', 'outlet'));
    }

    public function suppliers()
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $suppliers = Supplier::with(['company'])
            ->select('suppliers.*', 'outlets.outlet_title', 'employees.employee_name')
            ->leftJoin('outlets', 'suppliers.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'suppliers.created_by', '=', 'employees.id')
            ->where('suppliers.outlet_id', session('outlet_id'))
            ->get();


        return view('pages.print.suppliers_export', compact('suppliers', 'outlet'));
    }

    public function supplier_accounts()
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $supplier_accounts = SupplierAccount::select('supplier_accounts.*', 'payment_types.title as payment_type_title', 'outlets.outlet_title', 'employees.employee_name', 'suppliers.supplier_title', 'payment_methods.payment_title')
            ->leftJoin('suppliers', 'supplier_accounts.supplier_id', '=', 'suppliers.id')
            ->leftJoin('payment_methods', 'supplier_accounts.payment_method_id', '=', 'payment_methods.id')
            ->leftJoin('payment_types', 'supplier_accounts.payment_type', '=', 'payment_types.id')
            ->leftJoin('outlets', 'supplier_accounts.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'supplier_accounts.created_by', '=', 'employees.id')
            ->where('supplier_accounts.outlet_id', session('outlet_id'))
            ->latest('supplier_accounts.updated_at')
            ->get();


        return view('pages.print.supplier_accounts_export', compact('supplier_accounts', 'outlet'));
    }

    public function supplier_transactions(Request $request)
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();
        $supplier_transactions = SupplierAccount::select('supplier_accounts.*', 'suppliers.supplier_title', 'payment_types.title as payment_type_title')
            ->leftJoin('suppliers', 'suppliers.id', '=', 'supplier_accounts.supplier_id')
            ->leftJoin('payment_types', 'supplier_accounts.payment_type', '=', 'payment_types.id')
            ->where('supplier_accounts.outlet_id', session('outlet_id'))
            ->get();

        return view('pages.print.supplier_transactions_export', compact('supplier_transactions', 'outlet'));
    }

    public function customer_transactions(Request $request)
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();
        $customer_transactions = CustomerAccount::filter()->select('payment_types.title as payment_type_title', 'customers.customer_name', 'customer_accounts.*')
            ->leftJoin('customers', 'customers.id', '=', 'customer_accounts.customer_id')
            ->leftJoin('payment_types', 'customer_accounts.payment_type', '=', 'payment_types.id')
            ->where('customer_accounts.outlet_id', session('outlet_id'))
            ->get();

        return view('pages.print.customer_transactions_export', compact('customer_transactions', 'outlet'));
    }

    public function customers()
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $customers = DB::table('customers')
            ->select('customers.*', 'outlets.outlet_title', 'employees.employee_name')
            ->leftJoin('outlets', 'customers.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'customers.created_by', '=', 'employees.id')
            ->where('customers.outlet_id', session('outlet_id'))
            ->get();


        return view('pages.print.customers_export', compact('customers', 'outlet'));
    }

    public function customer_accounts()
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $customer_accounts = DB::table('customer_accounts')
            ->select('customer_accounts.*', 'payment_types.title as payment_type_title', 'outlets.outlet_title', 'employees.employee_name', 'customers.customer_name', 'payment_methods.payment_title')
            ->leftJoin('customers', 'customer_accounts.customer_id', '=', 'customers.id')
            ->leftJoin('payment_methods', 'customer_accounts.payment_method_id', '=', 'payment_methods.id')
            ->leftJoin('payment_types', 'customer_accounts.payment_type', '=', 'payment_types.id')
            ->leftJoin('outlets', 'customer_accounts.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'customer_accounts.created_by', '=', 'employees.id')
            ->where('customer_accounts.outlet_id', session('outlet_id'))
            ->get();


        return view('pages.print.customer_accounts_export', compact('customer_accounts', 'outlet'));
    }

    public function employees()
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $employees = DB::table('employees')
            ->select('employees.*', 'outlets.outlet_title', 'users.username')
            ->leftJoin('outlets', 'employees.outlet_id', '=', 'outlets.id')
            ->leftJoin('users', 'employees.created_by', '=', 'users.id')
            ->where('employees.outlet_id', session('outlet_id'))
            ->get();


        return view('pages.print.employees_export', compact('employees', 'outlet'));
    }

    public function products_report(Request $request)
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $items = Product::where('products.outlet_id', session('outlet_id'))
            ->get();


        $product_total = [];

        foreach ($items as $product) {
            $sold_quantity = 0;
            $total_amount = 0;

            $sales = SalesOrderDetail::filter()
                ->where('sales_order_details.outlet_id', session('outlet_id'))
                ->leftJoin('sales_orders', 'sales_orders.id', '=', 'sales_order_details.sales_order_id')
                ->select('sales_order_details.sales_order_id', 'sales_order_details.quantity', 'sales_order_details.product_id', 'sales_order_details.amount_payable as sold_amount')
                ->where('sales_order_details.product_id', $product->id)
                ->get();

            foreach ($sales as $sale) {
                $sold_quantity += $sale->quantity;
                $total_amount += $sale->sold_amount;
            }

            $product_total[] = [
                'product_title' => $product->product_title,
                'sold_quantity' => $sold_quantity,
                'total_amount' => $total_amount,
                'product_id' => $product->id,
                'fromDate' => date('Y-m-d', strtotime(request()->from_date)),
                'toDate' => date('Y-m-d', strtotime(request()->to_date)),
            ];
        }


        if (request()->from_date && request()->to_date != null) {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
        } else {
            $fromDate = Carbon::today()->format('Y-m-d');
            $toDate = Carbon::today()->format('Y-m-d');
        }


        return view('pages.print.products_report_export', compact('product_total', 'outlet'));
    }

    public function expense_categories()
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $expense_categories = DB::table('expense_categories')
            ->select('expense_categories.*', 'outlets.outlet_title', 'employees.employee_name')
            ->leftJoin('outlets', 'expense_categories.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'expense_categories.created_by', '=', 'employees.id')
            ->where('expense_categories.outlet_id', session('outlet_id'))
            ->get();


        return view('pages.print.expense_categories_export', compact('expense_categories', 'outlet'));
    }

    public function expense_transactions()
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $expense_transactions = ExpenseTransaction::filter()
            ->select(
                'expense_transactions.*',
                'expense_categories.title as expense_category',
                'referred_employees.employee_name as referred_user',
                'payment_methods.payment_title as payment_method',
                'outlets.outlet_title',
                'employees.employee_name',
                'payment_types.title as payment_type_title',
            )
            ->leftJoin('expense_categories', 'expense_transactions.expense_category_id', '=', 'expense_categories.id')
            ->leftJoin('employees as referred_employees', 'expense_transactions.referred_user_id', '=', 'referred_employees.id')
            ->leftJoin('payment_methods', 'expense_transactions.payment_method_id', '=', 'payment_methods.id')
            ->leftJoin('payment_types', 'expense_transactions.payment_type', '=', 'payment_types.id')
            ->leftJoin('outlets', 'expense_categories.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'expense_transactions.created_by', '=', 'employees.id')
            ->where('expense_transactions.outlet_id', session('outlet_id'))
            ->get();

        return view('pages.print.expense_transactions_export', compact('expense_transactions', 'outlet'));
    }

    public function parties()
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $parties = DB::table('parties')
            ->select('parties.*', 'outlets.outlet_title', 'employees.employee_name')
            ->leftJoin('outlets', 'parties.outlet_id', '=', 'outlets.id')
            ->leftJoin('employees', 'parties.created_by', '=', 'employees.id')
            ->where('parties.outlet_id', session('outlet_id'))
            ->get();


        return view('pages.print.parties_export', compact('parties', 'outlet'));
    }
    public function party_accounts()
    {

        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        $party_accounts = PartyAccount::select('party_accounts.*', 'payment_types.title as payment_type_title', 'outlets.outlet_title', 'employees.employee_name', 'parties.party_title', 'payment_methods.payment_title')
            ->leftJoin('parties', 'party_accounts.party_id', 'parties.id')
            ->leftJoin('payment_methods', 'party_accounts.payment_method_id', 'payment_methods.id')
            ->leftJoin('payment_types', 'party_accounts.payment_type', 'payment_types.id')
            ->leftJoin('outlets', 'party_accounts.outlet_id', 'outlets.id')
            ->leftJoin('employees', 'party_accounts.created_by', 'employees.id')
            ->where('party_accounts.outlet_id', session('outlet_id'))
            ->latest('party_accounts.updated_at')
            ->get();


        return view('pages.print.party_accounts_export', compact('party_accounts', 'outlet'));
    }

    public function party_transactions(Request $request)
    {
        $outlet = Outlet::where('outlets.id', session('outlet_id'))
            ->leftJoin('cities', 'cities.id', 'outlets.outlet_city')
            ->select('outlets.outlet_title', 'outlets.outlet_phone', 'cities.city_name', 'outlets.outlet_address')
            ->first();

        // $party = Party::where('id', 'party_id')->first();

        $party_transactions = PartyAccount::filter()->select('payment_types.title as payment_type_title', 'parties.party_title', 'party_accounts.*')
            ->leftJoin('parties', 'parties.id', '=', 'party_accounts.party_id')
            ->leftJoin('payment_types', 'party_accounts.payment_type', '=', 'payment_types.id')
            ->where('party_accounts.outlet_id', session('outlet_id'))
            ->get();

        return view('pages.print.party_transactions_export', compact('party_transactions', 'outlet'));
    }
}
