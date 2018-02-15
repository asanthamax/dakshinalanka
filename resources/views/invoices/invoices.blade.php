@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Invoices
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Invoices</a></li>
            <li class="active">Invoices</li>
        </ol>
    </section>
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            @if(Session::has('success'))
                <div id="message" class="alert alert-success">{{session('success')}}</div>
            @endif
            @if(Session::has('error'))
                <div id="message" class="alert alert-danger">{{session('error')}}</div>
            @endif
            <div class="col-md-12">

                <div class="box">

                    <div class="box-header">

                        <h3 class="box-title">Invoices</h3>
                        <a class="pull-right btn btn-success" href="{{url('invoice')}}"><i class="fa fa-plus"></i> Add New Invoice</a>
                    </div>
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">

                            <thead>

                                <th>Invoice ID</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Total Amount(Rs:)</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php foreach ($invoices as $invoice): ?>
                                <tr>
                                    <td>{{$invoice->invoiceID}}</td>
                                    <td>{{load_customers($invoice->customer)}}</td>
                                    <td>{{$invoice->date}}</td>
                                    <td>{{load_invoice_amount($invoice->invoiceID)}}</td>
                                    <td>
                                        <a class="btn btn-success" href="{{url('editinvoice/'.$invoice->invoiceID)}}"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger" href="{{url('removeinvoice/'.$invoice->invoiceID)}}"><i class="fa fa-trash-o"></i></a>
                                        <a class="btn btn-primary" href="{{url('viewinvoice/'.$invoice->invoiceID)}}"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-default" href="{{url('printinvoice')}}"><i class="fa fa-print"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>

        $(document).ready(function () {

            $('#example1').DataTable();
        });
    </script>
@endsection
