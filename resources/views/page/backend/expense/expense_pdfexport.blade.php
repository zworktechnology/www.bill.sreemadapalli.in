<!DOCTYPE html>
<html>
<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            padding-top: 10px;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: #5e54c966;
            color: black;
        }


        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        /* Float four columns side by side */
        .column {
            float: left;
            width: 30%;
            padding: 0 10px;
        }

        /* Remove extra left and right margins, due to padding */
        .row {
            margin: 0 -5px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        @media screen and (max-width: 600px) {
            .column {
                width: 100%;
                display: block;
                margin-bottom: 20px;
            }
        }

        /* Style the counter cards */
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 16px;
            text-align: center;
            background-color: #f1f1f1;
        }

        .logoname {
            display: flex;
        }

    </style>
</head>
<body>
   <div class="logoname">
        <div>
            <h4  style="text-transform: uppercase; color:red;text-align:center;">Expense Report</h4>
            <h4 style="text-align:right;">Date : {{$today}}</h4>
        </div>
    </div>


    <table id="customers">
        <thead style="background: #5e54c966">
            <tr>
            <th style="font-size:14px;width:10%">S.No</th>
                                       <th style="font-size:14px;width:35%">Particulars</th>
                                       <th style="font-size:14px;width:15%">Total Price</th>
                                        <th style="font-size:14px;width:15%">Payment Mode</th>
            </tr>
        </thead>
        <tbody id="customer_index">
            @foreach ($expense_data as $keydata => $expense_datas)
            <tr>
            <td style="font-size:14px;">{{ ++$keydata }}</td>
            <td style="font-size:14px;">
            @foreach ($expense_datas['terms'] as $index => $terms_array)
                                                    @if ($terms_array['expense_id'] == $expense_datas['id'])
                                                    {{ $terms_array['note'] }} - {{ $terms_array['price'] }}<br/>
                                                    @endif
                                                    @endforeach
            </td>
            <td style="font-size:14px;">{{ $expense_datas['total_price'] }}</td>
            <td style="font-size:14px;">{{ $expense_datas['bank'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>
