<div class="card card-custom mb-3" style="background: #f9f9f9">

    <div class="card-body py-4" id="">
        <div id="ticket_repeater">
            <div class="row mb-0">
                <div data-repeater-list="" class="col-lg-12">
                    <div data-repeater-item class="row border-bottom main-ticket-item">
                        <div class="text-left col-xl-6 my-2">
                            <p class="text-muted main-ticket-title">
                                Ticket 1
                            </p>
                        </div>
                        <div class="col-xl-6 my-2 text-right">
                            <a href="javascript:;" data-repeater-delete="" style="height: 30px; width:30px"
                                class="btn font-weight-bold btn-light-danger btn-icon remove-btn justify-self-end">
                                <i class="la la-remove"></i>
                            </a>
                        </div>
                        <div class="col-xl-8">
                            <div class="form-group row mb-3">
                                <div class="col-xl-3 pr-0 mb-3">
                                    <label for="">Pax Title</label>
                                    <select name="pax_title" style="height:30px" class="form-control pax-title p-0"
                                        id="">
                                        <option value="adult">Adult</option>
                                        <option value="child">Child</option>
                                        <option value="infant">Infant</option>
                                    </select>
                                </div>
                                <div class="col-xl-7 pr-0">
                                    <label for="">Pax Name</label>
                                    <input type="text" name="pax_name" id="" style="height:30px"
                                        class="form-control p-2 pax-name" placeholder="Pax Name">
                                </div>
                                <div class="col-xl-2 pr-0">
                                    <label for="">Class</label>
                                    <input type="text" name="class" id="" style="height:30px"
                                        class="form-control p-2 class" placeholder="Class">
                                </div>
                                <div class="col-xl-3 mb-3 pr-0">
                                    <label for="">Flight</label>
                                    <select class="form-control flight p-0" style="height:30px" id="">
                                        <option value="domestic">Domestic</option>
                                        <option value="international">International</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 mb-3  pr-0">
                                    <label for="">Ticket #</label>
                                    <input type="text" name="ticket_number" id="" style="height:30px"
                                        class="form-control p-2 ticket-number" placeholder="Ticket #">
                                </div>
                                <div class="col-xl-3 pr-0">
                                    <label for="">Flight #</label>
                                    <input type="text" name="flight_number" id="" style="height:30px"
                                        class="form-control p-2 flight-number" placeholder="Flight #">
                                </div>
                                <div class="col-xl-3 pr-0">
                                    <label for="">Departure Date</label>
                                    <input type="text" style="height:30px" autocomplete="off" name="departure_date"
                                        class="form-control p-2 departure-date kt_datepicker_3"
                                        placeholder="dd-mm-yyyy">
                                </div>

                                <div class="col-xl-3 pr-0">
                                    <label for="">Sector</label>
                                    <input type="text" name="sector" id="" style="height:30px"
                                        class="form-control p-2 sector" placeholder="Sector">
                                </div>
                                <div class="col-xl-3 pr-0">
                                    <label for="">Route</label>
                                    <select name="" class="form-control route p-0" style="height:30px" id="">
                                        <option value="one-way">One Way</option>
                                        <option value="return">Return</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 pr-0">
                                    <label for="">PNR #</label>
                                    <input type="text" name="pnr" id="" style="height:30px" class="form-control p-2 pnr"
                                        placeholder="PNR #">
                                </div>
                                <div class="col-xl-3 pr-0">
                                    <label for="">GDS PNR #</label>
                                    <input type="text" name="gds_pnr" id="" style="height:30px"
                                        class="form-control p-2 gds-pnr" placeholder="GDS PNR #">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="col-12">
                                <div class="form-group mb-3">
                                    <label for="">Remarks</label>
                                    <textarea class="form-control p-2 remarks" rows="4" placeholder="Remarks"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-right mt-2">
                <a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary"
                    id="ticket-add">
                    <i class="la la-plus"></i>Add Ticket
                </a>
            </div>

        </div>


    </div>
</div>
