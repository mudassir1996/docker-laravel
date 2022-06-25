 <div class="card card-custom mb-3" id="commission" style="display: none; background: #f9f9f9">
     <div class="card-header align-items-center min-h-50px">
         <h3 class="card-title">
             Order Commission
         </h3>
         <div>
             <button type="button" data-toggle="modal" data-target="#commissionModal" class="btn btn-primary btn-sm">
                 Add New
             </button>
             <button id="remove-commission" type="button" style="height: 30px; width:30px; display: none;"
                 class="btn btn-danger btn font-weight-bold btn-light-danger btn-icon">
                 <i class="la la-remove"></i>
             </button>
         </div>
     </div>
     <div class="card-body p-3">
         <div class="card-scroll" style="max-height: 200px; overflow-x:hidden; overflow-y:auto; ">
             <div id="commission_repeater">
                 <div class="form-group row mb-0">
                     <div data-repeater-list="" class="col-lg-12">
                         <div data-repeater-item
                             class="form-group row align-items-center mb-2 commission-repeater-item">
                             <div class="col-md-4 col-4 pr-2">
                                 <label class="commission-label">Commisson 1</label>
                                 <select name="" class="form-control select2 commission-title" data-tags="false" id="">
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
                                     <select class="form-control p-2 col-5 commission-type" style="height: 30px">
                                         <option value="PKR">PKR</option>
                                         <option value="%">%</option>
                                     </select>
                                 </div>
                             </div>
                             <div class="col-md-4 col-4 pl-2">
                                 <a href="javascript:;" data-toggle="collapse" style="height: 30px; width:30px"
                                     data-target="#commission-collapse1" aria-expanded="false"
                                     aria-controls="collapseExample"
                                     class="btn font-weight-bold btn-light-success btn-icon mt-8 commission-collapse-btn">
                                     <i class="la la-angle-down"></i>
                                 </a>
                                 <a href="javascript:;" data-repeater-delete="" style="height: 30px; width:30px"
                                     class="btn font-weight-bold btn-light-danger btn-icon mt-8">
                                     <i class="la la-remove"></i>
                                 </a>
                             </div>
                             <div class="collapse commission-collapse col-md-8 mt-2 pr-0" id="commission-collapse1">
                                 <textarea class="form-control commission-description" id="" placeholder="Description"
                                     rows="2"></textarea>
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
         <span class="font-weight-bold font-size-lg">PKR <span id="total-commission-label">0.00</span></span>
     </div>
 </div>
