<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="purchaseorderviewLargeModalLabel{{ $datas['unique_key'] }}">Purchase Details :
                <span style="color: red"># {{ $datas['bill_no'] }}</span>
            </h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="invoice-item invoice-item-date card py-2 ">
                <div class="row ">
                    <div class="col-lg-6 ">
                        <div class="details-item">
                            <h6>Supplier Info</h6>
                            <p>{{ $datas['supplier_name'] }}<br>
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 ">
                        <div class="details-item">
                            <h6>Voucher Number</h6>
                            <p>{{ $datas['voucher_no'] }}<br>
                                {{ date('d-m-Y', strtotime($datas['date'])) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="col-lg-6 ">
                    <div class="total-order w-100 max-widthauto mb-4">
                        <ul>
                            <li class="total">
                                <h4>Grand Total</h4>
                                <h5>₹ <span class="">{{ $datas['grandtotal'] }}</span></h5>
                            </li>
                            <li class="total">
                                <h4>Paid Amount</h4>
                                <h5 style="color:green">₹ <span class="">{{ $datas['paidamount'] }}</span>
                                </h5>
                            </li>
                            <li class="total">
                                <h4>Balance Amount</h4>
                                <h5 style="color:red">₹ <span class="">{{ $datas['balanceamount'] }}</span>
                                </h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
