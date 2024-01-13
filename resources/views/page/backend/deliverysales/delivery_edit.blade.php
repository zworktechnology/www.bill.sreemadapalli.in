<div class="modal-dialog modal-l">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Update</h5>
        </div>
        <div class="modal-body">
            <form autocomplete="off" method="POST" action="{{ route('deliverysales.delivery_edit', ['unique_key' => $Sale_Delivery_Datas['unique_key']]) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-6 col-12">
                           <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Date<span
                                        style="color: red;">*</span></label>
                                <input type="date" name="date" placeholder="" value="{{ $Sale_Delivery_Datas['saledate'] }}" required>
                            </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-12">
                           <div class="form-group">
                                 <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Time<span
                                        style="color: red;">*</span></label>
                                <input type="time" name="time" placeholder="" value="{{ $Sale_Delivery_Datas['time'] }}" required>
                            </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-12" hidden>
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Session<span
                                        style="color: red;">*</span></label>
                                    <select class="form-control js-example-basic-single select" name="session_id" id="session_id">
                                    <option value="" disabled selected hiddden>Select Session</option>
                                    @foreach ($sesionarr as $sessions)
                                        <option value="{{ $sessions->id }}"@if ($sessions->id === $Sale_Delivery_Datas['session_id']) selected='selected' @endif>{{ $sessions->name }}</option>
                                        
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>
                  </div>
                    <div class="col-lg-12 col-sm-6 col-12">
                           <div class="form-group">
                                 <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Customer<span
                                        style="color: red;">*</span></label>
                                        <select class="form-control js-example-basic-single select" name="customer_id" id="customer_id">
                                    <option value="" disabled selected hiddden>Select Customer</option>
                                    @foreach ($customer_arrdata as $customer_arrdatas)
                                        <option value="{{ $customer_arrdatas->id }}" @if ($customer_arrdatas->id === $Sale_Delivery_Datas['customer_id']) selected='selected' @endif>{{ $customer_arrdatas->name }}</option>
                                        
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-12">
                           <div class="form-group">
                                 <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Delivery Boy<span
                                        style="color: red;">*</span></label>
                                    <select class="form-control js-example-basic-single select" name="deliveryboyid" id="deliveryboyid">
                                    <option value="" disabled selected hiddden>Select Customer</option>
                                    @foreach ($deliveryboy as $deliveryboys)
                                        <option value="{{ $deliveryboys->id }}"@if ($deliveryboys->id === $Sale_Delivery_Datas['deliveryboyid']) selected='selected' @endif>{{ $deliveryboys->name }}</option>
                                        
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-12" hidden>
                           
                                 <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Status<span
                                        style="color: red;">*</span></label>
                                        <div class="input-group" style="margin-right: 5px;">
                                                            <div class="input-group-text">
                                                                <input class="form-check-input" type="radio" value="Yes" id ="delivery_status" name="delivery_status"
                                                                    aria-label="Radio button for following text input" checked>
                                                            </div>
                                                            <input type="text" class="form-control" value="Yes" disabled
                                                                aria-label="Text input with radio button">
                                                        </div>
                                </select>
                           
                    </div>
                    <hr>
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
