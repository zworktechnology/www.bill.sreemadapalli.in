<!DOCTYPE html>
<html>
<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            padding-top: 20px;
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
            <h4  style="text-transform: uppercase; color:red;text-align:center;">Customer Pending Report</h4>
            <h4 style="text-align:right;">Date : {{$today}}</h4>
        </div>
    </div>


    <table id="customers">
        <thead style="background: #5e54c966">
            <tr>
            <th style="font-size:14px;">S.No</th>
                                       <th style="font-size:14px;">Name</th>
                                       <th style="font-size:14px;">Contact Number</th>
                                        <th style="font-size:14px;">Accounts Values</th>
            </tr>
        </thead>
        <tbody id="customer_index">
            @foreach ($customerdata as $keydata => $customerdatas)
            <tr>
            <td style="font-size:14px;">{{ ++$keydata }}</td>
            <td style="font-size:14px;">{{ $customerdatas['name'] }}</td>
            <td style="font-size:14px;">{{ $customerdatas['phone_number'] }}</td>

               @if ($customerdatas['pending_amount'] != '')
                  <td style="color: red;font-size:14px;">{{ $customerdatas['pending_amount'] }}</td>
               @else
                  <td></td>
               @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>
