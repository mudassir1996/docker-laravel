<?php

namespace App\Http\Controllers\Charts;

use App\Charts\SalesChart;
use App\Http\Controllers\Controller;
use App\Models\Sales\SalesOrder;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class SalesChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = SalesOrder::select('id', 'created_at')
        ->whereBetween('created_at', [Carbon::today()->subDays(7)->format('Y-m-d H:i:s'), Carbon::today()->format('Y-m-d H:i:s')])
        ->get()
        ->groupBy(function ($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('d'); // grouping by months
        });

       $fromDate= Carbon::today()->subDays(7)->format('Y-m-d H:i:s');
       $toDate= Carbon::today()->format('Y-m-d H:i:s');

        // dd($sales);


        $salesdcount = [];
        $salesArr = [];

        foreach ($sales as $key => $value) {
            $salesdcount[(int)$key] = count($value);
        }

        //  dd(Carbon::today()->subMonths(10)->format('M'));
        $i= Carbon::today()->subDays(7)->format('j');
        $j=Carbon::today()->format('j');
        for ($i; $i <= $j; $i++) {
            if (!empty($salesdcount[$i])) {
                $salesArr[$i] = $salesdcount[$i];
            } else {
                $salesArr[$i] = 0;
            }
            
        }
        // dd($salesArr);


        $salesChart=new SalesChart;
        $salesChart->labels(array_keys($salesArr));
        
        $salesChart->dataset('No of Sales', 'line',array_values($salesArr))
        
        ->backgroundcolor("rgb(255, 99, 132)");
        ;

        // dd($salesChart);

        return view('pages.reports.saler_report.sales_chart', compact('salesChart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
