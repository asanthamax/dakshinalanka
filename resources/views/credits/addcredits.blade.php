@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            New Credit Payment
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add Payment</li>
        </ol>
    </section>
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-md-12">

                <div class="box box-info">

                    <div class="box-header with-border">

                        <h3 class="box-title">New Credit Payment</h3>
                        <form class="form-horizontal" method="post" action="{{url('addcredit')}}">

                            {{ csrf_field() }}
                            <div class="box-body">

                                <div class="form-group">

                                    <label for="customer_name" class="col-sm-2 control-label">Customer</label>
                                    <div class="col-sm-10">
                                    {{Form::select('customer_name', $customers_list, old('customer_name'), array('id' => 'customer_name','class' => 'form-control'))}}
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
                                <div class="form-group">

                                    <label for="outstanding" class="col-sm-2 control-label">Outstanding amount</label>
                                    <div class="col-sm-10">

                                        <input type="text" id="outstanding" name="outstanding" class="form-control" placeholder="Enter OutStanding Amount" required >
                                        @if ($errors->has('thickness'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('outstanding') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="date" class="col-sm-2 control-label">Date</label>
                                    <div class="col-sm-10">

                                        <input type="text" id="date" name="date" class="form-control" placeholder="Enter Date" >
                                        @if ($errors->has('date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="box-footer">

                                    <button type="submit" class="btn btn-info pull-right">Add Credit Payment Entry</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection