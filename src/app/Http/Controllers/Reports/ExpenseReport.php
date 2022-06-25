<?php

namespace App\Http\Controllers\Reports;

use App\Classes\Subscriber;
use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use App\Models\ExpenseTransaction;
use App\Models\Outlet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ExpenseReport extends Controller
{
    public function filterData(Request $request)
    {


        abort_if(!Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');

        abort_if(Gate::denies('reports_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('expense_report'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        if (request()->from_date && request()->to_date != null) {
            $fromDate = $request->from_date;
            $toDate = $request->to_date;
        } else {
            $fromDate = Carbon::today()->format('Y-m-d');
            $toDate = Carbon::today()->format('Y-m-d');
        }

        $expenses = ExpenseCategory::where('outlet_id', session('outlet_id'))->get();


        $all_transactions = [];

        foreach ($expenses as $expense) {
            $transactions = 0;
            $expense_transaction_amount = 0;

            $expense_transactions = ExpenseTransaction::filter()->where('expense_transactions.outlet_id', session('outlet_id'))
                ->where('expense_transactions.expense_category_id', $expense->id)
                ->select(DB::raw('count(expense_transactions.expense_category_id) as transactions,sum(expense_transactions.amount) as amount'))
                ->get();


            foreach ($expense_transactions as $expense_transaction) {

                $expense_transaction_amount = $expense_transaction->amount;
                $transactions = $expense_transaction->transactions;
            }


            $all_transactions[] = [
                'expense_category_id' => $expense->id,
                'expense_category' => $expense->title,
                'transactions' => $transactions,
                'expense_transaction_amount' => $expense_transaction_amount ?? 0,
            ];
        }





        return view('pages.reports.expense_report.expense_report', compact('all_transactions', 'fromDate', 'toDate'));
    }


    public function expense_category_transaction($fromDate, $toDate, $id)
    {
        abort_if(Subscriber::isPremium(), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category = ExpenseCategory::where('id', $id)->where('outlet_id', session('outlet_id'))->firstOrFail();
        $category_transactions = ExpenseTransaction::where('expense_transactions.expense_category_id', $category->id)
            ->whereDate('expense_transactions.created_at', '>=', $fromDate)
            ->whereDate('expense_transactions.created_at', '<=', $toDate)
            ->join('employees', 'employees.id', '=', 'expense_transactions.created_by')
            ->select('expense_transactions.*', 'employees.employee_name')
            ->get();

        return view('pages.reports.expense_report.expense_category_transactions', compact('category_transactions', 'category'));
    }
}
