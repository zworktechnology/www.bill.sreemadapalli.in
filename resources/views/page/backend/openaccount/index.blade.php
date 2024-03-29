@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Open Account</h4>
                <p style="color:lightgray">( Open Account Details )</p>
            </div>
            <div class="page-btn">

                  <div style="display: flex;">
                     <form autocomplete="off" method="POST" action="{{ route('openaccount.datefilter') }}">
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
            <div class="col-sm-8">
               <div class="card">
                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table  datanew">
                              <thead>
                                 <tr>
                                    <th>Sl. No</th>
                                    <th>Amount</th>
                                    <th>Note</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach ($data as $keydata => $datas)
                                    <tr>
                                          <td>{{ ++$keydata }}</td>
                                          <td>{{ $datas->amount }}</td>
                                          <td>{{ $datas->note }}</td>
                                          <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                   <li>
                                                         <a href="#edit{{ $datas->unique_key }}" data-bs-toggle="modal"
                                                            data-id="{{ $datas->unique_key }}"
                                                            data-bs-target=".openacountedit-modal-xl{{ $datas->unique_key }}"
                                                            class="badges bg-warning" style="color: white">Edit</a>
                                                   </li>
                                                   <li>
                                                         <a href="#delete{{ $datas->unique_key }}" data-bs-toggle="modal"
                                                            data-id="{{ $datas->unique_key }}"
                                                            data-bs-target=".openacountdelete-modal-xl{{ $datas->unique_key }}"
                                                            class="badges bg-lightyellow" style="color: white">Delete</a>
                                                   </li>
                                                </ul>
                                          </td>
                                    </tr>
                                          <div class="modal fade openacountedit-modal-xl{{ $datas->unique_key }}"
                                                tabindex="-1" role="dialog" data-bs-backdrop="static"
                                                aria-labelledby="editLargeModalLabel{{ $datas->unique_key }}"
                                                aria-hidden="true">
                                                @include('page.backend.openaccount.edit')
                                          </div>
                                          <div class="modal fade openacountdelete-modal-xl{{ $datas->unique_key }}"
                                                tabindex="-1" role="dialog"data-bs-backdrop="static"
                                                aria-labelledby="deleteLargeModalLabel{{ $datas->unique_key }}"
                                                aria-hidden="true">
                                                @include('page.backend.openaccount.delete')
                                          </div>

                                    
                                 @endforeach
                              </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-sm-4">

            @include('page.backend.openaccount.create')
            </div>
        </div>
        

       
    </div>
@endsection
