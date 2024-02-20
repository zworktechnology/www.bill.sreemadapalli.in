@extends('layout.backend.auth')

@section('content')

   <div class="content">
      <div class="page-header">
         <div class="page-title">
            <h4>Add Delivery Boy Payoff</h4>
         </div>
      </div>



        <div class="card">
            <div class="card-body">
                <form autocomplete="off" method="POST" action="{{ route('deliveryboyspayoff.store') }}" enctype="multipart/form-data">
                    @csrf


                  <div class="row">



                        
                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Date<span
                                        style="color: red;">*</span></label>
                                <input type="date" name="date" class="deliverypayoff_date" placeholder="" value="{{ $today }}" required>
                            </div>
                        </div>

                        
                  </div>


                    <br />

                    <div class="row">
                        <div class="table-responsive col-lg-12 col-sm-12 col-12">
                            <table class="table">
                                <thead id="head_deliveryboysalrayrow">
                                    <tr style="background: #f8f9fa;">
                                        <th style="font-size:15px; width:15%;">DeliveryBoy</th>
                                        <th style="font-size:15px; width:10%;">Status</th>
                                        <th style="font-size:15px; width:15%;">Day / Salary</th>
                                        <th style="font-size:15px; width:10%;">Paid</th>
                                        <th style="font-size:15px; width:10%;">Balance</th>
                                        <th style="font-size:15px; width:15%;">Salary</th>
                                        <th style="font-size:15px; width:20%;">Note</th>
                                    </tr>
                                </thead>
                                <tbody id="deliveryboysalrayrow">
                                @foreach ($atendance_output as $keydata => $atendance_outputs)
                                <tr>
                                            <td>{{ $atendance_outputs['Deliveryboy']  }}
                                                <input type="hidden" class="form-control Deliveryboy_id" id="Deliveryboy_id" name="Deliveryboy_id[]" value="{{ $atendance_outputs['id']  }}"/>
                                            </td>
                                            @if ($atendance_outputs['Attendance_status'] == 'Present')
                                            <td style="color:green;font-weight:700">{{ $atendance_outputs['Attendance_status']  }}</td>
                                            @else
                                            <td>{{ $atendance_outputs['Attendance_status']  }}</td>
                                            @endif

                                            <td>{{ $atendance_outputs['perdaysalary']  }}
                                                <input type="hidden" class="form-control perdaysalary" id="perdaysalary" name="perdaysalary[]" value="{{ $atendance_outputs['perdaysalary']  }}"/></td>

                                            <td>{{ $atendance_outputs['paid_salary']  }}
                                                <input type="hidden" class="form-control salarypaidamount" id="salarypaidamount" name="salarypaidamount[]"
                                                 value="{{ $atendance_outputs['paid_salary']  }}"/></td>
                                                 
                                            @if ($atendance_outputs['balanceAmount'] != 0)
                                            <td style="color:red;">{{ $atendance_outputs['balanceAmount']  }}<input type="hidden" class="form-control salarybalanceamount" id="salarybalanceamount" name="salarybalanceamount[]"
                                                 value="{{ $atendance_outputs['balanceAmount']  }}"  style="background: #f8f9fa;"/></td>
                                            @else
                                            <td>{{ $atendance_outputs['balanceAmount']  }}<input type="hidden" class="form-control salarybalanceamount" id="salarybalanceamount" name="salarybalanceamount[]"
                                                 value="{{ $atendance_outputs['balanceAmount']  }}"  style="background: #f8f9fa;"/></td>
                                            @endif

                                            <td><input type="text" class="form-control salaryamountgiven" id="salaryamountgiven" name="salaryamountgiven[]" {{$atendance_outputs['readonly'] }}
                                                  style="background: #f8f9fa;" placeholder="{{$atendance_outputs['placeholder'] }}"/></td>

                                            <td><input type="text" class="form-control payoffnotes" id="payoffnotes" name="payoffnotes[]" placeholder="{{$atendance_outputs['noteplaceholder'] }}" {{$atendance_outputs['readonly'] }}/></td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                  </div>

<script>
$(document).ready(function() {
     $('.deliverypayoff_date').on('change', function () {
        var deliverypayoff_date = $(this).val();

        $.ajax({
            url: '/getdeliveryboy_payoff/',
            type: 'get',
            data: {
                deliverypayoff_date: deliverypayoff_date,
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                var len = response.length;
                $('#deliveryboysalrayrow').html('');
                //$('#salary_adddetailrow').show();
                for (var i = 0; i < len; i++) {

                        var column_0 = $('<td/>', {
                            html: response[i].Deliveryboy + '<input type="hidden" id="Deliveryboy_id" name="Deliveryboy_id[]" value="' + response[i].id + '"/>',
                        });
                        var column_1 = $('<td/>', {
                            html: response[i].Attendance_status,
                        });
                        var column_2 = $('<td/>', {
                            html: response[i].perdaysalary + '<input type="hidden" id="perdaysalary" class="form-control perdaysalary" name="perdaysalary[]" style="background: white;" value="' + response[i].perdaysalary + '" readonly class="form-control"/>',
                        });
                        var column_3 = $('<td/>', {
                            html: response[i].paid_salary + '<input type="hidden" id="salarypaidamount" name="salarypaidamount[]" style="background: white;color: #198754;font-weight:800;" value="' + response[i].paid_salary + '" readonly class="form-control salarypaidamount"/>',
                        });
                        var column_4 = $('<td/>', {
                            html: response[i].balanceAmount + '<input type="hidden" id="salarybalanceamount" name="salarybalanceamount[]" style="background: white;color: red;font-weight:800;" value="' + response[i].balanceAmount + '" readonly class="form-control salarybalanceamount"/>',
                        });
                        var column_5 = $('<td/>', {
                            html: '<input type="text" id="salaryamountgiven" name="salaryamountgiven[]"  ' + response[i].readonly + ' class="form-control salaryamountgiven" placeholder="' + response[i].placeholder + '"/>',
                        });
                        var column_6 = $('<td/>', {
                            html: '<input type="text" class="form-control payoffnotes" id="payoffnotes" name="payoffnotes[]" ' + response[i].readonly + ' value="' + response[i].payoffnotes + '" placeholder="' + response[i].noteplaceholder + '"/>',
                        });

                        var row = $('<tr id=salrydetailrow/>', {}).append(column_0, column_1, column_2,
                            column_3, column_4, column_5, column_6);

                        $('#deliveryboysalrayrow').append(row);
                        
                }
            }
        });
    });

    $(document).on("keyup", ".salaryamountgiven", function() {
        var salaryamountgiven = $(this).val();
        var salarybalanceamount = $(this).parents('tr').find('.salarybalanceamount').val();
        if (Number(salaryamountgiven) > Number(salarybalanceamount)) {
            alert('!Paid Amount is More than of Total!');
            //$(this).parents('tr').find('.amountgiven').val('');
        }
    });
});



</script>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" />
                        <a href="{{ route('deliveryboyspayoff.index') }}" class="btn btn-danger" value="">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection


