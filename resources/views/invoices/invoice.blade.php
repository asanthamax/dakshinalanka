@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Create Invoice
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Create New Invoice</li>
        </ol>
    </section>
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-md-12">

                <div class="box box-info">

                    <div class="box-header with-border">

                        <h3 class="box-title">Create New Invoice</h3>
                        <form class="form-horizontal">

                            {{ csrf_field() }}
                            <div class="box-body">

                                <div class="form-group">

                                    <label for="customer_name" class="col-sm-2 control-label">Select Customer</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="customer_name" id="customer_name">

                                            <option value="">Select Customer</option>
                                            <option value="clear">British Cosmetic</option>
                                            <option value="white">Sidhalepha</option>
                                            <option value="color_sheets">Seylan</option>
                                        </select>
                                        @if ($errors->has('customer_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('customer_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="date" class="col-sm-2 control-label">Date</label>
                                    <div class="col-sm-10">

                                        <input type="text" id="date" name="date" class="form-control" placeholder="Enter Date">
                                        @if ($errors->has('date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group" id="print_records">

                                    <div class="row">
                                        <div class="col-sm-2 col-md-2 col-xs-2">

                                            <input type="text" name="qty[]" class="form-control" placeholder="Enter Quantity">
                                        </div>
                                        <div class="col-sm-5 col-md-5 col-xs-5">

                                            <input type="text" name="particulars[]" class="form-control" placeholder="Enter Particulars">
                                        </div>
                                        <div class="col-sm-1 col-md-1 col-xs-1">

                                            <input type="text" name="desc[]" class="form-control" placeholder="@">
                                        </div>
                                        <div class="col-sm-3 col-md-3 col-xs-3">

                                            <input type="text" name="amount[]" class="form-control" placeholder="Enter amount">
                                        </div>
                                        <div class="col-md-1 col-sm-1 col-xs-12">
                                            <a class="btn btn-danger close_btn" href="javascript:void(0);">X</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">

                                    <button type="button" class="btn btn-success" id="new_row"><i class="fa fa-plus"></i> Add New Row</button>
                                    <button type="submit" class="btn btn-info pull-right">Create Invoice</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>

        $(document).ready(function () {

            $('#new_row').click(function(){

                $('#print_records').append('<br><div class="row">'+
                        '<div class="col-sm-2 col-md-2 col-xs-2">'+

                        '<input type="text" name="qty[]" class="form-control" placeholder="Enter Quantity">'+
                        '</div>'+
                        '<div class="col-sm-5 col-md-5 col-xs-5">'+

                        '<input type="text" name="particulars[]" class="form-control" placeholder="Enter Particulars">'+
                        '</div>'+
                        '<div class="col-sm-1 col-md-1 col-xs-1">'+

                        '<input type="text" name="desc[]" class="form-control" placeholder="@">'+
                        '</div>'+
                        '<div class="col-sm-3 col-md-3 col-xs-3">'+

                        '<input type="text" name="amount[]" class="form-control" placeholder="Enter amount">'+
                        '</div>'+
                        '<div class="col-md-1 col-sm-1 col-xs-12">'+
                        '<a class="btn btn-danger close_btn" href="javascript:void(0);">X</a>'+
                        '</div>'+
                        '</div>')
            })


            $('.close_btn').click(function(){


            })
        })
    </script>
@endsection