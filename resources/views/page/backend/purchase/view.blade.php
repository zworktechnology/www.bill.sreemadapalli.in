<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="purchaseorderviewLargeModalLabel{{ $datas['unique_key'] }}">Purchase Details</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

            <div class="card">

       
            
                           <div class="invoice-item invoice-item-date card py-2 " style="background: #751818;">
                              <div class="row ">
                                 <div class="col-md-2">
                                    <p class="text-start invoice-details" style="color:white;margin-left: 10px;">
                                    Bill No<span>: </span><strong style="color:white;"># {{ $datas['bill_no'] }}</strong>
                                    </p>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="text-start invoice-details" style="color:white;">
                                       Voucher Number<span>: </span><strong style="color:white;"># {{ $datas['voucher_no'] }}</strong>
                                    </p>
                                 </div>
                                 <div class="col-md-2">
                                    <p class="invoice-details" style="color:white;">
                                       Supplier<span>: </span><strong style="color:white;text-transform: uppercase;">{{ $datas['supplier_name'] }}</strong>
                                    </p>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="text-start invoice-details" style="color:white;">
                                       Date<span>: </span><strong style="color:white;">{{ date('d-m-Y', strtotime($datas['date'])) }}</strong>
                                    </p>
                                 </div>
                                 <div class="col-md-2">
                                    <p class="text-start invoice-details" style="color:white;">
                                       Bank<span>: </span><strong style="color:white;">{{ $datas['payment_method'] }}</strong>
                                    </p>
                                 </div>
                              </div>
                           </div>




               <div class="row">
                  <div class="col-lg-6 ">
                     <div class="total-order w-100 max-widthauto mb-4">
                        <ul>
                           <li class="total">
                              <h4>Grand Total</h4>
                              <h5>₹ <span  class="">{{ $datas['grandtotal'] }}</span></h5>
                           </li>
                           <li class="total">
                              <h4>Paid Amount</h4>
                              <h5 style="color:green">₹ <span  class="">{{ $datas['paidamount'] }}</span></h5>
                           </li>
                           <li class="total">
                              <h4>Balance Amount</h4>
                              <h5 style="color:red">₹ <span  class="">{{ $datas['balanceamount'] }}</span></h5>
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


