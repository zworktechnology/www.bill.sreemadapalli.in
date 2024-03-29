<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ThemeMarch">
    <!-- Site Title -->
    <title>Internet Bill Invoice</title>
    <link rel="stylesheet" href="{{ asset('assets/backend/bill/css/style.css') }}">
</head>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap');

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        body {
            color: #666;
            font-size: 12px;
            font-weight: 400;
            line-height: 1.4em;
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f5f6fa;
        }

        .tm_pos_invoice_wrap {
            max-width: 450px;
            margin: auto;
            margin-top: 0px;
            padding: 30px 20px;
            background-color: #fff;
        }

        .tm_pos_company_logo {
            display: flex;
            justify-content: center;
            margin-bottom: 7px;
        }

        .tm_pos_company_logo img {
            vertical-align: middle;
            border: 0;
            max-width: 100%;
            height: auto;
            max-height: 45px;
        }

        .tm_pos_invoice_top {
            text-align: center;
            margin-bottom: 18px;
        }

        .tm_pos_invoice_heading {
            display: flex;
            justify-content: center;
            position: relative;
            text-transform: uppercase;
            font-size: 12px;
            font-weight: 500;
            margin: 10px 0;
        }

        .tm_pos_invoice_heading:before {
            content: '';
            position: absolute;
            height: 0;
            width: 100%;
            left: 0;
            top: 46%;
            border-top: 1px dashed #666;
        }

        .tm_pos_invoice_heading span {
            display: inline-flex;
            padding: 0 5px;
            background-color: #fff;
            z-index: 1;
            font-weight: 500;
        }

        .tm_list.tm_style1 {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
        }

        .tm_list.tm_style1 li {
            display: flex;
            width: 50%;
            font-size: 12px;
            line-height: 1.2em;
            margin-bottom: 7px;
        }

        .text-right {
            text-align: right;
            justify-content: flex-end;
        }

        .tm_list_title {
            color: #111;
            margin-right: 4px;
            font-weight: 500;
        }

        .tm_invoice_seperator {
            width: 150px;
            border-top: 1px dashed #666;
            margin: 9px 0;
            margin-left: auto;
        }

        .tm_pos_invoice_table {
            width: 100%;
            margin-top: 10px;
            line-height: 1.3em;
        }

        .tm_pos_invoice_table thead th {
            font-weight: 500;
            color: #111;
            text-align: left;
            padding: 8px 3px;
            border-top: 1px dashed #666;
            border-bottom: 1px dashed #666;
        }

        .tm_pos_invoice_table td {
            padding: 4px;
        }

        .tm_pos_invoice_table tbody tr:first-child td {
            padding-top: 10px;
        }

        .tm_pos_invoice_table tbody tr:last-child td {
            padding-bottom: 10px;
            border-bottom: 1px dashed #666;
        }

        .tm_pos_invoice_table th:last-child,
        .tm_pos_invoice_table td:last-child {
            text-align: right;
            padding-right: 0;
        }

        .tm_pos_invoice_table th:first-child,
        .tm_pos_invoice_table td:first-child {
            padding-left: 0;
        }

        .tm_pos_invoice_table tr {
            vertical-align: baseline;
        }

        .tm_bill_list {
            list-style: none;
            margin: 0;
            padding: 12px 0;
            border-bottom: 1px dashed #666;
        }

        .tm_bill_list_in {
            display: flex;
            text-align: right;
            justify-content: flex-end;
            padding: 3px 0;
        }

        .tm_bill_title {
            padding-right: 20px;
        }

        .tm_bill_value {
            width: 90px;
        }

        .tm_bill_value.tm_bill_focus,
        .tm_bill_title.tm_bill_focus {
            font-weight: 500;
            color: #111;
        }

        .tm_pos_invoice_footer {
            text-align: center;
            margin-top: 20px;
        }

        .tm_pos_sample_text {
            text-align: center;
            padding: 12px 0;
            border-bottom: 1px dashed #666;
            line-height: 1.6em;
            color: #9c9c9c;
        }

        .tm_pos_company_name {
            font-weight: 500;
            color: #111;
            font-size: 13px;
            line-height: 1.4em;
            font-family: 'Inter', sans-serif;
        }
    </style>
    </head>

    <body>
        <div class="tm_pos_invoice_wrap">
            <div class="tm_pos_sample_text"><img src="{{ asset('assets/backend/img/bill_logo.png') }}" alt="" width="150"
                                    height="150" ></div>
          {{--  <div style="font-weight:500;color:black; text-align: center;">...Thanks for chossing Sree
                Madapalli...</div> --}}
            <table class="tm_pos_invoice_table">
                <thead>
                    <tr>
                        <th style="font-weight:500;color:black;">SL</th>
                        <th style="font-weight:500;color:black;">Item</th>
                        <th style="font-weight:500;color:black;">Price</th>
                        <th style="font-weight:500;color:black;">Qty</th>
                        <th style="font-weight:500;color:black;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($output as $keydata => $output_arr)
                        <tr>
                            <td style="font-weight:500;color:black;">{{ ++$keydata }}.</td>
                            <td style="font-weight:500;color:black;">{{ $output_arr['productname'] }}</td>
                            <td style="font-weight:500;color:black;">{{ $output_arr['price'] }}</td>
                            <td style="font-weight:500;color:black;">{{ $output_arr['quantity'] }}</td>
                            <td style="font-weight:500;color:black;">{{ $output_arr['total_price'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="tm_bill_list">

                <div class="tm_bill_list_in">
                    <div class="tm_bill_title tm_bill_focus">Total :</div>
                    <div class="tm_bill_value tm_bill_focus">{{ $total }}.00</div>
                </div>
                <div class="tm_bill_list_in">
                    <div class="tm_bill_title tm_bill_focus">Balance :</div>
                    <div class="tm_bill_value tm_bill_focus">{{ $balanceamount }}.00</div>
                </div>
                <div class="tm_bill_list_in">
                    <div class="tm_bill_title tm_bill_focus">Grand Total :</div>
                    <div class="tm_bill_value tm_bill_focus">{{ $grandtotal }}.00</div>
                </div>
            </div>
            <div class="tm_pos_invoice_body">
                <ul class="tm_list tm_style1" style="padding-top: 15px">
                    <li>
                        {{-- <div class="tm_list_title">Bill No:</div> --}}
                        <div class="tm_list_desc" style="font-weight:500;color:black;"># {{ $billno }}</div>
                    </li>
                    <li class="text-right">
                        {{-- <div class="tm_list_title">Date:</div> --}}
                        <div class="tm_list_desc" style="font-weight:500;color:black;">{{ $date }}</div>
                    </li>
                    <li>
                        {{-- <div class="tm_list_title">P.No :</div> --}}
                        {{-- <div class="tm_list_desc" style="font-weight:800;color:black;">{{ $phoneno }}</div> --}}
                    </li>
                    <li></li>
                    <li style="width:100%;">
                        {{-- <div class="tm_list_title">Address :</div> --}}
                        <div class="tm_list_desc" style="font-weight:800;font-size:15px;color:black;">{{ $name }} | {{ $phoneno }}</div>
                    </li>
                </ul>
                <div class="tm_pos_invoice_heading"><span style="font-weight:500;font-size:15px;color:black;"></span>
                </div>
                   {{-- <div class="tm_pos_company_name">Sree Madapalli, No. 145, South Chitra St, Srirangam.</div> --}}
                    {{-- <div class="tm_pos_company_name"><img src="{{ asset('assets/backend/img/qr.jpg') }}" alt="" width="150"  height="150" ></div> --}}


            </div>
        </div>
        <script>
            //setTimeout(window.close, 7000);
            // window.onload=function(){self.print();}
            // window.onafterprint = function() {
            //     history.go(-1);
            // };
        </script>
    </body>

</html>
