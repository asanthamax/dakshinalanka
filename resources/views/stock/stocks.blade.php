@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Stocks
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Sheets Stock</a></li>
            <li class="active">Sheets</li>
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

                        <h3 class="box-title">Sheets Stock</h3>
                        <a class="pull-right btn btn-success" href="{{url('addstock')}}"><i class="fa fa-plus"></i> Add New Sheet</a>
                    </div>
                    <div class="box-body">

                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">

                            <thead>

                                <th>Sheet Type</th>
                                <th>Sheet Thickness</th>
                                <th>6 x 4 Price</th>
                                <th>8 x 4 Price</th>
                                <th>1 Sqare feet Price</th>
                                <th>Available Quantity</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php foreach ($stocks as $stock): ?>
                                <tr>
                                    <td>{{$stock->sheet_type}}</td>
                                    <td>{{$stock->sheet_thickness}}</td>
                                    <td>{{$stock->price64}}</td>
                                    <td>{{$stock->price84}}</td>
                                    <td>{{$stock->sqft_price}}</td>
                                    <td>{{$stock->quantity}}</td>
                                    <td><a class="btn btn-success" href="{{url('editstock/'.$stock->stockID)}}"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger" href="{{url('removestock/'.$stock->stockID)}}"><i class="fa fa-trash-o"></i></a>
                                        <a class="btn btn-default" href="{{url('viewstock/'.$stock->stockID)}}"><i class="fa fa-eye"></i></a>
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