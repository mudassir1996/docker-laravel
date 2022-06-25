@extends('layout.default-sales')
@section('title', 'Add Outlet Discount')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/airlines/order.css') }}">
@endsection
@section('content')
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid mt-15 px-md-5">
        <!--begin::Container-->
        <div class="container-fluid px-0">
            <!--begin::Teachers-->
            <div class="d-flex flex-row">
                <!--begin::Content-->
                <div class="flex-row-fluid">
                    <div class="row">
                        <div class="col-md-8 col-12">
                            {{-- Order Information --}}
                            <div class="card card-custom mb-3" style="background: #f9f9f9">
                                <div class="card-body py-4">
                                    <div class="form-group row">
                                        <div class="col-xl-3 pr-0 mb-5">
                                            <label for="">Invoice Date</label>
                                            <p class="invoice_date_picker font-weight-bolder font-size-h6">
                                                {{ date('Y-m-d', time()) }}</p>
                                            <input type="hidden" name="invoice_date" value="{{ date('Y-m-d', time()) }}">
                                        </div>
                                        <div class="col-xl-3 pr-0">
                                            <label for="">Invoice Category</label>
                                            <select name="" class="form-control selectpicker" data-live-search="true"
                                                title="Select Category" data-size="5" id="">
                                                <option value="UMERA">UMERA</option>
                                                <option value="VISA">VISA</option>
                                                <option value="PROTECTOR">PROTECTOR</option>
                                                <option value="SEAT RESERVATION">SEAT RESERVATION</option>
                                                <option value="TRANSIT VISA">TRANSIT VISA</option>
                                                <option value="VISIT VISA">VISIT VISA</option>
                                                <option value="DUBAI VISA">DUBAI VISA</option>
                                                <option value="KUWAIT VISA">KUWAIT VISA</option>
                                                <option value="TICKETS">TICKETS</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-3 pr-0">
                                            <label for="">Receipt No.</label>
                                            <input type="text" name="" id="" disabled style="height:30px"
                                                class="form-control p-2" placeholder="Receipt No">
                                        </div>
                                        <div class="col-xl-3 pr-0">
                                            <label for="">Status</label>
                                            <select name="" class="form-control selectpicker">
                                                <option value="1">Issued</option>
                                                <option value="2">Refunded</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-3 pr-0">
                                            <label for="client">Client</label>
                                            <div class="input-group">
                                                <select class="form-control selectpicker" id="client"
                                                    data-live-search="true" title="Choose Client">
                                                    @foreach ($parties as $party)
                                                        <option value="{{ $party->id }}">{{ $party->party_title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary btn-sm" data-toggle="modal"
                                                        data-target="#add-client" style="padding: 0.3rem 0.6rem"
                                                        type="button">
                                                        <i class="flaticon2-plus-1"></i>
                                                    </button>
                                                </div>

                                                {{-- Add Client Modal --}}
                                                <div class="modal" id="add-client" tabindex="-1" role="dialog"
                                                    aria-labelledby="add-client" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Add
                                                                    Client/Party</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group row">
                                                                    <div class="col-xl-6">
                                                                        <label for="">Client title *</label>
                                                                        <input type="text" class="form-control p-2"
                                                                            style="height:30px" autocomplete="no"
                                                                            name="client_title" id="" placeholder="Title">
                                                                    </div>
                                                                    <div class="col-xl-6">
                                                                        <label for="">Phone</label>
                                                                        <input type="text" class="form-control p-2"
                                                                            style="height:30px" name="client_phone" id=""
                                                                            autocomplete="no" placeholder="Phone">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-light-primary font-weight-bold"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="button" id="save-client"
                                                                    class="btn btn-primary font-weight-bold">Save
                                                                    Client</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 pr-0">
                                            <label for="agent">Agent</label>
                                            <div class="input-group">
                                                <select class="form-control selectpicker" id="agent" data-live-search="true"
                                                    title="Choose Agent">
                                                    @foreach ($parties as $party)
                                                        <option value="{{ $party->id }}">{{ $party->party_title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-secondary btn-sm" data-toggle="modal"
                                                        data-target="#add-agent" style="padding: 0.3rem 0.6rem"
                                                        type="button">
                                                        <i class="flaticon2-plus-1"></i>
                                                    </button>
                                                </div>
                                                {{-- Add Agent Modal --}}
                                                <div class="modal" id="add-agent" tabindex="-1" role="dialog"
                                                    aria-labelledby="add-agent" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Add
                                                                    Agent/Party</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group row">
                                                                    <div class="col-xl-6">
                                                                        <label for="">Agent title *</label>
                                                                        <input type="text" class="form-control p-2"
                                                                            style="height:30px" autocomplete="no"
                                                                            name="agent_title" id="" placeholder="Title">
                                                                    </div>
                                                                    <div class="col-xl-6">
                                                                        <label for="">Phone</label>
                                                                        <input type="text" class="form-control p-2"
                                                                            style="height:30px" name="agent_phone" id=""
                                                                            autocomplete="no" placeholder="Phone">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-light-primary font-weight-bold"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="button" id="save-agent"
                                                                    class="btn btn-primary font-weight-bold">Save
                                                                    Agent</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Ticket Details --}}
                            <div class="card card-custom mb-3" style="background: #f9f9f9">
                                <div class="card-header min-h-50px">
                                    <div class="card-title">
                                        Ticket Details
                                    </div>
                                    <div class="card-toolbar text-right">
                                        <button class="btn btn-primary btn-sm" type="button" id="add-ticket">Add
                                            Ticket</button>
                                    </div>
                                </div>
                                <div class="card-body py-4" id="tickets">
                                    <div class="row border-bottom" id="ticket-1">
                                        <div class="col-xl-12 text-right mt-3">
                                            <button class="btn font-weight-bold btn-light-danger btn-icon remove-btn"
                                                style="height: 30px; width:30px" id="remove-ticket-1">
                                                <i class="la la-remove"></i>
                                            </button>
                                        </div>
                                        <div class="col-xl-8">
                                            <div class="form-group row mb-3">
                                                <div class="col-xl-3 pr-0 mb-3">
                                                    <label for="">Pax Title</label>
                                                    <select name="" class="form-control selectpicker" id="">
                                                        <option value="adult">Adult</option>
                                                        <option value="child">Child</option>
                                                        <option value="infant">Infant</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-7 pr-0">
                                                    <label for="">Pax Name</label>
                                                    <input type="text" name="" id="" style="height:30px"
                                                        class="form-control p-2" placeholder="Pax Name">
                                                </div>
                                                <div class="col-xl-2 pr-0">
                                                    <label for="">Class</label>
                                                    <input type="text" name="class" id="" style="height:30px"
                                                        class="form-control p-2" placeholder="Class">
                                                </div>
                                                <div class="col-xl-3 mb-3 pr-0">
                                                    <label for="">Flight</label>
                                                    <select name="" class="form-control selectpicker" id="">
                                                        <option value="1">Domestic</option>
                                                        <option value="2">International</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 mb-3  pr-0">
                                                    <label for="">Ticket #</label>
                                                    <input type="text" name="" id="" style="height:30px"
                                                        class="form-control p-2 ticket_mask" placeholder="Ticket #">
                                                </div>
                                                <div class="col-xl-3 pr-0">
                                                    <label for="">Flight #</label>
                                                    <input type="text" name="flight_number" id="" style="height:30px"
                                                        class="form-control p-2" placeholder="Flight #">
                                                </div>
                                                <div class="col-xl-3 pr-0">
                                                    <label for="">Departure Date</label>
                                                    <input type="text" name="departure_date" style="height:30px"
                                                        value="{{ date('Y-m-d', time()) }}" readonly
                                                        class="form-control p-2 kt_datepicker_3">
                                                </div>

                                                <div class="col-xl-3 pr-0">
                                                    <label for="">Sector</label>
                                                    <input type="text" name="" id="" style="height:30px"
                                                        class="form-control p-2" placeholder="Sector">
                                                </div>
                                                <div class="col-xl-3 pr-0">
                                                    <label for="">Route</label>
                                                    <select name="" class="form-control selectpicker" id="">
                                                        <option value="1">One Way</option>
                                                        <option value="2">Two Way</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-3 pr-0">
                                                    <label for="">PNR #</label>
                                                    <input type="text" name="" id="" style="height:30px"
                                                        class="form-control p-2" placeholder="PNR #">
                                                </div>
                                                <div class="col-xl-3 pr-0">
                                                    <label for="">GDS PNR #</label>
                                                    <input type="text" name="" id="" style="height:30px"
                                                        class="form-control p-2" placeholder="GDS PNR #">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="row">
                                                <div class="col-6 pr-2">
                                                    <div class="form-group mb-3">
                                                        <label for="">Market Price</label>
                                                        <input type="text" name="market_price[]" style="height:30px"
                                                            class="form-control p-2 currency text-left market-price"
                                                            placeholder="Market Price">
                                                    </div>
                                                </div>
                                                <div class="col-6 pl-0">
                                                    <div class="form-group mb-3">
                                                        <label for="">Service Charges</label>
                                                        <div class="input-group my-group">
                                                            <input type="text"
                                                                class="form-control text-left currency service-charges p-2 col-6"
                                                                name="" style="height: 30px" placeholder="Amount">
                                                            <select class="form-control p-2 col-6 service-charges-type"
                                                                maxlength="3" style="height: 30px">
                                                                <option value="%">%</option>
                                                                <option value="PKR">PKR</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group mb-3">
                                                        <label for="">Remarks</label>
                                                        <textarea class="form-control p-2" rows="4"
                                                            placeholder="Remarks"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            {{-- Order Total --}}
                            <div class="card card-custom mb-3" style="background: #f9f9f9">
                                <div class="card-body py-4">
                                    <div class="form-group row">
                                        <div class="col-xl-2 pr-0">
                                            <label for="">Recievable</label>
                                            <input type="text" name="" id="" style="height:30px"
                                                class="form-control p-2 currency text-left recievable"
                                                placeholder="Total Recievable">
                                        </div>
                                        <div class="col-xl-2 pr-0">
                                            <label for="">Payable</label>
                                            <input type="text" name="" id="" style="height:30px"
                                                class="form-control p-2 currency text-left" placeholder="Total Payable">
                                        </div>
                                        <div class="col-xl-2 pr-0">
                                            <label for="">Total Income</label>
                                            <input type="text" name="" id="" style="height:30px"
                                                class="form-control p-2 currency text-left total-income"
                                                placeholder="Total Income">
                                        </div>
                                        <div class="col-xl-2 pr-0">
                                            <label for="">Payment Method</label>
                                            <select class="form-control selectpicker" data-live-search="true">
                                                @foreach ($payment_methods as $payment_method)
                                                    <option value="{{ $payment_method->id }}">
                                                        {{ $payment_method->payment_title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xl-2 pr-0">
                                            <label for="">Refund from Airline</label>
                                            <input type="text" name="" id="" style="height:30px"
                                                class="form-control p-2 currency text-left" placeholder="from Airline">
                                        </div>
                                        <div class="col-xl-2 pr-0">
                                            <label for="">Net</label>
                                            <input type="text" name="" id="" style="height:30px"
                                                class="form-control p-2 currency text-left" placeholder="Net">
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-between align-items-center mb-0">
                                        <div class="col-xl-3">
                                            <label for="" class="font-weight-bolder font-size-h6">Grand Total</label>
                                            <input type="text" name="" id="" style="height:30px"
                                                class="form-control p-2 currency text-left grand-total"
                                                placeholder="Grand Total">
                                        </div>
                                        <div class="col-xl-3 ">
                                            <button type="button" class="btn btn-success btn-block font-weight-bolder">Save
                                                order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Order tax, commission, and discount --}}
                        <div class="col-md-4 col-12">
                            {{-- TAX --}}
                            <div class="card card-custom mb-3" style="background: #f9f9f9">
                                <div class="card-header min-h-50px">
                                    <h2 class="card-title">
                                        Order Tax
                                    </h2>
                                </div>
                                <div class="card-body p-3">
                                    <div class="card-scroll"
                                        style="max-height: 200px; overflow-x:hidden; overflow-y:auto; ">
                                        <div id="kt_repeater_1">
                                            <div class="form-group row mb-0">
                                                <div data-repeater-list="" class="col-lg-12">
                                                    <div data-repeater-item
                                                        class="form-group row align-items-center mb-2 tax-repeater-item">
                                                        <div class="col-md-4 col-4 pr-2">
                                                            <label>Title</label>
                                                            <select name="" class="form-control select2 tax-title"
                                                                placeholder="Select" id="">
                                                                <option value=""></option>
                                                                @foreach ($taxes as $tax)
                                                                    <option value="{{ $tax->id }}">
                                                                        {{ $tax->tax_title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 col-4 px-0">
                                                            <label>Value</label>
                                                            <div class="input-group my-group">
                                                                <input type="text"
                                                                    class="form-control text-left currency tax-value p-2 col-7"
                                                                    name="" style="height: 30px" placeholder="Amount">
                                                                <select class="form-control p-2 col-5 tax-type"
                                                                    style="height: 30px">
                                                                    <option value="%">%</option>
                                                                    <option value="PKR">PKR</option>
                                                                </select>

                                                            </div>

                                                        </div>
                                                        <div class="col-md-4 col-4 pl-2">
                                                            <a href="javascript:;" data-toggle="collapse"
                                                                style="height: 30px; width:30px"
                                                                data-target="#tax-collapse1" aria-expanded="false"
                                                                aria-controls="collapseExample"
                                                                class="btn font-weight-bold btn-light-success btn-icon mt-8 tax-collapse-btn">
                                                                <i class="la la-angle-down"></i>
                                                            </a>

                                                            {{-- <a href="javascript:;" id="accordionExample4" class="btn font-weight-bold btn-success btn-icon mt-8">
                                                                <i class="la la-angle-down"></i>
                                                            </a> --}}
                                                            <a href="javascript:;" data-repeater-delete=""
                                                                style="height: 30px; width:30px"
                                                                class="btn font-weight-bold btn-light-danger btn-icon mt-8">
                                                                <i class="la la-remove"></i>
                                                            </a>
                                                        </div>
                                                        <div class="collapse tax-collapse col-md-8 mt-2 pr-0"
                                                            id="tax-collapse1">
                                                            <textarea class="form-control" id=""
                                                                placeholder="Description" rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="col-lg-6">
                                                    <a href="javascript:;" data-repeater-create=""
                                                        class="btn btn-sm font-weight-bolder btn-light-primary tax-add">
                                                        <i class="la la-plus"></i>Add
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between py-2">
                                    <span class="font-weight-bold font-size-lg">Total Tax</span>
                                    <input type="hidden" id="total-tax-value">
                                    <span class="font-weight-bold font-size-lg">PKR <span
                                            id="total-tax-label">0.00</span></span>
                                </div>
                            </div>

                            {{-- Discount --}}
                            <div class="card card-custom mb-3" style="background: #f9f9f9">
                                <div class="card-header min-h-50px">
                                    <h3 class="card-title">
                                        Order Discount
                                    </h3>
                                </div>
                                <div class="card-body p-3">
                                    <div class="card-scroll"
                                        style="max-height: 200px; overflow-x:hidden; overflow-y:auto; ">
                                        <div id="kt_repeater_2">
                                            <div class="form-group row mb-0">
                                                <div data-repeater-list="" class="col-lg-12">
                                                    <div data-repeater-item
                                                        class="form-group row align-items-center mb-2 discount-repeater-item">
                                                        <div class="col-md-4 col-4 pr-2">
                                                            <label>Title</label>
                                                            <select name="" class="form-control select2 discount-title"
                                                                id="">
                                                                <option value=""></option>
                                                                @foreach ($discounts as $discount)
                                                                    <option value="{{ $discount->id }}">
                                                                        {{ $discount->discount_title }}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 col-4 px-0">
                                                            <label>Value</label>
                                                            <div class="input-group my-group">
                                                                <input type="text"
                                                                    class="form-control p-2 text-left currency discount-value"
                                                                    style="height: 30px" placeholder="Amount" />
                                                                <select class="form-control p-2 col-5 discount-type"
                                                                    style="height: 30px">
                                                                    <option value="%">%</option>
                                                                    <option value="PKR">PKR</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-4 pl-2">
                                                            <a href="javascript:;" data-toggle="collapse"
                                                                style="height: 30px; width:30px"
                                                                data-target="#discount-collapse1" aria-expanded="false"
                                                                aria-controls="collapseExample"
                                                                class="btn font-weight-bold btn-light-success btn-icon mt-8 discount-collapse-btn">
                                                                <i class="la la-angle-down"></i>
                                                            </a>

                                                            {{-- <a href="javascript:;" id="accordionExample4" class="btn font-weight-bold btn-success btn-icon mt-8">
                                                                <i class="la la-angle-down"></i>
                                                            </a> --}}
                                                            <a href="javascript:;" data-repeater-delete=""
                                                                style="height: 30px; width:30px"
                                                                class="btn font-weight-bold btn-light-danger btn-icon mt-8">
                                                                <i class="la la-remove"></i>
                                                            </a>
                                                        </div>
                                                        <div class="collapse discount-collapse col-md-8 mt-2 pr-0"
                                                            id="discount-collapse1">
                                                            <textarea class="form-control" id=""
                                                                placeholder="Description" rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="col-lg-6">
                                                    <a href="javascript:;" data-repeater-create=""
                                                        class="btn btn-sm font-weight-bolder btn-light-primary">
                                                        <i class="la la-plus"></i>Add
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between py-2">
                                    <span class="font-weight-bold font-size-lg">Total Discount</span>
                                    <input type="hidden" id="total-discount-value">
                                    <span class="font-weight-bold font-size-lg">PKR <span
                                            id="total-discount-label">0.00</span></span>
                                </div>
                            </div>

                            {{-- Commission --}}
                            <div class="card card-custom mb-3" style="background: #f9f9f9">
                                <div class="card-header min-h-50px">
                                    <h3 class="card-title">
                                        Order Commission
                                    </h3>
                                </div>
                                <div class="card-body p-3">
                                    <div class="card-scroll"
                                        style="max-height: 200px; overflow-x:hidden; overflow-y:auto; ">
                                        <div id="kt_repeater_3">
                                            <div class="form-group row mb-0">
                                                <div data-repeater-list="" class="col-lg-12">
                                                    <div data-repeater-item
                                                        class="form-group row align-items-center mb-2 commission-repeater-item">
                                                        <div class="col-md-4 col-4 pr-2">
                                                            <label>Title</label>
                                                            <select name="" class="form-control select2 commission-title"
                                                                id="">
                                                                <option value=""></option>
                                                                @foreach ($commissions as $commission)
                                                                    <option value="{{ $commission->id }}">
                                                                        {{ $commission->commission_title }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 col-4 px-0">
                                                            <label>Value</label>
                                                            <div class="input-group my-group">
                                                                <input type="text" name=""
                                                                    class="form-control p-2 text-left currency commission-value"
                                                                    style="height: 30px" placeholder="Amount" />
                                                                <select class="form-control p-2 col-5 commission-type"
                                                                    style="height: 30px">
                                                                    <option value="%">%</option>
                                                                    <option value="PKR">PKR</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-4 pl-2">
                                                            <a href="javascript:;" data-toggle="collapse"
                                                                style="height: 30px; width:30px"
                                                                data-target="#commission-collapse1" aria-expanded="false"
                                                                aria-controls="collapseExample"
                                                                class="btn font-weight-bold btn-light-success btn-icon mt-8 commission-collapse-btn">
                                                                <i class="la la-angle-down"></i>
                                                            </a>
                                                            <a href="javascript:;" data-repeater-delete=""
                                                                style="height: 30px; width:30px"
                                                                class="btn font-weight-bold btn-light-danger btn-icon mt-8">
                                                                <i class="la la-remove"></i>
                                                            </a>
                                                        </div>
                                                        <div class="collapse commission-collapse col-md-8 mt-2 pr-0"
                                                            id="commission-collapse1">
                                                            <textarea class="form-control" id=""
                                                                placeholder="Description" rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <div class="col-lg-6">
                                                    <a href="javascript:;" data-repeater-create=""
                                                        class="btn btn-sm font-weight-bolder btn-light-primary">
                                                        <i class="la la-plus"></i>Add
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between py-2">
                                    <span class="font-weight-bold font-size-lg">Total Commission</span>
                                    <input type="hidden" id="total-commission-value">
                                    <span class="font-weight-bold font-size-lg">PKR <span
                                            id="total-commission-label">0.00</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Teachers-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection


{{-- Scripts Section --}}

@section('scripts')
    <script>
        var ADD_PARTY_URL = "{{ route('parties.add-party') }}";
        var GET_PARTY_URL = "{{ url('get-party') }}";
        var GET_TAX_URL = "{{ url('get-tax') }}";
        var GET_DISCOUNT_URL = "{{ url('get-discount') }}";
        var GET_COMISSION_URL = "{{ url('get-commission') }}";
    </script>
    <script src="{{ asset('js/airlines/order_calculations.js') }}"></script>
    <script src="{{ asset('js/airlines/order.js') }}"></script>
@endsection
