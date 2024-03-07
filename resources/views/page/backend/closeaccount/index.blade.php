@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Close Account</h4>
            </div>
            <div class="page-btn">

                  <div style="display: flex;">
                     <form autocomplete="off" method="POST" action="{{ route('closeaccount.datefilter') }}">
                           @method('PUT')
                           @csrf
                           <div style="display: flex">
                              <div style="margin-right: 10px;"><input type="date" name="from_date"
                                       class="form-control from_date" value="{{ $today }}"></div>
                              <div style="margin-right: 5px;"><input type="submit" class="btn" value="Search"
                                       style="background: #ff9f43; color:white;" /></div>
                           </div>
                     </form>
                  </div>

               </div>
        </div>

        <div class="row">
            <div class="col-sm-9">


               <div class="card">
                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table  datanew">
                              <thead>
                                 <tr>
                                    <th>Sl. No</th>
                                    <th>Date</th>
                                    <th>Sales</th>
                                    <th>Card</th>
                                    <th>Cash</th>
                                    <th>Paytm</th>
                                    <th>Paytm Business</th>
                                    <th>Gpay</th>
                                    <th>Gpay Business</th>
                                    <th>Phonepay</th>
                                    <th>Phonepay Business</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach ($data as $keydata => $datas)
                                    <tr>
                                          <td>{{ ++$keydata }}</td>
                                          <td>{{ date('d-m-Y', strtotime($datas->date)) }}</td>
                                          <td>{{ $datas->sales }}</td>
                                          <td>{{ $datas->card }}</td>
                                          <td>{{ $datas->cash }}</td>

                                          <td>{{ $datas->paytm }}</td>
                                          <td>{{ $datas->paytm_business }}</td>
                                          <td>{{ $datas->gpay }}</td>
                                          <td>{{ $datas->gpay_business }}</td>
                                          <td>{{ $datas->phonepe }}</td>
                                          <td>{{ $datas->phonepe_business }}</td>
                                          <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                   <li>
                                                         <a href="#edit{{ $datas->unique_key }}" data-bs-toggle="modal"
                                                            data-id="{{ $datas->unique_key }}"
                                                            data-bs-target=".closeaccountedit-modal-xl{{ $datas->unique_key }}"
                                                            class="badges bg-lightgrey" style="color: white">Edit</a>
                                                   </li>
                                                   <li>
                                                         <a href="#delete{{ $datas->unique_key }}" data-bs-toggle="modal"
                                                            data-id="{{ $datas->unique_key }}"
                                                            data-bs-target=".closeaccountdelete-modal-xl{{ $datas->unique_key }}"
                                                            class="badges bg-lightyellow" style="color: white">Delete</a>
                                                   </li>
                                                </ul>
                                          </td>
                                    </tr>
                                          <div class="modal fade closeaccountedit-modal-xl{{ $datas->unique_key }}"
                                                tabindex="-1" role="dialog" data-bs-backdrop="static"
                                                aria-labelledby="editLargeModalLabel{{ $datas->unique_key }}"
                                                aria-hidden="true">
                                                @include('page.backend.closeaccount.edit')
                                          </div>
                                          <div class="modal fade closeaccountdelete-modal-xl{{ $datas->unique_key }}"
                                                tabindex="-1" role="dialog"data-bs-backdrop="static"
                                                aria-labelledby="deleteLargeModalLabel{{ $datas->unique_key }}"
                                                aria-hidden="true">
                                                @include('page.backend.closeaccount.delete')
                                          </div>

                                    
                                 @endforeach
                              </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-sm-3">

            @include('page.backend.closeaccount.create')
            </div>
        </div>
        

       
    </div>
@endsection
