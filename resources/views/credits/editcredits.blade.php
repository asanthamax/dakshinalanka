@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            {{$status}} Credit Payment
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">{{$status}} Credit Payment</li>
        </ol>
    </section>
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-md-12">

                <div class="box box-info">

                    <div class="box-header with-border">

                        <h3 class="box-title">{{$status}} Credit Payment</h3>
                        <form class="form-horizontal" method="post" action="{{url(''.$action.'')}}">

                            {{ csrf_field() }}
                            <div class="box-body">

                                <div class="form-group">

                                    <label for="customer_name" class="col-sm-2 control-label">Customer</label>
                                    <div class="col-sm-10">
                                    {{Form::select('customer_name', $customers_list, old('customer_name',$credit_data->customer_id), array('id' => 'customer_name','class' => 'form-control',$disable => ''))}}
                                    <!--<select class="form-control" name="customer_name" id="customer_name">

                                            <option value="">Select Customer</option>
                                            <option value="clear">British Cosmetic</option>
                                            <option value="white">Sidhalepha</option>
                                            <option value="color_sheets">Seylan</option>
                                        </select>-->
                                        @if ($errors->has('customer_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('customer_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <input type="hidden" name="creditID" value="{{$credit_data->recordID}}">
                                <div class="form-group">

                                    <label for="outstanding" class="col-sm-2 control-label">Outstanding amount</label>
                                    <div class="col-sm-10">

                                        <input type="text" id="outstanding" name="outstanding" class="form-control" placeholder="Enter Outstanding Amount" required value="{{$credit_data->outstanding_amount}}" readonly>
                                        @if ($errors->has('outstanding'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('outstanding') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="date" class="col-sm-2 control-label">Date</label>
                                    <div class="col-sm-10">

                                        <input type="text" id="date" name="date" class="form-control" placeholder="Enter Date" value="{{$credit_data->amount_paid_date}}" {{$disable}}>
                                        @if ($errors->has('date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="job_duration" class="col-sm-2 control-label">Amount Paid</label>
                                    <div class="col-sm-10">

                                        <input type="text" id="amount_paid" name="amount_paid" class="form-control" placeholder="Enter Amount" value="{{$credit_data->amount_paid}}" {{$disable}}/>
                                        @if ($errors->has('job_duration'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('amount_paid') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="box-footer">

                                    <?php if($status != 'View'): ?>
                                    <button type="submit" class="btn btn-info pull-right">{{$status}} Job</button>
                                    <?php else: ?>
                                    <a class="btn btn-info pull-right" href="{{url('jobs')}}">Go Back</a>
                                    <?php endif; ?>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>

        $(document).ready(function(){

            $('#amount_paid').change(function(){

                var paid = $(this).val();
                var outstanding = $('#outstanding').val() - paid;
                $('#outstanding').val(outstanding);
            })
        })
    </script>
@endsection