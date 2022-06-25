<div class="card card-custom mb-3" style="background: #f9f9f9">

    <div class="card-body py-4" id="">
        <div id="ticket_repeater">
            @foreach ($airline_order->airline_tickets as $airline_ticket)
                <div class="row mb-0">
                    <div data-repeater-list="" class="col-lg-12">
                        <div data-repeater-item class="row {{ !$loop->last ? 'border-bottom' : '' }} main-ticket-item">
                            <div class="text-left col-xl-6 my-2">
                                <p class="text-muted main-ticket-title">
                                    Ticket {{ $loop->iteration }}
                                </p>
                            </div>
                            <div class="col-xl-8">
                                <div class="form-group row mb-3">
                                    <div class="col-xl-3 pr-0 mb-3">
                                        <label for="">Pax Title</label>
                                        <p class="font-weight-bolder">
                                            {{ ucfirst($airline_ticket->pax_title) }}
                                        </p>

                                    </div>
                                    <div class="col-xl-6 pr-0">
                                        <label for="">Pax Name</label>
                                        <p class="font-weight-bolder">
                                            {{ ucfirst($airline_ticket->pax_name) }}
                                        </p>
                                    </div>
                                    <div class="col-xl-2 pr-0">
                                        <label for="">Class</label>
                                        <p class="font-weight-bolder">
                                            {{ ucfirst($airline_ticket->ticket_class) }}
                                        </p>
                                    </div>
                                    <div class="col-xl-3 mb-3 pr-0">
                                        <label for="">Flight</label>
                                        <p class="font-weight-bolder">
                                            {{ ucfirst($airline_ticket->flight_type) }}
                                        </p>
                                    </div>
                                    <div class="col-xl-3 mb-3  pr-0">
                                        <label for="">Ticket #</label>
                                        <p class="font-weight-bolder">
                                            {{ ucfirst($airline_ticket->ticket_number) }}
                                        </p>
                                    </div>
                                    <div class="col-xl-3 pr-0">
                                        <label for="">Flight #</label>
                                        <p class="font-weight-bolder">
                                            {{ ucfirst($airline_ticket->flight_number) }}
                                        </p>
                                    </div>
                                    <div class="col-xl-3 pr-0">
                                        <label for="">Departure Date</label>
                                        <p class="font-weight-bolder">
                                            {{ date('d-m-Y', strtotime($airline_ticket->departure_date)) }}
                                        </p>
                                    </div>

                                    <div class="col-xl-3 pr-0">
                                        <label for="">Sector</label>
                                        <p class="font-weight-bolder">
                                            {{ ucfirst($airline_ticket->sector) }}
                                        </p>
                                    </div>
                                    <div class="col-xl-3 pr-0">
                                        <label for="">Route</label>
                                        <p class="font-weight-bolder">
                                            {{ ucfirst($airline_ticket->route) }}
                                        </p>
                                    </div>
                                    <div class="col-xl-3 pr-0">
                                        <label for="">PNR #</label>
                                        <p class="font-weight-bolder">
                                            {{ ucfirst($airline_ticket->pnr) }}
                                        </p>
                                    </div>
                                    <div class="col-xl-3 pr-0">
                                        <label for="">GDS PNR #</label>
                                        <p class="font-weight-bolder">
                                            {{ ucfirst($airline_ticket->gds_pnr) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="">Remarks</label>
                                        <p class="font-weight-bolder">
                                            {{ ucfirst($airline_ticket->remarks ?? '-') }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>


    </div>
</div>
