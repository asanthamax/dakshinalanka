@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Customers
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Customers</a></li>
            <li class="active">Customers</li>
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

                        <h3 class="box-title">Customers</h3>
                        <a class="pull-right btn btn-success" href="{{url('addcustomers')}}"><i class="fa fa-plus"></i> Add New Customer</a>
                    </div>
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">

                            <thead>

                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Contact No</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php foreach ($customers as $customer): ?>

                                    <tr>
                                        <td><?php echo $customer->customer_name; ?></td>
                                        <td><?php echo $customer->customer_email; ?></td>
                                        <td><?php echo $customer->contact_no; ?></td>
                                        <td>
                                            <a class="btn btn-default" href="{{url('/viewcustomer/'.$customer->customerID)}}"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-success" href="{{url('/editcustomer/'.$customer->customerID)}}"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger" href="{{url('/removecustomer/'.$customer->customerID)}}"><i class="fa fa-trash"></i></a>
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
@endsection