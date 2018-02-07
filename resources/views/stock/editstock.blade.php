@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            {{$status}} Stock
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">{{$status}} Sheet</li>
        </ol>
    </section>
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-md-12">

                <div class="box box-info">

                    <div class="box-header with-border">

                        <h3 class="box-title">{{$status}} Sheet</h3>
                        <form class="form-horizontal" method="post" action="{{url(''.$action.'')}}">

                            {{ csrf_field() }}
                            <div class="box-body">

                                <div class="form-group">

                                    <label for="customer_name" class="col-sm-2 control-label">Sheet Type</label>
                                    <div class="col-sm-10">
                                        {{Form::select('sheet_type', array('' => 'Select Sheet Type','clear' => 'Clear', 'white' => 'White','color_sheets' => 'Color Sheets'), old('sheet_type', $stock_data->sheet_type), array('id' => 'sheet_type','class' => 'form-control',$diable => ''))}}
                                       <!-- <select class="form-control" name="sheet_type" id="sheet_type">

                                            <option value="">Select Sheet Type</option>
                                            <option value="clear">Clear</option>
                                            <option value="white">White</option>
                                            <option value="color_sheets">Color Sheets</option>
                                        </select>-->
                                        @if ($errors->has('sheet_type'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('sheet_type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="thickness" class="col-sm-2 control-label">Sheet Thickness</label>
                                    <div class="col-sm-10">

                                        <input type="text" class="form-control" name="thickness" id="thickness" value="{{old('thickness',$stock_data->sheet_thickness)}}" {{$diable}}>
                                        @if ($errors->has('thickness'))
                                            <span class="help-block">

                                                <strong>{{$errors->first('thickness')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="price64" class="col-sm-2 control-label">6 x 4 Price</label>
                                    <div class="col-sm-10">

                                        <input type="text" id="price64" name="price64" class="form-control" placeholder="Enter Customer Contact No" required value="{{old('price64',$stock_data->price64)}}" {{$diable}}>
                                        @if ($errors->has('price64'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('price64') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="price84" class="col-sm-2 control-label">8 x 4 Piece Price</label>
                                    <div class="col-sm-10">

                                        <input type="text" id="price84" name="price84" class="form-control" placeholder="Enter Customer Email" value="{{old('price84', $stock_data->price84)}}" {{$diable}}>
                                        @if ($errors->has('price84'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('price84') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="square_feet_price" class="col-sm-2 control-label">1 Square Feet Price</label>
                                    <div class="col-sm-10">

                                        <input type="text" id="square_feet_price" name="square_feet_price" class="form-control" placeholder="Enter Customer Address" value="{{old('square_feet_price', $stock_data->sqft_price)}}" {{$diable}}/>
                                        @if ($errors->has('customer_address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('square_feet_price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="material" class="col-sm-2 control-label">Material</label>
                                    <div class="col-sm-10">

                                        <input type="text" id="material" name="material" class="form-control" placeholder="Enter Item Material" value="{{old('material',$stock_data->material)}}" {{$diable}}/>
                                        @if ($errors->has('material'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('material') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="qty_available" class="col-sm-2 control-label">Quantity Available</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="qty_available" class="form-control" name="qty_available" placeholder="Enter Quantity have Currently" value="{{old('qty_available',$stock_data->quantity)}}" {{$diable}}>
                                        @if ($errors->has('qty_available'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('qty_available') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <input type="hidden" name="stockID" value="{{$stock_data->stockID}}">
                                <div class="box-footer">

                                    <?php if($status != 'View'): ?>
                                    <button type="submit" class="btn btn-info pull-right">{{$status}} Stock</button>
                                    <?php else: ?>
                                    <a class="btn btn-info pull-right" href="{{url('stocks')}}">Go Back</a>
                                    <?php endif; ?>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection