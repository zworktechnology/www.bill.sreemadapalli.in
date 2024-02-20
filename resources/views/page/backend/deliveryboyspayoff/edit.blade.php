<div class="modal-dialog modal-l">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Update</h5>
        </div>
        <div class="modal-body">
            <form autocomplete="off" method="POST" action="{{ route('deliveryboyspayoff.update', ['unique_key' => $datas['unique_key']]) }}" enctype="multipart/form-data">
                  @method('PUT')
                    @csrf
                <div class="row">


                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Date<span
                                        style="color: red;">*</span></label>
                                <input type="date" name="date" class="date" readonly value="{{ $datas['date'] }}">
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Employee<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="employee" class="employee"  value="{{ $datas['deliveryboy']  }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Day Salary<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="perday_salary" class="deliverypayoffedit_perday_salary" readonly value="{{ $datas['perdaysalary']  }}">
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Amount Given<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="amountgiven" class="deliverypayoffedit_amountgiven"  value="{{ $datas['amountgiven']  }}">
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-6 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Note<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="note" class="note"  value="{{ $datas['payoffnotes']  }}">
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
