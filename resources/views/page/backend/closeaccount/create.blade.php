<form autocomplete="off" method="POST" action="{{ route('closeaccount.store') }}">
    @csrf
       <div class="card">
          <div class="card-body">
             <div class="form-group-item">

                   
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
                            <label>Sales</label>
                            <input type="text" class="sales" name="sales" id="sales" required value="{{$saletotalamount}}" readonly>
                         </div>
                      </div>
                   </div>

                 
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Cash</label>
                            <input type="text" class="cash" name="cash" id="cash" required value="0" placeholder=" Cash">
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Card</label>
                            <input type="text" class="card" name="card" id="card" required value="0" placeholder="Card">
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>PAY TM BUSINESS</label>
                            <input type="text" class="paytm_business" name="paytm_business" id="paytm_business" required value="0" placeholder="Enter Your ">
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>PAY TM</label>
                            <input type="text" class="paytm" name="paytm" id="paytm" required value="0" placeholder="Paytm">
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>PHONE PE BUISNESS</label>
                            <input type="text" class="phonepe_business" name="phonepe_business" id="phonepe_business" required value="0" placeholder="Enter Your ">
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>PHONEPE</label>
                            <input type="text" class="phonepe" name="phonepe" id="phonepe" required value="0" placeholder="Phone Pay " >
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>GPAY BUISNESS</label>
                            <input type="text" class="gpay_business" name="gpay_business" id="gpay_business" required value="0" placeholder="Enter Your ">
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>GPAY</label>
                            <input type="text" class="gpay" name="gpay" id="gpay" required value="0" placeholder="Enter gpay ">
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