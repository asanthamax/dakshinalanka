@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            {{$status}} Job
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">{{$status}} Job</li>
        </ol>
    </section>
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-md-12">

                <div class="box box-info">

                    <div class="box-header with-border">

                        <h3 class="box-title">{{$status}} New Job</h3>
                        <form class="form-horizontal" method="post" action="{{url(''.$action.'')}}">

                            {{ csrf_field() }}
                            <div class="box-body">

                                <div class="form-group">

                                    <label for="customer_name" class="col-sm-2 control-label">Customer</label>
                                    <div class="col-sm-10">
                                    {{Form::select('customer_name', $customers_list, old('customer_name',$job_data->customerID), array('id' => 'customer_name','class' => 'form-control',$disable => ''))}}
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
                                <input type="hidden" name="jobID" value="{{$job_data->jobID}}">
                                <div class="form-group">

                                    <label for="thickness" class="col-sm-2 control-label">Material</label>
                                    <div class="col-sm-10">
                                    {{Form::select('material', $material_list, old('material', $job_data->material), array('id' => 'material','class' => 'form-control',$disable => ''))}}
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

                                        <input type="text" id="price64" name="thickness" class="form-control" placeholder="Enter Thickness" required value="{{$job_data->thickness}}" {{$disable}}>
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

                                        <input type="text" id="date" name="date" class="form-control" placeholder="Enter Date" value="{{$job_data->date}}" {{$disable}}>
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

                                        <textarea id="description" name="description" class="form-control" placeholder="Enter Description" {{$disable}}>{{$job_data->description}}</textarea>
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

                                        <input type="text" id="job_duration" name="job_duration" class="form-control" placeholder="Enter Job Duration" value="{{$job_data->duration}}" {{$disable}}/>
                                        @if ($errors->has('job_duration'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('job_duration') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">

                                    <label for="job_duration" class="col-sm-2 control-label">Job Status</label>
                                    <div class="col-sm-10">

                                        {{Form::select('status', array('0' => 'Pending','1' => 'Finished'), old('status', $job_data->status), array('id' => 'status','class' => 'form-control',$disable => ''))}}
                                        @if ($errors->has('status'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('status') }}</strong>
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
@endsection