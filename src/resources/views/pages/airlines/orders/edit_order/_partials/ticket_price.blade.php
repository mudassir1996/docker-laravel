<div class="card mb-3">
    <div class="card-body py-4 px-2">
        <div class="card-scroll px-2" style="max-height:70vh; overflow-x:hidden; overflow-y:auto;">
            <!--begin::Repeater-->
            <div id="kt_docs_repeater_nested">
                @foreach ($airline_order->airline_tickets as $airline_ticket)
                    <!--begin::Form group-->
                    <div class="">
                        <div data-repeater-list="ticket_details" id="ticket-details">
                            <div data-repeater-item="ticket-list"
                                class="card card-custom mb-3 ticket-repeater-item border border-secondary">
                                <div class="card-header px-2 min-h-50px" style="background: #f9f9f9">
                                    <h2 class="card-title ticket-title">
                                        Ticket {{ $loop->iteration }}
                                    </h2>
                                </div>
                                <div class="card-body p-2" style="background: #f9f9f9">
                                    <div class="form-group row">
                                        <div class="col-xl-9">
                                            <label for="">Base Price</label>
                                            <p class="font-weight-bolder  m-0">
                                                {{ $airline_ticket->base_price }}</p>
                                            {{-- <input type="text" name="base_price" id="" style="height:30px"
                                                class="form-control p-2 currency text-left base-price"
                                                placeholder="Base price" value="{{ $airline_ticket->base_price }}"
                                                autocomplete="no"> --}}
                                        </div>
                                    </div>
                                    <div class="inner-repeater">
                                        <div data-repeater-list="ticket_taxes" class="">
                                            @foreach ($airline_ticket->ticket_tax_details as $ticket_tax)
                                                <div data-repeater-item="tax-list"
                                                    class="row align-items-center mb-2 tax-repeater-item">
                                                    <div class="col-md-3 col-3 pr-2">
                                                        <label class="tax-label">Tax 1</label>
                                                        <p class="font-weight-bolder  m-0">
                                                            {{ $ticket_tax->title }}</p>
                                                    </div>
                                                    <div class="col-md-3 col-3 px-0">
                                                        <label>Value</label>
                                                        <p class="font-weight-bolder  m-0">
                                                            {{ $ticket_tax->value }}</p>
                                                    </div>
                                                    <div class="col-md-3 col-3 px-0">
                                                        <label>Percentage</label>
                                                        <p class="font-weight-bolder  m-0">
                                                            {{ $ticket_tax->percentage }}%</p>
                                                    </div>
                                                    @if ($ticket_tax->description != '')
                                                        <div class="col-md-3 col-3 pl-2">
                                                            <a href="javascript:;" data-toggle="collapse"
                                                                style="height: 30px; width:30px"
                                                                data-target="#tax1-collapse1" aria-expanded="false"
                                                                aria-controls="collapseExample"
                                                                class="btn font-weight-bold btn-light-success btn-icon mt-8 tax-collapse-btn">
                                                                <i class="la la-angle-down"></i>
                                                            </a>
                                                        </div>
                                                        <div class="collapse tax-collapse col-md-8 mt-2 pr-0"
                                                            id="tax1-collapse1">
                                                            <p class="font-size-lg m-0">
                                                                {{ $ticket_tax->description }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>

                                        <div style="display:flex" class="mb-3 row airline-discount-field">
                                            <div class="col-xl-6 mt-3 pr-2">
                                                <label for=""> Agent/Airline Discount </label>
                                                <p class="font-weight-bolder  m-0">
                                                    {{ $airline_ticket->airline_discount_value }}</p>
                                            </div>
                                        </div>
                                        <div style="display:flex" class="mb-3 row airline-discount-field">
                                            <div class="col-xl-6 mt-3 pr-2">
                                                <label for=""> Ticket Value</label>
                                                <p class="font-weight-bolder  m-0">
                                                    {{ $airline_ticket->total_ticket_value }}</p>
                                            </div>
                                            <div class="col-xl-6 mt-3 pr-2">
                                                <label for=""> Service Charges</label>
                                                <p class="font-weight-bolder  m-0">
                                                    {{ $airline_ticket->service_charges_value / count($airline_order->airline_tickets) }}
                                                </p>
                                            </div>
                                        </div>
                                        {{-- <div class="row mb-2">
                                            <div class="col-6">
                                                <label for="">Ticket Value</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend" style="height: 30px">
                                                        <span class="input-group-text">PKR</span>
                                                    </div>
                                                    <input type="text"
                                                        class="form-control text-left currency ticket-value p-2"
                                                        name="charges" style="height: 30px"
                                                        value="{{ $airline_ticket->total_ticket_value }}"
                                                        placeholder="Amount" autocomplete="no">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 mt-3 pl-0">
                                                <p class="text-muted mb-0 mt-7 font-size-sm ticket-value-difference">
                                                </p>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="row">
                                            <div class="col-xl-6">
                                                <label for="">Service Changes</label>
                                                <div class="input-group my-group">
                                                    <input type="text"
                                                        class="form-control text-left currency service-charges p-2 col-8"
                                                        name="charges" style="height: 30px"
                                                        value="{{ $airline_ticket->service_charges_value }}"
                                                        placeholder="Amount" autocomplete="no">
                                                    <select class="form-control p-2 col-4 service-charges-type"
                                                        maxlength="3" style="height: 30px">
                                                        <option value="PKR">PKR</option>
                                                        <option value="%">%</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 mt-3 pl-0">
                                                <p class="text-muted mb-0 mt-4 font-size-sm">
                                                    Value:
                                                    <span class="service-charges-value">
                                                        {{ $airline_ticket->service_charges_value ?? '0.00' }}
                                                    </span>
                                                </p>
                                                <p class="text-muted mb-0 font-size-sm">
                                                    Total Income:
                                                    <span class="ticket-income">
                                                        {{ $airline_ticket->service_charges_value + $airline_ticket->airline_discount_value }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div> --}}
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <a href="javascript:;" data-ticket-id="1" data-repeater-delete
                                            class="btn btn-sm btn-light-danger mt-3 mt-md-9 d-none remove-tax-detail">
                                            <i class="la la-trash-o fs-3"></i>Delete Row
                                        </a>
                                    </div> --}}
                                </div>
                                <div class="card-footer d-flex align-items-center px-2 justify-content-between py-2"
                                    style="background: #f9f9f9">
                                    <span class="font-weight-bold font-size-lg ">Total</span>
                                    <div class="font-size-lg font-weight-bold text-center">
                                        <span>PKR</span>
                                        <span>
                                            {{ $airline_ticket->total_amount }}
                                        </span>
                                        {{-- <div class="input-group">
                                            <div class="input-group-prepend " style="height: 30px">
                                                <span class="input-group-text">PKR</span>
                                            </div>

                                            <input type="text"
                                                class="form-control currency text-left total-ticket-value p-2"
                                                style="height: 30px" value="{{ $airline_ticket->total_amount }}">
                                        </div>
                                        <span class="text-muted difference"></span> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Form group-->
                @endforeach
                <!--begin::Form group-->
                {{-- <div class="form-group mb-0">
                    <a href="javascript:;" data-repeater-create class="btn btn-light-primary d-none add-tax-detail">
                        <i class="la la-plus"></i>Add Row
                    </a>
                </div> --}}
                <!--end::Form group-->
            </div>
            <!--end::Repeater-->
        </div>
    </div>
</div>
