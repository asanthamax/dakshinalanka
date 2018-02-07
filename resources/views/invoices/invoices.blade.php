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
                                <th>Total Amount</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>6201</td>
                                <td>British Cosmetic</td>
                                <td>2018/01/04</td>
                                <td>25000</td>
                                <td><a class="btn btn-success" href="#"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger" href="#"><i class="fa fa-trash-o"></i></a>
                                    <a class="btn btn-primary" href="#"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-default" href="#"><i class="fa fa-print"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>6202</td>
                                <td>Sidhalepha</td>
                                <td>2018/01/05</td>
                                <td>35000</td>
                                <td><a class="btn btn-success" href="#"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger" href="#"><i class="fa fa-trash-o"></i></a>
                                    <a class="btn btn-primary" href="#"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-default" href="#"><i class="fa fa-print"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>6203</td>
                                <td>ABC</td>
                                <td>2018/01/08</td>
                                <td>40000</td>
                                <td><a class="btn btn-success" href="#"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger" href="#"><i class="fa fa-trash-o"></i></a>
                                    <a class="btn btn-primary" href="#"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-default" href="#"><i class="fa fa-print"></i></a>
                                </td>
                            </tr>
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