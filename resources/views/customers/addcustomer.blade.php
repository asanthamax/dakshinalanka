@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Add Customers
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
                        <form class="form-horizontal" method="post" action="{{url('savecustomer')}}">

                            {{ csrf_field() }}
                            <div class="box-body">

                                <div class="form-group">

                                    <label for="customer_name" class="col-sm-2 control-label">Customer Name</label>
                                    <div class="col-sm-10">

                                        <input type="text" id="customer_name" name="customer_name" class="form-control" placeholder="Enter Customer Name" required value="{{ old('customer_name') }}">
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

                                        <input type="text" id="customer_contact" name="contact_no" class="form-control" placeholder="Enter Customer Contact No" required value="{{ old('contact_no') }}">
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

                                        <input type="text" id="customer_email" name="customer_email" class="form-control" placeholder="Enter Customer Email" value="{{ old('customer_email') }}">
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

                                        <textarea type="text" id="customer_address" name="customer_address" class="form-control" placeholder="Enter Customer Address">{{ old('customer_address') }}</textarea>
                                        @if ($errors->has('customer_address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('customer_address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">

                                <button type="submit" class="btn btn-info pull-right">Add Customer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection