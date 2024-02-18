<div class="modal-dialog modal-l">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Update</h5>
        </div>
        <div class="modal-body">
            <form autocomplete="off" method="POST" action="{{ route('salespayment.edit', ['unique_key' => $salepayment_datas['unique_key']]) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Customer <span style="color: red;">*</span></label>
                              <select class="form-control  select salespaymentcustomer_id" name="customer_id" id="customer_id" required>
                                    <option value="" disabled selected hiddden>Select Customer</option>
                                    @foreach ($Customer as $Customers)
                                        <option value="{{ $Customers->id }}"@if ($Customers->id === $salepayment_datas['customer_id']) selected='selected' @endif>{{ $Customers->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Date <span style="color: red;">*</span></label>
                            <input type="date" name="date" placeholder="" value="{{ $salepayment_datas['saledate'] }}" required>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Payable Amount</label>
                            <input type="text" name="paid_amount" id="paid_amount" class="salepaymentpaidamt" value="{{ $salepayment_datas['paid_amount'] }}" placeholder="Enter Payable Amount">
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label>Note</label>
                            <input type="text" name="salespayment_note" id="salespayment_note" class="salespayment_note" value="{{ $salepayment_datas['salespayment_note'] }}" placeholder="Enter Note">
                        </div>
                    </div>
                    <div class="col-lg-12 button-align">
                        <button type="submit" class="btn btn-submit me-2">Update</button>
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
