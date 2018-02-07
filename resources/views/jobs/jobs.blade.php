@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Daily Jobs
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Daily Jobs</a></li>
            <li class="active">Jobs</li>
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

                        <h3 class="box-title">Laser Cutting JOBS</h3>
                        <a class="pull-right btn btn-success" href="{{url('newjob')}}"><i class="fa fa-plus"></i> Add New Job</a>
                    </div>
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">

                            <thead>

                                <th>Job ID</th>
                                <th>Description</th>
                                <th>Material</th>
                                <th>Customer Name</th>
                                <th>Thickness</th>
                                <th>Job Duration</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            <?php foreach($jobs as $job): ?>
                                <tr>
                                    <td>{{$job->jobID}}</td>
                                    <td>{{$job->description}}</td>
                                    <td>{{$job->material}}</td>
                                    <td>{{load_customers($job->customerID)}}</td>
                                    <td>{{$job->thickness}}</td>
                                    <td>{{$job->duration}}</td>
                                    <td><?php if($job->status==0): ?><label class="label label-warning">In Progress</label><?php else: ?><label class="label label-success">Finished</label><?php endif; ?></td>
                                    <td>{{$job->date}}</td>
                                    <td><a class="btn btn-success" href="{{url('editjob/'.$job->jobID)}}"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger" href="{{url('removejob/'.$job->jobID)}}"><i class="fa fa-trash-o"></i></a>
                                        <a class="btn btn-primary" href="{{url('viewjob/'.$job->jobID)}}"><i class="fa fa-eye"></i></a>
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
    <script>

        $(document).ready(function () {

            $('#example1').DataTable();
        });
    </script>
@endsection