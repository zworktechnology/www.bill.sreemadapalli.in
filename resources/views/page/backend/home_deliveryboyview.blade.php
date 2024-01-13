<div class="modal-dialog modal-l">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="purchaseorderviewLargeModalLabel">Deliveryboy</h5>
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
                                       <div class="col-lg-3 col-sm-3 col-3 border">
                                          <span class="" style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 700;line-height: 35px; ">Deliveryboy</span>
                                       </div>
                                       @foreach ($sessionarr as $index => $sessionarray)
                                       <div class="col-lg-3 col-sm-3 col-3 border">
                                          <span class="" style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 700;line-height: 35px; ">{{$sessionarray->name}}</span>
                                       </div>
                                       @endforeach
                                    </div>

                           <div class="row ">
                           @foreach ($alldeliveryboy as $index => $alldeliveryboys)
                                       <div class="col-lg-3 col-sm-3 col-3 border">
                                          {{ $alldeliveryboys->name }}
                                       </div>
                                       @foreach ($alldeliveryboy_attendance as $index => $alldeliveryboy_attendances)
                                       @if ($alldeliveryboy_attendances['deliveryboy_id'] == $alldeliveryboys->id)

                                       <div class="col-lg-3 col-sm-3 col-3 border">
                                      @if ($alldeliveryboy_attendances['attendance'] == 'P')
                                      <span class="" style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 700;line-height: 35px; ">{{ $alldeliveryboy_attendances['attendance'] }}</span>
                                      @elseif ($alldeliveryboy_attendances['attendance'] == 'A')
                                      <span class="" style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 700;line-height: 35px; ">{{ $alldeliveryboy_attendances['attendance'] }}</span>
                                      @else
                                      <span class="" style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 700;line-height: 35px; "></span>
                                      @endif
                                       
                                       </div>
                                       @endif
                                       @endforeach    
                                   
                                          
                                       
                                      
                                       
                                       
                                       
                                     
                                  
                                 @endforeach      
                           </div>
                        </div>
                        <div class="col-lg-1 col-1 col-sm-12"></div>

                     </div>

               </div>

              
   
           

        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->


