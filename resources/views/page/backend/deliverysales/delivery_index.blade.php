@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Sales Delivery - {{ $curent_month}}-{{$year}}</h4>
            </div>

            <div class="page-btn">
                <div style="display: flex;">
                        <form autocomplete="off" method="POST" action="{{ route('deliverysales.delivery_datefilter') }}">
                            @method('PUT')
                            @csrf
                            <div style="display: flex">
                                 
                                 <div style="margin-right: 10px;"><input type="date" name="from_date"
                                        class="form-control from_date" value="{{ $today }}"></div>
                                <div style="margin-right: 10px;"><input type="submit" class="btn btn-success"
                                        value="Search" /></div>


                            <button style="margin-right: 10px;" type="button" class="btn btn-primary waves-effect waves-light btn-added" data-bs-toggle="modal"
                            data-bs-target=".deliverybreakfast-modal-xl">BreakFast</button>


                            <button style="margin-right: 10px;" type="button" class="btn btn-primary waves-effect waves-light btn-added" data-bs-toggle="modal"
                            data-bs-target=".deliverylunch-modal-xl">Lunch</button>

                            <button style="margin-right: 10px;" type="button" class="btn btn-primary waves-effect waves-light btn-added" data-bs-toggle="modal"
                            data-bs-target=".deliverydinner-modal-xl">Dinner</button>
                            </div>
                            
                        </form>
                </div>


            </div>
        </div>


      
        <br/>
        
                    <div class="card">
                        <div class="card-body" >
                                <div class="row">
                                    
                                        <div class="col-sm-2">
                                            <table class="table ">
                                                <thead>
                                                    <tr>
                                                        <th class="border">Date</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="border">Day</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="border">Session</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($customer_arrdata as $customers_arrdatas)
                                                        <tr class="border"></tr>
                                                        <td class="border" >{{$customers_arrdatas->name}}</td>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-10" style="overflow: auto;">
                                            <table class="table ">
                                               
                                                <thead>
                                                        <tr>
                                                            @foreach ($list as $lists)
                                                                <th colspan="3" class="border" style="text-align:center;">{{ $lists }}</th>
                                                            @endforeach
                                                            <th class="border " colspan="3"></th>
                                                        </tr>
                                                        <tr>
                                                            @foreach ($list as $lists_ass)
                                                            @php 
                                                            
                                                            $timestamp = strtotime($year .'-'. $month .'-'. $lists_ass); 
                                                            $day = date('l', $timestamp);
                                                            $date = $year .'-'. $month .'-'. $lists_ass;
                                                            @endphp

                                                            <th class="border " colspan="3" style="text-align:center;"><span style="color: black">{{$day}}</span></th>
                                                            @endforeach
                                                            <th  class="border" style="text-align:center;" colspan="3">Total</th>
                                                        </tr>
                                                        <tr>
                                                            @foreach ($list as $lists)
                                                            @foreach ($session_terms as $session_termsarr)
                                                            <th class="border" style="text-align:center;">{{$session_termsarr['session']}}</th>
                                                            
                                                            @endforeach
                                                            @endforeach
                                                            <th  class="border">BF</th>
                                                            <th  class="border">L</th>
                                                            <th  class="border">D</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        @foreach ($customers_terms as $customers_termsarr)
                                                        <tr class="border">

                                                            @foreach ($Sale_Delivery_Data as $Sale_Delivery_Datas)
                                                                @if ($customers_termsarr['id'] == $Sale_Delivery_Datas['customer_id'])

                                                                    @if ($Sale_Delivery_Datas['status'] == 'Yes')
                                                                        <td class="border" >
                                                                            

                                                                                <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true" style="color:green;font-size:15px;" >
                                                                                {{ $Sale_Delivery_Datas['status'] }}</a>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <a href="#deliveryedit{{ $Sale_Delivery_Datas['unique_key'] }}" data-bs-toggle="modal"
                                                                                        data-id="{{ $Sale_Delivery_Datas['unique_key'] }}"
                                                                                        data-bs-target=".deliveryedit-modal-xl{{ $Sale_Delivery_Datas['unique_key'] }}"
                                                                                        class="dropdown-item" >Edit</a>
                                                                                </li>
                                                                                <li>
                                                                                <a data-bs-toggle="modal"  data-bs-target=".salesdeliveryedelete-modal-xl{{ $Sale_Delivery_Datas['unique_key'] }}" class="dropdown-item confirm-text">Delete Sale</a>
                                                                                </li>
                                                                            </ul>
                                                                        </td>

                                                                        <div class="modal fade deliveryedit-modal-xl{{ $Sale_Delivery_Datas['unique_key'] }}"
                                                                                tabindex="-1" role="dialog" data-bs-backdrop="static"
                                                                                aria-labelledby="editLargeModalLabel{{ $Sale_Delivery_Datas['unique_key'] }}"
                                                                                aria-hidden="true">
                                                                                @include('page.backend.deliverysales.delivery_edit')
                                                                        </div>
                                                                     
                                                                        <div class="modal fade salesdeliveryedelete-modal-xl{{ $Sale_Delivery_Datas['unique_key'] }}"
                                                                            tabindex="-1" role="dialog"  data-bs-backdrop="static"
                                                                            aria-labelledby="deleteLargeModalLabel{{ $Sale_Delivery_Datas['unique_key'] }}"
                                                                            aria-hidden="true">
                                                                            @include('page.backend.deliverysales.delivery_delete')
                                                                        </div>
                                                                    @else
                                                                        <td class="border" style="color:white">No</td>
                                                                    @endif

                                                                @endif


                                                            
                                                                
                                                            @endforeach
                                                            <td class="border" style="color:green;font-weight:800">{{$customers_termsarr['total_breakfast']}}</td>
                                                            <td class="border" style="color:#a2731d;font-weight:800">{{$customers_termsarr['total_lunch']}}</td>
                                                            <td class="border" style="color:#dc3545;font-weight:800">{{$customers_termsarr['total_dinner']}}</td>
                                                        </tr>
                                                        @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    
                                </div>
                        </div>
                    </div>

                        </div>
                    </div>


        <div class="modal fade deliverybreakfast-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            @include('page.backend.deliverysales.breakfastcreate')
        </div>

        <div class="modal fade deliverylunch-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            @include('page.backend.deliverysales.lunchcreate')
        </div>
        

        <div class="modal fade deliverydinner-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            @include('page.backend.deliverysales.dinnercreate')
        </div>
    </div>
@endsection
