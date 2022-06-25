<?php

namespace App\Http\Controllers\SmartInvoice;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Outlet;
use App\Models\SmartInvoice\Invoice;
use App\Models\SmartInvoice\InvoiceBodyData;
use App\Models\SmartInvoice\InvoiceBodyHeader;
use App\Models\SmartInvoice\InvoiceData;
use App\Models\SmartInvoice\InvoiceFooter;
use App\Models\SmartInvoice\InvoiceHeaderData;
use App\Models\SmartInvoice\SavedTemplate\TemplateInvoice;
use App\Models\SmartInvoice\SavedTemplate\TemplateInvoiceData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{


    public function index()
    {
        $invoices = Invoice::where('outlet_id', session('outlet_id'))->get();
        return view('pages.smart_invoice.select-template', compact('invoices'));
    }
    public function invoices()
    {
        $invoices = Invoice::where('outlet_id', session('outlet_id'))->get();
        return view('pages.smart_invoice.invoice-list', compact('invoices'));
    }
    public function wizard()
    {
        $invoice_std_headers = DB::table('invoice_standard_header')->get();
        $invoice_std_body_headers = DB::table('invoice_standard_body_header')->get();
        $invoice_std_footers = DB::table('invoice_standard_footer')->get();
        // dd($invoice_std_headers);
        return view('pages.smart_invoice.wizard', compact('invoice_std_headers', 'invoice_std_body_headers', 'invoice_std_footers'));
    }
    public function invoice_data(Request $request)
    {
        // return $request->invoice_id;
        if ($request->invoice_id == '') {
            $outlet = Outlet::where('id', session('outlet_id'))->select('outlet_title', 'outlet_address', 'outlet_phone', 'outlet_email', 'outlet_feature_img')->first();
            $customers = Customer::where('outlet_id', session('outlet_id'))->get();
            // dd($customers);
            $header_custom_fields = [];
            $body_header_custom_fields = [];
            $footer_custom_fields = [];

            if ($request->header_custom_fields != '') {
                $header_custom_fields = explode(',', implode(',', array_column(json_decode($request->header_custom_fields), 'value')));
            }
            if ($request->body_header_custom_fields != '') {
                $body_header_custom_fields = explode(',', implode(',', array_column(json_decode($request->body_header_custom_fields), 'value')));
            }
            if ($request->footer_custom_fields != '') {
                $footer_custom_fields = explode(',', implode(',', array_column(json_decode($request->footer_custom_fields), 'value')));
            }
            // dd($header_custom_fields);
            $header_template = $request->header_template;
            $body_template = $request->body_template;
            $footer_template = $request->footer_template;

            $invoice_headers = DB::table('invoice_standard_header')->whereIn('id', $request->header_data)->get();
            $invoice_body_headers = DB::table('invoice_standard_body_header')->whereIn('id', $request->body_header)->get();
            $invoice_footers = DB::table('invoice_standard_footer')->whereIn('id', $request->footer_data)->get();

            return view(
                'pages.smart_invoice.invoice-data',
                compact(
                    'outlet',
                    'customers',
                    'invoice_headers',
                    'invoice_body_headers',
                    'invoice_footers',
                    'header_custom_fields',
                    'body_header_custom_fields',
                    'footer_custom_fields',
                    'header_template',
                    'body_template',
                    'footer_template',
                )
            );
        } else {
            $header_custom_fields = [];
            $body_header_custom_fields = [];
            $footer_custom_fields = [];
            $invoice_data = InvoiceData::where('invoice_id', $request->invoice_id)
                ->first();

            $header_template = $invoice_data->header_tag;
            $body_template = $invoice_data->body_tag;
            $footer_template = $invoice_data->footer_tag;

            $invoice_header_data = DB::table('invoice_header_data')->where('invoice_data_id', $invoice_data->id)->get();

            // $invoice_custom_headers = [];
            $invoice_headers = $invoice_header_data->map(function ($item) {
                $header = DB::table('invoice_standard_header')->where('option', $item->option)->first();
                if ($header) {
                    return $item;
                }
            });

            $invoice_headers = $invoice_headers->filter(function ($item) {
                return !is_null($item);
            });
            // dd($invoice_headers);

            $invoice_custom_headers = $invoice_header_data->map(function ($item) {
                $header = DB::table('invoice_standard_header')->where('option', $item->option)->first();
                if (!$header) {
                    return $item;
                }
            });
            $invoice_custom_headers = $invoice_custom_headers->filter(function ($item) {
                return !is_null($item);
            });
            // dd($invoice_custom_headers);




            $invoice_body_headers = DB::table('invoice_body_header')->where('invoice_data_id', $invoice_data->id)->get();
            $invoice_footer_data = DB::table('invoice_footer')->where('invoice_data_id', $invoice_data->id)->get();
            // $invoice_custom_headers = [];
            $invoice_footers = $invoice_footer_data->map(function ($item) {
                $header = DB::table('invoice_standard_footer')->where('option', $item->option)->first();
                if ($header) {
                    return $item;
                }
            });

            $invoice_footers = $invoice_footers->filter(function ($item) {
                return !is_null($item);
            });

            $invoice_custom_footers = $invoice_footer_data->map(function ($item) {
                $header = DB::table('invoice_standard_footer')->where('option', $item->option)->first();
                if (!$header) {
                    return $item;
                }
            });
            $invoice_custom_footers = $invoice_custom_footers->filter(function ($item) {
                return !is_null($item);
            });
            // dd($invoice_custom_footers);


            return view(
                'pages.smart_invoice.invoice-data',
                compact(
                    'invoice_headers',
                    'invoice_body_headers',
                    'invoice_footers',
                    'invoice_custom_headers',
                    'invoice_custom_footers',
                    'header_custom_fields',
                    'body_header_custom_fields',
                    'footer_custom_fields',
                    'header_template',
                    'body_template',
                    'footer_template',
                )
            );
        }
    }


    public function store_invoice_data(Request $request)
    {
        // dd($request->all());
        DB::transaction(function () use ($request) {
            $invoice = Invoice::create([
                'outlet_id' => session('outlet_id'),
                'customer_id' => $request->customer_id ?? 0,
                // 'customer_id' => $request->customer_name_value,
                'invoice_title' => $request->invoice_title,
            ]);

            $invoice_data = InvoiceData::create([
                'invoice_id' => $invoice->id,
                'header_tag' => $request->header_tag,
                'body_tag' => $request->body_tag,
                'footer_tag' => $request->footer_tag,
                'outlet_id' => session('outlet_id')
            ]);

            if ($request->hasFile('outlet_logo')) {
                $image_full_name = $request->outlet_logo->getClientOriginalName();
                $image_name_arr = explode('.', $image_full_name);
                $image_name = $image_name_arr[0] . time() . '.' . $image_name_arr[1];
                $request->outlet_logo->storeAs('smart-invoice/logo', $image_name, 'public');
            } else {
                $image_name = 'placeholder.jpg';
            }


            for ($i = 0; $i < count($request->header_options); $i++) {
                if ($request->header_options[$i] == 'outlet_logo') {
                    InvoiceHeaderData::create([
                        'invoice_data_id' => $invoice_data->id,
                        'option' => $request->header_options[$i],
                        'value' => $image_name,
                        'outlet_id' => session('outlet_id')
                    ]);
                } else {
                    InvoiceHeaderData::create([
                        'invoice_data_id' => $invoice_data->id,
                        'option' => $request->header_options[$i],
                        'value' => $request->get($request->header_options[$i]),
                        'outlet_id' => session('outlet_id')
                    ]);
                }
            }
            for ($i = 0; $i < count($request->body_header_options); $i++) {

                $invoice_body_header = InvoiceBodyHeader::create([
                    'invoice_data_id' => $invoice_data->id,
                    'option' => $request->body_header_options[$i],   //s_no
                    'value' => $request->get($request->body_header_options[$i]),
                    'outlet_id' => session('outlet_id')
                ]);


                for ($j = 0; $j < $request->row_count; $j++) {
                    // dd($request->get('row_' . ($i + 1) . '_column')[$j]);
                    InvoiceBodyData::create([
                        'invoice_data_id' => $invoice_data->id,
                        'invoice_body_header_id' => $invoice_body_header->id,
                        'value' => $request->get('row_' . ($j + 1) . '_column')[$i],
                    ]);
                }
            }

            for ($i = 0; $i < count($request->footer_options); $i++) {

                InvoiceFooter::create([
                    'invoice_data_id' => $invoice_data->id,
                    'option' => $request->footer_options[$i],
                    'value' => $request->get($request->footer_options[$i]),
                    'outlet_id' => session('outlet_id')
                ]);
            }
        });

        // dd($header_data);
        // $invoice_header_data = InvoiceHeaderData::create([$header_data]);

        return redirect()->route('invoice.index');
    }

    public function invoice_print()
    {
        $invoice = Invoice::find(request()->id);
        $invoice_data = InvoiceData::where('invoice_id', $invoice->id)->first();
        $header_template = $invoice_data->header_tag;
        $body_template = $invoice_data->body_tag;
        $footer_template = $invoice_data->footer_tag;

        $invoice_header_data = InvoiceHeaderData::where('invoice_data_id', $invoice_data->id)->get();
        // $invoice_custom_headers = [];
        $invoice_headers = $invoice_header_data->map(function ($item) {
            $header = DB::table('invoice_standard_header')->where('option', $item->option)->first();
            if ($header) {
                return $item;
            }
        });

        $invoice_headers = $invoice_headers->filter(function ($item) {
            return !is_null($item);
        });
        // dd($invoice_headers);

        $invoice_custom_headers = $invoice_header_data->map(function ($item) {
            $header = DB::table('invoice_standard_header')->where('option', $item->option)->first();
            if (!$header) {
                return $item;
            }
        });
        $invoice_custom_headers = $invoice_custom_headers->filter(function ($item) {
            return !is_null($item);
        });
        // dd($invoice_custom_headers);




        $invoice_body_headers = InvoiceBodyHeader::where('invoice_data_id', $invoice_data->id)->get();

        $body_data = array();
        $body_header_id = array();
        foreach ($invoice_body_headers as $invoice_body_header) {
            $body_header_id[] = $invoice_body_header->id;
        }
        $invoice_body_data = InvoiceBodyData::where('invoice_data_id', $invoice_data->id)
            ->whereIn('invoice_body_header_id', $body_header_id)
            ->pluck('value');

        for ($i = 0; $i < count($invoice_body_data) / count($invoice_body_headers); ++$i) {
            $count = $i;
            while ($count < count($invoice_body_data)) {
                $body_data[$i][$count] = $invoice_body_data[$count];
                $count += count($invoice_body_data) / count($invoice_body_headers);
            }
            $count = $i;
            $count++;
        }

        $invoice_footers = InvoiceFooter::where('invoice_data_id', $invoice_data->id)->get();
        // dd($invoice_footers);
        return view('pages.smart_invoice.invoice_print', compact(
            'invoice_headers',
            'invoice_custom_headers',
            'invoice_body_headers',
            'invoice_footers',
            'body_data',
            'header_template',
            'body_template',
            'footer_template',
        ));
        // dd($invoice_footers);
    }
}
