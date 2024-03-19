@extends('layout.backend.auth')

@section('content')





   <div class="content">
      @if(Auth::user()->role == 'Super-Admin')
         <div class="page-header">
            <div class="page-title">
                <h4>Dashboard</h4>
            </div>

           

            <div class="page-btn">
                <div style="display: flex;">
                        <form autocomplete="off" method="POST" action="{{ route('home.datefilter') }}">
                            @method('PUT')
                            @csrf
                            <div style="display: flex">
                                 <div style="margin-right: 10px;"><input type="date" name="from_date"
                                        class="form-control from_date" value="{{ $today }}"></div>
                                <div style="margin-right: 10px;"><input type="submit" class="btn btn-success"
                                        value="Search" /></div>
                            </div>
                        </form>
                </div>


            </div>
           
        </div>

        
            <div class="row">

            

               <div class="col-lg-4 col-sm-6 col-12">
                  <div class="dash-widget" style="border: 1px solid #fff;background: #c8eccc;">
                     <div class="dash-widgetcontent">
                        <h5>₹ </span>{{$tot_purchaseAmount}}</h5>
                        <h6>Total Purchase Amount</h6>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-sm-6 col-12">
                  <div class="dash-widget dash1" style="border: 1px solid #fff;background: #e1d7fa;">
                     <div class="dash-widgetcontent">
                        <h5>₹ {{$tot_saleAmount}}</h5>
                        <h6>Total Sales Amount</h6>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-sm-6 col-12">
                  <div class="dash-widget dash2" style="border: 1px solid #fff;background: #eefad7;">
                     <div class="dash-widgetcontent">
                        <h5>₹ {{$tot_expenseAmount}}</h5>
                        <h6>Total Expense Amount</h6>
                     </div>
                  </div>
               </div>



               <div class="col-lg-3 col-sm-6 col-12 d-flex" >
                  <div class="dash-count" href="#employeeview" data-bs-toggle="modal"  data-bs-target=".employeeview-modal-xl" class="employeeview">
                     <div class="dash-counts">
                        <h4 style="color: red;" >{{$total_Employee}}</h4>
                        <h5 style="color: #261b0a;">Employees</h5>
                     </div>
                     <div class="dash-imgs" style="color:#751818">
                        <i data-feather="user"></i>
                     </div>
                  </div>
               </div>
                                                   <div class="modal fade employeeview-modal-xl"
                                                      tabindex="-1" role="dialog" data-bs-backdrop="static"
                                                      aria-labelledby="purchaseviewLargeModalLabel"
                                                      aria-hidden="true">
                                                      @include('page.backend.home_employeeview')
                                                </div>


               <div class="col-lg-3 col-sm-6 col-12 d-flex">
                  <div class="dash-count das1" href="#deliveryboyview" data-bs-toggle="modal"  data-bs-target=".deliveryboyview-modal-xl" class="deliveryboyview">
                     <div class="dash-counts">
                        <h4 style="color: red;">{{$total_Deliveryboy}}</h4>
                        <h5 style="color: #261b0a;">Delivery Boys</h5>
                     </div>
                     <div class="dash-imgs" style="color:#751818">
                        <i data-feather="user"></i>
                     </div>
                  </div>
               </div>

                                                   <div class="modal fade deliveryboyview-modal-xl"
                                                      tabindex="-1" role="dialog" data-bs-backdrop="static"
                                                      aria-labelledby="purchaseviewLargeModalLabel"
                                                      aria-hidden="true">
                                                      @include('page.backend.home_deliveryboyview')
                                                </div>
               <div class="col-lg-3 col-sm-6 col-12 d-flex">
                  <div class="dash-count das2"><a href="{{ route('customer.index') }}">
                     <div class="row">
                        <div class="col-8 dash-counts">
                           <h4 style="color: red;">{{$total_Customer}}</h4>
                           <h5 style="color: #261b0a;">Customers</h5>
                        </div>
                        <div class="col-4 dash-imgs" style="color:#751818">
                           <i data-feather="user"></i>
                        </div>
                     </div>
                     
                  </a>
                  </div>
               </div>
               <div class="col-lg-3 col-sm-6 col-12 d-flex">
                  <div class="dash-count das3"><a href="{{ route('supplier.index') }}">
                     <div class="row">
                        <div class="col-8 dash-counts">
                           <h4 style="color: red;">{{$total_Supplier}}</h4>
                           <h5 style="color: #261b0a;">Suppliers</h5>
                        </div>
                        <div class="col-4 dash-imgs" style="color:#751818">
                           <i data-feather="user"></i>
                        </div>
                     </div>
                     </a>
                  </div>
               </div>
               
            </div>


            <div class="row">
               <div class="col-lg-6 col-sm-12 col-12 d-flex">
                  <div class="card flex-fill">

                     <div class="card-body">
                        <div class="table-responsive ">
                           <table class="table  ">
                              <tbody>
                                 <tr>
                                    <td style="color:black;font-weight:600;font-size:15px;text-transform:uppercase;">Opening Account</td>
                                    <td><a href="{{ route('openaccount.index') }}">{{$Openaccountdata}}</a></td>
                                 </tr>
                                 <tr>
                                    <td style="color:black;font-weight:600;font-size:15px;text-transform:uppercase;">Sales</td>
                                    <td><a href="{{ route('sales.index') }}">{{$Saledata}}</a></td>
                                 </tr>
                                 <tr>
                                    <td style="color:red;font-weight:700;font-size:15px;text-transform:uppercase;">Total</td>
                                    <td style="color:red;font-weight:700;font-size:15px;text-transform:uppercase;">{{$open_sales}}</td>
                                 </tr>
                                 <tr>
                                    <td style="color:black;font-weight:600;font-size:15px;text-transform:uppercase;">Expense</td>
                                    <td><a href="{{ route('expense.index') }}">{{$total_expense}}</a></td>
                                 </tr>
                                 <tr>
                                    <td style="color:red;font-weight:700;font-size:15px;text-transform:uppercase;">Total</td>
                                    <td>{{$open_sales_exp}}</td>
                                 </tr>
                                 <tr><td></td><td></td></tr>
                                 @if ($over_all > 0)
                                 <tr>
                                    <td>Over All</td>
                                    <td style="color:green;font-weight:800;font-size:16px;text-transform:uppercase;">₹ {{$over_all}}</td>
                                 </tr>
                                 @else
                                 <tr>
                                    <td>Over All</td>
                                    <td style="font-weight:800;font-size:16px;text-transform:uppercase;">₹ {{$over_all}}</td>
                                 </tr>
                                 @endif
                              </tbody>
                           </table>
                        </div>
                     </div>

                  </div>
               </div>

               <div class="col-lg-6 col-sm-12 col-12 d-flex">
                  <div class="card flex-fill">

                     <div class="card-body">
                        <div class="table-responsive ">
                           <table class="table  ">
                              <tbody>
                                 <tr>
                                    <td style="color:black;font-weight:600;font-size:15px;text-transform:uppercase;">Cash</td>
                                    <td>{{$cash}}</td>
                                 </tr>
                                 <tr>
                                    <td style="color:black;font-weight:600;font-size:15px;text-transform:uppercase;">Card</td>
                                    <td>{{$card}}</td>
                                 </tr>
                                 <tr>
                                    <td style="color:black;font-weight:600;font-size:15px;text-transform:uppercase;">Paytm Business</td>
                                    <td>{{$paytm_business}}</td>
                                 </tr>
                                 <tr>
                                    <td style="color:black;font-weight:600;font-size:15px;text-transform:uppercase;">Paytm</td>
                                    <td>{{$paytm}}</td>
                                 </tr>
                                 <tr>
                                    <td style="color:black;font-weight:600;font-size:15px;text-transform:uppercase;">Phonepay Business</td>
                                    <td>{{$phonepe_business}}</td>
                                 </tr>
                                 <tr>
                                    <td style="color:black;font-weight:600;font-size:15px;text-transform:uppercase;">Phonepay</td>
                                    <td>{{$phonepe}}</td>
                                 </tr>
                                 <tr>
                                    <td style="color:black;font-weight:600;font-size:15px;text-transform:uppercase;">GPay Business</td>
                                    <td>{{$gpay_business}}</td>
                                 </tr>
                                 <tr>
                                    <td style="color:black;font-weight:600;font-size:15px;text-transform:uppercase;">GPay</td>
                                    <td>{{$gpay}}</td>
                                 </tr>
                                 <tr>
                                    <td style="color:red;font-weight:700;font-size:15px;text-transform:uppercase;">Total</td>
                                    <td  style="color:red;font-weight:700;font-size:15px;text-transform:uppercase;">{{$totalpayment_methods}}</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>

                  </div>
               </div>

            </div>



            <div class="row">
               <div class="col-lg-6 col-sm-12 col-12 d-flex">
                  <div class="card flex-fill">
                     <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Sales</h5>
                     </div>

                     <div class="card-body">
                        <div class="table-responsive ">
                           <table class="table  ">
                              <thead>
                                 <tr>
                                 <th>S.No</th>
                                 <th>Payment Mode</th>
                                 <th>Total Amount</th>
                                 </tr>
                              </thead>
                              <tbody>
                              @foreach ($salepaymentmode_table as $keydata => $salepaymentmode_tablearr)
                                 <tr>
                                    <td>{{ ++$keydata }}</td>
                                    <td class="">{{ $salepaymentmode_tablearr['name'] }}</td>
                                    <td>₹ {{ $salepaymentmode_tablearr['totsaleAmount'] }}</td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                     </div>

                  </div>
               </div>
               <div class="col-lg-6 col-sm-12 col-12 d-flex">
                  <div class="card flex-fill">
                     <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Purchase</h5>
                     </div>

                     <div class="card-body">
                        <div class="table-responsive ">
                           <table class="table  ">
                              <thead>
                                 <tr>
                                 <th>S.No</th>
                                 <th>Payment Mode</th>
                                 <th>Total Amount</th>
                                 </tr>
                              </thead>
                              <tbody>
                              @foreach ($salepaymentmode_table as $keydata => $salepaymentmode_tablearry)
                                 <tr>
                                    <td>{{ ++$keydata }}</td>
                                    <td class="">{{ $salepaymentmode_tablearry['name'] }}</td>
                                    <td>₹ {{ $salepaymentmode_tablearry['totalpurchase_payment'] }}</td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                     </div>

                  </div>
               </div>
            </div>



         @endif



         @if(Auth::user()->role == 'DeliveryBoy')

         <div class="page-header">
            <div class="page-title">
                <h4>Sales</h4>
            </div>
         </div>
         <div class="row">


               <div class="col-lg-12 col-sm-12 col-12 d-flex">
                  <div class="card flex-fill">

                     <div class="card-body">
                        <div class="table-responsive">
                           <table class="table  datanew">
                              <thead>
                                 <tr>
                                 <th>S.No</th>
                                 <th>Bill No</th>
                                 <th>Customer</th>
                                 <th>Payment Method</th>
                                 <th>Update</th>
                                 </tr>
                              </thead>
                              <tbody>
                              @foreach ($saledelivery_data as $keydata => $saledelivery_datas)
                                 <tr>
                                    <td>{{ ++$keydata }}</td>
                                    <td class="">{{ $saledelivery_datas['bill_no'] }}</td>
                                    <td> {{ $saledelivery_datas['customer'] }}</td>
                                    <td>{{ $saledelivery_datas['payment_method'] }}</td>
                                    <td>
                                                            <ul class="list-unstyled hstack gap-1 mb-0">
                                                                <li>
                                                                    <a href="deliveryboyupdate{{ $saledelivery_datas['unique_key'] }}"
                                                                    data-bs-toggle="modal" data-id="{{ $saledelivery_datas['id'] }}" style="background: #e3e167;"
                                                                    data-bs-target=".deliveryboyupdate-modal-xl{{ $saledelivery_datas['unique_key'] }}"
                                                                    class="badges" style="color: white">Add</a>
                                                                </li>
                                                            </ul>
                                    </td>
                                 </tr>

                                             <div class="modal fade deliveryboyupdate-modal-xl{{ $saledelivery_datas['unique_key'] }}"
                                                        tabindex="-1" role="dialog" data-bs-backdrop="static"
                                                        aria-labelledby="purchaseviewLargeModalLabel{{ $saledelivery_datas['unique_key'] }}"
                                                        aria-hidden="true">
                                                        @include('page.backend.sales.deliveryboyupdate')
                                                    </div>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                     </div>

                  </div>
               </div>



         </div>
         @endif

   </div>





@endsection
