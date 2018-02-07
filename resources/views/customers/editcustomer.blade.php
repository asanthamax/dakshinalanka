@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            {{$status}} Customers
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Customer</li>
        </ol>
    </section>
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">

                <div class="box box-info">

                    <div class="box-header with-border">

                        <h3 class="box-title">Add New Customer</h3>
                        <form class="form-horizontal" method="post" action="{{url(''.$action.'')}}">

                            {{ csrf_field() }}
                            <div class="box-body">

                                <div class="form-group">

                                    <label for="customer_name" class="col-sm-2 control-label">Customer Name</label>
                                    <div class="col-sm-10">

                                        <input type="text" id="customer_name" name="customer_name" class="form-control" placeholder="Enter Customer Name" required value="{{ old('customer_name', $customer_data->customer_name) }}" {{$diable}}>
                                        @if ($errors->has('customer_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->get('customer_name')->all() }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="customer_name" class="col-sm-2 control-label">Customer Contact No</label>
                                    <div class="col-sm-10">

                                        <input type="text" id="customer_contact" name="contact_no" class="form-control" placeholder="Enter Customer Contact No" required value="{{ old('contact_no', $customer_data->contact_no) }}" {{$diable}}>
                                        @if ($errors->has('contact_no'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('contact_no') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="customer_name" class="col-sm-2 control-label">Customer Email</label>
                                    <div class="col-sm-10">

                                        <input type="text" id="customer_email" name="customer_email" class="form-control" placeholder="Enter Customer Email" value="{{ old('customer_email', $customer_data->customer_email) }}" {{$diable}}>
                                        @if ($errors->has('customer_email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('customer_email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="customer_name" class="col-sm-2 control-label">Customer Address</label>
                                    <div class="col-sm-10">

                                        <textarea type="text" id="customer_address" name="customer_address" class="form-control" placeholder="Enter Customer Address" {{$diable}}>{{ old('customer_address', $customer_data->customer_address) }}</textarea>
                                        @if ($errors->has('customer_address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('customer_address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="customerID" value="{{$customer_data->customerID}}">
                            <div class="box-footer">

                                <?php if($status != 'View'): ?>
                                    <button type="submit" class="btn btn-info pull-right">{{$status}} Customer</button>
                                <?php else: ?>
                                    <a class="btn btn-info pull-right" href="{{url('customers')}}">Go Back</a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection