<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dakshinalanka</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>

        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }
        table {
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <!--<div class="container">-->

        <strong style="text-align: center;color: #2f7ac4;"><h3>Dakshina Lanka Advertising</h3></strong>
        <p style="text-align: center;color: #2f7ac4;"><b>444/10/F, Delgahawatta Road, Rathmalana. Tel: 0112723696</b></p>
        <p style="text-align: center;color: #2f7ac4;"><b>Web: www.dakshinalanka.lk, Email: dakshinaads@gmail.com</b></p>
        <br>
        <h4 style="color: #2f7ac4;text-align: center;">INVOICE</h4>
        <br>
        <div class="float-right" style="color: black;"><b>{{$invoice_id}}</b></div>
        <br>
        <hr style="background-color: #2f7ac4;height: 3px;">
        <div class="float-left">

            <strong style="color: #2f7ac4;">Client: {{load_customers($invoice['customer'])}}</strong>
        </div>
        <div class="float-right" style="border: 1px solid #2f7ac4; color: #2f7ac4;">

            <strong>Date: {{$invoice['date']}}</strong>
        </div>
        <br>
        <br>
        <br>
        <br>
        <table class="table table-bordered table-striped">

            <thead>
            <tr>
            <th width="10%" style="color: #2f7ac4;border: 1px solid #2f7ac4;">Qty-(Sheets)</th>
            <th width="60%" style="color: #2f7ac4;border: 1px solid #2f7ac4;">Particulars</th>
            <th width="30" style="color: #2f7ac4;border: 1px solid #2f7ac4;">Amount(Rs:)</th>
            </tr>
            </thead>
            <tbody>

            <?php $total = 0; foreach($invoice_details as $details): ?>
            <tr>
                <td style="border: 1px solid #2f7ac4;">{{$details['quantity']}}</td>
                <td style="border: 1px solid #2f7ac4;">{{$details['description']}}</td>
                <td style="border: 1px solid #2f7ac4;">{{$details['amount']}}</td>
            </tr>
            <?php
            $total += $details['amount'];
            ?>
            <?php endforeach; ?>
            <?php foreach($invoice_details_laser as $laser): ?>
            <tr>
                <td colspan="2" style="border: 1px solid #2f7ac4;">{{$laser['description']}}</td>
                <td style="border: 1px solid #2f7ac4;">{{$laser['amount']}}</td>
            </tr>
            <?php
            $total += $laser['amount'];
            ?>
            <?php endforeach; ?>
            <tr>
                <td colspan="2" style="text-align: right;border: 1px solid #2f7ac4;">

                    <b style="color: #2f7ac4;">Total Amount</b>
                </td>
                <td style="border: 1px solid #2f7ac4;">
                    {{$total}}
                </td>
            </tr>
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <br>
        <div class="float-right">
            <p style="color: #2f7ac4;"><b>...........................................</b></p>
            <p style="color: #2f7ac4;"><b>Signature</b></p>
        </div>
    <!--</div>-->
</body>
</html>
