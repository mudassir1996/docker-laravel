<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CustomerAccount;
use App\Models\Employee;
use App\Models\Inventory\InventoryPurchaseOrder;
use App\Models\Product;
use App\Models\Sales\SalesOrder;
use App\Models\SupplierAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

    /**
     * Search for a name.
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function employees($id)
    {
        $outlet =  DB::table('outlets')->where('id', $id)->first();
        // return $outlet;
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {

                $employees = Employee::where('outlet_id', $outlet->id)
                    ->select('id', 'employee_name')
                    ->get();

                return response()->json([
                    'Employees' =>
                    $employees
                ]);
            } else {
                return response(
                    [
                        'message' => 'Sorry, you are not allowed to access this outlet.'
                    ],
                    401
                );
            }
        } else {
            return response(
                [
                    'message' => 'Sorry, you are not allowed to access this outlet.'
                ],
                401
            );
        }
    }


    public function recent_orders($id)
    {

        $outlet =  DB::table('outlets')->where('id', $id)->first();
        if ($outlet->created_by == auth()->user()->id) {
            $orders = DB::table('sales_orders')
                ->where('sales_orders.outlet_id', $outlet->id)
                ->orderByDesc('sales_orders.id')
                ->join('customers', 'sales_orders.customer_id', '=', 'customers.id')
                ->select('sales_orders.id', 'customers.customer_name', 'sales_orders.payment_type', 'sales_orders.amount_payable')
                ->limit(5)
                ->get();

            return response()->json(["data" => $orders]);
        } else {
            return response(
                [
                    'message' => 'Sorry, you are not allowed to access this outlet.'
                ],
                401
            );
        }
    }

    public function ordersData($id, $date)
    {
        $outlet =  DB::table('outlets')->where('id', $id)->first();
        if ($outlet->created_by == auth()->user()->id) {
            $orders = DB::table('sales_orders')
                ->where('sales_orders.outlet_id', $outlet->id)
                ->whereDate('sales_orders.created_at', $date)
                ->orderByDesc('sales_orders.id')
                ->join('customers', 'sales_orders.customer_id', '=', 'customers.id')
                ->join('payment_types', 'sales_orders.payment_type', '=', 'payment_types.id')
                ->select('sales_orders.id', 'payment_types.title as payment_type', 'customers.customer_name', 'sales_orders.total_bill', 'sales_orders.so_discount_value', 'sales_orders.amount_payable', 'sales_orders.order_completion_date as order_time')
                ->get();

            $orders = collect($orders)->map(function ($item) {
                $item->order_time = date('h:i A', strtotime($item->order_time));
                return $item;
            });

            return response()->json(["TodayOrders" => $orders]);
        } else {
            return response(
                [
                    'message' => 'Sorry, you are not allowed to access this outlet.'
                ],
                401
            );
        }
    }



    public function my_outlets()
    {
        // $outlets = DB::table('outlets')->where('created_by', auth()->user()->id)->select('id', 'outlet_title', 'outlet_address')->get();
        $outlets = DB::table('outlets')->where('outlets.created_by', auth()->user()->id)
            ->join('cities', 'outlets.outlet_city', 'cities.id')
            ->join('outlet_statuses', 'outlets.outlet_status_id', 'outlet_statuses.id')
            ->orderByDesc('outlets.id')
            ->select('outlets.id', 'outlets.outlet_title', 'outlets.outlet_address', 'cities.city_name as outlet_city', 'outlet_statuses.status_title as outlet_status')
            ->get();

        $outlets = $outlets->map(function ($item) {
            $premium = DB::table('subscriptions')
                ->where('outlet_id', $item->id)
                ->where('subscription_status', 'verified')
                ->whereDate('subscription_start_date', '<=', Carbon::today()->format('Y-m-d h:i:s'))
                ->whereDate('subscription_end_date', '>=', Carbon::today()->format('Y-m-d h:i:s'))
                ->first();

            if ($premium) {
                $item->is_premium = 1;
            } else {
                $item->is_premium  = 0;
            }

            return $item;
        });
        return response()->json(['outlet' => $outlets]);
    }


    public function dashboardData($id, $date)
    {
        $outlet =  DB::table('outlets')->where('id', $id)->first();
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {
                $today_sales = SalesOrder::where('sales_orders.outlet_id', $outlet->id)->whereDate('sales_orders.created_at', $date)->where('so_status', 'completed');
                $credit_sales = SalesOrder::where('sales_orders.outlet_id', $outlet->id)->leftJoin('payment_types', 'payment_types.id', 'sales_orders.payment_type')->where('payment_types.value', '1')->whereDate('sales_orders.created_at', $date);
                $today_products = Product::where('outlet_id', $outlet->id)->whereDate('created_at', $date)->get();
                $today_customers = DB::table('customers')->where('outlet_id', $outlet->id)->whereDate('created_at', $date)->get();
                $today_purchase_orders = DB::table('inventory_purchase_orders')->where('outlet_id', $outlet->id)->whereDate('created_at', $date)->get();
                $today_expenses = DB::table('expense_transactions')->where('outlet_id', $outlet->id)->whereDate('created_at', $date)->get();

                $incomingCashSales = SalesOrder::where('sales_orders.outlet_id', $outlet->id)->whereDate('sales_orders.created_at', $date)
                    ->leftJoin('payment_types', 'payment_types.id', 'sales_orders.payment_type')
                    ->where('payment_types.value', '0')
                    ->get();


                $incomingSplitBillSales = SalesOrder::where('sales_orders.outlet_id', $outlet->id)->whereDate('sales_orders.created_at', $date)
                    ->leftJoin('payment_types', 'payment_types.id', 'sales_orders.payment_type')
                    ->where('payment_types.value', '2')
                    ->get();
                // return $incomingCashSales;

                $inCustomerSales = CustomerAccount::where('customer_accounts.outlet_id', $outlet->id)->whereDate('customer_accounts.created_at', $date)
                    ->leftJoin('payment_types', 'payment_types.id', 'customer_accounts.payment_type')
                    ->where('payment_types.value', '0')
                    ->get();

                $incoming_sales =   (float)$incomingCashSales->sum('amount_payable') + (float)$incomingSplitBillSales->sum('amount_paid') + (float)$inCustomerSales->sum('amount');

                $outCustomerSales = CustomerAccount::where('customer_accounts.outlet_id', $outlet->id)->whereDate('customer_accounts.created_at', $date)
                    ->where('customer_accounts.description', '!=', 'Credit order has been placed')
                    ->where('customer_accounts.description', '!=', 'Split order has been placed')
                    ->leftJoin('payment_types', 'payment_types.id', 'customer_accounts.payment_type')
                    ->where('payment_types.value', '1')
                    ->get();

                $outSupplierSales = SupplierAccount::where('supplier_accounts.outlet_id', $outlet->id)->whereDate('supplier_accounts.created_at', $date)
                    ->leftJoin('payment_types', 'payment_types.id', 'supplier_accounts.payment_type')
                    ->where('payment_types.value', '1')
                    ->get();



                $purchaseOrders = InventoryPurchaseOrder::where('outlet_id', $outlet->id)->whereDate('created_at', $date)
                    ->where('po_status', 'delivered')
                    ->get();

                $outgoing_sales = $outCustomerSales->sum('amount_payable') + $outSupplierSales->sum('amount') + $purchaseOrders->sum('amount_payable') + $today_expenses->sum('amount');
                $average_sales_collect = $today_sales;
                $profit_sales = $today_sales;

                if (count($average_sales_collect->get()) == 0) {
                    $average_sales = 0;
                } else {
                    $average_sales = ((float)$average_sales_collect->min('amount_payable') + (float)$average_sales_collect->max('amount_payable')) / 2;
                }
                if (count($today_sales->get()) == 0) {
                    $credit_sales_percentage = 0;
                } else {
                    $credit_sales_percentage = ($credit_sales->count('sales_orders.id') / count($today_sales->get())) * 100;
                }

                // return $credit_sales->count('id');

                if (count($today_sales->get()) == 0) {
                    $total_profit_percentage = 0.00;
                } else {

                    $total_profit_percentage = number_format($profit_sales->sum('profit_percentage') / count($today_sales->get()));
                }

                if ($today_sales->max('amount_payable') == 0) {
                    $average_sales_percentage = 0;
                } else {
                    $average_sales_percentage = number_format(($average_sales / $today_sales->max('amount_payable')) * 100);
                }
                return response()->json([
                    'OutletSummary' => [
                        'Outlet_ID'  => $outlet->id,
                        'Outlet_Title' => $outlet->outlet_title,
                        'Today_Expenses' => number_format($today_expenses->sum('amount'), 2),
                        'Total_Sales' => number_format($today_sales->sum('amount_payable'), 2),
                        'Total_Orders' => count($today_sales->get()),
                        'Total_Profit' => $today_sales->sum('profit_value'),
                        'Total_Profit_Percentage' => $total_profit_percentage,
                        'Today_New_Customers' => count($today_customers),
                        'Today_New_Products' => count($today_products),
                        'Total_Purchase_Orders' => count($today_purchase_orders),
                        'Requested' => count($today_purchase_orders->where('po_status', 'requested')),
                        'InProgress' => count($today_purchase_orders->where('po_status', 'in-process')),
                        'Shipped' => count($today_purchase_orders->where('po_status', 'shipped')),
                        'Delivered' => count($today_purchase_orders->where('po_status', 'delivered')),
                        'Total_Incoming_Amount' => number_format($incoming_sales, 2),
                        'Total_Outgoing_Amount' => number_format($outgoing_sales, 2),
                        'Average_Sales_Amount' =>  number_format($average_sales, 2),
                        'Minimum_Sales_Amount' => number_format($today_sales->min('amount_payable'), 2) ?? 0.00,
                        'Maximum_Sales_Amount' => number_format($today_sales->max('amount_payable'), 2) ?? 0.00,
                        'Average_Sales_Percentage' => $average_sales_percentage,
                        'Credit_Sales_Percentage' => number_format($credit_sales_percentage),
                        'Today_Total_Credit_Orders' => count($today_sales->leftJoin('payment_types', 'payment_types.id', 'sales_orders.payment_type')->where('payment_types.value', '1')->get()),
                        'Today_Total_Credit_Amount' => number_format($today_sales->where('payment_types.value', '1')->sum('amount_payable'), 2),
                    ],

                ]);
            } else {
                return response(
                    [
                        'message' => 'Sorry, you are not allowed to access this outlet.'
                    ],
                    401
                );
            }
        } else {
            return response(
                [
                    'message' => 'Sorry, you are not allowed to access this outlet.'
                ],
                401
            );
        }
    }


    public function expenses($id, $date)
    {
        $outlet =  DB::table('outlets')->where('id', $id)->first();
        // return $outlet;
        if ($outlet) {
            if ($outlet->created_by == auth()->user()->id) {
                $today_expenses = DB::table('expense_transactions')->where('expense_transactions.outlet_id', $outlet->id)
                    ->whereDate('expense_transactions.created_at', $date)
                    ->leftJoin('expense_categories', 'expense_categories.id', '=', 'expense_transactions.expense_category_id')
                    ->leftJoin('employees', 'expense_transactions.referred_user_id', '=', 'employees.id')
                    ->leftJoin('employees as e', 'expense_transactions.created_by', '=', 'e.id')
                    ->select(
                        'expense_transactions.title as transaction_title',
                        'expense_transactions.description',
                        'expense_categories.title as expense_category',
                        'expense_transactions.amount',
                        'employees.employee_name as referred_user',
                        'e.employee_name as created_by'
                    )
                    ->get();
                return response()->json([
                    'TodayExpenses' =>
                    $today_expenses
                ]);
            } else {
                return response(
                    [
                        'message' => 'Sorry, you are not allowed to access this outlet.'
                    ],
                    401
                );
            }
        } else {
            return response(
                [
                    'message' => 'Sorry, you are not allowed to access this outlet.'
                ],
                401
            );
        }
    }
}
