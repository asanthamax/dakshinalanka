@extends('layouts.app')

@section('content')
<style>

    .balance_plus{

        color: green;
    }

    .balance_minus{

       color: red;
    }
</style>
    <section class="content-header">
        <h1>
            Credit Payments
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Credit Payments</a></li>
            <li class="active">Credit Payments</li>
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

                        <h3 class="box-title">Credits</h3>
                        <a class="pull-right btn btn-success" href="{{url('savecredit')}}"><i class="fa fa-plus"></i> Add New Credit Payment</a>
                    </div>
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">

                            <thead>

                            <th>Customer Name</th>
                            <th>Last Paid date</th>
                            <th>Paid Amount</th>
                            <th>Outstanding Amount</th>
                            <th></th>
                            </thead>
                            <tbody>
                            <?php foreach ($credits as $credit): ?>

                            <tr>
                                <td><?php echo load_customers($credit->customer_id); ?></td>
                                <td><?php echo $credit->updated_at; ?></td>
                                <td><?php echo '<p class="balance_plus"><i class="fa fa-plus-circle"></i>  '.$credit->amount_paid.'</p>'; ?></td>
                                <td><?php echo '<p class="balance_minus"><i class="fa fa-minus-circle"></i> '.$credit->outstanding_amount.'</p>'; ?></td>
                                <td>
                                    <a class="btn btn-default" href="{{url('/viewcredit/'.$credit->recordID)}}"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-success" href="{{url('/editcredit/'.$credit->recordID)}}"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger" href="{{url('/removecredit/'.$credit->recordID)}}"><i class="fa fa-trash"></i></a>
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