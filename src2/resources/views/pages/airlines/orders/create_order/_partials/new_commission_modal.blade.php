<div class="modal fade" id="commissionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="add_commission_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Commission</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row mb-2">
                        <div class="col-xl-6 pr-0">
                            <label>Commission Title *</label>
                            <input autocomplete="off" style="height: 30px" type="text" name="commission_title"
                                id="commission_title" class="form-control p-2" placeholder="Commission Title" />

                        </div>
                        <div class="col-xl-6">
                            <label>Commission Value *</label>
                            <input autocomplete="off" style="height: 30px" type="text" name="commission_value"
                                id="commission_value" class="form-control p-2" value="{{ old('commission_value') }}"
                                placeholder="Commission Value" />

                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <div class="col-xl-4 pr-0">
                            <label>Commission Type *</label>
                            <select class="form-control selectpicker" id="commission_type" name="commission_type">
                                <option value="percentage"
                                    {{ old('commission_type') == 'percentage' ? 'selected' : '' }}>
                                    Percentage
                                </option>
                                <option value="value" {{ old('commission_type') == 'value' ? 'selected' : '' }}>
                                    Value
                                </option>
                            </select>

                        </div>
                        <div class="col-xl-4 px-2">
                            <label>Party *</label>
                            <select class="form-control selectpicker" title="Select Party" data-live-search="true"
                                data-size="5" id="party_id" name="party_id">
                                @foreach ($parties as $party)
                                    <option value="{{ $party->id }}"
                                        {{ old('party_id') == $party->id ? 'selected' : '' }}>
                                        {{ $party->party_title }}
                                    </option>
                                @endforeach

                            </select>

                        </div>
                        <div class="col-xl-4 pl-0">
                            <label>Status *</label>
                            <select class="form-control selectpicker" id="commission_status" name="commission_status">
                                <option value="active" {{ old('commission_status') == 'active' ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="inactive"
                                    {{ old('commission_status') == 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>

                        </div>
                    </div>


                    <div class="form-group mb-2">
                        <label for="exampleTextarea">Description</label>
                        <textarea class="form-control" id="commission_description" name="commission_description"
                            rows="5">{{ old('commission_description') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-light-primary font-weight-bold"
                        id="commissionModalClose">Close</button>
                    <button type="button" id="btn-submit" class="btn btn-primary font-weight-bold">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
