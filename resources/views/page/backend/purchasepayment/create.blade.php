<form autocomplete="off" method="POST" action="{{ route('purchasepayment.store') }}">
    @csrf
       <div class="card">
          <div class="card-body">
             <div class="form-group-item">

                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Supplier <span style="color: red;">*</span></label>
                              <select class="form-control  select js-example-basic-single purchasepaymentsupplier" name="supplier_id" id="supplier_id" required>
                                    <option value="" disabled selected hiddden>Select Supplier</option>
                                    @foreach ($Supplier as $Suppliers)
                                        <option value="{{ $Suppliers->id }}">{{ $Suppliers->name }}</option>
                                    @endforeach 
                                </select>
                        </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                           <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Date<span
                                        style="color: red;">*</span></label>
                                <input type="date" name="date" placeholder="" value="{{ $today }}" required>
                            </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Old Balance</label>
                            <input type="text" class="purchaseoldbalance" name="purchaseoldbalance" id="purchaseoldbalance" placeholder="" readonly style="background: #DCDCDC">
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Payable Amount <span style="color: red;">*</span></label>
                            <input type="text" name="paid_amount" id="paid_amount" class="purchase_paid_amount" placeholder="Enter Payable Amount" required>
                         </div>
                      </div>
                   </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label>Payment Method</label>
                            <select class="select bank_id" name="bank_id" id="bank_id" required>
                                    @foreach ($bank as $banks)
                                       <option value="{{ $banks->id }}">{{ $banks->name }}</option>
                                    @endforeach
                                 </select>
                        </div>
                    </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label> Balance</label>
                            <input type="text" name="purchasebalance" id="purchase_balance" class="purchasebal" placeholder="" readonly>
                         </div>
                      </div>
                   </div>
                   <div class="col-lg-12 button-align">
                        <button type="submit" class="btn btn-submit">Save</button>
                    </div>
             </div>
          </div>
       </div>
    </form>