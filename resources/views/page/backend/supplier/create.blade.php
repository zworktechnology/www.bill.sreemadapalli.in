<div class="modal-dialog modal-l">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Supplier</h5>
        </div>
        <div class="modal-body">
            <form autocomplete="off" method="POST" action="{{ route('supplier.store') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Name <span style="color: red;">*</span></label>
                            <input type="text" name="name" placeholder="Enter Supplier name" required>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Phone Number<span style="color: red;">*</span></label>
                            <div class="supplier_phnodiv row">
                                <div class="col-lg-10">
                                    <input type="text" name="phone_number" class="supplier_contactno" onkeyup="suppliercheck(); return false;"  placeholder="Enter Phone Number" required>
                                </div>
                                <div class="col-lg-2">
                                    <button style="width: 35px;"class="py-1 text-white font-medium rounded-lg text-sm  text-center btn btn-primary addsupplierphno"
                                                    type="button" id="" value="Add">+</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="address" placeholder="Enter Address">
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Old Balance</label>
                            <input type="text" name="old_balance" placeholder="Enter Old Balance Amount">
                        </div>
                    </div>
                    <hr>
                    <div class="col-lg-12 button-align">
                        <button type="submit" class="btn btn-submit me-2">Save</button>
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
