<div class="modal-dialog modal-l">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Update</h5>
        </div>
        <div class="modal-body">
            <form autocomplete="off" method="POST" action="{{ route('purchasepayment.edit', ['unique_key' => $purchasepayment_datas['unique_key']]) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Supplier <span style="color: red;">*</span></label>
                              <select class="form-control  select purchasepaymentsupplier" name="supplier_id" id="supplier_id" required>
                                    <option value="" disabled selected hiddden>Select Supplier</option>
                                    @foreach ($Supplier as $Suppliers)
                                        <option value="{{ $Suppliers->id }}"@if ($Suppliers->id === $purchasepayment_datas['supplier_id']) selected='selected' @endif>{{ $Suppliers->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Date <span style="color: red;">*</span></label>
                            <input type="date" name="date" placeholder="" value="{{ $purchasepayment_datas['purchasedate'] }}" required>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Payable Amount <span style="color: red;">*</span></label>
                            <input type="text" name="paid_amount" id="paid_amount" class="purcahsepaymentpaidamt" value="{{ $purchasepayment_datas['paid_amount'] }}" placeholder="Enter Payable Amount">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Payment Method</label>
                            <select class="form-control select bank_id" name="bank_id" id="bank_id" required>
                            <option value="" disabled selected hiddden>Select</option>
                                    @foreach ($bank as $banks)
                                       <option value="{{ $banks->id }}"@if ($banks->id === $purchasepayment_datas['bank_id']) selected='selected' @endif>{{ $banks->name }}</option>
                                    @endforeach
                                 </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Note</label>
                            <input type="text" name="purchasepayment_note" id="purchasepayment_note" class="purchasepayment_note" value="{{ $purchasepayment_datas['purchasepayment_note'] }}" placeholder="Enter Note">
                        </div>
                    </div>
                    <hr>
                    <div class="col-lg-12 button-align">
                        <button type="submit" class="btn btn-warning me-2">Update</button>
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
