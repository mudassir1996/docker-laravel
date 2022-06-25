<div class="card card-custom mb-3" style="background: #f9f9f9">
    <div class="card-body py-4">
        <div class="form-group row mb-2">
            <div class="col-xl-3 pr-0 mb-2">
                <label for="">Invoice Date</label>
                <p class=" font-weight-bolder font-size-h6">
                    <i class="fas fa-calendar text-dark text-hover-primary invoice_date_picker mr-1" role="button"></i>
                    <span class="invoice_date_picker_date">

                        {{ date('d-m-Y', time()) }}
                    </span>

                </p>

                <input type="hidden" name="invoice_date" id="invoice_date" value="{{ date('d-m-Y', time()) }}">
            </div>
            <div class="col-xl-3 pr-0">
                <label for="">Invoice Category</label>
                <select name="category_id" class="form-control selectpicker" id="category_id" data-live-search="true"
                    title="Select Category" data-size="5" id="">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->category_title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xl-3 pr-0">
                <label for="">Receipt No.</label>
                <input type="text" name="" id="" disabled style="height:30px" class="form-control p-2"
                    placeholder="Receipt No">
            </div>
            <div class="col-xl-3 pr-0">
                <label for="">Status</label>
                <select name="status" id="status" class="form-control selectpicker">
                    <option value="issued">Issued</option>
                    <option value="refunded">Refunded</option>
                </select>
            </div>

            <div class="col-xl-4 pr-0">
                <label for="client">Client</label>
                <div class="input-group">
                    <select class="form-control selectpicker customer_party_id" data-size="5" name="customer_party_id"
                        id="client" data-live-search="true">
                        <option value="">Choose Client</option>
                        @foreach ($parties as $party)
                            <option value="{{ $party->id }}">{{ $party->party_title }}
                            </option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#add-client"
                            style="padding: 0.3rem 0.6rem" type="button">
                            <i class="flaticon2-plus-1"></i>
                        </button>
                    </div>

                    {{-- Add Client Modal --}}
                    <div class="modal" id="add-client" tabindex="-1" role="dialog" aria-labelledby="add-client"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add
                                        Client</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <label for="">Title *</label>
                                            <input type="text" class="form-control p-2" style="height:30px"
                                                autocomplete="no" name="client_title" id="" placeholder="Title">
                                        </div>
                                        <div class="col-xl-6">
                                            <label for="">Phone</label>
                                            <input type="text" class="form-control p-2" style="height:30px"
                                                name="client_phone" id="" autocomplete="no" placeholder="Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary font-weight-bold"
                                        data-dismiss="modal">Close</button>
                                    <button type="button" id="save-client" class="btn btn-primary font-weight-bold">Save
                                        Client</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 pr-0">
                <label for="agent">Agent/Airline</label>
                <div class="input-group">
                    <select class="form-control selectpicker supplier_party_id" data-size="5" id="agent"
                        data-live-search="true" name="supplier_party_id">
                        <option value="">Choose Agent/Airline</option>
                        @foreach ($parties as $party)
                            <option value="{{ $party->id }}">{{ $party->party_title }}
                            </option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#add-agent"
                            style="padding: 0.3rem 0.6rem" type="button">
                            <i class="flaticon2-plus-1"></i>
                        </button>
                    </div>
                    {{-- Add Agent Modal --}}
                    <div class="modal" id="add-agent" tabindex="-1" role="dialog" aria-labelledby="add-agent"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add
                                        Agent/Airline</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <div class="col-xl-6">
                                            <label for="">Title *</label>
                                            <input type="text" class="form-control p-2" style="height:30px"
                                                autocomplete="no" name="agent_title" id="" placeholder="Title">
                                        </div>
                                        <div class="col-xl-6">
                                            <label for="">Phone</label>
                                            <input type="text" class="form-control p-2" style="height:30px"
                                                name="agent_phone" id="" autocomplete="no" placeholder="Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary font-weight-bold"
                                        data-dismiss="modal">Close</button>
                                    <button type="button" id="save-agent" class="btn btn-primary font-weight-bold">Save
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
