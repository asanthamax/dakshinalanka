@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Add Job
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Add New Job</li>
        </ol>
    </section>
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-md-12">

                <div class="box box-info">

                    <div class="box-header with-border">

                        <h3 class="box-title">Add New Job</h3>
                        <form class="form-horizontal" method="post" action="{{url('savejob')}}">

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

                                    <label for="thickness" class="col-sm-2 control-label">Material</label>
                                    <div class="col-sm-10">
                                        {{Form::select('material', $material_list, old('material'), array('id' => 'material','class' => 'form-control'))}}
                                        <!--<input type="text" class="form-control" name="material" id="material">-->
                                        @if ($errors->has('material'))
                                            <span class="help-block">

                                                <strong>{{$errors->first('material')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="price64" class="col-sm-2 control-label">Thickness</label>
                                    <div class="col-sm-10">

                                        <input type="text" id="price64" name="thickness" class="form-control" placeholder="Enter Thickness" required>
                                        @if ($errors->has('thickness'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('thickness') }}</strong>
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
                                <div class="form-group">

                                    <label for="date" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">

                                        <textarea id="description" name="description" class="form-control" placeholder="Enter Description"></textarea>
                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="job_duration" class="col-sm-2 control-label">Job Duration</label>
                                    <div class="col-sm-10">

                                        <input type="text" id="job_duration" name="job_duration" class="form-control" placeholder="Enter Job Duration"/>
                                        @if ($errors->has('job_duration'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('job_duration') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="box-footer">

                                    <button type="submit" class="btn btn-info pull-right">Add Job</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection