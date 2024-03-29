@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Add Purchase</h4>
            </div>
        </div>



        <div class="card">
            <div class="card-body">
                <form autocomplete="off" method="POST" action="{{ route('purchase.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-2 col-sm-2 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Bill No<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="bill_no" placeholder="Enter Bill No" value="{{ $billno }}"
                                    readonly style="background: #DCDCDC">
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Date<span
                                        style="color: red;">*</span></label>
                                <input type="date" name="date" placeholder="" value="{{ $today }}" required style="background: #DCDCDC">
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-2 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Time<span
                                        style="color: red;">*</span></label>
                                <input type="time" name="time" placeholder="" value="{{ $timenow }}" required style="background: #DCDCDC">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Voucher No<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="voucher_no" placeholder="Enter Voucher No" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Supplier<span
                                        style="color: red;">*</span> </label>
                                <select class="form-control js-example-basic-single select purchasepaymentsupplier" name="supplier_id"
                                    id="supplier_id" required>
                                    <option value="" disabled selected hiddden>Select Supplier</option>
                                    @foreach ($Supplier as $suppliers)
                                        <option value="{{ $suppliers->id }}">{{ $suppliers->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Old Balance<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="purchaseoldbalance" class="purchaseoldbalance" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Total Amount<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="purchasetotal_amount" class="purchasetotal_amount"
                                    placeholder="Enter Total Amount">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Grand Total<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="purchasegrandtotal" class="purchasegrandtotal" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Payable Amount<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="purchasepaidamount" class="purchasepaidamount"
                                    placeholder="Enter Payable Amount" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Balance Amount<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="purchasebalanceamount" class="purchasebalanceamount" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Payment Method<span
                                        style="color: red;">*</span></label>
                                <select class="form-control js-example-basic-single select payment_method" name="payment_method" id="payment_method" required>
                                    <option value="" disabled selected hiddden>Select Payment Method</option>
                                    @foreach ($bank as $banks)
                                        <option value="{{ $banks->id }}">{{ $banks->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" />
                        <a href="{{ route('purchase.index') }}" class="btn btn-danger" value="">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
