<div class="modal-dialog modal-l">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="purchaseorderviewLargeModalLabel">Employees</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

           

       


               <div class="invoice-box " style="max-width: 1600px;width:100%;padding: 0;font-size: 14px;line-height: 24px;color: #555;">
                  
                     <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-10 col-10  col-sm-11">
                           <div class="row">


                                       <div class="col-lg-6 col-sm-6 col-12 border">
                                          <span class="" style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 700;line-height: 35px; ">Employee</span>
                                       </div>
                                       <div class="col-lg-36 col-sm-6 col-12 border">
                                          <span class="" style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 700;line-height: 35px; ">Present / Absent</span>
                                       </div>
                           </div>
                           <div class="row ">
                           @if ($allemployee_attendance)
                                 @foreach ($allemployee_attendance as $index => $allemployee_attendances)
                                       <div class="col-lg-6 col-sm-6 col-12 border">
                                          <span class=""style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;line-height: 35px; ">{{ $allemployee_attendances['name'] }}</span>
                                       </div>
                                       <div class="col-lg-6 col-sm-6 col-12 border">
                                       @if ($allemployee_attendances['attendance'] == 'P')
                                          <span class=""style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:green;font-weight: 400;line-height: 35px; ">{{ $allemployee_attendances['attendance'] }}</span>
                                       @elseif ($allemployee_attendances['attendance'] == 'A')
                                          <span class=""style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:red;font-weight: 400;line-height: 35px; ">{{ $allemployee_attendances['attendance'] }}</span>
                                       @elseif ($allemployee_attendances['attendance'] == 'L')
                                          <span class=""style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:red;font-weight: 400;line-height: 35px; ">{{ $allemployee_attendances['attendance'] }}</span>
                                       @elseif ($allemployee_attendances['attendance'] == 'SL')
                                          <span class=""style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:red;font-weight: 400;line-height: 35px; ">{{ $allemployee_attendances['attendance'] }}</span>
                                       @endif
                                          
                                       </div>
                                 @endforeach
                                 @endif
                           </div>
                        </div>
                        <div class="col-lg-1 col-1 col-sm-12"></div>

                     </div>

               </div>

              
   
           

        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->


