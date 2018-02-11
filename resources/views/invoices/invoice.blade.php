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
                        <form class="form-horizontal" method="post" action="{{url('saveinvoice')}}">

                            {{ csrf_field() }}
                            <div class="box-body">

                                <div class="form-group">

                                    <label for="customer_name" class="col-sm-2 control-label">Select Customer</label>
                                    <div class="col-sm-10">
                                        {{Form::select('customer_name', $customers_list, old('customer_name'), array('id' => 'customer_name','class' => 'form-control'))}}
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

                                            <select name="size" class="size form-control">
                                                <option value="">Please Select the size</option>
                                                <option value="sqft_price">Square Feet</option>
                                                <option value="price64">64 x 64</option>
                                                <option value="price84">84 x 84</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-2 col-md-2 col-xs-2">

                                            <input type="text" name="qty[]" class="form-control" placeholder="Enter Quantity" onchange="calculateAmount($(this))">
                                        </div>
                                        <div class="col-sm-3 col-md-3 col-xs-3">

                                            <input type="text" name="particulars[]" class="form-control" placeholder="Enter Particulars">
                                        </div>
                                        <div class="col-sm-1 col-md-1 col-xs-1">

                                            <input type="text" name="desc[]" class="form-control" placeholder="@">
                                        </div>
                                        <div class="col-sm-3 col-md-3 col-xs-3">

                                            <input type="text" name="amount[]"  class="form-control amount" placeholder="Enter amount">
                                        </div>
                                        <div class="col-md-1 col-sm-1 col-xs-1">
                                            <a class="btn btn-danger close_btn" href="javascript:void(0);">X</a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group" id="laser_cutting">

                                    <div class="row">

                                        <div class="col-sm-5 col-md-5 col-lg-5">

                                           <input type="text" name="laser_custting_description[]" class="form-control" placeholder="Enter Laser Cutting Description">
                                        </div>
                                        <div class="col-sm-2 col-md-2 col-lg-2">

                                           <input type="text" name="laser_cutting_duration[]" class="form-control" placeholder="Enter duration">
                                        </div>
                                        <div class="col-sm-4 col-md-4 col-lg-4">

                                            <input type="text" name="laser_cutting_amount" class="form-control" placeholder="Enter Amount">
                                        </div>
                                        <div class="col-md-1 col-sm-1 col-xs-1">
                                            <a class="btn btn-danger close_btn_laser" href="javascript:void(0);">X</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">

                                    <button type="button" class="btn btn-success" id="new_laser"><i class="fa fa-plus"></i> Add Laser Cutting</button>
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

                        '<select name="size" class="size form-control">'+
                        '<option value="">Please Select the size</option>'+
                        '<option value="price64">64 x 64</option>'+
                        '<option value="price84">84 x 84</option>'+
                        '</select>'+
                        '</div>'+
                        '<div class="col-sm-2 col-md-2 col-xs-2">'+

                        '<input type="text" name="qty[]" class="form-control" placeholder="Enter Quantity">'+
                        '</div>'+
                        '<div class="col-sm-3 col-md-3 col-xs-3">'+

                        '<input type="text" name="particulars[]" class="form-control" placeholder="Enter Particulars">'+
                        '</div>'+
                        '<div class="col-sm-1 col-md-1 col-xs-1">'+

                        '<input type="text" name="desc[]" class="form-control" placeholder="@">'+
                        '</div>'+
                        '<div class="col-sm-3 col-md-3 col-xs-3">'+

                        '<input type="text" name="amount[]" class="form-control amount" placeholder="Enter amount">'+
                        '</div>'+
                        '<div class="col-md-1 col-sm-1 col-xs-12">'+
                        '<a class="btn btn-danger close_btn" href="javascript:void(0);">X</a>'+
                        '</div>'+
                        '</div>')
            });


            $('#new_laser').click(function () {

               $('#laser_cutting').append('<br><div class="row">'+

                       '<div class="col-sm-5 col-md-5 col-lg-5">'+

                        '<input type="text" name="laser_custting_description[]" class="form-control" placeholder="Enter Laser Cutting Description">'+
                        '</div>'+
                        '<div class="col-sm-2 col-md-2 col-lg-2">'+

                        '<input type="text" name="laser_cutting_duration[]" class="form-control" placeholder="Enter duration">'+
                        '</div>'+
                        '<div class="col-sm-4 col-md-4 col-lg-4">'+

                        '<input type="text" name="laser_cutting_amount" class="form-control" placeholder="Enter Amount">'+
                        '</div>'+
                        '<div class="col-md-1 col-sm-1 col-xs-1">'+
                        '<a class="btn btn-danger close_btn_laser" href="javascript:void(0);">X</a>'+
                        '</div>'+
                        '</div>');
            });
            $(document).on('click','a.close_btn',function(){

                //  alert('sdasdad');
                $(this).closest('.row').remove();
            });
            $(document).on('click','a.close_btn_laser',function(){

                $(this).closest('.row').remove();
            })
        })

        function calculateAmount(amount) {

            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '{{url('getprice')}}',
                dataType: 'json',
                data: {diameter: amount.val(), price: amount.closest('.size').val()},
                success:function (data) {

                    amount.closest('.amount').val(data.msg);
                },
                error:function(){

                    alert("Can't connect to server");
                }
            })
        }
    </script>
@endsection