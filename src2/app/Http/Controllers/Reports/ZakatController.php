<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class ZakatController extends Controller
{
    public function calculateZakat()
    {
        abort_if(Gate::denies('reports_screen'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (!Auth::guard('web')->check()) {
            abort_if(Gate::denies('zakat_calculator'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }
        $total_retail = 0;
        $total_zakat = 0;

        $product_stocks = ProductStock::where('outlet_id', session('outlet_id'))->select('retail_price', 'units_in_stock')->get();

        $total_retail = $product_stocks->sum(function ($item) {
            return $item->retail_price * $item->units_in_stock;
        });

        $total_zakat = $total_retail / 40;

        return view('pages.reports.zakat-calculator', compact('total_retail', 'total_zakat'));
    }
}
